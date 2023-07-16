<script>
    // Class definition
    var MVBlacklistActions = function() {
        var datatable;
        var table;


        var initBlacklistTable = () => {

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
                MVMenu.createInstances();
                handleEditRows();
                handleViewRows();
            });

            //search bar    
            const filterSearch = document.querySelector('[data-mv-blacklist-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                var table = $('#blacklist-table').DataTable();
                table.search(e.target.value).draw();
            });

        }

        
        var handleEditRows = () => {
            console.log('here');
            // Shared variables
            const element = document.getElementById('mv_modal_edit_blacklist');
            const form = element.querySelector('#mv_modal_edit_blacklist_form');
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

            var _table = document.querySelector('#blacklist-table');
            const editButtons = _table.querySelectorAll('[data-mv-blacklist-table-filter="edit_row"]');

            editButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    const _id = parent.querySelectorAll('input[name=blacklist-id]')[0].value;
                    const block_reason = parent.querySelectorAll('input[name=blacklist-block_reason]')[0].value;
                    const clientname = parent.querySelectorAll('input[name=blacklist-clientname]')[0].value;
                    const clientphoto = parent.querySelectorAll('input[name=blacklist-clientphoto]')[0].value;
                    const block_date = parent.querySelectorAll('input[name=blacklist-block_date]')[0].value;

                    form.querySelector('input[name=blacklist_edit_id]').value = _id;
                    form.querySelector('span#block_reason').innerText = block_reason;
                    // form.querySelector('textarea[name=block_reason]').value = block_reason;
                    // form.querySelector('textarea[name=reason]').value = block_reason;
                    form.querySelector('span#span_clientname').innerText = clientname;
                    form.querySelector('img#clientphoto').src = clientphoto;
                    form.querySelector('span#span_blockedsince').innerText = block_date;

                    modal.show();

                });
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-blacklist-edit-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-blacklist-edit-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-blacklist-edit-modal-action="submit"]');

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
                            var id = $("#blacklist_edit_id").val();

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

        var handleViewRows = () => {
            console.log('here');
            // Shared variables
            const element = document.getElementById('mv_modal_view_blacklist');
            const form = element.querySelector('#mv_modal_view_blacklist_form');
            const modal = new bootstrap.Modal(element);
            
            var _table = document.querySelector('#blacklist-table');
            const viewButtons = _table.querySelectorAll('[data-mv-blacklist-table-filter="view_row"]');

            viewButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    const _id = parent.querySelectorAll('input[name=blacklist-id]')[0].value;
                    const block_reason = parent.querySelectorAll('input[name=blacklist-block_reason]')[0].value;
                    const unblock_reason = parent.querySelectorAll('input[name=blacklist-unblock_reason]')[0].value;
                    const clientname = parent.querySelectorAll('input[name=blacklist-clientname]')[0].value;
                    const clientphoto = parent.querySelectorAll('input[name=blacklist-clientphoto]')[0].value;
                    const block_date = parent.querySelectorAll('input[name=blacklist-block_date]')[0].value;
                    const unblock_date = parent.querySelectorAll('input[name=blacklist-unblock_date]')[0].value;

                    form.querySelector('input[name=blacklist_view_id]').value = _id;
                    form.querySelector('span#block_reason').innerText = block_reason;
                    form.querySelector('span#unblock_reason').innerText = unblock_reason;
                    // form.querySelector('textarea[name=block_reason]').value = block_reason;
                    // form.querySelector('textarea[name=reason]').value = block_reason;
                    form.querySelector('span#span_clientname').innerText = clientname;
                    form.querySelector('img#clientphoto').src = clientphoto;
                    form.querySelector('span#span_block_date').innerText = block_date;
                    form.querySelector('span#span_unblock_date').innerText = unblock_date;

                    if (unblock_reason == ""){
                        $("#unblock_reason_div").hide();
                    }else{
                        $("#unblock_reason_div").show();
                    }

                    if (unblock_date == ""){
                        $("#unblock_date_container").hide();
                    }else{
                        $("#unblock_date_container").show();
                    }

                    modal.show();

                });
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-blacklist-view-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-blacklist-view-modal-action="cancel"]');
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
        }

        var initBlockUser = () => {
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
            const element = document.getElementById('mv_modal_add_blacklist');
            const form = element.querySelector('#mv_modal_add_blacklist_form');
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
                        'duration': {
                            validators: {
                                notEmpty: {
                                    message: 'Duration is required'
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
            const submitButton = element.querySelector('[data-mv-blacklist-modal-action="submit"]');

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
                                },
                                error: function(xhr, status, error) {                                    
                                    // Remove loading indication
                                    submitButton.removeAttribute('data-mv-indicator');

                                    // Enable button
                                    submitButton.disabled = false;

                                    // Show failure alert
                                    Swal.fire({
                                        text: "Form submission failed. \n" + xhr.responseJSON.error,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
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
            const cancelButton = element.querySelector('[data-mv-blacklist-modal-action="cancel"]');
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
            const closeButton = element.querySelector('[data-mv-blacklist-modal-action="close"]');
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
                table = document.querySelector('#blacklist-table');
                // console.log(table);
                if (!table) {
                    return;
                }
                initBlacklistTable();
                initBlockUser();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVBlacklistActions.init();

        }, 1000);
    });
</script>