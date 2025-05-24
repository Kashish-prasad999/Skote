<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $user = Auth::user();
        $roles = 'User';
        
        return view("user.dashboard", compact('roles'));
    }
}
