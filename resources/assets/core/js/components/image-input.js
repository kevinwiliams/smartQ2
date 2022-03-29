"use strict";

// Class definition
var MVImageInput = function(element, options) {
    ////////////////////////////
    // ** Private Variables  ** //
    ////////////////////////////
    var the = this;

    if ( typeof element === "undefined" || element === null ) {
        return;
    }

    // Default Options
    var defaultOptions = {
        
    };

    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('image-input') === true ) {
            the = MVUtil.data(element).get('image-input');
        } else {
            _init();
        }
    }

    var _init = function() {
        // Variables
        the.options = MVUtil.deepExtend({}, defaultOptions, options);
        the.uid = MVUtil.getUniqueId('image-input');

        // Elements
        the.element = element;
        the.inputElement = MVUtil.find(element, 'input[type="file"]');
        the.wrapperElement = MVUtil.find(element, '.image-input-wrapper');
        the.cancelElement = MVUtil.find(element, '[data-mv-image-input-action="cancel"]');
        the.removeElement = MVUtil.find(element, '[data-mv-image-input-action="remove"]');
        the.hiddenElement = MVUtil.find(element, 'input[type="hidden"]');
        the.src = MVUtil.css(the.wrapperElement, 'backgroundImage');

        // Set initialized
        the.element.setAttribute('data-mv-image-input', 'true');

        // Event Handlers
        _handlers();

        // Bind Instance
        MVUtil.data(the.element).set('image-input', the);
    }

    // Init Event Handlers
    var _handlers = function() {
        MVUtil.addEvent(the.inputElement, 'change', _change);
        MVUtil.addEvent(the.cancelElement, 'click', _cancel);
        MVUtil.addEvent(the.removeElement, 'click', _remove);
    }

    // Event Handlers
    var _change = function(e) {
        e.preventDefault();

        if ( the.inputElement !== null && the.inputElement.files && the.inputElement.files[0] ) {
            // Fire change event
            if ( MVEventHandler.trigger(the.element, 'mv.imageinput.change', the) === false ) {
                return;
            }

            var reader = new FileReader();

            reader.onload = function(e) {
                MVUtil.css(the.wrapperElement, 'background-image', 'url('+ e.target.result +')');
            }

            reader.readAsDataURL(the.inputElement.files[0]);

            MVUtil.addClass(the.element, 'image-input-changed');
            MVUtil.removeClass(the.element, 'image-input-empty');

            // Fire removed event
            MVEventHandler.trigger(the.element, 'mv.imageinput.changed', the);
        }
    }

    var _cancel = function(e) {
        e.preventDefault();

        // Fire cancel event
        if ( MVEventHandler.trigger(the.element, 'mv.imageinput.cancel', the) === false ) {
            return;
        }

        MVUtil.removeClass(the.element, 'image-input-changed');
        MVUtil.removeClass(the.element, 'image-input-empty');
        MVUtil.css(the.wrapperElement, 'background-image', the.src);
        the.inputElement.value = "";

        if ( the.hiddenElement !== null ) {
            the.hiddenElement.value = "0";
        }

        // Fire canceled event
        MVEventHandler.trigger(the.element, 'mv.imageinput.canceled', the);
    }

    var _remove = function(e) {
        e.preventDefault();

        // Fire remove event
        if ( MVEventHandler.trigger(the.element, 'mv.imageinput.remove', the) === false ) {
            return;
        }

        MVUtil.removeClass(the.element, 'image-input-changed');
        MVUtil.addClass(the.element, 'image-input-empty');
        MVUtil.css(the.wrapperElement, 'background-image', "none");
        the.inputElement.value = "";

        if ( the.hiddenElement !== null ) {
            the.hiddenElement.value = "1";
        }

        // Fire removed event
        MVEventHandler.trigger(the.element, 'mv.imageinput.removed', the);
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('image-input');
    }

    // Construct Class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Plugin API
    the.getInputElement = function() {
        return the.inputElement;
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
MVImageInput.getInstance = function(element) {
    if ( element !== null && MVUtil.data(element).has('image-input') ) {
        return MVUtil.data(element).get('image-input');
    } else {
        return null;
    }
}

// Create instances
MVImageInput.createInstances = function(selector = '[data-mv-image-input]') {
    // Initialize Menus
    var elements = document.querySelectorAll(selector);

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            new MVImageInput(elements[i]);
        }
    }
}

// Global initialization
MVImageInput.init = function() {
    MVImageInput.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVImageInput.init);
} else {
    MVImageInput.init();
}

// Webpack Support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVImageInput;
}
