<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Redirect;
use Session;
use DB;

use App\userInfo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    public function register_display()
    {
        return view('admin.register');
    }

    public function register_process(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:userInfo,email',
            'password' => 'required|confirmed',
            'password_confirmation'=>'Required',
            'name' => 'required'
        ]);

        if ($validator->fails())
        {
        // The given data did not pass validation
            return Redirect::to('register')->withErrors($validator);
        }
        else
        {
            $email = $request->input('email');
            $userName = $request->input('user_name');
            $password = $request->input('password');
            $name = $request->input('name');

            $userInfo = new userInfo();
            $userInfo->email = $email;
            $userInfo->user_name = $userName;
            $userInfo->password = $password;
            $userInfo->name = $name;
            $userInfo->pro_img_path = '/asset/img/default_profile.png';

            $userInfo->save();

            return Redirect::to('login');
        }
    }

    public function login_display()
    {    	
        return view('admin.login');
    }

    public function login_process(Request $request)
    {
        // get data from post
        $email = $request->input('email');
        $password= $request->input('password');

        // Compare if the email and password are compatible with the database records
        $me = userInfo::where('email', $email)->first();

        if($me == null)
        {
           $error_msg = "The email is not correct, please try again.";
           return Redirect::to('login')->with('error_msg', $error_msg);
        }
        else
        {           
            if($me->password != $password)
            {
                $error_msg = "The password is not correct, please try again.";
                return Redirect::to('login')->with('error_msg', $error_msg);
            }
            else
            {
                Session::put('email', $me->email);
                Session::put('name', $me->name); 
                Session::put('me_id', $me->id);

                return Redirect::to('profile?user_id=' . $me->id);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return Redirect::to('login');
    }

    public function display(Request $request)
    {          
        $me_id = $request->session()->get('me_id'); 

        $me = userInfo::where('id', $me_id)->first();

        return view('admin.profile_and_settings', ['me' => $me]);
    }

    public function processing(Request $request)
    {
        $me_id = $request->session()->get('me_id');
        $signature = $request->input('signature');
    
        userInfo::where('id', $me_id)
          ->update(['signature' => $signature]);

        $filename = $_FILES['pro_img']['tmp_name'];
        if(is_uploaded_file($filename))
        {
            $destination = public_path() . '/asset/img/' . $me_id . '.jpg';
            $filename = $_FILES['pro_img']['tmp_name'];
            move_uploaded_file($filename, $destination);

            // save $destination to database table userInfo
            $me = new userInfo;
            $path = '/asset/img/' . $me_id . '.jpg';
            $me::where('id', $me_id)
            ->update(['pro_img_path' => $path]);
        }
  
        return Redirect::to('profile?user_id='. $me_id); 
    }
}