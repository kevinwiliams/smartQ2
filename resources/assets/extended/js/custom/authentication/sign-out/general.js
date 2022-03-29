"use strict";

// Class definition
var MVUserSessionMain = function () {

    // Init logout session button
    var initLogoutSession = () => {
        const button = document.getElementById('mv_user_sign_out');

        button.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like sign out?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, sign out!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    button.closest('form').submit();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your session is still preserved!.",
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
    } 

    return {
        // Public functions
        init: function () {
            initLogoutSession();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVUserSessionMain.init();
});