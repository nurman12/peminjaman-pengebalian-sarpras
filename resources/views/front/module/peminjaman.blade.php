@extends('front.layouts.index_')
@push('title', 'Peminjaman')
@section('content')
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <h4 class="text-center text-uppercase m-b-22">Daftar Peminjaman</h4>
        <table class="table table-striped table-hover table-bordered" id="example-1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Keperluan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Ambil</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('peminjaman.show', $data->id) }}" style="color: #7280e0;">{{ $data->validasi->keperluan }}</a></td>
                    <td>{{ count($data->validasi->draft) }}</td>
                    <td>{{ date('d F Y', strtotime( $data->date_ambil )) }}</td>
                    <td>
                        @if($data->status == 0)
                        <label class="badge badge-light shadow">Tanggungan</label>
                        @elseif($data->status == 1)
                        <label class="badge badge-success shadow">Success</label>
                        @elseif($data->status == 2)
                        <label class="badge badge-danger shadow">Kerusakan</label>
                        @endif
                    </td>
                    <td class="text-center display-inline">
                        <form action="/draft/print" method="post" target="_blank" rel="noopener noreferrer">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->validasi_id}}">
                            <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="cetak"><i class="fa fa-print" aria-hidden="true"></i></button>
                        </form>
                        @if($data->status == 2)
                        <a href="storage/surat/SURAT%20PERGANTIAN.docx" class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer">Unduh</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.css">
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $('#example-1').DataTable({
            "pagingType": "simple_numbers",
            oLanguage: {
                oPaginate: {
                    sNext: '<i class="zmdi zmdi-skip-next" style="font-size: 19px;"></i>',
                    sPrevious: '<i class="zmdi zmdi-skip-previous" style="font-size: 19px;"></i>'
                }
            },
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ]
        });
        $('.dataTables_filter').addClass('pull-right');
        $('.dataTables_info').addClass('pull-left');
    });
</script>
<script src="{{ asset('/front') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush