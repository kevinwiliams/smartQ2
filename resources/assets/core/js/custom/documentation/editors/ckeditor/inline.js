"use strict";

// Class definition
var MVFormsCKEditorInline = function () {
    // Private functions
    var exampleInline = function () {
        InlineEditor
            .create(document.querySelector('#mv_docs_ckeditor_inline'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    }

    return {
        // Public Functions
        init: function () {
            exampleInline();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsCKEditorInline.init();
});
