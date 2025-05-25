@extends('layouts.user')
@section('title')
Payment
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
                    <h4 class="mb-0 font-size-18">Payment</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Payment</li>
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
                                <div class="tab-pane fade show active" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                    <div>
                                        <h4 class="card-title">Payment information</h4>
                                        <p class="card-title-desc">Fill all information below</p>
                                        <form action="{{route('payment.method', [$total, 0])}}" method="POST" name="orderForm" id="card-payment-form">
                                            @csrf
                                            <div>
                                                <div class="custom-control custom-radio custom-control-inline mr-4">
                                                    <input type="radio" id="card" name="payment" class="custom-control-input" value="card">
                                                    <label class="custom-control-label" for="card"><i class="fab fa-cc-mastercard mr-1 font-size-20 align-top"></i> Credit / Debit Card</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mr-4">
                                                    <input type="radio" id="netbanking" name="payment" class="custom-control-input" value="netbanking">
                                                    <label class="custom-control-label" for="netbanking"><i class="fab fa-cc-paypal mr-1 font-size-20 align-top"></i> Paypal</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mr-4">
                                                    <input type="radio" id="cod" name="payment" class="custom-control-input" value="cod" checked>
                                                    <label class="custom-control-label" for="cod"><i class="far fa-money-bill-alt mr-1 font-size-20 align-top"></i> Cash on Delivery</label>
                                                </div>
                                                @error('payment')
                                                <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- </form> -->
                                            <!-- <h5 class="mt-5 mb-3 font-size-15">For card Payment</h5> -->
                                            <div class="p-4 border pay_card">
                                                <!-- <form action="{{route('card')}}" method="POST"> -->
                                                @csrf
                                                <div class="form-group mb-0">
                                                    <label for="cardnumberInput">Card Number</label>
                                                    <input type="text" class="form-control" id="cardnumberInput" name="card_number" value="{{old('card_number')}}" placeholder="0000 0000 0000 0000">
                                                    @error('card_number')
                                                    <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mt-4 mb-0">
                                                            <label for="cardnameInput">Name on card</label>
                                                            <input type="text" class="form-control" id="cardnameInput" name="name" value="{{old('name')}}" placeholder="Name on Card">
                                                            @error('name')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- $date=date_create("2013-03-15") -->
                                                    <!-- <div class="col-lg-6">
                                                            <div class="form-group mt-4 mb-0">
                                                                <label for="cardnameInput">Expiry Date</label>
                                                                <a href="#" id="inline-dob" data-type="combodate" data-value="2015-09-24" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth" class="editable editable-click editable-open">24/09/2015</a>
                                                                @error('name')
                                                                    <span style="color:red">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> -->

                                                    <div class="col-lg-3">
                                                        <div class="form-group mt-4 mb-0">
                                                            <label for="month">Expiry Month</label>
                                                            <select class="custom-select" name="expiry_month">
                                                                <option value="" selected>--- Select Month ---</option>
                                                                @for ($x = 1; $x <= 12; $x++) <option value="{{$x}}">{{$x}}</option>
                                                                    @endfor
                                                            </select>
                                                            @error('expiry_month')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group mt-4 mb-0">
                                                            <label for="year">Expiry Year</label>
                                                            <select class="custom-select" name="expiry_year">
                                                                <option value="" selected>--- Select Year ---</option>
                                                                @for ($x = 2025; $x <= 2040; $x++) <option value="{{$x}}">{{$x}}</option>
                                                                    @endfor
                                                            </select>
                                                            @error('expiry_year')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group mt-4 mb-0">
                                                            <label for="cvvcodeInput">CVV Code</label>
                                                            <input type="password" class="form-control" id="cvvcodeInput" name="cvv" placeholder="Enter CVV Code">
                                                            @error('cvv')
                                                            <span style="color:red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group mt-4 mb-0">
                                                        <div class="custom-control custom-checkbox mb-2">
                                                            <input type="checkbox" id="save" name="saved" value="save" checked>
                                                            <label for="saved">Remember card details</label>
                                                        </div>
                                                    </div>
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
                                <!-- <a href="" id=""class="btn btn-success">
                                            <i class="mdi mdi-cash-multiple"></i>&nbsp;&nbsp;Pay Rs.&nbsp;{{$total}}</a> -->
                                <button type="submit" class="btn btn-success pay"><i class="mdi mdi-cash-multiple"></i>&nbsp;&nbsp;Pay Rs.&nbsp;{{$total}}</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AZdXuUZJVs-doHIrSaCCnq0gBpeA4skuGsBFR_CPcOw8ownmuv08z-vRWnUQ5J42eoHs8-jBp6hd4EFo"></script>

<!-- <script src="{{asset('storage/assets/js/paypal.js')}}"></script> -->
<script>
    $(document).ready(function() {
        $('.pay_card').hide();
        $('.details').hide();
        $('.paypal-buttons').hide();
        $('.pay_123').hide();
        $('.paylink').hide();

        $('.orderForm').validate({ // initialize the plugin
            rules: {
                card_number: {
                    required: true,
                    // email: true
                    maxlength: 16,
                    digits:true
                },
                name: {
                    required: true,
                },
                expiry_month: {
                    required: true
                },
                expiry_year: {
                    required: true,
                },
                cvv: {
                    required: true,
                    maxlength: 16
                }
            }
        });
    });

    $('#card').on('click', function(e) {

        if ($(this).is(':checked')) {
            // $(".sub_chk").prop('checked', true);
            $('.pay_card').show();
            $('.pay').show();
            $('.details').show();
            $('.paypal-buttons').hide();
        }
    });
    $('#cod').on('click', function(e) {

        if ($(this).is(':checked')) {
            // $(".sub_chk").prop('checked', true);
            $('.pay_card').hide();
            $('.details').hide();
            $('.paypal-buttons').hide();
            $('.pay_123').hide();
            $('.paylink').hide();
            $('.pay').show();
        }
    });
    $('#netbanking').on('click', function(e) {

        if ($(this).is(':checked')) {
            // $(".sub_chk").prop('checked', true);
            $('.pay_card').hide();
            $('.details').hide();
            $('.paypal-buttons').show();
            $('.pay_123').show();
            $('.pay').hide();
            $('.paylink').hide();
        }
    });

    var total = "{{$total}}";

    var req = "Netbanking";
    var transaction = null;
    var usd = (total / 83.21).toFixed(2);
    console.log(usd);
    console.log(product);
    console.log(req);

    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: usd
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Payment completed. ' + details.payer.name.given_name + ', your transaction id is: ' + details.id);

                transaction = details.id;
                Transaction(total, req, transaction);

            });
        }
    }).render('#paypal-button-container');

    function Transaction(total, req, transaction) {
        $.ajax({
            type: "GET",
            url: "{{ route('cart.payment', $total) }}",
            data: {
                total: total,
                product: product,
                req: req,
                transaction: transaction,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // $("#product-list").html(response);
                window.location.href = "{{route('ord')}}";

            },
        });
    }
</script>
@endsection
