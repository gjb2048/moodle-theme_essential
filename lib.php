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
    
    $theme = theme_config::load('essential');
    if (!empty($theme->settings->bootstrapcdn)) {
    	$css = str_replace($tag, 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/font/', $css);
    } else {
    	$css = str_replace($tag, $themewww.'/essential/fonts/', $css);
    }
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
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $theme = theme_config::load('essential');
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'pagebackground') {
            return $theme->setting_file_serve('pagebackground', $args, $forcedownload, $options);
        } else if ($filearea === 'slide1image') {
            return $theme->setting_file_serve('slide1image', $args, $forcedownload, $options);
        } else if ($filearea === 'slide2image') {
            return $theme->setting_file_serve('slide2image', $args, $forcedownload, $options);
        } else if ($filearea === 'slide3image') {
            return $theme->setting_file_serve('slide3image', $args, $forcedownload, $options);
        } else if ($filearea === 'slide4image') {
            return $theme->setting_file_serve('slide4image', $args, $forcedownload, $options);
        } else if ($filearea === 'marketing1image') {
            return $theme->setting_file_serve('marketing1image', $args, $forcedownload, $options);
        } else if ($filearea === 'marketing2image') {
            return $theme->setting_file_serve('marketing2image', $args, $forcedownload, $options);
        } else if ($filearea === 'marketing3image') {
            return $theme->setting_file_serve('marketing3image', $args, $forcedownload, $options);
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
 * Displays the Font Awesome Edit Icons based on settings value
 *
 * @param string $css
 * @param mixed $autohide
 * @return string
 */
function essential_set_editicons($css, $editicons) {
	global $CFG;
	if (!empty($CFG->themedir)) {
		$editiconsurl = $CFG->themedir . '/essential/style/editicons.css'; //Pull the full path for autohide css
	} else {
		$editiconsurl = $CFG->dirroot . '/theme/essential/style/editicons.css'; //MDL-36065
	}
    $tag = '[[setting:editicons]]';
    if ($editicons) { //Setting is "YES"
        $rules = file_get_contents($editiconsurl);
        $replacement = $rules;
    } else { //Setting is "NO"
        $replacement = null; //NULL so we don't actually output anything to the stylesheet
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Displays the Autohide CSS based on settings value
 *
 * @param string $css
 * @param mixed $autohide
 * @return string
 * This code originally written for the Zebra theme by Danny Wahl
 */
function essential_set_autohide($css, $autohide) {
	global $CFG;
	if (!empty($CFG->themedir)) {
		$autohideurl = $CFG->themedir . '/essential/style/autohide.css'; //Pull the full path for autohide css
	} else {
		$autohideurl = $CFG->dirroot . '/theme/essential/style/autohide.css'; //MDL-36065
	}
    $tag = '[[setting:autohide]]';
    if ($autohide) { //Setting is "YES"
        $rules = file_get_contents($autohideurl);
        $replacement = $rules;
    } else { //Setting is "NO"
        $replacement = null; //NULL so we don't actually output anything to the stylesheet
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}


/**
 * get_performance_output() override get_peformance_info()
 *  in moodlelib.php. Returns a string
 * values ready for use.
 *
 * @return string
 */
function essential_performance_output($param) {
	
    $html = '<div class="container-fluid performanceinfo"><div class="row-fluid"><h2>Performance Information</h2></div><div class="row-fluid">';
	if (isset($param['realtime'])) $html .= '<div class="span3"><a href="#"><var id="load">'.$param['realtime'].' secs</var><span>Load Time</span></a></div>';
	if (isset($param['memory_total'])) $html .= '<div class="span3"><a href="#"><var id="memory">'.display_size($param['memory_total']).'</var><span>Memory Used</span></a></div>';
    if (isset($param['includecount'])) $html .= '<div class="span3"><a href="#"><var id="included">'.$param['includecount'].' Files </var><span>Included</span></a></div>';
    if (isset($param['dbqueries'])) $html .= '<div class="span3"><a href="#"><var id="db">'.$param['dbqueries'].' </var><span>DB Read/Write</span></a></div>';
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

    // Set the Fonts.
    if ($theme->settings->fontselect ==1) {
        $headingfont = 'Oswald';
        $bodyfont = 'PT Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==2) {
        $headingfont = 'Lobster';
        $bodyfont = 'Cabin';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==3) {
        $headingfont = 'Raelway';
        $bodyfont = 'Goudy Bookletter 1911';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==4) {
        $headingfont = 'Allerta';
        $bodyfont = 'Crimson Text';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==5) {
        $headingfont = 'Arvo';
        $bodyfont = 'PT Sans';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==6) {
        $headingfont = 'Dancing Script';
        $bodyfont = 'Josefin Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==7) {
        $headingfont = 'Allan';
        $bodyfont = 'Cardo';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==8) {
        $headingfont = 'Molengo';
        $bodyfont = 'Lekton';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==9) {
        $headingfont = 'Droid Serif';
        $bodyfont = 'Droid Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==10) {
        $headingfont = 'Corben';
        $bodyfont = 'Nobile';
        $bodysize = '12px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==11) {
        $headingfont = 'Ubuntu';
        $bodyfont = 'Vollkorn';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==12) {
        $headingfont = 'Bree Serif';
        $bodyfont = 'Open Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==13) {
        $headingfont = 'Bevan';
        $bodyfont = 'Pontano Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==14) {
        $headingfont = 'Abril Fatface';
        $bodyfont = 'Average';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==15) {
        $headingfont = 'Playfair Display';
        $bodyfont = 'Multi';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==16) {
        $headingfont = 'Sansita one';
        $bodyfont = 'Kameron';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==17) {
        $headingfont = 'Istok Web';
        $bodyfont = 'Lora';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==18) {
        $headingfont = 'Pacifico';
        $bodyfont = 'Arimo';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==19) {
        $headingfont = 'Nixie One';
        $bodyfont = 'Ledger';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==20) {
        $headingfont = 'Cantata One';
        $bodyfont = 'Imprima';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==21) {
        $headingfont = 'Rancho';
        $bodyfont = 'Gudea';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==22) {
        $headingfont = 'Helvetica';
        $bodyfont = 'Georgia';
        $bodysize = '17px';
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

    
    // Set the navbar seperator.
    if (!empty($theme->settings->navbarsep)) {
        $navbarsep = $theme->settings->navbarsep;
    } else {
        $navbarsep = '/';
    }
    $css = theme_essential_set_navbarsep($css, $navbarsep);
    
    //Get the editicons value from settings
    if (!empty($theme->settings->editicons)) {
        $editicons = $theme->settings->editicons;
    } else {
        $editicons = null;
    }
    $css = essential_set_editicons($css, $editicons);
    
    //Get the autohide value from settings
    if (!empty($theme->settings->autohide)) {
        $autohide = $theme->settings->autohide;
    } else {
        $autohide = null;
    }
    $css = essential_set_autohide($css, $autohide);
    
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

    // Set the font path.
    $css = theme_essential_set_fontwww($css);
    return $css;
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

function theme_essential_set_footersepcolor($css, $footersepcolor) {
    $tag = '[[setting:footersepcolor]]';
    $replacement = $footersepcolor;
    if (is_null($replacement)) {
        $replacement = '#313131';
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

function theme_essential_set_pagebackground($css, $pagebackground, $setting) {
    global $OUTPUT;
    $tag = '[[setting:pagebackground]]';
    $replacement = $pagebackground;
    if (is_null($replacement)) {
        // Get default image from themes 'bg' folder of the name in $setting.
        $replacement = $OUTPUT->pix_url('bg/body', 'theme');
    }
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
    global $OUTPUT;
    $tag = '[[setting:'.$setting.']]';
    $replacement = $marketingimage;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_page_init(moodle_page $page) {
    $page->requires->jquery();
    $page->requires->jquery_plugin('cslider', 'theme_essential');
    $page->requires->jquery_plugin('custom', 'theme_essential'); 
    $page->requires->jquery_plugin('alert', 'theme_essential');
    $page->requires->jquery_plugin('carousel', 'theme_essential');
    $page->requires->jquery_plugin('collapse', 'theme_essential');
    $page->requires->jquery_plugin('modal', 'theme_essential');
    $page->requires->jquery_plugin('scrollspy', 'theme_essential');
    $page->requires->jquery_plugin('tab', 'theme_essential');
    $page->requires->jquery_plugin('tooltip', 'theme_essential');
    $page->requires->jquery_plugin('transition', 'theme_essential');
    $page->requires->jquery_plugin('modernizr', 'theme_essential');  
}