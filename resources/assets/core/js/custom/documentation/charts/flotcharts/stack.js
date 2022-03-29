"use strict";

// Class definition
var MVFlotDemoStack = function () {
    // Private functions
    var exampleStack = function () {
        var d1 = [];
		for (var i = 0; i <= 10; i += 1)
			d1.push([i, parseInt(Math.random() * 30)]);

		var d2 = [];
		for (var i = 0; i <= 10; i += 1)
			d2.push([i, parseInt(Math.random() * 30)]);

		var d3 = [];
		for (var i = 0; i <= 10; i += 1)
			d3.push([i, parseInt(Math.random() * 30)]);

		var stack = 0,
			bars = true,
			lines = false,
			steps = false;

		function plotWithOptions() {
			$.plot($("#mv_docs_flot_stack"),

				[{
					label: "sales",
					data: d1,
					lines: {
						lineWidth: 1,
					},
					shadowSize: 0
				}, {
					label: "tax",
					data: d2,
					lines: {
						lineWidth: 1,
					},
					shadowSize: 0
				}, {
					label: "profit",
					data: d3,
					lines: {
						lineWidth: 1,
					},
					shadowSize: 0
				}], {
					colors: [MVUtil.getCssVariableValue('--bs-active-danger'), MVUtil.getCssVariableValue('--bs-active-primary')],
					series: {
						stack: stack,
						lines: {
							show: lines,
							fill: true,
							steps: steps,
							lineWidth: 0, // in pixels
						},
						bars: {
							show: bars,
							barWidth: 0.5,
							lineWidth: 0, // in pixels
							shadowSize: 0,
							align: 'center'
						}
					},
					grid: {
						tickColor: MVUtil.getCssVariableValue('--bs-light-dark'),
						borderColor: MVUtil.getCssVariableValue('--bs-light-dark'),
						borderWidth: 1
					}
				}
			);
		}

		$(".stackControls input").click(function(e) {
			e.preventDefault();
			stack = $(this).val() == "With stacking" ? true : null;
			plotWithOptions();
		});

		$(".graphControls input").click(function(e) {
			e.preventDefault();
			bars = $(this).val().indexOf("Bars") != -1;
			lines = $(this).val().indexOf("Lines") != -1;
			steps = $(this).val().indexOf("steps") != -1;
			plotWithOptions();
		});

		plotWithOptions();
    }

    return {
        // Public Functions
        init: function () {
            exampleStack();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFlotDemoStack.init();
});
