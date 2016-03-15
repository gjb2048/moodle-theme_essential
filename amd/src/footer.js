/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Essential Footer AMD.');

    return {
        init: function() {
            log.debug('Essential Footer AMD init.');
            $(document).ready(function($) {
                var documentHeight = $(document).height();
                if ($('html').height() < documentHeight) {
                    log.debug('Essential Footer AMD adjusting footer position.');
                    var theOffset = 0;
                    var footer = $('footer');
                    var footerOffset = footer.offset().top;
                    if ($('footer .copy').length) {
                        var copy = $('footer .copy');
                        theOffset = (copy.offset().top + copy.outerHeight()) - footerOffset;
                        log.debug('Calculated footer copyright offset: ' + theOffset + '.');
                    } else {
                        var footerperformance = $('footer .footerperformance');
                        theOffset = footerperformance.offset().top - footerOffset;
                        log.debug('Calculated footer performance offset: ' + theOffset + '.');
                    }
                    theOffset = documentHeight - theOffset;
                    log.debug('Old footer offset: ' + footerOffset + '.');
                    log.debug('Calculated footer offset: ' + theOffset + '.');
                    log.debug('Old document height: ' + documentHeight + '.');
                    footer.offset({ top: theOffset, left: 0});
                    var newOffset = footer.offset().top;
                    log.debug('New footer offset: ' + newOffset + '.');
                    log.debug('New document height: ' + $(document).height() + '.');
                }
            });
        }
    }
});
/* jshint ignore:end */
