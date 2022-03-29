"use strict";

// Class definition
var MVFormsTinyMCEBasic = function() {
    // Private functions
    var exampleBasic = function() {
        var options = {selector: '#mv_docs_tinymce_basic'};
        
        if (MVApp.isDarkMode()) {
            options['skin'] = 'oxide-dark';
            options['content_css'] = 'dark';
        }
        
        tinymce.init(options);
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
    MVFormsTinyMCEBasic.init();
});
