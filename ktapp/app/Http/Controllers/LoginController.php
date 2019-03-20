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
            // dd($data);
        $user_data = array(
            'email'         => $data['email'] ,
            'password'      => $data['password']
        );

        $remember = $request->has('remember_me') ? true : false;

        if (Auth::attempt($user_data, $remember)) {
            return array('message' => 'gelukt', 'result' => true, 'data' => $user_data);
        } else {
            return array('error' => 'deze is onjuist');
        }
    }

    function successlogin() {
        return redirect('home');
    }
    function loggout() {
        Auth::logout();
        return redirect('main');
    }
}
