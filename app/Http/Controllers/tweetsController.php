<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tweet;
use App\follow_relation;
use App\userInfo;
use Redirect;

class tweetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('log');
    }
    
    public function profile_display(Request $request)
    {
        // 'me' is the login user
        $me_id = $request->session()->get('me_id');

        // 'me' is visiting the the profile belongs to the user_id  
        $user_id = $request->get('user_id');

        $isMyself = false;
        $isFollowed = false;

        // check if the login user is visiting his own profile
        if($user_id == $me_id)
        {
            $isMyself = true;   // if $isMyself is true, then don't
                                // display any 'follow me' or 'alre-
                                // ady followed' button on the profile

            $isFollowed = true;  // if $is_follow is true, then display
                                // 'already followed' on the profile
        }

        // get the user's information
        $user = userInfo::where('id', $user_id)->first();

        // get 'me' info
        $me = userInfo::where('id', $me_id)->first();

        // get the user's posts
        $tweets = Tweet::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->get();

        // check if the profile's owner is followed by 'me'
        $followed = follow_relation::where('user_id', $me_id)
        ->where('follower', $user_id)
        ->first();

        if($followed)  // if 'me' follow the profile's owner
        {
            $isFollowed = true;
        }



        return view('tweets.profile', array(
            'tweets' => $tweets,
            'isMyself' => $isMyself,
            'isFollowed' => $isFollowed,
            'user' => $user,
            'me' => $me,
            'me_id' => $me_id,
        ));
    }

    public function profile_follow(Request $request)
    {
        // me
        $me_id = $request->session()->get('me_id');

        // the person that 'me' wants to follow
        $follow_who = $request->input('follow_who');

        // save following action to database
        $follow_relation = new follow_relation;

        $follow_relation->user_id = $me_id;
        $follow_relation->follower = $follow_who;

        $follow_relation->save();

        // return to profile page
        return Redirect::to('profile?user_id=' . $follow_who);
    }

    public function timeline_display(Request $request)
    {   
        $me_id = $request->session()->get('me_id');
        
        // get 'me' info
        $me = userInfo::where('id', $me_id)->first();

        $user_id = $request->input('user_id');

        // find out who the 'usr' has followed
        $user_followed = follow_relation::where('user_id', $user_id)
                        ->get();

        // find the condition that like user_id in (8, 9, 10),
        // you have followed users with id 8, 9 and 10.
        $cond = "user_id in (";

        foreach($user_followed as $follow_who)
        {
            $cond .= $follow_who->follower . ", ";
        }
        $cond .= $user_id;
        $cond .= ")";

        // find out all the posts of whom you have followed and 
        // including yourself
        $followed_posts = Tweet::whereraw($cond)
                                ->orderBy('created_at', 'desc')
                                ->simplePaginate(3);
        
        // find the condition that like id in userInfo with id in 
        // (8, 9, 10),
        $cond2 = "id in (";
        foreach($user_followed as $follow_who)
        {
            $cond2 .= $follow_who->follower . ", ";
        }
        $cond2 .=$user_id;
        $cond2 .= ")";

        // To get all the followed users' detail personal information
        $followed = userInfo::whereraw($cond2)
                                ->orderBy('created_at', 'desc')
                                ->get();

        $followed_userInfo = [];

        foreach($followed as $u){
            $followed_userInfo[$u->id] = $u;
        }

        $user = $followed_userInfo[$user_id];

        return view('tweets.timeline', [
            'followed_posts' => $followed_posts, 
            'followed_userInfo' => $followed_userInfo,
            'user' => $user,
            'me' => $me,
        ]);                  
    }
}
