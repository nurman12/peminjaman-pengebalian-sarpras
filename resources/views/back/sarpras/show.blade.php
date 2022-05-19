@extends('back.layouts.index')
@push('title', 'Show | Sarpras')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Show Sarpras</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Sarpras</span></li>
                <li><span style="margin-right: 20px;">Show</span></li>
            </ol>
        </div>
    </header>
    <!-- Start page -->
    <div class="row">
        <div class="col-md-8">
            <section class="panel panel-featured panel-featured-dark">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Title</h2>
                </header>
                <div class="panel-body">
                    <div class="row" style="margin-bottom: 4vw;">
                        <div class="col-md-12 col-sm-12 col-lg-5">
                            <img src="{{ url('/storage/'. $sarpras->photo) }}" id="previewkk" style=" width: 19vw;min-width: 100px; margin-top: 5px;">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-7">
                            <h4 class="display-4">{{$sarpras->nama}}</h4>
                            <div class="form-group">
                                <h5 class="col-md-3">Jumlah</h5>
                                <h5 class="col-md-9">{{$sarpras->jumlah}}</h5>
                            </div>
                            <div class="form-group">
                                <h5 class="col-md-3">Kategori</h5>
                                <h5 class="col-md-9">{{$sarpras->kategori}}</h5>
                            </div>
                            <div class="form-group">
                                <h5 class="col-md-3">Deskripsi</h5>
                                <h5 class="col-md-9">{{$sarpras->deskripsi}}</h5>
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