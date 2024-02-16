"use strict";

// Class definition
var MVCompanyAddCompany = (function () {
    var initAddCompany = () => {
        // Shared variables
        const element = document.getElementById("mv_modal_add_company");
        const form = element.querySelector("#mv_modal_add_company_form");
        const modal = new bootstrap.Modal(element);

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(form, {
            fields: {
                business_category_id: {
                    validators: {
                        notEmpty: {
                            message: "Category is required",
                        },
                    },
                },
                name: {
                    validators: {
                        notEmpty: {
                            message: "Name is required",
                        },
                    },
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: "Address is required",
                        },
                    },
                },
                // 'website': {
                //     validators: {
                //         notEmpty: {
                //             message: 'Website is required'
                //         }
                //     }
                // },
                email: {
                    validators: {
                        notEmpty: {
                            message: "Email is required",
                        },
                    },
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: "Phone is required",
                        },
                    },
                },
                contact_person: {
                    validators: {
                        notEmpty: {
                            message: "Contact Person is required",
                        },
                    },
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: "Description is required",
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
            '[data-mv-company-modal-action="submit"]'
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
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        document.location.href = data.data;
                                        //"/onboarding/users";
                                        // datatable.draw();
                                        //form.reset();
                                        //modal.hide();
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
    };

    return {
        // Public functions
        init: function () {
            initAddCompany();            
        },
    };
})();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVCompanyAddCompany.init();
});
