@extends('back.layouts.index')
@push('title', 'Validasi | Detail')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Detail Validasi</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>validasi</span></li>
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
                        @if($validasi->user->photo_profile)
                        <img src="{{  url('/storage/'. $validasi->user->photo_profile) }}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{$validasi->user->name}}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @endif
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{$validasi->user->name}}</span>
                            <span class="thumb-info-type">{{$validasi->user->roles}}</span>
                        </div>
                    </div>

                    <h6 class="text-muted">Data Profile</h6>
                    <div class="content">
                        <ul class="simple-user-list">
                            <li>
                                <span class="title">NIM/NIDN</span>
                                <span class="message truncate">{{$validasi->user->nim_nidn}}</span>
                            </li>
                            <li>
                                <span class="title">Email</span>
                                <span class="message truncate">{{$validasi->user->email}}</span>
                            </li>
                            <li>
                                <span class="title">No Telp</span>
                                <span class="message truncate">{{$validasi->user->no_telp}}</span>
                            </li>
                        </ul>
                    </div>
                    @if($validasi->user->roles == 'Mahasiswa' || $validasi->user->roles == 'Dosen')
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
                                        {{ count($validasi->draft) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Proposal
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        <a href="/storage/{{ $validasi->proposal }}" target="_blank" rel="noopener noreferrer">
                                            <span class="mb-xs mt-xs btn btn-success btn-xs c-default" style="cursor: pointer;"> <i class="fa fa-download"></i> Download</span>
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
                                        {{ $validasi->keperluan }}
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
                                        {{ date('d F Y', strtotime( $validasi->tanggal_start )) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Sampai
                                    </span>
                                </div>
                                <div class="size-209">
                                    <span class="stext-115 cl2">
                                        {{ date('d F Y', strtotime( $validasi->tanggal_finish )) }}
                                    </span>
                                </div>
                                <div class="size-208">
                                    <span class="stext-115 cl2">
                                        Status
                                    </span>
                                </div>
                                <div class="size-209">
                                    @if($validasi->status == 3)
                                    <span class="mb-xs mt-xs btn btn-dark btn-xs c-default">Kedaluwarsa <i class="fa fa-check-circle"></i></span>
                                    @elseif( $validasi->status == 1 )
                                    <span class="mb-xs mt-xs btn btn-info btn-xs c-default">Diambil <i class="fa fa-fax"></i></span>
                                    @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 0 )
                                    <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Seleksi BMN <i class="fa fa-spinner"></i></span>
                                    @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                                    <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Seleksi Koordinator <i class="fa fa-spinner"></i></span>
                                    @elseif( $validasi->validasi_ktu == 0 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                                    <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Seleksi TU <i class="fa fa-spinner"></i></span>
                                    @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 2 )
                                    <span class="mb-xs mt-xs btn btn-danger btn-xs c-default">Tolak BMN <i class="fa fa-times-circle"></i></span>
                                    @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 2 && $validasi->validasi_bmn == 0 )
                                    <span class="mb-xs mt-xs btn btn-danger btn-xs c-default">Tolak Koordinator <i class="fa fa-times-circle"></i></span>
                                    @elseif( $validasi->validasi_ktu == 2 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                                    <span class="mb-xs mt-xs btn btn-danger btn-xs c-default">Tolak TU <i class="fa fa-times-circle"></i></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-xl">
                        @if($validasi->status != 3)
                        @if(Auth::user()->roles == 'KTU' && $validasi->validasi_ktu == 0 && $validasi->validasi_koor == 0 || Auth::user()->roles == 'KTU' && $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 0 || Auth::user()->roles == 'KTU' && $validasi->validasi_ktu == 2 && $validasi->validasi_koor == 0)
                        @if($validasi->validasi_ktu == 0)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sebelum_ktu" value="2">
                            <button type="submit" class="mr-xs btn btn-danger btn-xs"><i class="fa fa-times"></i>Tolak</button>
                        </form>
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sebelum_ktu" value="1">
                            <button type="submit" class="mr-xs btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i>Setuju</button>
                        </form>
                        @elseif($validasi->validasi_ktu == 2)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sudah_ktu" value="1">
                            <button type="submit" class="mr-xs btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i>Setuju</button>
                        </form>
                        @elseif($validasi->validasi_ktu == 1)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sudah_ktu" value="2">
                            <button type="submit" class="mr-xs btn btn-danger btn-xs"><i class="fa fa-times"></i>Tolak</button>
                        </form>
                        @endif
                        @elseif(Auth::user()->roles == 'Koordinator' && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 || Auth::user()->roles == 'Koordinator' && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 0 || Auth::user()->roles == 'Koordinator' && $validasi->validasi_koor == 2 && $validasi->validasi_bmn == 0)
                        @if($validasi->validasi_koor == 0)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sebelum_koor" value="1">
                            <button type="submit" class="mr-xs btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i>Setuju</button>
                        </form>
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sebelum_koor" value="2">
                            <button type="submit" class="mr-xs btn btn-danger btn-xs"><i class="fa fa-times"></i>Tolak</button>
                        </form>
                        @elseif($validasi->validasi_koor == 2)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sudah_koor" value="1">
                            <button type="submit" class="mr-xs btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i>Setuju</button>
                        </form>
                        @elseif($validasi->validasi_koor == 1)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sudah_koor" value="2">
                            <button type="submit" class="mr-xs btn btn-danger btn-xs"><i class="fa fa-times"></i>Tolak</button>
                        </form>
                        @endif
                        @elseif(Auth::user()->roles == 'BMN' && $validasi->validasi_bmn == 0 && $validasi->status == 0 || Auth::user()->roles == 'BMN' && $validasi->validasi_bmn == 1 && $validasi->status == 0 || Auth::user()->roles == 'BMN' && $validasi->validasi_bmn == 3 && $validasi->status == 0)
                        @if($validasi->validasi_bmn == 0)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sebelum_bmn" value="1">
                            <button type="submit" class="mr-xs btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i>Setuju</button>
                        </form>
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sebelum_bmn" value="2">
                            <button type="submit" class="mr-xs btn btn-danger btn-xs"><i class="fa fa-times"></i>Tolak</button>
                        </form>
                        @elseif($validasi->validasi_bmn == 2)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sudah_bmn" value="1">
                            <button type="submit" class="mr-xs btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i>Setuju</button>
                        </form>
                        @elseif($validasi->validasi_bmn == 1)
                        <form action="/validasi/{{$validasi->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sudah_bmn" value="2">
                            <button type="submit" class="mr-xs btn btn-danger btn-xs"><i class="fa fa-times"></i>Tolak</button>
                        </form>
                        @endif
                        @endif
                        @endif
                    </div>
                    @if($validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 1 && $validasi->status == 0)
                    <a id="ambil" data-validasi_id="{{ $validasi->id }}" data-user_id="{{ $validasi->user_id }}" class="mb-xl btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Ambil"> <i class="fa fa-truck"></i> Ambil</a>
                    @endif
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($validasi->draft as $data)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $data->sarpras->nama }}</td>
                                <td>{{ $data->qty == 0 ? $data->sarpras_keluar->jumlah : $data->qty }}</td>
                                <td class="center">
                                    <a href="#Photo" id="show" data-nama_item="{{ $data->sarpras->nama }}" data-img="{{ $data->sarpras->photo }}" data-desc="{{$data->sarpras->deskripsi}}" class="btn btn-primary btn-sm modal-with-zoom-anim" data-toggle="tooltip" data-placement="top" title="Foto">
                                        <i class="fa fa-picture-o"></i>
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
    $(document).on('click', '#show', function() {
        var nama = $(this).data('nama_item');
        var img = $(this).data('img');
        var desc = $(this).data('desc');

        $('.panel-title').text(nama);
        $('#img').attr("src", '/storage/' + img);
        $('p#deskripsi').text(desc);
    });
    $(document).on('click', '#ambil', function() {
        var validasi_id = $(this).data('validasi_id');
        var user_id = $(this).data('user_id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal.fire({
            title: 'Apa kamu yakin?',
            text: "Peminjam mengambil sarpras peminjaman!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, yakin!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "{{ route('peminjaman.store') }}",
                    data: {
                        'validasi_id': validasi_id,
                        'user_id': user_id,
                    },
                    success: function(response) {
                        if (response.error_message) {
                            swal.fire({
                                icon: 'error',
                                title: 'Oops..!',
                                text: response.error_message
                            });
                        } else if (response.success_message) {
                            swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success_message
                            }).then((result) => {
                                location.reload();
                            })
                        }
                    },
                    error: function(xhr) {
                        swal.fire({
                            icon: 'error',
                            title: 'Oops..!',
                            text: 'Someting went wrong!'
                        });
                    }
                });
            }
        })
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