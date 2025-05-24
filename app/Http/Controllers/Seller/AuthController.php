<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use  Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function  Login() {
        return view("seller.auth.login");
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
            if(Auth::user()->hasRole('Seller'))
            {
                // dd(Auth::user());
                $request->session()->regenerate();
                return redirect()->route('seller.dashboard')->with("status", "Logged in Successfully!!");
                // return redirect(session()->get('url.intended'))->with($credentials);
            } 
            else 
            {
                return redirect()->back()->with('status', 'Wrong username or password!!');
            }
        }
        
    }
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('seller.login');
    }
}
