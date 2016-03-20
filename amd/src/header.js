/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Essential header AMD');

    return {
        init: function() {
            $(document).ready(function($) {
                if (($('#page-header .titlearea').length) && ($('#essentialicons').length)) {
                    var titlearea = $('#page-header .titlearea');
                    $('#essentialicons').on('hide', function() {
                        titlearea.fadeIn();
                    });
                    $('#essentialicons').on('show', function() {
                        titlearea.fadeOut();
                    });
                }
            });
            log.debug('Essential header AMD init');
        }
    }
});
/* jshint ignore:end */
