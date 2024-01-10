<div class="single-post-header with-thumb">
    <div class="single-post-header-bkg"
         style="background-image:url({{ url($post->thumb) }})"></div>
    <div class="single-post-header-overlay" style="opacity: 0.401174;"></div>
    <div class="row">
        <div class="col-lg-7 col-md-12 col-sm-12 m-auto">
            <div class="title">
                <h1 class="entry-title">{{ $post->title }}</h1>
                @if(isset($post->fullname) && isset($post->slug) && isset($post->title) && isset($post->created_at) && isset($post->categories_title))
                    <div class="post_meta "> by
                        on
                        <a href="{{$post->slug}}" title="{{ $post->title }}" rel="bookmark">
                            <time class="entry-date"
                                  datetime="{{ $post->created_at }}">{{ date('d/m/Y',strtotime($post->created_at)) }}</time>
                        </a> in
                        <a href="{{ url('category/'. $post->categories_slug) }}"
                           rel="category tag">{{$post->categories_title}}</a>
                    </div>

            @endif
            </div>
        </div>
    </div>
</div>
