@extends('back.layouts.index')
@push('title', 'Validasi')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Semua Data Validasi</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Validasi</span></li>
                <li><span style="margin-right: 20px;">Semua</span></li>
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

            <h2 class="panel-title">Daftar Semua Validasi</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Peminjam</th>
                        <th>Keperluan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Validasi KTU</th>
                        <th>Validasi KOOR</th>
                        <th>Validasi BMN</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($validasi as $data)
                    @if($data->status == 3)
                    <tr class="text-danger">
                        @else
                    <tr>
                        @endif
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->keperluan }}</td>
                        <td>{{ date('d F', strtotime($data->tanggal_start)) }} sd. {{ date('d F Y', strtotime($data->tanggal_finish)) }}</td>
                        <td>
                            @if($data->validasi_ktu == 0)
                            <label class="badge badge-warning bdg-yellow shadow">Pendding</label>
                            @elseif($data->validasi_ktu == 1)
                            <label class="badge badge-success bdg-green shadow">Lolos</label>
                            @elseif($data->validasi_ktu == 2)
                            <label class="badge badge-danger bdg-red shadow">Tolak</label>
                            @endif
                        </td>
                        <td>
                            @if($data->validasi_koor == 0)
                            <label class="badge badge-warning bdg-yellow shadow">Pendding</label>
                            @elseif($data->validasi_koor == 1)
                            <label class="badge badge-success bdg-green shadow">Lolos</label>
                            @elseif($data->validasi_koor == 2)
                            <label class="badge badge-danger bdg-red shadow">Tolak</label>
                            @endif
                        </td>
                        <td>
                            @if($data->validasi_bmn == 0)
                            <label class="badge badge-warning bdg-yellow shadow">Pendding</label>
                            @elseif($data->validasi_bmn == 1)
                            <label class="badge badge-success bdg-green shadow">Lolos</label>
                            @elseif($data->validasi_bmn == 2)
                            <label class="badge badge-danger bdg-red shadow">Tolak</label>
                            @endif
                        </td>
                        <td width="90px !important">
                            <a href="{{ route('validasi.show', $data->id) }}" class="mr-xs mt-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            @if($data->status == 0)
                            <a href="{{ route('validasi.edit', $data->id) }}" class="mt-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                            <a id="delete" data-validasi_id="{{ $data->id }}" style="width: 34px;" class="mr-xs mt-xs btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"> <i class="fa fa-trash-o"></i></a>
                            @endif
                            @if($data->validasi_bmn == 1 && $data->status == 0 )
                            <a id="ambil" data-validasi_id="{{ $data->id }}" data-user_id="{{ $data->user_id }}" data-nama="{{ $data->user->name }}" class="mt-xs btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ambil"> <i class="fa fa-truck"></i></a>
                            @endif
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
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

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
            text: "Menghapus data permohonan pinjaman!",
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
                    url: "/validasi/" + validasi_id,
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
    // ambil peminjaman
    $(document).on('click', '#ambil', function() {
        var validasi_id = $(this).data('validasi_id');
        var user_id = $(this).data('user_id');
        var nama = $(this).data('nama');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal.fire({
            title: 'Apa kamu yakin?',
            text: nama + " mengambil peminjaman!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, yakin!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "{{ route('peminjaman.store') }}",
                    data: {
                        'validasi_id': validasi_id,
                        'user_id': user_id,
                    },
                    success: function(response) {
                        if (response.error_message) {
                            swal.fire({
                                icon: 'error',
                                title: 'Oops..!',
                                text: response.error_message
                            });
                        } else if (response.success_message) {
                            swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success_message
                            }).then((result) => {
                                location.reload();
                            })
                        }
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