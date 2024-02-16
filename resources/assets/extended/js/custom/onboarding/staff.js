"use strict";

// Class definition
var MVEditStaff = (function () {
    var initInvitations = () => {
        // Shared variables
        const element = document.getElementById("mv_modal_staff");

        // Submit button handler
        const submitButton = element.querySelector(
            '[data-mv-staff-modal-action="submit"]'
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
                        }
                    });
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
    };

    var handleDeleteRows = () => {
        // Select all delete buttons
        var _table = document.querySelector("#mv_officers_list");
        const deleteButtons = _table.querySelectorAll(
            '[data-mv-staff-table-filter="delete_invite"]'
        );
        // console.log(deleteButtons);

        deleteButtons.forEach((d) => {
            // console.log(d);

            // Delete button on click
            d.addEventListener("click", function (e) {
                e.preventDefault();

                var id = d.dataset.id;
                console.log('Data-id value:', id);

                
                // return;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete this invitation?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary",
                    },
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: "/invitation/cancel/" + id,
                            data: {
                                _token: $("input[name=_token]").val(),
                            },
                            success: function (res) {
                                Swal.fire({
                                    text: "Invitation cancelled!.",
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
                                    "Invitation was not cancelled.<br>" +
                                    jqXHR.responseText +
                                    "<br>" +
                                    error,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        });
                    } else if (result.dismiss === "cancel") {
                        Swal.fire({
                            text: "Invitation was not deleted.",
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

    return {
        // Public functions
        init: function () {
            initInvitations();
            handleDeleteRows();
        },
    };
})();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVEditStaff.init();
});
