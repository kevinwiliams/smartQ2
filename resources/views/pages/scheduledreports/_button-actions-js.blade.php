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
                            var next = moment(element.run_time);                            

                            name.text(next.format("dddd, MMMM Do YYYY, h:mm a"));

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
                        var schedule = res.schedule;
                        var scheduleinfo = JSON.parse(schedule.schedule_info);
                        console.log(schedule);
                        console.log(scheduleinfo);
                        var start_date = moment(schedule.start_date);
                        var end_date = moment(scheduleinfo.end_date);
                        
                        var htmlstring = "<table style='width:100%'>";
                        htmlstring += "<tr><td><span class='text-muted fw-semibold'>Type: </span></td><td><span class='fw-bold fs-6 text-capitalize'>" + schedule.schedule_type + "</span></td></tr>";
                        htmlstring += "<tr><td><span class='text-muted fw-semibold'>Starts: </span></td><td><span class='fw-bold fs-6'>" + start_date.format("dddd, MMMM Do YYYY, h:mm a") + "</span></td></tr>";
                        
                        switch (schedule.schedule_type) {
                            case 'daily':
                                htmlstring += "<tr><td><span class='text-muted fw-semibold'>Until: </span></td><td><span class='fw-bold fs-6'>" + end_date.format("dddd, MMMM Do YYYY") + "</span></td></tr>";
                                htmlstring += "<tr><td><span class='text-muted fw-semibold'>Recurs every: </span></td><td><span class='fw-bold fs-6'>" + scheduleinfo.recurs + " day(s)</span></td></tr>";
                                break;
                            case 'weekly':
                                htmlstring += "<tr><td><span class='text-muted fw-semibold'>Until: </span></td><td><span class='fw-bold fs-6'>" + end_date.format("dddd, MMMM Do YYYY") + "</span></td></tr>";
                                htmlstring += "<tr><td><span class='text-muted fw-semibold'>Recurs every: </span></td><td><span class='fw-bold fs-6'>" + scheduleinfo.recurs + " week(s)</span></td></tr>";
                                var _days = scheduleinfo.weekdays;
                                htmlstring += "<tr><td><span class='text-muted fw-semibold'>on: </span></td><td><span class='fw-bold fs-6'>" + _days.toString().replaceAll(',', ', ') + "</span></td></tr>";
                                break;
                            case 'monthly':
                                htmlstring += "<tr><td><span class='text-muted fw-semibold'>Until: </span></td><td><span class='fw-bold fs-6'>" + end_date.format("dddd, MMMM Do YYYY") + "</span></td></tr>";
                                var _months = scheduleinfo.months;
                                htmlstring += "<tr><td><span class='text-muted fw-semibold'>Months: </span></td><td><span class='fw-bold fs-6'>" + _months.toString().replaceAll(',', ', ') + "</span></td></tr>";
                                if (scheduleinfo.months_on == "ordinals") {
                                    var _ordinals = scheduleinfo.ordinal;
                                    htmlstring += "<tr><td><span class='text-muted fw-semibold'>Every: </span></td><td><span class='fw-bold fs-6'>" + _ordinals.toString().replaceAll(',', ', ') + "</span></td></tr>";
                                    var _weekday = scheduleinfo.weekday;
                                    htmlstring += "<tr><td><span class='text-muted fw-semibold'>Weekday: </span></td><td><span class='fw-bold fs-6'>" + _weekday.toString().replaceAll(',', ', ') + "</span></td></tr>";
                                } else {
                                    var _days = scheduleinfo.months_days;
                                    htmlstring += "<tr><td><span class='text-muted fw-semibold'>on: </span></td><td><span class='fw-bold fs-6'>" + _days.toString().replaceAll(',', ', ') + "</span></td></tr>";
                                }
                                // var _days = scheduleinfo.weekdays;
                                // htmlstring += "<tr><td>on: </td><td>" + _days.toString().replaceAll(',', ', ') + "</td></tr>";
                                break;
                            default:
                                break;
                        }
                        htmlstring += "<tr><td><span class='text-muted fw-semibold'>Notifies: </span></td><td><span class='fw-bold fs-6'>" + schedule.email_to.replaceAll(',', ', ') + "</span></td></tr>";
                        htmlstring += "</table><br />";


                        var schedulediv = $("#mv_schedulerepeaterinfo_schedule");
                        schedulediv.html('');
                        schedulediv.html(htmlstring);

                        var cntr = 1;
                        res.data.forEach(element => {
                            var _clone = repItem.clone();
                            _clone.removeAttr("id");
                            var name = _clone.find("#mv-repeater-date");
                            var next = moment(element.run_time);
                            name.text(next.format("dddd, MMMM Do YYYY, h:mm a"));

                            var notified = _clone.find("#mv-repeater-notified");


                            _clone.css('display', 'inline-block');


                            if (cntr == 1) {
                                _clone.addClass('bg-light-info');
                                notified.text("Next Run");
                            } else {
                                _clone.addClass('bg-light-primary');
                                notified.hide();
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

        return {
            // Public functions
            init: function() {
                handleDeleteRows();
                handleHistoryRows();
                handleScheduleRows();
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