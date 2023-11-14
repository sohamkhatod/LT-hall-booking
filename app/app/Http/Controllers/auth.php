<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class auth extends Controller
{
    //
    function check_login(Request $request){
        $cred = $request->all();

        //$user = null;
        $user = 'gsec';    //placeholder for database access

        if(!$cred['username'])
            return view('login',['error'  =>'Enter Username']);

        if(!$cred['password'])
            return view('login',['error'  =>'Enter password']);

        if($user){
            $request->session()->put('User', $user);

            return redirect($user);
        }else{
            return view('login',['error'  =>'Incorrect username or password']);
        }

        
    }
}
