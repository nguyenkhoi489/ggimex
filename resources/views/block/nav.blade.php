<!-- ======= Header ======= -->
<header id="header" class="fixed-top__menu d-flex align-items-center">
    <div class="container d-flex align-items-center">
        <div class="logo me-auto">
            <a href="{{ route('home') }}">
                <img src="{{ url($logo->logo) }}" alt="Logo" style="width: 200px">
            </a>
        </div>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->
        <nav id="navbar" class="navbar order-last order-lg-0 hide-for__responsive">
            <ul class="d-flex main-menu list-unstyled">
                {!! (new App\Helper\Helper())->menu($menus) !!}
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
        <div class="nav-menu__mobile">
            <a type="button" data-toggle="menuCanvas" href="javascript:void(0)">
                <i class="fa-solid fa fa-bars"></i>
            </a>
        </div>
        <div class="navbar-collapse menuCanvas-collapse">
            <div class="box-offcanvas p-4">
                <div class="btn-close__nav"><i class="far fa-window-close"></i></div>
                <ul id="menu-mobile" class="list-unstyled">
                    {!! (new App\Helper\Helper())->menu($menus) !!}
                </ul>
            </div>
            <div class="box-bg__tran"></div>
        </div>
    </div>
</header><!-- End Header -->
