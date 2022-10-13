<script type="module">
    // import QrScanner from "../qr-scanner.min.js";
    // QrScanner.WORKER_PATH = '../qr-scanner-worker.min.js';    
    import QrScanner from "{{ asset('vendor/qr-scanner/qr-scanner.min.js')}}";

    const video = document.getElementById('qr-video');
    const camHasCamera = document.getElementById('cam-has-camera');
    const camQrResult = document.getElementById('cam-qr-result');
    const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
    const fileSelector = document.getElementById('file-selector');
    const fileQrResult = document.getElementById('file-qr-result');
    const bcodebtn = $('#btnScanBarcode');
    // console.log(bcodebtn);
    const element = document.getElementById('mv_modal_check_in');

    const modal = new bootstrap.Modal(element);

    function setResult(label, result) {
        label.textContent = result;
        camQrResultTimestamp.textContent = new Date().toString();
        label.style.color = 'teal';
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
        console.log(result.data);
        scanner.stop();
        modal.hide();
        qrCheckIn(result.data);

    }

    function deviceHasCamera(hasCamera) {
        camHasCamera.textContent = hasCamera;
        bcodebtn.prop('disabled', !hasCamera);
    }

    function qrCheckIn(location) {
        var tokenid = $("#tokenID").val();
        $.ajax({
            type: 'post',
            url: '{{ URL::to("token/qrcheckin") }}',
            type: 'POST',
            dataType: 'json',
            data: {
                'location': location,
                'tokenid': tokenid,
                '_token': '<?php echo csrf_token() ?>'
            },
            success: function(data) {
                console.log(data);
                if (data.status) {
                    //document.location.href = '/home/current';
                    location.reload(true);
                } else {
                    Swal.fire({
                        text: data.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function() {
                        location.reload(true);
                    });
                }


            }
        });
    }

    // ####### Web Cam Scanning #######

    QrScanner.hasCamera().then(hasCamera => deviceHasCamera(hasCamera));

    const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
        // onDecodeError: error => {
        //     camQrResult.textContent = error;
        //     camQrResult.style.color = 'inherit';
        // },
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });
    $('#mv_modal_check_in').on('show.bs.modal', function() {
        scanner.start();
    });

    $('#mv_modal_check_in').on('hide.bs.modal', function() {
        scanner.stop();
    });

    // scanner.start();

    // document.getElementById('inversion-mode-select').addEventListener('change', event => {
    //     scanner.setInversionMode(event.target.value);
    // });

    // ####### File Scanning #######

    // fileSelector.addEventListener('change', event => {
    //     const file = fileSelector.files[0];
    //     if (!file) {
    //         return;
    //     }
    //     QrScanner.scanImage(file)
    //         .then(result => setResult(fileQrResult, result))
    //         .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
    // });
</script>