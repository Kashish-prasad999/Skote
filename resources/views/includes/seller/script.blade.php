<!-- JAVASCRIPT -->
<script src="{{asset('storage/app/public/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('storage/app/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('storage/app/public/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('storage/app/public/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('storage/app/public/assets/libs/node-waves/waves.min.js')}}"></script>

<!-- apexcharts -->
<script src="{{asset('storage/app/public/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<script src="{{asset('storage/app/public/assets/js/pages/dashboard.init.js')}}"></script>

<script src="{{asset('storage/app/public/assets/js/app.js')}}"></script>

<script>
    setTimeout(function() {
        $(".alert").slideUp(300);
        // $(".alert").fadeOut('fast');
    }, 3000);
</script>

@yield('script')