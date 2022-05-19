@extends('back.layouts.index')
@push('title', 'Masuk | Sarpras')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sarpras Masuk</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Sarpras</span></li>
                <li><span style="margin-right: 20px;">Masuk</span></li>
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

            <h2 class="panel-title">Daftar Sarpras Masuk</h2>
        </header>
        <div class="panel-body">
            <a href="{{ route('sarpras_masuk.create') }}" class="btn btn-primary rounded" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Create</a>
            <div id="content">
                @include('back.sarpras_masuk.table')
            </div>
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="img" src="" style="width: 29rem;" alt="">
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control tanggal" id="tanggal">
                            <input type="hidden" class="id" id="id">
                            <input type="hidden" class="sarpras_id" id="sarpras_id">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control jumlah" id="jumlah">
                            <input type="hidden" class="jumlah" id="old_jumlah">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control keterangan" id="keterangan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="update">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
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
        $(document).on('click', '#update', function() {
            const id = $('#id').val();
            const sarpras_id = $('#sarpras_id').val();
            const tanggal = $('#tanggal').val();
            const jumlah = $('#jumlah').val();
            const old_jumlah = $('#old_jumlah').val();
            const keterangan = $('#keterangan').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'sarpras_masuk/' + id,
                type: 'PUT',
                data: {
                    sarpras_id: sarpras_id,
                    tanggal: tanggal,
                    jumlah: jumlah,
                    old_jumlah: old_jumlah,
                    keterangan: keterangan,
                },
                success: function(data) {
                    $('#content').html(data);
                }
            })
        });
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
            $('.keterangan').val(keterangan_draf);
            $('.id').val(id);
            $('.sarpras_id').val(sarpras_id);
            $('.jumlah').val(jumlah);
            $('.tanggal').val(tanggal);
        });
    });
</script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
@endpush