<script>
    // Class definition
    var MVVIPActions = function() {
        var datatable;
        var table;


        var initVIPTable = () => {

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
            const filterSearch = document.querySelector('[data-mv-viplist-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                var table = $('#viplist-table').DataTable();
                table.search(e.target.value).draw();
            });

        }

        var handleDeleteRows = () => {

            var _table = document.querySelector('#viplist-table');
            const deleteButtons = _table.querySelectorAll('[data-mv-viplist-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[0].innerText;
                    if (parent.querySelectorAll('input[name=viplist-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=viplist-id]')[0].value;
                    else
                        var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");

                    console.log(tokenID);
                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete this VIP ?",
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
                                url: '/viplist/delete/' + tokenID,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have deleted the VIP.",
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
                                    text: "The VIP was not deleted.<br>" + jqXHR.responseText + "<br>" + error,
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
                                text: "VIP was not deleted.",
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
            const element = document.getElementById('mv_modal_edit_viplist');
            const form = element.querySelector('#mv_modal_edit_viplist_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'reason': {
                            validators: {
                                notEmpty: {
                                    message: 'Reason is required'
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

            var _table = document.querySelector('#viplist-table');
            const editButtons = _table.querySelectorAll('[data-mv-viplist-table-filter="edit_row"]');

            editButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    const _id = parent.querySelectorAll('input[name=viplist-id]')[0].value;
                    const reason = parent.querySelectorAll('input[name=viplist-reason]')[0].value;
                    const clientname = parent.querySelectorAll('input[name=viplist-clientname]')[0].value;
                    const clientphoto = parent.querySelectorAll('input[name=viplist-clientphoto]')[0].value;
                    const createdat = parent.querySelectorAll('input[name=viplist-createdat]')[0].value;

                    form.querySelector('input[name=viplist_edit_id]').value = _id;
                    form.querySelector('textarea[name=reason]').value = reason;
                    form.querySelector('span#span_clientname').innerText = clientname;
                    form.querySelector('img#clientphoto').src = clientphoto;
                    form.querySelector('span#span_vipsince').innerText = createdat;

                    modal.show();

                });
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-viplist-edit-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-viplist-edit-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-viplist-edit-modal-action="submit"]');

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
                            var id = $("#viplist_edit_id").val();

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
                                success: function(data) {
                                    console.log(data);                                    
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
                                        form.reset();
                                        modal.hide();
                                        // }
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

        var initAddVIPUser = () => {
            //Setup user search
            $('#client_id').select2({
                ajax: {
                    // url: "https://api.github.com/search/repositories",
                    url: "/location/getClients/" + $("#location").val(),
                    dataType: 'json',
                    delay: 250,                  
                    processResults: function(data, params) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.clients
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a client',
                minimumInputLength: 3,
                templateResult: formatUser,
                templateSelection: formatUser
            });

            // Shared variables
            const element = document.getElementById('mv_modal_add_viplist');
            const form = element.querySelector('#mv_modal_add_viplist_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'client_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Client is required'
                                }
                            }
                        },
                        'reason': {
                            validators: {
                                notEmpty: {
                                    message: 'Reason is required'
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
            const submitButton = element.querySelector('[data-mv-viplist-modal-action="submit"]');

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
                            $("#location_id").val($("#location").val());

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
            const cancelButton = element.querySelector('[data-mv-viplist-modal-action="cancel"]');
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
            const closeButton = element.querySelector('[data-mv-viplist-modal-action="close"]');
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

        const companyoptionFormat = (item) => {
            if (!item.id) {
                return item.text;
            }

            var span = document.createElement('span');
            var template = '';

            template += '<div class="d-flex align-items-center">';
            template += '<img src="' + item.element.getAttribute('data-mv-rich-content-icon') + '" class="rounded-circle h-40px me-3" alt="' + item.text + '"/>';
            template += '<div class="d-flex flex-column">'
            template += '<span class="fs-4 fw-bold lh-1">' + item.text + '</span>';
            // template += '<span class="text-muted fs-5">' + item.element.getAttribute('data-mv-rich-content-subcontent') + '</span>';
            template += '</div>';
            template += '</div>';

            span.innerHTML = template;

            return $(span);
        }

        function formatUser(item) {
            if (!item.id) {
                return item.text;
            }

            var span = document.createElement('span');
            var template = '';

            template += '<div class="d-flex align-items-center">';
            template += '<img src="' + item.avatar_url + '" class="rounded-circle h-40px me-3" alt="' + item.name + '"/>';
            template += '<div class="d-flex flex-column">'
            template += '<span class="fs-4 fw-bold lh-1">' + item.name + '</span>';
            template += '</div>';
            template += '</div>';

            span.innerHTML = template;

            return $(span);
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        return {
            // Public functions
            init: function() {
                table = document.querySelector('#viplist-table');
                // console.log(table);
                if (!table) {
                    return;
                }
                initVIPTable();
                initAddVIPUser();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVVIPActions.init();

        }, 1000);
    });
</script>