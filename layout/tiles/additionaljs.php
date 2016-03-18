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
 * Essential theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage essential
 * @copyright  &copy; 2015-onwards G J Barnard in respect to modifications of the Bootstrap theme.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$PAGE->requires->js_call_amd('theme_essential/footer', 'init');
if (\theme_essential\toolbox::not_lte_ie9()) {
    if (\theme_essential\toolbox::get_setting('oldnavbar')) {
        // Only need this to change the classes when scrolling when the navbar is in the old position.
        $PAGE->requires->js_call_amd('theme_essential/affix', 'init');
    }
    $breadcrumbstyle = \theme_essential\toolbox::get_setting('breadcrumbstyle');
    if ($PAGE->pagelayout == 'course') {
        $PAGE->requires->js_call_amd('theme_essential/course_navigation', 'init');
    }
    if ($breadcrumbstyle == '1') {
        $PAGE->requires->js_call_amd('theme_essential/jBreadCrumb', 'init');
    }
    if (\theme_essential\toolbox::get_setting('fitvids')) {
        $PAGE->requires->js_call_amd('theme_essential/fitvids', 'init');
    }
}
