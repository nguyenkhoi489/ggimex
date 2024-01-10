@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('slider.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề</label>
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
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Định dạng Slider</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="type">
                                            <option value="0" @selected(old('type') == 0)>Image</option>
                                            <option value="1" @selected(old('type') == 1)>Image Text</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề text</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="text"
                                               {{ old('type') == 0 ? "readonly" : "" }}
                                               value="{{ old('text') }}"
                                               class="form-control" placeholder="Tiêu đề text...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Sub text</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="subtext"
                                               {{ old('type') == 0 ? "readonly" : "" }}
                                               value="{{ old('subtext') }}"
                                               class="form-control" placeholder="Sub text...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Vị trí text</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" {{ old('text_position') == 0 ? "disabled" : "" }} name="text_position">
                                            <option value="0" @selected(old('text_position') == 0)>Bên trái</option>
                                            <option value="1" @selected(old('text_position') == 1)>Bên phải</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Vị trí Slider (*)</label>
                                    <div class="col-sm-8">
                                        <input type="number"
                                               name="sort_by"
                                               value="{{ old('sort_by') }}"
                                               class="form-control" placeholder="Vị trí slider...">
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
                                        <a href="{{ route('slider.index') }}"
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
