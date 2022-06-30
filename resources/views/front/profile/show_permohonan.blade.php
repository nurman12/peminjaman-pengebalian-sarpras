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
                                {{ $validasi->user->name }}
                            </span>
                        </div>
                        <div class="size-219">
                            <span class="stext-110 cl2">
                                NIM
                            </span>
                        </div>
                        <div class="size-220">
                            <span class="stext-115 cl2">
                                {{ $validasi->user->nim_nidn }}
                            </span>
                        </div>
                        <div class="size-219">
                            <span class="stext-110 cl2">
                                Keperluan
                            </span>
                        </div>
                        <div class="size-220">
                            <span class="stext-115 cl2">
                                {{ $validasi->keperluan }}
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
                                {{ date('d F Y', strtotime( $validasi->tanggal_start )) }}
                            </span>
                        </div>
                        <div class="size-208">
                            <span class="stext-115 cl2">
                                Sampai
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-115 cl2">
                                {{ date('d F Y', strtotime( $validasi->tanggal_finish )) }}
                            </span>
                        </div>
                        <div class="size-208">
                            <span class="stext-115 cl2">
                                Status
                            </span>
                        </div>
                        <div class="size-209">
                            @if($validasi->status == 3)
                            <span class="stext-101 cl0 size-115 bg11 bor13 p-lr-15 trans-04">Kadaluarsa</span>
                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 1 && $validasi->status == 0 )
                            <span class="stext-101 cl0 size-115 bg10 bor13 p-lr-15 trans-04">Disetujui</span>
                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 0 )
                            <span class="stext-101 cl0 size-115 bg3 bor13 p-lr-15 trans-04">Seleksi BMN</span>
                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                            <span class="stext-101 cl0 size-115 bg3 bor13 p-lr-15 trans-04">Seleksi Koordinator</span>
                            @elseif( $validasi->validasi_ktu == 0 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                            <span class="stext-101 cl0 size-115 bg3 bor13 p-lr-15 trans-04">Seleksi TU</span>
                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 1 && $validasi->validasi_bmn == 2 )
                            <span class="stext-101 cl0 size-115 bg11 bor13 p-lr-15 trans-04">Tolak BMN</span>
                            @elseif( $validasi->validasi_ktu == 1 && $validasi->validasi_koor == 2 && $validasi->validasi_bmn == 0 )
                            <span class="stext-101 cl0 size-115 bg11 bor13 p-lr-15 trans-04">Tolak Koordionator</span>
                            @elseif( $validasi->validasi_ktu == 2 && $validasi->validasi_koor == 0 && $validasi->validasi_bmn == 0 )
                            <span class="stext-101 cl0 size-115 bg11 bor13 p-lr-15 trans-04">Tolak TU</span>
                            @endif
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
                            </tr>
                        </thead>
                        <tbody>
                            @if($validasi->status == 3)
                            @foreach($validasi->draft as $data)
                            <?php
                            $value = App\Models\SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->first();
                            ?>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->sarpras->nama }}</a></td>
                                <td>{{ $value->jumlah }}</td>
                            </tr>
                            @endforeach
                            @else
                            @foreach($validasi->draft as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->sarpras->nama }}</a></td>
                                <td>{{ $data->qty }}</td>
                            </tr>
                            @endforeach
                            @endif
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