@extends("main")
@section("content")
    <section class="blogs">
        <div class="container mw-100 p-5">
            <div class="row">
                <div class="col-sm-12 p-0">
                    <h1 class="page-title on-shop text-center">
                        {{ $title }}
                    </h1>
                    @if($categories->count())
                        <ul class="list_shop_categories list-unstyled d-flex justify-content-center flex-wrap">
                            <li class="category_item">
                                <a href="{{ route('category') }}" class="category_item_link">
                                    <span class="category_name">All</span>
                                </a>
                            </li>
                            @foreach($categories as $item)
                                <li class="category_item">
                                    <a href="{{ url('category/'. $item->slug) }}" class="category_item_link">
                                        <span class="category_name">{{ $item->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            @include("block.post_item")
        </div>
    </section>
@endsection
