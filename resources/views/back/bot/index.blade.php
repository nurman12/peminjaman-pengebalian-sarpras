@extends('back.layouts.index')
@push('title', 'Bot WhatsApp')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Bot</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span style="margin-right: 20px;">Bot</span></li>
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

            <h2 class="panel-title">Daftar Response Bot WhatsApp</h2>
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
            <a href="#modalCreate" class="btn btn-primary rounded mb-xl modal-with-zoom-anim"><i class="fa fa-plus"></i> Buat</a>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Diterima</th>
                        <th>Response</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bot as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data->received}}</td>
                        <td>{{$data->send}}</td>
                        <th width="100px !important">
                            <a href="#modalDetail" id="detail" data-received="{{$data->received}}" data-send="{{$data->send}}" class="mr-xs btn btn-primary btn-sm modal-with-zoom-anim" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            <a href="#modalEdit" id="edit" data-id="{{$data->id}}" data-received="{{$data->received}}" data-send="{{$data->send}}" class="mr-xs btn btn-warning btn-sm modal-with-zoom-anim" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                            <form onclick="return confirm('Yakin ingin hapus ini?')" action="{{ route('bot.destroy', $data->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" style="width: 34px;" class="mr-xs mt-xs btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
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
<div id="modalCreate" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Buat Response Bot</h2>
        </header>
        <form action="{{ route('bot.store') }}" method="post">
            @csrf
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-text">
                        <div class="form-group @error('received') has-error @enderror">
                            <label class="col-sm-4 control-label" for="received">Diterima</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="received" id="received">
                                @error('received')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('response') has-error @enderror">
                            <label class="col-sm-4 control-label" for="kirim">Response</label>
                            <div class="col-sm-8">
                                <textarea name="response" id="response" rows="5" class="form-control"></textarea>
                                <!-- <input type="text" class="form-control input-sm" name="response" id="response"> -->
                                @error('response')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
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
<div id="modalDetail" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Detail Response Bot</h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <div class="form-group @error('received') has-error @enderror">
                        <label class="col-sm-4 control-label" for="received">Diterima</label>
                        <div class="col-sm-8">
                            <p id="received"></p>
                        </div>
                    </div>
                    <div class="form-group @error('response') has-error @enderror">
                        <label class="col-sm-4 control-label" for="kirim">Response</label>
                        <div class="col-sm-8">
                            <p id="send"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-default modal-dismiss">Tutup</button>
                </div>
            </div>
        </footer>
    </section>
</div>
<div id="modalEdit" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Detail Response Bot</h2>
        </header>
        <form id="formUpdate" method="post">
            @csrf
            @method('PUT')
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-text">
                        <div class="form-group @error('received') has-error @enderror">
                            <label class="col-sm-4 control-label" for="received">Diterima</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="received" id="received">
                                @error('received')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('response') has-error @enderror">
                            <label class="col-sm-4 control-label" for="kirim">Response</label>
                            <div class="col-sm-8">
                                <textarea name="response" id="response" rows="5" class="form-control"></textarea>

                                <!-- <input type="text" class="form-control input-sm" name="response" id="response"> -->
                                @error('response')
                                <span class="has-error" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Confirm</button>
                        <button class="btn btn-default modal-dismiss">Tutup</button>
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
<script>
    $(document).on('click', '#detail', function() {
        var received = $(this).data('received');
        var send = $(this).data('send');

        $('#received').text(received);
        $('#send').text(send);
    });
    $(document).on('click', '#edit', function() {
        var id = $(this).data('id');
        var received = $(this).data('received');
        var send = $(this).data('send');

        $('#formUpdate').attr('action', 'bot/' + id);
        $('#received').val(received);
        $('#response').val(send);
    });
</script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
<script src="{{ asset('/back') }}/javascripts/ui-elements/examples.modals.js"></script>
@endpush