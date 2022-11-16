@extends('back.layouts.index')
@push('title', 'Pengguna')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Create Pengguna</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Pengguna</span></li>
                <li><span style="margin-right: 20px;">Create</span></li>
            </ol>

        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-lg-6">
            <section class="panel form-wizard" id="w1">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Form Wizard</h2>
                </header>

                <div class="panel-body panel-body-nopadding">
                    <div class="wizard-tabs">
                        <ul class="wizard-steps">
                            <li class="active">
                                <a href="#w1-account" data-toggle="tab" class="text-center">
                                    <span class="badge hidden-xs">1</span>
                                    Account
                                </a>
                            </li>
                            <li>
                                <a href="#w1-profile" data-toggle="tab" class="text-center">
                                    <span class="badge hidden-xs">2</span>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="#w1-confirm" data-toggle="tab" class="text-center">
                                    <span class="badge hidden-xs">3</span>
                                    Confirm
                                </a>
                            </li>
                        </ul>
                    </div>
                    <form class="form-horizontal" id="form" action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content">
                            <div id="w1-account" class="tab-pane active">
                                <div class="form-group @error('nim_nidn') has-error @enderror">
                                    <label class="col-sm-4 control-label" for="nim_nidn"><span class="required">*</span>NIM/NIDN/NIP</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" name="nim_nidn" id="nim_nidn" value="{{old('nim_nidn')}}" required>
                                        @error('nim_nidn')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('roles') has-error @enderror">
                                    <label class="col-sm-4 control-label" for="role"><span class="required">*</span>Level</label>
                                    <div class="col-sm-8">
                                        <select name="roles" class="form-control mb-md" id="roles" required>
                                            <option selected disabled> --pilih--</option>
                                            <option value="BMN" {{ old('roles') == 'BMN' ? 'selected' : null }}>BMN</option>
                                            <option value="Dosen" {{ old('roles') == 'Dosen' ? 'selected' : null }}>Dosen</option>
                                            <option value="Koordinator" {{ old('roles') == 'Koordinator' ? 'selected' : null }}>Koordinator</option>
                                            <option value="KTU" {{ old('roles') == 'KTU' ? 'selected' : null }}>KTU</option>
                                            <option value="Mahasiswa" {{ old('roles') == 'Mahasiswa' ? 'selected' : null }}>Mahasiswa</option>
                                        </select>
                                        @error('roles')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('password') has-error @enderror">
                                    <label class="col-sm-4 control-label" for="password"><span class="required">*</span>Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control input-sm" name="password" id="password" minlength="8" required>
                                        @error('password')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="password">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div id="w1-profile" class="tab-pane">
                                <div class="form-group @error('photo_profile') has-error @enderror">
                                    <label class="col-sm-4 control-label" for="foto">Foto Profil</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control input-sm" name="photo_profile" id="photo_profile">
                                        <span class="help-block">Ukuran (Max: 1Mb) Ekstensi(.jpg,.jpeg,.png)</span>
                                        @error('photo_profile')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="col-sm-4 control-label" for="name"><span class="required">*</span>Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" name="name" id="name" value="{{old('name')}}" required>
                                        @error('name')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="stts">Status</label>
                                    <div class="col-sm-8">
                                        <select name="status_mhs" class="form-control mb-md" id="stts">
                                            <option selected disabled> --pilih--</option>
                                            <option value="Aktif" {{ old('status_mhs') == 'Aktif' ? 'selected' : null }}>Aktif</option>
                                            <option value="Non Aktif" {{ old('status_mhs') == 'Non Aktif' ? 'selected' : null }}>Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="jenis_kelamin">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <select name="jenis_kelamin" class="form-control mb-md" id="jenis_kelamin">
                                            <option selected disabled> --pilih--</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : null }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : null }}>Perempuan</option>
                                            <option value="Not Found" {{ old('jenis_kelamin') == 'Not Found' ? 'selected' : null }}>Not Found</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="alamat">Alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" name="alamat" value="{{old('alamat')}}" id="alamat">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="rt">Rt</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control input-sm" name="rt" id="rt" value="{{old('rt')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="rw">Rw</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control input-sm" name="rw" id="rw" value="{{old('rw')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="desa">Desa</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" name="desa" id="desa" value="{{old('desa')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="kota">Kota / Kabupaten</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" name="kota" id="kota" value="{{old('kota')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="no_telp">No Telpon</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" name="no_telp" id="no_telp" value="{{old('no_telp')}}">
                                    </div>
                                </div>
                            </div>
                            <div id="w1-confirm" class="tab-pane">
                                <div class="form-group @error('email') has-error @enderror">
                                    <label class="col-sm-4 control-label" for="email"><span class="required">*</span>Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control input-sm" name="email" id="email" value="{{old('email')}}" required>
                                        @error('email')
                                        <span class="has-error" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <ul class="pager">
                        <li class="previous disabled">
                            <a><i class="fa fa-angle-left"></i> Previous</a>
                        </li>
                        <li class="finish hidden pull-right">
                            <a onclick="document.getElementById('form').submit()">Finish</a>
                        </li>
                        <li class="next">
                            <a>Next <i class="fa fa-angle-right"></i></a>
                        </li>
                    </ul>
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
<!-- <link rel="stylesheet" href="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.css" /> -->
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/jquery-validation/jquery.validate.js"></script>
<script src="{{ asset('/back') }}/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<!-- <script src="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.js"></script> -->
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/forms/examples.wizard.js"></script>
@endpush