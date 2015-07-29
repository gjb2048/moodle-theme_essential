jQuery(document).ready(function() {
  // Note: Update event names if upgrade to BS3 - see BS docs.
  jQuery('#essentialmenus').on('hide', function () {
    jQuery(this).removeClass('shown');
  });
  jQuery('#essentialmenus').on('shown', function () {
    jQuery(this).addClass('shown');
  });
});
