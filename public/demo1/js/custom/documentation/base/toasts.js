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

/***/ "./resources/assets/core/js/custom/documentation/base/toasts.js":
/*!**********************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/base/toasts.js ***!
  \**********************************************************************/
/***/ (() => {

eval(" // Class definition\n\nvar MVBaseToastDemos = function () {\n  // Private functions\n  var exampleToggle = function exampleToggle() {\n    // Select elements\n    var button = document.getElementById('mv_docs_toast_toggle_button');\n    var toastElement = document.getElementById('mv_docs_toast_toggle'); // Get toast instance --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#getinstance\n\n    var toast = bootstrap.Toast.getOrCreateInstance(toastElement); // Handle button click\n\n    button.addEventListener('click', function (e) {\n      e.preventDefault(); // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show\n\n      toast.show();\n    });\n  };\n\n  var exampleStack = function exampleStack() {\n    // Select elements\n    var button = document.getElementById('mv_docs_toast_stack_button');\n    var container = document.getElementById('mv_docs_toast_stack_container');\n    var targetElement = document.querySelector('[data-mv-docs-toast=\"stack\"]'); // Use CSS class or HTML attr to avoid duplicating ids\n    // Remove base element markup\n\n    targetElement.parentNode.removeChild(targetElement); // Handle button click\n\n    button.addEventListener('click', function (e) {\n      e.preventDefault(); // Create new toast element\n\n      var newToast = targetElement.cloneNode(true);\n      container.append(newToast); // Create new toast instance --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#getorcreateinstance\n\n      var toast = bootstrap.Toast.getOrCreateInstance(newToast); // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show\n\n      toast.show();\n    });\n  };\n\n  return {\n    // Public Functions\n    init: function init() {\n      exampleToggle();\n      exampleStack();\n    }\n  };\n}(); // On document ready\n\n\nMVUtil.onDOMContentLoaded(function () {\n  MVBaseToastDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vYmFzZS90b2FzdHMuanMuanMiLCJtYXBwaW5ncyI6IkNBRUE7O0FBQ0EsSUFBTUEsZ0JBQWdCLEdBQUcsWUFBWTtBQUNqQztBQUNBLE1BQU1DLGFBQWEsR0FBRyxTQUFoQkEsYUFBZ0IsR0FBTTtBQUN4QjtBQUNBLFFBQU1DLE1BQU0sR0FBR0MsUUFBUSxDQUFDQyxjQUFULENBQXdCLDZCQUF4QixDQUFmO0FBQ0EsUUFBTUMsWUFBWSxHQUFHRixRQUFRLENBQUNDLGNBQVQsQ0FBd0Isc0JBQXhCLENBQXJCLENBSHdCLENBS3hCOztBQUNBLFFBQU1FLEtBQUssR0FBR0MsU0FBUyxDQUFDQyxLQUFWLENBQWdCQyxtQkFBaEIsQ0FBb0NKLFlBQXBDLENBQWQsQ0FOd0IsQ0FReEI7O0FBQ0FILElBQUFBLE1BQU0sQ0FBQ1EsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsVUFBQUMsQ0FBQyxFQUFJO0FBQ2xDQSxNQUFBQSxDQUFDLENBQUNDLGNBQUYsR0FEa0MsQ0FHbEM7O0FBQ0FOLE1BQUFBLEtBQUssQ0FBQ08sSUFBTjtBQUNILEtBTEQ7QUFNSCxHQWZEOztBQWlCQSxNQUFNQyxZQUFZLEdBQUcsU0FBZkEsWUFBZSxHQUFNO0FBQ3ZCO0FBQ0EsUUFBTVosTUFBTSxHQUFHQyxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsNEJBQXhCLENBQWY7QUFDQSxRQUFNVyxTQUFTLEdBQUdaLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QiwrQkFBeEIsQ0FBbEI7QUFDQSxRQUFNWSxhQUFhLEdBQUdiLFFBQVEsQ0FBQ2MsYUFBVCxDQUF1Qiw4QkFBdkIsQ0FBdEIsQ0FKdUIsQ0FJdUQ7QUFFOUU7O0FBQ0FELElBQUFBLGFBQWEsQ0FBQ0UsVUFBZCxDQUF5QkMsV0FBekIsQ0FBcUNILGFBQXJDLEVBUHVCLENBU3ZCOztBQUNBZCxJQUFBQSxNQUFNLENBQUNRLGdCQUFQLENBQXdCLE9BQXhCLEVBQWlDLFVBQUFDLENBQUMsRUFBSTtBQUNsQ0EsTUFBQUEsQ0FBQyxDQUFDQyxjQUFGLEdBRGtDLENBR2xDOztBQUNBLFVBQU1RLFFBQVEsR0FBR0osYUFBYSxDQUFDSyxTQUFkLENBQXdCLElBQXhCLENBQWpCO0FBQ0FOLE1BQUFBLFNBQVMsQ0FBQ08sTUFBVixDQUFpQkYsUUFBakIsRUFMa0MsQ0FPbEM7O0FBQ0EsVUFBTWQsS0FBSyxHQUFHQyxTQUFTLENBQUNDLEtBQVYsQ0FBZ0JDLG1CQUFoQixDQUFvQ1csUUFBcEMsQ0FBZCxDQVJrQyxDQVVsQzs7QUFDQWQsTUFBQUEsS0FBSyxDQUFDTyxJQUFOO0FBQ0gsS0FaRDtBQWFILEdBdkJEOztBQXlCQSxTQUFPO0FBQ0g7QUFDQVUsSUFBQUEsSUFBSSxFQUFFLGdCQUFZO0FBQ2R0QixNQUFBQSxhQUFhO0FBQ2JhLE1BQUFBLFlBQVk7QUFDZjtBQUxFLEdBQVA7QUFPSCxDQW5Ed0IsRUFBekIsQyxDQXFEQTs7O0FBQ0FVLE1BQU0sQ0FBQ0Msa0JBQVAsQ0FBMEIsWUFBWTtBQUNsQ3pCLEVBQUFBLGdCQUFnQixDQUFDdUIsSUFBakI7QUFDSCxDQUZEIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2Jhc2UvdG9hc3RzLmpzPzM3OWIiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcbmNvbnN0IE1WQmFzZVRvYXN0RGVtb3MgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgY29uc3QgZXhhbXBsZVRvZ2dsZSA9ICgpID0+IHtcclxuICAgICAgICAvLyBTZWxlY3QgZWxlbWVudHNcclxuICAgICAgICBjb25zdCBidXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbXZfZG9jc190b2FzdF90b2dnbGVfYnV0dG9uJyk7XHJcbiAgICAgICAgY29uc3QgdG9hc3RFbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ212X2RvY3NfdG9hc3RfdG9nZ2xlJyk7XHJcblxyXG4gICAgICAgIC8vIEdldCB0b2FzdCBpbnN0YW5jZSAtLS0gbW9yZSBpbmZvOiBodHRwczovL2dldGJvb3RzdHJhcC5jb20vZG9jcy81LjEvY29tcG9uZW50cy90b2FzdHMvI2dldGluc3RhbmNlXHJcbiAgICAgICAgY29uc3QgdG9hc3QgPSBib290c3RyYXAuVG9hc3QuZ2V0T3JDcmVhdGVJbnN0YW5jZSh0b2FzdEVsZW1lbnQpO1xyXG5cclxuICAgICAgICAvLyBIYW5kbGUgYnV0dG9uIGNsaWNrXHJcbiAgICAgICAgYnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZSA9PiB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcbiAgICAgICAgICAgIC8vIFRvZ2dsZSB0b2FzdCB0byBzaG93IC0tLSBtb3JlIGluZm86IGh0dHBzOi8vZ2V0Ym9vdHN0cmFwLmNvbS9kb2NzLzUuMS9jb21wb25lbnRzL3RvYXN0cy8jc2hvd1xyXG4gICAgICAgICAgICB0b2FzdC5zaG93KCk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgY29uc3QgZXhhbXBsZVN0YWNrID0gKCkgPT4ge1xyXG4gICAgICAgIC8vIFNlbGVjdCBlbGVtZW50c1xyXG4gICAgICAgIGNvbnN0IGJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtdl9kb2NzX3RvYXN0X3N0YWNrX2J1dHRvbicpO1xyXG4gICAgICAgIGNvbnN0IGNvbnRhaW5lciA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtdl9kb2NzX3RvYXN0X3N0YWNrX2NvbnRhaW5lcicpO1xyXG4gICAgICAgIGNvbnN0IHRhcmdldEVsZW1lbnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi1kb2NzLXRvYXN0PVwic3RhY2tcIl0nKTsgLy8gVXNlIENTUyBjbGFzcyBvciBIVE1MIGF0dHIgdG8gYXZvaWQgZHVwbGljYXRpbmcgaWRzXHJcblxyXG4gICAgICAgIC8vIFJlbW92ZSBiYXNlIGVsZW1lbnQgbWFya3VwXHJcbiAgICAgICAgdGFyZ2V0RWxlbWVudC5wYXJlbnROb2RlLnJlbW92ZUNoaWxkKHRhcmdldEVsZW1lbnQpO1xyXG5cclxuICAgICAgICAvLyBIYW5kbGUgYnV0dG9uIGNsaWNrXHJcbiAgICAgICAgYnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZSA9PiB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcbiAgICAgICAgICAgIC8vIENyZWF0ZSBuZXcgdG9hc3QgZWxlbWVudFxyXG4gICAgICAgICAgICBjb25zdCBuZXdUb2FzdCA9IHRhcmdldEVsZW1lbnQuY2xvbmVOb2RlKHRydWUpO1xyXG4gICAgICAgICAgICBjb250YWluZXIuYXBwZW5kKG5ld1RvYXN0KTtcclxuXHJcbiAgICAgICAgICAgIC8vIENyZWF0ZSBuZXcgdG9hc3QgaW5zdGFuY2UgLS0tIG1vcmUgaW5mbzogaHR0cHM6Ly9nZXRib290c3RyYXAuY29tL2RvY3MvNS4xL2NvbXBvbmVudHMvdG9hc3RzLyNnZXRvcmNyZWF0ZWluc3RhbmNlXHJcbiAgICAgICAgICAgIGNvbnN0IHRvYXN0ID0gYm9vdHN0cmFwLlRvYXN0LmdldE9yQ3JlYXRlSW5zdGFuY2UobmV3VG9hc3QpO1xyXG5cclxuICAgICAgICAgICAgLy8gVG9nZ2xlIHRvYXN0IHRvIHNob3cgLS0tIG1vcmUgaW5mbzogaHR0cHM6Ly9nZXRib290c3RyYXAuY29tL2RvY3MvNS4xL2NvbXBvbmVudHMvdG9hc3RzLyNzaG93XHJcbiAgICAgICAgICAgIHRvYXN0LnNob3coKTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGV4YW1wbGVUb2dnbGUoKTtcclxuICAgICAgICAgICAgZXhhbXBsZVN0YWNrKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuTVZVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbiAoKSB7XHJcbiAgICBNVkJhc2VUb2FzdERlbW9zLmluaXQoKTtcclxufSk7Il0sIm5hbWVzIjpbIk1WQmFzZVRvYXN0RGVtb3MiLCJleGFtcGxlVG9nZ2xlIiwiYnV0dG9uIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsInRvYXN0RWxlbWVudCIsInRvYXN0IiwiYm9vdHN0cmFwIiwiVG9hc3QiLCJnZXRPckNyZWF0ZUluc3RhbmNlIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJwcmV2ZW50RGVmYXVsdCIsInNob3ciLCJleGFtcGxlU3RhY2siLCJjb250YWluZXIiLCJ0YXJnZXRFbGVtZW50IiwicXVlcnlTZWxlY3RvciIsInBhcmVudE5vZGUiLCJyZW1vdmVDaGlsZCIsIm5ld1RvYXN0IiwiY2xvbmVOb2RlIiwiYXBwZW5kIiwiaW5pdCIsIk1WVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/base/toasts.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/base/toasts.js"]();
/******/ 	
/******/ })()
;