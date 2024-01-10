@extends("main")
@section("content")
    <section class="shop">
        <div class="container  mw-100 p-5">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title on-shop text-center">
                        {{ $title }}
                    </h1>
                    @if($categories->count())
                        <ul class="list_shop_categories list-unstyled d-flex justify-content-center flex-wrap">
                           @foreach($categories as $item)
                                <li class="category_item">
                                    <a href="{{ url('product-category/'. $item->slug) }}" class="category_item_link">
                                        <span class="category_name">{{ $item->title }}</span>
                                    </a>
                                </li>
                           @endforeach
                        </ul>
                    @endif

                </div>
            </div>
            @include("block.product_item")
        </div>
    </section>
@endsection
