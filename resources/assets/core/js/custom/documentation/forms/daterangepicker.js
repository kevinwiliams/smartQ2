"use strict";

// Class definition
var MVFormsDaterangepickerDemos = function() {
    // Private functions
    var example1 = function(element) {
        $("#mv_daterangepicker_1").daterangepicker();
    }

    var example2 = function(element) {
        $("#mv_daterangepicker_2").daterangepicker({
            timePicker: true,
            startDate: moment().startOf("hour"),
            endDate: moment().startOf("hour").add(32, "hour"),
            locale: {
                format: "M/DD hh:mm A"
            }
        });
    }

    var example3 = function(element) {
        $("#mv_daterangepicker_3").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"),10)
            }, function(start, end, label) {
                var years = moment().diff(start, "years");
                alert("You are " + years + " years old!");
            }
        );
    }

    var example4 = function(element) {
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#mv_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#mv_daterangepicker_4").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            "Today": [moment(), moment()],
            "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        }, cb);

        cb(start, end);
    }

    var example5 = function(element) {
        $("#mv_daterangepicker_5").daterangepicker();
    }    

    return {
        // Public Functions
        init: function(element) {
            example1();
            example2();
            example3();
            example4();
            example5();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVFormsDaterangepickerDemos.init();
});
