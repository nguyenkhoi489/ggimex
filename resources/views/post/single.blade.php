@extends('main')
@section('content')
    @include('post.header-title')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-9">
                <div class="entry-content blog-single">
                    {!!$post->content!!}
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                @include("block.form_search")
                @include("block.recent_post")
                @include("block.recent_comment")
            </div>
        </div>
    </div>
    @include('block.comment')
@endsection
