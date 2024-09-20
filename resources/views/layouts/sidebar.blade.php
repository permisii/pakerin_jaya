<aside class="main-sidebar elevation-4 sidebar-light-info">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/favicons.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle"
             style="opacity: .8">
        <span class="brand-text"><b>Daily</b>Operation</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-1 mb-3 d-flex border-bottom-0">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-1"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <div class="btn-group btn-block border-bottom pb-3">
            <a href="{{route('users.show', auth()->user()->id)}}" class="btn btn-default btn-sm"><i
                    class="fas fa-user"></i> User Profile
            </a>
            <a href="{{ route('login') }}" class="btn btn-default btn-sm"><i
                    class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-header">ADMINISTRATION</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-users"></i>
                        <p>User </p>
                    </a>
                </li>

                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="{{ route('units.index') }}"
                       class="nav-link {{ Request::is('units*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-building"></i>
                        <p>Unit </p>
                    </a>
                </li>

                <li class="nav-header">OPERATIONAL</li>
                <li class="nav-item">
                    <a href="{{ route('work-instructions.index') }}"
                       class="nav-link {{ Request::is('work-instructions*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-fw  fa-calendar-alt"></i>
                        <p>Work Instructions </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('daily-report.index') }}"
                       class="nav-link {{ Request::is('daily-report*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-fw  fa-calendar-alt"></i>
                        <p>Daily Report </p>
                    </a>
                </li>

                <li class="nav-header">REPORT</li>

                <li class="nav-item">
                    <a href="{{ route('monthly-report.index') }}"
                       class="nav-link {{ Request::is('monthly-report*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-fw  fa-copy"></i>
                        <p>Your Report </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
