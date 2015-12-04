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
    global $PAGE;
    $outputus = $PAGE->get_renderer('theme_essentials', 'core');
    \theme_essential\toolbox::set_core_renderer($outputus);

    /* Change to 'false' if you don't want to use Essential's settings and remove '$THEME->parents_exclude_sheets' in config.php.
     *
     * If you want to override any Essential setting with a separate version in this child theme, then define it in 'settings.php' with the
     * same name bar the theme name prefix and 'theme_essential_process_css' will do the rest via 'toolbox.php'.  Please look at the examples
     * already coded in 'settings.php'.
     *  
     * If you want the alternative colours, then remove the overridden method 'custom_menu_themecolours' in the 'theme_essentials_core_renderer'
     * class in the 'core_renderer.php' file in the 'classes' folder. */

    $usingessentialsettings = true;
    if ($usingessentialsettings) {
        global $CFG;
        if (file_exists("$CFG->dirroot/theme/essential/lib.php")) {
            require_once("$CFG->dirroot/theme/essential/lib.php");
        } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/essential/lib.php")) {
            require_once("$CFG->themedir/essential/lib.php");
        } // else will just fail when cannot find theme_essential_process_css!
        $css = theme_essential_process_css($css, $theme);
    }

    // If you have your own additional settings, then add them here.
    $css = essentials_set_frontpagetitlestyle($css, \theme_essential\toolbox::get_setting('frontpagetitlestyle'));

    // Finally return processed CSS
    return $css;
}
function essentials_set_frontpagetitlestyle($css, $frontpagetitlestyle) {
    $tag = '[[setting:frontpagetitlestyle]]';
    if (!$frontpagetitlestyle) {
        $replacement = 'inherit';
    } else {
        $replacement = $frontpagetitlestyle;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course.
 * @param stdClass $cm.
 * @param context $context.
 * @param string $filearea.
 * @param array $args.
 * @param bool $forcedownload.
 * @param array $options.
 * @return bool.
 */
function theme_essentials_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('essentials');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if (preg_match("/^(marketing|slide)[1-9][0-9]*image$/", $filearea)) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}
