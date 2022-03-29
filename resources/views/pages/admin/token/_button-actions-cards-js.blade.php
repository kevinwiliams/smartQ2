<script>
// Class definition
var MVTokenActions = function () {
    var handleDeleteRows = () => {
 
        var _table = document.querySelector('#token-cards');
        const deleteButtons = _table.querySelectorAll('[data-mv-token-cards-filter="delete_item"]');
        //console.log(deleteButtons);
        
        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();
                console.log(e.target.dataset);
                
                var tokenID  = e.target.dataset.id;
                var tokenNo  = e.target.dataset.tokenNumber;
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
                                        location.reload(true);
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

    var handleCancelRows = () => {

        var _table = document.querySelector('#token-cards');
        const cancelButtons = _table.querySelectorAll('[data-mv-token-cards-filter="cancel_item"]');
        // console.log(cancelButtons);

        cancelButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                console.log(e.target.dataset);
                    
                var tokenID  = e.target.dataset.id;
                var tokenNo  = e.target.dataset.tokenNumber;
                

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
                                        location.reload(true);
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


    var handleCompleteRows = () => {

        var _table = document.querySelector('#token-cards');
        const completeButtons = _table.querySelectorAll('[data-mv-token-cards-filter="complete_item"]');
        console.log(completeButtons);
        
        completeButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                console.log(e.target.dataset);
                    
                var tokenID  = e.target.dataset.id;
                var tokenNo  = e.target.dataset.tokenNumber;


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
                                        location.reload(true);
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

    

    return {
        // Public functions
        init: function () {
            handleDeleteRows();
            handleCompleteRows();
            handleCancelRows();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {

setTimeout(() => {
    MVTokenActions.init();
    
}, 1000);
});

</script>