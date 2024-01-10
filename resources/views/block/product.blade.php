<section class="min-100">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 m-auto">
                <h3 class="text-center mt-50">{{ $data->title_product }}</h3>
                <p style="text-align: center;">{{ $data->sub_title_product }}</p>

                <ul class="list-unstyled d-flex list-products">
                    @foreach($products as $item)
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
                            </div>
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
                <div class="box-btn text-center">
                    <a href="{{ route('shop') }}" class="btn btn-dark m-auto">All Products</a>
                </div>

            </div>
        </div>
    </div>
</section>
