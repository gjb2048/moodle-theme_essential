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
 *
 * @package   theme_essential
 * @copyright 2013 Julian Ridden
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hasiphoneicon = (!empty($PAGE->theme->settings->iphoneicon));
$hasipadicon = (!empty($PAGE->theme->settings->ipadicon));
$hasiphoneretinaicon = (!empty($PAGE->theme->settings->iphoneretinaicon));
$hasipadretinaicon = (!empty($PAGE->theme->settings->ipadretinaicon));

if ($hasiphoneicon) {
    $iphoneicon = $PAGE->theme->settings->iphoneicon;
} else {
	$iphoneicon = $OUTPUT->pix_url('homeicon/iphone', 'theme');
}

if ($hasipadicon) {
    $ipadicon = $PAGE->theme->settings->ipadicon;
} else {
	$ipadicon = $OUTPUT->pix_url('homeicon/ipad', 'theme');
}

if ($hasiphoneretinaicon) {
    $iphoneretinaicon = $PAGE->theme->settings->iphoneretinaicon;
} else {
	$iphoneretinaicon = $OUTPUT->pix_url('homeicon/iphone_retina', 'theme');
}

if ($hasipadretinaicon) {
    $ipadretinaicon = $PAGE->theme->settings->ipadretinaicon;
} else {
	$ipadretinaicon = $OUTPUT->pix_url('homeicon/ipad_retina', 'theme');
}
?>

<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $iphoneicon ?>" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $ipadicon ?>" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $iphoneretinaicon ?>" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $ipadretinaicon ?>" />