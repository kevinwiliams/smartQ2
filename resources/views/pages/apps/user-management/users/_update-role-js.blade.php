<script>
    // Class definition
    var MVUsersUpdateRole = function() {
        // Shared variables
        const element = document.getElementById('mv_modal_update_role');
        const form = element.querySelector('#mv_modal_update_role_form');
        const modal = new bootstrap.Modal(element);

        // Init add schedule modal
        var initUpdateRole = () => {

            // Close button handler
            const closeButton = element.querySelector('[data-mv-users-modal-action="close"]');
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

            // Cancel button handler
            const cancelButton = element.querySelector('[data-mv-users-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-users-modal-action="submit"]');
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Show loading indication
                submitButton.setAttribute('data-mv-indicator', 'on');

                // Disable button to avoid multiple click 
                submitButton.disabled = true;

                id = $("#user_id").val();

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
                            if (result.isConfirmed) {
                                // document.location.href = '/apps/user-management/users/edit/' + id;
                                // form.reset();
                                // modal.hide();
                                location.reload();
                            }
                        });
                    }
                });
                // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                // setTimeout(function () {
                //     // Remove loading indication
                //     submitButton.removeAttribute('data-mv-indicator');

                //     // Enable button
                //     submitButton.disabled = false;

                //     // Show popup confirmation 
                //     Swal.fire({
                //         text: "Form has been successfully submitted!",
                //         icon: "success",
                //         buttonsStyling: false,
                //         confirmButtonText: "Ok, got it!",
                //         customClass: {
                //             confirmButton: "btn btn-primary"
                //         }
                //     }).then(function (result) {
                //         if (result.isConfirmed) {
                //             modal.hide();
                //         }
                //     });

                //     //form.submit(); // Submit form
                // }, 2000);
            });
        }

        return {
            // Public functions
            init: function() {
                initUpdateRole();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        MVUsersUpdateRole.init();
    });
</script>