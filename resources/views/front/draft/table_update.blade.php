<tr class="table_head">
    <th class="p-l-30">Nama Sarpras</th>
    <th></th>
    <th class="txt-center">Quantity</th>
</tr>

@foreach($draft as $data)
<tr class="table_row">
    <td class="text-center p-l-30">
        <div class="how-itemcart1" style="width: 90px;" onclick="draft_destroy_update({{$data->id}})">
            <img src="{{ url('/storage/'. $data->sarpras->photo) }}" alt="IMG">
        </div>
    </td>
    <td>{{$data->sarpras->nama}}</td>
    <td class="action-update" style="padding-left: 80px;">
        <div class="wrap-num-product flex-w quantity txt-center">
            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                <i class="fs-16 zmdi zmdi-minus"></i>
            </div>
            <input type="hidden" value="{{$data->id}}" id="draft_id">
            <input type="hidden" value="{{$data->sarpras->jumlah + $data->qty}}" id="max_qty">
            <input class="mtext-104 cl3 txt-center num-product qty-input" type="number" value="{{$data->qty}}">
            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                <i class="fs-16 zmdi zmdi-plus"></i>
            </div>
        </div>
    </td>
</tr>
@endforeach

<!-- plus minus draft -->
<script src="{{ asset('/front') }}/vendor/jquery/jquery-3.2.1.min.js"></script>

<script>
    $('.btn-num-product-up').click(function(e) {
        e.preventDefault();
        let incre = $(this).parents('.quantity').find('.qty-input').val();
        let max = $(this).parents('.quantity').find('#max_qty').val();
        var draft_id = $(this).parents('.quantity').find('#draft_id').val();
        let value = parseInt(incre);
        let jenis = 'tambah';
        if (value < max) {
            value++;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "PUT",
            url: "/draft_qty/" + draft_id,
            data: {
                'jenis': jenis,
                'qty': value,
            },
            success: function(response) {}
        });
    });

    $('.btn-num-product-down').click(function(e) {
        e.preventDefault();
        let decre = $(this).parents('.quantity').find('.qty-input').val();
        var draft_id = $(this).parents('.quantity').find('#draft_id').val();
        let value = parseInt(decre);
        let jenis = 'kurang';
        if (value > 1) {
            value--;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "PUT",
            url: "/draft_qty/" + draft_id,
            data: {
                'jenis': jenis,
                'qty': value,
            },
            success: function(response) {}
        });
    });
</script>
<!-- end plus minus -->