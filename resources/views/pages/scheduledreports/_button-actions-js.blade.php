<script>
    // Class definition
    var MVTokenActions = function() {


        var handleDeleteRows = () => {

            var _table = document.querySelector('#scheduledreports-table');
            const deleteButtons = _table.querySelectorAll('[data-mv-scheduledreports-table-filter="delete_row"]');
            // console.log(deleteButtons);

            deleteButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[0].innerText;
                    if (parent.querySelectorAll('input[name=report-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=report-id]')[0].value;
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
                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                url: '/reports/scheduled/delete/' + tokenID,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have deleted " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        var dt = $('#scheduledreports-table').DataTable();
                                        dt.row($(parent)).remove().draw();
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
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

            var _table = document.querySelector('#scheduledreports-table');
            const completeButtons = _table.querySelectorAll('[data-mv-scheduledreports-table-filter="complete_row"]');
            // console.log(completeButtons);

            completeButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[1].innerText;
                    if (parent.querySelectorAll('input[name=token-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=token-id]')[0].value;
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
                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                url: '/token/complete/' + tokenID,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have closed " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        var dt = $('#scheduledreports-table').DataTable();
                                        dt.ajax.reload();
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
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

            var _table = document.querySelector('#scheduledreports-table');
            const cancelButtons = _table.querySelectorAll('[data-mv-scheduledreports-table-filter="cancel_row"]');
            // console.log(cancelButtons);

            cancelButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[1].innerText;
                    if (parent.querySelectorAll('input[name=token-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=token-id]')[0].value;
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
                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                url: '/token/stoped/' + tokenID,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have cancelled " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        var dt = $('#scheduledreports-table').DataTable();
                                        dt.ajax.reload();
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
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

            var _table = document.querySelector('#scheduledreports-table');
            const checkInButtons = _table.querySelectorAll('[data-mv-scheduledreports-table-filter="checkin_row"]');
            // console.log(checkInButtons);

            checkInButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[1].innerText;
                    if (parent.querySelectorAll('input[name=token-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=token-id]')[0].value;
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
                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                url: '/token/checkin/' + tokenID,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have checked in " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        var dt = $('#scheduledreports-table').DataTable();
                                        dt.ajax.reload();
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
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

            var _table = document.querySelector('#scheduledreports-table');
            const recallButtons = _table.querySelectorAll('[data-mv-scheduledreports-table-filter="recall_row"]');
            // console.log(recallButtons);

            recallButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[1].innerText;
                    if (parent.querySelectorAll('input[name=token-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=token-id]')[0].value;
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
                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                url: '/token/recall/' + tokenID,
                                data: {
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(res) {
                                    Swal.fire({
                                        text: "You have recalled " + tokenNo + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        var dt = $('#scheduledreports-table').DataTable();
                                        dt.ajax.reload();
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
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
            const element = document.getElementById('mv_modal_transfer_token');
            const form = element.querySelector('#mv_modal_transfer_token_form');
            const modal = new bootstrap.Modal(element);

            //fetch counters on department change
            $('#mv_modal_transfer_token_form select[name="department_id"]').on('change', function() {
                console.log(this.value);
                _counterDDL = $('#mv_modal_transfer_token_form select[name="counter_id"]');
                $.ajax({
                    url: '/location/counter/getCountersbyDept/' + this.value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        _counterDDL.children().remove();
                        //loop through response array
                        $.each(data, function() {
                            //create new option and add to select
                            var $opt = $('<option/>');
                            $opt.val(this.id);
                            $opt.text(this.name);
                            _counterDDL.append($opt);
                        });
                        _counterDDL.select2();
                        _counterDDL.trigger('change');
                    },
                    error: function(err) {
                        // alert('failed!');
                        console.log(err);
                    }
                });
            });

            //fetch officers on counter change
            $('#mv_modal_transfer_token_form select[name="counter_id"]').on('change', function() {
                console.log(this.value);
                _officerDDL = $('#mv_modal_transfer_token_form select[name="user_id"]');
                $.ajax({
                    url: '/location/getOfficersByCounter/' + this.value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        _officerDDL.children().remove();
                        //loop through response array
                        $.each(data, function() {
                            //create new option and add to select
                            var $opt = $('<option/>');
                            $opt.val(this.id);
                            $opt.text(this.full_name);
                            _officerDDL.append($opt);
                        });
                        _officerDDL.select2();
                    },
                    error: function(err) {
                        // alert('failed!');
                        console.log(err);
                    }
                });
            });


            // transfer token
            $('body').on('submit', '.transferFrm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    data: new FormData($(this)[0]),
                    success: function(res) {
                        // console.log(res);
                        Swal.fire({
                            text: res.message + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function() {
                            form.reset(); // Reset form			
                            modal.hide();
                            // Remove current row
                            var dt = $('#scheduledreports-table').DataTable();
                            dt.ajax.reload();
                        });
                    }
                }).fail(function(jqXHR, textStatus, error) {
                    // Handle error here
                    Swal.fire({
                        text: "Error :" + error,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                });

            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-mv-transfer-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

            // Close button handler
            const closeButton = element.querySelector('[data-mv-transfer-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

            var _table = document.querySelector('#scheduledreports-table');
            const transferButtons = _table.querySelectorAll('[data-mv-scheduledreports-table-filter="transfer_row"]');
            // console.log(transferButtons);

            transferButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Select parent row
                    const parent = e.target.closest('tr');
                    if (parent.querySelectorAll('input[name=dept]').length)
                        var deptID = parent.querySelectorAll('input[name=dept]')[0].value;
                    else
                        var deptID = parent.querySelectorAll('td')[2].getAttribute("id");
                    // console.log(deptID);

                    if (parent.querySelectorAll('input[name=counter]').length)
                        var counterID = parent.querySelectorAll('input[name=counter]')[0].value;
                    else
                        var counterID = parent.querySelectorAll('td')[3].getAttribute("id");

                    // console.log(counterID);

                    if (parent.querySelectorAll('input[name=officer]').length)
                        var officerID = parent.querySelectorAll('input[name=officer]')[0].value;
                    else
                        var officerID = parent.querySelectorAll('td')[4].getAttribute("id");

                    // console.log(officerID);

                    // alert(deptID);
                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[1].innerText;
                    // console.log(tokenNo);
                    if (parent.querySelectorAll('input[name=token-id]').length) {
                        var tokenID = parent.querySelectorAll('input[name=token-id]')[0].value;
                        var isVIP = parent.querySelectorAll('input[name=token-id]')[0].getAttribute('data-vip');
                        var note = parent.querySelectorAll('input[name=notes]')[0].getAttribute('value');
                        var officerNote = parent.querySelectorAll('input[name=off_notes]')[0].getAttribute('value');
                    } else {
                        var tokenID = parent.querySelectorAll('td')[1].getAttribute("id");
                        var isVIP = parent.querySelectorAll('td')[1].querySelectorAll('.badge')[0].getAttribute('data-vip');
                        var note = parent.querySelectorAll('td')[1].querySelectorAll('[name=notes]')[0].getAttribute('value');
                        var officerNote = parent.querySelectorAll('td')[1].querySelectorAll('[name=off_notes]')[0].getAttribute('value');
                    }

                    $("input[name=id]").val(tokenID);
                    $("input[name=departmentID]").val(deptID);
                    $("input[name=counterID]").val(counterID);
                    $("input[name=officerID]").val(officerID);
                    $("input[name=isVIP]").val(isVIP);
                    $("input[name=cNotes]").val(note);
                    $("input[name=oNotes]").val(officerNote);

                })
            });


        }

        var handleHistoryRows = () => {
            const element = document.getElementById('mv_modal_scheduledreports_history');
            // const form = element.querySelector('#mv_modal_scheduledreports_history_form');
            const modal = new bootstrap.Modal(element);


            // modal open with token id
            $('#mv_modal_scheduledreports_history').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var scheduleid = button.data('scheduledreport-id');
                var repItem = $('#mv-repeater-item');
                var content = $('#mv-repeater-content');
                content.html('')
                $.ajax({
                    url: '/reports/scheduled/history/' + scheduleid,
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(res) {

                        var cntr = 1;
                        res.data.forEach(element => {
                            var _clone = repItem.clone();
                            _clone.removeAttr("id");
                            var name = _clone.find("#mv-repeater-date");
                            name.text("Run date: " + element.executed_time);

                            var notified = _clone.find("#mv-repeater-notified");


                            _clone.css('display', 'inline-block');

                            // bg-light-success
                            if (element.success == 1) {
                                _clone.addClass('bg-light-success');
                                notified.text("Notified: " + element.notified);
                            } else {
                                _clone.addClass('bg-light-danger');
                                notified.text("Error: " + element.response);
                            }

                            content.append(_clone);
                            cntr++;
                        });
                    }
                }).fail(function(jqXHR, textStatus, error) {
                    // Handle error here
                    console.log(jqXHR.responseText);
                    console.log(error);
                });
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-mv-scheduledreports-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        // form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

            // Close button handler
            const closeButton = element.querySelector('[data-mv-scheduledreports-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        // form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

        }

        var handleScheduleRows = () => {
            const element = document.getElementById('mv_modal_scheduledreports_schedule');
            // const form = element.querySelector('#mv_modal_scheduledreports_history_form');
            const modal = new bootstrap.Modal(element);


            // modal open with token id
            $('#mv_modal_scheduledreports_schedule').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var scheduleid = button.data('scheduledreport-id');
                // alert(scheduleid);
                // return;
                //ajax call for history		
                var repItem = $('#mv-schedulerepeater-item');
                var content = $('#mv-schedulerepeater-content');
                content.html('')
                $.ajax({
                    url: '/reports/scheduled/schedule/' + scheduleid,
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(res) {
                        var cntr = 1;
                        res.data.forEach(element => {
                            var _clone = repItem.clone();
                            _clone.removeAttr("id");
                            var name = _clone.find("#mv-repeater-date");
                            name.text("Run date: " + element.run_time);

                            // var notified = _clone.find("#mv-repeater-notified");


                            _clone.css('display', 'inline-block');


                            if (cntr == 1) {
                                _clone.addClass('bg-light-info');
                                // notified.text("Notify: ");
                            } else {
                                _clone.addClass('bg-light-primary');
                                // notified.text("Notify: ");
                            }

                            content.append(_clone);
                            cntr++;
                        });
                    }
                }).fail(function(jqXHR, textStatus, error) {
                    // Handle error here
                    console.log(jqXHR.responseText);
                    console.log(error);
                });
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-mv-scheduledreports-schedule-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        // form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

            // Close button handler
            const closeButton = element.querySelector('[data-mv-scheduledreports-schedule-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        // form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

        }


        var handlePrintRows = () => {

            var _table = document.querySelector('#scheduledreports-table');
            const printButtons = _table.querySelectorAll('[data-mv-scheduledreports-table-filter="print_row"]');

            printButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get token name
                    const tokenNo = parent.querySelectorAll('td')[0].innerText;
                    if (parent.querySelectorAll('input[name=token-id]').length)
                        var tokenID = parent.querySelectorAll('input[name=token-id]')[0].value;
                    else
                        var tokenID = parent.querySelectorAll('td')[0].getAttribute("id");

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to Print " + tokenNo + "?",
                        icon: "info",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, print!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-success",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            console.log($(d).attr('href') + '/' + $(d).attr('data-token-id'));
                            url = $(d).attr('href') + '/' + $(d).attr('data-token-id');
                            window.open(url, '_blank');

                            return;
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: tokenNo + " was not printed.",
                                icon: "warning",
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
                handleDeleteRows();
                handleHistoryRows();
                handleScheduleRows();
                // handleCompleteRows();
                // handleCancelRows();
                // handleCheckInRows();
                // handleTransferRows();
                // handleRecallRows();
                // handlePrintRows();
            }
        };
    }();

    // On document ready
    MVUtil.onDOMContentLoaded(function() {

        setTimeout(() => {
            //MVTokenActions.init();

        }, 1000);
    });
</script>