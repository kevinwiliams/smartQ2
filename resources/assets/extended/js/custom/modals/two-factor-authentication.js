"use strict";

// Class definition
var MVModalTwoFactorAuthentication = function () {
    // Private variables
    var modal;
    var modalObject;

    var optionsWrapper;
    var optionsSelectButton;

    var smsWrapper;
    var smsForm;
    var smsSubmitButton;
    var smsCancelButton;
    var smsValidator;

    var emailWrapper;
    var emailForm;
    var emailSubmitButton;
    var emailCancelButton;
    var emailValidator;


	var codeWrapper;
    var codeForm;
    var codeSubmitButton;
    var codeCancelButton;
    var codeValidator;

    // Private functions
    var handleOptionsForm = function() {
        // Handle options selection
        optionsSelectButton.addEventListener('click', function (e) {
            e.preventDefault();
            var option = optionsWrapper.querySelector('[name="auth_option"]:checked');

            optionsWrapper.classList.add('d-none');

            if (option.value == 'sms') {
                smsWrapper.classList.remove('d-none');
            } else {
                emailWrapper.classList.remove('d-none');
            }
        });
    }

	var showOptionsForm = function() {
		optionsWrapper.classList.remove('d-none');
		smsWrapper.classList.add('d-none');
		emailWrapper.classList.add('d-none');
		codeWrapper.classList.add('d-none');
    }

    var handleSMSForm = function() {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		smsValidator = FormValidation.formValidation(
			smsForm,
			{
				fields: {
					'mobile': {
						validators: {
							notEmpty: {
								message: 'Mobile no is required'
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

        // Handle apps submition
        smsSubmitButton.addEventListener('click', function (e) {
            e.preventDefault();

			// Validate form before submit
			if (smsValidator) {
				smsValidator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						// Show loading indication
						smsSubmitButton.setAttribute('data-mv-indicator', 'on');

						// Disable button to avoid multiple click
						smsSubmitButton.disabled = true;

						// Get the input field within the emailForm
						var mobileValue = smsForm.querySelector('[name="mobile"]').value; 

						Swal.fire({
							html: "Are you sure?.",
							icon: "warning",
							buttonsStyling: false,
							confirmButtonText: "Aww, yeah!",
							customClass: {
								confirmButton: "btn btn-light"
							}
						}).then(function(value) {
							if (value.isConfirmed) {
								$.ajax({
									type: smsForm.method,
									url: smsForm.action,									
									headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									},
									dataType: 'json',
									data: {
										'phone': mobileValue										
									},
									success: function(data) {										
										smsSubmitButton.removeAttribute('data-mv-indicator');

										// Enable button
										smsSubmitButton.disabled = false;
										
										smsWrapper.classList.add('d-none');

										$('[data-mv-element="code-form"] #type').val('email');
										codeWrapper.classList.remove('d-none');
									}
								});
							}else{
								smsSubmitButton.removeAttribute('data-mv-indicator');

								// Enable button
								smsSubmitButton.disabled = false;
								modalObject.hide();
								showOptionsForm();
							}});
					} else {
						// Show error message.
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

        // Handle sms cancelation
        smsCancelButton.addEventListener('click', function (e) {
            e.preventDefault();
            var option = optionsWrapper.querySelector('[name="auth_option"]:checked');

            optionsWrapper.classList.remove('d-none');
            smsWrapper.classList.add('d-none');
        });
    }

    var handleEmailForm = function() {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		emailValidator = FormValidation.formValidation(
			emailForm,
			{
				fields: {
					'code': {
						validators: {
							notEmpty: {
								message: 'Code is required'
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

        // Handle apps submition
        emailSubmitButton.addEventListener('click', function (e) {
            e.preventDefault();

			// Validate form before submit
			if (emailValidator) {
				emailValidator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						emailSubmitButton.setAttribute('data-mv-indicator', 'on');

						// Disable button to avoid multiple click
						emailSubmitButton.disabled = true;

						// Get the input field within the emailForm
						var emailValue = emailForm.querySelector('[name="emailAddress"]').value; 

						Swal.fire({
							html: "Are you sure?.",
							icon: "warning",
							buttonsStyling: false,
							confirmButtonText: "Aww, yeah!",
							customClass: {
								confirmButton: "btn btn-light"
							}
						}).then(function(value) {
							if (value.isConfirmed) {
								$.ajax({
									type: emailForm.method,
									url: emailForm.action,									
									headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									},
									dataType: 'json',
									data: {
										'phone': emailValue										
									},
									success: function(data) {										
										emailSubmitButton.removeAttribute('data-mv-indicator');

										// Enable button
										emailSubmitButton.disabled = false;
										
										emailWrapper.classList.add('d-none');

										$('[data-mv-element="code-form"] #type').val('email');
										codeWrapper.classList.remove('d-none');
									}
								});
							}else{
								emailSubmitButton.removeAttribute('data-mv-indicator');

								// Enable button
								emailSubmitButton.disabled = false;
								modalObject.hide();
								showOptionsForm();
							}

						});

					} else {
						// Show error message.
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

        // Handle apps cancelation
        emailCancelButton.addEventListener('click', function (e) {
            e.preventDefault();
            var option = optionsWrapper.querySelector('[name="auth_option"]:checked');

            optionsWrapper.classList.remove('d-none');
            emailWrapper.classList.add('d-none');
        });
    }

	var handleCodeForm = function() {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		codeValidator = FormValidation.formValidation(
			codeForm,
			{
				fields: {
					'code': {
						validators: {
							notEmpty: {
								message: 'Code is required'
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

        // Handle apps submition
        codeSubmitButton.addEventListener('click', function (e) {
            e.preventDefault();

			// Validate form before submit
			if (codeValidator) {
				codeValidator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						codeSubmitButton.setAttribute('data-mv-indicator', 'on');

						// Disable button to avoid multiple click
						codeSubmitButton.disabled = true;

						

						// Get the input field within the emailForm
						var typeValue = codeForm.querySelector('[name="type"]').value; 
						var codeValue = codeForm.querySelector('[name="code"]').value; 

						Swal.fire({
							html: "Are you sure?.",
							icon: "warning",
							buttonsStyling: false,
							confirmButtonText: "Aww, yeah!",
							customClass: {
								confirmButton: "btn btn-light"
							}
						}).then(function(value) {
							if (value.isConfirmed) {
								$.ajax({
									type: codeForm.method,
									url: codeForm.action,									
									headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									},
									dataType: 'json',
									data: {
										'code': codeValue,
										'type': typeValue
									},
									success: function(data) {										
										codeSubmitButton.removeAttribute('data-mv-indicator');

										// Enable button
										codeSubmitButton.disabled = false;

										if (data.status == true) {
											modalObject.hide();
											showOptionsForm();
											location.reload();
										}else{
											Swal.fire({
												text: 'Invalid Code',
												icon: 'error'
											});
										}
									}
								});
							}else{
								codeSubmitButton.removeAttribute('data-mv-indicator');

								// Enable button
								codeSubmitButton.disabled = false;
								modalObject.hide();
								showOptionsForm();
							}

						});
					} else {
						// Show error message.
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

        // Handle apps cancelation
        emailCancelButton.addEventListener('click', function (e) {
            e.preventDefault();
            var option = optionsWrapper.querySelector('[name="auth_option"]:checked');

            optionsWrapper.classList.remove('d-none');
            emailWrapper.classList.add('d-none');
        });
    }

    // Public methods
    return {
        init: function () {
            // Elements
            modal = document.querySelector('#mv_modal_two_factor_authentication');

			if (!modal) {
				return;
			}

			Inputmask({
				"mask": "1 (999) 999-9999",
			}).mask("[name='mobile']");

            modalObject = new bootstrap.Modal(modal);

            optionsWrapper = modal.querySelector('[data-mv-element="options"]');
            optionsSelectButton = modal.querySelector('[data-mv-element="options-select"]');

            smsWrapper = modal.querySelector('[data-mv-element="sms"]');
            smsForm = modal.querySelector('[data-mv-element="sms-form"]');
            smsSubmitButton = modal.querySelector('[data-mv-element="sms-submit"]');
            smsCancelButton = modal.querySelector('[data-mv-element="sms-cancel"]');

            emailWrapper = modal.querySelector('[data-mv-element="email"]');
            emailForm = modal.querySelector('[data-mv-element="email-form"]');
            emailSubmitButton = modal.querySelector('[data-mv-element="email-submit"]');
            emailCancelButton = modal.querySelector('[data-mv-element="email-cancel"]');

			codeWrapper = modal.querySelector('[data-mv-element="code"]');
            codeForm = modal.querySelector('[data-mv-element="code-form"]');
            codeSubmitButton = modal.querySelector('[data-mv-element="code-submit"]');
            codeCancelButton = modal.querySelector('[data-mv-element="code-cancel"]');

            // Handle forms
            handleOptionsForm();
            handleSMSForm();
            handleEmailForm();
			handleCodeForm();
        }
    }
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVModalTwoFactorAuthentication.init();
});
