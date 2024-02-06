<main class="form-signin w-100 m-auto">
    <form wire:submit="auth">
        @csrf
        <img class="mb-4 b-img" src="/images/logo.png" alt="">
        <h1 class="h3 mb-3 fw-normal">Пожалуйста войдите</h1>

        <div class="form-floating">
            <input wire:model.blur="email" name="pemail" type="email" class="form-control" id="floatingInput"
                placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">E-mail Адрес</label>
        </div>
        <div class="form-floating">
            <input wire:model.blur="password" name="epassword" type="password" class="form-control"
                id="floatingPassword" placeholder="Password">
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

    {{-- for password.reset route (if password was updated successfully show the message) --}}
    <div class="form-text">
        <div class="text-success">
            @if (session()->has('success'))
                {{ session('success') }}
            @endif
        </div>
    </div>

    <div class="form-check text-start mt-3">
        <input wire:model="remember" class="form-check-input" type="checkbox" value="remember-me"
            id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Запомнить меня
        </label>
    </div>

    <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Войти</button>
    <div class="vblock vblock_align">
        <div class="hblock hblock_align hblock_gap">
            <p class="mt-5 mb-3 text-body-secondary">© 2017–2024</p>
            <a class="mt-5 mb-3 text-body-secondary" href="{{ route('register') }}">Зарегистрироваться</a>
        </div>
        <a href="{{ route('password.forgot') }}">Забыл Пароль</a>
    </div>

</form>
</main>
