<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Redirect;
use App\sendTweet_msg;
use Session;
use App\userInfo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class tweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('log');
    }

    public function sendTwitter_display(Request $request)
    {   
        $user_id = $request->session()->get('me_id');
        $user = userInfo::where('id', $user_id)->first();
        return view('tweet.sendTwitter', ['user' => $user]);   	
    }

    public function sendTwitter_process(Request $request)
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
            $user = $request->session()->get('me_id');

            $record = userInfo::where('id', $user)->first();

            $tweet_msg = $request->input('tweet_msg');

            $sendTweet_msg = new sendTweet_msg();

            $sendTweet_msg->user_id = $user;

            $sendTweet_msg->tweet_msg = $tweet_msg;

            $sendTweet_msg->email = $request->session()->get('email');

            $sendTweet_msg->name = $record->name;

            $sendTweet_msg->save();

            dd($user);

            return Redirect::to('profile?user_id=' . $user); // Todo: redirect to his timeline page.
        }
        
    }
}