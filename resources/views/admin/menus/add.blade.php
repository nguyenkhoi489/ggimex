@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('menus.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Name (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="title"
                                               value="{{ old('title') }}"
                                               class="form-control" id="title" placeholder="Name...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Type</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="type">
                                            <option value="0" @selected(old('type') == 0)>Link tuỳ chọn</option>
                                            <option value="1" @selected(old('type') == 1)>Product Category</option>
                                            <option value="2" @selected(old('type') == 2)>Post Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row hide">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Category</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" {{ old('type') == 0 ? "disabled" : "" }} name="table_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Link</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="slug"
                                               {{ old('type') == 0 ?  "" : "readonly" }}
                                               value="{{ old('slug') }}"
                                               class="form-control" id="title" placeholder="abc-123...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Vị trí hiển thị (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="sort_by"
                                               value="{{ old('sort_by') }}"
                                               class="form-control" id="title" placeholder="1...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Menus Parent</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="parent_id">
                                            <option value="0" @selected(old('parent_id') == 0)>Default</option>
                                            @if($menus)
                                                @foreach($menus as $item)
                                                    <option value="{{ $item->id }}"
                                                            @selected(old('parent_id') == $item->id)>
                                                        {{ $item->title }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
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
                                        <a href="{{ route('menus.index') }}" class="btn btn-default">Trở
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
