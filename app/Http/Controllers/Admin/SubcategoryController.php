<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->paginate(7);
        // $sub = DB::table('subcategory')::with('category')->all();
        // $sub = Subcategory::select('category_id')->get();
        // $sub = DB::table('subcategory')->pluck('category_id', 'category_id');
        // $cat = DB::table('category')->where('id',$sub)->pluck('name')->all();
        // $category = DB::table('category')->select('id','name')->get(); 
        // dd($cat);
        // $categories = Category::pluck('id', 'name')->get();
        return view('admin.product-category.subcategory.index',['subcategories'=>$subcategories]);
    }

    public function create($categoryId)
    {
        $cat = Category::findOrFail($categoryId);
        $category = Category::select('id','name')->get(); 
        return view('admin.product-category.subcategory.create',[ 'categoryId' => $categoryId,   "category" => $category, 'cat'=>$cat ]);
    }

    public function  store(Request $request, $categoryId)
    {
       // dd($request->all());
        // $category = Category::find($categoryId);
        // $category =  Category::where('id',$categoryId)->pluck('id');
        $request->validate([
            'name' => 'required','string','unique:subcategory,name'
        ]);

        Subcategory::create([
            'name' => $request->name,
            'category_id' => $categoryId
        ]);

        return redirect()->route('admin.subcategory.list')->with('status','Subcategory has been created!');
    }
    public function withoutcreate()
    {
        return view('admin.product-category.subcategory.without-category');
    }

    public function  withoutstore(Request $request)
    {
        $request->validate([
            'name' => 'required','string','unique:subcategory,name'
        ]);

        Subcategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.subcategory.list')->with('status','Subcategory has been created!');
    }

    public function edit(Subcategory $subcategory){
    
        return view('admin.product-category.subcategory.edit',[
            'subcategory'=>$subcategory]);        
    }

    public function update(Request $request, Subcategory $subcategory){
     
        $request->validate([
            'name' => 'required','string','unique:subcategory,name'.$subcategory->id,
        ]);

        $subcategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.subcategory.list')->with('status','Subcategory updated successfully!!');
    }
    
    public function destroy($subcategoryId){
        $subcategory = Subcategory::find($subcategoryId);
        $subcategory->delete();
        return redirect()->route('admin.subcategory.list')->with('status','Subcategory deleted successfully!!');
    }
}
