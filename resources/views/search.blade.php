@extends("main")
@section("content")
    <section class="shop">
        <div class="container mw-100 p-5">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title on-shop text-center">
                        {{ $title }}
                    </h1>
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-sm-12 col-lg-9 m-auto">
                    @if($product && $product->count())
                        @foreach($product as $item)
                            <div class="search_result_item">
                                <h2 class="entry-title-archive">
                                    <a href="{{ url('product/' . $item->slug) }}" class="thumbnail_archive">
                                        <span>{{ $item->title }}</span>
                                    </a>
                                </h2>
                                <div class="post_meta_archive">on
                                    <time class="entry-date"
                                          datetime="2023-11-21T16:58:50+07:00">{{ $item->created_at }}</time>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if($post && $post->count())
                        @foreach($post as $item)
                            <div class="search_result_item">
                                <h2 class="entry-title-archive">
                                    <a href="{{ url( $item->slug) }}" class="thumbnail_archive">
                                        <span>{{ $item->title }}</span>
                                    </a>
                                </h2>
                                <div class="post_meta_archive">on
                                    <time class="entry-date"
                                          datetime="2023-11-21T16:58:50+07:00">{{ $item->created_at }}</time>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
