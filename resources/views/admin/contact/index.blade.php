@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-1">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">
                                        <input type="checkbox" name="" id="check_all">
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Link</th>
                                    <th>Ngày đăng</th>
                                    <th style="width: 100px">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($contact->count())
                                    @foreach($contact as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{ $item->id }}" name="check_all[]"
                                                       class="check">
                                            </td>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                {{ \App\Helper\Helper::create_short($item->message,200) }}
                                            </td>
                                            <td>
                                                {{ $item->link }}
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm"
                                                   href="{{ route('contact.edit',['id' => $item->id]) }}"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-original-title="Chỉnh sữac">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <form method="post" class="d-inline"
                                                      action="{{ route('contact.destroy',['id' => $item->id]) }}">
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
                            {{ $contact->withquerystring()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
