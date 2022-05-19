@extends('back.layouts.index')
@push('title', 'Pengguna')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Pengguna</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span style="margin-right: 20px;">Pengguna</span></li>
            </ol>

        </div>
    </header>
    <!-- Start page -->
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">Daftar Pengguna</h2>
        </header>
        <div class="panel-body">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-lg-offset-4">
                    <!-- <div class="mb-md"> -->
                    <a href="{{ route('pengguna.create') }}" class="btn btn-primary rounded"><i class="fa fa-plus"></i> Create</a>
                    <a href="#modalAnim" class="btn btn-info rounded mr-xl ml-xl modal-with-zoom-anim"><i class="fa fa-cloud-upload"></i> Import</a>
                    <a href="/pengguna/export" class="btn btn-warning rounded"><i class="fa fa-cloud-download"></i> Export</a>
                    <!-- </div> -->
                </div>
            </div>
            @error('file')
            <div class="alert alert-danger" style="margin-top: 10px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{$message}}
            </div>
            @enderror
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM/NIDN/NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="hidden-phone">Level</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td><span class="highlight rounded">{{$data->nim_nidn}}</span></td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td class="center">{{$data->roles}}</td>
                        <th width="120px">
                            <a href="{{ route('pengguna.show', $data->id) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            @if($data->roles != 'BMN')
                            <a href="{{ route('pengguna.edit', $data->id) }}" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                            <form onclick="return confirm('Yakin ingin hapus ini?')" action="{{ route('pengguna.destroy', $data->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="old_photo" value="{{$data->photo_profile}}">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                            @endif
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- End page -->
</section>
</div>
@endsection

@push('style')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
<!-- <link rel="stylesheet" href="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.css" /> -->
@endpush
@push('modals')
<div id="modalAnim" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Import Data Pengguna</h2>
        </header>
        <form action="{{ route('pengguna.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fa fa-file-excel-o"></i>
                    </div>
                    <div class="modal-text">
                        <input type="file" class="form-control" name="file" required>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Confirm</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

@endpush
@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<!-- <script src="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.js"></script> -->
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
<script src="{{ asset('/back') }}/javascripts/ui-elements/examples.modals.js"></script>
@endpush