@extends('back.layouts.index')
@push('title', 'Keluar | Sarpras')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sarpras Keluar</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Sarpras</span></li>
                <li><span style="margin-right: 20px;">Keluar</span></li>
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

            <h2 class="panel-title">Daftar Sarpras Keluar</h2>
        </header>
        <div class="panel-body">
            @if(\Session::has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Peringatan !!</strong> {{\Session::get('error')}}
            </div>
            @endif
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Peringatan !!</strong> {{\Session::get('success')}}
            </div>
            @endif
            <a href="{{ route('sarpras_keluar.create') }}" class="btn btn-primary rounded" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Create</a>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th class="hidden-phone">Jumlah</th>
                        <th>Keterangan</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sarpras_keluar as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data['nama']}}</td>
                        <td>{{date('d F Y', strtotime($data['tanggal']))}}</td>
                        <td class="center">
                            {{$data['jumlah']}}
                        </td>
                        <td>
                            {{$data['keperluan']}}
                        </td>
                        <th width="125px">
                            <a href="{{ route('sarpras_keluar.show', $data['id']) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            @if($data['draft_id'] == null)
                            <a id="edit" data-id="{{$data['id']}}" data-tanggal="{{$data['tanggal']}}" data-jumlah="{{$data['jumlah']}}" data-keterangan="{{$data['keperluan']}}" data-sarpras_id="{{ $data['sarpras_id'] }}" data-nama="{{ $data['nama'] }}" data-img="{{ $data['photo'] }}" data-toggle="modal" data-target="#exampleModal" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                            <a id="delete" data-id="{{ $data['id'] }}" data-nama="{{$data['nama']}}" data-gambar="{{$data['photo']}}" style="width: 34px;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i></i></a>
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

@push('modals')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: black;" id="exampleModalLabel"> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="img" src="" style="width: 29rem;" alt="">
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control tanggal" id="tanggal">
                                <input type="hidden" name="sarpras_id" class="sarpras_id" id="sarpras_id">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control jumlah">
                                <input type="hidden" name="old_jumlah" class="jumlah">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control keterangan" id="keterangan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#edit', function() {
            var nama_sarpras = $(this).data('nama');
            var img_sarpras = $(this).data('img');
            var keterangan_draf = $(this).data('keterangan');
            var id = $(this).data('id');
            var sarpras_id = $(this).data('sarpras_id');
            var jumlah = $(this).data('jumlah');
            var tanggal = $(this).data('tanggal');

            $('.modal-title').text("Edit " + nama_sarpras);
            $('#img').attr('src', '/storage/' + img_sarpras);
            $('.tanggal').val(tanggal);
            $('.sarpras_id').val(sarpras_id);
            $('.jumlah').val(jumlah);
            $('.keterangan').val(keterangan_draf);
            $('#form').attr('action', 'sarpras_keluar/' + id);
        });
        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            swal.fire({
                title: 'Apa kamu yakin?',
                text: "Menghapus " + nama + " keluar",
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
                        url: "/sarpras_keluar/" + id,
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
    });
</script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
@endpush