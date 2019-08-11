<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class MainController extends Controller
{
    //
    function index()
    {
        if(isset(Auth::user()->email)){            
            return redirect('main/successLogin');
        }   
        return view('auth.login');
    }

    function checkLogin(Request $request)
    {
        $this->validate($request,[
            'email'         => 'required|email',
            'password'      => 'required|alphaNum|min:3'
        ]);

        $user_data = array(
            'email'         => $request->get('email'),
            'password'      => $request->get('password'),
        );

        if(Auth::attempt($user_data)){
            return redirect('main/successLogin');
        }else{
            return back()->with('error','Wrong Login Details');
        }
    }

    function successLogin()
    {
        return view('successLogin');
    }

    function logout()
    {
        Auth::logout();
        return redirect('main/successLogin');
    }
}
