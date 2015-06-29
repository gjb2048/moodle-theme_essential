<?php

namespace theme_essential;

class toolbox {

    static protected $theme;

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
            $url = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_essential/style/$itemid/$moodlecss");
            $url = preg_replace('|^https?://|i', '//', $url->out(false));
            return '<link rel="stylesheet" href="'.$url.'">';
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
            $urlone = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_essential/style/$itemid/$moodlecssone");
            $urlone = preg_replace('|^https?://|i', '//', $urlone->out(false));
            $urltwo = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_essential/style/$itemid/$moodlecsstwo");
            $urltwo = preg_replace('|^https?://|i', '//', $urltwo->out(false));
            return '<link rel="stylesheet" href="'.$urlone.'"><link rel="stylesheet" href="'.$urltwo.'">';
        }
    }

    static public function get_setting($setting, $format = false, $theme = null) {

        if (empty($theme)) {
            if (empty(self::$theme)) {
                self::$theme = \theme_config::load('essential');
            }
            $theme = self::$theme;
        }

        global $CFG;
        require_once($CFG->dirroot . '/lib/weblib.php');
        if (empty($theme->settings->$setting)) {
            return false;
        } else if (!$format) {
            return $theme->settings->$setting;
        } else if ($format === 'format_text') {
            return format_text($theme->settings->$setting, FORMAT_PLAIN);
        } else if ($format === 'format_html') {
            return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
        } else {
            return format_string($theme->settings->$setting);
        }
    }

    /**
     * Finds the given include file in the theme.  If it does not exist for the Essential child theme then the parent is checked.
     * @param string $filename Filename without extension to get.
     * @return string Complete path of the file.
     */
    static public function get_include_file($filename) {
        global $CFG, $PAGE;
        $themedir = $PAGE->theme->dir;
        $themename = $PAGE->theme->name;
        //error_log('filename: '.$filename.', dir: '.$themedir.', name: '.$themename);
        $filename .= '.php';
        if (file_exists("$themedir/layout/includes/$filename")) {
            return "$themedir/layout/includes/$filename";
        } else if (file_exists("$CFG->dirroot/theme/$themename/layout/includes/$filename")) {
            return "$CFG->dirroot/theme/$themename/layout/includes/$filename";
        } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/$themename/layout/includes/$filename")) {
            return "$CFG->themedir/$themename/includes/$filename";
        }
        // Not here so check parent Essential.
        if (file_exists("$CFG->dirroot/theme/essential/layout/includes/$filename")) {
            return "$CFG->dirroot/theme/essential/layout/includes/$filename";
        } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/essential/layout/includes/$filename")) {
            return "$CFG->themedir/essential/includes/$filename";
        } else {
            return dirname(__FILE__)."$filename";
        }
    }

    static public function render_slide($i, $captionoptions, $theme = null) {

        if (empty($theme)) {
            if (empty(self::$theme)) {
                self::$theme = \theme_config::load('essential');
            }
            $theme = self::$theme;
        }

        $slideurl = self::get_setting('slide' . $i . 'url', false, $theme);
        $slideurltarget = self::get_setting('slide' . $i . 'target', false, $theme);
        $slidetitle = self::get_setting('slide' . $i, true, $theme);
        $slidecaption = self::get_setting('slide' . $i . 'caption', true, $theme);
        if ($captionoptions == 0) {
            $slideextraclass = ' side-caption';
        } else {
            $slideextraclass = '';
        }
        $slideextraclass .= ($i === 1) ? ' active' : '';
        $slideimagealt = strip_tags($slidetitle);

        // Get slide image or fallback to default.
        $slideimage = self::get_setting('slide' . $i . 'image', false, $theme);
        if ($slideimage) {
            $slideimage = $theme->setting_file_url('slide' . $i . 'image', 'slide' . $i . 'image');
        } else {
            global $OUTPUT;
            $slideimage = $OUTPUT->pix_url('default_slide', 'theme');
        }

        if ($slideurl) {
            $slide = '<a href="' . $slideurl . '" target="' . $slideurltarget . '" class="item' . $slideextraclass . '">';
        } else {
            $slide = '<div class="item' . $slideextraclass . '">';
        }

        if ($captionoptions == 0) {
            $slide .= '<div class="container-fluid">';
            $slide .= '<div class="row-fluid">';
        
            if ($slidetitle || $slidecaption) {
                $slide .= '<div class="span5 the-side-caption">';
                $slide .= '<div class="the-side-caption-content">';
                $slide .= '<h4>' . $slidetitle . '</h4>';
                $slide .= '<p>' . $slidecaption . '</p>';
                $slide .= '</div>';
                $slide .= '</div>';
                $slide .= '<div class="span7">';
            } else {
                $slide .= '<div class="span10 offset1 nocaption">';
            }
            $slide .= '<div class="carousel-image-container">';
            $slide .= '<img src="' . $slideimage . '" alt="' . $slideimagealt . '" class="carousel-image"/>';
            $slide .= '</div>';
            $slide .= '</div>';

            $slide .= '</div>';
            $slide .= '</div>';
        } else {
            $nocaption = (!($slidetitle || $slidecaption)) ? ' nocaption' : '';
            $slide .= '<div class="carousel-image-container'.$nocaption.'">';
            $slide .= '<img src="' . $slideimage . '" alt="' . $slideimagealt . '" class="carousel-image"/>';
            $slide .= '</div>';

            // Output title and caption if either is present
            if ($slidetitle || $slidecaption) {
                $slide .= '<div class="carousel-caption">';
                $slide .= '<div class="carousel-caption-inner">';
                $slide .= '<h4>' . $slidetitle . '</h4>';
                $slide .= '<p>' . $slidecaption . '</p>';
                $slide .= '</div>';
                $slide .= '</div>';
            }
        }
        $slide .= ($slideurl) ? '</a>' : '</div>';

        return $slide;
    }

    static public function render_slide_controls($left) {
        $faleft = 'left';
        $faright = 'right';
        if (!$left) {
            $temp = $faleft;
            $faleft = $faright;
            $faright = $temp;
        }
        $prev = '<a class="left carousel-control" href="#essentialCarousel" data-slide="prev"><i class="fa fa-chevron-circle-' . $faleft . '"></i></a>';
        $next = '<a class="right carousel-control" href="#essentialCarousel" data-slide="next"><i class="fa fa-chevron-circle-' . $faright . '"></i></a>';

        return $prev . $next;
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
    static public function ie_properties() {
        $properties = \core_useragent::check_ie_properties(); // In /lib/classes/useragent.php.
        if (!is_array($properties)) {
            return false;
        } else {
            return $properties;
        }
    }
}
