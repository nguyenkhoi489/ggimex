<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
</head>
<body class="{{ isset($className) ? $className : "" }}">
@if($body_tags->count())
    @foreach($body_tags as $item)
        {!! $item->widget_code !!}
    @endforeach
@endif
@include('block.nav')
@yield('content')
@include('footer')
</body>
</html>
