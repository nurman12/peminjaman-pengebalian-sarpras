@extends('back.layouts.index')
@push('title', 'Validasi | Sudah')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sesudah Validasi</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Validasi</span></li>
                <li><span style="margin-right: 20px;">Sesudah</span></li>
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

            <h2 class="panel-title">Daftar Persetujuan Permohonan</h2>
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
                    @foreach($setuju as $data)
                    @if($data->status == 3)
                    <tr class="text-danger">
                        @else
                    <tr>
                        @endif
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data->keperluan}}</td>
                        <td>{{ date('d F', strtotime( $data->tanggal_start )) }} sd. {{ date('d F Y', strtotime( $data->tanggal_finish )) }}</td>
                        <td>{{ count($data->draft) }}</td>
                        <th width="85px">
                            <a href="{{ route('validasi.show', $data->id) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            @if($data->status != 3)
                            @if(Auth::user()->roles == 'KTU' && $data->validasi_koor == 0)
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sudah_ktu" value="2">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="fa fa-times"></i></button>
                            </form>
                            @elseif(Auth::user()->roles == 'Koordinator' && $data->validasi_bmn == 0)
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sudah_koor" value="2">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="fa fa-times"></i></button>
                            </form>
                            @elseif(AUth::user()->roles == 'BMN' && $data->status == 0)
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sudah_bmn" value="2">
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
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">Daftar Penolakan Permohonan</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default-1">
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
                    @foreach($tidak as $data)
                    @if($data->status == 3)
                    <tr class="text-danger">
                        @else
                    <tr>
                        @endif
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data->keperluan}}</td>
                        <td>{{ date('d F', strtotime( $data->tanggal_start )) }} sd. {{ date('d F Y', strtotime( $data->tanggal_finish )) }}</td>
                        <td>{{ count($data->draft) }}</td>
                        <th width="85px">
                            <a href="{{ route('validasi.show', $data->id) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            @if($data->status != 3)
                            @if(Auth::user()->roles == 'KTU' && $data->validasi_koor == 0)
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sudah_ktu" value="1">
                                <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Setuju"><i class="fa fa-pencil-square-o"></i></button>
                            </form>
                            @elseif(Auth::user()->roles == 'Koordinator' && $data->validasi_bmn == 0)
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sudah_koor" value="1">
                                <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Setuju"><i class="fa fa-pencil-square-o"></i></button>
                            </form>
                            @elseif(AUth::user()->roles == 'BMN' && $data->status == 0)
                            <form action="/validasi/{{$data->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="sudah_bmn" value="1">
                                <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Setuju"><i class="fa fa-pencil-square-o"></i></button>
                                <!-- <button type="submit" class="mr-xs btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i>Setuju</button> -->
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
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
@endpush