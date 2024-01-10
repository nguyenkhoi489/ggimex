@extends('main')
@section('content')
    <section class="p-5 product-page">
        <div class="container">
            <div class="row mb-5 ">
                <div class="col-lg-7 col-md-12 col-sm-12 ">
                    <!-- Slider main wrapper -->
                    <div class="swiper-container-wrapper custom-mobile d-flex justify-content-around align-items-start">
                        @if($product->gallery)
                            <div class="swiper-container gallery-thumbs hide-for__mobile">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset($product->thumb) }}" alt="">
                                    </div>
                                    @foreach(json_decode($product->gallery) as $item)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($item) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Slider main container -->
                            <div class="swiper-container gallery-top">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset($product->thumb) }}" alt="">
                                    </div>
                                    @foreach(json_decode($product->gallery) as $item)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($item) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-container gallery-thumbs hide-for__desktop">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset($product->thumb) }}" alt="">
                                    </div>
                                    @foreach(json_decode($product->gallery) as $item)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($item) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="product_infos">
                        <nav class="woocommerce-breadcrumb mb-3">
                            <a href="{{ route('home')  }}">Home</a>
                            <span>/</span>
                            <a class="breadcrumb-current"
                               href="{{ url('product-category/' . $product->categories_slug) }}">
                                {{ $product->categories_title }}
                            </a>
                        </nav>
                        <div class="product_summary_middle">
                            <h1 class="product_title entry-title">{{ $product->title }}</h1>
                        </div>
                        <p class="price">
                            @if($product->price)
                                <span class="price-amount amount">
                                    <bdi>{{ $product->price }}
                                        <span class="woocommerce-Price-currencySymbol">
                                            {{ $product->value }}
                                        </span>
                                    </bdi>
                                </span>
                            @endif
                            @if($product->price_to)
                                –
                                <span class="price-amount amount">
                                    <bdi>{{ $product->price_to }}
                                        <span class="woocommerce-Price-currencySymbol">
                                            {{ $product->value }}
                                        </span>
                                    </bdi>
                                </span>
                            @endif
                        </p>
                        <div class="woocommerce-product-details__short-description">
                            {!! $product->description !!}
                            <div class="form-submit">
                                @include('block.form')
                            </div>
                        </div>
                        <div class="product_meta mt-5">
                            <span class="sku_wrapper">SKU: <span class="sku">{{ $product->sku ?? "N/A" }}</span></span>
                            <span class="posted_in">Category: <a
                                    href="{{ url('product-category/'.$product->categories_slug) }}"
                                    rel="tag">{{ $product->categories_title }}</a></span>
                            <span class="tagged_as">Tags:
                                    @if($tags)
                                    @foreach($tags as $item)
                                        <a href="{{ url('product-tag/'.$item->slug)  }}"
                                           rel="tag">{{ $item->title }}</a>,
                                    @endforeach
                                @endif
                            </span>
                        </div>
                        <div class="product_navigation">
                            <nav role="navigation" id="nav-below" class="product-navigation"
                                 aria-label="Product Navigation">
                                @if($pre_product)
                                    <div class="product-nav-previous product-nav">
                                        <a
                                            href="{{ url('product/'.$pre_product->slug) }}"
                                            rel="prev">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </div>
                                @endif
                                @if($next_product)
                                        <div class="product-nav-next product-nav">
                                            <a
                                                href="{{ url('product/'.$next_product->slug) }}"
                                                rel="next">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </div>
                                @endif

                            </nav><!-- #nav-below -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9 m-auto">
                    <ul class="nav nav-pills justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#content" role="tab"
                               aria-controls="content" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#review" role="tab"
                               aria-controls="review" aria-selected="false">Reviews ({{ $reviews->count() }})</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane p-5 fade show active" id="content" role="tabpanel"
                             aria-labelledby="content">
                            {!! $product->content !!}
                        </div>
                        <div class="tab-pane p-5 fade" id="review" role="tabpanel" aria-labelledby="review">
                            <div id="reviews">
                                @if($reviews->count())
                                    <div id="comments" class="mb-5">
                                        <h2 class="woocommerce-Reviews-title">
                                            {{ $reviews->count() }} review for <span>{{ $product->title }}</span></h2>
                                        <ol class="commentlist list-unstyled">
                                            @foreach($reviews as $item)
                                                <li class="review even thread-even depth-1" id="li-comment-21604">
                                                    <div id="comment-21604" class="comment_container d-flex align-items-center">
                                                        <img alt=""
                                                             src="{{ asset('storage/2023/12/25/1703489666avata.png') }}"
                                                             class="avatar avatar-60 photo" height="60" width="60"
                                                             loading="lazy" decoding="async">
                                                        <div class="comment-text">
                                                            <p class="meta">
                                                                <strong class="woocommerce-review__author">
                                                                    {{ $item->name }}
                                                                </strong>
                                                                <span class="woocommerce-review__dash">–</span>
                                                                <time class="woocommerce-review__published-date"
                                                                      datetime="{{ $item->created_at }}">
                                                                    {{ date('d/m/Y',strtotime($item->created_at)) }}
                                                                </time>
                                                            </p>

                                                            <div class="description">
                                                                <p>
                                                                    {{ $item->message }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li><!-- #comment-## -->
                                            @endforeach
                                        </ol>
                                    </div>
                                @endif
                            </div>
                            @include("block.review")
                        </div>

                    </div>
                </div>
            </div>
            @if($related->count())
                <div class="row mt-5">
                    <div class="col-sm-12">
                        <h2 class="text-center">Related products</h2>
                        <ul class="list-unstyled d-flex list-products mt-5">
                            @foreach($related as $item)
                                <li class="product type-product has-post-thumbnail animate">
                                    <div class="product_thumbnail_wrapper ">
                                        <a href="{{ url('product/' . $item->slug) }}"
                                           class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                            <div class="product_thumbnail with_second_image second_image_loaded"
                                                 style="background-size: cover;">
                                                <span class="product_thumbnail_background"
                                                      style="background-image:url({{ asset($item->thumb) }})"></span>
                                                <img loading="lazy"
                                                     decoding="async" width="350" height="435"
                                                     src="{{ asset($item->thumb) }}"
                                                     class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                     alt="">
                                            </div>
                                        </a>
                                        <div class="product_thumbnail_icons">
                                            <a href="#" id="product_id_5209"
                                               class="product_quickview_button"
                                               data-product_id="{{ $item->id }}"></a>
                                            <div class="icons-separator"></div>
                                        </div>
                                    </div><!--.product_thumbnail_wrapper-->


                                    <h2 class="woocommerce-loop-product__title">
                                        <a href="{{ url('product/' . $item->slug) }}">{{ $item->title }}</a>
                                    </h2>
                                    <div class="product_after_shop_loop">
                                        <div class="product_after_shop_loop_switcher">
                                            <span class="price">
                                            @if($item->price)
                                                <span class="price-amount amount">
                                                    <bdi>{{ $item->price }}
                                                        <span class="woocommerce-Price-currencySymbol">
                                                            {{ $item->value }}
                                                        </span>
                                                    </bdi>
                                                </span>
                                            @endif
                                            @if($item->price_to)
                                                –
                                                <span class="price-amount amount">
                                                    <bdi>{{ $item->price_to }}
                                                        <span class="woocommerce-Price-currencySymbol">
                                                            {{ $item->value }}
                                                        </span>
                                                    </bdi>
                                                </span>
                                            @endif
                                                </span>
                                            <a class="button" href="{{ url('product/' . $item->slug) }}" rel="nofollow">
                                                Select options</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </section>
    <script src="{{ asset('component/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript">
        // Params

        const myCustomSlider = document.querySelectorAll('.gallery-thumbs');
        for( i = 0; i< myCustomSlider.length; i++ ) {
            var swiper_thumbnail = new Swiper(myCustomSlider[i], {  //added
                slidesPerView: 'auto',
            })
            var swiper = new Swiper('.gallery-top', {
                loop: true,
                simulateTouch: true,
                autoplay: {
                    delay: 2000,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {                       //added
                    swiper: swiper_thumbnail,   //added
                },
            })
        }
    </script>
@endsection
