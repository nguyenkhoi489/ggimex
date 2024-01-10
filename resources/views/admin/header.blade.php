<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }}</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('component/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('component/dist/css/adminlte.min.css') }}">

<link rel="stylesheet" href="{{ asset('component/css/main.css') }}">

<link rel="stylesheet" href="{{ asset('/component/plugins/sweetalert2/sweetalert2.css') }}">

<meta name="robots" content="noindex">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    .sweet_loader {
        width: 140px;
        height: 140px;
        margin: 0 auto;
        animation-duration: 0.5s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        animation-name: ro;
        transform-origin: 50% 50%;
        transform: rotate(0) translate(0,0);
    }
    @keyframes ro {
        100% {
            transform: rotate(-360deg) translate(0,0);
        }
    }
</style>
