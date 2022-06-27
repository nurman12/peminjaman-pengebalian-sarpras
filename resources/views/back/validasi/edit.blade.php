@extends('back.layouts.index')
@push('title', 'Validasi | Edit')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Detail Validasi</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Validasi</span></li>
                <li><span style="margin-right: 20px;">Edit</span></li>
            </ol>

        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        @if($validasi->user->photo_profile)
                        <img src="{{  url('/storage/'. $validasi->user->photo_profile) }}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{$validasi->user->name}}" id="preview_pengguna" class="rounded img-responsive" style="width: 35vh;">
                        @endif
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{$validasi->user->name}}</span>
                            <span class="thumb-info-type">{{$validasi->user->roles}}</span>
                        </div>
                    </div>

                    <h6 class="text-muted">Data Profile</h6>
                    <div class="content">
                        <ul class="simple-user-list">
                            <li>
                                <span class="title">NIM/NIDN</span>
                                <span class="message truncate">{{$validasi->user->nim_nidn}}</span>
                            </li>
                            <li>
                                <span class="title">Email</span>
                                <span class="message truncate">{{$validasi->user->email}}</span>
                            </li>
                            <li>
                                <span class="title">No Telp</span>
                                <span class="message truncate">{{$validasi->user->no_telp}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
        <style>
            .daterangepicker .calendar {
                margin: 0 10px;
                padding: 10px;
            }

            .daterangepicker_input .glyphicon-calendar {
                display: none;
            }

            .calendar-time .hourselect,
            .calendar-time .minuteselect,
            .calendar-time .ampmselect {
                height: 25px;
            }

            .ranges .range_inputs {
                margin-top: 4px;
                margin-left: 10px;
            }

            .ranges .range_inputs .cancelBtn {
                margin: 0 10px;
            }

            .daterangepicker .calendar {
                margin: 0 10px;
                padding: 10px;
            }

            .daterangepicker_input .glyphicon-calendar {
                display: none;
            }

            .calendar-time .hourselect,
            .calendar-time .minuteselect,
            .calendar-time .ampmselect {
                height: 25px;
            }

            .ranges .range_inputs {
                margin-top: 4px;
                margin-left: 10px;
            }

            .ranges .range_inputs .cancelBtn {
                margin: 0 10px;
            }
        </style>
        <div class="col-md-8 col-lg-9">
            <section class="panel">
                <div class="panel-body">
                    @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Peringatan !!</strong> {{\Session::get('success')}}
                    </div>
                    @endif
                    <form action="{{ route('validasi_edit.update', $validasi->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row mb-xl">
                            <div class="col-md-8 col-sm-12">
                                <div class="flex-w flex-t">
                                    <div class="size-208">
                                        <span class="stext-115 cl2">
                                            Keperluan
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        <span class="stext-115 cl2">
                                            <input type="text" class="form-control @error('keperluan') has-error @enderror" name="keperluan" value="{{ $validasi->keperluan }}">
                                            @error('keperluan')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="size-208 mb-sm">
                                        <span class="stext-115 cl2">
                                            Proposal
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        <span class="stext-115 cl2">
                                            <input type="hidden" name="old_proposal" value="{{ $validasi->proposal }}">
                                            <a href="/storage/{{ $validasi->proposal }}" target="_blank" rel="noopener noreferrer">
                                                <span class="mb-xs mt-xs btn btn-success btn-xs c-default" style="cursor: pointer;"> <i class="fa fa-download"></i> Download</span>
                                            </a>
                                        </span>
                                    </div>
                                    <div class="size-208 mb-sm">
                                        <span class="stext-115 cl2">
                                            Proposal Baru
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        <span class="stext-115 cl2">
                                            <input type="hidden" name="old_proposal" value="{{ $validasi->proposal }}">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-append">
                                                    <div class="uneditable-input">
                                                        <!-- <i class="fa fa-file fileupload-exists"></i> -->
                                                        <span class="fileupload-preview"></span>
                                                    </div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileupload-exists">Ganti</span>
                                                        <span class="fileupload-new">Pilih file</span>
                                                        <input type="file" name="proposal" />
                                                    </span>
                                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Hapus</a>
                                                </div>
                                            </div>
                                            @error('proposal')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="flex-w flex-t" id="picker">
                                    <div class="size-208 mb-sm">
                                        <span class="stext-115 cl2">
                                            Mulai
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        <span class="stext-115 cl2">
                                            <input type="text" class="form-control @error('mulai') has-error @enderror" name="mulai" id="start" value="{{ date('Y-m-d', strtotime($validasi->tanggal_start)) }}" autocomplete="off">
                                        </span>
                                    </div>
                                    @error('mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="size-208 mb-sm">
                                        <span class="stext-115 cl2">
                                            Sampai
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        <span class="stext-115 cl2">
                                            <input type="text" class="form-control @error('sampai') has-error @enderror" name="sampai" id="end" value="{{ date('Y-m-d', strtotime($validasi->tanggal_finish)) }}" autocomplete="off">
                                        </span>
                                    </div>
                                    @error('sampai')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="flex-w flex-t">
                                    <div class="size-208">
                                        <span class="stext-115 cl2">
                                            Status
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        @if($validasi->tanggal_finish < date('Y-m-d')) <span class="mb-xs mt-xs btn btn-dark btn-xs c-default">Kedaluwarsa <i class="fa fa-check-circle"></i></span>
                                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 1 && $validasi->status == 0 )
                                            <span class="mb-xs mt-xs btn btn-success btn-xs c-default">Disetujui <i class="fa fa-check-circle"></i></span>
                                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 0 )
                                            <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Seleksi BMN <i class="fa fa-spinner"></i></span>
                                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                                            <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Seleksi Koordinator <i class="fa fa-spinner"></i></span>
                                            @elseif( $validasi->validasi_ktu == 0 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                                            <span class="mb-xs mt-xs btn btn-primary btn-xs c-default">Seleksi TU <i class="fa fa-spinner"></i></span>
                                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 2 )
                                            <span class="mb-xs mt-xs btn btn-danger btn-xs c-default">Tolak BMN <i class="fa fa-times-circle"></i></span>
                                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 2 && $validasi->validasi_bmn == 0 )
                                            <span class="mb-xs mt-xs btn btn-danger btn-xs c-default">Tolak Koordinator <i class="fa fa-times-circle"></i></span>
                                            @elseif( $validasi->validasi_ktu == 2 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                                            <span class="mb-xs mt-xs btn btn-danger btn-xs c-default">Tolak TU <i class="fa fa-times-circle"></i></span>
                                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 1 && $validasi->status == 1 )
                                            <span class="mb-xs mt-xs btn btn-info btn-xs c-default">Diambil <i class="fa fa-fax"></i></span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('validasi_edit.add', $validasi->id) }}" class="btn btn-primary rounded" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Tambah Sarpras</a>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($validasi->draft as $data)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $data->sarpras->nama }}</td>
                                    <td style="width: 30%;">
                                        <div style="margin: auto; width: 60%;">
                                            <div data-plugin-spinner data-plugin-options='{ "value":{{ $data->qty == 0 ? $data->sarpras_keluar->jumlah : $data->qty }}, "step": 1, "min": 1, "max": {{ $data->sarpras->jumlah + $data->qty }} }'>
                                                <div class="input-group">
                                                    <div class="spinner-buttons input-group-btn">
                                                        <button type="button" class="btn btn-default spinner-down">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="draft_id[]" value="{{ $data->id }}">
                                                    <input type="text" name="qty[]" class="spinner-input form-control text-center" readonly>
                                                    <div class="spinner-buttons input-group-btn">
                                                        <button type="button" class="btn btn-default spinner-up">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a href="#Photo" id="show" data-nama_item="{{ $data->sarpras->nama }}" data-img="{{ $data->sarpras->photo }}" data-desc="{{$data->sarpras->deskripsi}}" class="mr-xs btn btn-primary btn-sm modal-with-zoom-anim" data-toggle="tooltip" data-placement="top" title="Foto">
                                            <i class="fa fa-picture-o"></i>
                                        </a>
                                        <a id="delete" data-id="{{ $data->id }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- End page -->
</section>
</div>
@endsection

@push('style')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
@endpush

@push('modals')
<div id="Photo" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"></h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="row">
                    <div class="col-md-4">
                        <img id="img" class="img-responsive" src="">
                    </div>
                    <div class="col-md-8">
                        <p id="deskripsi"></p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>
@endpush

@push('script')
<script src="{{ asset('/back') }}/vendor/fuelux/js/spinner.js"></script>
<script src="{{ asset('/front') }}/vendor/daterangepicker/moment.min.js"></script>
<script src="{{ asset('/front') }}/vendor/daterangepicker/daterangepicker.js"></script>
<script>
    // daterangepicker 
    var dateToday = new Date();
    $('#picker').daterangepicker({
        minDate: dateToday,
        opens: 'left',
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'YYYY-MM-DD'
        }
    }, function(start, end, label) {
        $('#start').val(start.format('YYYY-MM-DD'))
        $('#end').val(end.format('YYYY-MM-DD'))
    });

    $(document).on('click', '#picker', function() {
        $('.daterangepicker').removeAttr('style[0]');

        const color = document.getElementsByClassName("daterangepicker");
        color[0].style.display = 'flex';
    });

    // delete list draft
    $(document).on('click', '#delete', function() {
        var draft_id = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal.fire({
            title: 'Apa kamu yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: "/validasi_edit/" + draft_id,
                    data: {

                    },
                    success: function(response) {
                        if (response.error_message) {
                            swal.fire({
                                icon: 'error',
                                title: 'Oops..!',
                                text: response.error_message
                            });
                        } else {
                            swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Menghapus sarpras pada draft peminjam!'
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

    // set modal photo
    $(document).ready(function() {
        $(document).on('click', '#show', function() {
            var nama = $(this).data('nama_item');
            var img = $(this).data('img');
            var desc = $(this).data('desc');

            $('.panel-title').text(nama);
            $('#img').attr("src", '/storage/' + img);
            $('p#deskripsi').text(desc);
        });
    });
</script>
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script src="{{ asset('/back') }}/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
<script src="{{ asset('/back') }}/javascripts/ui-elements/examples.modals.js"></script>
@endpush