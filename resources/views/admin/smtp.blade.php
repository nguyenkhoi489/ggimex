@extends('admin.main')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('smtp.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">SMTP Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="smtp_type">
                                            <option value="0" @selected($smtp->smtp_type == 0)>Email Server</option>
                                            <option value="1" @selected($smtp->smtp_type == 1)>Google</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">SMTP Host (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="host"
                                               value="{{ $smtp->host }}"
                                               class="form-control" placeholder="smtp.gmail.com ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Username (*)
                                        </label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="user"
                                               value="{{ $smtp->user }}"
                                               class="form-control" placeholder="user ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label"> Mật khẩu (*)
                                        </label>
                                    <div class="col-sm-8">
                                        <input type="password" data-choise="upload-images" name="password" value="{{ (new \App\Helper\Helper())->decrypt($smtp->password) }}"
                                               class="form-control" placeholder="*********">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label"> Port (*)
                                        </label>
                                    <div class="col-sm-8">
                                        <input type="number" data-choise="upload-images" name="port" value="{{ $smtp->port }}"
                                               class="form-control" placeholder="25,465,587 ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">SSL Type</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="type">
                                            <option value="0" @selected($smtp->type == 0)>Default</option>
                                            <option value="1" @selected($smtp->type == 1)>SSL</option>
                                            <option value="2" @selected($smtp->type == 2)>TLS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="is_active">
                                            <option value="1" @selected($smtp->is_active == 1)>Kích Hoạt</option>
                                            <option value="0" @selected($smtp->is_active == 0)>Không kích hoạt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
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
