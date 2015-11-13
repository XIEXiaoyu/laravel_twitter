<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    public function login()
    {
    	$err_msg = "bula";
    	return view('admin.login', compact('err_msg'));
    }
}
