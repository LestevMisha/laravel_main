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
    <link href="{{ secure_asset('styles/light-mode.css') }}" rel="stylesheet">
    {{-- slick slider --}}
    <link href="{{ secure_asset('styles/slick-slider.css') }}" rel="stylesheet">
    {{-- glitch effect --}}
    <link href="{{ secure_asset('styles/glitch.css') }}" rel="stylesheet">
    {{-- accordion --}}
    <link href="{{ secure_asset('styles/accordion.css') }}" rel="stylesheet">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    {{--  slick slider  --}}
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    {{-- Three js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r126/three.min.js"
        integrity="sha512-n8IpKWzDnBOcBhRlHirMZOUvEq2bLRMuJGjuVqbzUJwtTsgwOgK5aS0c1JA647XWYfqvXve8k3PtZdzpipFjgg=="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/controls/OrbitControls.js"></script>

    {{-- post-rendering --}}
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/EffectComposer.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/ShaderPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/RenderPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/OutputPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/FilmPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/GlitchPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/UnrealBloomPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/DotScreenPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/BloomPass.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/postprocessing/FilmPass.js"></script>

    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/ConvolutionShader.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/FilmShader.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/DigitalGlitch.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/CopyShader.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/SobelOperatorShader.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/LuminosityHighPassShader.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/LuminosityShader.js"></script>
    <script src="https://unpkg.com/three@0.126.0/examples/js/shaders/ColorifyShader.js"></script>


    <!-- +++++++++++ PROJECT JAVASCRIPT +++++++++++ -->
    <script src="{{ secure_asset('javascript/light-mode.js') }}"></script>
    {{-- clipboard copy --}}
    <script src="{{ secure_asset('javascript/general.js') }}"></script>
    {{-- custom modern --}}
    <script src="{{ secure_asset('javascript/modern.js') }}"></script>
    {{-- slick slider --}}
    <script src="{{ URL::asset('javascript/slick-slider.js') }}"></script>
    {{-- Three js --}}
    <script src="{{ URL::asset('javascript/3D/NikeAirMag.js') }}"></script>
    <script src="{{ URL::asset('javascript/3D/SneakersOnBox.js') }}"></script>
    {{-- Accordion --}}
    <script src="{{ URL::asset('javascript/accordion.js') }}"></script>


</body>

</html>
