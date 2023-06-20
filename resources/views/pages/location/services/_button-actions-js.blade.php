<script>
    // Class definition
    var MVServiceActions = function() {
        var datatable;
        var table;


        var initServiceTable = () => {

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
                            targets: 6
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


        // Init add schedule modal
        var handleEditRows = () => {
            // Shared variables
            const element = document.getElementById('mv_modal_edit_service');
            const form = element.querySelector('#mv_modal_edit_service_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'description': {
                            validators: {
                                notEmpty: {
                                    message: 'Description is required'
                                }
                            }
                        },
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                }
                            }
                        },
                        'price_range_start': {
                            validators: {
                                notEmpty: {
                                    message: 'Price Range is required'
                                }
                            }
                        },
                        'price_range_end': {
                            validators: {
                                notEmpty: {
                                    message: 'Price Range is required'
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

            var _table = document.querySelector('#service-table');
            const editButtons = _table.querySelectorAll('[data-mv-service-table-filter="edit_row"]');

            // console.log(editButtons);
             
            editButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    var obj = $(this);
                    
                    form.querySelector('input[name=id]').value = obj.data('id');
                    form.querySelector('input[name=name]').value = obj.data('serviceName');
                    form.querySelector('textarea[name=description]').value = obj.data('serviceDescription');
                    form.querySelector('input[name=price_range_start]').value = obj.data('servicePrice_range_start');
                    form.querySelector('input[name=price_range_end]').value = obj.data('servicePrice_range_end');
                    form.querySelector('input[name=status]').checked = obj.data('serviceStatus') == 1;

                    modal.show();
                });
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-service-edit-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-service-edit-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-service-edit-modal-action="submit"]');

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

                            var id = $('#mv_modal_edit_service_form input[name=id]').val();
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


            //Price Range handler
            const endRange = $("#mv_modal_edit_service_form #price_range_end");
            endRange.on('change', function() {
                var _max = Inputmask.unmask($(this).val(), {
                    alias: "currency"
                });
                var _min = Inputmask.unmask($("#mv_modal_edit_service_form #price_range_start").val(), {
                    alias: "currency"
                });

                if (parseFloat(_max) < parseFloat(_min)) {

                    Inputmask.setValue("#mv_modal_edit_service_form #price_range_end", _min);

                }
            });
        }

        var handleDeleteRows = () => {
            // Select all delete buttons
            // vartable = 
            // console.log(table);
            // var dt = table;
            var _table = document.querySelector('#service-table');
            const deleteButtons = _table.querySelectorAll('[data-mv-service-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // console.log(d);

                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const serviceId = $(this).data('id');
                    const serviceName = parent.querySelectorAll('td')[0].innerText;


                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete " + serviceName + "?",
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
                                url: '/location/services/delete/' + serviceId,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have deleted " + serviceName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // var dt = $('#counter-table').DataTable();
                                        window.location.reload();
                                        // Remove current row
                                        // dt.row($(parent)).remove().draw();
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
                                // Handle error here
                                Swal.fire({
                                    text: serviceName + " was not deleted.<br>" + jqXHR.responseText + "<br>" + error,
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
                                text: serviceName + " was not deleted.",
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

        var initAddService = () => {

            // Shared variables
            const element = document.getElementById('mv_modal_add_service');
            const form = element.querySelector('#mv_modal_add_service_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'description': {
                            validators: {
                                notEmpty: {
                                    message: 'Description is required'
                                }
                            }
                        },
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                }
                            }
                        },
                        'price_range_start': {
                            validators: {
                                notEmpty: {
                                    message: 'Price Range is required'
                                }
                            }
                        },
                        'price_range_end': {
                            validators: {
                                notEmpty: {
                                    message: 'Price Range is required'
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
            const submitButton = element.querySelector('[data-mv-service-modal-action="submit"]');

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
            const cancelButton = element.querySelector('[data-mv-service-modal-action="cancel"]');
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
            const closeButton = element.querySelector('[data-mv-service-modal-action="close"]');
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

            //Price Range handler
            const endRange = $("#mv_modal_add_service_form #price_range_end");
            endRange.on('change', function() {
                var _max = Inputmask.unmask($(this).val(), {
                    alias: "currency"
                });
                var _min = Inputmask.unmask($("#mv_modal_add_service_form #price_range_start").val(), {
                    alias: "currency"
                });

                if (parseFloat(_max) < parseFloat(_min)) {

                    Inputmask.setValue("#mv_modal_add_service_form #price_range_end", _min);

                }
            });
        }

        return {
            // Public functions
            init: function() {
                table = document.querySelector('#service-table');
                // console.log(table);
                if (!table) {
                    return;
                }
                initServiceTable();
                initAddService();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVServiceActions.init();

        }, 1000);
    });
</script>