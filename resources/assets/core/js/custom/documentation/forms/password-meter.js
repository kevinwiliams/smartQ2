"use strict";

// Class definition
var MVGeneralPasswordMeterDemos = function() {
    // Private functions
    var _showScore = function() {
        // Select show score button
        const showScoreButton = document.getElementById('mv_password_meter_example_show_score');  

        // Get password meter instance
        const passwordMeterElement = document.querySelector("#mv_password_meter_example");
        const passwordMeter = MVPasswordMeter.getInstance(passwordMeterElement);

        // Handle show score button click
        showScoreButton.addEventListener('click', e => {
            // Get password score
            const score = passwordMeter.getScore();

            // Show popup confirmation 
            Swal.fire({
                text: "Current Password Score: " + score,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        });
    }

    return {
        // Public Functions
        init: function() {
            _showScore();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVGeneralPasswordMeterDemos.init();
});
