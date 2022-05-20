@extends('front.layouts.index')
@push('title', 'Sarpras')
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('/front') }}/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        {{$title}}
    </h2>
</section>

<!-- Product -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                @if($title == 'Daftar Barang')
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    Semua
                </button>
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".elektronik">
                    Elektronik
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".mebel">
                    Mebel
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".lainnya">
                    Lainnya
                </button>
                @elseif($title == 'Daftar Ruangan')
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    Semua
                </button>
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".kelas">
                    Kelas
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".lainnya">
                    Lainnya
                </button>
                @endif
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                </div>
            </div>
        </div>

        <div class="row isotope-grid">
            @foreach($sarpras as $data)
            <?php
            $pecah_string = explode(", ", $data->kategori);
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item @foreach($pecah_string as $item) {{$item}} @endforeach">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <img src="{{ url('/storage/sarpras/'. $data->photo) }}" style="height: 13vw;" alt="IMG-PRODUCT">

                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-jumlah="{{$data->jumlah}}" data-img="{{$data->photo}}" data-keterangan="{{$data->deskripsi}}">
                            Lihat Sekilas
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="/sarpras_detail" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{$data->nama}}
                            </a>

                            <span class="stext-105 cl3">
                                {{$data->jumlah}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Load more -->
        <!-- <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div> -->
    </div>
</div>

<!-- Modal1 -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-10">
            <div class="bg0   how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ asset('/front') }}/images/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-3 col-lg-5 col-sm-4">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="gallery-lb">
                            <div class="wrap-pic-w pos-relative">
                                <img src="" id="img" alt="IMG-PRODUCT">

                                <a class="flex-c-m size-108 m-l-20 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04 zoom-picture" href="">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4 col-sm-6 p-b-30 nama_sarpras">
                        <div class="p-r-50 p-t-30 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14" id="nama_item"></h4>

                            <span class="mtext-106 cl2" id="jumlah"></span>

                            <p class="stext-102 cl3 p-t-23">
                                Masukkan jumlah sarpras yang ingin anda pinjam
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10 quantity">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input type="hidden" class="sarpras_id" id="sarpras_id">
                                            <input type="hidden" class="max-qty" id="max_qty">
                                            <input class="mtext-104 cl3 txt-center num-product qty-input" type="number" name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to Draf
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p class="stext-102 cl3 p-t-23" id="keterangan"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/slick/slick.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
@endpush

@push('script')
<script>
    $('.btn-num-product-up').click(function(e) {
        e.preventDefault();
        let incre = $(this).parents('.quantity').find('.qty-input').val();
        let max = $(this).parents('.quantity').find('#max_qty').val();
        let value = parseInt(incre);
        if (value < max) {
            value++;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

    $('.btn-num-product-down').click(function(e) {
        e.preventDefault();
        let decre = $(this).parents('.quantity').find('.qty-input').val();
        let value = parseInt(decre);
        if (value > 1) {
            value--;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });
</script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/slick/slick.min.js"></script>
<script src="{{ asset('/front') }}/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $(document).on('click', '.js-show-modal1', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var jumlah = $(this).data('jumlah');
        var img = $(this).data('img');
        var keterangan = $(this).data('keterangan');

        $('#sarpras_id').val(id);
        $('#nama_item').text(nama);
        $('#img').attr('src', '/storage/sarpras/' + img);
        $('.zoom-picture').attr('href', '/storage/sarpras/' + img);
        $('#jumlah').text(jumlah);
        $('#max_qty').val(jumlah);
        $('#keterangan').text(keterangan);

        $('.qty-input').val(1);
    });

    $(document).on('click', '.js-addcart-detail', function() {
        var sarpras_id = $(this).parents('.respon6-next').find('.sarpras_id').val();
        var sarpras_qty = $(this).parents('.respon6-next').find('.qty-input').val();
        var nama = $(this).parents('.nama_sarpras').find('#nama_item').text();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "{{ route('draft.store')}}",
            data: {
                'sarpras_id': sarpras_id,
                'sarpras_qty': sarpras_qty,
            },
            success: function(response) {
                if (response.tes == 'Ok') {
                    swal("Berhasil", response.status, "success");
                    totalDraf();
                } else if (response.tes == 'Update') {
                    swal("Update!", response.status, "success");
                    totalDraf();
                } else if (response.tes == 'Error') {
                    swal("Error!", response.status, "error");
                }
            }
        });
    });
</script>
@endpush