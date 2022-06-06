@extends('front.layouts.index')
@push('title', 'Dashboard')
@section('content')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1 rs2-slick1">
        <div class="slick1">
            <div class="item-slick1 bg-overlay1" style="background-image: url({{ asset('/front') }}/images/slide-05.jpg);" data-thumb="{{ asset('/front') }}/images/thumb-01.jpg" data-caption="Women’s Wear">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 cl2 respon2 text-white">
                                Men Collection 2018
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1 text-white">
                                New arrivals
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="#!" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-white">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-slick1 bg-overlay1" style="background-image: url({{ asset('/front') }}/images/slide-06.jpg);" data-thumb="{{ asset('/front') }}/images/thumb-02.jpg" data-caption="Men’s Wear">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 cl2 respon2 text-white">
                                Men Collection 2018
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1 text-white">
                                New arrivals
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="#!" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-white">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-slick1 bg-overlay1" style="background-image: url({{ asset('/front') }}/images/slide-07.jpg);" data-thumb="{{ asset('/front') }}/images/thumb-03.jpg" data-caption="Men’s Wear">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 cl2 respon2 text-white">
                                Men Collection 2018
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1 text-white">
                                New arrivals
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="#!" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-white">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap-slick1-dots p-lr-10"></div>
    </div>
</section>


<!-- Banner -->
<div class="sec-banner bg0 p-t-95 p-b-55">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4 p-b-30 ">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('/front') }}/images/item-card-1.jpg" alt="IMG-BANNER">

                    <a href="/barang" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Barang
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                Daftar Barang
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Selengkapnya
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-5 col-lg-4 p-b-30">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('/front') }}/images/item-card-2.jpg" alt="IMG-BANNER">

                    <a href="/ruangan" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Ruangan
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                Daftar Ruangan
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Selengkapnya
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="sec-product bg0 p-t-10 p-b-50">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Gambaran Sarpras
            </h3>
        </div>

        <!-- Tab01 -->
        <div class="tab01">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item p-b-10">
                    <a class="nav-link active" data-toggle="tab" href="#best" role="tab">Semua</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#elektronik" role="tab">Elektronik</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#mebel" role="tab">Mebel</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#kain" role="tab">Kain</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#ruangan" role="tab">Kelas</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#laboratorium" role="tab">Laboratorium</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#rapat" role="tab">Rapat</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#lainnya" role="tab">Lainnya</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-t-20">
                <!-- - -->
                <div class="tab-pane fade show active" id="best" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            <!-- Kosong jek an -->

                            <!-- End Kosong jek an -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="elektronik" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_elek as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                            <a href="/sarpras_detail/{{ $data->id }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="mebel" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_mbel as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                            <a href="/sarpras_detail/{{ $data->id }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="kain" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_kain as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                            <a href="/sarpras_detail/{{ $data->id }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="ruangan" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_klas as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                            <a href="/sarpras_detail/{{ $data->id }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="labo" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_labo as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                            <a href="/sarpras_detail/{{ $data->id }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="rapat" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_rpat as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                            <a href="/sarpras_detail/{{ $data->id }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="lainnya" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_lain as $data)
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{ url('/storage/sarpras/'. $data->photo) }}" style="height: 13vw;" alt="IMG-PRODUCT">

                                    <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-jumlah="{{$data->jumlah}}" data-img="{{$data->photo}}" data-keterangan="{{$data->deskripsi}}">
                                        Lihat Sekilas
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="/sarpras_detail/{{ $data->id }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{$data->nama}}
                                        </a>

                                        <span class="stext-105 cl3">
                                            {{$data->jumlah}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/botman/chat.min.css"> -->
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/slick/slick.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
@endpush

@push('script')
<!--===============================================================================================-->
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
        //ambil data
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var jumlah = $(this).data('jumlah');
        var img = $(this).data('img');
        var keterangan = $(this).data('keterangan');
        //set pada view
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
<!-- <script>
    var botmanWidget = {
        aboutText: 'Write Something',
        introMessage: "Hai, saya asisten virtual Bolt the Zoom ️✋",
        introMessage: "Hai, saya asisten virtual Bolt the Zoom ️✋"
    };
</script>
<script src="{{ asset('/front') }}/vendor/botman/widget.js"></script> -->
@endpush