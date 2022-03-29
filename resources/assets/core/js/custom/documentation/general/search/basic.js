"use strict";

// Class definition
var MVGeneralSearchBasicDemos = function() {
    // Private variables
    var element;
    var suggestionsElement;
    var resultsElement;
    var wrapperElement;
    var emptyElement;
    var searchObject;
    
    var modal;

    // Private functions
    var processs = function(search) {
        var timeout = setTimeout(function() {
            var number = MVUtil.getRandomInt(1, 6);

            // Hide recently viewed
            suggestionsElement.classList.add('d-none');

            if (number === 3) {
                // Hide results
                resultsElement.classList.add('d-none');
                // Show empty message 
                emptyElement.classList.remove('d-none');
            } else {
                // Show results
                resultsElement.classList.remove('d-none');
                // Hide empty message 
                emptyElement.classList.add('d-none');
            }                  

            // Complete search
            search.complete();
        }, 1500);
    }

    var clear = function(search) {
        // Show recently viewed
        suggestionsElement.classList.remove('d-none');
        // Hide results
        resultsElement.classList.add('d-none');
        // Hide empty message 
        emptyElement.classList.add('d-none');
    }    

    // Public methods
	return {
		init: function() {
            // Elements
            element = document.querySelector('#mv_docs_search_handler_basic');

            if (!element) {
                return;
            }

            wrapperElement = element.querySelector('[data-mv-search-element="wrapper"]');
            suggestionsElement = element.querySelector('[data-mv-search-element="suggestions"]');
            resultsElement = element.querySelector('[data-mv-search-element="results"]');
            emptyElement = element.querySelector('[data-mv-search-element="empty"]');
            
            // Initialize search handler
            searchObject = new MVSearch(element);

            // Search handler
            searchObject.on('mv.search.process', processs);

            // Clear handler
            searchObject.on('mv.search.clear', clear);

            // Handle select
            MVUtil.on(element, '[data-mv-search-element="customer"]', 'click', function() {
                //modal.hide();
            });
		}
	};
}();

// On document ready
MVUtil.onDOMContentLoaded(function () {
    MVGeneralSearchBasicDemos.init();
});