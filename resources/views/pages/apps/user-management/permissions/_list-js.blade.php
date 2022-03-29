<script>
    // Class definition
    var MVUsersPermissionsList = function() {
        // Shared variables
        var datatable;
        var table;

        var handleEditRows = () => {
            const editButtons = document.querySelectorAll('[data-mv-permissions-action="edit"]');
            // console.log(editButtons);
            editButtons.forEach(d => {
                d.addEventListener('click', e => {
                    e.preventDefault();

                    var btn = $('#' + d.id);
                    var id = btn.data('id');
                    var name = btn.data('name');
                    console.log(name);
                    $('[name="permission_name"]').val(name);
                    $('[name="permission_id"]').val(id);

                    modal.show();
                })
            });
        }


        // Init add schedule modal
        var initPermissionsList = () => {  

            if ($.fn.dataTable.isDataTable(table)) {
                datatable = $(table).DataTable();
            } else {
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    "pageLength": 10,
                    "lengthChange": false,
                    'columnDefs': [{
                            orderable: false,
                            targets: 0
                        }, // Disable ordering on column 0 (checkbox)
                        {
                            orderable: false,
                            targets: 6
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            datatable.on('draw', function() {
                handleDeleteRows();
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-mv-permissions-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Delete user
        var handleDeleteRows = () => {
            // Select all delete buttons
            const deleteButtons = table.querySelectorAll('[data-mv-permissions-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get permission name
                    const permissionName = parent.querySelectorAll('td')[0].innerText;

                    var btn = $('#' + d.id);
                    var id = btn.data('id');

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
                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                url: '/apps/user-management/permissions/' + id,
                                type: 'delete',
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(data) {
                                    // document.location.href = '/apps/user-management/roles/list';
                                    Swal.fire({
                                        text: "You have deleted " + permissionName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        datatable.row($(parent)).remove().draw();
                                    });

                                }
                                // ,
                                // error: function(xhr, status, error){
                                //     var errorMessage = xhr.status + ': ' + xhr.statusText
                                //     alert('Error - ' + errorMessage);
                                // }
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
            init: function() {
                table = document.querySelector('#mv_permissions_table');

                if (!table) {
                    return;
                }

                initPermissionsList();
                handleSearchDatatable();
                handleDeleteRows();
                handleEditRows();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        setTimeout(() => {
            MVUsersPermissionsList.init();
        }, 1000);
    });
</script>