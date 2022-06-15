@foreach($sarpras as $data)
<div class="col-md-3 mt-xl">
    <div class="panel-body">
        <a class="image-popup-no-margins" href="{{ url('/storage/'. $data->photo) }}">
            <img class="img-responsive" src="{{ url('/storage/'. $data->photo) }}" style="height: 16rem; width:27rem;">
        </a>
        <h4 class="text-dark">{{ $data->nama }}</h4>
        <h5 class="text-bold">{{ $data->jumlah }}</h5>
        <div style="margin: auto; width: 60%;">
            <div data-plugin-spinner data-plugin-options='{ "value":0, "step": 1, "min": 0, "max": {{ $data->jumlah }} }'>
                <div class="input-group">
                    <div class="spinner-buttons input-group-btn">
                        <button type="button" class="btn btn-default spinner-down">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="hidden" id="sarpras_id" value="{{ $data->id }}">
                    <input type="hidden" id="validasi_id" value="{{ $id }}">
                    <input type="text" class="spinner-input form-control text-center" value="0" readonly>
                    <div class="spinner-buttons input-group-btn">
                        <button type="button" class="btn btn-default spinner-up">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin: auto; width: 45%;">
            <button class="btn btn-primary addToDraf mt-xl">Add to Draf</button>
        </div>
    </div>
</div>
@endforeach