<div class="flex v1">
    <div class="form-wrapper">
        <h1>Авторизация</h1>
        <x-modern-loader />

        <form wire:submit.default="submit" class="modern-form">
            @csrf
            <div class="flex v w100">
                <x-modern-input attr="email" title="Email Адрес" />
                <x-modern-input attr="password" title="Пароль" />
                <x-modern-error />
                <button class="go-button v1">Войти</button>
                <div class="flex h mt-24px space-btw">
                    <div class="flex h align">
                        <input wire:model="remember" type="checkbox" value="remember-me" id="flexCheckDefault">
                        <label class="text-remember" for="flexCheckDefault">Запомнить меня</label>
                    </div>
                    <a class="text-15px" href="{{ route('password.forgot') }}">Забыли Пароль?</a>
                </div>
                <a class="text-15px mt-05" href="{{ route('register') }}">Регистрация</a>

            </div>
        </form>

    </div>
</div>
