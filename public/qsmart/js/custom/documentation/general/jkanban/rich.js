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

/***/ "./resources/assets/core/js/custom/documentation/general/jkanban/rich.js":
/*!*******************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/general/jkanban/rich.js ***!
  \*******************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar MVJKanbanDemoRich = function () {\n  // Private functions\n  var exampleRich = function exampleRich() {\n    var kanban = new jKanban({\n      element: '#mv_docs_jkanban_rich',\n      gutter: '0',\n      click: function click(el) {\n        alert(el.innerHTML);\n      },\n      boards: [{\n        'id': '_backlog',\n        'title': 'Backlog',\n        'class': 'light-dark',\n        'item': [{\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-success me-3\\\">\\n                        \\t            <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-6.jpg\\\" />\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">SEO Optimization</span>\\n                        \\t            <span class=\\\"badge badge-light-success\\\">In progress</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \")\n        }, {\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-success me-3\\\">\\n                        \\t            <span class=\\\"symbol-label fs-4\\\">A.D</span>\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">Finance</span>\\n                        \\t            <span class=\\\"badge badge-light-danger\\\">Pending</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \"\n        }]\n      }, {\n        'id': '_todo',\n        'title': 'To Do',\n        'class': 'light-danger',\n        'item': [{\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-success me-3\\\">\\n                        \\t            <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-1.jpg\\\" />\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">Server Setup</span>\\n                        \\t            <span class=\\\"badge badge-light-info\\\">Completed</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \")\n        }, {\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-success me-3\\\">\\n                        \\t            <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-2.jpg\\\" />\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">Report Generation</span>\\n                        \\t            <span class=\\\"badge badge-light-warning\\\">Due</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \")\n        }]\n      }, {\n        'id': '_working',\n        'title': 'Working',\n        'class': 'light-primary',\n        'item': [{\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-success me-3\\\">\\n                            \\t         <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-6.jpg\\\" />\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">Marketing</span>\\n                        \\t            <span class=\\\"badge badge-light-danger\\\">Planning</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \")\n        }, {\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-light-info me-3\\\">\\n                        \\t            <span class=\\\"symbol-label fs-4\\\">A.P</span>\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">Finance</span>\\n                        \\t            <span class=\\\"badge badge-light-primary\\\">Done</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \"\n        }]\n      }, {\n        'id': '_done',\n        'title': 'Done',\n        'class': 'light-success',\n        'item': [{\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-success me-3\\\">\\n                        \\t            <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-5.jpg\\\" />\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">SEO Optimization</span>\\n                        \\t            <span class=\\\"badge badge-light-success\\\">In progress</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \")\n        }, {\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-success me-3\\\">\\n                        \\t            <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-20.jpg\\\" />\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">Product Team</span>\\n                        \\t            <span class=\\\"badge badge-light-danger\\\">In progress</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \")\n        }]\n      }, {\n        'id': '_deploy',\n        'title': 'Deploy',\n        'class': 'light-primary',\n        'item': [{\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-light-warning me-3\\\">\\n                        \\t            <span class=\\\"symbol-label fs-4\\\">D.L</span>\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">SEO Optimization</span>\\n                        \\t            <span class=\\\"badge badge-light-success\\\">In progress</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \"\n        }, {\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                        \\t        <div class=\\\"symbol symbol-light-danger me-3\\\">\\n                        \\t            <span class=\\\"symbol-label fs-4\\\">E.K</span>\\n                        \\t        </div>\\n                        \\t        <div class=\\\"d-flex flex-column align-items-start\\\">\\n                        \\t            <span class=\\\"text-dark-50 fw-bold mb-1\\\">Requirement Study</span>\\n                        \\t            <span class=\\\"badge badge-light-warning\\\">Scheduled</span>\\n                        \\t        </div>\\n                        \\t    </div>\\n                            \"\n        }]\n      }]\n    });\n    var toDoButton = document.getElementById('addToDo');\n    toDoButton.addEventListener('click', function () {\n      kanban.addElement('_todo', {\n        'title': \"\\n                        <div class=\\\"d-flex align-items-center\\\">\\n                            <div class=\\\"symbol symbol-light-primary me-3\\\">\\n                                <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-23.jpg\\\" />\\n                            </div>\\n                            <div class=\\\"d-flex flex-column align-items-start\\\">\\n                                <span class=\\\"text-dark-50 fw-bold mb-1\\\">Requirement Study</span>\\n                                <span class=\\\"badge badge-light-success\\\">Scheduled</span>\\n                            </div>\\n                        </div>\\n                    \")\n      });\n    });\n    var addBoardDefault = document.getElementById('addDefault');\n    addBoardDefault.addEventListener('click', function () {\n      kanban.addBoards([{\n        'id': '_default',\n        'title': 'New Board',\n        'class': 'light-primary',\n        'item': [{\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                                    <div class=\\\"symbol symbol-success me-3\\\">\\n                                        <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-12.jpg\\\" />\\n                                    </div>\\n                                    <div class=\\\"d-flex flex-column align-items-start\\\">\\n                                        <span class=\\\"text-dark-50 fw-bold mb-1\\\">Payment Modules</span>\\n                                        <span class=\\\"badge badge-light-primary\\\">In development</span>\\n                                    </div>\\n                                </div>\\n                        \")\n        }, {\n          'title': \"\\n                                <div class=\\\"d-flex align-items-center\\\">\\n                                    <div class=\\\"symbol symbol-success me-3\\\">\\n                                        <img alt=\\\"Pic\\\" src=\\\"\".concat(hostUrl, \"media/avatars/300-9.jpg\\\" />\\n                                    </div>\\n                                    <div class=\\\"d-flex flex-column align-items-start\\\">\\n                                    <span class=\\\"text-dark-50 fw-bold mb-1\\\">New Project</span>\\n                                    <span class=\\\"badge badge-light-danger\\\">Pending</span>\\n                                </div>\\n                            </div>\\n                        \")\n        }]\n      }]);\n    });\n    var removeBoard = document.getElementById('removeBoard');\n    removeBoard.addEventListener('click', function () {\n      kanban.removeBoard('_done');\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleRich();\n    }\n  };\n}();\n\n// On document ready\nMVUtil.onDOMContentLoaded(function () {\n  MVJKanbanDemoRich.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZ2VuZXJhbC9qa2FuYmFuL3JpY2guanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSxpQkFBaUIsR0FBRyxZQUFXO0VBQy9CO0VBQ0EsSUFBSUMsV0FBVyxHQUFHLFNBQWRBLFdBQVdBLENBQUEsRUFBYztJQUN6QixJQUFJQyxNQUFNLEdBQUcsSUFBSUMsT0FBTyxDQUFDO01BQ3JCQyxPQUFPLEVBQUUsdUJBQXVCO01BQ2hDQyxNQUFNLEVBQUUsR0FBRztNQUNYQyxLQUFLLEVBQUUsU0FBQUEsTUFBU0MsRUFBRSxFQUFFO1FBQ2hCQyxLQUFLLENBQUNELEVBQUUsQ0FBQ0UsU0FBUyxDQUFDO01BQ3ZCLENBQUM7TUFDREMsTUFBTSxFQUFFLENBQUM7UUFDRCxJQUFJLEVBQUUsVUFBVTtRQUNoQixPQUFPLEVBQUUsU0FBUztRQUNsQixPQUFPLEVBQUUsWUFBWTtRQUNyQixNQUFNLEVBQUUsQ0FBQztVQUNELE9BQU8sNk5BQUFDLE1BQUEsQ0FHd0JDLE9BQU87UUFRMUMsQ0FBQyxFQUNEO1VBQ0ksT0FBTztRQVdYLENBQUM7TUFFVCxDQUFDLEVBQ0Q7UUFDSSxJQUFJLEVBQUUsT0FBTztRQUNiLE9BQU8sRUFBRSxPQUFPO1FBQ2hCLE9BQU8sRUFBRSxjQUFjO1FBQ3ZCLE1BQU0sRUFBRSxDQUFDO1VBQ0QsT0FBTyw2TkFBQUQsTUFBQSxDQUd3QkMsT0FBTztRQVExQyxDQUFDLEVBQ0Q7VUFDSSxPQUFPLDZOQUFBRCxNQUFBLENBR3dCQyxPQUFPO1FBUTFDLENBQUM7TUFFVCxDQUFDLEVBQ0Q7UUFDSSxJQUFJLEVBQUUsVUFBVTtRQUNoQixPQUFPLEVBQUUsU0FBUztRQUNsQixPQUFPLEVBQUUsZUFBZTtRQUN4QixNQUFNLEVBQUUsQ0FBQztVQUNELE9BQU8sOE5BQUFELE1BQUEsQ0FHeUJDLE9BQU87UUFRM0MsQ0FBQyxFQUNEO1VBQ0ksT0FBTztRQVdYLENBQUM7TUFFVCxDQUFDLEVBQ0Q7UUFDSSxJQUFJLEVBQUUsT0FBTztRQUNiLE9BQU8sRUFBRSxNQUFNO1FBQ2YsT0FBTyxFQUFFLGVBQWU7UUFDeEIsTUFBTSxFQUFFLENBQUM7VUFDRCxPQUFPLDZOQUFBRCxNQUFBLENBR3dCQyxPQUFPO1FBUTFDLENBQUMsRUFDRDtVQUNJLE9BQU8sNk5BQUFELE1BQUEsQ0FHd0JDLE9BQU87UUFRMUMsQ0FBQztNQUVULENBQUMsRUFDRDtRQUNJLElBQUksRUFBRSxTQUFTO1FBQ2YsT0FBTyxFQUFFLFFBQVE7UUFDakIsT0FBTyxFQUFFLGVBQWU7UUFDeEIsTUFBTSxFQUFFLENBQUM7VUFDRCxPQUFPO1FBV1gsQ0FBQyxFQUNEO1VBQ0ksT0FBTztRQVdYLENBQUM7TUFFVCxDQUFDO0lBRVQsQ0FBQyxDQUFDO0lBRUYsSUFBSUMsVUFBVSxHQUFHQyxRQUFRLENBQUNDLGNBQWMsQ0FBQyxTQUFTLENBQUM7SUFDbkRGLFVBQVUsQ0FBQ0csZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQVc7TUFDNUNkLE1BQU0sQ0FBQ2UsVUFBVSxDQUNiLE9BQU8sRUFBRTtRQUNMLE9BQU8sK01BQUFOLE1BQUEsQ0FHMkJDLE9BQU87TUFRN0MsQ0FDSixDQUFDO0lBQ0wsQ0FBQyxDQUFDO0lBRUYsSUFBSU0sZUFBZSxHQUFHSixRQUFRLENBQUNDLGNBQWMsQ0FBQyxZQUFZLENBQUM7SUFDM0RHLGVBQWUsQ0FBQ0YsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQVc7TUFDakRkLE1BQU0sQ0FBQ2lCLFNBQVMsQ0FDWixDQUFDO1FBQ0csSUFBSSxFQUFFLFVBQVU7UUFDaEIsT0FBTyxFQUFFLFdBQVc7UUFDcEIsT0FBTyxFQUFFLGVBQWU7UUFDeEIsTUFBTSxFQUFFLENBQUM7VUFDRCxPQUFPLGlPQUFBUixNQUFBLENBRzJCQyxPQUFPO1FBTzVDLENBQUMsRUFBQztVQUNDLE9BQU8saU9BQUFELE1BQUEsQ0FHMkJDLE9BQU87UUFPNUMsQ0FBQztNQUVWLENBQUMsQ0FDTCxDQUFDO0lBQ0wsQ0FBQyxDQUFDO0lBRUYsSUFBSVEsV0FBVyxHQUFHTixRQUFRLENBQUNDLGNBQWMsQ0FBQyxhQUFhLENBQUM7SUFDeERLLFdBQVcsQ0FBQ0osZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQVc7TUFDN0NkLE1BQU0sQ0FBQ2tCLFdBQVcsQ0FBQyxPQUFPLENBQUM7SUFDL0IsQ0FBQyxDQUFDO0VBQ04sQ0FBQztFQUVELE9BQU87SUFDSDtJQUNBQyxJQUFJLEVBQUUsU0FBQUEsS0FBQSxFQUFXO01BQ2JwQixXQUFXLENBQUMsQ0FBQztJQUNqQjtFQUNKLENBQUM7QUFDTCxDQUFDLENBQUMsQ0FBQzs7QUFFSDtBQUNBcUIsTUFBTSxDQUFDQyxrQkFBa0IsQ0FBQyxZQUFXO0VBQ2pDdkIsaUJBQWlCLENBQUNxQixJQUFJLENBQUMsQ0FBQztBQUM1QixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZ2VuZXJhbC9qa2FuYmFuL3JpY2guanM/MDVkMiJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIE1WSkthbmJhbkRlbW9SaWNoID0gZnVuY3Rpb24oKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgdmFyIGV4YW1wbGVSaWNoID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIGthbmJhbiA9IG5ldyBqS2FuYmFuKHtcclxuICAgICAgICAgICAgZWxlbWVudDogJyNtdl9kb2NzX2prYW5iYW5fcmljaCcsXHJcbiAgICAgICAgICAgIGd1dHRlcjogJzAnLFxyXG4gICAgICAgICAgICBjbGljazogZnVuY3Rpb24oZWwpIHtcclxuICAgICAgICAgICAgICAgIGFsZXJ0KGVsLmlubmVySFRNTCk7XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGJvYXJkczogW3tcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX2JhY2tsb2cnLFxyXG4gICAgICAgICAgICAgICAgICAgICd0aXRsZSc6ICdCYWNrbG9nJyxcclxuICAgICAgICAgICAgICAgICAgICAnY2xhc3MnOiAnbGlnaHQtZGFyaycsXHJcbiAgICAgICAgICAgICAgICAgICAgJ2l0ZW0nOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwic3ltYm9sIHN5bWJvbC1zdWNjZXNzIG1lLTNcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8aW1nIGFsdD1cIlBpY1wiIHNyYz1cIiR7aG9zdFVybH1tZWRpYS9hdmF0YXJzLzMwMC02LmpwZ1wiIC8+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggZmxleC1jb2x1bW4gYWxpZ24taXRlbXMtc3RhcnRcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInRleHQtZGFyay01MCBmdy1ib2xkIG1iLTFcIj5TRU8gT3B0aW1pemF0aW9uPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYmFkZ2UgYmFkZ2UtbGlnaHQtc3VjY2Vzc1wiPkluIHByb2dyZXNzPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYCxcclxuICAgICAgICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwic3ltYm9sIHN5bWJvbC1zdWNjZXNzIG1lLTNcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInN5bWJvbC1sYWJlbCBmcy00XCI+QS5EPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwiZC1mbGV4IGZsZXgtY29sdW1uIGFsaWduLWl0ZW1zLXN0YXJ0XCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJ0ZXh0LWRhcmstNTAgZnctYm9sZCBtYi0xXCI+RmluYW5jZTwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cImJhZGdlIGJhZGdlLWxpZ2h0LWRhbmdlclwiPlBlbmRpbmc8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBgLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgXVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX3RvZG8nLFxyXG4gICAgICAgICAgICAgICAgICAgICd0aXRsZSc6ICdUbyBEbycsXHJcbiAgICAgICAgICAgICAgICAgICAgJ2NsYXNzJzogJ2xpZ2h0LWRhbmdlcicsXHJcbiAgICAgICAgICAgICAgICAgICAgJ2l0ZW0nOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwic3ltYm9sIHN5bWJvbC1zdWNjZXNzIG1lLTNcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8aW1nIGFsdD1cIlBpY1wiIHNyYz1cIiR7aG9zdFVybH1tZWRpYS9hdmF0YXJzLzMwMC0xLmpwZ1wiIC8+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggZmxleC1jb2x1bW4gYWxpZ24taXRlbXMtc3RhcnRcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInRleHQtZGFyay01MCBmdy1ib2xkIG1iLTFcIj5TZXJ2ZXIgU2V0dXA8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJiYWRnZSBiYWRnZS1saWdodC1pbmZvXCI+Q29tcGxldGVkPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYCxcclxuICAgICAgICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwic3ltYm9sIHN5bWJvbC1zdWNjZXNzIG1lLTNcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8aW1nIGFsdD1cIlBpY1wiIHNyYz1cIiR7aG9zdFVybH1tZWRpYS9hdmF0YXJzLzMwMC0yLmpwZ1wiIC8+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggZmxleC1jb2x1bW4gYWxpZ24taXRlbXMtc3RhcnRcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInRleHQtZGFyay01MCBmdy1ib2xkIG1iLTFcIj5SZXBvcnQgR2VuZXJhdGlvbjwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cImJhZGdlIGJhZGdlLWxpZ2h0LXdhcm5pbmdcIj5EdWU8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBgLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgXVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX3dvcmtpbmcnLFxyXG4gICAgICAgICAgICAgICAgICAgICd0aXRsZSc6ICdXb3JraW5nJyxcclxuICAgICAgICAgICAgICAgICAgICAnY2xhc3MnOiAnbGlnaHQtcHJpbWFyeScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ2l0ZW0nOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwic3ltYm9sIHN5bWJvbC1zdWNjZXNzIG1lLTNcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgPGltZyBhbHQ9XCJQaWNcIiBzcmM9XCIke2hvc3RVcmx9bWVkaWEvYXZhdGFycy8zMDAtNi5qcGdcIiAvPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwiZC1mbGV4IGZsZXgtY29sdW1uIGFsaWduLWl0ZW1zLXN0YXJ0XCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJ0ZXh0LWRhcmstNTAgZnctYm9sZCBtYi0xXCI+TWFya2V0aW5nPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYmFkZ2UgYmFkZ2UtbGlnaHQtZGFuZ2VyXCI+UGxhbm5pbmc8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBgLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAndGl0bGUnOiBgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBhbGlnbi1pdGVtcy1jZW50ZXJcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDxkaXYgY2xhc3M9XCJzeW1ib2wgc3ltYm9sLWxpZ2h0LWluZm8gbWUtM1wiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwic3ltYm9sLWxhYmVsIGZzLTRcIj5BLlA8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggZmxleC1jb2x1bW4gYWxpZ24taXRlbXMtc3RhcnRcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInRleHQtZGFyay01MCBmdy1ib2xkIG1iLTFcIj5GaW5hbmNlPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYmFkZ2UgYmFkZ2UtbGlnaHQtcHJpbWFyeVwiPkRvbmU8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBgLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgXVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX2RvbmUnLFxyXG4gICAgICAgICAgICAgICAgICAgICd0aXRsZSc6ICdEb25lJyxcclxuICAgICAgICAgICAgICAgICAgICAnY2xhc3MnOiAnbGlnaHQtc3VjY2VzcycsXHJcbiAgICAgICAgICAgICAgICAgICAgJ2l0ZW0nOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwic3ltYm9sIHN5bWJvbC1zdWNjZXNzIG1lLTNcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8aW1nIGFsdD1cIlBpY1wiIHNyYz1cIiR7aG9zdFVybH1tZWRpYS9hdmF0YXJzLzMwMC01LmpwZ1wiIC8+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggZmxleC1jb2x1bW4gYWxpZ24taXRlbXMtc3RhcnRcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInRleHQtZGFyay01MCBmdy1ib2xkIG1iLTFcIj5TRU8gT3B0aW1pemF0aW9uPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYmFkZ2UgYmFkZ2UtbGlnaHQtc3VjY2Vzc1wiPkluIHByb2dyZXNzPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYCxcclxuICAgICAgICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwic3ltYm9sIHN5bWJvbC1zdWNjZXNzIG1lLTNcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgICAgICA8aW1nIGFsdD1cIlBpY1wiIHNyYz1cIiR7aG9zdFVybH1tZWRpYS9hdmF0YXJzLzMwMC0yMC5qcGdcIiAvPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8ZGl2IGNsYXNzPVwiZC1mbGV4IGZsZXgtY29sdW1uIGFsaWduLWl0ZW1zLXN0YXJ0XCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJ0ZXh0LWRhcmstNTAgZnctYm9sZCBtYi0xXCI+UHJvZHVjdCBUZWFtPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYmFkZ2UgYmFkZ2UtbGlnaHQtZGFuZ2VyXCI+SW4gcHJvZ3Jlc3M8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBgLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgXVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX2RlcGxveScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogJ0RlcGxveScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ2NsYXNzJzogJ2xpZ2h0LXByaW1hcnknLFxyXG4gICAgICAgICAgICAgICAgICAgICdpdGVtJzogW3tcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICd0aXRsZSc6IGBcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwiZC1mbGV4IGFsaWduLWl0ZW1zLWNlbnRlclwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPGRpdiBjbGFzcz1cInN5bWJvbCBzeW1ib2wtbGlnaHQtd2FybmluZyBtZS0zXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJzeW1ib2wtbGFiZWwgZnMtNFwiPkQuTDwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBmbGV4LWNvbHVtbiBhbGlnbi1pdGVtcy1zdGFydFwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwidGV4dC1kYXJrLTUwIGZ3LWJvbGQgbWItMVwiPlNFTyBPcHRpbWl6YXRpb248L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJiYWRnZSBiYWRnZS1saWdodC1zdWNjZXNzXCI+SW4gcHJvZ3Jlc3M8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBgLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAndGl0bGUnOiBgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBhbGlnbi1pdGVtcy1jZW50ZXJcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDxkaXYgY2xhc3M9XCJzeW1ib2wgc3ltYm9sLWxpZ2h0LWRhbmdlciBtZS0zXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIFx0ICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJzeW1ib2wtbGFiZWwgZnMtNFwiPkUuSzwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBmbGV4LWNvbHVtbiBhbGlnbi1pdGVtcy1zdGFydFwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwidGV4dC1kYXJrLTUwIGZ3LWJvbGQgbWItMVwiPlJlcXVpcmVtZW50IFN0dWR5PC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYmFkZ2UgYmFkZ2UtbGlnaHQtd2FybmluZ1wiPlNjaGVkdWxlZDwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgXHQgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBcdCAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGAsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICBdXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIF1cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgdmFyIHRvRG9CdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYWRkVG9EbycpO1xyXG4gICAgICAgIHRvRG9CdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAga2FuYmFuLmFkZEVsZW1lbnQoXHJcbiAgICAgICAgICAgICAgICAnX3RvZG8nLCB7XHJcbiAgICAgICAgICAgICAgICAgICAgJ3RpdGxlJzogYFxyXG4gICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwiZC1mbGV4IGFsaWduLWl0ZW1zLWNlbnRlclwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cInN5bWJvbCBzeW1ib2wtbGlnaHQtcHJpbWFyeSBtZS0zXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGltZyBhbHQ9XCJQaWNcIiBzcmM9XCIke2hvc3RVcmx9bWVkaWEvYXZhdGFycy8zMDAtMjMuanBnXCIgLz5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBmbGV4LWNvbHVtbiBhbGlnbi1pdGVtcy1zdGFydFwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwidGV4dC1kYXJrLTUwIGZ3LWJvbGQgbWItMVwiPlJlcXVpcmVtZW50IFN0dWR5PC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYmFkZ2UgYmFkZ2UtbGlnaHQtc3VjY2Vzc1wiPlNjaGVkdWxlZDwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICBgXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIHZhciBhZGRCb2FyZERlZmF1bHQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYWRkRGVmYXVsdCcpO1xyXG4gICAgICAgIGFkZEJvYXJkRGVmYXVsdC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICBrYW5iYW4uYWRkQm9hcmRzKFxyXG4gICAgICAgICAgICAgICAgW3tcclxuICAgICAgICAgICAgICAgICAgICAnaWQnOiAnX2RlZmF1bHQnLFxyXG4gICAgICAgICAgICAgICAgICAgICd0aXRsZSc6ICdOZXcgQm9hcmQnLFxyXG4gICAgICAgICAgICAgICAgICAgICdjbGFzcyc6ICdsaWdodC1wcmltYXJ5JyxcclxuICAgICAgICAgICAgICAgICAgICAnaXRlbSc6IFt7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAndGl0bGUnOiBgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBhbGlnbi1pdGVtcy1jZW50ZXJcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cInN5bWJvbCBzeW1ib2wtc3VjY2VzcyBtZS0zXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aW1nIGFsdD1cIlBpY1wiIHNyYz1cIiR7aG9zdFVybH1tZWRpYS9hdmF0YXJzLzMwMC0xMi5qcGdcIiAvPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBmbGV4LWNvbHVtbiBhbGlnbi1pdGVtcy1zdGFydFwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJ0ZXh0LWRhcmstNTAgZnctYm9sZCBtYi0xXCI+UGF5bWVudCBNb2R1bGVzPC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJiYWRnZSBiYWRnZS1saWdodC1wcmltYXJ5XCI+SW4gZGV2ZWxvcG1lbnQ8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICBgfSx7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAndGl0bGUnOiBgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cImQtZmxleCBhbGlnbi1pdGVtcy1jZW50ZXJcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cInN5bWJvbCBzeW1ib2wtc3VjY2VzcyBtZS0zXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aW1nIGFsdD1cIlBpY1wiIHNyYz1cIiR7aG9zdFVybH1tZWRpYS9hdmF0YXJzLzMwMC05LmpwZ1wiIC8+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwiZC1mbGV4IGZsZXgtY29sdW1uIGFsaWduLWl0ZW1zLXN0YXJ0XCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwidGV4dC1kYXJrLTUwIGZ3LWJvbGQgbWItMVwiPk5ldyBQcm9qZWN0PC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzcz1cImJhZGdlIGJhZGdlLWxpZ2h0LWRhbmdlclwiPlBlbmRpbmc8L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgYH1cclxuICAgICAgICAgICAgICAgICAgICBdXHJcbiAgICAgICAgICAgICAgICB9XVxyXG4gICAgICAgICAgICApXHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIHZhciByZW1vdmVCb2FyZCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdyZW1vdmVCb2FyZCcpO1xyXG4gICAgICAgIHJlbW92ZUJvYXJkLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGthbmJhbi5yZW1vdmVCb2FyZCgnX2RvbmUnKTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZXhhbXBsZVJpY2goKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5NVlV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uKCkge1xyXG4gICAgTVZKS2FuYmFuRGVtb1JpY2guaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIk1WSkthbmJhbkRlbW9SaWNoIiwiZXhhbXBsZVJpY2giLCJrYW5iYW4iLCJqS2FuYmFuIiwiZWxlbWVudCIsImd1dHRlciIsImNsaWNrIiwiZWwiLCJhbGVydCIsImlubmVySFRNTCIsImJvYXJkcyIsImNvbmNhdCIsImhvc3RVcmwiLCJ0b0RvQnV0dG9uIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImFkZEV2ZW50TGlzdGVuZXIiLCJhZGRFbGVtZW50IiwiYWRkQm9hcmREZWZhdWx0IiwiYWRkQm9hcmRzIiwicmVtb3ZlQm9hcmQiLCJpbml0IiwiTVZVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/general/jkanban/rich.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/general/jkanban/rich.js"]();
/******/ 	
/******/ })()
;