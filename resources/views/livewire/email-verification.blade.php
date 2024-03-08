{{-- <div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">

            <div class="card-header">Верификация Почты</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                Прежде чем запросить код, проверьте свою электронную почту на наличие ссылки для подтверждения. Ссылка
                высылается с момента регистрации.
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                        Отправить верефикацию
                    </button>
                </form>
                <a class="text-15px mt-1" href="https://mail.ru/" target="_blank">Перейти в Mail.ru</a>
            </div>
        </div>
    </div>
</div> --}}

<div class="flex v1">
    <div class="form-wrapper">
        <h1>Верификация Почты</h1>
        <x-modern-loader />

        <form action="{{ route('verification.resend') }}" method="POST" class="modern-form">
            @csrf
            <div class="flex v gap w100">

                <button class="go-button v1">Отправить верефикацию</button>

                @if ($message = Session::get('success'))
                    <div class="b-text text-success">
                        {{ $message }}
                    </div>
                @endif

                <div class="b-text b-text_08 b-text_grey-dark">
                    Прежде чем запросить код, проверьте свою электронную почту на наличие ссылки для подтверждения.
                    Ссылка высылается с момента регистрации.
                </div>
                <a class="text-15px" href="https://mail.ru/" target="_blank">Перейти в Mail.ru</a>
            </div>
        </form>

    </div>
</div>
