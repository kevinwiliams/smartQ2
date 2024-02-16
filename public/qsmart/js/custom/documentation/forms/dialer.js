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

/***/ "./resources/assets/core/js/custom/documentation/forms/dialer.js":
/*!***********************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/forms/dialer.js ***!
  \***********************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsDialerDemos = function () {\n  // Private functions\n  var example1 = function example1(element) {\n    // Dialer container element\n    var dialerElement = document.querySelector(\"#mv_dialer_example_1\");\n\n    // Create dialer object and initialize a new instance\n    var dialerObject = new MVDialer(dialerElement, {\n      min: 1000,\n      max: 50000,\n      step: 1000,\n      prefix: \"$\",\n      decimals: 2\n    });\n  };\n  return {\n    // Public Functions\n    init: function init(element) {\n      example1();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsDialerDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZm9ybXMvZGlhbGVyLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEsa0JBQWtCLEdBQUcsWUFBVztFQUNoQztFQUNBLElBQUlDLFFBQVEsR0FBRyxTQUFYQSxRQUFRQSxDQUFZQyxPQUFPLEVBQUU7SUFDN0I7SUFDQSxJQUFJQyxhQUFhLEdBQUdDLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLHNCQUFzQixDQUFDOztJQUVsRTtJQUNBLElBQUlDLFlBQVksR0FBRyxJQUFJQyxRQUFRLENBQUNKLGFBQWEsRUFBRTtNQUMzQ0ssR0FBRyxFQUFFLElBQUk7TUFDVEMsR0FBRyxFQUFFLEtBQUs7TUFDVkMsSUFBSSxFQUFFLElBQUk7TUFDVkMsTUFBTSxFQUFFLEdBQUc7TUFDWEMsUUFBUSxFQUFFO0lBQ2QsQ0FBQyxDQUFDO0VBQ04sQ0FBQztFQUVELE9BQU87SUFDSDtJQUNBQyxJQUFJLEVBQUUsU0FBQUEsS0FBU1gsT0FBTyxFQUFFO01BQ3BCRCxRQUFRLENBQUMsQ0FBQztJQUNkO0VBQ0osQ0FBQztBQUNMLENBQUMsQ0FBQyxDQUFDOztBQUVIO0FBQ0FhLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBVztFQUNqQ2Ysa0JBQWtCLENBQUNhLElBQUksQ0FBQyxDQUFDO0FBQzdCLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvY29yZS9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9mb3Jtcy9kaWFsZXIuanM/Mzk3OSJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIE1WRm9ybXNEaWFsZXJEZW1vcyA9IGZ1bmN0aW9uKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBleGFtcGxlMSA9IGZ1bmN0aW9uKGVsZW1lbnQpIHtcclxuICAgICAgICAvLyBEaWFsZXIgY29udGFpbmVyIGVsZW1lbnRcclxuICAgICAgICB2YXIgZGlhbGVyRWxlbWVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIjbXZfZGlhbGVyX2V4YW1wbGVfMVwiKTtcclxuXHJcbiAgICAgICAgLy8gQ3JlYXRlIGRpYWxlciBvYmplY3QgYW5kIGluaXRpYWxpemUgYSBuZXcgaW5zdGFuY2VcclxuICAgICAgICB2YXIgZGlhbGVyT2JqZWN0ID0gbmV3IE1WRGlhbGVyKGRpYWxlckVsZW1lbnQsIHtcclxuICAgICAgICAgICAgbWluOiAxMDAwLFxyXG4gICAgICAgICAgICBtYXg6IDUwMDAwLFxyXG4gICAgICAgICAgICBzdGVwOiAxMDAwLFxyXG4gICAgICAgICAgICBwcmVmaXg6IFwiJFwiLFxyXG4gICAgICAgICAgICBkZWNpbWFsczogMlxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uKGVsZW1lbnQpIHtcclxuICAgICAgICAgICAgZXhhbXBsZTEoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5NVlV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uKCkge1xyXG4gICAgTVZGb3Jtc0RpYWxlckRlbW9zLmluaXQoKTtcclxufSk7XHJcbiJdLCJuYW1lcyI6WyJNVkZvcm1zRGlhbGVyRGVtb3MiLCJleGFtcGxlMSIsImVsZW1lbnQiLCJkaWFsZXJFbGVtZW50IiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwiZGlhbGVyT2JqZWN0IiwiTVZEaWFsZXIiLCJtaW4iLCJtYXgiLCJzdGVwIiwicHJlZml4IiwiZGVjaW1hbHMiLCJpbml0IiwiTVZVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/forms/dialer.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/forms/dialer.js"]();
/******/ 	
/******/ })()
;