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
 *
 * @package    core
 * @copyright  2013 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$plugins = array(
    'modernizr'     => array('files' => array('modernizr_2.6.2.js')),
    'alert'     => array('files' => array('bootstrap_plugins/alert_2.3.2.js')),
    'carousel'     => array('files' => array('bootstrap_plugins/carousel_2.3.2.js')),
    'collapse'     => array('files' => array('bootstrap_plugins/collapse_2.3.2.js')),
    'modal'     => array('files' => array('bootstrap_plugins/modal_2.3.2.js')),
    'scrollspy'     => array('files' => array('bootstrap_plugins/scrollspy_2.3.2.js')),
    'tab'     => array('files' => array('bootstrap_plugins/tab_2.3.2.js')),
    'tooltip'     => array('files' => array('bootstrap_plugins/tooltip_2.3.2.js')),
    'transition'     => array('files' => array('bootstrap_plugins/transition_2.3.2.js')),
    'cslider'     => array('files' => array('cslider_1.0.js')),
    'custom'   => array('files' => array('custom_1.0.js'))
);