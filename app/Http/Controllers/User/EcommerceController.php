<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Support\Facades\View;
use App\Models\City;
use App\Models\Subcategory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class EcommerceController extends Controller
{
    public function index(){

        $products = Product::paginate(6);
        // dd($products);
        session()->forget('order');
        $categories = Category::with('subcategory')->get();
        if(Auth::check()){
            $userId= Auth::user()->id;
            // dd($product);
            $carts = Cart::with('product')->where('user_id', $userId)->get();
            $count = $carts->count();
            // dd($count);
            return view ('user.ecommerce.index', [
                'products' => $products,
                'count' => $count,
                'categories' => $categories,
            ]);
        }
        else {
            return view ('user.ecommerce.index', [
                'products' => $products,
                'categories' => $categories,
            ]);
        }
    }

    public function details($productId){

        $products = Product::where('id',$productId)->first();
        if(Auth::check()){
            $userId= Auth::user()->id;
            // dd($product);
            $carts = Cart::with('product')->where('user_id', $userId)->get();
            $count = $carts->count();
            // dd($count);
            return view('user.ecommerce.details',['products' => $products, 'count' => $count]);
        }else {
            $cat = Product::with('category')->get();
            $sub = Product::with('subcategory')->get();
            // return view('user.ecommerce.details',['products' => $products,]);
            return view('user.ecommerce.details',['products' => $products]);
        }

    }

    public function filters(Request $request, $catId, $subcatId)
    {
        // $category = Category::all();
        // $category = Subcategory::all();
        // dd($category);
        // dd($catId,$subcatId);
        // dd($request->category);
        // if($catId == $category->id){
        // }
        // dd($product);
        $categories = Category::with('subcategory')->get();
        if(Auth::check()){
            $userId= Auth::user()->id;
            // dd($product);
            $carts = Cart::with('product')->where('user_id', $userId)->get();
            $count = $carts->count();

            $products = Product::where('category_id', $catId)->where('subcategory_id', $subcatId)->paginate(6);
            return view ('user.ecommerce.index', [
                'products' => $products,
                'count' => $count,
                'categories' => $categories,
            ]);
        }
        $products = Product::where('category_id', $catId)->where('subcategory_id', $subcatId)->paginate(6);
        return view ('user.ecommerce.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
        $search = $request->search;
        // $products = Product::where('product_name', 'like', '%'.$request->txtSearch."%") ->get();
        $products = Product::where('product_name','like','%'.$request->search."%")->paginate(6);

        $categories = Category::all();
        // dd(count($products));
        // dd($msg);
        // if(count($products)==0)
        // {
        //     $data= View::make('user.ecommerce.display',compact('products', 'msg'));
        //     return $data;
        // }
        // else{
        //     $data= View::make('user.ecommerce.display',compact('products', 'msg'));
        //     return $data;
        // }
        // dd($search);
        // dd($products);
        // $subcategories = Subcategory::all();
        // $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        // $count = $carts->count();
        // @dd($results);

    //     return view('user.ecommerce.index', [
    //         'products' => $products,
    //         'categories' => $categories,
    //         'subcategories' => $subcategories,
    //         'count' => $count
    // ]);
    // return response()->json($products);
    // $data= View::make('user.ecommerce.display',['products' => $products,
            // 'categories' => $categories,
            // 'subcategories' => $subcategories,
            // 'count' => $count]);
            $data= View::make('user.ecommerce.display',compact('products'));
            return $data;
    }

    public function category($catId)
    {
        $categories = Category::with('subcategory')->get();
        if(Auth::check()){
            $userId= Auth::user()->id;
            // dd($product);
            $carts = Cart::with('product')->where('user_id', $userId)->get();
            $count = $carts->count();

            $products = Product::where('category_id', $catId)->paginate(6);
            return view ('user.ecommerce.index', [
                'products' => $products,
                'count' => $count,
                'categories' => $categories,
            ]);
        }
        $products = Product::where('category_id', $catId)->paginate(6);
        return view ('user.ecommerce.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function buyNow($productId){
        $states = State::all();
        $cities = City::all();
        if(Auth::check())
        {
            $shipping = Shipping::where('user_id', Auth::id())->get();
            // dd($shipping);
            // echo $shipping;
            $product = Product::where('id',$productId)->firstOrFail();
            // dd($product);
            if(count($shipping)>0)
            {
                // dd('11111111111111111111');
                return redirect()->route('checkout.buy', ['product'=>$product, 'productId'=>$productId]);
            }
            else
            {
                // dd('0000000000000000000');
                return view('user.ecommerce.shipping.shipping',['states' => $states, 'cities' => $cities, 'productId' => $productId]);
            }
        }
    }
    // public function filterByPrice(Request $request)
    // {
    //     // if ($request->ajax()) {
    //         $minPrice = intval($request->min_price);
    //         $maxPrice = intval($request->max_price);

    //         $products = Product::with('discountss')->whereBetween('price', [$minPrice, $maxPrice])
    //             ->orderBy('price', 'asc')
    //             ->get();
    //           //  dd($products);

    //         $html = [];
    //         // foreach ($products as $product) {
    //             $html[] = view('user.ecommerce.display', ['products' => $products])->render();
    //         // }

    //         return response()->json(['success' => true, 'data' => ['html' => $html]]);
    //     // }

    //     // return response()->json(['success' => false]);
    // }


    public function search(Request $request)
    {
        $search = $request->search;

        // $products = Product::where('product_name', 'like', '%'.$request->txtSearch."%") ->get();
        $products = new Product;
        if($request->search){
            $products=$products->where('product_name','like','%'.$request->search."%");
        }
        if($request->min_price && $request->max_price){
            $products=$products->whereBetween('price', [$request->min_price, $request->max_price]);
        }
        $products=$products->get();
        // $categories = Category::all();
        // dd(count($products));
        // dd($msg);
        // if(count($products)==0)
        // {
        //     $data= View::make('user.ecommerce.display',compact('products', 'msg'));
        //     return $data;
        // }
        // else{
        //     $data= View::make('user.ecommerce.display',compact('products', 'msg'));
        //     return $data;
        // }
        // dd($search);
        // dd($products);
        // $subcategories = Subcategory::all();
        // $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        // $count = $carts->count();
        // @dd($results);

    //     return view('user.ecommerce.index', [
    //         'products' => $products,
    //         'categories' => $categories,
    //         'subcategories' => $subcategories,
    //         'count' => $count
    // ]);
    // return response()->json($products);
    // $data= View::make('user.ecommerce.display',['products' => $products,
            // 'categories' => $categories,
            // 'subcategories' => $subcategories,
            // 'count' => $count]);
            $data= View::make('user.ecommerce.display',compact('products'));
            return $data;
    }

    public function filterByPrice(Request $request)
    {
        $products = Product::whereBetween('price', [$request->min_price, $request->max_price])
        // $products = Product::whereBetween('price', [9500,10000])
            ->orderBy('price', 'asc')
            ->paginate(6);
            // dd($products[0]->discountss->percentage);
            //dd($products);
            $data= View::make('user.ecommerce.display',compact('products'));
            return $data;
    }
}
