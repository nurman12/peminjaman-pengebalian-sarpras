@extends('back.layouts.index')
@push('title', 'Pengembalian | Validasi')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Validasi Pengembalian</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Pengembalian</span></li>
                <li><span style="margin-right: 20px;">Validasi</span></li>
            </ol>

        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        @if($peminjaman->validasi->user->photo_profile)
                        <img src="{{  url('/storage/'. $peminjaman->user->photo_profile) }}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{$peminjaman->user->name}}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @endif
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{$peminjaman->user->name}}</span>
                            <span class="thumb-info-type">{{$peminjaman->user->roles}}</span>
                        </div>
                    </div>

                    <h6 class="text-muted">Data Profile</h6>
                    <div class="content">
                        <ul class="simple-user-list">
                            <li>
                                <span class="title">NIM/NIDN</span>
                                <span class="message truncate">{{$peminjaman->user->nim_nidn}}</span>
                            </li>
                            <li>
                                <span class="title">Email</span>
                                <span class="message truncate">{{$peminjaman->user->email}}</span>
                            </li>
                            <li>
                                <span class="title">No Telp</span>
                                <span class="message truncate">{{$peminjaman->user->no_telp}}</span>
                            </li>
                        </ul>
                    </div>
                    @if($peminjaman->user->roles == 'Mahasiswa' || $peminjaman->user->roles == 'Dosen')
                    <hr class="dotted short">

                    <div class="social-icons-list">
                        <blockquote class="primary rounded b-thin mt-md" style="background-color: #f5f5f5;">
                            <div class="user-rating">
                                <h3>{{ $rate }}</h3>
                                <div id="rate-rating">
                                    <div class="star">
                                        @if($rate == 0)<i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        @elseif($rate <= 0.8 ) <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            @elseif($rate <=1.2) <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                @elseif($rate <=1.8) <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    @elseif($rate <=2.2) <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        @elseif($rate <=2.8) <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            @elseif($rate <=3.2) <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                @elseif($rate <=3.8) <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    @elseif($rate <=4.2) <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                        @elseif($rate <=4.8) <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-half-o"></i>
                                                                            @elseif($rate <=5) <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-stars"></i>
                                                                                <i class="fa fa-star-o"></i>
                                                                                @endif
                                    </div>
                                    <span class="no-user">
                                        <span>{{ $jumlah }}</span>&nbsp;&nbsp;
                                        reviews
                                    </span>
                                </div>
                            </div>

                        </blockquote>
                    </div>
                    @endif
                </div>
            </section>
        </div>
        <div class="col-md-8 col-lg-9">
            <section class="panel">
                <div class="panel-body">
                    <div class="row mb-xl">
                        <div class="col-md-8 col-sm-12">
                            <div class="flex-w flex-t">
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Jumlah
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ count($peminjaman->validasi->draft) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Proposal
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        <a href="/storage/{{ $peminjaman->validasi->proposal }}" target="_blank" rel="noopener noreferrer">
                                            <span class="mb-xs mt-xs btn btn-success btn-xs c-default" style="cursor: pointer;"> <i class="fa fa-file"></i> Download</span>
                                        </a>
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Keperluan
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ $peminjaman->validasi->keperluan }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="flex-w flex-t">
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Mulai
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ date('d F Y', strtotime( $peminjaman->validasi->tanggal_start )) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Sampai
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ date('d F Y', strtotime( $peminjaman->validasi->tanggal_finish )) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Status
                                    </span>
                                </div>
                                <div class="size-209">
                                    @if( $peminjaman->status == 0 )
                                    <span class="mb-xs mt-xs btn btn-info btn-xs c-default">Dibawa <i class="fa fa-spinner"></i></span>
                                    @elseif( $peminjaman->status == 1 )
                                    <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Dikembalikan <i class="fa fa-check-circle"></i></span>
                                    @elseif( $peminjaman->status == 2 )
                                    <span class="mb-xs mt-xs btn btn-danger btn-xs c-default">Tanggungan <i class="fa fa-check-circle"></i></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl">
                        <div class="col-md-8 col-sm-12">
                            <div class="flex-w flex-t">
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Pengambilan
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ date('d F Y', strtotime( $peminjaman->date_ambil )) }}
                                    </span>
                                </div>
                                @if($peminjaman->date_kembali)
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Dikembalikan
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ date('d F Y', strtotime( $peminjaman->date_kembali )) }}
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman->validasi->draft as $data)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $data->sarpras->nama }}</td>
                                <td>{{ $data->qty }}</td>
                                <td>
                                    @if($data->kondisi == 0)
                                    <span class="badge badge-warning bdg-yellow">Dipinjam</span>
                                    @elseif($data->kondisi == 1)
                                    <span class="badge badge-success bdg-green">Dikembalikan</span>
                                    @elseif($data->kondisi == 2)
                                    <span class="badge badge-danger bdg-red">Tanggungan</span>
                                    @endif
                                </td>
                                <?php
                                $sarpras_masuk = App\Models\SarprasDetail::where('draft_id', $data->id)->where('jenis', 'masuk')->first();
                                if ($sarpras_masuk == null) {
                                    $jumlah_kembali = 0;
                                } else {
                                    $jumlah_kembali = $sarpras_masuk->jumlah;
                                }
                                ?>
                                <td>
                                    @if( $data->sarpras_keluar->hilang > 0 )
                                    <p class="text-lowercase">{{ $data->sarpras_keluar->hilang }} rusak / hilang, {{ $data->sarpras_keluar->keterangan }}</p>
                                    @else
                                    <p>{{ $data->sarpras_keluar->keterangan }}</p>
                                    @endif
                                </td>
                                <td class="center">
                                    <a href="#photo" id="show" data-nama_item="{{ $data->sarpras->nama }}" data-img="{{ $data->sarpras->photo }}" data-desc="{{$data->sarpras->deskripsi}}" class="mr-xs btn btn-primary btn-xs modal-with-zoom-anim">
                                        <i class="fa fa-picture-o"></i>
                                        Photo
                                    </a>
                                    <a href="#varifikasi" id="validasi" data-id="{{$data->id}}" data-peminjaman_id="{{$peminjaman->id}}" data-title="{{$data->sarpras->nama}}" data-img_sarpras="{{$data->sarpras->photo}}" data-jumlah_pinjam="{{ App\Models\SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->sum('jumlah') }}" data-jumlah_kembali="{{ $jumlah_kembali }}" data-jumlah_tanggungan="{{ $data->qty }}" data-jumlah_hilang="{{  App\Models\SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->first()->hilang }}" class="mr-xs btn btn-warning btn-xs modal-with-zoom-anim">
                                        <i class="fa fa-pencil-square-o"></i>
                                        Validasi
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!-- End page -->
</section>
</div>
@endsection

@push('style')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/theme-custom.css">
@endpush

@push('modals')
<div id="photo" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"></h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="row">
                    <div class="col-md-4">
                        <img id="img" class="img-responsive" src="">
                    </div>
                    <div class="col-md-8">
                        <p id="deskripsi"></p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>
<div id="varifikasi" class="zoom-anim-dialog modal-block modal-block-lg modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"></h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="row">
                    <div class="col-md-4">
                        <img id="img" class="img-responsive" src="">
                    </div>
                    <div class="col-md-7">
                        <h4 class="display-5 text-dark">Keterangan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-8">Total Pinjam</label>
                                    <label class="col-md-3" id="jumlah_pinjam"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-8">Tanggungan</label>
                                    <label class="col-md-3" id="jumlah_tanggungan"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-8">Dikembalikan</label>
                                    <label class="col-md-3" id="jumlah_kembali"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-8">Hilang / Rusak</label>
                                    <label class="col-md-3" id="jumlah_hilang"></label>
                                </div>
                            </div>
                        </div>
                        <h4 class="display-5 mt-xl text-dark">Masukkan Data</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Sesuai</label>
                                <select class="form-control" name="sesuai" id="sesuai">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Hilang / Rusak</label>
                                <input type="hidden" class="draft_id" id="draft_">
                                <select class="form-control" name="tidack" id="tidack">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="primary rounded b-thin">
                            <span class="text-danger">Catatan*</span>
                            <ol>
                                <li>Masukkan jumlah sarpras sesuai atau kondisi normal pada form <span class="text-warning">sesuai</span></li>
                                <li>Masukkan jumlah sarpras tidak sesuai atau dengan kondisi rusak / hilang pada form <span class="text-warning">rusak / hilang</span></li>
                            </ol>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary modal-dismiss" data-id="{{$peminjaman->id}}" id="modal-confirm">Confirm</button>
                    <button class="btn btn-default modal-dismiss" id="modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>
<div id="modal-rating" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Memberi Penilaian</h4>
            </div>
            <div class="modal-body">
                <div class="container-rating">
                    <div class="rating">
                        <input type="hidden" id="kembali_id" name="pengembalian">
                        <input type="radio" name="rating" id="rating-5">
                        <label for="rating-5"></label>
                        <input type="radio" name="rating" id="rating-4">
                        <label for="rating-4"></label>
                        <input type="radio" name="rating" id="rating-3">
                        <label for="rating-3"></label>
                        <input type="radio" name="rating" id="rating-2">
                        <label for="rating-2"></label>
                        <input type="radio" name="rating" id="rating-1">
                        <label for="rating-1"></label>
                        <div class="emoji-wrapper">
                            <div class="emoji">
                                <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                    <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534" />
                                    <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff" />
                                    <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347" />
                                    <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63" />
                                    <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff" />
                                    <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347" />
                                    <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63" />
                                    <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347" />
                                </svg>
                                <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                    <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347" />
                                    <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534" />
                                    <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff" />
                                    <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347" />
                                    <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff" />
                                    <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534" />
                                    <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff" />
                                    <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347" />
                                    <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff" />
                                </svg>
                                <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                    <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347" />
                                    <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff" />
                                    <circle cx="340" cy="260.4" r="36.2" fill="#3e4347" />
                                    <g fill="#fff">
                                        <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10" />
                                        <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z" />
                                    </g>
                                    <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347" />
                                    <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff" />
                                </svg>
                                <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                    <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347" />
                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                    <g fill="#fff">
                                        <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z" />
                                        <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81" />
                                    </g>
                                    <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                    <g fill="#fff">
                                        <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1" />
                                        <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81" />
                                    </g>
                                    <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                    <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff" />
                                </svg>
                                <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                    <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                                    <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f" />
                                    <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                                    <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                                    <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f" />
                                    <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                                    <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347" />
                                    <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b" />
                                </svg>
                                <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <g fill="#ffd93b">
                                        <circle cx="256" cy="256" r="256" />
                                        <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z" />
                                    </g>
                                    <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4" />
                                    <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea" />
                                    <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88" />
                                    <g fill="#38c0dc">
                                        <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z" />
                                    </g>
                                    <g fill="#d23f77">
                                        <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z" />
                                    </g>
                                    <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347" />
                                    <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b" />
                                    <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="" class="text-dark">Keterangan</label>
                        <textarea class="form-control" rows="3" id="textareaAutosize" data-plugin-textarea-autosize></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary simpan-rating">Simpan</button>
                <button type="button" class="btn btn-default tutup-rating" data-dismiss="modal">Nanti</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-autosize/jquery.autosize.js"></script>
<!-- <script src="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.js"></script> -->
@endpush

@push('last_script')
<script>
    // photo
    $(document).on('click', '#show', function() {
        var nama = $(this).data('nama_item');
        var img = $(this).data('img');
        var desc = $(this).data('desc');

        $('.panel-title').text(nama);
        $('#img').attr("src", '/storage/' + img);
        $('p#deskripsi').text(desc);
    });

    // validasi
    $(document).on('click', '#validasi', function() {
        var title = $(this).data('title');
        var sarpras = $(this).data('img_sarpras');
        var pinjam = $(this).data('jumlah_pinjam');
        var kembali = $(this).data('jumlah_kembali');
        var hilang = $(this).data('jumlah_hilang');
        var draft_id = $(this).data('id');
        var tanggungan = $(this).data('jumlah_tanggungan');

        $('.panel-title').text(title);
        $('#img').attr("src", '/storage/' + sarpras);
        $('#jumlah_pinjam').text(pinjam);
        $('#jumlah_kembali').text(kembali);
        $('#jumlah_hilang').text(hilang);
        $('#jumlah_tanggungan').text(tanggungan);
        $('.draft_id').val(draft_id);

        $(document).on('click', "#sesuai", function() {
            let tidack = document.getElementById("tidack").value;
            let value = pinjam - tidack;
            $("#sesuai option").remove()
            let sesuai = document.getElementById("sesuai");
            sesuai.innerHTML = "<option selected disabled>0</option>";
            for (let i = 1; i <= value; i++) {
                sesuai.innerHTML += "<option value='" + i + "'>" + i + "</option>";
            }
        });

        $(document).on('click', "#tidack", function() {
            let sesuai = document.getElementById("sesuai").value;
            let value = pinjam - sesuai;
            $("#tidack option").remove()
            let tidack = document.getElementById("tidack");
            tidack.innerHTML = "<option selected disabled>0</option>";
            for (let i = 1; i <= value; i++) {
                tidack.innerHTML += "<option value='" + i + "'>" + i + "</option>";
            }
        });

    });

    // confirm modal validasi
    $(document).on('click', '#modal-confirm', function() {
        var id = $(this).data('id');

        var draft_ = document.getElementById("draft_").value;
        var sesuai = document.getElementById("sesuai").value;
        var tidack = document.getElementById("tidack").value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "PUT",
            url: "/peminjaman/" + id,
            data: {
                'draft_id': draft_,
                'sesuai': sesuai,
                'tidack': tidack,
            },
            success: function(response) {
                if (response.error_message) {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.error_message
                    })
                } else if (response.success_message) {
                    swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.success_message
                    }).then((result) => {
                        location.reload();
                    })
                } else if (response.success_message_other) {
                    swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.success_message_other
                    }).then((result) => {
                        location.reload();
                    })
                }
            },
            error: function(xhr) {
                swal.fire({
                    type: 'error',
                    title: 'Oops..!',
                    text: 'Someting went wrong!'
                });
            }
        });
    });

    // tutup modal validasi
    $(document).on('click', '#modal-dismiss', function() {
        $("#sesuai option").remove()
        $("#tidack option").remove()

        $('#sesuai').val("");
        $('#tidack').val("");
    });

    // simpan rating
    $(document).on('click', '.simpan-rating', function() {
        var nilai = document.querySelector('.rating input[type="radio"][name="rating"]:checked').id;
        var rate = nilai.split("-")
        var pengembalian_id = document.getElementById('kembali_id').value;
        var keterangan = document.getElementById('textareaAutosize').value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/rating",
            data: {
                'pengembalian_id': pengembalian_id,
                'penilaian': rate[1],
                'keterangan': keterangan,
            },
            success: function(response) {
                swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.success_message
                }).then((result) => {
                    location.reload();
                })
            },
            error: function(xhr) {
                swal.fire({
                    type: 'error',
                    title: 'Oops..!',
                    text: 'Someting went wrong!'
                });
            }
        });
    });

    // cek validasi
    <?php
    if ($peminjaman->status == 1 && !$peminjaman->rating) {
    ?>
        var id = <?= $peminjaman->id; ?>;
        swal.fire({
            title: 'Apakah kamu ingin memberi rating?',
            text: "Kamu dapat memberikan rating dilain waktu jika kamu tidak memberi rating sekarang",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Nanti`,
        }).then((result) => {
            if (result.isConfirmed) {
                $('#modal-rating').modal('show');
                $('#kembali_id').val(id);
            } else if (result.isDenied) {
                swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.success_message
                }).then((result) => {
                    location.reload();
                })
            }
        })
    <?php } ?>

    // tutup modal rating
    $(document).on('click', '.tutup-rating', function() {
        location.reload();
    });
</script>

<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
<script src="{{ asset('/back') }}/javascripts/ui-elements/examples.modals.js"></script>
@endpush