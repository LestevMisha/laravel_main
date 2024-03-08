<div class="table-responsive">
    <table class="table mb-4 transactions-table">
        <thead>
            <tr>
                <th scope="col">
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
                    <th class="text-nowrap" scope="row"><code class="fw-normal">{{ $key + 1 }}
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
@if ($this->getURTCount() > 5)
    <button wire:click="loadMoreURTs" class="btn btn-primary" style="width: 100%;">Загрузить еще
        5</button>
@endif
