<html>

<head>
    <title>{{$validasi->user->name}} - Draft Print</title>
    <!-- Web Fonts  -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap/css/bootstrap.css" />

    <!-- Invoice Print Style -->
    <link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/invoice-print.css" />
</head>

<body>
    <div class="invoice">
        <header class="clearfix">
            <div class="row">
                <div class="col-sm-6 mt-md">
                    <!-- <h2 class="h2 mt-none mb-sm text-dark text-bold">Draft</h2> -->
                    <!-- <h4 class="h4 m-none text-dark text-bold">#76598345</h4> -->

                    <div class="m-t-15 ">
                        <img src="{{ asset('/front') }}/images/logo-polinema.png" style="width: 75px;" alt="OKLER Themes" />
                    </div>
                </div>
                <div class="col-sm-6 text-right mt-md mb-md">
                    <address class="ib mr-xlg">
                        Jl. Lingkar Maskumambang
                        <br />
                        No.1, Sukorame, Kec. Mojoroto, Jawa Timur
                        <br />
                        Telepon: (+365) 96 716 6879
                        <br />
                        bmn@polinema.ac.id
                    </address>
                </div>
            </div>
        </header>
        <div class="bill-info">
            <div class="row">
                <div class="col-md-6">
                    <div class="bill-to">
                        <p class="h5 mb-xs text-dark text-semibold">Ke:</p>
                        <address>
                            {{$validasi->user->name}}
                            <br />
                            Ds. {{$validasi->user->desa}}, Kota {{$validasi->user->kota}}
                            <br />
                            Telepon: {{$validasi->user->no_telp}}
                            <br />
                            {{$validasi->user->email}}
                        </address>
                        <p class="h5 mb-xs text-dark text-semibold">Keperluan:</p>
                        <address>
                            {{$validasi->keperluan}}
                        </address>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bill-data text-right">
                        <p class="mb-none">
                            <span class="text-dark">Mulai Tanggal:</span>
                            <span class="value">{{ date('d/m/Y', strtotime( $validasi->tanggal_start))}}</span>
                        </p>
                        <p class="mb-none">
                            <span class="text-dark">Sampai Tanggal:</span>
                            <span class="value">{{ date('d/m/Y', strtotime( $validasi->tanggal_finish))}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table invoice-items">
                <thead>
                    <tr class="h4 text-dark">
                        <th id="cell-id" class="text-semibold">#</th>
                        <th id="cell-item" class="text-semibold">Jenis</th>
                        <th id="cell-desc" class="text-semibold">Nama</th>
                        <th id="cell-price" class="text-center text-semibold">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($validasi->draft as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-semibold text-dark">{{$data->sarpras->jenis}}</td>
                        <td>{{$data->sarpras->nama}}</td>
                        <td class="text-center">{{$data->qty}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="invoice-summary">
            <?php

            use SimpleSoftwareIO\QrCode\Facades\QrCode;

            $qr_code = QrCode::generate($validasi->id . ' ' . $validasi->keperluan . $validasi->tanggal_start);

            ?>
            <div class="text-right">
                {!! $qr_code !!}
            </div>
        </div>
    </div>
    <script script>
        window.print();
    </script>
</body>

</html>