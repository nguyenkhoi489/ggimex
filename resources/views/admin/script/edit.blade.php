@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('script.update',['id' => $script->id]) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Tên gọi (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="title"
                                               value="{{ $script->title }}"
                                               class="form-control" id="title" placeholder="Tiêu đề ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Mã Nhúng (*)</label>
                                    <div class="col-sm-8">
                                        <textarea name="widget_code"
                                                  class="form-control">{{ $script->widget_code }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Vị trí hiển thị</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="position">
                                            <option value="0" @selected($script->position == 0)>Header</option>
                                            <option value="1" @selected($script->position == 1)>After Body Tag</option>
                                            <option value="2" @selected($script->position == 2)>Footer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="is_active">
                                            <option value="1" @selected($script->is_active == 1)>Kích hoạt</option>
                                            <option value="0" @selected($script->is_active == 0)>Không kích hoạt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('script.index') }}" class="btn btn-default">Trở
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
