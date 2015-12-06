<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\sendTweet_msg;
use App\follow_relation;
use App\userInfo;
use Redirect;

class tweetsController extends Controller
{
    public function profile_display(Request $request)
    {
        if(empty($request->session()->get('user_id')))
        {
            return Redirect::to('login');
        }

        // 'me' is the login user
        $me = $request->session()->get('user_id');

        // 'me' is visiting the the profile belongs to the user_id  
        $user_id = $request->get('user_id');

        $isMyself = false;
        $isFollowed = false;

        // check if the login user is visiting his own profile
        if($user_id == $me)
        {
            $isMyself = true;   // if $isMyself is true, then don't
                                // display any 'follow me' or 'alre-
                                // ady followed' button on the profile

            $isFollowed = true;  // if $is_follow is true, then display
                                // 'already followed' on the profile
        }

        // get the user's information
        $user = userInfo::where('id', $user_id)->first();

        // get the user's posts
        $posts = sendTweet_msg::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->get();

        // check if the profile's owner is followed by 'me'
        $followed = follow_relation::where('user_id', $me)
        ->where('follower', $user_id)
        ->first();

        if($followed)  // if 'me' follow the profile's owner
        {
            $isFollowed = true;
        }

        return view('tweets.profile', array(
            'posts' => $posts,
            'isMyself' => $isMyself,
            'isFollowed' => $isFollowed,
            'user' => $user,
            'me' => $me,
        ));
    }

    public function profile_follow(Request $request)
    {
        if(empty($request->session()->get('user_id')))
        {
            return Redirect::to('login');
        }
        else
        {
            // me
            $me = $request->session()->get('user_id');

            // the person that 'me' wants to follow
            $follow_who = $request->input('follow_who');

            // save following action to database
            $follow_relation = new follow_relation;

            $follow_relation->user_id = $me;
            $follow_relation->follower = $follow_who;

            $follow_relation->save();

            // return to profile page
            return Redirect::to('profile?user_id=' . $follow_who);
        }
    }

    public function timeline_show(Request $request)
    {
       if(empty($request->session()->get('user_id')))
        {
            return Redirect::to('login');
        }

    
        $login_user = $request->session()->get('user_id');

        $all_login_user_followed = follow_relation::where('user_id', $login_user)
                                    ->get();

        $cond = "user_id in (";

        foreach($all_login_user_followed as $follow_who)
        {
            $cond .= $follow_who->follower . ", ";
        }
        $cond .= $login_user;
        $cond .= ")";

        $all_followed_posts = sendTweet_msg::whereraw($cond)
                                ->orderBy('created_at', 'desc')->simplePaginate(3);
                                // ->get()->simplePaginate(3);
        
        $cond2 = "id in (";
        foreach($all_login_user_followed as $follow_who)
        {
            $cond2 .= $follow_who->follower . ", ";
        }
        $cond2 .=$login_user;
        $cond2 .= ")";

        $followed = userInfo::whereraw($cond2)
                                ->orderBy('created_at', 'desc')
                                ->get();

        $all_followed_userInfo = [];

        foreach($followed as $u){
            $all_followed_userInfo[$u->id] = $u;
        }

        return view('tweets.timeline', [
            'all_followed_posts' => $all_followed_posts, 
            'all_followed_userInfo' => $all_followed_userInfo,
        ]);           
        
    }
}
