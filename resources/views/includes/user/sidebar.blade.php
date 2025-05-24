<!-- ========== Left Sidebar Start ========== -->
@auth
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="dripicons-tags"></i>
                        <span>Products</span>
                    </a>
                    <a href="{{route('order.list')}}" class="waves-effect">
                        <i class="mdi mdi-cart-arrow-right"></i>
                        <span>Orders</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
@endauth
<!-- Left Sidebar End -->