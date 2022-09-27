<script>
	"use strict";

	// Class definition
	var MVCreateAccount = function() {
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
			// Initialize Stepper
			stepperObj = new MVStepper(stepper);

			// Stepper change event
			stepperObj.on('mv.stepper.changed', function(stepper) {
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
				console.log('stepper.next');

				// Validate form before change stepper step
				var validator = validations[stepper.getCurrentStepIndex() - 1]; // get validator for currnt step

				if (validator) {
					validator.validate().then(function(status) {
						console.log('validated!');

						if (status == 'Valid') {
							stepper.goNext();

							MVUtil.scrollTop();
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
				var validator = validations[2]; // get validator for last form

				validator.validate().then(function(status) {
					console.log('validated!');

					if (status == 'Valid') {
						// Prevent default button action
						e.preventDefault();

						// Disable button to avoid multiple click 
						formSubmitButton.disabled = true;

						// Show loading indication
						formSubmitButton.setAttribute('data-mv-indicator', 'on');

						// Simulate form submission
						// setTimeout(function() {
						// 	// Hide loading indication
						// 	formSubmitButton.removeAttribute('data-mv-indicator');

						// 	// Enable button
						// 	formSubmitButton.disabled = false;

						// 	stepperObj.goNext();
						// }, 2000);
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
								formSubmitButton.removeAttribute('data-mv-indicator');

								// Enable button
								formSubmitButton.disabled = false;

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
										document.location.href = '/reports/scheduled';
										// form.reset();
										// modal.hide();
									}
								});
							},
							error: function(xhr) {
								// Remove loading indication
								formSubmitButton.removeAttribute('data-mv-indicator');

								// Enable button
								formSubmitButton.disabled = false;
								Swal.fire({
									text: 'Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText,
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
						Swal.fire({
							text: "Sorry, looks like there are some errors detected, please try again.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn btn-light"
							}
						}).then(function() {
							// MVUtil.scrollTop();
						});
					}
				});
			});

			// // Expiry month. For more info, plase visit the official plugin site: https://select2.org/
			// $(form.querySelector('[name="card_expiry_month"]')).on('change', function() {
			// 	// Revalidate the field when an option is chosen
			// 	validations[3].revalidateField('card_expiry_month');
			// });

			// // Expiry year. For more info, plase visit the official plugin site: https://select2.org/
			// $(form.querySelector('[name="card_expiry_year"]')).on('change', function() {
			// 	// Revalidate the field when an option is chosen
			// 	validations[3].revalidateField('card_expiry_year');
			// });

			// // Expiry year. For more info, plase visit the official plugin site: https://select2.org/
			// $(form.querySelector('[name="business_type"]')).on('change', function() {
			// 	// Revalidate the field when an option is chosen
			// 	validations[2].revalidateField('business_type');
			// });
		}

		var initValidation = function() {
			// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
			// Step 1
			validations.push(FormValidation.formValidation(
				form, {
					fields: {
						name: {
							validators: {
								notEmpty: {
									message: 'Schedule Name is required'
								}
							}
						},
						report_id: {
							validators: {
								notEmpty: {
									message: 'Report is required'
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
			));

			// Step 2
			validations.push(FormValidation.formValidation(
				form, {
					fields: {
						'schedule_type': {
							validators: {
								notEmpty: {
									message: 'Schedule type is required'
								}
							}
						},
						'start_date': {
							validators: {
								notEmpty: {
									message: 'Start date is required'
								}
							}
						}
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

			// Step 3
			validations.push(FormValidation.formValidation(
				form, {
					fields: {
						'date_range': {
							validators: {
								notEmpty: {
									message: 'Date range is required'
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
						'notify': {
							validators: {
								notEmpty: {
									message: 'Emails to notify are required'
								}
							}
						}
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

			// Step 4
			validations.push(FormValidation.formValidation(
				form, {
					fields: {
						'card_name': {
							validators: {
								notEmpty: {
									message: 'Name on card is required'
								}
							}
						},
						'card_number': {
							validators: {
								notEmpty: {
									message: 'Card member is required'
								},
								creditCard: {
									message: 'Card number is not valid'
								}
							}
						},
						'card_expiry_month': {
							validators: {
								notEmpty: {
									message: 'Month is required'
								}
							}
						},
						'card_expiry_year': {
							validators: {
								notEmpty: {
									message: 'Year is required'
								}
							}
						},
						'card_cvv': {
							validators: {
								notEmpty: {
									message: 'CVV is required'
								},
								digits: {
									message: 'CVV must contain only digits'
								},
								stringLength: {
									min: 3,
									max: 4,
									message: 'CVV must contain 3 to 4 digits only'
								}
							}
						}
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
		}

		var initSetup = function() {
			$("#start_date").flatpickr({
				altInput: true,
				altFormat: "F j, Y h:i K",
				enableTime: true,
				dateFormat: "Y-m-d h:i K",
				minDate: "today"
			});

			$("#daily_end_date,#weekly_end_date,#monthly_end_date").flatpickr({
				altInput: true,
				altFormat: "F j, Y",				
				dateFormat: "Y-m-d",
				minDate: "today"
			});		

			
			$('#mv_create_account_form input[type=radio][name=schedule_type]').on('change', function(e) {
				var type = $(this).val();
				$("#mv_create_account_form div[id$='_schedule_div']").hide();
				$("#" + type + "_schedule_div").show();
			});

			// $('input[type=radio][name=schedule_type]').trigger('change');
			$('#mv_create_account_form input[type="radio"][value="one time"]').prop("checked", true);
			// $('input[type="radio"][value="one time"]').trigger('change');

			$('#monthly_months_on1').on('change', function(e) {
				// console.log($(this).is(":checked"));	

				$("#monthly_days").prop('disabled', false);
				$("#monthly_ordinal").prop('disabled', true);
				$("#monthly_weekday").prop('disabled', true);
			});
			$('#monthly_months_on2').on('change', function(e) {
				// console.log($(this).is(":checked"));	
				$("#monthly_days").prop('disabled', true);
				$("#monthly_ordinal").prop('disabled', false);
				$("#monthly_weekday").prop('disabled', false);
			});
			$('#monthly_months_on1').trigger('change');

			$("#start_date").on('change', function(e) {
				var _date = $(this).val();
				$("#date_range").flatpickr({
					mode: "range",
					maxDate: _date,
					dateFormat: "Y-m-d"
				});

				$("#daily_end_date,#weekly_end_date,#monthly_end_date").flatpickr({
				altInput: true,
				altFormat: "F j, Y",				
				dateFormat: "Y-m-d",
				minDate: _date
			});
			});

			var input1 = document.querySelector("#notify");
			new Tagify(input1, {
				pattern: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
			});
		}

		return {
			// Public Functions
			init: function() {
				// Elements
				modalEl = document.querySelector('#mv_modal_add_scheduledreport');

				if (modalEl) {
					modal = new bootstrap.Modal(modalEl);
				}

				stepper = document.querySelector('#mv_create_scheduledreport_stepper');

				if (!stepper) {
					return;
				}

				form = stepper.querySelector('#mv_create_account_form');
				formSubmitButton = stepper.querySelector('[data-mv-stepper-action="submit"]');
				formContinueButton = stepper.querySelector('[data-mv-stepper-action="next"]');

				initStepper();
				initValidation();
				handleForm();
				initSetup();

			}
		};
	}();

	// On document ready
	MVUtil.onDOMContentLoaded(function() {
		MVCreateAccount.init();
	});
</script>