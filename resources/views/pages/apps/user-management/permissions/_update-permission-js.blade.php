<script>
    // Class definition
    var KTUsersUpdatePermission = function() {
        // Shared variables
        const element = document.getElementById('kt_modal_update_permission');
        const form = element.querySelector('#kt_modal_update_permission_form');
        const modal = new bootstrap.Modal(element);


        var handleEditRows = () => {
            const editButtons = document.querySelectorAll('[data-kt-permissions-action="edit"]');
            // console.log(editButtons);
            editButtons.forEach(d => {
                d.addEventListener('click', e => {
                    e.preventDefault();

                    var btn = $('#' + d.id);
                    var id = btn.data('id');
                    var name = btn.data('name');
                    console.log(name);
                    $('[name="permission_name"]').val(name);
                    $('[name="permission_id"]').val(id);

                    modal.show();
                })
            });
        }


        // Init add schedule modal
        var initUpdatePermission = () => {

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'permission_name': {
                            validators: {
                                notEmpty: {
                                    message: 'Permission name is required'
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

            // Close button handler
            const closeButton = element.querySelector('[data-kt-permissions-modal-action="close"]');
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
                    modal.hide();
                    if (result.value) {
                        modal.hide(); // Hide modal				
                    }
                });
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-kt-permissions-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-kt-permissions-modal-action="submit"]');
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click 
                            submitButton.disabled = true;

                            id = $('[name="permission_id"]').val();

                            $.ajax({
                                url: form.action + '/' + id,
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
                                    console.log(data);
                                    // document.location.href = '/client';
                                    // setInterval( function () {
                                    //     table.ajax.reload();
                                    // }, 2000 );
                                    // Remove loading indication
                                    submitButton.removeAttribute('data-kt-indicator');

                                    // Enable button
                                    submitButton.disabled = false;

                                    // Show popup confirmation 
                                    Swal.fire({
                                        text: "Permission has been successfully updated!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            document.location.href = '/apps/user-management/permissions';
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
        }

        return {
            // Public functions
            init: function() {
                initUpdatePermission();
                handleEditRows();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        setTimeout(() => {
            KTUsersUpdatePermission.init();
        }, 1000);
    });
</script>