<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\sendTweet_msg;

class tweetsController extends Controller
{
    public function profile_show(Request $request)
    {
    	$email = $request->session()->get('email');
    	$posts = sendTweet_msg::where('email', $email)
    			->orderBy('created_at', 'desc')
    			->get();

    	// To do: need to check in the view if $posts is empty
    	// To do: pagination to display 10 post on a page.

    	return view('tweets.profile', array(
    		'posts' => $posts,
    	));
    }






    public function timeline_show()
    {
    	return view('tweets.timeline');
    }
}
