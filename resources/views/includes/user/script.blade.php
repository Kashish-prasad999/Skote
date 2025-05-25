
    <!-- JAVASCRIPT -->
    <script src="{{asset('storage/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('storage/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('storage/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('storage/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('storage/assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{asset('storage/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <script src="{{asset('storage/assets/js/pages/dashboard.init.js')}}"></script>

    <script src="{{asset('storage/assets/js/app.js')}}"></script>

    <script>
        setTimeout(function(){
            $(".alert").slideUp(300);
            // $(".alert").fadeOut('fast');
        }, 3000 ); 
        setTimeout(function(){
            $(".error").slideUp(300);
            // $(".alert").fadeOut('fast');
        }, 3000 ); 
    </script>
    
    @yield('script')