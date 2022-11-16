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
                        @if(request()->is('l_kadaluarsa') )
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('l_kerusakan'))
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('l_ketersediaan'))
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('l_peminjaman'))
                        <li class="nav-parent nav-expanded nav-active">
                            @elseif(request()->is('l_pengembalian*'))
                        <li class="nav-parent nav-expanded nav-active">
                            @else
                        <li class="nav-parent">
                            @endif
                            <a>
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="{{ request()->is('l_kadaluarsa') ? 'nav-active' : '' }}">
                                    <a href="/l_kadaluarsa">
                                        Kedaluwarsa
                                    </a>
                                </li>
                                <li class="{{ request()->is('l_ketersediaan') ? 'nav-active' : '' }}">
                                    <a href="/l_ketersediaan">
                                        Ketersediaan
                                    </a>
                                </li>
                                <li class="{{ request()->is('l_kerusakan') ? 'nav-active' : '' }}">
                                    <a href="/l_kerusakan">
                                        Kerusakan
                                    </a>
                                </li>
                                <li class="{{ request()->is('l_peminjaman') ? 'nav-active' : '' }}">
                                    <a href="/l_peminjaman">
                                        Peminjaman
                                    </a>
                                </li>
                                <li class="{{ request()->is('l_pengembalian*') ? 'nav-active' : '' }}">
                                    <a href="/l_pengembalian">
                                        Pengembalian
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user()->roles == 'BMN')
                        <li class="{{ request()->is('peminjaman*') ? 'nav-active' : '' }}">
                            <a href="/peminjaman">
                                <span class="pull-right label label-primary">{{ count(App\Models\Pengembalian::whereIn('status', [0, 2])->get()) }}</span>
                                <i class="fa fa-plane" aria-hidden="true"></i>
                                <span>Peminjaman</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('pengembalian*') ? 'nav-active' : '' }}">
                            <a href="/pengembalian">
                                <span class="pull-right label label-primary">{{ count(App\Models\Pengembalian::where('status', 1)->get()) }}</span>
                                <i class="fa fa-rocket" aria-hidden="true"></i>
                                <span>Pengembalian</span>
                            </a>
                        </li>
                        <!-- <li class="{{ request()->is('bot*') ? 'nav-active' : '' }}">
                            <a href="{{ route('bot.index') }}">
                                <span class="pull-right label label-primary"></span>
                                <i class="fa fa-reddit" aria-hidden="true"></i>
                                <span>Bot WhatsApp</span>
                            </a>
                        </li> -->
                        @endif
                    </ul>
                </nav>
            </div>

        </div>

    </aside>
    <!-- end: sidebar -->