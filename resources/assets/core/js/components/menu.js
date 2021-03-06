"use strict";

// Class definition
var MVMenu = function(element, options) {
    ////////////////////////////
    // ** Private Variables  ** //
    ////////////////////////////
    var the = this;

    if ( typeof element === "undefined" || element === null ) {
        return;
    }

    // Default Options
    var defaultOptions = {
        dropdown: {
            hoverTimeout: 200,
            zindex: 105
        },

        accordion: {
            slideSpeed: 250,
            expand: false
        }
    };

    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////

    var _construct = function() {
        if ( MVUtil.data(element).has('menu') === true ) {
            the = MVUtil.data(element).get('menu');
        } else {
            _init();
        }
    }

    var _init = function() {
        the.options = MVUtil.deepExtend({}, defaultOptions, options);
        the.uid = MVUtil.getUniqueId('menu');
        the.element = element;
        the.triggerElement;

        // Set initialized
        the.element.setAttribute('data-mv-menu', 'true');

        _setTriggerElement();
        _update();

        MVUtil.data(the.element).set('menu', the);
    }

    var _destroy = function() {  // todo

    }

    // Event Handlers
    // Toggle handler
    var _click = function(element, e) {
        e.preventDefault();

        var item = _getItemElement(element);

        if ( _getItemOption(item, 'trigger') !== 'click' ) {
            return;
        }

        if ( _getItemOption(item, 'toggle') === false ) {
            _show(item);
        } else {
            _toggle(item);
        }
    }

    // Link handler
    var _link = function(element, e) {
        if ( MVEventHandler.trigger(the.element, 'mv.menu.link.click', the) === false )  {
            return;
        }

        // Dismiss all shown dropdowns
        MVMenu.hideDropdowns();

        MVEventHandler.trigger(the.element, 'mv.menu.link.clicked', the);
    }

    // Dismiss handler
    var _dismiss = function(element, e) {
        var item = _getItemElement(element);
        var items = _getItemChildElements(item);

        if ( item !== null && _getItemSubType(item) === 'dropdown') {
            _hide(item); // hide items dropdown
            // Hide all child elements as well
            
            if ( items.length > 0 ) {
                for (var i = 0, len = items.length; i < len; i++) {
                    if ( items[i] !== null &&  _getItemSubType(items[i]) === 'dropdown') {
                        _hide(tems[i]);
                    }
                }
            }
        }
    }

    // Mouseover handle
    var _mouseover = function(element, e) {
        var item = _getItemElement(element);

        if ( item === null ) {
            return;
        }

        if ( _getItemOption(item, 'trigger') !== 'hover' ) {
            return;
        }

        if ( MVUtil.data(item).get('hover') === '1' ) {
            clearTimeout(MVUtil.data(item).get('timeout'));
            MVUtil.data(item).remove('hover');
            MVUtil.data(item).remove('timeout');
        }

        _show(item);
    }

    // Mouseout handle
    var _mouseout = function(element, e) {
        var item = _getItemElement(element);

        if ( item === null ) {
            return;
        }

        if ( _getItemOption(item, 'trigger') !== 'hover' ) {
            return;
        }

        var timeout = setTimeout(function() {
            if ( MVUtil.data(item).get('hover') === '1' ) {
                _hide(item);
            }
        }, the.options.dropdown.hoverTimeout);

        MVUtil.data(item).set('hover', '1');
        MVUtil.data(item).set('timeout', timeout);
    }

    // Toggle item sub
    var _toggle = function(item) {
        if ( !item ) {
            item = the.triggerElement;
        }

        if ( _isItemSubShown(item) === true ) {
            _hide(item);
        } else {
            _show(item);
        }
    }

    // Show item sub
    var _show = function(item) {
        if ( !item ) {
            item = the.triggerElement;
        }

        if ( _isItemSubShown(item) === true ) {
            return;
        }

        if ( _getItemSubType(item) === 'dropdown' ) {
            _showDropdown(item); // // show current dropdown
        } else if ( _getItemSubType(item) === 'accordion' ) {
            _showAccordion(item);
        }

        // Remember last submenu type
        MVUtil.data(item).set('type', _getItemSubType(item));  // updated
    }

    // Hide item sub
    var _hide = function(item) {
        if ( !item ) {
            item = the.triggerElement;
        }

        if ( _isItemSubShown(item) === false ) {
            return;
        }
        
        if ( _getItemSubType(item) === 'dropdown' ) {
            _hideDropdown(item);
        } else if ( _getItemSubType(item) === 'accordion' ) {
            _hideAccordion(item);
        }
    }

    // Reset item state classes if item sub type changed
    var _reset = function(item) {        
        if ( _hasItemSub(item) === false ) {
            return;
        }

        var sub = _getItemSubElement(item);

        // Reset sub state if sub type is changed during the window resize
        if ( MVUtil.data(item).has('type') && MVUtil.data(item).get('type') !== _getItemSubType(item) ) {  // updated
            MVUtil.removeClass(item, 'hover'); 
            MVUtil.removeClass(item, 'show'); 
            MVUtil.removeClass(sub, 'show'); 
        }  // updated
    }

    // Update all item state classes if item sub type changed
    var _update = function() {
        var items = the.element.querySelectorAll('.menu-item[data-mv-menu-trigger]');

        if ( items && items.length > 0 ) {
            for (var i = 0, len = items.length; i < len; i++) {
                _reset(items[i]);
            }
        }
    }

    // Set external trigger element
    var _setTriggerElement = function() {
        var target = document.querySelector('[data-mv-menu-target="# ' + the.element.getAttribute('id')  + '"]');

        if ( target !== null ) {
            the.triggerElement = target;
        } else if ( the.element.closest('[data-mv-menu-trigger]') ) {
            the.triggerElement = the.element.closest('[data-mv-menu-trigger]');
        } else if ( the.element.parentNode && MVUtil.child(the.element.parentNode, '[data-mv-menu-trigger]')) {
            the.triggerElement = MVUtil.child(the.element.parentNode, '[data-mv-menu-trigger]');
        }

        if ( the.triggerElement ) {
            MVUtil.data(the.triggerElement).set('menu', the);
        }
    }

    // Test if menu has external trigger element
    var _isTriggerElement = function(item) {
        return ( the.triggerElement === item ) ? true : false;
    }

    // Test if item's sub is shown
    var _isItemSubShown = function(item) {
        var sub = _getItemSubElement(item);

        if ( sub !== null ) {
            if ( _getItemSubType(item) === 'dropdown' ) {
                if ( MVUtil.hasClass(sub, 'show') === true && sub.hasAttribute('data-popper-placement') === true ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return MVUtil.hasClass(item, 'show');
            }
        } else {
            return false;
        }
    }

    // Test if item dropdown is permanent
    var _isItemDropdownPermanent = function(item) {
        return _getItemOption(item, 'permanent') === true ? true : false;
    }

    // Test if item's parent is shown
    var _isItemParentShown = function(item) {
        return MVUtil.parents(item, '.menu-item.show').length > 0;
    }

    // Test of it is item sub element
    var _isItemSubElement = function(item) {
        return MVUtil.hasClass(item, 'menu-sub');
    }

    // Test if item has sub
    var _hasItemSub = function(item) {
        return (MVUtil.hasClass(item, 'menu-item') && item.hasAttribute('data-mv-menu-trigger'));
    }

    // Get link element
    var _getItemLinkElement = function(item) {
        return MVUtil.child(item, '.menu-link');
    }

    // Get toggle element
    var _getItemToggleElement = function(item) {
        if ( the.triggerElement ) {
            return the.triggerElement;
        } else {
            return _getItemLinkElement(item);
        }
    }

    // Get item sub element
    var _getItemSubElement = function(item) {
        if ( _isTriggerElement(item) === true ) {
            return the.element;
        } if ( item.classList.contains('menu-sub') === true ) {
            return item;
        } else if ( MVUtil.data(item).has('sub') ) {
            return MVUtil.data(item).get('sub');
        } else {
            return MVUtil.child(item, '.menu-sub');
        }
    }

    // Get item sub type
    var _getItemSubType = function(element) {
        var sub = _getItemSubElement(element);

        if ( sub && parseInt(MVUtil.css(sub, 'z-index')) > 0 ) {
            return "dropdown";
        } else {
            return "accordion";
        }
    }

    // Get item element
    var _getItemElement = function(element) {
        var item, sub;

        // Element is the external trigger element
        if (_isTriggerElement(element) ) {
            return element;
        }   

        // Element has item toggler attribute
        if ( element.hasAttribute('data-mv-menu-trigger') ) {
            return element;
        }

        // Element has item DOM reference in it's data storage
        if ( MVUtil.data(element).has('item') ) {
            return MVUtil.data(element).get('item');
        }

        // Item is parent of element
        if ( (item = element.closest('.menu-item[data-mv-menu-trigger]')) ) {
            return item;
        }

        // Element's parent has item DOM reference in it's data storage
        if ( (sub = element.closest('.menu-sub')) ) {
            if ( MVUtil.data(sub).has('item') === true ) {
                return MVUtil.data(sub).get('item')
            } 
        }
    }

    // Get item parent element
    var _getItemParentElement = function(item) {  
        var sub = item.closest('.menu-sub');
        var parentItem;

        if ( MVUtil.data(sub).has('item') ) {
            return MVUtil.data(sub).get('item');
        }

        if ( sub && (parentItem = sub.closest('.menu-item[data-mv-menu-trigger]')) ) {
            return parentItem;
        }

        return null;
    }

    // Get item parent elements
    var _getItemParentElements = function(item) {
        var parents = [];
        var parent;
        var i = 0;

        do {
            parent = _getItemParentElement(item);
            
            if ( parent ) {
                parents.push(parent);
                item = parent;
            }           

            i++;
        } while (parent !== null && i < 20);

        if ( the.triggerElement ) {
            parents.unshift(the.triggerElement);
        }

        return parents;
    }

    // Get item child element
    var _getItemChildElement = function(item) {
        var selector = item;
        var element;

        if ( MVUtil.data(item).get('sub') ) {
            selector = MVUtil.data(item).get('sub');
        }

        if ( selector !== null ) {
            //element = selector.querySelector('.show.menu-item[data-mv-menu-trigger]');
            element = selector.querySelector('.menu-item[data-mv-menu-trigger]');

            if ( element ) {
                return element;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }   
    
    // Get item child elements
    var _getItemChildElements = function(item) {
        var children = [];
        var child;
        var i = 0;

        do {
            child = _getItemChildElement(item);
            
            if ( child ) {
                children.push(child);
                item = child;
            }           

            i++;
        } while (child !== null && i < 20);

        return children;
    }

    // Show item dropdown
    var _showDropdown = function(item) {
        // Handle dropdown show event
        if ( MVEventHandler.trigger(the.element, 'mv.menu.dropdown.show', item) === false )  {
            return;
        }

        // Hide all currently shown dropdowns except current one
        MVMenu.hideDropdowns(item); 

        var toggle = _isTriggerElement(item) ? item : _getItemLinkElement(item);
        var sub = _getItemSubElement(item);

        var width = _getItemOption(item, 'width');
        var height = _getItemOption(item, 'height');

        var zindex = the.options.dropdown.zindex; // update
        var parentZindex = MVUtil.getHighestZindex(item); // update

        // Apply a new z-index if dropdown's toggle element or it's parent has greater z-index // update
        if ( parentZindex !== null && parentZindex >= zindex ) {
            zindex = parentZindex + 1;
        }

        if ( zindex > 0 ) {
            MVUtil.css(sub, 'z-index', zindex);
        }

        if ( width !== null ) {
            MVUtil.css(sub, 'width', width);
        }

        if ( height !== null ) {
            MVUtil.css(sub, 'height', height);
        }

        MVUtil.css(sub, 'display', '');
        MVUtil.css(sub, 'overflow', '');

        // Init popper(new)
        _initDropdownPopper(item, sub); 

        MVUtil.addClass(item, 'show');
        MVUtil.addClass(item, 'menu-dropdown');
        MVUtil.addClass(sub, 'show');

        // Append the sub the the root of the menu
        if ( _getItemOption(item, 'overflow') === true ) {
            document.body.appendChild(sub);
            MVUtil.data(item).set('sub', sub);
            MVUtil.data(sub).set('item', item);
            MVUtil.data(sub).set('menu', the);
        } else {
            MVUtil.data(sub).set('item', item);
        }

        // Handle dropdown shown event
        MVEventHandler.trigger(the.element, 'mv.menu.dropdown.shown', item);
    }

    // Hide item dropdown
    var _hideDropdown = function(item) {
        // Handle dropdown hide event
        if ( MVEventHandler.trigger(the.element, 'mv.menu.dropdown.hide', item) === false )  {
            return;
        }

        var sub = _getItemSubElement(item);

        MVUtil.css(sub, 'z-index', '');
        MVUtil.css(sub, 'width', '');
        MVUtil.css(sub, 'height', '');

        MVUtil.removeClass(item, 'show');
        MVUtil.removeClass(item, 'menu-dropdown');
        MVUtil.removeClass(sub, 'show');

        // Append the sub back to it's parent
        if ( _getItemOption(item, 'overflow') === true ) {
            if (item.classList.contains('menu-item')) {
                item.appendChild(sub);
            } else {
                MVUtil.insertAfter(the.element, item);
            }
            
            MVUtil.data(item).remove('sub');
            MVUtil.data(sub).remove('item');
            MVUtil.data(sub).remove('menu');
        } 

        // Destroy popper(new)
        _destroyDropdownPopper(item);
        
        // Handle dropdown hidden event 
        MVEventHandler.trigger(the.element, 'mv.menu.dropdown.hidden', item);
    }

    // Init dropdown popper(new)
    var _initDropdownPopper = function(item, sub) {
        // Setup popper instance
        var reference;
        var attach = _getItemOption(item, 'attach');

        if ( attach ) {
            if ( attach === 'parent') {
                reference = item.parentNode;
            } else {
                reference = document.querySelector(attach);
            }
        } else {
            reference = item;
        }

        var popper = Popper.createPopper(reference, sub, _getDropdownPopperConfig(item)); 
        MVUtil.data(item).set('popper', popper);
    }

    // Destroy dropdown popper(new)
    var _destroyDropdownPopper = function(item) {
        if ( MVUtil.data(item).has('popper') === true ) {
            MVUtil.data(item).get('popper').destroy();
            MVUtil.data(item).remove('popper');
        }
    }

    // Prepare popper config for dropdown(see: https://popper.js.org/docs/v2/)
    var _getDropdownPopperConfig = function(item) {
        // Placement
        var placement = _getItemOption(item, 'placement');
        if (!placement) {
            placement = 'right';
        }

        // Offset
        var offsetValue = _getItemOption(item, 'offset');
        var offset = offsetValue ? offsetValue.split(",") : [];

        // Strategy
        var strategy = _getItemOption(item, 'overflow') === true ? 'absolute' : 'fixed';

        var altAxis = _getItemOption(item, 'flip') !== false ? true : false;

        var popperConfig = {
            placement: placement,
            strategy: strategy,
            modifiers: [{
                name: 'offset',
                options: {
                    offset: offset
                }
            }, {
                name: 'preventOverflow',
                options: {
                    altAxis: altAxis
                }
            }, {
                name: 'flip', 
                options: {
                    flipVariations: false
                }
            }]
        };

        return popperConfig;
    }

    // Show item accordion
    var _showAccordion = function(item) {
        if ( MVEventHandler.trigger(the.element, 'mv.menu.accordion.show', item) === false )  {
            return;
        }

        if ( the.options.accordion.expand === false ) {
            _hideAccordions(item);
        }

        var sub = _getItemSubElement(item);

        if ( MVUtil.data(item).has('popper') === true ) {
            _hideDropdown(item);
        }

        MVUtil.addClass(item, 'hover'); // updateWW

        MVUtil.addClass(item, 'showing');

        MVUtil.slideDown(sub, the.options.accordion.slideSpeed, function() {
            MVUtil.removeClass(item, 'showing');
            MVUtil.addClass(item, 'show');
            MVUtil.addClass(sub, 'show');

            MVEventHandler.trigger(the.element, 'mv.menu.accordion.shown', item);
        });        
    }

    // Hide item accordion
    var _hideAccordion = function(item) {
        if ( MVEventHandler.trigger(the.element, 'mv.menu.accordion.hide', item) === false )  {
            return;
        }
        
        var sub = _getItemSubElement(item);

        MVUtil.addClass(item, 'hiding');

        MVUtil.slideUp(sub, the.options.accordion.slideSpeed, function() {
            MVUtil.removeClass(item, 'hiding');
            MVUtil.removeClass(item, 'show');
            MVUtil.removeClass(sub, 'show');

            MVUtil.removeClass(item, 'hover'); // update

            MVEventHandler.trigger(the.element, 'mv.menu.accordion.hidden', item);
        });
    }

    // Hide all shown accordions of item
    var _hideAccordions = function(item) {
        var itemsToHide = MVUtil.findAll(the.element, '.show[data-mv-menu-trigger]');
        var itemToHide;

        if (itemsToHide && itemsToHide.length > 0) {
            for (var i = 0, len = itemsToHide.length; i < len; i++) {
                itemToHide = itemsToHide[i];

                if ( _getItemSubType(itemToHide) === 'accordion' && itemToHide !== item && item.contains(itemToHide) === false && itemToHide.contains(item) === false ) {
                    _hideAccordion(itemToHide);
                }
            }
        }
    }

    // Get item option(through html attributes)
    var _getItemOption = function(item, name) {
        var attr;
        var value = null;

        if ( item && item.hasAttribute('data-mv-menu-' + name) ) {
            attr = item.getAttribute('data-mv-menu-' + name);
            value = MVUtil.getResponsiveValue(attr);

            if ( value !== null && String(value) === 'true' ) {
                value = true;
            } else if ( value !== null && String(value) === 'false' ) {
                value = false;
            }
        }

        return value;
    }

    var _destroy = function() {
        MVUtil.data(the.element).remove('menu');
    }

    // Construct Class
    _construct();

    ///////////////////////
    // ** Public API  ** //
    ///////////////////////

    // Event Handlers
    the.click = function(element, e) {
        return _click(element, e);
    }

    the.link = function(element, e) {
        return _link(element, e);
    }

    the.dismiss = function(element, e) {
        return _dismiss(element, e);
    }

    the.mouseover = function(element, e) {
        return _mouseover(element, e);
    }

    the.mouseout = function(element, e) {
        return _mouseout(element, e);
    }

    // General Methods
    the.getItemTriggerType = function(item) {
        return _getItemOption(item, 'trigger');
    }

    the.getItemSubType = function(element) {
       return _getItemSubType(element);
    }

    the.show = function(item) {
        return _show(item);
    }

    the.hide = function(item) {
        return _hide(item);
    }

    the.reset = function(item) {
        return _reset(item);
    }

    the.update = function() {
        return _update();
    }

    the.getElement = function() {
        return the.element;
    }

    the.getItemLinkElement = function(item) {
        return _getItemLinkElement(item);
    }

    the.getItemToggleElement = function(item) {
        return _getItemToggleElement(item);
    }

    the.getItemSubElement = function(item) {
        return _getItemSubElement(item);
    }

    the.getItemParentElements = function(item) {
        return _getItemParentElements(item);
    }

    the.isItemSubShown = function(item) {
        return _isItemSubShown(item);
    }

    the.isItemParentShown = function(item) {
        return _isItemParentShown(item);
    }

    the.getTriggerElement = function() {
        return the.triggerElement;
    }

    the.isItemDropdownPermanent = function(item) {
        return _isItemDropdownPermanent(item);
    }

    the.destroy = function() {
        return _destroy();
    }

    // Accordion Mode Methods
    the.hideAccordions = function(item) {
        return _hideAccordions(item);
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
};

// Get MVMenu instance by element
MVMenu.getInstance = function(element) {
    var menu;
    var item;

    // Element has menu DOM reference in it's DATA storage
    if ( MVUtil.data(element).has('menu') ) {
        return MVUtil.data(element).get('menu');
    }

    // Element has .menu parent 
    if ( menu = element.closest('.menu') ) {
        if ( MVUtil.data(menu).has('menu') ) {
            return MVUtil.data(menu).get('menu');
        }
    }
    
    // Element has a parent with DOM reference to .menu in it's DATA storage
    if ( MVUtil.hasClass(element, 'menu-link') ) {
        var sub = element.closest('.menu-sub');

        if ( MVUtil.data(sub).has('menu') ) {
            return MVUtil.data(sub).get('menu');
        }
    } 

    return null;
}

// Hide all dropdowns and skip one if provided
MVMenu.hideDropdowns = function(skip) {
    var items = document.querySelectorAll('.show.menu-dropdown[data-mv-menu-trigger]');

    if (items && items.length > 0) {
        for (var i = 0, len = items.length; i < len; i++) {
            var item = items[i];
            var menu = MVMenu.getInstance(item);

            if ( menu && menu.getItemSubType(item) === 'dropdown' ) {
                if ( skip ) {
                    if ( menu.getItemSubElement(item).contains(skip) === false && item.contains(skip) === false &&  item !== skip ) {
                        menu.hide(item);
                    }
                } else {
                    menu.hide(item);
                }
            }
        }
    }
}

// Update all dropdowns popover instances
MVMenu.updateDropdowns = function() {
    var items = document.querySelectorAll('.show.menu-dropdown[data-mv-menu-trigger]');

    if (items && items.length > 0) {
        for (var i = 0, len = items.length; i < len; i++) {
            var item = items[i];

            if ( MVUtil.data(item).has('popper') ) {
                MVUtil.data(item).get('popper').forceUpdate();
            }
        }
    }
}

// Global handlers
MVMenu.initGlobalHandlers = function() {
    // Dropdown handler
    document.addEventListener("click", function(e) {
        var items = document.querySelectorAll('.show.menu-dropdown[data-mv-menu-trigger]');
        var menu;
        var item;
        var sub;
        var menuObj;

        if ( items && items.length > 0 ) {
            for ( var i = 0, len = items.length; i < len; i++ ) {
                item = items[i];
                menuObj = MVMenu.getInstance(item);

                if (menuObj && menuObj.getItemSubType(item) === 'dropdown') {
                    menu = menuObj.getElement();
                    sub = menuObj.getItemSubElement(item);

                    if ( item === e.target || item.contains(e.target) ) {
                        continue;
                    }
                    
                    if ( sub === e.target || sub.contains(e.target) ) {
                        continue;
                    }
                        
                    menuObj.hide(item);
                }
            }
        }
    });

    // Sub toggle handler(updated)
    MVUtil.on(document.body,  '.menu-item[data-mv-menu-trigger] > .menu-link, [data-mv-menu-trigger]:not(.menu-item):not([data-mv-menu-trigger="auto"])', 'click', function(e) {
        var menu = MVMenu.getInstance(this);

        if ( menu !== null ) {
            return menu.click(this, e);
        }
    });

    // Link handler
    MVUtil.on(document.body,  '.menu-item:not([data-mv-menu-trigger]) > .menu-link', 'click', function(e) {
        var menu = MVMenu.getInstance(this);

        if ( menu !== null ) {
            return menu.link(this, e);
        }
    });

    // Dismiss handler
    MVUtil.on(document.body,  '[data-mv-menu-dismiss="true"]', 'click', function(e) {
        var menu = MVMenu.getInstance(this);

        if ( menu !== null ) {
            return menu.dismiss(this, e);
        }
    });

    // Mouseover handler
    MVUtil.on(document.body,  '[data-mv-menu-trigger], .menu-sub', 'mouseover', function(e) {
        var menu = MVMenu.getInstance(this);

        if ( menu !== null && menu.getItemSubType(this) === 'dropdown' ) {
            return menu.mouseover(this, e);
        }
    });

    // Mouseout handler
    MVUtil.on(document.body,  '[data-mv-menu-trigger], .menu-sub', 'mouseout', function(e) {
        var menu = MVMenu.getInstance(this);

        if ( menu !== null && menu.getItemSubType(this) === 'dropdown' ) {
            return menu.mouseout(this, e);
        }
    });

    // Resize handler
    window.addEventListener('resize', function() {
        var menu;
        var timer;

        MVUtil.throttle(timer, function() {
            // Locate and update Offcanvas instances on window resize
            var elements = document.querySelectorAll('[data-mv-menu="true"]');

            if ( elements && elements.length > 0 ) {
                for (var i = 0, len = elements.length; i < len; i++) {
                    menu = MVMenu.getInstance(elements[i]);
                    if (menu) {
                        menu.update();
                    }
                }
            }
        }, 200);
    });
}

// Global instances
MVMenu.createInstances = function(selector = '[data-mv-menu="true"]') {
    // Initialize menus
    var elements = document.querySelectorAll(selector);
    if ( elements && elements.length > 0 ) {
        for (var i = 0, len = elements.length; i < len; i++) {
            new MVMenu(elements[i]);
        }
    }
}

// Global initialization
MVMenu.init = function() {
    // Global Event Handlers
    MVMenu.initGlobalHandlers();

    // Lazy Initialization
    MVMenu.createInstances();
};

// On document ready
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', MVMenu.init);
} else {
   MVMenu.init();
}

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = MVMenu;
}
