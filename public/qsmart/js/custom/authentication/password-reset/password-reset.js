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

/***/ "./resources/assets/extended/js/custom/authentication/password-reset/password-reset.js":
/*!*********************************************************************************************!*\
  !*** ./resources/assets/extended/js/custom/authentication/password-reset/password-reset.js ***!
  \*********************************************************************************************/
/***/ (() => {

eval("\n\n// Class Definition\nvar MVPasswordResetGeneral = function () {\n  // Elements\n  var form;\n  var submitButton;\n  var validator;\n\n  // Handle form\n  var handleForm = function handleForm(e) {\n    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/\n    validator = FormValidation.formValidation(form, {\n      fields: {\n        'email': {\n          validators: {\n            notEmpty: {\n              message: 'Email address is required'\n            },\n            emailAddress: {\n              message: 'The value is not a valid email address'\n            }\n          }\n        }\n      },\n      plugins: {\n        trigger: new FormValidation.plugins.Trigger(),\n        bootstrap: new FormValidation.plugins.Bootstrap5({\n          rowSelector: '.fv-row',\n          eleInvalidClass: '',\n          eleValidClass: ''\n        })\n      }\n    });\n\n    // Handle form submit\n    submitButton.addEventListener('click', function (e) {\n      // Prevent button default action\n      e.preventDefault();\n\n      // Validate form\n      validator.validate().then(function (status) {\n        if (status === 'Valid') {\n          // Show loading indication\n          submitButton.setAttribute('data-mv-indicator', 'on');\n\n          // Disable button to avoid multiple click\n          submitButton.disabled = true;\n\n          // Simulate ajax request\n          axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {\n            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/\n            Swal.fire({\n              text: \"Please check your email to proceed with the password reset.\",\n              icon: \"success\",\n              buttonsStyling: false,\n              confirmButtonText: \"Ok, got it!\",\n              customClass: {\n                confirmButton: \"btn btn-primary\"\n              }\n            }).then(function (result) {\n              if (result.isConfirmed) {\n                form.querySelector('[name=\"email\"]').value = \"\";\n              }\n            });\n          })[\"catch\"](function (error) {\n            var dataMessage = error.response.data.message;\n            var dataErrors = error.response.data.errors;\n            for (var errorsKey in dataErrors) {\n              if (!dataErrors.hasOwnProperty(errorsKey)) continue;\n              dataMessage += \"\\r\\n\" + dataErrors[errorsKey];\n            }\n            if (error.response) {\n              Swal.fire({\n                text: dataMessage,\n                icon: \"error\",\n                buttonsStyling: false,\n                confirmButtonText: \"Ok, got it!\",\n                customClass: {\n                  confirmButton: \"btn btn-primary\"\n                }\n              });\n            }\n          }).then(function () {\n            // always executed\n            // Hide loading indication\n            submitButton.removeAttribute('data-mv-indicator');\n\n            // Enable button\n            submitButton.disabled = false;\n          });\n        } else {\n          // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/\n          Swal.fire({\n            text: \"Sorry, looks like there are some errors detected, please try again.\",\n            icon: \"error\",\n            buttonsStyling: false,\n            confirmButtonText: \"Ok, got it!\",\n            customClass: {\n              confirmButton: \"btn btn-primary\"\n            }\n          });\n        }\n      });\n    });\n  };\n\n  // Public functions\n  return {\n    // Initialization\n    init: function init() {\n      form = document.querySelector('#mv_password_reset_form');\n      submitButton = document.querySelector('#mv_password_reset_submit');\n      handleForm();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVPasswordResetGeneral.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2V4dGVuZGVkL2pzL2N1c3RvbS9hdXRoZW50aWNhdGlvbi9wYXNzd29yZC1yZXNldC9wYXNzd29yZC1yZXNldC5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLHNCQUFzQixHQUFHLFlBQVk7RUFDckM7RUFDQSxJQUFJQyxJQUFJO0VBQ1IsSUFBSUMsWUFBWTtFQUNoQixJQUFJQyxTQUFTOztFQUViO0VBQ0EsSUFBSUMsVUFBVSxHQUFHLFNBQWJBLFVBQVVBLENBQWFDLENBQUMsRUFBRTtJQUMxQjtJQUNBRixTQUFTLEdBQUdHLGNBQWMsQ0FBQ0MsY0FBYyxDQUNyQ04sSUFBSSxFQUNKO01BQ0lPLE1BQU0sRUFBRTtRQUNKLE9BQU8sRUFBRTtVQUNMQyxVQUFVLEVBQUU7WUFDUkMsUUFBUSxFQUFFO2NBQ05DLE9BQU8sRUFBRTtZQUNiLENBQUM7WUFDREMsWUFBWSxFQUFFO2NBQ1ZELE9BQU8sRUFBRTtZQUNiO1VBQ0o7UUFDSjtNQUNKLENBQUM7TUFDREUsT0FBTyxFQUFFO1FBQ0xDLE9BQU8sRUFBRSxJQUFJUixjQUFjLENBQUNPLE9BQU8sQ0FBQ0UsT0FBTyxDQUFDLENBQUM7UUFDN0NDLFNBQVMsRUFBRSxJQUFJVixjQUFjLENBQUNPLE9BQU8sQ0FBQ0ksVUFBVSxDQUFDO1VBQzdDQyxXQUFXLEVBQUUsU0FBUztVQUN0QkMsZUFBZSxFQUFFLEVBQUU7VUFDbkJDLGFBQWEsRUFBRTtRQUNuQixDQUFDO01BQ0w7SUFDSixDQUNKLENBQUM7O0lBRUQ7SUFDQWxCLFlBQVksQ0FBQ21CLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxVQUFVaEIsQ0FBQyxFQUFFO01BQ2hEO01BQ0FBLENBQUMsQ0FBQ2lCLGNBQWMsQ0FBQyxDQUFDOztNQUVsQjtNQUNBbkIsU0FBUyxDQUFDb0IsUUFBUSxDQUFDLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLFVBQVVDLE1BQU0sRUFBRTtRQUN4QyxJQUFJQSxNQUFNLEtBQUssT0FBTyxFQUFF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Q2pDLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvZXh0ZW5kZWQvanMvY3VzdG9tL2F1dGhlbnRpY2F0aW9uL3Bhc3N3b3JkLXJlc2V0L3Bhc3N3b3JkLXJlc2V0LmpzPzFhZWUiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBEZWZpbml0aW9uXHJcbnZhciBNVlBhc3N3b3JkUmVzZXRHZW5lcmFsID0gZnVuY3Rpb24gKCkge1xyXG4gICAgLy8gRWxlbWVudHNcclxuICAgIHZhciBmb3JtO1xyXG4gICAgdmFyIHN1Ym1pdEJ1dHRvbjtcclxuICAgIHZhciB2YWxpZGF0b3I7XHJcblxyXG4gICAgLy8gSGFuZGxlIGZvcm1cclxuICAgIHZhciBoYW5kbGVGb3JtID0gZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAvLyBJbml0IGZvcm0gdmFsaWRhdGlvbiBydWxlcy4gRm9yIG1vcmUgaW5mbyBjaGVjayB0aGUgRm9ybVZhbGlkYXRpb24gcGx1Z2luJ3Mgb2ZmaWNpYWwgZG9jdW1lbnRhdGlvbjpodHRwczovL2Zvcm12YWxpZGF0aW9uLmlvL1xyXG4gICAgICAgIHZhbGlkYXRvciA9IEZvcm1WYWxpZGF0aW9uLmZvcm1WYWxpZGF0aW9uKFxyXG4gICAgICAgICAgICBmb3JtLFxyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICBmaWVsZHM6IHtcclxuICAgICAgICAgICAgICAgICAgICAnZW1haWwnOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhbGlkYXRvcnM6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG5vdEVtcHR5OiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbWVzc2FnZTogJ0VtYWlsIGFkZHJlc3MgaXMgcmVxdWlyZWQnXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgZW1haWxBZGRyZXNzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbWVzc2FnZTogJ1RoZSB2YWx1ZSBpcyBub3QgYSB2YWxpZCBlbWFpbCBhZGRyZXNzJ1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHBsdWdpbnM6IHtcclxuICAgICAgICAgICAgICAgICAgICB0cmlnZ2VyOiBuZXcgRm9ybVZhbGlkYXRpb24ucGx1Z2lucy5UcmlnZ2VyKCksXHJcbiAgICAgICAgICAgICAgICAgICAgYm9vdHN0cmFwOiBuZXcgRm9ybVZhbGlkYXRpb24ucGx1Z2lucy5Cb290c3RyYXA1KHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcm93U2VsZWN0b3I6ICcuZnYtcm93JyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgZWxlSW52YWxpZENsYXNzOiAnJyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgZWxlVmFsaWRDbGFzczogJydcclxuICAgICAgICAgICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgKTtcclxuXHJcbiAgICAgICAgLy8gSGFuZGxlIGZvcm0gc3VibWl0XHJcbiAgICAgICAgc3VibWl0QnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgLy8gUHJldmVudCBidXR0b24gZGVmYXVsdCBhY3Rpb25cclxuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG5cclxuICAgICAgICAgICAgLy8gVmFsaWRhdGUgZm9ybVxyXG4gICAgICAgICAgICB2YWxpZGF0b3IudmFsaWRhdGUoKS50aGVuKGZ1bmN0aW9uIChzdGF0dXMpIHtcclxuICAgICAgICAgICAgICAgIGlmIChzdGF0dXMgPT09ICdWYWxpZCcpIHtcclxuICAgICAgICAgICAgICAgICAgICAvLyBTaG93IGxvYWRpbmcgaW5kaWNhdGlvblxyXG4gICAgICAgICAgICAgICAgICAgIHN1Ym1pdEJ1dHRvbi5zZXRBdHRyaWJ1dGUoJ2RhdGEtbXYtaW5kaWNhdG9yJywgJ29uJyk7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC8vIERpc2FibGUgYnV0dG9uIHRvIGF2b2lkIG11bHRpcGxlIGNsaWNrXHJcbiAgICAgICAgICAgICAgICAgICAgc3VibWl0QnV0dG9uLmRpc2FibGVkID0gdHJ1ZTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLy8gU2ltdWxhdGUgYWpheCByZXF1ZXN0XHJcbiAgICAgICAgICAgICAgICAgICAgYXhpb3MucG9zdChzdWJtaXRCdXR0b24uY2xvc2VzdCgnZm9ybScpLmdldEF0dHJpYnV0ZSgnYWN0aW9uJyksIG5ldyBGb3JtRGF0YShmb3JtKSlcclxuICAgICAgICAgICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKHJlc3BvbnNlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAvLyBTaG93IG1lc3NhZ2UgcG9wdXAuIEZvciBtb3JlIGluZm8gY2hlY2sgdGhlIHBsdWdpbidzIG9mZmljaWFsIGRvY3VtZW50YXRpb246IGh0dHBzOi8vc3dlZXRhbGVydDIuZ2l0aHViLmlvL1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0OiBcIlBsZWFzZSBjaGVjayB5b3VyIGVtYWlsIHRvIHByb2NlZWQgd2l0aCB0aGUgcGFzc3dvcmQgcmVzZXQuXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJzdWNjZXNzXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYnV0dG9uc1N0eWxpbmc6IGZhbHNlLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY3VzdG9tQ2xhc3M6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKHJlc3VsdCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmIChyZXN1bHQuaXNDb25maXJtZWQpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZm9ybS5xdWVyeVNlbGVjdG9yKCdbbmFtZT1cImVtYWlsXCJdJykudmFsdWUgPSBcIlwiO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAuY2F0Y2goZnVuY3Rpb24gKGVycm9yKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsZXQgZGF0YU1lc3NhZ2UgPSBlcnJvci5yZXNwb25zZS5kYXRhLm1lc3NhZ2U7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsZXQgZGF0YUVycm9ycyA9IGVycm9yLnJlc3BvbnNlLmRhdGEuZXJyb3JzO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGZvciAoY29uc3QgZXJyb3JzS2V5IGluIGRhdGFFcnJvcnMpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoIWRhdGFFcnJvcnMuaGFzT3duUHJvcGVydHkoZXJyb3JzS2V5KSkgY29udGludWU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZGF0YU1lc3NhZ2UgKz0gXCJcXHJcXG5cIiArIGRhdGFFcnJvcnNbZXJyb3JzS2V5XTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoZXJyb3IucmVzcG9uc2UpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBTd2FsLmZpcmUoe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0OiBkYXRhTWVzc2FnZSxcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJlcnJvclwiLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1c3RvbUNsYXNzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uOiBcImJ0biBidG4tcHJpbWFyeVwiXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgLy8gYWx3YXlzIGV4ZWN1dGVkXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAvLyBIaWRlIGxvYWRpbmcgaW5kaWNhdGlvblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgc3VibWl0QnV0dG9uLnJlbW92ZUF0dHJpYnV0ZSgnZGF0YS1tdi1pbmRpY2F0b3InKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAvLyBFbmFibGUgYnV0dG9uXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBzdWJtaXRCdXR0b24uZGlzYWJsZWQgPSBmYWxzZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgIC8vIFNob3cgZXJyb3IgcG9wdXAuIEZvciBtb3JlIGluZm8gY2hlY2sgdGhlIHBsdWdpbidzIG9mZmljaWFsIGRvY3VtZW50YXRpb246IGh0dHBzOi8vc3dlZXRhbGVydDIuZ2l0aHViLmlvL1xyXG4gICAgICAgICAgICAgICAgICAgIFN3YWwuZmlyZSh7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRleHQ6IFwiU29ycnksIGxvb2tzIGxpa2UgdGhlcmUgYXJlIHNvbWUgZXJyb3JzIGRldGVjdGVkLCBwbGVhc2UgdHJ5IGFnYWluLlwiLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBpY29uOiBcImVycm9yXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJ1dHRvbnNTdHlsaW5nOiBmYWxzZSxcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvblRleHQ6IFwiT2ssIGdvdCBpdCFcIixcclxuICAgICAgICAgICAgICAgICAgICAgICAgY3VzdG9tQ2xhc3M6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b246IFwiYnRuIGJ0bi1wcmltYXJ5XCJcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICAvLyBQdWJsaWMgZnVuY3Rpb25zXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIEluaXRpYWxpemF0aW9uXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICBmb3JtID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI212X3Bhc3N3b3JkX3Jlc2V0X2Zvcm0nKTtcclxuICAgICAgICAgICAgc3VibWl0QnV0dG9uID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI212X3Bhc3N3b3JkX3Jlc2V0X3N1Ym1pdCcpO1xyXG5cclxuICAgICAgICAgICAgaGFuZGxlRm9ybSgpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIE9uIGRvY3VtZW50IHJlYWR5XHJcbk1WVXRpbC5vbkRPTUNvbnRlbnRMb2FkZWQoZnVuY3Rpb24gKCkge1xyXG4gICAgTVZQYXNzd29yZFJlc2V0R2VuZXJhbC5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiTVZQYXNzd29yZFJlc2V0R2VuZXJhbCIsImZvcm0iLCJzdWJtaXRCdXR0b24iLCJ2YWxpZGF0b3IiLCJoYW5kbGVGb3JtIiwiZSIsIkZvcm1WYWxpZGF0aW9uIiwiZm9ybVZhbGlkYXRpb24iLCJmaWVsZHMiLCJ2YWxpZGF0b3JzIiwibm90RW1wdHkiLCJtZXNzYWdlIiwiZW1haWxBZGRyZXNzIiwicGx1Z2lucyIsInRyaWdnZXIiLCJUcmlnZ2VyIiwiYm9vdHN0cmFwIiwiQm9vdHN0cmFwNSIsInJvd1NlbGVjdG9yIiwiZWxlSW52YWxpZENsYXNzIiwiZWxlVmFsaWRDbGFzcyIsImFkZEV2ZW50TGlzdGVuZXIiLCJwcmV2ZW50RGVmYXVsdCIsInZhbGlkYXRlIiwidGhlbiIsInN0YXR1cyIsInNldEF0dHJpYnV0ZSIsImRpc2FibGVkIiwiYXhpb3MiLCJwb3N0IiwiY2xvc2VzdCIsImdldEF0dHJpYnV0ZSIsIkZvcm1EYXRhIiwicmVzcG9uc2UiLCJTd2FsIiwiZmlyZSIsInRleHQiLCJpY29uIiwiYnV0dG9uc1N0eWxpbmciLCJjb25maXJtQnV0dG9uVGV4dCIsImN1c3RvbUNsYXNzIiwiY29uZmlybUJ1dHRvbiIsInJlc3VsdCIsImlzQ29uZmlybWVkIiwicXVlcnlTZWxlY3RvciIsInZhbHVlIiwiZXJyb3IiLCJkYXRhTWVzc2FnZSIsImRhdGEiLCJkYXRhRXJyb3JzIiwiZXJyb3JzIiwiZXJyb3JzS2V5IiwiaGFzT3duUHJvcGVydHkiLCJyZW1vdmVBdHRyaWJ1dGUiLCJpbml0IiwiZG9jdW1lbnQiLCJNVlV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/extended/js/custom/authentication/password-reset/password-reset.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/extended/js/custom/authentication/password-reset/password-reset.js"]();
/******/ 	
/******/ })()
;