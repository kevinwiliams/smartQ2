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
        document.location.href = '{{ URL::to("home/joinqueue") }}/' + result.data;
        // qrCheckIn(result.data);

    }

    function deviceHasCamera(hasCamera) {
        camHasCamera.textContent = hasCamera;
        bcodebtn.prop('disabled', !hasCamera);
    }

    function qrCheckIn(key) {                
        $.ajax({
            type: 'post',
            url: '{{ URL::to("home/joinqueue") }}',
            type: 'POST',
            dataType: 'json',
            data: {
                'key': key,                
                '_token': '<?php echo csrf_token() ?>'
            },
            success: function(data) {
                console.log(data);
                if (data.status) {
                    console.log('here');
                    //document.location.href = '/home/current';
                    //location.reload(true);
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
                        //location.reload(true);
                    });
                }


            }
        });
    }

    // Close button handler
    const closeButton = element.querySelector('[data-mv-checkin-modal-action="close"]');
    closeButton.addEventListener('click', e => {
        e.preventDefault();

        Swal.fire({
            text: "Are you sure you would like to close?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, close it!",
            cancelButtonText: "No, return",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(function(result) {
            if (result.value) {
                modal.hide(); // Hide modal				
            }
        });
    });

    // Cancel button handler
    const cancelButton = element.querySelector('[data-mv-checkin-modal-action="cancel"]');
    cancelButton.addEventListener('click', e => {
        e.preventDefault();

        Swal.fire({
            text: "Are you sure you would like to cancel?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, cancel it!",
            cancelButtonText: "No, return",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(function(result) {
            if (result.value) {
                // form.reset(); // Reset form	
                modal.hide(); // Hide modal				
            } else if (result.dismiss === 'cancel') {
                Swal.fire({
                    text: "Your form has not been cancelled!.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    }
                });
            }
        });
    });

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