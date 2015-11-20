<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class tweetController extends Controller
{
    public function sendTwitter_show()
    {
    	return view('tweet.sendTwitter');
    }
}
