@extends('back.layouts.index')
@push('title', 'Dashboard')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Beranda</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span style="margin-right: 20px;">Beranda</span></li>
            </ol>

        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <div class="panel-actions">
                                <a href="#" class="fa fa-caret-down"></a>
                                <a href="#" class="fa fa-times"></a>
                            </div>
                            <h2 class="panel-title">Pengambilan & Pengembalian</h2>
                            <p class="panel-subtitle">Perbandingan data peminjaman dengan data pengembalian pada sistem</p>
                        </header>
                        <div class="panel-body" style="height: 23rem;">
                            <!-- chart.js -->
                            <div id="peminjaman_pengembalian"></div>

                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-secondary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-secondary">
                                        <i class="fa fa-plane"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Peminjaman</h4>
                                        <div class="info">
                                            <strong class="amount">{{$t_peminjaman}}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="/peminjaman" class="text-muted text-uppercase">(lihat semua)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-tertiary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-tertiary">
                                        <i class="fa fa-rocket"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Pengembalian</h4>
                                        <div class="info">
                                            <strong class="amount">{{$t_pengembalian}}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="/pengembalian" class="text-muted text-uppercase">(lihat semua)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-primary">
                                        <i class="fa fa-check-square-o"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Menuggu Validasi</h4>
                                        <div class="info">
                                            <strong class="amount">{{ $menuggu_validasi }}</strong>
                                            <span class="text-primary">({{$unread}} unread)</span>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="/belum_validasi" class="text-muted text-uppercase">(lihat semua)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-quartenary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-quartenary">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Jumlah Mahasiswa / Dosen</h4>
                                        <div class="info">
                                            <strong class="amount">{{$t_pengguna}}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="/pengguna" class="text-muted text-uppercase">(lihat semua)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- End page -->
</section>
</div>
@endsection

@push('style')
<!-- Specific Page Vendor CSS -->

@endpush

@push('script')
<!-- Specific Page Vendor -->

@endpush
@push('last_script')
<script type="text/javascript" src="{{ asset('/back') }}/vendor/chart-js/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var data = google.visualization.arrayToDataTable([
            ['Bulan', 'Peminjaman', 'Pengembalian'],
            <?php foreach ($perbandingan as $item) : ?>[months[<?= $item['bulan']; ?> - 1], <?= $item['pinjam']; ?>, <?= $item['kembali']; ?>],
            <?php endforeach; ?>
        ]);

        var options = {
            title: 'Perbandingan',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('peminjaman_pengembalian'));

        chart.draw(data, options);
    }
</script>
@endpush