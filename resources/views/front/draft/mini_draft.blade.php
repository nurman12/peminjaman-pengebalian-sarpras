@foreach($data as $data)
<li class="header-cart-item flex-w flex-t m-b-12 p-t-12">
    <div class="header-cart-item-img" onClick="mini_draft_destroy({{$data->id}})">
        <img src="{{  url('/storage/'. $data->sarpras->photo) }}" alt="IMG">
    </div>

    <div class="header-cart-item-txt" style="margin-top: -5px;">
        <a href="/sarpras_detail/{{$data->sarpras->id}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
            {{$data->sarpras->nama}}
        </a>

        <span class="header-cart-item-info" style="margin-top: -15px;">
            {{$data->qty}}
        </span>
    </div>
</li>
@endforeach