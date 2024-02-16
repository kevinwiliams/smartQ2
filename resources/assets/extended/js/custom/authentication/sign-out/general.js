"use strict";

// Class definition
var MVUserSessionMain = function () {

    // Init logout session button
    var initLogoutSession = () => {
        const button = document.getElementById('mv_user_sign_out');

        if (button == null)
            return;
        
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

    // Init logout session button
    var initLanguageSwitcher = () => {
        const buttons = $('[data-mv-language-switcher]');


        $('[data-mv-language-switcher]').each(function (index, value) {
            // console.log(`div${index}: ${this.id}`);
            value.addEventListener('click', function (e) {

                e.preventDefault();
                // Select parent row
                // const parent = e.target.closest('a');

                var language = $(value).attr("data-mv-language-switcher");
                // alert(language);
                // return;
                Swal.fire({
                    text: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, switch!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url: '/common/language/',
                            data: {
                                _token: $("input[name=_token]").val(),
                                locale: language
                            },
                            success: function (res) {
                                location.reload();
                            }
                        }).fail(function (jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: "Error switching language.<br>" + jqXHR.responseText + "<br>" + error,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        });

                    } else if (result.dismiss === 'cancel') {

                    }
                });
            })
        });


        return;
        buttons.forEach(d => {
            // Delete button on click


        });
    }

    return {
        // Public functions
        init: function () {
            initLogoutSession();
            initLanguageSwitcher();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVUserSessionMain.init();
});
