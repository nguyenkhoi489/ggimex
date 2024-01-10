@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <a href="{{ route('script.create') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-plus nav-icon"></i> Thêm Script
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
                                    <th style="">Tiêu đề</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th style="width: 100px">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($scripts)
                                    @foreach($scripts as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{ $item->id }}" name="check_all[]"
                                                       class="check">
                                            </td>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                {{ (new App\Helper\Helper())->post_status($item->is_active) }}
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm"
                                                   href="{{ route('script.edit',['id' => $item->id]) }}"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-original-title="Chỉnh sữac">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <form method="post" class="d-inline"
                                                      action="{{ route('script.destroy',['id' => $item->id]) }}">
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
                        <!-- /.card -->
                        <div class="card-footer clearfix">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select name="" class="filter-change__product form-control" data-table="7">
                                        <option value="0">Chọn thao tác</option>
                                        <option value="1">De-active</option>
                                        <option value="2">Active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                </div>
                                <a data-type="1" class="btn col-sm-1 btn-outline-info btn-action__product disabled">Xử
                                    lý</a>
                                <div class="col-sm-5">
                                    {{ $scripts->withquerystring()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
