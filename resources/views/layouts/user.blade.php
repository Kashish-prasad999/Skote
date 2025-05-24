<!doctype html>
<html lang="en">
@include('includes.user.head')

<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('includes.user.header')
        @include('includes.user.sidebar')
        <div class="main-content">
            @yield('content')
            @include('includes.user.footer')
        </div>
    </div>
    @include('includes.user.script')

</body>

</html>