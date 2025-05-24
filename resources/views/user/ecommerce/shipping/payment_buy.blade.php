@extends('layouts.user')
@section('title')
Payment
@endsection
@section('css')
<style>
    .paypal-buttons {
        margin-left: 25%;
        width: 50% !important;
        margin-top: 3%;
        /* #556ee6 */
    }

    /* .paypal-button-number-0{
        color: green !important ;
    }
    .paypal-button-number-1{
        color: green !important ;
    }
    .paypal-button-row{
        color: green !important ;
    }
    .paypal-button{
        color: green !important ;
    } */
</style>
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
                                        {{-- method="post" action="{{route('buy.payment.method',[$total, $productId, 0])}}" --}}
                                        <form class="orderForm">
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
                                            <div class="table-responsive">
                                                <table class="table table-nowrap mb-0 details">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">
                                                                <h4>Address</h4>
                                                            </th>
                                                            <th>
                                                                <div class="row justify-content-end ">
                                                                    <div class="col-sm-6">
                                                                        <div class="text-sm-right">
                                                                            <a href="{{url('shipping')}}" id="" class="btn btn-primary">
                                                                                <i class="bx bx-add-to-queue"></i> Add New cARD </a>
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $prevCard = '';
                                                        @endphp
                                                        @foreach($cards as $card)
                                                        @if ($card->card_number != $prevCard)
                                                        <tr>
                                                            <td>
                                                                <input type="radio" id="cards" name="card" value="{{$card->id}}" checked>
                                                                <label class="" for="cards">
                                                                    <p>Card Number:&nbsp;&nbsp;{{ $card->card_number }}&nbsp;&nbsp;<br>
                                                                        Name on Card:&nbsp;&nbsp;{{$card->name}}<br>Expiry Date: {{$card->expiry_month}} / {{$card->expiry_year}} <br> cvv <input type="password" name="cvc" id="cvc"></p>
                                                                </label>
                                                                @error('card')
                                                                <span style="color:red">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <!-- <div class="row justify-content-end ">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="text-sm-right">
                                                                                                    <br><br><br><br><br><a href="" class="btn btn-primary btn-sm-right"> <i class="mdi mdi-cash-multiple"></i>&nbsp;&nbsp;Pay Rs.&nbsp;{{$total}}</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $prevCard = $card->card_number;
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- </form> -->
                                            <!-- <h5 class="mt-5 mb-3 font-size-15">For card Payment</h5> -->
                                            <div class="p-4 border pay_card">
                                                <!-- <form action="{{route('card')}}" method="POST"> -->
                                                @csrf
                                                <div class="form-group mb-0">
                                                    <label for="cardnumberInput">Card Number</label>
                                                    <input type="text" class="form-control" id="cardnumberInput" name="card_number" value="{{old('card_number')}}" placeholder="0000 0000 0000 0000">
                                                    {{-- @error('card_number')
                                                    <span style="color:red">{{ $message }}</span>
                                                    @enderror --}}
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
                                    <!-- paypal div -->
                                    <div id="paypal-button-container"></div>
                                    <!-- end paypal div -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <a href="{{route('product.details', $productId)}}" class="btn text-muted d-none d-sm-inline-block btn-link paylink">
                                <i class="mdi mdi-arrow-left mr-1"></i> Back to Shopping</a>
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
                </div> <!-- end row -->

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

<!-- <script src="{{asset('storage/app/public/assets/js/paypal.js')}}"></script> -->
<script>
    let total = "{{$total}}";
    let product = "{{$productId}}";
    let req = null;
    let transaction = null;
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
                    digits: true
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
    //    $('#card_type').change(function(){       
    //        var cardType = $(this).val();  //get the value of selected option
    //       if (cardType == "Visa") {            
    //           $("#cvv").attr("placeholder",'CVV');                            
    //       } else{
    //            $("#cvv").attr("placeholder",'CVC2/3');                                                        
    //       };                
    // });

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

            $('.paylink').hide();
            $('.pay').show();
            // Payment(total, product, transaction);
        }
    });
    $('#netbanking').on('click', function(e) {

        if ($(this).is(':checked')) {
            // $(".sub_chk").prop('checked', true);
            $('.pay_card').hide();
            $('.details').hide();
            $('.paypal-buttons').show();
            $('.pay').hide();
            $('.paylink').hide();
        }
    });
    $('.pay').on('click', function() {
        event.preventDefault();
        var paymentMethod = $('input[name=payment]:checked').val();
        console.log(paymentMethod);
        switch (paymentMethod) {
            case 'card':
                cardPayment();
                break;
            case 'cod':
                req = 'Cod';
                Payment(total, product, req, transaction);
                break;
            default:
                alert("Please select a valid option");
        }
    })

    function Payment(total, product, req, transaction) {
        console.log('paymentgjgfkjkugkgk');
        $.ajax({
            type: "GET",
            url: "{{route('order')}}",
            data: {
                total: total,
                product: product,
                req: req,
                transaction: transaction,
                _token: "{{ csrf_token() }}",
            },
            dataType: 'html',
            success: function(response) {

                console.log(response);
                // $("#product-list").html(response);
                window.location.href = "{{route('ord')}}";

            },
        });
    }

    function cardPayment() {
        event.preventDefault();
        $.ajax({
            url: "{{route('order')}}",
            method: "GET",
            data: {
                "product": product,
                "_token": "{{ csrf_token() }}",
                "transaction": transaction,
                "total": total,
                "req": 'card',

            },
            success: function(data) {
                console.log(data);
                window.location.href = "{{route('ord')}}";
            }
        });
    }
    // $("p").click(function(){

    // var text = $('#search').val();
    // search = $(this).val();

    // $("#amount").text(usd.toFixed(2));
    // $("#currency").text("USD");

    //     $('#proceed').on('click', function() {
    //         var cardType = $('input[name=card]:checked').val(),
    //             nameOnCard = $.trim($('#nameOnCard').val()),
    //             cardNumber = $.trim($("#cardNumber").val()),
    //             expMonth = $.trim($("#expMonth").val()),
    //             expYear = $.trim($("#expYear").val()),
    //             cvv = $.trim($("#cvv").val());

    //         if (cardType == 'master') {

    //             var regexMaster = /^(?:5[1-5][0-9]{14}|677189|2221[0-9]{12}|22[3-9][0-9]{13}|2[3-6][0-9]{14}|27[01][0-9]{1
    //             var regex = new RegExp("^(?:4[0-9]{12}(?:[0-9]{3})?)$");
    //         } else if (cardType == 'visa') {
    //             var regex = new RegExp("^4[0-9]{6}? [0-9]{5}$");
    //         }

    //         if (!regex.test(cardNumber)) {
    //             alert('Please enter a valid credit/debit card number');
    //             return false;
    //         }

    //         if ((expMonth < 1 || expMonth > 12) || !$.isNumeric(expMonth)) {
    //             alert('Invalid Expiry Month');
    //             return false;
    //         }

    //         if (parseInt(expYear) < parseInt(new Date().getFullYear()) ||
    //             (parseInt(expYear) === parseInt(new Date().getFullYear()) && parseInt(expMonth) <= parseInt(new Date().getMonth()))) {
    //                 alert();
    //                 return false;
    //         }

    //         if (cvv.length != 3 && cvv.length != 4) {
    //             alert('CVV must be 3 or 4 digits');
    //             return false;
    //         }

    //         // Proceed with payment...
    //         Stripe.setPublishableKey($("#stripe_public_key").val());
    //         Stripe.createToken({
    //           "number": cardNumber,
    //           "cvc": cvv,
    //           "exp_month": expMonth,
    //           "exp_year": expYear
    //         }, stripeResponseHandler);
    //     });
    // });

    // $('.orderForm').on('submit', function(e) {
    //     e.preventDefault();
    //     var name = $('#name').val();
    //     // var message = $('#message').val();
    //     // var postid = $('#post_id').val();
    //     $.ajax({
    //         type: "POST",
    //         url: host + '/comment/add',
    //         data: {
    //             name: name,
    //             message: message,
    //             post_id: postid
    //         },
    //         success: function(msg) {
    //             alert(msg);
    //         }
    //     });
    // });


    let usd = (total / 83.21).toFixed(2);
    console.log(usd);
    console.log(product);
    // console.log(req);

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
                Transaction(total, product, req, transaction);

            });
        }
    }).render('#paypal-button-container');

    function Transaction(total, product, req, transaction) {
        event.preventDefault();
        req = "Netbanking";
        $.ajax({
            type: "GET",
            url: "{{route('order')}}",
            data: {
                total: total,
                product: product,
                req: "Netbanking",
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