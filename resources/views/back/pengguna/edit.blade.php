@extends('back.layouts.index')
@push('title', 'Pengguna')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Pengguna</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Pengguna</span></li>
                <li><span style="margin-right: 20px;">Edit</span></li>
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
                    <hr class="dotted short">

                    <div class="social-icons-list">
                        <a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                        <a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                        <a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
                    </div>

                </div>
            </section>

        </div>
        <div class="col-md-8 col-lg-9">
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="{{ request()->is('pengguna/*/edit') ? 'active' : '' }}">
                        <a href="#edit" data-toggle="tab">Edit Profile</a>
                    </li>
                    <li>
                        <a href="#changePassword" data-toggle="tab">Ubah Password</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="edit" class="tab-pane {{ request()->is('pengguna/*/edit') ? 'active' : '' }}">

                        <form class="form-horizontal" method="post" action="{{ route('pengguna.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h4 class="mb-xlg">Personal Information</h4>
                            <fieldset>
                                <div class="form-group @error('photo_profile') has-error @enderror">
                                    <label class="col-md-3 control-label" for="photo_profile">Poto Profil</label>
                                    <div class="col-md-8">
                                        <input type="file" name="photo_profile" class="form-control" id="photo_profile" onchange="previewImage(this)">
                                        <input type="hidden" name="old_photo" value="{{$user->photo_profile}}">
                                        @error('photo_profile')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('nama') has-error @enderror">
                                    <label class="col-md-3 control-label" for="name">Nama</label>
                                    <div class="col-md-8">
                                        <input type="text" name="nama" class="form-control" id="name" value="{{$user->name}}">
                                        @error('nama')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('email') has-error @enderror">
                                    <label class="col-md-3 control-label" for="email">E-Mail</label>
                                    <div class="col-md-8">
                                        <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
                                        @error('email')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('nim_nidn') has-error @enderror">
                                    <label class="col-md-3 control-label" for="nidn">NIM/NIDN/NIP</label>
                                    <div class="col-md-8">
                                        <input type="number" name="nim_nidn" class="form-control" id="nidn" value="{{$user->nim_nidn}}">
                                        @error('nim_nidn')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="lv">Level</label>
                                    <div class="col-md-8">
                                        <select name="roles" id="lv" class="form-control mb-md">
                                            <option value="BMN" {{ $user->roles == 'BMN' ? 'selected' : null }}>BMN</option>
                                            <option value="Dosen" {{ $user->roles == 'Dosen' ? 'selected' : null }}>Dosen</option>
                                            <option value="Koordinator" {{ $user->roles == 'Koordinator' ? 'selected' : null }}>Koordinator</option>
                                            <option value="KTU" {{ $user->roles == 'KTU' ? 'selected' : null }}>KTU</option>
                                            <option value="Mahasiswa" {{ $user->roles == 'Mahasiswa' ? 'selected' : null }}>Mahasiswa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="jk">Status</label>
                                    <div class="col-md-8">
                                        <select name="status_mhs" id="jk" class="form-control mb-md">
                                            <option value="Aktif" {{ $user->status_mhs == 'Aktif' ? 'selected' : null }}>Aktif</option>
                                            <option value="Non Aktif" {{ $user->status_mhs == 'Non Aktif' ? 'selected' : null }}>Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="jk">Jenis Kelamin</label>
                                    <div class="col-md-8">
                                        <select name="jenis_kelamin" id="jk" class="form-control mb-md">
                                            <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : null }}>Laki-laki</option>
                                            <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : null }}>Perempuan</option>
                                            <option value="Not Found" {{ $user->jenis_kelamin == 'Not Found' ? 'selected' : null }}>Not Found</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="alamat">Alamat</label>
                                    <div class="col-md-8">
                                        <input type="text" name="alamat" class="form-control" id="alamat" value="{{$user->alamat}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="rt">Rt</label>
                                    <div class="col-md-8">
                                        <input type="number" name="rt" class="form-control" id="rt" value="{{$user->rt}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="rw">Rw</label>
                                    <div class="col-md-8">
                                        <input type="number" name="rw" class="form-control" id="rw" value="{{$user->rw}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="desa">Desa</label>
                                    <div class="col-md-8">
                                        <input type="text" name="desa" class="form-control" id="desa" value="{{$user->desa}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="kota">Kota / Kabupaten</label>
                                    <div class="col-md-8">
                                        <input type="text" name="kota" class="form-control" id="kota" value="{{$user->kota}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="no_telp">No. Telpon</label>
                                    <div class="col-md-8">
                                        <input type="text" name="no_telp" class="form-control" id="no_telp" value="{{$user->no_telp}}">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="changePassword" class="tab-pane  {{ request()->is('/pengguna/*/edit') ? 'active' : '' }}">
                        <form class="form-horizontal" method="post" action="/pengguna/{{$user->id}}/edit">
                            @csrf
                            <!-- <h4 class="mb-xlg">Ubah Password</h4>
                            <fieldset class="mb-xl">
                                <div class="form-group @error('old_password') has-error @enderror">
                                    <label class="col-md-4 control-label" for="old_password">Password Lama</label>
                                    <div class="col-md-8">
                                        <input name="old_password" id="old_password" type="text" class="form-control" placeholder="Password Lama...">
                                        @error('old_password')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                            <hr class="dotted short"> -->
                            <fieldset class="mb-xl">
                                <div class="form-group @error('password') has-error @enderror">
                                    <label class="col-md-4 control-label" for="password">Password Baru</label>
                                    <div class="col-md-8">
                                        <input name="password" id="password" type="password" class="form-control" placeholder="Password Baru...">
                                        @error('password')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password_confirmation">Konfirmasi Password</label>
                                    <div class="col-md-8">
                                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Konfirmasi Password...">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End page -->
</section>
</div>
@endsection

@push('script')
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