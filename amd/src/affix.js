/* jshint ignore:start */
define(['jquery', 'theme_essential/bootstrap', 'core/log'], function($, boot, log) {

  "use strict"; // jshint ;_;

  log.debug('Essential affix AMD');

  return {
    init: function() {
      $(document).ready(function($) {
        $('#essentialnavbar').affix({
          offset: {
            top: function() {
              return $('#essentialnavbar').height();
            }
          }
        });
      });
      log.debug('Essential affix AMD init');
    }
  }
});
/* jshint ignore:end */
