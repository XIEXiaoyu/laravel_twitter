<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\sendTweet_msg;
use App\follow_relation;
use Redirect;

class tweetsController extends Controller
{
    public function profile_show(Request $request)
    {
        $user_id = $request->get('user_id');
        $visitor = $request->session()->get('user_id');

        $isMyself = false;
        $is_followed = false;

        if($user_id == $visitor)
        {
            $isMyself = true;
            $is_follow = true;
        }
        else
        {
            $isMyself = false;

            $follow_relation = new follow_relation;
            $record = $follow_relation::where('follower', $user_id)
                        ->where('user_id', $visitor)
                        ->get();
            $is_followed = ! $record->isEmpty();
        }

        // sence2: the login user(user A) watch another user's(user B)
        // profile. Two cases, case1: he has followed B, then display
        // 'already followed', if not, case 2: display 'follow me'.

    	$posts = sendTweet_msg::where('user_id', $user_id)
    			->orderBy('created_at', 'desc')
    			->get();

    	return view('tweets.profile', array(
    		'posts' => $posts,
            'isMyself' => $isMyself,
            'is_followed' => $is_followed,
            'user_id' => $request->get('user_id'),
    	));
    }

    public function profile_follow(Request $request)
    {
        // user
        $user_id = $request->session()->get('user_id');

        // 想要 Follow 谁？
        $follow_who = $request->input('follow_who');

        // save following action to database
        $follow_relation = new follow_relation;

        $follow_relation->user_id = $user_id;
        $follow_relation->follower = $follow_who;

        $follow_relation->save();

        // return to profile page
        return Redirect::to('profile?user_id=' . $follow_who);
    }

    public function timeline_show()
    {
    	return view('tweets.timeline');
    }
}
