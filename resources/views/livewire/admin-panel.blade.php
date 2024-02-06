<div>
    <h3>Все транзакции Закрытого Клуба</h3>
    <p>
        Вся <code>информация</code> является конфиденциальной.
    </p>
    <table class="table mb-4 transactions-table">
        <thead>
            <tr>
                <th scope="col">Всего<br>
                    <span class="fw-normal">{{ count($users_transactions) }}
                        {{ count($users_transactions) === 1 ? 'транзакция' : 'транзакций' }}</span>
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
                    <span class="fw-normal">создания</span>
                </th>
                <th scope="col">Реферальная<br>
                    <span class="fw-normal">оплата</span>
                </th>
                <th scope="col">Время<br>
                    <span class="fw-normal">последнего изменения</span>
                </th>
                <th scope="col">Уникальный ID<br>
                    <span class="fw-normal">транзакции</span>
                </th>
                <th scope="col">E-mail<br>
                    <span class="fw-normal">пользователя</span>
                </th>
                <th scope="col">Телеграм<br>
                    <span class="fw-normal">ID</span>
                </th>
                <th scope="col">Телеграм<br>
                    <span class="fw-normal">пользователя</span>
                </th>
                <th scope="col">ЮКасса<br>
                    <span class="fw-normal">ID</span>
                </th>
                <th scope="col">IP<br>
                    <span class="fw-normal">пользователя</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users_transactions as $key => $transaction)
                <tr wire:key="{{ $loop->index }}">
                    <th><code>{{ $transaction->id }}</code></th>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td
                        class="{{ $transaction->status === 'succeeded' ? 'text-success' : ($transaction->status === 'pending' ? 'text-warning' : 'text-danger') }}">
                        {{ $transaction->status }}</td>
                    <td>{{ $this->getTimeMsc($transaction->created_at) }}</td>
                    <td>{{ $transaction->referral_id !== '' ? $transaction->referral_id : '-' }}</td>
                    <td>{{ $this->getTimeMsc($transaction->updated_at) }}</td>
                    <td>{{ $transaction->uuid }}</td>
                    <td>{{ $transaction->email }}</td>
                    <td><code>{{ $transaction->telegram_id }}</code></td>
                    <td>{{ $users->where('telegram_id', $transaction->telegram_id)->first()->telegram_username }}</td>
                    <td>{{ $transaction->yookassa_transaction_id }}</td>
                    <td>{{ $transaction->ip }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Все пользователи<br>Закрытого Клуба</h3>
    <p>
        Вся <code>информация</code> пользователя с момента создания и регистрации.<br>
        Использовать только в целях экстренной необходимости!
    </p>
    <table class="table mb-4 users-table">
        <thead>
            <tr>
                <th scope="col">Всего<br>
                    <span class="fw-normal">{{ count($users) }}
                        {{ count($users) === 1 ? 'пользователь' : 'пользователя' }}</span>
                </th>
                <th scope="col">Реферальная<br>
                    <span class="fw-normal">ссылка</span>
                </th>
                <th scope="col">Имя<br>
                    <span class="fw-normal">пользователя</span>
                </th>
                <th scope="col">E-mail<br>
                    <span class="fw-normal">пользователя</span>
                </th>
                <th scope="col">Телеграм<br>
                    <span class="fw-normal">пользователя</span>
                </th>
                <th scope="col">Телеграм ID<br>
                    <span class="fw-normal">пользователя</span>
                </th>
                <th scope="col">Время<br>
                    <span class="fw-normal">создания</span>
                </th>
                <th scope="col">Время<br>
                    <span class="fw-normal">последнего изменения</span>
                </th>
                <th scope="col">Уникальный ID<br>
                    <span class="fw-normal">пользователя</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr wire:key="{{ $loop->index }}">
                    <th><code>{{ $user->id }}</code></th>
                    <td><code>{{ $user->referral_id }}</code></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telegram_username }}</td>
                    <td><code>{{ $user->telegram_id }}</code></td>
                    <td>{{ $this->getTimeMsc($user->created_at) }}</td>
                    <td>{{ $this->getTimeMsc($user->updated_at) }}</td>
                    <td><code>{{ $user->uuid }}</code></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
