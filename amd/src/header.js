/**
 * Essential is a clean and customizable theme.
 *
 * @package     theme_essential
 * @copyright   2016 Gareth J Barnard
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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
