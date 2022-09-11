<script>
    // Class definition
    var MVTokenAddToken = function() {
        // Shared variables
        const element = document.getElementById('mv_modal_add_token');
        const form = element.querySelector('#mv_modal_add_token_form');
        const modal = new bootstrap.Modal(element);


        // Init add schedule modal
        var initAddUser = () => {

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'client_mobile': {
                            validators: {
                                notEmpty: {
                                    message: 'Client Mobile is required'
                                }
                            }
                        },
                        'department_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Department is required'
                                }
                            }
                        },
                        'counter_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Counter is required'
                                }
                            }
                        },
                        'user_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Officer is required'
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
            const submitButton = element.querySelector('[data-mv-tokens-modal-action="submit"]');
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

                                    // // Show popup confirmation 
                                    // Swal.fire({
                                    //     text: "Form has been successfully submitted!",
                                    //     icon: "success",
                                    //     buttonsStyling: false,
                                    //     confirmButtonText: "Ok, got it!",
                                    //     customClass: {
                                    //         confirmButton: "btn btn-primary"
                                    //     }
                                    // }).then(function (result) {
                                    //     if (result.isConfirmed) {     
                                    //         document.location.href = '/token/auto';                              
                                    //         form.reset();
                                    //         modal.hide();
                                    //     }
                                    // });
                                    if (data.status) {

                                        var content = "";
                                        content += "<div class=\"float-left\">";
                                        content += "<h1>#" + data.token.token_no + "</h1>";
                                        content += "<ul class=\"list-unstyled\">";
                                        // content += "<li><strong>{{ trans('app.location') }}: </strong>"+data.token.location+"</li>";
                                        content += "<li><strong>{{ trans('app.department') }}: </strong>" + data.token.department + "</li>";
                                        content += "<li><strong>{{ trans('app.counter') }}: </strong>" + data.token.counter + "</li>";
                                        content += "<li><strong>{{ trans('app.officer') }}: </strong>" + data.token.firstname + ' ' + data.token.lastname + "</li>";
                                        content += "<li><strong>{{ trans('app.date') }}: </strong>" + data.token.created_at + "</li>";
                                        content += "</ul>";
                                        content += "</div>";

                                        // print 
                                        //printThis(content);

                                        Swal.fire({
                                            // html: "You have created " + data.token.token_no + "<br>"+
                                            // "Assigned to: "+data.token.firstname+' '+data.token.lastname+ "<br>"+
                                            // "("++") <br>"+
                                            // "Counter : " + ,
                                            html: content,
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function(result) {
                                            if (result.isConfirmed) {
                                                document.location.href = '/token/current';
                                                // form.reset();
                                                // modal.hide();
                                            }
                                        });

                                        $("input[name=client_mobile]").val("");
                                        $("textarea[name=note]").val("");
                                    }
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
            const cancelButton = element.querySelector('[data-mv-tokens-modal-action="cancel"]');
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
            const closeButton = element.querySelector('[data-mv-tokens-modal-action="close"]');
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

              //fetch counters on department change
              $('#mv_modal_add_token_form select[name="department_id"]').on('change', function() {
                console.log(this.value);
                _counterDDL = $('#mv_modal_add_token_form select[name="counter_id"]');
                $.ajax({
                    url: '/location/counter/getCountersbyDept/' + this.value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        _counterDDL.children().remove();
                        //loop through response array
                        $.each(data, function() {
                            //create new option and add to select
                            var $opt = $('<option/>');
                            $opt.val(this.id);
                            $opt.text(this.name);
                            _counterDDL.append($opt);
                        });
                        _counterDDL.select2();
                        _counterDDL.trigger('change');
                    },
                    error: function(err) {
                        // alert('failed!');
                        console.log(err);
                    }
                });
            });

            //fetch officers on counter change
            $('#mv_modal_add_token_form select[name="counter_id"]').on('change', function() {
                console.log(this.value);
                _officerDDL = $('#mv_modal_add_token_form select[name="user_id"]');
                $.ajax({
                    url: '/location/getOfficersByCounter/' + this.value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        _officerDDL.children().remove();
                        //loop through response array
                        $.each(data, function() {
                            //create new option and add to select
                            var $opt = $('<option/>');
                            $opt.val(this.id);
                            $opt.text(this.full_name);
                            _officerDDL.append($opt);
                        });
                        _officerDDL.select2();
                    },
                    error: function(err) {
                        // alert('failed!');
                        console.log(err);
                    }
                });
            });
        }

        return {
            // Public functions
            init: function() {
                initAddUser();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            MVTokenAddToken.init();

        }, 1000);
    });
</script>