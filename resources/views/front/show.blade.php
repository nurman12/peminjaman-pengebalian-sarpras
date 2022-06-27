@extends('front.layouts.index_')
@push('title', 'Dashboard')
@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{$sarpras->nama}}
        </span>
    </div>
</div>


<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 col-sm-5 p-b-30">
                <div class="wrap-slick3-dots"></div>
                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                <div class="slick3 gallery-lb">
                    <div class="wrap-pic-w pos-relative">
                        <img src="{{ url('/storage/'. $sarpras->photo) }}" style="width: 34vw;" alt="IMG-PRODUCT">

                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ url('/storage/'. $sarpras->photo) }}">
                            <i class="fa fa-expand"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 col-sm-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{$sarpras->nama}}
                    </h4>

                    <span class="mtext-106 cl2">
                        {{$sarpras->jumlah}}
                    </span>

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

                                    <input type="hidden" id="sarpras_id" class="sarpras_id" value="{{$sarpras->id}}">
                                    <input type="hidden" id="max_qty" value="{{$sarpras->jumlah}}">
                                    <input class="mtext-104 cl3 txt-center num-product qty-input" type="number" name="num-product" value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>

                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Tambahkan pada Draf
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Deskripsi</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {{$sarpras->deskripsi}}
                            </p>
                        </div>
                    </div>

                    <!-- - -->
                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">

        <span class="stext-107 cl6 p-lr-25">
            Categories: {{$sarpras->kategori}}
        </span>
    </div>
</section>


<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                Sarpras Serupa
            </h3>
        </div>

        <!--  -->
        <div class="row wrap-slick2">
            @foreach($sarpras_like as $data)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 13vw;" alt="IMG-PRODUCT">

                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-jumlah="{{$data->jumlah}}" data-img="{{$data->photo}}" data-keterangan="{{$data->deskripsi}}">
                            Lihat Sekilas
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="/sarpras_detail/{{$data->id}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
</section>

<!-- Modal1 -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-10">
            <div class="bg0 how-pos3-parent">
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
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14" id="detail_nama_item"></h4>

                            <span class="mtext-106 cl2" id="detail_jumlah"></span>

                            <p class="stext-102 cl3 p-t-23">
                                Masukkan jumlah sarpras yang ingin anda pinjam
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w p-b-10">
                                    <div class="w-full flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10 detail-quantity">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input type="hidden" class="detail_sarpras_id" id="detail_sarpras_id">
                                            <input type="hidden" class="detail_max-qty" id="detail_max_qty">
                                            <input class="mtext-104 cl3 txt-center num-product detail-qty-input" type="number" name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-details">
                                            Add to Draft
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p class="stext-102 cl3 p-t-23" id="detail_keterangan"></p>
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

    $('.btn-num-product-up').click(function(e) {
        e.preventDefault();
        let incre = $(this).parents('.detail-quantity').find('.detail-qty-input').val();
        let max = $(this).parents('.detail-quantity').find('#detail_max_qty').val();
        let value = parseInt(incre);
        if (value < max) {
            value++;
            $(this).parents('.detail-quantity').find('.detail-qty-input').val(value);
        }
    });

    $('.btn-num-product-down').click(function(e) {
        e.preventDefault();
        let decre = $(this).parents('.detail-quantity').find('.detail-qty-input').val();
        let value = parseInt(decre);
        if (value > 1) {
            value--;
            $(this).parents('.detail-quantity').find('.detail-qty-input').val(value);
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

        $('#detail_sarpras_id').val(id);
        $('#detail_nama_item').text(nama);
        $('#img').attr('src', '/storage/' + img);
        $('.zoom-picture').attr('href', '/storage/' + img);
        $('#detail_jumlah').text(jumlah);
        $('#detail_max_qty').val(jumlah);
        $('#detail_keterangan').text(keterangan);

        $('.detail-qty-input').val(1);
    });

    $(document).on('click', '.js-addcart-detail', function() {
        var sarpras_id = $(this).parents('.respon6-next').find('.sarpras_id').val();
        var sarpras_qty = $(this).parents('.respon6-next').find('.qty-input').val();

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

    $(document).on('click', '.js-addcart-details', function() {
        var sarpras_id = $(this).parents('.respon6-next').find('.detail_sarpras_id').val();
        var sarpras_qty = $(this).parents('.respon6-next').find('.detail-qty-input').val();

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