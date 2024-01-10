@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <a href="{{ route('prefix.create') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-plus nav-icon"></i> Thêm Prefix
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
                                    <th style="width: 20%">Tiêu đề</th>
                                    <th style="width: 20%">Prefix</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th style="width: 100px">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($prefix)
                                    @foreach($prefix as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{ $item->id }}" name="check_all[]"
                                                       class="check">
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->value}}
                                            </td>
                                            <td>
                                                {{ (new App\Helper\Helper())->post_status($item->is_active) }}
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm"
                                                   href="{{ route('prefix.edit',['id' => $item->id]) }}"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-original-title="Chỉnh sữa">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <form method="post" class="d-inline"
                                                      action="{{ route('prefix.destroy',['id' => $item->id]) }}">
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
                            {{ $prefix->withquerystring()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
