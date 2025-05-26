@extends('layouts.user')
@section('title')
Checkout
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
                        <h4 class="mb-0 font-size-18">Checkout</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="checkout-tabs">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="v-pills-tabContent">
                                    
                                    <div class="tab-pane fade show active" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                        <div class="card shadow-none border mb-0">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Order Summary</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><h4>Address</h4></th>
                                                                <th>
                                                                    <div class="row justify-content-end ">
                                                                        <div class="col-sm-6">
                                                                            <div class="text-sm-right">
                                                                                <a href="{{url('shipping')}}" id="" class="btn btn-primary">
                                                                                    <i class="bx bx-add-to-queue"></i> Add New Address </a>
                                                                            </div>
                                                                        </div> <!-- end col -->
                                                                    </div> 
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $prevAddress = '';
                                                            @endphp
                                                            @foreach($shipping as $ship)
                                                            @if ($ship->address != $prevAddress)
                                                            <tr>
                                                                <form action="{{route('cart.payment',$total)}}" method="get">
                                                                    @csrf
                                                                <td>

                                                                    <input type="radio" id="shipping" name="address"  value="{{$ship->id}}">
                                                                    <label class="" for="shipping"><p>{{ $ship->address }}&nbsp;&nbsp;{{ $ship->city }}&nbsp;&nbsp;- {{$ship->zipcode }}</p></label>
                                                                    @error('address')
                                                                        <span style="color:red">{{ $message }}</span>
                                                                    @enderror
                                                                    </td>
                                                                    <td>
                                                                        <div class="row justify-content-end ">
                                                                            <div class="col-sm-6">
                                                                                <div class="text-sm-right">
                                                                                    <a href="{{ route('shipping.edit', ['shipId' => $ship->id]) }}" class="btn btn-primary btn-sm-right"> <i class="dripicons-document-edit"></i> Edit Address</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $prevAddress = $ship->address;
                                                                @endphp
                                                            @endif
                                                        @endforeach                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-centered mb-0 table-nowrap">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Product Desc</th>
                                                            <th scope="col">Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $total=0 @endphp

                                                            @foreach($carts as $cart) 
                                                                @php
                                                                    $total += $cart->product->price * $cart->quantity ;
                                                                    $subtotal = $cart->product->price * $cart->quantity ;
                                                                @endphp
                                                                <tr>       
                                                                    {{-- @php                                                             
                                                                        $img=json_decode($cart->product->image)[0];
                                                                    @endphp --}}
                                                                    <th scope="row"><img src="{{asset('storage/uploads/images/'.$cart->product->pictures[0]->image)}}" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                    <td>
                                                                        <h5 class="font-size-14 text-truncate"><a href="{{route('product.details',[$cart->product->id])}}" class="text-dark">{{$cart->product->brand}}&nbsp;{{$cart->product->product_name}}</a></h5>
                                                                        <p class="text-muted mb-0">₹{{$cart->product->price}} x {{$cart->quantity}}</p>
                                                                    </td>
                                                                    <td> ₹{{ $subtotal}}</td>
                                                                
                                                                </tr>
                                                            @endforeach
                                                            <!-- <tr>
                                                                <td colspan="2">
                                                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                                                </td>
                                                                <td>
                                                                    $ 675
                                                                </td>
                                                                </tr> -->
                                                            <tr>
                                                                <td colspan="3">
                                                                    <div class="bg-soft-primary p-3 rounded">
                                                                        <h5 class="font-size-14 text-primary mb-0"><i class="fas fa-shipping-fast mr-2"></i> Shipping <span class="float-right">Free</span></h5>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h6 class="m-0 text-right">Total:</h6>
                                                                </td>
                                                                <td>
                                                                    ₹{{ $total }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <a href="{{route('cart.list')}}" class="btn text-muted d-none d-sm-inline-block btn-link">
                                    <i class="mdi mdi-arrow-left mr-1"></i> Back to Shopping Cart </a>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-sm-right">
                                    
                                    <button type="submit" class="btn btn-success"><i class="mdi mdi-cart-arrow-right"></i>&nbsp;&nbsp;Confirm Order</button>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
                <!-- end row -->
    </div> <!-- container-fluid -->
</div>
    <!-- End Page-content -->
@endsection
@section('script')
@endsection