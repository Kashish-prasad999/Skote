@extends('layouts.seller')
@section('title')
Edit product
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    @if (session('status'))   
                        <div class="alert alert-danger alert-dismissible fade show center" role="alert">      
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                                <li class="breadcrumb-item active">Edit Product</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>     
            <!-- end page title -->

             <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                   
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-sm-right">
                                        <a href="{{url('seller/display')}}"><button class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-keyboard-backspace"> </i>Back</button></a>
                                    </div>
                                </div><!-- end col-->
                            </div>
                            <form action="{{url('seller/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group row mb-4">
                                    <label for="name" class="col-form-label col-lg-2">Product Name</label>
                                    <div class="col-lg-10">
                                        <input name="product_name" type="text" class="form-control" value="{{$product->product_name}}" placeholder="Enter Product Name">
                                        @error('product name')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="name" class="col-form-label col-lg-2">Manufacturer Brand</label>
                                    <div class="col-lg-10">
                                        <input name="brand" type="text" class="form-control" value="{{$product->brand}}" placeholder="Enter Brand Name">
                                        @error('brand name')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="name" class="col-form-label col-lg-2">Quantity</label>
                                    <div class="col-lg-10">
                                        <input name="quantity" type="number" class="form-control" value="{{$product->quantity}}" placeholder="Enter Quantity">
                                        @error('quantity')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="name" class="col-form-label col-lg-2">Price</label>
                                    <div class="col-lg-10">
                                        <input name="price" type="number" class="form-control" value="{{$product->price}}" placeholder="Enter Price">
                                        @error('price')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <!-- @php
                                        $img=json_decode($product->image);
                                    @endphp      -->
                                    @foreach($product->pictures as $picture)
                                        <img src="{{asset('storage/uploads/images/'.$picture->image)}}" width="100px" height="100px" alt="Image"><br><br>
                                    @endforeach
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label col-lg-2">Change Image?</label>
                                    <div class="col-lg-10">
                                        <div class="custom-file">
                                            <!-- <input name="image[]" type="file" class="custom-file-input" id="customFile" multiple/> -->
                                            <input type="file" value="{{asset('storage/uploads/images/'.$product->image)}}" name=image[] class="custom-file-input" id="customFile" reqired multiple>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('image')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for=""name class="col-form-label col-lg-2">Discount</label>
                                    <div class="col-lg-10">
                                       <select name="discount" class="form-control" value="{{$product->discount}}">
                                            <!-- <option value="">-----Select  Discount ----</option>  -->
                                            @foreach($discounts as $discount)
                                                <option value="{{$discount->percentage}}">{{$discount->percentage}}%</option>
                                            @endforeach
                                       </select>
                                        @error('category')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="name" class="col-form-label col-lg-2">Category</label>
                                    <div class="col-lg-10">
                                       <select name="category" class="form-control" id="categoryList" value="{{$product->category->name}}">
                                            <!-- <option value="">-----Select  Category ----</option>  -->
                                            @foreach($categories as $category)
                                                <!-- <a href="{{url('seller//subcategories/'.$category->id)}}"> -->
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                <!-- </a> -->
                                            @endforeach
                                       </select>
                                        @error('category')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="name" class="col-form-label col-lg-2">Subcategory</label>
                                    <div class="col-lg-10">
                                       <select name="subcategory" class="form-control" id= "subcategoryList" value="{{$product->subcategory->name}}">
                                            <!-- <option value="">----- Select subcategory ----- </option> -->
                                            @foreach($subcategories as $subcategory)
                                            <!-- <option value="{{$subcategory->id}}">{{$subcategory->name}}</option> -->
                                                <option value="{{$subcategory->id}}" class="parent-{{ $subcategory->category_id }} subcategory">{{$subcategory->name}}</option>
                                            
                                            @endforeach
                                            
                                       </select>
                                        @error('subcategory')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#categoryList').on('change', function () {
            $("#subcategoryList").attr('disabled', false); //enable subcategory select
            $("#subcategoryList").val("");
            $(".subcategory").attr('disabled', true); //disable all category option
            $(".subcategory").hide(); //hide all subcategory option
            $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
            $(".parent-" + $(this).val()).show(); 
        });
    });
</script>
@endsection