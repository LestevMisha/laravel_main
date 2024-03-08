{{-- <div>

    @if (Auth::check() && Auth::user()->telegram_id !== null)
        <div class="container">
            <header
                class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom sticky-top">
                <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"
                    style="width: fit-content;">
                    <img class="fs-4" style="width: 2em; height: 2em;" src="{{ url('images/logo.png') }}" alt="">
                </a>

                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('main') }}"
                            class="nav-link px-2 {{ request()->is('/') ? '' : 'link-dark' }}">Главная</a></li>

                    <li><a href="{{ route('dashboard') }}"
                            class="nav-link px-2 {{ request()->is('dashboard') ? '' : 'link-dark' }}">Профиль</a></li>
                    <li>
                        <form class="d-inline" method="POST" action="{{ route('payment.monthly') }}">
                            @csrf
                            <button onclick="$(this).addClass('text-muted disabled');" type="submit"
                                class="nav-link px-2 link-dark">Оплатить Февраль</button>
                        </form>
                    </li>

                    <li><a href="{{ route('support') }}"
                            class="nav-link px-2 {{ request()->is('support') ? '' : 'link-dark' }}">Поддержка</a></li>
                    <li><a href="{{ route('documents') }}"
                            class="nav-link px-2 {{ request()->is('documents') ? '' : 'link-dark' }}">Документы</a></li>
                    <li>
                        <form class="d-inline" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link px-2 link-dark">Выйти</button>
                        </form>
                    </li>

                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="https://github.com/twbs" target="_blank"
                                rel="noopener">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="https://twitter.com/getbootstrap"
                                target="_blank" rel="noopener">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </ul>
            </header>
        </div>
    @else
        <div class="container">
            <header
                class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom sticky-top">
                <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"
                    style="width: fit-content;">
                    <img class="fs-4" style="width: 2em; height: 2em;" src="{{ url('images/logo.png') }}"
                        alt="">
                </a>

                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('main') }}"
                            class="nav-link px-2 {{ request()->is('/') ? '' : 'link-dark' }}">Главная</a></li>
                    <li><a href="{{ route('support') }}"
                            class="nav-link px-2 {{ request()->is('support') ? '' : 'link-dark' }}">Поддержка</a></li>
                    <li><a href="{{ route('documents') }}"
                            class="nav-link px-2 {{ request()->is('documents') ? '' : 'link-dark' }}">Документы</a>
                    </li>

                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="https://github.com/twbs" target="_blank"
                                rel="noopener">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="https://twitter.com/getbootstrap"
                                target="_blank" rel="noopener">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </ul>

                <div class="col-md-3 text-end">
                    <button onclick="document.location.href = '{{ route('login') }}'" type="button"
                        class="btn me-2 {{ request()->is('login') ? 'btn-primary' : 'btn-outline-primary' }}">Войти</button>
                    <button onclick="document.location.href = '{{ route('register') }}'" type="button"
                        class="btn {{ request()->is('register') ? 'btn-primary' : 'btn-outline-primary' }}">Зарегистрироваться</button>
                </div>
            </header>
        </div>
    @endif


    <div class="container">


        <div class="vblock vblock_gap_1em">
            <div class="container_v-1">
                <div class="vblock vblock_gap_1em">
                    <div class="vblock">
                        <div class="hblock">
                            <div class="vr me-2"></div>
                            <div class="me-2">{{ Auth::user()->telegram_username }}</div>
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="#0ebc6b" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <small> <b> Telegram верефицирован </b> </small>
                        </div>
                    </div>

                    @if (Auth::user()->email_verified_at === null)
                        <div class="vblock vblock_v-1">
                            <div class="hblock">
                                <div class="me-2">E-mail:</div>
                                <div>{{ Auth::user()->email }}</div>
                            </div>
                            <a class="btn btn-primary" href="{{ route('email.verify') }}">Верефицировать E-mail</a>
                        </div>
                    @else
                        <div class="vblock">
                            <div class="hblock">
                                <div class="vr me-2"></div>
                                <div class="me-2">{{ Auth::user()->email }}</div>
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="#0ebc6b" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                                <small> <b> E-mail верефицирован </b> </small>
                            </div>
                        </div>
                    @endif


                    @if (Auth::user()->days_left === 0)
                        <form class="d-inline" method="POST" action="{{ route('payment.monthly') }}">
                            @csrf
                            <button onclick="$(this).addClass('text-muted disabled');" type="submit"
                                class="btn btn-outline-primary">Получить доступ в клуб</button>
                        </form>
                    @else
                        <div class="hblock">
                            <div class="vr me-2"></div>
                            <div class="me-2">Оставшиеся дни:</div>
                            <div>{{ Auth::user()->days_left }} дней</div>
                        </div>

                        <div class="hblock">
                            <div class="vr me-2"></div>
                            <div class="me-2">Закрытый клуб: </div>
                            <a href="https://t.me/+U86N3fnqA7wzM2Vl">https://t.me/+U86N3fnqA7wzM2Vl</a>
                        </div>
                    @endif

                    <div class="vblock vblock_gap_0.5em">
                        @if (Auth::user()->days_left !== 0)
                            <div class="vblock vblock_gap_0.5em">
                                @if ($this->hasCardVerification())
                                    <div class="hblock">
                                        <div class="vr me-2"></div>
                                        <div class="me-2 text-muted">Реферальная ссылка</div>
                                    </div>
                                    <div class="input-group mb-1">
                                        <input id="copyTarget" type="text" class="form-control"
                                            value="{{ url('/') . '/payment/referral?referral_id=' . Auth::user()->referral_id }}">

                                        <button id="copyButton" class="btn btn-outline-primary"
                                            style="border-radius: 0 var(--bs-border-radius) var(--bs-border-radius) 0;"
                                            type="button">Скопировать</button>

                                        <span class="copied">Copied !</span>
                                    </div>
                                @else
                                    <!-- Button trigger modal -->
                                    <button wire:click="setModal(1)" type="button" class="btn btn-outline-primary"
                                        data-bs-toggle="modal" data-bs-target="#modal">Стать Партнером</button>

                                    <!-- Modal -->
                                    <div class="modal fade {{ $isModalOpened === 1 ? 'show' : '' }}"
                                        aria-modal="{{ $isModalOpened === 1 ? 'true' : '' }}"
                                        role="{{ $isModalOpened === 1 ? 'dialog' : '' }}" id="modal"
                                        tabindex="-1" aria-labelledby="modalLabel"
                                        aria-hidden="{{ $isModalOpened === 1 ? '' : 'true' }}"
                                        data-bs-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Способ Оплаты</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form wire:submit="saveCC">
                                                        @csrf
                                                        <div style="width: 100%" class="mb-4">
                                                            <label for="cc-name" class="form-label">Имя на
                                                                карте</label>
                                                            <input wire:model="card_name" type="text"
                                                                class="form-control" id="cc-name">
                                                            @if ($errors->has('card_name'))
                                                                @error('card_name')
                                                                    <small class="text-danger">
                                                                        {{ $message }}</small>
                                                                @enderror
                                                            @else
                                                                <small class="text-muted">Полное имя, указанное на
                                                                    карте.</small>
                                                            @endif
                                                        </div>

                                                        <div style="width: 100%" class="mb-4">
                                                            <label for="cc-number" class="form-label">Номер банковской
                                                                карты</label>
                                                            <input wire:model="card_number" type="text"
                                                                class="form-control" id="cc-number"
                                                                placeholder="0000 0000 0000 0000">
                                                            @if ($errors->has('card_number'))
                                                                @error('card_number')
                                                                    <small class="text-danger">
                                                                        {{ $message }}</small>
                                                                @enderror
                                                            @endif
                                                        </div>

                                                        <div class="row gy-3 mb-4">
                                                            <div class="col-md-6">
                                                                <label for="cc-expiration" class="form-label">Срок
                                                                    действия</label>
                                                                <input wire:model="expiration" type="text"
                                                                    class="form-control date" id="cc-expiration"
                                                                    placeholder="mm/YYYY">
                                                                @if ($errors->has('expiration_month'))
                                                                    @error('expiration_month')
                                                                        <small class="text-danger">
                                                                            {{ $message }}</small>
                                                                    @enderror
                                                                @endif
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="cc-cvv" class="form-label">CVV /
                                                                    CVC</label>
                                                                <input wire:model="cvc" type="password"
                                                                    class="form-control" id="cc-cvv"
                                                                    placeholder="123" maxlength="3">
                                                                @if ($errors->has('cvc'))
                                                                    @error('cvc')
                                                                        <small class="text-danger">
                                                                            {{ $message }}</small>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                            <small class="text-muted">Если вы укажите неверные данные
                                                                мы не
                                                                сможем
                                                                отправить
                                                                вам
                                                                деньги.</small>
                                                        </div>

                                                        <button class="btn btn-primary w-100 py-2"
                                                            type="submit">Получить
                                                            реферальную ссылку</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if (Auth::user()->days_left !== 0)
            <hr class="bg-danger border-2 border-top border" style="margin-top: 5em;" />
            <ul class="nav nav-underline">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $currentTab ? '' : 'active' }}" id="simple-tab-0" data-bs-toggle="tab"
                        href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0"
                        aria-selected="true">Мои
                        транзакции</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $currentTab ? 'active' : '' }}" id="simple-tab-1" data-bs-toggle="tab"
                        href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1"
                        aria-selected="false">Реферальные транзакции</a>
                </li>
            </ul>
            <div class="tab-content pt-3" id="tab-content">
                <div wire:click="setCurrentTab(0)" class="tab-pane {{ $currentTab ? '' : 'active show' }}"
                    id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                    <div class="table-responsive">
                        <table class="table mb-4 transactions-table">
                            <thead>
                                <tr>
                                    <th scope="col">Всего<br>
                                        <span class="fw-normal">{{ $this->getUsersTransactionsCount() }}
                                            {{ $this->getUsersTransactionsCount() === 1 ? 'транзакция' : 'транзакций' }}</span>
                                    </th>
                                    <th scope="col">ID<br>
                                        <span class="fw-normal">транзакции</span>
                                    </th>
                                    <th scope="col">Имя<br>
                                        <span class="fw-normal">пользователя</span>
                                    </th>
                                    <th scope="col">
                                        Сумма<br>
                                        <span class="fw-normal">к оплате</span>
                                    </th>
                                    <th scope="col">Описание<br>
                                        <span class="fw-normal">платяжа</span>
                                    </th>
                                    <th scope="col">
                                        Cтатус<br>
                                        <span class="fw-normal">транзакции</span>
                                    </th>
                                    <th scope="col">Время<br>
                                        <span class="fw-normal">оплаты</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody wire:init="loadUTs">
                                @foreach ($users_transactions as $key => $transaction)
                                    <tr wire:key="{{ $loop->index }}">
                                        <th class="text-nowrap" scope="row"><code
                                                class="fw-normal">{{ $key + 1 }}
                                            </code>
                                        </th>
                                        <td>{{ $transaction->yookassa_transaction_id }}</td>
                                        <td><code>{{ auth()->user()->where('telegram_id', $transaction->telegram_id)->first()->telegram_username }}</code>
                                        </td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td
                                            class="{{ $transaction->status === 'succeeded' ? 'text-success' : ($transaction->status === 'pending' ? 'text-warning' : 'text-danger') }}">
                                            {{ $transaction->status }}</td>
                                        <td>{{ $transaction->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($this->getUsersTransactionsCount() > 5)
                        <button wire:click="loadMoreUTs" class="btn btn-primary" style="width: 100%;">Загрузить еще
                            5</button>
                    @endif
                </div>

                <div wire:click="setCurrentTab(1)" class="tab-pane {{ $currentTab ? 'active show' : '' }}"
                    id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">

                    <div class="table-responsive">
                        <table class="table mb-4 transactions-table">
                            <thead>
                                <tr>
                                    <th scope="col">Всего<br>
                                        <span class="fw-normal">{{ $this->getUsersTransactionsCount(true) }}
                                            {{ $this->getUsersTransactionsCount(true) === 1 ? 'транзакция' : 'транзакций' }}</span>
                                    </th>
                                    <th scope="col">ID<br>
                                        <span class="fw-normal">транзакции</span>
                                    </th>
                                    <th scope="col">Имя<br>
                                        <span class="fw-normal">пользователя</span>
                                    </th>
                                    <th scope="col">
                                        Сумма<br>
                                        <span class="fw-normal">к оплате</span>
                                    </th>
                                    <th scope="col">Описание<br>
                                        <span class="fw-normal">платяжа</span>
                                    </th>
                                    <th scope="col">
                                        Cтатус<br>
                                        <span class="fw-normal">транзакции</span>
                                    </th>
                                    <th scope="col">Время<br>
                                        <span class="fw-normal">оплаты</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody wire:init="loadURTs">
                                @foreach ($users_referral_transactions as $key => $transaction)
                                    <tr wire:key="{{ $loop->index }}">
                                        <th class="text-nowrap" scope="row"><code
                                                class="fw-normal">{{ $key + 1 }}
                                            </code>
                                        </th>
                                        <td>{{ $transaction->yookassa_transaction_id }}</td>
                                        <td><code>{{ auth()->user()->where('telegram_id', $transaction->telegram_id)->first()->telegram_username }}</code>
                                        </td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td
                                            class="{{ $transaction->status === 'succeeded' ? 'text-success' : ($transaction->status === 'pending' ? 'text-warning' : 'text-danger') }}">
                                            {{ $transaction->status }}</td>
                                        <td>{{ $transaction->updated_at }}</td>
                                    </tr>
                                @endforeach
                                @if (empty($users_referral_transactions))
                                    <tr>
                                        <td>Пока что пусто..</td>
                                        <td>_</td>
                                        <td>_</td>
                                        <td>_</td>
                                        <td>_</td>
                                        <td>_</td>
                                        <td>_</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($this->getUsersTransactionsCount(true) > 5)
                        <button wire:click="loadMoreURTs" class="btn btn-primary" style="width: 100%;">Загрузить еще
                            5</button>
                    @endif
                </div>
            </div>
        @endif

    </div>


</div> --}}
{{-- <x-modern-side-menu /> --}}


<section class="b-section b-section_v4">
    <div class="container container_v2">
        <div class="flex v gap_05 mb-2 mt-2 ml-2">

            @if ($this->hasCardVerification())
                <div class="flex h v2 v2_2 gap">
                    <div class="b-text">Реферальная ссылка: </div>
                    <?php $url = url('/') . '?referral_id=' . Auth::user()->referral_id; ?>
                    <a href="{{ $url }}">{{ $url }}</a>
                </div>
            @else
                <div class="flex v flex v3 mb-1" onclick="window.location.href='{{ route('card-credentials') }}';">
                    <div class="flex v gap_05">
                        <div class="b-text b-text_2em">Даем возможность стать партнером</div>
                        <div class="b-text b-text_grey">Если вы становитесь партнером мы перечисляем вам 50% от цены
                            клуба<br>с каждого
                            нового пользователя приглашенного вами.<br> + Каждый месяц 50% с продления</div>
                        <a href="{{ route('card-credentials') }}" class="go-button v3 mt-1">Стать партнером</a>
                    </div>
                    <img src="{{ URL::asset('images/dollar-coin-3d.png') }}" alt="dollar-coin-3d"
                        class="b-img b-img_v10">
                </div>
            @endif

            <div class="flex gap_05 h">
                <div class="flex h v2 v2_1 gap">
                    <div class="b-text">Закрытый клуб START: </div>
                    <a href="https://t.me/+U86N3fnqA7wzM2Vl">https://t.me/+U86N3fnqA7wzM2Vl</a>
                </div>

                <div class="flex h v2 v2_1 gap">
                    <div class="b-text">Оставшиеся дни:</div>
                    <div class="b-text b-text_green">{{ Auth::user()->days_left }} дней</div>
                </div>
            </div>


        </div>

    </div>
</section>
