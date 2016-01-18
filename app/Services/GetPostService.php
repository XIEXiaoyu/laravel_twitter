<?php
namespace App\Services;

use App\User;
use App\Tweet;
use App\follow_relation;

class GetPostService {
	public function followingPost(User $user, $number = 0){
		$following = follow_relation::where('user_id', $user->id) // $ followed are all the users's records that 'me' has followed 
                        ->orderBy('created_at', 'desc')
                        ->get();

        $cond = "user_id in ("; // suppose 'me' has followed user with id of 8, 9, then we want to construct a condition statment of "(id not in 8, 9, 0)". Throught $user->following, we can get oen id.

        foreach($following as $u)
        {
            $cond .= $u->following . ',';
        }
        $cond .= $user->id;
        $cond .= ")";

        //get all the posts from the 'tweets' database table
		$followingPosts = Tweet::whereraw($cond)
						->orderBy('created_at', 'desc');
		if($number != 0){
			$followingPosts->take($number);
		}

		return $followingPosts->get();
	}
}