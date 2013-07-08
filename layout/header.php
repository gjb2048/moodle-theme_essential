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
 * This is built using the Clean template to allow for new theme's using
 * Moodle's new Bootstrap theme engine
 *
 *
 * @package   theme_essential
 * @copyright 2013 Julian Ridden
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hasfacebook    = (empty($PAGE->theme->settings->facebook)) ? false : $PAGE->theme->settings->facebook;
$hastwitter     = (empty($PAGE->theme->settings->twitter)) ? false : $PAGE->theme->settings->twitter;
$hasgoogleplus  = (empty($PAGE->theme->settings->googleplus)) ? false : $PAGE->theme->settings->googleplus;
$haslinkedin    = (empty($PAGE->theme->settings->linkedin)) ? false : $PAGE->theme->settings->linkedin;
$hasyoutube     = (empty($PAGE->theme->settings->youtube)) ? false : $PAGE->theme->settings->youtube;
$hasflickr      = (empty($PAGE->theme->settings->flickr)) ? false : $PAGE->theme->settings->flickr;

/* Modified to check for IE 7/8. Switch headers to remove backgound-size CSS (in Custom CSS) functionality if true */
$checkuseragent = '';
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $checkuseragent = $_SERVER['HTTP_USER_AGENT'];
}
?>

<?php
// Check if IE7 browser and display message
if (strpos($checkuseragent, 'MSIE 7')) {
	echo get_string('ie7message', 'theme_essential');
}?>

<?php
if (strpos($checkuseragent, 'MSIE 8') || strpos($checkuseragent, 'MSIE 7')) {?>
    <header id="page-header-IE7-8" class="clearfix">
<?php
} else { ?>
    <header id="page-header" class="clearfix">
<?php
} ?>

    <div class="container-fluid">
    <div class="row-fluid">
    <!-- HEADER: LOGO AREA -->
        <div class="span8">
            <?php
            if (!$haslogo) { ?>
                <i id="headerlogo" class="icon-<?php echo $PAGE->theme->settings->siteicon ?>"></i>
                <h1 id="title"><?php echo $SITE->shortname; ?></h1>
                <h2 id="subtitle"><?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?></h2>
                
            <?php
            } else { ?>
                
                <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
            <?php
            } ?>
        </div>
        <div class="span4 pull-right">
        <p id="socialheading"><?php echo get_string('socialnetworks','theme_essential')?></p>
            <ul class="socials unstyled">
                <?php if ($hasgoogleplus) { ?>
                <li><a href="<?php echo $hasgoogleplus; ?>"><i class="icon-google-plus-sign"></i></a></li>
                <?php } ?>
                <?php if ($hastwitter) { ?>
                <li><a href="<?php echo $hastwitter; ?>"><i class="icon-twitter-sign"></i></a></li>
                <?php } ?>
                <?php if ($hasfacebook) { ?>
                <li><a href="<?php echo $hasfacebook; ?>"><i class="icon-facebook-sign"></i></a></li>
                <?php } ?>
                <?php if ($haslinkedin) { ?>
                <li><a href="<?php echo $haslinkedin; ?>"><i class="icon-linkedin-sign"></i></a></li>
                <?php } ?>
                <?php if ($hasyoutube) { ?>
                <li><a href="<?php echo $hasyoutube; ?>"><i class="icon-youtube-sign"></i></a></li>
                <?php } ?>
                <?php if ($hasflickr) { ?>
                <li><a href="<?php echo $hasflickr; ?>"><i class="icon-flickr"></i></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php if (!empty($courseheader)) { ?>
        <div id="course-header"><?php echo $courseheader; ?></div>
        <?php } ?>
    </div>
</header>
