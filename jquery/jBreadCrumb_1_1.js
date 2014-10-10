/**
 * @author Jason Roy for CompareNetworks Inc.
 * Thanks to mikejbond for suggested udaptes
 *
 * Version 1.1
 * Copyright (c) 2009 CompareNetworks Inc.
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php
 *
 */
(function($)
{

    // Private variables
    
    var _options = {};
    var _container = {};
    var _breadCrumbElements = {};
    var _autoIntervalArray = [];
	var _easingEquation;
    
    // Public functions
    
    jQuery.fn.jBreadCrumb = function(options)
    {
        _options = $.extend({}, $.fn.jBreadCrumb.defaults, options);
        
        return this.each(function()
        {
            _container = $(this);
            setupBreadCrumb();
        });
        
    };
    
    // Private functions
    
    function setupBreadCrumb()
    {
		//Check if easing plugin exists. If it doesn't, use "swing"
		if(typeof(jQuery.easing) == 'object')
		{
			_easingEquation = 'easeOutQuad'
		}
		else
		{
			_easingEquation = 'swing'
		}
    
        //The reference object containing all of the breadcrumb elements
        _breadCrumbElements = jQuery(_container).find('li');
        
        //Keep it from overflowing in ie6 & 7
        jQuery(_container).find('ul').wrap('<div style="overflow:hidden; position:relative;  width: ' + jQuery(_container).css("width") + ';"><div>');
        
        //If the breadcrumb contains nothing, don't do anything
        if (_breadCrumbElements.length > 0) 
        {
            jQuery(_breadCrumbElements[_breadCrumbElements.length - 1]).addClass('last');
            jQuery(_breadCrumbElements[0]).addClass('first');
            
            //If the breadcrumb object length is long enough, compress.
            
            if (_breadCrumbElements.length > _options.minimumCompressionElements) 
            {
                compressBreadCrumb();
            };
                    };
            };
    
    function compressBreadCrumb()
    {
    
        // Factor to determine if we should compress the element at all
        var finalElement = jQuery(_breadCrumbElements[_breadCrumbElements.length - 1]);
        
        
        // If the final element is really long, compress more elements
        if (jQuery(finalElement).width() > _options.maxFinalElementLength) 
        {
            if (_options.beginningElementsToLeaveOpen > 0)
            {
                _options.beginningElementsToLeaveOpen--;
                
            }
            if (_options.endElementsToLeaveOpen > 0) 
            {
                _options.endElementsToLeaveOpen--;
            }
        }
        // If the final element is within the short and long range, compress to the default end elements and 1 less beginning elements
        if (jQuery(finalElement).width() < _options.maxFinalElementLength && jQuery(finalElement).width() > _options.minFinalElementLength) 
        {
            if (_options.beginningElementsToLeaveOpen > 0)
            {
                _options.beginningElementsToLeaveOpen--;
                
            }
        }
        
        var itemsToRemove = _breadCrumbElements.length - 1 - _options.endElementsToLeaveOpen;
        
        // We compress only elements determined by the formula setting below
        $(_breadCrumbElements).each(function(i, listElement)
        {
            if (i > _options.beginningElementsToLeaveOpen && i < itemsToRemove)
            {
            
                jQuery(listElement).find('a').wrap('<span></span>').width(jQuery(listElement).find('a').width() + _options.previewWidth);
                var options = 
                {
                    id: i,
                    width: jQuery(listElement).width(),
                    listElement: jQuery(listElement).find('span'),
                    isAnimating: false,
                    element: jQuery(listElement).find('span')
                
                };
                jQuery(listElement).bind('mouseover', options, expandBreadCrumb).bind('mouseout', options, shrinkBreadCrumb);
                jQuery(listElement).find('a').unbind('mouseover', expandBreadCrumb).unbind('mouseout', shrinkBreadCrumb);
                listElement.autoInterval = setInterval(function()
                {
                    clearInterval(listElement.autoInterval);
                    jQuery(listElement).find('span').animate(
                    {
                        width: _options.previewWidth
                    }, _options.timeInitialCollapse, _options.easing);
                }, (150 * (i - 2)));
                
            }
        });
        
    };
    
    function expandBreadCrumb(e)
    {
        var originalWidth = e.data.width;
        jQuery(e.data.element).stop();
        jQuery(e.data.element).animate(
        {
            width: originalWidth + (_options.previewWidth / 2)
        }, 
        {
            duration: _options.timeExpansionAnimation,
            easing: _options.easing,
            queue: false
        });
        return false;
        
    };
    
    function shrinkBreadCrumb(e)
    {
        jQuery(e.data.element).stop();
        jQuery(e.data.element).animate(
        {
            width: _options.previewWidth
        }, 
        {
            duration: _options.timeCompressionAnimation,
            easing: _options.easing,
            queue: false
        });
        return false;
    };
    
    // Public global variables
    
    jQuery.fn.jBreadCrumb.defaults = 
    {
        maxFinalElementLength: Math.round($(window).width() * .05),
        minFinalElementLength: Math.round($(window).width() *.02),
        minimumCompressionElements: 1,
        endElementsToLeaveOpen: 0,
        beginningElementsToLeaveOpen: 0,
        timeExpansionAnimation: 500,
        timeCompressionAnimation: 400,
        timeInitialCollapse: 500,
        easing: 'swing',
        previewWidth: Math.round($(window).width() * .015)
    };
    
})(jQuery);
