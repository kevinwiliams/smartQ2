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

/***/ "./resources/assets/core/js/custom/documentation/editors/quill/autosave.js":
/*!*********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/quill/autosave.js ***!
  \*********************************************************************************/
/***/ (() => {

eval(" // Class definition\n\nvar MVFormsQuillAutosave = function () {\n  // Private functions\n  var exampleAutosave = function exampleAutosave() {\n    var Delta = Quill[\"import\"]('delta');\n    var quill = new Quill('#mv_docs_quill_autosave', {\n      modules: {\n        toolbar: true\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow'\n    }); // Store accumulated changes\n\n    var change = new Delta();\n    quill.on('text-change', function (delta) {\n      change = change.compose(delta);\n    }); // Save periodically\n\n    setInterval(function () {\n      if (change.length() > 0) {\n        console.log('Saving changes', change);\n        /*\r\n        Send partial changes\r\n        $.post('/your-endpoint', {\r\n        partial: JSON.stringify(change)\r\n        });\r\n          Send entire document\r\n        $.post('/your-endpoint', {\r\n        doc: JSON.stringify(quill.getContents())\r\n        });\r\n        */\n\n        change = new Delta();\n      }\n    }, 5 * 1000); // Check for unsaved data\n\n    window.onbeforeunload = function () {\n      if (change.length() > 0) {\n        return 'There are unsaved changes. Are you sure you want to leave?';\n      }\n    };\n  };\n\n  return {\n    // Public Functions\n    init: function init() {\n      exampleAutosave();\n    }\n  };\n}(); // On document ready\n\n\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsQuillAutosave.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy9xdWlsbC9hdXRvc2F2ZS5qcy5qcyIsIm1hcHBpbmdzIjoiQ0FFQTs7QUFDQSxJQUFJQSxvQkFBb0IsR0FBRyxZQUFZO0FBQ25DO0FBQ0EsTUFBSUMsZUFBZSxHQUFHLFNBQWxCQSxlQUFrQixHQUFZO0FBQzlCLFFBQUlDLEtBQUssR0FBR0MsS0FBSyxVQUFMLENBQWEsT0FBYixDQUFaO0FBQ0EsUUFBSUMsS0FBSyxHQUFHLElBQUlELEtBQUosQ0FBVSx5QkFBVixFQUFxQztBQUM3Q0UsTUFBQUEsT0FBTyxFQUFFO0FBQ0xDLFFBQUFBLE9BQU8sRUFBRTtBQURKLE9BRG9DO0FBSTdDQyxNQUFBQSxXQUFXLEVBQUUsd0JBSmdDO0FBSzdDQyxNQUFBQSxLQUFLLEVBQUU7QUFMc0MsS0FBckMsQ0FBWixDQUY4QixDQVU5Qjs7QUFDQSxRQUFJQyxNQUFNLEdBQUcsSUFBSVAsS0FBSixFQUFiO0FBQ0FFLElBQUFBLEtBQUssQ0FBQ00sRUFBTixDQUFTLGFBQVQsRUFBd0IsVUFBVUMsS0FBVixFQUFpQjtBQUNyQ0YsTUFBQUEsTUFBTSxHQUFHQSxNQUFNLENBQUNHLE9BQVAsQ0FBZUQsS0FBZixDQUFUO0FBQ0gsS0FGRCxFQVo4QixDQWdCOUI7O0FBQ0FFLElBQUFBLFdBQVcsQ0FBQyxZQUFZO0FBQ3BCLFVBQUlKLE1BQU0sQ0FBQ0ssTUFBUCxLQUFrQixDQUF0QixFQUF5QjtBQUNyQkMsUUFBQUEsT0FBTyxDQUFDQyxHQUFSLENBQVksZ0JBQVosRUFBOEJQLE1BQTlCO0FBQ0E7QUFDaEI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVnQkEsUUFBQUEsTUFBTSxHQUFHLElBQUlQLEtBQUosRUFBVDtBQUNIO0FBQ0osS0FoQlUsRUFnQlIsSUFBSSxJQWhCSSxDQUFYLENBakI4QixDQW1DOUI7O0FBQ0FlLElBQUFBLE1BQU0sQ0FBQ0MsY0FBUCxHQUF3QixZQUFZO0FBQ2hDLFVBQUlULE1BQU0sQ0FBQ0ssTUFBUCxLQUFrQixDQUF0QixFQUF5QjtBQUNyQixlQUFPLDREQUFQO0FBQ0g7QUFDSixLQUpEO0FBS0gsR0F6Q0Q7O0FBMkNBLFNBQU87QUFDSDtBQUNBSyxJQUFBQSxJQUFJLEVBQUUsZ0JBQVk7QUFDZGxCLE1BQUFBLGVBQWU7QUFDbEI7QUFKRSxHQUFQO0FBTUgsQ0FuRDBCLEVBQTNCLEMsQ0FxREE7OztBQUNBbUIsTUFBTSxDQUFDQyxrQkFBUCxDQUEwQixZQUFZO0FBQ2xDckIsRUFBQUEsb0JBQW9CLENBQUNtQixJQUFyQjtBQUNILENBRkQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy9xdWlsbC9hdXRvc2F2ZS5qcz9jZTQ2Il0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgTVZGb3Jtc1F1aWxsQXV0b3NhdmUgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgdmFyIGV4YW1wbGVBdXRvc2F2ZSA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2YXIgRGVsdGEgPSBRdWlsbC5pbXBvcnQoJ2RlbHRhJyk7XHJcbiAgICAgICAgdmFyIHF1aWxsID0gbmV3IFF1aWxsKCcjbXZfZG9jc19xdWlsbF9hdXRvc2F2ZScsIHtcclxuICAgICAgICAgICAgbW9kdWxlczoge1xyXG4gICAgICAgICAgICAgICAgdG9vbGJhcjogdHJ1ZVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBwbGFjZWhvbGRlcjogJ1R5cGUgeW91ciB0ZXh0IGhlcmUuLi4nLFxyXG4gICAgICAgICAgICB0aGVtZTogJ3Nub3cnXHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIC8vIFN0b3JlIGFjY3VtdWxhdGVkIGNoYW5nZXNcclxuICAgICAgICB2YXIgY2hhbmdlID0gbmV3IERlbHRhKCk7XHJcbiAgICAgICAgcXVpbGwub24oJ3RleHQtY2hhbmdlJywgZnVuY3Rpb24gKGRlbHRhKSB7XHJcbiAgICAgICAgICAgIGNoYW5nZSA9IGNoYW5nZS5jb21wb3NlKGRlbHRhKTtcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gU2F2ZSBwZXJpb2RpY2FsbHlcclxuICAgICAgICBzZXRJbnRlcnZhbChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGlmIChjaGFuZ2UubGVuZ3RoKCkgPiAwKSB7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygnU2F2aW5nIGNoYW5nZXMnLCBjaGFuZ2UpO1xyXG4gICAgICAgICAgICAgICAgLypcclxuICAgICAgICAgICAgICAgIFNlbmQgcGFydGlhbCBjaGFuZ2VzXHJcbiAgICAgICAgICAgICAgICAkLnBvc3QoJy95b3VyLWVuZHBvaW50Jywge1xyXG4gICAgICAgICAgICAgICAgcGFydGlhbDogSlNPTi5zdHJpbmdpZnkoY2hhbmdlKVxyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgU2VuZCBlbnRpcmUgZG9jdW1lbnRcclxuICAgICAgICAgICAgICAgICQucG9zdCgnL3lvdXItZW5kcG9pbnQnLCB7XHJcbiAgICAgICAgICAgICAgICBkb2M6IEpTT04uc3RyaW5naWZ5KHF1aWxsLmdldENvbnRlbnRzKCkpXHJcbiAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgICovXHJcbiAgICAgICAgICAgICAgICBjaGFuZ2UgPSBuZXcgRGVsdGEoKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0sIDUgKiAxMDAwKTtcclxuXHJcbiAgICAgICAgLy8gQ2hlY2sgZm9yIHVuc2F2ZWQgZGF0YVxyXG4gICAgICAgIHdpbmRvdy5vbmJlZm9yZXVubG9hZCA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgaWYgKGNoYW5nZS5sZW5ndGgoKSA+IDApIHtcclxuICAgICAgICAgICAgICAgIHJldHVybiAnVGhlcmUgYXJlIHVuc2F2ZWQgY2hhbmdlcy4gQXJlIHlvdSBzdXJlIHlvdSB3YW50IHRvIGxlYXZlPyc7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBQdWJsaWMgRnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICBleGFtcGxlQXV0b3NhdmUoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5NVlV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuICAgIE1WRm9ybXNRdWlsbEF1dG9zYXZlLmluaXQoKTtcclxufSk7XHJcbiJdLCJuYW1lcyI6WyJNVkZvcm1zUXVpbGxBdXRvc2F2ZSIsImV4YW1wbGVBdXRvc2F2ZSIsIkRlbHRhIiwiUXVpbGwiLCJxdWlsbCIsIm1vZHVsZXMiLCJ0b29sYmFyIiwicGxhY2Vob2xkZXIiLCJ0aGVtZSIsImNoYW5nZSIsIm9uIiwiZGVsdGEiLCJjb21wb3NlIiwic2V0SW50ZXJ2YWwiLCJsZW5ndGgiLCJjb25zb2xlIiwibG9nIiwid2luZG93Iiwib25iZWZvcmV1bmxvYWQiLCJpbml0IiwiTVZVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/editors/quill/autosave.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/editors/quill/autosave.js"]();
/******/ 	
/******/ })()
;