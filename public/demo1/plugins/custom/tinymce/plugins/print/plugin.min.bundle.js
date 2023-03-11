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

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.min.js":
/*!**********************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.min.js ***!
  \**********************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n!function () {\n  \"use strict\";\n\n  var n = tinymce.util.Tools.resolve(\"tinymce.PluginManager\"),\n      r = tinymce.util.Tools.resolve(\"tinymce.Env\");\n  n.add(\"print\", function (n) {\n    var t, i;\n\n    function e() {\n      return i.execCommand(\"mcePrint\");\n    }\n\n    (t = n).addCommand(\"mcePrint\", function () {\n      r.browser.isIE() ? t.getDoc().execCommand(\"print\", !1, null) : t.getWin().print();\n    }), (i = n).ui.registry.addButton(\"print\", {\n      icon: \"print\",\n      tooltip: \"Print\",\n      onAction: e\n    }), i.ui.registry.addMenuItem(\"print\", {\n      text: \"Print...\",\n      icon: \"print\",\n      onAction: e\n    }), n.addShortcut(\"Meta+P\", \"\", \"mcePrint\");\n  });\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3ByaW50L3BsdWdpbi5taW4uanM/ZjA4ZSJdLCJuYW1lcyI6WyJuIiwidGlueW1jZSIsInV0aWwiLCJUb29scyIsInJlc29sdmUiLCJyIiwiYWRkIiwidCIsImkiLCJlIiwiZXhlY0NvbW1hbmQiLCJhZGRDb21tYW5kIiwiYnJvd3NlciIsImlzSUUiLCJnZXREb2MiLCJnZXRXaW4iLCJwcmludCIsInVpIiwicmVnaXN0cnkiLCJhZGRCdXR0b24iLCJpY29uIiwidG9vbHRpcCIsIm9uQWN0aW9uIiwiYWRkTWVudUl0ZW0iLCJ0ZXh0IiwiYWRkU2hvcnRjdXQiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxDQUFDLFlBQVU7QUFBQzs7QUFBYSxNQUFJQSxDQUFDLEdBQUNDLE9BQU8sQ0FBQ0MsSUFBUixDQUFhQyxLQUFiLENBQW1CQyxPQUFuQixDQUEyQix1QkFBM0IsQ0FBTjtBQUFBLE1BQTBEQyxDQUFDLEdBQUNKLE9BQU8sQ0FBQ0MsSUFBUixDQUFhQyxLQUFiLENBQW1CQyxPQUFuQixDQUEyQixhQUEzQixDQUE1RDtBQUFzR0osRUFBQUEsQ0FBQyxDQUFDTSxHQUFGLENBQU0sT0FBTixFQUFjLFVBQVNOLENBQVQsRUFBVztBQUFDLFFBQUlPLENBQUosRUFBTUMsQ0FBTjs7QUFBUSxhQUFTQyxDQUFULEdBQVk7QUFBQyxhQUFPRCxDQUFDLENBQUNFLFdBQUYsQ0FBYyxVQUFkLENBQVA7QUFBaUM7O0FBQUEsS0FBQ0gsQ0FBQyxHQUFDUCxDQUFILEVBQU1XLFVBQU4sQ0FBaUIsVUFBakIsRUFBNEIsWUFBVTtBQUFDTixNQUFBQSxDQUFDLENBQUNPLE9BQUYsQ0FBVUMsSUFBVixLQUFpQk4sQ0FBQyxDQUFDTyxNQUFGLEdBQVdKLFdBQVgsQ0FBdUIsT0FBdkIsRUFBK0IsQ0FBQyxDQUFoQyxFQUFrQyxJQUFsQyxDQUFqQixHQUF5REgsQ0FBQyxDQUFDUSxNQUFGLEdBQVdDLEtBQVgsRUFBekQ7QUFBNEUsS0FBbkgsR0FBcUgsQ0FBQ1IsQ0FBQyxHQUFDUixDQUFILEVBQU1pQixFQUFOLENBQVNDLFFBQVQsQ0FBa0JDLFNBQWxCLENBQTRCLE9BQTVCLEVBQW9DO0FBQUNDLE1BQUFBLElBQUksRUFBQyxPQUFOO0FBQWNDLE1BQUFBLE9BQU8sRUFBQyxPQUF0QjtBQUE4QkMsTUFBQUEsUUFBUSxFQUFDYjtBQUF2QyxLQUFwQyxDQUFySCxFQUFvTUQsQ0FBQyxDQUFDUyxFQUFGLENBQUtDLFFBQUwsQ0FBY0ssV0FBZCxDQUEwQixPQUExQixFQUFrQztBQUFDQyxNQUFBQSxJQUFJLEVBQUMsVUFBTjtBQUFpQkosTUFBQUEsSUFBSSxFQUFDLE9BQXRCO0FBQThCRSxNQUFBQSxRQUFRLEVBQUNiO0FBQXZDLEtBQWxDLENBQXBNLEVBQWlSVCxDQUFDLENBQUN5QixXQUFGLENBQWMsUUFBZCxFQUF1QixFQUF2QixFQUEwQixVQUExQixDQUFqUjtBQUF1VCxHQUF2WTtBQUF5WSxDQUF2Z0IsRUFBRCIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBDb3B5cmlnaHQgKGMpIFRpbnkgVGVjaG5vbG9naWVzLCBJbmMuIEFsbCByaWdodHMgcmVzZXJ2ZWQuXHJcbiAqIExpY2Vuc2VkIHVuZGVyIHRoZSBMR1BMIG9yIGEgY29tbWVyY2lhbCBsaWNlbnNlLlxyXG4gKiBGb3IgTEdQTCBzZWUgTGljZW5zZS50eHQgaW4gdGhlIHByb2plY3Qgcm9vdCBmb3IgbGljZW5zZSBpbmZvcm1hdGlvbi5cclxuICogRm9yIGNvbW1lcmNpYWwgbGljZW5zZXMgc2VlIGh0dHBzOi8vd3d3LnRpbnkuY2xvdWQvXHJcbiAqXHJcbiAqIFZlcnNpb246IDUuMTAuMyAoMjAyMi0wMi0wOSlcclxuICovXHJcbiFmdW5jdGlvbigpe1widXNlIHN0cmljdFwiO3ZhciBuPXRpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKFwidGlueW1jZS5QbHVnaW5NYW5hZ2VyXCIpLHI9dGlueW1jZS51dGlsLlRvb2xzLnJlc29sdmUoXCJ0aW55bWNlLkVudlwiKTtuLmFkZChcInByaW50XCIsZnVuY3Rpb24obil7dmFyIHQsaTtmdW5jdGlvbiBlKCl7cmV0dXJuIGkuZXhlY0NvbW1hbmQoXCJtY2VQcmludFwiKX0odD1uKS5hZGRDb21tYW5kKFwibWNlUHJpbnRcIixmdW5jdGlvbigpe3IuYnJvd3Nlci5pc0lFKCk/dC5nZXREb2MoKS5leGVjQ29tbWFuZChcInByaW50XCIsITEsbnVsbCk6dC5nZXRXaW4oKS5wcmludCgpfSksKGk9bikudWkucmVnaXN0cnkuYWRkQnV0dG9uKFwicHJpbnRcIix7aWNvbjpcInByaW50XCIsdG9vbHRpcDpcIlByaW50XCIsb25BY3Rpb246ZX0pLGkudWkucmVnaXN0cnkuYWRkTWVudUl0ZW0oXCJwcmludFwiLHt0ZXh0OlwiUHJpbnQuLi5cIixpY29uOlwicHJpbnRcIixvbkFjdGlvbjplfSksbi5hZGRTaG9ydGN1dChcIk1ldGErUFwiLFwiXCIsXCJtY2VQcmludFwiKX0pfSgpOyJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL3ByaW50L3BsdWdpbi5taW4uanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.min.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/plugins/custom/tinymce/plugins/print/plugin.min.js"]();
/******/ 	
/******/ })()
;