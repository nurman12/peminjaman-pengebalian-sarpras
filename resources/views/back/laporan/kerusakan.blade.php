@extends('back.layouts.index')
@push('title', 'Laporan | Kerusakan')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Laporan Kerusakan</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Laporan</span></li>
                <li><span style="margin-right: 20px;">Karusakan</span></li>
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

            <h2 class="panel-title">Daftar Kerusakan</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Jumlah</th>
                        <th>Sarpras</th>
                        <th>Keterangan</th>
                        <th>Terakhir Diubah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rusak as $data)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->hilang }}</td>
                        <td>{{ $data->sarpras->nama }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td>{{ date('d F Y', strtotime($data->updated_at)) }}</td>
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