<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function Adminlogin()
    {
        return view('Admin/admin-login');
    }

    public function Login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            // dd('login');
            return redirect()->route('dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->route('admin')->with('error', 'Username or Password is Incorrect');
        }
    }


    public function Logout()
    {
        Auth::logout();
        return redirect()->route('admin')->with('success', 'Logged out successfully');
    }

}
