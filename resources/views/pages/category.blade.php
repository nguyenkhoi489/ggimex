@extends("main")
@section("content")
    <section>
        <div class="container mw-100 p-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-type text-center mb-3 page-title-desc">Category Archives</div>
                    <h1 class="page-title on-shop text-center">
                        {{ $title }}
                    </h1>
                    <ul class="list_shop_categories list-unstyled d-flex justify-content-center flex-wrap">
                            <li class="category_item">
                                <a href="{{ route('category') }}" class="category_item_link">
                                    <span class="category_name">All</span>
                                </a>
                            </li>
                    </ul>
                </div>
            </div>
            @include("block.post_item")
        </div>
    </section>
@endsection
