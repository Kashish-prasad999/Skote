<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::paginate(7);
        return view('admin.discount.index',['discounts'=>$discounts]);
    }

    public function create()
    {
        return view('admin.discount.create');
    }

    public function  store(Request $request)
    {
    //    dd($request->all());
        
        $request->validate([
            'percentage' => 'required','string','unique:discounts,percentage'
        ]);

        Discount::create([
            'percentage' => $request->percentage
        ]);

        return redirect()->route('admin.discount.list')->with('status','Discount has been created!');
    }

    public function edit(Discount $discount){
    
        return view('admin.discount.edit',[
            'discount'=>$discount]);        
    }

    public function update(Request $request, Discount $discount){
     
        $request->validate([
            'percentage' => 'required','string','unique:discounts,percentage'.$discount->id,
        ]);

        $discount->update([
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('admin.discount.list')->with('status','Discount updated successfully!!');
    }
    
    public function destroy($discountId){
        $discount = Discount::find($discountId);
        $discount->delete();
        return redirect('discount')->with('status','Discount deleted successfully!!');
    }
}
