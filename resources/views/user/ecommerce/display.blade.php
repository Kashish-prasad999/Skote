@forelse( $products as $product )
<div class="col-xl-4 col-sm-6">
    <div class="card">
        <div class="card-body" style="height:46rem;">
            <a href="{{url('ecommerce/details/'.$product->id)}}">
                <div class="product-img position-relative">
                    <div class="avatar-sm product-ribbon">
                        <span class="avatar-title rounded-circle  bg-primary">
                            @php
                            $discount = number_format($product->discountss?->percentage ?? 2)
                            @endphp
                            {{$discount}}%
                        </span>
                    </div>
                    {{-- @php
                    $img=json_decode($product->image)[0];
                    @endphp --}}

                    <img src="{{asset('storage/uploads/images/'.$product->pictures[0]->image)}}" style="height:33rem;" alt="Image" class="img-fluid mx-auto d-block">

                </div>
                <div class="mt-4 text-center">
                    <h5 class="mb-3 text-truncate"><a href="#" class="text-dark">{{$product->brand}}&nbsp;{{$product->product_name}}</a></h5>

                    <p class="text-muted">
                        <i class="bx bx-star text-warning"></i>
                        <i class="bx bx-star text-warning"></i>
                        <i class="bx bx-star text-warning"></i>
                        <i class="bx bx-star text-warning"></i>
                        <i class="bx bx-star text-warning"></i>
                    </p>
                    <!-- ₹ -->
                    @php
                    $old_amount = floor(($product->price * 100) / ($discount-100))
                    @endphp
                    <h5 class="my-0"><span class="text-muted mr-2"><del>Rs.{{$old_amount}}</del></span><b>Rs. {{$product->price}}</b></h5>
            </a>
            <a href="{{url('ecommerce/cart/'.$product->id)}}">
                <button type="button" class="btn btn-primary waves-effect waves-light mt-3 mr-1">
                    <i class="bx bx-cart mr-2"></i> Add to cart
                </button>
            </a>
                </div>
        </div>
    </div>
</div>
@empty
<h4>No Products Found!</h4>
@endforelse
{{-- <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                {!! $products->links() !!}
            </div> --}}
