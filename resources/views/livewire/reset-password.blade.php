{{-- <main class="form-signin w-100 m-auto">
    <form wire:submit="resetPassword">
        @csrf
        <input wire:model="token" type="text" hidden value="{{ request()?->token }}">

        <div class="form-floating">
            <input wire:model.blur="email" name="field" type="email" class="form-control" id="floatingInput"
                placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">E-mail Адрес</label>
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

    <button class="btn btn-primary w-100 py-2 my-2" type="submit">Изменить пароль</button>
</form>
</main>
 --}}

<div class="flex v1">
    <div class="form-wrapper">
        <h1>Сменить Пароль</h1>
        <x-modern-loader />

        <form wire:submit.default="resetPassword" class="modern-form">
            @csrf
            <div class="flex v w100">
                <x-modern-input attr="email" title="Email Адрес" />
                <x-modern-input attr="password" title="Новый Пароль" />
                <x-modern-input attr="password_confirmation" title="Введите новый пароль еще раз" />
                <x-modern-error />
                <button class="go-button v1">Изменить пароль</button>
                <div class="text-15px text-grey mt-1">
                    Измените пароль от вашего аккаунта, и мы перенаправим вас на страницу Авторизации.
                </div>
            </div>
        </form>

    </div>
</div>
