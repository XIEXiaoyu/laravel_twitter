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
    public function login_show()
    {    	
        return view('admin.login');
    }

    public function login_login(Request $request)
    {
        // get data from post
        $email_post = $request->input('email');
        $password_post = $request->input('password');

        // Compare if the email and password are compatible with the database records
        $user = DB::table('userInfo')->where('email', $email_post)->first();

        if($user == null)
        {
           $login_error_msg = "The email is not correct, please try again.";
           return Redirect::to('login')->with('login_error_msg', $login_error_msg);
        }
        else
        {           
            if($user->password != $password_post)
            {
                $login_error_msg = "The password is not correct, please try again.";
                return Redirect::to('login')->with('login_error_msg', $login_error_msg);
            }
            else
            {
                Session::put('email', $user->email);
                Session::put('name', $user->name); 

                return Redirect::to('sendTwitter');
            }
        }
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
            $password = $request->input('password');
            $name = $request->input('name');

            $userInfo = new userInfo();
            $userInfo->email = $email;
            $userInfo->password = $password;
            $userInfo->name = $name;

            $userInfo->save();

            return Redirect::to('login');
        }
    }
}