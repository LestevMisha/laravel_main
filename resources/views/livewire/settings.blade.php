<section class="b-section b-section_v4">
    <div class="container container_v2">
        <div class="flex v gap_05 mb-2 mt-2 ml-2">

            @if (Auth::user()->hasVerifiedEmail())
                <div class="flex h v2 v2_3 gap">
                    <div class="b-text b-text_nowrap"><span class="b-text b-text_blue">{{ Auth::user()->name }}</span>
                        ваша почта <span class="b-text b-text_green">верефицирована</span></div>
                    <svg class="b-img b-img_v10 b-img_v10_v2" xmlns="http://www.w3.org/2000/svg" version="1.2"
                        viewBox="0 0 180 175" fill="currentColor">
                        <g id="Layer">
                            <path id="Layer" fill-rule="evenodd" class="s0"
                                d="m147.2 19.2c8.1 7.4 23.9 31.7 28.5 43.6 12.6 31.8-3.4 72.6-37.1 95.1-15.9 10.7-30.7 15.9-48.4 17.1-16.4 1.2-28.2-1-41.7-7.6-13-6.4-22.7-16.5-34-35.4-14.1-23.8-17.4-40.1-12.1-60.6 8.6-32.6 36.7-59.6 71.4-68.7 26.2-6.9 54.9-0.3 73.4 16.5zm-67.3-12.4c-23.4 4.3-46.7 19.1-59.2 37.9-7.6 11.4-10.2 16.9-13.3 28.9-4.3 16.5-2.1 31 8.1 50.3 2.8 5.1 5 10.3 5 11.5 0 3.1 13.4 12.2 24.1 16.3 12.7 5 39.4 5.4 53.3 0.7 18.5-6.2 29.8-13.2 43.2-26.6 19.5-19.5 29.3-43.4 26.5-64.8-0.8-7.4-2.9-11.5-11.1-22.7-12.1-16.5-20.2-23.6-32.6-28.2-10.6-4-31.5-5.5-44-3.3zm88.6 78c-11.9 46.6-62 80.9-108.1 74-6-1-11.2-1.2-11.5-0.5-0.7 1.2 10 7 17.2 9.5 1.7 0.5 9.6 1 17.6 1 30.2 0 59.5-15.2 75.5-39.1 9.6-14.3 13.3-24.4 14.1-38.7 0.9-15.7-1.5-18.8-4.8-6.2z" />
                            <path id="Layer" fill-rule="evenodd" class="s0"
                                d="m127.7 24.7c17.4 11.6 24.6 25.8 24.3 47.7-0.4 16.4-8.8 33.6-23.1 46.8-11.2 10.5-19.8 15.7-32.9 19.5-39 11.7-76.2-10.2-80-47.2-3.3-31.8 22.7-65.6 57.8-74.7 20.7-5.3 38.1-2.9 53.9 7.9zm-31.3-5.1c-44.6-2.8-84.9 41.6-73.3 81 3.8 13.5 18 28.3 31.6 32.7 14.3 4.7 35.7 3.1 50.1-3.6 30-14.1 47.4-45.1 40.5-71.8-4.5-17-14-27.8-30.8-34.7-3.7-1.6-11.7-3.1-18.1-3.6z" />
                            <path id="Layer" fill-rule="evenodd" class="s0"
                                d="m118.8 51.4c2.7 3.1 10.5 14.3 9.9 14.5-0.3 0.3-16.8 11.2-36.6 24.2-26.9 17.8-36.3 23.3-37.4 21.5-0.7-1.3-5.5-8.9-10.6-16.8l-9.5-14.6 9.3-5.9c5.2-3.3 9.6-5.7 10-5.3 0.3 0.3 2.6 4.3 5.1 8.7 2.8 4.7 5.4 8.3 5.9 8.3 0.7-0.2 12.9-8.1 27-17.9 14.3-9.8 26.2-17.2 26.9-16.7zm-0.7 9c-1.6-1.2-7.4 1.9-20.9 10.6-10.1 6.9-21.6 14.3-25.6 16.6l-6.9 3.9-6.7-7c-7.4-7.8-8.3-8.1-11.4-5-3.2 3.2-2.5 6.2 3.7 14.8 2.9 4.3 6 8.6 6.5 9.4 1.4 2.1 8.1-1.5 26.7-14.3 8.4-5.8 19.8-13.4 25.1-16.8 5.3-3.5 10.2-7.3 10.7-8.5 0.5-1-0.2-2.7-1.2-3.7z" />
                        </g>
                    </svg>
                </div>
            @else
                <div class="flex v flex v3 mb-1" onclick="window.location.href='{{ route('email.verify') }}';">
                    <div class="flex v gap_05">
                        <div class="b-text b-text_2em">Хотите использовать функции на полную?</div>
                        <div class="b-text b-text_grey">Верефицируйте почту. Это поможет вам в дальнейшей работе по
                            клубу.<br> + Быстрая восстановка аккаунта в случае неполадок</div>
                        <a href="{{ route('email.verify') }}" class="go-button v3 mt-1">Верефицируйте почту</a>
                    </div>

                    <svg class="b-img b-img_v10 b-img_v10_v1" xmlns="http://www.w3.org/2000/svg" version="1.2"
                        viewBox="0 0 104 104" fill="currentColor">
                        <g id="Layer">
                            <path id="Layer" fill-rule="evenodd" class="s0"
                                d="m94 25.3c7 9.8 9.5 17.8 9.5 29.7-0.1 12.6-2.3 18.2-11.6 28.9-13 15-21.3 19.4-36.4 19.4-15.5 0-28.1-5.8-39.8-18.2-11.3-12-17.1-28.3-14.9-41.8 1.7-10.3 5.1-16.2 15.1-26.6 9.8-10.2 16.1-14 25.3-15.6 19-3.3 40.4 6.5 52.8 24.2zm-62.1-18.5c-1.5 0.6-5.5 3.6-8.9 6.6-3.4 3.1-6.6 5.6-7.1 5.6-1.6 0-4.8 7.8-5.8 14.2-1.3 7.6-0.1 16.4 3.3 24.8 5.9 14.6 18.6 26.6 34.5 32.8 5.4 2.1 8.4 2.5 16.6 2.6 8.8 0.1 10.7-0.2 15.7-2.6 3.1-1.4 6.2-3.7 6.9-5 0.6-1.2 2.9-4.4 5-6.9 6.9-8.3 9.8-19.4 8-30.7-3-18.4-18.4-36.2-36.8-42.4-9.7-3.3-21.8-2.9-31.4 1zm-26.9 33.7c-1.7 6-0.8 17.3 1.9 24.6 7.8 20.7 30.7 36.2 50.8 34.5 4.1-0.3 8.4-1.1 9.6-1.8 2-1.1 1.3-1.3-5.3-2-23.9-2.2-44.2-18.4-51.9-41.3-1.1-3.4-2.1-8.4-2.2-11.3-0.3-7.2-1.4-8.2-2.9-2.7z" />
                            <path id="Layer" fill-rule="evenodd" class="s0"
                                d="m53 9.3c9.3 0.5 14.8 2.4 22.8 7.9 21.3 14.4 26.2 42.8 10.2 58.8-6.2 6.2-11.2 8.3-21 8.8-9.7 0.5-18.2-1.8-25.4-6.8-21.6-14.8-27.6-39.9-14-57.7 3.1-4 5.6-5.8 13.1-8.9 5-2.2 6.9-2.4 14.3-2.1zm-13.7 4.7c-12.8 5.1-20 18.8-17.3 33 5.4 28.8 40.8 45.1 60.4 27.9 7.4-6.5 9.1-10.6 9.1-21.9 0-8.6-0.3-10.1-3.2-16.3-4.1-8.7-12-16.5-20.9-20.8-8.9-4.2-20.3-5-28.1-1.9z" />
                            <path id="Layer" fill-rule="evenodd" class="s0"
                                d="m61 26.1l5 3.1c2.7 1.7 5 3.5 5 4 0 0.6-1.6 3.8-3.6 7.3l-3.5 6.4 7.9 5.3 7.9 5.2-2.6 4.3c-1.4 2.3-2.9 4.3-3.3 4.3-0.5 0-3.9-2.2-7.8-5l-6.9-4.9-3.7 6.7c-2.1 3.7-3.8 6.8-3.9 7-0.2 0.2-7.9-4.6-10.4-6.4-0.2-0.2 1.5-3.4 3.7-7.3l4-7-15.8-10.4 2.2-3.6c1.1-2 2.5-4 2.9-4.4 0.4-0.5 4.1 1.4 8.3 4.2 6.8 4.6 7.7 5 8.4 3.4 0.4-1 2-4.1 3.5-7zm-1 8.9c-1.3 3.2-5.4 7-7.4 7-0.6 0-3.6-1.6-6.5-3.5-8.5-5.6-11.4-2.8-3.1 3 2.4 1.7 5.2 4.3 6.3 5.8l2.1 2.7-2.9 6.1c-2.5 5.1-2.7 6.2-1.5 6.9 2.5 1.6 3.9 1.1 5.4-1.8 4.2-7.9 7-8.5 15.1-3.1 4.3 2.9 6.5 3.1 6.5 0.6 0-0.7-1.3-2.1-3-3-9.2-5.5-10.6-8.7-7-15.7 2.4-4.7 2.5-6.6 0.4-7.4-2.6-1-3.1-0.7-4.4 2.4z" />
                        </g>
                    </svg>
                </div>
            @endif

            <div class="flex gap_05 h">

                <div class="flex h v2 v2_1 gap_05">
                    <div class="b-text">Изменить пароль</div>
                    <div class="b-text b-text_08 b-text_grey">Изменение пароля происходит в 2 этапа: <br>1 этап -
                        Введите почту и отправьте код<br>2 этап - Перейдите по ссылке указаной в почте и измените
                        пароль.</div>
                    <a href="{{ route('password.forgot') }}" class="go-button v4">Изменить пароль</a>
                </div>

                <div class="flex h v2 v2_1 gap_05">
                    <div class="b-text">Изменить E-mail адрес</div>
                    <div class="b-text b-text_08 b-text_grey">Изменение почты можно осуществить только имея доступ к
                        телеграм аккаунту. Ни
                        какой другой аккаунт не может быть импользован, бот просто не ответит.</div>
                    <a href="{{ route('password.forgot') }}" class="go-button v4">Изменить Почту</a>
                </div>
            </div>

            <div class="flex h v2 v2_1 gap_05">
                <div class="b-text">Хотите удалить аккаунт?</div>
                <div class="b-text b-text_08 b-text_grey">Удалить аккаунт на стороне сайта не возможно, это сделано
                    с целью предостережения пользователя от возможности потерять подписку. Удалить аккаунт возможно
                    только при личном обрщении в <a href="{{ route('support') }}">поддержку</a>.</div>
            </div>

        </div>

    </div>
</section>
