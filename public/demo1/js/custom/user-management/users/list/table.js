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

/***/ "./resources/assets/extended/js/custom/user-management/users/list/table.js":
/*!*********************************************************************************!*\
  !*** ./resources/assets/extended/js/custom/user-management/users/list/table.js ***!
  \*********************************************************************************/
/***/ (() => {

eval("// \"use strict\";\n// window.$ = window.jQuery = require( 'jquery' );\n// require( 'datatables.net' );\n// var MVUsersList = function () {\n//     // Define shared variables\n//     var table = document.getElementById('mv_table_users');\n//     var datatable;\n//     var toolbarBase;\n//     var toolbarSelected;\n//     var selectedCount;\n//     // Private functions\n//     var initUserTable = function () {\n//         // Set date data order\n//         const tableRows = table.querySelectorAll('tbody tr');\n//         tableRows.forEach(row => {\n//             const dateRow = row.querySelectorAll('td');\n//             const lastLogin = dateRow[4].innerText.toLowerCase(); // Get last login time\n//             let timeCount = 0;\n//             let timeFormat = 'minutes';\n//             // Determine date & time format -- add more formats when necessary\n//             if (lastLogin.includes('yesterday')) {\n//                 timeCount = 1;\n//                 timeFormat = 'days';\n//             } else if (lastLogin.includes('mins')) {\n//                 timeCount = parseInt(lastLogin.replace(/\\D/g, ''));\n//                 timeFormat = 'minutes';\n//             } else if (lastLogin.includes('hours')) {\n//                 timeCount = parseInt(lastLogin.replace(/\\D/g, ''));\n//                 timeFormat = 'hours';\n//             } else if (lastLogin.includes('days')) {\n//                 timeCount = parseInt(lastLogin.replace(/\\D/g, ''));\n//                 timeFormat = 'days';\n//             } else if (lastLogin.includes('weeks')) {\n//                 timeCount = parseInt(lastLogin.replace(/\\D/g, ''));\n//                 timeFormat = 'weeks';\n//             }\n//             // Subtract date/time from today -- more info on moment datetime subtraction: https://momentjs.com/docs/#/durations/subtract/\n//             const realDate = moment().subtract(timeCount, timeFormat).format();\n//             // Insert real date to last login attribute\n//             dateRow[4].setAttribute('data-order', realDate);\n//             // Set real date for joined column\n//             const joinedDate = moment(dateRow[5].innerHTML, \"DD MMM YYYY, LT\").format(); // select date from 5th column in table\n//             dateRow[5].setAttribute('data-order', joinedDate);\n//         });\n//         // Init datatable --- more info on datatables: https://datatables.net/manual/\n//         datatable = $(table).DataTable({\n//             \"info\": false,\n//             'order': [],\n//             \"pageLength\": 10,\n//             \"lengthChange\": false,\n//             'columnDefs': [\n//                 { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)\n//                 { orderable: false, targets: 6 }, // Disable ordering on column 6 (actions)\n//             ]\n//         });\n//         // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw\n//         datatable.on('draw', function () {\n//             // initToggleToolbar();\n//             // handleDeleteRows();\n//             // toggleToolbars();\n//         });\n//     }\n//     // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()\n//     var handleSearchDatatable = () => {\n//         const filterSearch = document.querySelector('[data-mv-user-table-filter=\"search\"]');\n//         filterSearch.addEventListener('keyup', function (e) {\n//             datatable.search(e.target.value).draw();\n//         });\n//     }\n//     // Filter Datatable\n//     var handleFilterDatatable = () => {\n//         // Select filter options\n//         const filterForm = document.querySelector('[data-mv-user-table-filter=\"form\"]');\n//         const filterButton = filterForm.querySelector('[data-mv-user-table-filter=\"filter\"]');\n//         const selectOptions = filterForm.querySelectorAll('select');\n//         // Filter datatable on submit\n//         filterButton.addEventListener('click', function () {\n//             var filterString = '';\n//             // Get filter values\n//             selectOptions.forEach((item, index) => {\n//                 if (item.value && item.value !== '') {\n//                     if (index !== 0) {\n//                         filterString += ' ';\n//                     }\n//                     // Build filter value options\n//                     filterString += item.value;\n//                 }\n//             });\n//             // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()\n//             datatable.search(filterString).draw();\n//         });\n//     }\n//     // Reset Filter\n//     var handleResetForm = () => {\n//         // Select reset button\n//         const resetButton = document.querySelector('[data-mv-user-table-filter=\"reset\"]');\n//         // Reset datatable\n//         resetButton.addEventListener('click', function () {\n//             // Select filter options\n//             const filterForm = document.querySelector('[data-mv-user-table-filter=\"form\"]');\n//             const selectOptions = filterForm.querySelectorAll('select');\n//             // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items\n//             selectOptions.forEach(select => {\n//                 $(select).val('').trigger('change');\n//             });\n//             // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()\n//             datatable.search('').draw();\n//         });\n//     }\n//     // Delete subscirption\n//     var handleDeleteRows = () => {\n//         // Select all delete buttons\n//         const deleteButtons = table.querySelectorAll('[data-mv-users-table-filter=\"delete_row\"]');\n//         deleteButtons.forEach(d => {\n//             // Delete button on click\n//             d.addEventListener('click', function (e) {\n//                 e.preventDefault();\n//                 // Select parent row\n//                 const parent = e.target.closest('tr');\n//                 // Get user name\n//                 const userName = parent.querySelectorAll('td')[1].querySelectorAll('a')[1].innerText;\n//                 // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/\n//                 Swal.fire({\n//                     text: \"Are you sure you want to delete \" + userName + \"?\",\n//                     icon: \"warning\",\n//                     showCancelButton: true,\n//                     buttonsStyling: false,\n//                     confirmButtonText: \"Yes, delete!\",\n//                     cancelButtonText: \"No, cancel\",\n//                     customClass: {\n//                         confirmButton: \"btn fw-bold btn-danger\",\n//                         cancelButton: \"btn fw-bold btn-active-light-primary\"\n//                     }\n//                 }).then(function (result) {\n//                     if (result.value) {\n//                         Swal.fire({\n//                             text: \"You have deleted \" + userName + \"!.\",\n//                             icon: \"success\",\n//                             buttonsStyling: false,\n//                             confirmButtonText: \"Ok, got it!\",\n//                             customClass: {\n//                                 confirmButton: \"btn fw-bold btn-primary\",\n//                             }\n//                         }).then(function () {\n//                             // Remove current row\n//                             datatable.row($(parent)).remove().draw();\n//                         }).then(function () {\n//                             // Detect checked checkboxes\n//                             toggleToolbars();\n//                         });\n//                     } else if (result.dismiss === 'cancel') {\n//                         Swal.fire({\n//                             text: customerName + \" was not deleted.\",\n//                             icon: \"error\",\n//                             buttonsStyling: false,\n//                             confirmButtonText: \"Ok, got it!\",\n//                             customClass: {\n//                                 confirmButton: \"btn fw-bold btn-primary\",\n//                             }\n//                         });\n//                     }\n//                 });\n//             })\n//         });\n//     }\n//     // Init toggle toolbar\n//     var initToggleToolbar = () => {\n//         // Toggle selected action toolbar\n//         // Select all checkboxes\n//         const checkboxes = table.querySelectorAll('[type=\"checkbox\"]');\n//         // Select elements\n//         toolbarBase = document.querySelector('[data-mv-user-table-toolbar=\"base\"]');\n//         toolbarSelected = document.querySelector('[data-mv-user-table-toolbar=\"selected\"]');\n//         selectedCount = document.querySelector('[data-mv-user-table-select=\"selected_count\"]');\n//         const deleteSelected = document.querySelector('[data-mv-user-table-select=\"delete_selected\"]');\n//         // Toggle delete selected toolbar\n//         checkboxes.forEach(c => {\n//             // Checkbox on click event\n//             c.addEventListener('click', function () {\n//                 setTimeout(function () {\n//                     toggleToolbars();\n//                 }, 50);\n//             });\n//         });\n//         // Deleted selected rows\n//         deleteSelected.addEventListener('click', function () {\n//             // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/\n//             Swal.fire({\n//                 text: \"Are you sure you want to delete selected customers?\",\n//                 icon: \"warning\",\n//                 showCancelButton: true,\n//                 buttonsStyling: false,\n//                 confirmButtonText: \"Yes, delete!\",\n//                 cancelButtonText: \"No, cancel\",\n//                 customClass: {\n//                     confirmButton: \"btn fw-bold btn-danger\",\n//                     cancelButton: \"btn fw-bold btn-active-light-primary\"\n//                 }\n//             }).then(function (result) {\n//                 if (result.value) {\n//                     Swal.fire({\n//                         text: \"You have deleted all selected customers!.\",\n//                         icon: \"success\",\n//                         buttonsStyling: false,\n//                         confirmButtonText: \"Ok, got it!\",\n//                         customClass: {\n//                             confirmButton: \"btn fw-bold btn-primary\",\n//                         }\n//                     }).then(function () {\n//                         // Remove all selected customers\n//                         checkboxes.forEach(c => {\n//                             if (c.checked) {\n//                                 datatable.row($(c.closest('tbody tr'))).remove().draw();\n//                             }\n//                         });\n//                         // Remove header checked box\n//                         const headerCheckbox = table.querySelectorAll('[type=\"checkbox\"]')[0];\n//                         headerCheckbox.checked = false;\n//                     }).then(function () {\n//                         toggleToolbars(); // Detect checked checkboxes\n//                         initToggleToolbar(); // Re-init toolbar to recalculate checkboxes\n//                     });\n//                 } else if (result.dismiss === 'cancel') {\n//                     Swal.fire({\n//                         text: \"Selected customers was not deleted.\",\n//                         icon: \"error\",\n//                         buttonsStyling: false,\n//                         confirmButtonText: \"Ok, got it!\",\n//                         customClass: {\n//                             confirmButton: \"btn fw-bold btn-primary\",\n//                         }\n//                     });\n//                 }\n//             });\n//         });\n//     }\n//     // Toggle toolbars\n//     const toggleToolbars = () => {\n//         // Select refreshed checkbox DOM elements\n//         const allCheckboxes = table.querySelectorAll('tbody [type=\"checkbox\"]');\n//         // Detect checkboxes state & count\n//         let checkedState = false;\n//         let count = 0;\n//         // Count checked boxes\n//         allCheckboxes.forEach(c => {\n//             if (c.checked) {\n//                 checkedState = true;\n//                 count++;\n//             }\n//         });\n//         // Toggle toolbars\n//         if (checkedState) {\n//             selectedCount.innerHTML = count;\n//             toolbarBase.classList.add('d-none');\n//             toolbarSelected.classList.remove('d-none');\n//         } else {\n//             toolbarBase.classList.remove('d-none');\n//             toolbarSelected.classList.add('d-none');\n//         }\n//     }\n//     return {\n//         // Public functions\n//         init: function () {\n//             if (!table) {\n//                 return;\n//             }\n//             // initUserTable();\n//             // initToggleToolbar();\n//             // handleSearchDatatable();\n//             // handleResetForm();\n//             // handleDeleteRows();\n//             // handleFilterDatatable();\n//         }\n//     }\n// }();\n// // On document ready\n// MVUtil.onDOMContentLoaded(function () {\n//     MVUsersList.init();\n// });//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2V4dGVuZGVkL2pzL2N1c3RvbS91c2VyLW1hbmFnZW1lbnQvdXNlcnMvbGlzdC90YWJsZS5qcz8xYmU1Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFFQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBR0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFFQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZXNDb250ZW50IjpbIi8vIFwidXNlIHN0cmljdFwiO1xyXG4vLyB3aW5kb3cuJCA9IHdpbmRvdy5qUXVlcnkgPSByZXF1aXJlKCAnanF1ZXJ5JyApO1xyXG4vLyByZXF1aXJlKCAnZGF0YXRhYmxlcy5uZXQnICk7XHJcblxyXG4vLyB2YXIgTVZVc2Vyc0xpc3QgPSBmdW5jdGlvbiAoKSB7XHJcbi8vICAgICAvLyBEZWZpbmUgc2hhcmVkIHZhcmlhYmxlc1xyXG4vLyAgICAgdmFyIHRhYmxlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ212X3RhYmxlX3VzZXJzJyk7XHJcbi8vICAgICB2YXIgZGF0YXRhYmxlO1xyXG4vLyAgICAgdmFyIHRvb2xiYXJCYXNlO1xyXG4vLyAgICAgdmFyIHRvb2xiYXJTZWxlY3RlZDtcclxuLy8gICAgIHZhciBzZWxlY3RlZENvdW50O1xyXG5cclxuLy8gICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbi8vICAgICB2YXIgaW5pdFVzZXJUYWJsZSA9IGZ1bmN0aW9uICgpIHtcclxuLy8gICAgICAgICAvLyBTZXQgZGF0ZSBkYXRhIG9yZGVyXHJcbi8vICAgICAgICAgY29uc3QgdGFibGVSb3dzID0gdGFibGUucXVlcnlTZWxlY3RvckFsbCgndGJvZHkgdHInKTtcclxuXHJcbi8vICAgICAgICAgdGFibGVSb3dzLmZvckVhY2gocm93ID0+IHtcclxuLy8gICAgICAgICAgICAgY29uc3QgZGF0ZVJvdyA9IHJvdy5xdWVyeVNlbGVjdG9yQWxsKCd0ZCcpO1xyXG4vLyAgICAgICAgICAgICBjb25zdCBsYXN0TG9naW4gPSBkYXRlUm93WzRdLmlubmVyVGV4dC50b0xvd2VyQ2FzZSgpOyAvLyBHZXQgbGFzdCBsb2dpbiB0aW1lXHJcbi8vICAgICAgICAgICAgIGxldCB0aW1lQ291bnQgPSAwO1xyXG4vLyAgICAgICAgICAgICBsZXQgdGltZUZvcm1hdCA9ICdtaW51dGVzJztcclxuXHJcbi8vICAgICAgICAgICAgIC8vIERldGVybWluZSBkYXRlICYgdGltZSBmb3JtYXQgLS0gYWRkIG1vcmUgZm9ybWF0cyB3aGVuIG5lY2Vzc2FyeVxyXG4vLyAgICAgICAgICAgICBpZiAobGFzdExvZ2luLmluY2x1ZGVzKCd5ZXN0ZXJkYXknKSkge1xyXG4vLyAgICAgICAgICAgICAgICAgdGltZUNvdW50ID0gMTtcclxuLy8gICAgICAgICAgICAgICAgIHRpbWVGb3JtYXQgPSAnZGF5cyc7XHJcbi8vICAgICAgICAgICAgIH0gZWxzZSBpZiAobGFzdExvZ2luLmluY2x1ZGVzKCdtaW5zJykpIHtcclxuLy8gICAgICAgICAgICAgICAgIHRpbWVDb3VudCA9IHBhcnNlSW50KGxhc3RMb2dpbi5yZXBsYWNlKC9cXEQvZywgJycpKTtcclxuLy8gICAgICAgICAgICAgICAgIHRpbWVGb3JtYXQgPSAnbWludXRlcyc7XHJcbi8vICAgICAgICAgICAgIH0gZWxzZSBpZiAobGFzdExvZ2luLmluY2x1ZGVzKCdob3VycycpKSB7XHJcbi8vICAgICAgICAgICAgICAgICB0aW1lQ291bnQgPSBwYXJzZUludChsYXN0TG9naW4ucmVwbGFjZSgvXFxEL2csICcnKSk7XHJcbi8vICAgICAgICAgICAgICAgICB0aW1lRm9ybWF0ID0gJ2hvdXJzJztcclxuLy8gICAgICAgICAgICAgfSBlbHNlIGlmIChsYXN0TG9naW4uaW5jbHVkZXMoJ2RheXMnKSkge1xyXG4vLyAgICAgICAgICAgICAgICAgdGltZUNvdW50ID0gcGFyc2VJbnQobGFzdExvZ2luLnJlcGxhY2UoL1xcRC9nLCAnJykpO1xyXG4vLyAgICAgICAgICAgICAgICAgdGltZUZvcm1hdCA9ICdkYXlzJztcclxuLy8gICAgICAgICAgICAgfSBlbHNlIGlmIChsYXN0TG9naW4uaW5jbHVkZXMoJ3dlZWtzJykpIHtcclxuLy8gICAgICAgICAgICAgICAgIHRpbWVDb3VudCA9IHBhcnNlSW50KGxhc3RMb2dpbi5yZXBsYWNlKC9cXEQvZywgJycpKTtcclxuLy8gICAgICAgICAgICAgICAgIHRpbWVGb3JtYXQgPSAnd2Vla3MnO1xyXG4vLyAgICAgICAgICAgICB9XHJcblxyXG4vLyAgICAgICAgICAgICAvLyBTdWJ0cmFjdCBkYXRlL3RpbWUgZnJvbSB0b2RheSAtLSBtb3JlIGluZm8gb24gbW9tZW50IGRhdGV0aW1lIHN1YnRyYWN0aW9uOiBodHRwczovL21vbWVudGpzLmNvbS9kb2NzLyMvZHVyYXRpb25zL3N1YnRyYWN0L1xyXG4vLyAgICAgICAgICAgICBjb25zdCByZWFsRGF0ZSA9IG1vbWVudCgpLnN1YnRyYWN0KHRpbWVDb3VudCwgdGltZUZvcm1hdCkuZm9ybWF0KCk7XHJcblxyXG4vLyAgICAgICAgICAgICAvLyBJbnNlcnQgcmVhbCBkYXRlIHRvIGxhc3QgbG9naW4gYXR0cmlidXRlXHJcbi8vICAgICAgICAgICAgIGRhdGVSb3dbNF0uc2V0QXR0cmlidXRlKCdkYXRhLW9yZGVyJywgcmVhbERhdGUpO1xyXG5cclxuLy8gICAgICAgICAgICAgLy8gU2V0IHJlYWwgZGF0ZSBmb3Igam9pbmVkIGNvbHVtblxyXG4vLyAgICAgICAgICAgICBjb25zdCBqb2luZWREYXRlID0gbW9tZW50KGRhdGVSb3dbNV0uaW5uZXJIVE1MLCBcIkREIE1NTSBZWVlZLCBMVFwiKS5mb3JtYXQoKTsgLy8gc2VsZWN0IGRhdGUgZnJvbSA1dGggY29sdW1uIGluIHRhYmxlXHJcbi8vICAgICAgICAgICAgIGRhdGVSb3dbNV0uc2V0QXR0cmlidXRlKCdkYXRhLW9yZGVyJywgam9pbmVkRGF0ZSk7XHJcbi8vICAgICAgICAgfSk7XHJcblxyXG4vLyAgICAgICAgIC8vIEluaXQgZGF0YXRhYmxlIC0tLSBtb3JlIGluZm8gb24gZGF0YXRhYmxlczogaHR0cHM6Ly9kYXRhdGFibGVzLm5ldC9tYW51YWwvXHJcbi8vICAgICAgICAgZGF0YXRhYmxlID0gJCh0YWJsZSkuRGF0YVRhYmxlKHtcclxuLy8gICAgICAgICAgICAgXCJpbmZvXCI6IGZhbHNlLFxyXG4vLyAgICAgICAgICAgICAnb3JkZXInOiBbXSxcclxuLy8gICAgICAgICAgICAgXCJwYWdlTGVuZ3RoXCI6IDEwLFxyXG4vLyAgICAgICAgICAgICBcImxlbmd0aENoYW5nZVwiOiBmYWxzZSxcclxuLy8gICAgICAgICAgICAgJ2NvbHVtbkRlZnMnOiBbXHJcbi8vICAgICAgICAgICAgICAgICB7IG9yZGVyYWJsZTogZmFsc2UsIHRhcmdldHM6IDAgfSwgLy8gRGlzYWJsZSBvcmRlcmluZyBvbiBjb2x1bW4gMCAoY2hlY2tib3gpXHJcbi8vICAgICAgICAgICAgICAgICB7IG9yZGVyYWJsZTogZmFsc2UsIHRhcmdldHM6IDYgfSwgLy8gRGlzYWJsZSBvcmRlcmluZyBvbiBjb2x1bW4gNiAoYWN0aW9ucylcclxuLy8gICAgICAgICAgICAgXVxyXG4vLyAgICAgICAgIH0pO1xyXG5cclxuLy8gICAgICAgICAvLyBSZS1pbml0IGZ1bmN0aW9ucyBvbiBldmVyeSB0YWJsZSByZS1kcmF3IC0tIG1vcmUgaW5mbzogaHR0cHM6Ly9kYXRhdGFibGVzLm5ldC9yZWZlcmVuY2UvZXZlbnQvZHJhd1xyXG4vLyAgICAgICAgIGRhdGF0YWJsZS5vbignZHJhdycsIGZ1bmN0aW9uICgpIHtcclxuLy8gICAgICAgICAgICAgLy8gaW5pdFRvZ2dsZVRvb2xiYXIoKTtcclxuLy8gICAgICAgICAgICAgLy8gaGFuZGxlRGVsZXRlUm93cygpO1xyXG4vLyAgICAgICAgICAgICAvLyB0b2dnbGVUb29sYmFycygpO1xyXG4vLyAgICAgICAgIH0pO1xyXG4vLyAgICAgfVxyXG5cclxuLy8gICAgIC8vIFNlYXJjaCBEYXRhdGFibGUgLS0tIG9mZmljaWFsIGRvY3MgcmVmZXJlbmNlOiBodHRwczovL2RhdGF0YWJsZXMubmV0L3JlZmVyZW5jZS9hcGkvc2VhcmNoKClcclxuLy8gICAgIHZhciBoYW5kbGVTZWFyY2hEYXRhdGFibGUgPSAoKSA9PiB7XHJcbi8vICAgICAgICAgY29uc3QgZmlsdGVyU2VhcmNoID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtdXNlci10YWJsZS1maWx0ZXI9XCJzZWFyY2hcIl0nKTtcclxuLy8gICAgICAgICBmaWx0ZXJTZWFyY2guYWRkRXZlbnRMaXN0ZW5lcigna2V5dXAnLCBmdW5jdGlvbiAoZSkge1xyXG4vLyAgICAgICAgICAgICBkYXRhdGFibGUuc2VhcmNoKGUudGFyZ2V0LnZhbHVlKS5kcmF3KCk7XHJcbi8vICAgICAgICAgfSk7XHJcbi8vICAgICB9XHJcblxyXG4vLyAgICAgLy8gRmlsdGVyIERhdGF0YWJsZVxyXG4vLyAgICAgdmFyIGhhbmRsZUZpbHRlckRhdGF0YWJsZSA9ICgpID0+IHtcclxuLy8gICAgICAgICAvLyBTZWxlY3QgZmlsdGVyIG9wdGlvbnNcclxuLy8gICAgICAgICBjb25zdCBmaWx0ZXJGb3JtID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEtbXYtdXNlci10YWJsZS1maWx0ZXI9XCJmb3JtXCJdJyk7XHJcbi8vICAgICAgICAgY29uc3QgZmlsdGVyQnV0dG9uID0gZmlsdGVyRm9ybS5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi11c2VyLXRhYmxlLWZpbHRlcj1cImZpbHRlclwiXScpO1xyXG4vLyAgICAgICAgIGNvbnN0IHNlbGVjdE9wdGlvbnMgPSBmaWx0ZXJGb3JtLnF1ZXJ5U2VsZWN0b3JBbGwoJ3NlbGVjdCcpO1xyXG5cclxuLy8gICAgICAgICAvLyBGaWx0ZXIgZGF0YXRhYmxlIG9uIHN1Ym1pdFxyXG4vLyAgICAgICAgIGZpbHRlckJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcclxuLy8gICAgICAgICAgICAgdmFyIGZpbHRlclN0cmluZyA9ICcnO1xyXG5cclxuLy8gICAgICAgICAgICAgLy8gR2V0IGZpbHRlciB2YWx1ZXNcclxuLy8gICAgICAgICAgICAgc2VsZWN0T3B0aW9ucy5mb3JFYWNoKChpdGVtLCBpbmRleCkgPT4ge1xyXG4vLyAgICAgICAgICAgICAgICAgaWYgKGl0ZW0udmFsdWUgJiYgaXRlbS52YWx1ZSAhPT0gJycpIHtcclxuLy8gICAgICAgICAgICAgICAgICAgICBpZiAoaW5kZXggIT09IDApIHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgZmlsdGVyU3RyaW5nICs9ICcgJztcclxuLy8gICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4vLyAgICAgICAgICAgICAgICAgICAgIC8vIEJ1aWxkIGZpbHRlciB2YWx1ZSBvcHRpb25zXHJcbi8vICAgICAgICAgICAgICAgICAgICAgZmlsdGVyU3RyaW5nICs9IGl0ZW0udmFsdWU7XHJcbi8vICAgICAgICAgICAgICAgICB9XHJcbi8vICAgICAgICAgICAgIH0pO1xyXG5cclxuLy8gICAgICAgICAgICAgLy8gRmlsdGVyIGRhdGF0YWJsZSAtLS0gb2ZmaWNpYWwgZG9jcyByZWZlcmVuY2U6IGh0dHBzOi8vZGF0YXRhYmxlcy5uZXQvcmVmZXJlbmNlL2FwaS9zZWFyY2goKVxyXG4vLyAgICAgICAgICAgICBkYXRhdGFibGUuc2VhcmNoKGZpbHRlclN0cmluZykuZHJhdygpO1xyXG4vLyAgICAgICAgIH0pO1xyXG4vLyAgICAgfVxyXG5cclxuLy8gICAgIC8vIFJlc2V0IEZpbHRlclxyXG4vLyAgICAgdmFyIGhhbmRsZVJlc2V0Rm9ybSA9ICgpID0+IHtcclxuLy8gICAgICAgICAvLyBTZWxlY3QgcmVzZXQgYnV0dG9uXHJcbi8vICAgICAgICAgY29uc3QgcmVzZXRCdXR0b24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi11c2VyLXRhYmxlLWZpbHRlcj1cInJlc2V0XCJdJyk7XHJcblxyXG4vLyAgICAgICAgIC8vIFJlc2V0IGRhdGF0YWJsZVxyXG4vLyAgICAgICAgIHJlc2V0QnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xyXG4vLyAgICAgICAgICAgICAvLyBTZWxlY3QgZmlsdGVyIG9wdGlvbnNcclxuLy8gICAgICAgICAgICAgY29uc3QgZmlsdGVyRm9ybSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LXVzZXItdGFibGUtZmlsdGVyPVwiZm9ybVwiXScpO1xyXG4vLyAgICAgICAgICAgICBjb25zdCBzZWxlY3RPcHRpb25zID0gZmlsdGVyRm9ybS5xdWVyeVNlbGVjdG9yQWxsKCdzZWxlY3QnKTtcclxuXHJcbi8vICAgICAgICAgICAgIC8vIFJlc2V0IHNlbGVjdDIgdmFsdWVzIC0tIG1vcmUgaW5mbzogaHR0cHM6Ly9zZWxlY3QyLm9yZy9wcm9ncmFtbWF0aWMtY29udHJvbC9hZGQtc2VsZWN0LWNsZWFyLWl0ZW1zXHJcbi8vICAgICAgICAgICAgIHNlbGVjdE9wdGlvbnMuZm9yRWFjaChzZWxlY3QgPT4ge1xyXG4vLyAgICAgICAgICAgICAgICAgJChzZWxlY3QpLnZhbCgnJykudHJpZ2dlcignY2hhbmdlJyk7XHJcbi8vICAgICAgICAgICAgIH0pO1xyXG5cclxuLy8gICAgICAgICAgICAgLy8gUmVzZXQgZGF0YXRhYmxlIC0tLSBvZmZpY2lhbCBkb2NzIHJlZmVyZW5jZTogaHR0cHM6Ly9kYXRhdGFibGVzLm5ldC9yZWZlcmVuY2UvYXBpL3NlYXJjaCgpXHJcbi8vICAgICAgICAgICAgIGRhdGF0YWJsZS5zZWFyY2goJycpLmRyYXcoKTtcclxuLy8gICAgICAgICB9KTtcclxuLy8gICAgIH1cclxuXHJcblxyXG4vLyAgICAgLy8gRGVsZXRlIHN1YnNjaXJwdGlvblxyXG4vLyAgICAgdmFyIGhhbmRsZURlbGV0ZVJvd3MgPSAoKSA9PiB7XHJcbi8vICAgICAgICAgLy8gU2VsZWN0IGFsbCBkZWxldGUgYnV0dG9uc1xyXG4vLyAgICAgICAgIGNvbnN0IGRlbGV0ZUJ1dHRvbnMgPSB0YWJsZS5xdWVyeVNlbGVjdG9yQWxsKCdbZGF0YS1tdi11c2Vycy10YWJsZS1maWx0ZXI9XCJkZWxldGVfcm93XCJdJyk7XHJcblxyXG4vLyAgICAgICAgIGRlbGV0ZUJ1dHRvbnMuZm9yRWFjaChkID0+IHtcclxuLy8gICAgICAgICAgICAgLy8gRGVsZXRlIGJ1dHRvbiBvbiBjbGlja1xyXG4vLyAgICAgICAgICAgICBkLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuLy8gICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcbi8vICAgICAgICAgICAgICAgICAvLyBTZWxlY3QgcGFyZW50IHJvd1xyXG4vLyAgICAgICAgICAgICAgICAgY29uc3QgcGFyZW50ID0gZS50YXJnZXQuY2xvc2VzdCgndHInKTtcclxuXHJcbi8vICAgICAgICAgICAgICAgICAvLyBHZXQgdXNlciBuYW1lXHJcbi8vICAgICAgICAgICAgICAgICBjb25zdCB1c2VyTmFtZSA9IHBhcmVudC5xdWVyeVNlbGVjdG9yQWxsKCd0ZCcpWzFdLnF1ZXJ5U2VsZWN0b3JBbGwoJ2EnKVsxXS5pbm5lclRleHQ7XHJcblxyXG4vLyAgICAgICAgICAgICAgICAgLy8gU3dlZXRBbGVydDIgcG9wIHVwIC0tLSBvZmZpY2lhbCBkb2NzIHJlZmVyZW5jZTogaHR0cHM6Ly9zd2VldGFsZXJ0Mi5naXRodWIuaW8vXHJcbi8vICAgICAgICAgICAgICAgICBTd2FsLmZpcmUoe1xyXG4vLyAgICAgICAgICAgICAgICAgICAgIHRleHQ6IFwiQXJlIHlvdSBzdXJlIHlvdSB3YW50IHRvIGRlbGV0ZSBcIiArIHVzZXJOYW1lICsgXCI/XCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJ3YXJuaW5nXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgc2hvd0NhbmNlbEJ1dHRvbjogdHJ1ZSxcclxuLy8gICAgICAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvblRleHQ6IFwiWWVzLCBkZWxldGUhXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgY2FuY2VsQnV0dG9uVGV4dDogXCJObywgY2FuY2VsXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgY3VzdG9tQ2xhc3M6IHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvbjogXCJidG4gZnctYm9sZCBidG4tZGFuZ2VyXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIGNhbmNlbEJ1dHRvbjogXCJidG4gZnctYm9sZCBidG4tYWN0aXZlLWxpZ2h0LXByaW1hcnlcIlxyXG4vLyAgICAgICAgICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICAgICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKHJlc3VsdCkge1xyXG4vLyAgICAgICAgICAgICAgICAgICAgIGlmIChyZXN1bHQudmFsdWUpIHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRleHQ6IFwiWW91IGhhdmUgZGVsZXRlZCBcIiArIHVzZXJOYW1lICsgXCIhLlwiLFxyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJzdWNjZXNzXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uVGV4dDogXCJPaywgZ290IGl0IVwiLFxyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY3VzdG9tQ2xhc3M6IHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uOiBcImJ0biBmdy1ib2xkIGJ0bi1wcmltYXJ5XCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKCkge1xyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgLy8gUmVtb3ZlIGN1cnJlbnQgcm93XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBkYXRhdGFibGUucm93KCQocGFyZW50KSkucmVtb3ZlKCkuZHJhdygpO1xyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICB9KS50aGVuKGZ1bmN0aW9uICgpIHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgICAgIC8vIERldGVjdCBjaGVja2VkIGNoZWNrYm94ZXNcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRvZ2dsZVRvb2xiYXJzKCk7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xyXG4vLyAgICAgICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAocmVzdWx0LmRpc21pc3MgPT09ICdjYW5jZWwnKSB7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIFN3YWwuZmlyZSh7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0OiBjdXN0b21lck5hbWUgKyBcIiB3YXMgbm90IGRlbGV0ZWQuXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpY29uOiBcImVycm9yXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uVGV4dDogXCJPaywgZ290IGl0IVwiLFxyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY3VzdG9tQ2xhc3M6IHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uOiBcImJ0biBmdy1ib2xkIGJ0bi1wcmltYXJ5XCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xyXG4vLyAgICAgICAgICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICAgICAgICAgIH0pO1xyXG4vLyAgICAgICAgICAgICB9KVxyXG4vLyAgICAgICAgIH0pO1xyXG4vLyAgICAgfVxyXG5cclxuLy8gICAgIC8vIEluaXQgdG9nZ2xlIHRvb2xiYXJcclxuLy8gICAgIHZhciBpbml0VG9nZ2xlVG9vbGJhciA9ICgpID0+IHtcclxuLy8gICAgICAgICAvLyBUb2dnbGUgc2VsZWN0ZWQgYWN0aW9uIHRvb2xiYXJcclxuLy8gICAgICAgICAvLyBTZWxlY3QgYWxsIGNoZWNrYm94ZXNcclxuLy8gICAgICAgICBjb25zdCBjaGVja2JveGVzID0gdGFibGUucXVlcnlTZWxlY3RvckFsbCgnW3R5cGU9XCJjaGVja2JveFwiXScpO1xyXG5cclxuLy8gICAgICAgICAvLyBTZWxlY3QgZWxlbWVudHNcclxuLy8gICAgICAgICB0b29sYmFyQmFzZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW12LXVzZXItdGFibGUtdG9vbGJhcj1cImJhc2VcIl0nKTtcclxuLy8gICAgICAgICB0b29sYmFyU2VsZWN0ZWQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi11c2VyLXRhYmxlLXRvb2xiYXI9XCJzZWxlY3RlZFwiXScpO1xyXG4vLyAgICAgICAgIHNlbGVjdGVkQ291bnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi11c2VyLXRhYmxlLXNlbGVjdD1cInNlbGVjdGVkX2NvdW50XCJdJyk7XHJcbi8vICAgICAgICAgY29uc3QgZGVsZXRlU2VsZWN0ZWQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1tdi11c2VyLXRhYmxlLXNlbGVjdD1cImRlbGV0ZV9zZWxlY3RlZFwiXScpO1xyXG5cclxuLy8gICAgICAgICAvLyBUb2dnbGUgZGVsZXRlIHNlbGVjdGVkIHRvb2xiYXJcclxuLy8gICAgICAgICBjaGVja2JveGVzLmZvckVhY2goYyA9PiB7XHJcbi8vICAgICAgICAgICAgIC8vIENoZWNrYm94IG9uIGNsaWNrIGV2ZW50XHJcbi8vICAgICAgICAgICAgIGMuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcbi8vICAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcclxuLy8gICAgICAgICAgICAgICAgICAgICB0b2dnbGVUb29sYmFycygpO1xyXG4vLyAgICAgICAgICAgICAgICAgfSwgNTApO1xyXG4vLyAgICAgICAgICAgICB9KTtcclxuLy8gICAgICAgICB9KTtcclxuXHJcbi8vICAgICAgICAgLy8gRGVsZXRlZCBzZWxlY3RlZCByb3dzXHJcbi8vICAgICAgICAgZGVsZXRlU2VsZWN0ZWQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcbi8vICAgICAgICAgICAgIC8vIFN3ZWV0QWxlcnQyIHBvcCB1cCAtLS0gb2ZmaWNpYWwgZG9jcyByZWZlcmVuY2U6IGh0dHBzOi8vc3dlZXRhbGVydDIuZ2l0aHViLmlvL1xyXG4vLyAgICAgICAgICAgICBTd2FsLmZpcmUoe1xyXG4vLyAgICAgICAgICAgICAgICAgdGV4dDogXCJBcmUgeW91IHN1cmUgeW91IHdhbnQgdG8gZGVsZXRlIHNlbGVjdGVkIGN1c3RvbWVycz9cIixcclxuLy8gICAgICAgICAgICAgICAgIGljb246IFwid2FybmluZ1wiLFxyXG4vLyAgICAgICAgICAgICAgICAgc2hvd0NhbmNlbEJ1dHRvbjogdHJ1ZSxcclxuLy8gICAgICAgICAgICAgICAgIGJ1dHRvbnNTdHlsaW5nOiBmYWxzZSxcclxuLy8gICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiBcIlllcywgZGVsZXRlIVwiLFxyXG4vLyAgICAgICAgICAgICAgICAgY2FuY2VsQnV0dG9uVGV4dDogXCJObywgY2FuY2VsXCIsXHJcbi8vICAgICAgICAgICAgICAgICBjdXN0b21DbGFzczoge1xyXG4vLyAgICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b246IFwiYnRuIGZ3LWJvbGQgYnRuLWRhbmdlclwiLFxyXG4vLyAgICAgICAgICAgICAgICAgICAgIGNhbmNlbEJ1dHRvbjogXCJidG4gZnctYm9sZCBidG4tYWN0aXZlLWxpZ2h0LXByaW1hcnlcIlxyXG4vLyAgICAgICAgICAgICAgICAgfVxyXG4vLyAgICAgICAgICAgICB9KS50aGVuKGZ1bmN0aW9uIChyZXN1bHQpIHtcclxuLy8gICAgICAgICAgICAgICAgIGlmIChyZXN1bHQudmFsdWUpIHtcclxuLy8gICAgICAgICAgICAgICAgICAgICBTd2FsLmZpcmUoe1xyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0OiBcIllvdSBoYXZlIGRlbGV0ZWQgYWxsIHNlbGVjdGVkIGN1c3RvbWVycyEuXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIGljb246IFwic3VjY2Vzc1wiLFxyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIGN1c3RvbUNsYXNzOiB7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uOiBcImJ0biBmdy1ib2xkIGJ0bi1wcmltYXJ5XCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICAgICAgICAgICAgICB9KS50aGVuKGZ1bmN0aW9uICgpIHtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgLy8gUmVtb3ZlIGFsbCBzZWxlY3RlZCBjdXN0b21lcnNcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgY2hlY2tib3hlcy5mb3JFYWNoKGMgPT4ge1xyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKGMuY2hlY2tlZCkge1xyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGRhdGF0YWJsZS5yb3coJChjLmNsb3Nlc3QoJ3Rib2R5IHRyJykpKS5yZW1vdmUoKS5kcmF3KCk7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgLy8gUmVtb3ZlIGhlYWRlciBjaGVja2VkIGJveFxyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICBjb25zdCBoZWFkZXJDaGVja2JveCA9IHRhYmxlLnF1ZXJ5U2VsZWN0b3JBbGwoJ1t0eXBlPVwiY2hlY2tib3hcIl0nKVswXTtcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgaGVhZGVyQ2hlY2tib3guY2hlY2tlZCA9IGZhbHNlO1xyXG4vLyAgICAgICAgICAgICAgICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKCkge1xyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICB0b2dnbGVUb29sYmFycygpOyAvLyBEZXRlY3QgY2hlY2tlZCBjaGVja2JveGVzXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIGluaXRUb2dnbGVUb29sYmFyKCk7IC8vIFJlLWluaXQgdG9vbGJhciB0byByZWNhbGN1bGF0ZSBjaGVja2JveGVzXHJcbi8vICAgICAgICAgICAgICAgICAgICAgfSk7XHJcbi8vICAgICAgICAgICAgICAgICB9IGVsc2UgaWYgKHJlc3VsdC5kaXNtaXNzID09PSAnY2FuY2VsJykge1xyXG4vLyAgICAgICAgICAgICAgICAgICAgIFN3YWwuZmlyZSh7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIHRleHQ6IFwiU2VsZWN0ZWQgY3VzdG9tZXJzIHdhcyBub3QgZGVsZXRlZC5cIixcclxuLy8gICAgICAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJlcnJvclwiLFxyXG4vLyAgICAgICAgICAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIGN1c3RvbUNsYXNzOiB7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uOiBcImJ0biBmdy1ib2xkIGJ0bi1wcmltYXJ5XCIsXHJcbi8vICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICAgICAgICAgICAgICB9KTtcclxuLy8gICAgICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICAgICAgfSk7XHJcbi8vICAgICAgICAgfSk7XHJcbi8vICAgICB9XHJcblxyXG4vLyAgICAgLy8gVG9nZ2xlIHRvb2xiYXJzXHJcbi8vICAgICBjb25zdCB0b2dnbGVUb29sYmFycyA9ICgpID0+IHtcclxuLy8gICAgICAgICAvLyBTZWxlY3QgcmVmcmVzaGVkIGNoZWNrYm94IERPTSBlbGVtZW50c1xyXG4vLyAgICAgICAgIGNvbnN0IGFsbENoZWNrYm94ZXMgPSB0YWJsZS5xdWVyeVNlbGVjdG9yQWxsKCd0Ym9keSBbdHlwZT1cImNoZWNrYm94XCJdJyk7XHJcblxyXG4vLyAgICAgICAgIC8vIERldGVjdCBjaGVja2JveGVzIHN0YXRlICYgY291bnRcclxuLy8gICAgICAgICBsZXQgY2hlY2tlZFN0YXRlID0gZmFsc2U7XHJcbi8vICAgICAgICAgbGV0IGNvdW50ID0gMDtcclxuXHJcbi8vICAgICAgICAgLy8gQ291bnQgY2hlY2tlZCBib3hlc1xyXG4vLyAgICAgICAgIGFsbENoZWNrYm94ZXMuZm9yRWFjaChjID0+IHtcclxuLy8gICAgICAgICAgICAgaWYgKGMuY2hlY2tlZCkge1xyXG4vLyAgICAgICAgICAgICAgICAgY2hlY2tlZFN0YXRlID0gdHJ1ZTtcclxuLy8gICAgICAgICAgICAgICAgIGNvdW50Kys7XHJcbi8vICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICB9KTtcclxuXHJcbi8vICAgICAgICAgLy8gVG9nZ2xlIHRvb2xiYXJzXHJcbi8vICAgICAgICAgaWYgKGNoZWNrZWRTdGF0ZSkge1xyXG4vLyAgICAgICAgICAgICBzZWxlY3RlZENvdW50LmlubmVySFRNTCA9IGNvdW50O1xyXG4vLyAgICAgICAgICAgICB0b29sYmFyQmFzZS5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcclxuLy8gICAgICAgICAgICAgdG9vbGJhclNlbGVjdGVkLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG4vLyAgICAgICAgIH0gZWxzZSB7XHJcbi8vICAgICAgICAgICAgIHRvb2xiYXJCYXNlLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG4vLyAgICAgICAgICAgICB0b29sYmFyU2VsZWN0ZWQuY2xhc3NMaXN0LmFkZCgnZC1ub25lJyk7XHJcbi8vICAgICAgICAgfVxyXG4vLyAgICAgfVxyXG5cclxuLy8gICAgIHJldHVybiB7XHJcbi8vICAgICAgICAgLy8gUHVibGljIGZ1bmN0aW9uc1xyXG4vLyAgICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuLy8gICAgICAgICAgICAgaWYgKCF0YWJsZSkge1xyXG4vLyAgICAgICAgICAgICAgICAgcmV0dXJuO1xyXG4vLyAgICAgICAgICAgICB9XHJcblxyXG4vLyAgICAgICAgICAgICAvLyBpbml0VXNlclRhYmxlKCk7XHJcbi8vICAgICAgICAgICAgIC8vIGluaXRUb2dnbGVUb29sYmFyKCk7XHJcbi8vICAgICAgICAgICAgIC8vIGhhbmRsZVNlYXJjaERhdGF0YWJsZSgpO1xyXG4vLyAgICAgICAgICAgICAvLyBoYW5kbGVSZXNldEZvcm0oKTtcclxuLy8gICAgICAgICAgICAgLy8gaGFuZGxlRGVsZXRlUm93cygpO1xyXG4vLyAgICAgICAgICAgICAvLyBoYW5kbGVGaWx0ZXJEYXRhdGFibGUoKTtcclxuXHJcbi8vICAgICAgICAgfVxyXG4vLyAgICAgfVxyXG4vLyB9KCk7XHJcblxyXG4vLyAvLyBPbiBkb2N1bWVudCByZWFkeVxyXG4vLyBNVlV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuLy8gICAgIE1WVXNlcnNMaXN0LmluaXQoKTtcclxuLy8gfSk7XHJcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2V4dGVuZGVkL2pzL2N1c3RvbS91c2VyLW1hbmFnZW1lbnQvdXNlcnMvbGlzdC90YWJsZS5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/extended/js/custom/user-management/users/list/table.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/extended/js/custom/user-management/users/list/table.js"]();
/******/ 	
/******/ })()
;