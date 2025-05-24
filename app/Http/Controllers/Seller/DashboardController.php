<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use  Illuminate\Support\Facades\Auth; 

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $user = Auth::user();
        $roles = 'Seller';
        $product= Product::where('seller_id',Auth::id());
        $count = $product->count();
        
        return view("seller.dashboard", compact('roles', 'count'));
    }
}
