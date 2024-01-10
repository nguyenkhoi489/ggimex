<footer class="site-footer">
    <div class="row">
        <div class="col-lg-3 col-sm-12">
            <h3 class="widget-title">HEAD OFFICE</h3>
            <div class="textwidget">
                <p>{{ $setting->title }}</p>
                <p>Address: {{ $setting->address }}</p>
                <p>Call:{{ $setting->phone }}</p>
                <p>Tax Code: {{ $setting->tax }}</p>
                <p>Email: {{ $setting->email }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <h3 class="widget-title">NEWS</h3>
            <ul class="list-unstyled list-post">
                @foreach($recent_post as $item)
                    <li>
                        <a href="{{ url($item->slug) }}" title="{{ $item->title }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-newspaper" viewBox="0 0 16 16">
                                <path
                                        d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z"/>
                                <path
                                        d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z"/>
                            </svg>
                            {{ $item->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-3 col-sm-12">
            <h3 class="widget-title">CALENDAR</h3>
            <div class="box-calendar">
                <div class="box-header">
                    <p class="current-date"></p>
                    <div class="icons">
                        <span id="prev" class="material-symbols-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-left" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd"
                                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </span>
                        <span id="next" class="material-symbols-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                              <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="calendar">
                    <ul class="weeks">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                    </ul>
                    <ul class="days"></ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 widget_search ">
            <h3 class="widget-title">SEARCH</h3>
            <form action="{{ route('search.keyword') }}" method="get">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" name="keyword" id="form1" class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-copyright__social">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="footer_socials_wrapper">
                        <ul class="sk_social_icons_list center d-flex justify-content-center list-unstyled">
                            @foreach($socials as $item)
                                <li class="sk_social_icon default_icon">
                                    <a class="sk_social_icon_link" target="_blank"
                                       href="{{ $item->link }}">
                                        <img src="{{ asset($item->thumb) }}" width="25" alt="{{ $item->title }}">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($chats->count())
        <div id="button-contact-vr" class="">
            <div id="gom-all-in-one"><!-- v3 -->
                @foreach($chats as $item)
                    <div class="{{ Str::slug($item->title) }} button-contact">
                        <div class="phone-vr">
                            <div class="phone-vr-circle-fill"></div>
                            <div class="phone-vr-img-circle">
                                <a target="_blank" href="{{ $item->link }}">
                                    <img alt="icon" src="{{ asset($item->thumb) }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- end v3 class gom-all-in-one -->
        </div>
    @endif
</footer>
@include("block.canvas")
<script type="text/javascript">
    var api_comment = '{{ route('post.comment') }}';
    var api_getProduct = '{{ route('get.product') }}';
    var api_submit = '{{ route('form.submit') }}';

    function url(slug) {
        return "{{ route('home') }}/" + slug;
    }
</script>
<script src="{{ asset('component/js/jquery-3.7.1.min.js') }}"></script>
<script defer src="{{ asset('component/js/popper.min.js') }}"></script>
<script defer src="{{ asset('component/js/bootstrap.min.js') }}"></script>
<script defer src="{{ asset('/component/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('component/js/client/main.js') }}"></script>
@if($footer_script->count())
    @foreach($footer_script as $item)
        {!! $item->widget_code !!}
    @endforeach
@endif