"use strict";

// Class definition
var MVFormsDialerDemos = function() {
    // Private functions
    var example1 = function(element) {
        // Dialer container element
        var dialerElement = document.querySelector("#mv_dialer_example_1");

        // Create dialer object and initialize a new instance
        var dialerObject = new MVDialer(dialerElement, {
            min: 1000,
            max: 50000,
            step: 1000,
            prefix: "$",
            decimals: 2
        });
    }

    return {
        // Public Functions
        init: function(element) {
            example1();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVFormsDialerDemos.init();
});
