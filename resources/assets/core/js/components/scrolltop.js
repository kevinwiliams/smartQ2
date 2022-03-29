"use strict";

// Class definition
var MVScrolltop = function(element, options) {
    ////////////////////////////
    // ** Private variables  ** //
    ////////////////////////////
    var the = this;
    var body = document.getElementsByTagName("BODY")[0];

    if ( typeof element === "undefined" || element === null ) {
        return;
    }

    // Default options
    var defaultOptions = {
        offset: 300,
        speed: 600
    };

    ////////////////////////////
    // ** Private methods  ** //
    ////////////////////////////

    var _construct = function() {
        if (MVUtil.data(element).has('scrolltop')) {
            the = MVUtil.data(element).get('scrolltop');
        } else {
            _init();
        }
    }

    var _init = function() {
        // Variables
        the.options = MVUtil.deepExtend({}, defaultOptions, options);
        the.uid = MVUtil.getUniqueId('scrolltop');
        the.element = element;

        // Set initialized
        the.element.setAttribute('data-mv-scrolltop', 'true');

        // Event Handlers
        _handlers();

        // Bind Instance
        MVUtil.data(the.element).set('scrolltop', the);
    }

    var _handlers = function() {
        var timer;

        window.addEventListener('scroll', function() {
            MVUtil.throttle(timer, function() {
                _scroll();
            }, 200);
        });

        MVUtil.addEvent(the.element, 'click', function(e) {
            e.preventDefault();

            _go();
        });
    }

    var _scroll = function() {
        var offset = parseInt(_getOption('offset'));

        var pos = MVUtil.getScrollTop(); // current vertical position

        if ( pos > offset ) {
            if ( body.hasAttribute('data-mv-scrolltop') === false ) {
                body.setAttribute('data-mv-scrolltop', 'on');
            }
        } else {
            if ( body.hasAttribute('data-mv-scrolltop') === true ) {
                body.removeAttribute('data-mv-scrolltop');
            }
        }
    }

    var _go = function() {
        var speed = parseInt(_getOption('speed'));

        MVUtil.scrollTop(0, speed);
    }

    var _getOption = function(name) {
        if ( the.element.hasAttribute('data-mv-scrolltop-' + name) === true ) {
            var attr = the.element.getAttribute('data-mv-scrolltop-' + name);
            var value = MVUtil.getResponsiveValue(attr);

            if ( value !== null && String(value) === 'true' ) {
                value = true;
            } else if ( value !== null && String(value) === 'false' ) {
                value = false;
            }

            return value;
        } else {
            var optionName = MVUtil.snakeToCamel(name);

            if ( the.options[optionName] ) {
                return MVUtil.getResponsiveValue(the.options[optionName]);
            } else {
                return null;
            }
        }
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('scrolltop');
    }

    // Construct class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Plugin API
    the.go = function() {
        return _go();
    }

    the.getElement = function() {
        return the.element;
    }

    the.destroy = function() {
        return _destroy();
    }
};

// Static methods
MVScrolltop.getInstance = function(element) {
    if (element && MVUtil.data(element).has('scrolltop')) {
        return MVUtil.data(element).get('scrolltop');
    } else {
        return null;
    }
}

// Create instances
MVScrolltop.createInstances = function(selector = '[data-mv-scrolltop="true"]') {
    var body = document.getElementsByTagName("BODY")[0];

    // Initialize Menus
    var elements = body.querySelectorAll(selector);
    var scrolltop;

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            scrolltop = new MVScrolltop(elements[i]);
        }
    }
}

// Global initialization
MVScrolltop.init = function() {
    MVScrolltop.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVScrolltop.init);
} else {
    MVScrolltop.init();
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVScrolltop;
}
