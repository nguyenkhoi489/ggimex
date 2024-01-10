<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" target="_blank" role="button">
                <i class="fas fa-user-clock"></i> Đang Online: <strong><span class="text-red">{{ $user_online }}</span></strong>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}" target="_blank" role="button">
                <i class="fas fa-globe-americas"></i> Go to Website
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cache.clear') }}" role="button">
                <i class="fas fa-broom"></i> Clear Cache
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.edit',['id' => auth()->user()->id]) }}" role="button">
                <i class="fas fa-user-tie"></i> Thông tin cá nhân
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('smtp.index') }}" role="button">
                <i class="fa fa-mail-bulk"></i> Cấu hình SMTP (Mail)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('setting.index') }}" role="button">
                <i class="fa fa-tools"></i> Cấu hình Website
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               role="button">
                <i class="fa fa-sign-out-alt"></i> Đăng xuất
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
