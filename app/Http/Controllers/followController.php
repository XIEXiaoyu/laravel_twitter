<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\userInfo;
use App\follow_relation;
use Redirect;

class followController extends Controller
{
    public function __construct()
    {
        $this->middleware('log');
    }
    
	public function display_all_user(Request $request)
	{
        $users = userInfo::all();

        // find out the array that contains lists of unfollowed users.
        $user_id = $request->session()->get('me_id');

        $unfollowed = [];
        
        $users_followed = follow_relation::where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $cond = "id not in (";
        foreach($users_followed as $user)
        {
            $cond .= $user->follower . ',';
        }
        $cond .= 0;
        $cond .= ")";

        $users_unfollowed = userInfo::whereraw($cond)
                            ->orderBy('created_at', 'desc')
                            ->get();

        foreach($users_unfollowed as $user_unfollowed)
        {
            $unfollowed[] = $user_unfollowed->id;
        }

        return view('follow_list', ['users' => $users, 'unfollowed' => $unfollowed]);
	}

    public function display_unfollowed(Request $request) 
    {
        $user_id = $request->session()->get('me_id');

        // users who he doesn't follow in the database table 'userInfo'
        $users_followed = follow_relation::where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $cond = "id not in (";
        foreach($users_followed as $user)
        {
            $cond .= $user->follower . ',';
        }
        $cond .= $user_id;
        $cond .= ")";

        $users_unfollowed = userInfo::whereraw($cond)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $flag = "unfollowed";

        return view('follow_list', ['users' => $users_unfollowed, 'flag' => $flag]);
    }

    public function display_followed(Request $request)
    {
    	$user_id = $request->session()->get('me_id');

    	// users that he has followed
    	$followed_id = follow_relation::where('user_id', $user_id)
               ->orderBy('created_at', 'desc')
               ->get();

        $cond = "id in (";
        foreach($followed_id as $user)
        {
        	$cond .= $user->follower . ',';
        }
        $cond .= 0;
        $cond .= ")";

        $users_followed = userInfo::whereraw($cond)
        					->orderBy('created_at', 'desc')
        					->get();
       	$flag = "followed";

        return view('follow_list', ['users' => $users_followed, 'flag' => $flag]);           
    }
}
