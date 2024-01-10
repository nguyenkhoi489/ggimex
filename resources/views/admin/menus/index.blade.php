@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <a href="{{ route('menus.create') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-plus nav-icon"></i> Thêm Menus
                    </a>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-1">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">
                                        <input type="checkbox" name="" id="check_all">
                                    </th>
                                    <th style="width: 20%">Name</th>
                                    <th style="width: 20%">Type</th>
                                    <th>Vị trí</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th style="width: 100px">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($menus->total() > 0)
                                    {!! (new \App\Helper\Helper())->getMenus($menus) !!}
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card -->
                        <div class="card-footer clearfix">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select name="" class="filter-change__menus form-control">
                                        <option value="0">Chọn thao tác</option>
                                        <option value="1">Thay đổi vị trí</option>
                                        <option value="2">De-active Menus</option>
                                        <option value="3">Active All Menus</option>
                                    </select>
                                </div>
                                <a data-type="1" class="btn col-sm-1 btn-outline-info btn-action__change disabled">Xử lý</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
