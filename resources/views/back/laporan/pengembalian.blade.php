@extends('back.layouts.index')
@push('title', 'Laporan | Pengembalian')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Laporan Pengembalian</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Laporan</span></li>
                <li><span style="margin-right: 20px;">Pengembalian</span></li>
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

            <h2 class="panel-title">Laporan Pengembalian</h2>
        </header>
        <div class="panel-body">
            <div class="row mb-sm">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">Mulai Tanggal</label>
                        <input type="text" name="min" id="min" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">Sampai Tanggal</label>
                        <input type="text" name="max" id="max" class="form-control">
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="example">
                <thead>
                    <tr>
                        <th style="width: 20% !important;">Nama</th>
                        <th style="width: 10% !important;">Tanggal</th>
                        <th style="width: 40% !important;" class="center">Keperluan</th>
                        <th class="center">Durasi</th>
                        <th style="width: 20% !important;">Sarpras</th>
                        <th style="width: 5% !important;">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalian as $data)
                    <tr>
                        <td>
                            <div class="d-flex text-items-center">
                                @if($data->user->photo_profile)
                                <img src="{{  url('/storage/'. $data->user->photo_profile)}}" alt="" class="img-circle img-size-45">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ $data->user->name }}" alt="" class="img-circle img-size-45">
                                @endif
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $data->user->name }}</p>
                                    <p class="test-muted mb-o">{{ $data->user->roles }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ date('d F Y', strtotime($data->date_kembali)) }}</td>
                        <td>{{ $data->validasi->keperluan }}</td>
                        <?php
                        $tgl1_ambil = new DateTime($data->date_ambil);
                        $tgl2_kembali = new DateTime($data->date_kembali);
                        $rentan = $tgl2_kembali->diff($tgl1_ambil);
                        $durasi = $rentan->d . " hari";
                        ?>
                        <td>
                            <span class="badge badge-primary rounded-pill">{{ $durasi }}</span>
                        </td>
                        <td>
                            @foreach($data->validasi->draft as $key => $item)
                            <p class="fw-bold mb-0">{{ $item->sarpras->nama }}</p>
                            @if($data->validasi->draft->count() != $key + 1)
                            <hr class="solid short">
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($data->validasi->draft as $key => $item)
                            <p class="fw-bold mb-0">{{ $item->sarpras_keluar->jumlah }}</p>
                            @if($data->validasi->draft->count() != $key + 1)
                            <hr class="solid short">
                            @endif
                            @endforeach
                        </td>
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
<link rel="stylesheet" href="{{ asset('/back') }}/custom/style.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/datatables/dataTables.dateTime.min.css">
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/datatables.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

<script src="{{ asset('/back') }}/vendor/datatables/moment.min.js"></script>
<script src="{{ asset('/back') }}/vendor/datatables/dataTables.dateTime.min.js"></script> >

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
<!-- <script script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script> -->
<script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[1]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'DD MMMM YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'DD MMMM YYYY'
        });

        // DataTables initialisation
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['pdf', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

        // Refilter the table
        $('#min, #max').on('change', function() {
            table.draw();
        });
    });
</script>
@endpush