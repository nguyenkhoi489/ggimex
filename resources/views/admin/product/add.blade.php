@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-1">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill"
                                       href="#default-tab" role="tab" aria-controls="default-tab"
                                       aria-selected="true">Nội dung cơ bản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="pill"
                                       href="#content-tab" role="tab" aria-controls="content-tab"
                                       aria-selected="true">Content</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="pill"
                                       href="#extract-tab" role="tab" aria-controls="extract-tab"
                                       aria-selected="true">Thông tin bổ sung</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="pill"
                                       href="#gallery-tab" role="tab" aria-controls="gallery-tab"
                                       aria-selected="true">Thư viện hình ảnh</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill"
                                       href="#seo-tab" role="tab"
                                       aria-controls="seo-tab" aria-selected="false">Thông tin SEO</a>
                                </li>
                            </ul>
                        </div>
                        <form method="post" action="{{ route('product.store') }}">
                            @csrf
                            <div class="card-body">

                                <div class="tab-content">
                                    <!--Tab default-->
                                    <div class="tab-pane fade active show" id="default-tab" role="tabpanel"
                                         aria-labelledby="default-tab">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề (*)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title"
                                                       value="{{ old('title') }}"
                                                       data-target="slug"
                                                       class="form-control"
                                                       placeholder="...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Đường dẫn (*)</label>
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <input type="text" readonly name="slug"
                                                               value="{{ old('slug') }}"
                                                               class="form-control"
                                                               placeholder="...">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a class="btn btn-warning btn-edit__permalink btn-sm"
                                                           href="javascript:void(0)"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Chỉnh sữa">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Ảnh
                                                Thumbnail (*)</label>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <input type="text" data-choise="upload-images" name="thumb"
                                                               value="{{ old('thumb') }}"
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
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Giá
                                                tiền {{ old('price_type') == 1 ? "(từ)" : "" }}</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="price"
                                                       value="{{ old('price') }}"
                                                       class="form-control"
                                                       placeholder="...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Type</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="price_type">
                                                    <option value="0" @selected(old('price_type') == 0)>Đơn giá
                                                    </option>
                                                    <option value="1" @selected(old('price_type') == 1)>Khoảng Giá
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group row {{ old('price_type') == 0 ? "d-none" : "" }} price-to">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Giá tiền
                                                (đến)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="price_to"
                                                       value="{{ old('price_to') }}"
                                                       class="form-control"
                                                       placeholder="...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="is_active">
                                                    <option value="1" @selected(old('is_active') == 1)>Kích hoạt
                                                    </option>
                                                    <option value="0" @selected(old('is_active') == 0)>Không kích hoạt
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!--Tab content -->
                                    <div class="tab-pane fade" id="content-tab" role="tabpanel"
                                         aria-labelledby="content-tab">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Mô tả ngắn</label>
                                            <div class="col-sm-8">
                                        <textarea class="ckeditor"
                                                  name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Nội dung (*)</label>
                                            <div class="col-sm-8">
                                        <textarea class="ckeditor"
                                                  name="content">{{ old('content') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Tab thông tin bổ sung -->
                                    <div class="tab-pane fade" id="extract-tab" role="tabpanel"
                                         aria-labelledby="extract-tab">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Danh mục sản
                                                phẩm</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="categories_id">
                                                    @foreach($categories as $item)
                                                        <option value="{{ $item->id }}"
                                                            @selected(old('categories_id') == $item->id )>
                                                            {{ $item->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Đơn vị tiền
                                                tệ</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="prefix_id">
                                                    @foreach($prefix as $item)
                                                        <option value="{{ $item->id }}"
                                                            @selected(old('prefix_id') == $item->id )>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Mã sản phẩm</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="sku"
                                                       value="{{ old('sku') }}"
                                                       class="form-control"
                                                       placeholder="...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Kho hàng</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="inventory"
                                                       value="{{ old('inventory') }}"
                                                       class="form-control"
                                                       placeholder="...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Product Tags <br>
                                                <small>
                                                    Mỗi tags cách nhau bởi dấu phẩy (,)
                                                </small></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="product_tags"
                                                       value="{{ old('product_tags') }}"
                                                       class="form-control"
                                                       placeholder="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!--Tab gallery -->
                                    <div class="tab-pane fade" id="gallery-tab" role="tabpanel"
                                         aria-labelledby="gallery-tab">
                                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix"
                                            id="gallery-display">
                                        </ul>
                                        <input type="file" id="files" name="files[]" class="d-none" multiple>
                                        <input type="hidden" name="gallery" value="{{ old('gallery') }}">
                                        <a class="btn btn-add__gallery btn-outline-success">
                                            Thêm hình ảnh
                                        </a>
                                    </div>
                                    <!--SEO default-->
                                    <div class="tab-pane" id="seo-tab" role="tabpanel"
                                         aria-labelledby="seo-tab">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề SEO</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title_seo"
                                                       value="{{ old('title_seo') }}"
                                                       data-target="slug_seo"
                                                       class="form-control"
                                                       placeholder="...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Đường dẫn
                                                SEO</label>
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <input type="text" readonly name="slug_seo"
                                                               value="{{ old('slug_seo') }}"
                                                               class="form-control"
                                                               placeholder="...">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a class="btn btn-warning btn-edit__permalink btn-sm"
                                                           href="javascript:void(0)"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Chỉnh sữa">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Canonical Link
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <input type="text" readonly name="canonical_link"
                                                               value="{{ old('canonical_link') }}"
                                                               class="form-control"
                                                               placeholder="...">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a class="btn btn-warning btn-edit__permalink btn-sm"
                                                           href="javascript:void(0)"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Chỉnh sữa">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Ảnh
                                                Thumbnail </label>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <input type="text" data-choise="upload-images" name="thumb_seo"
                                                               value="{{ old('thumb_seo') }}"
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
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Mô tả</label>
                                            <div class="col-sm-8">
                                        <textarea class="ckeditor"
                                                  name="description_seo"> {{ old('description_seo') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Google
                                                INDEX</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="google_index">
                                                    <option value="1" @selected(old('google_index') == 1)>Index
                                                    </option>
                                                    <option value="0" @selected(old('google_index') == 0)>Noindex
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer clearfix">
                                <a href="{{ route('product.index') }}" class="btn btn-default" data-dismiss="modal">Trở
                                    về</a>
                                <button type="submit" class="btn btn-success">Lưu thông tin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
