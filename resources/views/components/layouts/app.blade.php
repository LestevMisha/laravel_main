<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'КЛУБ START' }}</title>

    <!-- +++++++++++ CDNs +++++++++++ -->
    {{-- slick slider --}}
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- +++++++++++ PROJECT CSS +++++++++++ -->
    <link href="{{ secure_asset('styles/different-components.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('styles/main.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('styles/index.css') }}" rel="stylesheet">
    {{-- custom modern --}}
    <link href="{{ secure_asset('styles/modern.css') }}" rel="stylesheet">
    {{-- slick slider --}}
    <link href="{{ secure_asset('styles/slick-slider.css') }}" rel="stylesheet">

</head>

<body>

    {{-- Admin --}}
    {{-- @if (Auth::guard('admin')->check())
        @include('templates.header_admin')
        <div class="container my-5">
            {{ $slot }}
        </div>
    @else
        @include('templates.header')
        <div class="container my-5">
            {{ $slot }}
        </div>
    @endif --}}
    {{-- @include('templates.footer') --}}

    {{ $slot }}

    <!-- +++++++++++ CDNs +++++++++++ -->
    {{-- jQuery/Mask jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    {{--  slick slider  --}}
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <!-- +++++++++++ PROJECT JAVASCRIPT +++++++++++ -->
    {{-- clipboard copy --}}
    <script src="{{ secure_asset('javascript/general.js') }}"></script>
    {{-- custom modern --}}
    <script src="{{ secure_asset('javascript/modern.js') }}"></script>
    {{-- slick slider --}}
    <script src="{{ URL::asset('javascript/slick-slider.js') }}"></script>
</body>

</html>
