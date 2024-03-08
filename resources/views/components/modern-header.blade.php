<header class="modern-header">
    <div class="flex h fit align flex_blured">
        <div class="b-text b-text_nowrap text-header">Клуб Start</div>
        <i class="mark-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" id="check-circle">
                <path fill-rule="evenodd"
                    d="M14.72,8.79l-4.29,4.3L8.78,11.44a1,1,0,1,0-1.41,1.41l2.35,2.36a1,1,0,0,0,.71.29,1,1,0,0,0,.7-.29l5-5a1,1,0,0,0,0-1.42A1,1,0,0,0,14.72,8.79ZM12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                    clip-rule="evenodd"></path>
            </svg>
        </i>
    </div>

    <div class="flex h gap fit align flex_blured">
        <a href="{{ route('login') }}" class="b-text">Войти</a>
        <color-scheme-switcher id="lightModeSwitcher" mode="horizontal">
            <div class="flex h100 w100 h space-btw align">
                <svg class="b-img b-img_sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="brightness"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12ZM5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM12,5a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5Zm5.66,2.34a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34Zm-12-.29a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5ZM12,19a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19Z"
                        clip-rule="evenodd">
                    </path>
                </svg>
                <svg class="b-img b-img_moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="moon"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </div>
            <input wire:click="toggle" type="checkbox" {{ $checked ? 'checked' : '' }}>
            <div class="toggle-circle"></div>
        </color-scheme-switcher>

        <a wire:ignore href="{{ route('main') }}" class="cr-button">
            @if (request()->is('/'))
                <i class="reload-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M21,11a1,1,0,0,0-1,1,8.05,8.05,0,1,1-2.22-5.5h-2.4a1,1,0,0,0,0,2h4.53a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4.77A10,10,0,1,0,22,12,1,1,0,0,0,21,11Z"
                            clip-rule="evenodd"></path>
                    </svg>
                </i>
            @else
                <i class="close-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 12 12">
                        <path fill-rule="evenodd"
                            d="M1.707.293A1 1 0 0 0 .293 1.707L4.586 6 .293 10.293a1 1 0 1 0 1.414 1.414L6 7.414l4.293 4.293a1 1 0 0 0 1.414-1.414L7.414 6l4.293-4.293A1 1 0 0 0 10.293.293L6 4.586 1.707.293Z"
                            clip-rule="evenodd"></path>
                    </svg>
                </i>
            @endif
        </a>
    </div>
</header>