<!doctype html>
<html lang="en">
@include('includes.seller.head')

<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('includes.seller.header')
        @include('includes.seller.sidebar')
        <div class="main-content">
            @yield('content')
            @include('includes.seller.footer')
        </div>
    </div>
    @include('includes.seller.script')

</body>

</html>