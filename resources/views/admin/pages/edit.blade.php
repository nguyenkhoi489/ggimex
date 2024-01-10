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
                        <form method="post" action="{{ route('pages.update',['id' => $page->id]) }}">
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
                                                       value="{{ $page->title }}"
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
                                                               value="{{ $page->slug }}"
                                                               class="form-control"
                                                               placeholder="...">
                                                    </div>
                                                    @if($page->id != 1)
                                                    <div class="col-sm-2">
                                                        <a class="btn btn-warning btn-edit__permalink btn-sm"
                                                           href="javascript:void(0)"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Chỉnh sữa">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                    </div>
                                                    @endif
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
                                                               value="{{ $page->thumb }}"
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
                                        @if($page->id != 1)
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Nội dung</label>
                                            <div class="col-sm-8">
                                        <textarea class="ckeditor"
                                                  name="content">{{ $page->content }}</textarea>
                                            </div>
                                        </div>
                                        @else
                                            @php($content = json_decode($page->content))
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề product</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="title_product"
                                                           value="{{ $content->title_product ?? "" }}"
                                                           class="form-control"
                                                           placeholder="...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Sub title Product</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="sub_title_product"
                                                           value="{{ $content->sub_title_product ?? "" }}"
                                                           class="form-control"
                                                           placeholder="...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Tiêu đề danh mục</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="title_category"
                                                           value="{{ $content->title_category ?? "" }}"
                                                           class="form-control"
                                                           placeholder="...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Sub title danh mục</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="sub_title_category"
                                                           value="{{ $content->sub_title_category ?? "" }}"
                                                           class="form-control"
                                                           placeholder="...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Danh mục sản phẩm</label>
                                                <div class="col-sm-8">
                                                    <select class="select2 form-control" multiple="multiple" name="category[]">
                                                        @foreach($category as $item)
                                                            <option value="{{ $item->id }}" @selected(in_array($item->id,$content->category))>{{ $item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--Quality-->
                                            <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                                QUALITY 1
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label">Quality Title 1</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="quality_title_1"
                                                                           value="{{ $content->quality_title_1 ?? "" }}"
                                                                           class="form-control"
                                                                           placeholder="...">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label">Quality
                                                                    Thumbnail 1</label>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-sm-8">
                                                                            <input type="text" data-choise="upload-images" name="quality_thumb_1"
                                                                                   value="{{ $content->quality_thumb_1  ?? ""}}"
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
                                                                <textarea class="form-control" rows="5" name="quality_des_1">{{ $content->quality_des_1 ?? null }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                                QUALITY 2
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label">Quality Title 2</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="quality_title_2"
                                                                           value="{{ $content->quality_title_2 ?? "" }}"
                                                                           class="form-control"
                                                                           placeholder="...">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label">Quality
                                                                    Thumbnail 2</label>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-sm-8">
                                                                            <input type="text" data-choise="upload-images" name="quality_thumb_2"
                                                                                   value="{{ $content->quality_thumb_2 ?? "" }}"
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
                                                                <textarea class="form-control" rows="5" name="quality_des_2">{{ $content->quality_des_2 ?? null }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                                QUALITY 3
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label">Quality Title 3</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="quality_title_3"
                                                                           value="{{ $content->quality_title_3 ?? "" }}"
                                                                           class="form-control"
                                                                           placeholder="...">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label">Quality
                                                                    Thumbnail 3</label>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-sm-8">
                                                                            <input type="text" data-choise="upload-images" name="quality_thumb_3"
                                                                                   value="{{ $content->quality_thumb_3  ?? ""}}"
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
                                                                <textarea class="form-control" rows="5" name="quality_des_3">{{ $content->quality_des_3 ?? null }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Market-->
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Title Market</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="title_market"
                                                           value="{{ $content->title_market ?? "" }}"
                                                           class="form-control"
                                                           placeholder="...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Market
                                                    Thumbnail </label>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <input type="text" data-choise="upload-images" name="thumb_market"
                                                                   value="{{ $content->thumb_market ?? null }}"
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
                                        @endif

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="is_active">
                                                    <option value="1" @selected($page->is_active == 1)>Kích hoạt
                                                    </option>
                                                    <option value="0" @selected($page->is_active == 0)>Không kích hoạt
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
                                                    @if($page->id != 1)
                                                    <div class="col-sm-2">
                                                        <a class="btn btn-warning btn-edit__permalink btn-sm"
                                                           href="javascript:void(0)"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Chỉnh sữa">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                    </div>
                                                    @endif
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
                                                    @if($page->id != 1)
                                                    <div class="col-sm-2">
                                                        <a class="btn btn-warning btn-edit__permalink btn-sm"
                                                           href="javascript:void(0)"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Chỉnh sữa">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                    </div>
                                                    @endif
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
                                                  name="description_seo"> {{ $seo->description_seo }}</textarea>
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
                                <a href="{{ route('pages.index') }}" class="btn btn-default" data-dismiss="modal">Trở
                                    về</a>
                                <button type="submit" class="btn btn-success">Lưu thông tin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="{{ asset('component/plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-selection__choice {
            background-color: blue !important;
        }
    </style>
@endsection
