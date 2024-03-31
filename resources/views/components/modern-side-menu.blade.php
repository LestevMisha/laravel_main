<div wire:ignore class="side-container">
    <div class="flex h my-1">
        <div class="b-text b-text_nowrap text-header">Клуб Start</div>
        <x-svg class="mark-icon" svg="CheckCircle" />
    </div>

    <a class="flex h align fit gap" href="{{ route('dashboard') }}">
        <x-svg class="item-icon {{ request()->is('dashboard') ? 'is-active-icon' : '' }}" svg="Home" />
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('dashboard') ? 'b-text_blue' : '' }}">Дашборд
        </div>
    </a>

    <a class="flex h align fit gap" href="{{ route('profile') }}">
        @if ($image)
            <img class="item-icon item-icon_v1" src="data:image/png;base64,{{ $image }}" alt="Image">
        @else
            <x-svg class="item-icon {{ request()->is('profile') ? 'is-active-icon' : '' }}" svg="CircledUser" />
        @endif
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('profile') ? 'b-text_blue' : '' }}">Профиль
        </div>
    </a>

    <a class="flex h align fit gap" href="{{ route('transactions') }}">
        <x-svg class="item-icon {{ request()->is('transactions') ? 'is-active-icon' : '' }}" svg="TwoCards" />
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('transactions') ? 'b-text_blue' : '' }}">
            Мои Транзакции
        </div>
    </a>

    <a class="flex h align fit gap" href="{{ route('referral.transactions') }}">
        <x-svg class="item-icon {{ request()->is('referral-transactions') ? 'is-active-icon' : '' }}" svg="Link" />
        <div
            class="b-text b-text_grey b-text_hovered {{ request()->is('referral-transactions') ? 'b-text_blue' : '' }}">
            Реф. Транзакции</div>
    </a>

    <a class="flex h align fit gap" href="{{ route('settings') }}">
        <x-svg class="item-icon {{ request()->is('settings') ? 'is-active-icon' : '' }}" svg="Gear" />
        <div class="b-text b-text_grey b-text_hovered {{ request()->is('settings') ? 'b-text_blue' : '' }}">
            Настройки</div>
    </a>

    <div class="item-divider"></div>

    <form id="logout" class="d-inline flex h align fit gap" method="POST" action="{{ route('logout') }}">
        @csrf
        <x-svg onclick="document.getElementById('logout').submit()" class="item-icon pointer" svg="Exit" />
        <button type="submit" class="b-text b-text_grey b-text_hovered">Выйти</button>
    </form>

    <div class="item-divider"></div>
    <div class="b-text b-text_transparent-hover">Страницы Сайта</div>

    <a class="flex h align fit gap" href="{{ route('main') }}">
        <x-svg class="item-icon" svg="Tab" />
        <div class="b-text b-text_grey b-text_hovered">Главная</div>
    </a>

    <a class="flex h align fit gap" href="{{ route('support') }}">
        <x-svg class="item-icon" svg="CircledQuestionMark" />
        <div class="b-text b-text_grey b-text_hovered">Поддержка</div>
    </a>

    <a class="flex h align fit gap" href="{{ route('documents') }}">
        <x-svg class="item-icon" svg="FavoriteDocument" />
        <div class="b-text b-text_grey b-text_hovered">Документы</div>
    </a>

    <x-theme-switcher checked="{{$checked}}" />
</div>
