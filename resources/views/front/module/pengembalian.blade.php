@extends('front.layouts.index_')
@push('title', 'Pengembalian')
@section('content')
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <h4 class="text-center text-uppercase m-b-22">Daftar Pengembalian</h4>
        <table class="table table-striped table-hover table-bordered" id="example-1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Keperluan</th>
                    <th>Tanggal Ambil</th>
                    <th>Tanggal Kembali</th>
                    <th>Penilaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengembalian as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('pengembalian.show', $data->id) }}" style="color: #7280e0;">{{ $data->validasi->keperluan }}</a></td>
                    <td>{{ date('d F Y', strtotime( $data->date_ambil )) }}</td>
                    <td>{{ date('d F Y', strtotime( $data->date_kembali )) }}</td>
                    <td id="rate-rating">
                        @if($data->rating->penilaian == 1)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @elseif($data->rating->penilaian == 2)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @elseif($data->rating->penilaian == 3)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @elseif($data->rating->penilaian == 4)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @elseif($data->rating->penilaian == 5)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
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