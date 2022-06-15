@extends('back.layouts.index')
@push('title', 'Pengembalian | Detail')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Detail Pengembalian</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>pengembalian</span></li>
                <li><span style="margin-right: 20px;">Detail</span></li>
            </ol>

        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        @if($pengembalian->validasi->user->photo_profile)
                        <img src="{{  url('/storage/'. $pengembalian->user->photo_profile) }}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{$pengembalian->user->name}}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @endif
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{$pengembalian->user->name}}</span>
                            <span class="thumb-info-type">{{$pengembalian->user->roles}}</span>
                        </div>
                    </div>

                    <h6 class="text-muted">Data Profile</h6>
                    <div class="content">
                        <ul class="simple-user-list">
                            <li>
                                <span class="title">NIM/NIDN</span>
                                <span class="message truncate">{{$pengembalian->user->nim_nidn}}</span>
                            </li>
                            <li>
                                <span class="title">Email</span>
                                <span class="message truncate">{{$pengembalian->user->email}}</span>
                            </li>
                            <li>
                                <span class="title">No Telp</span>
                                <span class="message truncate">{{$pengembalian->user->no_telp}}</span>
                            </li>
                        </ul>
                    </div>
                    @if($pengembalian->user->roles == 'Mahasiswa' || $pengembalian->user->roles == 'Dosen')
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
                                        {{ count($pengembalian->validasi->draft) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Proposal
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        <a href="/storage/{{ $pengembalian->validasi->proposal }}" target="_blank" rel="noopener noreferrer">
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
                                        {{ $pengembalian->validasi->keperluan }}
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
                                        {{ date('d F Y', strtotime( $pengembalian->validasi->tanggal_start )) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Sampai
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ date('d F Y', strtotime( $pengembalian->validasi->tanggal_finish )) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Status
                                    </span>
                                </div>
                                <div class="size-209">
                                    @if( $pengembalian->status == 0 )
                                    <span class="mb-xs mt-xs btn btn-info btn-xs c-default">Dibawa <i class="fa fa-spinner"></i></span>
                                    @elseif( $pengembalian->status == 1 )
                                    <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Dikembalikan <i class="fa fa-check-circle"></i></span>
                                    @elseif( $pengembalian->status == 2 )
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
                                        {{ date('d F Y', strtotime( $pengembalian->date_ambil )) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Dikembalikan
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ date('d F Y', strtotime( $pengembalian->date_kembali )) }}
                                    </span>
                                </div>
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
                            @foreach($pengembalian->validasi->draft as $data)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $data->sarpras->nama }}</td>
                                <td>
                                    @if($data->kondisi == 1)
                                    {{ $data->sarpras_masuk->jumlah }}
                                    @else
                                    {{ $data->qty }}
                                    @endif
                                </td>
                                <td>
                                    @if($data->kondisi == 0)
                                    <span class="badge badge-warning bdg-yellow">Dipinjam</span>
                                    @elseif($data->kondisi == 1)
                                    <span class="badge badge-success bdg-green">Dikembalikan</span>
                                    @elseif($data->kondisi == 2)
                                    <span class="badge badge-danger bdg-red">Tanggungan</span>
                                    @endif
                                </td>
                                <td>
                                    <?php

                                    $sarpras_keluar = App\Models\SarprasDetail::where('draft_id', $data->id)
                                        ->where('jenis', 'keluar')
                                        ->first();

                                    ?>
                                    @if( $sarpras_keluar->hilang > 0 )
                                    <p class="text-lowercase">{{ $sarpras_keluar->hilang }}
                                        {{ $sarpras_keluar->keterangan }}
                                    </p>
                                    @endif
                                </td>
                                <td class="center">
                                    <a href="#Photo" id="show" data-nama_item="{{ $data->sarpras->nama }}" data-img="{{ $data->sarpras->photo }}" data-desc="{{$data->sarpras->deskripsi}}" class="mr-xs btn btn-primary btn-xs modal-with-zoom-anim">
                                        <i class="fa fa-picture-o"></i>
                                        Photo
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($pengembalian->status == 1 && !empty($pengembalian->rating))
                    <blockquote class="primary rounded b-thin mt-md" style="background-color: #f5f5f5;">
                        @if($pengembalian->rating)
                        <p class="lead" style="margin-bottom: 1rem;">{{ $pengembalian->rating->keterangan != null ? $pengembalian->rating->keterangan : null }}</p>
                        @endif
                        <div class="container-show-rating">
                            <div class="rating-s">
                                @if($pengembalian->rating->penilaian == 1)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                @elseif($pengembalian->rating->penilaian == 2)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                @elseif($pengembalian->rating->penilaian == 3)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                @elseif($pengembalian->rating->penilaian == 4)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                @elseif($pengembalian->rating->penilaian == 5)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                @endif
                            </div>
                        </div>
                        @if($pengembalian->rating)
                        <small>{{ showDateTime($pengembalian->rating->updated_at, 'l, d F Y') }}</small>
                        @endif
                    </blockquote>
                    @endif
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
@endpush

@push('modals')
<div id="Photo" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
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
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '#show', function() {
            var nama = $(this).data('nama_item');
            var img = $(this).data('img');
            var desc = $(this).data('desc');

            $('.panel-title').text(nama);
            $('#img').attr("src", '/storage/' + img);
            $('p#deskripsi').text(desc);
        });
    });
</script>
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
<script src="{{ asset('/back') }}/javascripts/ui-elements/examples.modals.js"></script>
@endpush