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
        if ($filearea === 'logo') {
            $theme = theme_config::load('essential');
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'pagebackground') {
            $theme = theme_config::load('essential');
            return $theme->setting_file_serve('pagebackground', $args, $forcedownload, $options);
        } else if (preg_match("/slide[1-9][0-9]*image/", $filearea) !== false) {
            $theme = theme_config::load('essential');
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if ((substr($filearea, 0, 9) === 'marketing') && (substr($filearea, 10, 5) === 'image')) {
            $theme = theme_config::load('essential');
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if ($filearea === 'iphoneicon') {
            $theme = theme_config::load('essential');
            return $theme->setting_file_serve('iphoneicon', $args, $forcedownload, $options);
        } else if ($filearea === 'iphoneretinaicon') {
            $theme = theme_config::load('essential');
            return $theme->setting_file_serve('iphoneretinaicon', $args, $forcedownload, $options);
        } else if ($filearea === 'ipadicon') {
            $theme = theme_config::load('essential');
            return $theme->setting_file_serve('ipadicon', $args, $forcedownload, $options);
        } else if ($filearea === 'ipadretinaicon') {
            $theme = theme_config::load('essential');
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
    
    // Set the theme colour.
    if (!empty($theme->settings->themecolor)) {
        $themecolor = $theme->settings->themecolor;
    } else {
        $themecolor = null;
    }
    $css = theme_essential_set_color($css, $themecolor, '[[setting:themecolor]]', '#30add1');

    // Set the theme text colour.
    if (!empty($theme->settings->themetextcolor)) {
        $themetextcolor = $theme->settings->themetextcolor;
    } else {
        $themetextcolor = null;
    }
    $css = theme_essential_set_color($css, $themetextcolor, '[[setting:themetextcolor]]', '#30add1');

    // Set the theme url colour.
    if (!empty($theme->settings->themeurlcolor)) {
        $themeurlcolor = $theme->settings->themeurlcolor;
    } else {
        $themeurlcolor = null;
    }
    $css = theme_essential_set_color($css, $themeurlcolor, '[[setting:themeurlcolor]]', '#29a1c4');

    // Set the theme hover colour.
    if (!empty($theme->settings->themehovercolor)) {
        $themehovercolor = $theme->settings->themehovercolor;
    } else {
        $themehovercolor = null;
    }
    $css = theme_essential_set_color($css, $themehovercolor, '[[setting:themehovercolor]]', '#29a1c4');

    // Set the theme navigation colour.
    if (!empty($theme->settings->themenavcolor)) {
        $themenavcolor = $theme->settings->themenavcolor;
    } else {
        $themenavcolor = null;
    }
    $css = theme_essential_set_color($css, $themenavcolor, '[[setting:themenavcolor]]', '#ffffff');

    // Set the footer colour.
    if (!empty($theme->settings->footercolor)) {
        $footercolor = $theme->settings->footercolor;
    } else {
        $footercolor = null;
    }
    $css = theme_essential_set_color($css, $footercolor, '[[setting:footercolor]]', '#000000');

    // Set the footer separator colour.
    if (!empty($theme->settings->footersepcolor)) {
        $footersepcolor = $theme->settings->footersepcolor;
    } else {
        $footersepcolor = null;
    }
    $css = theme_essential_set_color($css, $footersepcolor, '[[setting:footersepcolor]]', '#313131');

    // Set the footer text color.
    if (!empty($theme->settings->footertextcolor)) {
        $footertextcolor = $theme->settings->footertextcolor;
    } else {
        $footertextcolor = null;
    }
    $css = theme_essential_set_color($css, $footertextcolor, '[[setting:footertextcolor]]', '#DDDDDD');

    // Set the footer URL color.
    if (!empty($theme->settings->footerurlcolor)) {
        $footerurlcolor = $theme->settings->footerurlcolor;
    } else {
        $footerurlcolor = null;
    }
    $css = theme_essential_set_color($css, $footerurlcolor, '[[setting:footerurlcolor]]', '#BBBBBB');

    // Set the footer hover colour.
    if (!empty($theme->settings->footerhovercolor)) {
        $footerhovercolor = $theme->settings->footerhovercolor;
    } else {
        $footerhovercolor = null;
    }
    $css = theme_essential_set_color($css, $footerhovercolor, '[[setting:footerhovercolor]]', '#FFFFFF');

    // Set the footer heading colour.
    if (!empty($theme->settings->footerheadingcolor)) {
        $footerheadingcolor = $theme->settings->footerheadingcolor;
    } else {
        $footerheadingcolor = null;
    }
    $css = theme_essential_set_color($css, $footerheadingcolor, '[[setting:footerheadingcolor]]', '#CCCCCC');

     // Set the slide header colour.
    if (!empty($theme->settings->slideshowcolor)) {
        $slideshowcolor = $theme->settings->slideshowcolor;
    } else {
        $slideshowcolor = null;
    }
    $css = theme_essential_set_color($css, $slideshowcolor, '[[setting:slideshowcolor]]', '#30add1');

     // Set the slide header colour.
    if (!empty($theme->settings->slideheadercolor)) {
        $slideheadercolor = $theme->settings->slideheadercolor;
    } else {
        $slideheadercolor = null;
    }
    $css = theme_essential_set_color($css, $slideheadercolor, '[[setting:slideheadercolor]]', '#30add1');

     // Set the slide text colour.
    if (!empty($theme->settings->slidecolor)) {
        $slidecolor = $theme->settings->slidecolor;
    } else {
        $slidecolor = null;
    }
    $css = theme_essential_set_color($css, $slidecolor, '[[setting:slidecolor]]', '#888888');

    // Set the slide button colour.
    if (!empty($theme->settings->slidebuttoncolor)) {
        $slidebuttoncolor = $theme->settings->slidebuttoncolor;
    } else {
        $slidebuttoncolor = null;
    }
    $css = theme_essential_set_color($css, $slidebuttoncolor, '[[setting:slidebuttoncolor]]', '#30add1');

     // Set the slide button hover colour.
    if (!empty($theme->settings->slidebuttonhovercolor)) {
        $slidebuttonhovercolor = $theme->settings->slidebuttonhovercolor;
    } else {
        $slidebuttonhovercolor = null;
    }
    $css = theme_essential_set_color($css, $slidebuttonhovercolor, '[[setting:slidebuttonhovercolor]]', '#45b5d6');

    // Set theme alternative colours.
    $defaultalternativethemecolors = array('#a430d1', '#d15430', '#5dd130');
    $defaultalternativethemehovercolors = array('#9929c4', '#c44c29', '#53c429');

    foreach (range(1, 3) as $alternativethemenumber) {
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $defaulthover = $defaultalternativethemehovercolors[$alternativethemenumber - 1];
        $css = theme_essential_set_alternativecolor($css, 'color' . $alternativethemenumber, $theme->settings->{'alternativethemecolor' . $alternativethemenumber}, $default);
        $css = theme_essential_set_alternativecolor($css, 'textcolor' . $alternativethemenumber, $theme->settings->{'alternativethemetextcolor' . $alternativethemenumber}, $default);
        $css = theme_essential_set_alternativecolor($css, 'urlcolor' . $alternativethemenumber, $theme->settings->{'alternativethemeurlcolor' . $alternativethemenumber}, $default);
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
 * Gets the theme colours the user has selected if enabled or the default if they have never changed
 *
 * @param string $default The default theme colors to use
 * @return string The theme colours the user has selected
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

function theme_essential_set_color($css, $themecolor, $tag, $default) {
    if (is_null($themecolor)) {
        $replacement = $default;
    } else {
        $replacement = $themecolor;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_alternativecolor($css, $type, $customcolor, $defaultcolor) {
    $tag = '[[setting:alternativetheme' . $type . ']]';
    if (is_null($customcolor)) {
        $replacement = $defaultcolor;
    } else {
        $replacement = $customcolor;
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