<script>
    // Class definition
    var MVOpenHoursActions = function() {
        // Init add schedule modal
        var handleEdit = () => {
            // Shared variables
            const element = document.getElementById('mv_modal_edit_openhours');
            const form = element.querySelector('#mv_modal_edit_openhours_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
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
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );

            


            // Close button handler
            const closeButton = element.querySelector('[data-mv-openhours-edit-modal-action="close"]');
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
                }).then(function(result) {
                    if (result.value) {
                        modal.hide(); // Hide modal				
                    }
                });
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-mv-openhours-edit-modal-action="cancel"]');
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
                }).then(function(result) {
                    if (result.value) {
                        form.reset(); // Reset form	
                        modal.hide(); // Hide modal				
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

            // Submit button handler
            const submitButton = element.querySelector('[data-mv-openhours-edit-modal-action="submit"]');

            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        // console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-mv-indicator', 'on');

                            // Disable button to avoid multiple click 
                            submitButton.disabled = true;

                            var id = $('#openhours_edit_id').val();
                            $.ajax({
                                url: form.action + "/" + id,
                                type: form.method,
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                contentType: false,
                                cache: false,
                                processData: false,
                                data: new FormData(form),
                                // success: function(data)

                                // url: '{{ URL::to("client/token/checkin") }}/' + id,
                                // type: 'get',
                                // dataType: 'json',
                                success: function(data) {
                                    // console.log(data);
                                    // document.location.href = '/client';
                                    // setInterval( function () {
                                    //     table.ajax.reload();
                                    // }, 2000 );
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
                                    }).then(function(result) {
                                        location.reload();
                                    });
                                }
                                // ,
                                // error: function(xhr, status, error){
                                //     var errorMessage = xhr.status + ': ' + xhr.statusText
                                //     alert('Error - ' + errorMessage);
                                // }
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
        }

        var handleDeleteRows = () => {
            // Shared variables
            const element = document.getElementById('mv_modal_delete_reasonforvisit');
            const form = element.querySelector('#mv_modal_delete_reasonforvisit_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'department_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Department is required'
                                }
                            }
                        },
                        'id': {
                            validators: {
                                notEmpty: {
                                    message: 'Reason being deleted is required'
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

            var _table = document.querySelector('#openhours-table');
            const deleteButtons = _table.querySelectorAll('[data-mv-openhours-table-filter="delete_row"]');

            // console.log(editButtons);

            // $('#mv_modal_delete_reasonforvisit_form select[name=id]').on('change', function(e) {
            // 	$('#mv_modal_delete_reasonforvisit_form input[name=reason]').val($(this).find(':selected').text());
            // });


            deleteButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    var id = $(this).data('id');
                    // Select parent row
                    // const parent = e.target.closest('tr');
                    // alert('click');
                    modal.show();
                    // console.log(form.querySelector('input[name=id]'));

                    var options = form.querySelectorAll('select[name=id] option');
                    options.forEach(o => o.remove());
                    // form.querySelector('select[name=department_id]').value = id;
                    $('#mv_modal_delete_reasonforvisit_form select[name=department_id_display]').val(id);
                    $('#mv_modal_delete_reasonforvisit_form select[name=department_id_display]').trigger('change');
                    $('#mv_modal_delete_reasonforvisit_form select[name=department_id_display]').prop("disabled", true);
                    $('#mv_modal_delete_reasonforvisit_form input[name=department_id]').val(id);


                    $.ajax({
                        url: '{{ URL::to("location/openhours/reasonsforvisit") }}/' + id,
                        type: 'get',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            // console.log(data);

                            form.querySelector('select[name=id]').append(new Option("Select a reason", ""));
                            data.data.forEach(element => {
                                // console.log(element);
                                form.querySelector('select[name=id]').append(new Option(element.reason, element.id));
                            });
                        }

                    });

                });
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-openhours-delete-modal-action="close"]');
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
                }).then(function(result) {
                    if (result.value) {
                        modal.hide(); // Hide modal				
                    }
                });
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-mv-openhours-delete-modal-action="cancel"]');
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
                }).then(function(result) {
                    if (result.value) {
                        form.reset(); // Reset form	
                        modal.hide(); // Hide modal				
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

            // Submit button handler
            const submitButton = element.querySelector('[data-mv-openhours-delete-modal-action="submit"]');

            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        // console.log('validated!');

                        if (status == 'Valid') {

                            var id = $('#mv_modal_delete_reasonforvisit_form select[name=id]').val();
                            var reason = $('#mv_modal_delete_reasonforvisit_form select[name=id]').find(":selected").text();
                            Swal.fire({
                                text: "Are you sure you want to delete " + reason + "?",
                                icon: "warning",
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonText: "Yes, delete!",
                                cancelButtonText: "No, cancel",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-danger",
                                    cancelButton: "btn fw-bold btn-active-light-primary"
                                }
                            }).then(function(result) {
                                if (result.value) {
                                    // Show loading indication
                                    submitButton.setAttribute('data-mv-indicator', 'on');

                                    // Disable button to avoid multiple click 
                                    submitButton.disabled = true;

                                    $.ajax({
                                        url: form.action + "/" + id,
                                        type: "get",
                                        success: function(res) {
                                            // Remove loading indication
                                            submitButton.removeAttribute('data-mv-indicator');

                                            // Enable button
                                            submitButton.disabled = false;

                                            Swal.fire({
                                                text: "You have deleted " + reason + "!.",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: {
                                                    confirmButton: "btn fw-bold btn-primary",
                                                }
                                            }).then(function() {
                                                // Remove current row
                                                location.reload();
                                            });
                                        }
                                    }).fail(function(jqXHR, textStatus, error) {
                                        // Remove loading indication
                                        submitButton.removeAttribute('data-mv-indicator');

                                        // Enable button
                                        submitButton.disabled = false;

                                        // Handle error here
                                        Swal.fire({
                                            text: reason + " was not deleted.<br>" + jqXHR.responseText + "<br>" + error,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        });
                                    });

                                } else if (result.dismiss === 'cancel') {
                                    Swal.fire({
                                        text: reason + " was not deleted.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
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
        }

        var initAddopenhours = () => {

            // Shared variables
            const element = document.getElementById('mv_modal_add_reasonforvisit');
            const form = element.querySelector('#mv_modal_add_reasonforvisit_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'department_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Department is required'
                                }
                            }
                        },
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
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

            // Submit button handler
            const submitButton = element.querySelector('[data-mv-openhours-modal-action="submit"]');

            submitButton.addEventListener('click', e => {
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        // console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-mv-indicator', 'on');

                            // Disable button to avoid multiple click 
                            submitButton.disabled = true;

                            $.ajax({
                                url: form.action,
                                type: form.method,
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                contentType: false,
                                cache: false,
                                processData: false,
                                data: new FormData(form),
                                // success: function(data)

                                // url: '{{ URL::to("client/token/checkin") }}/' + id,
                                // type: 'get',
                                // dataType: 'json',
                                success: function(data) {
                                    // document.location.href = '/client';
                                    // setInterval( function () {
                                    //     table.ajax.reload();
                                    // }, 2000 );
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
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            // document.location.href = '/company/list';
                                            // datatable.draw();
                                            form.reset();
                                            modal.hide();
                                            location.reload();
                                        }
                                    });
                                },
                                error: function(xhr) {
                                    // Remove loading indication
                                    submitButton.removeAttribute('data-mv-indicator');

                                    // Enable button
                                    submitButton.disabled = false;
                                    Swal.fire({
                                        text: 'Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-light"
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
            const cancelButton = element.querySelector('[data-mv-openhours-modal-action="cancel"]');
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
                }).then(function(result) {
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
            const closeButton = element.querySelector('[data-mv-openhours-modal-action="close"]');
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
                }).then(function(result) {
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
            init: function() {
                
                // initopenhoursTable();
                // initAddopenhours();

                handleEdit();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVOpenHoursActions.init();

        }, 1000);
    });
</script>