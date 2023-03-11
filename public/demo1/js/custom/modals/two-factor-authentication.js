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

eval(" // Class definition\n\nvar MVModalTwoFactorAuthentication = function () {\n  // Private variables\n  var modal;\n  var modalObject;\n  var optionsWrapper;\n  var optionsSelectButton;\n  var smsWrapper;\n  var smsForm;\n  var smsSubmitButton;\n  var smsCancelButton;\n  var smsValidator;\n  var appsWrapper;\n  var appsForm;\n  var appsSubmitButton;\n  var appsCancelButton;\n  var appsValidator; // Private functions\n\n  var handleOptionsForm = function handleOptionsForm() {\n    // Handle options selection\n    optionsSelectButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      var option = optionsWrapper.querySelector('[name=\"auth_option\"]:checked');\n      optionsWrapper.classList.add('d-none');\n\n      if (option.value == 'sms') {\n        smsWrapper.classList.remove('d-none');\n      } else {\n        appsWrapper.classList.remove('d-none');\n      }\n    });\n  };\n\n  var showOptionsForm = function showOptionsForm() {\n    optionsWrapper.classList.remove('d-none');\n    smsWrapper.classList.add('d-none');\n    appsWrapper.classList.add('d-none');\n  };\n\n  var handleSMSForm = function handleSMSForm() {\n    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/\n    smsValidator = FormValidation.formValidation(smsForm, {\n      fields: {\n        'mobile': {\n          validators: {\n            notEmpty: {\n              message: 'Mobile no is required'\n            }\n          }\n        }\n      },\n      plugins: {\n        trigger: new FormValidation.plugins.Trigger(),\n        bootstrap: new FormValidation.plugins.Bootstrap5({\n          rowSelector: '.fv-row',\n          eleInvalidClass: '',\n          eleValidClass: ''\n        })\n      }\n    }); // Handle apps submition\n\n    smsSubmitButton.addEventListener('click', function (e) {\n      e.preventDefault(); // Validate form before submit\n\n      if (smsValidator) {\n        smsValidator.validate().then(function (status) {\n          console.log('validated!');\n\n          if (status == 'Valid') {\n            // Show loading indication\n            smsSubmitButton.setAttribute('data-mv-indicator', 'on'); // Disable button to avoid multiple click\n\n            smsSubmitButton.disabled = true; // Simulate ajax process\n\n            setTimeout(function () {\n              // Remove loading indication\n              smsSubmitButton.removeAttribute('data-mv-indicator'); // Enable button\n\n              smsSubmitButton.disabled = false; // Show success message. For more info check the plugin's official documentation: https://sweetalert2.github.io/\n\n              Swal.fire({\n                text: \"Mobile number has been successfully submitted!\",\n                icon: \"success\",\n                buttonsStyling: false,\n                confirmButtonText: \"Ok, got it!\",\n                customClass: {\n                  confirmButton: \"btn btn-primary\"\n                }\n              }).then(function (result) {\n                if (result.isConfirmed) {\n                  modalObject.hide();\n                  showOptionsForm();\n                }\n              }); //smsForm.submit(); // Submit form\n            }, 2000);\n          } else {\n            // Show error message.\n            Swal.fire({\n              text: \"Sorry, looks like there are some errors detected, please try again.\",\n              icon: \"error\",\n              buttonsStyling: false,\n              confirmButtonText: \"Ok, got it!\",\n              customClass: {\n                confirmButton: \"btn btn-primary\"\n              }\n            });\n          }\n        });\n      }\n    }); // Handle sms cancelation\n\n    smsCancelButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      var option = optionsWrapper.querySelector('[name=\"auth_option\"]:checked');\n      optionsWrapper.classList.remove('d-none');\n      smsWrapper.classList.add('d-none');\n    });\n  };\n\n  var handleAppsForm = function handleAppsForm() {\n    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/\n    appsValidator = FormValidation.formValidation(appsForm, {\n      fields: {\n        'code': {\n          validators: {\n            notEmpty: {\n              message: 'Code is required'\n            }\n          }\n        }\n      },\n      plugins: {\n        trigger: new FormValidation.plugins.Trigger(),\n        bootstrap: new FormValidation.plugins.Bootstrap5({\n          rowSelector: '.fv-row',\n          eleInvalidClass: '',\n          eleValidClass: ''\n        })\n      }\n    }); // Handle apps submition\n\n    appsSubmitButton.addEventListener('click', function (e) {\n      e.preventDefault(); // Validate form before submit\n\n      if (appsValidator) {\n        appsValidator.validate().then(function (status) {\n          console.log('validated!');\n\n          if (status == 'Valid') {\n            appsSubmitButton.setAttribute('data-mv-indicator', 'on'); // Disable button to avoid multiple click\n\n            appsSubmitButton.disabled = true;\n            setTimeout(function () {\n              appsSubmitButton.removeAttribute('data-mv-indicator'); // Enable button\n\n              appsSubmitButton.disabled = false; // Show success message.\n\n              Swal.fire({\n                text: \"Code has been successfully submitted!\",\n                icon: \"success\",\n                buttonsStyling: false,\n                confirmButtonText: \"Ok, got it!\",\n                customClass: {\n                  confirmButton: \"btn btn-primary\"\n                }\n              }).then(function (result) {\n                if (result.isConfirmed) {\n                  modalObject.hide();\n                  showOptionsForm();\n                }\n              }); //appsForm.submit(); // Submit form\n            }, 2000);\n          } else {\n            // Show error message.\n            Swal.fire({\n              text: \"Sorry, looks like there are some errors detected, please try again.\",\n              icon: \"error\",\n              buttonsStyling: false,\n              confirmButtonText: \"Ok, got it!\",\n              customClass: {\n                confirmButton: \"btn btn-primary\"\n              }\n            });\n          }\n        });\n      }\n    }); // Handle apps cancelation\n\n    appsCancelButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      var option = optionsWrapper.querySelector('[name=\"auth_option\"]:checked');\n      optionsWrapper.classList.remove('d-none');\n      appsWrapper.classList.add('d-none');\n    });\n  }; // Public methods\n\n\n  return {\n    init: function init() {\n      // Elements\n      modal = document.querySelector('#mv_modal_two_factor_authentication');\n\n      if (!modal) {\n        return;\n      }\n\n      modalObject = new bootstrap.Modal(modal);\n      optionsWrapper = modal.querySelector('[data-mv-element=\"options\"]');\n      optionsSelectButton = modal.querySelector('[data-mv-element=\"options-select\"]');\n      smsWrapper = modal.querySelector('[data-mv-element=\"sms\"]');\n      smsForm = modal.querySelector('[data-mv-element=\"sms-form\"]');\n      smsSubmitButton = modal.querySelector('[data-mv-element=\"sms-submit\"]');\n      smsCancelButton = modal.querySelector('[data-mv-element=\"sms-cancel\"]');\n      appsWrapper = modal.querySelector('[data-mv-element=\"apps\"]');\n      appsForm = modal.querySelector('[data-mv-element=\"apps-form\"]');\n      appsSubmitButton = modal.querySelector('[data-mv-element=\"apps-submit\"]');\n      appsCancelButton = modal.querySelector('[data-mv-element=\"apps-cancel\"]'); // Handle forms\n\n      handleOptionsForm();\n      handleSMSForm();\n      handleAppsForm();\n    }\n  };\n}(); // On document ready\n\n\nMVUtil.onDOMContentLoaded(function () {\n  MVModalTwoFactorAuthentication.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2V4dGVuZGVkL2pzL2N1c3RvbS9tb2RhbHMvdHdvLWZhY3Rvci1hdXRoZW50aWNhdGlvbi5qcy5qcyIsIm1hcHBpbmdzIjoiQ0FFQTs7QUFDQSxJQUFJQSw4QkFBOEIsR0FBRyxZQUFZO0FBQzdDO0FBQ0EsTUFBSUMsS0FBSjtBQUNBLE1BQUlDLFdBQUo7QUFFQSxNQUFJQyxjQUFKO0FBQ0EsTUFBSUMsbUJBQUo7QUFFQSxNQUFJQyxVQUFKO0FBQ0EsTUFBSUMsT0FBSjtBQUNBLE1BQUlDLGVBQUo7QUFDQSxNQUFJQyxlQUFKO0FBQ0EsTUFBSUMsWUFBSjtBQUVBLE1BQUlDLFdBQUo7QUFDQSxNQUFJQyxRQUFKO0FBQ0EsTUFBSUMsZ0JBQUo7QUFDQSxNQUFJQyxnQkFBSjtBQUNBLE1BQUlDLGFBQUosQ0FsQjZDLENBb0I3Qzs7QUFDQSxNQUFJQyxpQkFBaUIsR0FBRyxTQUFwQkEsaUJBQW9CLEdBQVc7QUFDL0I7QUFDQVgsSUFBQUEsbUJBQW1CLENBQUNZLGdCQUFwQixDQUFxQyxPQUFyQyxFQUE4QyxVQUFVQyxDQUFWLEVBQWE7QUFDdkRBLE1BQUFBLENBQUMsQ0FBQ0MsY0FBRjtBQUNBLFVBQUlDLE1BQU0sR0FBR2hCLGNBQWMsQ0FBQ2lCLGFBQWYsQ0FBNkIsOEJBQTdCLENBQWI7QUFFQWpCLE1BQUFBLGNBQWMsQ0FBQ2tCLFNBQWYsQ0FBeUJDLEdBQXpCLENBQTZCLFFBQTdCOztBQUVBLFVBQUlILE1BQU0sQ0FBQ0ksS0FBUCxJQUFnQixLQUFwQixFQUEyQjtBQUN2QmxCLFFBQUFBLFVBQVUsQ0FBQ2dCLFNBQVgsQ0FBcUJHLE1BQXJCLENBQTRCLFFBQTVCO0FBQ0gsT0FGRCxNQUVPO0FBQ0hkLFFBQUFBLFdBQVcsQ0FBQ1csU0FBWixDQUFzQkcsTUFBdEIsQ0FBNkIsUUFBN0I7QUFDSDtBQUNKLEtBWEQ7QUFZSCxHQWREOztBQWdCSCxNQUFJQyxlQUFlLEdBQUcsU0FBbEJBLGVBQWtCLEdBQVc7QUFDaEN0QixJQUFBQSxj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QUFDbUIsYUFBTixDQUFvQix5QkFBcEIsQ0FBYjtBQUNBZCxNQUFBQSxPQUFPLEdBQUdMLEtBQUssQ0FBQ21CLGFBQU4sQ0FBb0IsOEJBQXBCLENBQVY7QUFDQWIsTUFBQUEsZUFBZSxHQUFHTixLQUFLLENBQUNtQixhQUFOLENBQW9CLGdDQUFwQixDQUFsQjtBQUNBWixNQUFBQSxlQUFlLEdBQUdQLEtBQUssQ0FBQ21CLGFBQU4sQ0FBb0IsZ0NBQXBCLENBQWxCO0FBRUFWLE1BQUFBLFdBQVcsR0FBR1QsS0FBSyxDQUFDbUIsYUFBTixDQUFvQiwwQkFBcEIsQ0FBZDtBQUNBVCxNQUFBQSxRQUFRLEdBQUdWLEtBQUssQ0FBQ21CLGFBQU4sQ0FBb0IsK0JBQXBCLENBQVg7QUFDQVIsTUFBQUEsZ0JBQWdCLEdBQUdYLEtBQUssQ0FBQ21CLGFBQU4sQ0FBb0IsaUNBQXBCLENBQW5CO0FBQ0FQLE1BQUFBLGdCQUFnQixHQUFHWixLQUFLLENBQUNtQixhQUFOLENBQW9CLGlDQUFwQixDQUFuQixDQXJCYyxDQXVCZDs7QUFDQUwsTUFBQUEsaUJBQWlCO0FBQ2pCVyxNQUFBQSxhQUFhO0FBQ2JtQyxNQUFBQSxjQUFjO0FBQ2pCO0FBNUJFLEdBQVA7QUE4QkgsQ0FqUW9DLEVBQXJDLEMsQ0FtUUE7OztBQUNBSSxNQUFNLENBQUNDLGtCQUFQLENBQTBCLFlBQVc7QUFDakNsRSxFQUFBQSw4QkFBOEIsQ0FBQzhELElBQS9CO0FBQ0gsQ0FGRCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvZXh0ZW5kZWQvanMvY3VzdG9tL21vZGFscy90d28tZmFjdG9yLWF1dGhlbnRpY2F0aW9uLmpzPzFkZTAiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcbnZhciBNVk1vZGFsVHdvRmFjdG9yQXV0aGVudGljYXRpb24gPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyBQcml2YXRlIHZhcmlhYmxlc1xyXG4gICAgdmFyIG1vZGFsO1xyXG4gICAgdmFyIG1vZGFsT2JqZWN0O1xyXG5cclxuICAgIHZhciBvcHRpb25zV3JhcHBlcjtcclxuICAgIHZhciBvcHRpb25zU2VsZWN0QnV0dG9uO1xyXG5cclxuICAgIHZhciBzbXNXcmFwcGVyO1xyXG4gICAgdmFyIHNtc0Zvcm07XHJcbiAgICB2YXIgc21zU3VibWl0QnV0dG9uO1xyXG4gICAgdmFyIHNtc0NhbmNlbEJ1dHRvbjtcclxuICAgIHZhciBzbXNWYWxpZGF0b3I7XHJcblxyXG4gICAgdmFyIGFwcHNXcmFwcGVyO1xyXG4gICAgdmFyIGFwcHNGb3JtO1xyXG4gICAgdmFyIGFwcHNTdWJtaXRCdXR0b247XHJcbiAgICB2YXIgYXBwc0NhbmNlbEJ1dHRvbjtcclxuICAgIHZhciBhcHBzVmFsaWRhdG9yO1xyXG5cclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgaGFuZGxlT3B0aW9uc0Zvcm0gPSBmdW5jdGlvbigpIHtcclxuICAgICAgICAvLyBIYW5kbGUgb3B0aW9ucyBzZWxlY3Rpb25cclxuICAgICAgICBvcHRpb25zU2VsZWN0QnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICB2YXIgb3B0aW9uID0gb3B0aW9uc1dyYXBwZXIucXVlcnlTZWxlY3RvcignW25hbWU9XCJhdXRoX29wdGlvblwiXTpjaGVja2VkJyk7XHJcblxyXG4gICAgICAgICAgICBvcHRpb25zV3JhcHBlci5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcclxuXHJcbiAgICAgICAgICAgIGlmIChvcHRpb24udmFsdWUgPT0gJ3NtcycpIHtcclxuICAgICAgICAgICAgICAgIHNtc1dyYXBwZXIuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJyk7XHJcbiAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICBhcHBzV3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuXHR2YXIgc2hvd09wdGlvbnNGb3JtID0gZnVuY3Rpb24oKSB7XHJcblx0XHRvcHRpb25zV3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKTtcclxuXHRcdHNtc1dyYXBwZXIuY2xhc3NMaXN0LmFkZCgnZC1ub25lJyk7XHJcblx0XHRhcHBzV3JhcHBlci5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgaGFuZGxlU01TRm9ybSA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIC8vIEluaXQgZm9ybSB2YWxpZGF0aW9uIHJ1bGVzLiBGb3IgbW9yZSBpbmZvIGNoZWNrIHRoZSBGb3JtVmFsaWRhdGlvbiBwbHVnaW4ncyBvZmZpY2lhbCBkb2N1bWVudGF0aW9uOmh0dHBzOi8vZm9ybXZhbGlkYXRpb24uaW8vXHJcblx0XHRzbXNWYWxpZGF0b3IgPSBGb3JtVmFsaWRhdGlvbi5mb3JtVmFsaWRhdGlvbihcclxuXHRcdFx0c21zRm9ybSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdGZpZWxkczoge1xyXG5cdFx0XHRcdFx0J21vYmlsZSc6IHtcclxuXHRcdFx0XHRcdFx0dmFsaWRhdG9yczoge1xyXG5cdFx0XHRcdFx0XHRcdG5vdEVtcHR5OiB7XHJcblx0XHRcdFx0XHRcdFx0XHRtZXNzYWdlOiAnTW9iaWxlIG5vIGlzIHJlcXVpcmVkJ1xyXG5cdFx0XHRcdFx0XHRcdH1cclxuXHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0fVxyXG5cdFx0XHRcdH0sXHJcblx0XHRcdFx0cGx1Z2luczoge1xyXG5cdFx0XHRcdFx0dHJpZ2dlcjogbmV3IEZvcm1WYWxpZGF0aW9uLnBsdWdpbnMuVHJpZ2dlcigpLFxyXG5cdFx0XHRcdFx0Ym9vdHN0cmFwOiBuZXcgRm9ybVZhbGlkYXRpb24ucGx1Z2lucy5Cb290c3RyYXA1KHtcclxuXHRcdFx0XHRcdFx0cm93U2VsZWN0b3I6ICcuZnYtcm93JyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgZWxlSW52YWxpZENsYXNzOiAnJyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgZWxlVmFsaWRDbGFzczogJydcclxuXHRcdFx0XHRcdH0pXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9XHJcblx0XHQpO1xyXG5cclxuICAgICAgICAvLyBIYW5kbGUgYXBwcyBzdWJtaXRpb25cclxuICAgICAgICBzbXNTdWJtaXRCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcblxyXG5cdFx0XHQvLyBWYWxpZGF0ZSBmb3JtIGJlZm9yZSBzdWJtaXRcclxuXHRcdFx0aWYgKHNtc1ZhbGlkYXRvcikge1xyXG5cdFx0XHRcdHNtc1ZhbGlkYXRvci52YWxpZGF0ZSgpLnRoZW4oZnVuY3Rpb24gKHN0YXR1cykge1xyXG5cdFx0XHRcdFx0Y29uc29sZS5sb2coJ3ZhbGlkYXRlZCEnKTtcclxuXHJcblx0XHRcdFx0XHRpZiAoc3RhdHVzID09ICdWYWxpZCcpIHtcclxuXHRcdFx0XHRcdFx0Ly8gU2hvdyBsb2FkaW5nIGluZGljYXRpb25cclxuXHRcdFx0XHRcdFx0c21zU3VibWl0QnV0dG9uLnNldEF0dHJpYnV0ZSgnZGF0YS1tdi1pbmRpY2F0b3InLCAnb24nKTtcclxuXHJcblx0XHRcdFx0XHRcdC8vIERpc2FibGUgYnV0dG9uIHRvIGF2b2lkIG11bHRpcGxlIGNsaWNrXHJcblx0XHRcdFx0XHRcdHNtc1N1Ym1pdEJ1dHRvbi5kaXNhYmxlZCA9IHRydWU7XHJcblxyXG5cdFx0XHRcdFx0XHQvLyBTaW11bGF0ZSBhamF4IHByb2Nlc3NcclxuXHRcdFx0XHRcdFx0c2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuXHRcdFx0XHRcdFx0XHQvLyBSZW1vdmUgbG9hZGluZyBpbmRpY2F0aW9uXHJcblx0XHRcdFx0XHRcdFx0c21zU3VibWl0QnV0dG9uLnJlbW92ZUF0dHJpYnV0ZSgnZGF0YS1tdi1pbmRpY2F0b3InKTtcclxuXHJcblx0XHRcdFx0XHRcdFx0Ly8gRW5hYmxlIGJ1dHRvblxyXG5cdFx0XHRcdFx0XHRcdHNtc1N1Ym1pdEJ1dHRvbi5kaXNhYmxlZCA9IGZhbHNlO1xyXG5cclxuXHRcdFx0XHRcdFx0XHQvLyBTaG93IHN1Y2Nlc3MgbWVzc2FnZS4gRm9yIG1vcmUgaW5mbyBjaGVjayB0aGUgcGx1Z2luJ3Mgb2ZmaWNpYWwgZG9jdW1lbnRhdGlvbjogaHR0cHM6Ly9zd2VldGFsZXJ0Mi5naXRodWIuaW8vXHJcblx0XHRcdFx0XHRcdFx0U3dhbC5maXJlKHtcclxuXHRcdFx0XHRcdFx0XHRcdHRleHQ6IFwiTW9iaWxlIG51bWJlciBoYXMgYmVlbiBzdWNjZXNzZnVsbHkgc3VibWl0dGVkIVwiLFxyXG5cdFx0XHRcdFx0XHRcdFx0aWNvbjogXCJzdWNjZXNzXCIsXHJcblx0XHRcdFx0XHRcdFx0XHRidXR0b25zU3R5bGluZzogZmFsc2UsXHJcblx0XHRcdFx0XHRcdFx0XHRjb25maXJtQnV0dG9uVGV4dDogXCJPaywgZ290IGl0IVwiLFxyXG5cdFx0XHRcdFx0XHRcdFx0Y3VzdG9tQ2xhc3M6IHtcclxuXHRcdFx0XHRcdFx0XHRcdFx0Y29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIlxyXG5cdFx0XHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0XHRcdH0pLnRoZW4oZnVuY3Rpb24gKHJlc3VsdCkge1xyXG5cdFx0XHRcdFx0XHRcdFx0aWYgKHJlc3VsdC5pc0NvbmZpcm1lZCkge1xyXG5cdFx0XHRcdFx0XHRcdFx0XHRtb2RhbE9iamVjdC5oaWRlKCk7XHJcblx0XHRcdFx0XHRcdFx0XHRcdHNob3dPcHRpb25zRm9ybSgpO1xyXG5cdFx0XHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0XHRcdH0pO1xyXG5cclxuXHRcdFx0XHRcdFx0XHQvL3Ntc0Zvcm0uc3VibWl0KCk7IC8vIFN1Ym1pdCBmb3JtXHJcblx0XHRcdFx0XHRcdH0sIDIwMDApO1xyXG5cdFx0XHRcdFx0fSBlbHNlIHtcclxuXHRcdFx0XHRcdFx0Ly8gU2hvdyBlcnJvciBtZXNzYWdlLlxyXG5cdFx0XHRcdFx0XHRTd2FsLmZpcmUoe1xyXG5cdFx0XHRcdFx0XHRcdHRleHQ6IFwiU29ycnksIGxvb2tzIGxpa2UgdGhlcmUgYXJlIHNvbWUgZXJyb3JzIGRldGVjdGVkLCBwbGVhc2UgdHJ5IGFnYWluLlwiLFxyXG5cdFx0XHRcdFx0XHRcdGljb246IFwiZXJyb3JcIixcclxuXHRcdFx0XHRcdFx0XHRidXR0b25zU3R5bGluZzogZmFsc2UsXHJcblx0XHRcdFx0XHRcdFx0Y29uZmlybUJ1dHRvblRleHQ6IFwiT2ssIGdvdCBpdCFcIixcclxuXHRcdFx0XHRcdFx0XHRjdXN0b21DbGFzczoge1xyXG5cdFx0XHRcdFx0XHRcdFx0Y29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIlxyXG5cdFx0XHRcdFx0XHRcdH1cclxuXHRcdFx0XHRcdFx0fSk7XHJcblx0XHRcdFx0XHR9XHJcblx0XHRcdFx0fSk7XHJcblx0XHRcdH1cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gSGFuZGxlIHNtcyBjYW5jZWxhdGlvblxyXG4gICAgICAgIHNtc0NhbmNlbEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgdmFyIG9wdGlvbiA9IG9wdGlvbnNXcmFwcGVyLnF1ZXJ5U2VsZWN0b3IoJ1tuYW1lPVwiYXV0aF9vcHRpb25cIl06Y2hlY2tlZCcpO1xyXG5cclxuICAgICAgICAgICAgb3B0aW9uc1dyYXBwZXIuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJyk7XHJcbiAgICAgICAgICAgIHNtc1dyYXBwZXIuY2xhc3NMaXN0LmFkZCgnZC1ub25lJyk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgdmFyIGhhbmRsZUFwcHNGb3JtID0gZnVuY3Rpb24oKSB7XHJcblx0XHQvLyBJbml0IGZvcm0gdmFsaWRhdGlvbiBydWxlcy4gRm9yIG1vcmUgaW5mbyBjaGVjayB0aGUgRm9ybVZhbGlkYXRpb24gcGx1Z2luJ3Mgb2ZmaWNpYWwgZG9jdW1lbnRhdGlvbjpodHRwczovL2Zvcm12YWxpZGF0aW9uLmlvL1xyXG5cdFx0YXBwc1ZhbGlkYXRvciA9IEZvcm1WYWxpZGF0aW9uLmZvcm1WYWxpZGF0aW9uKFxyXG5cdFx0XHRhcHBzRm9ybSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdGZpZWxkczoge1xyXG5cdFx0XHRcdFx0J2NvZGUnOiB7XHJcblx0XHRcdFx0XHRcdHZhbGlkYXRvcnM6IHtcclxuXHRcdFx0XHRcdFx0XHRub3RFbXB0eToge1xyXG5cdFx0XHRcdFx0XHRcdFx0bWVzc2FnZTogJ0NvZGUgaXMgcmVxdWlyZWQnXHJcblx0XHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHR9XHJcblx0XHRcdFx0fSxcclxuXHRcdFx0XHRwbHVnaW5zOiB7XHJcblx0XHRcdFx0XHR0cmlnZ2VyOiBuZXcgRm9ybVZhbGlkYXRpb24ucGx1Z2lucy5UcmlnZ2VyKCksXHJcblx0XHRcdFx0XHRib290c3RyYXA6IG5ldyBGb3JtVmFsaWRhdGlvbi5wbHVnaW5zLkJvb3RzdHJhcDUoe1xyXG5cdFx0XHRcdFx0XHRyb3dTZWxlY3RvcjogJy5mdi1yb3cnLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBlbGVJbnZhbGlkQ2xhc3M6ICcnLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBlbGVWYWxpZENsYXNzOiAnJ1xyXG5cdFx0XHRcdFx0fSlcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHRcdCk7XHJcblxyXG4gICAgICAgIC8vIEhhbmRsZSBhcHBzIHN1Ym1pdGlvblxyXG4gICAgICAgIGFwcHNTdWJtaXRCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcblxyXG5cdFx0XHQvLyBWYWxpZGF0ZSBmb3JtIGJlZm9yZSBzdWJtaXRcclxuXHRcdFx0aWYgKGFwcHNWYWxpZGF0b3IpIHtcclxuXHRcdFx0XHRhcHBzVmFsaWRhdG9yLnZhbGlkYXRlKCkudGhlbihmdW5jdGlvbiAoc3RhdHVzKSB7XHJcblx0XHRcdFx0XHRjb25zb2xlLmxvZygndmFsaWRhdGVkIScpO1xyXG5cclxuXHRcdFx0XHRcdGlmIChzdGF0dXMgPT0gJ1ZhbGlkJykge1xyXG5cdFx0XHRcdFx0XHRhcHBzU3VibWl0QnV0dG9uLnNldEF0dHJpYnV0ZSgnZGF0YS1tdi1pbmRpY2F0b3InLCAnb24nKTtcclxuXHJcblx0XHRcdFx0XHRcdC8vIERpc2FibGUgYnV0dG9uIHRvIGF2b2lkIG11bHRpcGxlIGNsaWNrXHJcblx0XHRcdFx0XHRcdGFwcHNTdWJtaXRCdXR0b24uZGlzYWJsZWQgPSB0cnVlO1xyXG5cclxuXHRcdFx0XHRcdFx0c2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuXHRcdFx0XHRcdFx0XHRhcHBzU3VibWl0QnV0dG9uLnJlbW92ZUF0dHJpYnV0ZSgnZGF0YS1tdi1pbmRpY2F0b3InKTtcclxuXHJcblx0XHRcdFx0XHRcdFx0Ly8gRW5hYmxlIGJ1dHRvblxyXG5cdFx0XHRcdFx0XHRcdGFwcHNTdWJtaXRCdXR0b24uZGlzYWJsZWQgPSBmYWxzZTtcclxuXHJcblx0XHRcdFx0XHRcdFx0Ly8gU2hvdyBzdWNjZXNzIG1lc3NhZ2UuXHJcblx0XHRcdFx0XHRcdFx0U3dhbC5maXJlKHtcclxuXHRcdFx0XHRcdFx0XHRcdHRleHQ6IFwiQ29kZSBoYXMgYmVlbiBzdWNjZXNzZnVsbHkgc3VibWl0dGVkIVwiLFxyXG5cdFx0XHRcdFx0XHRcdFx0aWNvbjogXCJzdWNjZXNzXCIsXHJcblx0XHRcdFx0XHRcdFx0XHRidXR0b25zU3R5bGluZzogZmFsc2UsXHJcblx0XHRcdFx0XHRcdFx0XHRjb25maXJtQnV0dG9uVGV4dDogXCJPaywgZ290IGl0IVwiLFxyXG5cdFx0XHRcdFx0XHRcdFx0Y3VzdG9tQ2xhc3M6IHtcclxuXHRcdFx0XHRcdFx0XHRcdFx0Y29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIlxyXG5cdFx0XHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0XHRcdH0pLnRoZW4oZnVuY3Rpb24gKHJlc3VsdCkge1xyXG5cdFx0XHRcdFx0XHRcdFx0aWYgKHJlc3VsdC5pc0NvbmZpcm1lZCkge1xyXG5cdFx0XHRcdFx0XHRcdFx0XHRtb2RhbE9iamVjdC5oaWRlKCk7XHJcblx0XHRcdFx0XHRcdFx0XHRcdHNob3dPcHRpb25zRm9ybSgpO1xyXG5cdFx0XHRcdFx0XHRcdFx0fVxyXG5cdFx0XHRcdFx0XHRcdH0pO1xyXG5cclxuXHRcdFx0XHRcdFx0XHQvL2FwcHNGb3JtLnN1Ym1pdCgpOyAvLyBTdWJtaXQgZm9ybVxyXG5cdFx0XHRcdFx0XHR9LCAyMDAwKTtcclxuXHRcdFx0XHRcdH0gZWxzZSB7XHJcblx0XHRcdFx0XHRcdC8vIFNob3cgZXJyb3IgbWVzc2FnZS5cclxuXHRcdFx0XHRcdFx0U3dhbC5maXJlKHtcclxuXHRcdFx0XHRcdFx0XHR0ZXh0OiBcIlNvcnJ5LCBsb29rcyBsaWtlIHRoZXJlIGFyZSBzb21lIGVycm9ycyBkZXRlY3RlZCwgcGxlYXNlIHRyeSBhZ2Fpbi5cIixcclxuXHRcdFx0XHRcdFx0XHRpY29uOiBcImVycm9yXCIsXHJcblx0XHRcdFx0XHRcdFx0YnV0dG9uc1N0eWxpbmc6IGZhbHNlLFxyXG5cdFx0XHRcdFx0XHRcdGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcblx0XHRcdFx0XHRcdFx0Y3VzdG9tQ2xhc3M6IHtcclxuXHRcdFx0XHRcdFx0XHRcdGNvbmZpcm1CdXR0b246IFwiYnRuIGJ0bi1wcmltYXJ5XCJcclxuXHRcdFx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHRcdH0pO1xyXG5cdFx0XHRcdFx0fVxyXG5cdFx0XHRcdH0pO1xyXG5cdFx0XHR9XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIC8vIEhhbmRsZSBhcHBzIGNhbmNlbGF0aW9uXHJcbiAgICAgICAgYXBwc0NhbmNlbEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgdmFyIG9wdGlvbiA9IG9wdGlvbnNXcmFwcGVyLnF1ZXJ5U2VsZWN0b3IoJ1tuYW1lPVwiYXV0aF9vcHRpb25cIl06Y2hlY2tlZCcpO1xyXG5cclxuICAgICAgICAgICAgb3B0aW9uc1dyYXBwZXIuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJyk7XHJcbiAgICAgICAgICAgIGFwcHNXcmFwcGVyLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIFB1YmxpYyBtZXRob2RzXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgLy8gRWxlbWVudHNcclxuICAgICAgICAgICAgbW9kYWwgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjbXZfbW9kYWxfdHdvX2ZhY3Rvcl9hdXRoZW50aWNhdGlvbicpO1xyXG5cclxuXHRcdFx0aWYgKCFtb2RhbCkge1xyXG5cdFx0XHRcdHJldHVybjtcclxuXHRcdFx0fVxyXG5cclxuICAgICAgICAgICAgbW9kYWxPYmplY3QgPSBuZXcgYm9vdHN0cmFwLk1vZGFsKG1vZGFsKTtcclxuXHJcbiAgICAgICAgICAgIG9wdGlvbnNXcmFwcGVyID0gbW9kYWwucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtZWxlbWVudD1cIm9wdGlvbnNcIl0nKTtcclxuICAgICAgICAgICAgb3B0aW9uc1NlbGVjdEJ1dHRvbiA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJvcHRpb25zLXNlbGVjdFwiXScpO1xyXG5cclxuICAgICAgICAgICAgc21zV3JhcHBlciA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJzbXNcIl0nKTtcclxuICAgICAgICAgICAgc21zRm9ybSA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJzbXMtZm9ybVwiXScpO1xyXG4gICAgICAgICAgICBzbXNTdWJtaXRCdXR0b24gPSBtb2RhbC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi1lbGVtZW50PVwic21zLXN1Ym1pdFwiXScpO1xyXG4gICAgICAgICAgICBzbXNDYW5jZWxCdXR0b24gPSBtb2RhbC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi1lbGVtZW50PVwic21zLWNhbmNlbFwiXScpO1xyXG5cclxuICAgICAgICAgICAgYXBwc1dyYXBwZXIgPSBtb2RhbC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi1lbGVtZW50PVwiYXBwc1wiXScpO1xyXG4gICAgICAgICAgICBhcHBzRm9ybSA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJhcHBzLWZvcm1cIl0nKTtcclxuICAgICAgICAgICAgYXBwc1N1Ym1pdEJ1dHRvbiA9IG1vZGFsLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LWVsZW1lbnQ9XCJhcHBzLXN1Ym1pdFwiXScpO1xyXG4gICAgICAgICAgICBhcHBzQ2FuY2VsQnV0dG9uID0gbW9kYWwucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtZWxlbWVudD1cImFwcHMtY2FuY2VsXCJdJyk7XHJcblxyXG4gICAgICAgICAgICAvLyBIYW5kbGUgZm9ybXNcclxuICAgICAgICAgICAgaGFuZGxlT3B0aW9uc0Zvcm0oKTtcclxuICAgICAgICAgICAgaGFuZGxlU01TRm9ybSgpO1xyXG4gICAgICAgICAgICBoYW5kbGVBcHBzRm9ybSgpO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuTVZVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIE1WTW9kYWxUd29GYWN0b3JBdXRoZW50aWNhdGlvbi5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiTVZNb2RhbFR3b0ZhY3RvckF1dGhlbnRpY2F0aW9uIiwibW9kYWwiLCJtb2RhbE9iamVjdCIsIm9wdGlvbnNXcmFwcGVyIiwib3B0aW9uc1NlbGVjdEJ1dHRvbiIsInNtc1dyYXBwZXIiLCJzbXNGb3JtIiwic21zU3VibWl0QnV0dG9uIiwic21zQ2FuY2VsQnV0dG9uIiwic21zVmFsaWRhdG9yIiwiYXBwc1dyYXBwZXIiLCJhcHBzRm9ybSIsImFwcHNTdWJtaXRCdXR0b24iLCJhcHBzQ2FuY2VsQnV0dG9uIiwiYXBwc1ZhbGlkYXRvciIsImhhbmRsZU9wdGlvbnNGb3JtIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJwcmV2ZW50RGVmYXVsdCIsIm9wdGlvbiIsInF1ZXJ5U2VsZWN0b3IiLCJjbGFzc0xpc3QiLCJhZGQiLCJ2YWx1ZSIsInJlbW92ZSIsInNob3dPcHRpb25zRm9ybSIsImhhbmRsZVNNU0Zvcm0iLCJGb3JtVmFsaWRhdGlvbiIsImZvcm1WYWxpZGF0aW9uIiwiZmllbGRzIiwidmFsaWRhdG9ycyIsIm5vdEVtcHR5IiwibWVzc2FnZSIsInBsdWdpbnMiLCJ0cmlnZ2VyIiwiVHJpZ2dlciIsImJvb3RzdHJhcCIsIkJvb3RzdHJhcDUiLCJyb3dTZWxlY3RvciIsImVsZUludmFsaWRDbGFzcyIsImVsZVZhbGlkQ2xhc3MiLCJ2YWxpZGF0ZSIsInRoZW4iLCJzdGF0dXMiLCJjb25zb2xlIiwibG9nIiwic2V0QXR0cmlidXRlIiwiZGlzYWJsZWQiLCJzZXRUaW1lb3V0IiwicmVtb3ZlQXR0cmlidXRlIiwiU3dhbCIsImZpcmUiLCJ0ZXh0IiwiaWNvbiIsImJ1dHRvbnNTdHlsaW5nIiwiY29uZmlybUJ1dHRvblRleHQiLCJjdXN0b21DbGFzcyIsImNvbmZpcm1CdXR0b24iLCJyZXN1bHQiLCJpc0NvbmZpcm1lZCIsImhpZGUiLCJoYW5kbGVBcHBzRm9ybSIsImluaXQiLCJkb2N1bWVudCIsIk1vZGFsIiwiTVZVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/extended/js/custom/modals/two-factor-authentication.js\n");

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