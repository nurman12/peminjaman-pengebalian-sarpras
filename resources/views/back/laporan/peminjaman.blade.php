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
            <table class="table table-bordered table-striped mb-none" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Keperluan</th>
                        <th class="center">Rencana Peminjaman</th>
                        <th class="center">Durasi</th>
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
                        <td>{{ $durasi }}</td>
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
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/datatables/datatables.min.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/datatables/Buttons-2.2.3/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/datatables.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

<script src="{{ asset('/back') }}/vendor/datatables/Buttons-2.2.3/js/dataTables.buttons.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/Buttons-2.2.3/js/buttons.bootstrap.min.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/Buttons-2.2.3/js/buttons.html5.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/Buttons-2.2.3/js/buttons.print.min.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/Buttons-2.2.3/js/buttons.colVis.min.js"></script>
@endpush

@push('last_script')
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    });
</script>
@endpush