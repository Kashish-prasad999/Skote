@extends('layouts.user')
@section('title')
Orders list
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
                    <h4 class="mb-0 font-size-18">Orders</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Add New Order</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Order ID</th>
                                        <th>Billing Name</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Payment Method</th>
                                        <th>View Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                    <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{$order->id}}</a> </td>
                                                <td>{{$order->name}}</td>
                                                <td>
                                                    {{$order->created_at}}
                                                </td>
                                                <td>
                                                    {{$order->grand_total}}
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-soft-success font-size-12">{{$order->status}}</span>
                                                </td>
                                                <td>
                                                    <i class="fab fa-cc-mastercard mr-1"></i> {{$order->payment_method}}
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded" data-toggle="modal" data-target=".exampleModal-{{ $order->id }}">
                                                        View Details
                                                    </button>
                                               

                                                    <!-- Modal for viewing order details -->
                                                    <div class="modal fade exampleModal-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="mb-2">Order id: <span class="text-primary">{{ $order->id }}</span></p>
                                                                    <p class="mb-4">Billing Name: <span class="text-primary">{{ $order->name }}</span></p>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-centered table-nowrap">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Product</th>
                                                                                    <th>Product Name</th>
                                                                                    <th>Price</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($order->items as $item)
                                                                                @php
                                                                                    $total += $item->product->price * $item->quantity ;
                                                                                    $subtotal = $item->product->price * $item->quantity ;
                                                                                @endphp
                                                                                <tr>
                                                                                    <th scope="row">
                                                                                        <div>
                                                                                            @php                                                             
                                                                                                $img=json_decode($item->product->image)[0];
                                                                                            @endphp
                                                                                            <img src="{{asset('storage/uploads/images/'.$img)}}" alt="product-img" class="avatar-sm">
                                                                                        </div>
                                                                                    </th>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-truncate font-size-14">{{$item->product->brand}}&nbsp;{{$item->product->product_name}}</h5>
                                                                                            <p class="text-muted mb-0">₹ {{$item->price}} x {{$item->quantity}}</p>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>₹{{ $subtotal}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                                                                    </td>
                                                                                    <td>
                                                                                        ₹{{ $total}}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <h6 class="m-0 text-right">Shipping:</h6>
                                                                                    </td>
                                                                                    <td>
                                                                                        Free
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <h6 class="m-0 text-right">Total:</h6>
                                                                                    </td>
                                                                                    <td>
                                                                                        ₹{{ $total}}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
<!-- End Page-content -->
@endsection
@section('script')
@endsection