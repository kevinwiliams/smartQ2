"use strict";

// Class definition
var MVFormsCKEditorBalloon = function () {
    // Private functions
    var exampleBalloon = function () {
        BalloonEditor
            .create(document.querySelector('#mv_docs_ckeditor_balloon'))
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
            exampleBalloon();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsCKEditorBalloon.init();
});
