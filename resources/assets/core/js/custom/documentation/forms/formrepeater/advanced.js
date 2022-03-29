"use strict";

// Class definition
var MVFormRepeaterAdvanced = function () {
    // Private functions
    var example1 = function () {
        $('#mv_docs_repeater_advanced').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();

                // Re-init select2
                $(this).find('[data-mv-repeater="select2"]').select2();

                // Re-init flatpickr
                $(this).find('[data-mv-repeater="datepicker"]').flatpickr();

                // Re-init tagify
                new Tagify(this.querySelector('[data-mv-repeater="tagify"]'));
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                // Init select
                $('[data-mv-repeater="select2"]').select2();

                // Init flatpickr
                $('[data-mv-repeater="datepicker"]').flatpickr();

                // Init Tagify
                new Tagify(document.querySelector('[data-mv-repeater="tagify"]'));
            }
        });        
    }

    return {
        // Public Functions
        init: function () {
            example1();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormRepeaterAdvanced.init();
});
