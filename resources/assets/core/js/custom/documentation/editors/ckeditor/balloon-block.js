"use strict";

// Class definition
var MVFormsCKEditorBalloonBlock = function () {
    // Private functions
    var exampleBalloonBlock = function () {
        BalloonEditor
            .create(document.querySelector('#mv_docs_ckeditor_balloon_block'))
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
            exampleBalloonBlock();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsCKEditorBalloonBlock.init();
});
