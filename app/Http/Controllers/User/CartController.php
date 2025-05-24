<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function details($productId){

    //     $products = Product::where('id',$productId)->first();
    //     $userId= Auth::user()->id;
    //     // dd($product);
    //     $carts = Cart::with('product')->where('user_id', $userId)->get();
    //     $count = $carts->count();
    //     $cat = Product::with('category')->get();
    //     $sub = Product::with('subcategory')->get();
    //     return view('user.ecommerce.details',['products' => $products, 'count' => $count]);
    // }
    public function cartList()
    {

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $product = Product::all();
            // $outOfStockProducts = Product::whereHas('orders', function ($query) use ($quantity) {
            //     $query->whereRaw('quantity > products.quantity');
            // })->get();
            // dd($product);
            // if($product == 0)
            // {
            // @if($product->quantity == 0)


            // }
            foreach ($product as $product) {
                $product = Product::all()->select('quantity');
            }

            $carts = Cart::with('product')->where('user_id', $userId)->get();
            $count = $carts->count();
            // dd($carts);
            if ($count == 0) {

                $msgs = 'OOPS!! Your Cart is Empty!';
                return view('user.ecommerce.cart', compact('carts', 'msgs', 'count', 'product'));
            } else {

                return view('user.ecommerce.cart', compact('carts', 'count', 'product'));
            }
        }
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            return view('user.ecommerce.cart', compact('cart'));
        } else {
            $cart = null;
            $msg = 'OOPS!! Your Cart is Empty!';
            return view('user.ecommerce.cart', compact('cart', 'msg'));
        }
        // return view('ecommerce.cart');
    }
    public function  addToCart($id)
    {
        $product = Product::where('id', $id)->first();
        // $data = json_decode($product->image, true);
        $data = $product->pictures[0]->image;
        $cart = session()->get('cart');
        if (Auth::check()) {
            $userId = Auth::user()->id;
            if (Cart::where('user_id', $userId)->where('product_id', $id)->exists()) {
                // If the item is already in the cart we just need to increment the quantity by one.
                $item = Cart::where('user_id', $userId)->where('product_id', $id)->first();
                $item->increment('quantity');
                $item->save();
                return redirect()->route('cart.list')->with('status', 'Product added to cart successfully!');
            } else {
                $cart = Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $id,
                    'quantity' => 1,
                ]);
                return redirect()->route('cart.list')->with('status', 'Product added to cart successfully!');
            }
        } else {
            // dd($product->id);
            if (!$cart) {
                $cart = [
                    $product->id => [
                        'id' => $product->id,
                        'name' => $product->product_name,
                        'quantity' => 1,
                        'brand' => $product->brand,
                        'price' => $product->price,
                        'image' => $data,
                    ]
                ];
                session()->put('cart', $cart);
                return redirect()->route('cart.list')->with('status', 'Product added to Cart Successfully');
            }
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += 1;
                session()->put('cart', $cart);
                return redirect()->route('cart.list')->with('status', 'This product is already in your cart', 409);
            } else {
                $cart[$product->id] = [
                    'name' => $product->product_name,
                    'quantity' => 1,
                    'brand' => $product->brand,
                    'price' => $product->price,
                    'image' => $data,
                ];
                session()->put('cart', $cart);
                return redirect()->route('cart.list')->with('status', 'Product added to Cart Successfully', 200);
            }
        }
    }
    public function updates(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            if (Cart::where('user_id', $userId)->where('product_id', $request->id)->exists()) {
                // If the item is already in the cart we just need to increment the quantity by one.
                $item = Cart::where('user_id', $userId)->where('product_id', $request->id)->update(['quantity' => $request->quantity]);
                // $update = Cart::where('user_id', $userId)->where('product_id', $request->id)->update(['quantity'=>$request->quantity]);

                $item->save();
                // return redirect()->route('cart.list')->with('status','Cart Updated successfully!');
                session()->flash('status', 'Cart updated successfully');
            }
        }
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('status', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        // dd($request->id);

        if ($request->id) {
            $cart = session()->get('cart');
            // dd( $cart);
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            return response()->json(["responseCode" => 1, "responseData" => "Deleted Successfully"]);
            // return redirect()->back()->with('success', 'Product removed successfully');
        }
    }
    public static function updateQuantity($userId, $productId, $newQty)
    {
        $cartItem = Cart::addItem($userId, $productId);
        $cartItem->quantity = $newQty;
        $cartItem->save();
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            if ($request->quantity > $cart->quantity) {
                return redirect()->back()->with('status', 'The quantity you have entered is greater than the available stock.');
            }
            $cart->quantity = $request->quantity;
            $cart->save();

            return redirect()->route('cart.list')->with('status', 'Cart updated successfully');
        }

        return redirect()->route('cart.list')->with('error', 'Product not found in cart');
    }
    // public static function removeItem($userId ,$productId){
    //     $item = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
    //     if ($item) {
    //         // The item was found in the database so delete it.
    //         $item->delete();
    //     }
    // }
    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            $cart->delete();

            return redirect()->route('cart.list')->with('status', 'Product removed from cart successfully');
        }

        return redirect()->route('cart.list')->with('error', 'Product not found in cart');
    }
}
