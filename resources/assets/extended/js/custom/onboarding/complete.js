"use strict";

// Class definition
var MVEditStaff = (function () {
    var initCompleted = () => {
        // Shared variables
        const element = document.getElementById("mv_modal_complete");

        // Submit button handler
        const submitButton = element.querySelector(
            '[data-mv-complete-modal-action="submit"]'
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
    };



    return {
        // Public functions
        init: function () {
            initCompleted();            
        },
    };
})();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVEditStaff.init();
});
