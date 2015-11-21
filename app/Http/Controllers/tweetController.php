<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Redirect;
use App\sendTweet_msg;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class tweetController extends Controller
{
    public function sendTwitter_show()
    {
    	return view('tweet.sendTwitter');
    }

    public function sendTwitter_send(Request $request)
    {
    	// 创建一个数据表，名叫sendTweet_msg，里面有id, email, tweet_msg
    	// 收到post后，把tweet_msg存到数据表里面
    	$validator = Validator::make($request->all(),[
            'tweet_msg' => 'required' //Todo: comfirm what rules are needed to validate msg 
        ]);

        if ($validator->fails())
        {
            return Redirect::to('sendTwitter')->withErrors($validator);
        }

        else
        {
            $tweet_msg = $request->input('tweet_msg');

            $sendTweet_msg = new sendTweet_msg();
            $sendTweet_msg->tweet_msg = $tweet_msg;

            $sendTweet_msg->email = $request->session()->get('email');

            $sendTweet_msg->save();

            return Redirect::to('profile'); // Todo: redirect to his timeline page.
        }
    }
}