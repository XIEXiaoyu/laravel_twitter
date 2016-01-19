<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tweet;
use App\follow_relation;
use App\User;
use Redirect;
use App\Services\FollowService;
use App\Services\GetPostService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;


class tweetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('log');
    }
    
    public function timeline_display(Request $request, FollowService $followService, GetPostService $getPostService)
    {
        // 'me' is the login user
        $me_id = $request->session()->get('me_id');

        // the profile that 'me' is visiting belongs to the user_id  
        $user_id = $request->get('user_id');

        $isMyself = false;
        $isFollowing = false;

        // check if the login user is visiting his own timeline
        if($user_id == $me_id)
        {
            $isMyself = true;   // if $isMyself is true, then don't
                                // display any 'follow me' or 'alre-
                                // ady followed' button on the profile

            $isFollowing = true;  // if $is_follow is true, then display
                                // 'already followed' on the profile
        }
        else
        {
            // check if the profile's owner is followed by 'me'
            $following = follow_relation::where('user_id', $me_id)
            ->where('following', $user_id)
            ->first();

            if($following)  // if 'me' follows the profile's owner
            {
                $isFollowed = true;
            }
        }


        // get the user's information
        $user = User::where('id', $user_id)->first();


        // get 'me' info
        $me = User::where('id', $me_id)->first(); //first() returns a User instance

        // get all the tweets from users who is followed by 'me'
        $followingPosts = $getPostService->followingPost($me);
        $followingTweets = $followingPosts->simplePaginate(3);
        $followingTweets->setPath('timeline');

        // get infos of all users whom '$me' is following.
        $followingUsers = $me->following();    
        $followings = [];
        foreach($followingUsers as $u)
        {
            $followings[$u->id] = $u;
        }
        $followings[$me->id] = $me;

        // // get the user's posts
        // $tweets = Tweet::where('user_id', $user_id)
        // ->orderBy('created_at', 'desc')
        // ->get();

        // get the people that he hasn't followed
        $notFollowings = $followService->notFollowing($user, 3);

        return view('tweets.timeline', array(
            'isMyself' => $isMyself,
            'isFollowing' => $isFollowing,
            'user' => $user,
            'me' => $me,
            'me_id' => $me_id,
            'notFollowings' => $notFollowings,
            'followingTweets' => $followingTweets,
            'followings' => $followings,
        ));
    }

    // public function xx(Request $request)
    // {
    //     // me
    //     $me_id = $request->session()->get('me_id');

    //     // the person that 'me' wants to follow
    //     $follow_who = $request->input('follow_who');

    //     // save following action to database
    //     $follow_relation = new follow_relation;

    //     $follow_relation->user_id = $me_id;
    //     $follow_relation->follower = $follow_who;

    //     $follow_relation->save();

    //     // return to profile page
    //     return Redirect::to('profile?user_id=' . $follow_who);
    // }

    public function xx(Request $request)
    {   
        $me_id = $request->session()->get('me_id');
        
        // get 'me' info
        $me = User::where('id', $me_id)->first();

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
        $followed = User::whereraw($cond2)
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
