<section class="min-100 slider-ss">
<div class="swiper-container main-slider" style="overflow: hidden;top: 0;left: 0">
    <div class="swiper-wrapper">
        @if($sliders)
            @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <figure class="slide-bgimg"
                            style="background-image:url({{ url($slider->thumb) }})"
                            data-swiper-parallax-x="50%">
                        <img src="{{ url($slider->thumb) }}" class="entity-img" />
                    </figure>
                    @if($slider->type == 1)
                        <div class="content {{ $slider->text_position == 0 ? "" : "text-right" }}">
                            <div class="box-content__text">
                                <h2 class="title slider-title">{{ $slider->text }}</h2>
                                <p class="caption"
                                   data-swiper-parallax-x="30%"
                                   data-swiper-parallax-opacity="0">{{ $slider->subtext  }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev swiper-button-white"></div>
    <div class="swiper-button-next swiper-button-white"></div>
</div>

<script src="{{ asset('component/js/swiper-bundle.min.js') }}"></script>
<script type="text/javascript">
    // Params
    let mainSliderSelector = '.main-slider';

    // Main Slider
    let mainSliderOptions = {
        loop: true,
        speed:1000,
        parallax:true,
        autoplay:{
            delay:3000
        },
        grabCursor: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }

    };
    let mainSlider = new Swiper(mainSliderSelector, mainSliderOptions);
</script>
</section>
