<script>
    // Class definition
    var MVCreateToken = function() {
        // Elements
        var modal;
        var modalEl;

        var stepper;
        var form;
        var formSubmitButton;
        var formContinueButton;

        // Variables
        var stepperObj;
        var validations = [];

        // Private Functions
        var initStepper = function() {

            // Placeholder
            Inputmask({
                "mask": "1 (999) 999-9999",
            }).mask("[name='phone']");
            // Initialize Stepper
            stepperObj = new MVStepper(stepper);

            // Stepper change event
            stepperObj.on('mv.stepper.changed', function(stepper) {
                console.log(stepperObj.getCurrentStepIndex());
                if (stepperObj.getCurrentStepIndex() === 2) {
                    $('[data-mv-stepper-action="next"]').addClass('disabled');
                }


                if (stepperObj.getCurrentStepIndex() === 4) {
                    formSubmitButton.classList.remove('d-none');
                    formSubmitButton.classList.add('d-inline-block');
                    formContinueButton.classList.add('d-none');
                } else if (stepperObj.getCurrentStepIndex() === 5) {
                    formSubmitButton.classList.add('d-none');
                    formContinueButton.classList.add('d-none');
                } else {
                    formSubmitButton.classList.remove('d-inline-block');
                    formSubmitButton.classList.remove('d-none');
                    formContinueButton.classList.remove('d-none');
                }
            });

            // Validation before going to next page
            stepperObj.on('mv.stepper.next', function(stepper) {
                console.log('stepper.next', stepper.getCurrentStepIndex());

                if (stepper.getCurrentStepIndex() == 1) {
                    // Enable or disable validators for the `email` field
                    var visitreason = $("#visitreason").val();
                    // console.log("visitreason:" + visitreason);
                    (visitreason == 1) ? validations[0].disableValidator('department_id'): validations[0].enableValidator('department_id');
                    (visitreason == 0) ? validations[0].disableValidator('reason_id'): validations[0].enableValidator('reason_id');
                    // console.log("visitreason:" + visitreason);
                    // console.log(validations[2].getFields());
                }

                // Validate form before change stepper step
                var validator = validations[stepper.getCurrentStepIndex() - 1]; // get validator for currnt step

                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            if (stepper.getCurrentStepIndex() == 1) {
                                Swal.fire({
                                    text: 'Are you willing the wait?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: "Yes I am",
                                    cancelButtonText: 'Nope, cancel it',
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                        cancelButton: 'btn btn-danger'
                                    }
                                }).then(function(value) {
                                    if (value.isConfirmed) {
                                        var location = $('#mv_location_list').val(); //
                                        var dept = $('input[name=department_id]:checked').val();
                                        var reason = $('select[name="reason_id"]').val();
                                        var note = $('#userNote').val();
                                        var lat = '';//$('#lat').val();
                                        var lng = '';//$('#lng').val();
                                        const element = document.getElementById('mv_create_token_stepper');
                                        const form = element.querySelector('#mv_create_token_form');

                                        console.log("location: " + location);
                                        console.log("dept: " + dept);
                                        console.log("reason: " + reason);
                                        console.log("note: " + note);
                                        console.log("form.action: " + form.action);

                                        $.ajax({
                                            url: form.action,
                                            type: form.method,
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            dataType: 'json',
                                            data: {
                                                'location': location,
                                                'department_id': dept,
                                                'reason_id': reason,
                                                'note': note,
                                                'lat': lat,
                                                'lng': lng,
                                            },
                                            success: function(data) {
                                                if (data.status == true) {
                                                    var msg = "You are #" + data.position + " in the line";
                                                    $("#tkn_position").text(msg);
                                                    $("#tkn_number").text(data.token.token_no);
                                                    $("#tkn_id").val(data.token.id);
                                                    stepper.goNext();
                                                    MVUtil.scrollTop();
                                                    $('[data-mv-stepper-action="previous"]').addClass('disabled');

                                                }

                                            }
                                        });
                                    }
                                });
                            } else {
                                stepper.goNext();
                                MVUtil.scrollTop();
                            }



                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-light"
                                }
                            }).then(function() {
                                MVUtil.scrollTop();
                            });
                        }
                    });
                } else {
                    stepper.goNext();

                    MVUtil.scrollTop();
                }
            });

            // Prev event
            stepperObj.on('mv.stepper.previous', function(stepper) {
                console.log('stepper.previous');

                stepper.goPrevious();
                MVUtil.scrollTop();
            });
        }

        var handleForm = function() {
            formSubmitButton.addEventListener('click', function(e) {
                // Validate form before change stepper step
                // document.location.href = '/home/list';
                document.location.href = '/home/current/' + $("#tkn_id").val();

            });
        }

        var initValidation = function() {
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            // Step 1
            // validations.push(FormValidation.formValidation(
            //     form, {
            //         fields: {
            //             company_id: {
            //                 validators: {
            //                     notEmpty: {
            //                         message: 'Please a Company!'
            //                     }
            //                 }
            //             }
            //         },
            //         plugins: {
            //             trigger: new FormValidation.plugins.Trigger(),
            //             bootstrap: new FormValidation.plugins.Bootstrap5({
            //                 rowSelector: '.fv-row',
            //                 eleInvalidClass: '',
            //                 eleValidClass: ''
            //             })
            //         }
            //     }
            // ));

            // // Step 2
            // validations.push(FormValidation.formValidation(
            //     form, {
            //         fields: {
            //             alert_type: {
            //                 validators: {
            //                     notEmpty: {
            //                         message: 'Please choose a way for us to alert you!'
            //                     }
            //                 }
            //             }
            //         },
            //         plugins: {
            //             trigger: new FormValidation.plugins.Trigger(),
            //             bootstrap: new FormValidation.plugins.Bootstrap5({
            //                 rowSelector: '.fv-row',
            //                 eleInvalidClass: '',
            //                 eleValidClass: ''
            //             })
            //         }
            //     }
            // ));

            // Step 3
            validations.push(FormValidation.formValidation(
                form, {
                    fields: {
                        department_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Please choose a department'
                                }
                            }
                        },
                        reason_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Please choose a service'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            ));

            // // Step 3
            // validations.push(FormValidation.formValidation(
            // 	form,
            // 	{
            // 		fields: {
            // 			'business_name': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Busines name is required'
            // 					}
            // 				}
            // 			},
            // 			'business_descriptor': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Busines descriptor is required'
            // 					}
            // 				}
            // 			},
            // 			'business_type': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Busines type is required'
            // 					}
            // 				}
            // 			},
            // 			'business_description': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Busines description is required'
            // 					}
            // 				}
            // 			},
            // 			'business_email': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Busines email is required'
            // 					},
            // 					emailAddress: {
            // 						message: 'The value is not a valid email address'
            // 					}
            // 				}
            // 			}
            // 		},
            // 		plugins: {
            // 			trigger: new FormValidation.plugins.Trigger(),
            // 			// Bootstrap Framework Integration
            // 			bootstrap: new FormValidation.plugins.Bootstrap5({
            // 				rowSelector: '.fv-row',
            //                 eleInvalidClass: '',
            //                 eleValidClass: ''
            // 			})
            // 		}
            // 	}
            // ));

            // // Step 4
            // validations.push(FormValidation.formValidation(
            // 	form,
            // 	{
            // 		fields: {
            // 			'card_name': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Name on card is required'
            // 					}
            // 				}
            // 			},
            // 			'card_number': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Card member is required'
            // 					},
            //                     creditCard: {
            //                         message: 'Card number is not valid'
            //                     }
            // 				}
            // 			},
            // 			'card_expiry_month': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Month is required'
            // 					}
            // 				}
            // 			},
            // 			'card_expiry_year': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'Year is required'
            // 					}
            // 				}
            // 			},
            // 			'card_cvv': {
            // 				validators: {
            // 					notEmpty: {
            // 						message: 'CVV is required'
            // 					},
            // 					digits: {
            // 						message: 'CVV must contain only digits'
            // 					},
            // 					stringLength: {
            // 						min: 3,
            // 						max: 4,
            // 						message: 'CVV must contain 3 to 4 digits only'
            // 					}
            // 				}
            // 			}
            // 		},

            // 		plugins: {
            // 			trigger: new FormValidation.plugins.Trigger(),
            // 			// Bootstrap Framework Integration
            // 			bootstrap: new FormValidation.plugins.Bootstrap5({
            // 				rowSelector: '.fv-row',
            //                 eleInvalidClass: '',
            //                 eleValidClass: ''
            // 			})
            // 		}
            // 	}
            // ));
        }

        var handleFormSubmit = function() {

        }

        return {
            // Public Functions
            init: function() {
                // Elements


                stepper = document.querySelector('#mv_create_token_stepper');
                form = stepper.querySelector('#mv_create_token_form');
                formSubmitButton = stepper.querySelector('[data-mv-stepper-action="submit"]');
                formContinueButton = stepper.querySelector('[data-mv-stepper-action="next"]');

                initStepper();
                initValidation();
                handleForm();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        MVCreateToken.init();
    });
</script>