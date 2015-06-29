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

//$PAGE->requires->jquery();
//$properties = core_useragent::check_ie_properties(); // In /lib/classes/useragent.php.
//if ((is_array($properties)) && ($properties['version'] <= 8.0)) {
//    $PAGE->requires->jquery_plugin('html5shiv', 'theme_essential');
//}
if (\theme_essential\toolbox::not_lte_ie9()) {
    $PAGE->requires->js_call_amd('theme_essential/affix', 'init');
    $breadcrumbstyle = \theme_essential\toolbox::get_setting('breadcrumbstyle');
    if ($breadcrumbstyle == '1') {
        $PAGE->requires->js_call_amd('theme_essential/jBreadCrumb', 'init');
    }
    if (\theme_essential\toolbox::get_setting('fitvids')) {
        $PAGE->requires->js_call_amd('theme_essential/fitvids', 'init');
    }
}

/*
switch($PAGE->pagelayout) {
    case 'frontpage':
        $data = array('data' => array('slideinterval' => '5000'));
        $PAGE->requires->js_call_amd('theme_essential/carousel', 'init', $data);
    break;
}
*/

//$PAGE->requires->jquery_plugin('bootstrap', 'theme_essential');
//$PAGE->requires->jquery_plugin('breadcrumb', 'theme_essential');
//$PAGE->requires->jquery_plugin('fitvids', 'theme_essential');
//$PAGE->requires->jquery_plugin('antigravity', 'theme_essential');
