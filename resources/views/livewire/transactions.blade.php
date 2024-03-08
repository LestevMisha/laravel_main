<section class="b-section">
    <div class="container">
        <div class="table-responsive">
            <table class="table mb-4 transactions-table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="b-text" scope="col">ID<br>
                            <span class="fw-normal">транзакции</span>
                        </th>
                        <th class="b-text" scope="col">Имя<br>
                            <span class="fw-normal">пользователя</span>
                        </th>
                        <th class="b-text" scope="col">
                            Сумма<br>
                            <span class="fw-normal">к оплате</span>
                        </th>
                        <th class="b-text" scope="col">Описание<br>
                            <span class="fw-normal">платяжа</span>
                        </th>
                        <th class="b-text" scope="col">
                            Cтатус<br>
                            <span class="fw-normal">транзакции</span>
                        </th>
                        <th class="b-text" scope="col">Время<br>
                            <span class="fw-normal">оплаты</span>
                        </th>
                    </tr>
                </thead>
                <tbody wire:init="loadUTs">
                    @foreach ($users_transactions as $key => $transaction)
                        <tr wire:key="{{ $loop->index }}">
                            <th class="b-text" scope="row"><code class="fw-normal">{{ $key + 1 }}
                                </code>
                            </th>
                            <td class="b-text">{{ $transaction->yookassa_transaction_id }}</td>
                            <td class="b-text">
                                {{ auth()->user()->where('telegram_id', $transaction->telegram_id)->first()->telegram_username }}
                            </td class="b-text">
                            <td class="b-text">{{ $transaction->amount }}</td>
                            <td class="b-text">{{ $transaction->description }}</td>
                            <td
                                class="{{ $transaction->status === 'succeeded' ? 'text-success' : ($transaction->status === 'pending' ? 'text-warning' : 'text-danger') }}">
                                {{ $transaction->status }}</td>
                            <td class="b-text">{{ $transaction->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($this->getUTCount() > 5)
            <button wire:click="loadMoreUTs" class="btn btn-primary" style="width: 100%;">Загрузить еще
                5</button>
        @endif

</section>
