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
 * @param stdClass $course.
 * @param stdClass $cm.
 * @param context $context.
 * @param string $filearea.
 * @param array $args.
 * @param bool $forcedownload.
 * @param array $options.
 * @return bool.
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

    if (file_exists("{$CFG->dirroot}/theme/essential/style/")) {
        $thestylepath = $CFG->dirroot . '/theme/essential/style/';
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/essential/style/")) {
        $thestylepath = $CFG->themedir . '/essential/style/';
     } else {
        header('HTTP/1.0 404 Not Found');
        die('Essential style folder not found, check $CFG->themedir is correct.');
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
 * Set the width on the container-fluid div.
 *
 * @param string $css.
 * @param mixed $pagewidth.
 * @return string.
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

/**
 * Convert a colour hex string to an opacity supporting rgba one.
 *
 * @param string $hex Hex RGB string.
 * @param float $opacity between 0.0 and 1.0.
 * @return string.
 */
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
    $customcss = str_replace('themecredit', 'themepagefooter', $customcss);
    $replacement = $customcss;
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_essential_process_css($css, $theme) {
    // Set the theme width.
    $pagewidth = \theme_essential\toolbox::get_setting('pagewidth');
    $css = theme_essential_set_pagewidth($css, $pagewidth);

    // Set the theme font.
    $css = theme_essential_set_font($css, 'heading', \theme_essential\toolbox::get_setting('fontnameheading'));
    $css = theme_essential_set_font($css, 'body', \theme_essential\toolbox::get_setting('fontnamebody'));

    // Set the theme colour.
    $themecolor = \theme_essential\toolbox::get_setting('themecolor');
    $css = theme_essential_set_color($css, $themecolor, '[[setting:themecolor]]', '#30ADD1');

    // Set the theme text colour.
    $themetextcolor = \theme_essential\toolbox::get_setting('themetextcolor');
    $css = theme_essential_set_color($css, $themetextcolor, '[[setting:themetextcolor]]', '#047797');

    // Set the theme url colour.
    $themeurlcolor = \theme_essential\toolbox::get_setting('themeurlcolor');
    $css = theme_essential_set_color($css, $themeurlcolor, '[[setting:themeurlcolor]]', '#FF5034');

    // Set the theme hover colour.
    $themehovercolor = \theme_essential\toolbox::get_setting('themehovercolor');
    $css = theme_essential_set_color($css, $themehovercolor, '[[setting:themehovercolor]]', '#F32100');

    // Set the theme header text colour.
    $themetextcolor = \theme_essential\toolbox::get_setting('headertextcolor');
    $css = theme_essential_set_color($css, $themetextcolor, '[[setting:headertextcolor]]', '#217a94');

    // Set the theme icon colour.
    $themeiconcolor = \theme_essential\toolbox::get_setting('themeiconcolor');
    $css = theme_essential_set_color($css, $themeiconcolor, '[[setting:themeiconcolor]]', '#30ADD1');

    // Set the theme navigation colour.
    $themenavcolor = \theme_essential\toolbox::get_setting('themenavcolor');
    $css = theme_essential_set_color($css, $themenavcolor, '[[setting:themenavcolor]]', '#ffffff');

    // Set the footer colour.
    $footercolor = theme_essential_hex2rgba(\theme_essential\toolbox::get_setting('footercolor'), '0.95');
    $css = theme_essential_set_color($css, $footercolor, '[[setting:footercolor]]', '#555555');

    // Set the footer text colour.
    $footertextcolor = \theme_essential\toolbox::get_setting('footertextcolor');
    $css = theme_essential_set_color($css, $footertextcolor, '[[setting:footertextcolor]]', '#bbbbbb');

    // Set the footer heading colour.
    $footerheadingcolor = \theme_essential\toolbox::get_setting('footerheadingcolor');
    $css = theme_essential_set_color($css, $footerheadingcolor, '[[setting:footerheadingcolor]]', '#cccccc');

    // Set the footer separator colour.
    $footersepcolor = \theme_essential\toolbox::get_setting('footersepcolor');
    $css = theme_essential_set_color($css, $footersepcolor, '[[setting:footersepcolor]]', '#313131');

    // Set the footer URL colour.
    $footerurlcolor = \theme_essential\toolbox::get_setting('footerurlcolor');
    $css = theme_essential_set_color($css, $footerurlcolor, '[[setting:footerurlcolor]]', '#217a94');

    // Set the footer hover colour.
    $footerhovercolor = \theme_essential\toolbox::get_setting('footerhovercolor');
    $css = theme_essential_set_color($css, $footerhovercolor, '[[setting:footerhovercolor]]', '#30add1');

    // Set the slide background colour.
    $slidebgcolor = theme_essential_hex2rgba(\theme_essential\toolbox::get_setting('themecolor'), '.75');
    $css = theme_essential_set_color($css, $slidebgcolor, '[[setting:carouselcolor]]', '#30add1');

    // Set the slide active pip colour.
    $slidebgcolor = theme_essential_hex2rgba(\theme_essential\toolbox::get_setting('themecolor'), '.25');
    $css = theme_essential_set_color($css, $slidebgcolor, '[[setting:carouselactivecolor]]', '#30add1');

    // Set the slide header colour.
    $slideshowcolor = \theme_essential\toolbox::get_setting('slideshowcolor');
    $css = theme_essential_set_color($css, $slideshowcolor, '[[setting:slideshowcolor]]', '#30add1');

    // Set the slide header colour.
    $slideheadercolor = \theme_essential\toolbox::get_setting('slideheadercolor');
    $css = theme_essential_set_color($css, $slideheadercolor, '[[setting:slideheadercolor]]', '#30add1');

    // Set the slide text colour.
    $slidecolor = \theme_essential\toolbox::get_setting('slidecolor');
    $css = theme_essential_set_color($css, $slidecolor, '[[setting:slidecolor]]', '#ffffff');

    // Set the slide button colour.
    $slidebuttoncolor = \theme_essential\toolbox::get_setting('slidebuttoncolor');
    $css = theme_essential_set_color($css, $slidebuttoncolor, '[[setting:slidebuttoncolor]]', '#30add1');

    // Set the slide button hover colour.
    $slidebuttonhcolor = \theme_essential\toolbox::get_setting('slidebuttonhovercolor');
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
                    \theme_essential\toolbox::get_setting('alternativethemecolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'textcolor' . $alternative,
                    \theme_essential\toolbox::get_setting('alternativethemetextcolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'urlcolor' . $alternative,
                    \theme_essential\toolbox::get_setting('alternativethemeurlcolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'iconcolor' . $alternative,
                    \theme_essential\toolbox::get_setting('alternativethemeiconcolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'navcolor' . $alternative,
                    \theme_essential\toolbox::get_setting('alternativethemenavcolor' . $alternative), $default);
            $css = theme_essential_set_alternativecolor($css, 'hovercolor' . $alternative,
                    \theme_essential\toolbox::get_setting('alternativethemehovercolor' . $alternative), $defaulthover);
        }
    }

    // Set custom CSS.
    $customcss = \theme_essential\toolbox::get_setting('customcss');
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
    $pagebgstyle = \theme_essential\toolbox::get_setting('pagebackgroundstyle');
    $css = theme_essential_set_pagebackgroundstyle($css, $pagebgstyle);

    // Set marketing image height.
    $marketingheight = \theme_essential\toolbox::get_setting('marketingheight');
    $css = theme_essential_set_marketingheight($css, $marketingheight);

    // Set marketing images.
    $setting = 'marketing1image';
    $marketingimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);

    $setting = 'marketing2image';
    $marketingimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);

    $setting = 'marketing3image';
    $marketingimage = $theme->setting_file_url($setting, $setting);
    $css = theme_essential_set_marketingimage($css, $marketingimage, $setting);

    // Finally return processed CSS.
    return $css;
}

function theme_essential_set_font($css, $type, $fontname) {
    $familytag = '[[setting:' . $type .'font]]';
    $facetag = '[[setting:fontfiles' . $type . ']]';
    if (empty($fontname)) {
        $familyreplacement = 'Verdana';
        $facereplacement = '';
    } else if (\theme_essential\toolbox::get_setting('fontselect') === '3') {
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

        if (!empty($fontfiles)) {
            $familyreplacement = '"'.$fontname.'"';
            $facereplacement = '@font-face {' . PHP_EOL . 'font-family: "' . $fontname . '";' . PHP_EOL;
            $facereplacement .= !empty($fontfileeot) ? "src: url('" . $fontfileeot . "');" . PHP_EOL : '';
            $facereplacement .= "src: ";
            $facereplacement .= implode("," . PHP_EOL . " ", $fontfiles);
            $facereplacement .= ";";
            $facereplacement .= '' . PHP_EOL . "}";
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
