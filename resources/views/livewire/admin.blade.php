<main class="form-signin w-100 m-auto">
    <form wire:submit="auth_admin">
        @csrf
        <img class="mb-4 b-img" src="/images/logo.png" alt="">
        <h1 class="h3 mb-3 fw-normal">Пожалуйста войдите</h1>

        <div class="form-floating">
            <input wire:model.blur="telegram_profile" name="pemail" type="text" class="form-control"
                id="floatingInput" placeholder="telegram_profile">
            <label for="floatingInput">Telegram профиль</label>
        </div>
        <div class="form-floating">
            <input wire:model.blur="password" name="epassword" type="password" class="form-control"
                id="floatingPassword" placeholder="password">
            <label for="floatingPassword">Пароль</label>
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
    <button class="btn btn-primary w-100 py-2" type="submit">Войти</button>
</form>
</main>
