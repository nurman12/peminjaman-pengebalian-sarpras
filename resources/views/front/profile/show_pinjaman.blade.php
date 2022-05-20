@extends('front.layouts.index_')
@push('title', 'Profile')
@section('content')
<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
            <div class="row p-b-10">
                <div class="col-sm-8 col-md-8">
                    <div class="flex-w flex-t p-b-13">
                        <div class="size-219">
                            <span class="stext-110 cl2">
                                Nama
                            </span>
                        </div>
                        <div class="size-220">
                            <span class="stext-115 cl2">
                                {{ $peminjaman->validasi->user->name }}
                            </span>
                        </div>
                        <div class="size-219">
                            <span class="stext-110 cl2">
                                NIM
                            </span>
                        </div>
                        <div class="size-220">
                            <span class="stext-115 cl2">
                                {{ $peminjaman->validasi->user->nim_nidn }}
                            </span>
                        </div>
                        <div class="size-219">
                            <span class="stext-110 cl2">
                                Keperluan
                            </span>
                        </div>
                        <div class="size-220">
                            <span class="stext-115 cl2">
                                {{ $peminjaman->validasi->keperluan }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 txt-right ">
                    <div class="flex-w flex-t p-b-13">
                        <div class="size-208">
                            <span class="stext-115 cl2">
                                Mulai
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-115 cl2">
                                {{ date('l, d F Y', strtotime( $peminjaman->validasi->tanggal_start )) }}
                            </span>
                        </div>
                        <div class="size-208">
                            <span class="stext-115 cl2">
                                Sampai
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-115 cl2">
                                {{ date('l, d F Y', strtotime( $peminjaman->validasi->tanggal_finish )) }}
                            </span>
                        </div>
                        <div class="size-208">
                            <span class="stext-115 cl2">
                                Status
                            </span>
                        </div>
                        <div class="size-209">
                            @if($peminjaman->status == 0)
                            <span class="stext-101 cl0 size-115 bg3 bor13 p-lr-15 trans-04">Tanggungan</span>
                            @elseif($peminjaman->status == 1)
                            <span class="stext-101 cl0 size-115 bg10 bor13 p-lr-15 trans-04">Success</span>
                            @elseif($peminjaman->status == 2)
                            <span class="stext-101 cl0 size-115 bg11 bor13 p-lr-15 trans-04">Kerusakan</span>
                            @endif
                        </div>
                        <div class="size-208">
                            <span class="stext-115 cl2">
                                Pengambilan
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-115 cl2">
                                {{ date('d F Y', strtotime( $peminjaman->date_ambil )) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 p-t-20">
                    <table class="table table-hover table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman->validasi->draft as $data)
                            @if($data->kondisi == 2)
                            <tr class="table-danger">
                                @elseif($data->kondisi == 1)
                            <tr class="table-success">
                                @elseif($data->kondisi == 0)
                            <tr class="">
                                @endif

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->sarpras->nama }}</a></td>
                                <td>
                                    @if($data->kondisi == 1)
                                    {{ $data->sarpras_masuk->jumlah }}
                                    @else
                                    {{ $data->qty }}
                                    @endif
                                </td>
                                <td>
                                    @if($data->kondisi == 1)
                                    <p>Dikembalikan</p>
                                    @elseif( $data->sarpras_keluar->hilang > 0 )
                                    <p class="text-lowercase">{{ $data->sarpras_keluar->hilang }} {{ $data->sarpras_keluar->keterangan }}</p>
                                    @elseif($data->kondisi == 0)
                                    <p>Dibawa</p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.css">
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "pagingType": "simple_numbers",
            oLanguage: {
                oPaginate: {
                    sNext: '<i class="zmdi zmdi-skip-next" style="font-size: 19px;"></i>',
                    sPrevious: '<i class="zmdi zmdi-skip-previous" style="font-size: 19px;"></i>'
                }
            }
        });
        $('.dataTables_filter').addClass('pull-right');
        $('.dataTables_info').addClass('pull-left');
    });
</script>
<script src="{{ asset('/front') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/front') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush