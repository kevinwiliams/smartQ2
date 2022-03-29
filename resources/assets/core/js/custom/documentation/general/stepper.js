"use strict";

// Class definition
var MVGeneralStepperDemos = function() {
    // Private functions
    var _exampleBasic = function() {
        // Stepper lement
        var element = document.querySelector("#mv_stepper_example_basic");

        // Initialize Stepper
		var stepper = new MVStepper(element);

        // Handle next step
		stepper.on("mv.stepper.next", function (stepper) {
			stepper.goNext(); // go next step
		});

		// Handle previous step
		stepper.on("mv.stepper.previous", function (stepper) {
			stepper.goPrevious(); // go previous step
		});
    }

    var _exampleVertical = function() {
        // Stepper lement
        var element = document.querySelector("#mv_stepper_example_vertical");

        // Initialize Stepper
		var stepper = new MVStepper(element);

        // Handle next step
		stepper.on("mv.stepper.next", function (stepper) {
			stepper.goNext(); // go next step
		});

		// Handle previous step
		stepper.on("mv.stepper.previous", function (stepper) {
			stepper.goPrevious(); // go previous step
		});
    }

    var _exampleClickable = function() {
        // Stepper lement
        var element = document.querySelector("#mv_stepper_example_clickable");

        // Initialize Stepper
		var stepper = new MVStepper(element);

        // Handle navigation click
		stepper.on("mv.stepper.click", function (stepper) {
			stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step
		});

        // Handle next step
		stepper.on("mv.stepper.next", function (stepper) {
			stepper.goNext(); // go next step
		});

		// Handle previous step
		stepper.on("mv.stepper.previous", function (stepper) {
			stepper.goPrevious(); // go previous step
		});
    }

    return {
        // Public Functions
        init: function() {
            _exampleBasic();
            _exampleVertical();
            _exampleClickable();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVGeneralStepperDemos.init();
});
