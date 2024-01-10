@extends('admin.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <a href="{{ route('redirect.create') }}" class="btn btn-outline-secondary"><i
                            class="fas fa-plus nav-icon"></i> Thêm Link</a>
                </div>
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%"><input class="check-all" type="checkbox">
                                    </th>
                                    <th class="text-center">OLD URL</th>
                                    <th class="text-center">NEW URL</th>
                                    <th class="text-center">TYPE</th>
                                    <th class="text-center">Ngày đăng</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center" style="width: 15%">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($links as $link)
                                    <tr class="align-self-center">
                                        <td class="text-center">
                                            <input type="checkbox" name="select[]" value="{{ $link->id }}"/>
                                        </td>
                                        <td class="text-center">{{ $link->old_url }}</td>
                                        <td class="text-center">{{ $link->new_url }}</td>
                                        <td class="text-center">{{ $link->type }}</td>
                                        <td class="text-center">{{ $link->created_at }}</td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled
                                                   name="is_active" @checked(old('is_active',1) == $link->is_active)>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-warning btn-sm"
                                               href="{{ route('redirect.edit',['id' => $link->id]) }}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Chỉnh sữa danh mục">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <form method="post" class="d-inline"
                                                  action="{{ route('redirect.destroy',['id' => $link->id]) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Xoá danh mục" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card -->
                        <div class="card-footer clearfix">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select name="" class="filter-change__product form-control" data-table="10">
                                        <option value="0">Chọn thao tác</option>
                                        <option value="1">De-active</option>
                                        <option value="2">Active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                </div>
                                <a data-type="1" class="btn col-sm-1 btn-outline-info btn-action__product disabled">Xử
                                    lý</a>
                                <div class="col-sm-5">
                                    {{ $links->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
