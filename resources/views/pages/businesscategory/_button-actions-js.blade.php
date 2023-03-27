<script>
    // Class definition
    var MVCategoryActions = function() {
        var datatable;
        var table;


        var initCategoryTable = () => {

            if ($.fn.dataTable.isDataTable(table)) {
                datatable = $(table).DataTable();
            } else {
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    "pageLength": 10,
                    "lengthChange": false,
                    'columnDefs': [{
                            orderable: false,
                            targets: 3
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }
            datatable.draw();
            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            datatable.on('draw', function() {
                // console.log("raw")
                MVMenu.createInstances();
                handleDeleteRows();
                handleEditRows();
            });

            //search bar    
            // const filterSearch = document.querySelector('[data-mv-counter-table-filter="search"]');
            // filterSearch.addEventListener('keyup', function (e) {
            //     var table = $('#counter-table').DataTable();
            //     table.search(e.target.value).draw();
            // });

        }

        var handleDeleteRows = () => {

            var _table = document.querySelector('#mv_category_table');
            const deleteButtons = _table.querySelectorAll('[data-mv-category-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[0].innerText;
                    if (parent.querySelectorAll('input[name=category-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=category-id]')[0].value;
                    else
                        var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");

                    // console.log(tokenID);
                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete " + tokenNo + "?",
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

                            $.ajax({
                                url: '/category/delete/' + tokenID,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have deleted " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        document.location.href = '/category/list';
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
                                // Handle error here
                                Swal.fire({
                                    text: tokenNo + " was not deleted.<br>" + jqXHR.responseText + "<br>" + error,
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
                                text: tokenNo + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                })
            });


        }

        // Init add schedule modal
        var handleEditRows = () => {
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

            var _table = document.querySelector('#mv_category_table');
            const editButtons = _table.querySelectorAll('[data-mv-category-table-filter="edit_row"]');

            // console.log(editButtons);
            editButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');
                    // alert('click');
                    modal.show();

                    var _id = parent.querySelectorAll('input[name=category-id]')[0].value;
                    var _name = parent.querySelectorAll('input[name=category-name]')[0].value;                    
                    var _description = parent.querySelectorAll('input[name=category-description]')[0].value;                   
                    
                    form.querySelector('input[name=category_edit_id]').value = _id;         
                    form.querySelector('input[name=name]').value = _name;
                    form.querySelector('textarea[name=description]').value = _description;                    

                });
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
                                        // document.location.href = '/category/list';
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

        var initAddCategory = () => {

            // Shared variables
            const element = document.getElementById('mv_modal_add_category');
            const form = element.querySelector('#mv_modal_add_category_form');
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
                                            document.location.href = '/category/list';
                                            // datatable.draw();
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

        return {
            // Public functions
            init: function() {
                table = document.querySelector('#mv_category_table');
                // console.log(table);
                if (!table) {
                    return;
                }
                initAddCategory();
                initCategoryTable();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVCategoryActions.init();

        }, 1000);
    });
</script>