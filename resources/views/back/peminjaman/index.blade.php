@extends('back.layouts.index')
@push('title', 'Peminjaman')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Peminjaman</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
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

            <h2 class="panel-title">Daftar Peminjaman</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Keperluan</th>
                        <th>Tgl Ambil</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data->validasi->user->name}}</td>
                        <td>{{$data->validasi->keperluan}}</td>
                        <td>{{date('d F Y', strtotime($data->date_ambil))}}</td>
                        <th width="90px !important">
                            <a href="{{ route('peminjaman.show', $data->id) }}" class="mr-xs mt-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('peminjaman.edit', $data->id) }}" class="mr-xs mt-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Validasi"><i class="fa fa-file-text"></i></a>
                            <a id="delete" data-validasi_id="{{ $data->validasi->id }}" style="width: 34px;" class="mt-xs btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i></i></a>
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
@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<!-- <script src="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.js"></script> -->

<script>
    // delete peminjaman
    $(document).on('click', '#delete', function() {
        var validasi_id = $(this).data('validasi_id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data peminjaman akan dihapus dan status permohonan akan menjadi belum diambil!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, yakin!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: "/peminjaman/" + validasi_id,
                    data: {

                    },
                    success: function(response) {
                        swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success_message
                        }).then((result) => {
                            location.reload();
                        })
                    },
                    error: function(xhr) {
                        swal.fire({
                            icon: 'error',
                            title: 'Oops..!',
                            text: 'Someting went wrong!'
                        });
                    }
                });
            }
        })
    });
</script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
@endpush