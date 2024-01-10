@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('menus.update',['id' => $menu->id]) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Name (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="title"
                                               value="{{ $menu->title }}"
                                               class="form-control" id="title" placeholder="Name...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Type</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="type">
                                            <option value="0" @selected($menu->type == 0)>Link tuỳ chọn</option>
                                            <option value="1" @selected($menu->type == 1)>Product Category</option>
                                            <option value="2" @selected($menu->type == 2)>Post Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row hide">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Category</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" {{ $menu->type == 0 ? "disabled" : "" }} name="table_id">
                                            @if($menu->type == 1)
                                                @foreach($product_cat as $item)
                                                    <option value="{{ $item->id }}" @selected($menu->table_id == $item->id)>{{ $item->title }}</option>
                                                @endforeach
                                            @endif
                                            @if($menu->type == 2)
                                                @foreach($post_cat as $item)
                                                    <option value="{{ $item->id }}" @selected($menu->table_id == $item->id)>{{ $item->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Link</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="slug"
                                               {{ $menu->type == 0 ?  "" : "readonly" }}
                                               value="{{ $menu->type == 0 ?$menu->slug : "" }}"
                                               class="form-control" id="title" placeholder="abc-123...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Vị trí hiển thị (*)</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="sort_by"
                                               value="{{ $menu->sort_by }}"
                                               class="form-control" id="title" placeholder="1...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Menus Parent</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="parent_id">
                                            <option value="0" @selected($menu->parent_id == 0)>Default</option>
                                            @foreach($menus as $item)
                                                <option value="{{ $item->id }}"
                                                        @selected($menu->parent_id == $item->id)>
                                                    {{ $item->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="is_active">
                                            <option value="1" @selected($menu->is_active == 1)>Kích hoạt</option>
                                            <option value="0" @selected($menu->is_active == 0)>Không kích hoạt</option>
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
    <script type="text/javascript">
        var api_post = '{{route('get.post.category')}}';
        var api_product = '{{ route('get.product.category') }}';
    </script>
@endsection
