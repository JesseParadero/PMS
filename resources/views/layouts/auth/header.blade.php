<div class="preloader flex-column justify-content-center align-items-center">
    <img src="{{ rspr::vers('images/common/logo.svg') }}" alt="{{ config('app.name') }}" class="animation__shake" height="60" width="60" />
    <span class="brand-text font-weignt-bold text-blue">{{ config('app.name') }}</span>
</div>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="nav-link" data-widget="pushmenu" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
                {{-- \Auth::user()->name --}}
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{-- \Auth::user()->email --}}</span>
                <div class="dropdown-divider"></div>
                <a href="{{-- route('user.profile') --}}" class="dropdown-item">
                    <i class="fas fa-id-card mr-2"></i> {{ __('words.Profile') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{-- route('logout') --}}" class="dropdown-item dropdown-footer">
                    <i class="fas fa-power-off text-red"></i> <strong>{{ __('words.Logout') }}</strong>
                </a>
            </div>
        </li>
    </ul>
</nav>