/**
 * Essential is a clean and customizable theme.
 *
 * @package     theme_essential
 * @copyright   2016 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* jshint ignore:start */
define(['jquery', 'theme_bootstrapbase/bootstrap', 'core/log'], function($, bs, log) {

    "use strict"; // jshint ;_;

    log.debug('Essential Alert AMD');

    return {
        init: function(data) {
            $(document).ready(function($) {
                if ($('#' + data.alertid).length) {
                    $('#' + data.alertid).modal('show');
                }
            });
            log.debug('Essential Alert AMD init: ' + data.alertid + '.');
        }
    }
});
/* jshint ignore:end */
