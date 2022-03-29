<script>
// Class definition
var MVTokenActions = function () {


var handleDeleteRows = () => {
 
    var _table = document.querySelector('#token-table');
    const deleteButtons = _table.querySelectorAll('[data-mv-token-table-filter="delete_row"]');
    // console.log(deleteButtons);
    
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
                                    // Remove current row
                                    var dt = $('#token-table').DataTable();
                                    dt.row($(parent)).remove().draw();
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
    const completeButtons = _table.querySelectorAll('[data-mv-token-table-filter="complete_row"]');
    // console.log(completeButtons);
    
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
                                    // Remove current row
                                    var dt = $('#token-table').DataTable();
                                    dt.ajax.reload();
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
    const cancelButtons = _table.querySelectorAll('[data-mv-token-table-filter="cancel_row"]');
    // console.log(cancelButtons);
    
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
                                // Remove current row
                                var dt = $('#token-table').DataTable();
                                    dt.ajax.reload();
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
    const checkInButtons = _table.querySelectorAll('[data-mv-token-table-filter="checkin_row"]');
    // console.log(checkInButtons);
    
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
                                    // Remove current row
                                    var dt = $('#token-table').DataTable();
                                        dt.ajax.reload();
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
    const recallButtons = _table.querySelectorAll('[data-mv-token-table-filter="recall_row"]');
    // console.log(recallButtons);
    
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
                                // Remove current row
                                var dt = $('#token-table').DataTable();
                                    dt.ajax.reload();
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
                    // console.log(res);
                    Swal.fire({
                        text: res.message + "!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        // Remove current row
                        var dt = $('#token-table').DataTable();
                                    dt.ajax.reload();;
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
    const transferButtons = _table.querySelectorAll('[data-mv-token-table-filter="transfer_row"]');
    // console.log(transferButtons);
    
    transferButtons.forEach(d => {
        // Delete button on click
        d.addEventListener('click', function (e) {
            e.preventDefault();
            // Select parent row
            const parent = e.target.closest('tr');
            if(parent.querySelectorAll('input[name=dept]').length)
                var deptID =  parent.querySelectorAll('input[name=dept]')[0].value;
            else
                var deptID =  parent.querySelectorAll('td')[2].getAttribute("id");
            // console.log(deptID);
            
            if(parent.querySelectorAll('input[name=counter]').length)
                var counterID =  parent.querySelectorAll('input[name=counter]')[0].value;
            else
                var counterID =  parent.querySelectorAll('td')[3].getAttribute("id");

            // console.log(counterID);

            if(parent.querySelectorAll('input[name=officer]').length)
                var officerID =  parent.querySelectorAll('input[name=officer]')[0].value;
            else
                var officerID =  parent.querySelectorAll('td')[4].getAttribute("id");

            // console.log(officerID);

            // alert(deptID);
            // Get token name
            const tokenNo = parent.querySelectorAll('td')[1].innerText;
            // console.log(tokenNo);
            if(parent.querySelectorAll('input[name=token-id]').length){
                var tokenID =  parent.querySelectorAll('input[name=token-id]')[0].value;
                var isVIP = parent.querySelectorAll('input[name=token-id]')[0].getAttribute('data-vip');
                var note =  parent.querySelectorAll('input[name=notes]')[0].getAttribute('value');
            } else {
                var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");
                var isVIP = parent.querySelectorAll('td')[1].querySelectorAll('.badge')[0].getAttribute('data-vip');
                var note = parent.querySelectorAll('td')[1].querySelectorAll('[name=notes]')[0].getAttribute('value');
            }
           
            $("input[name=id]").val(tokenID);
            $("input[name=departmentID]").val(deptID);
            $("input[name=counterID]").val(counterID);
            $("input[name=officerID]").val(officerID);
            $("input[name=isVIP").val(isVIP);
            $("input[name=cNotes").val(note);
            
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
        handleRecallRows();
    }
};
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {

setTimeout(() => {
    //MVTokenActions.init();
    
}, 1000);
});
</script>