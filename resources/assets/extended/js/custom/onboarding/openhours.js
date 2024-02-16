"use strict";

// Class definition
var MVOpenHoursActions = (function () {
    // Init add schedule modal
    var handleForm = () => {
        // Shared variables
        const element = document.getElementById("mv_modal_edit_openhours");
        const form = element.querySelector("#mv_modal_edit_openhours_form");
        const modal = new bootstrap.Modal(element);

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(form, {
            fields: {
                // 'department_id': {
                //     validators: {
                //         notEmpty: {
                //             message: 'Department is required'
                //         }
                //     }
                // },
                // 'id': {
                //     validators: {
                //         notEmpty: {
                //             message: 'Reason being changed is required'
                //         }
                //     }
                // },
                // 'reason': {
                //     validators: {
                //         notEmpty: {
                //             message: 'Reason is required'
                //         }
                //     }
                // }
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
            '[data-mv-openhours-modal-action="submit"]'
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
                    form.reset(); // Reset form
                    modal.hide(); // Hide modal
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

    var initSetup = () => {
        var optional_config = {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",
        };
        $(".timepicker").flatpickr(optional_config);

        $("select[name^='is_open_']").on("change", function () {
            var obj = $(this);
            var _isOpen = obj.find(":selected").val();
            var key = obj.attr("name").split("_")[2];

            switch (_isOpen) {
                case "all":
                    $("#start_time_" + key + ",#end_time_" + key).hide();
                    break;
                case "true":
                    $("#start_time_" + key + ",#end_time_" + key).show();
                    break;
                case "false":
                    $("#start_time_" + key + ",#end_time_" + key).hide();
                    break;
                default:
                    break;
            }
        });
        $("select[name^='is_open_']").trigger("change");
    };

    return {
        // Public functions
        init: function () {
            // initSetup();
            handleForm();
        },
    };
})();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVOpenHoursActions.init();
});
