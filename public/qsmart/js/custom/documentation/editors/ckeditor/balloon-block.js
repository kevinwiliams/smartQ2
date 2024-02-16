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

/***/ "./resources/assets/core/js/custom/documentation/editors/ckeditor/balloon-block.js":
/*!*****************************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/ckeditor/balloon-block.js ***!
  \*****************************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVFormsCKEditorBalloonBlock = function () {\n  // Private functions\n  var exampleBalloonBlock = function exampleBalloonBlock() {\n    BalloonEditor.create(document.querySelector('#mv_docs_ckeditor_balloon_block')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleBalloonBlock();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVFormsCKEditorBalloonBlock.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZWRpdG9ycy9ja2VkaXRvci9iYWxsb29uLWJsb2NrLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEsMkJBQTJCLEdBQUcsWUFBWTtFQUMxQztFQUNBLElBQUlDLG1CQUFtQixHQUFHLFNBQXRCQSxtQkFBbUJBLENBQUEsRUFBZTtJQUNsQ0MsYUFBYSxDQUNSQyxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLGlDQUFpQyxDQUFDLENBQUMsQ0FDakVDLElBQUksQ0FBQyxVQUFBQyxNQUFNLEVBQUk7TUFDWkMsT0FBTyxDQUFDQyxHQUFHLENBQUNGLE1BQU0sQ0FBQztJQUN2QixDQUFDLENBQUMsU0FDSSxDQUFDLFVBQUFHLEtBQUssRUFBSTtNQUNaRixPQUFPLENBQUNFLEtBQUssQ0FBQ0EsS0FBSyxDQUFDO0lBQ3hCLENBQUMsQ0FBQztFQUNWLENBQUM7RUFFRCxPQUFPO0lBQ0g7SUFDQUMsSUFBSSxFQUFFLFNBQUFBLEtBQUEsRUFBWTtNQUNkVixtQkFBbUIsQ0FBQyxDQUFDO0lBQ3pCO0VBQ0osQ0FBQztBQUNMLENBQUMsQ0FBQyxDQUFDOztBQUVIO0FBQ0FXLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBWTtFQUNsQ2IsMkJBQTJCLENBQUNXLElBQUksQ0FBQyxDQUFDO0FBQ3RDLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvY29yZS9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9lZGl0b3JzL2NrZWRpdG9yL2JhbGxvb24tYmxvY2suanM/Mzk1OSJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIE1WRm9ybXNDS0VkaXRvckJhbGxvb25CbG9jayA9IGZ1bmN0aW9uICgpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZUJhbGxvb25CbG9jayA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICBCYWxsb29uRWRpdG9yXHJcbiAgICAgICAgICAgIC5jcmVhdGUoZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI212X2RvY3NfY2tlZGl0b3JfYmFsbG9vbl9ibG9jaycpKVxyXG4gICAgICAgICAgICAudGhlbihlZGl0b3IgPT4ge1xyXG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coZWRpdG9yKTtcclxuICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgLmNhdGNoKGVycm9yID0+IHtcclxuICAgICAgICAgICAgICAgIGNvbnNvbGUuZXJyb3IoZXJyb3IpO1xyXG4gICAgICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGV4YW1wbGVCYWxsb29uQmxvY2soKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5NVlV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuICAgIE1WRm9ybXNDS0VkaXRvckJhbGxvb25CbG9jay5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiTVZGb3Jtc0NLRWRpdG9yQmFsbG9vbkJsb2NrIiwiZXhhbXBsZUJhbGxvb25CbG9jayIsIkJhbGxvb25FZGl0b3IiLCJjcmVhdGUiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJ0aGVuIiwiZWRpdG9yIiwiY29uc29sZSIsImxvZyIsImVycm9yIiwiaW5pdCIsIk1WVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/editors/ckeditor/balloon-block.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/editors/ckeditor/balloon-block.js"]();
/******/ 	
/******/ })()
;