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
                <li><span>Beranda</span></li>
            </ol>
            <!-- <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a> -->
        </div>
    </header>

    <!-- Start page -->
    <div class="row">
        <!-- Start Chat -->
        <!-- <div id="Chat">
        <section class="panel panel-featured">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" onclick="ShowChat()" style="font-weight: bold">x</a>
                </div>
                <h2 class="panel-title">Asep Chan</h2>
            </header>
            <div class="panel-body">
                <div class="list-group list-group-flush m-t-10 h-250">
                    <blockquote class="primary rounded b-thin">
                        <p>Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Est, cum.
                        </p>
                        <small>[12 Feb 2022 17:41]</small>
                    </blockquote>
                    <blockquote class="primary rounded b-thin blockquote-reverse">
                        <p>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.</p>
                        <small>[12 Feb 2022 18:01]</small>
                    </blockquote> 
                </div>
                <div style="display: flex;">
                    <input type="text" class="form-control m-r-10" placeholder="Messages...">
                    <button class="btn btn-primary">Send</button>
                </div>
            </div>
        </section> 
    </div> -->
        <!-- End Chat -->
        <div class="col-md-6 col-lg-12 col-xl-6">
            <section class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="chart-data-selector" id="salesSelectorWrapper">
                                <h2>
                                    Sales:
                                    <strong>
                                        <select class="form-control" id="salesSelector">
                                            <option value="JSOFT Admin" selected>JSOFT Admin</option>
                                            <option value="JSOFT Drupal">JSOFT Drupal</option>
                                            <option value="JSOFT Wordpress">JSOFT Wordpress</option>
                                        </select>
                                    </strong>
                                </h2>

                                <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                    <!-- Flot: Sales JSOFT Admin -->
                                    <div class="chart chart-sm" data-sales-rel="JSOFT Admin" id="flotDashSales1" class="chart-active"></div>
                                    <script>
                                        var flotDashSales1Data = [{
                                            data: [
                                                ["Jan", 140],
                                                ["Feb", 240],
                                                ["Mar", 190],
                                                ["Apr", 140],
                                                ["May", 180],
                                                ["Jun", 320],
                                                ["Jul", 270],
                                                ["Aug", 180]
                                            ],
                                            color: "#0088cc"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.
                                    </script>

                                    <!-- Flot: Sales JSOFT Drupal -->
                                    <div class="chart chart-sm" data-sales-rel="JSOFT Drupal" id="flotDashSales2" class="chart-hidden"></div>
                                    <script>
                                        var flotDashSales2Data = [{
                                            data: [
                                                ["Jan", 240],
                                                ["Feb", 240],
                                                ["Mar", 290],
                                                ["Apr", 540],
                                                ["May", 480],
                                                ["Jun", 220],
                                                ["Jul", 170],
                                                ["Aug", 190]
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
                                                ["Jan", 840],
                                                ["Feb", 740],
                                                ["Mar", 690],
                                                ["Apr", 940],
                                                ["May", 1180],
                                                ["Jun", 820],
                                                ["Jul", 570],
                                                ["Aug", 780]
                                            ],
                                            color: "#734ba9"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.
                                    </script>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <h2 class="panel-title mt-md">Sales Goal</h2>
                            <div class="liquid-meter-wrapper liquid-meter-sm mt-lg">
                                <div class="liquid-meter">
                                    <meter min="0" max="100" value="35" id="meterSales"></meter>
                                </div>
                                <div class="liquid-meter-selector" id="meterSalesSel">
                                    <a href="#" data-val="35" class="active">Monthly Goal</a>
                                    <a href="#" data-val="28">Annual Goal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6 col-lg-12 col-xl-6">
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
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/vendor/morris/morris.css" />
<link rel="stylesheet" href="{{ asset('/back') }}/custom/style.css" />
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/custom/script.js"></script>
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