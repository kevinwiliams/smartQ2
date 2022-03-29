"use strict";

// Class definition
var MVFormsQuillBasic = function() {
    // Private functions
    var exampleBasic = function() {
        var quill = new Quill('#mv_docs_quill_basic', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
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
    MVFormsQuillBasic.init();
});
