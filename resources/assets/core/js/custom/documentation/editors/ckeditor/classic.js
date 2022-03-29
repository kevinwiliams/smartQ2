"use strict";

// Class definition
var MVFormsCKEditorClassic = function () {
    // Private functions
    var exampleClassic = function () {
        ClassicEditor
            .create(document.querySelector('#mv_docs_ckeditor_classic'))
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
            exampleClassic();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsCKEditorClassic.init();
});
