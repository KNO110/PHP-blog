<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ url('/') }}">
            <strong>Blog</strong>
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasic">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasic" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ url('/') }}">
                Головна
            </a>
            <!-- Додайте інші пункти меню за потреби -->
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    {{--                    @auth
                                            <a href="{{ route('dashboard') }}" class="button is-primary">
                                                Кабінет
                                            </a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="button is-light">
                                                    Вийти
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="button is-primary">
                                                Увійти
                                            </a>
                                            <a href="{{ route('register') }}" class="button is-light">
                                                Реєстрація
                                            </a>
                                        @endauth--}}
                </div>
            </div>
        </div>
    </div>
</nav>
