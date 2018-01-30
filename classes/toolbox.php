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

        // Ref: fa-v4-shims.js.
        static $icons = array(
            'fa-glass' => 'fas fa-glass-martini',
            'fa-meetup' => 'fab fa-meetup',
            'fa-star-o' => 'far fa-star',
            'fa-remove' => 'fas fa-times',
            'fa-close' => 'fas fa-times',
            'fa-gear' => 'fas fa-cog',
            'fa-trash-o' => 'far fa-trash-alt',
            'fa-file-o' => 'far fa-file',
            'fa-clock-o' => 'far fa-clock',
            'fa-arrow-circle-o-down' => 'far fa-arrow-alt-circle-down',
            'fa-arrow-circle-o-up' => 'far fa-arrow-alt-circle-up',
            'fa-play-circle-o' => 'far fa-play-circle',
            'fa-repeat' => 'fas fa-redo',
            'fa-rotate-right' => 'fas fa-redo',
            'fa-refresh' => 'fas fa-sync',
            'fa-list-alt' => 'far fa-list-alt',
            'fa-dedent' => 'fas fa-outdent',
            'fa-video-camera' => 'fas fa-video',
            'fa-picture-o' => 'far fa-image',
            'fa-photo' => 'far fa-image',
            'fa-image' => 'far fa-image',
            'fa-pencil' => 'fas fa-pencil-alt',
            'fa-map-marker' => 'fas fa-map-marker-alt',
            'fa-pencil-square-o' => 'far fa-edit',
            'fa-share-square-o' => 'far fa-share-square',
            'fa-check-square-o' => 'far fa-check-square',
            'fa-arrows' => 'fas fa-arrows-alt',
            'fa-times-circle-o' => 'far fa-times-circle',
            'fa-check-circle-o' => 'far fa-check-circle',
            'fa-mail-forward' => 'fas fa-share',
            'fa-eye-slash' => 'far fa-eye-slash',
            'fa-warning' => 'fas fa-exclamation-triangle',
            'fa-calendar' => 'fas fa-calendar-alt',
            'fa-arrows-v' => 'fas fa-arrows-alt-v',
            'fa-arrows-h' => 'fas fa-arrows-alt-h',
            'fa-bar-chart' => 'far fa-chart-bar',
            'fa-bar-chart-o' => 'far fa-chart-bar',
            'fa-twitter-square' => 'fab fa-twitter-square',
            'fa-facebook-square' => 'fab fa-facebook-square',
            'fa-gears' => 'fas fa-cogs',
            'fa-thumbs-o-up' => 'far fa-thumbs-up',
            'fa-thumbs-o-down' => 'far fa-thumbs-down',
            'fa-heart-o' => 'far fa-heart',
            'fa-sign-out' => 'fas fa-sign-out-alt',
            'fa-linkedin-square' => 'fab fa-linkedin',
            'fa-thumb-tack' => 'fas fa-thumbtack',
            'fa-external-link' => 'fas fa-external-link-alt',
            'fa-sign-in' => 'fas fa-sign-in-alt',
            'fa-github-square' => 'fab fa-github-square',
            'fa-lemon-o' => 'far fa-lemon',
            'fa-square-o' => 'far fa-square',
            'fa-bookmark-o' => 'far fa-bookmark',
            'fa-twitter' => 'fab fa-twitter',
            'fa-facebook' => 'fab fa-facebook-f',
            'fa-facebook-f' => 'fab fa-facebook-f',
            'fa-github' => 'fab fa-github',
            'fa-credit-card' => 'far fa-credit-card',
            'fa-feed' => 'fas fa-rss',
            'fa-hdd-o' => 'far fa-hdd',
            'fa-hand-o-right' => 'far fa-hand-point-right',
            'fa-hand-o-left' => 'far fa-hand-point-left',
            'fa-hand-o-up' => 'far fa-hand-point-up',
            'fa-hand-o-down' => 'far fa-hand-point-down',
            'fa-arrows-alt' => 'fas fa-expand-arrows-alt',
            'fa-group' => 'fas fa-users',
            'fa-chain' => 'fas fa-link',
            'fa-scissors' => 'fas fa-cut',
            'fa-files-o' => 'far fa-copy',
            'fa-floppy-o' => 'far fa-save',
            'fa-navicon' => 'fas fa-bars',
            'fa-reorder' => 'fas fa-bars',
            'fa-pinterest' => 'fab fa-pinterest',
            'fa-pinterest-square' => 'fab fa-pinterest-square',
            'fa-google-plus-square' => 'fab fa-google-plus-square',
            'fa-google-plus' => 'fab fa-google-plus-g',
            'fa-money' => 'far fa-money-bill-alt',
            'fa-unsorted' => 'fas fa-sort',
            'fa-sort-desc' => 'fas fa-sort-down',
            'fa-sort-asc' => 'fas fa-sort-up',
            'fa-linkedin' => 'fab fa-linkedin-in',
            'fa-rotate-left' => 'fas fa-undo',
            'fa-legal' => 'fas fa-gavel',
            'fa-tachometer' => 'fas fa-tachometer-alt',
            'fa-dashboard' => 'fas fa-tachometer-alt',
            'fa-comment-o' => 'far fa-comment',
            'fa-comments-o' => 'far fa-comments',
            'fa-flash' => 'fas fa-bolt',
            'fa-clipboard' => 'far fa-clipboard',
            'fa-paste' => 'far fa-clipboard',
            'fa-lightbulb-o' => 'far fa-lightbulb',
            'fa-exchange' => 'fas fa-exchange-alt',
            'fa-cloud-download' => 'fas fa-cloud-download-alt',
            'fa-cloud-upload' => 'fas fa-cloud-upload-alt',
            'fa-bell-o' => 'far fa-bell',
            'fa-cutlery' => 'fas fa-utensils',
            'fa-file-text-o' => 'far fa-file-alt',
            'fa-building-o' => 'far fa-building',
            'fa-hospital-o' => 'far fa-hospital',
            'fa-tablet' => 'fas fa-tablet-alt',
            'fa-mobile' => 'fas fa-mobile-alt',
            'fa-mobile-phone' => 'fas fa-mobile-alt',
            'fa-circle-o' => 'far fa-circle',
            'fa-mail-reply' => 'fas fa-reply',
            'fa-github-alt' => 'fab fa-github-alt',
            'fa-folder-o' => 'far fa-folder',
            'fa-folder-open-o' => 'far fa-folder-open',
            'fa-smile-o' => 'far fa-smile',
            'fa-frown-o' => 'far fa-frown',
            'fa-meh-o' => 'far fa-meh',
            'fa-keyboard-o' => 'far fa-keyboard',
            'fa-flag-o' => 'far fa-flag',
            'fa-mail-reply-all' => 'fas fa-reply-all',
            'fa-star-half-o' => 'far fa-star-half',
            'fa-star-half-empty' => 'far fa-star-half',
            'fa-star-half-full' => 'far fa-star-half',
            'fa-code-fork' => 'fas fa-code-branch',
            'fa-chain-broken' => 'fas fa-unlink',
            'fa-shield' => 'fas fa-shield-alt',
            'fa-calendar-o' => 'far fa-calendar',
            'fa-maxcdn' => 'fab fa-maxcdn',
            'fa-html5' => 'fab fa-html5',
            'fa-css3' => 'fab fa-css3',
            'fa-ticket' => 'fas fa-ticket-alt',
            'fa-minus-square-o' => 'far fa-minus-square',
            'fa-level-up' => 'fas fa-level-up-alt',
            'fa-level-down' => 'fas fa-level-down-alt',
            'fa-pencil-square' => 'fas fa-pen-square',
            'fa-external-link-square' => 'fas fa-external-link-square-alt',
            'fa-compass' => 'far fa-compass',
            'fa-caret-square-o-down' => 'far fa-caret-square-down',
            'fa-toggle-down' => 'far fa-caret-square-down',
            'fa-caret-square-o-up' => 'far fa-caret-square-up',
            'fa-toggle-up' => 'far fa-caret-square-up',
            'fa-caret-square-o-right' => 'far fa-caret-square-right',
            'fa-toggle-right' => 'far fa-caret-square-right',
            'fa-eur' => 'fas fa-euro-sign',
            'fa-euro' => 'fas fa-euro-sign',
            'fa-gbp' => 'fas fa-pound-sign',
            'fa-usd' => 'fas fa-dollar-sign',
            'fa-dollar' => 'fas fa-dollar-sign',
            'fa-inr' => 'fas fa-rupee-sign',
            'fa-rupee' => 'fas fa-rupee-sign',
            'fa-jpy' => 'fas fa-yen-sign',
            'fa-cny' => 'fas fa-yen-sign',
            'fa-rmb' => 'fas fa-yen-sign',
            'fa-yen' => 'fas fa-yen-sign',
            'fa-rub' => 'fas fa-ruble-sign',
            'fa-ruble' => 'fas fa-ruble-sign',
            'fa-rouble' => 'fas fa-ruble-sign',
            'fa-krw' => 'fas fa-won-sign',
            'fa-won' => 'fas fa-won-sign',
            'fa-btc' => 'fab fa-btc',
            'fa-bitcoin' => 'fab fa-btc',
            'fa-file-text' => 'fas fa-file-alt',
            'fa-sort-alpha-asc' => 'fas fa-sort-alpha-down',
            'fa-sort-alpha-desc' => 'fas fa-sort-alpha-up',
            'fa-sort-amount-asc' => 'fas fa-sort-amount-down',
            'fa-sort-amount-desc' => 'fas fa-sort-amount-up',
            'fa-sort-numeric-asc' => 'fas fa-sort-numeric-down',
            'fa-sort-numeric-desc' => 'fas fa-sort-numeric-up',
            'fa-youtube-square' => 'fab fa-youtube-square',
            'fa-youtube' => 'fab fa-youtube',
            'fa-xing' => 'fab fa-xing',
            'fa-xing-square' => 'fab fa-xing-square',
            'fa-youtube-play' => 'fab fa-youtube',
            'fa-dropbox' => 'fab fa-dropbox',
            'fa-stack-overflow' => 'fab fa-stack-overflow',
            'fa-instagram' => 'fab fa-instagram',
            'fa-flickr' => 'fab fa-flickr',
            'fa-adn' => 'fab fa-adn',
            'fa-bitbucket' => 'fab fa-bitbucket',
            'fa-bitbucket-square' => 'fab fa-bitbucket',
            'fa-tumblr' => 'fab fa-tumblr',
            'fa-tumblr-square' => 'fab fa-tumblr-square',
            'fa-long-arrow-down' => 'fas fa-long-arrow-alt-down',
            'fa-long-arrow-up' => 'fas fa-long-arrow-alt-up',
            'fa-long-arrow-left' => 'fas fa-long-arrow-alt-left',
            'fa-long-arrow-right' => 'fas fa-long-arrow-alt-right',
            'fa-apple' => 'fab fa-apple',
            'fa-windows' => 'fab fa-windows',
            'fa-android' => 'fab fa-android',
            'fa-linux' => 'fab fa-linux',
            'fa-dribbble' => 'fab fa-dribble',
            'fa-skype' => 'fab fa-skype',
            'fa-foursquare' => 'fab fa-foursquare',
            'fa-trello' => 'fab fa-trello',
            'fa-gratipay' => 'fab fa-gratipay',
            'fa-gittip' => 'fab fa-gratipay',
            'fa-sun-o' => 'far fa-sun',
            'fa-moon-o' => 'far fa-moon',
            'fa-vk' => 'fab fa-vk',
            'fa-weibo' => 'fab fa-weibo',
            'fa-renren' => 'fab fa-renren',
            'fa-pagelines' => 'fab fa-pagelines',
            'fa-stack-exchange' => 'fab fa-stack-exchange',
            'fa-arrow-circle-o-right' => 'far fa-arrow-alt-circle-right',
            'fa-arrow-circle-o-left' => 'far fa-arrow-alt-circle-left',
            'fa-caret-square-o-left' => 'far fa-caret-square-left',
            'fa-toggle-left' => 'far fa-caret-square-left',
            'fa-dot-circle-o' => 'far fa-dot-circle',
            'fa-vimeo-square' => 'fab fa-vimeo-square',
            'fa-try' => 'fas fa-lira-sign',
            'fa-turkish-lira' => 'fas fa-lira-sign',
            'fa-plus-square-o' => 'far fa-plus-square',
            'fa-slack' => 'fab fa-slack',
            'fa-wordpress' => 'fab fa-wordpress',
            'fa-openid' => 'fab fa-openid',
            'fa-institution' => 'fas fa-university',
            'fa-bank' => 'fas fa-university',
            'fa-mortar-board' => 'fas fa-graduation-cap',
            'fa-yahoo' => 'fab fa-yahoo',
            'fa-google' => 'fab fa-google',
            'fa-reddit' => 'fab fa-reddit',
            'fa-reddit-square' => 'fab fa-reddit-square',
            'fa-stumbleupon-circle' => 'fab fa-stumbleupon-circle',
            'fa-stumbleupon' => 'fab fa-stumbleupon',
            'fa-delicious' => 'fab fa-delicious',
            'fa-digg' => 'fab fa-digg',
            'fa-pied-piper-pp' => 'fab fa-pied-piper-pp',
            'fa-pied-piper-alt' => 'fab fa-pied-piper-alt',
            'fa-drupal' => 'fab fa-drupal',
            'fa-joomla' => 'fab fa-joomla',
            'fa-spoon' => 'fas fa-utensil-spoon',
            'fa-behance' => 'fab fa-behance',
            'fa-behance-square' => 'fab fa-behance-square',
            'fa-steam' => 'fab fa-steam',
            'fa-steam-square' => 'fab fa-steam-square',
            'fa-automobile' => 'fas fa-car',
            'fa-cab' => 'fas fa-taxi',
            'fa-spotify' => 'fab fa-spotify',
            'fa-envelope-o' => 'far fa-envelope',
            'fa-soundcloud' => 'fab fa-soundcloud',
            'fa-file-pdf-o' => 'far fa-file-pdf',
            'fa-file-word-o' => 'far fa-file-word',
            'fa-file-excel-o' => 'far fa-file-excel',
            'fa-file-powerpoint-o' => 'far fa-file-powerpoint',
            'fa-file-image-o' => 'far fa-file-image',
            'fa-file-photo-o' => 'far fa-file-image',
            'fa-file-picture-o' => 'far fa-file-image',
            'fa-file-archive-o' => 'far fa-file-archive',
            'fa-file-zip-o' => 'far fa-file-archive',
            'fa-file-audio-o' => 'far fa-file-audio',
            'fa-file-sound-o' => 'far fa-file-audio',
            'fa-file-video-o' => 'far fa-file-video',
            'fa-file-movie-o' => 'far fa-file-video',
            'fa-file-code-o' => 'far fa-file-code',
            'fa-vine' => 'fab fa-vine',
            'fa-codepen' => 'fab fa-codepen',
            'fa-jsfiddle' => 'fab fa-jsfiddle',
            'fa-life-ring' => 'far fa-life-ring',
            'fa-life-bouy' => 'far fa-life-ring',
            'fa-life-buoy' => 'far fa-life-ring',
            'fa-life-saver' => 'far fa-life-ring',
            'fa-support' => 'far fa-life-ring',
            'fa-circle-o-notch' => 'fas fa-circle-notch',
            'fa-rebel' => 'fab fa-rebel',
            'fa-ra' => 'fab fa-rebel',
            'fa-resistance' => 'fab fa-rebel',
            'fa-empire' => 'fab fa-empire',
            'fa-ge' => 'fab fa-empire',
            'fa-git-square' => 'fab fa-git-square',
            'fa-git' => 'fab fa-git',
            'fa-hacker-news' => 'fab fa-hacker-news',
            'fa-y-combinator-square' => 'fab fa-hacker-news',
            'fa-yc-square' => 'fab fa-hacker-news',
            'fa-tencent-weibo' => 'fab fa-tencent-weibo',
            'fa-qq' => 'fab fa-gg',
            'fa-weixin' => 'fab fa-weixin',
            'fa-wechat' => 'fab fa-weixin',
            'fa-send' => 'fas fa-paper-plane',
            'fa-paper-plane-o' => 'far fa-paper-plane',
            'fa-send-o' => 'far fa-paper-plane',
            'fa-circle-thin' => 'far fa-circle',
            'fa-header' => 'fas fa-heading',
            'fa-sliders' => 'fas fa-sliders-h',
            'fa-futbol-o' => 'far fa-futbol',
            'fa-soccer-ball-o' => 'far fa-futbol',
            'fa-slideshare' => 'fab fa-slideshare',
            'fa-twitch' => 'fab fa-twitch',
            'fa-yelp' => 'fab fa-yelp',
            'fa-newspaper-o' => 'far fa-newspaper',
            'fa-paypal' => 'fab fa-paypal',
            'fa-google-wallet' => 'fab fa-google-wallet',
            'fa-cc-visa' => 'fab fa-cc-visa',
            'fa-cc-mastercard' => 'fab fa-cc-mastercard',
            'fa-cc-discover' => 'fab fa-cc-discover',
            'fa-cc-amex' => 'fab fa-cc-amex',
            'fa-cc-paypal' => 'fab fa-cc-paypal',
            'fa-cc-stripe' => 'fab fa-cc-stripe',
            'fa-bell-slash-o' => 'far fa-bell-slash',
            'fa-trash' => 'fas fa-trash-alt',
            'fa-copyright' => 'far fa-copyright',
            'fa-eyedropper' => 'fas fa-eye-dropper',
            'fa-area-chart' => 'fas fa-chart-area',
            'fa-pie-chart' => 'fas fa-chart-pie',
            'fa-line-chart' => 'fas fa-chart-line',
            'fa-lastfm' => 'fab fa-lastfm',
            'fa-lastfm-square' => 'fab fa-lastfm-square',
            'fa-ioxhost' => 'fab fa-ioxhost',
            'fa-angellist' => 'fab fa-angellist',
            'fa-cc' => 'far fa-closed-captioning',
            'fa-ils' => 'fas fa-shekel-sign',
            'fa-shekel' => 'fas fa-shekel-sign',
            'fa-sheqel' => 'fas fa-shekel-sign',
            'fa-meanpath' => 'fab' => 'font-awesome',
            'fa-buysellads' => 'fab fa-buysellads',
            'fa-connectdevelop' => 'fab fa-connectdevelop',
            'fa-dashcube' => 'fab fa-dashcube',
            'fa-forumbee' => 'fab fa-forumbee',
            'fa-leanpub' => 'fab fa-leanpub',
            'fa-sellsy' => 'fab fa-sellsy',
            'fa-shirtsinbulk' => 'fab fa-shirtsinbulk',
            'fa-simplybuilt' => 'fab fa-simplybuilt',
            'fa-skyatlas' => 'fab fa-skyatlas',
            'fa-diamond' => 'far fa-gem',
            'fa-intersex' => 'fas fa-transgender',
            'fa-facebook-official' => 'fab fa-facebook',
            'fa-pinterest-p' => 'fab fa-pinterest-p',
            'fa-whatsapp' => 'fab fa-whatsapp',
            'fa-hotel' => 'fas fa-bed',
            'fa-viacoin' => 'fab fa-viacoin',
            'fa-medium' => 'fab fa-medium',
            'fa-y-combinator' => 'fab fa-y-combinator',
            'fa-yc' => 'fab fa-y-combinator',
            'fa-optin-monster' => 'fab fa-optin-monster',
            'fa-opencart' => 'fab fa-opencart',
            'fa-expeditedssl' => 'fab fa-expeditedssl',
            'fa-battery-4' => 'fas fa-battery-full',
            'fa-battery' => 'fas fa-battery-full',
            'fa-battery-3' => 'fas fa-battery-three-quarters',
            'fa-battery-2' => 'fas fa-battery-half',
            'fa-battery-1' => 'fas fa-battery-quarter',
            'fa-battery-0' => 'fas fa-battery-empty',
            'fa-object-group' => 'far fa-object-group',
            'fa-object-ungroup' => 'far fa-object-ungroup',
            'fa-sticky-note-o' => 'far fa-sticky-note',
            'fa-cc-jcb' => 'fab fa-cc-jcb',
            'fa-cc-diners-club' => 'fab fa-cc-diners-club',
            'fa-clone' => 'far fa-clone',
            'fa-hourglass-o' => 'far fa-hourglass',
            'fa-hourglass-1' => 'fas fa-hourglass-start',
            'fa-hourglass-2' => 'fas fa-hourglass-half',
            'fa-hourglass-3' => 'fas fa-hourglass-end',
            'fa-hand-rock-o' => 'far fa-hand-rock',
            'fa-hand-grab-o' => 'far fa-hand-rock',
            'fa-hand-paper-o' => 'far fa-hand-paper',
            'fa-hand-stop-o' => 'far fa-hand-paper',
            'fa-hand-scissors-o' => 'far fa-hand-scissors',
            'fa-hand-lizard-o' => 'far fa-hand-lizard',
            'fa-hand-spock-o' => 'far fa-hand-spock',
            'fa-hand-pointer-o' => 'far fa-hand-pointer',
            'fa-hand-peace-o' => 'far fa-hand-peace',
            'fa-registered' => 'far fa-registered',
            'fa-creative-commons' => 'fab fa-creative-commons',
            'fa-gg' => 'fab fa-gg',
            'fa-gg-circle' => 'fab fa-gg-circle',
            'fa-tripadvisor' => 'fab fa-tripadvisor',
            'fa-odnoklassniki' => 'fab fa-odnoklassniki',
            'fa-odnoklassniki-square' => 'fab fa-odnoklassniki-square',
            'fa-get-pocket' => 'fab fa-get-pocket',
            'fa-wikipedia-w' => 'fab fa-wikipedia-w',
            'fa-safari' => 'fab fa-safari',
            'fa-chrome' => 'fab fa-chrome',
            'fa-firefox' => 'fab fa-firefox',
            'fa-opera' => 'fab fa-opera',
            'fa-internet-explorer' => 'fab fa-internet-explorer',
            'fa-television' => 'fas fa-tv',
            'fa-contao' => 'fab fa-contao',
            'fa-500px' => 'fab fa-500px',
            'fa-amazon' => 'fab fa-amazon',
            'fa-calendar-plus-o' => 'far fa-calendar-plus',
            'fa-calendar-minus-o' => 'far fa-calendar-minus',
            'fa-calendar-times-o' => 'far fa-calendar-times',
            'fa-calendar-check-o' => 'far fa-calendar-check',
            'fa-map-o' => 'far fa-map',
            'fa-commenting' => 'fas fa-comment-alt',
            'fa-commenting-o' => 'far fa-comment-alt',
            'fa-houzz' => 'fab fa-houzz',
            'fa-vimeo' => 'fab fa-vimeo-v',
            'fa-black-tie' => 'fab fa-black-tie',
            'fa-fonticons' => 'fab fa-fonticons',
            'fa-reddit-alien' => 'fab fa-reddit-alien',
            'fa-edge' => 'fab fa-edge',
            'fa-credit-card-alt' => 'fas fa-credit-card',
            'fa-codiepie' => 'fab fa-codiepie',
            'fa-modx' => 'fab fa-modx',
            'fa-fort-awesome' => 'fab fa-fort-awesome',
            'fa-usb' => 'fab fa-usb',
            'fa-product-hunt' => 'fab fa-product-hunt',
            'fa-mixcloud' => 'fab fa-mixcloud',
            'fa-scribd' => 'fab fa-scribd',
            'fa-pause-circle-o' => 'far fa-pause-circle',
            'fa-stop-circle-o' => 'far fa-stop-circle',
            'fa-bluetooth' => 'fab fa-bluetooth',
            'fa-bluetooth-b' => 'fab fa-bluetooth-b',
            'fa-gitlab' => 'fab fa-gitlab',
            'fa-wpbeginner' => 'fab fa-wpbeginner',
            'fa-wpforms' => 'fab fa-wpforms',
            'fa-envira' => 'fab fa-envira',
            'fa-wheelchair-alt' => 'fab fa-accessible-icon',
            'fa-question-circle-o' => 'far fa-question-circle',
            'fa-volume-control-phone' => 'fas fa-phone-volume',
            'fa-asl-interpreting' => 'fas fa-american-sign-language-interpreting',
            'fa-deafness' => 'fas fa-deaf',
            'fa-hard-of-hearing' => 'fas fa-deaf',
            'fa-glide' => 'fab fa-glide',
            'fa-glide-g' => 'fab fa-glide-g',
            'fa-signing' => 'fas fa-sign-language',
            'fa-viadeo' => 'fab fa-viadeo',
            'fa-viadeo-square' => 'fab fa-viadeo-square',
            'fa-snapchat' => 'fab fa-snapchat',
            'fa-snapchat-ghost' => 'fab fa-snapchat-ghost',
            'fa-snapchat-square' => 'fab fa-snapchat-square',
            'fa-pied-piper' => 'fab fa-pied-piper',
            'fa-first-order' => 'fab fa-first-order',
            'fa-yoast' => 'fab fa-yoast',
            'fa-themeisle' => 'fab fa-themeisle',
            'fa-google-plus-official' => 'fab fa-google-plus',
            'fa-google-plus-circle' => 'fab fa-google-plus',
            'fa-font-awesome' => 'fab fa-font-awesome',
            'fa-fa' => 'fab' => 'font-awesome',
            'fa-handshake-o' => 'far fa-handshake',
            'fa-envelope-open-o' => 'far fa-envelope-open',
            'fa-linode' => 'fab fa-linode',
            'fa-address-book-o' => 'far fa-address-book',
            'fa-vcard' => 'fas fa-address-card',
            'fa-address-card-o' => 'far fa-address-card',
            'fa-vcard-o' => 'far fa-address-card',
            'fa-user-circle-o' => 'far fa-user-circle',
            'fa-user-o' => 'far fa-user',
            'fa-id-badge' => 'far fa-id-badge',
            'fa-drivers-license' => 'fas fa-id-card',
            'fa-id-card-o' => 'far fa-id-card',
            'fa-drivers-license-o' => 'far fa-id-card',
            'fa-quora' => 'fab fa-quora',
            'fa-free-code-camp' => 'fab fa-free-code-camp',
            'fa-telegram' => 'fab fa-telegram',
            'fa-thermometer-4' => 'fas fa-thermometer-full',
            'fa-thermometer' => 'fas fa-thermometer-full',
            'fa-thermometer-3' => 'fas fa-thermometer-three-quarters',
            'fa-thermometer-2' => 'fas fa-thermometer-half',
            'fa-thermometer-1' => 'fas fa-thermometer-quarter',
            'fa-thermometer-0' => 'fas fa-thermometer-empty',
            'fa-bathtub' => 'fas fa-bath',
            'fa-s15' => 'fas fa-bath',
            'fa-window-maximize' => 'far fa-window-maximize',
            'fa-window-restore' => 'far fa-window-restore',
            'fa-times-rectangle' => 'fas fa-window-close',
            'fa-window-close-o' => 'far fa-window-close',
            'fa-times-rectangle-o' => 'far fa-window-close',
            'fa-bandcamp' => 'fab fa-bandcamp',
            'fa-grav' => 'fab fa-gray',
            'fa-etsy' => 'fab fa-etsy',
            'fa-imdb' => 'fab fa-imdb',
            'fa-ravelry' => 'fab fa-ravelry',
            'fa-eercast' => 'fab fa-sellcast',
            'fa-snowflake-o' => 'far fa-snowflake',
            'fa-superpowers' => 'fab fa-superpowers',
            'fa-wpexplorer' => 'fab fa-wpexplorer',
            'fa-deviantart' => 'fab fa-deviantart'
        );

        if(isset($icon[$icontofind])){
            return $icon[$icontofind];
        } else {
            return false;
        }
    }
}
