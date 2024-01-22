<div>
    @include('templates.header')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email Address</div>
                <div class="card-body">
                    <div>
                        Перед тем как закончить регистрацию напишите любое слово нашему боту
                        <i>
                            <b>
                                <a href="https://t.me/marathon_test13_bot"
                                    style="text-decoration: none;">@marathon_test13_bot</a>
                            </b>
                        </i>
                    </div>
                    <br />
                    <ul>
                        <li>
                            Мы хотим быть уверены, что вы все ввели все правильно. Если никнейм соответствует аккаунту с
                            которого вы пишете боту - вы получите ссылку на ваш личный кабинет.
                        </li>
                        <li>
                            Если вы ввели неверный <i>Телеграм Никнейм</i> при регистрации, бот напишет <q>К сожалению,
                                предоставленный вами <i>Телеграм Никнейм</i> не соответствует аккаунту..</q>. В таком
                            случае
                            начните <a href=" {{ route('register') }} ">регистрацию</a> заново и введите правильный
                            <i>Телеграм Никнейм</i>.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
