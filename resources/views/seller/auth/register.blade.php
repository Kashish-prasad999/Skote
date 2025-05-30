<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Register | Seller</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('storage/assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('storage/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('storage/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('storage/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <!-- <div class="home-btn d-none d-sm-block">
            <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> -->
        <div class="account-pages my-4 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Free Register</h5>
                                            <p>Get your free Skote account now.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{asset('storage/assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset('storage/assets/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" action="{{route('seller.register')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name">
                                            @error('name')
                                                <span style="color:red">{{ $message }}</span>
                                           @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"  placeholder="Enter email"> 
                                            @error('email')
                                                <span style="color:red">{{ $message }}</span>
                                           @enderror       
                                        </div>
                
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="number" class="form-control" name="mobile" id="mobile"  placeholder="Enter mobile number">  
                                            @error('mobile')
                                                <span style="color:red">{{ $message }}</span>
                                           @enderror     
                                        </div>
                
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username"  placeholder="Enter username">
                                            @error('username')
                                                <span style="color:red">{{ $message }}</span>
                                           @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">    
                                            @error('password')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror    
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">    
                                            @error('confirm password')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>                    
                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" name="register" type="submit">Register</button>
                                        </div>  
                
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">By registering you agree to the Skote <a href="#" class="text-primary">Terms of Use</a></p>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>Already have an account ? <a href="{{route('seller.login')}}" class="font-weight-medium text-primary"> Login</a> </p>
                            <p>© 2020 Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
