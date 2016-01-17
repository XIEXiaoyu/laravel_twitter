<?php

namespace App\Services;

use App\User;
use App\follow_relation;

class FollowService {

	public function notFollowing(User $user, $number = 0)
	{

        $following = follow_relation::where('user_id', $user->id) // $ followed are all the users's records that 'me' has followed 
                        ->orderBy('created_at', 'desc')
                        ->get();

        $cond = "id not in ("; // suppose 'me' has followed user with id of 8, 9, then we want to construct a condition statment of "(id not in 8, 9, 0)". Throught $user->following, we can get oen id.

        foreach($following as $u)
        {
            $cond .= $u->following . ',';
        }
        $cond .= $user->id;
        $cond .= ")";

        $notFollowing = User::whereraw($cond)
                            ->orderBy('created_at', 'desc');
        if($number != 0){
            $notFollowing->take($number);
        }

        return $notFollowing->get();
	}
}