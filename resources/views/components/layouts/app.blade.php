<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'КЛУБ START' }}</title>

    <!-- +++++++++++ PROJECT CSS +++++++++++ -->
    <link href="{{ secure_asset('styles/different-components.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ secure_asset('styles/main.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ secure_asset('styles/light-mode.css') }}" type="text/css" rel="stylesheet">
    {{-- slick slider --}}
    <link href="{{ secure_asset('styles/slick-slider.css') }}" type="text/css" rel="stylesheet">
    {{-- glitch effect --}}
    <link href="{{ secure_asset('styles/glitch.css') }}" type="text/css" rel="stylesheet">
    {{-- accordion --}}
    <link href="{{ secure_asset('styles/accordion.css') }}" type="text/css" rel="stylesheet">

    <!-- +++++++++++ CDNs +++++++++++ -->
    {{-- slick slider --}}
    <link defer rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

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

    {{-- <div id="scene"></div> --}}
    <div class="flex w100 h100">
        <livewire:light-mode-on menu_type="top" />
        {{ $slot }}
    </div>

    <!-- +++++++++++ CDNs +++++++++++ -->
    {{-- jQuery/Mask jQuery --}}
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    {{--  slick slider  --}}
    <script defer type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- +++++++++++ PROJECT JAVASCRIPT +++++++++++ -->
    <script src="{{ secure_asset('javascript/light-mode.js') }}"></script>
    {{-- clipboard copy --}}
    <script src="{{ secure_asset('javascript/general.js') }}"></script>
    {{-- custom modern --}}
    <script src="{{ secure_asset('javascript/modern.js') }}"></script>
    {{-- slick slider --}}
    <script src="{{ URL::asset('javascript/slick-slider.js') }}"></script>
    {{-- Three js --}}
    <script type="importmap">
        {
          "imports": {
            "three": "./javascript/3D/three.js/build/three.module.js"
          }
        }
    </script>
    <script type="module" src="{{ URL::asset('javascript/3D/NikeAirMag.js') }}"></script>
    <script src="{{ URL::asset('javascript/3D/SneakersOnBox.js') }}"></script>
    {{-- Accordion --}}
    <script src="{{ URL::asset('javascript/accordion.js') }}"></script>
    <!-- Fix jQuery [Violation] non-passive event (support https://github.com/ignasdamunskis/passive-events-support) -->
    <script>
        window.passiveSupport = {
            events: ['touchstart', 'touchmove']
        }
    </script>
    <script type="module" src="{{ URL::asset('javascript/passive-events-support/dist/main.js') }}"></script>

</body>

</html>
