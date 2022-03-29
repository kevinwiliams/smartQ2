"use strict";

// Class definition
var MVToggle = function(element, options) {
    ////////////////////////////
    // ** Private variables  ** //
    ////////////////////////////
    var the = this;
    var body = document.getElementsByTagName("BODY")[0];

    if (!element) {
        return;
    }

    // Default Options
    var defaultOptions = {
        saveState: true
    };

    ////////////////////////////
    // ** Private methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('toggle') === true ) {
            the = MVUtil.data(element).get('toggle');
        } else {
            _init();
        }
    }

    var _init = function() {
        // Variables
        the.options = MVUtil.deepExtend({}, defaultOptions, options);
        the.uid = MVUtil.getUniqueId('toggle');

        // Elements
        the.element = element;

        the.target = document.querySelector(the.element.getAttribute('data-mv-toggle-target')) ? document.querySelector(the.element.getAttribute('data-mv-toggle-target')) : the.element;
        the.state = the.element.hasAttribute('data-mv-toggle-state') ? the.element.getAttribute('data-mv-toggle-state') : '';
        the.attribute = 'data-mv-' + the.element.getAttribute('data-mv-toggle-name');

        // Event Handlers
        _handlers();

        // Bind Instance
        MVUtil.data(the.element).set('toggle', the);
    }

    var _handlers = function() {
        MVUtil.addEvent(the.element, 'click', function(e) {
            e.preventDefault();

            _toggle();
        });
    }

    // Event handlers
    var _toggle = function() {
        // Trigger "after.toggle" event
        MVEventHandler.trigger(the.element, 'mv.toggle.change', the);

        if ( _isEnabled() ) {
            _disable();
        } else {
            _enable();
        }

        // Trigger "before.toggle" event
        MVEventHandler.trigger(the.element, 'mv.toggle.changed', the);

        return the;
    }

    var _enable = function() {
        if ( _isEnabled() === true ) {
            return;
        }

        MVEventHandler.trigger(the.element, 'mv.toggle.enable', the);

        the.target.setAttribute(the.attribute, 'on');

        if (the.state.length > 0) {
            the.element.classList.add(the.state);
        }        

        if ( typeof MVCookie !== 'undefined' && the.options.saveState === true ) {
            MVCookie.set(the.attribute, 'on');
        }

        MVEventHandler.trigger(the.element, 'mv.toggle.enabled', the);

        return the;
    }

    var _disable = function() {
        if ( _isEnabled() === false ) {
            return;
        }

        MVEventHandler.trigger(the.element, 'mv.toggle.disable', the);

        the.target.removeAttribute(the.attribute);

        if (the.state.length > 0) {
            the.element.classList.remove(the.state);
        } 

        if ( typeof MVCookie !== 'undefined' && the.options.saveState === true ) {
            MVCookie.remove(the.attribute);
        }

        MVEventHandler.trigger(the.element, 'mv.toggle.disabled', the);

        return the;
    }

    var _isEnabled = function() {
        return (String(the.target.getAttribute(the.attribute)).toLowerCase() === 'on');
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('toggle');
    }

    // Construct class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Plugin API
    the.toggle = function() {
        return _toggle();
    }

    the.enable = function() {
        return _enable();
    }

    the.disable = function() {
        return _disable();
    }

    the.isEnabled = function() {
        return _isEnabled();
    }

    the.goElement = function() {
        return the.element;
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
MVToggle.getInstance = function(element) {
    if ( element !== null && MVUtil.data(element).has('toggle') ) {
        return MVUtil.data(element).get('toggle');
    } else {
        return null;
    }
}

// Create instances
MVToggle.createInstances = function(selector = '[data-mv-toggle]') {
    var body = document.getElementsByTagName("BODY")[0];

    // Get instances
    var elements = body.querySelectorAll(selector);

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            // Initialize instances
            new MVToggle(elements[i]);
        }
    }
}

// Global initialization
MVToggle.init = function() {
    MVToggle.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVToggle.init);
} else {
    MVToggle.init();
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVToggle;
}