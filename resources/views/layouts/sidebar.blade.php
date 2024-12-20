<aside class="main-sidebar elevation-4 sidebar-light-info">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/favicons.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text"><b>Laporan</b>Harian</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-1 mb-3 d-flex border-bottom-0">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-1"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <div class="btn-group btn-block border-bottom pb-3">
            <a href="{{ route('users.show', auth()->user()->id) }}" class="btn btn-default btn-sm">
                <i class="fas fa-user"></i> Profil Pengguna
            </a>
            <a href="#" class="btn btn-default btn-sm"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if (auth()->user()->hasPermission('read', 'dashboard'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>DASHBOARD</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read', 'users'))
                    <li class="nav-header">ADMINISTRATION</li>
                @endif

                @if (auth()->user()->hasPermission('read', 'users'))
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                           class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-users"></i>
                            <p>USER</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read', 'units'))
                    <li class="nav-header">MASTER DATA</li>
                @endif

                @if (auth()->user()->hasPermission('read', 'units'))
                    <li class="nav-item">
                        <a href="{{ route('units.index') }}"
                           class="nav-link {{ Request::is('units*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-building"></i>
                            <p>UNIT</p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read', 'work-instructions') || auth()->user()->hasPermission('read', 'daily-reports'))
                    <li class="nav-header">OPERASIONAL</li>
                @endif


                @if (auth()->user()->hasPermission('read', 'work-instructions'))
                    <li class="nav-item">
                        <a href="{{ route('work-instructions.index') }}"
                           class="nav-link {{ Request::is('work-instructions*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-fw fa-calendar-alt"></i>
                            <p>INSTRUKSI KERJA</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read', 'daily-reports'))
                    <li class="nav-item">
                        <a href="{{ route('daily-report.index') }}"
                           class="nav-link {{ Request::is('daily-report*') ? 'active' : '' }}"
                           data-menu-prefix="daily-report">
                            <i class="nav-icon far fa-fw fa-calendar-alt"></i>
                            <p>LAPORAN HARIAN</p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read', 'monthly-reports'))
                    <li class="nav-header">LAPORAN</li>
                @endif

                @if (auth()->user()->hasPermission('read', 'monthly-reports'))
                    <li class="nav-item">
                        <a href="{{ route('monthly-report.index') }}"
                           class="nav-link {{ Request::is('monthly-report*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-fw fa-copy"></i>
                            <p>LAPORAN KARYAWAN</p>
                        </a>
                    </li>
                @endif
                {{--
                                @if (auth()->user()->hasPermission('read', 'service-cards'))
                                    <li class="nav-item">
                                        <a href="{{ route('service-cards.index') }}"
                                           class="nav-link {{ Request::is('service-cards*') ? 'active' : '' }}"
                                           data-menu-prefix="service-cards">
                                            <i class="nav-icon fas fa-fw fa-clipboard"></i>
                                            <p>KARTU SERVIS</p>
                                        </a>
                                    </li>
                                @endif --}}

                @if(auth()->user()->hasPermission('read', 'pcs') || auth()->user()->hasPermission('read', 'printers') )
                    <li class="nav-header">KARTU SERVIS</li>
                @endif

                @if (auth()->user()->hasPermission('read', 'pcs'))
                    <li class="nav-item">
                        <a href="{{ route('pcs.index') }}"
                           class="nav-link {{ Request::is('pcs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-laptop"></i>
                            <p>PC</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read', 'printers'))
                    <li class="nav-item">
                        <a href="{{ route('printers.index') }}"
                           class="nav-link {{ Request::is('printers*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-print"></i>
                            <p>PRINTER</p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read', 'pps') || auth()->user()->hasPermission('read', 'ops') || auth()->user()->hasPermission('read', 'op-presets'))
                    <li class="nav-header">PP</li>
                @endif

                @if (auth()->user()->hasPermission('read', 'pps'))
                    <li class="nav-item">
                        <a href="{{ route('pps.index') }}"
                           class="nav-link {{ Request::is('pps*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-box"></i>
                            <p>PPS</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read', 'ops'))
                    <li class="nav-item">
                        <a href="{{ route('ops.index') }}"
                           class="nav-link {{ Request::is('ops*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-file"></i>
                            <p>OPS</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read', 'op-presets'))
                    <li class="nav-item">
                        <a href="{{ route('op-presets.index') }}"
                           class="nav-link {{ Request::is('op-presets*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-paint-brush"></i>
                            <p>OP Preset</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.sidebar .nav-link');
        const currentMenuPrefix = localStorage.getItem('menu-prefix');

        if (currentMenuPrefix) {

            // Remove active class from all menu items
            menuItems.forEach(item => item.classList.remove('active'));

            // Set active class based on localStorage
            menuItems.forEach(item => {
                const menuPrefix = item.getAttribute('data-menu-prefix');
                if (menuPrefix === currentMenuPrefix) {
                    item.classList.add('active');
                }
            });
        }

        // Update localStorage and active class on menu item click
        menuItems.forEach(item => {
            item.addEventListener('click', function(event) {
                const menuPrefix = event.currentTarget.getAttribute('data-menu-prefix');
                if (menuPrefix) {
                    localStorage.setItem('menu-prefix', menuPrefix);
                } else {
                    localStorage.removeItem('menu-prefix');
                }

                // Remove active class from all menu items
                menuItems.forEach(item => item.classList.remove('active'));

                // Add active class to the clicked item
                event.currentTarget.classList.add('active');
            });
        });
    });
</script>
