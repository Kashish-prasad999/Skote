<?php

namespace App\Http\Controllers\Admin;

use  Illuminate\Support\Facades\Auth;   
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function  Login() {
        return view("admin.auth.login");
    }
    public function doLogin(Request $request)  {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // $credentials = [
        //     'email' => $request->username,
        //     'password' => $request->password,
        // ];

        // dd(Auth::attempt([
        //     'username' => $request->username,
        //     'password' => $request->password,
        // ]));
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,])) 
        {
            if(Auth::user()->hasRole('Admin'))
            {
                // dd(Auth::user());
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard')->with("status", "Logged in Successfully!!");
                // return redirect(session()->get('url.intended'))->with($credentials);\
            } 
            else {
                return redirect()->back()->with('status', 'Wrong username or password!!');
            }
        }
        
    }
    public function destroy()
    {        
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
