<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Cart;
use  Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function create()
    {
        $states = State::all();
        $cities = City::all();
        if (Auth::check()) {
            $shipping = Shipping::where('user_id', Auth::id())->get();
            if (!empty($shipping)) {
                return redirect()->route('checkout');
            } else {
                return view('user.ecommerce.shipping.shipping', ['states' => $states, 'cities' => $cities]);
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required'],
            'city' => ['required'],
            'zipcode' => ['required', 'string', 'min:6', 'max:6'],
        ]);

        $shipping = new Shipping;
        $shipping->address = $request['address'];
        // $shipping->country = 'India';
        $shipping->state = $request['state'];
        $shipping->city = $request['city'];
        $shipping->zipcode = $request['zipcode'];
        $shipping->notes = $request['notes'];
        $shipping->user_id = Auth::user()->id;
        $shipping->save();

        // 102, Deepmala Society, Ramnagar, Surat
        // 395009

        return redirect()->route('checkout')->with('status', 'Account has been created successfully!!!');
    }
    public function edit($shipId)
    {
        $userId = Auth::User()->id;
        $shipping = Shipping::with('statess')->where('user_id', $userId)->where('id', $shipId)->firstOrFail();
        // dd($shipping);
        // foreach ($shippings as $shipping) {
        //     $state = $shipping->state;

        //     if ($state) {
        //         $stateName = $state->name;
        //     } else {
        //         $stateName = 'Unknown';
        //     }

        //     echo $stateName;
        // }
        $states = State::all();
        $cities = City::all();
        return view('user.ecommerce.shipping.shipping-edit', ['states' => $states, 'cities' => $cities, 'shipping' => $shipping]);
    }
    public function update(Request $request, $shipId)
    {
        $userId = Auth::User()->id;
        $shipping = Shipping::with('city')->where('user_id', $userId)->where('id',  $shipId)->update([
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'notes' => $request->notes,
        ]);
        return redirect()->route('checkout')->with('status', 'Address updated successfully');
    }

    public function addNew()
    {
        $states = State::all();
        $cities = City::all();
        $shipping = Shipping::with(['city'])->where('user_id', Auth::id())->first();
        return view('user.ecommerce.shipping.add-address', ['states' => $states, 'cities' => $cities, 'shipping' => $shipping]);
    }

    public function addNewStore(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required'],
            'city' => ['required'],
            'zipcode' => ['required', 'string', 'min:6', 'max:6'],
        ]);

        $shipping = new Shipping;
        $shipping->address = $request['address'];
        $shipping->state = $request['state'];
        $shipping->city = $request['city'];
        $shipping->zipcode = $request['zipcode'];
        $shipping->notes = $request['notes'];
        $shipping->user_id = Auth::user()->id;
        $shipping->save();

        // 102, Deepmala Society, Ramnagar, Surat
        // 395009

        return redirect()->route('checkout',[])->with('status', 'Address has been added successfully!!!');
    }
    public function checkout()
    {
        if (Auth::check()) {
            $userId =  Auth::user()->id;
            $carts = Cart::with('product')->where('user_id', $userId)->get();
            $shipping = Shipping::where('user_id', $userId)->get();
            // $product = Product::where('id', $productId)->firstOrFail();
            $total=0 ;
            foreach($carts as $cart)
            {
                $total += $cart->product->price * $cart->quantity ;
                $subtotal = $cart->product->price * $cart->quantity ;
            }

            // dd($shipping->address);
            // $shipped=[
            //         'id' => $shipping->id,
            //         'address'=> $shipping->address,
            //         'state'=> $shipping->state->name,
            //         'city'=> $shipping->city,
            //         'zipcode'=> $shipping->zipcode,
            //         'notes' => $shipping->notes
            // ];
            if (!empty($carts)) {
                return view('user.ecommerce.shipping.checkout', [
                    'userId' => $userId,
                    'carts' => $carts,
                    'shipping' => $shipping,
                    // 'subtotal' => $subtotal,
                    'total' => $total
                ]);
            }
        }   else {
                return redirect('user.login');
            }
    }

    public function checkoutBuy($productId)
    {
        if (Auth::check()) {

            $product = Product::where('id', $productId)->firstOrFail();
            $total =  $product->price;
            $userId =  Auth::user()->id;
            $shipping = Shipping::where('user_id', $userId)->get();
            if (count($shipping) > 0) {
                return view('user.ecommerce.shipping.checkout_buy', [
                    'userId' => $userId,
                    'shipping' => $shipping,
                    'total' => $total,
                    'product' => $product
                ])->with('status', 'Add address for shipping');
            } else {
                return view('user.ecommerce.shipping.checkout_buy', [
                    'userId' => $userId,
                    'shipping' => $shipping,
                    'total' => $total,
                    'product' => $product
                ]);
            }
        } else {
            return redirect('user.login');
        }
    }

    public function cartPayment(Request $request, $total)
    {
        $request->validate([
            'address' => 'required'
        ]);
        $shipId = $request->address;
        // dd($ship);
        return view('user.ecommerce.shipping.payment', [
            'total' => $total,
            'shipId' => $shipId
            // 'productId' => $productId
        ]);
    }
    public function payment(Request $request, $total, $productId)
    {

        $cards = Card::where('user_id', Auth::user()->id)->get();
        // dd($card);
        // if(count($card)>0){

        // }
        $request->validate([
            'address' => 'required'
        ]);
        $shipId = $request->address;
        // dd($ship);
        return view('user.ecommerce.shipping.payment_buy', [
            'total' => $total,
            'shipId' => $shipId,
            'productId' => $productId,
            'cards' => $cards
        ]);
    }
}
