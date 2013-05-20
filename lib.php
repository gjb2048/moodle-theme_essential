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

function essential_process_css($css, $theme) {


	// Set the theme color    if (!empty($theme->settings->themecolor)) {        $themecolor = $theme->settings->themecolor;    } else {        $themecolor = null;    }    $css = essential_set_themecolor($css, $themecolor);
    
    // Set the theme hover color
    if (!empty($theme->settings->themehovercolor)) {        $themehovercolor = $theme->settings->themehovercolor;    } else {        $themehovercolor = null;    }    $css = essential_set_themehovercolor($css, $themehovercolor);
    
    
    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = essential_set_logo($css, $logo);
    
    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = essential_set_customcss($css, $customcss);
    
    if (!empty($theme->settings->slide1image)) {
        $slide1image = $theme->settings->slide1image;
    } else {
        $slide1image = null;
    }
    $css = essential_set_slide1image($css, $slide1image);
    
    if (!empty($theme->settings->slide2image)) {
        $slide2image = $theme->settings->slide2image;
    } else {
        $slide2image = null;
    }
    $css = essential_set_slide2image($css, $slide2image);
    
    if (!empty($theme->settings->slide3image)) {
        $slide3image = $theme->settings->slide3image;
    } else {
        $slide3image = null;
    }
    $css = essential_set_slide3image($css, $slide3image);
    
    if (!empty($theme->settings->slide4image)) {
        $slide4image = $theme->settings->slide4image;
    } else {
        $slide4image = null;
    }
    $css = essential_set_slide4image($css, $slide4image);

    return $css;
	}
	
	

function essential_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_essential_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'logo') {
        $theme = theme_config::load('essential');
        return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }    
}

function essential_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function essential_set_themecolor($css, $themecolor) {    $tag = '[[setting:themecolor]]';    $replacement = $themecolor;    if (is_null($replacement)) {        $replacement = '#30add1';    }    $css = str_replace($tag, $replacement, $css);    return $css;}

function essential_set_themehovercolor($css, $themehovercolor) {    $tag = '[[setting:themehovercolor]]';    $replacement = $themehovercolor;    if (is_null($replacement)) {        $replacement = '#29a1c4';    }    $css = str_replace($tag, $replacement, $css);    return $css;}

function essential_set_slide1image($css, $slide1image) {
    $tag = '[[setting:slide1image]]';
    $replacement = $slide1image;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function essential_set_slide2image($css, $slide2image) {
    $tag = '[[setting:slide2image]]';
    $replacement = $slide2image;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function essential_set_slide3image($css, $slide3image) {
    $tag = '[[setting:slide3image]]';
    $replacement = $slide3image;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function essential_set_slide4image($css, $slide4image) {
    $tag = '[[setting:slide4image]]';
    $replacement = $slide4image;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_essential_page_init(moodle_page $page) {
    $page->requires->jquery();
    $page->requires->jquery_plugin('modernizr', 'theme_essential');
    $page->requires->jquery_plugin('cslider', 'theme_essential');
}
