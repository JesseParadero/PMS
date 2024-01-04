<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ rspr::vers('images/common/pms_logo.png') }}" alt="{{ config('app.name') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link{{ rspr::isRoute('user.index') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt half"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('employee.index') }}"
                        class="nav-link{{ request()->routeIs(['employee.index', 'evaluate.user']) ? ' active' : '' }}">
                        <i class="fa fa-list-alt mr-2"></i>
                        <p>
                            Employee List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-user mr-2"></i>
                        <p>
                            My Account
                        </p>
                    </a>
                </li>
                @if ($user_details->role == 2 || $user_details->role == 3)
                    <li class="nav-item">
                        <a href="{{ route('language.index') }}"
                            class="nav-link{{ request()->routeIs(['language.index', 'language.edit']) ? ' active' : '' }}">
                            <i class="fa fa-language "></i>
                            <p>
                                Manage Language
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('evaluation.index') }}"
                            class="nav-link{{ rspr::isRoute('evaluation.index') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Evaluation Record</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('rating.index') }}"
                            class="nav-link{{ rspr::isRoute('rating.index') ? ' active' : '' }}">
                            <i class="fa fa-star"></i>
                            <p>Development Rating</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('development.index') }}"
                            class="nav-link{{ rspr::isRoute('development.index') ? ' active' : '' }}">
                            <i class="fa fa-asterisk"></i>
                            <p>Development Criteria</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('user.logout') }}" class="nav-link">
                        <i class="fa fa-sign-out mr-2"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
