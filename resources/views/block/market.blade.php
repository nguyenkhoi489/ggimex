<section class="min-70 p-5 market">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-head__market d-flex align-items-center">
                    <span class="holder">
                        <span class="line"></span>
                    </span>
                    <h3>{{ $data->title_market }}</h3>
                    <span class="holder">
                        <span class="line"></span>
                    </span>
                </div>
                <div class="box-content__market">
                    <img alt="{{ $data->title_market }}" src="{{ asset($data->thumb_market) }}">
                </div>
            </div>
        </div>
    </div>
</section>
