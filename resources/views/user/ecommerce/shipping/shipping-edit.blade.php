@extends('layouts.user')
@section('title')
Shipping Details - edit
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

                                                <form action="{{route('shipping.edit',$shipping->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group row mb-4">
                                                        <label for="address" class="col-md-2 col-form-label">Address</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="address" id="address" rows="3" placeholder="{{$shipping->address}}">{{$shipping->address}}</textarea>
                                                            @error('address')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label for="zipcode" class="col-md-2 col-form-label">Zipcode</label>
                                                        <div class="col-md-10">
                                                            <input type="number" class="form-control"  value="{{$shipping->zipcode}}" name="zipcode" id="zipcode" placeholder="Enter Zipcode" />
                                                            @error('zipcode')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="form-group row mb-4">
                                                        <label class="col-md-2 col-form-label">State</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2"  name="state" id="stateList" title="State" value="{{$shipping->state}}">
                                                                <option value="{{$shipping->state}}">{{$shipping->statess->name}}</option>
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('state')
                                                                <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <label class="col-md-2 col-form-label">City</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2"  name="city" id="cityList" title="City" value="{{$shipping->city}}">
                                                                <!-- <option value="{{$shipping->city}}">{{$shipping->city}}</option>   -->
                                                                @foreach($cities as $city)
                                                                <!-- <option value="{{$city->id}}">{{$city->name}}</option> -->
                                                                    <option value="{{$city->name}}" class="parent-{{ $city->state_id }} city" <?php $shipping->city == $city->name ? 'selected' : 'ertyuigf' ?> >{{$city->name}}</option>
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
                                        <button type="submit"  id=""class="btn btn-success"><i class="mdi mdi-update"></i> Update</button>
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
            $(".parent-" + $(this).val()).attr('disabled', false); //enable city of selected category/parent
            $(".parent-" + $(this).val()).show();
        });
    });

    $(document).ready(function () {
        // $('#stateList').on('change', function () {
            $("#cityList").attr('disabled', false); //enable city select
            $("#cityList").val("");
            $(".city").attr('disabled', true); //disable all state option
            $(".city").hide(); //hide all city option
            $(".parent-" + $('#stateList').val()).attr('disabled', false); //enable city of selected category/parent
            $(".parent-" + $('#stateList').val()).show();
        // });
    });
</script>
<!-- <div class="form-group row mb-4">
    <label class="col-md-2 col-form-label">City</label>
    {{-- jo slected h already uske hi aate h sirf cities matlab ki bihar state slected th ato uske hi cities aa rahe the sirf samjh aaya? --}}
    <div class="col-md-10">
        <select class="form-control select2" name="city" id="cityList" title="City" disabled>
            <option value="0">Select City</option>
            @foreach($cities as $city)
                <option value="{{$city->name}}" class="parent-{{ $city->state_id }} city" {{ old('city') == $city->name ? 'selected' : '' }}>{{$city->name}}</option>
            @endforeach 
        </select>
        @error('city')
            <span style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div> -->
@endsection
