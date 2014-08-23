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
    global $CFG;
    $fontwww = preg_replace("(https?:)", "", $CFG->wwwroot .'/theme/essential/fonts/');

    $tag = '[[setting:fontwww]]';

    if (theme_essential_get_setting('bootstrapcdn')) {
     $css = str_replace($tag, '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/fonts/', $css);
    } else {
     $css = str_replace($tag, $fontwww, $css);
    }
    return $css;
}

function theme_essential_get_setting($setting, $format = false) {
    static $theme = '';
    if (empty($theme)) {
        $theme = theme_config::load('essential');
    }
    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting);
    } else {
        return format_string($theme->settings->$setting);
    }
}

function theme_essential_set_logo($css, $logo) {
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (!($replacement)) {
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
    static $theme = '';
    if (empty($theme)) {
        $theme = theme_config::load('essential');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'pagebackground') {
            return $theme->setting_file_serve('pagebackground', $args, $forcedownload, $options);
        } else if (preg_match("/slide[1-9][0-9]*image/", $filearea) !== false) {
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
function theme_essential_set_pagewidth($css, $pagewidth) {
    $tag = '[[setting:pagewidth]]';
    $replacement = $pagewidth;
    if (!($replacement)) {
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
function theme_essential_performance_output($param, $perfinfo) {
    
    $html  = html_writer::start_tag('div', array('class' => 'container-fluid performanceinfo'));
    $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
    $html .= html_writer::tag('h2', get_string('perfinfoheading', 'theme_essential'));
    $html .= html_writer::end_tag('div');
    $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
    if (isset($param['realtime'])) {
        $html .= html_writer::start_tag('div', array('class' => 'span3'));
        $html .= html_writer::tag('var',round($param['realtime'], 2).' '.get_string('seconds'), array('id' => 'load'));
        $html .= html_writer::span(get_string('loadtime', 'theme_essential'));
        $html .= html_writer::end_tag('div');
    }
    if (isset($param['memory_total'])) {
        $html .= html_writer::start_tag('div', array('class' => 'span3'));
        $html .= html_writer::tag('var',display_size($param['memory_total']), array('id' => 'memory'));
        $html .= html_writer::span(get_string('memused', 'theme_essential'));
        $html .= html_writer::end_tag('div');
    }
    if (isset($param['includecount'])) {
        $html .= html_writer::start_tag('div', array('class' => 'span3'));
        $html .= html_writer::tag('var',$param['includecount'], array('id' => 'included'));
        $html .= html_writer::span(get_string('included', 'theme_essential'));
        $html .= html_writer::end_tag('div');
    }
    if (isset($param['dbqueries'])) { 
        $html .= html_writer::start_tag('div', array('class' => 'span3'));
        $html .= html_writer::tag('var',$param['dbqueries'], array('id' => 'db'));
        $html .= html_writer::span(get_string('dbqueries', 'theme_essential'));
        $html .= html_writer::end_tag('div');
    }
    $html .= html_writer::end_tag('div');
    if ($perfinfo === "max") {
        $html .= html_writer::empty_tag('hr');
        $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
        $html .= html_writer::tag('h2', get_string('extperfinfoheading', 'theme_essential'));
        $html .= html_writer::end_tag('div');
        $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
        if (isset($param['serverload'])) { 
            $html .= html_writer::start_tag('div', array('class' => 'span3'));
            $html .= html_writer::tag('var',$param['serverload'], array('id' => 'load'));
            $html .= html_writer::span(get_string('serverload', 'theme_essential'));
            $html .= html_writer::end_tag('div');
         }
        if (isset($param['memory_peak'])) {
            $html .= html_writer::start_tag('div', array('class' => 'span3'));
            $html .= html_writer::tag('var',display_size($param['memory_peak']), array('id' => 'load'));
            $html .= html_writer::span(get_string('peakmem', 'theme_essential'));
            $html .= html_writer::end_tag('div');
         }
        if (isset($param['cachesused'])) { 
            $html .= html_writer::start_tag('div', array('class' => 'span3'));
            $html .= html_writer::tag('var',$param['cachesused'], array('id' => 'cache'));
            $html .= html_writer::span(get_string('peakmem', 'theme_essential'));
            $html .= html_writer::end_tag('div');
         }
        if (isset($param['sessionsize'])) { 
            $html .= html_writer::start_tag('div', array('class' => 'span3'));
            $html .= html_writer::tag('var',$param['sessionsize'], array('id' => 'session'));
            $html .= html_writer::span(get_string('sessionsize', 'theme_essential'));
            $html .= html_writer::end_tag('div');
         }
         $html .= html_writer::end_tag('div');
    }
    $html .= html_writer::end_tag('div');
    $html .= html_writer::end_tag('div');

    return $html;
}

function theme_essential_hex2rgba($hex, $opacity) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
    }
    return "rgba($r, $g, $b, $opacity)";
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_essential_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (!($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_essential_process_css($css, $theme) {

    $pagewidth = theme_essential_get_setting('pagewidth');
    $css = theme_essential_set_pagewidth($css,$pagewidth);
    
    // Set the Fonts.
    switch(theme_essential_get_setting('fontselect')) {
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
    $themecolor = theme_essential_get_setting('themecolor');
    $css = theme_essential_set_color($css, $themecolor, '[[setting:themecolor]]', '#30ADD1');

    // Set the theme text colour.
    $themetextcolor = theme_essential_get_setting('themetextcolor');
    $css = theme_essential_set_color($css, $themetextcolor, '[[setting:themetextcolor]]', '#047797');

    // Set the theme url colour.
    $themeurlcolor = theme_essential_get_setting('themeurlcolor');
    $css = theme_essential_set_color($css, $themeurlcolor, '[[setting:themeurlcolor]]', '#FF5034');

    // Set the theme hover colour.
    $themehovercolor = theme_essential_get_setting('themehovercolor');
    $css = theme_essential_set_color($css, $themehovercolor, '[[setting:themehovercolor]]', '#F32100');
    
    // Set the theme icon colour.
    $themeiconcolor = theme_essential_get_setting('themeiconcolor');
    $css = theme_essential_set_color($css, $themeiconcolor, '[[setting:themeiconcolor]]', '#30ADD1');

    // Set the theme navigation colour.
    $themenavcolor = theme_essential_get_setting('themenavcolor');
    $css = theme_essential_set_color($css, $themenavcolor, '[[setting:themenavcolor]]', '#ffffff');
    
    // Set the footer colour.
    $footercolor = theme_essential_get_setting('footercolor');
    $css = theme_essential_set_color($css, $footercolor, '[[setting:footercolor]]', '#555555');
    
    // Set the footer text color.
    $footertextcolor = theme_essential_get_setting('footertextcolor');
    $css = theme_essential_set_color($css, $footertextcolor, '[[setting:footertextcolor]]', '#bbbbbb');

    // Set the footer heading colour.
    $footerheadingcolor = theme_essential_get_setting('footerheadingcolor');
    $css = theme_essential_set_color($css, $footerheadingcolor, '[[setting:footerheadingcolor]]', '#cccccc');
    
    // Set the footer separator colour.
    $footersepcolor = theme_essential_get_setting('footersepcolor');
    $css = theme_essential_set_color($css, $footersepcolor, '[[setting:footersepcolor]]', '#313131');

    // Set the footer URL color.
    $footerurlcolor = theme_essential_get_setting('footerurlcolor');
    $css = theme_essential_set_color($css, $footerurlcolor, '[[setting:footerurlcolor]]', '#217a94');

    // Set the footer hover colour.
    $footerhovercolor = theme_essential_get_setting('footerhovercolor');
    $css = theme_essential_set_color($css, $footerhovercolor, '[[setting:footerhovercolor]]', '#30add1');
     
    // Set the slide background colour.
    $slidebackgroundcolor = theme_essential_hex2rgba(theme_essential_get_setting('themecolor'), '.75');
    $css = theme_essential_set_color($css, $slidebackgroundcolor, '[[setting:carouselcolor]]', '#30add1');
    
    // Set the slide active pip colour.
    $slidebackgroundcolor = theme_essential_hex2rgba(theme_essential_get_setting('themecolor'), '.25');
    $css = theme_essential_set_color($css, $slidebackgroundcolor, '[[setting:carouselactivecolor]]', '#30add1');

    // Set the slide header colour.
    $slideshowcolor = theme_essential_get_setting('slideshowcolor');
    $css = theme_essential_set_color($css, $slideshowcolor, '[[setting:slideshowcolor]]', '#30add1');

    // Set the slide header colour.
    $slideheadercolor = theme_essential_get_setting('slideheadercolor');
    $css = theme_essential_set_color($css, $slideheadercolor, '[[setting:slideheadercolor]]', '#30add1');

    // Set the slide text colour.
    $slidecolor = theme_essential_get_setting('slidecolor');
    $css = theme_essential_set_color($css, $slidecolor, '[[setting:slidecolor]]', '#ffffff');

    // Set the slide button colour.
    $slidebuttoncolor = theme_essential_get_setting('slidebuttoncolor');
    $css = theme_essential_set_color($css, $slidebuttoncolor, '[[setting:slidebuttoncolor]]', '#30add1');

    // Set the slide button hover colour.
    $slidebuttonhovercolor = theme_essential_get_setting('slidebuttonhovercolor');
    $css = theme_essential_set_color($css, $slidebuttonhovercolor, '[[setting:slidebuttonhovercolor]]', '#217a94');

    // Set theme alternative colours.
    $defaultalternativethemecolors = array('#a430d1', '#d15430', '#5dd130');
    $defaultalternativethemehovercolors = array('#9929c4', '#c44c29', '#53c429');

    foreach (range(1, 3) as $alternativethemenumber) {
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $defaulthover = $defaultalternativethemehovercolors[$alternativethemenumber - 1];
        $css = theme_essential_set_alternativecolor($css, 'color' . $alternativethemenumber, theme_essential_get_setting('alternativethemehovercolor'.$alternativethemenumber), $default);
        $css = theme_essential_set_alternativecolor($css, 'textcolor' . $alternativethemenumber, theme_essential_get_setting('alternativethemetextcolor'.$alternativethemenumber), $default);
        $css = theme_essential_set_alternativecolor($css, 'urlcolor' . $alternativethemenumber, theme_essential_get_setting('alternativethemeurlcolor'.$alternativethemenumber), $default);
        $css = theme_essential_set_alternativecolor($css, 'hovercolor' . $alternativethemenumber, theme_essential_get_setting('alternativethemehovercolor'.$alternativethemenumber), $defaulthover);
    }

    // Set custom CSS.
    $customcss = theme_essential_get_setting('customcss');
    $css = theme_essential_set_customcss($css, $customcss);

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_essential_set_logo($css, $logo);
    
    // Set the background image for the page.
    $setting = 'pagebackground';
    $pagebackground = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_pagebackground($css, $pagebackground, $setting);

    // Set Marketing Image Height.
    $marketingheight = theme_essential_get_setting('marketingheight');
    $css = theme_essential_set_marketingheight($css, $marketingheight);
    
    // Set Marketing Images.
    if (theme_essential_get_setting('marketing1image')) {
        $setting = 'marketing1image';
        $marketingimage = $theme->setting_file_url($setting, $setting);
        $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);
    }
    
    if (theme_essential_get_setting('marketing2image')) {
        $setting = 'marketing2image';
        $marketingimage = $theme->setting_file_url($setting, $setting);
        $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);
    }
    
    if (theme_essential_get_setting('marketing3image')) {
        $setting = 'marketing3image';
        $marketingimage = $theme->setting_file_url($setting, $setting);
        $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);
    }
    
    // Set FontAwesome font loading path
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
    $preference = get_user_preferences('theme_essential_colours', $default);
    foreach (range(1, 3) as $alternativethemenumber) {
        if ($preference == 'alternative' . $alternativethemenumber && theme_essential_get_setting('enablealternativethemecolors' . $alternativethemenumber)) {
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
    if (!($replacement)) {
        $replacement = 'Georgia';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_bodyfont($css, $bodyfont) {
    $tag = '[[setting:bodyfont]]';
    $replacement = $bodyfont;
    if (!($replacement)) {
        $replacement = 'Arial';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_bodysize($css, $bodysize) {
    $tag = '[[setting:bodysize]]';
    $css = str_replace($tag, $bodysize, $css);
    return $css;
}

function theme_essential_set_bodyweight($css, $bodyweight) {
    $tag = '[[setting:bodyweight]]';
    $css = str_replace($tag, $bodyweight, $css);
    return $css;
}

function theme_essential_set_color($css, $themecolor, $tag, $default) {
    if (!($themecolor)) {
        $replacement = $default;
    } else {
        $replacement = $themecolor;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_alternativecolor($css, $type, $customcolor, $defaultcolor) {
    $tag = '[[setting:alternativetheme' . $type . ']]';
    if (!($customcolor)) {
        $replacement = $defaultcolor;
    } else {
        $replacement = $customcolor;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_pagebackground($css, $pagebackground, $setting) {
    $tag = '[[setting:pagebackground]]';
    $replacement = $pagebackground;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_marketingheight($css, $marketingheight) {
    $tag = '[[setting:marketingheight]]';
    $replacement = $marketingheight;
    if (!($replacement)) {
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

function theme_essential_showslider($setting) {
    $noslides = theme_essential_get_setting($setting);
    if ($noslides) {
        $devicetype = core_useragent::get_device_type(); // In moodlelib.php.
        if (($devicetype == "mobile") && theme_essential_get_setting('hideonphone')) {
            $noslides = false;
        } else if (($devicetype == "tablet") && theme_essential_get_setting('hideontablet')) {
            $noslides = false;
        }
    }
    return $noslides;
}

function theme_essential_page_init(moodle_page $page) {
    $page->requires->jquery();
    if (core_useragent::check_ie_version() && !core_useragent::check_ie_version('9.0')) {
        $page->requires->jquery_plugin('html5shiv', 'theme_essential');
    }
    $page->requires->jquery_plugin('bootstrap', 'theme_essential');
    $page->requires->jquery_plugin('breadcrumb', 'theme_essential');
}