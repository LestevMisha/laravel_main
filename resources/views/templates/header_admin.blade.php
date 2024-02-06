<div class="container">
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom sticky-top">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"
            style="width: fit-content;">
            <img class="fs-4" style="width: 2em; height: 2em;" src="{{ url('images/logo.png') }}" alt="">
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('main') }}"
                    class="nav-link px-2 {{ request()->is('/') ? '' : 'link-dark' }}">Главная</a>
            </li>

            <li><a href="{{ route('admin.panel') }}"
                    class="nav-link px-2 {{ request()->is('admin/panel') ? '' : 'link-dark' }}">Админ Панель</a></li>

            <li><a href="{{ route('support') }}"
                    class="nav-link px-2 {{ request()->is('support') ? '' : 'link-dark' }}">Поддержка</a></li>
            <li><a href="{{ route('documents') }}"
                    class="nav-link px-2 {{ request()->is('documents') ? '' : 'link-dark' }}">Документы</a></li>
            <li>
                <form class="d-inline" method="POST" action="{{ route('logout.admin') }}">
                    @csrf
                    <button type="submit" class="nav-link px-2 link-dark">Выйти</button>
                </form>
            </li>
        </ul>
    </header>

</div>
