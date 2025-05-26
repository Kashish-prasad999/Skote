@extends('layouts.user')
@section('title')
Order
@endsection
@section('css')
<style>
    .gif{
        padding-left: 25rem;
    }
    .gifs{  
        margin-left: 30rem;
        height: 45rem;
    }
    .bg {
        margin: 8rem;
    }
    .btn1{
        margin-left: 36rem;
    }
    .btn2{
        margin-left: 53rem;
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">

            </div>
        </div>

        @if (Session::has('order'))
        <div class="row ">
            <div class="col-lg-12" >
                <div class="card " >
                    <div class="card-body bg">
                        <img src="{{asset('storage/uploads/images/confirm.gif')}}" class=" gif" alt="">
                        <h4 class="text-center ">Order Confirmed!!</h4>
                        <h4 class="text-center ">Thank You for ordering...</h4>
                        <h4 class="text-center ">Order Id: {{Session::get('order')}} </h4>
                        <a href="{{route('index')}}" class="btn btn-success btn1">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row ">
            <div class="col-lg-12" >
                <div class="card " >
                    <div class="card-body">
                        <img src="{{asset('storage/uploads/images/bad-sign.gif')}}" class="gifs" alt="">
                        <h4 class="text-center ">Opps!!!! Your Payment is not Successfull.</h4>
                        <h4 class="text-center ">Order Failed.....</h4>

                        <a href="{{route('index')}}" class="btn btn-success btn2">Try again</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('script')
@endsection
