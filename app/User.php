<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\follow_relation;

class User extends Model 
{ // almost every class extends the Model class
    public function following() //this function returns all the records of users whom a specific user is following
    {
    	$following_records = follow_relation::where('user_id', $this->id) // $following_records is all the records that 'me' have followed. but not each person's record.
       				->orderBy('created_at', 'desc')
      				->get();


        $cond = "id in ("; // suppose 'me' have followed user of id 8, 9, then I want to construct a condition like "id in (8, 9, 0)". Of course, no user has an id of 0. Throught $user->follower, we can get one id.
        foreach($following_records as $u)
        {
        	$cond .= $u->following . ',';
        }
        $cond .= 0;
        $cond .= ")";

        $following = self::whereraw($cond) // $following contains the info of all the users who I am following. Key word 'self' here means the 'User' class
        			->orderBy('created_at', 'desc')
        			->get();

       	return $following;
    }
}
