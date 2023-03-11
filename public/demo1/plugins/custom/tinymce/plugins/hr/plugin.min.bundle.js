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

/***/ "./resources/assets/core/plugins/custom/tinymce/plugins/hr/plugin.min.js":
/*!*******************************************************************************!*\
  !*** ./resources/assets/core/plugins/custom/tinymce/plugins/hr/plugin.min.js ***!
  \*******************************************************************************/
/***/ (() => {

eval("/**\r\n * Copyright (c) Tiny Technologies, Inc. All rights reserved.\r\n * Licensed under the LGPL or a commercial license.\r\n * For LGPL see License.txt in the project root for license information.\r\n * For commercial licenses see https://www.tiny.cloud/\r\n *\r\n * Version: 5.10.3 (2022-02-09)\r\n */\n!function () {\n  \"use strict\";\n\n  tinymce.util.Tools.resolve(\"tinymce.PluginManager\").add(\"hr\", function (n) {\n    var o, t;\n\n    function e() {\n      return t.execCommand(\"InsertHorizontalRule\");\n    }\n\n    (o = n).addCommand(\"InsertHorizontalRule\", function () {\n      o.execCommand(\"mceInsertContent\", !1, \"<hr />\");\n    }), (t = n).ui.registry.addButton(\"hr\", {\n      icon: \"horizontal-rule\",\n      tooltip: \"Horizontal line\",\n      onAction: e\n    }), t.ui.registry.addMenuItem(\"hr\", {\n      icon: \"horizontal-rule\",\n      text: \"Horizontal line\",\n      onAction: e\n    });\n  });\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvcGx1Z2lucy9jdXN0b20vdGlueW1jZS9wbHVnaW5zL2hyL3BsdWdpbi5taW4uanM/ODU5MCJdLCJuYW1lcyI6WyJ0aW55bWNlIiwidXRpbCIsIlRvb2xzIiwicmVzb2x2ZSIsImFkZCIsIm4iLCJvIiwidCIsImUiLCJleGVjQ29tbWFuZCIsImFkZENvbW1hbmQiLCJ1aSIsInJlZ2lzdHJ5IiwiYWRkQnV0dG9uIiwiaWNvbiIsInRvb2x0aXAiLCJvbkFjdGlvbiIsImFkZE1lbnVJdGVtIiwidGV4dCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLENBQUMsWUFBVTtBQUFDOztBQUFhQSxFQUFBQSxPQUFPLENBQUNDLElBQVIsQ0FBYUMsS0FBYixDQUFtQkMsT0FBbkIsQ0FBMkIsdUJBQTNCLEVBQW9EQyxHQUFwRCxDQUF3RCxJQUF4RCxFQUE2RCxVQUFTQyxDQUFULEVBQVc7QUFBQyxRQUFJQyxDQUFKLEVBQU1DLENBQU47O0FBQVEsYUFBU0MsQ0FBVCxHQUFZO0FBQUMsYUFBT0QsQ0FBQyxDQUFDRSxXQUFGLENBQWMsc0JBQWQsQ0FBUDtBQUE2Qzs7QUFBQSxLQUFDSCxDQUFDLEdBQUNELENBQUgsRUFBTUssVUFBTixDQUFpQixzQkFBakIsRUFBd0MsWUFBVTtBQUFDSixNQUFBQSxDQUFDLENBQUNHLFdBQUYsQ0FBYyxrQkFBZCxFQUFpQyxDQUFDLENBQWxDLEVBQW9DLFFBQXBDO0FBQThDLEtBQWpHLEdBQW1HLENBQUNGLENBQUMsR0FBQ0YsQ0FBSCxFQUFNTSxFQUFOLENBQVNDLFFBQVQsQ0FBa0JDLFNBQWxCLENBQTRCLElBQTVCLEVBQWlDO0FBQUNDLE1BQUFBLElBQUksRUFBQyxpQkFBTjtBQUF3QkMsTUFBQUEsT0FBTyxFQUFDLGlCQUFoQztBQUFrREMsTUFBQUEsUUFBUSxFQUFDUjtBQUEzRCxLQUFqQyxDQUFuRyxFQUFtTUQsQ0FBQyxDQUFDSSxFQUFGLENBQUtDLFFBQUwsQ0FBY0ssV0FBZCxDQUEwQixJQUExQixFQUErQjtBQUFDSCxNQUFBQSxJQUFJLEVBQUMsaUJBQU47QUFBd0JJLE1BQUFBLElBQUksRUFBQyxpQkFBN0I7QUFBK0NGLE1BQUFBLFFBQVEsRUFBQ1I7QUFBeEQsS0FBL0IsQ0FBbk07QUFBOFIsR0FBemE7QUFBMmEsQ0FBbmMsRUFBRCIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBDb3B5cmlnaHQgKGMpIFRpbnkgVGVjaG5vbG9naWVzLCBJbmMuIEFsbCByaWdodHMgcmVzZXJ2ZWQuXHJcbiAqIExpY2Vuc2VkIHVuZGVyIHRoZSBMR1BMIG9yIGEgY29tbWVyY2lhbCBsaWNlbnNlLlxyXG4gKiBGb3IgTEdQTCBzZWUgTGljZW5zZS50eHQgaW4gdGhlIHByb2plY3Qgcm9vdCBmb3IgbGljZW5zZSBpbmZvcm1hdGlvbi5cclxuICogRm9yIGNvbW1lcmNpYWwgbGljZW5zZXMgc2VlIGh0dHBzOi8vd3d3LnRpbnkuY2xvdWQvXHJcbiAqXHJcbiAqIFZlcnNpb246IDUuMTAuMyAoMjAyMi0wMi0wOSlcclxuICovXHJcbiFmdW5jdGlvbigpe1widXNlIHN0cmljdFwiO3RpbnltY2UudXRpbC5Ub29scy5yZXNvbHZlKFwidGlueW1jZS5QbHVnaW5NYW5hZ2VyXCIpLmFkZChcImhyXCIsZnVuY3Rpb24obil7dmFyIG8sdDtmdW5jdGlvbiBlKCl7cmV0dXJuIHQuZXhlY0NvbW1hbmQoXCJJbnNlcnRIb3Jpem9udGFsUnVsZVwiKX0obz1uKS5hZGRDb21tYW5kKFwiSW5zZXJ0SG9yaXpvbnRhbFJ1bGVcIixmdW5jdGlvbigpe28uZXhlY0NvbW1hbmQoXCJtY2VJbnNlcnRDb250ZW50XCIsITEsXCI8aHIgLz5cIil9KSwodD1uKS51aS5yZWdpc3RyeS5hZGRCdXR0b24oXCJoclwiLHtpY29uOlwiaG9yaXpvbnRhbC1ydWxlXCIsdG9vbHRpcDpcIkhvcml6b250YWwgbGluZVwiLG9uQWN0aW9uOmV9KSx0LnVpLnJlZ2lzdHJ5LmFkZE1lbnVJdGVtKFwiaHJcIix7aWNvbjpcImhvcml6b250YWwtcnVsZVwiLHRleHQ6XCJIb3Jpem9udGFsIGxpbmVcIixvbkFjdGlvbjplfSl9KX0oKTsiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL3BsdWdpbnMvY3VzdG9tL3RpbnltY2UvcGx1Z2lucy9oci9wbHVnaW4ubWluLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/plugins/custom/tinymce/plugins/hr/plugin.min.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/plugins/custom/tinymce/plugins/hr/plugin.min.js"]();
/******/ 	
/******/ })()
;