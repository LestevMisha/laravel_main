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
                                    role="{{ $isModalOpened === 1 ? 'dialog' : '' }}" id="modal" tabindex="-1"
                                    aria-labelledby="modalLabel" aria-hidden="{{ $isModalOpened === 1 ? '' : 'true' }}"
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
                                                        <label for="cc-name" class="form-label">Имя на карте</label>
                                                        <input wire:model="card_name" type="text"
                                                            class="form-control" id="cc-name">
                                                        @if ($errors->has('card_name'))
                                                            @error('card_name')
                                                                <small class="text-danger"> {{ $message }}</small>
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
                                                                <small class="text-danger"> {{ $message }}</small>
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
                                                            <label for="cc-cvv" class="form-label">CVV / CVC</label>
                                                            <input wire:model="cvc" type="password"
                                                                class="form-control" id="cc-cvv" placeholder="123"
                                                                maxlength="3">
                                                            @if ($errors->has('cvc'))
                                                                @error('cvc')
                                                                    <small class="text-danger">
                                                                        {{ $message }}</small>
                                                                @enderror
                                                            @endif
                                                        </div>
                                                        <small class="text-muted">Если вы укажите неверные данные мы не
                                                            сможем
                                                            отправить
                                                            вам
                                                            деньги.</small>
                                                    </div>

                                                    <button class="btn btn-primary w-100 py-2" type="submit">Получить
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
