@extends('admin.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card p-4">
                        <form action="{{ route('redirect.update',['id' => $link->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Old URL (*)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="old_url" value="{{ $link->old_url }}" class="form-control"
                                           id="title"
                                           placeholder="Old URL ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">New URL (*)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="new_url" value="{{ $link->new_url }}"
                                           class="form-control" placeholder="New URL ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Type (*)</label>
                                <div class="col-sm-8">
                                    <input type="number" name="type" value="{{ $link->type }}"
                                           class="form-control" placeholder="301,302,307 ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ssl_name" class="col-sm-4 col-form-label">Trạng thái</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="is_active">
                                        <option value="1" @selected(old('is_active',1) == $link->is_active)>Kích hoạt
                                        </option>
                                        <option value="0" @selected(old('is_active',0) == $link->is_active)>Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('redirect.index') }}" class="btn btn-outline-secondary">Trở về</a>
                                    <button type="submit" class="btn btn-success">Lưu thông tin</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
