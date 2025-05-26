@extends('layouts.user')
@section('title')
Product Details
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
                    <h4 class="mb-0 font-size-18">Product Detail</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Product Detail</li>
                        </ol>
                        @guest
                        <ul class="nav nav-pills product-view-nav float-right">
                            <li class="nav-item">
                                <!-- <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">3</span> -->
                                &nbsp;&nbsp;&nbsp;<span class="badge badge-danger badge-pill float-right">{{ count(Session::get('cart', array())) }}</span><a class="nav-link active float-right" href="{{route('cart.list')}}">

                                    <i class="bx bx-cart-alt"></i>

                                </a>
                            </li>
                        </ul>
                        @endguest
                        @auth
                        <ul class="nav nav-pills product-view-nav float-right">
                            <li class="nav-item">
                                <!-- <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">3</span> -->
                                <span class="badge badge-danger badge-pill float-right">{{ $count }}</span><a class="nav-link active float-right" href="{{route('cart.list')}}">

                                    <i class="bx bx-cart-alt"></i>

                                </a>
                            </li>
                        </ul>
                        @endauth
                    </div>

                </div>

            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="col-md-2 col-3">
                                        {{-- @php
                                                $img=json_decode($products->image);
                                            @endphp  --}}
                                        <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            @foreach($products->pictures as $img)
                                            <a class="nav-link" target="_parent" href="{{asset('storage/uploads/images/'.$img->image)}}" role="tab" style="height:7rem; width:6rem">
                                                <img src="{{asset('storage/uploads/images/'.$img->image)}}" style="height:5rem; width:7rem" alt="Img" class="img-fluid mx-auto d-block rounded">
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-7 offset-md-1 col-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            {{-- @php
                                            $img=json_decode($products->image)[0];
                                        @endphp --}}
                                            {{-- @dd($products->pictures) --}}

                                            <img src="{{asset('storage/uploads/images/'.$products->pictures[0]->image)}}" style="height:35rem;" alt="Image" class="img-fluid mx-auto d-block">


                                        </div>
                                        <div class="text-center">
                                            <a href="{{url('ecommerce/cart/'.$products->id)}}"><button type="button" class="btn btn-primary waves-effect waves-light mt-2 mr-1">
                                                    <i class="bx bx-cart mr-2"></i> Add to cart
                                                </button></a>
                                            <a href="{{route('buy.now', $products->id)}}"><button type="button" class="btn btn-success waves-effect  mt-2 waves-light">
                                                    <i class="bx bx-shopping-bag mr-2"></i>Buy now
                                                </button></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <a href="#" class="text-primary">{{$products->category->name}}</a>
                                <h4 class="mt-1 mb-3">{{$products->brand}}&nbsp;{{$products->product_name}}</h4>

                                <p class="text-muted float-left mr-3">
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star"></span>
                                </p>
                                <p class="text-muted mb-4">( 152 Customers Review )</p>

                                <h6 class="text-success text-uppercase">{{$product->discountss?->percentage ?? 0}}% OFF</h6>
                                <h5 class="mb-4">Price : <span class="text-muted mr-2"><del>$240 USD</del></span> <b>₹{{$products->price}}</b></h5>
                                <p class="text-muted mb-4">To achieve this, it would be necessary to have uniform grammar pronunciation and more common words If several languages coalesce..................................................................................................................</p>


                            </div>
                        </div>

                    </div>
                    <!-- end row -->

                    <div class="mt-5">
                        <h5 class="mb-3">Specifications :</h5>

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Category</th>
                                        <td>{{$products->subcategory->name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Brand</th>
                                        <td>{{$products->brand}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Color</th>
                                        <td>Black</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end Specifications -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
@section('script')
<script>
    
</script>
@endsection