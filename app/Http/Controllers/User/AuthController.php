<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        // $this->middleware('guest')->except('signout');
        $this->redirectTo = url()->previous();
    }

    public function  Login()
    {
        return view("user.auth.login");
    }
    public function doLogin(Request $request)
    {
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
            'password' => $request->password,])) {
          
                // dd(Auth::user());
                // $user= Auth::user();
                // $roles = $user->getRoleNames(); 
                // dd($roles);
                if(Auth::user()->hasRole('User')){
                    // dd(Auth::user());
                
                    $request->session()->regenerate();
                    if (!session()->has('url.intended')) {
                        session(['url.intended' => url()->previous()]);
                    }
            
                    return redirect()->route('index')->with("status", "Logged in Successfully!!");
                    // Session::flush();
                    // return redirect()->intended()->with("status", "Logged in Successfully!!");
                    // return redirect(session()->get('url.intended'))->with($credentials);\
                    // if (!session()->has('url.intended')) {
                    //     session(['url.intended' => url()->previous()]);
                    // }\
                    return redirect(session()->get('url.intended'));

                } else {
                    return redirect()->back()->with('status', 'Wrong username or password!!');
                }
        }
        else {
            return redirect()->back()->with('status', 'Wrong username or password!!');
        }
    }
    public function destroy()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('user.login');
    }
}
