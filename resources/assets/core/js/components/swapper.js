"use strict";

// Class definition
var MVSwapper = function(element, options) {
    ////////////////////////////
    // ** Private Variables  ** //
    ////////////////////////////
    var the = this;

    if ( typeof element === "undefined" || element === null ) {
        return;
    }

    // Default Options
    var defaultOptions = {
        mode: 'append'
    };

    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('swapper') === true ) {
            the = MVUtil.data(element).get('swapper');
        } else {
            _init();
        }
    }

    var _init = function() {
        the.element = element;
        the.options = MVUtil.deepExtend({}, defaultOptions, options);

        // Set initialized
        the.element.setAttribute('data-mv-swapper', 'true');

        // Initial update
        _update();

        // Bind Instance
        MVUtil.data(the.element).set('swapper', the);
    }

    var _update = function(e) {
        var parentSelector = _getOption('parent');

        var mode = _getOption('mode');
        var parentElement = parentSelector ? document.querySelector(parentSelector) : null;
       

        if (parentElement && element.parentNode !== parentElement) {
            if (mode === 'prepend') {
                parentElement.prepend(element);
            } else if (mode === 'append') {
                parentElement.append(element);
            }
        }
    }

    var _getOption = function(name) {
        if ( the.element.hasAttribute('data-mv-swapper-' + name) === true ) {
            var attr = the.element.getAttribute('data-mv-swapper-' + name);
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
        MVUtil.data(the.element).remove('swapper');
    }

    // Construct Class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Methods
    the.update = function() {
        _update();
    }

    the.destroy = function() {
        return _destroy();
    }

    // Event API
    the.on = function(name, handler) {
        return MVEventHandler.on(the.element, name, handler);
    }

    the.one = function(name, handler) {
        return MVEventHandler.one(the.element, name, handler);
    }

    the.off = function(name) {
        return MVEventHandler.off(the.element, name);
    }

    the.trigger = function(name, event) {
        return MVEventHandler.trigger(the.element, name, event, the, event);
    }
};

// Static methods
MVSwapper.getInstance = function(element) {
    if ( element !== null && MVUtil.data(element).has('swapper') ) {
        return MVUtil.data(element).get('swapper');
    } else {
        return null;
    }
}

// Create instances
MVSwapper.createInstances = function(selector = '[data-mv-swapper="true"]') {
    // Initialize Menus
    var elements = document.querySelectorAll(selector);
    var swapper;

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            swapper = new MVSwapper(elements[i]);
        }
    }
}

// Window resize handler
window.addEventListener('resize', function() {
    var timer;

    MVUtil.throttle(timer, function() {
        // Locate and update Offcanvas instances on window resize
        var elements = document.querySelectorAll('[data-mv-swapper="true"]');

        if ( elements && elements.length > 0 ) {
            for (var i = 0, len = elements.length; i < len; i++) {
                var swapper = MVSwapper.getInstance(elements[i]);
                if (swapper) {
                    swapper.update();
                }                
            }
        }
    }, 200);
});

// Global initialization
MVSwapper.init = function() {
    MVSwapper.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVSwapper.init);
} else {
    MVSwapper.init();
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVSwapper;
}
