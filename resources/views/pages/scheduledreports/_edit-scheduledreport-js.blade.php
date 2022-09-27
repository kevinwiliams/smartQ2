<script>
	"use strict";

	// Class definition
	var MVEditScheduleReport = function() {
		// Elements
		var editmodal;
		var editmodalEl;

		var editstepper;
		var editform;
		var editformSubmitButton;
		var editformContinueButton;

		// Variables
		var editstepperObj;
		var validations = [];

		// Private Functions
		var initStepper = function() {
			// Initialize Stepper
			editstepperObj = new MVStepper(editstepper);

			// Stepper change event
			editstepperObj.on('mv.stepper.changed', function(editstepper) {
				if (editstepperObj.getCurrentStepIndex() === 4) {
					editformSubmitButton.classList.remove('d-none');
					editformSubmitButton.classList.add('d-inline-block');
					editformContinueButton.classList.add('d-none');
				} else if (editstepperObj.getCurrentStepIndex() === 5) {
					editformSubmitButton.classList.add('d-none');
					editformContinueButton.classList.add('d-none');
				} else {
					editformSubmitButton.classList.remove('d-inline-block');
					editformSubmitButton.classList.remove('d-none');
					editformContinueButton.classList.remove('d-none');
				}
			});

			// Validation before going to next page
			editstepperObj.on('mv.stepper.next', function(editstepper) {
				console.log('stepper.next');

				// Validate form before change stepper step
				var validator = validations[editstepper.getCurrentStepIndex() - 1]; // get validator for currnt step

				if (validator) {
					validator.validate().then(function(status) {
						console.log('validated!');

						if (status == 'Valid') {
							editstepper.goNext();

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
					editstepper.goNext();

					MVUtil.scrollTop();
				}
			});

			// Prev event
			editstepperObj.on('mv.stepper.previous', function(editstepper) {
				console.log('stepper.previous');

				editstepper.goPrevious();
				MVUtil.scrollTop();
			});
		}

		var handleForm = function() {
			editformSubmitButton.addEventListener('click', function(e) {
				// Validate form before change stepper step
				var validator = validations[2]; // get validator for last form

				validator.validate().then(function(status) {
					console.log('validated!');

					if (status == 'Valid') {
						// Prevent default button action
						e.preventDefault();

						// Disable button to avoid multiple click 
						editformSubmitButton.disabled = true;

						// Show loading indication
						editformSubmitButton.setAttribute('data-mv-indicator', 'on');

						// Simulate form submission
						// setTimeout(function() {
						// 	// Hide loading indication
						// 	formSubmitButton.removeAttribute('data-mv-indicator');

						// 	// Enable button
						// 	formSubmitButton.disabled = false;

						// 	stepperObj.goNext();
						// }, 2000);
						var id = $('#mv_edit_scheduledreport_form input[name="id"]').val();
						$.ajax({
							url: editform.action + "/" + id,
							type: editform.method,
							dataType: 'json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							contentType: false,
							cache: false,
							processData: false,
							data: new FormData(editform),
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
								editformSubmitButton.removeAttribute('data-mv-indicator');

								// Enable button
								editformSubmitButton.disabled = false;

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
								editformSubmitButton.removeAttribute('data-mv-indicator');

								// Enable button
								editformSubmitButton.disabled = false;
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
				editform, {
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
				editform, {
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
				editform, {
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
				editform, {
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
			$("#edit_start_date").flatpickr({
				altInput: true,
				altFormat: "F j, Y h:i K",
				enableTime: true,
				dateFormat: "Y-m-d h:i K" //,
				// minDate: "today"
			});

			$("#edit_daily_end_date,#edit_weekly_end_date,#edit_monthly_end_date").flatpickr({
				altInput: true,
				altFormat: "F j, Y",
				dateFormat: "Y-m-d" //,
				// minDate: "today"
			});



			$("#mv_edit_scheduledreport_form input[type=radio][id$='_edit_schedule_type']").on('change', function(e) {
				var type = $(this).val();
				$("div[id$='_edit_schedule_div']").hide();
				$("#" + type + "_edit_schedule_div").show();
			});

			$('#mv_edit_scheduledreport_form input[type="radio"][value="one time"]').prop("checked", true);
			// $('input[type="radio"][value="one time"]').trigger('change');

			$('#edit_monthly_months_on1').on('change', function(e) {
				// console.log($(this).is(":checked"));	

				$("#edit_monthly_days").prop('disabled', false);
				$("#edit_monthly_ordinal").prop('disabled', true);
				$("#edit_monthly_weekday").prop('disabled', true);
			});
			$('#edit_monthly_months_on2').on('change', function(e) {
				// console.log($(this).is(":checked"));	
				$("#edit_monthly_days").prop('disabled', true);
				$("#edit_monthly_ordinal").prop('disabled', false);
				$("#edit_monthly_weekday").prop('disabled', false);
			});
			$('#edit_monthly_months_on1').trigger('change');

			$("#edit_start_date").on('change', function(e) {
				var _date = $(this).val();
				$("#edit_date_range").flatpickr({
					mode: "range",
					maxDate: _date,
					dateFormat: "Y-m-d"
				});

				$("#edit_daily_end_date,#edit_weekly_end_date,#edit_monthly_end_date").flatpickr({
					altInput: true,
					altFormat: "F j, Y",
					dateFormat: "Y-m-d",
					minDate: _date
				});
			});

			var input1 = document.querySelector("#edit_notify");
			new Tagify(input1, {
				pattern: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
			});

			// modal open with token id
			$('#mv_modal_edit_scheduledreport').on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget);
				var scheduleid = button.data('scheduledreport-id');
				// alert(scheduleid);
				// return;
				editform.reset();
				$.ajax({
					url: '/reports/scheduled/show/' + scheduleid,
					data: {
						_token: $("input[name=_token]").val()
					},
					success: function(res) {
						console.log(res);
						// console.log(editstepper);

						editstepperObj.goFirst();
						$('#mv_edit_scheduledreport_form input[name="id"]').val(res.id);
						$('#mv_edit_scheduledreport_form input[name="name"]').val(res.name);
						$('#mv_edit_scheduledreport_form select[name="report_id"]').val(res.report_id);
						$('#mv_edit_scheduledreport_form select[name="report_id"]').trigger('change');
						$('#mv_edit_scheduledreport_form input[name="active"]').prop("checked", (res.active == 1) ? true : false);
						// $('#edit_start_date').val(res.start_date);
						$("#edit_start_date").flatpickr({
							altInput: true,
							altFormat: "F j, Y h:i K",
							enableTime: true,
							dateFormat: "Y-m-d h:i K",
							defaultDate: res.start_date,
							minDate: res.start_date
						});

						$("#mv_edit_scheduledreport_form input[type=radio][id$='_edit_schedule_type']").each(function() {
							$(this).closest('label').removeClass('active');
						});

						$("#mv_edit_scheduledreport_form input[type=radio][id$='_edit_schedule_type']").each(function() {
							if($(this).val() == res.schedule_type){
								$(this).prop("checked", true);
								$(this).closest('label').addClass('active');
								$(this).trigger('change');
							}
						}); 

						$("#" + res.schedule_type + "_edit_schedule_type").trigger('change');
						var scheduleinfo = JSON.parse(res.schedule_info);
						console.log(scheduleinfo);
						switch (res.schedule_type) {
							case 'daily':
								$('#mv_edit_scheduledreport_form input[name="daily_recurs"]').val(scheduleinfo.recurs);
								$("#edit_daily_end_date").flatpickr({
									altInput: true,
									altFormat: "F j, Y",									
									dateFormat: "Y-m-d",
									defaultDate: scheduleinfo.end_date,
									minDate: res.start_date
								});
								break;
							case 'weekly':
								$('#mv_edit_scheduledreport_form input[name="weekly_recurs"]').val(scheduleinfo.recurs);
								$("#edit_weekly_end_date").flatpickr({
									altInput: true,
									altFormat: "F j, Y",									
									dateFormat: "Y-m-d",
									defaultDate: scheduleinfo.end_date,
									minDate: res.start_date
								});
								$('#edit_weekly_dayname').val(scheduleinfo.weekdays);
								$('#edit_weekly_dayname').trigger('change');
								
								break;
							case 'monthly':
								$('#edit_monthly_months').val(scheduleinfo.months);
								$('#edit_monthly_months').trigger('change');
								$("#edit_monthly_end_date").flatpickr({
									altInput: true,
									altFormat: "F j, Y",									
									dateFormat: "Y-m-d",
									defaultDate: scheduleinfo.end_date,
									minDate: res.start_date
								});

								if (scheduleinfo.months_on == "ordinals") {
									$("#edit_monthly_months_on2").prop('checked', true);
									$("#edit_monthly_months_on2").trigger('change');
									$('#edit_monthly_ordinal').val(scheduleinfo.ordinal);
									$("#edit_monthly_ordinal").trigger('change');
									$('#edit_monthly_weekday').val(scheduleinfo.weekday);
									$("#edit_monthly_weekday").trigger('change');
								} else {
									$("#edit_monthly_months_on1").prop('checked', true);
									$("#edit_monthly_months_on1").trigger('change');
									$('#edit_monthly_days').val(scheduleinfo.months_days);
									$("#edit_monthly_days").trigger('change');
								}
								break;

							default:
								break;
						}

						$("#edit_date_range").flatpickr({
							mode: "range",
							maxDate: res.start_date,
							dateFormat: "Y-m-d",
							defaultDate: scheduleinfo.date_range
						});

						$('#edit_location_id').val(scheduleinfo.locations);
						$("#edit_location_id").trigger('change');

						$('#edit_notify').val(res.email_to);
						$("#edit_notify").trigger('change');


					}
				}).fail(function(jqXHR, textStatus, error) {
					// Handle error here
					console.log(jqXHR.responseText);
					console.log(error);
				});
			});
		}

		return {
			// Public Functions
			init: function() {
				// Elements
				editmodalEl = document.querySelector('#mv_modal_edit_scheduledreport');

				if (editmodalEl) {
					editmodal = new bootstrap.Modal(editmodalEl);
				}

				editstepper = document.querySelector('#mv_edit_scheduledreport_stepper');

				if (!editstepper) {
					return;
				}

				editform = editstepper.querySelector('#mv_edit_scheduledreport_form');
				editformSubmitButton = editstepper.querySelector('[data-mv-stepper-action="submit"]');
				editformContinueButton = editstepper.querySelector('[data-mv-stepper-action="next"]');

				initStepper();
				initValidation();
				handleForm();
				initSetup();

			}
		};
	}();

	// On document ready
	MVUtil.onDOMContentLoaded(function() {
		MVEditScheduleReport.init();
	});
</script>