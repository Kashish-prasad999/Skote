<?php

namespace App\Http\Controllers\Seller;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(7);
        return view('seller.product-category.category.index',['categories'=>$categories]);
    }

    public function create()
    {
        return view('seller.product-category.category.create');
    }

    public function  store(Request $request)
    {
       // dd($request->all());
        
        $request->validate([
            'name' => 'required','string','unique:category,name'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('category.list')->with('status','Category has been created!');
    }

    public function edit(Category $category){
    
        return view('seller.product-category.category.edit',[
            'category'=>$category]);        
    }

    public function update(Request $request, Category $category){
     
        $request->validate([
            'name' => 'required','string','unique:category,name'.$category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.list')->with('status','Category updated successfully!!');
    }
    
    public function destroy($categoryId){
        $category = Category::find($categoryId);
        $category->delete();
        return redirect('category')->with('status','Category deleted successfully!!');
    }
}
