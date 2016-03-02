/* jshint ignore:start */
define(['jquery', 'theme_essential/bootstrap', 'core/log'], function($, bootstrap, log) {

    "use strict"; // jshint ;_;

    log.debug('Essential Style Guide AMD');

    return {
        init: function() {
            $(document).ready(function($) {
                $("[data-toggle=tooltip]").tooltip();
                $("[data-toggle=popover]").popover().click(function(e) {
                    e.preventDefault()
                });
            });
            log.debug('Essential Style Guide AMD init');
        }
    }
});
/* jshint ignore:end */
