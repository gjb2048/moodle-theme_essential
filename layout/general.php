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

$hasfooterleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-left', $OUTPUT));
$hasfootermiddle = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-middle', $OUTPUT));
$hasfooterright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-right', $OUTPUT));

$showfooterleft = ($hasfooterleft && !$PAGE->blocks->region_completely_docked('footer-left', $OUTPUT));
$showfootermiddle = ($hasfootermiddle && !$PAGE->blocks->region_completely_docked('footer-middle', $OUTPUT));
$showfooterright = ($hasfooterright && !$PAGE->blocks->region_completely_docked('footer-right', $OUTPUT));
$hasboringlayout = (empty($PAGE->theme->settings->layout)) ? false : $PAGE->theme->settings->layout;
$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;

$haslogo = (!empty($PAGE->theme->settings->logo));
$hasboringlayout = (empty($PAGE->theme->settings->layout)) ? false : $PAGE->theme->settings->layout;

$hasfootnote = (!empty($PAGE->theme->settings->footnote));

if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google web fonts -->
    <link href='//fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php require_once(dirname(__FILE__).'/header.php'); ?>

<header role="banner" class="navbar">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><i class="icon-home"></i>&nbsp;<?php print_string('home'); ?></a>
            <a class="btn btn-navbar" data-toggle="workaround-collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
            <?php echo $OUTPUT->custom_menu(); ?>
            <ul class="nav pull-right">
            <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
            <li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
            </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Start Main Regions -->
<div id="page" class="container-fluid">
	<div id="page-content" class="row-fluid">
        <div id="<?php echo $regionbsid ?>" class="span9">
            <div class="row-fluid">
                <?php if ($hasboringlayout) {
	            	echo '<section id="region-main" class="span8 pull-right">';
                } else {
                	echo '<section id="region-main" class="span8">';
                } ?>
                	<div id="page-navbar" class="clearfix">
            			<nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
            			<div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
        			</div>
                    <?php
                    echo $OUTPUT->course_content_header();
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php if ($hasboringlayout) {
	            	echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column');
                } else {
                	echo $OUTPUT->blocks('side-pre', 'span4 pull-right');
                } ?>
            </div>
        </div>
        <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
    </div>
</div>
<!-- End Main Regions -->  

<footer id="page-footer" class="container-fluid">
            <?php require_once(dirname(__FILE__).'/footer.php'); ?>
</footer>

<?php echo $OUTPUT->standard_footer_html(); ?>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

<!-- Start Google Analytics -->
<?php if ($hasanalytics) { ?>
	<?php require_once(dirname(__FILE__).'/analytics.php'); ?>
<?php } ?>
<!-- End Google Analytics -->

</body>
</html>
