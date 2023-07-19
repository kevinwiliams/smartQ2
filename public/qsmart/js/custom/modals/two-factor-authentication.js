/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/extended/js/custom/modals/two-factor-authentication.js":
/*!*********************************************************************************!*\
  !*** ./resources/assets/extended/js/custom/modals/two-factor-authentication.js ***!
  \*********************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVModalTwoFactorAuthentication = function () {\n  // Private variables\n  var modal;\n  var modalObject;\n  var optionsWrapper;\n  var optionsSelectButton;\n  var smsWrapper;\n  var smsForm;\n  var smsSubmitButton;\n  var smsCancelButton;\n  var smsValidator;\n  var appsWrapper;\n  var appsForm;\n  var appsSubmitButton;\n  var appsCancelButton;\n  var appsValidator;\n\n  // Private functions\n  var handleOptionsForm = function handleOptionsForm() {\n    // Handle options selection\n    optionsSelectButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      var option = optionsWrapper.querySelector('[name=\"auth_option\"]:checked');\n      optionsWrapper.classList.add('d-none');\n      if (option.value == 'sms') {\n        smsWrapper.classList.remove('d-none');\n      } else {\n        appsWrapper.classList.remove('d-none');\n      }\n    });\n  };\n  var showOptionsForm = function showOptionsForm() {\n    optionsWrapper.classList.remove('d-none');\n    smsWrapper.classList.add('d-none');\n    appsWrapper.classList.add('d-none');\n  };\n  var handleSMSForm = function handleSMSForm() {\n    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/\n    smsValidator = FormValidation.formValidation(smsForm, {\n      fields: {\n        'mobile': {\n          validators: {\n            notEmpty: {\n              message: 'Mobile no is required'\n            }\n          }\n        }\n      },\n      plugins: {\n        trigger: new FormValidation.plugins.Trigger(),\n        bootstrap: new FormValidation.plugins.Bootstrap5({\n          rowSelector: '.fv-row',\n          eleInvalidClass: '',\n          eleValidClass: ''\n        })\n      }\n    });\n\n    // Handle apps submition\n    smsSubmitButton.addEventListener('click', function (e) {\n      e.preventDefault();\n\n      // Validate form before submit\n      if (smsValidator) {\n        smsValidator.validate().then(function (status) {\n          console.log('validated!');\n          if (status == 'Valid') {\n            // Show loading indication\n            smsSubmitButton.setAttribute('data-mv-indicator', 'on');\n\n            // Disable button to avoid multiple click\n            smsSubmitButton.disabled = true;\n\n            // Simulate ajax process\n            setTimeout(function () {\n              // Remove loading indication\n              smsSubmitButton.removeAttribute('data-mv-indicator');\n\n              // Enable button\n              smsSubmitButton.disabled = false;\n\n              // Show success message. For more info check the plugin's official documentation: https://sweetalert2.github.io/\n              Swal.fire({\n                text: \"Mobile number has been successfully submitted!\",\n                icon: \"success\",\n                buttonsStyling: false,\n                confirmButtonText: \"Ok, got it!\",\n                customClass: {\n                  confirmButton: \"btn btn-primary\"\n                }\n              }).then(function (result) {\n                if (result.isConfirmed) {\n                  modalObject.hide();\n                  showOptionsForm();\n                }\n              });\n\n              //smsForm.submit(); // Submit form\n            }, 2000);\n          } else {\n            // Show error message.\n            Swal.fire({\n              text: \"Sorry, looks like there are some errors detected, please try again.\",\n              icon: \"error\",\n              buttonsStyling: false,\n              confirmButtonText: \"Ok, got it!\",\n              customClass: {\n                confirmButton: \"btn btn-primary\"\n              }\n            });\n          }\n        });\n      }\n    });\n\n    // Handle sms cancelation\n    smsCancelButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      var option = optionsWrapper.querySelector('[name=\"auth_option\"]:checked');\n      optionsWrapper.classList.remove('d-none');\n      smsWrapper.classList.add('d-none');\n    });\n  };\n  var handleAppsForm = function handleAppsForm() {\n    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/\n    appsValidator = FormValidation.formValidation(appsForm, {\n      fields: {\n        'code': {\n          validators: {\n            notEmpty: {\n              message: 'Code is required'\n            }\n          }\n        }\n      },\n      plugins: {\n        trigger: new FormValidation.plugins.Trigger(),\n        bootstrap: new FormValidation.plugins.Bootstrap5({\n          rowSelector: '.fv-row',\n          eleInvalidClass: '',\n          eleValidClass: ''\n        })\n      }\n    });\n\n    // Handle apps submition\n    appsSubmitButton.addEventListener('click', function (e) {\n      e.preventDefault();\n\n      // Validate form before submit\n      if (appsValidator) {\n        appsValidator.validate().then(function (status) {\n          console.log('validated!');\n          if (status == 'Valid') {\n            appsSubmitButton.setAttribute('data-mv-indicator', 'on');\n\n            // Disable button to avoid multiple click\n            appsSubmitButton.disabled = true;\n            setTimeout(function () {\n              appsSubmitButton.removeAttribute('data-mv-indicator');\n\n              // Enable button\n              appsSubmitButton.disabled = false;\n\n              // Show success message.\n              Swal.fire({\n                text: \"Code has been successfully submitted!\",\n                icon: \"success\",\n                buttonsStyling: false,\n                confirmButtonText: \"Ok, got it!\",\n                customClass: {\n                  confirmButton: \"btn btn-primary\"\n                }\n              }).then(function (result) {\n                if (result.isConfirmed) {\n                  modalObject.hide();\n                  showOptionsForm();\n                }\n              });\n\n              //appsForm.submit(); // Submit form\n            }, 2000);\n          } else {\n            // Show error message.\n            Swal.fire({\n              text: \"Sorry, looks like there are some errors detected, please try again.\",\n              icon: \"error\",\n              buttonsStyling: false,\n              confirmButtonText: \"Ok, got it!\",\n              customClass: {\n                confirmButton: \"btn btn-primary\"\n              }\n            });\n          }\n        });\n      }\n    });\n\n    // Handle apps cancelation\n    appsCancelButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      var option = optionsWrapper.querySelector('[name=\"auth_option\"]:checked');\n      optionsWrapper.classList.remove('d-none');\n      appsWrapper.classList.add('d-none');\n    });\n  };\n\n  // Public methods\n  return {\n    init: function init() {\n      // Elements\n      modal = document.querySelector('#mv_modal_two_factor_authentication');\n      if (!modal) {\n        return;\n      }\n      modalObject = new bootstrap.Modal(modal);\n      optionsWrapper = modal.querySelector('[data-mv-element=\"options\"]');\n      optionsSelectButton = modal.querySelector('[data-mv-element=\"options-select\"]');\n      smsWrapper = modal.querySelector('[data-mv-element=\"sms\"]');\n      smsForm = modal.querySelector('[data-mv-element=\"sms-form\"]');\n      smsSubmitButton = modal.querySelector('[data-mv-element=\"sms-submit\"]');\n      smsCancelButton = modal.querySelector('[data-mv-element=\"sms-cancel\"]');\n      appsWrapper = modal.querySelector('[data-mv-element=\"apps\"]');\n      appsForm = modal.querySelector('[data-mv-element=\"apps-form\"]');\n      appsSubmitButton = modal.querySelector('[data-mv-element=\"apps-submit\"]');\n      appsCancelButton = modal.querySelector('[data-mv-element=\"apps-cancel\"]');\n\n      // Handle forms\n      handleOptionsForm();\n      handleSMSForm();\n      handleAppsForm();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVModalTwoFactorAuthentication.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2V4dGVuZGVkL2pzL2N1c3RvbS9tb2RhbHMvdHdvLWZhY3Rvci1hdXRoZW50aWNhdGlvbi5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLDhCQUE4QixHQUFHLFlBQVk7RUFDN0M7RUFDQSxJQUFJQyxLQUFLO0VBQ1QsSUFBSUMsV0FBVztFQUVmLElBQUlDLGNBQWM7RUFDbEIsSUFBSUMsbUJBQW1CO0VBRXZCLElBQUlDLFVBQVU7RUFDZCxJQUFJQyxPQUFPO0VBQ1gsSUFBSUMsZUFBZTtFQUNuQixJQUFJQyxlQUFlO0VBQ25CLElBQUlDLFlBQVk7RUFFaEIsSUFBSUMsV0FBVztFQUNmLElBQUlDLFFBQVE7RUFDWixJQUFJQyxnQkFBZ0I7RUFDcEIsSUFBSUMsZ0JBQWdCO0VBQ3BCLElBQUlDLGFBQWE7O0VBRWpCO0VBQ0EsSUFBSUMsaUJBQWlCLEdBQUcsU0FBcEJBLGlCQUFpQkEsQ0FBQSxFQUFjO0lBQy9CO0lBQ0FYLG1CQUFtQixDQUFDWSxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsVUFBVUMsQ0FBQyxFQUFFO01BQ3ZEQSxDQUFDLENBQUNDLGNBQWMsQ0FBQyxDQUFDO01BQ2xCLElBQUlDLE1BQU0sR0FBR2hCLGNBQWMsQ0FBQ2lCLGFBQWEsQ0FBQyw4QkFBOEIsQ0FBQztNQUV6RWpCLGNBQWMsQ0FBQ2tCLFNBQVMsQ0FBQ0MsR0FBRyxDQUFDLFFBQVEsQ0FBQztNQUV0QyxJQUFJSCxNQUFNLENBQUNJLEtBQUssSUFBSSxLQUFLLEVBQUU7UUFDdkJsQixVQUFVLENBQUNnQixTQUFTLENBQUNHLE1BQU0sQ0FBQyxRQUFRLENBQUM7TUFDekMsQ0FBQyxNQUFNO1FBQ0hkLFdBQVcsQ0FBQ1csU0FBUyxDQUFDRyxNQUFNLENBQUMsUUFBUSxDQUFDO01BQzFDO0lBQ0osQ0FBQyxDQUFDO0VBQ04sQ0FBQztFQUVKLElBQUlDLGVBQWUsR0FBRyxTQUFsQkEsZUFBZUEsQ0FBQSxFQUFjO0lBQ2hDdEIsY0FBYyxDQUFD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QUFDO0lBQ3BCO0VBQ0osQ0FBQztBQUNMLENBQUMsQ0FBQyxDQUFDOztBQUVIO0FBQ0FJLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBVztFQUNqQ2xFLDhCQUE4QixDQUFDOEQsSUFBSSxDQUFDLENBQUM7QUFDekMsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9leHRlbmRlZC9qcy9jdXN0b20vbW9kYWxzL3R3by1mYWN0b3ItYXV0aGVudGljYXRpb24uanM/MWRlMCJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIE1WTW9kYWxUd29GYWN0b3JBdXRoZW50aWNhdGlvbiA9IGZ1bmN0aW9uICgpIHtcclxuICAgIC8vIFByaXZhdGUgdmFyaWFibGVzXHJcbiAgICB2YXIgbW9kYWw7XHJcbiAgICB2YXIgbW9kYWxPYmplY3Q7XHJcblxyXG4gICAgdmFyIG9wdGlvbnNXcmFwcGVyO1xyXG4gICAgdmFyIG9wdGlvbnNTZWxlY3RCdXR0b247XHJcblxyXG4gICAgdmFyIHNtc1dyYXBwZXI7XHJcbiAgICB2YXIgc21zRm9ybTtcclxuICAgIHZhciBzbXNTdWJtaXRCdXR0b247XHJcbiAgICB2YXIgc21zQ2FuY2VsQnV0dG9uO1xyXG4gICAgdmFyIHNtc1ZhbGlkYXRvcjtcclxuXHJcbiAgICB2YXIgYXBwc1dyYXBwZXI7XHJcbiAgICB2YXIgYXBwc0Zvcm07XHJcbiAgICB2YXIgYXBwc1N1Ym1pdEJ1dHRvbjtcclxuICAgIHZhciBhcHBzQ2FuY2VsQnV0dG9uO1xyXG4gICAgdmFyIGFwcHNWYWxpZGF0b3I7XHJcblxyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBoYW5kbGVPcHRpb25zRm9ybSA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIC8vIEhhbmRsZSBvcHRpb25zIHNlbGVjdGlvblxyXG4gICAgICAgIG9wdGlvbnNTZWxlY3RCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgIHZhciBvcHRpb24gPSBvcHRpb25zV3JhcHBlci5xdWVyeVNlbGVjdG9yKCdbbmFtZT1cImF1dGhfb3B0aW9uXCJdOmNoZWNrZWQnKTtcclxuXHJcbiAgICAgICAgICAgIG9wdGlvbnNXcmFwcGVyLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xyXG5cclxuICAgICAgICAgICAgaWYgKG9wdGlvbi52YWx1ZSA9PSAnc21zJykge1xyXG4gICAgICAgICAgICAgICAgc21zV3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKTtcclxuICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgIGFwcHNXcmFwcGVyLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG5cdHZhciBzaG93T3B0aW9uc0Zvcm0gPSBmdW5jdGlvbigpIHtcclxuXHRcdG9wdGlvbnNXcmFwcGVyLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG5cdFx0c21zV3JhcHBlci5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcclxuXHRcdGFwcHNXcmFwcGVyLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xyXG4gICAgfVxyXG5cclxuICAgIHZhciBoYW5kbGVTTVNGb3JtID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgLy8gSW5pdCBmb3JtIHZhbGlkYXRpb24gcnVsZXMuIEZvciBtb3JlIGluZm8gY2hlY2sgdGhlIEZvcm1WYWxpZGF0aW9uIHBsdWdpbidzIG9mZmljaWFsIGRvY3VtZW50YXRpb246aHR0cHM6Ly9mb3JtdmFsaWRhdGlvbi5pby9cclxuXHRcdHNtc1ZhbGlkYXRvciA9IEZvcm1WYWxpZGF0aW9uLmZvcm1WYWxpZGF0aW9uKFxyXG5cdFx0XHRzbXNGb3JtLFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0ZmllbGRzOiB7XHJcblx0XHRcdFx0XHQnbW9iaWxlJzoge1xyXG5cdFx0XHRcdFx0XHR2YWxpZGF0b3JzOiB7XHJcblx0XHRcdFx0XHRcdFx0bm90RW1wdHk6IHtcclxuXHRcdFx0XHRcdFx0XHRcdG1lc3NhZ2U6ICdNb2JpbGUgbm8gaXMgcmVxdWlyZWQnXHJcblx0XHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHR9XHJcblx0XHRcdFx0fSxcclxuXHRcdFx0XHRwbHVnaW5zOiB7XHJcblx0XHRcdFx0XHR0cmlnZ2VyOiBuZXcgRm9ybVZhbGlkYXRpb24ucGx1Z2lucy5UcmlnZ2VyKCksXHJcblx0XHRcdFx0XHRib290c3RyYXA6IG5ldyBGb3JtVmFsaWRhdGlvbi5wbHVnaW5zLkJvb3RzdHJhcDUoe1xyXG5cdFx0XHRcdFx0XHRyb3dTZWxlY3RvcjogJy5mdi1yb3cnLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBlbGVJbnZhbGlkQ2xhc3M6ICcnLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBlbGVWYWxpZENsYXNzOiAnJ1xyXG5cdFx0XHRcdFx0fSlcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHRcdCk7XHJcblxyXG4gICAgICAgIC8vIEhhbmRsZSBhcHBzIHN1Ym1pdGlvblxyXG4gICAgICAgIHNtc1N1Ym1pdEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcblx0XHRcdC8vIFZhbGlkYXRlIGZvcm0gYmVmb3JlIHN1Ym1pdFxyXG5cdFx0XHRpZiAoc21zVmFsaWRhdG9yKSB7XHJcblx0XHRcdFx0c21zVmFsaWRhdG9yLnZhbGlkYXRlKCkudGhlbihmdW5jdGlvbiAoc3RhdHVzKSB7XHJcblx0XHRcdFx0XHRjb25zb2xlLmxvZygndmFsaWRhdGVkIScpO1xyXG5cclxuXHRcdFx0XHRcdGlmIChzdGF0dXMgPT0gJ1ZhbGlkJykge1xyXG5cdFx0XHRcdFx0XHQvLyBTaG93IGxvYWRpbmcgaW5kaWNhdGlvblxyXG5cdFx0XHRcdFx0XHRzbXNTdWJtaXRCdXR0b24uc2V0QXR0cmlidXRlKCdkYXRhLW12LWluZGljYXRvcicsICdvbicpO1xyXG5cclxuXHRcdFx0XHRcdFx0Ly8gRGlzYWJsZSBidXR0b24gdG8gYXZvaWQgbXVsdGlwbGUgY2xpY2tcclxuXHRcdFx0XHRcdFx0c21zU3VibWl0QnV0dG9uLmRpc2FibGVkID0gdHJ1ZTtcclxuXHJcblx0XHRcdFx0XHRcdC8vIFNpbXVsYXRlIGFqYXggcHJvY2Vzc1xyXG5cdFx0XHRcdFx0XHRzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xyXG5cdFx0XHRcdFx0XHRcdC8vIFJlbW92ZSBsb2FkaW5nIGluZGljYXRpb25cclxuXHRcdFx0XHRcdFx0XHRzbXNTdWJtaXRCdXR0b24ucmVtb3ZlQXR0cmlidXRlKCdkYXRhLW12LWluZGljYXRvcicpO1xyXG5cclxuXHRcdFx0XHRcdFx0XHQvLyBFbmFibGUgYnV0dG9uXHJcblx0XHRcdFx0XHRcdFx0c21zU3VibWl0QnV0dG9uLmRpc2FibGVkID0gZmFsc2U7XHJcblxyXG5cdFx0XHRcdFx0XHRcdC8vIFNob3cgc3VjY2VzcyBtZXNzYWdlLiBGb3IgbW9yZSBpbmZvIGNoZWNrIHRoZSBwbHVnaW4ncyBvZmZpY2lhbCBkb2N1bWVudGF0aW9uOiBodHRwczovL3N3ZWV0YWxlcnQyLmdpdGh1Yi5pby9cclxuXHRcdFx0XHRcdFx0XHRTd2FsLmZpcmUoe1xyXG5cdFx0XHRcdFx0XHRcdFx0dGV4dDogXCJNb2JpbGUgbnVtYmVyIGhhcyBiZWVuIHN1Y2Nlc3NmdWxseSBzdWJtaXR0ZWQhXCIsXHJcblx0XHRcdFx0XHRcdFx0XHRpY29uOiBcInN1Y2Nlc3NcIixcclxuXHRcdFx0XHRcdFx0XHRcdGJ1dHRvbnNTdHlsaW5nOiBmYWxzZSxcclxuXHRcdFx0XHRcdFx0XHRcdGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcblx0XHRcdFx0XHRcdFx0XHRjdXN0b21DbGFzczoge1xyXG5cdFx0XHRcdFx0XHRcdFx0XHRjb25maXJtQnV0dG9uOiBcImJ0biBidG4tcHJpbWFyeVwiXHJcblx0XHRcdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHRcdFx0fSkudGhlbihmdW5jdGlvbiAocmVzdWx0KSB7XHJcblx0XHRcdFx0XHRcdFx0XHRpZiAocmVzdWx0LmlzQ29uZmlybWVkKSB7XHJcblx0XHRcdFx0XHRcdFx0XHRcdG1vZGFsT2JqZWN0LmhpZGUoKTtcclxuXHRcdFx0XHRcdFx0XHRcdFx0c2hvd09wdGlvbnNGb3JtKCk7XHJcblx0XHRcdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHRcdFx0fSk7XHJcblxyXG5cdFx0XHRcdFx0XHRcdC8vc21zRm9ybS5zdWJtaXQoKTsgLy8gU3VibWl0IGZvcm1cclxuXHRcdFx0XHRcdFx0fSwgMjAwMCk7XHJcblx0XHRcdFx0XHR9IGVsc2Uge1xyXG5cdFx0XHRcdFx0XHQvLyBTaG93IGVycm9yIG1lc3NhZ2UuXHJcblx0XHRcdFx0XHRcdFN3YWwuZmlyZSh7XHJcblx0XHRcdFx0XHRcdFx0dGV4dDogXCJTb3JyeSwgbG9va3MgbGlrZSB0aGVyZSBhcmUgc29tZSBlcnJvcnMgZGV0ZWN0ZWQsIHBsZWFzZSB0cnkgYWdhaW4uXCIsXHJcblx0XHRcdFx0XHRcdFx0aWNvbjogXCJlcnJvclwiLFxyXG5cdFx0XHRcdFx0XHRcdGJ1dHRvbnNTdHlsaW5nOiBmYWxzZSxcclxuXHRcdFx0XHRcdFx0XHRjb25maXJtQnV0dG9uVGV4dDogXCJPaywgZ290IGl0IVwiLFxyXG5cdFx0XHRcdFx0XHRcdGN1c3RvbUNsYXNzOiB7XHJcblx0XHRcdFx0XHRcdFx0XHRjb25maXJtQnV0dG9uOiBcImJ0biBidG4tcHJpbWFyeVwiXHJcblx0XHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0XHR9KTtcclxuXHRcdFx0XHRcdH1cclxuXHRcdFx0XHR9KTtcclxuXHRcdFx0fVxyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICAvLyBIYW5kbGUgc21zIGNhbmNlbGF0aW9uXHJcbiAgICAgICAgc21zQ2FuY2VsQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICB2YXIgb3B0aW9uID0gb3B0aW9uc1dyYXBwZXIucXVlcnlTZWxlY3RvcignW25hbWU9XCJhdXRoX29wdGlvblwiXTpjaGVja2VkJyk7XHJcblxyXG4gICAgICAgICAgICBvcHRpb25zV3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKTtcclxuICAgICAgICAgICAgc21zV3JhcHBlci5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgaGFuZGxlQXBwc0Zvcm0gPSBmdW5jdGlvbigpIHtcclxuXHRcdC8vIEluaXQgZm9ybSB2YWxpZGF0aW9uIHJ1bGVzLiBGb3IgbW9yZSBpbmZvIGNoZWNrIHRoZSBGb3JtVmFsaWRhdGlvbiBwbHVnaW4ncyBvZmZpY2lhbCBkb2N1bWVudGF0aW9uOmh0dHBzOi8vZm9ybXZhbGlkYXRpb24uaW8vXHJcblx0XHRhcHBzVmFsaWRhdG9yID0gRm9ybVZhbGlkYXRpb24uZm9ybVZhbGlkYXRpb24oXHJcblx0XHRcdGFwcHNGb3JtLFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0ZmllbGRzOiB7XHJcblx0XHRcdFx0XHQnY29kZSc6IHtcclxuXHRcdFx0XHRcdFx0dmFsaWRhdG9yczoge1xyXG5cdFx0XHRcdFx0XHRcdG5vdEVtcHR5OiB7XHJcblx0XHRcdFx0XHRcdFx0XHRtZXNzYWdlOiAnQ29kZSBpcyByZXF1aXJlZCdcclxuXHRcdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHRcdH1cclxuXHRcdFx0XHRcdH1cclxuXHRcdFx0XHR9LFxyXG5cdFx0XHRcdHBsdWdpbnM6IHtcclxuXHRcdFx0XHRcdHRyaWdnZXI6IG5ldyBGb3JtVmFsaWRhdGlvbi5wbHVnaW5zLlRyaWdnZXIoKSxcclxuXHRcdFx0XHRcdGJvb3RzdHJhcDogbmV3IEZvcm1WYWxpZGF0aW9uLnBsdWdpbnMuQm9vdHN0cmFwNSh7XHJcblx0XHRcdFx0XHRcdHJvd1NlbGVjdG9yOiAnLmZ2LXJvdycsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGVsZUludmFsaWRDbGFzczogJycsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGVsZVZhbGlkQ2xhc3M6ICcnXHJcblx0XHRcdFx0XHR9KVxyXG5cdFx0XHRcdH1cclxuXHRcdFx0fVxyXG5cdFx0KTtcclxuXHJcbiAgICAgICAgLy8gSGFuZGxlIGFwcHMgc3VibWl0aW9uXHJcbiAgICAgICAgYXBwc1N1Ym1pdEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcblx0XHRcdC8vIFZhbGlkYXRlIGZvcm0gYmVmb3JlIHN1Ym1pdFxyXG5cdFx0XHRpZiAoYXBwc1ZhbGlkYXRvcikge1xyXG5cdFx0XHRcdGFwcHNWYWxpZGF0b3IudmFsaWRhdGUoKS50aGVuKGZ1bmN0aW9uIChzdGF0dXMpIHtcclxuXHRcdFx0XHRcdGNvbnNvbGUubG9nKCd2YWxpZGF0ZWQhJyk7XHJcblxyXG5cdFx0XHRcdFx0aWYgKHN0YXR1cyA9PSAnVmFsaWQnKSB7XHJcblx0XHRcdFx0XHRcdGFwcHNTdWJtaXRCdXR0b24uc2V0QXR0cmlidXRlKCdkYXRhLW12LWluZGljYXRvcicsICdvbicpO1xyXG5cclxuXHRcdFx0XHRcdFx0Ly8gRGlzYWJsZSBidXR0b24gdG8gYXZvaWQgbXVsdGlwbGUgY2xpY2tcclxuXHRcdFx0XHRcdFx0YXBwc1N1Ym1pdEJ1dHRvbi5kaXNhYmxlZCA9IHRydWU7XHJcblxyXG5cdFx0XHRcdFx0XHRzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xyXG5cdFx0XHRcdFx0XHRcdGFwcHNTdWJtaXRCdXR0b24ucmVtb3ZlQXR0cmlidXRlKCdkYXRhLW12LWluZGljYXRvcicpO1xyXG5cclxuXHRcdFx0XHRcdFx0XHQvLyBFbmFibGUgYnV0dG9uXHJcblx0XHRcdFx0XHRcdFx0YXBwc1N1Ym1pdEJ1dHRvbi5kaXNhYmxlZCA9IGZhbHNlO1xyXG5cclxuXHRcdFx0XHRcdFx0XHQvLyBTaG93IHN1Y2Nlc3MgbWVzc2FnZS5cclxuXHRcdFx0XHRcdFx0XHRTd2FsLmZpcmUoe1xyXG5cdFx0XHRcdFx0XHRcdFx0dGV4dDogXCJDb2RlIGhhcyBiZWVuIHN1Y2Nlc3NmdWxseSBzdWJtaXR0ZWQhXCIsXHJcblx0XHRcdFx0XHRcdFx0XHRpY29uOiBcInN1Y2Nlc3NcIixcclxuXHRcdFx0XHRcdFx0XHRcdGJ1dHRvbnNTdHlsaW5nOiBmYWxzZSxcclxuXHRcdFx0XHRcdFx0XHRcdGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcblx0XHRcdFx0XHRcdFx0XHRjdXN0b21DbGFzczoge1xyXG5cdFx0XHRcdFx0XHRcdFx0XHRjb25maXJtQnV0dG9uOiBcImJ0biBidG4tcHJpbWFyeVwiXHJcblx0XHRcdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHRcdFx0fSkudGhlbihmdW5jdGlvbiAocmVzdWx0KSB7XHJcblx0XHRcdFx0XHRcdFx0XHRpZiAocmVzdWx0LmlzQ29uZmlybWVkKSB7XHJcblx0XHRcdFx0XHRcdFx0XHRcdG1vZGFsT2JqZWN0LmhpZGUoKTtcclxuXHRcdFx0XHRcdFx0XHRcdFx0c2hvd09wdGlvbnNGb3JtKCk7XHJcblx0XHRcdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHRcdFx0fSk7XHJcblxyXG5cdFx0XHRcdFx0XHRcdC8vYXBwc0Zvcm0uc3VibWl0KCk7IC8vIFN1Ym1pdCBmb3JtXHJcblx0XHRcdFx0XHRcdH0sIDIwMDApO1xyXG5cdFx0XHRcdFx0fSBlbHNlIHtcclxuXHRcdFx0XHRcdFx0Ly8gU2hvdyBlcnJvciBtZXNzYWdlLlxyXG5cdFx0XHRcdFx0XHRTd2FsLmZpcmUoe1xyXG5cdFx0XHRcdFx0XHRcdHRleHQ6IFwiU29ycnksIGxvb2tzIGxpa2UgdGhlcmUgYXJlIHNvbWUgZXJyb3JzIGRldGVjdGVkLCBwbGVhc2UgdHJ5IGFnYWluLlwiLFxyXG5cdFx0XHRcdFx0XHRcdGljb246IFwiZXJyb3JcIixcclxuXHRcdFx0XHRcdFx0XHRidXR0b25zU3R5bGluZzogZmFsc2UsXHJcblx0XHRcdFx0XHRcdFx0Y29uZmlybUJ1dHRvblRleHQ6IFwiT2ssIGdvdCBpdCFcIixcclxuXHRcdFx0XHRcdFx0XHRjdXN0b21DbGFzczoge1xyXG5cdFx0XHRcdFx0XHRcdFx0Y29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIlxyXG5cdFx0XHRcdFx0XHRcdH1cclxuXHRcdFx0XHRcdFx0fSk7XHJcblx0XHRcdFx0XHR9XHJcblx0XHRcdFx0fSk7XHJcblx0XHRcdH1cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gSGFuZGxlIGFwcHMgY2FuY2VsYXRpb25cclxuICAgICAgICBhcHBzQ2FuY2VsQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICB2YXIgb3B0aW9uID0gb3B0aW9uc1dyYXBwZXIucXVlcnlTZWxlY3RvcignW25hbWU9XCJhdXRoX29wdGlvblwiXTpjaGVja2VkJyk7XHJcblxyXG4gICAgICAgICAgICBvcHRpb25zV3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKTtcclxuICAgICAgICAgICAgYXBwc1dyYXBwZXIuY2xhc3NMaXN0LmFkZCgnZC1ub25lJyk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgLy8gUHVibGljIG1ldGhvZHNcclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAvLyBFbGVtZW50c1xyXG4gICAgICAgICAgICBtb2RhbCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNtdl9tb2RhbF90d29fZmFjdG9yX2F1dGhlbnRpY2F0aW9uJyk7XHJcblxyXG5cdFx0XHRpZiAoIW1vZGFsKSB7XHJcblx0XHRcdFx0cmV0dXJuO1xyXG5cdFx0XHR9XHJcblxyXG4gICAgICAgICAgICBtb2RhbE9iamVjdCA9IG5ldyBib290c3RyYXAuTW9kYWwobW9kYWwpO1xyXG5cclxuICAgICAgICAgICAgb3B0aW9uc1dyYXBwZXIgPSBtb2RhbC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi1lbGVtZW50PVwib3B0aW9uc1wiXScpO1xyXG4gICAgICAgICAgICBvcHRpb25zU2VsZWN0QnV0dG9uID0gbW9kYWwucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtZWxlbWVudD1cIm9wdGlvbnMtc2VsZWN0XCJdJyk7XHJcblxyXG4gICAgICAgICAgICBzbXNXcmFwcGVyID0gbW9kYWwucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtZWxlbWVudD1cInNtc1wiXScpO1xyXG4gICAgICAgICAgICBzbXNGb3JtID0gbW9kYWwucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtZWxlbWVudD1cInNtcy1mb3JtXCJdJyk7XHJcbiAgICAgICAgICAgIHNtc1N1Ym1pdEJ1dHRvbiA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJzbXMtc3VibWl0XCJdJyk7XHJcbiAgICAgICAgICAgIHNtc0NhbmNlbEJ1dHRvbiA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJzbXMtY2FuY2VsXCJdJyk7XHJcblxyXG4gICAgICAgICAgICBhcHBzV3JhcHBlciA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJhcHBzXCJdJyk7XHJcbiAgICAgICAgICAgIGFwcHNGb3JtID0gbW9kYWwucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtZWxlbWVudD1cImFwcHMtZm9ybVwiXScpO1xyXG4gICAgICAgICAgICBhcHBzU3VibWl0QnV0dG9uID0gbW9kYWwucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtZWxlbWVudD1cImFwcHMtc3VibWl0XCJdJyk7XHJcbiAgICAgICAgICAgIGFwcHNDYW5jZWxCdXR0b24gPSBtb2RhbC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi1lbGVtZW50PVwiYXBwcy1jYW5jZWxcIl0nKTtcclxuXHJcbiAgICAgICAgICAgIC8vIEhhbmRsZSBmb3Jtc1xyXG4gICAgICAgICAgICBoYW5kbGVPcHRpb25zRm9ybSgpO1xyXG4gICAgICAgICAgICBoYW5kbGVTTVNGb3JtKCk7XHJcbiAgICAgICAgICAgIGhhbmRsZUFwcHNGb3JtKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5NVlV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uKCkge1xyXG4gICAgTVZNb2RhbFR3b0ZhY3RvckF1dGhlbnRpY2F0aW9uLmluaXQoKTtcclxufSk7XHJcbiJdLCJuYW1lcyI6WyJNVk1vZGFsVHdvRmFjdG9yQXV0aGVudGljYXRpb24iLCJtb2RhbCIsIm1vZGFsT2JqZWN0Iiwib3B0aW9uc1dyYXBwZXIiLCJvcHRpb25zU2VsZWN0QnV0dG9uIiwic21zV3JhcHBlciIsInNtc0Zvcm0iLCJzbXNTdWJtaXRCdXR0b24iLCJzbXNDYW5jZWxCdXR0b24iLCJzbXNWYWxpZGF0b3IiLCJhcHBzV3JhcHBlciIsImFwcHNGb3JtIiwiYXBwc1N1Ym1pdEJ1dHRvbiIsImFwcHNDYW5jZWxCdXR0b24iLCJhcHBzVmFsaWRhdG9yIiwiaGFuZGxlT3B0aW9uc0Zvcm0iLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsInByZXZlbnREZWZhdWx0Iiwib3B0aW9uIiwicXVlcnlTZWxlY3RvciIsImNsYXNzTGlzdCIsImFkZCIsInZhbHVlIiwicmVtb3ZlIiwic2hvd09wdGlvbnNGb3JtIiwiaGFuZGxlU01TRm9ybSIsIkZvcm1WYWxpZGF0aW9uIiwiZm9ybVZhbGlkYXRpb24iLCJmaWVsZHMiLCJ2YWxpZGF0b3JzIiwibm90RW1wdHkiLCJtZXNzYWdlIiwicGx1Z2lucyIsInRyaWdnZXIiLCJUcmlnZ2VyIiwiYm9vdHN0cmFwIiwiQm9vdHN0cmFwNSIsInJvd1NlbGVjdG9yIiwiZWxlSW52YWxpZENsYXNzIiwiZWxlVmFsaWRDbGFzcyIsInZhbGlkYXRlIiwidGhlbiIsInN0YXR1cyIsImNvbnNvbGUiLCJsb2ciLCJzZXRBdHRyaWJ1dGUiLCJkaXNhYmxlZCIsInNldFRpbWVvdXQiLCJyZW1vdmVBdHRyaWJ1dGUiLCJTd2FsIiwiZmlyZSIsInRleHQiLCJpY29uIiwiYnV0dG9uc1N0eWxpbmciLCJjb25maXJtQnV0dG9uVGV4dCIsImN1c3RvbUNsYXNzIiwiY29uZmlybUJ1dHRvbiIsInJlc3VsdCIsImlzQ29uZmlybWVkIiwiaGlkZSIsImhhbmRsZUFwcHNGb3JtIiwiaW5pdCIsImRvY3VtZW50IiwiTW9kYWwiLCJNVlV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/extended/js/custom/modals/two-factor-authentication.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/extended/js/custom/modals/two-factor-authentication.js"]();
/******/ 	
/******/ })()
;