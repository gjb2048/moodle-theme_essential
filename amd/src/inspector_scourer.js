/**
 * Essential is a clean and customizable theme.
 *
 * @package     theme_essential
 * @copyright   2016 Gareth J Barnard
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* jshint ignore:start */
define(['jquery', 'jqueryui', 'core/log'], function($, jqui, log) {

    "use strict"; // jshint ;_;

    log.debug('Essential Inspector Scourer AMD initialised');

    return {
        init: function(data) {
            $(document).ready(function($) {

                log.debug('Essential Inspector Scourer AMD init');
                log.debug('Essential Inspector Scourer AJAX URL: ' + data.theme);

                $("#courseitemsearch").autocomplete({
                    source: data.theme,
                    appendTo: "#courseitemsearchresults",
                    minLength: 2,
                    response: function(event, ui) {
                        // ui is an array.
                        var tally = ui.content.pop();
                        $('#courseitemsearchtally').text(tally.label);
                    },
                    select: function(event, ui) {
                        var url = ui.item.id;
                        if (url != '#') {
                            location.href = url;
                        }
                    }
                }).prop("disabled", false).on('input', function() {
                    $('#courseitemsearchtally').text('');
                });

                var $courseitemsearchtype = $("#courseitemsearchtype");
                if ($courseitemsearchtype.length) {
                    log.debug('searchallcoursecontentenable enabled');
                    $courseitemsearchtype.click(function() {
                        var $checked = $(this).prop("checked") | 0; // Convert to integer from true or false.
                        log.debug('Essential Inspector Scourer AJAX SACC: ' + $checked);

                        $.ajax({
                            url: data.theme + '&pref=courseitemsearchtype&value=' + $checked,
                            statusCode: {
                                404: function() {
                                    log.debug("Essential Inspector Scourer AJAX SACC - url not found");
                                },
                                406: function() {
                                    log.debug("Essential Inspector Scourer AJAX SACC - value not acceptable");
                                }
                            }
                        });
                    });
                    $courseitemsearchtype.prop("disabled", false);
                } else {
                    log.debug('searchallcoursecontentenable disabled');
                }
            });
        }
    };
});
/* jshint ignore:end */
