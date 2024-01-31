<main class="form-signin w-100 m-auto">
    <form wire:submit="store">
        @csrf
        <img class="mb-4 b-img" src="/images/logo.png" alt="">
        <h1 class="h3 mb-3 fw-normal">Зарегистрироваться</h1>

        <div class="form-floating">
            <input wire:model.blur="telegram_username" name="field" type="text" class="form-control"
                id="telegram_username" placeholder="telegram_username">
            <label for="telegram_username">Телеграм Ник <b>без @ знака</b></label>
        </div>

        <div class="form-floating">
            <input wire:model.blur="email" name="field" type="email" class="form-control" id="floatingInput"
                placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">E-mail Адрес</label>
        </div>

        <div class="form-floating">
            <input wire:model.blur="name" name="field" type="text" class="form-control" id="name"
                placeholder="name">
            <label for="name">Ваше Имя</label>
        </div>

        <div class="form-floating">
            <input wire:model="password" name="password" type="password" class="form-control" id="floatingPassword"
                placeholder="Password">
            <label for="floatingPassword">Пароль</label>
        </div>
        <div class="form-floating">
            <input wire:model="password_confirmation" name="password_confirmation" type="password" class="form-control"
                id="password_confirmation" placeholder="password_confirmation">
            <label for="password_confirmation">Повтор Пароля</label>
        </div>

        <div class="form-text">
            <div class="text-danger">
                @if ($errors->any())
                    @foreach ($errors->getMessages() as $key => $message)
                        @if ($key === 'server')
                            <div id="summary">
                                <div class="text-danger">
                                    <p class="collapse" id="collapseSummary">
                                        {{ $message[0] }}
                                    </p>
                                </div>
                                <a class="collapsed" data-toggle="collapse" href="#collapseSummary"
                                    aria-expanded="false" aria-controls="collapseSummary">
                                </a>
                            </div>
                        @else
                            {{ $message[0] }}
                        @endif
                    @break
                @endforeach
            @endif
        </div>
    </div>

    <div class="form-check text-start my-3">
        <input wire:model="remember" class="form-check-input" type="checkbox" value="remember-me"
            id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Запомнить меня
        </label>
    </div>

    <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Зарегистрироваться</button>
    <small class="fw-light text-body-secondary">Нажимая кнопку "Зарегистрироваться", вы соглашаетесь
        <a href="{{ route('documents') }}" class="text-reset">с правилами и политикой сайта</a>.
    </small>

    <div style="display: flex; justify-content: center; gap: 1em; align-items: center;">
        <p class="mt-5 mb-3 text-body-secondary">© 2017–2024</p>
        <a class="mt-5 mb-3 text-body-secondary" href="{{ route('login') }}">Войти</a>
    </div>
</form>
</main>
