@extends('back.layouts.index')
@push('title', 'Show Pengguna')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Detail Pengguna</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Pengguna</span></li>
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
                        @if($user->photo_profile)
                        <img src="{{  url('/storage/'. $user->photo_profile) }}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{$user->name}}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @endif
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{$user->name}}</span>
                            <span class="thumb-info-type">{{$user->roles}}</span>
                        </div>
                    </div>

                    <h6 class="text-muted">Data Profile</h6>
                    <ul class="simple-todo-list">
                        <li class="{{$user->photo_profile ? 'completed' : 'text-warning'}}">Update Poto Profil</li>
                        <li class="{{$user->password_tidack_enkripsi != 12345678 ? 'completed' : 'text-warning'}}">Ganti Password</li>
                    </ul>
                    @if($user->roles == 'Mahasiswa' || $user->roles == 'Dosen')
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
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="{{ request()->is('pengguna/*') ? 'active' : '' }}">
                        <a href="#overview" data-toggle="tab">Home</a>
                    </li>
                    @if($user->roles == 'Mahasiswa' || $user->roles == 'Dosen')
                    <li>
                        <a href="#other" data-toggle="tab">Lainnya</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane {{ request()->is('pengguna/*') ? 'active' : '' }}">
                        <h4 class="mb-md">About Me</h4>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>NIDN</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{$user->nim_nidn}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Status</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{ $user->status_mhs ? $user->status_mhs : 'null' }}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Jenis Kelamin</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{$user->jenis_kelamin ? $user->jenis_kelamin : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Alamat</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{$user->alamat ? $user->alamat : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Rt / Rw</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{$user->rt ? $user->rt : 'null'}} / {{$user->rw ? $user->rw : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Desa</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{$user->desa ? $user->desa : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Kota / Kabupaten</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{$user->kota ? $user->kota : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>No. Telp</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8 mb-xlg">
                                <h5>{{$user->no_telp ? $user->no_telp : 'null'}}</h5>
                            </div>
                        </div>
                    </div>
                    <div id="other" class="tab-pane">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Daftar Permohonan Pinjaman</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keperluan</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permohonan as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('validasi.show', $data->id) }}" style="color: #7280e0;">{{ $data->keperluan }}</a></td>
                                            <td>{{ count($data->draft) }}</td>
                                            <td>{{ date('d F', strtotime( $data->tanggal_start )) }} sd. {{ date('d F Y', strtotime( $data->tanggal_finish )) }}</td>
                                            <td>
                                                @if( $data->status == 3 )
                                                <label class="badge badge-danger shadow">Kadaluarsa</label>
                                                @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 1 && $data->status == 0 )
                                                <label class="badge badge-success shadow">Disetujui</label>
                                                @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 0 )
                                                <label class="badge badge-light shadow">Seleksi BMN</label>
                                                @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 0 && $data->validasi_bmn == 0 )
                                                <label class="badge badge-light shadow">Seleksi Koordinator</label>
                                                @elseif( $data->validasi_ktu == 0 && $data->validasi_koor == 0 && $data->validasi_bmn == 0 )
                                                <label class="badge badge-light shadow">Seleksi TU</label>
                                                @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 2 )
                                                <label class="badge badge-danger shadow">Tolak BMN</label>
                                                @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 2 && $data->validasi_bmn == 0 )
                                                <label class="badge badge-danger shadow">Tolak Koordionator</label>
                                                @elseif( $data->validasi_ktu == 2 && $data->validasi_koor == 0 && $data->validasi_bmn == 0 )
                                                <label class="badge badge-danger shadow">Tolak TU</label>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Daftar Pinjaman</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default-2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keperluan</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Ambil</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($peminjaman as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('peminjaman.show', $data->id) }}" style="color: #7280e0;">{{ $data->validasi->keperluan }}</a></td>
                                            <td>{{ count($data->validasi->draft) }}</td>
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
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Daftar Pengembalian</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default-3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keperluan</th>
                                            <th>Tanggal Ambil</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Penilaian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pengembalian as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('pengembalian.show', $data->id) }}" style="color: #7280e0;">{{ $data->validasi->keperluan }}</a></td>
                                            <td>{{ date('d F Y', strtotime( $data->date_ambil )) }}</td>
                                            <td>{{ date('d F Y', strtotime( $data->date_kembali )) }}</td>
                                            <td id="rate-rating">
                                                @if($data->rating)
                                                @if($data->rating->penilaian == 1)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @elseif($data->rating->penilaian == 2)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @elseif($data->rating->penilaian == 3)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @elseif($data->rating->penilaian == 4)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @elseif($data->rating->penilaian == 5)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                @endif
                                                @else
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
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

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script>
    function previewImage(input) {
        var file = $("input[type=file]").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $('#preview_pengguna').attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
@endpush