@extends('back.layouts.index')
@push('title', 'Sarpras')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sarpras</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Sarpras</span></li>
                <li><span style="margin-right: 20px;">Master Data</span></li>
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

            <h2 class="panel-title">Daftar Sarpras</h2>
        </header>
        <div class="panel-body">
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Peringatan !!</strong> {{\Session::get('success')}}
            </div>
            @endif
            <a href="{{ route('sarpras.create') }}" class="btn btn-primary rounded" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Create</a>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis</th>
                        <th>Nama</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sarpras as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data->jenis}}</td>
                        <td>{{$data->nama}}</td>
                        <th width="125px">
                            <a href="{{ route('sarpras.show', $data->id) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('sarpras.edit', $data->id) }}" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                            <a id="delete" data-id="{{ $data->id }}" data-nama="{{$data->nama}}" data-gambar="{{$data->photo}}" style="width: 34px;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i></i></a>
                            <!-- <form onclick="return confirm('Yakin ingin hapus ini?')" action="{{ route('sarpras.destroy', $data->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="old_photo" value="{{$data->photo}}">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form> -->
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
<script>
    $(document).on('click', '#delete', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var photo = $(this).data('gambar');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal.fire({
            title: 'Yakin Ingin Hapus?',
            text: "Data " + nama + " kemungkinan terhubung dengan data lain, termasuk data masuk keluar",
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
                    url: "/sarpras/" + id,
                    data: {
                        photo: photo,
                    },
                    success: function(response) {
                        if (response.error_message) {
                            swal.fire({
                                title: 'Error!',
                                text: response.error_message,
                                icon: 'warning',
                                showDenyButton: true,
                                confirmButtonText: 'Ya',
                                denyButtonText: `Nanti`,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        method: "DELETE",
                                        url: "/sarpras_delete/" + id,
                                        data: {
                                            photo: photo,
                                        },
                                        success: function(response) {
                                            swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: response.success_messages
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
                                    })
                                } else if (result.isDenied) {
                                    location.reload();
                                }
                            })
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