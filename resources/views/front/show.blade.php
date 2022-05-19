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
                                    Add to Draf
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
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>
                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (2)</a>
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
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">
                                    <!-- Review -->
                                    <div class="flex-w flex-t p-b-68">
                                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                            <img src="{{ asset('/front') }}/images/avatar-01.jpg" alt="AVATAR">
                                        </div>

                                        <div class="size-207">
                                            <div class="flex-w flex-sb-m p-b-17">
                                                <span class="mtext-107 cl2 p-r-20">
                                                    Ariana Grande
                                                </span>

                                                <span class="fs-18 cl11">
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star-half"></i>
                                                </span>
                                            </div>

                                            <p class="stext-102 cl6">
                                                Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex-w flex-t p-b-68">
                                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                            <img src="{{ asset('/front') }}/images/avatar-01.jpg" alt="AVATAR">
                                        </div>

                                        <div class="size-207">
                                            <div class="flex-w flex-sb-m p-b-17">
                                                <span class="mtext-107 cl2 p-r-20">
                                                    Ariana Grande
                                                </span>

                                                <span class="fs-18 cl11">
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star-half"></i>
                                                </span>
                                            </div>

                                            <p class="stext-102 cl6">
                                                Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                Related Products
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-01.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex fs-18 cl11">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-02.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex text-primary">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-03.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex text-primary">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-04.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex text-primary">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-05.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex text-primary">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-06.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex text-primary">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-07.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex text-primary">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('/front') }}/images/product-08.jpg" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    Square Neck Back
                                </a>

                                <span class="stext-105 cl3">
                                    $29.64
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <span class="dis-flex text-primary">
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star"></i>
                                    <i class="zmdi zmdi-star-half">(23)</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal1 -->

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
        $('#img').attr('src', '/storage/' + img);
        $('.zoom-picture').attr('href', '/storage/' + img);
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