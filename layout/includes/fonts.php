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
 * @copyright   2014 Gareth J Barnard, David Bezemer, Mary Evans
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$fontselect = (!empty($PAGE->theme->settings->fontselect));
$fonturl = 'fonts.googleapis.com/css?family=';
$rel = 'stylesheet';
$type = 'type/css';
$output = '';

if ($fontselect == 1) {
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'Open+Sans', 'rel' => $rel, 'type' => $type));
} else if ($fontselect == 2) {
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'Oswald', 'rel' => $rel, 'type' => $type));
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'PT+Sans', 'rel' => $rel, 'type' => $type));
} else if ($fontselect == 3) {
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'Roboto', 'rel' => $rel, 'type' => $type));
} else if ($fontselect == 4) {
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'PT+Sans', 'rel' => $rel, 'type' => $type));
} else if ($fontselect == 5) {
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'Ubuntu', 'rel' => $rel, 'type' => $type));
} else if ($fontselect == 6) {
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'Arimo', 'rel' => $rel, 'type' => $type));
} else if ($fontselect == 7) {
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'Lobster', 'rel' => $rel, 'type' => $type));
    $output .= html_writer::empty_tag('link', array('href' => $fonturl. 'Raleway', 'rel' => $rel, 'type' => $type));
}
