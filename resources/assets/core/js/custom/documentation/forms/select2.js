"use strict";

// Class definition
var MVFormsSelect2Demo = function () {
    // Private functions
    var exampleCountry = function () {
        // Format options
        const format = (item) => {
            if (!item.id) {
                return item.text;
            }

            var url = hostUrl + 'media/' + item.element.getAttribute('data-mv-select2-country');
            var img = $("<img>", {
                class: "rounded-circle me-2",
                width: 26,
                src: url
            });
            var span = $("<span>", {
                text: " " + item.text
            });
            span.prepend(img);
            return span;
        }

        // Init Select2 --- more info: https://select2.org/
        $('#mv_docs_select2_country').select2({
            templateResult: function (item) {
                return format(item);
            }
        });
    }

    const exampleUsers = function () {
        // Format options
        const format = (item) => {
            if (!item.id) {
                return item.text;
            }

            var url = hostUrl + 'media/' + item.element.getAttribute('data-mv-select2-user');
            var img = $("<img>", {
                class: "rounded-circle me-2",
                width: 26,
                src: url
            });
            var span = $("<span>", {
                text: " " + item.text
            });
            span.prepend(img);
            return span;
        }

        // Init Select2 --- more info: https://select2.org/
        $('#mv_docs_select2_users').select2({
            templateResult: function (item) {
                return format(item);
            }
        });
    }

    return {
        // Public Functions
        init: function () {
            exampleCountry();
            exampleUsers();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVFormsSelect2Demo.init();
});
