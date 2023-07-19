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

/***/ "./resources/assets/core/js/custom/documentation/editors/tinymce/hidden.js":
/*!*********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/tinymce/hidden.js ***!
  \*********************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsTinyMCEHidden = function () {\n  // Private functions\n  var exampleHidden = function exampleHidden() {\n    tinymce.init({\n      selector: '#mv_docs_tinymce_hidden',\n      menubar: false,\n      toolbar: ['styleselect fontselect fontsizeselect', 'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify', 'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],\n      plugins: 'advlist autolink link image lists charmap print preview code'\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleHidden();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsTinyMCEHidden.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy90aW55bWNlL2hpZGRlbi5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLG9CQUFvQixHQUFHLFlBQVc7RUFDbEM7RUFDQSxJQUFJQyxhQUFhLEdBQUcsU0FBaEJBLGFBQWFBLENBQUEsRUFBYztJQUMzQkMsT0FBTyxDQUFDQyxJQUFJLENBQUM7TUFDVEMsUUFBUSxFQUFFLHlCQUF5QjtNQUNuQ0MsT0FBTyxFQUFFLEtBQUs7TUFDZEMsT0FBTyxFQUFFLENBQUMsdUNBQXVDLEVBQzdDLHVHQUF1RyxFQUN2RyxrSUFBa0ksQ0FBQztNQUN2SUMsT0FBTyxFQUFHO0lBQ2QsQ0FBQyxDQUFDO0VBQ04sQ0FBQztFQUVELE9BQU87SUFDSDtJQUNBSixJQUFJLEVBQUUsU0FBQUEsS0FBQSxFQUFXO01BQ2JGLGFBQWEsQ0FBQyxDQUFDO0lBQ25CO0VBQ0osQ0FBQztBQUNMLENBQUMsQ0FBQyxDQUFDOztBQUVIO0FBQ0FPLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBVztFQUNqQ1Qsb0JBQW9CLENBQUNHLElBQUksQ0FBQyxDQUFDO0FBQy9CLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvY29yZS9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9lZGl0b3JzL3RpbnltY2UvaGlkZGVuLmpzPzQ4ZTEiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcbnZhciBNVkZvcm1zVGlueU1DRUhpZGRlbiA9IGZ1bmN0aW9uKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBleGFtcGxlSGlkZGVuID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdGlueW1jZS5pbml0KHtcclxuICAgICAgICAgICAgc2VsZWN0b3I6ICcjbXZfZG9jc190aW55bWNlX2hpZGRlbicsXHJcbiAgICAgICAgICAgIG1lbnViYXI6IGZhbHNlLFxyXG4gICAgICAgICAgICB0b29sYmFyOiBbJ3N0eWxlc2VsZWN0IGZvbnRzZWxlY3QgZm9udHNpemVzZWxlY3QnLFxyXG4gICAgICAgICAgICAgICAgJ3VuZG8gcmVkbyB8IGN1dCBjb3B5IHBhc3RlIHwgYm9sZCBpdGFsaWMgfCBsaW5rIGltYWdlIHwgYWxpZ25sZWZ0IGFsaWduY2VudGVyIGFsaWducmlnaHQgYWxpZ25qdXN0aWZ5JyxcclxuICAgICAgICAgICAgICAgICdidWxsaXN0IG51bWxpc3QgfCBvdXRkZW50IGluZGVudCB8IGJsb2NrcXVvdGUgc3Vic2NyaXB0IHN1cGVyc2NyaXB0IHwgYWR2bGlzdCB8IGF1dG9saW5rIHwgbGlzdHMgY2hhcm1hcCB8IHByaW50IHByZXZpZXcgfCAgY29kZSddLFxyXG4gICAgICAgICAgICBwbHVnaW5zIDogJ2Fkdmxpc3QgYXV0b2xpbmsgbGluayBpbWFnZSBsaXN0cyBjaGFybWFwIHByaW50IHByZXZpZXcgY29kZSdcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZXhhbXBsZUhpZGRlbigpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIE9uIGRvY3VtZW50IHJlYWR5XHJcbk1WVXRpbC5vbkRPTUNvbnRlbnRMb2FkZWQoZnVuY3Rpb24oKSB7XHJcbiAgICBNVkZvcm1zVGlueU1DRUhpZGRlbi5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiTVZGb3Jtc1RpbnlNQ0VIaWRkZW4iLCJleGFtcGxlSGlkZGVuIiwidGlueW1jZSIsImluaXQiLCJzZWxlY3RvciIsIm1lbnViYXIiLCJ0b29sYmFyIiwicGx1Z2lucyIsIk1WVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/editors/tinymce/hidden.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/editors/tinymce/hidden.js"]();
/******/ 	
/******/ })()
;