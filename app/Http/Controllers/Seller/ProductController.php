<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        // $product= Product::with(['category','subcategory'])->where('seller_id',Auth::id())->paginate(4);  
        $product = Product::with(['category', 'subcategory', 'pictures'])->where('seller_id', Auth::id())->paginate(4);
        // dd($product);
        return view('seller.product.index', ['product' => $product]);
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $discounts =  Discount::all();

        return view('seller.product.add-product', ['categories' => $categories, 'subcategories' => $subcategories, 'discounts' => $discounts]);
    }
    // public function getsubcategory(Request $request)
    // {
    //     $subcategory = Subcategory::where("id",$request->subcategory_id)->get("id");
    //     return response()->json($subcategory);
    // }
    public function store(Request $request)
    {

        $request->validate([
            'product_name' => 'required', 'string',
            'brand' => 'required', 'string',
            'price' => 'required|numeric',
            'image' => 'required',
        ]);
        $product = new Product;

        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->seller_id = Auth::user()->id;
        $product->brand = $request->input('brand');
        $product->quantity = $request->input('quantity');
        $product->category_id = $request->input('category');
        $product->subcategory_id = $request->input('subcategory');
        $product->discount = $request->input('discount');

        $product->save();

        // $product_images = new ProductImage();
        // $allImages = null;

        // if ($request->hasFile('image')) {
        //     foreach ($request->file('image') as $image) {
        //         $destinationPath = 'storage/uploads/images/';
        //         $filename = $image->getClientOriginalName();
        //         $image->move($destinationPath, $filename);
        //         $fullPath = $filename;
        //         $allImages .= $allImages == null ? $fullPath : ';' . $fullPath;
        //     }
        //     // $product = Product::create($request->all());
        //     // $product->id = $product->id;
        //     // $products = Product::where(["id" => $product->id])->first();
        //     // $product_images->setProductId($products->id);
            
        //     // $product_images->product_id =  $request->input('product_id');
        //     $product_images->product_id =  $product->id;
        //     // dd($product_images);
        //     $product_images->image = $allImages;
        //     $product_images->save();
        // }


        $product_images = new ProductImage();
        $allImages = null;

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName();

                // Store file using Laravel Storage (this saves it in storage/uploads/images/)
                $image->storeAs('public/uploads/images', $filename);

                // Store just the filename or path for later use
                $allImages .= $allImages === null ? $filename : ';' . $filename;
            }

            $product_images->product_id = $product->id;
            $product_images->image = $allImages;
            $product_images->save();
        }

        return redirect()->route('display.product')->with('status', 'Record added successfully');
    }

    public function edit($id)
    {

        $product = Product::with(['category', 'subcategory'])->where('id', $id)->first();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $discounts =  Discount::all();
        // dd($product);   

        return view('seller.product.edit', ['product' => $product, 'categories' => $categories, 'subcategories' => $subcategories, 'discounts' => $discounts]);
    }

    // public function update(Request $request, $id)
    // {

    //     $product = Product::where('id', $id)->first();
    //     // $filename = null;
    //     // dd($product);
    //     // $str = json_decode($product->image);\
    //     $product_images = new ProductImage();
    //     $allImages = null;

    //     $img= $product_images->image;

    //     if ($request->hasFile('image') != '') {

    //         $destination = 'storage/uploads/images/' . $img;
    //         // dd(File::exists($destination));
    //         if (File::exists($destination)) {
    //             File::delete($destination);
    //         }
    //         foreach ($request->file('image') as $image) {
    //             $destinationPath = 'storage/uploads/images/';
    //             $filename = $image->getClientOriginalName();
    //             $image->move($destinationPath, $filename);
    //             $fullPath = $filename;
    //             $allImages .= $allImages == null ? $fullPath : ';' . $fullPath;
    //         }
    //         // $product_images->product_id =  $product->id;
    //         // dd($product_images);
    //         $product_images->image = $allImages;
    //         $product_images->update();
    //         // foreach ($request->file('image') as $image) {
    //         //     $name = $image->getClientOriginalName();
    //         //     $image->move('storage/uploads/images/', $name);
    //         //     $item[] = $name;
    //         // }
    //     }

    //     // // $upload = new Product;
    //     // $Image = json_encode($item);
    //     // $product->image = $Image;

    //     $updateProduct = Product::where('id', $id)->update(['product_name' => $request->product_name, 'brand' => $request->brand, 'price' => $request->price, 'category_id' => $request->category, 'subcategory_id' => $request->subcategory, 'discount' => $request->discount, 'quantity' => $request->quantity]);
    //     return redirect()->route('display.product')->with('status', 'Record updated successfully');
    // }


    public function update(Request $request, $id)
    {
        // Get product and its image record
        $product = Product::findOrFail($id);
        $productImages = ProductImage::where('product_id', $product->id)->first();
        $allImages = null;

        if ($request->hasFile('image')) {

            // Delete old images
            if ($productImages && $productImages->image) {
                $oldImages = explode(';', $productImages->image);
                foreach ($oldImages as $img) {
                    $oldPath = storage_path('app/public/uploads/images/' . $img);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }
            }

            // Upload new images
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName();
                $image->storeAs('public/uploads/images', $filename);
                $allImages .= $allImages === null ? $filename : ';' . $filename;
            }

            // Update image record (don't create new one)
            if ($productImages) {
                $productImages->image = $allImages;
                $productImages->save();
            } else {
                // If no image record exists, create new one
                $productImages = new ProductImage();
                $productImages->product_id = $product->id;
                $productImages->image = $allImages;
                $productImages->save();
            }
        }

        // Update product fields
        $product->update([
            'product_name' => $request->product_name,
            'brand' => $request->brand,
            'price' => $request->price,
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'discount' => $request->discount,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('display.product')->with('status', 'Record updated successfully');
    }


    public function destroy($id)
    {

        Product::where('id', $id)->delete();
        ProductImage::where('product_id', $id)->delete();
        // $product= Product::where('id',$id)->delete();
        return redirect()->back()->with('status', 'Record deleted Successfully');
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->p1;
        // dd($ids);
        Product::whereIn('id', explode(",", $ids))->delete();
        // $product = Product::whereIn('id',explode(",",$ids))->get();
        // dd($product);
        // $product->delete();
        // if ($product->delete()) {
        //     return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
        // } else {
        //     return response()->json(['error' => 'Error deleting product']);
        // }
        return response()->json(['success' => "Products Deleted successfully."]);
        // return redirect()->back()->with('status','Record deleted Successfully');
    }

    //     public function filterByPrice(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $minPrice = intval($request->min_price);
    //         $maxPrice = intval($request->max_price);

    //         $products = Product::whereBetween('price', [$minPrice, $maxPrice])
    //             ->orderBy('price', 'asc')
    //             ->get()
    //             ->toArray();

    //         $html = [];
    //         foreach ($products as $product) {
    //             $html[] = view('user.ecommerce.products.product-item', ['product' => $product])->render();
    //         }

    //         return response()->json(['success' => true, 'data' => ['html' => $html]]);
    //     }

    //     return response()->json(['success' => false]);
    // }

    // image \upload multiple 
    // if($request->hasFile('image'))
    // {
    //     foreach($request->file('image') as $image)
    //     {
    //         $name = $image->getClientOriginalName();

    //         $image->move('storage/uploads/images/',$name);
    //         $item[] = $name;
    //     }      
    // }
    // $Image= json_encode($item);
    // $product->image = $Image;
    // $product->save();

    // return redirect()->route('display.product')->with('status','Record added successfully');
}
