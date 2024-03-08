<div class="flex v1">
    <div class="form-wrapper">
        <h1>Забыли Пароль?</h1>
        <x-modern-loader />

        <form wire:submit.default="sendResetLink" class="modern-form">
            @csrf
            <div class="flex v w100">
                <x-modern-input attr="email" title="Email Адрес" />
                <div>
                    <x-modern-error />
                </div>

                <button id="timed_button" class="go-button v1" {{ $disabled ? 'disabled' : '' }}
                    wire:loading.attr="disabled">Отправить
                    Письмо</button>



                @if (session()->has('success'))
                    <div class="b-text b-text_green mt-1">
                        {{ session('success') }}
                    </div>
                    <div id="timer_wrapper" class="b-text b-text_grey b-text_08 {{ $disabled ? 'active' : '' }} mt-05">
                        Следующий код:
                        <span id="counter"></span>
                    </div>
                @elseif (session()->has('failure'))
                    <div class="text-error more mt-1">
                        {{ session('failure') }}
                    </div>
                @else
                    <div class="text-15px text-grey mt-1">Введите адрес электронной почты привязанный к аккаунту. Мы
                        вышлем письмо
                        о смене пароля.</div>
                @endif



                <a class="text-15px mt-1" href="https://mail.ru/" target="_blank">Перейти в Mail.ru</a>
            </div>
        </form>

    </div>

    <script>
        const btn = document.getElementById("timed_button");

        document.addEventListener("DOMContentLoaded", function() {
            Livewire.hook('morph.updated', ({
                el
            }) => {
                if (el === btn) {
                    if (el.disabled) {
                        var count = 60,
                            timer = setInterval(function() {
                                $("#counter").html(`${count--} секунд`);
                                if (count == 0) {
                                    @this.call('resetDisabled');
                                    clearInterval(timer);
                                };
                            }, 1000);
                    }
                }
            })
        })
    </script>

</div>


{{-- 
<main class="form-signin w-100 m-auto">
    <form wire:submit="sendResetLink">
        @csrf
        <div class="form-floating">
            <input wire:model.blur="email" name="field" type="text" class="form-control" id="email"
                placeholder="email">
            <label for="email">Ваше E-mail</label>
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

        <div class="form-text">
            <div class="text-success">
                @if (session()->has('success'))
                    {{ session('success') }}
                @endif
            </div>
            <div class="text-danger">
                @if (session()->has('failure'))
                    {{ session('failure') }}
                @endif
            </div>
        </div>



        <button id="submit_btn" class="btn btn-primary w-100 py-2 my-2" type="submit"
            {{ $disabled ? 'disabled' : '' }} wire:loading.attr="disabled">Отправить
            Письмо</button>
        <a href="https://mail.google.com/" target="_blank">Перейти в Gmail</a>

        <p id="timer_wrapper" class="{{ $disabled ? 'active' : '' }}">Следующий код:
            <span id="timer">60 секунд</span>
        </p>
</form>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const button = document.getElementById("submit_btn");
        const timer = document.getElementById("timer");
        const timer_wrapper = document.getElementById("timer_wrapper");
        var seconds = 60;
        var isClicked = 0;

        button.addEventListener("click", function() {
            if (!isClicked) {
                function updateTimer() {
                    timer.textContent = `${seconds} сек`;
                    seconds--;
                    if (seconds === 0) {
                        @this.call('resetDisabled');
                        clearInterval(timerInterval);
                        isClicked = 0;
                    }
                }

                // Call the function every second
                var timerInterval = setInterval(updateTimer, 1000);
            }

            isClicked = 1;
        });
    });
</script>
</main> --}}
