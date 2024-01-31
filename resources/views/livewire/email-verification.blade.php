<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">

            <div class="card-header">Verify Your Email Address</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения. Если вы не
                получили электронное письмо,
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">нажмите здесь, чтобы запросить
                        другой.</button>
                </form>
                <a href="https://mail.google.com/" target="_blank">Перейти в Gmail</a>
            </div>
        </div>
    </div>
</div>
