<aside class="main-sidebar elevation-4 bg-white">
    <a href="{{-- route('dashboard.index') --}}" class="brand-link" style="margin-left: 40px;">
        <img src="{{ rspr::vers('images/common/pms_logo.png') }}" alt="{{ config('app.name') }}" class="brand-image" />
        <span class="brand-text font-weight-bold text-blue">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('language.index') }}"
                        class="nav-link{{ request()->routeIs(['language.index', 'language.edit']) ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt half"></i>
                        <p>Manage Language</p>
                    </a>
                    <a href="{{ route('evaluation.index') }}"
                        class="nav-link{{ rspr::isRoute('evaluation.index') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Evaluation Record</p>
                    </a>
                    <a href="{{ route('rating.index') }}"
                        class="nav-link{{ rspr::isRoute('rating.index') ? ' active' : '' }}">
                        <i class="fa fa-star"></i>
                        <p>Development Rating</p>
                    </a>
                    <a href="{{ route('development.index') }}"
                        class="nav-link{{ rspr::isRoute('development.index') ? ' active' : '' }}">
                        <i class="fa fa-asterisk"></i>
                        <p>Development Criteria</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
