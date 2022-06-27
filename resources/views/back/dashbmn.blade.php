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
                        <div class="panel-body">
                            <!-- chart.js -->
                            <canvas id="peminjaman_pengembalian" style="height: 30rem;"></canvas>

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
                        <div class="panel-body">
                            <!-- chart.js -->
                            <canvas id="stok_peminjaman_pengembalian" style="height: 30rem;"></canvas>

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
<script type="text/javascript" src="{{ asset('/back') }}/vendor/chart-js/chart.js"></script>
<script>
    // setup 
    const months = ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    // customLegend
    // const customLegend = {
    //     id: 'customLegend',
    //     afterDraw: (chart, args, options) => {
    //         const {
    //             _metasets,
    //             ctx
    //         } = chart;
    //         ctx.save();

    //         _metasets.forEach((meta) => {
    //             ctx.font = 'bolder 12px Arial';
    //             ctx.fillStyle = meta._dataset.borderColor;
    //             ctx.textBaseLine = 'middle';
    //             ctx.fillText(meta._dataset.label, meta.data[meta.data.length - 1].x + 6, meta.data[meta.data.length - 1].y)
    //         })
    //     }
    // }
    // tooltipLine
    const tooltipLine = {
        id: 'tooltipLine',
        beforeDraw: chart => {
            if (chart.tooltip._active && chart.tooltip._active.length) {
                const ctx = chart.ctx;
                ctx.save();
                const activePoint = chart.tooltip._active[0];

                ctx.beginPath();
                ctx.setLineDash([5.7]);
                ctx.moveTo(activePoint.element.x, chart.chartArea.top);
                ctx.lineTo(activePoint.element.x, activePoint.element.y);
                ctx.lineWidth = 2;
                ctx.strokeStyle = 'red';
                ctx.stroke();
                ctx.restore();

                ctx.beginPath();
                ctx.moveTo(activePoint.element.x, activePoint.element.y);
                ctx.lineTo(activePoint.element.x, chart.chartArea.bottom);
                ctx.lineWidth = 2;
                ctx.strokeStyle = 'rgba(119, 107, 107, 0.8)';
                ctx.stroke();
                ctx.restore();
            }
        }
    }

    // config 
    const config1 = {
        type: 'line',
        data: {
            labels: [<?php foreach ($perbandingan as $item) : ?>months[<?= $item['bulan']; ?> - 1], <?php endforeach; ?>],
            datasets: [{
                label: 'Peminjaman',
                data: [<?php foreach ($perbandingan as $item) : ?><?= $item['pinjam']; ?>, <?php endforeach; ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.4,
                pointHoverBorderColor: 'white',
                pointHoverBackgroundColor: 'rgba(54, 162, 235, 0.2)',
                pointBorderWidth: 3,
                pointHoverBorderWidth: 3,
                pointRadius: 7,
                pointHoverRadius: 7,
            }, {
                label: 'Pengembalian',
                data: [<?php foreach ($perbandingan as $item) : ?><?= $item['kembali']; ?>, <?php endforeach; ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                tension: 0.4,
                pointHoverBorderColor: 'white',
                pointHoverBackgroundColor: 'rgba(54, 162, 235, 0.2)',
                pointBorderWidth: 3,
                pointHoverBorderWidth: 3,
                pointRadius: 7,
                pointHoverRadius: 7,
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    yAlign: 'bottom'
                }
            },
            tension: 0.4,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [tooltipLine]
    };

    const config2 = {
        type: 'line',
        data: {
            labels: [<?php foreach ($perbandingan_sarpras as $item) : ?>months[<?= $item['bulan']; ?> - 1], <?php endforeach; ?>],
            datasets: [{
                label: 'Peminjaman',
                data: [<?php foreach ($perbandingan_sarpras as $item) : ?><?= $item['keluar']; ?>, <?php endforeach; ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',

            }, {
                label: 'Pengembalian',
                data: [<?php foreach ($perbandingan_sarpras as $item) : ?><?= $item['masuk']; ?>, <?php endforeach; ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',

            }]
        },
        options: {
            // responsive: true,
            // maintainAspectRatio: false,
            // layout: {
            //     padding: {
            //         right: 100
            //     }
            // },
            tension: 0.4,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        // plugins: [customLegend]
    };

    // render init block 
    const myChart1 = new Chart(
        document.getElementById('peminjaman_pengembalian'),
        config1
    );

    const myChart2 = new Chart(
        document.getElementById('stok_peminjaman_pengembalian'),
        config2
    );
</script>
@endpush