<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\follow_relation;
use Redirect;
use App\Services\FollowService;

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

        // $unfollowed = $me->unfollowed();

        $follow_servive = new FollowService;   // users that 'me' is not following  
        $not_following = $follow_servive->notFollowing($me);

        $unfollowed_ids = []; // $unfollowed_ids contains all the ids of the users that 'me' is not following
        foreach($not_following as $u)
        {
            $unfollowed_ids[] = $u->id;
        }

        $flag = null;

        return view('follow_list', [
            'me' => $me, 
            'users' => $users, 
            'unfollowed_ids' => $unfollowed_ids, 
            'flag' => $flag,
        ]);
	}


    public function display_not_following(Request $request, FollowService $followService) 
    {
        $me_id = $request->session()->get('me_id');

        $me = User::where('id', $me_id)->first(); // $me is used for app.blade.php

        $notFollowing = $followService->notFollowing($me);

        $flag = "unfollowed";

        return view('follow_list', [
            'me'    => $me,
            'users' => $notFollowing,
            'flag'  => $flag,
        ]);
    }

    public function display_following(Request $request)
    {
    	$me_id = $request->session()->get('me_id');

        $me = User::where('id', $me_id)->first(); // $me is used for app.blade.php

        $following = $me->following(); 

       	$flag = "followed";

        return view('follow_list', [
            'me'    => $me, 
            'users' => $following, 
            'flag'  => $flag,
        ]);           
    }
}
