"use strict";

// Class definition
var MVFormsGoogleRecaptchaDemos = function () {
    // Private functions
    var example = function (element) {
        document.querySelector("#mv_form_submit_button").addEventListener("click", function (e) {
            e.preventDefault();

            grecaptcha.ready(function () {
                if (grecaptcha.getResponse() === "") {
                    alert("Please validate the Google reCaptcha.");
                } else {
                    alert("Successful validation! Now you can submit this form to your server side processing.");
                }
            });
        });
    }

    return {
        // Public Functions
        init: function (element) {
            example();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsGoogleRecaptchaDemos.init();
});
