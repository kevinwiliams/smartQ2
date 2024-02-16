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

/***/ "./resources/assets/core/js/custom/documentation/editors/ckeditor/inline.js":
/*!**********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/ckeditor/inline.js ***!
  \**********************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsCKEditorInline = function () {\n  // Private functions\n  var exampleInline = function exampleInline() {\n    InlineEditor.create(document.querySelector('#mv_docs_ckeditor_inline')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleInline();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsCKEditorInline.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy9ja2VkaXRvci9pbmxpbmUuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSxxQkFBcUIsR0FBRyxZQUFZO0VBQ3BDO0VBQ0EsSUFBSUMsYUFBYSxHQUFHLFNBQWhCQSxhQUFhQSxDQUFBLEVBQWU7SUFDNUJDLFlBQVksQ0FDUEMsTUFBTSxDQUFDQyxRQUFRLENBQUNDLGFBQWEsQ0FBQywwQkFBMEIsQ0FBQyxDQUFDLENBQzFEQyxJQUFJLENBQUMsVUFBQUMsTUFBTSxFQUFJO01BQ1pDLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDRixNQUFNLENBQUM7SUFDdkIsQ0FBQyxDQUFDLFNBQ0ksQ0FBQyxVQUFBRyxLQUFLLEVBQUk7TUFDWkYsT0FBTyxDQUFDRSxLQUFLLENBQUNBLEtBQUssQ0FBQztJQUN4QixDQUFDLENBQUM7RUFDVixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FDLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVk7TUFDZFYsYUFBYSxDQUFDLENBQUM7SUFDbkI7RUFDSixDQUFDO0FBQ0wsQ0FBQyxDQUFDLENBQUM7O0FBRUg7QUFDQVcsTUFBTSxDQUFDQyxrQkFBa0IsQ0FBQyxZQUFZO0VBQ2xDYixxQkFBcUIsQ0FBQ1csSUFBSSxDQUFDLENBQUM7QUFDaEMsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvY2tlZGl0b3IvaW5saW5lLmpzPzMxMmYiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcbnZhciBNVkZvcm1zQ0tFZGl0b3JJbmxpbmUgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgdmFyIGV4YW1wbGVJbmxpbmUgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgSW5saW5lRWRpdG9yXHJcbiAgICAgICAgICAgIC5jcmVhdGUoZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI212X2RvY3NfY2tlZGl0b3JfaW5saW5lJykpXHJcbiAgICAgICAgICAgIC50aGVuKGVkaXRvciA9PiB7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhlZGl0b3IpO1xyXG4gICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAuY2F0Y2goZXJyb3IgPT4ge1xyXG4gICAgICAgICAgICAgICAgY29uc29sZS5lcnJvcihlcnJvcik7XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgZXhhbXBsZUlubGluZSgpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIE9uIGRvY3VtZW50IHJlYWR5XHJcbk1WVXRpbC5vbkRPTUNvbnRlbnRMb2FkZWQoZnVuY3Rpb24gKCkge1xyXG4gICAgTVZGb3Jtc0NLRWRpdG9ySW5saW5lLmluaXQoKTtcclxufSk7XHJcbiJdLCJuYW1lcyI6WyJNVkZvcm1zQ0tFZGl0b3JJbmxpbmUiLCJleGFtcGxlSW5saW5lIiwiSW5saW5lRWRpdG9yIiwiY3JlYXRlIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwidGhlbiIsImVkaXRvciIsImNvbnNvbGUiLCJsb2ciLCJlcnJvciIsImluaXQiLCJNVlV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/editors/ckeditor/inline.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/editors/ckeditor/inline.js"]();
/******/ 	
/******/ })()
;