@extends('front.layouts.index')
@push('title', 'Dashboard')
@section('content')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1 rs2-slick1">
        <div class="slick1">
            <div class="item-slick1 bg-overlay1" style="background-image: url({{ asset('/front') }}/images/gedung-b.jpg);" data-thumb="{{ asset('/front') }}/images/thumb-01.jpg" data-caption="Women’s Wear">
                <div class="container h-full">
                    <div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
                        <!-- <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 txt-center cl0 respon2">
                                BMN
                            </span>
                        </div> -->

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 txt-center cl0 p-t-22 p-b-20 respon1">
                                POLINEMA
                            </h2>
                            <h2 class="ltext-104 txt-center cl0 p-t-12 p-b-40 respon1">
                                PSDKU KEDIRI
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="#sarpras" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                BMN
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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


<section class="sec-product bg0 p-t-10 p-b-50" id="sarpras">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Daftar Sarpras
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
                            @foreach($sarpras_alls as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                <div class="tab-pane fade" id="laboratorium" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($sarpras_labo as $data)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                                        <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                                    <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

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
                                    <div class="w-full flex-w flex-m respon6-next">
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
@auth
@if($tanggungan->count() > 0)
<div class="wrap-modal2 js-modal2 p-t-60 p-b-20 show-modal2">
    <div class="overlay-modal2 js-hide-modal2"></div>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="bg0 how-pos3-parent">
                <div class="container p-all-20">
                    <h5 class="display-5 p-t-10 text-capitalize">Selamat datang {{Auth::user()->name}}</h5>
                    <p>
                        Mengingat anda memiliki tanggungan peminjaman seperti berikut, mohon mengembalikan tepat waktu.
                        <br>
                        <br>
                        Terima kasih.
                    </p>
                    <h4 class="text-center text-uppercase m-b-22 m-t-15">Daftar Peminjaman</h4>
                    <table class="table table-striped table-hover table-bordered" id="example-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Keperluan</th>
                                <th>Jumlah</th>
                                <th>Tgl. Kegiatan</th>
                                <th>Tanggal Ambil</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tanggungan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('peminjaman.show', $data->id) }}" style="color: #7280e0;">{{ $data->validasi->keperluan }}</a></td>
                                <td>{{ count($data->validasi->draft) }}</td>
                                <td>{{ date('d F', strtotime( $data->validasi->tanggal_start )) }} s.d. {{ date('d F Y', strtotime( $data->validasi->tanggal_finish )) }}</td>
                                <td>{{ date('d F Y', strtotime( $data->date_ambil )) }}</td>
                                <td>
                                    @if($data->status == 0)
                                    <label class="badge badge-light shadow">Tanggungan</label>
                                    @elseif($data->status == 1)
                                    <label class="badge badge-success shadow">Success</label>
                                    @elseif($data->status == 2)
                                    <label class="badge badge-danger shadow">Kerusakan</label>
                                    @endif
                                </td>
                                <td class="text-center display-inline">
                                    <form action="/draft/print" method="post" target="_blank" rel="noopener noreferrer">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$data->validasi_id}}">
                                        <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="cetak"><i class="fa fa-print" aria-hidden="true"></i></button>
                                    </form>
                                    @if($data->status == 2)
                                    <a href="storage/surat/SURAT%20PERGANTIAN.docx" class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer">Unduh</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="flex-c-m stext-101 cl0 size-115 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-hide-modal2">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="wrap-modal2 js-modal2 p-t-60 p-b-20 show-modal2">
    <div class="overlay-modal2 js-hide-modal2"></div>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="bg0 how-pos3-parent">
                <div class="container p-all-20">
                    <h5 class="display-5 p-t-10 text-capitalize">Selamat datang {{Auth::user()->name}}</h5>
                    <h5 class="txt-center display-5 p-tb-30">
                        Anda tidak memiliki pinjaman.
                    </h5>
                    <button class="flex-c-m stext-101 cl0 size-115 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-hide-modal2">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endauth
@endsection

@push('style')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/botman/chat.min.css"> -->
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/slick/slick.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('/front') }}/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.css">
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
<script>
    $(document).ready(function() {
        $('#example-1').DataTable({
            "pagingType": "simple_numbers",
            oLanguage: {
                oPaginate: {
                    sNext: '<i class="zmdi zmdi-skip-next" style="font-size: 19px;"></i>',
                    sPrevious: '<i class="zmdi zmdi-skip-previous" style="font-size: 19px;"></i>'
                }
            },
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ]
        });
        $('.dataTables_filter').addClass('pull-right');
        $('.dataTables_info').addClass('pull-left');
    });
</script>
<script src="{{ asset('/front') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush