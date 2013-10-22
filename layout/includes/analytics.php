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
} else {
	$trackurl = $SITE->shortname;
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
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');


	ga('create', '<?php echo $PAGE->theme->settings->analyticsid;?>', 
	{
		'cookieDomain': '<?php echo preg_replace("(https?://)", "", $CFG->wwwroot);?>',
		'cookieExpires': '<?php echo $CFG->sessiontimeout;?>'
	});
	<?php if ($hascleanurl) { ?>
		ga('send', 'pageview', 
		{
			'page': '<?php echo $trackurl;?>',
			'title': '<?php echo $PAGE->heading;?>'
		});
	<?php } else { ?>
		ga('send', 'pageview' );

	<?php } ?>
</script>