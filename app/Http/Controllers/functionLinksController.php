<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tweet;
use App\Http\Controllers\Controller;
use Redirect;

class functionLinksController extends Controller
{
    public function like(Request $request)
    {
    	$user_id = $request->get('user_id');

        $tweet_id = $request->get('tweet_id');

        // check how many 'like' for this twitter
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

        return Redirect::to('profile?user_id=' . $user_id);
    }
}
