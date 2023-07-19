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

/***/ "./resources/assets/core/js/custom/documentation/editors/tinymce/basic.js":
/*!********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/tinymce/basic.js ***!
  \********************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsTinyMCEBasic = function () {\n  // Private functions\n  var exampleBasic = function exampleBasic() {\n    var options = {\n      selector: '#mv_docs_tinymce_basic'\n    };\n    if (MVApp.isDarkMode()) {\n      options['skin'] = 'oxide-dark';\n      options['content_css'] = 'dark';\n    }\n    tinymce.init(options);\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleBasic();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsTinyMCEBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy90aW55bWNlL2Jhc2ljLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEsbUJBQW1CLEdBQUcsWUFBVztFQUNqQztFQUNBLElBQUlDLFlBQVksR0FBRyxTQUFmQSxZQUFZQSxDQUFBLEVBQWM7SUFDMUIsSUFBSUMsT0FBTyxHQUFHO01BQUNDLFFBQVEsRUFBRTtJQUF3QixDQUFDO0lBRWxELElBQUlDLEtBQUssQ0FBQ0MsVUFBVSxDQUFDLENBQUMsRUFBRTtNQUNwQkgsT0FBTyxDQUFDLE1BQU0sQ0FBQyxHQUFHLFlBQVk7TUFDOUJBLE9BQU8sQ0FBQyxhQUFhLENBQUMsR0FBRyxNQUFNO0lBQ25DO0lBRUFJLE9BQU8sQ0FBQ0MsSUFBSSxDQUFDTCxPQUFPLENBQUM7RUFDekIsQ0FBQztFQUVELE9BQU87SUFDSDtJQUNBSyxJQUFJLEVBQUUsU0FBQUEsS0FBQSxFQUFXO01BQ2JOLFlBQVksQ0FBQyxDQUFDO0lBQ2xCO0VBQ0osQ0FBQztBQUNMLENBQUMsQ0FBQyxDQUFDOztBQUVIO0FBQ0FPLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBVztFQUNqQ1QsbUJBQW1CLENBQUNPLElBQUksQ0FBQyxDQUFDO0FBQzlCLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvY29yZS9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9lZGl0b3JzL3RpbnltY2UvYmFzaWMuanM/MGJiOSJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIE1WRm9ybXNUaW55TUNFQmFzaWMgPSBmdW5jdGlvbigpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZUJhc2ljID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIG9wdGlvbnMgPSB7c2VsZWN0b3I6ICcjbXZfZG9jc190aW55bWNlX2Jhc2ljJ307XHJcbiAgICAgICAgXHJcbiAgICAgICAgaWYgKE1WQXBwLmlzRGFya01vZGUoKSkge1xyXG4gICAgICAgICAgICBvcHRpb25zWydza2luJ10gPSAnb3hpZGUtZGFyayc7XHJcbiAgICAgICAgICAgIG9wdGlvbnNbJ2NvbnRlbnRfY3NzJ10gPSAnZGFyayc7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIHRpbnltY2UuaW5pdChvcHRpb25zKTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZXhhbXBsZUJhc2ljKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuTVZVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIE1WRm9ybXNUaW55TUNFQmFzaWMuaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIk1WRm9ybXNUaW55TUNFQmFzaWMiLCJleGFtcGxlQmFzaWMiLCJvcHRpb25zIiwic2VsZWN0b3IiLCJNVkFwcCIsImlzRGFya01vZGUiLCJ0aW55bWNlIiwiaW5pdCIsIk1WVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/editors/tinymce/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/editors/tinymce/basic.js"]();
/******/ 	
/******/ })()
;