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
                    <h4 class="mb-0 font-size-18">Sellers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Sellers</li>
                        </ol>
                    </div>
                    
                </div>
            </div>
        </div>     
        <!-- end page title -->

        <div class="row">
            @foreach ($users as $user)
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="text-center p-4 border-right">
                                    <div class="avatar-sm mx-auto mb-4">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                           @php 
                                                $first_char = substr($user->name, 0, 1);
                                           @endphp
                                           {{$first_char}}
                                        </span>
                                    </div>
                                    <h5 class="text-truncate">{{$user->name}}</h5>
                                    <h6 class="text-muted">{{$user->email}}</h6>
                                    <h6 class="text-muted">{{$user->mobile}}</h6>
                                </div>
                            </div>

                            <div class="col-xl-7">
                                <div class="p-4 text-center text-xl-left">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <p class="text-muted mb-2 text-truncate">Products</p>
                                                <h5>
                                                {{ $user->product_count }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <p class="text-muted mb-2 text-truncate">Orders</p>
                                                
                                                <h5> {{ $totalOrderCount }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{route('display.seller.products',$user->id)}}">See products</a>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
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
                    </div>
                </div>
            @endforeach
            <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                {!! $users->links() !!}
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
@section('script')
@endsection