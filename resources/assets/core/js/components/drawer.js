"use strict";

// Class definition
var MVDrawer = function(element, options) {
    //////////////////////////////
    // ** Private variables  ** //
    //////////////////////////////
    var the = this;
    var body = document.getElementsByTagName("BODY")[0];

    if ( typeof element === "undefined" || element === null ) {
        return;
    }

    // Default options
    var defaultOptions = {
        overlay: true,
        direction: 'end',
        baseClass: 'drawer',
        overlayClass: 'drawer-overlay'
    };

    ////////////////////////////
    // ** Private methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('drawer') ) {
            the = MVUtil.data(element).get('drawer');
        } else {
            _init();
        }
    }

    var _init = function() {
        // Variables
        the.options = MVUtil.deepExtend({}, defaultOptions, options);
        the.uid = MVUtil.getUniqueId('drawer');
        the.element = element;
        the.overlayElement = null;
        the.name = the.element.getAttribute('data-mv-drawer-name');
        the.shown = false;
        the.lastWidth;
        the.toggleElement = null;

        // Set initialized
        the.element.setAttribute('data-mv-drawer', 'true');

        // Event Handlers
        _handlers();

        // Update Instance
        _update();

        // Bind Instance
        MVUtil.data(the.element).set('drawer', the);
    }

    var _handlers = function() {
        var togglers = _getOption('toggle');
        var closers = _getOption('close');

        if ( togglers !== null && togglers.length > 0 ) {
            MVUtil.on(body, togglers, 'click', function(e) {
                e.preventDefault();

                the.toggleElement = this;
                _toggle();
            });
        }

        if ( closers !== null && closers.length > 0 ) {
            MVUtil.on(body, closers, 'click', function(e) {
                e.preventDefault();

                the.closeElement = this;
                _hide();
            });
        }
    }

    var _toggle = function() {
        if ( MVEventHandler.trigger(the.element, 'mv.drawer.toggle', the) === false ) {
            return;
        }

        if ( the.shown === true ) {
            _hide();
        } else {
            _show();
        }

        MVEventHandler.trigger(the.element, 'mv.drawer.toggled', the);
    }

    var _hide = function() {
        if ( MVEventHandler.trigger(the.element, 'mv.drawer.hide', the) === false ) {
            return;
        }

        the.shown = false;

        _deleteOverlay();

        body.removeAttribute('data-mv-drawer-' + the.name, 'on');
        body.removeAttribute('data-mv-drawer');

        MVUtil.removeClass(the.element, the.options.baseClass + '-on');

        if ( the.toggleElement !== null ) {
            MVUtil.removeClass(the.toggleElement, 'active');
        }

        MVEventHandler.trigger(the.element, 'mv.drawer.after.hidden', the) === false
    }

    var _show = function() {
        if ( MVEventHandler.trigger(the.element, 'mv.drawer.show', the) === false ) {
            return;
        }

        the.shown = true;

        _createOverlay();
        body.setAttribute('data-mv-drawer-' + the.name, 'on');
        body.setAttribute('data-mv-drawer', 'on');

        MVUtil.addClass(the.element, the.options.baseClass + '-on');

        if ( the.toggleElement !== null ) {
            MVUtil.addClass(the.toggleElement, 'active');
        }

        MVEventHandler.trigger(the.element, 'mv.drawer.shown', the);
    }

    var _update = function() {
        var width = _getWidth();
        var direction = _getOption('direction');

        // Reset state
        if ( MVUtil.hasClass(the.element, the.options.baseClass + '-on') === true && String(body.getAttribute('data-mv-drawer-' + the.name + '-')) === 'on' ) {
            the.shown = true;
        } else {
            the.shown = false;
        }       

        // Activate/deactivate
        if ( _getOption('activate') === true ) {
            MVUtil.addClass(the.element, the.options.baseClass);
            MVUtil.addClass(the.element, the.options.baseClass + '-' + direction);
            MVUtil.css(the.element, 'width', width, true);

            the.lastWidth = width;
        } else {
            MVUtil.css(the.element, 'width', '');

            MVUtil.removeClass(the.element, the.options.baseClass);
            MVUtil.removeClass(the.element, the.options.baseClass + '-' + direction);

            _hide();
        }
    }

    var _createOverlay = function() {
        if ( _getOption('overlay') === true ) {
            the.overlayElement = document.createElement('DIV');

            MVUtil.css(the.overlayElement, 'z-index', MVUtil.css(the.element, 'z-index') - 1); // update

            body.append(the.overlayElement);

            MVUtil.addClass(the.overlayElement, _getOption('overlay-class'));

            MVUtil.addEvent(the.overlayElement, 'click', function(e) {
                e.preventDefault();
                _hide();
            });
        }
    }

    var _deleteOverlay = function() {
        if ( the.overlayElement !== null ) {
            MVUtil.remove(the.overlayElement);
        }
    }

    var _getOption = function(name) {
        if ( the.element.hasAttribute('data-mv-drawer-' + name) === true ) {
            var attr = the.element.getAttribute('data-mv-drawer-' + name);
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

    var _getWidth = function() {
        var width = _getOption('width');

        if ( width === 'auto') {
            width = MVUtil.css(the.element, 'width');
        }

        return width;
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('drawer');
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

    the.show = function() {
        return _show();
    }

    the.hide = function() {
        return _hide();
    }

    the.isShown = function() {
        return the.shown;
    }

    the.update = function() {
        _update();
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
MVDrawer.getInstance = function(element) {
    if (element !== null && MVUtil.data(element).has('drawer')) {
        return MVUtil.data(element).get('drawer');
    } else {
        return null;
    }
}

// Hide all drawers and skip one if provided
MVDrawer.hideAll = function(skip = null, selector = '[data-mv-drawer="true"]') {
    var items = document.querySelectorAll(selector);

    if (items && items.length > 0) {
        for (var i = 0, len = items.length; i < len; i++) {
            var item = items[i];
            var drawer = MVDrawer.getInstance(item);

            if (!drawer) {
                continue;
            }

            if ( skip ) {
                if ( item !== skip ) {
                    drawer.hide();
                }
            } else {
                drawer.hide();
            }
        }
    }
}

// Update all drawers
MVDrawer.updateAll = function(selector = '[data-mv-drawer="true"]') {
    var items = document.querySelectorAll(selector);

    if (items && items.length > 0) {
        for (var i = 0, len = items.length; i < len; i++) {
            var item = items[i];
            var drawer = MVDrawer.getInstance(item);

            if (drawer) {
                drawer.update();;
            }
        }
    }
}

// Create instances
MVDrawer.createInstances = function(selector = '[data-mv-drawer="true"]') {
    var body = document.getElementsByTagName("BODY")[0];

    // Initialize Menus
    var elements = body.querySelectorAll(selector);
    var drawer;

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            drawer = new MVDrawer(elements[i]);
        }
    }
}

// Toggle instances
MVDrawer.handleShow = function() {
    // External drawer toggle handler
    MVUtil.on(document.body,  '[data-mv-drawer-show="true"][data-mv-drawer-target]', 'click', function(e) {
        var element = document.querySelector(this.getAttribute('data-mv-drawer-target'));

        if (element) {
            MVDrawer.getInstance(element).show();
        } 
    });
}

// Dismiss instances
MVDrawer.handleDismiss = function() {
    // External drawer toggle handler
    MVUtil.on(document.body,  '[data-mv-drawer-dismiss="true"]', 'click', function(e) {
        var element = this.closest('[data-mv-drawer="true"]');

        if (element) {
            var drawer = MVDrawer.getInstance(element);
            if (drawer.isShown()) {
                drawer.hide();
            }
        } 
    });
}

// Window resize Handling
window.addEventListener('resize', function() {
    var timer;
    var body = document.getElementsByTagName("BODY")[0];

    MVUtil.throttle(timer, function() {
        // Locate and update drawer instances on window resize
        var elements = body.querySelectorAll('[data-mv-drawer="true"]');

        if ( elements && elements.length > 0 ) {
            for (var i = 0, len = elements.length; i < len; i++) {
                var drawer = MVDrawer.getInstance(elements[i]);
                if (drawer) {
                    drawer.update();
                }
            }
        }
    }, 200);
});

// Global initialization
MVDrawer.init = function() {
    MVDrawer.createInstances();
    MVDrawer.handleShow();
    MVDrawer.handleDismiss();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVDrawer.init);
} else {
    MVDrawer.init();
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVDrawer;
}