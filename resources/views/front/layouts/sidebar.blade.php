<!-- Sidebar -->
<aside class="wrap-sidebar js-sidebar">
    <div class="s-full js-hide-sidebar"></div>

    <div class="sidebar flex-col-l p-t-22 p-b-25">
        <div class="flex-r w-full p-b-30 p-r-27">
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
            <ul class="sidebar-link w-full main-menu-m" style="background:#fff;">
                <li class="p-b-13">
                    <a href="/" class="stext-102 cl2 hov-cl1 trans-04" style="color: #666;">
                        Home
                    </a>
                </li>
                <li class="p-b-13">
                    <a href="#!" class="stext-102 cl2 hov-cl1 trans-04" style="color: #666;">Sarpras</a>
                    <ul class="sub-menu-m">
                        <li><a href="/barang">Barang</a></li>
                        <li><a href="/ruangan">Ruangan</a></li>
                    </ul>
                    <span class="arrow-main-menu-m" style="color: #666;">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
                <li class="p-b-13">
                    <a href="/contact" class="stext-102 cl2 hov-cl1 trans-04" style="color: #666;">
                        Contact
                    </a>
                </li>
                <li class="p-b-13">
                    <a href="/profile" class="stext-102 cl2 hov-cl1 trans-04" style="color: #666;">
                        Profil
                    </a>
                </li>
                <li class="p-b-13">
                    <a href="/faqs" class="stext-102 cl2 hov-cl1 trans-04" style="color: #666;">
                        Bantuan & FAQs
                    </a>
                </li>
                <hr class="separator">
                <li class="p-b-13">
                    <a href="#" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04" onclick=" event.preventDefault(); document.getElementById('formLogout').submit();">
                        Logout
                        <form id="formLogout" action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>

            <div class="sidebar-gallery w-full">
                <span class="mtext-101 cl5">
                    Tentang
                </span>

                <p class="stext-108 cl6 p-t-27">
                    Layanan resmi POLINEMA PSDKU KEDIRI dengan pengelola BMN yang disediakan bagi para dosen dan mahasiswa untuk permohonan peminjaman barang dan ruangan.
                </p>
            </div>
        </div>
    </div>
</aside>


<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Daftar Draft
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" id="miniDraft">

            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40" id="total_miniDraf">

                </div>
            </div>
        </div>
        <a href="{{ route('draft.index') }}" class="flex-c-m stext-101 cl0 size-111 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
            Lihat Draft
        </a>
    </div>
</div>