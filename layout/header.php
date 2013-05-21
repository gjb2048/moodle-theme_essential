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
$hasflickr      = (empty($PAGE->theme->settings->flickr)) ? false : $PAGE->theme->settings->flickr;
$haspicasa      = (empty($PAGE->theme->settings->picasa)) ? false : $PAGE->theme->settings->picasa;
$haslinkedin    = (empty($PAGE->theme->settings->linkedin)) ? false : $PAGE->theme->settings->linkedin;
$hasyoutube     = (empty($PAGE->theme->settings->youtube)) ? false : $PAGE->theme->settings->youtube;

?>
<header id="page-header" class="clearfix">
    <div class="container-fluid">
    <div class="row">
    <!-- HEADER: LOGO AREA -->
        <div class="span5 desktop-first-column">
            <?php
            if (!$haslogo) { ?>
                <h1><?php echo $PAGE->heading; ?></h1>
            <?php
            } else { ?>
                <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
            <?php
            } ?>
        </div>
        <div class="span3 pull-right">
            <ul class="socials unstyled">
            <p>Our Social Networks</p>
                <?php if ($hasgoogleplus) { ?>
                <li><a class="googleplus" href="<?php echo $hasgoogleplus; ?>"></a></li>
                <?php } ?>
                <?php if ($hastwitter) { ?>
                <li><a class="twitter" href="<?php echo $hastwitter; ?>"></a></li>
                <?php } ?>
                <?php if ($hasfacebook) { ?>
                <li><a class="facebook" href="<?php echo $hasfacebook; ?>"></a></li>
                <?php } ?>
                <?php if ($haslinkedin) { ?>
                <li><a class="linkedin" href="<?php echo $haslinkedin; ?>"></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php if (!empty($courseheader)) { ?>
        <div id="course-header"><?php echo $courseheader; ?></div>
        <?php } ?>
    </div>
</header>
