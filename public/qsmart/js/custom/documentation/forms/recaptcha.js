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

/***/ "./resources/assets/core/js/custom/documentation/forms/recaptcha.js":
/*!**************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/forms/recaptcha.js ***!
  \**************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsGoogleRecaptchaDemos = function () {\n  // Private functions\n  var example = function example(element) {\n    document.querySelector(\"#mv_form_submit_button\").addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      grecaptcha.ready(function () {\n        if (grecaptcha.getResponse() === \"\") {\n          alert(\"Please validate the Google reCaptcha.\");\n        } else {\n          alert(\"Successful validation! Now you can submit this form to your server side processing.\");\n        }\n      });\n    });\n  };\n  return {\n    // Public Functions\n    init: function init(element) {\n      example();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsGoogleRecaptchaDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZm9ybXMvcmVjYXB0Y2hhLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEsMkJBQTJCLEdBQUcsWUFBWTtFQUMxQztFQUNBLElBQUlDLE9BQU8sR0FBRyxTQUFWQSxPQUFPQSxDQUFhQyxPQUFPLEVBQUU7SUFDN0JDLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLHdCQUF3QixDQUFDLENBQUNDLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxVQUFVQyxDQUFDLEVBQUU7TUFDcEZBLENBQUMsQ0FBQ0MsY0FBYyxDQUFDLENBQUM7TUFFbEJDLFVBQVUsQ0FBQ0MsS0FBSyxDQUFDLFlBQVk7UUFDekIsSUFBSUQsVUFBVSxDQUFDRSxXQUFXLENBQUMsQ0FBQyxLQUFLLEVBQUUsRUFBRTtVQUNqQ0MsS0FBSyxDQUFDLHVDQUF1QyxDQUFDO1FBQ2xELENBQUMsTUFBTTtVQUNIQSxLQUFLLENBQUMscUZBQXFGLENBQUM7UUFDaEc7TUFDSixDQUFDLENBQUM7SUFDTixDQUFDLENBQUM7RUFDTixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FDLElBQUksRUFBRSxTQUFBQSxLQUFVVixPQUFPLEVBQUU7TUFDckJELE9BQU8sQ0FBQyxDQUFDO0lBQ2I7RUFDSixDQUFDO0FBQ0wsQ0FBQyxDQUFDLENBQUM7O0FBRUg7QUFDQVksTUFBTSxDQUFDQyxrQkFBa0IsQ0FBQyxZQUFZO0VBQ2xDZCwyQkFBMkIsQ0FBQ1ksSUFBSSxDQUFDLENBQUM7QUFDdEMsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2Zvcm1zL3JlY2FwdGNoYS5qcz8zYTQ1Il0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgTVZGb3Jtc0dvb2dsZVJlY2FwdGNoYURlbW9zID0gZnVuY3Rpb24gKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBleGFtcGxlID0gZnVuY3Rpb24gKGVsZW1lbnQpIHtcclxuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiI212X2Zvcm1fc3VibWl0X2J1dHRvblwiKS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG5cclxuICAgICAgICAgICAgZ3JlY2FwdGNoYS5yZWFkeShmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICBpZiAoZ3JlY2FwdGNoYS5nZXRSZXNwb25zZSgpID09PSBcIlwiKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxlcnQoXCJQbGVhc2UgdmFsaWRhdGUgdGhlIEdvb2dsZSByZUNhcHRjaGEuXCIpO1xyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICBhbGVydChcIlN1Y2Nlc3NmdWwgdmFsaWRhdGlvbiEgTm93IHlvdSBjYW4gc3VibWl0IHRoaXMgZm9ybSB0byB5b3VyIHNlcnZlciBzaWRlIHByb2Nlc3NpbmcuXCIpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoZWxlbWVudCkge1xyXG4gICAgICAgICAgICBleGFtcGxlKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuTVZVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbiAoKSB7XHJcbiAgICBNVkZvcm1zR29vZ2xlUmVjYXB0Y2hhRGVtb3MuaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIk1WRm9ybXNHb29nbGVSZWNhcHRjaGFEZW1vcyIsImV4YW1wbGUiLCJlbGVtZW50IiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImdyZWNhcHRjaGEiLCJyZWFkeSIsImdldFJlc3BvbnNlIiwiYWxlcnQiLCJpbml0IiwiTVZVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/forms/recaptcha.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/forms/recaptcha.js"]();
/******/ 	
/******/ })()
;