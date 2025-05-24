@extends('layouts.seller')
@section('title')
Display Product
@endsection
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <h4 class="mb-0 font-size-18">Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                            <li class="breadcrumb-item active">Display</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">

                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <a href="{{url('seller/add')}}"><button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i>Add Product</button></a>
                                </div>
                            </div><!-- end col-->
                        </div>


                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap">
                                <thead>
                                    <tr>
                                        <th width="50px"><input type="checkbox" class="custom-control select_all" id="master"></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>

                                        <th width="80px">No</th>
                                        <th>Product Name</th>
                                        <th>Product Details</th>
                                        <th width="100px">Action</th>
                                    </tr> -->
                                    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('myproductsDeleteAll') }}">Delete All Selected</button>

                                    @foreach ($product as $item)

                                    <tr id="tr_{{$item->id}}">
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input sub_chk" id="customCheck {{$item->id}}" data-id="{{$item->id}}">
                                                <label class="custom-control-label" for="customCheck {{$item->id}}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->brand}}</td>
                                        <td> ₹{{$item->price}}</td>
                                        <td> {{$item->quantity}}</td>
                                        @if(is_null($item->discount))
                                        <td>No Discount</td>
                                        @else
                                        <td> {{$item->discount}}%</td>
                                        @endif
                                        @if (is_null($item->category))
                                        <td> --- </td>
                                        @else
                                        <td> {{$item->category->name}}</td>
                                        @endif
                                        @if(is_null($item->subcategory))
                                        <td> --- </td>
                                        @else
                                        <td> {{$item->subcategory->name}}</td>
                                        @endif
                                        <td>

                                            {{-- @php
                                            $img=json_decode($item->image);
                                            @endphp --}}
                                            @foreach($item->pictures as $picture)
                                            <img src="{{asset('storage/app/public/uploads/images/'.$picture->image)}}" width="100px" height="100px" alt="Image">
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="{{url('seller/edit/'.$item->id)}}" class="dropdown-item"><i class="fas fa-pencil-alt text-success mr-1"></i> Edit</a></li>
                                                    <li><a href="{{url('seller/delete/'.$item->id)}}" class="dropdown-item"><i class="fas fa-trash-alt text-danger mr-1"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                            {!! $product->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection
@section('script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
<script>
    $(".delete_all").hide();

    $(document).ready(function() {
        if ($('.sub_chk').length === 0) {
            $('.select_all').prop('disabled', true);
        }

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {



        // $(".select_all").on("click", function() {
        //     if ($(this).prop("checked")) {
        //         $("[name='ids[]']").each(function() {
        //             $(this).parent().parent().addClass("selected");
        //             // console.log($(this));
        //             $(this).prop("checked", true);
        //         });
        //         $(".delete_all").show();

        //     } else {
        //         $("[name='ids[]']:not(:checked)").each(function() {
        //             $(this).parent().parent().removeClass("selected");
        //         })
        //         var checked = 0;
        //         $("[name='ids[]']").each(function() {
        //             if ($(this).is(":checked")) {
        //                 checked++;
        //             }
        //         });
        //         if (checked == 0) {
        //             $(".delete_all").fadeOut();
        //         }
        //     }

        //     show_notification('.count', $('.selected').length, "html");
        // });

        // $(".sub_chk").on("click", function() {
        //     if ($(this).prop("checked")) {
        //         $("[name='ids[]']").each(function() {
        //             $(this).parent().parent().addClass("selected");
        //             // console.log($(this));
        //             $(this).prop("checked", true);
        //         });
        //         $(".delete_all").show();

        //     } else {
        //         $("[name='ids[]']:not(:checked)").each(function() {
        //             $(this).parent().parent().removeClass("selected");
        //         })
        //         var checked = 0;
        //         $("[name='ids[]']").each(function() {
        //             if ($(this).is(":checked")) {
        //                 checked++;
        //             }
        //         });
        //         if (checked == 0) {
        //             $(".delete_all").fadeOut();
        //         }
        //     }

        //     show_notification('.count', $('.selected').length, "html");
        // });

        $('.select_all').on('click', function(e) {
            //...

            if ($(this).is(':checked')) {
                $(".sub_chk").prop('checked', true);
                $('.delete_all').show();
            } else {
                $(".sub_chk").prop('checked', false);
                $('.delete_all').hide();
            }
        });
        $('.sub_chk').on('click', function(e) {
            //...

            // if ($(this).is(':checked')) {
            //     $(".sub_chk").prop('checked', true);
            $('.delete_all').show();
            // } else {
            // $(".sub_chk").prop('checked', false);
            // $('.delete_all').hide();
            // }
        });

        var cb = $(".sub_chk:checked").length;
        if (cb == 0)
        {
            $(".delete_all").fadeOut();
        };

        // $("#btnDelete").click(function() {
        //     $('#frmDel').submit();
        // });

        $('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        // if( $(".all").prop('checked', false)){
        //     $(".delete_all").prop('checked', false);

        // }
        // else{
        //     $(".delete_all").prop('disabled', false);
        // }

        $('.delete_all').on('click', function(e) {


            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });


            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {


                var check = confirm("Are you sure you want to delete this row?");
                if (check == true) {


                    var join_selected_values = allVals.join(",");
                    console.log(join_selected_values); // It will log - 2,3,5 and 7
                    var id = 'ids=0,' + join_selected_values;
                    console.log(id);
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'p1': id
                        },
                        success: function(data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                if ($('.sub_chk').length === 0) {
                                    $('.select_all').prop('checked', false);
                                    $('.select_all').prop('disabled', true);
                                    $('.delete_all').hide();
                                }
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                            console.log(data);
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });


                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function(event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function(e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>

@endsection
