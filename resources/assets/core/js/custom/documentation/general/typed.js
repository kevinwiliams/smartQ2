"use strict";

// Class definition
var MVGeneralTypedJsDemos = function() {
    // Private functions
    var exampleBasic = function() {
        var typed = new Typed("#mv_typedjs_example_1", {
            strings: ["First sentence.", "Second sentence.", "Third sentense", "And some longer sentence"],
            typeSpeed: 30
        });
    }

    return {
        // Public Functions
        init: function() {
            exampleBasic();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVGeneralTypedJsDemos.init();
});
