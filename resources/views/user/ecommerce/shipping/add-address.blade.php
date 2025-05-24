@extends('layouts.user')
@section('title')
Shipping Details
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
                        <h4 class="mb-0 font-size-18">Shipping</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Shipping</li>
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
                                        <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                            <div>
                                                <h4 class="card-title">Shipping information</h4>
                                                <p class="card-title-desc">Fill all information below</p>

                                                <form action="{{route('add.new')}}" method="POST">
                                                    @csrf
                                                    <div class="form-group row mb-4">
                                                        <label for="address" class="col-md-2 col-form-label">Address</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter full address">{{old('address')}}</textarea>
                                                            @error('address')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label for="zipcode" class="col-md-2 col-form-label">Zipcode</label>
                                                        <div class="col-md-10">
                                                            <input type="number" class="form-control" name="zipcode" id="zipcode" placeholder="Enter Zipcode" value="{{old('zipcode')}}" />
                                                            @error('zipcode')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label class="col-md-2 col-form-label">State</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2" name="state" id="stateList" title="State">
                                                                <option value="0">Select State</option>   
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}">{{$state->name}}</option>    
                                                                @endforeach                                
                                                            </select>
                                                            @error('state')
                                                                <span style="color: red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                            
                                                    <div class="form-group row mb-4">
                                                        <label class="col-md-2 col-form-label">City</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2" name="city" id="cityList" title="City" disabled>
                                                                <option value="0">Select City</option>
                                                                @foreach($cities as $city)
                                                                <!-- <option value="{{$city->id}}">{{$city->name}}</option> -->
                                                                    <option value="{{$city->name}}" class="parent-{{ $city->state_id }} city">{{$city->name}}</option>
                                                                    <!-- <option value="{{$city->id}}" class="parent-{{ $city->state_id }} city">{{$city->name}}</option> -->
                                                                    <!-- <option value="{{$city->id}}" class="parent-{{ $city->state_id }} city">{{$city->name}}</option> -->
                                                                @endforeach
                                                            </select>
                                                            @error('city')
                                                                <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-0">
                                                        <label for="example-textarea" class="col-md-2 col-form-label">Order Notes:</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="example-textarea" rows="3" placeholder="Write some note.."></textarea>
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
                                        <button type="submit"  id=""class="btn btn-success"><i class="mdi mdi-cart-arrow-right mr-1"></i>Checkout</button>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#stateList').on('change', function () {
            $("#cityList").attr('disabled', false); //enable city select
            $("#cityList").val("");
            $(".city").attr('disabled', true); //disable all state option
            $(".city").hide(); //hide all city option
            $(".parent-" + $(this).val()).attr('disabled', false); //enable city of selected state/parent
            $(".parent-" + $(this).val()).show(); 
        });
    });
</script>
<!-- <script type="text/javascript">
    $(document).ready(function () {
        $('#stateList').on('change', function () {
            $("#cityList").attr('disabled', false); //enable city select
            $("#cityList").empty(); //clear existing city options
            $(".city").attr('disabled', true); //disable all city options
            $(".city." + $(this).val()).attr('disabled', false); //enable city options of selected state
            $(".city." + $(this).val()).show(); //show city options of selected state
            $("#cityList").append('<option value="0" selected>Select City</option>'); //add a default "Select City" option
            $(".city." + $(this).val()).each(function () {
                $("#cityList").append('<option class="city" value="' + $(this).val() + '">' + $(this).text() + '</option>');
            });
        });
    }); 
</script> -->
@endsection
