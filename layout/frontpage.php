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
 * The Essential theme is built upon the Bootstrapbase theme.
 *
 * @package    theme
 * @subpackage Essential
 * @author     Julian (@moodleman) Ridden
 * @author     Based on code originally written by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$hashiddendock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('hidden-dock', $OUTPUT));
$sideregionsmaxwidth = (!empty($PAGE->theme->settings->sideregionsmaxwidth));

$hasslide1 = (!empty($PAGE->theme->settings->slide1));
$hasslide1image = (!empty($PAGE->theme->settings->slide1image));
$hasslide1caption = (!empty($PAGE->theme->settings->slide1caption));
$hasslide1url = (!empty($PAGE->theme->settings->slide1url));
$hasslide2 = (!empty($PAGE->theme->settings->slide2));
$hasslide2image = (!empty($PAGE->theme->settings->slide2image));
$hasslide2caption = (!empty($PAGE->theme->settings->slide2caption));
$hasslide2url = (!empty($PAGE->theme->settings->slide2url));
$hasslide3 = (!empty($PAGE->theme->settings->slide3));
$hasslide3image = (!empty($PAGE->theme->settings->slide3image));
$hasslide3caption = (!empty($PAGE->theme->settings->slide3caption));
$hasslide3url = (!empty($PAGE->theme->settings->slide3url));
$hasslide4 = (!empty($PAGE->theme->settings->slide4));
$hasslide4image = (!empty($PAGE->theme->settings->slide4image));
$hasslide4caption = (!empty($PAGE->theme->settings->slide4caption));
$hasslide4url = (!empty($PAGE->theme->settings->slide4url));
$hasslideshow = ($hasslide1||$hasslide2||$hasslide3||$hasslide4);
$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;

$hasalert1 = (empty($PAGE->theme->settings->enable1alert)) ? false : $PAGE->theme->settings->enable1alert;
$hasalert2 = (empty($PAGE->theme->settings->enable2alert)) ? false : $PAGE->theme->settings->enable2alert;
$hasalert3 = (empty($PAGE->theme->settings->enable3alert)) ? false : $PAGE->theme->settings->enable3alert;
$alertinfo = '<span class="fa-stack "><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-info fa-stack-1x fa-inverse"></i></span>';
$alertwarning = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-warning fa-stack-1x fa-inverse"></i></span>';
$alertsuccess = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></span>';

$hasmarketing1image = (!empty($PAGE->theme->settings->marketing1image));
$hasmarketing2image = (!empty($PAGE->theme->settings->marketing2image));
$hasmarketing3image = (!empty($PAGE->theme->settings->marketing3image));

$hasfrontpageblocks = (empty($PAGE->theme->settings->frontpageblocks)) ? false : $PAGE->theme->settings->frontpageblocks;

$haslogo = (!empty($PAGE->theme->settings->logo));

$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;

/* Slide1 settings */
$hideonphone = $PAGE->theme->settings->hideonphone;
if ($hasslide1) {
    $slide1 = $PAGE->theme->settings->slide1;
}
if ($hasslide1image) {
    $slide1image = $PAGE->theme->setting_file_url('slide1image', 'slide1image');
}
if ($hasslide1caption) {
    $slide1caption = $PAGE->theme->settings->slide1caption;
}
if ($hasslide1url) {
    $slide1url = $PAGE->theme->settings->slide1url;
}

/* slide2 settings */
if ($hasslide2) {
    $slide2 = $PAGE->theme->settings->slide2;
}
if ($hasslide2image) {
    $slide2image = $PAGE->theme->setting_file_url('slide2image', 'slide2image');
}
if ($hasslide2caption) {
    $slide2caption = $PAGE->theme->settings->slide2caption;
}
if ($hasslide2url) {
    $slide2url = $PAGE->theme->settings->slide2url;
}

/* slide3 settings */
if ($hasslide3) {
    $slide3 = $PAGE->theme->settings->slide3;
}
if ($hasslide3image) {
    $slide3image = $PAGE->theme->setting_file_url('slide3image', 'slide3image');
}
if ($hasslide3caption) {
    $slide3caption = $PAGE->theme->settings->slide3caption;
}
if ($hasslide3url) {
    $slide3url = $PAGE->theme->settings->slide3url;
}

/* slide4 settings */
if ($hasslide4) {
    $slide4 = $PAGE->theme->settings->slide4;
}
if ($hasslide4image) {
    $slide4image = $PAGE->theme->setting_file_url('slide4image', 'slide4image');
}
if ($hasslide4caption) {
    $slide4caption = $PAGE->theme->settings->slide4caption;
}
if ($hasslide4url) {
    $slide4url = $PAGE->theme->settings->slide4url;
}

theme_essential_check_colours_switch();
theme_essential_initialise_colourswitcher($PAGE);

$bodyclasses = array();
$bodyclasses[] = 'two-column';
$bodyclasses[] = 'essential-colours-' . theme_essential_get_colours();
if ($sideregionsmaxwidth) {
    $bodyclasses[] = 'side-regions-with-max-width';
}

$left = (!right_to_left());  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.
echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <noscript>
			<link rel="stylesheet" type="text/css" href="<?php echo $CFG->wwwroot;?>/theme/essential/style/nojs.css" />
	</noscript>
    <!-- Google web fonts -->
    <?php require_once(dirname(__FILE__).'/includes/fonts.php'); ?>
    <!-- iOS Homescreen Icons -->
    <?php require_once(dirname(__FILE__).'/includes/iosicons.php'); ?>
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php require_once(dirname(__FILE__).'/includes/header.php'); ?>

<header role="banner" class="navbar">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $SITE->shortname; ?></a>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
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

<!-- Start Alerts -->

<!-- Alert #1 -->
<?php if ($hasalert1) { ?>  
	<div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert1type ?>">  
	<a class="close" data-dismiss="alert" href="#">×</a>
	<?php 
	if ($PAGE->theme->settings->alert1type == 'info') {
		$alert1icon = $alertinfo;
    } else if ($PAGE->theme->settings->alert1type == 'error') {
    	$alert1icon = $alertwarning;
   	} else {
   		$alert1icon = $alertsuccess;
   	} 
    $alert1title = 'alert1title_'.current_language();
    $alert1text = 'alert1text_'.current_language();
   	echo $alert1icon.'<span class="title">'.$PAGE->theme->settings->$alert1title.'</span>'.$PAGE->theme->settings->$alert1text; ?> 
</div>
<?php } ?>

<!-- Alert #2 -->
<?php if ($hasalert2) { ?>  
	<div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert2type ?>">  
	<a class="close" data-dismiss="alert" href="#">×</a>
	<?php 
	if ($PAGE->theme->settings->alert2type == 'info') {
		$alert2icon = $alertinfo;
    } else if ($PAGE->theme->settings->alert2type == 'error') {
    	$alert2icon = $alertwarning;
   	} else {
   		$alert2icon = $alertsuccess;
   	} 
    $alert2title = 'alert2title_'.current_language();
    $alert2text = 'alert2text_'.current_language();
   	echo $alert2icon.'<span class="title">'.$PAGE->theme->settings->$alert2title.'</span>'.$PAGE->theme->settings->$alert2text; ?> 
</div>
<?php } ?>

<!-- Alert #3 -->
<?php if ($hasalert3) { ?>  
	<div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert3type ?>">  
	<a class="close" data-dismiss="alert" href="#">×</a>
	<?php 
	if ($PAGE->theme->settings->alert3type == 'info') {
		$alert3icon = $alertinfo;
    } else if ($PAGE->theme->settings->alert3type == 'error') {
    	$alert3icon = $alertwarning;
   	} else {
   		$alert3icon = $alertsuccess;
   	} 
    $alert3title = 'alert3title_'.current_language();
    $alert3text = 'alert3text_'.current_language();
   	echo $alert3icon.'<span class="title">'.$PAGE->theme->settings->$alert3title.'</span>'.$PAGE->theme->settings->$alert3text; ?> 
</div>
<?php } ?>
<!-- End Alerts -->

<!-- Start Slideshow -->
<?php 
	if($PAGE->theme->settings->toggleslideshow==1) {
		require_once(dirname(__FILE__).'/includes/slideshow_'. ($PAGE->theme->settings->slideshowvariant) .'.php');
	} else if($PAGE->theme->settings->toggleslideshow==2 && !isloggedin()) {
		require_once(dirname(__FILE__).'/includes/slideshow_'. ($PAGE->theme->settings->slideshowvariant) .'.php');
	} else if($PAGE->theme->settings->toggleslideshow==3 && isloggedin()) {
		require_once(dirname(__FILE__).'/includes/slideshow_'. ($PAGE->theme->settings->slideshowvariant) .'.php');
	} 
?>
<!-- End Slideshow -->

<!-- Start Marketing Spots -->
<?php 
	if($PAGE->theme->settings->togglemarketing==1) {
		require_once(dirname(__FILE__).'/includes/marketingspots.php');
	} else if($PAGE->theme->settings->togglemarketing==2 && !isloggedin()) {
		require_once(dirname(__FILE__).'/includes/marketingspots.php');
	} else if($PAGE->theme->settings->togglemarketing==3 && isloggedin()) {
		require_once(dirname(__FILE__).'/includes/marketingspots.php');
	} 
?>
<!-- End Marketing Spots -->

<!-- Start Middle Blocks -->
<?php 
	if($PAGE->theme->settings->frontpagemiddleblocks==1) {
		require_once(dirname(__FILE__).'/includes/middleblocks.php');
	} else if($PAGE->theme->settings->frontpagemiddleblocks==2 && !isloggedin()) {
		require_once(dirname(__FILE__).'/includes/middleblocks.php');
	} else if($PAGE->theme->settings->frontpagemiddleblocks==3 && isloggedin()) {
		require_once(dirname(__FILE__).'/includes/middleblocks.php');
	} 
?>
<!-- End Middle Blocks -->

<!-- Start Frontpage Content -->
<?php if($PAGE->theme->settings->usefrontcontent ==1) { 
	echo $PAGE->theme->settings->frontcontentarea;
	?>
	<div class="bor" style="margin-top: 10px;"></div>	
<?php }?>
<!-- End Frontpage Content -->


    <div id="page-content" class="row-fluid">
    	<?php if ($hasfrontpageblocks==1) { ?>
        <section id="region-main" class="span8 pull-right">
        <?php } else { ?>
        <section id="region-main" class="span8 desktop-first-column">
        <?php } ?>
        	<div id="page-navbar" class="clearfix">
            	<div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
            	<nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
        	</div>
            <?php
            echo $OUTPUT->course_content_header();
            echo $OUTPUT->main_content();
            echo $OUTPUT->course_content_footer();
            ?>
        </section>
        <?php
        if ($hasfrontpageblocks==1) {
        	echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column');
        } else {
        	echo $OUTPUT->blocks('side-pre', 'span4 pull-right');
        }
        ?>
    </div>
    
    <!-- End Main Regions -->

    <?php if (is_siteadmin()) { ?>
	<div class="hidden-blocks">
    	<div class="row-fluid">
        	<h4><?php echo get_string('visibleadminonly', 'theme_essential') ?></h4>
            <?php
                echo $OUTPUT->essentialblocks('hidden-dock');
            ?>
    	</div>
	</div>
	<?php } ?>

	<footer id="page-footer" class="container-fluid">
		<?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>
	</footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>

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
