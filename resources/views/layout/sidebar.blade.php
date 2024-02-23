<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">CutiKita</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">CK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link "><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>

            <li class="menu-header">Cuti</li>
            @php
                $userPositionLevel = auth()->user()->position->level; // Assuming you have a 'level' property in your Position model
            @endphp

            @can('index leaves')
                @if ($userPositionLevel != 1 && $userPositionLevel != 2)
                    <li class="{{ request()->is('leaves*', 'leaves/create') ? 'active' : '' }}">
                        <a href="{{ route('leaves.index') }}" class="nav-link"><i
                                class="fas fa-calendar"></i><span>Pengajuan
                                Cuti</span></a>
                    </li>
                @endif
            @endcan


            @can('index request-leave')
                <li class="{{ request()->is('request-leave*', 'request-leave/create') ? 'active' : '' }}">
                    <a href="{{ route('request-leave.index') }}" class="nav-link "><i
                            class="fas fa-clipboard"></i><span>Permohonan Cuti</span></a>

                </li>
            @endcan

            @can('index types')
                <li class="{{ request()->is('types') ? 'active' : '' }}">
                    <a href="{{ route('types.index') }}" class="nav-link "><i class="fas fa-tag"></i><span>Tipe
                            Cuti</span></a>

                </li>
            @endcan

            {{-- <li class="{{ request()->is('') ? 'active' : '' }}">
                <a href="" class="nav-link "><i class="fas fa-clipboard"></i><span>Laporan Pengajuan</span></a>

            </li> --}}

            {{-- @canany('index divisions', 'index positions', 'index roles', 'index users') --}}
            @can('index divisions')
                @can('index positions')
                    @can('index roles')
                        @can('index users')
                            <li class="menu-header">Master Data</li>
                        @endcan
                    @endcan
                @endcan
            @endcan
            {{-- @endcanany --}}

            @can('index divisions')
                <li class="{{ request()->is('divisions*', 'division/trashed') ? 'active' : '' }}">
                    <a href="{{ route('divisions.index') }}" class="nav-link"><i class="fas fa-list"></i><span> Data Divisi
                            </span></a>
                </li>
            @endcan
            @can('index positions')
                <li class="{{ request()->is('positions*', 'positions/trashed') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('positions.index') }}"><i
                            class="fas fa-briefcase"></i><span> Data Posisi</span></a>
                </li>
            @endcan
            @can('index roles')
                <li class="{{ request()->is('roles*', 'roles/create', 'roles') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('roles.index') }}"><i class="fas fa-filter"></i><span> Data
                            Role</span></a>
                </li>
            @endcan
            @can('index users')
                <li class="{{ request()->is('users*', 'users/trashed', 'users/create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i><span>
                            Data User</span></a>
                </li>
            @endcan


            {{-- <li class="menu-header">Settings</li> --}}
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>
