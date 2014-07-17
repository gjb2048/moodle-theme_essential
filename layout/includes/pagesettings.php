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
 * This is built using the bootstrapbase template to allow for new theme's using
 * Moodle's new Bootstrap theme engine
 *
 * @package     theme_essential
 * @copyright   2013 Julian Ridden
 * @copyright   2014 Gareth J Barnard, David Bezemer
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
/* Group Body */
theme_essential_check_colours_switch();
theme_essential_initialise_colourswitcher($PAGE);

$bodyclasses = array();
$bodyclasses[] = 'essential-colours-' . theme_essential_get_colours();
if ($PAGE->theme->settings->sideregionsmaxwidth) {
    $bodyclasses[] = 'side-regions-with-max-width';
}
 
if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
    $left = false;
} else {
    $regionbsid = 'region-bs-main-and-pre';
    $left = true;
}

$fontselect = $PAGE->theme->settings->fontselect;
 
/* Group Header */

$hasanalytics = $PAGE->theme->settings->useanalytics;

$hassocialnetworks = (  empty($PAGE->theme->settings->facebook)     &&
                        empty($PAGE->theme->settings->twitter)      &&
                        empty($PAGE->theme->settings->googleplus)   &&
                        empty($PAGE->theme->settings->linkedin)     &&
                        empty($PAGE->theme->settings->youtube)      &&
                        empty($PAGE->theme->settings->flickr)       &&
                        empty($PAGE->theme->settings->vk)           &&
                        empty($PAGE->theme->settings->pinterest)    &&
                        empty($PAGE->theme->settings->instagram)    &&
                        empty($PAGE->theme->settings->skype)        &&
                        empty($PAGE->theme->settings->website)
                        ? false : true );
$hasmobileapps =    (   empty($PAGE->theme->settings->ios)          &&
                        empty($PAGE->theme->settings->android)
                        ? false : true );

$hasprofilepic = $PAGE->theme->settings->headerprofilepic;

$logoclass = 'span12';
if (($hassocialnetworks || $hasmobileapps) && $hasprofilepic) {
	$logoclass = 'span6';
} else if (!($hassocialnetworks || $hasmobileapps) && $hasprofilepic) {
	$logoclass = 'span11';
} else if (($hassocialnetworks || $hasmobileapps) && !$hasprofilepic) {
	$logoclass = 'span7';
}

$oldnavbar = $PAGE->theme->settings->oldnavbar;
$haslogo = (!empty($PAGE->theme->settings->logo));

/* Group Slideshow */

/* Group Frontpage */
$alertinfo = '<span class="fa-stack "><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-info fa-stack-1x fa-inverse"></i></span>';
$alertwarning = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-warning fa-stack-1x fa-inverse"></i></span>';
$alertsuccess = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></span>';

$hasmarketing1image = (!empty($PAGE->theme->settings->marketing1image));
$hasmarketing2image = (!empty($PAGE->theme->settings->marketing2image));
$hasmarketing3image = (!empty($PAGE->theme->settings->marketing3image));

/* Group Content */
$hasboringlayout = $PAGE->theme->settings->layout;

/* Group Footer */
$hashiddendock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('hidden-dock', $OUTPUT));
$hascopyright = (empty($PAGE->theme->settings->copyright)) ? false : $PAGE->theme->settings->copyright;
$hasfootnote = (empty($PAGE->theme->settings->footnote)) ? false : $PAGE->theme->settings->footnote;