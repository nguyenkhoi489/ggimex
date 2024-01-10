<section class="min-70 bg-gra__gray p-5">
    <div class="container company">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <img loading="lazy" decoding="async" class="vc_single_image-img "
                     src="{{ asset($data->quality_thumb_1) }}" width="650"
                     height="441" alt="zyro-image" title="zyro-image">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h4 style="text-align: center;">{{ $data->quality_title_1 }}</h4>
                <p style="text-align: center;">{{ $data->quality_des_1 }}</p>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <img loading="lazy" decoding="async" class="vc_single_image-img "
                     src="{{ asset($data->quality_thumb_2) }}" width="650"
                     height="441" alt="zyro-image" title="zyro-image">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h4 style="text-align: center;">{{ $data->quality_title_2 }}</h4>
                <p style="text-align: center;">{{ $data->quality_des_2 }}</p>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <img loading="lazy" decoding="async" class="vc_single_image-img "
                     src="{{ asset($data->quality_thumb_3) }}" width="650"
                     height="441" alt="zyro-image" title="zyro-image">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h4 style="text-align: center;">{{ $data->quality_title_3 }}</h4>
                <p style="text-align: center;">{{ $data->quality_des_3 }}</p>
            </div>
        </div>
    </div>
</section>
