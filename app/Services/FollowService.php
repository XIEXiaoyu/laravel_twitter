<?php

namespace App\Services;

use App\User;
use App\follow_relation;

class FollowService {

	/**
	 * 
	 */
	public function notFollowing(User $user)
	{

        $following = follow_relation::where('follower', $user->id) // $ followed are all the users's records that 'me' has followed 
                        ->orderBy('created_at', 'desc')
                        ->get();

        $cond = "id not in ("; // suppose 'me' has followed user with id of 8, 9, then we want to construct a condition statment of "(id not in 8, 9, 0)". Throught $user->follower, we can get oen id.

        foreach($following as $u)
        {
            $cond .= $u->user_id . ',';
        }
        $cond .= $user->id;
        $cond .= ")";

        $notFollowing = User::whereraw($cond)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return $notFollowing;
	}
}