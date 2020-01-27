<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LoginController extends \TCG\Voyager\Http\Controllers\VoyagerAuthController
{
    public function login()
    {
        if ($this->guard()->attempt(Input::only(['email','password']), Input::has('remember'))) {
            $this->guard()->login($this->guard()->user(), Input::has('remember'));
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect()->back();
    }
}
