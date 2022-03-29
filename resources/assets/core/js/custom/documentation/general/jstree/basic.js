"use strict";

// Class definition
var MVJSTreeBasic = function() {
    // Private functions
    var exampleBasic = function() {
        $('#mv_docs_jstree_basic').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder"
                },
                "file" : {
                    "icon" : "fa fa-file"
                }
            },
            "plugins": ["types"]
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
    MVJSTreeBasic.init();
});
