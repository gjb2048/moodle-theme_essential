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

$THEME->name = 'essential';

// The only thing you need to change in this file when copying it to
// create a new theme is the name above. You also need to change the name
// in version.php and lang/en/theme_essential.php as well.

$THEME->doctype = 'html5';
$THEME->yuicssmodules = array();
$THEME->parents = array('bootstrapbase');
$THEME->sheets = array('custom', 'slides', 'lightbox', 'font-awesome');
$THEME->supportscssoptimisation = false;
$THEME->enable_dock = false;
$THEME->yuicssmodules = array();

$THEME->editor_sheets = array();

$THEME->plugins_exclude_sheets = array(
    'block' => array(
        'html',
    ),
    'gradereport' => array(
        'grader',
    ),
);

$THEME->layouts = array(
    // Most backwards compatible layout without the blocks - this is the layout used by default
    'base' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-post',
    ),
    // Front page.
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('side-pre', 'footer-left', 'footer-middle', 'footer-right', 'hidden-dock'),
        'defaultregion' => 'hidden-dock',
        'options' => array('nonavbar'=>true),
    ),
    // Standard layout with blocks, this is recommended for most pages with general information.
    'standard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right', 'hidden-dock'),
        'defaultregion' => 'side-post',
    ),
    // Course page.
    'course' => array(
        'file' => 'course.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-post',
         'options' => array('nonavbar'=>false),
    ),
    // Page content and modules.
    'incourse' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-post',
    ),
    // Category listing page.
    	'coursecategory' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-post',
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu'=>true),
    ),
    // My public page.
    'mypublic' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu'=>true),
    ),
    // Public Login page.
    'login' => array(
        'file' => 'login.php',
        'regions' => array('footer-left', 'footer-middle', 'footer-right', 'hidden-dock'),
        'defaultregion' => 'hidden-dock',
        'options' => array('langmenu'=>true),
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => 'report.php',
        'regions' => array('side-pre', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-pre',
    ),
    // Report Pages.
    'report' => array(
        'file' => 'report.php',
        'regions' => array('side-pre', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-pre',
    ),
    
    // Report Pages.
    'maintenance' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post', 'footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'side-post',
    ),

);

$THEME->javascripts = array(
);

$THEME->javascripts_footer = array(
    'dockmod'
);

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->csspostprocess = 'theme_essential_process_css';

$useragent = '';
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $useragent = $_SERVER['HTTP_USER_AGENT'];
}

if (check_browser_version('MSIE') && !check_browser_version('MSIE', '9.0')) {
    $THEME->javascripts[] = 'html5shiv';
}
