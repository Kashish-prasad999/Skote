<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PriceFilterController extends Controller
{
    public function productshop(Request $request)
    {
        #Get minimum and maximum price to set in price filter range
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        //dd('Minimum Price value in DB->'.$min_price,'Maximum Price value in DB->'.$max_price);
 
        #Get filter request parameters and set selected value in filter
        $filter_min_price = $request->min_price;
        $filter_max_price = $request->max_price;
         
        #Get products according to filter
        if($filter_min_price && $filter_max_price){
            if($filter_min_price >0 && $filter_max_price >0)
            {
            $products = Product::select('product_name','product_image','price','selling_price')->whereBetween('price',[$filter_min_price,$filter_max_price])->get();
          }
        }  
        #Show default product list in Blade file
        else{
            $products = Product::select('product_name','product_image','price','selling_price')->get();
        }
        return view('pricefilter.index',compact('products','min_price','max_price','filter_min_price','filter_max_price'));
    }
}
