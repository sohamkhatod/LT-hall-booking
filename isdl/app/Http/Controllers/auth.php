<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;

class auth extends Controller
{
    //
    function check_login(Request $request){
        $cred = $request->all();

        if(!$cred['username'])
            return view('login',['error'  =>'Enter Username']);

        if(!$cred['password'])
            return view('login',['error'  =>'Enter password']);

        $user = DB::table('User')
            ->select('role')
            ->where('username', $cred['username'])
            ->where('password',$cred['password'])
            ->where('active',1)
            ->get();

        if(!isset($user[0]->role))
            return view('login',['error'  =>'Incorrect username or password']);
            
  

        
        $role = $user[0]->role;    //placeholder for database access
        $request->session()->put('role', $role);
        $request->session()->put('User', $cred['username']);
      //  dd(url()->current().'test');
        return redirect(url()->current().'/'.$role);
    }
}
