<script>
    // Class definition
    var MVUsersUpdatePermissions = function() {
        // Shared variables
        const element = document.getElementById('mv_modal_update_role');
        const form = element.querySelector('#mv_modal_update_role_form');
        const modal = new bootstrap.Modal(element);

        // Init add schedule modal
        var initUpdatePermissions = () => {

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'role_name': {
                            validators: {
                                notEmpty: {
                                    message: 'Role name is required'
                                }
                            }
                        },
                        'permissions[]': {
                            validators: {
                                notEmpty: {
                                    message: 'Permissions are required'
                                }
                            }
                        },
                        'role_description': {
                            validators: {
                                notEmpty: {
                                    message: 'Descriptions are required'
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

            const editButtons = $('#btn_Edit');
            editButtons.on('click', e => {
                e.preventDefault();

                var id = editButtons.data('id');
                var name = editButtons.data('name');
                var perms = editButtons.data('permissions');
                var desc = editButtons.data('description');
                var editable = editButtons.data('editable');

                $("#update_role_name").val(name);
                $("#role_id").val(id);
                $("#update_role_description").val(desc);

                var _core = (editable == 0);
                $("#mv_update_roles_core").prop("disabled", _core);
                if (desc != "") {
                    $("#update_role_description").prop("disabled", _core);
                }

                $("#mv_update_roles_core").prop("checked", _core);

                // var $ddlPermissions = $("#ddlPermissions").select2();
                // $ddlPermissions.val(perms).trigger("change");

                $.each(perms, function(index, obj) {
                    //We can access the object using obj or this
                    $('[type="checkbox"][value="' + obj + '"][name="permissions[]"]').prop("checked", true);
                });
                modal.show();
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-roles-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-roles-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-roles-modal-action="submit"]');
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-mv-indicator', 'on');

                            // Disable button to avoid multiple click 
                            submitButton.disabled = true;
                            var id = $("#role_id").val();
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
                                    console.log(data);
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
                                        // if (result.isConfirmed) {     
                                        document.location.href = '/apps/user-management/roles/view/' + id;
                                        form.reset();
                                        modal.hide();
                                        // }
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

        // Select all handler
        const handleSelectAll = () => {
            // Define variables
            const selectAll = form.querySelector('#mv_roles_select_all');
            const allCheckboxes = form.querySelectorAll('[type="checkbox"]');

            // Handle check state
            selectAll.addEventListener('change', e => {

                // Apply check state to all checkboxes
                allCheckboxes.forEach(c => {
                    c.checked = e.target.checked;
                });
            });
        }

        return {
            // Public functions
            init: function() {
                initUpdatePermissions();
                // handleSelectAll();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        MVUsersUpdatePermissions.init();
    });
</script>