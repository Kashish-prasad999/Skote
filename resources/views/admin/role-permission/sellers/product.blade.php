@extends('layouts.admin')
@section('title')
Sellers
@endsection
@section('css')

@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Seller</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                    
                </div>
            </div>
        </div>     
        <!-- end page title -->

        <div class="row">
            @foreach($products as $product)
            
                <div class="col-xl-4 col-sm-6">
                    <div class="card" >
                        <div class="card-body" style="height: 17rem;">
                            <div class="media" >
                                <div class="avatar-md mr-4" style="height: 15rem; width: 15rem">
                                    <span class="avatar-title bg-light text-danger font-size-16">
                                        @php
                                            $img=json_decode($product->image)[0];
                                        @endphp
                                        <img src="{{asset('storage/app/public/uploads/images/'.$img)}}" style="height: 15rem; width: 12rem" alt="Image">
                                    </span>
                                </div>

                                <div class="media-body overflow-hidden">
                                    <h5 class="text-truncate font-size-15 mb-4"><a href="#" class="text-dark">{{$product->brand}}&nbsp;{{$product->product_name}}</a></h5>
                                    <p class="text-muted mb-1">Brand:  {{$product->brand}}</p>
                                    <p class="text-muted mb-1">Category:  {{$product->category->name}}</p>
                                    <p class="text-muted mb-1">SubCategory:  {{$product->subcategory->name}}</p>
                                    <p class="text-muted mb-1">Quantity left:   {{$product->quantity}}</p>
                                    <div class="team">
                                        @php 
                                            $image = json_decode($product->image)
                                        @endphp    
                                        @if(count($image)>0)
                                            @foreach($image as $picture)
                                            
                                                <a href="{{asset('storage/app/public/uploads/images/'.$picture)}}" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Daniel Canales">
                                                
                                                    <img src="{{asset('storage/app/public/uploads/images/'.$picture)}}" class="rounded-circle avatar-xs m-1" alt="Image">
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                        More
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-pencil-alt text-success mr-1"></i> Edit</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-trash-alt text-danger mr-1"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                    {!! $products->links() !!}
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