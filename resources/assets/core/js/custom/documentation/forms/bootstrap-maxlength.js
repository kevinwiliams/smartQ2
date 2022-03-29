"use strict";

// Class definition
var MVFormsMaxlengthDemos = function () {
    // Private functions
    var exampleBasic = function () {
        // minimum setup
        $('#mv_docs_maxlength_basic').maxlength({
            warningClass: "badge badge-primary",
            limitReachedClass: "badge badge-success"
        });
    }

    var exampleThreshold = function () {
        // Threshold setup
        $('#mv_docs_maxlength_threshold').maxlength({
            threshold: 20,
            warningClass: "badge badge-primary",
            limitReachedClass: "badge badge-success"
        });
    }

    var exampleAlwaysShow = function () {
        // Always show setup
        $('#mv_docs_maxlength_always_show').maxlength({
            alwaysShow: true,
            threshold: 20,
            warningClass: "badge badge-danger",
            limitReachedClass: "badge badge-info"
        });
    }

    var exampleCustomText = function () {
        // Always show setup
        $('#mv_docs_maxlength_custom_text').maxlength({
            threshold: 20,
            warningClass: "badge badge-danger",
            limitReachedClass: "badge badge-success",
            separator: ' of ',
            preText: 'You have ',
            postText: ' chars remaining.',
            validate: true
        });
    }

    var exampleTextarea = function () {
        // Textarea setup
        $('#mv_docs_maxlength_textarea').maxlength({
            warningClass: "badge badge-primary",
            limitReachedClass: "badge badge-success"
        });
    }

    var examplePosition = function () {
        // Position setup
        $('#mv_docs_maxlength_position_top_left').maxlength({
            placement: 'top-left',
            warningClass: "badge badge-danger",
            limitReachedClass: "badge badge-primary"
        });

        $('#mv_docs_maxlength_position_top_right').maxlength({
            placement: 'top-right',
            warningClass: "badge badge-success",
            limitReachedClass: "badge badge-danger"
        });

        $('#mv_docs_maxlength_position_bottom_left').maxlength({
            placement: 'bottom-left',
            warningClass: "badge badge-info",
            limitReachedClass: "badge badge-warning"
        });

        $('#mv_docs_maxlength_position_bottom_right').maxlength({
            placement: 'bottom-right',
            warningClass: "badge badge-primary",
            limitReachedClass: "badge badge-success"
        });
    }

    return {
        // Public Functions
        init: function () {
            exampleBasic();
            exampleThreshold();
            exampleAlwaysShow();
            exampleCustomText();
            exampleTextarea();
            examplePosition();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsMaxlengthDemos.init();
});
