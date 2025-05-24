@extends('layouts.admin')
@section('title')
Create Category
@endsection
@section('css')

@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Users</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                            <li class="breadcrumb-item active">Users Grid</li>
                        </ol>
                    </div>
                    
                </div>
            </div>
        </div>     
        <!-- end page title -->

        <div class="row">
            @foreach ($users as $user)
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar-sm mx-auto mb-4">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                    @php 
                                        $first_char = substr($user->name, 0, 1);
                                    @endphp
                                    {{$first_char}}
                                </span>
                            </div>
                            <h5 class="font-size-15"><a href="#" class="text-dark"></a>{{$user->name}}</h5>
                            <p class="text-muted">{{$user->mobile}}</p>

                            <div>
                                <a href="#" class="badge badge-primary font-size-11 m-1">{{$user->username}}</a>
                                <a href="#" class="badge badge-primary font-size-11 m-1">{{$user->email}}</a>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="contact-links d-flex font-size-20">
                                <div class="flex-fill">
                                    <a href="{{route('admin.edit.profile', $user->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="bx bx-user-circle"></i></a>
                                </div>
                                <div class="flex-fill">
                                    <a href="{{route('admin.orders', $user->id)}}" data-toggle="tooltip" data-placement="top" title="Orders"><i class="bx bx-archive"></i></a>
                                </div>
                                <div class="flex-fill">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete-alert"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex pagination pagination-rounded justify-content-end mb-2">
                {!! $users->links() !!}
            </div>
        </div>
        <!-- end row -->

        <!-- <div class="row">
            <div class="col-12">
                <div class="text-center my-3">
                    <a href="javascript:void(0);" class="text-success"><i class="bx bx-hourglass bx-spin mr-2"></i> Load more </a>
                </div>
            </div>  end col
        </div> -->
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
@section('script')
@endsection