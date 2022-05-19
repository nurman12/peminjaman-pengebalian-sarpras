<div class="inner-wrapper">
    <!-- start: sidebar -->
    <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header">
            <div class="sidebar-title" style="color: white;">
                Navigation
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">
                    <ul class="nav nav-main">
                        <li class="{{ request()->is('dashboard') ? 'nav-active' : '' }}">
                            <a href="/dashboard">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @if(Auth::user()->roles == 'BMN')
                        <li class="{{ request()->is('pengguna*') ? 'nav-active' : '' }}">
                            <a href="{{ route('pengguna.index') }}">
                                <span class="pull-right label label-primary">{{ count(App\Models\User::all()) }}</span>
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Pengguna</span>
                            </a>
                        </li>
                        @if(request()->is('sarpras*') )
                        <li class="nav-parent nav-expanded nav-active">
                            @else
                        <li class="nav-parent">
                            @endif
                            <a>
                                <i class="fa fa-copy" aria-hidden="true"></i>
                                <span>Sarpras</span>
                            </a>
                            <ul class="nav nav-children">
                                @if(request()->is('sarpras'))
                                <li class="{{ request()->is('sarpras') ? 'nav-active' : '' }}">
                                    @elseif(request()->is('sarpras/*'))
                                <li class="{{ request()->is('sarpras/*') ? 'nav-active' : '' }}">
                                    @else
                                <li>
                                    @endif
                                    <a href="{{ route('sarpras.index') }}">
                                        Master Data
                                    </a>
                                </li>
                                @if(request()->is('sarpras_masuk'))
                                <li class="{{ request()->is('sarpras_masuk') ? 'nav-active' : '' }}">
                                    @elseif(request()->is('sarpras_masuk/*'))
                                <li class="{{ request()->is('sarpras_masuk/*') ? 'nav-active' : '' }}">
                                    @else
                                <li>
                                    @endif
                                    <a href="{{ route('sarpras_masuk.index') }}">
                                        Sarpras Masuk
                                    </a>
                                </li>
                                @if(request()->is('sarpras_keluar'))
                                <li class="{{ request()->is('sarpras_keluar') ? 'nav-active' : '' }}">
                                    @elseif(request()->is('sarpras_keluar/*'))
                                <li class="{{ request()->is('sarpras_keluar/*') ? 'nav-active' : '' }}">
                                    @else
                                <li>
                                    @endif
                                    <a href="{{ route('sarpras_keluar.index') }}">
                                        Sarpras Keluar
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(request()->is('*validasi') )
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('validasi*'))
                        <li class="nav-parent nav-expanded nav-active">
                            @else
                        <li class="nav-parent">
                            @endif
                            <a>
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <span>Validasi</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="{{ request()->is('belum_validasi') ? 'nav-active' : '' }}">
                                    <a href="/belum_validasi">
                                        Belum Validasi
                                    </a>
                                </li>
                                <li class="{{ request()->is('sudah_validasi') ? 'nav-active' : '' }}">
                                    <a href="/sudah_validasi">
                                        Sudah Validasi
                                    </a>
                                </li>
                                @if(request()->is('validasi'))
                                <li class="{{ request()->is('validasi') ? 'nav-active' : '' }}">
                                    @elseif(request()->is('validasi*'))
                                <li class="{{ request()->is('validasi*') ? 'nav-active' : '' }}">
                                    @else
                                <li>
                                    @endif
                                    <a href="/validasi">
                                        Semua Validasi
                                    </a>
                                </li>
                                <li class="{{ request()->is('expired_validasi*') ? 'nav-active' : '' }}">
                                    <a href="/expired_validasi">
                                        Kedaluwarsa
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->roles == 'KTU' || Auth::user()->roles == 'Koordinator' )
                        @if(request()->is('*validasi') )
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('validasi*'))
                        <li class="nav-parent nav-expanded nav-active">
                            @else
                        <li class="nav-parent">
                            @endif
                            <a>
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <span>Validasi</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="{{ request()->is('belum_validasi') ? 'nav-active' : '' }}">
                                    <a href="/belum_validasi">
                                        Belum Validasi
                                    </a>
                                </li>
                                <li class="{{ request()->is('sudah_validasi') ? 'nav-active' : '' }}">
                                    <a href="/sudah_validasi">
                                        Sudah Validasi
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(request()->is('ketersediaan') )
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('kerusakan'))
                        <li class="nav-parent nav-expanded nav-active">
                            @else
                        <li class="nav-parent">
                            @endif
                            <a>
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="{{ request()->is('ketersediaan') ? 'nav-active' : '' }}">
                                    <a href="/ketersediaan">
                                        Ketersediaan
                                    </a>
                                </li>
                                <li class="{{ request()->is('kerusakan') ? 'nav-active' : '' }}">
                                    <a href="/kerusakan">
                                        Kerusakan
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user()->roles == 'BMN')
                        <hr class="sparator" separator>
                        <div class="sidebar-widget widget-tasks">
                            <div class="widget-header">
                                <h6 style="color: white;">MASTER DATA</h6>
                                <div class="widget-toggle" style="color: white;">+</div>
                            </div>
                            <div class="widget-content">
                                <ul class="list-unstyled m-none">
                                    <li class="nav-active">
                                        <a href="{{ route('peminjaman.index') }}">Peminjaman</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('pengembalian.index') }}">Pengembalian</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr class="sparator" separator>
                        @if(request()->is('perangkat') )
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('schedule') )
                        <li class="nav-parent nav-expanded nav-active">
                            @else
                        <li class="nav-parent">
                            @endif
                            <a>
                                <i class="fa fa-send" aria-hidden="true"></i>
                                <span>WhatsApp</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="{{ request()->is('perangkat') ? 'nav-active' : '' }}">
                                    <a href="/perangkat">
                                        Perangkat
                                    </a>
                                </li>
                                <li class="{{ request()->is('message') ? 'nav-active' : '' }}">
                                    <a href="/message">
                                        Message
                                    </a>
                                </li>
                                <li class="{{ request()->is('schedule') ? 'nav-active' : '' }}">
                                    <a href="/schedule">
                                        Schedule
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>

        </div>

    </aside>
    <!-- end: sidebar -->