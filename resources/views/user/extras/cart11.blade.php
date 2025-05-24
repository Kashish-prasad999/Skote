@include('layout.topbar')
@include('layout.header')
@include('layout.left_sidebar')
@include('layout.loader')
<div class="main-content">
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
                                <table class="table table-centered mb-0 table-nowrap">
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
                                        @php $total = 0; @endphp
                                        @if(session('cart'))
                                            @foreach(session('cart') as $id => $product)
                                                <!-- @php 
                                                    $sub_total = $product['price'] * $product['quantity'];
                                                @endphp -->
                                                <tr>
                                                    <td>
                                                    @if (isset($product['image']))
                                                        <img src="{{asset('storage/app/public/uploads/images/'.$product['image'])}}" alt="Image" class="avatar-md">
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">{{$product['name']}}</a></h5>
                                                        <p class="mb-0">Color : <span class="font-weight-medium">Maroon</span></p>
                                                    </td>
                                                    <td class="cost">
                                                        {{ $product['price'] }}
                                                    </td>
                                                    <td>
                                                        <div style="width: 100px;">
                                                                <input type="number" class="form-control quantity update-cart" min="1" value="{{$product['quantity']}}" />
                                                        </div>

                                                    </td>
                                                    <td class="total">
                                                        {{ $product['price']}} 
                                                    </td>
                                                    <td>
                                                        <a href="{{route('cart.remove',[$id])}}" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{url('ecommerce/products')}}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left mr-1"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-right mt-2 mt-sm-0">
                                        <a href="ecommerce-checkout.html" class="btn btn-success">
                                            <i class="mdi mdi-cart-arrow-right mr-1"></i> Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>
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
                                        <th>$ 1744.22</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
           
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
            <!-- end main content-->
@include('layout.right_sidebar')

@include('layout.footer')
<!-- <script>
    $(".minus , .plus , .quantity").on("click input", function() {
    var selectors = $(this).closest('tr'); //get closest tr
    var quan = selectors.find('.quantity').val(); //get qty
    if (!quan || quan < 0)
        return;
    var cost = parseFloat(selectors.find('.cost').text());
    var total = (cost * quan).toFixed(2);
    selectors.find('.total').text(total); //add total 
});
</script> -->
<script>
$(document).ready(function() {
    $(".quantity").trigger("change");


$(".minus , .plus , .quantity").on("click input", function(){
    var selectors = $(this).closest('tr'); //get closest tr
    var quan = selectors.find('.quantity').val();
    var cost = parseFloat(selectors.find('.cost').text());
    var total = (cost * quan).toFixed(2);
    selectors.find('.total').text(total);
});
});
</script>