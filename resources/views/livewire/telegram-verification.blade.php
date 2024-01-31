<div>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

        <main class="px-3">
            <h1>Проверьте свой Телеграм</h1>
            <p class="lead">
                <b>Перед тем как закончить регистрацию напишите любое слово нашему боту</b>
                <i>
                    <b>
                        <a href="https://t.me/marathon_test13_bot" style="text-decoration: none;">@marathon_test13_bot</a>
                    </b>
                </i>
            </p>
            <p class="lead" style="font-size: 1em;">
                Если вы ввели неверный <i>Телеграм Никнейм</i> при регистрации, бот напишет ошибку. В таком
                случае начните <a href=" {{ route('register') }} ">регистрацию</a> заново и введите правильный
                <i>Телеграм Никнейм</i>. В случае если вы <u>хотите войти в существующий аккаунт</u> перейдите в <a href=" {{ route('register') }} ">регистрацию</a>, и от туда перейдите в Логин (Войти) панель.
            </p>
            <div class="text-danger lead mb-3" style="font-size: 1em;"><b>Внимание!</b> Нажимая на <u>регистрацию</u> вы теряете весь
                прогресс! Вернуться обратно уже будет невозможно.</div>

            <button onclick="document.location.href='https://t.me/marathon_test13_bot'"
                class="btn btn-primary">Написать</button>
        </main>
    </div>
</div>
