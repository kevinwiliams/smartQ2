"use strict";

// Class definition
var MVSupport = function () {
    // Shared variables
    const element = document.getElementById('mv_modal_add_feedback');
    const form = element.querySelector('#mv_modal_add_feedback_form');
    const modal = new bootstrap.Modal(element);

        // Init add schedule modal
    var initAddFeedback = () => {
        if(element == null)
            return;
        
        var _rating = $("#rating_div");        
      

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'comment': {
                        validators: {
                            notEmpty: {
                                message: 'Comment is required'
                            }
                        }
                    },
                    'type': {
                        validators: {
                            notEmpty: {
                                message: 'Type is required'
                            }
                        }
                    },
                    'rating': {
                        validators: {
                            notEmpty: {
                                message: 'Rating is required'
                            }
                        }
                    }
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

        $('#mv_modal_add_feedback_form select[name="type"]').on('change',function (e) {
            var _type = $(this).find(":selected").val();
            switch (_type) {
             case "comment":
                validator.disableValidator('rating');    
                _rating.hide();
                 
                 break;           
             default:
                validator.enableValidator('rating');
                _rating.show();
                 break;
            }

            validator.revalidateField('rating');
         });
         $('#mv_modal_add_feedback_form select[name="type"]').trigger('change');

        // Submit button handler
        const submitButton = element.querySelector('[data-mv-feedback-modal-action="submit"]');
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
                                 // Remove loading indication
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
                                        // window.location.reload();                                             
                                        form.reset();
                                        modal.hide();
                                        $('#mv_modal_add_feedback_form select[name="type"]').val('comment');
                                        $('#mv_modal_add_feedback_form select[name="type"]').trigger('change');
                                    }
                                });
                            }
                        }).fail(function(jqXHR, textStatus, error) {
                            // Remove loading indication
                            submitButton.removeAttribute('data-mv-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Handle error here
                            Swal.fire({
                                text: "Information was not added.<br>" + jqXHR.responseText + "<br>" + error,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
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
        const cancelButton = element.querySelector('[data-mv-feedback-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-mv-feedback-modal-action="close"]');
        closeButton.addEventListener('click', e => {
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
    }

    return {
        // Public functions
        init: function () {
            initAddFeedback();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVSupport.init();
});