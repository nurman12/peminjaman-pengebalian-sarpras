@extends('back.layouts.index')
@push('title', 'Validasi | Belum')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sebelum Validasi</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Validasi</span></li>
                <li><span style="margin-right: 20px;">Sebelum</span></li>
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

            <h2 class="panel-title">Daftar Belum Validasi</h2>
        </header>
        <div class="panel-body">
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Peringatan !!</strong> {{\Session::get('success')}}
            </div>
            @endif
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Keperluan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Jumlah</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($belum_validasi as $data)
                    @if($data->status == 3)
                    <tr class="text-danger">
                        @elseif($data->notif == 0)
                    <tr class="info">
                        @else
                    <tr>
                        @endif
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data->keperluan}}</td>
                        <td>{{ date('d F', strtotime( $data->tanggal_start )) }} sd. {{ date('d F Y', strtotime( $data->tanggal_finish )) }}</td>
                        <td>{{ count($data->draft) }}</td>
                        <th width="130px">
                            <a href="{{ route('validasi.show', $data->id) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            @if($data->status != 3)
                            @if(Auth::user()->roles == 'KTU')
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sebelum_ktu" value="1">
                                <button type="submit" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Setuju"><i class="fa fa-pencil-square-o"></i></button>
                            </form>
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sebelum_ktu" value="2">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="fa fa-times"></i></button>
                            </form>
                            @elseif(Auth::user()->roles == 'Koordinator')
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sebelum_koor" value="1">
                                <button type="submit" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Setuju"><i class="fa fa-pencil-square-o"></i></button>
                            </form>
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sebelum_koor" value="2">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="fa fa-times"></i></button>
                            </form>
                            @elseif(AUth::user()->roles == 'BMN')
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sebelum_bmn" value="1">
                                <button type="submit" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Setuju"><i class="fa fa-pencil-square-o"></i></button>
                            </form>
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sebelum_bmn" value="2">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="fa fa-times"></i></button>
                            </form>
                            @endif
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
<div id="notif" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Kirim notifikasi</h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="flex-w m--t-45">
                    <h5 class="size-219 cl1">Ke</h5>
                    <h5 class="size-220 cl1" id="nama"></h5>
                </div>
                <div class="flex-w">
                    <h5 class="size-219 cl1">Keperluan</h5>
                    <h5 class="size-220 cl1" id="keperluan"></h5>
                </div>
                <div class="flex-w">
                    <h5 class="size-219 cl1">Mulai</h5>
                    <h5 class="size-220 cl1" id="mulai"></h5>
                </div>
                <div class="flex-w">
                    <h5 class="size-219 cl1">Sampai</h5>
                    <h5 class="size-220 cl1" id="sampai"></h5>
                </div>
                <div class="flex-w">
                    <h5 class="size-219 cl1">Notifikasi</h5>
                    <textarea name="" id="pesan" class="form-control size-220 cl1"></textarea>
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
    </section>
</div>
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '#showModal', function() {
            var nama = $(this).data('nama');
            var keperluan = $(this).data('keperluan');
            var mulai = $(this).data('mulai');
            var sampai = $(this).data('sampai');

            $('h5#nama').text(nama);
            $('h5#keperluan').text(keperluan);
            $('h5#mulai').text(mulai);
            $('h5#sampai').text(sampai);
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