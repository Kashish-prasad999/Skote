@extends('layouts.admin')
@section('title')
Create Discount
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
                                <li class="breadcrumb-item active">Create Discount</li>
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
                                        <a href="{{url('admin/discount')}}"><button class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-keyboard-backspace"> </i>Back</button></a>
                                    </div>
                                </div><!-- end col-->
                            </div>
                            <form action="{{url('admin/discount/create')}}" method="POST">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label for="percentage" class="col-form-label col-lg-2">Discount Percentage</label>
                                    <div class="col-lg-10">
                                        <input id="name" name="percentage" type="text" class="form-control" placeholder="Enter Discount Percentage">
                                        @error('discount')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary">Add Discount</button>
                                    </div>
                                </div>
                            </form>
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
@endsection