<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\State;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rules;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $user = Auth::user();
        $roles = 'Admin';
        // $roleusers = ;
        // $sellers = DB::table('model_has_roles')->where('role_id', 2)->get()->count();
        $sellers = User::Role('Seller')->get()->count();
        $users = User::Role('User')->get()->count();
        $total = User::count()-1;
        $categories = Category::count();
        $subcategories = Subcategory::count();
        $states = State::count();
        $cities = City::count();
        $orders = Order::count();
        $products = Product::count();
        
        return view("Admin.dashboard", compact('roles', 'sellers', 'users', 'total', 'categories', 'subcategories', 'states', 'cities', 'orders', 'products'));
    }
    public function seller(){

        // $roleId = Role::where('name','Seller')->value('id');  
        // $role = Role::findOrFail($roleId);
        // $roleusers = DB::table("model_has_roles")
        //     ->where("model_has_roles.role_id",$role->id)
        //     ->pluck("model_has_roles.model_id")
        //     ->toArray();

        // $users = User::whereIn('id', $roleusers)->paginate(5);

        $users = User::Role('Seller')->withCount(['orders','product'])->paginate(5);
        $orderCountBySeller = [];

  // Iterate through the sellers and count the number of orders for each
    //     foreach ($users as $seller) {
    //         // $orderCountBySeller[$seller->id] = $seller->orders->count();
    //         $orders = $seller->orders();

    // // Check if the $orders variable is not null
    // if (!is_null($orders)) {
    //   $orderCountBySeller[$seller->id] = $orders->count();
    // } else {
    //   $orderCountBySeller[$seller->id] = 0;
    // }
    //     }


    $totalOrderCount = 0;

    // Iterate through the sellers and count the number of orders for each
    // foreach ($users as $seller) {
    //   $orders = $seller->orders();
  
    //   // Check if the $orders variable is not null
    //   if (!is_null($orders)) {
    //     $totalOrderCount += $orders->count();
    //   }
    // }
    // foreach ($users as $seller) {
    //     $totalOrderCount += $seller->orders_count;
    //   }



    // foreach ($users as $seller) {
    //     $orders = $seller->ordersToCount();
    
    //     // Check if the $orders variable is not null
    //     if (!is_null($orders)) {
    //       $orderCount = 0;
    
    //       // Iterate through the orders and count the number of order items
    //       foreach ($orders as $order) {
    //         $orderCount += $order->orderItems()->count();
    //       }
    
    //       // Add the order count for this seller to the total
    //       $totalOrderCount += $orderCount;
    //     }
    //   }
//     $count = DB::table('orders')
//               ->select(DB::raw('COUNT(*) as `Total`'))
//               ->whereIn('status', ['completed'])
//               ->groupByRaw('user_id, status')
//               ->get()
//               ->pluck('Total');
              
// $dataPoints = array();
// foreach ($count as $value) {
//     $dataPoints[] = [ "label" => "", "y" => $value ];
// }

// $count = DB::table('orders')





        // $user = User::Role('Seller')->with('product')->get();
        // $sellers = User::withCount('product')->get();
        // $sellers = User::role('seller')->get();

        // $sellers->loadCount('product.orders');
        // @foreach ($users as $seller)
                                                
        //                                         <h5>{{ $orderCountBySeller[$seller->id] }}</h5>
        //                                     @endforeach
        // productWithOrder
        // $users->loadCount('productWithOrder');
        // $sellers->loadCount('product.orders');


        
        
        // @php
        //                                             $user = User::Role('Seller')->with('product')->get();
        //                                             $product = $user->count();
        //                                             @endphp{{$product}}
        // $user = User::withCount('products')->get();
        // $product = Product::where('seller_id', $user)->count();
        // dd($product);
    //     $users = User::withCount('products')->get();
    // return view('sellers', compact('users')); {{ $user->products_count }}
    // return view('sellers', compact('users'));
        // dd($user);@php
                                                
        // $product = $user->count();
                                                    
        // @endphp
        // {{$product}}
        // // dd($user);
        // foreach($user as $userr){
        //     dd($userr);
        // $products = Product::with(['category','subcategory'])->where('seller_id', $user)->get();  
        // // dd($products);
        // $count = $products->count();
        // dd($count);
        // }      
// dd('121321');
        return view('admin.role-permission.sellers.ind', [
            'users' => $users,
            // 'user' => $user
            'orderCountBySeller' => $orderCountBySeller,
            'totalOrderCount' => $totalOrderCount
            // 'sellers' => $sellers,
            // 'products' => $products,
            // 'count' => $count
        ]);
    }
   

    public function user()
    {
        // $roleId = Role::where('name','User')->value('id');  
        // $role = Role::findOrFail($roleId);
        // $roleusers = DB::table("model_has_roles")
        //     ->where("model_has_roles.role_id",$role->id)
        //     ->pluck("model_has_roles.model_id")
        //     ->toArray();

        // $users = User::whereIn('id', $roleusers)->paginate(5);
        $users = User::Role('User')->paginate(5);

        return view('admin.role-permission.users.index', ['users' => $users]);
    }
    public function orderlist(){
        $orders = Order::paginate(5);
       
        return view('admin.orderlist',[
          'orders' => $orders
        ]);
    }

    public function  userOrders($userId)
    {
        $orders = Order::where('user_id', $userId)->paginate(8);
        return view('admin.role-permission.users.orders', ['orders' => $orders]);
    }

    public function sellerProducts($userId){
        $products = Product::with(['category','subcategory'])->where('seller_id', $userId)->paginate(6);
        return view ('admin.role-permission.sellers.main',['products'=>$products]);
    }

    public function products(){
        $products = Product::with(['category','subcategory'])->paginate(6);
        return view ('admin.role-permission.sellers.main',['products'=>$products]);
    }
    
    public function editProfile($userId){
        $user=User::findOrFail($userId);
        
        return view('admin.role-permission.users.edit-profile',compact('user'));
    }
    // public function updateProfile(Request $request, $userId)
    // {
    //     $request->validate([
    //         'name'      => ['required', 'string', 'max:255'],
    //         'email'     => ['required', 'string', 'max:255', 'unique:'.User::class],
    //         'mobile'    => ['required'],
    //         'username'  => ['required', 'string', 'max:255', 'unique:'.User::class],
    //         'password'  => ['nullable', 'confirmed', 'min:8'],
    //     ]);

    //     $updates = User::where('id', $userId)->update([
    //         'name'      => $request->name,
    //         'email'     => $request->email,
    //         'mobile'    => $request->mobile,
    //         'username'  => $request->username,
    //     ]);

    //     return redirect()->route('display.user')->with('status', 'Record updated successfully');
    // }
    public function updateProfile(Request $request,  $userId){
      
        // $request->validate([
        //     'name'      => ['required|string|max:255'],
        //     'email'     => ['required', 'string', 'max:255','unique:'.User::class],
        //     'mobile'    => ['required'],
        //     'username'  => ['required', 'string', 'max:255','unique:'.User::class],
        //     'password'  => ['nullable|confirmed|min:8'],
        // ]);
        $request::validate([
            'name' => ['required', 'string', 'max:255'],
           // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['required', 'string', 'max:255'],
          //  'username' => ['required', 'string', 'max:255','unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $data= $request::all();
        $updates = User::where('id',$userId)->update(['name'=>$data['name'],'email' => $data['email'],'mobile'=>$data['mobile'],'username'=>$data['username']
        // 'email' => $request->email, 'mobile'=>$request->mobile, 'username'=>$request->username
    ]);
        return redirect()->route('display.user')->with('status','Record updated successfully');
    }
    // //    $input=$request->all();
//        if(!isset($input['password'])){
//            unset($input['password']);
//        }else{
//            $input['password']=Hash::make($input['password']);
//        }
//        User::findOrFail($userId)->update($input);
//        Session::flash('message', 'Your profile has been updated!');
//        return redirect()->route('admin.dashboard');
//    }

//    //show add product form to admin
//    public function createProduct() {
//        $categories = Category::get();
//        $subCategories = SubCategory::whereNull('deleted_at')
//                                ->orderBy('category_id','asc')
//                                ->get();
//        return view('admin.product.add', compact('categories', 'subCategories'));
//    }

//    //store new product in database
//    public function storeProduct(Request $request) {
//        $validator = Validator::make($request->all(),[
//            'title'=>'required|string|max:190',
//            'price'=>'required|numeric',
//            'discount_price'=>'nullable|numeric',
//            'description'=>'required|string',
//            'quantity'=>'required|integer',
//            'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'status'=>'required|boolean',
//            'category_id'=>'required|exists:App\Models\Category,id',
//            'sub_category_id'=>'sometimes|nullable|exists:App\Models\SubCategory,id'
//        ])->validate();

//        $imageName='';
//        if ($request->hasFile('image')) {
//            $imageName = time().'.'.$request->image->extension();
//            $request->image->move(public_path('/uploads/products'),$imageName);
//        }

//        Product::create([
//           'user_id'=>Auth::user()->id,
//           'title'=>$request->title,
//           'slug'=>Str::of($request->title)->slug('-'),
//           'price'=>$request->price,
//           'discount_price'=>isset($request->discount_price)?$request->discount_price:'',
//           'description'=>$request->description,
//           'quantity'=>$request->quantity,
//           'image'=>$imageName,
//           'status'=>$request->status,
//           'viewed'=>0,
//           'featured'=>false,
//           'trending'=>false,
//           'category_id'=>$request->category_id,
//           'sub_category_id'=>$request->sub_category_id?$request->sub_category_id:NULL
//       ]);

//        Toastr::success("New product has been added successfully","Success");
//        return redirect()->route('product.index');
//     }

// //show edit form for the selected product
//    public function showEditForm(Product $product){
//      abort_if(Gate::denies('edit_product'),Response::HTTP_FORBIDDEN,"You are not authorized to perform this action");
     
    
//     }
}
