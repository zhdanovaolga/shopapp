<header class="header navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <div class="header-area">
            <div class="logo">
                <a href="{{ route("frontend.home") }}">
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_light) }}" alt="{{ $sitesettings->site_title }}" class="logo-dark"/>
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_dark) }}" alt="{{ $sitesettings->site_title }}" class="logo-white"/>
                </a>
            </div>
            <div class="header-navbar">
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->url() == route("frontend.home") }} ? " active" : "" }}" href="{{ route("frontend.home") }}">{{ 'Home' }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->url() == route("frontend.books") }} ? " active" : "" }}" href="{{ route("frontend.books") }}">{{ 'Books' }}</a>
                                </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="header-right">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round ">
                            <i class="lar la-sun icon-light"></i>
                            <i class="lar la-moon icon-dark"></i>
                        </span>
                    </label>
                </div>
                <div class="search-icon">
                    <i class="las la-search"></i>
                </div>
                @auth
                @if(Auth::user()->role == ROLE_ADMIN)
                <div class="botton-sub">
                    <a href="{{ route("dashboard.home") }}" class="btn-subscribe">Dashboard</a>
                </div>
                @else
                <div class="botton-sub">
                    <a  onclick="document.getElementById('logout').submit()">
                        <form method="POST" class="btn-subscribe" id="logout" action="{{ route("auth.logout") }}">
                            @csrf
                            Log Out
                        </form>
                    </a>
                </div>
                @endif

                @else
                <div class="botton-sub">
                    <a href="{{ route("auth.login") }}" class="btn-subscribe">Log In</a>
                </div>
                @endauth

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>
