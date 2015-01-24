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
 * Essentials is a basic child theme of Essential to help you as a theme
 * developer create your own child theme of Essential.
 *
 * @package     theme_essentials
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function theme_essentials_process_css($css, $theme) {
    // Set FontAwesome font loading path
    $css = theme_essentials_set_fontwww($css);

    // Finally return processed CSS
    return $css;
}

function theme_essentials_set_fontwww($css) {
    global $CFG;
    $fontwww = preg_replace("(https?:)", "", $CFG->wwwroot . '/theme/essential/fonts/');

    $tag = '[[setting:fontwww]]';

    if (theme_essential_get_setting('bootstrapcdn')) {
        $css = str_replace($tag, '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/fonts/', $css);
    } else {
        $css = str_replace($tag, $fontwww, $css);
    }
    return $css;
}

function theme_essentials_page_init(moodle_page $page) {
    require_once(dirname(__FILE__) . '/../essential/lib.php');
    theme_essential_page_init($page);
}
