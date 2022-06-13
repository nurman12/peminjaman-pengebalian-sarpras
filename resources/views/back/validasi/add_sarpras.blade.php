@extends('back.layouts.index')
@push('title', 'Peminjaman | Detail')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tambah Sarpras</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#!">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><a href="{{ route('validasi.index') }}"><span>Validasi</span></a></li>
                <li><a href="{{ route('validasi.edit', $id) }}"><span>Ubah</span></a></li>
                <li><a href="{{ route('validasi_edit.add', $id) }}"><span style="margin-right: 20px;">Tambah sarpras</span></a></li>
            </ol>
        </div>
    </header>
    <!-- Start page -->
    <section class="panel">
        <div class="row">
            <blockquote class="primary rounded b-thin">
                <p>Sarpras yang tampil merupakan sarpras yang tidak ada pada draft peminjam. Pilih sarpras yang ingin ditambahkan, masukkan jumlah kemudian <cite>click</cite> tombol Add to Draft. jika berhasil menambahkan sarpras pada draft, sarpras yang dimasukkan tadi akan tidak tampil.</p>
            </blockquote>
            <a href="{{ route('validasi.edit', $id) }}" class="btn btn-primary">Kembali</a>
            <div id="content">
                @include('back.validasi.list_sarpras')
            </div>
        </div>
    </section>
    <!-- End page -->
</section>
</div>
@endsection

@push('script')
<script src="{{ asset('/back') }}/vendor/pnotify/pnotify.custom.js"></script>
<script src="{{ asset('/back') }}/vendor/fuelux/js/spinner.js"></script>
@endpush

@push('last_script')
<script>
    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });
    $(document).on('click', '.addToDraf', function() {
        var sarpras_id = $(this).parent().siblings().find('input[id="sarpras_id"]').val();
        var validasi_id = $(this).parent().siblings().find('input[id="validasi_id"]').val();
        var qty = $(this).parent().siblings().find('input[class="spinner-input form-control text-center"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "{{ route('validasi_edit.store') }}",
            data: {
                'validasi_id': validasi_id,
                'sarpras_id': sarpras_id,
                'qty': qty,
            },
            success: function(response) {
                if (response.error_message) {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops..!',
                        text: response.error_message
                    });
                } else {
                    swal.fire({
                        icon: 'success',
                        title: 'Berhasil menambah sarpras pada draft peminjaman',
                        // showConfirmButton: false
                    }).then((result) => {
                        $('#content').html(response);
                    })
                }
            },
            error: function(xhr) {
                swal.fire({
                    type: 'error',
                    title: 'Oops..!',
                    text: 'Someting went wrong!'
                });
            }
        });
    });
</script>
@endpush