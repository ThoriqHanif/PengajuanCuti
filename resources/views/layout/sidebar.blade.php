<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">CutiKita</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">CK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('/') ? 'active' : '' }}">
                <a href="/" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>

            <li class="menu-header">Pengajuan</li>
            <li class="{{ request()->is('cuti') ? 'active' : '' }}">
                <a href="/" class="nav-link "><i class="fas fa-calendar"></i><span>Pengajuan Cuti</span></a>
                {{-- <ul class="dropdown-menu">
              <li class=""><a class="nav-link" href="/"> Dashboard</a></li>
            </ul> --}}
            </li>
            <li class="menu-header">Master Data</li>
            <li class="{{ request()->is('divisions','division/trashed') ? 'active' : '' }}">
                <a href="{{route('divisions.index')}}" class="nav-link"><i class="fas fa-list"></i><span>Divisions Management</span></a>
            </li>
            <li class="{{ request()->is('positions', 'positions/trashed') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('positions.index')}}"><i class="fas fa-briefcase"></i><span>Positions Management</span></a>
            </li>
            <li class="{{ request()->is('roles', 'roles/create', 'roles') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('roles.index')}}"><i class="fas fa-filter"></i><span>Roles Management</span></a>
            </li>
            <li class="{{ request()->is('users', 'users/trashed', 'users/create', 'users/edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index')}}"><i class="fas fa-users"></i><span>Users Management</span></a>
            </li>

            <li class="menu-header">Settings</li>
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>
