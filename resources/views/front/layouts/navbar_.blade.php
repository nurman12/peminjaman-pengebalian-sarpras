<body class="animsition">

    <!-- Header -->
    <header class="header-v2">
        <!-- Header desktop -->
        <div class="container-menu-desktop trans-03">

            <div class="wrap-menu-desktop how-shadow1">
                <nav class="limiter-menu-desktop p-l-45">

                    <!-- Logo desktop -->
                    <a href="#!" class="logo">
                        <img src="{{ asset('/front') }}/images/icons/logo-01.png" alt="IMG-LOGO">
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
                    <div class="wrap-icon-header flex-w flex-r-m">
                        @auth
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-22 p-r-11 icon-header-noti js-show-cart" data-notify="">
                            <i class="zmdi zmdi-assignment"></i>
                        </div>
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-45 js-show-sidebar">
                            <i class="zmdi zmdi-menu"></i>
                        </div>
                        @else
                        <a href="/login" class="cl2 hov-cl1 p-l-22 p-r-45">
                            <i class="zmdi zmdi-account p-r-5"></i> Sign In
                        </a>
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
                    <a href="#!">Profile</a>
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
                @endauth
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="{{ asset('/front') }}/images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>