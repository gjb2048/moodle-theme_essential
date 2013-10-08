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
 * OUC theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage Essential
 * @author     Julian (@moodleman) Ridden
 * @author     Based on code originally written by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$pre = 'side-pre';
$post = 'side-post';
$rtl = right_to_left();

if ($rtl) {
    $regionbsid = 'region-bs-main-and-post';
    // In RTL the sides are reversed, so swap the 'essentialblocks' method parameter....
    $temp = $pre;
    $pre = $post;
    $post = $temp;
} else {
    $regionbsid = 'region-bs-main-and-pre';
}

$haslogo = (!empty($PAGE->theme->settings->logo));
$hasboringlayout = (empty($PAGE->theme->settings->layout)) ? false : $PAGE->theme->settings->layout;
$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$regionclass = 'span9';
$contentclass = 'span8';
$blockclass = 'span4';

if (!($hassidepre AND $hassidepost)) {
    // Two columns.
    $contentclass = 'span9';
    $blockclass = 'span3';
    if (!$PAGE->user_is_editing()) {
        if (((!$hassidepre) && (!$rtl)) ||
            ((!$hassidepost) && ($rtl))) {
            // Fill complete area when editing off and LTR and no side-pre content or RTL and no side-post content.
            $contentclass = 'span12';
        } else if ((!$hassidepre) && ($rtl)) {
            // Fill complete area when editing off, RTL and no side pre.
            $regionclass = 'span12';
        }
    } else {
        if ((!$hassidepre) && ($rtl)) {
            // Fill complete area when editing on, RTL and no side pre.
            $contentclass = 'span8';
            $blockclass = 'span4';
        }
    }
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google web fonts -->
    <?php require_once(dirname(__FILE__).'/includes/fonts.php'); ?>
    <!-- iOS Homescreen Icons -->
    <?php require_once(dirname(__FILE__).'/includes/iosicons.php'); ?>
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php require_once(dirname(__FILE__).'/includes/header.php'); ?>

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
        <div id="<?php echo $regionbsid ?>" class="<?php echo $regionclass; ?>">
            <div class="row-fluid">
                <?php if ($hasboringlayout) { ?>
                	<div id="region-main-essential" class="<?php echo $contentclass; ?> pull-right">
                <?php } else { ?>
                	<div id="region-main-essential" class="<?php echo $contentclass; ?>">
                <?php } ?>
                    <section id="region-main" class="row-fluid">
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
                </div>
                <?php 
                if ($hasboringlayout) {
					echo $OUTPUT->essentialblocks($pre, $blockclass.' desktop-first-column'); 
				} else {
					echo $OUTPUT->essentialblocks($pre, $blockclass.' pull-right');
				}
				?>
            </div>
        </div>
        <?php echo $OUTPUT->essentialblocks($post, 'span3'); ?>
    </div>
</div>
<!-- End Main Regions --> 
 
<a href="#top" class="back-to-top"><i class="icon-chevron-sign-up"></i><p><?php print_string('backtotop', 'theme_essential'); ?></p></a>

<footer id="page-footer" class="container-fluid">
            <?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>
</footer>

<?php echo $OUTPUT->standard_footer_html(); ?>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

<!-- Start Google Analytics -->
<?php if ($hasanalytics) { ?>
	<?php require_once(dirname(__FILE__).'/includes/analytics.php'); ?>
<?php } ?>
<!-- End Google Analytics -->

<script type="text/javascript">
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
</script>
</body>
</html>
