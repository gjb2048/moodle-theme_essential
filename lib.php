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

function theme_essential_get_setting($setting, $format = false) {
    global $CFG;
    require_once($CFG->dirroot . '/lib/weblib.php');
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('essential');
    }
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

function theme_essential_set_logo($css, $logo) {
    $tag = '[[setting:logo]]';
    if (!($logo)) {
        $replacement = 'none';
    } else {
        $replacement = 'url(\'' . $logo . '\')';
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
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('essential');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'style') {
            theme_essential_serve_css($args[1]);
        } else if ($filearea === 'headerbackground') {
            return $theme->setting_file_serve('headerbackground', $args, $forcedownload, $options);
        } else if ($filearea === 'pagebackground') {
            return $theme->setting_file_serve('pagebackground', $args, $forcedownload, $options);
        } else if (preg_match("/^fontfile(eot|otf|svg|ttf|woff|woff2)(heading|body)$/", $filearea)) { // http://www.regexr.com/.
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/^(marketing|slide)[1-9][0-9]*image$/", $filearea)) {
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

function theme_essential_serve_css($filename) {
    global $CFG;
    if (!empty($CFG->themedir)) {
        $thestylepath = $CFG->themedir . '/essential/style/';
        if (!file_exists($thestylepath)) {
            header('HTTP/1.0 404 Not Found');
            die('Essential style folder not found, check $CFG->themedir is correct.');
        }
    } else {
        $thestylepath = $CFG->dirroot . '/theme/essential/style/';
    }
    $thesheet = $thestylepath . $filename;

    /* http://css-tricks.com/snippets/php/intelligent-php-cache-control/ - rather than /lib/csslib.php as it is a static file who's
      contents should only change if it is rebuilt.  But! There should be no difference with TDM on so will see for the moment if
      that decision is a factor. */

    $etagfile = md5_file($thesheet);
    // File.
    $lastmodified = filemtime($thesheet);
    // Header.
    $ifmodifiedsince = (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
    $etagheader = (isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);

    if ((($ifmodifiedsince) && (strtotime($ifmodifiedsince) == $lastmodified)) || $etagheader == $etagfile) {
        theme_essential_send_unmodified($lastmodified, $etagfile);
    }
    theme_essential_send_cached_css($thestylepath, $filename, $lastmodified, $etagfile);
}

function theme_essential_send_unmodified($lastmodified, $etag) {
    $lifetime = 60 * 60 * 24 * 60;
    header('HTTP/1.1 304 Not Modified');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $lifetime) . ' GMT');
    header('Cache-Control: public, max-age=' . $lifetime);
    header('Content-Type: text/css; charset=utf-8');
    header('Etag: "' . $etag . '"');
    if ($lastmodified) {
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastmodified) . ' GMT');
    }
    die;
}

function theme_essential_send_cached_css($path, $filename, $lastmodified, $etag) {
    global $CFG;
    require_once($CFG->dirroot . '/lib/configonlylib.php'); // For min_enable_zlib_compression().
    // 60 days only - the revision may get incremented quite often.
    $lifetime = 60 * 60 * 24 * 60;

    header('Etag: "' . $etag . '"');
    header('Content-Disposition: inline; filename="'.$filename.'"');
    if ($lastmodified) {
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastmodified) . ' GMT');
    }
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $lifetime) . ' GMT');
    header('Pragma: ');
    header('Cache-Control: public, max-age=' . $lifetime);
    header('Accept-Ranges: none');
    header('Content-Type: text/css; charset=utf-8');
    if (!min_enable_zlib_compression()) {
        header('Content-Length: ' . filesize($path . $filename));
    }

    readfile($path . $filename);
    die;
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
    $imagetag = '[[setting:pagewidthimage]]';
    $replacement = $pagewidth;
    if (!($replacement)) {
        $replacement = '1200';
    }
    if ($replacement == "100") {
        $css = str_replace($tag, $replacement . '%', $css);
        $css = str_replace($imagetag, '90' . '%', $css);
    } else {
        $css = str_replace($tag, $replacement . 'px', $css);
        $css = str_replace($imagetag, $replacement . 'px', $css);
    }
    return $css;
}

function theme_essential_hex2rgba($hex, $opacity) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
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
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_process_css($css, $theme) {
    // Set the theme width
    $pagewidth = theme_essential_get_setting('pagewidth');
    $css = theme_essential_set_pagewidth($css, $pagewidth);

    // Set the theme font
    $headingfont = theme_essential_get_setting('fontnameheading');
    $bodyfont = theme_essential_get_setting('fontnamebody');

    $css = theme_essential_set_headingfont($css, $headingfont);
    $css = theme_essential_set_bodyfont($css, $bodyfont);
    $css = theme_essential_set_fontfiles($css, 'heading', $headingfont);
    $css = theme_essential_set_fontfiles($css, 'body', $bodyfont);

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

    // Set the theme header text colour.
    $themetextcolor = theme_essential_get_setting('headertextcolor');
    $css = theme_essential_set_color($css, $themetextcolor, '[[setting:headertextcolor]]', '#217a94');

    // Set the theme icon colour.
    $themeiconcolor = theme_essential_get_setting('themeiconcolor');
    $css = theme_essential_set_color($css, $themeiconcolor, '[[setting:themeiconcolor]]', '#30ADD1');

    // Set the theme navigation colour.
    $themenavcolor = theme_essential_get_setting('themenavcolor');
    $css = theme_essential_set_color($css, $themenavcolor, '[[setting:themenavcolor]]', '#ffffff');

    // Set the footer colour.
    $footercolor = theme_essential_hex2rgba(theme_essential_get_setting('footercolor'), '0.95');
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
    $slidebgcolor = theme_essential_hex2rgba(theme_essential_get_setting('themecolor'), '.75');
    $css = theme_essential_set_color($css, $slidebgcolor, '[[setting:carouselcolor]]', '#30add1');

    // Set the slide active pip colour.
    $slidebgcolor = theme_essential_hex2rgba(theme_essential_get_setting('themecolor'), '.25');
    $css = theme_essential_set_color($css, $slidebgcolor, '[[setting:carouselactivecolor]]', '#30add1');

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
    $slidebuttonhcolor = theme_essential_get_setting('slidebuttonhovercolor');
    $css = theme_essential_set_color($css, $slidebuttonhcolor, '[[setting:slidebuttonhovercolor]]', '#217a94');

    if ((get_config('theme_essential', 'enablealternativethemecolors1')) ||
            (get_config('theme_essential', 'enablealternativethemecolors2')) ||
            (get_config('theme_essential', 'enablealternativethemecolors3'))
    ) {
        // Set theme alternative colours.
        $defaultcolors = array('#a430d1', '#d15430', '#5dd130');
        $defaulthovercolors = array('#9929c4', '#c44c29', '#53c429');

        foreach (range(1, 3) as $alternative) {
            $default = $defaultcolors[$alternative - 1];
            $defaulthover = $defaulthovercolors[$alternative - 1];
            $css = theme_essential_set_alternativecolor($css, 'color' . $alternative,
                    theme_essential_get_setting('alternativethemehovercolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'textcolor' . $alternative,
                    theme_essential_get_setting('alternativethemetextcolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'urlcolor' . $alternative,
                    theme_essential_get_setting('alternativethemeurlcolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'hovercolor' . $alternative,
                    theme_essential_get_setting('alternativethemehovercolor' . $alternative), $defaulthover);
        }
    }

    // Set custom CSS.
    $customcss = theme_essential_get_setting('customcss');
    $css = theme_essential_set_customcss($css, $customcss);

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_essential_set_logo($css, $logo);

    // Set the background image for the header.
    $headerbackground = $theme->setting_file_url('headerbackground', 'headerbackground');
    $css = theme_essential_set_headerbackground($css, $headerbackground);

    // Set the background image for the page.
    $pagebackground = $theme->setting_file_url('pagebackground', 'pagebackground');
    $css = theme_essential_set_pagebackground($css, $pagebackground);

    // Set the background style for the page.
    $pagebgstyle = theme_essential_get_setting('pagebackgroundstyle');
    $css = theme_essential_set_pagebackgroundstyle($css, $pagebgstyle);

    // Set Marketing Image Height.
    $marketingheight = theme_essential_get_setting('marketingheight');
    $css = theme_essential_set_marketingheight($css, $marketingheight);

    // Set Marketing Images.
    $setting = 'marketing1image';
    $marketingimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);

    $setting = 'marketing2image';
    $marketingimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);

    $setting = 'marketing3image';
    $marketingimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);

    // Finally return processed CSS
    return $css;
}

function theme_essential_set_headingfont($css, $headingfont) {
    $tag = '[[setting:headingfont]]';
    $replacement = $headingfont;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_bodyfont($css, $bodyfont) {
    $tag = '[[setting:bodyfont]]';
    $replacement = $bodyfont;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_fontfiles($css, $type, $fontname) {
    $tag = '[[setting:fontfiles' . $type . ']]';
    $replacement = '';
    if (theme_essential_get_setting('fontselect') === '3') {
        static $theme;
        if (empty($theme)) {
            $theme = theme_config::load('essential');  // $theme needs to be us for child themes.
        }

        $fontfiles = array();
        $fontfileeot = $theme->setting_file_url('fontfileeot' . $type, 'fontfileeot' . $type);
        if (!empty($fontfileeot)) {
            $fontfiles[] = "url('" . $fontfileeot . "?#iefix') format('embedded-opentype')";
        }
        $fontfilewoff = $theme->setting_file_url('fontfilewoff' . $type, 'fontfilewoff' . $type);
        if (!empty($fontfilewoff)) {
            $fontfiles[] = "url('" . $fontfilewoff . "') format('woff')";
        }
        $fontfilewofftwo = $theme->setting_file_url('fontfilewofftwo' . $type, 'fontfilewofftwo' . $type);
        if (!empty($fontfilewofftwo)) {
            $fontfiles[] = "url('" . $fontfilewofftwo . "') format('woff2')";
        }
        $fontfileotf = $theme->setting_file_url('fontfileotf' . $type, 'fontfileotf' . $type);
        if (!empty($fontfileotf)) {
            $fontfiles[] = "url('" . $fontfileotf . "') format('opentype')";
        }
        $fontfilettf = $theme->setting_file_url('fontfilettf' . $type, 'fontfilettf' . $type);
        if (!empty($fontfilettf)) {
            $fontfiles[] = "url('" . $fontfilettf . "') format('truetype')";
        }
        $fontfilesvg = $theme->setting_file_url('fontfilesvg' . $type, 'fontfilesvg' . $type);
        if (!empty($fontfilesvg)) {
            $fontfiles[] = "url('" . $fontfilesvg . "') format('svg')";
        }

        $replacement = '@font-face {' . PHP_EOL . 'font-family: "' . $fontname . '";' . PHP_EOL;
        $replacement .=!empty($fontfileeot) ? "src: url('" . $fontfileeot . "');" . PHP_EOL : '';
        if (!empty($fontfiles)) {
            $replacement .= "src: ";
            $replacement .= implode("," . PHP_EOL . " ", $fontfiles);
            $replacement .= ";";
        }
        $replacement .= '' . PHP_EOL . "}";
    }

    $css = str_replace($tag, $replacement, $css);
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

function theme_essential_set_headerbackground($css, $headerbackground) {
    global $OUTPUT;
    $tag = '[[setting:headerbackground]]';
    if ($headerbackground) {
        $replacement = $headerbackground;
    } else {
        $replacement = $OUTPUT->pix_url('bg/header', 'theme');
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_pagebackground($css, $pagebackground) {
    $tag = '[[setting:pagebackground]]';
    if (!($pagebackground)) {
        $replacement = 'none';
    } else {
        $replacement = 'url(\'' . $pagebackground . '\')';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_set_pagebackgroundstyle($css, $style) {
    $tagattach = '[[setting:backgroundattach]]';
    $tagrepeat = '[[setting:backgroundrepeat]]';
    $tagsize = '[[setting:backgroundsize]]';
    $replacementattach = 'fixed';
    $replacementrepeat = 'no-repeat';
    $replacementsize = 'cover';
    if ($style === 'tiled') {
        $replacementrepeat = 'repeat';
        $replacementsize = 'initial';
    } else if ($style === 'stretch') {
        $replacementattach = 'scroll';
    }

    $css = str_replace($tagattach, $replacementattach, $css);
    $css = str_replace($tagrepeat, $replacementrepeat, $css);
    $css = str_replace($tagsize, $replacementsize, $css);
    return $css;
}

function theme_essential_set_marketingheight($css, $marketingheight) {
    $tag = '[[setting:marketingheight]]';
    $replacement = $marketingheight;
    if (!($replacement)) {
        $replacement = 100;
    }
    $css = str_replace($tag, $replacement . 'px', $css);
    return $css;
}

function theme_essential_set_marketingimage($css, $marketingimage, $setting) {
    $tag = '[[setting:' . $setting . ']]';
    if (!($marketingimage)) {
        $replacement = 'none';
    } else {
        $replacement = 'url(\'' . $marketingimage . '\')';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_showslider() {
    global $CFG;
    $noslides = theme_essential_get_setting('numberofslides');
    if ($noslides && (intval($CFG->version) >= 2013111800)) {
        $devicetype = core_useragent::get_device_type(); // In moodlelib.php.
        if (($devicetype == "mobile") && theme_essential_get_setting('hideonphone')) {
            $noslides = false;
        } else if (($devicetype == "tablet") && theme_essential_get_setting('hideontablet')) {
            $noslides = false;
        }
    }
    return $noslides;
}

function theme_essential_get_nav_links($course, $sections, $sectionno) {
    // FIXME: This is really evil and should by using the navigation API.
    $course = course_get_format($course)->get_course();
    $left = 'left';
    $right = 'right';
    if (right_to_left()) {
        $temp = $left;
        $left = $right;
        $right = $temp;
    }
    $previousarrow = '<i class="fa fa-chevron-circle-' . $left . '"></i>';
    $nextarrow = '<i class="fa fa-chevron-circle-' . $right . '"></i>';
    $canviewhidden = has_capability('moodle/course:viewhiddensections', context_course::instance($course->id))
            or ! $course->hiddensections;

    $links = array('previous' => '', 'next' => '');
    $back = $sectionno - 1;
    while ($back > 0 and empty($links['previous'])) {
        if ($canviewhidden || $sections[$back]->uservisible) {
            $params = array('id' => 'previous_section');
            if (!$sections[$back]->visible) {
                $params['class'] = 'dimmed_text';
            }
            $previouslink = html_writer::start_tag('div', array('class' => 'nav_icon'));
            $previouslink .= $previousarrow;
            $previouslink .= html_writer::end_tag('div');
            $previouslink .= html_writer::start_tag('span', array('class' => 'text'));
            $previouslink .= html_writer::start_tag('span', array('class' => 'nav_guide'));
            $previouslink .= get_string('previoussection', 'theme_essential');
            $previouslink .= html_writer::end_tag('span');
            $previouslink .= html_writer::empty_tag('br');
            $previouslink .= get_section_name($course, $sections[$back]);
            $previouslink .= html_writer::end_tag('span');
            $links['previous'] = html_writer::link(course_get_url($course, $back), $previouslink, $params);
        }
        $back--;
    }

    $forward = $sectionno + 1;
    while ($forward <= $course->numsections and empty($links['next'])) {
        if ($canviewhidden || $sections[$forward]->uservisible) {
            $params = array('id' => 'next_section');
            if (!$sections[$forward]->visible) {
                $params['class'] = 'dimmed_text';
            }
            $nextlink = html_writer::start_tag('div', array('class' => 'nav_icon'));
            $nextlink .= $nextarrow;
            $nextlink .= html_writer::end_tag('div');
            $nextlink .= html_writer::start_tag('span', array('class' => 'text'));
            $nextlink .= html_writer::start_tag('span', array('class' => 'nav_guide'));
            $nextlink .= get_string('nextsection', 'theme_essential');
            $nextlink .= html_writer::end_tag('span');
            $nextlink .= html_writer::empty_tag('br');
            $nextlink .= get_section_name($course, $sections[$forward]);
            $nextlink .= html_writer::end_tag('span');
            $links['next'] = html_writer::link(course_get_url($course, $forward), $nextlink, $params);
        }
        $forward++;
    }

    return $links;
}

function theme_essential_print_single_section_page(&$that, &$courserenderer, $course, $sections, $mods, $modnames, $modnamesused,
        $displaysection) {
    global $PAGE;

    $modinfo = get_fast_modinfo($course);
    $course = course_get_format($course)->get_course();

    // Can we view the section in question?
    if (!($sectioninfo = $modinfo->get_section_info($displaysection))) {
        // This section doesn't exist
        print_error('unknowncoursesection', 'error', null, $course->fullname);
        return false;
    }

    if (!$sectioninfo->uservisible) {
        if (!$course->hiddensections) {
            echo $that->start_section_list();
            echo $that->section_hidden($displaysection);
            echo $that->end_section_list();
        }
        // Can't view this section.
        return false;
    }

    // Copy activity clipboard..
    echo $that->course_activity_clipboard($course, $displaysection);
    $thissection = $modinfo->get_section_info(0);
    if ($thissection->summary or ! empty($modinfo->sections[0]) or $PAGE->user_is_editing()) {
        echo $that->start_section_list();
        echo $that->section_header($thissection, $course, true, $displaysection);
        echo $courserenderer->course_section_cm_list($course, $thissection, $displaysection);
        echo $courserenderer->course_section_add_cm_control($course, 0, $displaysection);
        echo $that->section_footer();
        echo $that->end_section_list();
    }

    // Start single-section div
    echo html_writer::start_tag('div', array('class' => 'single-section'));

    // The requested section page.
    $thissection = $modinfo->get_section_info($displaysection);

    // Title with section navigation links.
    $sectionnavlinks = $that->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);

    // Construct navigation links
    $sectionnav = html_writer::start_tag('nav', array('class' => 'section-navigation'));
    $sectionnav .= $sectionnavlinks['previous'];
    $sectionnav .= $sectionnavlinks['next'];
    $sectionnav .= html_writer::empty_tag('br', array('style' => 'clear:both'));
    $sectionnav .= html_writer::end_tag('nav');
    $sectionnav .= html_writer::tag('div', '', array('class' => 'bor'));

    // Output Section Navigation
    echo $sectionnav;

    // Define the Section Title
    $sectiontitle = '';
    $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-title'));
    // Title attributes
    $titleattr = 'title';
    if (!$thissection->visible) {
        $titleattr .= ' dimmed_text';
    }
    $sectiontitle .= html_writer::start_tag('h3', array('class' => $titleattr));
    $sectiontitle .= get_section_name($course, $displaysection);
    $sectiontitle .= html_writer::end_tag('h3');
    $sectiontitle .= html_writer::end_tag('div');

    // Output the Section Title.
    echo $sectiontitle;

    // Now the list of sections..
    echo $that->start_section_list();

    echo $that->section_header($thissection, $course, true, $displaysection);

    // Show completion help icon.
    $completioninfo = new completion_info($course);
    echo $completioninfo->display_help_icon();

    echo $courserenderer->course_section_cm_list($course, $thissection, $displaysection);
    echo $courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
    echo $that->section_footer();
    echo $that->end_section_list();

    // Close single-section div.
    echo html_writer::end_tag('div');
}

/**
 * Checks if the user is switching colours with a refresh
 *
 * If they are this updates the users preference in the database
 */
function theme_essential_check_colours_switch() {
    $colours = optional_param('essentialcolours', null, PARAM_ALPHANUM);
    if (in_array($colours, array('default', 'alternative1', 'alternative2', 'alternative3'))) {
        set_user_preference('theme_essential_colours', $colours);
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
function theme_essential_initialise_colourswitcher(moodle_page $page) {
    user_preference_allow_ajax_update('theme_essential_colours', PARAM_ALPHANUM);
    $page->requires->yui_module(
            'moodle-theme_essential-coloursswitcher', 'M.theme_essential.initColoursSwitcher',
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

function theme_essential_page_init(moodle_page $page) {
    global $CFG;
    $page->requires->jquery();
    $properties = core_useragent::check_ie_properties(); // In /lib/classes/useragent.php.
    if ((is_array($properties)) && ($properties['version'] <= 8.0)) {
        $page->requires->jquery_plugin('html5shiv', 'theme_essential');
    }
    $page->requires->jquery_plugin('bootstrap', 'theme_essential');
    $page->requires->jquery_plugin('breadcrumb', 'theme_essential');
    $page->requires->jquery_plugin('fitvids', 'theme_essential');
    $page->requires->jquery_plugin('antigravity', 'theme_essential');
}
