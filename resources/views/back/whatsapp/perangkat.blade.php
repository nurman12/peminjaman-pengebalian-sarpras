@extends('back.layouts.index')
@push('title', 'Perangkat')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Perangkat</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>WhatsApp</span></li>
                <li><span style="margin-right: 20px;">Perangkat</span></li>
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

            <h2 class="panel-title">WhatsApp Gateway</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="API">API Key</label>
                        <input type="text" value="{{$perangkat['data']['token']}}" id="API" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="domain">Domain</label>
                        <input type="text" value="https://{{$perangkat['data']['domain']}}.wablas.com" id="domain" class="form-control text-lowercase" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" value="{{$perangkat['data']['whatsapp']['quota']}}" id="kuota" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="expired">Aktif Sampai</label>
                        <input type="text" value="{{date('d F Y', strtotime($perangkat['data']['whatsapp']['expired']))}}" id="expired" class="form-control" readonly="readonly">
                    </div>
                    <form action="/perangkat" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nomer">Nomer Hp</label>
                            <input type="number" name="nomer" value="{{$perangkat['data']['sender']}}" id="nomer" class="form-control" placeholder="085xxx or 628xxx">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                    <form action="/perangkats" method="post" style="display: inline;">
                        @csrf
                        @method('put')
                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning"><i class="fa fa-refresh"></i> Restart</button>
                    </form>
                    <a href="https://sambi.wablas.com/generate/qr.php?token={{$perangkat['data']['token']}}=aHR0cHM6Ly9zYW1iaS53YWJsYXMuY29t" target="_blank" class="btn btn-info"><i class="fa fa-qrcode"></i> Scan qr Code</a>
                </div>
                <div class="col-md-4">
                    @if($perangkat['data']['whatsapp']['status'] == 'connected')
                    <img src="{{ asset('/back') }}/images/online.png" style="width: 33rem;" alt="">
                    @else
                    <img src="{{ asset('/back') }}/images/offline.png" style="width: 33rem;" alt="">
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End page -->
</section>
</div>
@endsection