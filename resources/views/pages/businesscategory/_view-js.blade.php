<script>
    // Class definition
    var MVCategoryActions = function() {
        var datatable;
        var table;



        var initAddCategory = () => {
            // Shared variables
            const element = document.getElementById('mv_modal_add_category');
            const form = element.querySelector('#mv_modal_add_category_form');
            const modal = new bootstrap.Modal(element);
            console.log(element);
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {                       
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                }
                            }
                        },
                        'description': {
                            validators: {
                                notEmpty: {
                                    message: 'Description is required'
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
            const submitButton = element.querySelector('[data-mv-category-modal-action="submit"]');

            submitButton.addEventListener('click', e => {
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
                                            location.reload();
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
            const cancelButton = element.querySelector('[data-mv-category-modal-action="cancel"]');
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
            const closeButton = element.querySelector('[data-mv-category-modal-action="close"]');
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
        // Init add schedule modal
        var initViewCompany = () => {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');
            console.log(tableRows);
            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                "pageLength": 2,
                "lengthMenu": [
                    [1, 2, 5, 10, -1],
                    [1, 2, 5, 10, "All"]
                ],
                // "lengthChange": false,
                'columnDefs': []
            });
        }

        // Init edit company modal
        var handleEdit = () => {
            // Shared variables
            const element = document.getElementById('mv_modal_edit_category');
            const form = element.querySelector('#mv_modal_edit_category_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                }
                            }
                        },
                        'description': {
                            validators: {
                                notEmpty: {
                                    message: 'Description is required'
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

            
            const editButton = document.querySelector('[data-mv-category-action-filter="edit_record"]');

            // console.log(editButtons);

            editButton.addEventListener('click', function(e) {

                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');
                // alert('click');
                modal.show();

                var _id = $('#category-id').val();
                var _name = $('#category-name').val();
                var _description = $('#category-description').val();
                
                form.querySelector('input[name=category_edit_id]').value = _id;
                form.querySelector('input[name=name]').value = _name;                
                form.querySelector('textarea[name=description]').value = _description;               

            });



            // Close button handler
            const closeButton = element.querySelector('[data-mv-category-edit-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-category-edit-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-category-edit-modal-action="submit"]');

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
                            var id = $("#category_edit_id").val();
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
                                        // document.location.href = '/company/list';
                                        // datatable.draw();
                                        location.reload();
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

        return {
            // Public functions
            init: function() {
                table = document.querySelector('#mv_category_table');
                console.log(table);
                if (!table) {
                    return;
                }

                initViewCategory();
                initAddCategory();
                handleEdit();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        MVCategoryActions.init();
    });
</script>