<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Card;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function orderlist()
    {

        $orders = Order::with('product')->where('user_id', Auth::id())->paginate(15);
        $order = Order::where('user_id', Auth::id())->pluck('id', 'id');
        $total = 0;
        $subtotals = [];

        $orderItems = OrderItem::whereIn('order_id', $order)->get();
        foreach ($orderItems as $item) {
            $subtotal = $item->product->price * $item->quantity;
            $subtotals[] = $subtotal;
            $total += $subtotal;
        }

        return view('user.ecommerce.orderlist', [
            'orders' => $orders,
            'total' => $total,
            'subtotals' => $subtotals
        ]);
    }

    // public function order(Request $request,$total, $req, $productId, $transactionId)
    // {
    //     $shipping = Shipping::where('user_id', Auth::id())->first();
    //     // if($request->payment == 'cod')
    //     // {
    //     $order =  new Order();
    //     $order->user_id = Auth::user()->id;
    //     $order->status = 'completed';
    //     $order->grand_total = number_format((float)$total, 2, '.', '');
    //     $order->item_count = 1;
    //     $order->payment_method = $req;
    //     $order->transaction_id = $transactionId;
    //     $order->name = Auth::user()->name;
    //     $order->address = $shipping->address;
    //     $order->city = $shipping->city;
    //     $order->state = $shipping->state;
    //     $order->zipcode = $shipping->zipcode;
    //     $order->phone = Auth::user()->mobile;
    //     $order->notes = $shipping->notes;

    //     $order->save();

    //     if ($productId != null) {
    //         $product = Product::where('id', $productId)->first();
    //         $orderItem = new OrderItem();
    //         $orderItem->product_id = $product->id;
    //         $orderItem->order_id = $order->id;
    //         $orderItem->price = $product->price;
    //         $orderItem->quantity = 1;
    //         $orderItem->save();

    //         // $product =  Product::where('id', $item->product->id)->first();
    //         $product->quantity = $product->quantity - 1;
    //         $product->update();

    //         //   $cart = Cart::where('user_id', Auth::user()->id)->get();
    //         //   if ($cart) {
    //         //     $cart->delete();
    //         //  }
    //     }
    //     Session::put('order', $order->id);
    //     // dd($try);
    //     // $request->session()->put('order', $order->id);
    //         if($req=='Netbanking'){
    //             return response()->json();
    //         }
    //     // return view('user.ecommerce.order', [
    //     //     'order' => $order
    //     // ]);
    //     return view('user.ecommerce.order');
    // }

    public function extra()
    {
        return view('user.ecommerce.order');
    }

    public function order(Request $request)
    {
        // dd($request->all());
        $total = $request->total;
        $product = $request->product;
        $req = $request->req;
        $transaction = $request->transaction;
        $shipping = Shipping::where('user_id', Auth::id())->first();
        // if($request->payment == 'cod')
        // {
        $order =  new Order();
        $order->user_id = Auth::user()->id;
        $order->status = 'completed';
        $order->grand_total = number_format((float)$total, 2, '.', '');
        $order->item_count = 1;
        $order->payment_method = $req;
        $order->transaction_id = $transaction;
        $order->name = Auth::user()->name;
        $order->address = $shipping->address;
        $order->city = $shipping->city;
        $order->state = $shipping->state;
        $order->zipcode = $shipping->zipcode;
        $order->phone = Auth::user()->mobile;
        $order->notes = $shipping->notes;

        $order->save();

        if ($product != null) {
            $product = Product::where('id', $product)->first();
            $orderItem = new OrderItem();
            $orderItem->product_id = $product->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $product->price;
            $orderItem->quantity = 1;
            $orderItem->save();

            // $product =  Product::where('id', $item->product->id)->first();
            $product->quantity = $product->quantity - 1;
            $product->update();

            //   $cart = Cart::where('user_id', Auth::user()->id)->get();
            //   if ($cart) {
            //     $cart->delete();
            //  }
        }
        if ($request->saved == 'save') {
            // dd($request->all());
            $card = new Card;

            $card->card_number = $request->input('card_number');
            $card->name = $request->input('name');
            $card->expiry_month = $request->input('expiry_month');
            $card->expiry_year = $request->input('expiry_year');
            $card->user_id = Auth::user()->id;
            $card->save();
        }
        
        Session::put('order', $order->id);
        // dd($try);
        // $request->session()->put('order', $order->id);
        // if ($req == 'Netbanking') {
        //     return response()->json();
        // }
        // return view('user.ecommerce.order', [
        //     'order' => $order
        // ]);
        return response()->json();
    }

    public function cartOrder($total, $req, $transactionId)
    {
        // dd($request->all());
        // dd($request->payment);
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $count = $carts->count();
        $shipping = Shipping::where('user_id', Auth::id())->first();
        // if($request->payment == 'cod')
        // {
        $order =  new Order();

        $order->user_id = Auth::user()->id;
        $order->status = 'completed';
        $order->grand_total = $total;
        $order->item_count = $count;
        $order->payment_method = $req;
        $order->transaction_id = $transactionId;
        $order->name = Auth::user()->name;
        $order->address = $shipping->address;
        $order->city = $shipping->city;
        $order->state = $shipping->state;
        $order->zipcode = $shipping->zipcode;
        $order->phone = Auth::user()->mobile;
        $order->notes = $shipping->notes;
        $order->save();

        foreach ($carts as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->product->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->product->price;
            $orderItem->quantity = $item->quantity;
            $orderItem->save();
            $item->delete();

            $product =  Product::where('id', $item->product->id)->first();
            $product->quantity = $product->quantity - $item->quantity;
            $product->update();

            //   $cart = Cart::where('user_id', Auth::user()->id)->get();
            //   if ($cart) {
            //     $cart->delete();
            //  }
        }
        Session::put('order', $order->id);
        return view('user.ecommerce.order');
    }

    public function cartPaymentMethod(Request $request, $total, $transactionId)
    {

        // dd($request->all());
        $request->validate([
            'payment' => ['required']
        ]);
        if ($request->payment == 'cod') {
            $req = 'COD';
            $transactionId = 0;
            // dd($req);
            return redirect()->route('cart.order', [$total, $req, $transactionId]);
        } elseif ($request->payment == 'card') {
            // dd($request->all());
            // return redirect()->route('card');
            $request->validate([
                'card_number' => ['required', 'min:16', 'max:16'],
                'name' => ['required'],
                'expiry_month' => ['required'],
                'expiry_year' => ['required'],
                'cvv' => ['required', 'min:3', 'max:3']
            ]);
            // dd($request->all());
            $req = 'Card';
            $transactionId = 0;
            if ($request->saved == 'save') {
                // dd($request->all());
                $card = new Card;

                $card->card_number = $request->input('card_number');
                $card->name = $request->input('name');
                $card->expiry_month = $request->input('expiry_month');
                $card->expiry_year = $request->input('expiry_year');
                $card->user_id = Auth::user()->id;
                $card->save();
                return redirect()->route('order', [$total, $req, $transactionId]);
            } else {

                return redirect()->route('cart.order', [$total, $req, $transactionId]);
            }
        } else {
            $req = 'Paypal';
            return redirect()->route('order', [$total, $req, $transactionId]);
        }
    }
    // public function paymentMethod(Request $request, $total, $productId, $transactionId)
    // {

    //     // dd($request->all())
    //     $request->validate([
    //         'payment' => ['required']
    //     ]);
    //     // if ($request->payment == 'netbanking') {
    //     //     $req = 'Netbanking';
    //     //     return redirect()->route('payment.paypal.payment', [$total, $req, $productId]);
    //     // }
    //     if ($request->payment == 'cod') {
    //         $req = 'COD';
    //         $transactionId = 0;
    //         // dd($req);
    //         return redirect()->route('order', [$total, $req, $productId]);
    //     } elseif ($request->payment == 'card') {
    //         // dd($request->all());
    //         // return redirect()->route('card');
    //         $request->validate([
    //             'card_number' => ['required', 'min:16', 'max:16'],
    //             'name' => ['required'],
    //             'expiry_month' => ['required'],
    //             'expiry_year' => ['required'],
    //             'cvv' => ['required', 'min:3', 'max:3']
    //         ]);
    //         // dd($request->all());
    //         $req = 'Card';
    //         $transactionId = 0;
    //         if ($request->saved == 'save') {
    //             // dd($request->all());
    //             $card = new Card;

    //             $card->card_number = $request->input('card_number');
    //             $card->name = $request->input('name');
    //             $card->expiry_month = $request->input('expiry_month');
    //             $card->expiry_year = $request->input('expiry_year');
    //             $card->user_id = Auth::user()->id;
    //             $card->save();
    //             return redirect()->route('order', [$total, $req, $productId, $transactionId]);
    //         } else {

    //             return redirect()->route('order', [$total, $req, $productId, $transactionId]);
    //         }
    //     }
    //     // else {
    //     //     $req = 'Paypal';
    //     //     return redirect()->route('order', [$total, $req, $productId, $transactionId]);
    //     // }
    // }
    public function paymentMethod(Request $request)
    {

        // // dd($request->all())
        // $request->validate([
        //     'payment' => ['required']
        // ]);
        // if ($request->payment == 'netbanking') {
        //     $req = 'Netbanking';
        //     return redirect()->route('payment.paypal.payment', [$total, $req, $productId]);
        // }
        if ($request->payment == 'cod') {
            $req = 'COD';
            $transactionId = 0;
            // dd($req);
            return redirect()->route('order');
        } elseif ($request->payment == 'card') {
            // dd($request->all());
            // return redirect()->route('card');
            $request->validate([
                'card_number' => ['required', 'min:16', 'max:16'],
                'name' => ['required'],
                'expiry_month' => ['required'],
                'expiry_year' => ['required'],
                'cvv' => ['required', 'min:3', 'max:3']
            ]);
            // dd($request->all());
            $req = 'Card';
            $transactionId = 0;
            if ($request->saved == 'save') {
                // dd($request->all());
                $card = new Card;

                $card->card_number = $request->input('card_number');
                $card->name = $request->input('name');
                $card->expiry_month = $request->input('expiry_month');
                $card->expiry_year = $request->input('expiry_year');
                $card->user_id = Auth::user()->id;
                $card->save();
                return redirect()->route('order');
            } else {

                return redirect()->route('order');
            }
        }
        // else {
        //     $req = 'Paypal';
        //     return redirect()->route('order', [$total, $req, $productId, $transactionId]);
        // }
    }
}
