"use strict";

// Class definition
var MVFormsCKEditorDocument = function () {
    // Private functions
    var exampleDocument = function () {
        DecoupledEditor
            .create(document.querySelector('#mv_docs_ckeditor_document'))
            .then(editor => {
                const toolbarContainer = document.querySelector('#mv_docs_ckeditor_document_toolbar');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });
    }

    return {
        // Public Functions
        init: function () {
            exampleDocument();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsCKEditorDocument.init();
});
