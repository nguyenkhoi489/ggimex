<div class="row mt-3">
    <div class="col-sm-12 p-0">
        <div class="top-bar__shop align-items-center d-flex">
            <div class="mr-3">
                    <span class="filters-text"
                          type="button" data-toggle="offcanvas">
                        <i class="fas fa-filter"></i>
                        Filter
                    </span>
            </div>
            <nav class="woocommerce-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="breadcrump_sep">/</span>
                {{ $title }}
            </nav>
        </div>
        <div class="box-product__item mt-5">
            <ul class="list-unstyled products list-replace d-flex list-products">
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
        </div>
    </div>
    <div class="col-sm-12 nav-paginate">
        {{ $products->withquerystring()->links()  }}
    </div>
</div>
