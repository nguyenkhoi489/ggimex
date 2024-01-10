<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand-link" style="text-align: center;">
            <a href="{{ route('dashboard') }}">
                <img style="max-height: 80px" class="w-4" src="{{ url($logo->logo) }}">
            </a>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>
                            Quản trị viên
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link ">
                                <i class="fas fa-users-cog nav-icon"></i>
                                <p>Danh sách quản trị viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.create') }}" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Thêm quản trị viên</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <p>
                            Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link ">
                                <i class="fas fa-blog nav-icon"></i>
                                <p>Tất cả sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Thêm sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.categories.index') }}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Danh mục sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prefix.index') }}" class="nav-link">
                                <i class="fas fa-dollar-sign nav-icon"></i>
                                <p>Đơn vị tiền tệ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Bài viết
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link ">
                                <i class="fas fa-blog nav-icon"></i>
                                <p>Tất cả bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.create') }}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Thêm bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.index') }}" class="nav-link">
                        <i class="fas fa-file-alt nav-icon"></i>
                        <p>
                            Pages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('menus.index') }}" class="nav-link">
                        <i class="fas fa-tasks nav-icon"></i>
                        <p>
                            Menus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('media.index') }}" class="nav-link">
                        <i class="fas fa-photo-video nav-icon"></i>
                        <p>
                            Media
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('chatwidget.index') }}" class="nav-link">
                        <i class="fas fa-comments nav-icon"></i>
                        <p>
                            ChatWidget
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('comment.index') }}" class="nav-link">
                        <i class="far fa-comment-alt nav-icon"></i>
                        <p>
                            Đánh giá/Bình luận
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('script.index') }}" class="nav-link">
                        <i class="fas fa-code nav-icon"></i>
                        <p>
                            Header - Footer Code
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('slider.index') }}" class="nav-link">
                        <i class="fas fa-sliders-h nav-icon"></i>
                        <p>
                            Slider
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('social.index') }}" class="nav-link">
                        <i class="fas fa-share-alt nav-icon"></i>
                        <p>
                            Social
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.index') }}" class="nav-link">
                        <i class="fas fa-id-card nav-icon"></i>
                        <p>
                            Dữ liệu form
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('redirect.index') }}" class="nav-link">
                        <i class="fas fa-atlas nav-icon"></i>
                        <p>
                            Điều hướng Link
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
