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
            Draft
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </span>
        <span class="stext-109 cl4">
            Edit
        </span>
    </div>
</div>
<!-- Shoping Cart -->
<div class="bg0 p-t-55 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart" id="table_draft_update">

                        </table>
                    </div>
                </div>
            </div>
            <form action="{{ route('validasi.update', $validasi->id) }}" method="POST" enctype="multipart/form-data" class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-10">
                @csrf
                @method('put')
                <!-- bor10 card p-b-10 m-l-63 m-r-40 m-lr-0-xl -->
                <div class="bor10 card p-lr-25 p-t-30 p-b-10 m-l-63 m-r-25 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Data Permohonan
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Total
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2" id="total_draft_update"></span>
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
                            <textarea class="form-control @error('keperluan') is-invalid @enderror stext-113 cl2 size-110" id="textArea" type="text" name="keperluan" autocomplete="off">
                            {{ $validasi->keperluan }}
                            </textarea>
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
                            <input type="hidden" name="old_proposal" value="{{$validasi->proposal}}">
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
                            <a href="/storage/{{ $validasi->proposal }}" class="btn btn-success w-full" target="_blank" rel="noopener noreferrer">
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
                                <input type="text" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="start" value="{{ date('Y-m-d', strtotime($validasi->tanggal_start)) }}" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('sampai') is-invalid @enderror" name="sampai" id="end" value="{{ date('Y-m-d', strtotime($validasi->tanggal_finish)) }}" autocomplete="off">
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
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
<script src="{{ asset('/front') }}/vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/daterangepicker/moment.min.js"></script>
<script src="{{ asset('/front') }}/vendor/daterangepicker/daterangepicker.js"></script>
<script>
    // ambil url 
    var URLpath = window.location.pathname;

    // pisah url
    var pathArray = URLpath.split('/');

    // ambil id validasi
    var idValidasi = pathArray[2];

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "GET",
        url: "/draft_update/" + idValidasi,
        success: function(data) {
            $("#table_draft_update").html(data);
            totalDraf_Update();
        }
    })

    function Update_Draft() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "GET",
            url: "/draft_update/" + idValidasi,
            success: function(data) {
                $("#table_draft_update").html(data);
                totalDraf_Update();
            }
        })
    }

    function totalDraf_Update() {
        $.ajax({
            type: 'GET',
            url: '/draft_count/' + idValidasi,
            success: function(response) {
                var response = JSON.parse(response);
                $('#total_draft_update').text(response);
            }
        })
    }

    function draft_destroy_update(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "post",
            url: "/draft_update/" + id,
            success: function(response) {
                if (response.tes == 'Error') {
                    swal("Gagal", response.status, "error");
                }
                Update_Draft();
                totalDraf_Update();
            }
        })
    }

    $('textarea#textArea').html($('textarea#textArea').html().trim());
    var dateToday = new Date();
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