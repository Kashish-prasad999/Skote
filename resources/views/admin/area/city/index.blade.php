@extends('layouts.admin')
@section('title')
Display City
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
                        <h4 class="mb-0 font-size-18">City</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">City</a></li>
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
        
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cities as $city)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input " id="customCheck1 {{$city->id}}">
                                                    <label class="custom-control-label " for="customCheck1 {{$city->id}}">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>{{$city->id}}</td>
                                            <td>{{$city->name}}</td> 
                                            
                                                @if($city->state_id!='') 
                                                                                    
                                                    <td>{{$city->state->name}}</td>    
                                                @else
                                                    <td>---</td>
                                                @endif
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu">
                                                        <li><a href="{{url('admin/city/'.$city->id.'/edit')}}" class="dropdown-item"><i class="fas fa-pencil-alt text-success mr-1"></i> Edit</a></li>
                                                        <li><a href="{{url('admin/city/'.$city->id.'/delete')}}" class="dropdown-item"><i class="fas fa-trash-alt text-danger mr-1"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                                {!! $cities->links() !!}
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