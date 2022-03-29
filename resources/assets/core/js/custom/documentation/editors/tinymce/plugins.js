"use strict";

// Class definition
var MVFormsTinyMCEPlugins = function() {
    // Private functions
    var examplePlugins = function() {
        tinymce.init({
            selector: '#mv_docs_tinymce_plugins',
            toolbar: 'advlist | autolink | link image | lists charmap | print preview',
            plugins : 'advlist autolink link image lists charmap print preview'
        });
    }

    return {
        // Public Functions
        init: function() {
            examplePlugins();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVFormsTinyMCEPlugins.init();
});
