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
    public function profile_show(Request $request)
    {
        if(empty($request->session()->get('user_id')))
        {
            return Redirect::to('login');
        }

        $user_id = $request->get('user_id');
        
        $visitor = $request->session()->get('user_id');

        $isMyself = false;
        $is_followed = false;

        // if profile displays the login user's page, then don't 
        // display 'follow me' button. If alreay followed, display
        // 'already followed' instead of diplay 'follow me'.
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

        $posts = sendTweet_msg::where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->get();

        $sig_record = userInfo::where('id', $user_id)->first();
        $user_name = $sig_record->user_name;
        $signature = $sig_record->signature;
        $name = $sig_record->name;

        return view('tweets.profile', array(
            'posts' => $posts,
            'isMyself' => $isMyself,
            'is_followed' => $is_followed,
            'user_id' => $request->get('user_id'),
            'signature' => $signature,
            'user_name' => $user_name,
            'name' => $name,
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
