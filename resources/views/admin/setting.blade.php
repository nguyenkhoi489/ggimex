@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('setting.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Tên gọi của site</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="title"
                                               value="{{ $settings->title }}"
                                               class="form-control" id="title" placeholder="Tiêu đề ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Mô tả của site</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="meta"
                                               value="{{ $settings->meta }}"
                                               class="form-control" id="title" placeholder="Mô tả ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Địa Chỉ</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="address"
                                               value="{{ $settings->address }}"
                                               class="form-control" id="title" placeholder="Mô tả ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="phone"
                                               value="{{ $settings->phone }}"
                                               class="form-control" id="title" placeholder="Mô tả ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="email"
                                               value="{{ $settings->email }}"
                                               class="form-control" id="title" placeholder="Mô tả ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Tax Code</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="tax"
                                               value="{{ $settings->tax }}"
                                               class="form-control" id="title" placeholder="Mô tả ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Google Map</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="iframe"
                                               value="{{ $settings->iframe }}"
                                               class="form-control" id="title" placeholder="Mô tả ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Từ khóa cho máy chủ tìm
                                        kiếm</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="keyword"
                                               value="{{ $settings->keyword }}"
                                               class="form-control" id="title" placeholder="keyword ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Đường dẫn file logo của
                                        site </label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <input type="text" data-choise="upload-images" name="logo" value="{{ $settings->logo }}"
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
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Đường dẫn file favicon của
                                        site </label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <input type="text" data-choise="upload-images" name="favicon" value="{{ $settings->favicon }}"
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
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Google Index</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="google_index">
                                            <option value="1" @selected($settings->google_index == 1)>Index</option>
                                            <option value="0" @selected($settings->google_index == 0)>NoIndex</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái Website</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="status">
                                            <option value="1" @selected($settings->status == 1)>Hoạt động</option>
                                            <option value="0" @selected($settings->status == 0)>Bảo trì</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Nội dung thông báo site
                                        ngưng hoạt động</label>
                                    <div class="col-sm-8">
                                        <textarea class="ckeditor" name="content"> {{ $settings->content }}</textarea>
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
