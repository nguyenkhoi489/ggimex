@extends('admin.main')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('admin.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Fullname (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="fullname"
                                               value="{{ old('fullname') }}"
                                               class="form-control" placeholder="Nguyen Van A ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Username (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="username"
                                               value="{{ old('username') }}"
                                               class="form-control" placeholder="user ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Mật khẩu (*)</label>
                                    <div class="col-sm-8">
                                        <input type="password"
                                               name="password" value="{{ old('password')  }}"
                                               class="form-control" placeholder="*********">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label"> Email (*)</label>
                                    <div class="col-sm-8">
                                        <input type="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               class="form-control" placeholder="abc@gmail.com ...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="is_active">
                                            <option value="1" @selected(old('active') == 1)>Kích Hoạt</option>
                                            <option value="0" @selected(old('active') == 0)>Không kích hoạt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('admin.index') }}"
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
