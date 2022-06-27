@extends('back.layouts.index')
@push('title', 'Profile')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Account Settings</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span style="margin-right: 20px;">User Profile</span></li>
            </ol>

        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        @if(Auth::user()->photo_profile)
                        <img src="{{  url('/storage/'. Auth::user()->photo_profile) }}" id="preview_profile" class="rounded img-responsive" style="width: 35vh;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" id="preview_profile" class="rounded img-responsive" style="width: 35vh;">
                        @endif
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{Auth::user()->name}}</span>
                            <span class="thumb-info-type">{{Auth::user()->roles}}</span>
                        </div>
                    </div>

                    <h6 class="text-muted">Data Profile</h6>
                    <ul class="simple-todo-list">
                        <li class="{{Auth::user()->photo_profile ? 'completed' : 'text-warning'}}">Update Poto Profil</li>
                        <li class="{{Auth::user()->password_tidack_enkripsi != 12345678 ? 'completed' : 'text-warning'}}">Ganti Password</li>
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
        <div class="col-md-8 col-lg-6">
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="{{ request()->is('profile') ? 'active' : '' }}">
                        <a href="#overview" data-toggle="tab">Home</a>
                    </li>
                    <li class="{{ request()->is('edit') ? 'active' : '' }}">
                        <a href="#edit" data-toggle="tab">Edit Profile</a>
                    </li>
                    <li class="{{ request()->is('changePassword') ? 'active' : '' }}">
                        <a href="#changePassword" data-toggle="tab">Ubah Password</a>
                    </li>
                </ul>
                <div class="tab-content">
                    @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Peringatan !!</strong> {{\Session::get('success')}}
                    </div>
                    @endif
                    <div id="overview" class="tab-pane {{ request()->is('profile') ? 'active' : '' }}">
                        <h4 class="mb-md">About Me</h4>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>NIDN</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{Auth::user()->nim_nidn ? Auth::user()->nim_nidn : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Status</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{Auth::user()->status_mhs ? Auth::user()->status_mhs : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Jenis Kelamin</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{Auth::user()->jenis_kelamin ? Auth::user()->jenis_kelamin : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Alamat</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{Auth::user()->alamat ? Auth::user()->alamat : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Rt / Rw</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{Auth::user()->rt ? Auth::user()->rt : 'null'}} / {{Auth::user()->rw ? Auth::user()->rt : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Desa</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{Auth::user()->desa ? Auth::user()->desa : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>Kota / Kabupaten</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <h5>{{Auth::user()->kota ? Auth::user()->kota : 'null'}}</h5>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <h5>No. Telp</h5>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8 mb-xlg">
                                <h5>{{Auth::user()->no_telp ? Auth::user()->no_telp : 'null'}}</h5>
                            </div>
                        </div>
                    </div>
                    <div id="edit" class="tab-pane {{ request()->is('edit') ? 'active' : '' }}">

                        <form class="form-horizontal" method="POST" action="/edit/{{Auth::user()->id}}" enctype="multipart/form-data">
                            @csrf
                            <h4 class="mb-xlg">Personal Information</h4>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="photo_profile">Poto Profil</label>
                                    <div class="col-md-8">
                                        <input type="file" name="photo_profile" class="form-control @error('photo_profile') is-invalid @enderror" id="photo_profile" onchange="previewImage(this)">
                                        <input type="hidden" name="old_photo" value="{{Auth::user()->photo_profile}}">
                                        @error('photo_profile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">Nama</label>
                                    <div class="col-md-8">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="name" value="{{Auth::user()->name}}">
                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="email">E-Mail</label>
                                    <div class="col-md-8">
                                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" value="{{Auth::user()->email}}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="nidn">NIM/NIDN/NIP</label>
                                    <div class="col-md-8">
                                        <input type="text" name="nim_nidn" class="form-control  @error('nim_nidn') is-invalid @enderror" id="nidn" value="{{Auth::user()->nim_nidn}}">
                                        @error('nim_nidn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="jk">Status</label>
                                    <div class="col-md-8">
                                        <select name="jenis_kelamin" id="jk" class="form-control mb-md">
                                            <option value="Aktif" {{ Auth::user()->status_mhs == 'Aktif' ? 'selected' : null }}>Aktif</option>
                                            <option value="Non Aktif" {{ Auth::user()->status_mhs == 'Non Aktif' ? 'selected' : null }}>Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="alamat">Alamat</label>
                                    <div class="col-md-8">
                                        <input type="text" name="alamat" class="form-control" id="alamat" value="{{Auth::user()->alamat}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="rt">Rt</label>
                                    <div class="col-md-8">
                                        <input type="number" name="rt" class="form-control" id="rt" value="{{Auth::user()->rt}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="rw">Rw</label>
                                    <div class="col-md-8">
                                        <input type="number" name="rw" class="form-control" id="rw" value="{{Auth::user()->rw}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="desa">Desa</label>
                                    <div class="col-md-8">
                                        <input type="text" name="desa" class="form-control" id="desa" value="{{Auth::user()->desa}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="kota">Kota / Kabupaten</label>
                                    <div class="col-md-8">
                                        <input type="text" name="kota" class="form-control" id="kota" value="{{Auth::user()->kota}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="no_telp">No. Telpon</label>
                                    <div class="col-md-8">
                                        <input type="text" name="no_telp" class="form-control" id="no_telp" value="{{Auth::user()->no_telp}}">
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
                    <div id="changePassword" class="tab-pane {{ request()->is('changePassword') ? 'active' : '' }}">
                        <form class="form-horizontal" method="post" action="{{ route('changePassword') }}">
                            @csrf
                            <h4 class="mb-xlg">Ubah Password</h4>
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
                            <hr class="dotted short">
                            <fieldset class="mb-xl">
                                <div class="form-group @error('password') has-error @enderror">
                                    <label class="col-md-4 control-label" for="password">Password Baru</label>
                                    <div class="col-md-8">
                                        <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru...">
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
                $('#preview_profile').attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush