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

/* Default globals */
global $CFG, $PAGE, $USER, $SITE, $COURSE;

/* Group Body */
$bodyclasses = array();

if (theme_essential_get_setting('enablealternativethemecolors1') ||
    theme_essential_get_setting('enablealternativethemecolors2') ||
    theme_essential_get_setting('enablealternativethemecolors3')
) {
    $colourswitcher = true;
    theme_essential_check_colours_switch();
    theme_essential_initialise_colourswitcher($PAGE);
    $bodyclasses[]  = 'essential-colours-' . theme_essential_get_colours();
} else {
    $colourswitcher = false;
}

$devicetype = core_useragent::get_device_type(); // In /lib/classes/useragent.php.
if ($devicetype == "mobile") {
    $bodyclasses[] = 'mobiledevice';
} else if ($devicetype == "tablet") {
    $bodyclasses[] = 'tabletdevice';
} else {
    $bodyclasses[] = 'desktopdevice';
}

switch (theme_essential_get_setting('pagewidth')) {
    case 100:
        $bodyclasses[] = 'pagewidthvariable';
        break;
    case 960:
        $bodyclasses[] = 'pagewidthnarrow';
        break;
    case 1200:
        $bodyclasses[] = 'pagewidthnormal';
        break;
    case 1400:
        $bodyclasses[] = 'pagewidthwide';
        break;
}
if (!empty($CFG->custommenuitems)) {
    $bodyclasses[] = 'custommenuitems';
}
if (theme_essential_get_setting('enablecategoryicon')) {
    $bodyclasses[] = 'categoryicons';
}

if (($PAGE->pagelayout == 'course') && (get_config('core', 'modeditingmenu'))) {
    $bodyclasses[] = 'modeditingmenu';
}

$regionbsid = 'region-bs-main-and-pre';
$left = true;
if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-pre';
    $left = false;
}

$fontselect = theme_essential_get_setting('fontselect');
if ($fontselect === '2') {
    $fontcharacterset = '&subset=latin';
    if (theme_essential_get_setting('fontcharacterset')) {
        $fontcharacterset = '&subset=latin,'.theme_essential_get_setting('fontcharacterset');
    }
    $headingfont = urlencode(theme_essential_get_setting('fontnameheading'));
    $bodyfont = urlencode(theme_essential_get_setting('fontnamebody'));
}

/* Group Header */
$hassocialnetworks = (
    theme_essential_get_setting('facebook') ||
    theme_essential_get_setting('twitter') ||
    theme_essential_get_setting('googleplus') ||
    theme_essential_get_setting('linkedin') ||
    theme_essential_get_setting('youtube') ||
    theme_essential_get_setting('flickr') ||
    theme_essential_get_setting('vk') ||
    theme_essential_get_setting('pinterest') ||
    theme_essential_get_setting('instagram') ||
    theme_essential_get_setting('skype') ||
    theme_essential_get_setting('website')
);
$hasmobileapps = (theme_essential_get_setting('ios') ||
    theme_essential_get_setting('android')
);

$logoclass = 'ecol12';
if ($hassocialnetworks || $hasmobileapps) {
    $logoclass = 'ecol7';
}

$oldnavbar = theme_essential_get_setting('oldnavbar');
$haslogo = theme_essential_get_setting('logo');

/* Group Content */
$hasboringlayout = theme_essential_get_setting('layout');
if ($hasboringlayout) {
    $bodyclasses[] = 'hasboringlayout';
}

/* Group Report Page Title */
function essential_report_page_has_title() {
    global $PAGE;
    $hastitle = true;

    switch ($PAGE->pagetype) {
        case 'grade-report-overview-index':
            $hastitle = false;
            break;
        default: break;
    }

    return $hastitle;
}

/* Group Page Footer Region */
function essential_has_footer_region() {
    global $PAGE;
    $hasregion = false;

    switch ($PAGE->pagetype) {
        case 'admin-plugins':
        case 'course-management':
        case 'mod-assign-view':
        case 'mod-quiz-edit':
            $hasregion = true;
            break;
        default: break;
    }

    return $hasregion;
}

/* Group Footer */
$hascopyright = theme_essential_get_setting('copyright', true);
$hasfootnote = theme_essential_get_setting('footnote', 'format_html');

/* Group Breadcrumb */
$breadcrumbstyle = theme_essential_get_setting('breadcrumbstyle');
