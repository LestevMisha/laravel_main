

<div class="flex v1 v1_v1">
    <div class="form-wrapper">
        <h1>Регистрация Карты</h1>
        <x-modern-loader />

        <form wire:submit.default="saveCC" class="modern-form">
            @csrf
            <div class="flex v w100">
                <x-modern-input attr="card_name" title="Имя на карте" />
                <x-modern-input attr="card_number" title="Номер банковской карты" />
                <x-modern-input-date attr="expiration" title="Срок действия" />
                <x-modern-input attr="cvc" title="CVV/CVC" />
                <x-modern-error />
                <button class="go-button v1">Получить реферальную ссылку</button>
            </div>
        </form>
    </div>
    
</div>
