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

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/index.js":
/*!************************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/index.js ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("// Exports the \"visualblocks\" plugin for usage with module loaders\n// Usage:\n//   CommonJS:\n//     require('tinymce/plugins/visualblocks')\n//   ES2015:\n//     import 'tinymce/plugins/visualblocks'\n__webpack_require__(/*! ./plugin.js */ \"./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/plugin.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3Zpc3VhbGJsb2Nrcy9pbmRleC5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQUEsbUJBQU8sQ0FBQyxrR0FBRCxDQUFQIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL3BsdWdpbnMvY3VzdG9tL3RpbnltY2UvcGx1Z2lucy92aXN1YWxibG9ja3MvaW5kZXguanM/YzY0ZCJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBFeHBvcnRzIHRoZSBcInZpc3VhbGJsb2Nrc1wiIHBsdWdpbiBmb3IgdXNhZ2Ugd2l0aCBtb2R1bGUgbG9hZGVyc1xyXG4vLyBVc2FnZTpcclxuLy8gICBDb21tb25KUzpcclxuLy8gICAgIHJlcXVpcmUoJ3RpbnltY2UvcGx1Z2lucy92aXN1YWxibG9ja3MnKVxyXG4vLyAgIEVTMjAxNTpcclxuLy8gICAgIGltcG9ydCAndGlueW1jZS9wbHVnaW5zL3Zpc3VhbGJsb2NrcydcclxucmVxdWlyZSgnLi9wbHVnaW4uanMnKTsiXSwibmFtZXMiOlsicmVxdWlyZSJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/index.js\n");

/***/ }),

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/plugin.js":
/*!*************************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/plugin.js ***!
  \*************************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n(function () {\n  'use strict';\n\n  var Cell = function Cell(initial) {\n    var value = initial;\n\n    var get = function get() {\n      return value;\n    };\n\n    var set = function set(v) {\n      value = v;\n    };\n\n    return {\n      get: get,\n      set: set\n    };\n  };\n\n  var global = tinymce.util.Tools.resolve('tinymce.PluginManager');\n\n  var fireVisualBlocks = function fireVisualBlocks(editor, state) {\n    editor.fire('VisualBlocks', {\n      state: state\n    });\n  };\n\n  var toggleVisualBlocks = function toggleVisualBlocks(editor, pluginUrl, enabledState) {\n    var dom = editor.dom;\n    dom.toggleClass(editor.getBody(), 'mce-visualblocks');\n    enabledState.set(!enabledState.get());\n    fireVisualBlocks(editor, enabledState.get());\n  };\n\n  var register$1 = function register$1(editor, pluginUrl, enabledState) {\n    editor.addCommand('mceVisualBlocks', function () {\n      toggleVisualBlocks(editor, pluginUrl, enabledState);\n    });\n  };\n\n  var isEnabledByDefault = function isEnabledByDefault(editor) {\n    return editor.getParam('visualblocks_default_state', false, 'boolean');\n  };\n\n  var setup = function setup(editor, pluginUrl, enabledState) {\n    editor.on('PreviewFormats AfterPreviewFormats', function (e) {\n      if (enabledState.get()) {\n        editor.dom.toggleClass(editor.getBody(), 'mce-visualblocks', e.type === 'afterpreviewformats');\n      }\n    });\n    editor.on('init', function () {\n      if (isEnabledByDefault(editor)) {\n        toggleVisualBlocks(editor, pluginUrl, enabledState);\n      }\n    });\n  };\n\n  var toggleActiveState = function toggleActiveState(editor, enabledState) {\n    return function (api) {\n      api.setActive(enabledState.get());\n\n      var editorEventCallback = function editorEventCallback(e) {\n        return api.setActive(e.state);\n      };\n\n      editor.on('VisualBlocks', editorEventCallback);\n      return function () {\n        return editor.off('VisualBlocks', editorEventCallback);\n      };\n    };\n  };\n\n  var register = function register(editor, enabledState) {\n    var onAction = function onAction() {\n      return editor.execCommand('mceVisualBlocks');\n    };\n\n    editor.ui.registry.addToggleButton('visualblocks', {\n      icon: 'visualblocks',\n      tooltip: 'Show blocks',\n      onAction: onAction,\n      onSetup: toggleActiveState(editor, enabledState)\n    });\n    editor.ui.registry.addToggleMenuItem('visualblocks', {\n      text: 'Show blocks',\n      icon: 'visualblocks',\n      onAction: onAction,\n      onSetup: toggleActiveState(editor, enabledState)\n    });\n  };\n\n  function Plugin() {\n    global.add('visualblocks', function (editor, pluginUrl) {\n      var enabledState = Cell(false);\n      register$1(editor, pluginUrl, enabledState);\n      register(editor, enabledState);\n      setup(editor, pluginUrl, enabledState);\n    });\n  }\n\n  Plugin();\n})();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3Zpc3VhbGJsb2Nrcy9wbHVnaW4uanM/YzU4ZSJdLCJuYW1lcyI6WyJDZWxsIiwiaW5pdGlhbCIsInZhbHVlIiwiZ2V0Iiwic2V0IiwidiIsImdsb2JhbCIsInRpbnltY2UiLCJ1dGlsIiwiVG9vbHMiLCJyZXNvbHZlIiwiZmlyZVZpc3VhbEJsb2NrcyIsImVkaXRvciIsInN0YXRlIiwiZmlyZSIsInRvZ2dsZVZpc3VhbEJsb2NrcyIsInBsdWdpblVybCIsImVuYWJsZWRTdGF0ZSIsImRvbSIsInRvZ2dsZUNsYXNzIiwiZ2V0Qm9keSIsInJlZ2lzdGVyJDEiLCJhZGRDb21tYW5kIiwiaXNFbmFibGVkQnlEZWZhdWx0IiwiZ2V0UGFyYW0iLCJzZXR1cCIsIm9uIiwiZSIsInR5cGUiLCJ0b2dnbGVBY3RpdmVTdGF0ZSIsImFwaSIsInNldEFjdGl2ZSIsImVkaXRvckV2ZW50Q2FsbGJhY2siLCJvZmYiLCJyZWdpc3RlciIsIm9uQWN0aW9uIiwiZXhlY0NvbW1hbmQiLCJ1aSIsInJlZ2lzdHJ5IiwiYWRkVG9nZ2xlQnV0dG9uIiwiaWNvbiIsInRvb2x0aXAiLCJvblNldHVwIiwiYWRkVG9nZ2xlTWVudUl0ZW0iLCJ0ZXh0IiwiUGx1Z2luIiwiYWRkIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0MsYUFBWTtBQUNUOztBQUVBLE1BQUlBLElBQUksR0FBRyxTQUFQQSxJQUFPLENBQVVDLE9BQVYsRUFBbUI7QUFDNUIsUUFBSUMsS0FBSyxHQUFHRCxPQUFaOztBQUNBLFFBQUlFLEdBQUcsR0FBRyxTQUFOQSxHQUFNLEdBQVk7QUFDcEIsYUFBT0QsS0FBUDtBQUNELEtBRkQ7O0FBR0EsUUFBSUUsR0FBRyxHQUFHLFNBQU5BLEdBQU0sQ0FBVUMsQ0FBVixFQUFhO0FBQ3JCSCxNQUFBQSxLQUFL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QXZCO0FBQ0FxQixNQUFBQSxVQUFVLENBQUNULE1BQUQsRUFBU0ksU0FBVCxFQUFvQkMsWUFBcEIsQ0FBVjtBQUNBaUIsTUFBQUEsUUFBUSxDQUFDdEIsTUFBRCxFQUFTSyxZQUFULENBQVI7QUFDQVEsTUFBQUEsS0FBSyxDQUFDYixNQUFELEVBQVNJLFNBQVQsRUFBb0JDLFlBQXBCLENBQUw7QUFDRCxLQUxEO0FBTUQ7O0FBRUQ0QixFQUFBQSxNQUFNO0FBRVQsQ0E5RkEsR0FBRCIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBDb3B5cmlnaHQgKGMpIFRpbnkgVGVjaG5vbG9naWVzLCBJbmMuIEFsbCByaWdodHMgcmVzZXJ2ZWQuXHJcbiAqIExpY2Vuc2VkIHVuZGVyIHRoZSBMR1BMIG9yIGEgY29tbWVyY2lhbCBsaWNlbnNlLlxyXG4gKiBGb3IgTEdQTCBzZWUgTGljZW5zZS50eHQgaW4gdGhlIHByb2plY3Qgcm9vdCBmb3IgbGljZW5zZSBpbmZvcm1hdGlvbi5cclxuICogRm9yIGNvbW1lcmNpYWwgbGljZW5zZXMgc2VlIGh0dHBzOi8vd3d3LnRpbnkuY2xvdWQvXHJcbiAqXHJcbiAqIFZlcnNpb246IDUuMTAuMyAoMjAyMi0wMi0wOSlcclxuICovXHJcbihmdW5jdGlvbiAoKSB7XHJcbiAgICAndXNlIHN0cmljdCc7XHJcblxyXG4gICAgdmFyIENlbGwgPSBmdW5jdGlvbiAoaW5pdGlhbCkge1xyXG4gICAgICB2YXIgdmFsdWUgPSBpbml0aWFsO1xyXG4gICAgICB2YXIgZ2V0ID0gZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIHJldHVybiB2YWx1ZTtcclxuICAgICAgfTtcclxuICAgICAgdmFyIHNldCA9IGZ1bmN0aW9uICh2KSB7XHJcbiAgICAgICAgdmFsdWUgPSB2O1xyXG4gICAgICB9O1xyXG4gICAgICByZXR1cm4ge1xyXG4gICAgICAgIGdldDogZ2V0LFxyXG4gICAgICAgIHNldDogc2V0XHJcbiAgICAgIH07XHJcbiAgICB9O1xyXG5cclxuICAgIHZhciBnbG9iYWwgPSB0aW55bWNlLnV0aWwuVG9vbHMucmVzb2x2ZSgndGlueW1jZS5QbHVnaW5NYW5hZ2VyJyk7XHJcblxyXG4gICAgdmFyIGZpcmVWaXN1YWxCbG9ja3MgPSBmdW5jdGlvbiAoZWRpdG9yLCBzdGF0ZSkge1xyXG4gICAgICBlZGl0b3IuZmlyZSgnVmlzdWFsQmxvY2tzJywgeyBzdGF0ZTogc3RhdGUgfSk7XHJcbiAgICB9O1xyXG5cclxuICAgIHZhciB0b2dnbGVWaXN1YWxCbG9ja3MgPSBmdW5jdGlvbiAoZWRpdG9yLCBwbHVnaW5VcmwsIGVuYWJsZWRTdGF0ZSkge1xyXG4gICAgICB2YXIgZG9tID0gZWRpdG9yLmRvbTtcclxuICAgICAgZG9tLnRvZ2dsZUNsYXNzKGVkaXRvci5nZXRCb2R5KCksICdtY2UtdmlzdWFsYmxvY2tzJyk7XHJcbiAgICAgIGVuYWJsZWRTdGF0ZS5zZXQoIWVuYWJsZWRTdGF0ZS5nZXQoKSk7XHJcbiAgICAgIGZpcmVWaXN1YWxCbG9ja3MoZWRpdG9yLCBlbmFibGVkU3RhdGUuZ2V0KCkpO1xyXG4gICAgfTtcclxuXHJcbiAgICB2YXIgcmVnaXN0ZXIkMSA9IGZ1bmN0aW9uIChlZGl0b3IsIHBsdWdpblVybCwgZW5hYmxlZFN0YXRlKSB7XHJcbiAgICAgIGVkaXRvci5hZGRDb21tYW5kKCdtY2VWaXN1YWxCbG9ja3MnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdG9nZ2xlVmlzdWFsQmxvY2tzKGVkaXRvciwgcGx1Z2luVXJsLCBlbmFibGVkU3RhdGUpO1xyXG4gICAgICB9KTtcclxuICAgIH07XHJcblxyXG4gICAgdmFyIGlzRW5hYmxlZEJ5RGVmYXVsdCA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgcmV0dXJuIGVkaXRvci5nZXRQYXJhbSgndmlzdWFsYmxvY2tzX2RlZmF1bHRfc3RhdGUnLCBmYWxzZSwgJ2Jvb2xlYW4nKTtcclxuICAgIH07XHJcblxyXG4gICAgdmFyIHNldHVwID0gZnVuY3Rpb24gKGVkaXRvciwgcGx1Z2luVXJsLCBlbmFibGVkU3RhdGUpIHtcclxuICAgICAgZWRpdG9yLm9uKCdQcmV2aWV3Rm9ybWF0cyBBZnRlclByZXZpZXdGb3JtYXRzJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICBpZiAoZW5hYmxlZFN0YXRlLmdldCgpKSB7XHJcbiAgICAgICAgICBlZGl0b3IuZG9tLnRvZ2dsZUNsYXNzKGVkaXRvci5nZXRCb2R5KCksICdtY2UtdmlzdWFsYmxvY2tzJywgZS50eXBlID09PSAnYWZ0ZXJwcmV2aWV3Zm9ybWF0cycpO1xyXG4gICAgICAgIH1cclxuICAgICAgfSk7XHJcbiAgICAgIGVkaXRvci5vbignaW5pdCcsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICBpZiAoaXNFbmFibGVkQnlEZWZhdWx0KGVkaXRvcikpIHtcclxuICAgICAgICAgIHRvZ2dsZVZpc3VhbEJsb2NrcyhlZGl0b3IsIHBsdWdpblVybCwgZW5hYmxlZFN0YXRlKTtcclxuICAgICAgICB9XHJcbiAgICAgIH0pO1xyXG4gICAgfTtcclxuXHJcbiAgICB2YXIgdG9nZ2xlQWN0aXZlU3RhdGUgPSBmdW5jdGlvbiAoZWRpdG9yLCBlbmFibGVkU3RhdGUpIHtcclxuICAgICAgcmV0dXJuIGZ1bmN0aW9uIChhcGkpIHtcclxuICAgICAgICBhcGkuc2V0QWN0aXZlKGVuYWJsZWRTdGF0ZS5nZXQoKSk7XHJcbiAgICAgICAgdmFyIGVkaXRvckV2ZW50Q2FsbGJhY2sgPSBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgcmV0dXJuIGFwaS5zZXRBY3RpdmUoZS5zdGF0ZSk7XHJcbiAgICAgICAgfTtcclxuICAgICAgICBlZGl0b3Iub24oJ1Zpc3VhbEJsb2NrcycsIGVkaXRvckV2ZW50Q2FsbGJhY2spO1xyXG4gICAgICAgIHJldHVybiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICByZXR1cm4gZWRpdG9yLm9mZignVmlzdWFsQmxvY2tzJywgZWRpdG9yRXZlbnRDYWxsYmFjayk7XHJcbiAgICAgICAgfTtcclxuICAgICAgfTtcclxuICAgIH07XHJcbiAgICB2YXIgcmVnaXN0ZXIgPSBmdW5jdGlvbiAoZWRpdG9yLCBlbmFibGVkU3RhdGUpIHtcclxuICAgICAgdmFyIG9uQWN0aW9uID0gZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIHJldHVybiBlZGl0b3IuZXhlY0NvbW1hbmQoJ21jZVZpc3VhbEJsb2NrcycpO1xyXG4gICAgICB9O1xyXG4gICAgICBlZGl0b3IudWkucmVnaXN0cnkuYWRkVG9nZ2xlQnV0dG9uKCd2aXN1YWxibG9ja3MnLCB7XHJcbiAgICAgICAgaWNvbjogJ3Zpc3VhbGJsb2NrcycsXHJcbiAgICAgICAgdG9vbHRpcDogJ1Nob3cgYmxvY2tzJyxcclxuICAgICAgICBvbkFjdGlvbjogb25BY3Rpb24sXHJcbiAgICAgICAgb25TZXR1cDogdG9nZ2xlQWN0aXZlU3RhdGUoZWRpdG9yLCBlbmFibGVkU3RhdGUpXHJcbiAgICAgIH0pO1xyXG4gICAgICBlZGl0b3IudWkucmVnaXN0cnkuYWRkVG9nZ2xlTWVudUl0ZW0oJ3Zpc3VhbGJsb2NrcycsIHtcclxuICAgICAgICB0ZXh0OiAnU2hvdyBibG9ja3MnLFxyXG4gICAgICAgIGljb246ICd2aXN1YWxibG9ja3MnLFxyXG4gICAgICAgIG9uQWN0aW9uOiBvbkFjdGlvbixcclxuICAgICAgICBvblNldHVwOiB0b2dnbGVBY3RpdmVTdGF0ZShlZGl0b3IsIGVuYWJsZWRTdGF0ZSlcclxuICAgICAgfSk7XHJcbiAgICB9O1xyXG5cclxuICAgIGZ1bmN0aW9uIFBsdWdpbiAoKSB7XHJcbiAgICAgIGdsb2JhbC5hZGQoJ3Zpc3VhbGJsb2NrcycsIGZ1bmN0aW9uIChlZGl0b3IsIHBsdWdpblVybCkge1xyXG4gICAgICAgIHZhciBlbmFibGVkU3RhdGUgPSBDZWxsKGZhbHNlKTtcclxuICAgICAgICByZWdpc3RlciQxKGVkaXRvciwgcGx1Z2luVXJsLCBlbmFibGVkU3RhdGUpO1xyXG4gICAgICAgIHJlZ2lzdGVyKGVkaXRvciwgZW5hYmxlZFN0YXRlKTtcclxuICAgICAgICBzZXR1cChlZGl0b3IsIHBsdWdpblVybCwgZW5hYmxlZFN0YXRlKTtcclxuICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgUGx1Z2luKCk7XHJcblxyXG59KCkpO1xyXG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL3BsdWdpbnMvY3VzdG9tL3RpbnltY2UvcGx1Z2lucy92aXN1YWxibG9ja3MvcGx1Z2luLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/plugin.js\n");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/core/plugins/custom/tinymce/plugins/visualblocks/index.js");
/******/ 	
/******/ })()
;