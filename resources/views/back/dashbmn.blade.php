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
            <section class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="chart-data-selector" id="salesSelectorWrapper">
                                <h2>
                                    Grafik:
                                    <strong>
                                        <select class="form-control" id="salesSelector">
                                            <option value="JSOFT Admin" selected>Peminjaman</option>
                                            <option value="JSOFT Drupal">Sarpras Dipinjam</option>
                                            <option value="JSOFT Wordpress">Sarpras Dikembalikan</option>
                                        </select>
                                    </strong>
                                </h2>

                                <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                    <!-- Flot: Sales JSOFT Admin -->
                                    <div class="chart chart-sm" data-sales-rel="JSOFT Admin" id="flotDashSales1" class="chart-active"></div>
                                    <script>
                                        var months = ["Jan", "Feb", 'Mar', "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Des"];
                                        var flotDashSales1Data = [{
                                            data: [
                                                <?php
                                                foreach ($pinjam as $data) {
                                                ?>[months[<?= $data->bulan ?> - 1], <?= $data->jumlah ?>, ],
                                                <?php } ?>
                                            ],
                                            color: "#0088cc"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.
                                    </script>

                                    <!-- Flot: Sales JSOFT Drupal -->
                                    <div class="chart chart-sm" data-sales-rel="JSOFT Drupal" id="flotDashSales2" class="chart-hidden"></div>
                                    <script>
                                        var months = ["Jan", "Feb", 'Mar', "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Des"];
                                        var flotDashSales2Data = [{
                                            data: [
                                                <?php
                                                foreach ($peminjaman as $data) {
                                                ?>[months[<?= $data->bulan ?> - 1], <?= $data->jumlah ?>],
                                                <?php } ?>
                                            ],
                                            color: "#2baab1"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.
                                    </script>

                                    <!-- Flot: Sales JSOFT Wordpress -->
                                    <div class="chart chart-sm" data-sales-rel="JSOFT Wordpress" id="flotDashSales3" class="chart-hidden"></div>
                                    <script>
                                        var flotDashSales3Data = [{
                                            data: [
                                                <?php
                                                foreach ($pengembalian as $data) {
                                                ?>[months[<?= $data->bulan ?> - 1], <?= $data->jumlah ?>],
                                                <?php } ?>
                                            ],
                                            color: "#734ba9"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.
                                    </script>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <h2 class="panel-title mt-md">Perbandingan</h2>
                            <div class="liquid-meter-wrapper liquid-meter-sm mt-lg">
                                <div class="liquid-meter">
                                    <meter min="0" max="100" value="35" id="meterSales"></meter>
                                </div>
                                <!-- <div class="liquid-meter-selector" id="meterSalesSel">
                                    <a href="#" data-val="35" class="active">Monthly Goal</a>
                                    <a href="#" data-val="28">Annual Goal</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- End page -->
</section>
</div>
@endsection

@push('style')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/morris/morris.css" />
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-appear/jquery.appear.js"></script>
<script src="{{ asset('/back') }}/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.js"></script>
<script src="{{ asset('/back') }}/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.pie.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.categories.js"></script>
<script src="{{ asset('/back') }}/vendor/flot/jquery.flot.resize.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{ asset('/back') }}/vendor/raphael/raphael.js"></script>
<script src="{{ asset('/back') }}/vendor/morris/morris.js"></script>
<script src="{{ asset('/back') }}/vendor/gauge/gauge.js"></script>
<script src="{{ asset('/back') }}/vendor/snap-svg/snap.svg.js"></script>
<script src="{{ asset('/back') }}/vendor/liquid-meter/liquid.meter.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/jquery.vmap.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
<script src="{{ asset('/back') }}/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
@endpush
@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/dashboard/examples.dashboard.js"></script>
@endpush