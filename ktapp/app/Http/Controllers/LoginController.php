<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    function index() {
        return view('login');
    }

    function checklogin(Request $request) {

        $data = $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required|alphaNum|min:3',
            'remember_me'   => 'nullable'
        ]);
        $user_data = array(
            'email'         => $data['email'] ,
            'password'      => $data['password']
        );

        $remember = $request->has('remember_me') ? true : false;
        if (Auth::attempt($user_data, $remember)) {
            return view('home');
        } else {
            return array('error' => 'deze is onjuist');
        }
    }

    function successlogin() {
        return view('home');
    }
    function loggout() {
        Auth::logout();
        return redirect('/');
    }
}
