"use strict";

// Class definition
var MVFlotDemoPie = function () {
    // Private functions
    var examplePie = function () {
        var data = [
            { label: "CSS", data: 10, color: MVUtil.getCssVariableValue('--bs-active-primary') },
            { label: "HTML5", data: 40, color: MVUtil.getCssVariableValue('--bs-active-success') },
            { label: "PHP", data: 30, color: MVUtil.getCssVariableValue('--bs-active-danger') },
            { label: "Angular", data: 20, color: MVUtil.getCssVariableValue('--bs-active-warning') }
        ];

        $.plot($("#mv_docs_flot_pie"), data, {
            series: {
                pie: {
                    show: true
                }
            }
        });
    }

    return {
        // Public Functions
        init: function () {
            examplePie();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFlotDemoPie.init();
});
