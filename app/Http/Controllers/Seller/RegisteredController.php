<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RegisteredController extends Controller
{
    public function create(): View
    {
        // $roles = Role::pluck('name','name')->all();
        // dd($roles);

        return view('seller.auth.register');
       
    }

    public function store(Request $request)
    {
        $user = new User;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Seller');
        // $user->syncRoles($request->roles);
        //   dd($user);
        event(new Registered($user));
        Auth::login($user);
        // return redirect(RouteServiceProvider::HOME);
        // dd($user);
        return redirect()->route('seller.login')->with('status','Account has been created successfully!!!');
    }
}
