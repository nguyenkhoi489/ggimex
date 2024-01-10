@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('prefix.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Tên gọi</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="name"
                                               value="{{ old('name') }}"
                                               class="form-control" placeholder="Việt Nam Đồng ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Prefix</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="value"
                                               value="{{ old('value') }}"
                                               class="form-control" placeholder="đ ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="is_active">
                                            <option value="1" @selected(old('is_active') == 1)>Kích hoạt</option>
                                            <option value="0" @selected(old('is_active') == 0)>Không kích hoạt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('prefix.index') }}"
                                           class="btn btn-default"
                                           data-dismiss="modal">Trở
                                            về</a>
                                        <button type="submit" class="btn btn-success">Lưu thông tin</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
