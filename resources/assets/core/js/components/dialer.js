"use strict";

// Class definition
var MVDialer = function(element, options) {
    ////////////////////////////
    // ** Private variables  ** //
    ////////////////////////////
    var the = this;

    if (!element) {
        return;
    }

    // Default options
    var defaultOptions = {
        min: null,
        max: null,
        step: 1,
        decimals: 0,
        prefix: "",
        suffix: ""
    };

    ////////////////////////////
    // ** Private methods  ** //
    ////////////////////////////

    // Constructor
    var _construct = function() {
        if ( MVUtil.data(element).has('dialer') === true ) {
            the = MVUtil.data(element).get('dialer');
        } else {
            _init();
        }
    }

    // Initialize
    var _init = function() {
        // Variables
        the.options = MVUtil.deepExtend({}, defaultOptions, options);

        // Elements
        the.element = element;
        the.incElement = the.element.querySelector('[data-mv-dialer-control="increase"]');
        the.decElement = the.element.querySelector('[data-mv-dialer-control="decrease"]');
        the.inputElement = the.element.querySelector('input[type]'); 
        
        // Set Values
        if (_getOption('decimals')) {
            the.options.decimals = parseInt(_getOption('decimals'));
        }
        
        if (_getOption('prefix')) {
            the.options.prefix = _getOption('prefix');
        }
        
        if (_getOption('suffix')) {
            the.options.suffix = _getOption('suffix');
        }
        
        if (_getOption('step')) {
            the.options.step = parseFloat(_getOption('step'));
        }

        if (_getOption('min')) {
            the.options.min = parseFloat(_getOption('min'));
        }

        if (_getOption('max')) {
            the.options.max = parseFloat(_getOption('max'));
        }

        the.value = parseFloat(the.inputElement.value.replace(/[^\d.]/g, ''));  

        _setValue();

        // Event Handlers
        _handlers();

        // Bind Instance
        MVUtil.data(the.element).set('dialer', the);
    }

    // Handlers
    var _handlers = function() {
        MVUtil.addEvent(the.incElement, 'click', function(e) {
            e.preventDefault();
        
            _increase();
        });

        MVUtil.addEvent(the.decElement, 'click', function(e) {
            e.preventDefault();

            _decrease();
        });

        MVUtil.addEvent(the.inputElement, 'input', function(e) {
            e.preventDefault();

            _setValue();
        });
    }

    // Event handlers
    var _increase = function() {
        // Trigger "after.dialer" event
        MVEventHandler.trigger(the.element, 'mv.dialer.increase', the);

        the.inputElement.value = the.value + the.options.step;
        _setValue();

        // Trigger "before.dialer" event
        MVEventHandler.trigger(the.element, 'mv.dialer.increased', the);

        return the;
    }

    var _decrease = function() {
        // Trigger "after.dialer" event
        MVEventHandler.trigger(the.element, 'mv.dialer.decrease', the);

        the.inputElement.value = the.value - the.options.step;      

        _setValue();

        // Trigger "before.dialer" event
        MVEventHandler.trigger(the.element, 'mv.dialer.decreased', the);

        return the;
    }

    // Set Input Value
    var _setValue = function() {
        // Trigger "after.dialer" event
        MVEventHandler.trigger(the.element, 'mv.dialer.change', the);

        the.value = _parse(the.inputElement.value); 
        
        if (the.options.min !== null && the.value < the.options.min) {
            the.value = the.options.min;
        }

        if (the.options.max !== null && the.value > the.options.max) {
            the.value = the.options.max;
        }

        the.inputElement.value = _format(the.value);

        // Trigger input change event
        the.inputElement.dispatchEvent(new Event('change'));

        // Trigger "after.dialer" event
        MVEventHandler.trigger(the.element, 'mv.dialer.changed', the);
    }

    var _parse = function(val) {
        val = val
            .replace(/[^0-9.-]/g, '')       // remove chars except number, hyphen, point. 
            .replace(/(\..*)\./g, '$1')     // remove multiple points.
            .replace(/(?!^)-/g, '')         // remove middle hyphen.
            .replace(/^0+(\d)/gm, '$1');    // remove multiple leading zeros. <-- I added this.

        val = parseFloat(val);

        if (isNaN(val)) {
            val = 0;
        } 

        return val;
    }

    // Format
    var _format = function(val){
        return the.options.prefix + parseFloat(val).toFixed(the.options.decimals) + the.options.suffix;              
    }

    // Get option
    var _getOption = function(name) {
        if ( the.element.hasAttribute('data-mv-dialer-' + name) === true ) {
            var attr = the.element.getAttribute('data-mv-dialer-' + name);
            var value = attr;            

            return value;
        } else {
            return null;
        }
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('dialer');
    }

    // Construct class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Plugin API
    the.increase = function() {
        return _increase();
    }

    the.decrease = function() {
        return _decrease();
    }

    the.getElement = function() {
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
MVDialer.getInstance = function(element) {
    if ( element !== null && MVUtil.data(element).has('dialer') ) {
        return MVUtil.data(element).get('dialer');
    } else {
        return null;
    }
}

// Create instances
MVDialer.createInstances = function(selector = '[data-mv-dialer="true"]') {
    // Get instances
    var elements = document.body.querySelectorAll(selector);

    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            // Initialize instances
            new MVDialer(elements[i]);
        }
    }
}

// Global initialization
MVDialer.init = function() {
    MVDialer.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVDialer.init);
} else {
    MVDialer.init();
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVDialer;
}