"use strict";

// Class definition
var KTUsersDeleteRole = function () {
    // Shared variables
    // const element = document.getElementById('kt_modal_add_role');
    // const form = element.querySelector('#kt_modal_add_role_form');
    // const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initDeleteRole = () => {



        // Delete button handler
        const deleteButtons = document.querySelectorAll('[data-kt-roles-action="delete"]');        
        deleteButtons.forEach(d => {
            d.addEventListener('click', e => {
                e.preventDefault();

                var btn = $('#' + d.id);                                
                var id = btn.data('id');

                Swal.fire({
                    text: "Are you sure you would like to delete?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {                        
                        $.ajax({
                            url: '/apps/user-management/roles/' + id,
                            type: 'delete',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data) { 

                                // Show popup confirmation 
                                Swal.fire({
                                    text: "Role has been successfully deleted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    // if (result.isConfirmed) {     
                                    document.location.href = '/apps/user-management/roles/list';
                                    
                                    // }
                                });
                            }
                            // ,
                            // error: function(xhr, status, error){
                            //     var errorMessage = xhr.status + ': ' + xhr.statusText
                            //     alert('Error - ' + errorMessage);
                            // }
                        });
                    }
                });
            });
        });
    }

    // Select all handler
    const handleSelectAll = () => {
        // Define variables
        const selectAll = form.querySelector('#kt_roles_select_all');
        const allCheckboxes = form.querySelectorAll('[type="checkbox"]');

        // Handle check state
        selectAll.addEventListener('change', e => {

            // Apply check state to all checkboxes
            allCheckboxes.forEach(c => {
                c.checked = e.target.checked;
            });
        });
    }

    return {
        // Public functions
        init: function () {
            initDeleteRole();
            // handleSelectAll();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersDeleteRole.init();
});
