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

/***/ "./resources/assets/core/js/custom/documentation/general/jkanban/color.js":
/*!********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/general/jkanban/color.js ***!
  \********************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVJKanbanDemoColor = function () {\n  // Private functions\n  var exampleColor = function exampleColor() {\n    var kanban = new jKanban({\n      element: '#mv_docs_jkanban_color',\n      gutter: '0',\n      widthBoard: '250px',\n      boards: [{\n        'id': '_inprocess',\n        'title': 'In Process',\n        'class': 'primary',\n        'item': [{\n          'title': '<span class=\"fw-bold\">You can drag me too</span>',\n          'class': 'light-primary'\n        }, {\n          'title': '<span class=\"fw-bold\">Buy Milk</span>',\n          'class': 'light-primary'\n        }]\n      }, {\n        'id': '_working',\n        'title': 'Working',\n        'class': 'success',\n        'item': [{\n          'title': '<span class=\"fw-bold\">Do Something!</span>',\n          'class': 'light-success'\n        }, {\n          'title': '<span class=\"fw-bold\">Run?</span>',\n          'class': 'light-success'\n        }]\n      }, {\n        'id': '_done',\n        'title': 'Done',\n        'class': 'danger',\n        'item': [{\n          'title': '<span class=\"fw-bold\">All right</span>',\n          'class': 'light-danger'\n        }, {\n          'title': '<span class=\"fw-bold\">Ok!</span>',\n          'class': 'light-danger'\n        }]\n      }]\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleColor();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVJKanbanDemoColor.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZ2VuZXJhbC9qa2FuYmFuL2NvbG9yLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEsa0JBQWtCLEdBQUcsWUFBVztFQUNoQztFQUNBLElBQUlDLFlBQVksR0FBRyxTQUFmQSxZQUFZQSxDQUFBLEVBQWM7SUFDMUIsSUFBSUMsTUFBTSxHQUFHLElBQUlDLE9BQU8sQ0FBQztNQUNyQkMsT0FBTyxFQUFFLHdCQUF3QjtNQUNqQ0MsTUFBTSxFQUFFLEdBQUc7TUFDWEMsVUFBVSxFQUFFLE9BQU87TUFDbkJDLE1BQU0sRUFBRSxDQUFDO1FBQ0QsSUFBSSxFQUFFLFlBQVk7UUFDbEIsT0FBTyxFQUFFLFlBQVk7UUFDckIsT0FBTyxFQUFFLFNBQVM7UUFDbEIsTUFBTSxFQUFFLENBQUM7VUFDRCxPQUFPLEVBQUUsa0RBQWtEO1VBQzNELE9BQU8sRUFBRTtRQUNiLENBQUMsRUFDRDtVQUNJLE9BQU8sRUFBRSx1Q0FBdUM7VUFDaEQsT0FBTyxFQUFFO1FBQ2IsQ0FBQztNQUVULENBQUMsRUFBRTtRQUNDLElBQUksRUFBRSxVQUFVO1FBQ2hCLE9BQU8sRUFBRSxTQUFTO1FBQ2xCLE9BQU8sRUFBRSxTQUFTO1FBQ2xCLE1BQU0sRUFBRSxDQUFDO1VBQ0QsT0FBTyxFQUFFLDRDQUE0QztVQUNyRCxPQUFPLEVBQUU7UUFDYixDQUFDLEVBQ0Q7VUFDSSxPQUFPLEVBQUUsbUNBQW1DO1VBQzVDLE9BQU8sRUFBRTtRQUNiLENBQUM7TUFFVCxDQUFDLEVBQUU7UUFDQyxJQUFJLEVBQUUsT0FBTztRQUNiLE9BQU8sRUFBRSxNQUFNO1FBQ2YsT0FBTyxFQUFFLFFBQVE7UUFDakIsTUFBTSxFQUFFLENBQUM7VUFDRCxPQUFPLEVBQUUsd0NBQXdDO1VBQ2pELE9BQU8sRUFBRTtRQUNiLENBQUMsRUFDRDtVQUNJLE9BQU8sRUFBRSxrQ0FBa0M7VUFDM0MsT0FBTyxFQUFFO1FBQ2IsQ0FBQztNQUVULENBQUM7SUFFVCxDQUFDLENBQUM7RUFDTixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FDLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVc7TUFDYlAsWUFBWSxDQUFDLENBQUM7SUFDbEI7RUFDSixDQUFDO0FBQ0wsQ0FBQyxDQUFDLENBQUM7O0FBRUg7QUFDQVEsTUFBTSxDQUFDQyxrQkFBa0IsQ0FBQyxZQUFXO0VBQ2pDVixrQkFBa0IsQ0FBQ1EsSUFBSSxDQUFDLENBQUM7QUFDN0IsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2dlbmVyYWwvamthbmJhbi9jb2xvci5qcz8yYTI5Il0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgTVZKS2FuYmFuRGVtb0NvbG9yID0gZnVuY3Rpb24oKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgdmFyIGV4YW1wbGVDb2xvciA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIHZhciBrYW5iYW4gPSBuZXcgakthbmJhbih7XHJcbiAgICAgICAgICAgIGVsZW1lbnQ6ICcjbXZfZG9jc19qa2FuYmFuX2NvbG9yJyxcclxuICAgICAgICAgICAgZ3V0dGVyOiAnMCcsXHJcbiAgICAgICAgICAgIHdpZHRoQm9hcmQ6ICcyNTBweCcsXHJcbiAgICAgICAgICAgIGJvYXJkczogW3tcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX2lucHJvY2VzcycsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogJ0luIFByb2Nlc3MnLFxyXG4gICAgICAgICAgICAgICAgICAgICdjbGFzcyc6ICdwcmltYXJ5JyxcclxuICAgICAgICAgICAgICAgICAgICAnaXRlbSc6IFt7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAndGl0bGUnOiAnPHNwYW4gY2xhc3M9XCJmdy1ib2xkXCI+WW91IGNhbiBkcmFnIG1lIHRvbzwvc3Bhbj4nLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ2NsYXNzJzogJ2xpZ2h0LXByaW1hcnknLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAndGl0bGUnOiAnPHNwYW4gY2xhc3M9XCJmdy1ib2xkXCI+QnV5IE1pbGs8L3NwYW4+JyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICdjbGFzcyc6ICdsaWdodC1wcmltYXJ5JyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIF1cclxuICAgICAgICAgICAgICAgIH0sIHtcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX3dvcmtpbmcnLFxyXG4gICAgICAgICAgICAgICAgICAgICd0aXRsZSc6ICdXb3JraW5nJyxcclxuICAgICAgICAgICAgICAgICAgICAnY2xhc3MnOiAnc3VjY2VzcycsXHJcbiAgICAgICAgICAgICAgICAgICAgJ2l0ZW0nOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogJzxzcGFuIGNsYXNzPVwiZnctYm9sZFwiPkRvIFNvbWV0aGluZyE8L3NwYW4+JyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICdjbGFzcyc6ICdsaWdodC1zdWNjZXNzJyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogJzxzcGFuIGNsYXNzPVwiZnctYm9sZFwiPlJ1bj88L3NwYW4+JyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICdjbGFzcyc6ICdsaWdodC1zdWNjZXNzJyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIF1cclxuICAgICAgICAgICAgICAgIH0sIHtcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX2RvbmUnLFxyXG4gICAgICAgICAgICAgICAgICAgICd0aXRsZSc6ICdEb25lJyxcclxuICAgICAgICAgICAgICAgICAgICAnY2xhc3MnOiAnZGFuZ2VyJyxcclxuICAgICAgICAgICAgICAgICAgICAnaXRlbSc6IFt7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAndGl0bGUnOiAnPHNwYW4gY2xhc3M9XCJmdy1ib2xkXCI+QWxsIHJpZ2h0PC9zcGFuPicsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAnY2xhc3MnOiAnbGlnaHQtZGFuZ2VyJyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogJzxzcGFuIGNsYXNzPVwiZnctYm9sZFwiPk9rITwvc3Bhbj4nLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ2NsYXNzJzogJ2xpZ2h0LWRhbmdlcicsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICBdXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIF1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZXhhbXBsZUNvbG9yKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuTVZVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIE1WSkthbmJhbkRlbW9Db2xvci5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiTVZKS2FuYmFuRGVtb0NvbG9yIiwiZXhhbXBsZUNvbG9yIiwia2FuYmFuIiwiakthbmJhbiIsImVsZW1lbnQiLCJndXR0ZXIiLCJ3aWR0aEJvYXJkIiwiYm9hcmRzIiwiaW5pdCIsIk1WVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/general/jkanban/color.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/general/jkanban/color.js"]();
/******/ 	
/******/ })()
;