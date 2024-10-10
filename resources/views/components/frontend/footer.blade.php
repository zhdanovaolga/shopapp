<div class="footer">
    <div class="footer-area">
        <div class="footer-area-content">
            <div class="container">
                <div class="row ">
                    @if (count($menu) > 0)
                    <div class="col-md-3">
                        <div class="menu">
                            <h6>Menu</h6>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->url() == route("frontend.home") }} ? " active" : "" }}" href="{{ route("frontend.home") }}">{{ 'Home' }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->url() == route("frontend.books") }} ? " active" : "" }}" href="{{ route("frontend.books") }}">{{ 'Books' }}</a>
                                </li>
                        </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer-area-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright">
                            <p>{{ $sitesettings->copyright_text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
