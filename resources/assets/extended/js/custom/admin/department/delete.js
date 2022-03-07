// "use strict";

// // Class definition
// var KTTokenDeleteDept = function () {


    var handleDeleteRows = () => {
        // Select all delete buttons
        // vartable = 
        var table = document.querySelector('#department-table');
        const deleteButtons = table.querySelectorAll('[data-kt-dept-table-filter="delete_row"]');
        // console.log(deleteButtons);
        var datatable = $('#department-table').DataTable();
        deleteButtons.forEach(d => {
        console.log(d);

            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get token name
                const deptName = parent.querySelectorAll('td')[1].innerText;
                const deptID = parent.querySelectorAll('td')[0].innerText;


                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + deptName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + deptName + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            $.ajax({
                                url: '/admin/department/delete/'+ deptID,
                                data:   {
                                    _token: $("input[name=_token]").val() },
                                    success: function (res) {
                                        // Remove current row
                                        datatable.row($(parent)).remove().draw();
                                    }
                            });
                            
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: deptName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });


    }

//     return {
//         // Public functions
//         init: function () {
//             handleDeleteRows();
//         }
//     };
// }();

// // On document ready
// KTUtil.onDOMContentLoaded(function () {
//     // KTTokenDeleteDept.init();
// });