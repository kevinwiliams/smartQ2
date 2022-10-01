<script>
    // Class definition
    var MVVisitReasonActions = function() {
        var datatable;
        var table;

        // Init add schedule modal
        var handleEditRows = () => {
            // Shared variables
            const element = document.getElementById('mv_modal_edit_reasonforvisitcounter');
            const form = element.querySelector('#mv_modal_edit_reasonforvisitcounter_form');
            const modal = new bootstrap.Modal(element);

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'counter_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Counter is required'
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

            var _table = document.querySelector('#visitreasoncounter-table');
            const editButtons = _table.querySelectorAll('[data-mv-visitreasoncounter-table-filter="edit_row"]');


            editButtons.forEach(d => {

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    var deptid = $(this).data('department-id');
                    var counterid = $(this).data('counter-id');
                    var idlist = $(this).data('reasons');
                    console.log(deptid);
                    console.log(counterid);
                    console.log(idlist);
                    // Select parent row
                    // const parent = e.target.closest('tr');
                    // alert('click');
                    $('#mv_modal_edit_reasonforvisitcounter_form input[id=counter_id]').val(counterid);
                    modal.show();
                    // console.log(form.querySelector('input[name=id]'));
                    // return;
                    var options = form.querySelectorAll('select[id=reason_id] option');
                    options.forEach(o => o.remove());

                    $.ajax({
                        url: '{{ URL::to("location/visitreason/reasonsforvisit") }}/' + deptid,
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

                            form.querySelector('select[id=reason_id]').append(new Option("Select a reason", ""));
                            data.data.forEach(element => {
                                // console.log(element);
                                form.querySelector('select[id=reason_id]').append(new Option(element.reason, element.id));
                            });

                            $('#mv_modal_edit_reasonforvisitcounter_form select[id=reason_id]').val(idlist);
                            $('#mv_modal_edit_reasonforvisitcounter_form select[name=reason_id]').trigger('change');
                        }

                    });
                    // var _id = parent.querySelectorAll('input[name=company-id]')[0].value;
                    // var _name = parent.querySelectorAll('input[name=company-name]')[0].value;
                    // var _address = parent.querySelectorAll('input[name=company-address]')[0].value;
                    // var _website = parent.querySelectorAll('input[name=company-website]')[0].value;
                    // var _email = parent.querySelectorAll('input[name=company-email]')[0].value;
                    // var _phone = parent.querySelectorAll('input[name=company-phone]')[0].value;
                    // var _contact_person = parent.querySelectorAll('input[name=company-contact_person]')[0].value;
                    // var _description = parent.querySelectorAll('input[name=company-description]')[0].value;
                    // var _active = parent.querySelectorAll('input[name=company-active]')[0].value;

                    // form.querySelector('input[name=company_edit_id]').value = _id;
                    // form.querySelector('input[name=name]').value = _name;
                    // form.querySelector('input[name=address]').value = _address;
                    // form.querySelector('input[name=website]').value = _website;
                    // form.querySelector('input[name=email]').value = _email;
                    // form.querySelector('input[name=phone]').value = _phone;
                    // form.querySelector('input[name=contact_person]').value = _contact_person;
                    // form.querySelector('textarea[name=description]').value = _description;
                    // $('#edit_active').prop("checked", _active);

                });
            });


            // Close button handler
            const closeButton = element.querySelector('[data-mv-visitreasoncounter-edit-modal-action="close"]');
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
            const cancelButton = element.querySelector('[data-mv-visitreasoncounter-edit-modal-action="cancel"]');
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
            const submitButton = element.querySelector('[data-mv-visitreasoncounter-edit-modal-action="submit"]');

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

                            var id = $('#mv_modal_edit_reasonforvisitcounter_form input[id=counter_id]').val();
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
                            }).fail(function(jqXHR, textStatus, error) {
                                // Remove loading indication
                                submitButton.removeAttribute('data-mv-indicator');

                                // Enable button
                                submitButton.disabled = false;

                                // Handle error here
                                Swal.fire({
                                    text: "Error.<br>" + jqXHR.responseText + "<br>" + error,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            });;
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
                table = document.querySelector('#visitreasoncounter-table');
                // console.log(table);
                if (!table) {
                    return;
                }
                handleEditRows();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVVisitReasonActions.init();

        }, 1000);
    });
</script>