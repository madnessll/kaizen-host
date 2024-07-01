<header class="header">
    <div class="header__container">
        <div class="header__wrapper">
            <h1 class="header__name">
                <a href="{{ route('main_page') }}" class="header__link">Kaizen</a>
            </h1>
            <div class="header__right">
                <div class="header__btns">
                    @auth
                        <div class="header__user">
                            <span class="header__user-name">{{ Auth::user()->name }}</span>
                            <a href="{{ route('logout') }}" class="header__btn"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Выйти
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="header__btn">Войти</a>
                        <a href="{{ route('register') }}" class="header__btn">Зарегистрироваться</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
