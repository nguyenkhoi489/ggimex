@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('chatwidget.store') }}" method="post">
                                @csrf
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="title"
                                               value="{{ old('title') }}"
                                               class="form-control" placeholder="Tiêu đề ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Đường dẫn file (*)</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <input type="text" data-choise="upload-images" name="thumb" value="{{ old('thumb') }}"
                                                       class="form-control" placeholder="Chọn File">
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button"
                                                        class="btn btn-outline-secondary btn-open-thumb"
                                                        data-toggle="modal" data-target="#modal-xl"
                                                >
                                                    <i class="fas fa-folder-open"></i> Chọn hình ảnh
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Link (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="link"
                                               value="{{ old('link') }}"
                                               class="form-control" placeholder="Link Social...">
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
                                        <a href="{{ route('social.index') }}"
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
