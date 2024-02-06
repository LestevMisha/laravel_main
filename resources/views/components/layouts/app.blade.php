<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ secure_asset('table-responsive.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('signin.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('cover.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('docs.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('features.css') }}" rel="stylesheet">
    <title>{{ $title ?? 'Marathon' }}</title>
    @livewireStyles
    @livewireScripts
</head>

<body>
    {{-- Admin --}}
    @if (Auth::guard('admin')->check())
        @include('templates.header_admin')
        <div class="container my-5">
            {{ $slot }}
        </div>
    @else
        {{-- User --}}
        @include('templates.header')
        <div class="container my-5">
            {{ $slot }}
        </div>
    @endif
    @include('templates.footer')
    <script src="{{ secure_asset('general.js') }}"></script>
</body>

</html>
