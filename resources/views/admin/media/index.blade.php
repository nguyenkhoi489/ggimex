@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-header">
                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <select class="custom-select" name="year">
                                        <option value="0" selected="">Tất cả</option>
                                        @foreach($folder as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="custom-select" name="month">
                                        <option value="0" selected="">-----</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="custom-select" name="day">
                                        <option value="0" selected="">-----</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <button type="button" class="btn btn-filter__img btn-secondary">Tìm kiếm</button>
                                    <button type="button" class="btn btn-add__btn btn-outline-secondary">Chọn nhiều</button>
                                    <button type="button" class="btn btn-outline-secondary btn-open-thumb" data-toggle="modal" data-target="#modal-xl">
                                        <i class="fas fa-folder-open"></i> Tải lên
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row filer-show__media">
                                @if($files)
                                    @foreach($files as $item)
                                        <div class="col-sm-2 position-relative mb-2">
                                            <input type="checkbox" value="{{ $item }}" name="media_all[]" class="media-check">
                                            <div class="thumbnail">
                                                <a href="javascript:void(0)" class="btn-choice__thumb-func" data-url="{{ $item }}">
                                                    <img src="{{ url($item) }}" class="img-fluid mb-2">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="row">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success btn-loadMore">Load More</button>
                                </div>
                                <div class="col-sm-2">
                                    <select name="" class="fiter-control form-control">
                                        <option value="0">Chọn thao tác</option>
                                        <option value="remove">Xoá</option>
                                    </select>
                                </div>
                                <a data-type="1" class="btn col-sm-1 btn-outline-info btn-action__view disabled">Xử lý</a>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
