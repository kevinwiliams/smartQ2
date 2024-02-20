"use strict";

// Class definition
var MVEditStaff = (function () {
    var initSetup = () => {
        // Shared variables
        const element = document.getElementById("mv_modal_setup");

        // Submit button handler
        const submitButton = element.querySelector(
            '[data-mv-setup-modal-action="submit"]'
        );

        submitButton.addEventListener("click", (e) => {
            e.preventDefault();

            // Show loading indication
            submitButton.setAttribute("data-mv-indicator", "on");

            // Disable button to avoid multiple click
            submitButton.disabled = true;

            $.ajax({
                url: "/onboarding/next",
                type: "get",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                contentType: false,
                cache: false,
                processData: false,

                success: function (data) {
                    console.log(data);
                    // Remove loading indication
                    submitButton.removeAttribute("data-mv-indicator");

                    // Enable button
                    submitButton.disabled = false;
                    document.location.href = data.data;
                    // Show popup confirmation
                    // Swal.fire({
                    //     text: "Form has been successfully submitted!",
                    //     icon: "success",
                    //     buttonsStyling: false,
                    //     confirmButtonText: "Ok, got it!",
                    //     customClass: {
                    //         confirmButton: "btn btn-primary",
                    //     },
                    // }).then(function (result) {
                    //     if (result.isConfirmed) {
                    //         document.location.href = data.data;
                    //     }
                    // });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Code to execute when the AJAX request encounters an error
                    console.error("AJAX Error:", textStatus, errorThrown);

                    // Remove loading indication
                    submitButton.removeAttribute("data-mv-indicator");

                    // Enable button
                    submitButton.disabled = false;

                    // Show an error popup using SweetAlert2 library
                    Swal.fire({
                        text: "Error submitting the form. Please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-danger",
                        },
                    });
                },
            });
        });

        // Cancel button handler
        const cancelButton = element.querySelector(
            '[data-mv-onboarding-action="cancel"]'
        );
        cancelButton.addEventListener("click", (e) => {
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
                    cancelButton: "btn btn-active-light",
                },
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: "/onboarding/cancel",
                        type: "get",
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        contentType: false,
                        cache: false,
                        processData: false,

                        success: function (data) {
                            document.location.href = "/home";
                        },
                    });
                } else if (result.dismiss === "cancel") {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });

        // Cancel button handler
        const backButton = element.querySelector(
            '[data-mv-setup-modal-action="back"]'
        );
        backButton.addEventListener("click", (e) => {
            e.preventDefault();

                // Show loading indication
                backButton.setAttribute("data-mv-indicator", "on");

                // Disable button to avoid multiple click
                backButton.disabled = true;

            Swal.fire({
                text: "Are you sure you would like to go back?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, take me back!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light",
                },
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: "/onboarding/back",
                        type: "get",
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        contentType: false,
                        cache: false,
                        processData: false,

                        success: function (data) {
                            document.location.href = data.data;                            
                        },
                    });

                     // Remove loading indication
                     backButton.removeAttribute("data-mv-indicator");

                     // Enable button
                     backButton.disabled = false;
                } else if (result.dismiss === "cancel") {
                    // Remove loading indication
                    backButton.removeAttribute("data-mv-indicator");

                    // Enable button
                    backButton.disabled = false;
                    Swal.fire({
                        text: "Your're safe!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
    };

    var handleDeleteRows = () => {
        // Select all delete buttons
        var _table = document.querySelector("#mv_queue_config");
        const deleteButtons = _table.querySelectorAll(
            '[data-mv-queue-table-filter="delete"]'
        );

        if (deleteButtons)
            deleteButtons.forEach((d) => {
                // console.log(d);

                // Delete button on click
                d.addEventListener("click", function (e) {
                    e.preventDefault();

                    var id = d.dataset.id;
                    console.log("Data-id value:", id);

                    // return;

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete this configuration?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton:
                                "btn fw-bold btn-active-light-primary",
                        },
                    }).then(function (result) {
                        if (result.value) {
                            $.ajax({
                                url: "/location/token/setting/delete/" + id,
                                data: {
                                    _token: $("input[name=_token]").val(),
                                },
                                success: function (res) {
                                    Swal.fire({
                                        text: "Configuration Deleted!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton:
                                                "btn fw-bold btn-primary",
                                        },
                                    }).then(function () {
                                        // var dt = $('#counter-table').DataTable();
                                        window.location.reload();
                                        // Remove current row
                                        // dt.row($(parent)).remove().draw();
                                    });
                                },
                            }).fail(function (jqXHR, textStatus, error) {
                                // Handle error here
                                Swal.fire({
                                    text:
                                        "Configuration was not deleted.<br>" +
                                        jqXHR.responseText +
                                        "<br>" +
                                        error,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton:
                                            "btn fw-bold btn-primary",
                                    },
                                });
                            });
                        } else if (result.dismiss === "cancel") {
                            Swal.fire({
                                text: "Configuration was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        }
                    });
                });
            });
    };

    var initAddConfig = () => {
        // Shared variables
        const element = document.getElementById("mv_modal_setup");
        const form = element.querySelector("#mv_modal_add_config_form");

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(form, {
            fields: {
                department_id: {
                    validators: {
                        notEmpty: {
                            message: "Department is required",
                        },
                    },
                },
                counter_id: {
                    validators: {
                        notEmpty: {
                            message: "Counter is required",
                        },
                    },
                },
                user_id: {
                    validators: {
                        notEmpty: {
                            message: "Officer is required",
                        },
                    },
                },
            },

            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: "",
                }),
            },
        });

        // Submit button handler
        const submitButton = element.querySelector(
            '[data-mv-queuesetup-modal-action="submit"]'
        );

        submitButton.addEventListener("click", (e) => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log("validated!");

                    if (status == "Valid") {
                        // Show loading indication
                        submitButton.setAttribute("data-mv-indicator", "on");

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        $.ajax({
                            url: form.action,
                            type: form.method,
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            contentType: false,
                            cache: false,
                            processData: false,
                            data: new FormData(form),
                            // success: function(data)

                            // url: '{{ URL::to("client/token/checkin") }}/' + id,
                            // type: 'get',
                            // dataType: 'json',
                            success: function (data) {
                                // document.location.href = '/client';
                                // setInterval( function () {
                                //     table.ajax.reload();
                                // }, 2000 );
                                console.log(data);
                                // Remove loading indication
                                submitButton.removeAttribute(
                                    "data-mv-indicator"
                                );

                                // Enable button
                                submitButton.disabled = false;

                                // Show popup confirmation
                                Swal.fire({
                                    text: "Configuration has been successfully added!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                // Code to execute when the AJAX request encounters an error
                                console.error(
                                    "AJAX Error:",
                                    textStatus,
                                    errorThrown
                                );

                                // Remove loading indication
                                submitButton.removeAttribute(
                                    "data-mv-indicator"
                                );

                                // Enable button
                                submitButton.disabled = false;

                                // Show an error popup using SweetAlert2 library
                                Swal.fire({
                                    text: "Error submitting the form. Please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-danger",
                                    },
                                });
                            },
                        });
                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            }
        });

        // Reset button handler
        // const resetButton = element.querySelector(
        //     '[data-mv-queuesetup-modal-action="reset"]'
        // );
        // resetButton.addEventListener("click", (e) => {
        //     e.preventDefault();

        //     Swal.fire({
        //         text: "Are you sure you would like to reset?",
        //         icon: "warning",
        //         showCancelButton: true,
        //         buttonsStyling: false,
        //         confirmButtonText: "Yes, reset it!",
        //         cancelButtonText: "No, return",
        //         customClass: {
        //             confirmButton: "btn btn-primary",
        //             cancelButton: "btn btn-active-light",
        //         },
        //     }).then(function (result) {
        //         if (result.value) {
        //             form.reset();
        //             $('[name="department_id"]').val(null).trigger('change');
        //             $('[name="counter_id"]').val(null).trigger('change');
        //             $('[name="user_id"]').val(null).trigger('change');
        //             $('[name="department_id"]').select2();
        //             $('[name="counter_id"]').select2();
        //             $('[name="user_id"]').select2();

        //         }
        //     });
        // });
    };

    return {
        // Public functions
        init: function () {
            initSetup();

            handleDeleteRows();
            initAddConfig();
        },
    };
})();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVEditStaff.init();
});
