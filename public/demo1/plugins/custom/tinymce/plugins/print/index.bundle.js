/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/print/index.js":
/*!*****************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/print/index.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("// Exports the \"print\" plugin for usage with module loaders\n// Usage:\n//   CommonJS:\n//     require('tinymce/plugins/print')\n//   ES2015:\n//     import 'tinymce/plugins/print'\n__webpack_require__(/*! ./plugin.js */ \"./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3ByaW50L2luZGV4LmpzLmpzIiwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBQSxtQkFBTyxDQUFDLDJGQUFELENBQVAiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3ByaW50L2luZGV4LmpzPzM0YWYiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gRXhwb3J0cyB0aGUgXCJwcmludFwiIHBsdWdpbiBmb3IgdXNhZ2Ugd2l0aCBtb2R1bGUgbG9hZGVyc1xyXG4vLyBVc2FnZTpcclxuLy8gICBDb21tb25KUzpcclxuLy8gICAgIHJlcXVpcmUoJ3RpbnltY2UvcGx1Z2lucy9wcmludCcpXHJcbi8vICAgRVMyMDE1OlxyXG4vLyAgICAgaW1wb3J0ICd0aW55bWNlL3BsdWdpbnMvcHJpbnQnXHJcbnJlcXVpcmUoJy4vcGx1Z2luLmpzJyk7Il0sIm5hbWVzIjpbInJlcXVpcmUiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/print/index.js\n");

/***/ }),

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.js":
/*!******************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.js ***!
  \******************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n(function () {\n  'use strict';\n\n  var global$1 = tinymce.util.Tools.resolve('tinymce.PluginManager');\n  var global = tinymce.util.Tools.resolve('tinymce.Env');\n\n  var register$1 = function register$1(editor) {\n    editor.addCommand('mcePrint', function () {\n      if (global.browser.isIE()) {\n        editor.getDoc().execCommand('print', false, null);\n      } else {\n        editor.getWin().print();\n      }\n    });\n  };\n\n  var register = function register(editor) {\n    var onAction = function onAction() {\n      return editor.execCommand('mcePrint');\n    };\n\n    editor.ui.registry.addButton('print', {\n      icon: 'print',\n      tooltip: 'Print',\n      onAction: onAction\n    });\n    editor.ui.registry.addMenuItem('print', {\n      text: 'Print...',\n      icon: 'print',\n      onAction: onAction\n    });\n  };\n\n  function Plugin() {\n    global$1.add('print', function (editor) {\n      register$1(editor);\n      register(editor);\n      editor.addShortcut('Meta+P', '', 'mcePrint');\n    });\n  }\n\n  Plugin();\n})();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3ByaW50L3BsdWdpbi5qcz8zNDkwIl0sIm5hbWVzIjpbImdsb2JhbCQxIiwidGlueW1jZSIsInV0aWwiLCJUb29scyIsInJlc29sdmUiLCJnbG9iYWwiLCJyZWdpc3RlciQxIiwiZWRpdG9yIiwiYWRkQ29tbWFuZCIsImJyb3dzZXIiLCJpc0lFIiwiZ2V0RG9jIiwiZXhlY0NvbW1hbmQiLCJnZXRXaW4iLCJwcmludCIsInJlZ2lzdGVyIiwib25BY3Rpb24iLCJ1aSIsInJlZ2lzdHJ5IiwiYWRkQnV0dG9uIiwiaWNvbiIsInRvb2x0aXAiLCJhZGRNZW51SXRlbSIsInRleHQiLCJQbHVnaW4iLCJhZGQiLCJhZGRTaG9ydGN1dCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNDLGFBQVk7QUFDVDs7QUFFQSxNQUFJQSxRQUFRLEdBQUdDLE9BQU8sQ0FBQ0MsSUFBUixDQUFhQyxLQUFiLENBQW1CQyxPQUFuQixDQUEyQix1QkFBM0IsQ0FBZjtBQUVBLE1BQUlDLE1BQU0sR0FBR0osT0FBTyxDQUFDQyxJQUFSLENBQWFDLEtBQWIsQ0FBbUJDLE9BQW5CLENBQTJCLGFBQTNCLENBQWI7O0FBRUEsTUFBSUUsVUFBVSxHQUFHLFNBQWJBLFVBQWEsQ0FBVUMsTUFBVixFQUFrQjtBQUNqQ0EsSUFBQUEsTUFBTSxDQUFDQyxVQUFQLENBQWtCLFVBQWxCLEVBQThCLFlBQVk7QUFDeEMsVUFBSUgsTUFBTSxDQUFDSSxPQUFQLENBQWVDLElBQWYsRUFBSixFQUEyQjtBQUN6QkgsUUFBQUEsTUFBTSxDQUFDSSxNQUFQLEdBQWdCQyxXQUFoQixDQUE0QixPQUE1QixFQUFxQyxLQUFyQyxFQUE0QyxJQUE1QztBQUNELE9BRkQsTUFFTztBQUNMTCxRQUFBQSxNQUFNLENBQUNNLE1BQVAsR0FBZ0JDLEtBQWhCO0FBQ0Q7QUFDRixLQU5EO0FBT0QsR0FSRDs7QUFVQSxNQUFJQyxRQUFRLEdBQUcsU0FBWEEsUUFBVyxDQUFVUixNQUFWLEVBQWtCO0FBQy9CLFFBQUlTLFFBQVEsR0FBRyxTQUFYQSxRQUFXLEdBQVk7QUFDekIsYUFBT1QsTUFBTSxDQUFDSyxXQUFQLENBQW1CLFVBQW5CLENBQVA7QUFDRCxLQUZEOztBQUdBTCxJQUFBQSxNQUFNLENBQUNVLEVBQVAsQ0FBVUMsUUFBVixDQUFtQkMsU0FBbkIsQ0FBNkIsT0FBN0IsRUFBc0M7QUFDcENDLE1BQUFBLElBQUksRUFBRSxPQUQ4QjtBQUVwQ0MsTUFBQUEsT0FBTyxFQUFFLE9BRjJCO0FBR3BDTCxNQUFBQSxRQUFRLEVBQUVBO0FBSDBCLEtBQXRDO0FBS0FULElBQUFBLE1BQU0sQ0FBQ1UsRUFBUCxDQUFVQyxRQUFWLENBQW1CSSxXQUFuQixDQUErQixPQUEvQixFQUF3QztBQUN0Q0MsTUFBQUEsSUFBSSxFQUFFLFVBRGdDO0FBRXRDSCxNQUFBQSxJQUFJLEVBQUUsT0FGZ0M7QUFHdENKLE1BQUFBLFFBQVEsRUFBRUE7QUFINEIsS0FBeEM7QUFLRCxHQWREOztBQWdCQSxXQUFTUSxNQUFULEdBQW1CO0FBQ2pCeEIsSUFBQUEsUUFBUSxDQUFDeUIsR0FBVCxDQUFhLE9BQWIsRUFBc0IsVUFBVWxCLE1BQVYsRUFBa0I7QUFDdENELE1BQUFBLFVBQVUsQ0FBQ0MsTUFBRCxDQUFWO0FBQ0FRLE1BQUFBLFFBQVEsQ0FBQ1IsTUFBRCxDQUFSO0FBQ0FBLE1BQUFBLE1BQU0sQ0FBQ21CLFdBQVAsQ0FBbUIsUUFBbkIsRUFBNkIsRUFBN0IsRUFBaUMsVUFBakM7QUFDRCxLQUpEO0FBS0Q7O0FBRURGLEVBQUFBLE1BQU07QUFFVCxDQTNDQSxHQUFEIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXHJcbiAqIENvcHlyaWdodCAoYykgVGlueSBUZWNobm9sb2dpZXMsIEluYy4gQWxsIHJpZ2h0cyByZXNlcnZlZC5cclxuICogTGljZW5zZWQgdW5kZXIgdGhlIExHUEwgb3IgYSBjb21tZXJjaWFsIGxpY2Vuc2UuXHJcbiAqIEZvciBMR1BMIHNlZSBMaWNlbnNlLnR4dCBpbiB0aGUgcHJvamVjdCByb290IGZvciBsaWNlbnNlIGluZm9ybWF0aW9uLlxyXG4gKiBGb3IgY29tbWVyY2lhbCBsaWNlbnNlcyBzZWUgaHR0cHM6Ly93d3cudGlueS5jbG91ZC9cclxuICpcclxuICogVmVyc2lvbjogNS4xMC4zICgyMDIyLTAyLTA5KVxyXG4gKi9cclxuKGZ1bmN0aW9uICgpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICB2YXIgZ2xvYmFsJDEgPSB0aW55bWNlLnV0aWwuVG9vbHMucmVzb2x2ZSgndGlueW1jZS5QbHVnaW5NYW5hZ2VyJyk7XHJcblxyXG4gICAgdmFyIGdsb2JhbCA9IHRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKCd0aW55bWNlLkVudicpO1xyXG5cclxuICAgIHZhciByZWdpc3RlciQxID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICBlZGl0b3IuYWRkQ29tbWFuZCgnbWNlUHJpbnQnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgaWYgKGdsb2JhbC5icm93c2VyLmlzSUUoKSkge1xyXG4gICAgICAgICAgZWRpdG9yLmdldERvYygpLmV4ZWNDb21tYW5kKCdwcmludCcsIGZhbHNlLCBudWxsKTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgZWRpdG9yLmdldFdpbigpLnByaW50KCk7XHJcbiAgICAgICAgfVxyXG4gICAgICB9KTtcclxuICAgIH07XHJcblxyXG4gICAgdmFyIHJlZ2lzdGVyID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICB2YXIgb25BY3Rpb24gPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgcmV0dXJuIGVkaXRvci5leGVjQ29tbWFuZCgnbWNlUHJpbnQnKTtcclxuICAgICAgfTtcclxuICAgICAgZWRpdG9yLnVpLnJlZ2lzdHJ5LmFkZEJ1dHRvbigncHJpbnQnLCB7XHJcbiAgICAgICAgaWNvbjogJ3ByaW50JyxcclxuICAgICAgICB0b29sdGlwOiAnUHJpbnQnLFxyXG4gICAgICAgIG9uQWN0aW9uOiBvbkFjdGlvblxyXG4gICAgICB9KTtcclxuICAgICAgZWRpdG9yLnVpLnJlZ2lzdHJ5LmFkZE1lbnVJdGVtKCdwcmludCcsIHtcclxuICAgICAgICB0ZXh0OiAnUHJpbnQuLi4nLFxyXG4gICAgICAgIGljb246ICdwcmludCcsXHJcbiAgICAgICAgb25BY3Rpb246IG9uQWN0aW9uXHJcbiAgICAgIH0pO1xyXG4gICAgfTtcclxuXHJcbiAgICBmdW5jdGlvbiBQbHVnaW4gKCkge1xyXG4gICAgICBnbG9iYWwkMS5hZGQoJ3ByaW50JywgZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICAgIHJlZ2lzdGVyJDEoZWRpdG9yKTtcclxuICAgICAgICByZWdpc3RlcihlZGl0b3IpO1xyXG4gICAgICAgIGVkaXRvci5hZGRTaG9ydGN1dCgnTWV0YStQJywgJycsICdtY2VQcmludCcpO1xyXG4gICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICBQbHVnaW4oKTtcclxuXHJcbn0oKSk7XHJcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3ByaW50L3BsdWdpbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/core/plugins/custom/tinymce/plugins/print/index.js");
/******/ 	
/******/ })()
;