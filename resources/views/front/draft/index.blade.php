@extends('front.layouts.index_')
@push('title', 'Draft')
@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Draf
        </span>
    </div>
</div>


<!-- Shoping Cart -->
<div class="bg0 p-t-55 p-b-85">
    <div class="container">
        @if(\Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Peringatan !!</strong> {{\Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif(\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Peringatan !!</strong> {{\Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart" id="table_draft">

                        </table>
                    </div>
                </div>
            </div>
            <style>
                .nav-item>.nav-link {
                    color: #fff;
                    margin-right: 5px;
                    border-radius: 5px;
                    font-size: 14px;
                    border: none;
                    padding: 11px 23px;
                    line-height: 1.5;
                }

                .nav-item.show .nav-link,
                .nav-link.active {
                    background-color: rgba(255, 255, 255, 0.2);
                    color: #fff;
                }

                .nav-item>.nav-link:hover {
                    background-color: rgba(255, 255, 255, 0.2);
                }

                .dropdown-item.active {
                    color: #fff;
                    background-color: #222;
                }

                .dropdown-item:hover {
                    color: #fff;
                    background-color: #222;
                }

                .tab-pane {
                    padding: 20px;
                }
            </style>
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-10">
                <div class="bor10 card p-b-10 m-l-63 m-r-40 m-lr-0-xl">
                    @if(count($data) == 0)
                    <ul class="nav bg1 p-tb-10 p-lr-10" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#baru" role="tab">Baru</a>
                        </li>
                    </ul>
                    @else
                    <ul class="nav bg1 p-tb-10 p-lr-10" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#baru" role="tab">Baru</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Sudah Ada</a>
                            <div class="dropdown-menu m-0 p-0 border-0 shadow">
                                @foreach($data as $data)
                                <a class="dropdown-item" data-toggle="tab" data-keperluan="{{ $data->keperluan }}" href="#{{ $data->id }}">{{ $data->keperluan }}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="baru" role="tabpanel">
                            <form action="{{ route('validasi.store') }}" method="POST" enctype="multipart/form-data" class="p-t-15">
                                @csrf
                                <h4 class="mtext-109 cl2 p-b-30">
                                    Data Permohonan Baru
                                </h4>
                                <div class="flex-w flex-t bor12 p-b-13">
                                    <div class="size-208">
                                        <span class="stext-110 cl2">
                                            Total
                                        </span>
                                    </div>

                                    <div class="size-209">
                                        <span class="mtext-110 cl2" id="total_draft"></span>
                                    </div>
                                </div>
                                <div class="flex-w flex-t  p-t-15 p-b-10">
                                    <div class="size-208 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Keperluan
                                        </span>
                                    </div>
                                    <div class="bor8 bg0 m-b-12 w-full">
                                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                        <textarea class="form-control @error('keperluan') is-invalid @enderror stext-113 cl2 size-110" id="AreaText" type="text" name="keperluan" autocomplete="off">
                                        {{ old('keperluan') }}
                                        </textarea>
                                    </div>
                                    @error('keperluan')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="flex-w flex-t  p-t-15 p-b-10">
                                    <div class="size-208 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Proposal
                                        </span>
                                    </div>
                                    <div class="bor8 bg0 m-b-12 w-full">
                                        <input class="form-control @error('proposal') is-invalid @enderror" type="file" name="proposal">
                                    </div>
                                    @error('proposal')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="flex-w flex-t  p-t-15 p-b-30">
                                    <div class="size-208 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Tanggal
                                        </span>
                                    </div>
                                    <div class="row " id="picker">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="start" value="{{ old('tanggal') }}" autocomplete="off">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('sampai') is-invalid @enderror" name="sampai" id="end" value="{{ old('sampai') }}" autocomplete="off">
                                        </div>
                                    </div>
                                    @error('tanggal')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                    @error('sampai')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="flex-w">
                                    <button type="submit" class="flex-c-m stext-101 cl0 size-115 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                        Kirim Permohonan
                                    </button>
                                </div>

                            </form>
                        </div>
                        @foreach($draft as $item)
                        <div class="tab-pane fade" id="{{ $item->id }}" role="tabpanel">
                            <form action="/validasi_update/{{$item->id}}" method="POST" enctype="multipart/form-data" class="p-t-15">
                                @csrf
                                @method('put')
                                <h4 class="mtext-109 cl2 p-b-30">
                                    Data Permohonan
                                </h4>
                                <div class="flex-w flex-t bor12 p-b-13">
                                    <div class="size-208">
                                        <span class="stext-110 cl2">
                                            Total Awal
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        <span class="mtext-110 cl2">
                                            {{ count($item->draft) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-w flex-t  p-t-15 p-b-10">
                                    <div class="size-208 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Keperluan
                                        </span>
                                    </div>
                                    <div class="bor8 bg0 m-b-12 w-full">
                                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                        <textarea class="form-control @error('keperluan') is-invalid @enderror stext-113 cl2 size-110" id="textArea" type="text" name="keperluan" autocomplete="off">{{ $item->keperluan }}</textarea>
                                    </div>
                                    @error('keperluan')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="flex-w flex-t  p-t-15 p-b-10">
                                    <div class="size-209 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Proposal Baru
                                        </span>
                                    </div>
                                    <div class="bor8 bg0 m-b-12 w-full">
                                        <input type="hidden" name="old_proposal" value="{{$item->proposal}}">
                                        <input class="form-control @error('proposal') is-invalid @enderror" type="file" name="proposal">
                                    </div>
                                    @error('proposal')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="flex-w flex-t  p-t-15 p-b-10">
                                    <div class="size-209 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Proposal Lama
                                        </span>
                                    </div>
                                    <div class="bor8 bg0 m-b-12 w-full">
                                        <a href="/storage/{{ $item->proposal }}" class="btn btn-success w-full" target="_blank" rel="noopener noreferrer">
                                            Download
                                        </a>
                                    </div>
                                </div>
                                <div class="flex-w flex-t  p-t-15 p-b-30">
                                    <div class="size-208 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Tanggal
                                        </span>
                                    </div>
                                    <div class="row" id="pickers">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="starts" value="{{ date('Y-m-d', strtotime($item->tanggal_start)) }}" autocomplete="off">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('sampai') is-invalid @enderror" name="sampai" id="ends" value="{{ date('Y-m-d', strtotime($item->tanggal_finish)) }}" autocomplete="off">
                                        </div>
                                    </div>
                                    @error('tanggal')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                    @error('sampai')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="flex-w">
                                    <button type="submit" class="flex-c-m stext-101 cl0 size-115 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
<script src="{{ asset('/front') }}/vendor/daterangepicker/moment.min.js"></script>
<script src="{{ asset('/front') }}/vendor/daterangepicker/daterangepicker.js"></script>
<script>
    $('textarea#AreaText').html($('textarea#AreaText').html().trim());

    var dateToday = new Date();
    $('#picker').daterangepicker({
        // numberOfMonths: 3,
        // showButtonPanel: true,
        minDate: dateToday,
        opens: 'left',
        // timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'YYYY-MM-DD'
        }
    }, function(start, end, label) {
        $('#start').val(start.format('YYYY-MM-DD'))
        $('#end').val(end.format('YYYY-MM-DD'))
    });
    $('#pickers').daterangepicker({
        // numberOfMonths: 3,
        // showButtonPanel: true,
        minDate: dateToday,
        opens: 'left',
        // timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'YYYY-MM-DD'
        }
    }, function(start, end, label) {
        $('#starts').val(start.format('YYYY-MM-DD'))
        $('#ends').val(end.format('YYYY-MM-DD'))
    });
</script>
@endpush