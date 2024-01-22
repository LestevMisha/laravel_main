<div>
    @include('templates.header')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form wire:submit="auth">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail Адрес</label>
                            <input wire:model.blur="email" type="email" class="form-control"
                                value="{{ old('email') }}">
                            <div class="form-text">
                                Мы никогда не передадим ваш email кому-либо.
                                <span class="text-danger">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input wire:model.blur="password" type="password" class="form-control">
                            <div id="passwordHelp" class="form-text">
                                Мы никогда не передадим ваш пароль кому-либо.
                                <span class="text-danger">
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="mb-3"
                            style="display: flex;
                    justify-content: center;
                    gap: 1em;
                    align-items: center;">
                            <input type="submit" class="col-md-3 btn btn-primary" value="Логин">
                            <a href="{{ route('register') }}">Зарегистрироваться</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
