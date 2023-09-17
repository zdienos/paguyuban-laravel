<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function index()
    {
        // if (!Auth::check() && !Request::is('auth.login')) {
        //     return Redirect::route('dashboard');
        // }
        if (Auth::check()) {
            return Redirect::route('dashboard.zed');
            // return view('dashboard.index');
        } else {
            return view('auth.index');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return response()->json(['status' => true, 'redirect' => '/dashboard']);
            // return redirect ('/dashboard');
        } else {
            return response()->json(['status' => false, 'message' => 'Incorrect email or password']);
        }

        return back()->withErrors([
            'email'=>'Wrongggg'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect ('/auth');

    }
}
