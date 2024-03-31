<svg {{ $attributes }}>

    {{-- insert element --}}
    <use class="{{ $svg }}" xlink:href="{{ URL::asset('images/svg/sprite.svg#') . $svg }}" />

    {{-- define a gradient or a mask --}}
    @if ($svg === 'GradientArrow')
        <linearGradient id="{{ $svg }}" x1="99.638" y1="-.017" x2="99.638" y2="113.472"
            gradientUnits="userSpaceOnUse">
            <stop stop-color="#0D59FD" />
            <stop offset="1" stop-color="#00FF75" />
        </linearGradient>
    @elseif ($svg === 'GradientArrowVertical')
        <linearGradient id="{{ $svg }}" x1="114.017" y1="99.6376" x2="0.528328" y2="99.6376"
            gradientUnits="userSpaceOnUse">
            <stop stop-color="#0D59FD" />
            <stop offset="1" stop-color="#00FF75" />
        </linearGradient>
    @elseif ($svg === 'PreviousStepArrow')
        <mask id="{{ $svg }}" width="16" height="16" x="4" y="4" maskUnits="userSpaceOnUse"
            style="mask-type:alpha">
            <path fill-rule="evenodd"
                d="M19.7 11.59a1 1 0 0 0-1-1H7.5l4.9-4.9a.99.99 0 1 0-1.4-1.4l-6.593 6.593a1 1 0 0 0 0 1.414L11 18.89a.99.99 0 0 0 1.4-1.4l-4.9-4.9h11.2a1 1 0 0 0 1-1Z"
                clip-rule="evenodd"></path>
        </mask>
    @endif

    {{-- define path to gradient/mask for element --}}
    <style type="text/css">
        use.{{ $svg }} {
            fill: url(#{{ $svg }});
            mask: url(#{{ $svg }});
        }
    </style>

</svg>
