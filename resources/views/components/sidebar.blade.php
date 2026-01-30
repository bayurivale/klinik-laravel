<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="fa fa-home menu-icon"></i>
                </a>
            </li>
        @endif

        @if(auth()->user()->role === 'pegawai')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pegawai.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="fa fa-home menu-icon"></i>
                </a>
            </li>
        @endif

        @if(auth()->user()->role === 'pelanggan')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pelanggan.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="fa fa-home menu-icon"></i>
                </a>
            </li>
        @endif
        
        @if(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="/user">
                <span class="menu-title">Users</span>
                <i class="fa fa-users menu-icon"></i>
                </a>
            </li>
        @endif

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'pegawai')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('obat.index') }}">
                <span class="menu-title">Obat</span>
                <i class="fa fa-medkit menu-icon"></i>
                </a>
            </li>
        @endif

        @if(auth()->user()->role === 'pegawai')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('transaksi.menunggu') }}">
                <span class="menu-title">List Transaksi</span>
                <i class="fa fa-list menu-icon"></i>
                </a>
            </li>
        @endif

        @if(auth()->user()->role === 'pelanggan')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pelanggan.obat.index') }}">
                <span class="menu-title">Obat</span>
                <i class="fa fa-medkit menu-icon"></i>
                </a>
            </li>
        @endif

        @if(auth()->user()->role === 'pelanggan')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pelanggan.pembayaran.index') }}">
                <span class="menu-title">Pembayaran</span>
                <i class="fa fa-money menu-icon"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>