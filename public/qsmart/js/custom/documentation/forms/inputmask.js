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

/***/ "./resources/assets/core/js/custom/documentation/forms/inputmask.js":
/*!**************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/forms/inputmask.js ***!
  \**************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsInputmaskDemos = function () {\n  // Private functions\n  var _examples = function _examples() {\n    // Date\n    Inputmask({\n      \"mask\": \"99/99/9999\"\n    }).mask(\"#mv_inputmask_1\");\n\n    // Phone \n    Inputmask({\n      \"mask\": \"(999) 999-9999\"\n    }).mask(\"#mv_inputmask_2\");\n\n    // Placeholder \n    Inputmask({\n      \"mask\": \"(999) 999-9999\",\n      \"placeholder\": \"(999) 999-9999\"\n    }).mask(\"#mv_inputmask_3\");\n\n    // Repeating \n    Inputmask({\n      \"mask\": \"9\",\n      \"repeat\": 10,\n      \"greedy\": false\n    }).mask(\"#mv_inputmask_4\");\n\n    // Right aligned \n    Inputmask(\"decimal\", {\n      \"rightAlignNumerics\": false\n    }).mask(\"#mv_inputmask_5\");\n\n    // Currency\n    Inputmask(\"€ 999.999.999,99\", {\n      \"numericInput\": true\n    }).mask(\"#mv_inputmask_6\");\n\n    // Ip address\n    Inputmask({\n      \"mask\": \"999.999.999.999\"\n    }).mask(\"#mv_inputmask_7\");\n\n    // Email address\n    Inputmask({\n      mask: \"*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]\",\n      greedy: false,\n      onBeforePaste: function onBeforePaste(pastedValue, opts) {\n        pastedValue = pastedValue.toLowerCase();\n        return pastedValue.replace(\"mailto:\", \"\");\n      },\n      definitions: {\n        \"*\": {\n          validator: '[0-9A-Za-z!#$%&\"*+/=?^_`{|}~\\-]',\n          cardinality: 1,\n          casing: \"lower\"\n        }\n      }\n    }).mask(\"#mv_inputmask_8\");\n  };\n  return {\n    // Public Functions\n    init: function init(element) {\n      _examples();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsInputmaskDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZm9ybXMvaW5wdXRtYXNrLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEscUJBQXFCLEdBQUcsWUFBVztFQUNuQztFQUNBLElBQUlDLFNBQVMsR0FBRyxTQUFaQSxTQUFTQSxDQUFBLEVBQWM7SUFDdkI7SUFDQUMsU0FBUyxDQUFDO01BQ04sTUFBTSxFQUFHO0lBQ2IsQ0FBQyxDQUFDLENBQUNDLElBQUksQ0FBQyxpQkFBaUIsQ0FBQzs7SUFFMUI7SUFDQUQsU0FBUyxDQUFDO01BQ04sTUFBTSxFQUFHO0lBQ2IsQ0FBQyxDQUFDLENBQUNDLElBQUksQ0FBQyxpQkFBaUIsQ0FBQzs7SUFFMUI7SUFDQUQsU0FBUyxDQUFDO01BQ04sTUFBTSxFQUFHLGdCQUFnQjtNQUN6QixhQUFhLEVBQUU7SUFDbkIsQ0FBQyxDQUFDLENBQUNDLElBQUksQ0FBQyxpQkFBaUIsQ0FBQzs7SUFFMUI7SUFDQUQsU0FBUyxDQUFDO01BQ04sTUFBTSxFQUFFLEdBQUc7TUFDWCxRQUFRLEVBQUUsRUFBRTtNQUNaLFFBQVEsRUFBRTtJQUNkLENBQUMsQ0FBQyxDQUFDQyxJQUFJLENBQUMsaUJBQWlCLENBQUM7O0lBRTFCO0lBQ0FELFNBQVMsQ0FBQyxTQUFTLEVBQUU7TUFDakIsb0JBQW9CLEVBQUU7SUFDMUIsQ0FBQyxDQUFDLENBQUNDLElBQUksQ0FBQyxpQkFBaUIsQ0FBQzs7SUFFMUI7SUFDQUQsU0FBUyxDQUFDLGtCQUFrQixFQUFFO01BQzFCLGNBQWMsRUFBRTtJQUNwQixDQUFDLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLGlCQUFpQixDQUFDOztJQUUxQjtJQUNBRCxTQUFTLENBQUM7TUFDTixNQUFNLEVBQUU7SUFDWixDQUFDLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLGlCQUFpQixDQUFDOztJQUUxQjtJQUNBRCxTQUFTLENBQUM7TUFDTkMsSUFBSSxFQUFFLGlFQUFpRTtNQUN2RUMsTUFBTSxFQUFFLEtBQUs7TUFDYkMsYUFBYSxFQUFFLFNBQUFBLGNBQVVDLFdBQVcsRUFBRUMsSUFBSSxFQUFFO1FBQ3hDRCxXQUFXLEdBQUdBLFdBQVcsQ0FBQ0UsV0FBVyxDQUFDLENBQUM7UUFDdkMsT0FBT0YsV0FBVyxDQUFDRyxPQUFPLENBQUMsU0FBUyxFQUFFLEVBQUUsQ0FBQztNQUM3QyxDQUFDO01BQ0RDLFdBQVcsRUFBRTtRQUNULEdBQUcsRUFBRTtVQUNEQyxTQUFTLEVBQUUsaUNBQWlDO1VBQzVDQyxXQUFXLEVBQUUsQ0FBQztVQUNkQyxNQUFNLEVBQUU7UUFDWjtNQUNKO0lBQ0osQ0FBQyxDQUFDLENBQUNWLElBQUksQ0FBQyxpQkFBaUIsQ0FBQztFQUM5QixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FXLElBQUksRUFBRSxTQUFBQSxLQUFTQyxPQUFPLEVBQUU7TUFDcEJkLFNBQVMsQ0FBQyxDQUFDO0lBQ2Y7RUFDSixDQUFDO0FBQ0wsQ0FBQyxDQUFDLENBQUM7O0FBRUg7QUFDQWUsTUFBTSxDQUFDQyxrQkFBa0IsQ0FBQyxZQUFXO0VBQ2pDakIscUJBQXFCLENBQUNjLElBQUksQ0FBQyxDQUFDO0FBQ2hDLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvY29yZS9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9mb3Jtcy9pbnB1dG1hc2suanM/MDAxZCJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIE1WRm9ybXNJbnB1dG1hc2tEZW1vcyA9IGZ1bmN0aW9uKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBfZXhhbXBsZXMgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICAvLyBEYXRlXHJcbiAgICAgICAgSW5wdXRtYXNrKHtcclxuICAgICAgICAgICAgXCJtYXNrXCIgOiBcIjk5Lzk5Lzk5OTlcIlxyXG4gICAgICAgIH0pLm1hc2soXCIjbXZfaW5wdXRtYXNrXzFcIik7XHJcblxyXG4gICAgICAgIC8vIFBob25lIFxyXG4gICAgICAgIElucHV0bWFzayh7XHJcbiAgICAgICAgICAgIFwibWFza1wiIDogXCIoOTk5KSA5OTktOTk5OVwiXHJcbiAgICAgICAgfSkubWFzayhcIiNtdl9pbnB1dG1hc2tfMlwiKTtcclxuXHJcbiAgICAgICAgLy8gUGxhY2Vob2xkZXIgXHJcbiAgICAgICAgSW5wdXRtYXNrKHtcclxuICAgICAgICAgICAgXCJtYXNrXCIgOiBcIig5OTkpIDk5OS05OTk5XCIsXHJcbiAgICAgICAgICAgIFwicGxhY2Vob2xkZXJcIjogXCIoOTk5KSA5OTktOTk5OVwiLFxyXG4gICAgICAgIH0pLm1hc2soXCIjbXZfaW5wdXRtYXNrXzNcIik7XHJcblxyXG4gICAgICAgIC8vIFJlcGVhdGluZyBcclxuICAgICAgICBJbnB1dG1hc2soe1xyXG4gICAgICAgICAgICBcIm1hc2tcIjogXCI5XCIsXHJcbiAgICAgICAgICAgIFwicmVwZWF0XCI6IDEwLFxyXG4gICAgICAgICAgICBcImdyZWVkeVwiOiBmYWxzZVxyXG4gICAgICAgIH0pLm1hc2soXCIjbXZfaW5wdXRtYXNrXzRcIik7XHJcblxyXG4gICAgICAgIC8vIFJpZ2h0IGFsaWduZWQgXHJcbiAgICAgICAgSW5wdXRtYXNrKFwiZGVjaW1hbFwiLCB7XHJcbiAgICAgICAgICAgIFwicmlnaHRBbGlnbk51bWVyaWNzXCI6IGZhbHNlXHJcbiAgICAgICAgfSkubWFzayhcIiNtdl9pbnB1dG1hc2tfNVwiKTtcclxuXHJcbiAgICAgICAgLy8gQ3VycmVuY3lcclxuICAgICAgICBJbnB1dG1hc2soXCLigqwgOTk5Ljk5OS45OTksOTlcIiwge1xyXG4gICAgICAgICAgICBcIm51bWVyaWNJbnB1dFwiOiB0cnVlXHJcbiAgICAgICAgfSkubWFzayhcIiNtdl9pbnB1dG1hc2tfNlwiKTtcclxuXHJcbiAgICAgICAgLy8gSXAgYWRkcmVzc1xyXG4gICAgICAgIElucHV0bWFzayh7XHJcbiAgICAgICAgICAgIFwibWFza1wiOiBcIjk5OS45OTkuOTk5Ljk5OVwiXHJcbiAgICAgICAgfSkubWFzayhcIiNtdl9pbnB1dG1hc2tfN1wiKTtcclxuXHJcbiAgICAgICAgLy8gRW1haWwgYWRkcmVzc1xyXG4gICAgICAgIElucHV0bWFzayh7XHJcbiAgICAgICAgICAgIG1hc2s6IFwiKnsxLDIwfVsuKnsxLDIwfV1bLip7MSwyMH1dWy4qezEsMjB9XUAqezEsMjB9Wy4qezIsNn1dWy4qezEsMn1dXCIsXHJcbiAgICAgICAgICAgIGdyZWVkeTogZmFsc2UsXHJcbiAgICAgICAgICAgIG9uQmVmb3JlUGFzdGU6IGZ1bmN0aW9uIChwYXN0ZWRWYWx1ZSwgb3B0cykge1xyXG4gICAgICAgICAgICAgICAgcGFzdGVkVmFsdWUgPSBwYXN0ZWRWYWx1ZS50b0xvd2VyQ2FzZSgpO1xyXG4gICAgICAgICAgICAgICAgcmV0dXJuIHBhc3RlZFZhbHVlLnJlcGxhY2UoXCJtYWlsdG86XCIsIFwiXCIpO1xyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBkZWZpbml0aW9uczoge1xyXG4gICAgICAgICAgICAgICAgXCIqXCI6IHtcclxuICAgICAgICAgICAgICAgICAgICB2YWxpZGF0b3I6ICdbMC05QS1aYS16ISMkJSZcIiorLz0/Xl9ge3x9flxcLV0nLFxyXG4gICAgICAgICAgICAgICAgICAgIGNhcmRpbmFsaXR5OiAxLFxyXG4gICAgICAgICAgICAgICAgICAgIGNhc2luZzogXCJsb3dlclwiXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KS5tYXNrKFwiI212X2lucHV0bWFza184XCIpO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uKGVsZW1lbnQpIHtcclxuICAgICAgICAgICAgX2V4YW1wbGVzKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuTVZVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIE1WRm9ybXNJbnB1dG1hc2tEZW1vcy5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiTVZGb3Jtc0lucHV0bWFza0RlbW9zIiwiX2V4YW1wbGVzIiwiSW5wdXRtYXNrIiwibWFzayIsImdyZWVkeSIsIm9uQmVmb3JlUGFzdGUiLCJwYXN0ZWRWYWx1ZSIsIm9wdHMiLCJ0b0xvd2VyQ2FzZSIsInJlcGxhY2UiLCJkZWZpbml0aW9ucyIsInZhbGlkYXRvciIsImNhcmRpbmFsaXR5IiwiY2FzaW5nIiwiaW5pdCIsImVsZW1lbnQiLCJNVlV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/forms/inputmask.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/forms/inputmask.js"]();
/******/ 	
/******/ })()
;