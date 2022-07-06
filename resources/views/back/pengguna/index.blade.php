@extends('back.layouts.index')
@push('title', 'Pengguna')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Pengguna</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span style="margin-right: 20px;">Pengguna</span></li>
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

            <h2 class="panel-title">Daftar Pengguna</h2>
        </header>
        <div class="panel-body">
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Peringatan !!</strong> {{\Session::get('success')}}
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-lg-4 col-lg-offset-4">
                    <!-- <div class="mb-md"> -->
                    <a href="{{ route('pengguna.create') }}" class="btn btn-primary rounded"><i class="fa fa-plus"></i> Create</a>
                    <a href="#modalAnim" class="btn btn-info rounded mr-xl ml-xl modal-with-zoom-anim"><i class="fa fa-cloud-upload"></i> Import</a>
                    <a href="/pengguna/export" class="btn btn-warning rounded"><i class="fa fa-cloud-download"></i> Export</a>
                    <!-- </div> -->
                </div>
            </div>
            @error('file')
            <div class="alert alert-danger" style="margin-top: 10px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{$message}}
            </div>
            @enderror
            @if(session()->has('failures'))
            <table class="table table-bordered table-striped mb-4 mt-4">
                <thead>
                    <tr class="bg-danger">
                        <th>Row</th>
                        <th>Attribute</th>
                        <th>Errors</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session()->get('failures') as $validation)
                    <tr>
                        <td>{{ $validation->row() }}</td>
                        <td>{{ $validation->attribute() }}</td>
                        <td>
                            <ul>
                                @foreach( $validation->errors() as $e )
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $validation->values()[$validation->attribute()] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM/NIDN/NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="hidden-phone">Level</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td><span class="highlight rounded">{{$data['nim_nidn']}}</span></td>
                        <td>{{$data['name']}}</td>
                        <td>{{$data['email']}}</td>
                        <td class="center">{{$data['roles']}}</td>
                        <th width="120px">
                            <a href="{{ route('pengguna.show', $data['id']) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            @if($data['roles'] != 'BMN')
                            <a href="{{ route('pengguna.edit', $data['id']) }}" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                            <a id="delete" data-id="{{ $data['id'] }}" data-nama="{{$data['name']}}" data-gambar="{{$data['photo_profile']}}" class=" btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i></i></a>
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
<!-- <link rel="stylesheet" href="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.css" /> -->
@endpush
@push('modals')
<div id="modalAnim" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Import Data Pengguna</h2>
        </header>
        <form action="{{ route('pengguna.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fa fa-file-excel-o"></i>
                    </div>
                    <div class="modal-text">
                        <input type="file" class="form-control" name="file" required>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Confirm</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

@endpush
@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<!-- <script src="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.js"></script> -->
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
            text: "Data " + nama + " kemungkinan terhubung dengan data lain",
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
                    url: "/pengguna/" + id,
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
                                        url: "/pengguna_delete/" + id,
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
<script src="{{ asset('/back') }}/javascripts/ui-elements/examples.modals.js"></script>
@endpush