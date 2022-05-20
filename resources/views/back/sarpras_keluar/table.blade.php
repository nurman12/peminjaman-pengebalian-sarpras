<table class="table table-bordered table-striped mb-none" id="datatable-default">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th class="hidden-phone">Jumlah</th>
            <th class="center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sarpras_keluar as $data)
        <tr>
            <th>{{$loop->iteration}}</th>
            <td>{{$data->sarpras->nama}}</td>
            <td>{{date('l, d F Y', strtotime($data->tanggal_keluar))}}</td>
            <td class="center">{{$data->jumlah}}</td>
            <th width="120px">
                <a href="{{ route('sarpras_keluar.show', $data->id) }}" class="mr-xs btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                <a id="edit" data-id="{{$data->id}}" data-tanggal="{{$data->tanggal_keluar}}" data-jumlah="{{$data->jumlah}}" data-keterangan="{{$data->keterangan}}" data-sarpras_id="{{ $data->sarpras_id }}" data-nama="{{ $data->sarpras->nama }}" data-img="{{ $data->sarpras->photo }}" data-toggle="modal" data-target="#exampleModal" class="mr-xs btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-pencil-square-o"></i></a>
                <form onclick="return confirm('Yakin ingin hapus ini?')" action="{{ route('sarpras_keluar.destroy', $data->id) }}" method="post" style="display: inline;">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </form>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>