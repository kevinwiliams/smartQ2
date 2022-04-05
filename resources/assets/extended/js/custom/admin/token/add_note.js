"use strict";

// Class definition

var MVAddStaffNote = function(){
   

    // Init add schedule modal
    var initAddStaffNote = () => {  

    // Shared variables
    const element = document.getElementById('mv_modal_add_staff_note');
    console.log(element);
    const form = element.querySelector('#mv_modal_add_staff_note_form');


    const modal = new bootstrap.Modal(element);

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'officer_note': {
                        validators: {
                            notEmpty: {
                                message: 'Note is required'
                            }
                        }
                    },
    
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = element.querySelector('[data-mv-notes-modal-action="submit"]');
        // console.log(submitButton);

        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-mv-indicator', 'on');

                        // Disable button to avoid multiple click 
                        submitButton.disabled = true;

                        $.ajax({
                            url: form.action,
                            type: form.method,
                            dataType: 'json', 
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            contentType: false,  
                            cache: false,  
                            processData: false,
                            data:  new FormData(form),

                            success: function(data) {
                                submitButton.removeAttribute('data-mv-indicator');

                                // Enable button
                                submitButton.disabled = false;

                                // Show popup confirmation 
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {     
                                        document.location.href = '/admin/token/current';                              
                                        form.reset();
                                        modal.hide();
                                    }
                                });
                            }
                        });

                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-mv-notes-modal-action="cancel"]');
        // console.log(cancelButton);

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
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form			
                    modal.hide();	
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

        // Close button handler
        const closeButton = element.querySelector('[data-mv-notes-modal-action="close"]');
        // console.log(closeButton);

        closeButton.addEventListener('click', e => {
            e.preventDefault();

            form.reset(); // Reset form			
            modal.hide();	
        });

    }

    return {
        // Public functions
        init: function () {
            initAddStaffNote();
        }
    };

}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVAddStaffNote.init();
        
});
