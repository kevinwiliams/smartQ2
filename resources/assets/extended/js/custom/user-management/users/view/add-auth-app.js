"use strict";

// Class definition
var MVUsersAddAuthApp = function () {
    // Shared variables
    const element = document.getElementById('mv_modal_add_auth_app');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initAddAuthApp = () => {

        // Close button handler
        const closeButton = element.querySelector('[data-mv-users-modal-action="close"]');
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
            }).then(function (result) {
                if (result.value) {
                    modal.hide(); // Hide modal				
                } 
            });
        });

    }

    // QR code to text code swapper
    var initCodeSwap = () => {
        const qrCode = element.querySelector('[ data-mv-add-auth-action="qr-code"]');
        const textCode = element.querySelector('[ data-mv-add-auth-action="text-code"]');
        const qrCodeButton = element.querySelector('[ data-mv-add-auth-action="qr-code-button"]');
        const textCodeButton = element.querySelector('[ data-mv-add-auth-action="text-code-button"]');
        const qrCodeLabel = element.querySelector('[ data-mv-add-auth-action="qr-code-label"]');
        const textCodeLabel = element.querySelector('[ data-mv-add-auth-action="text-code-label"]');

        const toggleClass = () =>{
            qrCode.classList.toggle('d-none');
            qrCodeButton.classList.toggle('d-none');
            qrCodeLabel.classList.toggle('d-none');
            textCode.classList.toggle('d-none');
            textCodeButton.classList.toggle('d-none');
            textCodeLabel.classList.toggle('d-none');
        }

        // Swap to text code handler
        textCodeButton.addEventListener('click', e =>{
            e.preventDefault();

            toggleClass();
        });

        qrCodeButton.addEventListener('click', e =>{
            e.preventDefault();

            toggleClass();
        });
    }

    return {
        // Public functions
        init: function () {
            initAddAuthApp();
            initCodeSwap();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVUsersAddAuthApp.init();
});