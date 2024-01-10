<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title }}</title>
<!-- Favicon -->
<link rel="shortcut icon" type="image/png" href="{{ url($favicon->favicon) }}"/>
@if(!isset($seo))
    <meta name="description" content=""/>
@endif
@if(!isset($seo) && $setting->google_index == 1 )
    <meta name="robots" content="{{ $setting->google_index == 1 ? "index" : "noindex"}}">
@endif
@if(isset($seo))
    @if($setting->google_index != 0)
        <meta name="robots" content="{{ $seo->google_index == 1 ? "index" : "noindex"}}">
    @else
        <meta name="robots" content="noindex">
    @endif
<meta name="description" content="{{ $seo->description }}"/>
<link rel="canonical" href="{{ url($seo->canonical) }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url($seo->slug) }}">
<meta property="og:title" content="{{ $seo->title }}">
<meta property="og:description" content="{{ $seo->description }}">
<meta property="og:image" content="{{ $seo->thumb ? url($seo->thumb) : "" }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url($seo->slug) }}">
<meta property="twitter:title" content="{{ $seo->title }}">
<meta property="twitter:description" content="{{ $seo->description }}">
<meta property="twitter:image" content="{{ $seo->thumb ? url($seo->thumb) : "" }}">
@endif

<link rel="stylesheet" href="{{ asset('component/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('component/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('component/FontAwesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('component/css/client/main.css') }}">
{{--Preload Font--}}
<link rel="preload" as="font" href="{{ asset('component/font/Radnika-Regular.woff2') }}" type="font/woff2" crossorigin>
<link rel="preload" as="font" href="{{ asset('component/font/Radnika-Bold.woff2') }}" type="font/woff2" crossorigin>
<link rel="preload" as="font" href="{{ asset('component/font/NeueEinstellung-Regular.woff2') }}" type="font/woff2"
      crossorigin>
<link rel="preload" as="font" href="{{ asset('component/font/NeueEinstellung-Bold.woff2') }}" type="font/woff2"
      crossorigin>
<style id="ggimex-styles-inline-css">
    @font-face {
        font-family: Radnika;
        font-display: swap;
        font-style: normal;
        font-weight: 500;
        src: url("{{ asset('component/font/Radnika-Regular.eot') }}");
        src: url("{{ asset('component/font/Radnika-Regular.eot') }}") format("embedded-opentype"),
        url("{{ asset('component/font/Radnika-Regular.woff2') }}") format("woff2"),
        url("{{ asset('component/font/Radnika-Regular.woff') }}") format("woff")
    }

    @font-face {
        font-family: Radnika;
        font-display: swap;
        font-style: normal;
        font-weight: 700;
        src: url("{{ asset('component/font/Radnika-Bold.eot') }}");
        src: url("{{ asset('component/font/Radnika-Bold.eot?#iefix') }}") format("embedded-opentype"),
        url("{{ asset('component/font/Radnika-Bold.woff2') }}") format("woff2"),
        url("{{ asset('component/font/Radnika-Bold.woff') }}") format("woff")
    }

    @font-face {
        font-family: NeueEinstellung;
        font-display: swap;
        font-style: normal;
        font-weight: 500;
        src: url("{{ asset('component/font/NeueEinstellung-Regular.eot') }}");
        src: url("{{ asset('component/font/NeueEinstellung-Regular.eot?#iefix') }}") format("embedded-opentype"),
        url("{{asset('component/font/NeueEinstellung-Regular.woff2')}}") format("woff2"),
        url("{{ asset('component/font/NeueEinstellung-Regular.woff') }}") format("woff")
    }

    @font-face {
        font-family: NeueEinstellung;
        font-display: swap;
        font-style: normal;
        font-weight: 700;
        src: url("{{ asset('component/font/NeueEinstellung-Bold.eot') }}");
        src: url("{{ asset('component/font/NeueEinstellung-Bold.eot?#iefix') }}") format("embedded-opentype"),
        url("{{ asset('component/font/NeueEinstellung-Bold.woff2') }}") format("woff2"),
        url("{{ asset('component/font/NeueEinstellung-Bold.woff') }}") format("woff")
    }
</style>

<link rel="stylesheet" href="{{ asset('/component/plugins/sweetalert2/sweetalert2.css') }}">
<link rel="dns-prefetch" href="google.com" />
@if($header_script->count())
    @foreach($header_script as $item)
        {!! $item->widget_code !!}
    @endforeach
@endif