"use strict";

// Class definition
var KTActiveTokensList = function () {
    // Shared variables
    var datatable;
    var table;

    
 // Init add schedule modal
 var initTokensList = () => {

    //  console.log(table);
     // Init datatable --- more info on datatables: https://datatables.net/manual/
     $.noConflict();
    //datatable = $(table).DataTable();  
    datatable = $(table).DataTable({
        "info": false,
        'order': [],
        'columnDefs': [
            { orderable: false, targets: 1 }, // Disable ordering on column 1 (assigned)
            { orderable: false, targets: 3 }, // Disable ordering on column 3 (actions)
        ]
    });      

    
           
}
    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-token-table-filter="search"]');
        // console.log(filterSearch);
    //datatable = $(table).DataTable();  
        filterSearch.addEventListener('keyup', function (e) {
             datatable.search(e.target.value).draw();
        });
    }

    // Delete user
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-token-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get permission name
                const permissionName = parent.querySelectorAll('td')[0].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + permissionName + "?",
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
                            text: "You have deleted " + permissionName + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " was not deleted.",
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
            table = document.querySelector('#token-table');
            
            if (!table) {
                return;
            }

            initTokensList();
            handleSearchDatatable();
            // handleDeleteRows();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTActiveTokensList.init();
});