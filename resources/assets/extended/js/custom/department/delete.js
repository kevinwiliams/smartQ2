"use strict";

// Class definition
var MVTokenDeleteDept = function () {


    var handleDeleteRows = () => {
        // Select all delete buttons
        // vartable = 
        // console.log(table);
        // var dt = table;
        var _table = document.querySelector('#department-table');
        const deleteButtons = _table.querySelectorAll('[data-mv-dept-table-filter="delete_row"]');
        // console.log(deleteButtons);
        jQuery.noConflict();
        $.noConflict();

        // console.log($('#department-table'));

        
        deleteButtons.forEach(d => {
        // console.log(d);

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
                        $.ajax({
                            url: '/location/department/delete/'+ deptID,
                            data:   {
                                _token: $("input[name=_token]").val() },
                                success: function (res) {
                                    Swal.fire({
                                        text: "You have deleted " + deptName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        // var dt = $('#department-table').DataTable();
                                        document.location.href = '/location/department/'+ deptID;
                                        // Remove current row
                                        // dt.row($(parent)).remove().draw();
                                    });
                                    
                                }
                        }).fail(function (jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: deptName + " was not deleted.<br>" + jqXHR.responseText + "<br>" + error,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
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

    return {
        // Public functions
        init: function () {
            handleDeleteRows();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {

    setTimeout(() => {
    // var dt = $('#department-table').DataTable();
    // console.log(table);
    MVTokenDeleteDept.init();
        
    }, 1000);
});