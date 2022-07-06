</section>

@stack('modals')
<!-- Vendor -->
<script src="{{ asset('/back') }}/vendor/jquery/jquery.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="{{ asset('/back') }}/vendor/bootstrap/js/bootstrap.js"></script>
<script src="{{ asset('/back') }}/vendor/nanoscroller/nanoscroller.js"></script>
<script src="{{ asset('/back') }}/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('/back') }}/vendor/magnific-popup/magnific-popup.js"></script>
<script src="{{ asset('/back') }}/vendor/jquery-placeholder/jquery.placeholder.js"></script>

@stack('script')

@if(Auth::user()->roles == 'BMN')
<div class="modal fade" id="modalBootstrapScanDraf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Scan Draft</h4>
            </div>
            <div class="modal-body">
                <div id="reader" width="400px"></div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/back') }}/vendor/sweetalert/sweetalert2.all.min.js"></script>
<script src="{{ asset('/back') }}/vendor/qr-code/html5-qrcode.min.js"></script>
<script>
    document.getElementById("ScanQRDraft").onclick = function() {
        ScanDraft()
    };
    $(document).on('hidden.bs.modal', function() {
        html5QrcodeScanner.clear();
    });


    function onScanSuccess(decodedText, decodedResult) {

        let id = decodedText

        csrf_token = $('meta[name="csrf-token"]').attr('content');

        let timerInterval
        swal.fire({
            icon: 'info',
            title: 'Berhasil Scan',
            html: 'Mencari data dalam <b></b> detik.',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
        }).then((result) => {
            if (result.dismiss) {
                $.ajax({
                    url: "/cek_qrcode",
                    type: 'POST',
                    data: {
                        '_method': 'POST',
                        '_token': csrf_token,
                        'qr_code': id
                    },
                    success: function(response) {
                        if (response.status_error) {
                            swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Data tidak ditemukan!'
                            })
                        } else if (response.validasi) {
                            swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Data ditemukan !'
                            }).then((result) => {
                                window.location.href = 'http://127.0.0.1:8000/validasi/' + response.validasi
                            });
                        } else if (response.peminjaman) {
                            swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Data ditemukan !'
                            }).then((result) => {
                                window.location.href = 'http://127.0.0.1:8000/peminjaman/' + response.peminjaman + '/edit'
                            });
                        } else if (response.pengembalian) {
                            swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Data ditemukan !'
                            }).then((result) => {
                                window.location.href = 'http://127.0.0.1:8000/pengembalian/' + response.pengembalian + '/edit'
                            });
                        }
                    },
                    error: function(xhr) {
                        swal.fire({
                            type: 'error',
                            title: 'Oops..!',
                            text: 'Someting went wrong!'
                        });
                    }
                })
            }
        })
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 320,
                height: 320
            }
        },
        /* verbose= */
        false);

    function ScanDraft() {
        html5QrcodeScanner.render(onScanSuccess);
    }
</script>
@endif

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('/back') }}/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="{{ asset('/back') }}/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('/back') }}/javascripts/theme.init.js"></script>

@stack('last_script')

</body>

</html>