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

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/index.js":
/*!***********************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/index.js ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("// Exports the \"noneditable\" plugin for usage with module loaders\n// Usage:\n//   CommonJS:\n//     require('tinymce/plugins/noneditable')\n//   ES2015:\n//     import 'tinymce/plugins/noneditable'\n__webpack_require__(/*! ./plugin.js */ \"./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/plugin.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL25vbmVkaXRhYmxlL2luZGV4LmpzLmpzIiwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBQSxtQkFBTyxDQUFDLGlHQUFELENBQVAiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL25vbmVkaXRhYmxlL2luZGV4LmpzP2QxNTMiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gRXhwb3J0cyB0aGUgXCJub25lZGl0YWJsZVwiIHBsdWdpbiBmb3IgdXNhZ2Ugd2l0aCBtb2R1bGUgbG9hZGVyc1xyXG4vLyBVc2FnZTpcclxuLy8gICBDb21tb25KUzpcclxuLy8gICAgIHJlcXVpcmUoJ3RpbnltY2UvcGx1Z2lucy9ub25lZGl0YWJsZScpXHJcbi8vICAgRVMyMDE1OlxyXG4vLyAgICAgaW1wb3J0ICd0aW55bWNlL3BsdWdpbnMvbm9uZWRpdGFibGUnXHJcbnJlcXVpcmUoJy4vcGx1Z2luLmpzJyk7Il0sIm5hbWVzIjpbInJlcXVpcmUiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/index.js\n");

/***/ }),

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/plugin.js":
/*!************************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/plugin.js ***!
  \************************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n(function () {\n  'use strict';\n\n  var global$1 = tinymce.util.Tools.resolve('tinymce.PluginManager');\n  var global = tinymce.util.Tools.resolve('tinymce.util.Tools');\n\n  var getNonEditableClass = function getNonEditableClass(editor) {\n    return editor.getParam('noneditable_noneditable_class', 'mceNonEditable');\n  };\n\n  var getEditableClass = function getEditableClass(editor) {\n    return editor.getParam('noneditable_editable_class', 'mceEditable');\n  };\n\n  var getNonEditableRegExps = function getNonEditableRegExps(editor) {\n    var nonEditableRegExps = editor.getParam('noneditable_regexp', []);\n\n    if (nonEditableRegExps && nonEditableRegExps.constructor === RegExp) {\n      return [nonEditableRegExps];\n    } else {\n      return nonEditableRegExps;\n    }\n  };\n\n  var hasClass = function hasClass(checkClassName) {\n    return function (node) {\n      return (' ' + node.attr('class') + ' ').indexOf(checkClassName) !== -1;\n    };\n  };\n\n  var replaceMatchWithSpan = function replaceMatchWithSpan(editor, content, cls) {\n    return function (match) {\n      var args = arguments,\n          index = args[args.length - 2];\n      var prevChar = index > 0 ? content.charAt(index - 1) : '';\n\n      if (prevChar === '\"') {\n        return match;\n      }\n\n      if (prevChar === '>') {\n        var findStartTagIndex = content.lastIndexOf('<', index);\n\n        if (findStartTagIndex !== -1) {\n          var tagHtml = content.substring(findStartTagIndex, index);\n\n          if (tagHtml.indexOf('contenteditable=\"false\"') !== -1) {\n            return match;\n          }\n        }\n      }\n\n      return '<span class=\"' + cls + '\" data-mce-content=\"' + editor.dom.encode(args[0]) + '\">' + editor.dom.encode(typeof args[1] === 'string' ? args[1] : args[0]) + '</span>';\n    };\n  };\n\n  var convertRegExpsToNonEditable = function convertRegExpsToNonEditable(editor, nonEditableRegExps, e) {\n    var i = nonEditableRegExps.length,\n        content = e.content;\n\n    if (e.format === 'raw') {\n      return;\n    }\n\n    while (i--) {\n      content = content.replace(nonEditableRegExps[i], replaceMatchWithSpan(editor, content, getNonEditableClass(editor)));\n    }\n\n    e.content = content;\n  };\n\n  var setup = function setup(editor) {\n    var contentEditableAttrName = 'contenteditable';\n    var editClass = ' ' + global.trim(getEditableClass(editor)) + ' ';\n    var nonEditClass = ' ' + global.trim(getNonEditableClass(editor)) + ' ';\n    var hasEditClass = hasClass(editClass);\n    var hasNonEditClass = hasClass(nonEditClass);\n    var nonEditableRegExps = getNonEditableRegExps(editor);\n    editor.on('PreInit', function () {\n      if (nonEditableRegExps.length > 0) {\n        editor.on('BeforeSetContent', function (e) {\n          convertRegExpsToNonEditable(editor, nonEditableRegExps, e);\n        });\n      }\n\n      editor.parser.addAttributeFilter('class', function (nodes) {\n        var i = nodes.length,\n            node;\n\n        while (i--) {\n          node = nodes[i];\n\n          if (hasEditClass(node)) {\n            node.attr(contentEditableAttrName, 'true');\n          } else if (hasNonEditClass(node)) {\n            node.attr(contentEditableAttrName, 'false');\n          }\n        }\n      });\n      editor.serializer.addAttributeFilter(contentEditableAttrName, function (nodes) {\n        var i = nodes.length,\n            node;\n\n        while (i--) {\n          node = nodes[i];\n\n          if (!hasEditClass(node) && !hasNonEditClass(node)) {\n            continue;\n          }\n\n          if (nonEditableRegExps.length > 0 && node.attr('data-mce-content')) {\n            node.name = '#text';\n            node.type = 3;\n            node.raw = true;\n            node.value = node.attr('data-mce-content');\n          } else {\n            node.attr(contentEditableAttrName, null);\n          }\n        }\n      });\n    });\n  };\n\n  function Plugin() {\n    global$1.add('noneditable', function (editor) {\n      setup(editor);\n    });\n  }\n\n  Plugin();\n})();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL25vbmVkaXRhYmxlL3BsdWdpbi5qcz9hNDE3Il0sIm5hbWVzIjpbImdsb2JhbCQxIiwidGlueW1jZSIsInV0aWwiLCJUb29scyIsInJlc29sdmUiLCJnbG9iYWwiLCJnZXROb25FZGl0YWJsZUNsYXNzIiwiZWRpdG9yIiwiZ2V0UGFyYW0iLCJnZXRFZGl0YWJsZUNsYXNzIiwiZ2V0Tm9uRWRpdGFibGVSZWdFeHBzIiwibm9uRWRpdGFibGVSZWdFeHBzIiwiY29uc3RydWN0b3IiLCJSZWdFeHAiLCJoYXNDbGFzcyIsImNoZWNrQ2xhc3NOYW1lIiwibm9kZSIsImF0dHIiLCJpbmRleE9mIiwicmVwbGFjZU1hdGNoV2l0aFNwYW4iLCJjb250ZW50IiwiY2xzIiwibWF0Y2giLCJhcmdzIiwiYXJndW1lbnRzIiwiaW5kZXgiLCJsZW5ndGgiLCJwcmV2Q2hhciIsImNoYXJBdCIsImZpbmRTdGFydFRhZ0luZGV4IiwibGFzdEluZGV4T2YiLCJ0YWdIdG1sIiwic3Vic3RyaW5nIiwiZG9tIiwiZW5jb2RlIiwiY29udmVydFJlZ0V4cHNUb05vbkVkaXRhYmxlIiwiZSIsImkiLCJmb3JtYXQiLCJyZXBsYWNlIiwic2V0dXAiLCJjb250ZW50RWRpdGFibGVBdHRyTmFtZSIsImVkaXRDbGFzcyIsInRyaW0iLCJub25FZGl0Q2xhc3MiLCJoYXNFZGl0Q2xhc3MiLCJoYXNOb25FZGl0Q2xhc3MiLCJvbiIsInBhcnNlciIsImFkZEF0dHJpYnV0ZUZpbHRlciIsIm5vZGVzIiwic2VyaWFsaXplciIsIm5hbWUiLCJ0eXBlIiwicmF3IiwidmFsdWUiLCJQbHVnaW4iLCJhZGQiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQyxhQUFZO0FBQ1Q7O0FBRUEsTUFBSUEsUUFBUSxHQUFHQyxPQUFPLENBQUNDLElB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QixJQUFELENBQWIsSUFBdUIsQ0FBQzhCLGVBQWUsQ0FBQzlCLElBQUQsQ0FBM0MsRUFBbUQ7QUFDakQ7QUFDRDs7QUFDRCxjQUFJTCxrQkFBa0IsQ0FBQ2UsTUFBbkIsR0FBNEIsQ0FBNUIsSUFBaUNWLElBQUksQ0FBQ0MsSUFBTCxDQUFVLGtCQUFWLENBQXJDLEVBQW9FO0FBQ2xFRCxZQUFBQSxJQUFJLENBQUNvQyxJQUFMLEdBQVksT0FBWjtBQUNBcEMsWUFBQUEsSUFBSSxDQUFDcUMsSUFBTCxHQUFZLENBQVo7QUFDQXJDLFlBQUFBLElBQUksQ0FBQ3NDLEdBQUwsR0FBVyxJQUFYO0FBQ0F0QyxZQUFBQSxJQUFJLENBQUN1QyxLQUFMLEdBQWF2QyxJQUFJLENBQUNDLElBQUwsQ0FBVSxrQkFBVixDQUFiO0FBQ0QsV0FMRCxNQUtPO0FBQ0xELFlBQUFBLElBQUksQ0FBQ0MsSUFBTCxDQUFVd0IsdUJBQVYsRUFBbUMsSUFBbkM7QUFDRDtBQUNGO0FBQ0YsT0FoQkQ7QUFpQkQsS0FsQ0Q7QUFtQ0QsR0ExQ0Q7O0FBNENBLFdBQVNlLE1BQVQsR0FBbUI7QUFDakJ4RCxJQUFBQSxRQUFRLENBQUN5RCxHQUFULENBQWEsYUFBYixFQUE0QixVQUFVbEQsTUFBVixFQUFrQjtBQUM1Q2lDLE1BQUFBLEtBQUssQ0FBQ2pDLE1BQUQsQ0FBTDtBQUNELEtBRkQ7QUFHRDs7QUFFRGlELEVBQUFBLE1BQU07QUFFVCxDQTVHQSxHQUFEIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXHJcbiAqIENvcHlyaWdodCAoYykgVGlueSBUZWNobm9sb2dpZXMsIEluYy4gQWxsIHJpZ2h0cyByZXNlcnZlZC5cclxuICogTGljZW5zZWQgdW5kZXIgdGhlIExHUEwgb3IgYSBjb21tZXJjaWFsIGxpY2Vuc2UuXHJcbiAqIEZvciBMR1BMIHNlZSBMaWNlbnNlLnR4dCBpbiB0aGUgcHJvamVjdCByb290IGZvciBsaWNlbnNlIGluZm9ybWF0aW9uLlxyXG4gKiBGb3IgY29tbWVyY2lhbCBsaWNlbnNlcyBzZWUgaHR0cHM6Ly93d3cudGlueS5jbG91ZC9cclxuICpcclxuICogVmVyc2lvbjogNS4xMC4zICgyMDIyLTAyLTA5KVxyXG4gKi9cclxuKGZ1bmN0aW9uICgpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICB2YXIgZ2xvYmFsJDEgPSB0aW55bWNlLnV0aWwuVG9vbHMucmVzb2x2ZSgndGlueW1jZS5QbHVnaW5NYW5hZ2VyJyk7XHJcblxyXG4gICAgdmFyIGdsb2JhbCA9IHRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKCd0aW55bWNlLnV0aWwuVG9vbHMnKTtcclxuXHJcbiAgICB2YXIgZ2V0Tm9uRWRpdGFibGVDbGFzcyA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgcmV0dXJuIGVkaXRvci5nZXRQYXJhbSgnbm9uZWRpdGFibGVfbm9uZWRpdGFibGVfY2xhc3MnLCAnbWNlTm9uRWRpdGFibGUnKTtcclxuICAgIH07XHJcbiAgICB2YXIgZ2V0RWRpdGFibGVDbGFzcyA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgcmV0dXJuIGVkaXRvci5nZXRQYXJhbSgnbm9uZWRpdGFibGVfZWRpdGFibGVfY2xhc3MnLCAnbWNlRWRpdGFibGUnKTtcclxuICAgIH07XHJcbiAgICB2YXIgZ2V0Tm9uRWRpdGFibGVSZWdFeHBzID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICB2YXIgbm9uRWRpdGFibGVSZWdFeHBzID0gZWRpdG9yLmdldFBhcmFtKCdub25lZGl0YWJsZV9yZWdleHAnLCBbXSk7XHJcbiAgICAgIGlmIChub25FZGl0YWJsZVJlZ0V4cHMgJiYgbm9uRWRpdGFibGVSZWdFeHBzLmNvbnN0cnVjdG9yID09PSBSZWdFeHApIHtcclxuICAgICAgICByZXR1cm4gW25vbkVkaXRhYmxlUmVnRXhwc107XHJcbiAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgcmV0dXJuIG5vbkVkaXRhYmxlUmVnRXhwcztcclxuICAgICAgfVxyXG4gICAgfTtcclxuXHJcbiAgICB2YXIgaGFzQ2xhc3MgPSBmdW5jdGlvbiAoY2hlY2tDbGFzc05hbWUpIHtcclxuICAgICAgcmV0dXJuIGZ1bmN0aW9uIChub2RlKSB7XHJcbiAgICAgICAgcmV0dXJuICgnICcgKyBub2RlLmF0dHIoJ2NsYXNzJykgKyAnICcpLmluZGV4T2YoY2hlY2tDbGFzc05hbWUpICE9PSAtMTtcclxuICAgICAgfTtcclxuICAgIH07XHJcbiAgICB2YXIgcmVwbGFjZU1hdGNoV2l0aFNwYW4gPSBmdW5jdGlvbiAoZWRpdG9yLCBjb250ZW50LCBjbHMpIHtcclxuICAgICAgcmV0dXJuIGZ1bmN0aW9uIChtYXRjaCkge1xyXG4gICAgICAgIHZhciBhcmdzID0gYXJndW1lbnRzLCBpbmRleCA9IGFyZ3NbYXJncy5sZW5ndGggLSAyXTtcclxuICAgICAgICB2YXIgcHJldkNoYXIgPSBpbmRleCA+IDAgPyBjb250ZW50LmNoYXJBdChpbmRleCAtIDEpIDogJyc7XHJcbiAgICAgICAgaWYgKHByZXZDaGFyID09PSAnXCInKSB7XHJcbiAgICAgICAgICByZXR1cm4gbWF0Y2g7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGlmIChwcmV2Q2hhciA9PT0gJz4nKSB7XHJcbiAgICAgICAgICB2YXIgZmluZFN0YXJ0VGFnSW5kZXggPSBjb250ZW50Lmxhc3RJbmRleE9mKCc8JywgaW5kZXgpO1xyXG4gICAgICAgICAgaWYgKGZpbmRTdGFydFRhZ0luZGV4ICE9PSAtMSkge1xyXG4gICAgICAgICAgICB2YXIgdGFnSHRtbCA9IGNvbnRlbnQuc3Vic3RyaW5nKGZpbmRTdGFydFRhZ0luZGV4LCBpbmRleCk7XHJcbiAgICAgICAgICAgIGlmICh0YWdIdG1sLmluZGV4T2YoJ2NvbnRlbnRlZGl0YWJsZT1cImZhbHNlXCInKSAhPT0gLTEpIHtcclxuICAgICAgICAgICAgICByZXR1cm4gbWF0Y2g7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgcmV0dXJuICc8c3BhbiBjbGFzcz1cIicgKyBjbHMgKyAnXCIgZGF0YS1tY2UtY29udGVudD1cIicgKyBlZGl0b3IuZG9tLmVuY29kZShhcmdzWzBdKSArICdcIj4nICsgZWRpdG9yLmRvbS5lbmNvZGUodHlwZW9mIGFyZ3NbMV0gPT09ICdzdHJpbmcnID8gYXJnc1sxXSA6IGFyZ3NbMF0pICsgJzwvc3Bhbj4nO1xyXG4gICAgICB9O1xyXG4gICAgfTtcclxuICAgIHZhciBjb252ZXJ0UmVnRXhwc1RvTm9uRWRpdGFibGUgPSBmdW5jdGlvbiAoZWRpdG9yLCBub25FZGl0YWJsZVJlZ0V4cHMsIGUpIHtcclxuICAgICAgdmFyIGkgPSBub25FZGl0YWJsZVJlZ0V4cHMubGVuZ3RoLCBjb250ZW50ID0gZS5jb250ZW50O1xyXG4gICAgICBpZiAoZS5mb3JtYXQgPT09ICdyYXcnKSB7XHJcbiAgICAgICAgcmV0dXJuO1xyXG4gICAgICB9XHJcbiAgICAgIHdoaWxlIChpLS0pIHtcclxuICAgICAgICBjb250ZW50ID0gY29udGVudC5yZXBsYWNlKG5vbkVkaXRhYmxlUmVnRXhwc1tpXSwgcmVwbGFjZU1hdGNoV2l0aFNwYW4oZWRpdG9yLCBjb250ZW50LCBnZXROb25FZGl0YWJsZUNsYXNzKGVkaXRvcikpKTtcclxuICAgICAgfVxyXG4gICAgICBlLmNvbnRlbnQgPSBjb250ZW50O1xyXG4gICAgfTtcclxuICAgIHZhciBzZXR1cCA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgdmFyIGNvbnRlbnRFZGl0YWJsZUF0dHJOYW1lID0gJ2NvbnRlbnRlZGl0YWJsZSc7XHJcbiAgICAgIHZhciBlZGl0Q2xhc3MgPSAnICcgKyBnbG9iYWwudHJpbShnZXRFZGl0YWJsZUNsYXNzKGVkaXRvcikpICsgJyAnO1xyXG4gICAgICB2YXIgbm9uRWRpdENsYXNzID0gJyAnICsgZ2xvYmFsLnRyaW0oZ2V0Tm9uRWRpdGFibGVDbGFzcyhlZGl0b3IpKSArICcgJztcclxuICAgICAgdmFyIGhhc0VkaXRDbGFzcyA9IGhhc0NsYXNzKGVkaXRDbGFzcyk7XHJcbiAgICAgIHZhciBoYXNOb25FZGl0Q2xhc3MgPSBoYXNDbGFzcyhub25FZGl0Q2xhc3MpO1xyXG4gICAgICB2YXIgbm9uRWRpdGFibGVSZWdFeHBzID0gZ2V0Tm9uRWRpdGFibGVSZWdFeHBzKGVkaXRvcik7XHJcbiAgICAgIGVkaXRvci5vbignUHJlSW5pdCcsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICBpZiAobm9uRWRpdGFibGVSZWdFeHBzLmxlbmd0aCA+IDApIHtcclxuICAgICAgICAgIGVkaXRvci5vbignQmVmb3JlU2V0Q29udGVudCcsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGNvbnZlcnRSZWdFeHBzVG9Ob25FZGl0YWJsZShlZGl0b3IsIG5vbkVkaXRhYmxlUmVnRXhwcywgZSk7XHJcbiAgICAgICAgICB9KTtcclxuICAgICAgICB9XHJcbiAgICAgICAgZWRpdG9yLnBhcnNlci5hZGRBdHRyaWJ1dGVGaWx0ZXIoJ2NsYXNzJywgZnVuY3Rpb24gKG5vZGVzKSB7XHJcbiAgICAgICAgICB2YXIgaSA9IG5vZGVzLmxlbmd0aCwgbm9kZTtcclxuICAgICAgICAgIHdoaWxlIChpLS0pIHtcclxuICAgICAgICAgICAgbm9kZSA9IG5vZGVzW2ldO1xyXG4gICAgICAgICAgICBpZiAoaGFzRWRpdENsYXNzKG5vZGUpKSB7XHJcbiAgICAgICAgICAgICAgbm9kZS5hdHRyKGNvbnRlbnRFZGl0YWJsZUF0dHJOYW1lLCAndHJ1ZScpO1xyXG4gICAgICAgICAgICB9IGVsc2UgaWYgKGhhc05vbkVkaXRDbGFzcyhub2RlKSkge1xyXG4gICAgICAgICAgICAgIG5vZGUuYXR0cihjb250ZW50RWRpdGFibGVBdHRyTmFtZSwgJ2ZhbHNlJyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgICAgICBlZGl0b3Iuc2VyaWFsaXplci5hZGRBdHRyaWJ1dGVGaWx0ZXIoY29udGVudEVkaXRhYmxlQXR0ck5hbWUsIGZ1bmN0aW9uIChub2Rlcykge1xyXG4gICAgICAgICAgdmFyIGkgPSBub2Rlcy5sZW5ndGgsIG5vZGU7XHJcbiAgICAgICAgICB3aGlsZSAoaS0tKSB7XHJcbiAgICAgICAgICAgIG5vZGUgPSBub2Rlc1tpXTtcclxuICAgICAgICAgICAgaWYgKCFoYXNFZGl0Q2xhc3Mobm9kZSkgJiYgIWhhc05vbkVkaXRDbGFzcyhub2RlKSkge1xyXG4gICAgICAgICAgICAgIGNvbnRpbnVlO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIGlmIChub25FZGl0YWJsZVJlZ0V4cHMubGVuZ3RoID4gMCAmJiBub2RlLmF0dHIoJ2RhdGEtbWNlLWNvbnRlbnQnKSkge1xyXG4gICAgICAgICAgICAgIG5vZGUubmFtZSA9ICcjdGV4dCc7XHJcbiAgICAgICAgICAgICAgbm9kZS50eXBlID0gMztcclxuICAgICAgICAgICAgICBub2RlLnJhdyA9IHRydWU7XHJcbiAgICAgICAgICAgICAgbm9kZS52YWx1ZSA9IG5vZGUuYXR0cignZGF0YS1tY2UtY29udGVudCcpO1xyXG4gICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgIG5vZGUuYXR0cihjb250ZW50RWRpdGFibGVBdHRyTmFtZSwgbnVsbCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgICAgfSk7XHJcbiAgICB9O1xyXG5cclxuICAgIGZ1bmN0aW9uIFBsdWdpbiAoKSB7XHJcbiAgICAgIGdsb2JhbCQxLmFkZCgnbm9uZWRpdGFibGUnLCBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgICAgc2V0dXAoZWRpdG9yKTtcclxuICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgUGx1Z2luKCk7XHJcblxyXG59KCkpO1xyXG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL3BsdWdpbnMvY3VzdG9tL3RpbnltY2UvcGx1Z2lucy9ub25lZGl0YWJsZS9wbHVnaW4uanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/plugin.js\n");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/core/plugins/custom/tinymce/plugins/noneditable/index.js");
/******/ 	
/******/ })()
;