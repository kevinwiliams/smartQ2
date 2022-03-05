// Delete user
// var handleDeleteRows = (datatable) => {
    // Select all delete buttons
    // vartable = 
    table = document.querySelector('#token-table');
    const deleteButtons = table.querySelectorAll('[data-kt-token-table-filter="delete_row"]');
    console.log(deleteButtons);
    //var datatable = $('#token-table').DataTable();
    deleteButtons.forEach(d => {
    console.log(d);

        // Delete button on click
        d.addEventListener('click', function (e) {
            e.preventDefault();

            // Select parent row
            const parent = e.target.closest('tr');

            // Get token name
            const tokenNo = parent.querySelectorAll('td')[1].innerText;

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete " + tokenNo + "?",
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
                        text: "You have deleted " + tokenNo + "!.",
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
                        text: tokenNo + " was not deleted.",
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
// }