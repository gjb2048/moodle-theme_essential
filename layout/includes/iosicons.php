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

$iphoneicon = (!empty($PAGE->theme->settings->iphoneicon) ? 
                    $PAGE->theme->settings->iphoneicon : 
                    $OUTPUT->pix_url('homeicon/iphone', 'theme'));
$ipadicon = (!empty($PAGE->theme->settings->ipadicon) ? 
                    $PAGE->theme->settings->ipadicon : 
                    $OUTPUT->pix_url('homeicon/ipad', 'theme'));
$iphoneretinaicon = (!empty($PAGE->theme->settings->iphoneretinaicon)?
                    $PAGE->theme->settings->iphoneretinaicon :
                    $OUTPUT->pix_url('homeicon/iphone_retina', 'theme'));
$ipadretinaicon = (!empty($PAGE->theme->settings->ipadretinaicon)? 
                    $PAGE->theme->settings->ipadretinaicon :
                    $OUTPUT->pix_url('homeicon/ipad_retina', 'theme'));
?>

<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $iphoneicon ?>" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $ipadicon ?>" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $iphoneretinaicon ?>" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $ipadretinaicon ?>" />