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

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/toc/index.js":
/*!***************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/toc/index.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("// Exports the \"toc\" plugin for usage with module loaders\n// Usage:\n//   CommonJS:\n//     require('tinymce/plugins/toc')\n//   ES2015:\n//     import 'tinymce/plugins/toc'\n__webpack_require__(/*! ./plugin.js */ \"./resources/assets/core/plugins/custom/tinymce/plugins/toc/plugin.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3RvYy9pbmRleC5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQUEsbUJBQU8sQ0FBQyx5RkFBRCxDQUFQIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL3BsdWdpbnMvY3VzdG9tL3RpbnltY2UvcGx1Z2lucy90b2MvaW5kZXguanM/NmE4ZiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBFeHBvcnRzIHRoZSBcInRvY1wiIHBsdWdpbiBmb3IgdXNhZ2Ugd2l0aCBtb2R1bGUgbG9hZGVyc1xyXG4vLyBVc2FnZTpcclxuLy8gICBDb21tb25KUzpcclxuLy8gICAgIHJlcXVpcmUoJ3RpbnltY2UvcGx1Z2lucy90b2MnKVxyXG4vLyAgIEVTMjAxNTpcclxuLy8gICAgIGltcG9ydCAndGlueW1jZS9wbHVnaW5zL3RvYydcclxucmVxdWlyZSgnLi9wbHVnaW4uanMnKTsiXSwibmFtZXMiOlsicmVxdWlyZSJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/toc/index.js\n");

/***/ }),

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/toc/plugin.js":
/*!****************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/toc/plugin.js ***!
  \****************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n(function () {\n  'use strict';\n\n  var global$3 = tinymce.util.Tools.resolve('tinymce.PluginManager');\n  var global$2 = tinymce.util.Tools.resolve('tinymce.dom.DOMUtils');\n  var global$1 = tinymce.util.Tools.resolve('tinymce.util.I18n');\n  var global = tinymce.util.Tools.resolve('tinymce.util.Tools');\n\n  var getTocClass = function getTocClass(editor) {\n    return editor.getParam('toc_class', 'mce-toc');\n  };\n\n  var getTocHeader = function getTocHeader(editor) {\n    var tagName = editor.getParam('toc_header', 'h2');\n    return /^h[1-6]$/.test(tagName) ? tagName : 'h2';\n  };\n\n  var getTocDepth = function getTocDepth(editor) {\n    var depth = parseInt(editor.getParam('toc_depth', '3'), 10);\n    return depth >= 1 && depth <= 9 ? depth : 3;\n  };\n\n  var create = function create(prefix) {\n    var counter = 0;\n    return function () {\n      var guid = new Date().getTime().toString(32);\n      return prefix + guid + (counter++).toString(32);\n    };\n  };\n\n  var tocId = create('mcetoc_');\n\n  var generateSelector = function generateSelector(depth) {\n    var i;\n    var selector = [];\n\n    for (i = 1; i <= depth; i++) {\n      selector.push('h' + i);\n    }\n\n    return selector.join(',');\n  };\n\n  var hasHeaders = function hasHeaders(editor) {\n    return readHeaders(editor).length > 0;\n  };\n\n  var readHeaders = function readHeaders(editor) {\n    var tocClass = getTocClass(editor);\n    var headerTag = getTocHeader(editor);\n    var selector = generateSelector(getTocDepth(editor));\n    var headers = editor.$(selector);\n\n    if (headers.length && /^h[1-9]$/i.test(headerTag)) {\n      headers = headers.filter(function (i, el) {\n        return !editor.dom.hasClass(el.parentNode, tocClass);\n      });\n    }\n\n    return global.map(headers, function (h) {\n      var id = h.id;\n      return {\n        id: id ? id : tocId(),\n        level: parseInt(h.nodeName.replace(/^H/i, ''), 10),\n        title: editor.$.text(h),\n        element: h\n      };\n    });\n  };\n\n  var getMinLevel = function getMinLevel(headers) {\n    var minLevel = 9;\n\n    for (var i = 0; i < headers.length; i++) {\n      if (headers[i].level < minLevel) {\n        minLevel = headers[i].level;\n      }\n\n      if (minLevel === 1) {\n        return minLevel;\n      }\n    }\n\n    return minLevel;\n  };\n\n  var generateTitle = function generateTitle(tag, title) {\n    var openTag = '<' + tag + ' contenteditable=\"true\">';\n    var closeTag = '</' + tag + '>';\n    return openTag + global$2.DOM.encode(title) + closeTag;\n  };\n\n  var generateTocHtml = function generateTocHtml(editor) {\n    var html = generateTocContentHtml(editor);\n    return '<div class=\"' + editor.dom.encode(getTocClass(editor)) + '\" contenteditable=\"false\">' + html + '</div>';\n  };\n\n  var generateTocContentHtml = function generateTocContentHtml(editor) {\n    var html = '';\n    var headers = readHeaders(editor);\n    var prevLevel = getMinLevel(headers) - 1;\n\n    if (!headers.length) {\n      return '';\n    }\n\n    html += generateTitle(getTocHeader(editor), global$1.translate('Table of Contents'));\n\n    for (var i = 0; i < headers.length; i++) {\n      var h = headers[i];\n      h.element.id = h.id;\n      var nextLevel = headers[i + 1] && headers[i + 1].level;\n\n      if (prevLevel === h.level) {\n        html += '<li>';\n      } else {\n        for (var ii = prevLevel; ii < h.level; ii++) {\n          html += '<ul><li>';\n        }\n      }\n\n      html += '<a href=\"#' + h.id + '\">' + h.title + '</a>';\n\n      if (nextLevel === h.level || !nextLevel) {\n        html += '</li>';\n\n        if (!nextLevel) {\n          html += '</ul>';\n        }\n      } else {\n        for (var ii = h.level; ii > nextLevel; ii--) {\n          if (ii === nextLevel + 1) {\n            html += '</li></ul><li>';\n          } else {\n            html += '</li></ul>';\n          }\n        }\n      }\n\n      prevLevel = h.level;\n    }\n\n    return html;\n  };\n\n  var isEmptyOrOffscreen = function isEmptyOrOffscreen(editor, nodes) {\n    return !nodes.length || editor.dom.getParents(nodes[0], '.mce-offscreen-selection').length > 0;\n  };\n\n  var insertToc = function insertToc(editor) {\n    var tocClass = getTocClass(editor);\n    var $tocElm = editor.$('.' + tocClass);\n\n    if (isEmptyOrOffscreen(editor, $tocElm)) {\n      editor.insertContent(generateTocHtml(editor));\n    } else {\n      updateToc(editor);\n    }\n  };\n\n  var updateToc = function updateToc(editor) {\n    var tocClass = getTocClass(editor);\n    var $tocElm = editor.$('.' + tocClass);\n\n    if ($tocElm.length) {\n      editor.undoManager.transact(function () {\n        $tocElm.html(generateTocContentHtml(editor));\n      });\n    }\n  };\n\n  var register$1 = function register$1(editor) {\n    editor.addCommand('mceInsertToc', function () {\n      insertToc(editor);\n    });\n    editor.addCommand('mceUpdateToc', function () {\n      updateToc(editor);\n    });\n  };\n\n  var setup = function setup(editor) {\n    var $ = editor.$,\n        tocClass = getTocClass(editor);\n    editor.on('PreProcess', function (e) {\n      var $tocElm = $('.' + tocClass, e.node);\n\n      if ($tocElm.length) {\n        $tocElm.removeAttr('contentEditable');\n        $tocElm.find('[contenteditable]').removeAttr('contentEditable');\n      }\n    });\n    editor.on('SetContent', function () {\n      var $tocElm = $('.' + tocClass);\n\n      if ($tocElm.length) {\n        $tocElm.attr('contentEditable', false);\n        $tocElm.children(':first-child').attr('contentEditable', true);\n      }\n    });\n  };\n\n  var toggleState = function toggleState(editor) {\n    return function (api) {\n      var toggleDisabledState = function toggleDisabledState() {\n        return api.setDisabled(editor.mode.isReadOnly() || !hasHeaders(editor));\n      };\n\n      toggleDisabledState();\n      editor.on('LoadContent SetContent change', toggleDisabledState);\n      return function () {\n        return editor.on('LoadContent SetContent change', toggleDisabledState);\n      };\n    };\n  };\n\n  var isToc = function isToc(editor) {\n    return function (elm) {\n      return elm && editor.dom.is(elm, '.' + getTocClass(editor)) && editor.getBody().contains(elm);\n    };\n  };\n\n  var register = function register(editor) {\n    var insertTocAction = function insertTocAction() {\n      return editor.execCommand('mceInsertToc');\n    };\n\n    editor.ui.registry.addButton('toc', {\n      icon: 'toc',\n      tooltip: 'Table of contents',\n      onAction: insertTocAction,\n      onSetup: toggleState(editor)\n    });\n    editor.ui.registry.addButton('tocupdate', {\n      icon: 'reload',\n      tooltip: 'Update',\n      onAction: function onAction() {\n        return editor.execCommand('mceUpdateToc');\n      }\n    });\n    editor.ui.registry.addMenuItem('toc', {\n      icon: 'toc',\n      text: 'Table of contents',\n      onAction: insertTocAction,\n      onSetup: toggleState(editor)\n    });\n    editor.ui.registry.addContextToolbar('toc', {\n      items: 'tocupdate',\n      predicate: isToc(editor),\n      scope: 'node',\n      position: 'node'\n    });\n  };\n\n  function Plugin() {\n    global$3.add('toc', function (editor) {\n      register$1(editor);\n      register(editor);\n      setup(editor);\n    });\n  }\n\n  Plugin();\n})();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3RvYy9wbHVnaW4uanM/ZmJiZiJdLCJuYW1lcyI6WyJnbG9iYWwkMyIsInRpbnltY2UiLCJ1dGlsIiwiVG9vbHMiLCJyZXNvbHZlIiwiZ2xvYmFsJDIiLCJnbG9iYWwkMSIsImdsb2JhbCIsImdldFRvY0NsYXNzIiwiZWRpdG9yIiwiZ2V0UGFyYW0iLCJnZXRUb2NIZWFkZXIiLCJ0YWdOYW1lIiwidGVzdCIsImdldFRvY0RlcHRoIiwiZGVwdGgiLCJwYXJzZUludCIsImNyZWF0ZSIsInByZWZpeCIsImNvdW50ZXIiLCJndWlkIiwiRGF0ZSIsImdldFRpbWUiLCJ0b1N0cmluZyIsInRvY0lkIiwiZ2VuZXJhdGVTZWxlY3RvciIsImkiLCJzZWxlY3RvciIsInB1c2giLCJqb2luIiwiaGFzSGVhZGVycyIsInJlYWRIZWFkZXJzIiwibGVuZ3RoIiwidG9jQ2xhc3MiLCJoZWFkZXJUYWciLCJoZWFkZXJzIiwiJCIsImZpbHRlciIsImVsIiwiZG9tIiwiaGFzQ2xhc3MiLCJwYXJlbnROb2RlIiwibWFwIiwiaCIsImlkIiwibGV2ZWwiLCJub2RlTmFtZSIsInJlcGxhY2UiLCJ0aXRsZSIsInRleHQiLCJlbGVtZW50IiwiZ2V0TWluTGV2ZWwiLCJtaW5MZXZlbCIsImdlbmVyYXRlVGl0bGUiLCJ0YWciLCJvcGVuVGFnIiwiY2xvc2VUYWciLCJET00iLCJlbmNvZGUiLCJnZW5lcmF0ZVRvY0h0bWwiLCJodG1sIiwiZ2VuZXJhdGVUb2NDb250ZW50SHRtbCIsInByZXZMZXZlbCIsInRyYW5zbGF0ZSIsIm5leHRMZXZlbCIsImlpIiwiaXNFbXB0eU9yT2Zmc2NyZWVuIiwibm9kZXMiLCJnZXRQYXJlbnRzIiwiaW5zZXJ0VG9jIiwiJHRvY0VsbSIsImluc2VydENvbnRlbnQiLCJ1cGRhdGVUb2MiLCJ1bmRvTWFuYWdlciIsInRyYW5zYWN0IiwicmVnaXN0ZXIkMSIsImFkZENvbW1hbmQiLCJzZXR1cCIsIm9uIiwiZSIsIm5vZGUiLCJyZW1vdmVBdHRyIiwiZmluZCIsImF0dHIiLCJjaGlsZHJlbiIsInRvZ2dsZVN0YXRlIiwiYXBpIiwidG9nZ2xlRGlzYWJsZWRTdGF0ZSIsInNldERpc2FibGVkIiwibW9kZSIsImlzUmVhZE9ubHkiLCJpc1RvYyIsImVsbSIsImlzIiwiZ2V0Qm9keSIsImNvbnRhaW5zIiwicmVnaXN0ZXIiLCJpbnNlcnRUb2NBY3Rpb24iLCJleGVjQ29tbWFuZCIsInVpIiwicmVnaXN0cnkiLCJhZGRCdXR0b24iLCJpY29uIiwidG9vbHRpcCIsIm9uQWN0aW9uIiwib25TZXR1cCIsImFkZE1lbnVJdGVtIiwiYWRkQ29udGV4dFRvb2xiYXIiLCJpdGVtcyIsInByZWRpY2F0ZSIsInNjb3BlIiwicG9zaXRpb24iLCJQbHVnaW4iLCJhZGQiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQyxhQUFZO0FBQ1Q7O0FBRUEsTUFBSUEsUUFBUSxHQUFHQyxPQUFPLENBQUNDLElBQVIsQ0FBYUMsS0FBYixDQUFtQkMsT0FBbkIsQ0FBMkIsdUJBQTNCLENBQWY7QUFFQSxNQUFJQyxRQUFRLEdBQUdKLE9BQU8sQ0FBQ0MsSUFBUixDQUFhQyxLQUFiLENBQW1CQyxPQUFuQixDQUEyQixzQkFBM0IsQ0FBZjtBQUVBLE1BQUlFLFFBQVEsR0FBR0wsT0FBTyxDQUFDQyxJQUFSLENBQWFDLEtBQWIsQ0FBbUJDLE9BQW5CLENBQTJCLG1CQUEzQixDQUFmO0FBRUEsTUFBSUcsTUFBTSxHQUFHTixPQUFPLENBQUNDLElBQVIsQ0FBYUMsS0FBYixDQUFtQkMsT0FBbkIsQ0FBMkIsb0JBQTNCLENBQWI7O0FBRUEsTUFBSUksV0FBVyxHQUFHLFNBQWRBLFdBQWMsQ0FBVUMsTUFBVixFQUFrQjtBQUNsQyxXQUFPQSxNQUFNLENBQUNDLFFBQVAsQ0FBZ0IsV0FBaEIsRUFBNkIsU0FBN0IsQ0FBUDtBQUNELEdBRkQ7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RCxDQUFSO0FBQ0FvRSxNQUFBQSxLQUFLLENBQUNwRSxNQUFELENBQUw7QUFDRCxLQUpEO0FBS0Q7O0FBRUR1RyxFQUFBQSxNQUFNO0FBRVQsQ0FyT0EsR0FBRCIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBDb3B5cmlnaHQgKGMpIFRpbnkgVGVjaG5vbG9naWVzLCBJbmMuIEFsbCByaWdodHMgcmVzZXJ2ZWQuXHJcbiAqIExpY2Vuc2VkIHVuZGVyIHRoZSBMR1BMIG9yIGEgY29tbWVyY2lhbCBsaWNlbnNlLlxyXG4gKiBGb3IgTEdQTCBzZWUgTGljZW5zZS50eHQgaW4gdGhlIHByb2plY3Qgcm9vdCBmb3IgbGljZW5zZSBpbmZvcm1hdGlvbi5cclxuICogRm9yIGNvbW1lcmNpYWwgbGljZW5zZXMgc2VlIGh0dHBzOi8vd3d3LnRpbnkuY2xvdWQvXHJcbiAqXHJcbiAqIFZlcnNpb246IDUuMTAuMyAoMjAyMi0wMi0wOSlcclxuICovXHJcbihmdW5jdGlvbiAoKSB7XHJcbiAgICAndXNlIHN0cmljdCc7XHJcblxyXG4gICAgdmFyIGdsb2JhbCQzID0gdGlueW1jZS51dGlsLlRvb2xzLnJlc29sdmUoJ3RpbnltY2UuUGx1Z2luTWFuYWdlcicpO1xyXG5cclxuICAgIHZhciBnbG9iYWwkMiA9IHRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKCd0aW55bWNlLmRvbS5ET01VdGlscycpO1xyXG5cclxuICAgIHZhciBnbG9iYWwkMSA9IHRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKCd0aW55bWNlLnV0aWwuSTE4bicpO1xyXG5cclxuICAgIHZhciBnbG9iYWwgPSB0aW55bWNlLnV0aWwuVG9vbHMucmVzb2x2ZSgndGlueW1jZS51dGlsLlRvb2xzJyk7XHJcblxyXG4gICAgdmFyIGdldFRvY0NsYXNzID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICByZXR1cm4gZWRpdG9yLmdldFBhcmFtKCd0b2NfY2xhc3MnLCAnbWNlLXRvYycpO1xyXG4gICAgfTtcclxuICAgIHZhciBnZXRUb2NIZWFkZXIgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHZhciB0YWdOYW1lID0gZWRpdG9yLmdldFBhcmFtKCd0b2NfaGVhZGVyJywgJ2gyJyk7XHJcbiAgICAgIHJldHVybiAvXmhbMS02XSQvLnRlc3QodGFnTmFtZSkgPyB0YWdOYW1lIDogJ2gyJztcclxuICAgIH07XHJcbiAgICB2YXIgZ2V0VG9jRGVwdGggPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHZhciBkZXB0aCA9IHBhcnNlSW50KGVkaXRvci5nZXRQYXJhbSgndG9jX2RlcHRoJywgJzMnKSwgMTApO1xyXG4gICAgICByZXR1cm4gZGVwdGggPj0gMSAmJiBkZXB0aCA8PSA5ID8gZGVwdGggOiAzO1xyXG4gICAgfTtcclxuXHJcbiAgICB2YXIgY3JlYXRlID0gZnVuY3Rpb24gKHByZWZpeCkge1xyXG4gICAgICB2YXIgY291bnRlciA9IDA7XHJcbiAgICAgIHJldHVybiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdmFyIGd1aWQgPSBuZXcgRGF0ZSgpLmdldFRpbWUoKS50b1N0cmluZygzMik7XHJcbiAgICAgICAgcmV0dXJuIHByZWZpeCArIGd1aWQgKyAoY291bnRlcisrKS50b1N0cmluZygzMik7XHJcbiAgICAgIH07XHJcbiAgICB9O1xyXG5cclxuICAgIHZhciB0b2NJZCA9IGNyZWF0ZSgnbWNldG9jXycpO1xyXG4gICAgdmFyIGdlbmVyYXRlU2VsZWN0b3IgPSBmdW5jdGlvbiAoZGVwdGgpIHtcclxuICAgICAgdmFyIGk7XHJcbiAgICAgIHZhciBzZWxlY3RvciA9IFtdO1xyXG4gICAgICBmb3IgKGkgPSAxOyBpIDw9IGRlcHRoOyBpKyspIHtcclxuICAgICAgICBzZWxlY3Rvci5wdXNoKCdoJyArIGkpO1xyXG4gICAgICB9XHJcbiAgICAgIHJldHVybiBzZWxlY3Rvci5qb2luKCcsJyk7XHJcbiAgICB9O1xyXG4gICAgdmFyIGhhc0hlYWRlcnMgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHJldHVybiByZWFkSGVhZGVycyhlZGl0b3IpLmxlbmd0aCA+IDA7XHJcbiAgICB9O1xyXG4gICAgdmFyIHJlYWRIZWFkZXJzID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICB2YXIgdG9jQ2xhc3MgPSBnZXRUb2NDbGFzcyhlZGl0b3IpO1xyXG4gICAgICB2YXIgaGVhZGVyVGFnID0gZ2V0VG9jSGVhZGVyKGVkaXRvcik7XHJcbiAgICAgIHZhciBzZWxlY3RvciA9IGdlbmVyYXRlU2VsZWN0b3IoZ2V0VG9jRGVwdGgoZWRpdG9yKSk7XHJcbiAgICAgIHZhciBoZWFkZXJzID0gZWRpdG9yLiQoc2VsZWN0b3IpO1xyXG4gICAgICBpZiAoaGVhZGVycy5sZW5ndGggJiYgL15oWzEtOV0kL2kudGVzdChoZWFkZXJUYWcpKSB7XHJcbiAgICAgICAgaGVhZGVycyA9IGhlYWRlcnMuZmlsdGVyKGZ1bmN0aW9uIChpLCBlbCkge1xyXG4gICAgICAgICAgcmV0dXJuICFlZGl0b3IuZG9tLmhhc0NsYXNzKGVsLnBhcmVudE5vZGUsIHRvY0NsYXNzKTtcclxuICAgICAgICB9KTtcclxuICAgICAgfVxyXG4gICAgICByZXR1cm4gZ2xvYmFsLm1hcChoZWFkZXJzLCBmdW5jdGlvbiAoaCkge1xyXG4gICAgICAgIHZhciBpZCA9IGguaWQ7XHJcbiAgICAgICAgcmV0dXJuIHtcclxuICAgICAgICAgIGlkOiBpZCA/IGlkIDogdG9jSWQoKSxcclxuICAgICAgICAgIGxldmVsOiBwYXJzZUludChoLm5vZGVOYW1lLnJlcGxhY2UoL15IL2ksICcnKSwgMTApLFxyXG4gICAgICAgICAgdGl0bGU6IGVkaXRvci4kLnRleHQoaCksXHJcbiAgICAgICAgICBlbGVtZW50OiBoXHJcbiAgICAgICAgfTtcclxuICAgICAgfSk7XHJcbiAgICB9O1xyXG4gICAgdmFyIGdldE1pbkxldmVsID0gZnVuY3Rpb24gKGhlYWRlcnMpIHtcclxuICAgICAgdmFyIG1pbkxldmVsID0gOTtcclxuICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCBoZWFkZXJzLmxlbmd0aDsgaSsrKSB7XHJcbiAgICAgICAgaWYgKGhlYWRlcnNbaV0ubGV2ZWwgPCBtaW5MZXZlbCkge1xyXG4gICAgICAgICAgbWluTGV2ZWwgPSBoZWFkZXJzW2ldLmxldmVsO1xyXG4gICAgICAgIH1cclxuICAgICAgICBpZiAobWluTGV2ZWwgPT09IDEpIHtcclxuICAgICAgICAgIHJldHVybiBtaW5MZXZlbDtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgcmV0dXJuIG1pbkxldmVsO1xyXG4gICAgfTtcclxuICAgIHZhciBnZW5lcmF0ZVRpdGxlID0gZnVuY3Rpb24gKHRhZywgdGl0bGUpIHtcclxuICAgICAgdmFyIG9wZW5UYWcgPSAnPCcgKyB0YWcgKyAnIGNvbnRlbnRlZGl0YWJsZT1cInRydWVcIj4nO1xyXG4gICAgICB2YXIgY2xvc2VUYWcgPSAnPC8nICsgdGFnICsgJz4nO1xyXG4gICAgICByZXR1cm4gb3BlblRhZyArIGdsb2JhbCQyLkRPTS5lbmNvZGUodGl0bGUpICsgY2xvc2VUYWc7XHJcbiAgICB9O1xyXG4gICAgdmFyIGdlbmVyYXRlVG9jSHRtbCA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgdmFyIGh0bWwgPSBnZW5lcmF0ZVRvY0NvbnRlbnRIdG1sKGVkaXRvcik7XHJcbiAgICAgIHJldHVybiAnPGRpdiBjbGFzcz1cIicgKyBlZGl0b3IuZG9tLmVuY29kZShnZXRUb2NDbGFzcyhlZGl0b3IpKSArICdcIiBjb250ZW50ZWRpdGFibGU9XCJmYWxzZVwiPicgKyBodG1sICsgJzwvZGl2Pic7XHJcbiAgICB9O1xyXG4gICAgdmFyIGdlbmVyYXRlVG9jQ29udGVudEh0bWwgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHZhciBodG1sID0gJyc7XHJcbiAgICAgIHZhciBoZWFkZXJzID0gcmVhZEhlYWRlcnMoZWRpdG9yKTtcclxuICAgICAgdmFyIHByZXZMZXZlbCA9IGdldE1pbkxldmVsKGhlYWRlcnMpIC0gMTtcclxuICAgICAgaWYgKCFoZWFkZXJzLmxlbmd0aCkge1xyXG4gICAgICAgIHJldHVybiAnJztcclxuICAgICAgfVxyXG4gICAgICBodG1sICs9IGdlbmVyYXRlVGl0bGUoZ2V0VG9jSGVhZGVyKGVkaXRvciksIGdsb2JhbCQxLnRyYW5zbGF0ZSgnVGFibGUgb2YgQ29udGVudHMnKSk7XHJcbiAgICAgIGZvciAodmFyIGkgPSAwOyBpIDwgaGVhZGVycy5sZW5ndGg7IGkrKykge1xyXG4gICAgICAgIHZhciBoID0gaGVhZGVyc1tpXTtcclxuICAgICAgICBoLmVsZW1lbnQuaWQgPSBoLmlkO1xyXG4gICAgICAgIHZhciBuZXh0TGV2ZWwgPSBoZWFkZXJzW2kgKyAxXSAmJiBoZWFkZXJzW2kgKyAxXS5sZXZlbDtcclxuICAgICAgICBpZiAocHJldkxldmVsID09PSBoLmxldmVsKSB7XHJcbiAgICAgICAgICBodG1sICs9ICc8bGk+JztcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgZm9yICh2YXIgaWkgPSBwcmV2TGV2ZWw7IGlpIDwgaC5sZXZlbDsgaWkrKykge1xyXG4gICAgICAgICAgICBodG1sICs9ICc8dWw+PGxpPic7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGh0bWwgKz0gJzxhIGhyZWY9XCIjJyArIGguaWQgKyAnXCI+JyArIGgudGl0bGUgKyAnPC9hPic7XHJcbiAgICAgICAgaWYgKG5leHRMZXZlbCA9PT0gaC5sZXZlbCB8fCAhbmV4dExldmVsKSB7XHJcbiAgICAgICAgICBodG1sICs9ICc8L2xpPic7XHJcbiAgICAgICAgICBpZiAoIW5leHRMZXZlbCkge1xyXG4gICAgICAgICAgICBodG1sICs9ICc8L3VsPic7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgIGZvciAodmFyIGlpID0gaC5sZXZlbDsgaWkgPiBuZXh0TGV2ZWw7IGlpLS0pIHtcclxuICAgICAgICAgICAgaWYgKGlpID09PSBuZXh0TGV2ZWwgKyAxKSB7XHJcbiAgICAgICAgICAgICAgaHRtbCArPSAnPC9saT48L3VsPjxsaT4nO1xyXG4gICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgIGh0bWwgKz0gJzwvbGk+PC91bD4nO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIHByZXZMZXZlbCA9IGgubGV2ZWw7XHJcbiAgICAgIH1cclxuICAgICAgcmV0dXJuIGh0bWw7XHJcbiAgICB9O1xyXG4gICAgdmFyIGlzRW1wdHlPck9mZnNjcmVlbiA9IGZ1bmN0aW9uIChlZGl0b3IsIG5vZGVzKSB7XHJcbiAgICAgIHJldHVybiAhbm9kZXMubGVuZ3RoIHx8IGVkaXRvci5kb20uZ2V0UGFyZW50cyhub2Rlc1swXSwgJy5tY2Utb2Zmc2NyZWVuLXNlbGVjdGlvbicpLmxlbmd0aCA+IDA7XHJcbiAgICB9O1xyXG4gICAgdmFyIGluc2VydFRvYyA9IGZ1bmN0aW9uIChlZGl0b3IpIHtcclxuICAgICAgdmFyIHRvY0NsYXNzID0gZ2V0VG9jQ2xhc3MoZWRpdG9yKTtcclxuICAgICAgdmFyICR0b2NFbG0gPSBlZGl0b3IuJCgnLicgKyB0b2NDbGFzcyk7XHJcbiAgICAgIGlmIChpc0VtcHR5T3JPZmZzY3JlZW4oZWRpdG9yLCAkdG9jRWxtKSkge1xyXG4gICAgICAgIGVkaXRvci5pbnNlcnRDb250ZW50KGdlbmVyYXRlVG9jSHRtbChlZGl0b3IpKTtcclxuICAgICAgfSBlbHNlIHtcclxuICAgICAgICB1cGRhdGVUb2MoZWRpdG9yKTtcclxuICAgICAgfVxyXG4gICAgfTtcclxuICAgIHZhciB1cGRhdGVUb2MgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHZhciB0b2NDbGFzcyA9IGdldFRvY0NsYXNzKGVkaXRvcik7XHJcbiAgICAgIHZhciAkdG9jRWxtID0gZWRpdG9yLiQoJy4nICsgdG9jQ2xhc3MpO1xyXG4gICAgICBpZiAoJHRvY0VsbS5sZW5ndGgpIHtcclxuICAgICAgICBlZGl0b3IudW5kb01hbmFnZXIudHJhbnNhY3QoZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgJHRvY0VsbS5odG1sKGdlbmVyYXRlVG9jQ29udGVudEh0bWwoZWRpdG9yKSk7XHJcbiAgICAgICAgfSk7XHJcbiAgICAgIH1cclxuICAgIH07XHJcblxyXG4gICAgdmFyIHJlZ2lzdGVyJDEgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIGVkaXRvci5hZGRDb21tYW5kKCdtY2VJbnNlcnRUb2MnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgaW5zZXJ0VG9jKGVkaXRvcik7XHJcbiAgICAgIH0pO1xyXG4gICAgICBlZGl0b3IuYWRkQ29tbWFuZCgnbWNlVXBkYXRlVG9jJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIHVwZGF0ZVRvYyhlZGl0b3IpO1xyXG4gICAgICB9KTtcclxuICAgIH07XHJcblxyXG4gICAgdmFyIHNldHVwID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICB2YXIgJCA9IGVkaXRvci4kLCB0b2NDbGFzcyA9IGdldFRvY0NsYXNzKGVkaXRvcik7XHJcbiAgICAgIGVkaXRvci5vbignUHJlUHJvY2VzcycsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgdmFyICR0b2NFbG0gPSAkKCcuJyArIHRvY0NsYXNzLCBlLm5vZGUpO1xyXG4gICAgICAgIGlmICgkdG9jRWxtLmxlbmd0aCkge1xyXG4gICAgICAgICAgJHRvY0VsbS5yZW1vdmVBdHRyKCdjb250ZW50RWRpdGFibGUnKTtcclxuICAgICAgICAgICR0b2NFbG0uZmluZCgnW2NvbnRlbnRlZGl0YWJsZV0nKS5yZW1vdmVBdHRyKCdjb250ZW50RWRpdGFibGUnKTtcclxuICAgICAgICB9XHJcbiAgICAgIH0pO1xyXG4gICAgICBlZGl0b3Iub24oJ1NldENvbnRlbnQnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdmFyICR0b2NFbG0gPSAkKCcuJyArIHRvY0NsYXNzKTtcclxuICAgICAgICBpZiAoJHRvY0VsbS5sZW5ndGgpIHtcclxuICAgICAgICAgICR0b2NFbG0uYXR0cignY29udGVudEVkaXRhYmxlJywgZmFsc2UpO1xyXG4gICAgICAgICAgJHRvY0VsbS5jaGlsZHJlbignOmZpcnN0LWNoaWxkJykuYXR0cignY29udGVudEVkaXRhYmxlJywgdHJ1ZSk7XHJcbiAgICAgICAgfVxyXG4gICAgICB9KTtcclxuICAgIH07XHJcblxyXG4gICAgdmFyIHRvZ2dsZVN0YXRlID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICByZXR1cm4gZnVuY3Rpb24gKGFwaSkge1xyXG4gICAgICAgIHZhciB0b2dnbGVEaXNhYmxlZFN0YXRlID0gZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgcmV0dXJuIGFwaS5zZXREaXNhYmxlZChlZGl0b3IubW9kZS5pc1JlYWRPbmx5KCkgfHwgIWhhc0hlYWRlcnMoZWRpdG9yKSk7XHJcbiAgICAgICAgfTtcclxuICAgICAgICB0b2dnbGVEaXNhYmxlZFN0YXRlKCk7XHJcbiAgICAgICAgZWRpdG9yLm9uKCdMb2FkQ29udGVudCBTZXRDb250ZW50IGNoYW5nZScsIHRvZ2dsZURpc2FibGVkU3RhdGUpO1xyXG4gICAgICAgIHJldHVybiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICByZXR1cm4gZWRpdG9yLm9uKCdMb2FkQ29udGVudCBTZXRDb250ZW50IGNoYW5nZScsIHRvZ2dsZURpc2FibGVkU3RhdGUpO1xyXG4gICAgICAgIH07XHJcbiAgICAgIH07XHJcbiAgICB9O1xyXG4gICAgdmFyIGlzVG9jID0gZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICByZXR1cm4gZnVuY3Rpb24gKGVsbSkge1xyXG4gICAgICAgIHJldHVybiBlbG0gJiYgZWRpdG9yLmRvbS5pcyhlbG0sICcuJyArIGdldFRvY0NsYXNzKGVkaXRvcikpICYmIGVkaXRvci5nZXRCb2R5KCkuY29udGFpbnMoZWxtKTtcclxuICAgICAgfTtcclxuICAgIH07XHJcbiAgICB2YXIgcmVnaXN0ZXIgPSBmdW5jdGlvbiAoZWRpdG9yKSB7XHJcbiAgICAgIHZhciBpbnNlcnRUb2NBY3Rpb24gPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgcmV0dXJuIGVkaXRvci5leGVjQ29tbWFuZCgnbWNlSW5zZXJ0VG9jJyk7XHJcbiAgICAgIH07XHJcbiAgICAgIGVkaXRvci51aS5yZWdpc3RyeS5hZGRCdXR0b24oJ3RvYycsIHtcclxuICAgICAgICBpY29uOiAndG9jJyxcclxuICAgICAgICB0b29sdGlwOiAnVGFibGUgb2YgY29udGVudHMnLFxyXG4gICAgICAgIG9uQWN0aW9uOiBpbnNlcnRUb2NBY3Rpb24sXHJcbiAgICAgICAgb25TZXR1cDogdG9nZ2xlU3RhdGUoZWRpdG9yKVxyXG4gICAgICB9KTtcclxuICAgICAgZWRpdG9yLnVpLnJlZ2lzdHJ5LmFkZEJ1dHRvbigndG9jdXBkYXRlJywge1xyXG4gICAgICAgIGljb246ICdyZWxvYWQnLFxyXG4gICAgICAgIHRvb2x0aXA6ICdVcGRhdGUnLFxyXG4gICAgICAgIG9uQWN0aW9uOiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICByZXR1cm4gZWRpdG9yLmV4ZWNDb21tYW5kKCdtY2VVcGRhdGVUb2MnKTtcclxuICAgICAgICB9XHJcbiAgICAgIH0pO1xyXG4gICAgICBlZGl0b3IudWkucmVnaXN0cnkuYWRkTWVudUl0ZW0oJ3RvYycsIHtcclxuICAgICAgICBpY29uOiAndG9jJyxcclxuICAgICAgICB0ZXh0OiAnVGFibGUgb2YgY29udGVudHMnLFxyXG4gICAgICAgIG9uQWN0aW9uOiBpbnNlcnRUb2NBY3Rpb24sXHJcbiAgICAgICAgb25TZXR1cDogdG9nZ2xlU3RhdGUoZWRpdG9yKVxyXG4gICAgICB9KTtcclxuICAgICAgZWRpdG9yLnVpLnJlZ2lzdHJ5LmFkZENvbnRleHRUb29sYmFyKCd0b2MnLCB7XHJcbiAgICAgICAgaXRlbXM6ICd0b2N1cGRhdGUnLFxyXG4gICAgICAgIHByZWRpY2F0ZTogaXNUb2MoZWRpdG9yKSxcclxuICAgICAgICBzY29wZTogJ25vZGUnLFxyXG4gICAgICAgIHBvc2l0aW9uOiAnbm9kZSdcclxuICAgICAgfSk7XHJcbiAgICB9O1xyXG5cclxuICAgIGZ1bmN0aW9uIFBsdWdpbiAoKSB7XHJcbiAgICAgIGdsb2JhbCQzLmFkZCgndG9jJywgZnVuY3Rpb24gKGVkaXRvcikge1xyXG4gICAgICAgIHJlZ2lzdGVyJDEoZWRpdG9yKTtcclxuICAgICAgICByZWdpc3RlcihlZGl0b3IpO1xyXG4gICAgICAgIHNldHVwKGVkaXRvcik7XHJcbiAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIFBsdWdpbigpO1xyXG5cclxufSgpKTtcclxuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9hc3NldHMvY29yZS9wbHVnaW5zL2N1c3RvbS90aW55bWNlL3BsdWdpbnMvdG9jL3BsdWdpbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/toc/plugin.js\n");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/core/plugins/custom/tinymce/plugins/toc/index.js");
/******/ 	
/******/ })()
;