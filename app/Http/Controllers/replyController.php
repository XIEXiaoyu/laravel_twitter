<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\userInfo;
use App\Tweet;
use App\Http\Controllers\Controller;

class replyController extends Controller
{
    public function __construct()
    {
        $this->middleware('log');
    }

    public function reply_display(Request $request)
    {
        /*  
        The replay page will display all the posts and an emtpy 
        post which is used to wait for the new post. 
        All the posts are displayed in the descending order acc-
        ording to when they are created.
        */

        // get the thread_id of the tweet
        $tweet_id = $request->input('tweet_id');
        $tweet = Tweet::where('id', $tweet_id)->first();
        $thread_id = $tweet->thread_id;

        // get all the tweets that belongs to the thread
        $tweets = Tweet::where('thread_id', $thread_id)
                ->orderBy('created_at', 'asc')
                ->get();

        // As we need to display the personal info, for exmaple, name 
        // and user_name of the poster, so we need to get all the users 
        // of these posts. This is done by the following 3 steps:
        // 1. set the condition
        $cond = "id in (";
        foreach($tweets as $tweet)
        {
            $cond .= $tweet->user_id;
            $cond .= ',';
        }
        $cond .= '0';
        $cond .= ')';

        // 2. get users from database
        $records = userInfo::whereraw($cond)
                ->get();

        // 3. create a new array $users[], and let the index of the 
        // array element the same with the record's id.
        $users = [];
        foreach($records as $u)
        {
            $users[$u->id] = $u;
        } 


        // Need to display an empty post for 'me' to enter
        // get user_id. The user is the owner of the thread
    	$user_id = $request->input('user_id');       

        // get 'me' id
        $me_id = $request->session()->get('me_id');

        // need 'me' at hand for the app.blade.php, meanwhile, if 
        // 'me' is not in users
        $me = userInfo::where('id', $me_id)->first();

    	return view('reply', [
            'tweets' => $tweets,
            'users' => $users,
    		'user_id' => $user_id,
            'me_id' => $me_id, 
            'thread_id' => $thread_id,
            'me' => $me,
    	]);
    }

    public function reply_process(Request $request)
    {
        // save the reply into database table Tweets
        $message = $request->input('message');
        $user_id = $request->input('user_id');
        $reply_to = $request->input('reply_to');
        $thread_id = $request->input('thread_id');
        
        $tweet = new Tweet;
        $tweet->user_id = $user_id;
        $tweet->reply_to = $reply_to;
        $tweet->message = $message;
        $tweet->thread_id = $thread_id;
        $tweet->save();

        // get all the posts include the original one in one thread
        $tweets = Tweet::where('thread_id', $thread_id)
               ->orderBy('created_at', 'asc')
               ->get();

        // get all the users who are the owners of these tweets
        $cond = "id in (";
        foreach($tweets as $tweet)
        {
            $cond .= $tweet->user_id;
            $cond .= ',';
        }
        $cond .= '0';
        $cond .= ')';
        
        $records = userInfo::whereRaw($cond)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $users = [];

        foreach($records as $u)
        {
            $users[$u->id] = $u;
        }

        // get me for the app.blade.php
        $me = $users[$user_id];

        // display all the posts
        return view('reply', [
            'tag' => 'all_posts',
            'tweets' => $tweets, 
            'users' => $users,
            'me' => $me,
        ]);
    }
}
