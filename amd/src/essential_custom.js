/* jshint ignore:start */
define(['jquery', 'core/log'], function(jQuery, log) {

  "use strict"; // jshint ;_;

  log.debug('Essential custom AMD initialised');

  jQuery(document).ready(function() {
    // Note: Update event names if upgrade to BS3 - see BS docs.
    var menu = jQuery('#essentialmenus');
    menu.on('hide', function (event) {
      jQuery(this).attr('shown', 'no');
      log.debug('#essentialmenus remove shown');
    });
    menu.on('shown', function (event) {
      jQuery(this).attr('shown', 'yes');
      log.debug('#essentialmenus add shown');
    });
  });
});
/* jshint ignore:end */
