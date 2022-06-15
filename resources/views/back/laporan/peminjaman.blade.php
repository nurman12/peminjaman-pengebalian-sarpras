@extends('back.layouts.index')
@push('title', 'Laporan | Peminjaman')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Laporan Peminjaman</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Laporan</span></li>
                <li><span style="margin-right: 20px;">Peminjaman</span></li>
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

            <h2 class="panel-title">Laporan Peminjaman</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Keperluan</th>
                        <th>Rencana Peminjaman</th>
                        <th>Durasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->validasi->keperluan }}</td>
                        <?php
                        $tgl1 = new DateTime($data->validasi->tanggal_start);
                        $tgl2 = new DateTime($data->validasi->tanggal_finish);
                        $jarak = $tgl2->diff($tgl1);

                        if ($data->status == 0 || $data->status == 2) {
                            $durasi = "belum dikembalikan";
                        } else {
                            $tgl1_ambil = new DateTime($data->date_ambil);
                            $tgl2_kembali = new DateTime($data->date_kembali);
                            $rentan = $tgl2_kembali->diff($tgl1_ambil);
                            $durasi = $rentan->d . " hari";
                        }
                        ?>
                        <td>{{ $jarak->d }} hari</td>
                        <td>{{ $durasi->d }}</td>
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