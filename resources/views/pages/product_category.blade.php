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
            @include("block.product_item")
        </div>
    </section>
@endsection
