"use strict";

// Class definition
var MVFlotDemoBar = function () {
    // Private functions
    var exampleBar = function () {
        // horizontal bar chart:
		var data1 = [
			[10, 10],
			[20, 20],
			[30, 30],
			[40, 40],
			[50, 50],
            [60, 60],
            [70, 70],
            [80, 80],
            [90, 90],
            [100, 100],
		];

		var options = {
			colors: [MVUtil.getCssVariableValue('--bs-active-primary')],
			series: {
				bars: {
					show: true
				}
			},
			bars: {
				horizontal: true,
				barWidth: 6,
				lineWidth: 0, // in pixels
				shadowSize: 0,
				align: 'left'
			},
			grid: {
				tickColor: MVUtil.getCssVariableValue('--bs-light-dark'),
				borderColor: MVUtil.getCssVariableValue('--bs-light-dark'),
				borderWidth: 1
			}
		};

		$.plot($("#mv_docs_flot_bar"), [data1], options);
    }

    return {
        // Public Functions
        init: function () {
            exampleBar();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFlotDemoBar.init();
});
