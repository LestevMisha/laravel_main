<div>
    @include('templates.header')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <ul>
                        <li>
                            Days left:
                            <code> {{ Auth::user()->days_left }} days</code>
                        </li>
                        <li>
                            Name:
                            <code> {{ Auth::user()->name }} </code>
                        </li>
                        <li>
                            Email:
                            <code> {{ Auth::user()->email }} </code>
                        </li>
                        <li>
                            Telegram ID:
                            <code> {{ Auth::user()->telegram_id }} </code>
                        </li>
                        <li>
                            Referral url:
                            <a target="_blank"
                                href="{{ url('/') . '/referral_payment?referral_id=' . Auth::user()->referral_id }}">
                                <code> {{ url('/') . '/referral_payment?referral_id=' . Auth::user()->referral_id }}
                                </code>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
