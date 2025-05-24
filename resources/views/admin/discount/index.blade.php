@extends('layouts.admin')
@section('title')
Display Discount
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
                        <h4 class="mb-0 font-size-18">Discount</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Discount</a></li>
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
                                        <a href="{{url('admin/discount/create')}}"><button class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"> </i>Add Discount</button></a>
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id</th>
                                            <th>Percentage</th>
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($discounts as $discount)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input " id="customCheck1 {{$discount->id}}" >
                                                    <label class="custom-control-label " for="customCheck1 {{$discount->id}} ">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>{{$discount->id}}</td>
                                            <td>{{$discount->percentage}}%</td>
                                            <td><a href="{{url('admin/discount/create/'.$discount->id)}}" class="dropdown-item"><i class="mdi mdi-plus mr-1"></i> Add Discount</a></td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu">
                                                        <li><a href="{{url('admin/discount/'.$discount->id.'/edit')}}" class="dropdown-item"><i class="fas fa-pencil-alt text-success mr-1"></i> Edit</a></li>
                                                        <li><a href="{{url('admin/discount/'.$discount->id.'/delete')}}" class="dropdown-item"><i class="fas fa-trash-alt text-danger mr-1"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                                {!! $discounts->links() !!}
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
@endsection