<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\follow_relation;

class User extends Model
{
    public function following()
    {
    	$following_records = follow_relation::where('follower', $this->id) // $following_records is all the records that 'me' have followed. but not each peoson's recored.
       				->orderBy('created_at', 'desc')
      				->get();


        $cond = "id in ("; // suppose 'me' have followed user with id 8, 9, then I want to construct a condition like "id in (8, 9, 0)". Of course, no user has an id of 0. Throught $user->follower, we can get one id.
        foreach($following_records as $u)
        {
        	$cond .= $u->user_id . ',';
        }
        $cond .= 0;
        $cond .= ")";

        $following = self::whereraw($cond) // $following contains the info of all the users who I am following 
        			->orderBy('created_at', 'desc')
        			->get();

       	return $following;
    }
}
