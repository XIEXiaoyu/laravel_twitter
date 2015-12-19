<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Redirect;
use App\Tweet;
use Session;
use App\User;

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
        $me_id = $request->session()->get('me_id');
        $me = User::where('id', $me_id)->first();
        return view('tweet.sendTwitter', ['me' => $me]);   	
    }

    public function sendTwitter_process(Request $request)
    {
        // 创建一个数据表，名叫tweets，里面有id, message
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
            $me = $request->session()->get('me_id');

            $record = User::where('id', $me)->first();
            $tweet_msg = $request->input('tweet_msg');
            $tweet = new Tweet();
            $tweet->user_id = $me;
            $tweet->message = $tweet_msg;
            $tweet->save();
            $tweet->thread_id = $tweet->id;
            $tweet->save();

            return Redirect::to('profile?user_id=' . $me); // Todo: redirect to his timeline page.
        }
        
    }
}