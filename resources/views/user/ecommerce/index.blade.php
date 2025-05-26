@extends('layouts.user')
@section('title')
Products
@endsection
@section('css')
<style>
    /* .irs--square .irs-handle {
        border: 2px solid #556ee6;
        background-color: #556ee6;
    } */

    .irs-single {
        background-color: #556ee6;
    }
    .container-fluid{
        margin-left:  -10px !important;
    }
    .page-content{
        margin-left:  10px !important;
    }
    .main{
        /* padding-top: 3% !important */
        margin-left: -10px !important;
    }

</style>
@endsection
@section('content')

<div class="main">
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row ">
            <div class="col-12">
                <div class="col-5 center">
                    @if (session('status'))
                    <div class="alert alert-danger alert-dismissible fade show center" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Filter</h4>

                        <div>
                            @foreach($categories as $category)
                                <a href="{{route('category', $category->id)}}">
                                    <h5 class="font-size-14 mb-3">{{$category->name}}</h5>
                                </a>
                                <ul class="list-unstyled product-list">
                                    @foreach($category->subcategory as $subcategory)
                                        <li><a name="category" class="category" href="{{route('filters',[$category->id, $subcategory->id])}}"><i class="mdi mdi-chevron-right mr-1"></i> {{$subcategory->name}}</a></li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                        <!-- <div class="mt-4 pt-3">
                                <h5 class="font-size-14 mb-3">Price</h5>
                                <input type="text" id="pricerange">

                            </div>           -->
                        <div class="mt-4 pt-3">
                            <h5 class="font-size-14 mb-3">Price</h5>
                            <input type="text" id="pricerange" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">

                <div class="row mb-3">
                    <div class="col-xl-4 col-sm-6">
                        <div class="mt-2">
                            <!-- @if (!empty($msg))
                            <h5>Products</h5>
                            @else
                            @foreach($categories as $categoryy)
                            <h5>{{$categoryy->name}}</h5>@endforeach
                            @endif -->
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-6">
                    @guest
                        <ul class="mt-4 mt-sm-0 float-sm-right form-inline nav nav-pills product-view-nav">
                            <li class="nav-item">
                                <!-- <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">3</span> -->
                                &nbsp;&nbsp;&nbsp;<span class="badge badge-danger badge-pill float-right">{{ count(Session::get('cart', array())) }}</span><a class="nav-link active float-right" href="{{route('cart.list')}}">
                                    <i class="bx bx-cart-alt"></i>
                                </a>
                            </li>
                        </ul>
                        @endguest
                        @auth
                        <ul class="mt-4 mt-sm-0 float-sm-right form-inline nav nav-pills product-view-nav">
                            <li class="nav-item">
                                <!-- <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">3</span> -->
                                &nbsp;&nbsp;&nbsp;<span class="badge badge-danger badge-pill float-right">{{ $count }}</span><a class="nav-link active float-right" href="{{route('cart.list')}}">
                                    <i class="bx bx-cart-alt"></i>
                                </a>
                            </li>
                        </ul>
                        @endauth
                        <form action="{{ route('products.search') }}" method="GET" class="mt-4 mt-sm-0 float-sm-right form-inline" enctype="multipart/form-data">
                            <div class="search-box mr-2">
                                <div class="position-relative">
                                    <input type="text" class="form-control border-0" id="search" name="search" placeholder="Search..." value="{{old('search')}}">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </form>
                        {{-- <form action="{{ route('products.search') }}" method="GET" class="mt-4 mt-sm-0 float-sm-right form-inline" enctype="multipart/form-data">
                            <div class="search-box mr-2">
                                <div class="position-relative">
                                    <input type="text" class="form-control border-0" id="search" name="search" placeholder="Search..." value="{{old('search')}}">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
                <div class="row" id="product-list">

                    @foreach( $products as $product )

                    <div class="col-xl-4 col-sm-6">
                        {{-- @include('user.ecommerce.display', ['product' => $product])  --}}
                        <div class="card">
                            <div class="card-body">
                                <a href="{{url('ecommerce/details/'.$product->id)}}">
                                    <div class="product-img position-relative">
                                        <div class="avatar-sm product-ribbon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                @php
                                                    $discount = number_format($product->discountss?->percentage ?? 2)
                                                @endphp
                                                {{$discount}}%
                                            </span>
                                        </div>

                                        <img src="{{asset('storage/app/public/uploads/images/'.$product->pictures[0]->image)}}" style="height:33rem;" alt="Image" class="img-fluid mx-auto d-block">

                                    </div>
                                    <div class="mt-4 text-center">
                                        <h5 class="mb-3 text-truncate"><a href="#" class="text-dark">{{$product->brand}}&nbsp;{{$product->product_name}}</a></h5>

                                        <p class="text-muted">
                                            <i class="bx bx-star text-warning"></i>
                                            <i class="bx bx-star text-warning"></i>
                                            <i class="bx bx-star text-warning"></i>
                                            <i class="bx bx-star text-warning"></i>
                                            <i class="bx bx-star text-warning"></i>
                                        </p>
                                        <!-- ₹ -->
                                        @php
                                            $old_amount = floor(($product->price * 100) / ($discount-100))
                                        @endphp
                                        <h5 class="my-0"><span class="text-muted mr-2"><del>Rs.{{$old_amount}}</del></span><b>Rs. {{$product->price}}</b></h5>
                                </a>
                                {{-- @dd($product->quantity>0) --}}
                                @if ( $product->quantity > 0 )

                                <a href="{{url('ecommerce/cart/'.$product->id)}}"><button type="button" class="btn btn-primary waves-effect waves-light mt-3 mr-1">
                                        <i class="bx bx-cart mr-2"></i> Add to cart
                                    </button></a>
                                    @else
                                    <h4 class="waves-effect waves-light mt-3 mr-1">Out Of Stock</h4>
                                    @endif
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <!-- end row -->
            <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                {!! $products->links() !!}
            </div>

        </div>
    </div>
    <!-- end row -->

</div> <!-- container-fluid -->
</div>
</div>


@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Ion Range Slider-->
<link href="{{asset('storage/assets/libs/ion-rangeslider/css/ion.rangeSlider.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('storage/assets/libs/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>



<script>
    let minPrice=null;
    let maxPrice=null;
    let search=null;

    $(document).ready(function() {
        $("#pricerange").ionRangeSlider({
            range: true,
            skin: "square",
            type: "double",
            grid: true,
            min: 0,
            max: 11000,
            from: 500,
            to: 1500,
            prefix: "₹",
            onFinish: function(data) {
                minPrice=data.from;
                maxPrice=data.to;
                updateProductsByPrice(data.from, data.to,search);
                // console.log(data.from);
            },
        });

        $('#search').on('keyup', function() {

            // var text = $('#search').val();
            search = $(this).val();

            if(search!==""){
                updateProductsByPrice(minPrice,maxPrice,search);
            }
        });
    });

    function updateProductsByPrice(minPrice, maxPrice,search) {
        $.ajax({
            type: "GET",
            url: "{{url('search')}}",
            data: {
                min_price: minPrice,
                max_price: maxPrice,
                search: search,
            },
            dataType: 'html',
            success: function(response) {

                $("#product-list").html(response);

            },
        });
    }

</script>
@endsection
