<div class="row isotope-grid">
    @foreach($sarpras as $data)
    <?php
    $pecah_string = explode(", ", $data->kategori);
    ?>
    <div class="col-sm-4 col-md-4 col-lg-3 p-b-35 isotope-item @foreach($pecah_string as $item) {{$item}} @endforeach">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img src="{{ url('/storage/'. $data->photo) }}" style="height: 15rem;" alt="IMG-PRODUCT">

                <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-jumlah="{{$data->jumlah}}" data-img="{{$data->photo}}" data-keterangan="{{$data->deskripsi}}">
                    Lihat Sekilas
                </a>
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="/sarpras_detail/{{$data->id}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        {{$data->nama}}
                    </a>

                    <span class="stext-105 cl3">
                        {{$data->jumlah}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('script')
<script>
    $('.btn-num-product-up').click(function(e) {
        e.preventDefault();
        let incre = $(this).parents('.quantity').find('.qty-input').val();
        let max = $(this).parents('.quantity').find('#max_qty').val();
        let value = parseInt(incre);
        if (value < max) {
            value++;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

    $('.btn-num-product-down').click(function(e) {
        e.preventDefault();
        let decre = $(this).parents('.quantity').find('.qty-input').val();
        let value = parseInt(decre);
        if (value > 1) {
            value--;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });
</script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/slick/slick.min.js"></script>
<script src="{{ asset('/front') }}/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="{{ asset('/front') }}/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $(document).on('click', '.js-show-modal1', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var jumlah = $(this).data('jumlah');
        var img = $(this).data('img');
        var keterangan = $(this).data('keterangan');

        $('#sarpras_id').val(id);
        $('#nama_item').text(nama);
        $('#img').attr('src', '/storage/' + img);
        $('.zoom-picture').attr('href', '/storage/' + img);
        $('#jumlah').text(jumlah);
        $('#max_qty').val(jumlah);
        $('#keterangan').text(keterangan);

        $('.qty-input').val(1);
    });

    $(document).on('click', '.js-addcart-detail', function() {
        var sarpras_id = $(this).parents('.respon6-next').find('.sarpras_id').val();
        var sarpras_qty = $(this).parents('.respon6-next').find('.qty-input').val();
        var nama = $(this).parents('.nama_sarpras').find('#nama_item').text();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "{{ route('draft.store')}}",
            data: {
                'sarpras_id': sarpras_id,
                'sarpras_qty': sarpras_qty,
            },
            success: function(response) {
                if (response.tes == 'Ok') {
                    swal("Berhasil", response.status, "success");
                    totalDraf();
                } else if (response.tes == 'Update') {
                    swal("Update!", response.status, "success");
                    totalDraf();
                } else if (response.tes == 'Error') {
                    swal("Error!", response.status, "error");
                }
            }
        });
    });
</script>
@endpush