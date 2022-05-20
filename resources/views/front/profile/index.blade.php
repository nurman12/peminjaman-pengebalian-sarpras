@extends('front.layouts.index_')
@push('title', 'Profile')
@section('content')

<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="profile-header">
            <div class="profile-img">
                @if(Auth::user()->photo_profile)
                <img src="{{  url('/storage/photo/'. Auth::user()->photo_profile)}}" width="200" alt="">
                @else
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" width="200" alt="">
                @endif
            </div>
            <div class="profile-nav-info">
                <h3 class="user-name">{{ Auth::user()->name }}</h3>
                <div class="address">
                    <p class="state">{{ Auth::user()->desa }},</p>
                    <span class="country">{{ Auth::user()->kota }}</span>
                </div>
            </div>
            <!-- <div class="profile-option">
                <div class="notification">
                    <i class="lnr lnr-alarm"></i>
                    <span class="alert-message">1</span>
                </div>
            </div> -->
        </div>
        <div class="main-bd">
            <div class="left-side">
                <div class="profile-side">
                    <div class="flex-w w-full p-b-18">
                        <span class="fs-18 txt-center cl5 p-t-2 size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Email
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-8">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                    <div class="flex-w w-full p-b-18">
                        <span class="fs-18 txt-center cl5 p-t-2 size-211">
                            <span class="lnr lnr-license"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                NIM / NIDN
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-8">
                                {{ Auth::user()->nim_nidn }}
                            </p>
                        </div>
                    </div>
                    <div class="flex-w w-full p-b-18">
                        <span class="fs-18 txt-center cl5 p-t-2 size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                No Telp
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-8">
                                {{ Auth::user()->no_telp }}
                            </p>
                        </div>
                    </div>
                    <div class="profile-btn">
                        <button class="chatbtn js-show-modal1">
                            <i class="fa fa-user "></i>
                            Detail
                        </button>
                        <button class="createbtn js-show-modal2">
                            <i class="fa fa-key"></i>
                            Password
                        </button>
                    </div>
                    <div class="user-rating p-b-18">
                        <h3 class="rating">{{ $rate }}</h3>
                        <div class="rate">
                            <div class="stars">
                                @if($rate <= 0.8 ) <i class="fa fa-star-half-o"></i>
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
                </div>
            </div>
            <div class="right-side">
                <div class="nav-side">
                    <ul>
                        <li onclick="tabs(0)" class="user-post active">Permohonan</li>
                        <li onclick="tabs(1)" class="user-review">Peminjaman</li>
                        <li onclick="tabs(2)" class="user-setting">Pengembalian</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-posts tab">
                        <h4 class="mtext-112 cl2 p-b-27">Daftar Permohonan Pinjaman</h4>
                        @if(\Session::has('status'))
                        <div class="alert alert-success alert-dismissible fade show txt-left" role="alert">
                            <strong>Peringatan !!</strong> {{\Session::get('status')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <table class="table table-striped table-hover table-bordered" id="example-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Keperluan</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                                        @if( $data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 1 && $data->status == 0 )
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
                                    <td class="text-center display-inline">
                                        @if($data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 1)
                                        <form action="/draft/print" method="post" target="_blank" rel="noopener noreferrer">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="cetak"><i class="fa fa-print" aria-hidden="true"></i></button>
                                        </form>
                                        @endif
                                        @if($data->validasi_ktu == 0)
                                        <a href="{{ route('validasi.edit', $data->id) }}" class="btn btn-warning btn-sm fa fa-pencil-square-o" data-toggle="tooltip" title="Ubah"></a>
                                        <form action="{{ route('validasi.destroy', $data->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="proposal" value="{{$data->proposal}}">
                                            <button type="submit" onclick="return confirm('Yakin ingin Hapus ini?')" class="btn btn-danger btn-sm fa fa-trash" data-toggle="tooltip" title="Hapus"><button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="profile-review tab">
                        <h4 class="mtext-112 cl2 p-b-27">Daftar Peminjaman</h4>
                        <table class="table table-striped table-hover table-bordered" id="example-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Keperluan</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Ambil</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                                    <td class="text-center display-inline">
                                        @if($data->status == 2)
                                        <a href="storage/surat/SURAT%20PERGANTIAN.docx" class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer">Unduh</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="profile-setting tab">
                        <h4 class="mtext-112 cl2 p-b-27">Daftar Pengembalian</h4>
                        <table class="table table-striped table-hover table-bordered" id="example-3">
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.css">
@endpush

@push('script')
<script src="{{ asset('/back') }}/vendor/sweetalert/sweetalert2.all.min.js"></script>
<script src="{{ asset('/vendor/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
<!-- Modal1 -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-10">
            <div class="bg0 how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ asset('/front') }}/images/icons/icon-close.png" alt="CLOSE">
                </button>
                <form method="POST" id="update_profile" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-lg-5 col-sm-4">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="gallery-lb">
                                <div class="wrap-pic-w pos-relative">
                                    @if(Auth::user()->photo_profile)
                                    <img src="{{ url('/storage/photo/'. Auth::user()->photo_profile) }}" id="preview_photo" alt="IMG-PRODUCT">
                                    <a class="flex-c-m size-108 m-l-20 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04 zoom-picture" href="{{ url('/storage/'. Auth::user()->photo_profile)}}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                    @else
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" id="preview_photo" alt="IMG-PRODUCT">
                                    @endif
                                    <input type="hidden" id="old_photo_profile" name="old_photo" value="{{ Auth::user()->photo_profile }}">
                                    <input id="photo" type="file" name="photo" style="opacity: 0; height:1px; display:none;" onchange="previewImage(this)">

                                    <a href='javascript:void(0)' class="flex-c-m stext-101 cl0 size-101 bg1 hov-btn1 p-lr-15 trans-04" id="change_picture">Ganti Foto</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-7 col-sm-8 p-b-30">
                            <div class="p-r-50 p-t-30 p-lr-0-lg">
                                <label for="nama_edit">Nama</label>
                                <input type="hidden" id="id_edit" value="{{ Auth::user()->id }}">
                                <div class="bor8 m-b-20 how-pos4-parent">
                                    <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30" id="nama_edit" type="text" name="name" placeholder="Your Username" value="{{ Auth::user()->name }}">
                                    <i class="how-pos4 pointer-none fa fa-user-o"></i>
                                </div>
                                <p class="text-danger m-b-20 name" style="margin-top: -20px;" id="nama_e"></p>
                                <label for="email_edit">Email</label>
                                <div class="bor8 m-b-20 how-pos4-parent w-100">
                                    <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30" id="email_edit" type="email" name="email" placeholder="Your Email Address" value="{{ Auth::user()->email }}">
                                    <i class="how-pos4 pointer-none fa fa-envelope-o"></i>
                                </div>
                                <p class="text-danger m-b-20 email" style="margin-top: -20px;" id="email_e"></p>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="no_telp_edit">WhatsApp</label>
                                        <div class="bor8 m-b-20 how-pos4-parent w-100">
                                            <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30" id="no_telp_edit" type="number" name="no_telp" placeholder="Your Number Phone" value="{{ Auth::user()->no_telp }}">
                                            <i class="how-pos4 pointer-none fa fa-whatsapp"></i>
                                        </div>
                                        <p class="text-danger m-b-20 no_telp" style="margin-top: -20px;" id="no_telp_e"></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <div class="bor8 m-b-20 how-pos4-parent w-100">
                                            <select class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30 bor8" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="" selected disabled>Pilih</option>
                                                <option data-value="Laki-laki" {{ Auth::user()->jenis_kelamin == 'Laki-laki' ? 'selected' : null }}>Laki-laki</option>
                                                <option data-value="Perempuan" {{ Auth::user()->jenis_kelamin == 'Perempuan' ? 'selected' : null }}>Perempuan</option>
                                                <option data-value="Not Found" {{ Auth::user()->jenis_kelamin == 'Not Found' ? 'selected' : null }}>Not Found</option>
                                            </select>
                                            <i class="how-pos4 pointer-none fa fa-transgender"></i>
                                        </div>
                                    </div>
                                </div>
                                <label for="alamat_edit">Alamat</label>
                                <div class="bor8 m-b-20 how-pos4-parent w-100">
                                    <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30" id="alamat_edit" type="text" name="alamat" placeholder="Your Location Address" value="{{ Auth::user()->alamat }}">
                                    <i class="how-pos4 pointer-none fa fa-map-marker"></i>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="rt_edit">Rt</label>
                                        <div class="bor8 m-b-20 how-pos4-parent w-100">
                                            <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30" id="rt_edit" type="number" name="rt" placeholder="Your Location Address" value="{{ Auth::user()->rt }}">
                                            <i class="how-pos4 pointer-none fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="rw_edit">Rw</label>
                                        <div class="bor8 m-b-20 how-pos4-parent w-100">
                                            <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30" id="rw_edit" type="number" name="rw" placeholder="Your Location Address" value="{{ Auth::user()->rw }}">
                                            <i class="how-pos4 pointer-none fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                </div>
                                <label for="kota_edit">Kota</label>
                                <div class="bor8 m-b-20 how-pos4-parent w-100">
                                    <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30" id="kota_edit" type="text" name="kota" placeholder="Your Location Address" value="{{ Auth::user()->kota }}">
                                    <i class="how-pos4 pointer-none fa fa-map-marker"></i>
                                </div>
                                <button class="savedit" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal2 -->
<div class="wrap-modal2 js-modal2 p-t-60 p-b-20">
    <div class="overlay-modal2 js-hide-modal2"></div>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-10">
            <div class="bg0 how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ asset('/front') }}/images/icons/icon-close.png" alt="CLOSE">
                </button>
                <form method="POST" id="update_profile_password">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-lg-7 col-sm-8 p-b-30">
                            <div class="p-r-50 p-t-30 p-lr-0-lg">
                                <label for="old_password">Password lama</label>
                                <div class="bor8 m-b-20 how-pos4-parent">
                                    <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30 form-control" id="old_password" type="password" name="old_password" placeholder="Your Password">
                                    <i class="how-pos4 pointer-none fa fa-key"></i>
                                </div>
                                <p class="text-danger m-b-20 old_password" style="margin-top: -20px;" id="old_password-1"></p>
                                <hr>
                                <label for="password">Password baru</label>
                                <div class="bor8 m-b-20 how-pos4-parent">
                                    <input class="stext-111 cl2 plh3 size-126 p-l-62 p-r-30 form-control" id="password" type="password" name="password" placeholder="New Password">
                                    <i class="how-pos4 pointer-none fa fa-key"></i>
                                </div>
                                <div class="indicator">
                                    <span class="weak"></span>
                                    <span class="medium"></span>
                                    <span class="strong"></span>
                                </div>
                                <p class="m-b-20 password_" id="password-1"></p>
                                <label for="confirm_password">Konfirmasi password</label>
                                <div class="bor8 m-b-20 how-pos4-parent">
                                    <input class="plh3 p-l-62 p-r-30 confirm form-control" id="confirm_password" type="password" name="password_confirmation" placeholder="Confirm Password">
                                    <i class="how-pos4 pointer-none fa fa-check icon-confirm"></i>
                                </div>
                                <p class="text-danger m-b-20 confirm_password" style="margin-top: -20px;" id="confirm_password-1"></p>
                                <button class="savedit_pass" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.nav-side ul li').on('click', function() {
        $(this).addClass("active").siblings().removeClass("active");
    });

    const tabBtn = document.querySelectorAll('.nav-side ul li');
    const tab = document.querySelectorAll('.profile-body .tab');

    function tabs(panelIndex) {
        tab.forEach(function(node) {
            node.style.display = "none";
        });
        tab[panelIndex].style.display = "block";
    }
    tabs(0);

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
        $('#example-2').DataTable({
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
        $('#example-3').DataTable({
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

    function previewImage(input) {
        var file = $("input[type=file]").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $('#preview_photo').attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    $(document).on('click', '#change_picture', function() {
        $('#photo').click();
    });

    $("#update_profile").on('submit', function(event) {
        event.preventDefault();

        const name = document.getElementsByClassName("name");
        const email = document.getElementsByClassName("email");
        const no_telp = document.getElementsByClassName("no_telp");
        name[0].style.display = 'none';
        email[0].style.display = 'none';
        no_telp[0].style.display = 'none';

        var id = document.getElementById('id_edit').value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/edit/" + id,
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.error_nama) {
                    document.getElementById("nama_e").innerHTML = response.error_nama;
                    const color = document.getElementsByClassName("name");
                    color[0].style.display = 'block';
                }
                if (response.error_email) {
                    document.getElementById("email_e").innerHTML = response.error_email;
                    const color = document.getElementsByClassName("email");
                    color[0].style.display = 'block';
                }
                if (response.error_no_telp) {
                    document.getElementById("no_telp_e").innerHTML = response.error_no_telp;
                    const color = document.getElementsByClassName("no_telp");
                    color[0].style.display = 'block';
                }
                if (response.success_message) {
                    $('.js-modal1').removeClass('show-modal1');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.success_message
                    }).then((result) => {
                        location.reload();
                    })
                }
            }
        })
    });

    // $("button[class='savedit_pass']").prop("type", "button");

    $(document).on('keyup', '#password', function() {
        const indicator = document.querySelector(".indicator");
        const weak = document.querySelector(".weak");
        const medium = document.querySelector(".medium");
        const strong = document.querySelector(".strong");
        let pass_message = document.getElementById('password-1');

        let password = document.getElementById("password").value;
        let confirm_password = document.getElementById("confirm_password").value;
        let message = document.getElementById('confirm_password-1');

        if (password.length != 0) {
            indicator.style.display = "block";
            indicator.style.display = "flex";
            if (password.length < 8) {
                weak.classList.add("active");
                pass_message.style.display = "block";
                pass_message.classList.add("weak")
                pass_message.textContent = "minimal 8 karakter huruf"
            }
            if (password.length >= 8 && password.length < 10) {
                medium.classList.add("active");
                pass_message.classList.add("medium")
                pass_message.textContent = "password cukup kuat"
            } else {
                medium.classList.remove('active');
                pass_message.classList.remove('medium');
            }
            if (password.length >= 10) {
                medium.classList.add("active");
                strong.classList.add("active");
                pass_message.textContent = "password anda kuat"
                pass_message.classList.add("strong");
            } else {
                strong.classList.remove('active');
                pass_message.classList.remove('strong');
            }
        } else {
            indicator.style.display = "none";
            pass_message.style.display = "none";
        }

        if (confirm_password.length != 0) {
            message.style.display = "block";
            if (password == confirm_password) {
                $(".confirm").addClass("is-valid").removeClass("is-invalid");
                $(".confirm_password").addClass("text-success").removeClass("text-danger");
                message.textContent = "password sama";
            } else {
                $(".confirm").addClass("is-invalid").removeClass("is-valid");
                $(".confirm_password").addClass("text-danger").removeClass("text-success");
                message.textContent = "password tidak sama!";
            }
        } else {
            message.style.display = "none";
            $(".confirm").removeClass("is-valid").removeClass("is-invalid");
        }
    });
    $(document).on('keyup', '#confirm_password', function() {
        let password = document.getElementById("password").value;
        let confirm_password = document.getElementById("confirm_password").value;
        let message = document.getElementById('confirm_password-1');

        if (password.length != 0) {
            message.style.display = "block";
            if (password == confirm_password) {
                $(".confirm").addClass("is-valid").removeClass("is-invalid");
                $(".confirm_password").addClass("text-success").removeClass("text-danger");
                message.textContent = "password sama";
            } else {
                $(".confirm").addClass("is-invalid").removeClass("is-valid");
                $(".confirm_password").addClass("text-danger").removeClass("text-success");
                message.textContent = "password tidak sama!";
            }
        } else {
            message.style.display = "none";
            $(".confirm").removeClass("is-valid").removeClass("is-invalid");
        }
    });

    $("#update_profile_password").on('submit', function(event) {
        event.preventDefault();

        const old_pass = document.getElementsByClassName("old_password");
        old_pass[0].style.display = 'none';

        let old_password = document.getElementById("old_password").value;
        let password = document.getElementById("password").value;
        let confirm_password = document.getElementById("confirm_password").value;
        let confirm_message = document.getElementById('confirm_password-1');
        const indicator = document.querySelector(".indicator");
        let pass_message = document.getElementById('password-1');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (old_password.length != 0 && password.length >= 8 && password == confirm_password) {
            $.ajax({
                url: "/changePassword/",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.error_message) {
                        document.getElementById("old_password-1").innerHTML = response.error_message;
                        const color = document.getElementsByClassName("old_password");
                        color[0].style.display = 'block';
                        document.getElementById("old_password").value = "";
                        document.getElementById("password").value = "";
                        document.getElementById("confirm_password").value = "";
                        indicator.style.display = "none";
                        pass_message.style.display = "none";
                        confirm_message.textContent = "";
                        $(".confirm").removeClass("is-valid").removeClass("is-invalid");
                    }
                    if (response.success_message) {
                        $('.js-modal2').removeClass('show-modal2');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.success_message
                        }).then((result) => {
                            location.reload();
                        })
                    }
                }
            })
        } else if (old_password.length == 0) {
            alert('pasword lama harus diisi!');
            document.getElementById("password").value = "";
            document.getElementById("confirm_password").value = "";
            indicator.style.display = "none";
            pass_message.style.display = "none";
            confirm_message.textContent = "";
            $(".confirm").removeClass("is-valid").removeClass("is-invalid");
        } else if (password != confirm_password) {
            alert('password baru tidak sama dengan konfirmasi');
            document.getElementById("old_password").value = "";
            document.getElementById("password").value = "";
            document.getElementById("confirm_password").value = "";
            indicator.style.display = "none";
            pass_message.style.display = "none";
            confirm_message.textContent = "";
            $(".confirm").removeClass("is-valid").removeClass("is-invalid");
        } else if (password.length < 8) {
            alert('minimal pasword 8 huruf');
            document.getElementById("old_password").value = "";
            document.getElementById("password").value = "";
            document.getElementById("confirm_password").value = "";
            indicator.style.display = "none";
            pass_message.style.display = "none";
            confirm_message.textContent = "";
            $(".confirm").removeClass("is-valid").removeClass("is-invalid");
        }
    });
</script>
<script src="{{ asset('/front') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush