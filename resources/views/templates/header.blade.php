@if (!request()->user()?->is_telegram_id_verified)
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                            href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@else
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a wire:click="access3" class="nav-link" role="button">Access 3K+</a>
                    </li>
                    <li class="nav-item">
                        <a wire:click="logout" class="nav-link" role="button">Logout</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a wire:click="delete" class="nav-link" role="button">Delete Account</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
@endif
