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
                <div class="col-md-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="chart-data-selector" id="salesSelectorWrapper">
                                <h2>
                                    Kerusakan :
                                    <strong>
                                        <select class="form-control" id="salesSelector">
                                            @foreach($kerusakan as $key => $value)
                                            <?php
                                            $data = App\Models\Sarpras::where('id', $value->sarpras_id)->first();
                                            ?>
                                            <option value="{{ $data->nama }}" {{ $key == 0 ? 'selected' : '' }}>{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </strong>
                                </h2>

                                <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                    @foreach($kerusakan as $key => $value)
                                    <?php
                                    $data = App\Models\Sarpras::where('id', $value->sarpras_id)->first();
                                    ?>
                                    <div class="chart chart-sm" data-sales-rel="{{ $data->nama }}" id="sarpras_{{ $value->sarpras_id }}" class="{{ $key == 0 ? 'chart-active' : '' }}"></div>
                                    @endforeach

                                </div>

                            </div>
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
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.js"></script>
<script src="{{ asset('/back') }}/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.pie.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.categories.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.resize.js"></script>
<script src="{{ asset('/back') }}/vendor/liquid-meter/liquid.meter.js"></script>
@endpush
@push('last_script')
<script src="{{ asset('/back') }}/vendor/highcharts/highcharts.js"></script>
<script src="{{ asset('/back') }}/vendor/chart-js/chart.js"></script>
<script>
    // setup 
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

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
            tension: 0.4,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
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
<script>
    (function($) {

        'use strict';

        /*
        Sales Selector
        */
        $('#salesSelector').themePluginMultiSelect().on('change', function() {
            var rel = $(this).val();
            $('#salesSelectorItems .chart').removeClass('chart-active').addClass('chart-hidden');
            $('#salesSelectorItems .chart[data-sales-rel="' + rel + '"]').addClass('chart-active').removeClass('chart-hidden');
        });

        $('#salesSelector').trigger('change');

        $('#salesSelectorWrapper').addClass('ready');

        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        <?php foreach ($kerusakan as $value) :

            $end_pemasangan = Illuminate\Support\Facades\DB::table('rusak')
                ->join('sarpras_detail', 'sarpras_detail.id', '=', 'rusak.sarpras_detail_id')
                ->where('sarpras_detail.sarpras_id', $value->sarpras_id)
                ->where('sarpras_detail.jenis', 'keluar')
                ->select(
                    Illuminate\Support\Facades\DB::raw("CAST(SUM(rusak.hilang) as int) as jumlah")
                )
                ->groupBy(Illuminate\Support\Facades\DB::raw("month(rusak.created_at)"))
                ->pluck('jumlah');

            $monthspemasukanpemasangan = Illuminate\Support\Facades\DB::table('rusak')
                ->join('sarpras_detail', 'sarpras_detail.id', '=', 'rusak.sarpras_detail_id')
                ->where('sarpras_detail.sarpras_id', $value->sarpras_id)
                ->where('sarpras_detail.jenis', 'keluar')
                ->select(Illuminate\Support\Facades\DB::raw("Month(rusak.created_at) as month"))
                ->groupby(Illuminate\Support\Facades\DB::raw("Month(rusak.created_at)"))
                ->pluck('month');

            $dataspemasangan = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($monthspemasukanpemasangan as $index => $month) {
                if (!isset($end_pemasangan[$index])) {
                    $end_pemasangan[$index] = 0;
                }
                $dataspemasangan[$month - 1] = $end_pemasangan[$index];
            }
            $data = App\Models\Sarpras::where('id', $value->sarpras_id)->first();
        ?>
            var sarpras_<?= $value->sarpras_id; ?> = <?= json_encode($dataspemasangan) ?>;


            Highcharts.chart('sarpras_<?= $value->sarpras_id; ?>', {
                title: {
                    text: 'Pengembalian 2022'
                },
                subtitle: {
                    text: 'Grafik Kerusakan <?= $data->nama; ?>'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Kerusakan'
                    },
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [{
                    name: 'Sarpras Rusak <?= $data->nama; ?>',
                    data: sarpras_<?= $value->sarpras_id; ?>
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });

        <?php endforeach; ?>

        /*
        Liquid Meter
        */
        $('#meterSales').liquidMeter({
            shape: 'circle',
            color: '#0088cc',
            background: '#F9F9F9',
            fontSize: '24px',
            fontWeight: '600',
            stroke: '#F2F2F2',
            textColor: '#333',
            liquidOpacity: 0.9,
            liquidPalette: ['#333'],
            speed: 3000,
            animate: !$.browser.mobile
        });

        $('#meterSalesSel a').on('click', function(ev) {
            ev.preventDefault();

            var val = $(this).data("val"),
                selector = $(this).parent(),
                items = selector.find('a');

            items.removeClass('active');
            $(this).addClass('active');

            // Update Meter Value
            $('#meterSales').liquidMeter('set', val);
        });
    }).apply(this, [jQuery]);
</script>
@endpush