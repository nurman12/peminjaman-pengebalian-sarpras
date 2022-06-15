@extends('back.layouts.index')
@push('title', 'Edit | Sarpras')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Sarpras</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Sarpras</span></li>
                <li><span style="margin-right: 20px;">Edit</span></li>
            </ol>
        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-xs-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Select Replacement</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" action="{{ route('sarpras.update', $sarpras->id) }}" method="POST" id="formEdit" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group @error('jenis') has-error @enderror">
                            <label class="col-md-3 control-label">Jenis<span class="required">*</span></label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control" id="jenis" name="jenis" onchange="showKategori(this)">
                                    <option value="Ruangan" {{ $sarpras->jenis == 'Ruangan' ? 'selected' : null }}>Ruangan</option>
                                    <option value="Barang" {{ $sarpras->jenis == 'Barang' ? 'selected' : null }}>Barang</option>
                                </select>
                                @error('jenis')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <?php
                        $pecah_string = explode(", ", $sarpras->kategori);
                        ?>
                        <div class="form-group" id="barang">
                            <label class="col-md-3 control-label">Kategori</label>
                            <div class="col-md-6">
                                <select class="form-control" multiple="multiple" name="kategori_brg[]" data-plugin-multiselect id="ms_example0">
                                    <option value="elektronik" @foreach($pecah_string as $data) {{ $data == 'elektronik' ? 'selected' : null }} @endforeach>Elektronik</option>
                                    <option value="mebel" @foreach($pecah_string as $data) {{ $data == 'mebel' ? 'selected' : null }} @endforeach>Mebel</option>
                                    <option value="kain" @foreach($pecah_string as $data) {{ $data == 'kain' ? 'selected' : null }} @endforeach>Kain</option>
                                    <option value="lainnya" @foreach($pecah_string as $data) {{ $data == 'lainnya' ? 'selected' : null }} @endforeach>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="ruangan">
                            <label class="col-md-3 control-label">Kategori</label>
                            <div class="col-md-6">
                                <select class="form-control" multiple="multiple" name="kategori_rgn[]" data-plugin-multiselect id="ms_example0">
                                    <option value="kelas" @foreach($pecah_string as $data) {{ $data == 'kelas' ? 'selected' : null }} @endforeach>Kelas</option>
                                    <option value="laboratorium" @foreach($pecah_string as $data) {{ $data == 'laboratorium' ? 'selected' : null }} @endforeach>Laboratorium</option>
                                    <option value="rapat" @foreach($pecah_string as $data) {{ $data == 'rapat' ? 'selected' : null }} @endforeach>rapat</option>
                                    <option value="lainnya" @foreach($pecah_string as $data) {{ $data == 'lainnya' ? 'selected' : null }} @endforeach>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group @error('nama') has-error @enderror">
                            <label class="col-md-3 control-label" for="nama">Nama<span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nama" value="{{$sarpras->nama}}" name="nama">
                                @error('nama')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('deskripsi') has-error @enderror">
                            <label class="col-md-3 control-label" for="deskripsi">Deskripsi<span class="required">*</span></label>
                            <div class="col-md-8">
                                <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control">{{$sarpras->deskripsi}}</textarea>
                                @error('deskripsi')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('photo') has-error @enderror">
                            <label class="col-md-3 control-label" for="Photo">Photo<span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="hidden" name="old_photo" value="{{$sarpras->photo}}">
                                <input type="file" class="form-control" id="Photo" name="photo" onchange="previewImage(this)">
                                <img src="{{  url('/storage/'. $sarpras->photo) }}" id="preview_sarpras" class="rounded img-responsive" style="width: 35vh; margin-top:10px;">
                                @error('photo')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3">
                            <button onclick="document.getElementById('formEdit').submit()" class="btn btn-primary">Submit</button>
                            <button onclick="document.getElementById('formEdit').reset()" class="btn btn-default">Reset</button>
                        </div>
                    </div>
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
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
@endpush

@push('script')
<script src="{{ asset('/back') }}/vendor/jquery-validation/jquery.validate.js"></script>
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script>
    function previewImage(input) {
        var file = $("input[type=file]").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $('#preview_sarpras').attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
    if ($('#jenis').val() == 'Ruangan') {
        $("#barang").hide();
    } else if ($('#jenis').val() == 'Barang') {
        $("#ruangan").hide();
    }

    function showKategori(elem) {
        if (elem.value == 'Ruangan') {
            $("#ruangan").show();
            $("#barang").hide();
        } else if (elem.value == 'Barang') {
            $('#barang').show();
            $("#ruangan").hide();
        }
    }
</script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/forms/examples.advanced.form.js"></script>
@endpush