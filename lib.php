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
 * Adds the logo to CSS.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the logo.
 * @return string The parsed CSS
 */
 
function theme_essential_set_fontwww($css) {
    global $CFG, $PAGE;
    if(empty($CFG->themewww)){
        $themewww = $CFG->wwwroot."/theme";
    } else {
        $themewww = $CFG->themewww;
    }
    $tag = '[[setting:fontwww]]';
    
    $theme = theme_config::load('essential');
    if (!empty($theme->settings->bootstrapcdn)) {
     $css = str_replace($tag, '//netdna.bootstrapcdn.com/font-awesome/4.1.0/fonts/', $css);
    } else {
     $css = str_replace($tag, $themewww.'/essential/fonts/', $css);
    }
    return $css;
}
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
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $theme = theme_config::load('essential');
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'pagebackground') {
            return $theme->setting_file_serve('pagebackground', $args, $forcedownload, $options);
        } else if ((substr($filearea, 0, 5) === 'slide') && (substr($filearea, 6, 5) === 'image')) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if ((substr($filearea, 0, 9) === 'marketing') && (substr($filearea, 10, 5) === 'image')) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if ($filearea === 'iphoneicon') {
            return $theme->setting_file_serve('iphoneicon', $args, $forcedownload, $options);
        } else if ($filearea === 'iphoneretinaicon') {
            return $theme->setting_file_serve('iphoneretinaicon', $args, $forcedownload, $options);
        } else if ($filearea === 'ipadicon') {
            return $theme->setting_file_serve('ipadicon', $args, $forcedownload, $options);
        } else if ($filearea === 'ipadretinaicon') {
            return $theme->setting_file_serve('ipadretinaicon', $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}

/**
 * Set the width on the container-fluid div
 *
 * @param string $css
 * @param mixed $pagewidth
 * @return string
 */
function essential_set_pagewidth($css, $pagewidth) {
    $tag = '[[setting:pagewidth]]';
    $replacement = $pagewidth;
    if (is_null($replacement)) {
        $replacement = '1200';
    }
    if ( $replacement == "100" ) {
        $css = str_replace($tag, $replacement.'%', $css);
    } else {
        $css = str_replace($tag, $replacement.'px', $css);
    }
    return $css;
}


/**
 * get_performance_output() override get_peformance_info()
 *  in moodlelib.php. Returns a string
 * values ready for use.
 *
 * @return string
 */
function essential_performance_output($param, $perfinfo) {
    
    $html = '<div class="container-fluid performanceinfo"><div class="row-fluid"><h2>Performance Information</h2></div><div class="row-fluid">';
    if (isset($param['realtime'])) { $html .= '<div class="span3"><var id="load">'.round($param['realtime'], 2).' secs</var><span>Load Time</span></div>'; }
    if (isset($param['memory_total'])) { $html .= '<div class="span3"><var id="memory">'.display_size($param['memory_total']).'</var><span>Memory Used</span></div>'; }
    if (isset($param['includecount'])) { $html .= '<div class="span3"><var id="included">'.$param['includecount'].' Files </var><span>Included</span></div>'; }
    if (isset($param['dbqueries'])) { $html .= '<div class="span3"><var id="db">'.$param['dbqueries'].' </var><span>DB Read/Write</span></div>'; }
    if ($perfinfo === "max") {
        $html .= '</div><hr /><div class="row-fluid"><h2>Extended Performance Information</h2></div><div class="row-fluid">';
        if (isset($param['serverload'])) { $html .= '<div class="span3"><var id="load">'.$param['serverload'].' </var><span>Server Load</span></div>'; }
        if (isset($param['memory_peak'])) { $html .= '<div class="span3"><var id="memory">'.display_size($param['memory_peak']).' </var><span>Peak Memory</span></div>'; }
        if (isset($param['cachesused'])) { $html .= '<div class="span3"><var id="cache">'.$param['cachesused'].' </var><span>Caches Used</span></div>'; }
        if (isset($param['sessionsize'])) { $html .= '<div class="span3"><var id="session">'.$param['sessionsize'].' </var><span>Session Size</span></div>'; }
    }
    $html .= '</div>';
    $html .= '</div>';

    return $html;
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

    if (!empty($theme->settings->pagewidth)) {
       $pagewidth = $theme->settings->pagewidth;
    } else {
       $pagewidth = null;
    }
    $css = essential_set_pagewidth($css,$pagewidth);
    
    // Set the Fonts.
	switch($theme->settings->fontselect) {
	case 1:
        $headingfont = 'Open Sans, Arial, Helvetica, sans-serif';
        $bodyfont = 'Open Sans, Arial, Helvetica, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 2:
        $headingfont = 'Oswald, Verdana, Geneva, sans-serif';
        $bodyfont = '"PT Sans", Helvetica, Verdana sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 3:
        $headingfont = 'Roboto, Tahoma, Geneva, sans-serif';
        $bodyfont = 'Roboto, Tahoma, Geneva, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 4:
        $headingfont = '"PT Sans", Helvetica, Arial, sans-serif';
        $bodyfont = '"PT Sans", Helvetica, Arial, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 5:
        $headingfont = 'Ubuntu, Arial, Helvetica, sans-serif';
        $bodyfont = 'Ubuntu, Arial, Helvetica, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 6:
        $headingfont = 'Arimo, Arial, Helvetica, sans-serif';
        $bodyfont = 'Arimo, Arial, Helvetica, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 7:
        $headingfont = 'Lobster, "Lucida Calligraphy", Mistral, Verdana, sans-serif';
        $bodyfont = 'Raleway, Helvetica, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 8:
        $headingfont = 'Arial, Helvetica, sans-serif';
        $bodyfont = 'Arial, Helvetica, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 9:
        $headingfont = 'Georgia, serif';
        $bodyfont = 'Georgia, serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 10:
        $headingfont = 'Verdana, Geneva, sans-serif';
        $bodyfont = 'Verdana, Geneva, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 11:
        $headingfont = '"Times New Roman", Times, serif';
        $bodyfont = '"Times New Roman", Times, serif';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
    case 12:
        $headingfont = 'Consolas, Monaco, monospace';
        $bodyfont = 'Consolas, "Courier New", monospace';
        $bodysize = '14px';
        $bodyweight = '400';
		break;
	default:
		$headingfont = 'Verdana, Geneva, sans-serif';
        $bodyfont = 'Verdana, Geneva, sans-serif';
        $bodysize = '14px';
        $bodyweight = '400';
    }
    
    $css = theme_essential_set_headingfont($css, $headingfont);
    $css = theme_essential_set_bodyfont($css, $bodyfont);
    $css = theme_essential_set_bodysize($css, $bodysize);
    $css = theme_essential_set_bodyweight($css, $bodyweight);
    
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
    
    // Set the footer color.
    if (!empty($theme->settings->footercolor)) {
        $footercolor = $theme->settings->footercolor;
    } else {
        $footercolor = null;
    }
    $css = theme_essential_set_footercolor($css, $footercolor);
    
    // Set the footer seperator color.
    if (!empty($theme->settings->footersepcolor)) {
        $footersepcolor = $theme->settings->footersepcolor;
    } else {
        $footersepcolor = null;
    }
    $css = theme_essential_set_footersepcolor($css, $footersepcolor);
    
    // Set the footer text color.
    if (!empty($theme->settings->footertextcolor)) {
        $footertextcolor = $theme->settings->footertextcolor;
    } else {
        $footertextcolor = null;
    }
    $css = theme_essential_set_footertextcolor($css, $footertextcolor);
    
    // Set the footer URL color.
    if (!empty($theme->settings->footerurlcolor)) {
        $footerurlcolor = $theme->settings->footerurlcolor;
    } else {
        $footerurlcolor = null;
    }
    $css = theme_essential_set_footerurlcolor($css, $footerurlcolor);
    
    // Set the footer hover color.
    if (!empty($theme->settings->footerhovercolor)) {
        $footerhovercolor = $theme->settings->footerhovercolor;
    } else {
        $footerhovercolor = null;
    }
    $css = theme_essential_set_footerhovercolor($css, $footerhovercolor);


    // Set the footer heading color.
    if (!empty($theme->settings->footerheadingcolor)) {
        $footerheadingcolor = $theme->settings->footerheadingcolor;
    } else {
        $footerheadingcolor = null;
    }
    $css = theme_essential_set_footerheadingcolor($css, $footerheadingcolor);
    
     // Set the slide header color.
    if (!empty($theme->settings->slideshowcolor)) {
        $slideshowcolor = $theme->settings->slideshowcolor;
    } else {
        $slideshowcolor = null;
    }
    $css = theme_essential_set_slideshowcolor($css, $slideshowcolor);
    
     // Set the slide header color.
    if (!empty($theme->settings->slideheadercolor)) {
        $slideheadercolor = $theme->settings->slideheadercolor;
    } else {
        $slideheadercolor = null;
    }
    $css = theme_essential_set_slideheadercolor($css, $slideheadercolor);
    
     // Set the slide text color.
    if (!empty($theme->settings->slidecolor)) {
        $slidecolor = $theme->settings->slidecolor;
    } else {
        $slidecolor = null;
    }
    $css = theme_essential_set_slidecolor($css, $slidecolor);
    
     // Set the slide button color.
    if (!empty($theme->settings->slidebuttoncolor)) {
        $slidebuttoncolor = $theme->settings->slidebuttoncolor;
    } else {
        $slidebuttoncolor = null;
    }
    $css = theme_essential_set_slidebuttoncolor($css, $slidebuttoncolor);
    
     // Set the slide button hover color.
    if (!empty($theme->settings->slidebuttonhovercolor)) {
        $slidebuttonhovercolor = $theme->settings->slidebuttonhovercolor;
    } else {
        $slidebuttonhovercolor = null;
    }
    $css = theme_essential_set_slidebuttonhovercolor($css, $slidebuttonhovercolor);

    // Set theme alternative colors.
    $defaultalternativethemecolors = array('#a430d1', '#d15430', '#5dd130');
    $defaultalternativethemehovercolors = array('#9929c4', '#c44c29', '#53c429');

    foreach (range(1, 3) as $alternativethemenumber) {
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $defaulthover = $defaultalternativethemehovercolors[$alternativethemenumber - 1];
        $css = theme_essential_set_alternativecolor($css, 'color' . $alternativethemenumber, $theme->settings->{'alternativethemecolor' . $alternativethemenumber}, $default);
        $css = theme_essential_set_alternativecolor($css, 'hovercolor' . $alternativethemenumber, $theme->settings->{'alternativethemehovercolor' . $alternativethemenumber}, $defaulthover);
    }
    
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
    
    // Set the background image for the page.
    $setting = 'pagebackground';
    $pagebackground = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_pagebackground($css, $pagebackground, $setting);
    
    // Set Slide Images.
    $setting = 'slide1image';
    if (!empty($theme->settings->slide1image)) {
        $slideimage = $theme->setting_file_url($setting, $setting);
    } else {
        $slideimage = null;
    }
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);

    $setting = 'slide2image';
    if (!empty($theme->settings->slide2image)) {
        $slideimage = $theme->setting_file_url($setting, $setting);
    } else {
        $slideimage = null;
    }
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);

    $setting = 'slide3image';
    if (!empty($theme->settings->slide3image)) {
        $slideimage = $theme->setting_file_url($setting, $setting);
    } else {
        $slideimage = null;
    }
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);

    $setting = 'slide4image';
    if (!empty($theme->settings->slide4image)) {
        $slideimage = $theme->setting_file_url($setting, $setting);
    } else {
        $slideimage = null;
    }
    $css = theme_essential_set_slideimage($css, $slideimage, $setting);
    
    // Set Marketing Image Height.
    if (!empty($theme->settings->marketingheight)) {
        $marketingheight = $theme->settings->marketingheight;
    } else {
        $marketingheight = null;
    }
    $css = theme_essential_set_marketingheight($css, $marketingheight);
    
    // Set Marketing Images.
    $setting = 'marketing1image';
    if (!empty($theme->settings->marketing1image)) {
        $marketingimage = $theme->setting_file_url($setting, $setting);
    } else {
        $marketingimage = null;
    }
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);
    
    $setting = 'marketing2image';
    if (!empty($theme->settings->marketing2image)) {
        $marketingimage = $theme->setting_file_url($setting, $setting);
    } else {
        $marketingimage = null;
    }
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);
    
    $setting = 'marketing3image';
    if (!empty($theme->settings->marketing3image)) {
        $marketingimage = $theme->setting_file_url($setting, $setting);
    } else {
        $marketingimage = null;
    }
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);

	$css = theme_essential_set_fontwww($css);
    return $css;
}

/**
 * Adds the JavaScript for the colour switcher to the page.
 *
 * The colour switcher is a YUI moodle module that is located in
 *     theme/udemspl/yui/udemspl/udemspl.js
 *
 * @param moodle_page $page
 */
function theme_essential_initialise_colourswitcher(moodle_page $page) {
    user_preference_allow_ajax_update('theme_essential_colours', PARAM_ALPHANUM);
    $page->requires->yui_module(
        'moodle-theme_essential-coloursswitcher',
        'M.theme_essential.initColoursSwitcher',
        array(array('div' => '.dropdown-menu'))
    );
}

/**
 * Gets the theme colors the user has selected if enabled or the default if they have never changed
 *
 * @param string $default The default theme colors to use
 * @return string The theme colors the user has selected
 */
function theme_essential_get_colours($default = 'default') {
    $theme = theme_config::load('essential');
    $preference = get_user_preferences('theme_essential_colours', $default);
    foreach (range(1, 3) as $alternativethemenumber) {
        if ($preference == 'alternative' . $alternativethemenumber && !empty($theme->settings->{'enablealternativethemecolors' . $alternativethemenumber})) {
            return $preference;
        }
    }
    return $default;
}

/**
 * Checks if the user is switching colours with a refresh
 *
 * If they are this updates the users preference in the database
 */
function theme_essential_check_colours_switch() {
    $colours= optional_param('essentialcolours', null, PARAM_ALPHANUM);
    if (in_array($colours, array('default', 'alternative1', 'alternative2', 'alternative3'))) {
        set_user_preference('theme_essential_colours', $colours);
    }
}

 
function theme_essential_set_headingfont($css, $headingfont) {
    $tag = '[[setting:headingfont]]';
    $replacement = $headingfont;
    if (is_null($replacement)) {
        $replacement = 'Georgia';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_bodyfont($css, $bodyfont) {
    $tag = '[[setting:bodyfont]]';
    $replacement = $bodyfont;
    if (is_null($replacement)) {
        $replacement = 'Arial';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_bodysize($css, $bodysize) {
    $tag = '[[setting:bodysize]]';
    $replacement = $bodysize;
    if (is_null($replacement)) {
        $replacement = '13';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_bodyweight($css, $bodyweight) {
    $tag = '[[setting:bodyweight]]';
    $replacement = $bodyweight;
    if (is_null($replacement)) {
        $replacement = '400';
    }
    $css = str_replace($tag, $replacement, $css);
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

function theme_essential_set_alternativecolor($css, $type, $customcolor, $defaultcolor) {
    $tag = '[[setting:alternativetheme' . $type . ']]';
    $replacement = $customcolor;
    if (is_null($replacement)) {
        $replacement = $defaultcolor;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_footercolor($css, $footercolor) {
    $tag = '[[setting:footercolor]]';
    $replacement = $footercolor;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_footertextcolor($css, $footertextcolor) {
    $tag = '[[setting:footertextcolor]]';
    $replacement = $footertextcolor;
    if (is_null($replacement)) {
        $replacement = '#DDDDDD';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_footerurlcolor($css, $footerurlcolor) {
    $tag = '[[setting:footerurlcolor]]';
    $replacement = $footerurlcolor;
    if (is_null($replacement)) {
        $replacement = '#BBBBBB';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_footerhovercolor($css, $footerhovercolor) {
    $tag = '[[setting:footerhovercolor]]';
    $replacement = $footerhovercolor;
    if (is_null($replacement)) {
        $replacement = '#FFFFFF';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_footerheadingcolor($css, $footerheadingcolor) {
    $tag = '[[setting:footerheadingcolor]]';
    $replacement = $footerheadingcolor;
    if (is_null($replacement)) {
        $replacement = '#CCCCCC';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_slideshowcolor($css, $slideshowcolor) {
    $tag = '[[setting:slideshowcolor]]';
    $replacement = $slideshowcolor;
    if (is_null($replacement)) {
        $replacement = '#30add1';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_slideheadercolor($css, $slideheadercolor) {
    $tag = '[[setting:slideheadercolor]]';
    $replacement = $slideheadercolor;
    if (is_null($replacement)) {
        $replacement = '#30add1';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_slidecolor($css, $slidecolor) {
    $tag = '[[setting:slidecolor]]';
    $replacement = $slidecolor;
    if (is_null($replacement)) {
        $replacement = '#888888';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_slidebuttoncolor($css, $slidebuttoncolor) {
    $tag = '[[setting:slidebuttoncolor]]';
    $replacement = $slidebuttoncolor;
    if (is_null($replacement)) {
        $replacement = '#30add1';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_slidebuttonhovercolor($css, $slidebuttonhovercolor) {
    $tag = '[[setting:slidebuttonhovercolor]]';
    $replacement = $slidebuttonhovercolor;
    if (is_null($replacement)) {
        $replacement = '#45b5d6';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_footersepcolor($css, $footersepcolor) {
    $tag = '[[setting:footersepcolor]]';
    $replacement = $footersepcolor;
    if (is_null($replacement)) {
        $replacement = '#313131';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_pagebackground($css, $pagebackground, $setting) {
    global $OUTPUT;
    $tag = '[[setting:pagebackground]]';
    $replacement = $pagebackground;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}


function theme_essential_set_slideimage($css, $slideimage, $setting) {
    global $OUTPUT;
    $tag = '[[setting:'.$setting.']]';
    $replacement = $slideimage;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_marketingheight($css, $marketingheight) {
    $tag = '[[setting:marketingheight]]';
    $replacement = $marketingheight;
    if (is_null($replacement)) {
        $replacement = 100;
    }
    $css = str_replace($tag, $replacement.'px', $css);
    return $css;
}

function theme_essential_set_marketingimage($css, $marketingimage, $setting) {
    $tag = '[[setting:'.$setting.']]';
    $replacement = $marketingimage;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_showslider($settings) {
    $noslides = (empty($settings->numberofslides)) ? false : $settings->numberofslides;
    if ($noslides) {
        $devicetype = core_useragent::get_device_type(); // In moodlelib.php.
        if ($devicetype == "mobile") {
            if ($settings->hideonphone) {
                $noslides = false;
            }
        } else if ($devicetype == "tablet") {
            if ($settings->hideontablet) {
                $noslides = false;
            }
        }
    }
    return $noslides;
}

function theme_essential_page_init(moodle_page $page) {
    $page->requires->jquery();
	$page->requires->jquery_plugin('affix', 'theme_essential');
    $page->requires->jquery_plugin('alert', 'theme_essential');
    $page->requires->jquery_plugin('carousel', 'theme_essential');
    $page->requires->jquery_plugin('collapse', 'theme_essential');
    $page->requires->jquery_plugin('modal', 'theme_essential');
    $page->requires->jquery_plugin('scrollspy', 'theme_essential');
    $page->requires->jquery_plugin('tab', 'theme_essential');
    $page->requires->jquery_plugin('tooltip', 'theme_essential');
    $page->requires->jquery_plugin('transition', 'theme_essential');
	$page->requires->jquery_plugin('typeahead', 'theme_essential');
    $page->requires->jquery_plugin('modernizr', 'theme_essential');
}