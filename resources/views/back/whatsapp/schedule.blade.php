@extends('back.layouts.index')
@push('title', 'Schedule')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Schedule</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>WhatsApp</span></li>
                <li><span style="margin-right: 20px;">Schedule</span></li>
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

            <h2 class="panel-title">Schedule Message</h2>
        </header>
        <div class="panel-body">
            <p>atur waktu kapan pesan akan dikirim</p>
            <a class="btn btn-primary rounded" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> New Schedule</a>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Penerima</th>
                        <th>Tanggal / Waktu</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Internet
                            Explorer 4.0</td>
                        <td>Win 95+</td>
                        <td class="center">4</td>
                        <td class="center">4</td>
                        <td class="center">X</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Internet
                            Explorer 5.0</td>
                        <td>Win 95+</td>
                        <td class="center">5</td>
                        <td class="center">C</td>
                        <td class="center">C</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Internet
                            Explorer 5.5</td>
                        <td>Win 95+</td>
                        <td class="center">5.5</td>
                        <td class="center">A</td>
                        <td class="center">A</td>
                    </tr>
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