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
 * This is built using the Clean template to allow for new theme's using
 * Moodle's new Bootstrap theme engine
 *
 *
 * @package   theme_essential
 * @copyright 2013 Julian Ridden
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */

/**
 * Include the Awesome Font.
 */

function theme_essential_set_fontwww($css) {
    global $CFG, $PAGE;
    if(empty($CFG->themewww)){
        $themewww = $CFG->wwwroot."/theme";
    } else {
        $themewww = $CFG->themewww;
    }
    $tag = '[[setting:fontwww]]';
    $css = str_replace($tag, $themewww.'/'.$PAGE->theme->name.'/fonts/', $css);
    return $css;
}

/**
 * Adds the logo to CSS.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the logo.
 * @return string The parsed CSS
 */
function theme_essential_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_essential_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'logo') {
        $theme = theme_config::load('essential');
        return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'slide1image') {
        $theme = theme_config::load('essential');
        return $theme->setting_file_serve('slide1image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'slide2image') {
        $theme = theme_config::load('essential');
        return $theme->setting_file_serve('slide2image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'slide3image') {
        $theme = theme_config::load('essential');
        return $theme->setting_file_serve('slide3image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'slide4image') {
        $theme = theme_config::load('essential');
        return $theme->setting_file_serve('slide4image', $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function essential_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_essential_process_css($css, $theme) {

    // Set the theme color.
    if (!empty($theme->settings->themecolor)) {
        $themecolor = $theme->settings->themecolor;
    } else {
        $themecolor = null;
    }
    $css = theme_essential_set_themecolor($css, $themecolor);

    // Set the theme hover color.
    if (!empty($theme->settings->themehovercolor)) {
        $themehovercolor = $theme->settings->themehovercolor;
    } else {
        $themehovercolor = null;
    }
    $css = theme_essential_set_themehovercolor($css, $themehovercolor);
    
    // Set the navbar seperator.
    if (!empty($theme->settings->navbarsep)) {
        $navbarsep = $theme->settings->navbarsep;
    } else {
        $navbarsep = '/';
    }
    $css = theme_essential_set_navbarsep($css, $navbarsep);
    
    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = essential_set_customcss($css, $customcss);

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_essential_set_logo($css, $logo);

    // Set Slide Images.
    $setting = 'slide1image';
    // Creates the url for image file which is then served up by 'theme_essential_pluginfile' below.
    $slideimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);

    $setting = 'slide2image';
    $slideimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);

    $setting = 'slide3image';
    $slideimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);

    $setting = 'slide4image';
    $slideimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);
    
    // Set the font path.
    $css = theme_essential_set_fontwww($css);

    return $css;
}


function theme_essential_set_themecolor($css, $themecolor) {
    $tag = '[[setting:themecolor]]';
    $replacement = $themecolor;
    if (is_null($replacement)) {
        $replacement = '#30add1';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_themehovercolor($css, $themehovercolor) {
    $tag = '[[setting:themehovercolor]]';
    $replacement = $themehovercolor;
    if (is_null($replacement)) {
        $replacement = '#29a1c4';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_navbarsep($css, $navbarsep) {
    $tag = '[[setting:navbarsep]]';
    $replacement = $navbarsep;
    if (is_null($replacement)) {
        $replacement = '';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_slideimage($css, $slideimage, $setting) {
    global $OUTPUT;
    $tag = '[[setting:'.$setting.']]';
    $replacement = $slideimage;
    if (is_null($replacement)) {
        // Get default image from themes 'images' folder of the name in $setting.
        $replacement = $OUTPUT->pix_url('images/'.$setting, 'theme');
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_page_init(moodle_page $page) {
    $page->requires->jquery();
    $page->requires->jquery_plugin('modernizr', 'theme_essential');
    $page->requires->jquery_plugin('cslider', 'theme_essential');
    $page->requires->jquery_plugin('custom', 'theme_essential');   
}
