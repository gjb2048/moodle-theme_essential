<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This code was written and released by Bas Brands and is added as a
 * value add to the essential theme.
 *
 *
 * @package   theme_essential
 * @copyright 2013 Julian Ridden
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
//Check for theme settings 
$hascleanurl = (empty($PAGE->theme->settings->analyticsclean)) ? false : $PAGE->theme->settings->analyticsclean;

$trackurl = '';

global $DB;
	
if ($COURSE->id != 1 ){

    //Add course category name
    if ($category = $DB->get_record('course_categories',array('id'=>$COURSE->category))){
        $trackurl .= '/' . urlencode($category->name);
    }

    //Add course name
    $trackurl .= '/' . urlencode($COURSE->shortname);
}

//Use navigation bar to get items
$navbar = $OUTPUT->page->navbar->get_items();

//remove first item (home)
$first = array_shift($navbar);

foreach ($navbar as $item) {
    //get section name
    if ($item->type == "30") {
        $trackurl .= '/' . urlencode($item->title) ;
    }
    //get activity type
    if ($item->type == "40") {
        $trackurl .= '/' . urlencode($item->text) ;
        $trackurl .= '/' . urlencode($item->title) ;
    }
    //get action type
    if ($item->type == "60") {
        $trackurl .= '/' . urlencode($item->title) ;
    }
}

?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $PAGE->theme->settings->analyticsid;?>']);
  <?php if ($hascleanurl) { ?>
  	_gaq.push(['_trackPageview','<?php echo $trackurl;?>']);
  <?php } else { ?>
  	_gaq.push(['_trackPageview']);
  <?php } ?>

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
    '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();
</script>