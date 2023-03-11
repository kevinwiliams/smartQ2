"use strict";

// Class definition
var MVLayoutAside = function () {
    // Private variables
    var toggle;
    var aside;

    // Private functions
    var handleToggle = function () {
       var toggleObj = MVToggle.getInstance(toggle);

       // Add a class to prevent aside hover effect after toggle click
       toggleObj.on('mv.toggle.change', function() {
           aside.classList.add('animating');

           setTimeout(function() {
                aside.classList.remove('animating');
           }, 300);
       })
    }

    // Public methods
    return {
        init: function () {
            // Elements
            aside = document.querySelector('#mv_aside');
            toggle = document.querySelector('#mv_aside_toggle');

            if (!aside || !toggle) {
                return;
            }

            handleToggle();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVLayoutAside.init();
});