"use strict";

// Class definition
var KTTokenActions = function () {


    var handleDeleteRows = () => {
     
        var _table = document.querySelector('#token-table');
        const deleteButtons = _table.querySelectorAll('[data-kt-token-table-filter="delete_row"]');
        // console.log(deleteButtons);
        jQuery.noConflict();
        $.noConflict();
        
        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get token name
                const tokenNo = parent.querySelectorAll('td')[1].innerText;
                if(parent.querySelectorAll('input[name=token-id]').length)
                    var tokenID =  parent.querySelectorAll('input[name=token-id]')[0].value;
                else
                    var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");
                // alert(tokenID);

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

                        $.ajax({
                            url: '/admin/token/delete/'+ tokenID,
                            data:   {
                                _token: $("input[name=_token]").val() },
                                success: function (res) {
                                    Swal.fire({
                                        text: "You have deleted " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                    // var dt = $('#counter-table').DataTable();
                                    document.location.reload();
                                    // Remove current row
                                    // dt.row($(parent)).remove().draw();
                                    });
                                }
                        }).fail(function (jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: tokenNo + " was not deleted.<br>" + jqXHR.responseText + "<br>" + error,
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


    }

    var handleCompleteRows = () => {
     
        var _table = document.querySelector('#token-table');
        const completeButtons = _table.querySelectorAll('[data-kt-token-table-filter="complete_row"]');
        // console.log(completeButtons);
        jQuery.noConflict();
        $.noConflict();
        
        completeButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get token name
                const tokenNo = parent.querySelectorAll('td')[1].innerText;
                if(parent.querySelectorAll('input[name=token-id]').length)
                    var tokenID =  parent.querySelectorAll('input[name=token-id]')[0].value;
                else
                    var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");


                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to close " + tokenNo + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, mark as done!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url: '/admin/token/complete/'+ tokenID,
                            data:   {
                                _token: $("input[name=_token]").val() },
                                success: function (res) {
                                    Swal.fire({
                                        text: "You have closed " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                    // var dt = $('#counter-table').DataTable();
                                    document.location.reload();
                                    // Remove current row
                                    // dt.row($(parent)).remove().draw();
                                    });
                                }
                        }).fail(function (jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: tokenNo + " was not closed.<br>" + jqXHR.responseText + "<br>" + error,
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
                            text: tokenNo + " was not closed.",
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

    var handleCancelRows = () => {
     
        var _table = document.querySelector('#token-table');
        const cancelButtons = _table.querySelectorAll('[data-kt-token-table-filter="cancel_row"]');
        // console.log(cancelButtons);
        jQuery.noConflict();
        $.noConflict();
        
        cancelButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get token name
                const tokenNo = parent.querySelectorAll('td')[1].innerText;
                if(parent.querySelectorAll('input[name=token-id]').length)
                    var tokenID =  parent.querySelectorAll('input[name=token-id]')[0].value;
                else
                    var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");
                

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to cancel " + tokenNo + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel token!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url: '/admin/token/stoped/'+ tokenID,
                            data:   {
                                _token: $("input[name=_token]").val() },
                                success: function (res) {
                                    Swal.fire({
                                        text: "You have cancelled " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                    // var dt = $('#counter-table').DataTable();
                                    document.location.reload();
                                    // Remove current row
                                    // dt.row($(parent)).remove().draw();
                                    });
                                }
                        }).fail(function (jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: tokenNo + " was not cancelled.<br>" + jqXHR.responseText + "<br>" + error,
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
                            text: tokenNo + " was not cancelled.",
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

    var handleCheckInRows = () => {
     
        var _table = document.querySelector('#token-table');
        const checkInButtons = _table.querySelectorAll('[data-kt-token-table-filter="checkin_row"]');
        // console.log(checkInButtons);
        jQuery.noConflict();
        $.noConflict();
        
        checkInButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get token name
                const tokenNo = parent.querySelectorAll('td')[1].innerText;
                if(parent.querySelectorAll('input[name=token-id]').length)
                    var tokenID =  parent.querySelectorAll('input[name=token-id]')[0].value;
                else
                    var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");
                

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to check in " + tokenNo + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, check in!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url: '/admin/token/checkin/'+ tokenID,
                            data:   {
                                _token: $("input[name=_token]").val() },
                                success: function (res) {
                                    Swal.fire({
                                        text: "You have checked in " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                    // var dt = $('#counter-table').DataTable();
                                    document.location.reload();
                                    // Remove current row
                                    // dt.row($(parent)).remove().draw();
                                    });
                                }
                        }).fail(function (jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: tokenNo + " was not checked in.<br>" + jqXHR.responseText + "<br>" + error,
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
                            text: tokenNo + " was not checked in.",
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

    var handleRecallRows = () => {
     
        var _table = document.querySelector('#token-table');
        const recallButtons = _table.querySelectorAll('[data-kt-token-table-filter="recall_row"]');
        // console.log(recallButtons);
        jQuery.noConflict();
        $.noConflict();
        
        recallButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get token name
                const tokenNo = parent.querySelectorAll('td')[1].innerText;
                if(parent.querySelectorAll('input[name=token-id]').length)
                    var tokenID =  parent.querySelectorAll('input[name=token-id]')[0].value;
                else
                    var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");
                

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to recall " + tokenNo + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, call back!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url: '/admin/token/recall/'+ tokenID,
                            data:   {
                                _token: $("input[name=_token]").val() },
                                success: function (res) {
                                    Swal.fire({
                                        text: "You have recalled " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                    // var dt = $('#counter-table').DataTable();
                                    document.location.reload();
                                    // Remove current row
                                    // dt.row($(parent)).remove().draw();
                                    });
                                }
                        }).fail(function (jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: tokenNo + " was not recalled.<br>" + jqXHR.responseText + "<br>" + error,
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
                            text: tokenNo + " was not recalled.",
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

    var handleTransferRows = () => {
        
        // transfer token
		$('body').on('submit', '.transferFrm', function(e){
			e.preventDefault();
			
            $.ajax({
                url: $(this).attr('action'),
				type: $(this).attr('method'),
                dataType: 'json', 
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: false,  
				processData: false,
                data:   new FormData($(this)[0]),
                    success: function (res) {
                        console.log(res);
                        Swal.fire({
                            text: res.message + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            setTimeout(() => { window.location.reload() }, 1500);
                        });
                    }
            }).fail(function (jqXHR, textStatus, error) {
                // Handle error here
                Swal.fire({
                    text: "Error :" + error ,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                });
            });

		});

        var _table = document.querySelector('#token-table');
        const transferButtons = _table.querySelectorAll('[data-kt-token-table-filter="transfer_row"]');
        console.log(transferButtons);
        jQuery.noConflict();
        $.noConflict();
        
        transferButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();
                // $('[name=department_id]').val("0");
                // alert(window.location.pathname);
                // Select parent row
                const parent = e.target.closest('tr');
                if(parent.querySelectorAll('input[name=dept]').length)
                    var deptID =  parent.querySelectorAll('input[name=dept]')[0].value;
                else
                    var deptID =  parent.querySelectorAll('td')[2].getAttribute("id");
                console.log(deptID);
                
                if(parent.querySelectorAll('input[name=counter]').length)
                    var counterID =  parent.querySelectorAll('input[name=counter]')[0].value;
                else
                    var counterID =  parent.querySelectorAll('td')[3].getAttribute("id");

                console.log(counterID);

                if(parent.querySelectorAll('input[name=officer]').length)
                    var officerID =  parent.querySelectorAll('input[name=officer]')[0].value;
                else
                    var officerID =  parent.querySelectorAll('td')[4].getAttribute("id");

                console.log(officerID);

                // alert(deptID);
                // Get token name
                const tokenNo = parent.querySelectorAll('td')[1].innerText;
                if(parent.querySelectorAll('input[name=token-id]').length)
                    var tokenID =  parent.querySelectorAll('input[name=token-id]')[0].value;
                else
                    var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");

                console.log(tokenID);

               
                // alert(tokenID);
                $("input[name=id]").val(tokenID);
                $("input[name=department_id]").val(deptID);
                $("input[name=counter_id]").val(counterID);
                $("input[name=officer_id]").val(officerID);
                
            })
        });


    }

    return {
        // Public functions
        init: function () {
            handleDeleteRows();
            handleCompleteRows();
            handleCancelRows();
            handleCheckInRows();
            handleTransferRows();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {

    setTimeout(() => {
    KTTokenActions.init();
        
    }, 1000);
});