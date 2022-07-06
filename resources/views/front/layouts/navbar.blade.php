<body class="animsition">

    <!-- Header -->
    <header class="header-v3">
        <!-- Header desktop -->
        <div class="container-menu-desktop trans-03">
            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop p-l-45">

                    <!-- Logo desktop -->
                    <a href="#!" class="logo">
                        <img src="{{ asset('/front') }}/images/icons/logo-02.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="/" class="{{ request()->is('') ? ' active' : '' }}">Home</a>
                            </li>
                            <li>
                                <a href="#!">Sarpras</a>
                                <ul class="sub-menu">
                                    <li><a href="/barang">Barang</a></li>
                                    <li><a href="/ruangan">Ruangan</a></li>
                                </ul>
                            </li>
                            @auth
                            <li>
                                <a href="#!">Module</a>
                                <ul class="sub-menu">
                                    <li><a href="/permohonans">Permohonan</a></li>
                                    <li><a href="/peminjamans">Peminjaman</a></li>
                                    <li><a href="/pengembalians">Pengembalian</a></li>
                                </ul>
                            </li>
                            @endauth
                            <li>
                                <a href="/about">About</a>
                            </li>
                            <li>
                                <a href="/faqs">FAQs</a>
                            </li>
                            <li>
                                <a href="/contact">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m h-full">
                        @auth
                        <div class="flex-c-m h-full p-r-25 bor6">
                            <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="">
                                <i class="zmdi zmdi-assignment"></i>
                            </div>
                        </div>
                        <div class="flex-c-m h-full p-r-19">
                            <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                        </div>
                        @else
                        <div class="flex-c-m h-full p-r-45">
                            <a href="/login" class="cl0">
                                <i class="zmdi zmdi-account p-r-5"></i> Sign In
                            </a>
                        </div>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="#!"><img src="{{ asset('/front') }}/images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>
            @auth
            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
                <div class="flex-c-m h-full p-r-5">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="">
                        <i class="zmdi zmdi-assignment"></i>
                    </div>
                </div>
            </div>
            @endauth
            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="main-menu-m">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="#!">Sarpras</a>
                    <ul class="sub-menu-m">
                        <li><a href="/barang">Barang</a></li>
                        <li><a href="/ruangan">Ruangan</a></li>
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
                @auth
                <li>
                    <a href="#!">Module</a>
                    <ul class="sub-menu-m">
                        <li><a href="/permohonans">Permohonan</a></li>
                        <li><a href="/peminjamans">Peminjaman</a></li>
                        <li><a href="/pengembalians">Pengembalian</a></li>
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
                @endauth
                <li>
                    <a href="/about">About</a>
                </li>

                <li>
                    <a href="/faqs">FAQs</a>
                </li>

                <li>
                    <a href="/contact">Contact</a>
                </li>
                @auth
                <li>
                    <a href="/profile">Profile</a>
                </li>
                <li>
                    <a href="#" onclick=" event.preventDefault(); document.getElementById('formLogout').submit();">
                        Logout
                        <form id="formLogout" action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>
                    </a>
                </li>
                @else
                <li>
                    <a href="/login">Login</a>
                </li>
                @endif
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <button class="flex-c-m btn-hide-modal-search trans-04">
                <i class="zmdi zmdi-close"></i>
            </button>

            <form class="container-search-header">
                <div class="wrap-search-header">
                    <input class="plh0" type="text" name="search" placeholder="Search...">

                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </header>