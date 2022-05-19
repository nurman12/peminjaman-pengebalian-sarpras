@extends('back.layouts.index')
@push('title', 'Sarpras')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sarpras</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>Sarpras</span></li>
                <li><span style="margin-right: 20px;">Master Data</span></li>
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

            <h2 class="panel-title">Daftar Sarpras</h2>
        </header>
        <div class="panel-body">
            <a href="{{ route('sarpras.create') }}" class="btn btn-primary rounded" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Create</a>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis</th>
                        <th>Nama</th>
                        <th class="hidden-phone">Jumlah</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sarpras as $data)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$data->jenis}}</td>
                        <td>{{$data->nama}}</td>
                        <td class="center">{{$data->jumlah}}</td>
                        <th width="120px">
                            <a href="{{ route('sarpras.show', $data->id) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('sarpras.edit', $data->id) }}" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                            <form onclick="return confirm('Yakin ingin hapus ini?')" action="{{ route('sarpras.destroy', $data->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="old_photo" value="{{$data->photo}}">
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </th>
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
@endpush

@push('script')
<!-- Specific Page Vendor -->
<script src="{{ asset('/back') }}/vendor/select2/select2.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
@endpush

@push('last_script')
<!-- Examples -->
<script src="{{ asset('/back') }}/javascripts/tables/examples.datatables.default.js"></script>
@endpush