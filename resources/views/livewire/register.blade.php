<div>
    @include('templates.header')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Зарегистрироваться</div>
                <div class="card-body">
                    <form wire:submit="store">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name">Ваше Имя</label>
                            <input wire:model.blur="name" type="text" class="form-control" value="{{ old('name') }}">
                            <div class="form-text">
                                <span class="text-danger">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        {{-- E-mail --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail Адрес</label>
                            <input wire:model.blur="email" type="email" class="form-control"
                                value="{{ old('email') }}">
                            <div class="form-text">
                                <span class="text-danger">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        {{-- Telegram Username --}}
                        <div class="mb-3">
                            <label for="telegram_username" class="form-label">Телеграм Никнейм</label>
                            <input wire:model.blur="telegram_username" type="text" class="form-control"
                                value="{{ old('telegram_username') }}">
                            <div class="form-text">
                                Введите ваш точный телеграм никнейм <b>без @ знака</b>
                                <span class="text-danger">
                                    @error('telegram_username')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password">Пароль</label>
                            <input wire:model="password" type="password" class="form-control">
                            <div class="form-text">
                                <span class="text-danger">
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation">Подтвердите Пароль</label>
                            <input wire:model.blur="password_confirmation" type="password" class="form-control">
                        </div>
                        <div class="mb-3"
                            style="display: flex;
                        justify-content: center;
                        gap: 1em;
                        align-items: center;">
                            <input type="submit" class="col-md-3 btn btn-primary" value="Зарегистрироваться">
                            <a href="{{ route('login') }}">Логин</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
