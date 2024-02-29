<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Клуб Start' }}</title>

    {{-- custom modern --}}
    <link href="{{ secure_asset('styles/main.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('styles/modern.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('styles/different-components.css') }}" rel="stylesheet">
</head>

<body>
    <div class="flex w100 h100">
        <x-modern-header />
        {{ $slot }}        
    </div>


    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- custom modern --}}
    <script src="{{ secure_asset('javascript/modern.js') }}"></script>
</body>

</html>
