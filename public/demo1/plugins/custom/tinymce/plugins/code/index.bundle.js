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

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/code/index.js":
/*!****************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/code/index.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("// Exports the \"code\" plugin for usage with module loaders\n// Usage:\n//   CommonJS:\n//     require('tinymce/plugins/code')\n//   ES2015:\n//     import 'tinymce/plugins/code'\n__webpack_require__(/*! ./plugin.js */ \"./resources/assets/core/plugins/custom/tinymce/plugins/code/plugin.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL2NvZGUvaW5kZXguanMuanMiLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0FBLG1CQUFPLENBQUMsMEZBQUQsQ0FBUCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvY29yZS9wbHVnaW5zL2N1c3RvbS90aW55bWNlL3BsdWdpbnMvY29kZS9pbmRleC5qcz83MTUzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIEV4cG9ydHMgdGhlIFwiY29kZVwiIHBsdWdpbiBmb3IgdXNhZ2Ugd2l0aCBtb2R1bGUgbG9hZGVyc1xyXG4vLyBVc2FnZTpcclxuLy8gICBDb21tb25KUzpcclxuLy8gICAgIHJlcXVpcmUoJ3RpbnltY2UvcGx1Z2lucy9jb2RlJylcclxuLy8gICBFUzIwMTU6XHJcbi8vICAgICBpbXBvcnQgJ3RpbnltY2UvcGx1Z2lucy9jb2RlJ1xyXG5yZXF1aXJlKCcuL3BsdWdpbi5qcycpOyJdLCJuYW1lcyI6WyJyZXF1aXJlIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/code/index.js\n");

/***/ }),

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/code/plugin.js":
/*!*****************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/code/plugin.js ***!
  \*****************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n(function () {\n  'use strict';\n\n  var global = tinymce.util.Tools.resolve('tinymce.PluginManager');\n\n  var setContent = function setContent(editor, html) {\n    editor.focus();\n    editor.undoManager.transact(function () {\n      editor.setContent(html);\n    });\n    editor.selection.setCursorLocation();\n    editor.nodeChanged();\n  };\n\n  var getContent = function getContent(editor) {\n    return editor.getContent({\n      source_view: true\n    });\n  };\n\n  var open = function open(editor) {\n    var editorContent = getContent(editor);\n    editor.windowManager.open({\n      title: 'Source Code',\n      size: 'large',\n      body: {\n        type: 'panel',\n        items: [{\n          type: 'textarea',\n          name: 'code'\n        }]\n      },\n      buttons: [{\n        type: 'cancel',\n        name: 'cancel',\n        text: 'Cancel'\n      }, {\n        type: 'submit',\n        name: 'save',\n        text: 'Save',\n        primary: true\n      }],\n      initialData: {\n        code: editorContent\n      },\n      onSubmit: function onSubmit(api) {\n        setContent(editor, api.getData().code);\n        api.close();\n      }\n    });\n  };\n\n  var register$1 = function register$1(editor) {\n    editor.addCommand('mceCodeEditor', function () {\n      open(editor);\n    });\n  };\n\n  var register = function register(editor) {\n    var onAction = function onAction() {\n      return editor.execCommand('mceCodeEditor');\n    };\n\n    editor.ui.registry.addButton('code', {\n      icon: 'sourcecode',\n      tooltip: 'Source code',\n      onAction: onAction\n    });\n    editor.ui.registry.addMenuItem('code', {\n      icon: 'sourcecode',\n      text: 'Source code',\n      onAction: onAction\n    });\n  };\n\n  function Plugin() {\n    global.add('code', function (editor) {\n      register$1(editor);\n      register(editor);\n      return {};\n    });\n  }\n\n  Plugin();\n})();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL2NvZGUvcGx1Z2luLmpzP2UwYmIiXSwibmFtZXMiOlsiZ2xvYmFsIiwidGlueW1jZSIsInV0aWwiLCJUb29scyIsInJlc29sdmUiLCJzZXRDb250ZW50IiwiZWRpdG9yIiwiaHRtbCIsImZvY3VzIiwidW5kb01hbmFnZXIiLCJ0cmFuc2FjdCIsInNlbGVjdGlvbiIsInNldEN1cnNvckxvY2F0aW9uIiwibm9kZUNoYW5nZWQiLCJnZXRDb250ZW50Iiwic291cmNlX3ZpZXciLCJvcGVuIiwiZWRpdG9yQ29udGVudCIsIndpbmRvd01hbmFnZXIiLCJ0aXRsZSIsInNpemUiLCJib2R5IiwidHlwZSIsIml0ZW1zIiwibmFtZSIsImJ1dHRvbnMiLCJ0ZXh0IiwicHJpbWFyeSIsImluaXRpYWxEYXRhIiwiY29kZSIsIm9uU3VibWl0IiwiYXBpIiwiZ2V0RGF0YSIsImNsb3NlIiwicmVnaXN0ZXIkMSIsImFkZENvbW1hbmQiLCJyZWdpc3RlciIsIm9uQWN0aW9uIiwiZXhlY0NvbW1hbmQiLCJ1aSIsInJlZ2lzdHJ5IiwiYWRkQnV0dG9uIiwiaWNvbiIsInRvb2x0aXAiLCJhZGRNZW51SXRlbSIsIlBsdWdpbiIsImFkZCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNDLGFBQVk7QUFDVDs7QUFFQSxNQUFJQSxNQUFNLEdBQUdDLE9BQU8sQ0FBQ0MsSUFBUixDQUFhQyxLQUFiLENBQW1CQyxPQUFuQixDQUEyQix1QkFBM0IsQ0FBYjs7QUFFQSxNQUFJQyxVQUFVLEdBQUcsU0FBYkEsVUFBYSxDQUFVQyxNQUFWLEVBQWtCQyxJQUFsQixFQUF3QjtBQUN2Q0QsSUFBQUEsTUFBTSxDQUFDRSxLQUFQO0FBQ0FGLElBQUFBLE1BQU0sQ0FBQ0csV0FBUCxDQUFtQkMsUUFBbkIsQ0FBNEIsWUFBWTtBQUN0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LE1BQVYsRUFBa0I7QUFDbkM0QixNQUFBQSxVQUFVLENBQUM1QixNQUFELENBQVY7QUFDQThCLE1BQUFBLFFBQVEsQ0FBQzlCLE1BQUQsQ0FBUjtBQUNBLGFBQU8sRUFBUDtBQUNELEtBSkQ7QUFLRDs7QUFFRHVDLEVBQUFBLE1BQU07QUFFVCxDQWxGQSxHQUFEIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXHJcbiAqIENvcHlyaWdodCAoYykgVGlueSBUZWNobm9sb2dpZXMsIEluYy4gQWxsIHJpZ2h0cyByZXNlcnZlZC5cclxuICogTGljZW5zZWQgdW5kZXIgdGhlIExHUEwgb3IgYSBjb21tZXJjaWFsIGxpY2Vuc2UuXHJcbiAqIEZvciBMR1BMIHNlZSBMaWNlbnNlLnR4dCBpbiB0aGUgcHJvamVjdCByb290IGZvciBsaWNlbnNlIGluZm9ybWF0aW9uLlxyXG4gKiBGb3IgY29tbWVyY2lhbCBsaWNlbnNlcyBzZWUgaHR0cHM6Ly93d3cudGlueS5jbG91ZC9cclxuICpcclxuICogVmVyc2lvbjogNS4xMC4zICgyMDIyLTAyLTA5KVxyXG4gKi9cclxuKGZ1bmN0aW9uICgpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICB2YXIgZ2xvYmFsID0gdGlueW1jZS51dGlsLlRvb2xzLnJlc29sdmUoJ3RpbnltY2UuUGx1Z2luTWFuYWdlcicpO1xyXG5cclxuICAgIHZhciBzZXRDb250ZW50ID0gZnVuY3Rpb24gKGVkaXRvciwgaHRtbCkge1xyXG4gICAgICBlZGl0b3IuZm9jdXMoKTtcclxuICAgICAgZWRpdG9yLnVuZG9NYW5hZ2VyLnRyYW5zYWN0KGZ1bmN0aW9uICgpIHtcclxuICAgICAgICBlZGl0b3Iuc2V0Q29udGVudChodG1sKTtcclxuICAgICAgfSk7XHJcbiAgICAgIGVkaXRvci5zZWxlY3Rpb24uc2V0Q3Vyc29yTG9jYXRpb24oKTtcclxuICAgICAgZWRpdG9yLm5vZGVDaGFuZ2VkKCk7XHJcbiAgICB9O1xyXG4gICAgdmFyIGdldENvbnRlbnQgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHJldHVybiBlZGl0b3IuZ2V0Q29udGVudCh7IHNvdXJjZV92aWV3OiB0cnVlIH0pO1xyXG4gICAgfTtcclxuXHJcbiAgICB2YXIgb3BlbiA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgdmFyIGVkaXRvckNvbnRlbnQgPSBnZXRDb250ZW50KGVkaXRvcik7XHJcbiAgICAgIGVkaXRvci53aW5kb3dNYW5hZ2VyLm9wZW4oe1xyXG4gICAgICAgIHRpdGxlOiAnU291cmNlIENvZGUnLFxyXG4gICAgICAgIHNpemU6ICdsYXJnZScsXHJcbiAgICAgICAgYm9keToge1xyXG4gICAgICAgICAgdHlwZTogJ3BhbmVsJyxcclxuICAgICAgICAgIGl0ZW1zOiBbe1xyXG4gICAgICAgICAgICAgIHR5cGU6ICd0ZXh0YXJlYScsXHJcbiAgICAgICAgICAgICAgbmFtZTogJ2NvZGUnXHJcbiAgICAgICAgICAgIH1dXHJcbiAgICAgICAgfSxcclxuICAgICAgICBidXR0b25zOiBbXHJcbiAgICAgICAgICB7XHJcbiAgICAgICAgICAgIHR5cGU6ICdjYW5jZWwnLFxyXG4gICAgICAgICAgICBuYW1lOiAnY2FuY2VsJyxcclxuICAgICAgICAgICAgdGV4dDogJ0NhbmNlbCdcclxuICAgICAgICAgIH0sXHJcbiAgICAgICAgICB7XHJcbiAgICAgICAgICAgIHR5cGU6ICdzdWJtaXQnLFxyXG4gICAgICAgICAgICBuYW1lOiAnc2F2ZScsXHJcbiAgICAgICAgICAgIHRleHQ6ICdTYXZlJyxcclxuICAgICAgICAgICAgcHJpbWFyeTogdHJ1ZVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgIF0sXHJcbiAgICAgICAgaW5pdGlhbERhdGE6IHsgY29kZTogZWRpdG9yQ29udGVudCB9LFxyXG4gICAgICAgIG9uU3VibWl0OiBmdW5jdGlvbiAoYXBpKSB7XHJcbiAgICAgICAgICBzZXRDb250ZW50KGVkaXRvciwgYXBpLmdldERhdGEoKS5jb2RlKTtcclxuICAgICAgICAgIGFwaS5jbG9zZSgpO1xyXG4gICAgICAgIH1cclxuICAgICAgfSk7XHJcbiAgICB9O1xyXG5cclxuICAgIHZhciByZWdpc3RlciQxID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICBlZGl0b3IuYWRkQ29tbWFuZCgnbWNlQ29kZUVkaXRvcicsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICBvcGVuKGVkaXRvcik7XHJcbiAgICAgIH0pO1xyXG4gICAgfTtcclxuXHJcbiAgICB2YXIgcmVnaXN0ZXIgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHZhciBvbkFjdGlvbiA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICByZXR1cm4gZWRpdG9yLmV4ZWNDb21tYW5kKCdtY2VDb2RlRWRpdG9yJyk7XHJcbiAgICAgIH07XHJcbiAgICAgIGVkaXRvci51aS5yZWdpc3RyeS5hZGRCdXR0b24oJ2NvZGUnLCB7XHJcbiAgICAgICAgaWNvbjogJ3NvdXJjZWNvZGUnLFxyXG4gICAgICAgIHRvb2x0aXA6ICdTb3VyY2UgY29kZScsXHJcbiAgICAgICAgb25BY3Rpb246IG9uQWN0aW9uXHJcbiAgICAgIH0pO1xyXG4gICAgICBlZGl0b3IudWkucmVnaXN0cnkuYWRkTWVudUl0ZW0oJ2NvZGUnLCB7XHJcbiAgICAgICAgaWNvbjogJ3NvdXJjZWNvZGUnLFxyXG4gICAgICAgIHRleHQ6ICdTb3VyY2UgY29kZScsXHJcbiAgICAgICAgb25BY3Rpb246IG9uQWN0aW9uXHJcbiAgICAgIH0pO1xyXG4gICAgfTtcclxuXHJcbiAgICBmdW5jdGlvbiBQbHVnaW4gKCkge1xyXG4gICAgICBnbG9iYWwuYWRkKCdjb2RlJywgZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICAgIHJlZ2lzdGVyJDEoZWRpdG9yKTtcclxuICAgICAgICByZWdpc3RlcihlZGl0b3IpO1xyXG4gICAgICAgIHJldHVybiB7fTtcclxuICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgUGx1Z2luKCk7XHJcblxyXG59KCkpO1xyXG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL3BsdWdpbnMvY3VzdG9tL3RpbnltY2UvcGx1Z2lucy9jb2RlL3BsdWdpbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/code/plugin.js\n");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/core/plugins/custom/tinymce/plugins/code/index.js");
/******/ 	
/******/ })()
;