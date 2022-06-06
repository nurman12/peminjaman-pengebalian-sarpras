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
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <div class="panel-actions">
                                <a href="#" class="fa fa-caret-down"></a>
                                <a href="#" class="fa fa-times"></a>
                            </div>
                            <h2 class="panel-title">Pengambilan & Pengembalian Sarpras</h2>
                            <p class="panel-subtitle">Perbandingan jumlah sarpras yang dipinjam dengan jumlah sarpras yang dikembalikan.</p>
                        </header>
                        <div class="panel-body" style="height: 23rem;">
                            <!-- chart.js -->
                            <canvas id="stok_peminjaman_pengembalian"></canvas>

                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-primary">
                                        <i class="fa fa-life-ring"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Support Questions</h4>
                                        <div class="info">
                                            <strong class="amount">1281</strong>
                                            <span class="text-primary">(14 unread)</span>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-secondary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-secondary">
                                        <i class="fa fa-usd"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Profit</h4>
                                        <div class="info">
                                            <strong class="amount">$ 14,890.30</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(withdraw)</a>
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
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Today's Orders</h4>
                                        <div class="info">
                                            <strong class="amount">38</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(statement)</a>
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
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Today's Visitors</h4>
                                        <div class="info">
                                            <strong class="amount">3765</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(report)</a>
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
        var months = ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var data = google.visualization.arrayToDataTable([
            ['Bulan', 'Peminjaman', 'Pengembalian'],
            <?php foreach ($perbandingan as $item) : ?>[months[<?= $item['bulan']; ?> - 1], <?= $item['jumlah_pinjam']; ?>, <?= $item['jumlah_kembali']; ?>],
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
<script type="text/javascript" src="{{ asset('/back') }}/vendor/chart-js/chart.js"></script>
<script>
    // setup 
    const months = ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const data = {
        labels: [<?php foreach ($perbandingan_sarpras as $item) : ?>months[<?= $item['bulan']; ?> - 1], <?php endforeach; ?>],
        datasets: [{
            label: 'Pengembalian',
            data: [<?php foreach ($perbandingan_sarpras as $item) : ?><?= $item['masuk']; ?>, <?php endforeach; ?>],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',

        }, {
            label: 'Peminjaman',
            data: [<?php foreach ($perbandingan_sarpras as $item) : ?><?= $item['keluar']; ?>, <?php endforeach; ?>],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',

        }]
    };

    // customLegend
    const customLegend = {
        id: 'customLegend',
        afterDraw: (chart, args, options) => {
            const {
                _metasets,
                ctx
            } = chart;
            ctx.save();

            _metasets.forEach((meta) => {
                ctx.font = 'bolder 12px Arial';
                ctx.fillStyle = meta._dataset.borderColor;
                ctx.textBaseLine = 'middle';
                ctx.fillText(meta._dataset.label, meta.data[meta.data.length - 1].x + 6, meta.data[meta.data.length - 1].y)
            })
        }
    }

    // config 
    const config = {
        type: 'line',
        data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    right: 100
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            tension: 0.4,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [customLegend]
    };

    // render init block
    const myChart = new Chart(
        document.getElementById('stok_peminjaman_pengembalian'),
        config
    );
</script>
@endpush