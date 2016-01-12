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
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if ($footerregion) {
    echo '<section id="region-main" class="span12">';
} else if ($hasboringlayout) {
    echo '<section id="region-main" class="span9 pull-right">';
} else {
    echo '<section id="region-main" class="span9">';
}
if ($COURSE->id > 1) {
    echo $OUTPUT->heading(format_string($COURSE->fullname), 1, 'coursetitle');;
    echo '<div class="bor"></div>';
}
echo $OUTPUT->course_content_header();
echo $OUTPUT->main_content();
if (empty($PAGE->layout_options['nocoursefooter'])) {
    echo $OUTPUT->course_content_footer();
}
echo '</section>';
if (!$footerregion) {
    if ($hasboringlayout) {
        echo $OUTPUT->blocks('side-pre', 'span3 desktop-first-column');
    } else {
        echo $OUTPUT->blocks('side-pre', 'span3');
    }
}
