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

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/index.js":
/*!********************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/index.js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("// Exports the \"tabfocus\" plugin for usage with module loaders\n// Usage:\n//   CommonJS:\n//     require('tinymce/plugins/tabfocus')\n//   ES2015:\n//     import 'tinymce/plugins/tabfocus'\n__webpack_require__(/*! ./plugin.js */ \"./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/plugin.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3RhYmZvY3VzL2luZGV4LmpzLmpzIiwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBQSxtQkFBTyxDQUFDLDhGQUFELENBQVAiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3RhYmZvY3VzL2luZGV4LmpzPzEwNDAiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gRXhwb3J0cyB0aGUgXCJ0YWJmb2N1c1wiIHBsdWdpbiBmb3IgdXNhZ2Ugd2l0aCBtb2R1bGUgbG9hZGVyc1xyXG4vLyBVc2FnZTpcclxuLy8gICBDb21tb25KUzpcclxuLy8gICAgIHJlcXVpcmUoJ3RpbnltY2UvcGx1Z2lucy90YWJmb2N1cycpXHJcbi8vICAgRVMyMDE1OlxyXG4vLyAgICAgaW1wb3J0ICd0aW55bWNlL3BsdWdpbnMvdGFiZm9jdXMnXHJcbnJlcXVpcmUoJy4vcGx1Z2luLmpzJyk7Il0sIm5hbWVzIjpbInJlcXVpcmUiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/index.js\n");

/***/ }),

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/plugin.js":
/*!*********************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/plugin.js ***!
  \*********************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n(function () {\n  'use strict';\n\n  var global$6 = tinymce.util.Tools.resolve('tinymce.PluginManager');\n  var global$5 = tinymce.util.Tools.resolve('tinymce.dom.DOMUtils');\n  var global$4 = tinymce.util.Tools.resolve('tinymce.EditorManager');\n  var global$3 = tinymce.util.Tools.resolve('tinymce.Env');\n  var global$2 = tinymce.util.Tools.resolve('tinymce.util.Delay');\n  var global$1 = tinymce.util.Tools.resolve('tinymce.util.Tools');\n  var global = tinymce.util.Tools.resolve('tinymce.util.VK');\n\n  var getTabFocusElements = function getTabFocusElements(editor) {\n    return editor.getParam('tabfocus_elements', ':prev,:next');\n  };\n\n  var getTabFocus = function getTabFocus(editor) {\n    return editor.getParam('tab_focus', getTabFocusElements(editor));\n  };\n\n  var DOM = global$5.DOM;\n\n  var tabCancel = function tabCancel(e) {\n    if (e.keyCode === global.TAB && !e.ctrlKey && !e.altKey && !e.metaKey) {\n      e.preventDefault();\n    }\n  };\n\n  var setup = function setup(editor) {\n    var tabHandler = function tabHandler(e) {\n      var x;\n\n      if (e.keyCode !== global.TAB || e.ctrlKey || e.altKey || e.metaKey || e.isDefaultPrevented()) {\n        return;\n      }\n\n      var find = function find(direction) {\n        var el = DOM.select(':input:enabled,*[tabindex]:not(iframe)');\n\n        var canSelectRecursive = function canSelectRecursive(e) {\n          var castElem = e;\n          return e.nodeName === 'BODY' || castElem.type !== 'hidden' && castElem.style.display !== 'none' && castElem.style.visibility !== 'hidden' && canSelectRecursive(e.parentNode);\n        };\n\n        var canSelect = function canSelect(el) {\n          return /INPUT|TEXTAREA|BUTTON/.test(el.tagName) && global$4.get(e.id) && el.tabIndex !== -1 && canSelectRecursive(el);\n        };\n\n        global$1.each(el, function (e, i) {\n          if (e.id === editor.id) {\n            x = i;\n            return false;\n          }\n        });\n\n        if (direction > 0) {\n          for (var i = x + 1; i < el.length; i++) {\n            if (canSelect(el[i])) {\n              return el[i];\n            }\n          }\n        } else {\n          for (var i = x - 1; i >= 0; i--) {\n            if (canSelect(el[i])) {\n              return el[i];\n            }\n          }\n        }\n\n        return null;\n      };\n\n      var v = global$1.explode(getTabFocus(editor));\n\n      if (v.length === 1) {\n        v[1] = v[0];\n        v[0] = ':prev';\n      }\n\n      var el;\n\n      if (e.shiftKey) {\n        if (v[0] === ':prev') {\n          el = find(-1);\n        } else {\n          el = DOM.get(v[0]);\n        }\n      } else {\n        if (v[1] === ':next') {\n          el = find(1);\n        } else {\n          el = DOM.get(v[1]);\n        }\n      }\n\n      if (el) {\n        var focusEditor = global$4.get(el.id || el.name);\n\n        if (el.id && focusEditor) {\n          focusEditor.focus();\n        } else {\n          global$2.setTimeout(function () {\n            if (!global$3.webkit) {\n              window.focus();\n            }\n\n            el.focus();\n          }, 10);\n        }\n\n        e.preventDefault();\n      }\n    };\n\n    editor.on('init', function () {\n      if (editor.inline) {\n        DOM.setAttrib(editor.getBody(), 'tabIndex', null);\n      }\n\n      editor.on('keyup', tabCancel);\n\n      if (global$3.gecko) {\n        editor.on('keypress keydown', tabHandler);\n      } else {\n        editor.on('keydown', tabHandler);\n      }\n    });\n  };\n\n  function Plugin() {\n    global$6.add('tabfocus', function (editor) {\n      setup(editor);\n    });\n  }\n\n  Plugin();\n})();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3RhYmZvY3VzL3BsdWdpbi5qcz8wY2Y0Il0sIm5hbWVzIjpbImdsb2JhbCQ2IiwidGlueW1jZSIsInV0aWwiLCJUb29scyIsInJlc29sdmUiLCJnbG9iYWwkNSIsImdsb2JhbCQ0IiwiZ2xvYmFsJDMiLCJnbG9iYWwkMiIsImdsb2JhbCQxIiwiZ2xvYmFsIiwiZ2V0VGFiRm9jdXNFbGVtZW50cyIsImVkaXRvciIsImdldFBhcmFtIiwiZ2V0VGFiRm9jdXMiLCJET00iLCJ0YWJDYW5jZWwiLCJlIiwia2V5Q29kZSIsIlRBQiIsImN0cmxLZXkiLCJhbHRLZXkiLCJtZXRhS2V5IiwicHJldmVudERlZmF1bHQiLCJzZXR1cCIsInRhYkhhbmRsZXIiLCJ4IiwiaXNEZWZhdWx0UHJldmVudGVkIiwiZmluZCIsImRpcmVjdGlvbiIsImVsIiwic2VsZWN0IiwiY2FuU2VsZWN0UmVjdXJzaXZlIiwiY2FzdEVsZW0iLCJub2RlTmFtZSIsInR5cGUiLCJzdHlsZSIsImRpc3BsYXkiLCJ2aXNpYmlsaXR5IiwicGFyZW50Tm9kZSIsImNhblNlbGVjdCIsInRlc3QiLCJ0YWdOYW1lIiwiZ2V0IiwiaWQiLCJ0YWJJbmRleCIsImVhY2giLCJpIiwibGVuZ3RoIiwidiIsImV4cGxvZGUiLCJzaGlmdEtleSIsImZvY3VzRWRpdG9yIiwibmFtZSIsImZvY3VzIiwic2V0VGltZW91dCIsIndlYmtpdCIsIndpbmRvdyIsIm9uIiwiaW5saW5lIiwic2V0QXR0cmliIiwiZ2V0Qm9keSIsImdlY2tvIiwiUGx1Z2luIiwiYWRkIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0MsYUFBWTtBQUNUOztBQUVBLE1BQUlBLFFBQVEsR0FBR0MsT0FBTyxDQUFDQyxJQUFSLENBQWFDLEtBQWIsQ0FBbUJDLE9BQW5CLENBQTJC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QWQsRUFBc0I7QUFDcEJDLGNBQUFBLE1BQU0sQ0FBQ0gsS0FBUDtBQUNEOztBQUNEeEIsWUFBQUEsRUFBRSxDQUFDd0IsS0FBSDtBQUNELFdBTEQsRUFLRyxFQUxIO0FBTUQ7O0FBQ0RyQyxRQUFBQSxDQUFDLENBQUNNLGNBQUY7QUFDRDtBQUNGLEtBcEVEOztBQXFFQVgsSUFBQUEsTUFBTSxDQUFDOEMsRUFBUCxDQUFVLE1BQVYsRUFBa0IsWUFBWTtBQUM1QixVQUFJOUMsTUFBTSxDQUFDK0MsTUFBWCxFQUFtQjtBQUNqQjVDLFFBQUFBLEdBQUcsQ0FBQzZDLFNBQUosQ0FBY2hELE1BQU0sQ0FBQ2lELE9BQVAsRUFBZCxFQUFnQyxVQUFoQyxFQUE0QyxJQUE1QztBQUNEOztBQUNEakQsTUFBQUEsTUFBTSxDQUFDOEMsRUFBUCxDQUFVLE9BQVYsRUFBbUIxQyxTQUFuQjs7QUFDQSxVQUFJVCxRQUFRLENBQUN1RCxLQUFiLEVBQW9CO0FBQ2xCbEQsUUFBQUEsTUFBTSxDQUFDOEMsRUFBUCxDQUFVLGtCQUFWLEVBQThCakMsVUFBOUI7QUFDRCxPQUZELE1BRU87QUFDTGIsUUFBQUEsTUFBTSxDQUFDOEMsRUFBUCxDQUFVLFNBQVYsRUFBcUJqQyxVQUFyQjtBQUNEO0FBQ0YsS0FWRDtBQVdELEdBakZEOztBQW1GQSxXQUFTc0MsTUFBVCxHQUFtQjtBQUNqQi9ELElBQUFBLFFBQVEsQ0FBQ2dFLEdBQVQsQ0FBYSxVQUFiLEVBQXlCLFVBQVVwRCxNQUFWLEVBQWtCO0FBQ3pDWSxNQUFBQSxLQUFLLENBQUNaLE1BQUQsQ0FBTDtBQUNELEtBRkQ7QUFHRDs7QUFFRG1ELEVBQUFBLE1BQU07QUFFVCxDQXpIQSxHQUFEIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXHJcbiAqIENvcHlyaWdodCAoYykgVGlueSBUZWNobm9sb2dpZXMsIEluYy4gQWxsIHJpZ2h0cyByZXNlcnZlZC5cclxuICogTGljZW5zZWQgdW5kZXIgdGhlIExHUEwgb3IgYSBjb21tZXJjaWFsIGxpY2Vuc2UuXHJcbiAqIEZvciBMR1BMIHNlZSBMaWNlbnNlLnR4dCBpbiB0aGUgcHJvamVjdCByb290IGZvciBsaWNlbnNlIGluZm9ybWF0aW9uLlxyXG4gKiBGb3IgY29tbWVyY2lhbCBsaWNlbnNlcyBzZWUgaHR0cHM6Ly93d3cudGlueS5jbG91ZC9cclxuICpcclxuICogVmVyc2lvbjogNS4xMC4zICgyMDIyLTAyLTA5KVxyXG4gKi9cclxuKGZ1bmN0aW9uICgpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICB2YXIgZ2xvYmFsJDYgPSB0aW55bWNlLnV0aWwuVG9vbHMucmVzb2x2ZSgndGlueW1jZS5QbHVnaW5NYW5hZ2VyJyk7XHJcblxyXG4gICAgdmFyIGdsb2JhbCQ1ID0gdGlueW1jZS51dGlsLlRvb2xzLnJlc29sdmUoJ3RpbnltY2UuZG9tLkRPTVV0aWxzJyk7XHJcblxyXG4gICAgdmFyIGdsb2JhbCQ0ID0gdGlueW1jZS51dGlsLlRvb2xzLnJlc29sdmUoJ3RpbnltY2UuRWRpdG9yTWFuYWdlcicpO1xyXG5cclxuICAgIHZhciBnbG9iYWwkMyA9IHRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKCd0aW55bWNlLkVudicpO1xyXG5cclxuICAgIHZhciBnbG9iYWwkMiA9IHRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKCd0aW55bWNlLnV0aWwuRGVsYXknKTtcclxuXHJcbiAgICB2YXIgZ2xvYmFsJDEgPSB0aW55bWNlLnV0aWwuVG9vbHMucmVzb2x2ZSgndGlueW1jZS51dGlsLlRvb2xzJyk7XHJcblxyXG4gICAgdmFyIGdsb2JhbCA9IHRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKCd0aW55bWNlLnV0aWwuVksnKTtcclxuXHJcbiAgICB2YXIgZ2V0VGFiRm9jdXNFbGVtZW50cyA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgcmV0dXJuIGVkaXRvci5nZXRQYXJhbSgndGFiZm9jdXNfZWxlbWVudHMnLCAnOnByZXYsOm5leHQnKTtcclxuICAgIH07XHJcbiAgICB2YXIgZ2V0VGFiRm9jdXMgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHJldHVybiBlZGl0b3IuZ2V0UGFyYW0oJ3RhYl9mb2N1cycsIGdldFRhYkZvY3VzRWxlbWVudHMoZWRpdG9yKSk7XHJcbiAgICB9O1xyXG5cclxuICAgIHZhciBET00gPSBnbG9iYWwkNS5ET007XHJcbiAgICB2YXIgdGFiQ2FuY2VsID0gZnVuY3Rpb24gKGUpIHtcclxuICAgICAgaWYgKGUua2V5Q29kZSA9PT0gZ2xvYmFsLlRBQiAmJiAhZS5jdHJsS2V5ICYmICFlLmFsdEtleSAmJiAhZS5tZXRhS2V5KSB7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICB9XHJcbiAgICB9O1xyXG4gICAgdmFyIHNldHVwID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICB2YXIgdGFiSGFuZGxlciA9IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgdmFyIHg7XHJcbiAgICAgICAgaWYgKGUua2V5Q29kZSAhPT0gZ2xvYmFsLlRBQiB8fCBlLmN0cmxLZXkgfHwgZS5hbHRLZXkgfHwgZS5tZXRhS2V5IHx8IGUuaXNEZWZhdWx0UHJldmVudGVkKCkpIHtcclxuICAgICAgICAgIHJldHVybjtcclxuICAgICAgICB9XHJcbiAgICAgICAgdmFyIGZpbmQgPSBmdW5jdGlvbiAoZGlyZWN0aW9uKSB7XHJcbiAgICAgICAgICB2YXIgZWwgPSBET00uc2VsZWN0KCc6aW5wdXQ6ZW5hYmxlZCwqW3RhYmluZGV4XTpub3QoaWZyYW1lKScpO1xyXG4gICAgICAgICAgdmFyIGNhblNlbGVjdFJlY3Vyc2l2ZSA9IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIHZhciBjYXN0RWxlbSA9IGU7XHJcbiAgICAgICAgICAgIHJldHVybiBlLm5vZGVOYW1lID09PSAnQk9EWScgfHwgY2FzdEVsZW0udHlwZSAhPT0gJ2hpZGRlbicgJiYgY2FzdEVsZW0uc3R5bGUuZGlzcGxheSAhPT0gJ25vbmUnICYmIGNhc3RFbGVtLnN0eWxlLnZpc2liaWxpdHkgIT09ICdoaWRkZW4nICYmIGNhblNlbGVjdFJlY3Vyc2l2ZShlLnBhcmVudE5vZGUpO1xyXG4gICAgICAgICAgfTtcclxuICAgICAgICAgIHZhciBjYW5TZWxlY3QgPSBmdW5jdGlvbiAoZWwpIHtcclxuICAgICAgICAgICAgcmV0dXJuIC9JTlBVVHxURVhUQVJFQXxCVVRUT04vLnRlc3QoZWwudGFnTmFtZSkgJiYgZ2xvYmFsJDQuZ2V0KGUuaWQpICYmIGVsLnRhYkluZGV4ICE9PSAtMSAmJiBjYW5TZWxlY3RSZWN1cnNpdmUoZWwpO1xyXG4gICAgICAgICAgfTtcclxuICAgICAgICAgIGdsb2JhbCQxLmVhY2goZWwsIGZ1bmN0aW9uIChlLCBpKSB7XHJcbiAgICAgICAgICAgIGlmIChlLmlkID09PSBlZGl0b3IuaWQpIHtcclxuICAgICAgICAgICAgICB4ID0gaTtcclxuICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgaWYgKGRpcmVjdGlvbiA+IDApIHtcclxuICAgICAgICAgICAgZm9yICh2YXIgaSA9IHggKyAxOyBpIDwgZWwubGVuZ3RoOyBpKyspIHtcclxuICAgICAgICAgICAgICBpZiAoY2FuU2VsZWN0KGVsW2ldKSkge1xyXG4gICAgICAgICAgICAgICAgcmV0dXJuIGVsW2ldO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgZm9yICh2YXIgaSA9IHggLSAxOyBpID49IDA7IGktLSkge1xyXG4gICAgICAgICAgICAgIGlmIChjYW5TZWxlY3QoZWxbaV0pKSB7XHJcbiAgICAgICAgICAgICAgICByZXR1cm4gZWxbaV07XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICByZXR1cm4gbnVsbDtcclxuICAgICAgICB9O1xyXG4gICAgICAgIHZhciB2ID0gZ2xvYmFsJDEuZXhwbG9kZShnZXRUYWJGb2N1cyhlZGl0b3IpKTtcclxuICAgICAgICBpZiAodi5sZW5ndGggPT09IDEpIHtcclxuICAgICAgICAgIHZbMV0gPSB2WzBdO1xyXG4gICAgICAgICAgdlswXSA9ICc6cHJldic7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIHZhciBlbDtcclxuICAgICAgICBpZiAoZS5zaGlmdEtleSkge1xyXG4gICAgICAgICAgaWYgKHZbMF0gPT09ICc6cHJldicpIHtcclxuICAgICAgICAgICAgZWwgPSBmaW5kKC0xKTtcclxuICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgIGVsID0gRE9NLmdldCh2WzBdKTtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgaWYgKHZbMV0gPT09ICc6bmV4dCcpIHtcclxuICAgICAgICAgICAgZWwgPSBmaW5kKDEpO1xyXG4gICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgZWwgPSBET00uZ2V0KHZbMV0pO1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICBpZiAoZWwpIHtcclxuICAgICAgICAgIHZhciBmb2N1c0VkaXRvciA9IGdsb2JhbCQ0LmdldChlbC5pZCB8fCBlbC5uYW1lKTtcclxuICAgICAgICAgIGlmIChlbC5pZCAmJiBmb2N1c0VkaXRvcikge1xyXG4gICAgICAgICAgICBmb2N1c0VkaXRvci5mb2N1cygpO1xyXG4gICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgZ2xvYmFsJDIuc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgaWYgKCFnbG9iYWwkMy53ZWJraXQpIHtcclxuICAgICAgICAgICAgICAgIHdpbmRvdy5mb2N1cygpO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBlbC5mb2N1cygpO1xyXG4gICAgICAgICAgICB9LCAxMCk7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgfVxyXG4gICAgICB9O1xyXG4gICAgICBlZGl0b3Iub24oJ2luaXQnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgaWYgKGVkaXRvci5pbmxpbmUpIHtcclxuICAgICAgICAgIERPTS5zZXRBdHRyaWIoZWRpdG9yLmdldEJvZHkoKSwgJ3RhYkluZGV4JywgbnVsbCk7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVkaXRvci5vbigna2V5dXAnLCB0YWJDYW5jZWwpO1xyXG4gICAgICAgIGlmIChnbG9iYWwkMy5nZWNrbykge1xyXG4gICAgICAgICAgZWRpdG9yLm9uKCdrZXlwcmVzcyBrZXlkb3duJywgdGFiSGFuZGxlcik7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgIGVkaXRvci5vbigna2V5ZG93bicsIHRhYkhhbmRsZXIpO1xyXG4gICAgICAgIH1cclxuICAgICAgfSk7XHJcbiAgICB9O1xyXG5cclxuICAgIGZ1bmN0aW9uIFBsdWdpbiAoKSB7XHJcbiAgICAgIGdsb2JhbCQ2LmFkZCgndGFiZm9jdXMnLCBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgICAgc2V0dXAoZWRpdG9yKTtcclxuICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgUGx1Z2luKCk7XHJcblxyXG59KCkpO1xyXG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL3BsdWdpbnMvY3VzdG9tL3RpbnltY2UvcGx1Z2lucy90YWJmb2N1cy9wbHVnaW4uanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/plugin.js\n");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/core/plugins/custom/tinymce/plugins/tabfocus/index.js");
/******/ 	
/******/ })()
;