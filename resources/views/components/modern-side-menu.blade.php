<div wire:ignore class="side-container">
    <div class="flex h my-1">
        <div class="b-text b-text_nowrap text-header">Клуб Start</div>
        <i class="mark-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" id="check-circle">
                <path fill-rule="evenodd"
                    d="M14.72,8.79l-4.29,4.3L8.78,11.44a1,1,0,1,0-1.41,1.41l2.35,2.36a1,1,0,0,0,.71.29,1,1,0,0,0,.7-.29l5-5a1,1,0,0,0,0-1.42A1,1,0,0,0,14.72,8.79ZM12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                    clip-rule="evenodd"></path>
            </svg>
        </i>
    </div>

    <a class="flex h align fit gap" href="{{ route('dashboard') }}">
        <i class="item-icon {{ request()->is('dashboard') ? 'is-active-icon' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z">
                </path>
            </svg>
        </i>
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('dashboard') ? 'b-text_blue' : '' }}">Дашборд
        </div>
    </a>
    
    <a class="flex h align fit gap" href="{{ route('profile') }}">
        @if ($image)
            <img class="item-icon item-icon_v1" src="data:image/png;base64,{{ $image }}" alt="Image">
        @else
            <i class="item-icon {{ request()->is('profile') ? 'is-active-icon' : '' }}">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12,2A10,10,0,0,0,4.65,18.76h0a10,10,0,0,0,14.7,0h0A10,10,0,0,0,12,2Zm0,18a8,8,0,0,1-5.55-2.25,6,6,0,0,1,11.1,0A8,8,0,0,1,12,20ZM10,10a2,2,0,1,1,2,2A2,2,0,0,1,10,10Zm8.91,6A8,8,0,0,0,15,12.62a4,4,0,1,0-6,0A8,8,0,0,0,5.09,16,7.92,7.92,0,0,1,4,12a8,8,0,0,1,16,0A7.92,7.92,0,0,1,18.91,16Z">
                    </path>
                </svg>
            </i>
        @endif
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('profile') ? 'b-text_blue' : '' }}">Профиль
        </div>
    </a>

    <a class="flex h align fit gap" href="{{ route('transactions') }}">
        <i class="item-icon {{ request()->is('transactions') ? 'is-active-icon' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M20 2H10a3 3 0 0 0-3 3v7a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3Zm1 10a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1Zm-3.5-4a1.49 1.49 0 0 0-1 .39 1.5 1.5 0 1 0 0 2.22 1.5 1.5 0 1 0 1-2.61ZM16 17a1 1 0 0 0-1 1v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-4h1a1 1 0 0 0 0-2H3v-1a1 1 0 0 1 1-1 1 1 0 0 0 0-2 3 3 0 0 0-3 3v7a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-1a1 1 0 0 0-1-1ZM6 18h1a1 1 0 0 0 0-2H6a1 1 0 0 0 0 2Z">
                </path>
            </svg>
        </i>
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('transactions') ? 'b-text_blue' : '' }}">
            Мои Транзакции
        </div>
    </a>

    <a class="flex h align fit gap" href="{{ route('referral.transactions') }}">
        <i class="item-icon {{ request()->is('referral-transactions') ? 'is-active-icon' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10,17.55,8.23,19.27a2.47,2.47,0,0,1-3.5-3.5l4.54-4.55a2.46,2.46,0,0,1,3.39-.09l.12.1a1,1,0,0,0,1.4-1.43A2.75,2.75,0,0,0,14,9.59a4.46,4.46,0,0,0-6.09.22L3.31,14.36a4.48,4.48,0,0,0,6.33,6.33L11.37,19A1,1,0,0,0,10,17.55ZM20.69,3.31a4.49,4.49,0,0,0-6.33,0L12.63,5A1,1,0,0,0,14,6.45l1.73-1.72a2.47,2.47,0,0,1,3.5,3.5l-4.54,4.55a2.46,2.46,0,0,1-3.39.09l-.12-.1a1,1,0,0,0-1.4,1.43,2.75,2.75,0,0,0,.23.21,4.47,4.47,0,0,0,6.09-.22l4.55-4.55A4.49,4.49,0,0,0,20.69,3.31Z">
                </path>
            </svg>
        </i>
        <div
            class="b-text b-text_grey b-text_hovered {{ request()->is('referral-transactions') ? 'b-text_blue' : '' }}">
            Реф. Транзакции
        </div>
    </a>

    <a class="flex h align fit gap" href="{{ route('settings') }}">
        <i class="item-icon {{ request()->is('settings') ? 'is-active-icon' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9-1.28 2.22-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24-1.3-2.21.8-.9a3 3 0 0 0 0-4l-.8-.9 1.28-2.2 1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24 1.28 2.22-.8.9a3 3 0 0 0 0 3.98Zm-6.77-6a4 4 0 1 0 4 4 4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2Z">
                </path>
            </svg>
        </i>
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('settings') ? 'b-text_blue' : '' }}">
            Настройки</div>
    </a>

    <div class="item-divider"></div>

    <form id="logout" class="d-inline flex h align fit gap" method="POST" action="{{ route('logout') }}">
        @csrf
        <i onclick="document.getElementById('logout').submit()"
            class="item-icon {{ request()->is('login') ? 'is-active-icon' : '' }} pointer">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z">
                </path>
            </svg>
        </i>
        <button type="submit" class="b-text b-text_grey b-text_hovered">Выйти</button>
    </form>


    <div class="item-divider"></div>

    <div class="b-text b-text_transparent-hover">Страницы Сайта</div>

    <a class="flex h align fit gap" href="{{ route('main') }}">
        <i class="item-icon {{ request()->is('main') ? 'is-active-icon' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10,5a1,1,0,1,0,1,1A1,1,0,0,0,10,5ZM6,5A1,1,0,1,0,7,6,1,1,0,0,0,6,5Zm8,0a1,1,0,1,0,1,1A1,1,0,0,0,14,5Zm6-4H4A3,3,0,0,0,1,4V20a3,3,0,0,0,3,3H20a3,3,0,0,0,3-3V4A3,3,0,0,0,20,1Zm1,19a1,1,0,0,1-1,1H4a1,1,0,0,1-1-1V11H21ZM21,9H3V4A1,1,0,0,1,4,3H20a1,1,0,0,1,1,1Z">
                </path>
            </svg>
        </i>
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('main') ? 'b-text_blue' : '' }}">
            Главная</div>
    </a>

    <a class="flex h align fit gap" href="{{ route('support') }}">
        <i class="item-icon {{ request()->is('support') ? 'is-active-icon' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.29,15.29a1.58,1.58,0,0,0-.12.15.76.76,0,0,0-.09.18.64.64,0,0,0-.06.18,1.36,1.36,0,0,0,0,.2.84.84,0,0,0,.08.38.9.9,0,0,0,.54.54.94.94,0,0,0,.76,0,.9.9,0,0,0,.54-.54A1,1,0,0,0,13,16a1,1,0,0,0-.29-.71A1,1,0,0,0,11.29,15.29ZM12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20ZM12,7A3,3,0,0,0,9.4,8.5a1,1,0,1,0,1.73,1A1,1,0,0,1,12,9a1,1,0,0,1,0,2,1,1,0,0,0-1,1v1a1,1,0,0,0,2,0v-.18A3,3,0,0,0,12,7Z">
                </path>
            </svg>
        </i>
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('support') ? 'b-text_blue' : '' }}">
            Поддержка</div>
    </a>

    <a class="flex h align fit gap" href="{{ route('documents') }}">
        <i class="item-icon {{ request()->is('documents') ? 'is-active-icon' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.5,10h1a1,1,0,0,0,0-2h-1a1,1,0,0,0,0,2Zm4,6h-4a1,1,0,0,0,0,2h4a1,1,0,0,0,0-2Zm0-4h-4a1,1,0,0,0,0,2h4a1,1,0,0,0,0-2Zm6.92-2.62a1,1,0,0,0-.21-1.09l-6-6h0a1.07,1.07,0,0,0-.28-.19.32.32,0,0,0-.09,0L11.56,2H5.5a3,3,0,0,0-3,3V19a3,3,0,0,0,3,3h6a1,1,0,0,0,0-2h-6a1,1,0,0,1-1-1V5a1,1,0,0,1,1-1h5V7a3,3,0,0,0,3,3h4A1,1,0,0,0,18.42,9.38ZM13.5,8a1,1,0,0,1-1-1V5.41L15.09,8Zm7,4h-5a1,1,0,0,0-1,1v8a1,1,0,0,0,.53.88,1,1,0,0,0,1-.05L18,20.53,20,21.83A1,1,0,0,0,21.5,21V13A1,1,0,0,0,20.5,12Zm-1,7.12-.94-.63a1,1,0,0,0-1.12,0l-.94.63V14h3Z">
                </path>
            </svg>
        </i>
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('documents') ? 'b-text_blue' : '' }}">
            Документы</div>
    </a>

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
</div>
