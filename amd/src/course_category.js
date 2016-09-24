/**
 * Essential is a clean and customizable theme.
 *
 * @package     theme_essential
 * @copyright   2016 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Essential course category AMD');

    return {
        init: function() {
            $(document).ready(function($) {
                if ($('.categoryicons .essentialcats').length) {
                    var $caticons = $('.categoryicons .essentialcats');
                    var max = 0;
                    var current = 0;
                    var count = 0;
                    $caticons.each(function() {
                        current = $(this).height();
                        if (current > max) {
                            max = current;
                        }
                        count++;
                    });
                    if (count > 1) {
                        $caticons.each(function() {
                            $(this).height(max);
                        });
                        log.debug('Essential course category set to: ' + max);
                    }
                }
            });
            log.debug('Essential course category AMD init.');
        }
    }
});
/* jshint ignore:end */
