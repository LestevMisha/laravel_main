<div class="flex v1">
    <div class="form-wrapper">

        <h1>Регистрация в КЛУБ START</h1>
        <x-modern-loader />

        <form wire:submit.default="nextStep" class="modern-form">
            @csrf
            <div class="flex static v w100">
                @if ($currentStep >= 0)
                    <x-modern-input displayed="{{ $currentStep > 0 ? 'none' : 'block' }}" attr="name"
                        title="Ваше Имя" />
                    @if ($currentStep >= 1)
                        <button type="button" wire:click="previousStep" class="previous-step-button">
                            <x-svg-gradient class="previous-step-icon" svg="PreviousStepArrow" />
                        </button>
                        <x-modern-input displayed="{{ $currentStep > 1 ? 'none' : 'block' }}" attr="email"
                            title="Email Адрес" />
                        @if ($currentStep >= 2)
                            <button type="button" wire:click="previousStep" class="previous-step-button">
                                <x-svg-gradient class="previous-step-icon" svg="PreviousStepArrow" />
                            </button>
                            <x-modern-input attr="password" title="Пароль" />
                            <x-modern-input attr="password_confirmation" title="Введите пароль еще раз" />
                            <button type="submit" class="go-button v1">Зарегистрироваться</button>
                        @endif
                    @endif
                @endif
                <x-modern-error />
            </div>
            @if ($currentStep < 2)
                <button type="submit" class="modern-button">
                    <x-svg class="modern-next" svg="NextArrow" />
                </button>
            @endif
        </form>
    </div>
</div>
