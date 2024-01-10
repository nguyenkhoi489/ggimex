@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <a href="{{ route('posts.create') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-plus nav-icon"></i> Thêm bài viết mới
                    </a>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-1">
                        <div class="card-header">
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <form action="{{ route('posts.index') }}" type="get">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <select class="custom-select" name="category">
                                                    <option value="0" selected="">Tất cả danh mục</option>
                                                    @if($category->count())
                                                        @foreach($category as $item)
                                                            <option value="{{$item->id}}" @selected(request()->get('category') == $item->id)>{{$item->title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="custom-select" name="is_active">
                                                    <option value="all" @selected(request()->get('is_active') === "all")>Tất cả trạng thái</option>
                                                    <option value="1" @selected(request()->get('is_active') === "1")>Active</option>
                                                    <option value="0" @selected(request()->get('is_active') === "0")>De-Active</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="title" class="form-control" value="{{ request()->get('title') }}"
                                                       placeholder="Tiêu đề bài viết ...">
                                            </div>
                                            <div class="col-sm-2 mt-3">
                                                <button type="submit" class="btn btn-secondary">Tìm kiếm
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">
                                        <input type="checkbox" name="" id="check_all">
                                    </th>
                                    <th style="width: 20%">Tiêu đề</th>
                                    <th style="width: 20%">Đường dẫn</th>
                                    <th>Danh mục</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th style="width: 100px">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($posts->total() > 0)
                                    @foreach($posts as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{ $item->id }}" name="check_all[]"
                                                       class="check">
                                            </td>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                {{ $item->slug }}
                                            </td>
                                            <td>
                                                {{ $item->categories_name }}
                                            </td>
                                            <td>
                                                {{ (new App\Helper\Helper())->post_status($item->is_active) }}
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm"
                                                   href="{{ route('posts.edit',['id' => $item->id]) }}"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-original-title="Chỉnh sữac">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <form method="post" class="d-inline"
                                                      action="{{ route('posts.destroy',['id' => $item->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                             title=""
                                                            class="btn btn-sm btn-danger"
                                                            data-original-title="Xoá">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select name="" class="filter-change__product form-control" data-table="2">
                                        <option value="0">Chọn thao tác</option>
                                        <option value="1">De-active</option>
                                        <option value="2">Active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                </div>
                                <a data-type="1" class="btn col-sm-1 btn-outline-info btn-action__product disabled">Xử
                                    lý</a>
                                <div class="col-sm-5">
                                    {{ $posts->withquerystring()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
