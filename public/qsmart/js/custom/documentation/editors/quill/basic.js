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

/***/ "./resources/assets/core/js/custom/documentation/editors/quill/basic.js":
/*!******************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/quill/basic.js ***!
  \******************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsQuillBasic = function () {\n  // Private functions\n  var exampleBasic = function exampleBasic() {\n    var quill = new Quill('#mv_docs_quill_basic', {\n      modules: {\n        toolbar: [[{\n          header: [1, 2, false]\n        }], ['bold', 'italic', 'underline'], ['image', 'code-block']]\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow' // or 'bubble'\n    });\n  };\n\n  return {\n    // Public Functions\n    init: function init() {\n      exampleBasic();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsQuillBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy9xdWlsbC9iYXNpYy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLGlCQUFpQixHQUFHLFlBQVc7RUFDL0I7RUFDQSxJQUFJQyxZQUFZLEdBQUcsU0FBZkEsWUFBWUEsQ0FBQSxFQUFjO0lBQzFCLElBQUlDLEtBQUssR0FBRyxJQUFJQyxLQUFLLENBQUMsc0JBQXNCLEVBQUU7TUFDMUNDLE9BQU8sRUFBRTtRQUNMQyxPQUFPLEVBQUUsQ0FDTCxDQUFDO1VBQ0dDLE1BQU0sRUFBRSxDQUFDLENBQUMsRUFBRSxDQUFDLEVBQUUsS0FBSztRQUN4QixDQUFDLENBQUMsRUFDRixDQUFDLE1BQU0sRUFBRSxRQUFRLEVBQUUsV0FBVyxDQUFDLEVBQy9CLENBQUMsT0FBTyxFQUFFLFlBQVksQ0FBQztNQUUvQixDQUFDO01BQ0RDLFdBQVcsRUFBRSx3QkFBd0I7TUFDckNDLEtBQUssRUFBRSxNQUFNLENBQUM7SUFDbEIsQ0FBQyxDQUFDO0VBQ04sQ0FBQzs7RUFFRCxPQUFPO0lBQ0g7SUFDQUMsSUFBSSxFQUFFLFNBQUFBLEtBQUEsRUFBVztNQUNiUixZQUFZLENBQUMsQ0FBQztJQUNsQjtFQUNKLENBQUM7QUFDTCxDQUFDLENBQUMsQ0FBQzs7QUFFSDtBQUNBUyxNQUFNLENBQUNDLGtCQUFrQixDQUFDLFlBQVc7RUFDakNYLGlCQUFpQixDQUFDUyxJQUFJLENBQUMsQ0FBQztBQUM1QixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy9xdWlsbC9iYXNpYy5qcz9mMmFmIl0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgTVZGb3Jtc1F1aWxsQmFzaWMgPSBmdW5jdGlvbigpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZUJhc2ljID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIHF1aWxsID0gbmV3IFF1aWxsKCcjbXZfZG9jc19xdWlsbF9iYXNpYycsIHtcclxuICAgICAgICAgICAgbW9kdWxlczoge1xyXG4gICAgICAgICAgICAgICAgdG9vbGJhcjogW1xyXG4gICAgICAgICAgICAgICAgICAgIFt7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGhlYWRlcjogWzEsIDIsIGZhbHNlXVxyXG4gICAgICAgICAgICAgICAgICAgIH1dLFxyXG4gICAgICAgICAgICAgICAgICAgIFsnYm9sZCcsICdpdGFsaWMnLCAndW5kZXJsaW5lJ10sXHJcbiAgICAgICAgICAgICAgICAgICAgWydpbWFnZScsICdjb2RlLWJsb2NrJ11cclxuICAgICAgICAgICAgICAgIF1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgcGxhY2Vob2xkZXI6ICdUeXBlIHlvdXIgdGV4dCBoZXJlLi4uJyxcclxuICAgICAgICAgICAgdGhlbWU6ICdzbm93JyAvLyBvciAnYnViYmxlJ1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICBleGFtcGxlQmFzaWMoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5NVlV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uKCkge1xyXG4gICAgTVZGb3Jtc1F1aWxsQmFzaWMuaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIk1WRm9ybXNRdWlsbEJhc2ljIiwiZXhhbXBsZUJhc2ljIiwicXVpbGwiLCJRdWlsbCIsIm1vZHVsZXMiLCJ0b29sYmFyIiwiaGVhZGVyIiwicGxhY2Vob2xkZXIiLCJ0aGVtZSIsImluaXQiLCJNVlV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/editors/quill/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/editors/quill/basic.js"]();
/******/ 	
/******/ })()
;