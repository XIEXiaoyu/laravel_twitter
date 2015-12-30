<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\follow_relation;
use Redirect;

class followController extends Controller
{
    public function __construct()
    {
        $this->middleware('log');
    }
    
	public function display_all(Request $request)
	{
        // in this funtion, we will list all the users in the database no matter if the user is followed by me or not, but we need to disinguish if the user is followed not not. If 'me' has followed the user, then in the view, we would display 'followed' besides the user. If not so, we will display 'following' besides the user. 

        $users = User::all();// $users is all the users that in the database

        $me_id = $request->session()->get('me_id');

        $me = User::where('id', $me_id)->first(); // $me is used for app.blade.php
        
        $followed = follow_relation::where('id', $me_id) // $followed is all the uses that 'me' have followed. We can find out all the users that I have not followed by substracting the users that I have followed in all the users.
                        ->orderBy('created_at', 'desc')        
                        ->get();

        $cond = "id not in ("; // Suppose 'me' have followed user with id 8 and 9, then we want to construct a condition like: " id not in (8, 9, 0)". There is no user with id 0.
        foreach($followed as $followed_)
        {
            $cond .= $followed_->follower . ',';
        }
        $cond .= 0;
        $cond .= ")";
        
        // we are going to get an $unfollowed array, the arrary contains all the users' ids that 'me' has not followed. so that in the view, we could check each id in $all, if the id is in the $unfollowd array, then we display 'following' besides the user. 
        $unfollowed = User::whereraw($cond)
                            ->orderBy('created_at', 'desc')
                            ->get();


        $unfollowed_ids = []; // $users contains all the ids of the users that 'me' haven't followed
        foreach($unfollowed as $unfollowed_)
        {
            $unfollowed_ids[] = $unfollowed_->id;
        }

        $flag = null;
        
        return view('follow_list', ['me' => $me, 'users' => $users, 'unfollowed_ids' => $unfollowed_ids, 'flag' => $flag]);
	}


    public function display_unfollowed(Request $request) 
    {
        $me_id = $request->session()->get('me_id');

        $me = User::where('id', $me_id)->first(); // $me is used for app.blade.php

        $followed = follow_relation::where('id', $me_id) // $ followed are all the users's records that 'me' has followed 
                        ->orderBy('created_at', 'desc')
                        ->get();

        $cond = "id not in ("; // suppose 'me' has followed user with id of 8, 9, then we want to construct a condition statment of "(id not in 8, 9, 0)". Throught $user->follower, we can get oen id.

        foreach($followed as $user)
        {
            $cond .= $user->follower . ',';
        }
        $cond .= $user_id;
        $cond .= ")";

        $unfollowed = User::whereraw($cond)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $flag = "unfollowed";

        return view('follow_list', ['me' => $me, 'users' => $unfollowed, 'flag' => $flag]);
    }

    public function display_followed(Request $request)
    {
    	$me_id = $request->session()->get('me_id');

        $me = User::where('id', $me_id)->first(); // $me is used for app.blade.php

    	$followed = follow_relation::where('id', $me_id) // $followed is all users' records that 'me' have followed.
               ->orderBy('created_at', 'desc')
               ->get();


        $cond = "id in ("; // suppose 'me' have followed user with id 8, 9, then I want to construct a condition like "id in (8, 9, 0)". Of course, no user has an id of 0. Throught $user->follower, we can get one id.
        foreach($followed as $user)
        {
        	$cond .= $user->follower . ',';
        }
        $cond .= 0;
        $cond .= ")";

        $followed = User::whereraw($cond)
        					->orderBy('created_at', 'desc')
        					->get();
       	$flag = "followed";

        return view('follow_list', ['me' => $me, 'users' => $followed, 'flag' => $flag]);           
    }
}
