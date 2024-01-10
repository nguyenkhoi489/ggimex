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
                                    <a class="nav-link" data-toggle="pill"
                                       href="#seo-tab" role="tab"
                                       aria-controls="seo-tab" aria-selected="false">Thông tin SEO</a>
                                </li>
                            </ul>
                        </div>
                        <form method="post" action="{{ route('categories.update',['id' => $categories->id]) }}">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="tab-content">
                                    <!--Tab default-->
                                    <div class="tab-pane fade active show" id="default-tab" role="tabpanel"
                                         aria-labelledby="default-tab">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề (*)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title"
                                                       value="{{ $categories->title }}"
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
                                                               value="{{ $categories->slug }}"
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
                                                        <input type="text" data-choise="upload-images" name="thumb"
                                                               value="{{ $categories->thumb }}"
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
                                                  name="description">{{ $categories->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="is_active">
                                                    <option value="1" @selected($categories->is_active == 1)>Kích hoạt
                                                    </option>
                                                    <option value="0" @selected($categories->is_active == 0)>Không kích hoạt
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!--SEO default-->
                                    <div class="tab-pane" id="seo-tab" role="tabpanel"
                                         aria-labelledby="seo-tab">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề SEO</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title_seo"
                                                       value="{{ $seo->title }}"
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
                                                               value="{{ $seo->slug }}"
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
                                                               value="{{ $seo->canonical }}"
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
                                                               value="{{ $seo->thumb }}"
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
                                                  name="description_seo"> {{ $seo->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Google
                                                INDEX</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="google_index">
                                                    <option value="1" @selected($seo->google_index == 1)>Index
                                                    </option>
                                                    <option value="0" @selected($seo->google_index == 0)>Noindex
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer clearfix">
                                <a href="{{ route('categories.index') }}" class="btn btn-default" data-dismiss="modal">Trở
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
