<script>
    // Class definition
    var MVAlertsActions = function() {
        var datatable;
        var table;


        var initAlertTable = () => {

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
                handleViewRows();
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

            var _table = document.querySelector('#alerts-table');
            const deleteButtons = _table.querySelectorAll('[data-mv-alert-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[0].innerText;
                    if (parent.querySelectorAll('input[name=alert-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=alert-id]')[0].value;
                    else
                        var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");

                    console.log(tokenID);
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
                                url: '/alerts/delete/' + tokenID,
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
                                        location.reload();
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

        var handleViewRows = () => {

            var _table = document.querySelector('#alerts-table');
            const viewButtons = _table.querySelectorAll('[data-mv-alert-table-filter="view_row"]');

            viewButtons.forEach(d => {
                // Delete button on click

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[0].innerText;
                    const title = parent.querySelectorAll('input[name=alert-title]')[0].value;
                    const message = parent.querySelectorAll('input[name=alert-message]')[0].value;
                    const imageurl = parent.querySelectorAll('input[name=alert-image_url]')[0].value;
                    const imagepath = parent.querySelectorAll('input[name=alert-image_path]')[0].value;

                    // console.log(tokenID);

                    if (imageurl == '') {
                        Swal.fire({
                            title: title,
                            text: message,

                        });
                    } else {
                        Swal.fire({
                            title: title,
                            text: message,
                            imageUrl: imagepath,
                            imageAlt: title
                        });
                    }


                    return;


                })
            });


        }


        // Init add schedule modal
        var handleEditRows = () => {
            // Shared variables
            const element = document.getElementById('mv_modal_edit_alert');
            const form = element.querySelector('#mv_modal_edit_alert_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'title': {
                            validators: {
                                notEmpty: {
                                    message: 'Title is required'
                                }
                            }
                        },
                        'message': {
                            validators: {
                                notEmpty: {
                                    message: 'Message is required'
                                }
                            }
                        },
                        'start_date': {
                            validators: {
                                notEmpty: {
                                    message: 'Start Date is required'
                                }
                            }
                        },
                        'end_date': {
                            validators: {
                                notEmpty: {
                                    message: 'End Date is required'
                                }
                            }
                        },
                        'location_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Location is required'
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

            var _table = document.querySelector('#alerts-table');
            const editButtons = _table.querySelectorAll('[data-mv-alert-table-filter="edit_row"]');

            editButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    const _id = parent.querySelectorAll('input[name=alert-id]')[0].value;
                    const title = parent.querySelectorAll('input[name=alert-title]')[0].value;
                    const message = parent.querySelectorAll('input[name=alert-message]')[0].value;
                    const imageurl = parent.querySelectorAll('input[name=alert-image_url]')[0].value;
                    const imagepath = parent.querySelectorAll('input[name=alert-image_path]')[0].value;
                    const startdate = parent.querySelectorAll('input[name=alert-end_date]')[0].value;
                    const enddate = parent.querySelectorAll('input[name=alert-start_date]')[0].value;
                    const isActive = parent.querySelectorAll('input[name=alert-active]')[0].value;
                    const locations = parent.querySelectorAll('input[name=alert-locations]')[0].value;


                    form.querySelector('input[name=alert_edit_id]').value = _id;
                    form.querySelector('input[name=title]').value = title;
                    form.querySelector('textarea[name=message]').value = message;
                    form.querySelector('input[name=start_date]').value = startdate;
                    form.querySelector('input[name=end_date]').value = enddate;
                    $('#edit_active').prop("checked", isActive);
                    $('input[name="old_logo"]').val(imageurl);
                    $("#alert-logo-wrapper").css({
                        "background-image": "url(" + imagepath + ")"
                    });

                    var selLocation = $("#edit_location_id");
                    selLocation.val(locations.split(','));
                    if (selLocation.prop("tagName") == "SELECT") {
                        selLocation.trigger('change');
                        selLocation.select2();
                    }


                    // form.querySelector('input[name=shortname]').value = _shortname;
                    // // form.querySelector('select[name=business_category_id]').value = _categoryId;
                    // form.querySelector('input[name=address]').value = _address;
                    // form.querySelector('input[name=website]').value = _website;
                    // form.querySelector('input[name=email]').value = _email;
                    // form.querySelector('input[name=phone]').value = _phone;
                    // form.querySelector('input[name=contact_person]').value = _contact_person;
                    // form.querySelector('textarea[name=description]').value = _description;
                    // $('#edit_active').prop("checked", _active);
                    // $('input[name="old_logo"]').val(_logo);
                    // $("#alert-logo-wrapper").css({
                    //     "background-image": "url(" + _logourl + ")"
                    // });

                    // var business_category = $("select[name=business_category_id]").select2({
                    //     dropdownParent: $('#mv_modal_edit_alert')
                    // });
                    // // console.log(_categoryId);
                    // business_category.val(_categoryId);
                    // business_category.trigger('change');
                    // business_category.select2();

                    modal.show();

                });
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-alert-edit-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-alert-edit-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-alert-edit-modal-action="submit"]');

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
                            var id = $("#alert_edit_id").val();
                            var locations = $("#edit_location_id").val();
                            if (Array.isArray(locations)) {
                                var locationJoin = locations.join(',');
                            } else {
                                var locationJoin = locations;
                            }

                            $("#edit_locations").val(locationJoin);
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
                                        // document.location.href = '/alert/list';
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

        var initAddAlert = () => {

            // Shared variables
            const element = document.getElementById('mv_modal_add_alert');
            const form = element.querySelector('#mv_modal_add_alert_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'title': {
                            validators: {
                                notEmpty: {
                                    message: 'Title is required'
                                }
                            }
                        },
                        'message': {
                            validators: {
                                notEmpty: {
                                    message: 'Message is required'
                                }
                            }
                        },
                        'start_date': {
                            validators: {
                                notEmpty: {
                                    message: 'Start Date is required'
                                }
                            }
                        },
                        'end_date': {
                            validators: {
                                notEmpty: {
                                    message: 'End Date is required'
                                }
                            }
                        },
                        'location_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Location is required'
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
            const submitButton = element.querySelector('[data-mv-alert-modal-action="submit"]');

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

                            var locations = $("#location_id").val();
                            if (Array.isArray(locations)) {
                                var locationJoin = locations.join(',');
                            } else {
                                var locationJoin = locations;
                            }

                            $("#locations").val(locationJoin);

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
            const cancelButton = element.querySelector('[data-mv-alert-modal-action="cancel"]');
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
            const closeButton = element.querySelector('[data-mv-alert-modal-action="close"]');
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
                table = document.querySelector('#alerts-table');
                // console.log(table);
                if (!table) {
                    return;
                }
                initAlertTable();
                initAddAlert();
                // handleDeleteRows();
                // handleEditRows();

                // handleEditRows();
                // handleCompleteRows();
                // handleCancelRows();
                // handleCheckInRows();
                // handleTransferRows();
                // handleRecallRows();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVAlertsActions.init();

        }, 1000);
    });
</script>