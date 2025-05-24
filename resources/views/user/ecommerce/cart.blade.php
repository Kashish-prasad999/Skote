@extends('layouts.user')
@section('title')
Cart
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
                        <h4 class="mb-0 font-size-18">Cart</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="cart" class="table table-centered mb-0 table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Product Desc</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total=0 @endphp
                                        @guest
                                            @if(session('cart'))
                                                @foreach(session('cart') as $id => $details)
                                                    @php
                                                            $total += $details['price'] * $details['quantity'] ;
                                                            $subtotal = $details['price'] * $details['quantity'] ;
                                                    @endphp
                                                    <tr rowId="{{ $id }}" class="row-{{$id}}">
                                                        <td data-th="Product">
                                                            {{-- @foreach($details['image'] as $picture) --}}
                                                            <a href="{{route('product.details',[$id])}}"><img src="{{asset('storage/app/public/uploads/images/'.$details['image'])}}" alt="Image" class="avatar-md"></a>
                                                            {{-- @endforeach --}}

                                                        </td>
                                                        <td>
                                                            <h5 class="font-size-14 text-truncate"><a href="{{route('product.details',[$id])}}" class="text-dark">{{$details['brand']}}{{$details['name']}}</a></h5>
                                                            <p class="mb-0">Color : <span class="font-weight-medium">Maroon</span></p>
                                                        </td>
                                                        <td class="cost">
                                                            {{$details['price']}}
                                                        </td>
                                                        <td>
                                                            <div style="width: 120px;">
                                                                <input type="number" name="quantity" value="{{$details['quantity']}}" class="form-control quantity update-cart" min="1">
                                                            </div>
                                                        </td>
                                                        <td class="subtotal">
                                                            ₹{{ $subtotal}}
                                                        </td>
                                                        <td class="actions">

                                                            <a href="" class="action-icon text-danger remove-from-cart" data-id="{{ $id }}"> <i class="mdi mdi-trash-can font-size-18"></i></a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endguest

                                        @auth
                                            @foreach($carts as $cart)
                                            
                                                @php
                                                    $total += $cart->product->price * $cart->quantity ;
                                                    $subtotal = $cart->product->price * $cart->quantity ;
                                                @endphp
                                                <tr >
                                                    <td data-th="cart">
                                                        {{-- @php
                                                            $img=json_decode($cart->product->image)[0];
                                                        @endphp    --}}
                                        
                                                        <a href="{{url('ecommerce/details/'.$cart->product_id)}}"><img src="{{asset('storage/app/public/uploads/images/'.$cart->product->pictures[0]->image)}}" alt="Image" class="avatar-md"></a>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 text-truncate"><a href="{{url('ecommerce/details/'.$cart->product_id)}}" class="text-dark">{{$cart->product->brand}}&nbsp;{{$cart->product->product_name}}</a></h5>
                                                        <p class="mb-0">Color : <span class="font-weight-medium">Maroon</span></p>
                                                    </td>
                                                    <td class="cost">
                                                        {{$cart->product->price}}
                                                    </td>
                                                    <td>
                                                        <div style="width: 120px;">
                                                        <form action="{{ route('cart.update', ['id' => $cart->product_id]) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            @if ($cart->product->quantity == 0 )
                                                            <div class="alert alert-dismissible fade show center" role="alert">
                                                                <p></p>
                                                            </div>    
                                                            <label >Out of Stock</label>
                                                                <input type="number" class="form-control" name="quantity" value="0" disabled>
                                                            @elseif($cart->product->quantity < $cart->quantity)
                                                                <div class="alert alert-dismissible fade show center" role="alert">
                                                                    <p>Only {{ $cart->product->quantity }} product left in stock.</p>
                                                                </div>
                                                                    <!-- <input type="number" class="form-control" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{$cart->product->quantity}}" required> -->
                                                                    <!-- <input type="number" class="form-control" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{ min($cart->quantity, $cart->product->quantity) }}" required> -->
                                                                    <input type="number" class="form-control" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->quantity }}" required>
                                                            @else
                                                                <input type="number" class="form-control" name="quantity" value="{{ $cart->quantity }}" min="1" required>
                                                            @endif 
                                                                
                                                           
                                                            <!-- <button type="submit">Update</button> -->
                                                        </form>
                                                      
                                                            <!-- <input type="number" href="{{url('/cart/'.$cart->product->id.'/update')}}" name="quantity" value="{{$cart->quantity}}" class="form-control quantity" min="1">  $subtotal = $cart->product->price * $cart->quantity ; -->
                                                        </div>
                                                    </td>
                                                    {{-- @if($cart->product->quantity == 0 )
                                                        $subtotal= 0;
                                                    @else
                                                        $subtotal = $cart->product->price * $cart->quantity ;
                                                    @endif --}}
                                                    <td class="subtotal">
                                                            ₹{{ $subtotal}}
                                                    </td>
                                                    <td class="actions">
                                                        <form action="{{ route('cart.destroy', ['id' => $cart->product_id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('cart.destroy', ['id' => $cart->product_id]) }}" class="action-icon text-danger" > <i class="mdi mdi-trash-can font-size-18"></i></a>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                @if($count == 0)
                                    <div class="justify-center" style="padding-left: 30rem;">
                                        <strong><br><br>{{$msgs}}</strong>
                                    </div>
                                    <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{route('index')}}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left mr-1"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                                @else
                                </div>
                            </div>
                        </div>

                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <a href="{{route('index')}}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left mr-1"></i> Continue Shopping </a>
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-sm-right mt-2 mt-sm-0">
                                            <a href="{{url('ecommerce/shipping/')}}" class="btn btn-success">
                                                <i class="mdi mdi-truck-fast mr-1"></i> Proceed to Shipping </a>
                                        </div>
                                    </div> <!-- end col -->
                                    
                                </div>
                            </div>
                            <div class="col-xl-4">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Order Summary</h4>

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Grand Total :</td>
                                                        <td>$ 1,857</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount : </td>
                                                        <td>- $ 157</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>
                                                        <td>$ 25</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax : </td>
                                                        <td>$ 19.22</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total :</th>
                                                        <th>₹{{ $total }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end row -->
                            @endif
                            @endauth
                            @guest
                                    </tbody>
                                </table>
                      
                                @if($cart == null)
                                <div class="justify-center" style="padding-left: 30rem;">
                                        <strong><br><br>{{$msg}}</strong>
                                    </div>
                                    </div>
                            </div>
                        </div>
                                    <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{route('index')}}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left mr-1"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                                @else
                                </div>
                            </div>
                        </div>

                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <a href="{{route('index')}}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left mr-1"></i> Continue Shopping </a>
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-sm-right mt-2 mt-sm-0">
                                            <a href="{{url('ecommerce/shipping/')}}" class="btn btn-success">
                                                <i class="mdi mdi-truck-fast mr-1"></i> Proceed to Shipping </a>
                                        </div>
                                    </div> <!-- end col -->
                                    
                                </div>
                            </div>
                            <div class="col-xl-4">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Order Summary</h4>

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Grand Total :</td>
                                                        <td>$ 1,857</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount : </td>
                                                        <td>- $ 157</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>
                                                        <td>$ 25</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax : </td>
                                                        <td>$ 19.22</td>
                                                    </tr>
                                                    <tr>
                                                        <th >Total :</th>
                                                        <th class="total">₹{{ $total }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end row -->
                            @endif
                            @endguest
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
<script>
    $(document).ready(function(){
        var selectors = $(this).closest('tr'); //get closest tr
        var quan = selectors.find('.quantity').val();
        var cost = parseFloat(selectors.find('.cost').text());
        var subtotal = (cost * quan).toFixed(2);
        var sub = selectors.find('.subtotal').text(subtotal);
        // var total =  $('.total').text();
        // var newTotal = ((parseFloat(total) - cost) + subtotal).toFixed(2);
        // $('.total').text(newTotal);
        var total = tot + (cost * quan).toFixed(2);
        var tot = selectors.find( '.total' ).text(total);

         // Add to cart button click event
        // $('.addToCartBtn').on('click', function () {
        //      var id = $(this).data("id");
        //      if (id) {
        //          $.ajax({
        //              url: "http://localhost/ecommerce_project/public/cart/"+id,
        //              type: "POST",
        //              data:{ "_token": $("meta[name=csrf-token]").attr("content") },
        //              success: function(response){
        //                   $("#countCart").html(response);
        //                   alertify.success("Item added to Cart Successfully!");
        //              }
        //          });
        //      } else {
        //           alertify.error("Please Select a Product!");
        //      }
        // });

        // $('#removeFromWishlistBtn').on('click', function() {
        //    var id = $(this).data("id");
        //    $.ajax({
        //        url: 'http://localhost/ecommerce_project/public/wishlist/'+id,
        //        method: 'DELETE',
        //        data:{ "_token":$("meta[name='csrf-token']").attr('content')},
        //        success: function() {
        //            $("#wishlist-product-"+id).hide();
        //            alertify.warning("Removed from WishList!");
        //        }
        //    })
        // });
    });

    $(".quantity").trigger("change");

    $(".minus , .plus , .quantity").on("click input", function() {
        var selectors = $(this).closest('tr'); //get closest tr
        var quan = selectors.find('.quantity').val();
        var cost = parseFloat(selectors.find('.cost').text());
        var subtotal = (cost * quan).toFixed(2);
        var sub = selectors.find('.subtotal').text(subtotal);
        
        // var total =  $('.total').text();
        // var newTotal = ((parseFloat(total) - cost) + subtotal).toFixed(2);
        // $('.total').text(newTotal);
        var total = tot + (cost * quan).toFixed(2);
        var tot = selectors.find( '.total' ).text(total);
        console.log(total);
        // var total = (0 + $('.subtotal'));
        // $('#totalamount').html(total.toFixed(2));
    });

    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        console.log(id);

        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: "{{ route('remove.from.cart') }}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    if (response.responseCode == 1) {
                        alert(response.responseData)
                        $(`.row-${id}`).remove();

                        console.log(total);
                        // $('.total').append(tot);
                    } else {            
                        alert('Error! Please try again later.')
                    }
       
                
                    // e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
                }
                
            });
            
        }


    });
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: "{{ route('update.cart') }}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("rowId"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

</script>
@endsection
