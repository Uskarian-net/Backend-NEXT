<?php

namespace ATLauncher\Http\Controllers\Auth;

use ATLauncher\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Log the user out of the application, returning them to the page they came from.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logoutWithReturn(\Illuminate\Http\Request $request)
    {
        $fromUrl = \URL::previous();

        $this->logout($request);

        return redirect($fromUrl);
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'logoutWithReturn']]);
    }
}