@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <form action="{{ route('comment.update',['id' => $cmt->id]) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               name="name"
                                               value="{{ $cmt->name }}"
                                               class="form-control" placeholder="Name ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email"
                                               name="email"
                                               value="{{ $cmt->email }}"
                                               class="form-control" placeholder="email ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Message</label>
                                    <div class="col-sm-8">
                                        <textarea name="message"
                                                  class="form-control">{{ $cmt->message  }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Type</label>
                                    <div class="col-sm-8">
                                        {!! App\Helper\Helper::type_comment($cmt->type) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Sản phẩm/Bài viết</label>
                                    <div class="col-sm-8">
                                        <a href="{{ url($cmt->type == 0 ? $post->slug : "product/" . $post->slug) }}" target="_blank">
                                            {{ $post->title }}
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Client IP</label>
                                    <div class="col-sm-8">
                                        <input type="email"
                                               readonly
                                               name="ip_address"
                                               value="{{ $cmt->ip_address }}"
                                               class="form-control" placeholder="127.0.0.1 ...">
                                    </div>
                                </div>
                                @if($cmt->type == 1)
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Đánh giá</label>
                                        <div class="col-sm-8">
                                            <select class="custom-select" name="rating">
                                                <option value="1" @selected($cmt->rating == 1)>1 Sao</option>
                                                <option value="2" @selected($cmt->rating == 2)>2 Sao</option>
                                                <option value="3" @selected($cmt->rating == 3)>3 Sao</option>
                                                <option value="4" @selected($cmt->rating == 4)>4 Sao</option>
                                                <option value="5" @selected($cmt->rating == 5)>5 Sao</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Trạng thái</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="is_active">
                                            <option value="1" @selected($cmt->is_active == 1)>Duyệt</option>
                                            <option value="0" @selected($cmt->is_active == 0)>Chờ duyệt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('comment.index') }}"
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
