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
        $email_database = DB::table('userInfo')->where('email', $email_post);
        if($email_database->count() <= 0)
        {
           $login_error_msg = "The email is not correct, please try again.";
           return Redirect::to('login')->with('login_error_msg', $login_error_msg);
        }
        else
        {           
            $password_database = DB::table('userInfo')->where('email', $email_post)->value('password');           

            if($password_database != $password_post)
            {
                $login_error_msg = "The password is not correct, please try again.";
                echo "haha, password is not correct";
                // return Redirect::to('login')->with($login_error_msg);
            }
            else
            {
                $email_database = DB::table('userInfo')->where('email', $email_post)->value('email');
                $name_database = DB::table('userInfo')->where('email', $email_post)->value('name');

                Session::put('email', $email_database);
                Session::put('password', $password_database);
                Session::put('name', $name_database); 

                return Redirect::to('login'); // Todo: need to redirct to a correct page
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
            'name' => 'required|unique:userInfo,name'
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
