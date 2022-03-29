"use strict";

// Class definition
var MVSticky = function(element, options) {
    ////////////////////////////
    // ** Private Variables  ** //
    ////////////////////////////
    var the = this;
    var body = document.getElementsByTagName("BODY")[0];

    if ( typeof element === "undefined" || element === null ) {
        return;
    }

    // Default Options
    var defaultOptions = {
        offset: 200,
        releaseOffset: 0,
        reverse: false,
        animation: true,
        animationSpeed: '0.3s',
        animationClass: 'animation-slide-in-down'
    };
    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('sticky') === true ) {
            the = MVUtil.data(element).get('sticky');
        } else {
            _init();
        }
    }

    var _init = function() {
        the.element = element;
        the.options = MVUtil.deepExtend({}, defaultOptions, options);
        the.uid = MVUtil.getUniqueId('sticky');
        the.name = the.element.getAttribute('data-mv-sticky-name');
        the.attributeName = 'data-mv-sticky-' + the.name;
        the.eventTriggerState = true;
        the.lastScrollTop = 0;
        the.scrollHandler;

        // Set initialized
        the.element.setAttribute('data-mv-sticky', 'true');

        // Event Handlers
        window.addEventListener('scroll', _scroll);

        // Initial Launch
        _scroll();

        // Bind Instance
        MVUtil.data(the.element).set('sticky', the);
    }

    var _scroll = function(e) {
        var offset = _getOption('offset');
        var releaseOffset = _getOption('release-offset');
        var reverse = _getOption('reverse');
        var st;
        var attrName;
        var diff;

        // Exit if false
        if ( offset === false ) {
            return;
        }

        offset = parseInt(offset);
        releaseOffset = releaseOffset ? parseInt(releaseOffset) : 0;
        st = MVUtil.getScrollTop();
        diff = document.documentElement.scrollHeight - window.innerHeight - MVUtil.getScrollTop();

        if ( reverse === true ) {  // Release on reverse scroll mode
            if ( st > offset && (releaseOffset === 0 || releaseOffset < diff)) {
                if ( body.hasAttribute(the.attributeName) === false) {
                    _enable();
                    body.setAttribute(the.attributeName, 'on');
                }

                if ( the.eventTriggerState === true ) {
                    MVEventHandler.trigger(the.element, 'mv.sticky.on', the);
                    MVEventHandler.trigger(the.element, 'mv.sticky.change', the);

                    the.eventTriggerState = false;
                }
            } else { // Back scroll mode
                if ( body.hasAttribute(the.attributeName) === true) {
                    _disable();
                    body.removeAttribute(the.attributeName);
                }

                if ( the.eventTriggerState === false ) {
                    MVEventHandler.trigger(the.element, 'mv.sticky.off', the);
                    MVEventHandler.trigger(the.element, 'mv.sticky.change', the);
                    the.eventTriggerState = true;
                }
            }

            the.lastScrollTop = st;
        } else { // Classic scroll mode
            if ( st > offset && (releaseOffset === 0 || releaseOffset < diff)) {
                if ( body.hasAttribute(the.attributeName) === false) {
                    _enable();
                    body.setAttribute(the.attributeName, 'on');
                }

                if ( the.eventTriggerState === true ) {
                    MVEventHandler.trigger(the.element, 'mv.sticky.on', the);
                    MVEventHandler.trigger(the.element, 'mv.sticky.change', the);
                    the.eventTriggerState = false;
                }
            } else { // back scroll mode
                if ( body.hasAttribute(the.attributeName) === true ) {
                    _disable();
                    body.removeAttribute(the.attributeName);
                }

                if ( the.eventTriggerState === false ) {
                    MVEventHandler.trigger(the.element, 'mv.sticky.off', the);
                    MVEventHandler.trigger(the.element, 'mv.sticky.change', the);
                    the.eventTriggerState = true;
                }
            }
        }

        if (releaseOffset > 0) {
            if ( diff < releaseOffset ) {
                the.element.setAttribute('data-mv-sticky-released', 'true');
            } else {
                the.element.removeAttribute('data-mv-sticky-released');
            }
        }        
    }

    var _enable = function(update) {
        var top = _getOption('top');
        var left = _getOption('left');
        var right = _getOption('right');
        var width = _getOption('width');
        var zindex = _getOption('zindex');

        if ( update !== true && _getOption('animation') === true ) {
            MVUtil.css(the.element, 'animationDuration', _getOption('animationSpeed'));
            MVUtil.animateClass(the.element, 'animation ' + _getOption('animationClass'));
        }

        if ( zindex !== null ) {
            MVUtil.css(the.element, 'z-index', zindex);
            MVUtil.css(the.element, 'position', 'fixed');
        }

        if ( top !== null ) {
            MVUtil.css(the.element, 'top', top);
        }

        if ( width !== null ) {
            if (width['target']) {
                var targetElement = document.querySelector(width['target']);
                if (targetElement) {
                    width = MVUtil.css(targetElement, 'width');
                }
            }

            MVUtil.css(the.element, 'width', width);
        }

        if ( left !== null ) {
            if ( String(left).toLowerCase() === 'auto' ) {
                var offsetLeft = MVUtil.offset(the.element).left;

                if ( offsetLeft > 0 ) {
                    MVUtil.css(the.element, 'left', String(offsetLeft) + 'px');
                }
            }
        }
    }

    var _disable = function() {
        MVUtil.css(the.element, 'top', '');
        MVUtil.css(the.element, 'width', '');
        MVUtil.css(the.element, 'left', '');
        MVUtil.css(the.element, 'right', '');
        MVUtil.css(the.element, 'z-index', '');
        MVUtil.css(the.element, 'position', '');
    }

    var _getOption = function(name) {
        if ( the.element.hasAttribute('data-mv-sticky-' + name) === true ) {
            var attr = the.element.getAttribute('data-mv-sticky-' + name);
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
        window.removeEventListener('scroll', _scroll);
        MVUtil.data(the.element).remove('sticky');
    }

    // Construct Class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Methods
    the.update = function() {
        if ( body.hasAttribute(the.attributeName) === true ) {
            _disable();
            body.removeAttribute(the.attributeName);
            _enable(true);
            body.setAttribute(the.attributeName, 'on');
        }
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
MVSticky.getInstance = function(element) {
    if ( element !== null && MVUtil.data(element).has('sticky') ) {
        return MVUtil.data(element).get('sticky');
    } else {
        return null;
    }
}

// Create instances
MVSticky.createInstances = function(selector = '[data-mv-sticky="true"]') {
    var body = document.getElementsByTagName("BODY")[0];

    // Initialize Menus
    var elements = body.querySelectorAll(selector);
    var sticky;

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            sticky = new MVSticky(elements[i]);
        }
    }
}

// Window resize handler
window.addEventListener('resize', function() {
    var timer;
    var body = document.getElementsByTagName("BODY")[0];

    MVUtil.throttle(timer, function() {
        // Locate and update Offcanvas instances on window resize
        var elements = body.querySelectorAll('[data-mv-sticky="true"]');

        if ( elements && elements.length > 0 ) {
            for (var i = 0, len = elements.length; i < len; i++) {
                var sticky = MVSticky.getInstance(elements[i]);
                if (sticky) {
                    sticky.update();
                }
            }
        }
    }, 200);
});

// Global initialization
MVSticky.init = function() {
    MVSticky.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVSticky.init);
} else {
    MVSticky.init();
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVSticky;
}
