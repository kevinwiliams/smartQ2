"use strict";

// Class definition
var MVBlockUI = function(element, options) {
    //////////////////////////////
    // ** Private variables  ** //
    //////////////////////////////
    var the = this;

    if ( typeof element === "undefined" || element === null ) {
        return;
    }

    // Default options
    var defaultOptions = {
        zIndex: false,
        overlayClass: '',
        overflow: 'hidden',
        message: '<span class="spinner-border text-primary"></span>'
    };

    ////////////////////////////
    // ** Private methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('blockui') ) {
            the = MVUtil.data(element).get('blockui');
        } else {
            _init();
        }
    }

    var _init = function() {
        // Variables
        the.options = MVUtil.deepExtend({}, defaultOptions, options);
        the.element = element;
        the.overlayElement = null;
        the.blocked = false;
        the.positionChanged = false;
        the.overflowChanged = false;

        // Bind Instance
        MVUtil.data(the.element).set('blockui', the);
    }

    var _block = function() {
        if ( MVEventHandler.trigger(the.element, 'mv.blockui.block', the) === false ) {
            return;
        }

        var isPage = (the.element.tagName === 'BODY');
       
        var position = MVUtil.css(the.element, 'position');
        var overflow = MVUtil.css(the.element, 'overflow');
        var zIndex = isPage ? 10000 : 1;

        if (the.options.zIndex > 0) {
            zIndex = the.options.zIndex;
        } else {
            if (MVUtil.css(the.element, 'z-index') != 'auto') {
                zIndex = MVUtil.css(the.element, 'z-index');
            }
        }

        the.element.classList.add('blockui');

        if (position === "absolute" || position === "relative" || position === "fixed") {
            MVUtil.css(the.element, 'position', 'relative');
            the.positionChanged = true;
        }

        if (the.options.overflow === 'hidden' && overflow === 'visible') {           
            MVUtil.css(the.element, 'overflow', 'hidden');
            the.overflowChanged = true;
        }

        the.overlayElement = document.createElement('DIV');    
        the.overlayElement.setAttribute('class', 'blockui-overlay ' + the.options.overlayClass);
        
        the.overlayElement.innerHTML = the.options.message;

        MVUtil.css(the.overlayElement, 'z-index', zIndex);

        the.element.append(the.overlayElement);
        the.blocked = true;

        MVEventHandler.trigger(the.element, 'mv.blockui.after.blocked', the) === false
    }

    var _release = function() {
        if ( MVEventHandler.trigger(the.element, 'mv.blockui.release', the) === false ) {
            return;
        }

        the.element.classList.add('blockui');
        
        if (the.positionChanged) {
            MVUtil.css(the.element, 'position', '');
        }

        if (the.overflowChanged) {
            MVUtil.css(the.element, 'overflow', '');
        }

        if (the.overlayElement) {
            MVUtil.remove(the.overlayElement);
        }        

        the.blocked = false;

        MVEventHandler.trigger(the.element, 'mv.blockui.released', the);
    }

    var _isBlocked = function() {
        return the.blocked;
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('blockui');
    }

    // Construct class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Plugin API
    the.block = function() {
        _block();
    }

    the.release = function() {
        _release();
    }

    the.isBlocked = function() {
        return _isBlocked();
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
MVBlockUI.getInstance = function(element) {
    if (element !== null && MVUtil.data(element).has('blockui')) {
        return MVUtil.data(element).get('blockui');
    } else {
        return null;
    }
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVBlockUI;
}