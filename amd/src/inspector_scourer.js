/* jshint ignore:start */
define(['jquery', 'jqueryui', 'core/log'], function($, jqui, log) {

    "use strict"; // jshint ;_;

    log.debug('Essential Inspector Scourer AMD initialised');

    return {
        init: function(data) {
            $(document).ready(function($, jqui) {

                log.debug('Essential Inspector Scourer AMD init');
                log.debug('Essential Inspector Scourer AJAX File: ' + data.theme);

                $("#courseitemsearch").autocomplete({
                    source: data.theme,
                    minLength: 2,
                    select: function(event, ui) {
                        var url = ui.item.id;
                        if (url != '#') {
                            location.href = url;
                        }
                    }
                }).prop("disabled", false);
            });
        }
    }
});
/* jshint ignore:end */
