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

/**
 * This file describes jQuery plugins available in the moodle
 * core component. These can be included in page using:
 *   $PAGE->requires->jquery();
 *   $PAGE->requires->jquery_plugin('migrate', 'core');
 *   $PAGE->requires->jquery_plugin('ui', 'core');
 *   $PAGE->requires->jquery_plugin('ui-css', 'core');
 *
 * Please note that other moodle plugins can not use the sample
 * jquery plugin names, only one is loaded if collision detected.
 *
 * Any Moodle plugin may add jquery/plugins.php and include extra
 * jQuery plugins.
 *
 * Themes or other plugin may blacklist any jquery plugin,
 * for example to override default jQueryUI theme.
 */

$plugins = array(
    'bootstrap' => array('files' => array('bootstrap_2_3_2_min.js')),
    'html5shiv' => array('files' => array('html5shiv_3_7_2.js')),
    'breadcrumb' => array('files' => array('jBreadCrumb_1_1.js')),
    'fitvids' => array('files' => array('fitvids_1_1_2.js')),
    'antigravity' => array('files' => array('anti_gravity_1_1.js'))
);