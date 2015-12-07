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
        $user = userInfo::where('email', $email)->first();

        if($user == null)
        {
           $error_msg = "The email is not correct, please try again.";
           return Redirect::to('login')->with('login_error_msg', $error_msg);
        }
        else
        {           
            if($user->password != $password)
            {
                $error_msg = "The password is not correct, please try again.";
                return Redirect::to('login')->with('login_error_msg', $error_msg);
            }
            else
            {
                Session::put('email', $user->email);
                Session::put('name', $user->name); 
                Session::put('user_id', $user->id);

                return Redirect::to('profile?user_id=' . $user->id);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return Redirect::to('login');
    }

    public function register_show()
    {
    	return view('admin.register');
    }

    public function register_addUser(Request $request)
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

    public function display(Request $request)
    {
        if(empty($request->session()->get('user_id')))
        {
            return Redirect::to('login');
        }  
          
        $user_id = $request->session()->get('user_id'); 

        $user = userInfo::where('id', $user_id)->first();

        return view('admin.profile_and_settings', ['user' => $user]);
    }

    public function processing(Request $request)
    {
        if(empty($request->session()->get('user_id')))
        {
            return Redirect::to('login');
        }

        $user_id = $request->session()->get('user_id');
        $signature = $request->input('signature');
    
        userInfo::where('id', $user_id)
          ->update(['signature' => $signature]);

        $filename = $_FILES['pro_img']['tmp_name'];
        if(is_uploaded_file($filename))
        {
            $destination = public_path() . '/asset/img/' . $user_id . '.jpg';
            $filename = $_FILES['pro_img']['tmp_name'];
            move_uploaded_file($filename, $destination);

            // save $destination to database table userInfo
            $user_info = new userInfo;
            $path = '/asset/img/' . $user_id . '.jpg';
            $user_info::where('id', $user_id)
            ->update(['pro_img_path' => $path]);
        }
  
        return Redirect::to('profile?user_id='. $user_id); 
    }
}