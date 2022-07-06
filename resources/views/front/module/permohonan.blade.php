@extends('front.layouts.index_')
@push('title', 'Permohonan')
@section('content')
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <h4 class="text-center text-uppercase m-b-22">Daftar Permohonan Peminjaman</h4>
        <table class="table table-striped table-hover table-bordered" id="example-1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Keperluan</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permohonan as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('validasi.show', $data->id) }}" style="color: #7280e0;">{{ $data->keperluan }}</a></td>
                    <td>{{ count($data->draft) }}</td>
                    <td>{{ date('d F', strtotime( $data->tanggal_start )) }} sd. {{ date('d F Y', strtotime( $data->tanggal_finish )) }}</td>
                    <td>
                        @if( $data->status == 3 )
                        <label class="badge badge-danger shadow">Kadaluarsa</label>
                        @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 1 && $data->status == 0 )
                        <label class="badge badge-success shadow">Disetujui</label>
                        @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 0 )
                        <label class="badge badge-light shadow">Seleksi BMN</label>
                        @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 0 && $data->validasi_bmn == 0 )
                        <label class="badge badge-light shadow">Seleksi Koordinator</label>
                        @elseif( $data->validasi_ktu == 0 && $data->validasi_koor == 0 && $data->validasi_bmn == 0 )
                        <label class="badge badge-light shadow">Seleksi TU</label>
                        @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 2 )
                        <label class="badge badge-danger shadow">Tolak BMN</label>
                        @elseif( $data->validasi_ktu == 1 && $data->validasi_koor == 2 && $data->validasi_bmn == 0 )
                        <label class="badge badge-danger shadow">Tolak Koordionator</label>
                        @elseif( $data->validasi_ktu == 2 && $data->validasi_koor == 0 && $data->validasi_bmn == 0 )
                        <label class="badge badge-danger shadow">Tolak TU</label>
                        @endif
                    </td>
                    <td class="text-center display-inline">
                        @if($data->validasi_ktu == 1 && $data->validasi_koor == 1 && $data->validasi_bmn == 1 && $data->status == 0)
                        <form action="/draft/print" method="post" target="_blank" rel="noopener noreferrer">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="cetak"><i class="fa fa-print" aria-hidden="true"></i></button>
                        </form>
                        @endif
                        @if($data->validasi_ktu == 0)
                        <a href="{{ route('validasi.edit', $data->id) }}" class="btn btn-warning btn-sm fa fa-pencil-square-o" data-toggle="tooltip" title="Ubah"></a>
                        <form action="{{ route('validasi.destroy', $data->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="proposal" value="{{$data->proposal}}">
                            <button type="submit" onclick="return confirm('Yakin ingin Hapus ini?')" class="btn btn-danger btn-sm fa fa-trash" data-toggle="tooltip" title="Hapus"><button>
                        </form>
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