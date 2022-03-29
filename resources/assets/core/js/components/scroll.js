"use strict";

// Class definition
var MVScroll = function(element, options) {
    ////////////////////////////
    // ** Private Variables  ** //
    ////////////////////////////
    var the = this;
    var body = document.getElementsByTagName("BODY")[0];

    if (!element) {
        return;
    }

    // Default options
    var defaultOptions = {
        saveState: true
    };

    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('scroll') ) {
            the = MVUtil.data(element).get('scroll');
        } else {
            _init();
        }
    }

    var _init = function() {
        // Variables
        the.options = MVUtil.deepExtend({}, defaultOptions, options);

        // Elements
        the.element = element;        
        the.id = the.element.getAttribute('id');

        // Set initialized
        the.element.setAttribute('data-mv-scroll', 'true');

        // Update
        _update();

        // Bind Instance
        MVUtil.data(the.element).set('scroll', the);
    }

    var _setupHeight = function() {
        var heightType = _getHeightType();
        var height = _getHeight();

        // Set height
        if ( height !== null && height.length > 0 ) {
            MVUtil.css(the.element, heightType, height);
        } else {
            MVUtil.css(the.element, heightType, '');
        }
    }

    var _setupState = function () {
        if ( _getOption('save-state') === true && typeof MVCookie !== 'undefined' && the.id ) {
            if ( MVCookie.get(the.id + 'st') ) {
                var pos = parseInt(MVCookie.get(the.id + 'st'));

                if ( pos > 0 ) {
                    the.element.scrollTop = pos;
                }
            }
        }
    }

    var _setupScrollHandler = function() {
        if ( _getOption('save-state') === true && typeof MVCookie !== 'undefined' && the.id ) {
            the.element.addEventListener('scroll', _scrollHandler);
        } else {
            the.element.removeEventListener('scroll', _scrollHandler);
        }
    }

    var _destroyScrollHandler = function() {
        the.element.removeEventListener('scroll', _scrollHandler);
    }

    var _resetHeight = function() {
        MVUtil.css(the.element, _getHeightType(), '');
    }

    var _scrollHandler = function () {
        MVCookie.set(the.id + 'st', the.element.scrollTop);
    }

    var _update = function() {
        // Activate/deactivate
        if ( _getOption('activate') === true || the.element.hasAttribute('data-mv-scroll-activate') === false ) {
            _setupHeight();
            _setupScrollHandler();
            _setupState();
        } else {
            _resetHeight()
            _destroyScrollHandler();
        }        
    }

    var _getHeight = function() {
        var height = _getOption(_getHeightType());

        if ( height instanceof Function ) {
            return height.call();
        } else if ( height !== null && typeof height === 'string' && height.toLowerCase() === 'auto' ) {
            return _getAutoHeight();
        } else {
            return height;
        }
    }

    var _getAutoHeight = function() {
        var height = MVUtil.getViewPort().height;

        var dependencies = _getOption('dependencies');
        var wrappers = _getOption('wrappers');
        var offset = _getOption('offset');

        // Height dependencies
        if ( dependencies !== null ) {
            var elements = document.querySelectorAll(dependencies);

            if ( elements && elements.length > 0 ) {
                for ( var i = 0, len = elements.length; i < len; i++ ) {
                    var element = elements[i];

                    if ( MVUtil.visible(element) === false ) {
                        continue;
                    }

                    height = height - parseInt(MVUtil.css(element, 'height'));
                    height = height - parseInt(MVUtil.css(element, 'margin-top'));
                    height = height - parseInt(MVUtil.css(element, 'margin-bottom'));

                    if (MVUtil.css(element, 'border-top')) {
                        height = height - parseInt(MVUtil.css(element, 'border-top'));
                    }

                    if (MVUtil.css(element, 'border-bottom')) {
                        height = height - parseInt(MVUtil.css(element, 'border-bottom'));
                    }
                }
            }
        }

        // Wrappers
        if ( wrappers !== null ) {
            var elements = document.querySelectorAll(wrappers);
            if ( elements && elements.length > 0 ) {
                for ( var i = 0, len = elements.length; i < len; i++ ) {
                    var element = elements[i];

                    if ( MVUtil.visible(element) === false ) {
                        continue;
                    }

                    height = height - parseInt(MVUtil.css(element, 'margin-top'));
                    height = height - parseInt(MVUtil.css(element, 'margin-bottom'));
                    height = height - parseInt(MVUtil.css(element, 'padding-top'));
                    height = height - parseInt(MVUtil.css(element, 'padding-bottom'));

                    if (MVUtil.css(element, 'border-top')) {
                        height = height - parseInt(MVUtil.css(element, 'border-top'));
                    }

                    if (MVUtil.css(element, 'border-bottom')) {
                        height = height - parseInt(MVUtil.css(element, 'border-bottom'));
                    }
                }
            }
        }

        // Custom offset
        if ( offset !== null ) {
            height = height - parseInt(offset);
        }

        height = height - parseInt(MVUtil.css(the.element, 'margin-top'));
        height = height - parseInt(MVUtil.css(the.element, 'margin-bottom'));
        
        if (MVUtil.css(element, 'border-top')) {
            height = height - parseInt(MVUtil.css(element, 'border-top'));
        }

        if (MVUtil.css(element, 'border-bottom')) {
            height = height - parseInt(MVUtil.css(element, 'border-bottom'));
        }

        height = String(height) + 'px';

        return height;
    }

    var _getOption = function(name) {
        if ( the.element.hasAttribute('data-mv-scroll-' + name) === true ) {
            var attr = the.element.getAttribute('data-mv-scroll-' + name);

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

    var _getHeightType = function() {
        if (_getOption('height')) {
            return 'height';
        } if (_getOption('min-height')) {
            return 'min-height';
        } if (_getOption('max-height')) {
            return 'max-height';
        }
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('scroll');
    }

    // Construct Class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    the.update = function() {
        return _update();
    }

    the.getHeight = function() {
        return _getHeight();
    }

    the.getElement = function() {
        return the.element;
    }

    the.destroy = function() {
        return _destroy();
    }
};

// Static methods
MVScroll.getInstance = function(element) {
    if ( element !== null && MVUtil.data(element).has('scroll') ) {
        return MVUtil.data(element).get('scroll');
    } else {
        return null;
    }
}

// Create instances
MVScroll.createInstances = function(selector = '[data-mv-scroll="true"]') {
    var body = document.getElementsByTagName("BODY")[0];

    // Initialize Menus
    var elements = body.querySelectorAll(selector);

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            new MVScroll(elements[i]);
        }
    }
}

// Window resize handling
window.addEventListener('resize', function() {
    var timer;
    var body = document.getElementsByTagName("BODY")[0];

    MVUtil.throttle(timer, function() {
        // Locate and update Offcanvas instances on window resize
        var elements = body.querySelectorAll('[data-mv-scroll="true"]');

        if ( elements && elements.length > 0 ) {
            for (var i = 0, len = elements.length; i < len; i++) {
                var scroll = MVScroll.getInstance(elements[i]);
                if (scroll) {
                    scroll.update();
                }
            }
        }
    }, 200);
});

// Global initialization
MVScroll.init = function() {
    MVScroll.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVScroll.init);
} else {
    MVScroll.init();
}

// Webpack Support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVScroll;
}
