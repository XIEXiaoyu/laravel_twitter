<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tweet;
use App\Like;
use App\Http\Controllers\Controller;
use Redirect;

class functionLinksController extends Controller
{
    public function like(Request $request)
    {
    	$user_id = $request->get('user_id');
        $tweet_id = $request->get('tweet_id');
        $me = $request->session()->get('me_id');

		// avoid one person gives more than one 'like' on the same tweet
   		$count = Like::where('tweet_id', $tweet_id)
   						->where('user_id' , $me)
   						->count();
   		if($count == 0)
   		{
	        // record this 'like' in database table 'likes'
	        $likey = new Like;
	        $likey->tweet_id = $tweet_id;
	        $likey->user_id = $me; // If user_id equals 15, it means the user 
	        					   // of id 15 have pressed the like button 
	        					   // on this tweet
	        $likey->save();

	        // add this 'like' in database table 'tweets'
	        $tweet = Tweet::where('id', $tweet_id)->first();
	        $like = $tweet->like;

	        if(empty($like))
	 		{
	            $like = 1;
	        }
	        else
	        {
	            $like += 1;
	        }

	        $tweet->like = $like;
	        $tweet->save();
   		}

        return Redirect::to('profile?user_id=' . $user_id);
    }
}
