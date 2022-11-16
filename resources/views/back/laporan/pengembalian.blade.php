@extends('back.layouts.index')
@push('title', 'Laporan | Pengembalian')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Laporan Pengembalian</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Laporan</span></li>
                <li><span style="margin-right: 20px;">Pengembalian</span></li>
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

            <h2 class="panel-title">Laporan Pengembalian</h2>
        </header>
        <div class="panel-body">
            <div class="row mb-sm">
                <form action="/l_pengembalian/filter" method="get">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">Jenis</label>
                            <select data-plugin-selectTwo class="form-control" name="jenis" id="jenis">
                                <option selected disabled></option>
                                <option value="Ruangan" {{ $jenis == "Ruangan" ? 'selected' : '' }}>Ruangan</option>
                                <option value="Barang" {{ $jenis == "Barang" ? 'selected' : '' }}>Barang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Sarana Prasarana</label>
                            <div id="select">
                                <select data-plugin-selectTwo class="form-control" name="sarpras_id" id="sarpras">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="mt-xl btn btn-success form-control"><i class="fa fa-sliders"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 20% !important;">Nama</th>
                        <th style="width: 10% !important;">Tanggal</th>
                        <th style="width: 40% !important;" class="center">Keperluan</th>
                        <th class="center">Durasi</th>
                        <th style="width: 20% !important;">Sarpras</th>
                        <th style="width: 5% !important;">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalian as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <?php
                        $user = App\Models\User::where('id', $data->user_id)->first();
                        ?>
                        <td>
                            <div class="d-flex text-items-center">
                                @if($user->photo)
                                <img src="{{  url('/storage/'. $user->photo)}}" alt="" class="img-circle img-size-45">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="" class="img-circle img-size-45">
                                @endif
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $user->name }}</p>
                                    <p class="test-muted mb-o">{{ $user->role }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ date('d F Y', strtotime($data->date_kembali)) }}</td>
                        <td>{{ $data->keperluan }}</td>
                        <?php
                        $tgl1_ambil = new DateTime($data->date_ambil);
                        $tgl2_kembali = new DateTime($data->date_kembali);
                        $rentan = $tgl2_kembali->diff($tgl1_ambil);
                        $durasi = $rentan->d . " hari";
                        ?>
                        <td>
                            <span class="badge badge-primary rounded-pill">{{ $durasi }}</span>
                        </td>
                        <?php
                        $draft = App\Models\Draft::where('validasi_id', $data->validasi_id)->get();
                        ?>
                        <td>
                            @foreach($draft as $key => $item)
                            <p class="fw-bold mb-0">{{ $item->sarpras->nama }}</p>
                            @if($draft->count() != $key + 1)
                            <hr class="solid short">
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($draft as $key => $item)
                            <p class="fw-bold mb-0">{{ $item->sarpras_keluar->jumlah }}</p>
                            @if($draft->count() != $key + 1)
                            <hr class="solid short">
                            @endif
                            @endforeach
                        </td>
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
<link rel="stylesheet" href="{{ asset('/back') }}/custom/style.css" />
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
@endpush

@push('last_script')
<script script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
<script>
    $('#jenis').change(function() {
        var jenis = $(this).find(':selected').val();
        if (jenis) {
            sarpras(jenis);
        } else {
            $("#sarpras").empty();
        }
    });
    var jenis = $('#jenis').find(':selected').val();
    if (jenis) {
        sarpras(jenis);
    } else {
        $("#sarpras").empty();
    }

    function sarpras(jenis) {
        $.ajax({
            type: "get",
            url: "/getSarprasKembali/" + jenis,
            success: function(data) {
                if (data) {
                    $("#sarpras").empty();
                    $("#select2-chosen-2").text('Pilih ' + jenis);
                    $("#sarpras").append('<option value=""></option>');
                    $.each(data, function(key, value) {
                        $("#sarpras").append('<option value="' + key + '" >' + value + '</option>');
                    });
                } else {
                    $("#sarpras").empty();
                }
            }
        });
    }
</script>
@endpush