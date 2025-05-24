@extends('layouts.admin')
@section('title')
Edit profile - user
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
                        <h4 class="mb-0 font-size-18">User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                <li class="breadcrumb-item active">Edit profile</li>
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
                                        <a href="{{url('display.user')}}"><button class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-keyboard-backspace"> </i>Back</button></a>
                                    </div>
                                </div><!-- end col-->
                            </div>
                            <form action="{{route('admin.update.profile',$user->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group row mb-4">
                                    <label for="name" class="col-form-label col-lg-2">Name</label>
                                    <div class="col-lg-10">
                                        <input name="name" type="text" class="form-control" value="{{$user->name}}" placeholder="Enter Name">
                                        @error('name')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="email" class="col-form-label col-lg-2">Email</label>
                                    <div class="col-lg-10">
                                        <input name="email" type="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email" readonly>
                                        @error('email')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="mobile" class="col-form-label col-lg-2">Mobile Number</label>
                                    <div class="col-lg-10">
                                        <input name="mobile" type="number" class="form-control" value="{{$user->mobile}}" placeholder="Enter Mobile Number">
                                        @error('mobile')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="username" class="col-form-label col-lg-2">Username</label>
                                    <div class="col-lg-10">
                                        <input name="username" type="text" class="form-control" value="{{$user->username}}" placeholder="Enter Username" readonly>
                                        @error('username')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="password" class="col-form-label col-lg-2">Password</label>
                                    <div class="col-lg-10">
                                        <input name="password" type="text" class="form-control" value="{{ $user->password}}" placeholder="Enter Password" autocomplete="new-password">
                                        @error('password')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
</div>
@endsection
@section('script')

@endsection