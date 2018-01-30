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
 * Essential is a clean and customizable theme.
 *
 * @package     theme_essential
 * @copyright   2016 Gareth J Barnard
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_essential;

defined('MOODLE_INTERNAL') || die;

class toolbox {

    protected $corerenderer = null;
    protected static $instance;

    private function __construct() {
    }

    public static function get_instance() {
        if (!is_object(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Sets the core_renderer class instance so that when purging all caches and 'theme_xxx_process_css' etc.
     * the settings are correct.
     * @param class core_renderer $core Child object of core_renderer class.
     */
    static public function set_core_renderer($core) {
        $us = self::get_instance();
        // Set only once from the initial calling lib.php process_css function so that subsequent parent calls do not override it.
        // Must happen before parents.
        if (null === $us->corerenderer) {
            $us->corerenderer = $core;
        }
    }

    // Moodle CSS file serving.
    static public function get_csswww() {
        global $CFG;

        if (!self::lte_ie9()) {
            if (\right_to_left()) {
                $moodlecss = 'essential-rtl.css';
            } else {
                $moodlecss = 'essential.css';
            }

            $syscontext = \context_system::instance();
            $itemid = \theme_get_revision();
            $url = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                            "/$syscontext->id/theme_essential/style/$itemid/$moodlecss");
            $url = preg_replace('|^https?://|i', '//', $url->out(false));
            return '<link rel="stylesheet" href="' . $url . '">';
        } else {
            if (\right_to_left()) {
                $moodlecssone = 'essential-rtl_ie9-blessed1.css';
                $moodlecsstwo = 'essential-rtl_ie9.css';
            } else {
                $moodlecssone = 'essential_ie9-blessed1.css';
                $moodlecsstwo = 'essential_ie9.css';
            }

            $syscontext = \context_system::instance();
            $itemid = \theme_get_revision();
            $urlone = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                            "/$syscontext->id/theme_essential/style/$itemid/$moodlecssone");
            $urlone = preg_replace('|^https?://|i', '//', $urlone->out(false));
            $urltwo = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                            "/$syscontext->id/theme_essential/style/$itemid/$moodlecsstwo");
            $urltwo = preg_replace('|^https?://|i', '//', $urltwo->out(false));
            return '<link rel="stylesheet" href="'.$urlone . '"><link rel="stylesheet" href="'.$urltwo.'">';
        }
    }

    /**
     * Finds the given setting in the theme from the themes' configuration object.
     * @param string $setting Setting name.
     * @param string $format false|'format_text'|'format_html'.
     * @return any false|value of setting.
     */
    static public function get_setting($setting, $format = false) {
        $us = self::check_corerenderer();

        $settingvalue = $us->get_setting($setting);

        global $CFG;
        require_once($CFG->dirroot . '/lib/weblib.php');
        if (empty($settingvalue)) {
            return false;
        } else if (!$format) {
            return $settingvalue;
        } else if ($format === 'format_text') {
            return format_text($settingvalue, FORMAT_PLAIN);
        } else if ($format === 'format_html') {
            return format_text($settingvalue, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
        } else if ($format === 'format_file_url') {
            return self::setting_file_url($setting, $setting);
        } else {
            return format_string($settingvalue);
        }
    }

    static public function setting_file_url($setting, $filearea) {
        $us = self::check_corerenderer();

        return $us->setting_file_url($setting, $filearea);
    }

    static public function pix_url($imagename, $component) {
        $us = self::check_corerenderer();
        return $us->pix_url($imagename, $component);
    }

    static public function getfontawesomemarkup($theicon, $classes = array(), $attributes = array(), $content = '') {
        $us = self::check_corerenderer();
        return $us->getfontawesomemarkup($theicon, $classes, $attributes, $content);
    }

    /**
     * States if course content search can be used.  Will not work if theme is in $CFG->themedir.
     * @return boolean false|true if course content search can be used.
     */
    static public function course_content_search() {
        $canwe = false;
        global $CFG;
        if ((self::get_setting('coursecontentsearch')) && (file_exists("$CFG->dirroot/theme/essential/"))) {
            $canwe = true;
        }
        return $canwe;
    }

    static private function check_corerenderer() {
        $us = self::get_instance();
        if (empty($us->corerenderer)) {
            // Use $OUTPUT unless is not a Essential or child core_renderer which can happen on theme switch.
            global $OUTPUT;
            if (property_exists($OUTPUT, 'essential')) {
                $us->corerenderer = $OUTPUT;
            } else {
                // Use $PAGE->theme->name as will be accurate than $CFG->theme when using URL theme changes.
                // Core 'allowthemechangeonurl' setting.
                global $PAGE;
                $corerenderer = null;
                try {
                    $corerenderer = $PAGE->get_renderer('theme_'.$PAGE->theme->name, 'core');
                } catch (\coding_exception $ce) {
                    // Specialised renderer may not exist in theme.  This is not a coding fault.  We just need to cope.
                    $corerenderer = null;
                }
                // Fallback check.
                if (($corerenderer != null) && (property_exists($corerenderer, 'essential'))) {
                    $us->corerenderer = $corerenderer;
                } else {
                    // Probably during theme switch, '$CFG->theme' will be accurrate.
                    global $CFG;
                    try {
                        $corerenderer = $PAGE->get_renderer('theme_'.$CFG->theme, 'core');
                    } catch (\coding_exception $ce) {
                        // Specialised renderer may not exist in theme.  This is not a coding fault.  We just need to cope.
                        $corerenderer = null;
                    }
                    if (($corerenderer != null) && (property_exists($corerenderer, 'essential'))) {
                        $us->corerenderer = $corerenderer;
                    } else {
                        // Last resort.  Hopefully will be fine on next page load for Child themes.
                        // However '***_process_css' in lib.php will be fine as it sets the correct renderer.
                        $us->corerenderer = $PAGE->get_renderer('theme_essential', 'core');
                    }
                }
            }
        }
        return $us->corerenderer;
    }

    /**
     * Finds the given tile file in the theme.
     * @param string $filename Filename without extension to get.
     * @return string Complete path of the file.
     */
    static public function get_tile_file($filename) {
        $us = self::check_corerenderer();
        return $us->get_tile_file($filename);
    }

    static public function get_categories_list() {
        static $catlist = null;
        if (empty($catlist)) {
            global $DB;
            $catlist = $DB->get_records('course_categories', null, 'sortorder', 'id, name, depth, path');

            foreach ($catlist as $category) {
                $category->parents = array();
                if ($category->depth > 1 ) {
                    $path = preg_split('|/|', $category->path, -1, PREG_SPLIT_NO_EMPTY);
                    $category->namechunks = array();
                    foreach ($path as $parentid) {
                        $category->namechunks[] = $catlist[$parentid]->name;
                        $category->parents[] = $parentid;
                    }
                    $category->parents = array_reverse($category->parents);
                } else {
                    $category->namechunks = array($category->name);
                }
            }
        }

        return $catlist;
    }

    // Report Page Title.
    static public function report_page_has_title() {
        global $PAGE;
        $hastitle = true;

        switch ($PAGE->pagetype) {
            case 'grade-report-overview-index':
                $hastitle = false;
                break;
            default:
                break;
        }

        return $hastitle;
    }

    // Page Bottom Region.
    static public function has_page_bottom_region() {
        global $PAGE;
        $hasregion = false;

        switch ($PAGE->pagetype) {
            case 'admin-plugins':
            case 'course-management':
            case 'mod-quiz-edit':
                $hasregion = true;
                break;
            case 'mod-assign-view':
                // Only apply to 'grading' page.
                if (optional_param('action', '', PARAM_TEXT) == 'grading') {
                    $hasregion = true;
                }
                break;
            default:
                break;
        }

        return $hasregion;
    }

    static public function showslider() {
        global $CFG;
        $noslides = self::get_setting('numberofslides');
        if ($noslides && (intval($CFG->version) >= 2013111800)) {
            $devicetype = \core_useragent::get_device_type(); // In useragent.php.
            if (($devicetype == "mobile") && self::get_setting('hideonphone')) {
                $noslides = false;
            } else if (($devicetype == "tablet") && self::get_setting('hideontablet')) {
                $noslides = false;
            }
        }
        return $noslides;
    }

    static public function render_indicators($numberofslides) {
        $indicators = '';
        for ($indicatorslideindex = 0; $indicatorslideindex < $numberofslides; $indicatorslideindex++) {
            $indicators .= '<li data-target="#essentialCarousel" data-slide-to="'.$indicatorslideindex.'"';
            if ($indicatorslideindex == 0) {
                $indicators .= ' class="active"';
            }
            $indicators .= '></li>';
        }
        return $indicators;
    }

    static public function render_slide($slideno, $captionoptions) {
        $slideurl = self::get_setting('slide'.$slideno.'url');
        $slideurltarget = self::get_setting('slide'.$slideno.'target');
        $slidetitle = format_string(self::get_setting('slide'.$slideno));
        $slidecaption = self::get_setting('slide'.$slideno.'caption', 'format_html');
        if ($slideurl) {
            // Strip links from the caption to prevent link in a link.
            $slidecaption = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $slidecaption);
        }
        if ($captionoptions == 0) {
            $slideextraclass = ' side-caption';
        } else {
            $slideextraclass = '';
        }
        $slideextraclass .= ($slideno === 1) ? ' active' : '';
        $slideimagealt = strip_tags($slidetitle);

        // Get slide image or fallback to default.
        $slideimage = self::get_setting('slide'.$slideno.'image');
        if ($slideimage) {
            $slideimage = self::setting_file_url('slide'.$slideno.'image', 'slide'.$slideno.'image');
        } else {
            $slideimage = self::pix_url('default_slide', 'theme');
        }

        if ($slideurl) {
            $slidecontent = '<a href="'.$slideurl.'" target="'.$slideurltarget.'" class="item'.$slideextraclass.'">';
        } else {
            $slidecontent = '<div class="item'.$slideextraclass.'">';
        }

        if ($captionoptions == 0) {
            $slidecontent .= '<div class="container-fluid">';
            $slidecontent .= '<div class="row-fluid">';

            if ($slidetitle || $slidecaption) {
                $slidecontent .= '<div class="span5 the-side-caption">';
                $slidecontent .= '<div class="the-side-caption-content">';
                $slidecontent .= '<h4>'.$slidetitle.'</h4>';
                $slidecontent .= '<div>'.$slidecaption.'</div>';
                $slidecontent .= '</div>';
                $slidecontent .= '</div>';
                $slidecontent .= '<div class="span7">';
            } else {
                $slidecontent .= '<div class="span10 offset1 nocaption">';
            }
            $slidecontent .= '<div class="carousel-image-container">';
            $slidecontent .= '<img src="'.$slideimage.'" alt="'.$slideimagealt.'" class="carousel-image">';
            $slidecontent .= '</div>';
            $slidecontent .= '</div>';

            $slidecontent .= '</div>';
            $slidecontent .= '</div>';
        } else {
            $nocaption = (!($slidetitle || $slidecaption)) ? ' nocaption' : '';
            $slidecontent .= '<div class="carousel-image-container'.$nocaption.'">';
            $slidecontent .= '<img src="'.$slideimage.'" alt="'.$slideimagealt.'" class="carousel-image">';
            $slidecontent .= '</div>';

            // Output title and caption if either is present.
            if ($slidetitle || $slidecaption) {
                $slidecontent .= '<div class="carousel-caption">';
                $slidecontent .= '<div class="carousel-caption-inner">';
                $slidecontent .= '<h4>'.$slidetitle.'</h4>';
                $slidecontent .= '<div>'.$slidecaption.'</div>';
                $slidecontent .= '</div>';
                $slidecontent .= '</div>';
            }
        }
        $slidecontent .= ($slideurl) ? '</a>' : '</div>';

        return $slidecontent;
    }

    static public function render_slide_controls($left) {
        $strprev = get_string('prev');
        $strnext = get_string('next');
        if ($left) {
            $arrowprev = 'left';
            $arrownext = 'right';
        } else {
            $arrowprev = 'right';
            $arrownext = 'left';
        }
        $prev = '<a class="left carousel-control" href="#essentialCarousel" data-slide="prev" aria-label="'.$strprev.'">';
        $prev .= '<span aria-hidden="true" class="fas fa-chevron-circle-'.$arrowprev.'"></span></a>';
        $next = '<a class="right carousel-control" href="#essentialCarousel" data-slide="next" aria-label="'.$strnext.'">';
        $next .= '<span aria-hidden="true" class="fas fa-chevron-circle-'.$arrownext.'"></span></a>';

        return $prev . $next;
    }

    /**
     * Checks if the user is switching colours with a refresh
     *
     * If they are this updates the users preference in the database
     */
    static protected function check_colours_switch() {
        $colours = \optional_param('essentialcolours', null, PARAM_ALPHANUM);
        if (in_array($colours, array('default', 'alternative1', 'alternative2', 'alternative3', 'alternative4'))) {
            \set_user_preference('theme_essential_colours', $colours);
        }
    }

    /**
     * Adds the JavaScript for the colour switcher to the page.
     *
     * The colour switcher is a YUI moodle module that is located in
     *     theme/udemspl/yui/udemspl/udemspl.js
     *
     * @param moodle_page $page
     */
    static public function initialise_colourswitcher(\moodle_page $page) {
        self::check_colours_switch();
        \user_preference_allow_ajax_update('theme_essential_colours', PARAM_ALPHANUM);
        $page->requires->js_call_amd('theme_essential/coloursswitcher', 'init',
            array(array('div' => '#custom_menu_themecolours .dropdown-menu')));
    }

    /**
     * Gets the theme colours the user has selected if enabled or the default if they have never changed.
     *
     * @param string $default The default theme colors to use.
     * @return string The theme colours the user has selected.
     */
    static public function get_colours($default = 'default') {
        $preference = \get_user_preferences('theme_essential_colours', $default);
        foreach (range(1, 4) as $alternativethemenumber) {
            if ($preference == 'alternative'.$alternativethemenumber &&
                self::get_setting('enablealternativethemecolors'.$alternativethemenumber)) {
                return $preference;
            }
        }
        return $default;
    }

    static public function set_font($css, $type, $fontname) {
        $familytag = '[[setting:' . $type . 'font]]';
        $facetag = '[[setting:fontfiles' . $type . ']]';
        if (empty($fontname)) {
            $familyreplacement = 'Verdana';
            $facereplacement = '';
        } else if (self::get_setting('fontselect') === '3') {

            $fontfiles = array();
            $fontfileeot = self::setting_file_url('fontfileeot'.$type, 'fontfileeot'.$type);
            if (!empty($fontfileeot)) {
                $fontfiles[] = "url('".$fontfileeot."?#iefix') format('embedded-opentype')";
            }
            $fontfilewoff = self::setting_file_url('fontfilewoff'.$type, 'fontfilewoff'.$type);
            if (!empty($fontfilewoff)) {
                $fontfiles[] = "url('".$fontfilewoff."') format('woff')";
            }
            $fontfilewofftwo = self::setting_file_url('fontfilewofftwo' . $type, 'fontfilewofftwo'.$type);
            if (!empty($fontfilewofftwo)) {
                $fontfiles[] = "url('".$fontfilewofftwo."') format('woff2')";
            }
            $fontfileotf = self::setting_file_url('fontfileotf'.$type, 'fontfileotf'.$type);
            if (!empty($fontfileotf)) {
                $fontfiles[] = "url('".$fontfileotf."') format('opentype')";
            }
            $fontfilettf = self::setting_file_url('fontfilettf'.$type, 'fontfilettf'.$type);
            if (!empty($fontfilettf)) {
                $fontfiles[] = "url('".$fontfilettf."') format('truetype')";
            }
            $fontfilesvg = self::setting_file_url('fontfilesvg'.$type, 'fontfilesvg'.$type);
            if (!empty($fontfilesvg)) {
                $fontfiles[] = "url('".$fontfilesvg."') format('svg')";
            }

            if (!empty($fontfiles)) {
                $familyreplacement = '"'.$fontname.'"';
                $facereplacement = '@font-face {'.PHP_EOL.'font-family: "'.$fontname.'";'.PHP_EOL;
                $facereplacement .= !empty($fontfileeot) ? "src: url('".$fontfileeot."');".PHP_EOL : '';
                $facereplacement .= "src: ";
                $facereplacement .= implode(",".PHP_EOL." ", $fontfiles);
                $facereplacement .= ";".PHP_EOL."}";
            } else {
                // No files back to default.
                $familyreplacement = 'Verdana';
                $facereplacement = '';
            }
        } else {
            $familyreplacement = '"'.$fontname.'"';
            $facereplacement = '';
        }

        $css = str_replace($familytag, $familyreplacement, $css);
        $css = str_replace($facetag, $facereplacement, $css);

        return $css;
    }

    static public function set_color($css, $themecolor, $tag, $defaultcolour, $alpha = null) {
        if (!($themecolor)) {
            $replacement = $defaultcolour;
        } else {
            $replacement = $themecolor;
        }
        if (!is_null($alpha)) {
            $replacement = self::hex2rgba($replacement, $alpha);
        }
        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    static public function set_alternativecolor($css, $type, $customcolor, $defaultcolour, $alpha = null) {
        $tag = '[[setting:alternativetheme'.$type.']]';
        if (!($customcolor)) {
            $replacement = $defaultcolour;
        } else {
            $replacement = $customcolor;
        }
        if (!is_null($alpha)) {
            $replacement = self::hex2rgba($replacement, $alpha);
        }
        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    static public function get_current_category() {
        $us = self::check_corerenderer();

        return $us->get_current_category();
    }

    static public function set_categorycoursetitleimages($css) {
        $tag = '[[setting:categorycoursetitle]]';
        $replacement = '';

        if (self::get_setting('enablecategorycti')) {
            $categories = self::get_categories_list();

            foreach ($categories as $cid => $unused) {
                $image = self::get_setting('categoryct'.$cid.'image');
                $imageurl = false;
                if ($image) {
                    $imageurl = self::setting_file_url('categoryct'.$cid.'image', 'categoryct'.$cid.'image');
                } else {
                    $imageurlsetting = self::get_setting('categoryctimageurl'.$cid);
                    if ($imageurlsetting) {
                        $imageurl = $imageurlsetting;
                    }
                }
                if ($imageurl) {
                    $replacement .= '.categorycti-'.$cid.' {';
                    $replacement .= 'background-image: url(\''.$imageurl.'\');';
                    $replacement .= 'height: '.self::get_setting('categorycti'.$cid.'height').'px;';
                    $replacement .= '}';
                    $replacement .= '.categorycti-'.$cid.' .coursetitle {';
                    $replacement .= 'color: '.self::get_setting('categorycti'.$cid.'textcolour').';';
                    $replacement .= 'background-color: '.self::get_setting('categorycti'.$cid.'textbackgroundcolour').';';
                    $replacement .= 'opacity: '.self::get_setting('categorycti'.$cid.'textbackgroundopactity').';';
                    $replacement .= '}';
                }
            }
        }

        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    /**
     * Returns the RGB for the given hex.
     *
     * @param string $hex
     * @return array
     */
    static private function hex2rgb($hex) {
        // From: http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/.
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array('r' => $r, 'g' => $g, 'b' => $b);
        return $rgb; // Returns the rgb as an array.
    }

    static public function hexadjust($hex, $percentage) {
        $percentage = round($percentage / 100, 2);
        $rgb = self::hex2rgb($hex);
        $r = round($rgb['r'] - ($rgb['r'] * $percentage));
        $g = round($rgb['g'] - ($rgb['g'] * $percentage));
        $b = round($rgb['b'] - ($rgb['b'] * $percentage));

        return '#'.str_pad(dechex(max(0, min(255, $r))), 2, '0', STR_PAD_LEFT)
            .str_pad(dechex(max(0, min(255, $g))), 2, '0', STR_PAD_LEFT)
            .str_pad(dechex(max(0, min(255, $b))), 2, '0', STR_PAD_LEFT);
    }

    /**
     * Returns the RGBA for the given hex and alpha.
     *
     * @param string $hex
     * @param string $alpha
     * @return string
     */
    static private function hex2rgba($hex, $alpha) {
        $rgba = self::hex2rgb($hex);
        $rgba[] = $alpha;
        return 'rgba('.implode(", ", $rgba).')'; // Returns the rgba values separated by commas.
    }

    static public function set_headerbackground($css, $headerbackground) {
        $tag = '[[setting:headerbackground]]';

        $headerbackgroundstyle = self::get_setting('headerbackgroundstyle');
        $replacement = '#page-header {';
        $replacement .= 'background-image: url(\'';
        if ($headerbackground) {
            $replacement .= $headerbackground;
        } else {
            $replacement .= self::pix_url('bg/header', 'theme');
            $headerbackgroundstyle = 'tiled';
        }
        $replacement .= '\');';

        if ($headerbackground) {
            $replacement .= 'background-size: contain;';
        }

        if ($headerbackgroundstyle == 'tiled') {
            $replacement .= 'background-repeat: repeat;';
        } else {
            $replacement .= 'background-repeat: no-repeat;';
            $replacement .= 'background-position: center;';
        }

        $replacement .= '}';

        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    static public function set_pagebackground($css, $pagebackground) {
        $tag = '[[setting:pagebackground]]';
        if (!($pagebackground)) {
            $replacement = 'none';
        } else {
            $replacement = 'url(\''.$pagebackground.'\')';
        }
        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    static public function set_pagebackgroundstyle($css, $style) {
        $tagattach = '[[setting:backgroundattach]]';
        $tagrepeat = '[[setting:backgroundrepeat]]';
        $tagsize = '[[setting:backgroundsize]]';
        $replacementattach = 'fixed';
        $replacementrepeat = 'no-repeat';
        $replacementsize = 'cover';
        if ($style === 'tiled') {
            $replacementrepeat = 'repeat';
            $replacementsize = 'auto';
        } else if ($style === 'stretch') {
            $replacementattach = 'scroll';
        }

        $css = str_replace($tagattach, $replacementattach, $css);
        $css = str_replace($tagrepeat, $replacementrepeat, $css);
        $css = str_replace($tagsize, $replacementsize, $css);
        return $css;
    }

    static public function set_loginbackground($css, $loginbackground) {
        $tag = '[[setting:loginbackground]]';
        if (!($loginbackground)) {
            $replacement = 'none';
        } else {
            $replacement = 'url(\''.$loginbackground.'\')';
        }
        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    static public function set_loginbackgroundstyle($css, $style, $opacity) {
        $tagopacity = '[[setting:loginbackgroundopacity]]';
        $tagsize = '[[setting:loginbackgroundstyle]]';
        $replacementsize = 'cover';
        if ($style === 'stretch') {
            $replacementsize = '100% 100%';
        }

        $css = str_replace($tagopacity, $opacity, $css);
        $css = str_replace($tagsize, $replacementsize, $css);
        return $css;
    }

    static public function set_marketingheight($css, $marketingheight, $marketingimageheight) {
        $tag = '[[setting:marketingheight]]';
        $mhreplacement = $marketingheight;
        if (!($mhreplacement)) {
            $mhreplacement = 100;
        }
        $css = str_replace($tag, $mhreplacement.'px', $css);
        $tag = '[[setting:marketingheightwithbutton]]';
        $mhreplacement += 32;
        $css = str_replace($tag, $mhreplacement.'px', $css);

        $tag = '[[setting:marketingimageheight]]';
        $mihreplacement = $marketingimageheight;
        if (!($mihreplacement)) {
            $mihreplacement = 100;
        }
        $css = str_replace($tag, $mihreplacement.'px', $css);

        $tag = '[[setting:marketingheightwithimage]]';
        $replacement = $mhreplacement + $mihreplacement;
        if (!($replacement)) {
            $replacement = 200;
        }
        $css = str_replace($tag, $replacement.'px', $css);
        $tag = '[[setting:marketingheightwithimagewithbutton]]';
        $replacement += 32;
        $css = str_replace($tag, $replacement.'px', $css);

        return $css;
    }

    static public function set_marketingimage($css, $marketingimage, $setting) {
        $tag = '[[setting:'.$setting.']]';
        if (!($marketingimage)) {
            $replacement = 'none';
        } else {
            $replacement = 'url(\''.$marketingimage.'\')';
        }
        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    static public function set_customcss($css, $customcss) {
        $tag = '[[setting:customcss]]';
        $replacement = $customcss;
        $css = str_replace($tag, $replacement, $css);
        return $css;
    }

    static public function set_integer($css, $setting, $integer, $default) {
        $tag = '[[setting:'.$setting.']]';
        if (!($integer)) {
            $replacement = $default;
        } else {
            $replacement = $integer;
        }
        $css = str_replace($tag, $replacement, $css);

        return $css;
    }

    static public function set_pagewidth($css, $pagewidth) {
        $tag = '[[setting:pagewidth]]';
        $imagetag = '[[setting:pagewidthimage]]';
        $replacement = $pagewidth;
        if (!($replacement)) {
            $replacement = '1200';
        }
        if ($replacement == "100") {
            $css = str_replace($tag, $replacement.'%', $css);
            $css = str_replace($imagetag, '90'.'%', $css);
        } else {
            $css = str_replace($tag, $replacement.'px', $css);
            $css = str_replace($imagetag, $replacement.'px', $css);
        }
        return $css;
    }

    /**
     * States if the browser is not IE9 or less.
     */
    static public function not_lte_ie9() {
        $properties = self::ie_properties();
        if (!is_array($properties)) {
            return true;
        }
        // We have properties, it is a version of IE, so is it greater than 9?
        return ($properties['version'] > 9.0);
    }

    /**
     * States if the browser is IE9 or less.
     */
    static public function lte_ie9() {
        $properties = self::ie_properties();
        if (!is_array($properties)) {
            return false;
        }
        // We have properties, it is a version of IE, so is it greater than 9?
        return ($properties['version'] <= 9.0);
    }

    /**
     * States if the browser is IE by returning properties, otherwise false.
     */
    static protected function ie_properties() {
        $properties = \core_useragent::check_ie_properties(); // In /lib/classes/useragent.php.
        if (!is_array($properties)) {
            return false;
        } else {
            return $properties;
        }
    }

    static public function compile_properties($themename, $array = true) {
        global $CFG, $DB;

        $props = array();
        $themeprops = $DB->get_records('config_plugins', array('plugin' => 'theme_'.$themename));

        if ($array) {
            $props['moodle_version'] = $CFG->version;
            // Put the theme version next so that it will be at the top of the table.
            foreach ($themeprops as $themeprop) {
                if ($themeprop->name == 'version') {
                    $props['theme_version'] = $themeprop->value;
                    unset($themeprops[$themeprop->id]);
                    break;
                }
            }

            foreach ($themeprops as $themeprop) {
                $props[$themeprop->name] = $themeprop->value;
            }
        } else {
            $data = new \stdClass();
            $data->id = 0;
            $data->value = $CFG->version;
            $props['moodle_version'] = $data;
            // Convert 'version' to 'theme_version'.
            foreach ($themeprops as $themeprop) {
                if ($themeprop->name == 'version') {
                    $data = new \stdClass();
                    $data->id = $themeprop->id;
                    $data->name = 'theme_version';
                    $data->value = $themeprop->value;
                    $props['theme_version'] = $data;
                    unset($themeprops[$themeprop->id]);
                    break;
                }
            }
            foreach ($themeprops as $themeprop) {
                $data = new \stdClass();
                $data->id = $themeprop->id;
                $data->value = $themeprop->value;
                $props[$themeprop->name] = $data;
            }
        }

        return $props;
    }

    static public function put_properties($themename, $props) {
        global $DB;

        // Get the current properties as a reference and for theme version information.
        $currentprops = self::compile_properties($themename, false);

        // Build the report.
        $report = get_string('putpropertyreport', 'theme_essential').PHP_EOL;
        $report .= get_string('putpropertyproperties', 'theme_essential').' \'Moodle\' '.
            get_string('putpropertyversion', 'theme_essential').' '.$props['moodle_version'].'.'.PHP_EOL;
        unset($props['moodle_version']);
        $report .= get_string('putpropertyour', 'theme_essential').' \'Moodle\' '.
            get_string('putpropertyversion', 'theme_essential').' '.$currentprops['moodle_version']->value.'.'.PHP_EOL;
        unset($currentprops['moodle_version']);
        $report .= get_string('putpropertyproperties', 'theme_essential').' \''.ucfirst($themename).'\' '.
            get_string('putpropertyversion', 'theme_essential').' '.$props['theme_version'].'.'.PHP_EOL;
        unset($props['theme_version']);
        $report .= get_string('putpropertyour', 'theme_essential').' \''.ucfirst($themename).'\' '.
            get_string('putpropertyversion', 'theme_essential').' '.$currentprops['theme_version']->value.'.'.PHP_EOL.PHP_EOL;
        unset($currentprops['theme_version']);

        // Pre-process files - using 'theme_essential_pluginfile' in lib.php as a reference.
        // TODO: refactor into one method for both this and that.
        $filestoreport = '';
        $preprocessfilesettings = array('logo', 'headerbackground', 'pagebackground', 'favicon', 'iphoneicon',
            'iphoneretinaicon', 'ipadicon', 'ipadretinaicon', 'loginbackground');
        $fonttypes = array('eot', 'otf', 'svg', 'ttf', 'woff', 'woff2');
        foreach ($fonttypes as $fonttype) {
            $preprocessfilesettings[] = 'fontfile'.$fonttype.'heading';
            $preprocessfilesettings[] = 'fontfile'.$fonttype.'body';
        }
        // Only 3 marketing spots and no setting for the number.
        $preprocessfilesettings = array_merge($preprocessfilesettings, array('marketing1image', 'marketing2image', 'marketing3image'));

        // Slide show.
        for ($propslide = 1; $propslide <= $props['numberofslides']; $propslide++) {
            $preprocessfilesettings[] = 'slide'.$propslide.'image';
        }

        // Process the file properties.
        foreach ($preprocessfilesettings as $preprocessfilesetting) {
            self::put_prop_file_preprocess($preprocessfilesetting, $props, $filestoreport);
            unset($currentprops[$preprocessfilesetting]);
        }

        // Course title images are complex and related to the category id of the installation, so ignore!
        if ((!empty($props['enablecategorycti'])) || (!empty($props['enablecategoryctics']))) {
            $report .= get_string('putpropertiesignorecti', 'theme_essential').PHP_EOL.PHP_EOL;
        }
        $ctikeys = array(
            'enablecategorycti',
            'enablecategoryctics',
            'ctioverrideheight',
            'ctioverridetextcolour',
            'ctioverridetextbackgroundcolour',
            'ctioverridetextbackgroundopacity');
        foreach ($ctikeys as $ctikey) {
            unset($props[$ctikey]);
            unset($currentprops[$ctikey]);
        }
        $propskeys = array_keys($props);
        foreach ($propskeys as $propkey) {
            if (preg_match('#^categoryct#', $propkey) === 1) {
                unset($props[$propkey]);
            }
        }
        $currentpropkeys = array_keys($currentprops);
        foreach ($currentpropkeys as $currentpropkey) {
            if (preg_match('#^categoryct#', $currentpropkey) === 1) {
                unset($currentprops[$currentpropkey]);
            }
        }

        if ($filestoreport) {
            $report .= get_string('putpropertiesreportfiles', 'theme_essential').PHP_EOL.$filestoreport.PHP_EOL;
        }

        // Need to ignore and report on any unknown settings.
        $report .= get_string('putpropertiessettingsreport', 'theme_essential').PHP_EOL;
        $changed = '';
        $unchanged = '';
        $added = '';
        $ignored = '';
        $settinglog = '';
        foreach ($props as $propkey => $propvalue) {
            $settinglog = '\''.$propkey.'\' '.get_string('putpropertiesvalue', 'theme_essential').' \''.$propvalue.'\'';
            if (array_key_exists($propkey, $currentprops)) {
                if ($propvalue != $currentprops[$propkey]->value) {
                    $settinglog .= ' '.get_string('putpropertiesfrom', 'theme_essential').' \''.$currentprops[$propkey]->value.'\'';
                    $changed .= $settinglog.'.'.PHP_EOL;
                    $DB->update_record('config_plugins', array('id' => $currentprops[$propkey]->id, 'value' => $propvalue), true);
                } else {
                    $unchanged .= $settinglog.'.'.PHP_EOL;
                }
            } else if (preg_match('#^slide#', $propkey) === 1) {
                $DB->insert_record('config_plugins', array(
                    'plugin' => 'theme_'.$themename, 'name' => $propkey, 'value' => $propvalue), true);
                $added .= $settinglog.'.'.PHP_EOL;
            } else {
                $ignored .= $settinglog.'.'.PHP_EOL;
            }
        }

        if (!empty($changed)) {
            $report .= get_string('putpropertieschanged', 'theme_essential').PHP_EOL.$changed.PHP_EOL;
        }
        if (!empty($added)) {
            $report .= get_string('putpropertiesadded', 'theme_essential').PHP_EOL.$added.PHP_EOL;
        }
        if (!empty($unchanged)) {
            $report .= get_string('putpropertiesunchanged', 'theme_essential').PHP_EOL.$unchanged.PHP_EOL;
        }
        if (!empty($ignored)) {
            $report .= get_string('putpropertiesignored', 'theme_essential').PHP_EOL.$ignored.PHP_EOL;
        }

        return $report;
    }

    static private function put_prop_file_preprocess($key, &$props, &$filestoreport) {
        if (!empty($props[$key])) {
            $filestoreport .= '\''.$key.'\' '.get_string('putpropertiesvalue', 'theme_essential').' \''.
                \core_text::substr($props[$key], 1).'\'.'.PHP_EOL;
        }
        unset($props[$key]);
    }

    public function get_fa5_from_fa4($icon, $hasprefix = false) {
        $icontofind = ($hasprefix) ? $icon : 'fa-'.$icon;

        $foundicon = false;

        // Ref: fa-v4-shims.js.
        static $icons = array(
            'glass' => 'fas fa-glass-martini',
            'meetup' => 'fab fa-meetup',
            'star-o' => 'far fa-star',
            'remove' => => 'fas fa-times',
            'close' => 'fas fa-times',
            'gear' => 'fas fa-cog',
            'trash-o' => 'far fa-trash-alt',
            'file-o' => 'far fa-file',
            'clock-o' => 'far fa-clock',
            'arrow-circle-o-down' => 'far fa-arrow-alt-circle-down',
            'arrow-circle-o-up' => 'far fa-arrow-alt-circle-up',
            'play-circle-o' => 'far fa-play-circle',
            'repeat' => 'fas fa-redo',
            'rotate-right' => 'fas fa-redo',
            'refresh' => 'fas fa-sync',
            'list-alt' => 'far fa-list-alt',
            'dedent' => 'fas fa-outdent',
            'video-camera' => 'fas fa-video',
            'picture-o' => 'far fa-image',
            'photo' => 'far fa-image',
            'image' => 'far fa-image',
            'pencil' => 'fas fa-pencil-alt',
            'map-marker' => 'fas fa-map-marker-alt',
            'pencil-square-o' => 'far fa-edit',
            'share-square-o' => 'far fa-share-square',
            'check-square-o' => 'far fa-check-square',
            'arrows' => 'fas fa-arrows-alt',
            'times-circle-o' => 'far fa-times-circle',
            'check-circle-o' => 'far fa-check-circle',
            'mail-forward' => 'fas fa-share',
            'eye-slash' => 'far fa-eye-slash',
            'warning' => 'fas fa-exclamation-triangle',
            'calendar' => 'fas fa-calendar-alt',
            'arrows-v' => 'fas fa-arrows-alt-v',
            'arrows-h' => 'fas fa-arrows-alt-h',
            'bar-chart' => 'far fa-chart-bar',
            'bar-chart-o' => 'far fa-chart-bar',
            'twitter-square' => 'fab fa-twitter-square',
            'facebook-square' => 'fab fa-facebook-square',
            'gears' => 'fas fa-cogs',
            'thumbs-o-up' => 'far fa-thumbs-up',
            'thumbs-o-down' => 'far fa-thumbs-down',
            'heart-o' => 'far fa-heart',
            'sign-out' => 'fas fa-sign-out-alt',
            'linkedin-square' => 'fab fa-linkedin',
            'thumb-tack' => 'fas fa-thumbtack',
            'external-link' => 'fas fa-external-link-alt',
            'sign-in' => 'fas fa-sign-in-alt',
            'github-square' => 'fab fa-github-square',
            'lemon-o' => 'far fa-lemon',
            'square-o' => 'far fa-square',
            'bookmark-o' => 'far fa-bookmark',
            'twitter' => 'fab fa-twitter',
            'facebook' => 'fab fa-facebook-f',
            'facebook-f' => 'fab fa-facebook-f',
            'github' => 'fab fa-github',
            'credit-card' => 'far fa-credit-card',
            'feed' => 'fas fa-rss',
            'hdd-o' => 'far fa-hdd',
            'hand-o-right' => 'far fa-hand-point-right',
            'hand-o-left' => 'far fa-hand-point-left',
            'hand-o-up' => 'far fa-hand-point-up',
            'hand-o-down' => 'far fa-hand-point-down',
            'arrows-alt' => 'fas fa-expand-arrows-alt',
            'group' => 'fas fa-users',
            'chain' => 'fas fa-link',
            'scissors' => 'fas fa-cut',
            'files-o' => 'far fa-copy',
            'floppy-o' => 'far fa-save',
            'navicon' => 'fas fa-bars',
            'reorder' => 'fas fa-bars',
            'pinterest' => 'fab fa-pinterest',
            'pinterest-square' => 'fab fa-pinterest-square',
            'google-plus-square' => 'fab fa-google-plus-square',
            'google-plus' => 'fab fa-google-plus-g',
            'money' => 'far fa-money-bill-alt',
            'unsorted' => 'fas fa-sort',
            'sort-desc' => 'fas fa-sort-down',
            'sort-asc' => 'fas fa-sort-up',
            'linkedin' => 'fab fa-linkedin-in',
            'rotate-left' => 'fas fa-undo',
            'legal' => 'fas fa-gavel',
            'tachometer' => 'fas fa-tachometer-alt',
            'dashboard' => 'fas fa-tachometer-alt',
            'comment-o' => 'far fa-comment',
            'comments-o' => 'far fa-comments',
            'flash' => 'fas fa-bolt',
            'clipboard' => 'far fa-clipboard',
            'paste' => 'far fa-clipboard',
            'lightbulb-o' => 'far fa-lightbulb',
            'exchange' => 'fas fa-exchange-alt',
            'cloud-download' => 'fas fa-cloud-download-alt',
            'cloud-upload' => 'fas fa-cloud-upload-alt',
            'bell-o' => 'far fa-bell',
            'cutlery' => 'fas fa-utensils',
            'file-text-o' => 'far fa-file-alt',
            'building-o' => 'far fa-building',
            'hospital-o' => 'far fa-hospital',
            'tablet' => 'fas fa-tablet-alt',
            'mobile' => 'fas fa-mobile-alt',
            'mobile-phone' => 'fas fa-mobile-alt',
            'circle-o' => 'far fa-circle',
            'mail-reply' => 'fas fa-reply',
            'github-alt' => 'fab fa-github-alt',
            'folder-o' => 'far fa-folder',
            'folder-open-o' => 'far fa-folder-open',
            'smile-o' => 'far fa-smile',
            'frown-o' => 'far fa-frown',
            'meh-o' => 'far fa-meh',
            'keyboard-o' => 'far fa-keyboard',
            'flag-o' => 'far fa-flag',
            'mail-reply-all' => 'fas fa-reply-all',
            'star-half-o' => 'far fa-star-half',
            'star-half-empty' => 'far fa-star-half',
            'star-half-full' => 'far fa-star-half',
            'code-fork' => 'fas fa-code-branch',
            'chain-broken' => 'fas fa-unlink',
            'shield' => 'fas fa-shield-alt',
            'calendar-o' => 'far fa-calendar',
            'maxcdn' => 'fab fa-maxcdn',
            'html5' => 'fab fa-html5',
            'css3' => 'fab fa-css3',
            'ticket' => 'fas fa-ticket-alt',
            'minus-square-o' => 'far fa-minus-square',
            'level-up' => 'fas fa-level-up-alt',
            'level-down' => 'fas fa-level-down-alt',
            'pencil-square' => 'fas fa-pen-square',
            'external-link-square' => 'fas fa-external-link-square-alt',
            'compass' => 'far fa-compass',
            'caret-square-o-down' => 'far fa-caret-square-down',
            'toggle-down' => 'far fa-caret-square-down',
            'caret-square-o-up' => 'far fa-caret-square-up',
            'toggle-up' => 'far fa-caret-square-up',
            'caret-square-o-right' => 'far fa-caret-square-right',
            'toggle-right' => 'far fa-caret-square-right',
            'eur' => 'fas fa-euro-sign',
            'euro' => 'fas fa-euro-sign',
            'gbp' => 'fas fa-pound-sign',
            'usd' => 'fas fa-dollar-sign',
            'dollar' => 'fas fa-dollar-sign',
            'inr' => 'fas fa-rupee-sign',
            'rupee' => 'fas fa-rupee-sign',
            'jpy' => 'fas fa-yen-sign',
            'cny' => 'fas fa-yen-sign',
            'rmb' => 'fas fa-yen-sign',
            'yen' => 'fas fa-yen-sign',
            'rub' => 'fas fa-ruble-sign',
            'ruble' => 'fas fa-ruble-sign',
            'rouble' => 'fas fa-ruble-sign',
            'krw' => 'fas fa-won-sign',
            'won' => 'fas fa-won-sign',
            'btc' => 'fab' => 'fas ',
            'bitcoin' => 'fab fa-btc',
            'file-text' => 'fas fa-file-alt',
            'sort-alpha-asc' => 'fas fa-sort-alpha-down',
            'sort-alpha-desc' => 'fas fa-sort-alpha-up',
            'sort-amount-asc' => 'fas fa-sort-amount-down',
            'sort-amount-desc' => 'fas fa-sort-amount-up',
            'sort-numeric-asc' => 'fas fa-sort-numeric-down',
            'sort-numeric-desc' => 'fas fa-sort-numeric-up',
            'youtube-square' => 'fab fa-youtube-square',
            'youtube' => 'fab fa-youtube',
            'xing' => 'fab fa-xing',
            'xing-square' => 'fab fa-xing-square',
            'youtube-play' => 'fab fa-youtube',
            'dropbox' => 'fab fa-dropbox',
            'stack-overflow' => 'fab fa-stack-overflow',
            'instagram' => 'fab fa-instagram',
            'flickr' => 'fab fa-flickr',
            'adn' => 'fab fa-adn',
            'bitbucket' => 'fab fa-bitbucket',
            'bitbucket-square' => 'fab fa-bitbucket',
            'tumblr' => 'fab fa-tumblr',
            'tumblr-square' => 'fab fa-tumblr-square',
            'long-arrow-down' => 'fas fa-long-arrow-alt-down',
            'long-arrow-up' => 'fas fa-long-arrow-alt-up',
            'long-arrow-left' => 'fas fa-long-arrow-alt-left',
            'long-arrow-right' => 'fas fa-long-arrow-alt-right',
            'apple' => 'fab fa-apple',
            'windows' => 'fab fa-windows',
            'android' => 'fab fa-android',
            'linux' => 'fab fa-linux',
            'dribbble' => 'fab fa-dribble',
            'skype' => 'fab fa-skype',
            'foursquare' => 'fab fa-foursquare',
            'trello' => 'fab fa-trello',
            'gratipay' => 'fab fa-gratipay',
            'gittip' => 'fab fa-gratipay',
            'sun-o' => 'far fa-sun',
            'moon-o' => 'far fa-moon',
            'vk' => 'fab fa-vk',
            'weibo' => 'fab fa-weibo',
            'renren' => 'fab fa-renren',
            'pagelines' => 'fab fa-pagelines',
            'stack-exchange' => 'fab fa-stack-exchange',
            'arrow-circle-o-right' => 'far fa-arrow-alt-circle-right',
            'arrow-circle-o-left' => 'far fa-arrow-alt-circle-left',
            'caret-square-o-left' => 'far fa-caret-square-left',
            'toggle-left' => 'far fa-caret-square-left',
            'dot-circle-o' => 'far fa-dot-circle',
            'vimeo-square' => 'fab fa-vimeo-square',
            'try' => 'fas fa-lira-sign',
            'turkish-lira' => 'fas fa-lira-sign',
            'plus-square-o' => 'far fa-plus-square',
            'slack' => 'fab fa-slack',
            'wordpress' => 'fab fa-wordpress',
            'openid' => 'fab fa-openid',
            'institution' => 'fas fa-university',
            'bank' => 'fas fa-university',
            'mortar-board' => 'fas fa-graduation-cap',
            'yahoo' => 'fab fa-yahoo',
            'google' => 'fab fa-google',
            'reddit' => 'fab fa-reddit',
            'reddit-square' => 'fab fa-reddit-square',
            'stumbleupon-circle' => 'fab fa-stumbleupon-circle',
            'stumbleupon' => 'fab fa-stumbleupon',
            'delicious' => 'fab fa-delicious',
            'digg' => 'fab fa-digg',
            'pied-piper-pp' => 'fab fa-pied-piper-pp',
            'pied-piper-alt' => 'fab fa-pied-piper-alt',
            'drupal' => 'fab fa-drupal',
            'joomla' => 'fab fa-joomla',
            'spoon' => 'fas fa-utensil-spoon',
            'behance' => 'fab fa-behance',
            'behance-square' => 'fab fa-behance-square',
            'steam' => 'fab fa-steam',
            'steam-square' => 'fab fa-steam-square',
            'automobile' => 'fas fa-car',
            'cab' => 'fas fa-taxi',
            'spotify' => 'fab fa-spotify',
            'envelope-o' => 'far fa-envelope',
            'soundcloud' => 'fab fa-soundcloud',
            'file-pdf-o' => 'far fa-file-pdf',
            'file-word-o' => 'far fa-file-word',
            'file-excel-o' => 'far fa-file-excel',
            'file-powerpoint-o' => 'far fa-file-powerpoint',
            'file-image-o' => 'far fa-file-image',
            'file-photo-o' => 'far fa-file-image',
            'file-picture-o' => 'far fa-file-image',
            'file-archive-o' => 'far fa-file-archive',
            'file-zip-o' => 'far fa-file-archive',
            'file-audio-o' => 'far fa-file-audio',
            'file-sound-o' => 'far fa-file-audio',
            'file-video-o' => 'far fa-file-video',
            'file-movie-o' => 'far fa-file-video',
            'file-code-o' => 'far fa-file-code',
            'vine' => 'fab fa-vine',
            'codepen' => 'fab fa-codepen',
            'jsfiddle' => 'fab fa-jsfiddle',
            'life-ring' => 'far fa-life-ring',
            'life-bouy' => 'far fa-life-ring',
            'life-buoy' => 'far fa-life-ring',
            'life-saver' => 'far fa-life-ring',
            'support' => 'far fa-life-ring',
            'circle-o-notch' => 'fas fa-circle-notch',
            'rebel' => 'fab fa-rebel',
            'ra' => 'fab fa-rebel',
            'resistance' => 'fab fa-rebel',
            'empire' => 'fab fa-empire',
            'ge' => 'fab fa-empire',
            'git-square' => 'fab fa-git-square',
            'git' => 'fab fa-git',
            'hacker-news' => 'fab fa-hacker-news',
            'y-combinator-square' => 'fab fa-hacker-news',
            'yc-square' => 'fab fa-hacker-news',
            'tencent-weibo' => 'fab fa-tencent-weibo',
            'qq' => 'fab fa-gg',
            'weixin' => 'fab fa-weixin',
            'wechat' => 'fab fa-weixin',
            'send' => 'fas fa-paper-plane',
            'paper-plane-o' => 'far fa-paper-plane',
            'send-o' => 'far fa-paper-plane',
            'circle-thin' => 'far fa-circle',
            'header' => 'fas fa-heading',
            'sliders' => 'fas fa-sliders-h',
            'futbol-o' => 'far fa-futbol',
            'soccer-ball-o' => 'far fa-futbol',
            'slideshare' => 'fab fa-slideshare',
            'twitch' => 'fab fa-twitch',
            'yelp' => 'fab fa-yelp',
            'newspaper-o' => 'far fa-newspaper',
            'paypal' => 'fab fa-paypal',
            'google-wallet' => 'fab fa-google-wallet',
            'cc-visa' => 'fab fa-cc-visa',
            'cc-mastercard' => 'fab fa-cc-mastercard',
            'cc-discover' => 'fab fa-cc-discover',
            'cc-amex' => 'fab fa-cc-amex',
            'cc-paypal' => 'fab fa-cc-paypal',
            'cc-stripe' => 'fab fa-cc-stripe',
            'bell-slash-o' => 'far fa-bell-slash',
            'trash' => 'fas fa-trash-alt',
            'copyright' => 'far fa-copyright',
            'eyedropper' => 'fas fa-eye-dropper',
            'area-chart' => 'fas fa-chart-area',
            'pie-chart' => 'fas fa-chart-pie',
            'line-chart' => 'fas fa-chart-line',
            'lastfm' => 'fab fa-lastfm',
            'lastfm-square' => 'fab fa-lastfm-square',
            'ioxhost' => 'fab fa-ioxhost',
            'angellist' => 'fab fa-angellist',
            'cc' => 'far fa-closed-captioning',
            'ils' => 'fas fa-shekel-sign',
            'shekel' => 'fas fa-shekel-sign',
            'sheqel' => 'fas fa-shekel-sign',
            'meanpath' => 'fab' => 'font-awesome',
            'buysellads' => 'fab fa-buysellads',
            'connectdevelop' => 'fab fa-connectdevelop',
            'dashcube' => 'fab fa-dashcube',
            'forumbee' => 'fab fa-forumbee',
            'leanpub' => 'fab fa-leanpub',
            'sellsy' => 'fab fa-sellsy',
            'shirtsinbulk' => 'fab fa-shirtsinbulk',
            'simplybuilt' => 'fab fa-simplybuilt',
            'skyatlas' => 'fab fa-skyatlas',
            'diamond' => 'far fa-gem',
            'intersex' => 'fas fa-transgender',
            'facebook-official' => 'fab fa-facebook',
            'pinterest-p' => 'fab fa-pinterest-p',
            'whatsapp' => 'fab fa-whatsapp',
            'hotel' => 'fas fa-bed',
            'viacoin' => 'fab fa-viacoin',
            'medium' => 'fab fa-medium',
            'y-combinator' => 'fab fa-y-combinator',
            'yc' => 'fab fa-y-combinator',
            'optin-monster' => 'fab fa-optin-monster',
            'opencart' => 'fab fa-opencart',
            'expeditedssl' => 'fab fa-expeditedssl',
            'battery-4' => 'fas fa-battery-full',
            'battery' => 'fas fa-battery-full',
            'battery-3' => 'fas fa-battery-three-quarters',
            'battery-2' => 'fas fa-battery-half',
            'battery-1' => 'fas fa-battery-quarter',
            'battery-0' => 'fas fa-battery-empty',
            'object-group' => 'far fa-object-group',
            'object-ungroup' => 'far fa-object-ungroup',
            'sticky-note-o' => 'far fa-sticky-note',
            'cc-jcb' => 'fab fa-cc-jcb',
            'cc-diners-club' => 'fab fa-cc-diners-club',
            'clone' => 'far fa-clone',
            'hourglass-o' => 'far fa-hourglass',
            'hourglass-1' => 'fas fa-hourglass-start',
            'hourglass-2' => 'fas fa-hourglass-half',
            'hourglass-3' => 'fas fa-hourglass-end',
            'hand-rock-o' => 'far fa-hand-rock',
            'hand-grab-o' => 'far fa-hand-rock',
            'hand-paper-o' => 'far fa-hand-paper',
            'hand-stop-o' => 'far fa-hand-paper',
            'hand-scissors-o' => 'far fa-hand-scissors',
            'hand-lizard-o' => 'far fa-hand-lizard',
            'hand-spock-o' => 'far fa-hand-spock',
            'hand-pointer-o' => 'far fa-hand-pointer',
            'hand-peace-o' => 'far fa-hand-peace',
            'registered' => 'far fa-registered',
            'creative-commons' => 'fab fa-creative-commons',
            'gg' => 'fab fa-gg',
            'gg-circle' => 'fab fa-gg-circle',
            'tripadvisor' => 'fab fa-tripadvisor',
            'odnoklassniki' => 'fab fa-odnoklassniki',
            'odnoklassniki-square' => 'fab fa-odnoklassniki-square',
            'get-pocket' => 'fab fa-get-pocket',
            'wikipedia-w' => 'fab fa-wikipedia-w',
            'safari' => 'fab fa-safari',
            'chrome' => 'fab fa-chrome',
            'firefox' => 'fab fa-firefox',
            'opera' => 'fab fa-opera',
            'internet-explorer' => 'fab fa-internet-explorer',
            'television' => 'fas fa-tv',
            'contao' => 'fab fa-contao',
            '500px' => 'fab fa-500px',
            'amazon' => 'fab fa-amazon',
            'calendar-plus-o' => 'far fa-calendar-plus',
            'calendar-minus-o' => 'far fa-calendar-minus',
            'calendar-times-o' => 'far fa-calendar-times',
            'calendar-check-o' => 'far fa-calendar-check',
            'map-o' => 'far fa-map',
            'commenting' => 'fas fa-comment-alt',
            'commenting-o' => 'far fa-comment-alt',
            'houzz' => 'fab fa-houzz',
            'vimeo' => 'fab fa-vimeo-v',
            'black-tie' => 'fab fa-black-tie',
            'fonticons' => 'fab fa-fonticons',
            'reddit-alien' => 'fab fa-reddit-alien',
            'edge' => 'fab fa-edge',
            'credit-card-alt' => 'fas fa-credit-card',
            'codiepie' => 'fab fa-codiepie',
            'modx' => 'fab fa-modx',
            'fort-awesome' => 'fab fa-fort-awesome',
            'usb' => 'fab fa-usb',
            'product-hunt' => 'fab fa-product-hunt',
            'mixcloud' => 'fab fa-mixcloud',
            'scribd' => 'fab fa-scribd',
            'pause-circle-o' => 'far fa-pause-circle',
            'stop-circle-o' => 'far fa-stop-circle',
            'bluetooth' => 'fab fa-bluetooth',
            'bluetooth-b' => 'fab fa-bluetooth-b',
            'gitlab' => 'fab fa-gitlab',
            'wpbeginner' => 'fab fa-wpbeginner',
            'wpforms' => 'fab fa-wpforms',
            'envira' => 'fab fa-envira',
            'wheelchair-alt' => 'fab fa-accessible-icon',
            'question-circle-o' => 'far fa-question-circle',
            'volume-control-phone' => 'fas fa-phone-volume',
            'asl-interpreting' => 'fas fa-american-sign-language-interpreting',
            'deafness' => 'fas fa-deaf',
            'hard-of-hearing' => 'fas fa-deaf',
            'glide' => 'fab fa-glide',
            'glide-g' => 'fab fa-glide-g',
            'signing' => 'fas fa-sign-language',
            'viadeo' => 'fab fa-viadeo',
            'viadeo-square' => 'fab fa-viadeo-square',
            'snapchat' => 'fab fa-snapchat',
            'snapchat-ghost' => 'fab fa-snapchat-ghost',
            'snapchat-square' => 'fab fa-snapchat-square',
            'pied-piper' => 'fab fa-pied-piper',
            'first-order' => 'fab fa-first-order',
            'yoast' => 'fab fa-yoast',
            'themeisle' => 'fab fa-themeisle',
            'google-plus-official' => 'fab fa-google-plus',
            'google-plus-circle' => 'fab fa-google-plus',
            'font-awesome' => 'fab fa-font-awesome',
            'fa' => 'fab' => 'font-awesome',
            'handshake-o' => 'far fa-handshake',
            'envelope-open-o' => 'far fa-envelope-open',
            'linode' => 'fab fa-linode',
            'address-book-o' => 'far fa-address-book',
            'vcard' => 'fas fa-address-card',
            'address-card-o' => 'far fa-address-card',
            'vcard-o' => 'far fa-address-card',
            'user-circle-o' => 'far fa-user-circle',
            'user-o' => 'far fa-user',
            'id-badge' => 'far fa-id-badge',
            'drivers-license' => 'fas fa-id-card',
            'id-card-o' => 'far fa-id-card',
            'drivers-license-o' => 'far fa-id-card',
            'quora' => 'fab fa-quora',
            'free-code-camp' => 'fab fa-free-code-camp',
            'telegram' => 'fab fa-telegram',
            'thermometer-4' => 'fas fa-thermometer-full',
            'thermometer' => 'fas fa-thermometer-full',
            'thermometer-3' => 'fas fa-thermometer-three-quarters',
            'thermometer-2' => 'fas fa-thermometer-half',
            'thermometer-1' => 'fas fa-thermometer-quarter',
            'thermometer-0' => 'fas fa-thermometer-empty',
            'bathtub' => 'fas fa-bath',
            's15' => 'fas fa-bath',
            'window-maximize' => 'far fa-window-maximize',
            'window-restore' => 'far fa-window-restore',
            'times-rectangle' => 'fas fa-window-close',
            'window-close-o' => 'far fa-window-close',
            'times-rectangle-o' => 'far fa-window-close',
            'bandcamp' => 'fab fa-bandcamp',
            'grav' => 'fab fa-gray',
            'etsy' => 'fab fa-etsy',
            'imdb' => 'fab fa-imdb',
            'ravelry' => 'fab fa-ravelry',
            'eercast' => 'fab fa-sellcast',
            'snowflake-o' => 'far fa-snowflake',
            'superpowers' => 'fab fa-superpowers',
            'wpexplorer' => 'fab fa-wpexplorer',
            'deviantart' => 'fab fa-deviantart'
        );

        return $foundicon;
    }
}
