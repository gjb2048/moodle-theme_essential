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

$hashiddendock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('hidden-dock', $OUTPUT));

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
$alertinfo = '<span class="icon-stack"><i class="icon-sign-blank icon-stack-base"></i><i class="icon-info icon-light"></i></span>';
$alertwarning = '<span class="icon-stack"><i class="icon-sign-blank icon-stack-base"></i><i class="icon-warning-sign icon-light"></i></span>';
$alertsuccess = '<span class="icon-stack"><i class="icon-sign-blank icon-stack-base"></i><i class="icon-bullhorn icon-light"></i></span>';

$hasmarketing1image = (!empty($PAGE->theme->settings->marketing1image));
$hasmarketing2image = (!empty($PAGE->theme->settings->marketing2image));
$hasmarketing3image = (!empty($PAGE->theme->settings->marketing3image));

$haslogo = (!empty($PAGE->theme->settings->logo));


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

$hasfootnote = (!empty($PAGE->theme->settings->footnote));
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

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
    <!-- iOS Homescreen Icons -->
    <?php require_once(dirname(__FILE__).'/iosicons.php'); ?>
    <noscript>
			<link rel="stylesheet" type="text/css" href="<?php echo $CFG->wwwroot;?>/theme/essential/style/nojs.css" />
	</noscript>
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php require_once(dirname(__FILE__).'/header.php'); ?>

<header role="banner" class="navbar">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $SITE->shortname; ?></a>
            <a class="btn btn-navbar" data-toggle="workaround-collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
            <?php if ($hascustommenu) {
                echo $custommenu;
            } ?>
            <ul class="nav pull-right">
            <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
            <li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
            </ul>
            </div>
        </div>
    </nav>
</header>

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
   	echo $alert1icon.'<span class="title">'.$PAGE->theme->settings->alert1title.'</span>'.$PAGE->theme->settings->alert1text; ?> 
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
   	echo $alert2icon.'<span class="title">'.$PAGE->theme->settings->alert2title.'</span>'.$PAGE->theme->settings->alert2text; ?> 
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
   	echo $alert3icon.'<span class="title">'.$PAGE->theme->settings->alert3title.'</span>'.$PAGE->theme->settings->alert3text; ?> 
</div>
<?php } ?>
<!-- End Alerts -->

<!-- Start Slideshow -->
<?php 
    if ($hasslideshow && !strpos($checkuseragent, 'MSIE 7')) { // Hide slideshow for IE7
?>
    <div id="da-slider" class="da-slider <?php echo $hideonphone ?>" style="background-position: 8650% 0%;">

    <?php if ($hasslide1) { ?>
        <div class="da-slide">
            <h2><?php echo $slide1 ?></h2>
            <?php if ($hasslide1caption) { ?>
                <p><?php echo $slide1caption ?></p>
            <?php } ?>
            <?php if ($hasslide1url) { ?>
                <a href="<?php echo $slide1url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide1image) { ?>
            <div class="da-img"><img src="<?php echo $slide1image ?>" alt="<?php echo $slide1 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    

    <?php if ($hasslide2) { ?>
        <div class="da-slide">
            <h2><?php echo $slide2 ?></h2>
            <?php if ($hasslide2caption) { ?>
                <p><?php echo $slide2caption ?></p>
            <?php } ?>
            <?php if ($hasslide2url) { ?>
                <a href="<?php echo $slide2url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide2image) { ?>
            <div class="da-img"><img src="<?php echo $slide2image ?>" alt="<?php echo $slide2 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    

    <?php if ($hasslide3) { ?>
        <div class="da-slide">
            <h2><?php echo $slide3 ?></h2>
            <?php if ($hasslide3caption) { ?>
                <p><?php echo $slide3caption ?></p>
            <?php } ?>
            <?php if ($hasslide3url) { ?>
                <a href="<?php echo $slide3url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide3image) { ?>
            <div class="da-img"><img src="<?php echo $slide3image ?>" alt="<?php echo $slide3 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    

    <?php if ($hasslide4) { ?>
        <div class="da-slide">
            <h2><?php echo $slide4 ?></h2>
            <?php if ($hasslide4caption) { ?>
                <p><?php echo $slide4caption ?></p>
            <?php } ?>
            <?php if ($hasslide4url) { ?>
                <a href="<?php echo $slide4url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide4image) { ?>
            <div class="da-img"><img src="<?php echo $slide4image ?>" alt="<?php echo $slide4 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    
    

        <nav class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>
        </nav>
        
    </div>
<?php } ?>
<!-- End Slideshow -->

<!-- Start Frontpage Content -->
<?php if($PAGE->theme->settings->usefrontcontent ==1) { 
	echo $PAGE->theme->settings->frontcontentarea;
	?>
	<div class="bor" style="margin-top: 10px;"></div>	
<?php }?>
<!-- End Frontpage Content -->


<!-- Start Marketing Spots -->
<?php if($PAGE->theme->settings->togglemarketing==1) { ?>

<div class="row-fluid" id="middle-blocks">
    <div class="span4">
        <!-- Advert #1 -->
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i class="icon-<?php echo $PAGE->theme->settings->marketing1icon ?>"></i> <?php echo $PAGE->theme->settings->marketing1 ?></span></h5>
            <?php if ($hasmarketing1image) { ?>
            	<div class="marketing-image1"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing1content ?>
            <p align="right"><a href="<?php echo $PAGE->theme->settings->marketing1buttonurl ?>" id="button"><?php echo $PAGE->theme->settings->marketing1buttontext ?></a></p>
        </div>
    </div>
    
    <div class="span4">
        <!-- Advert #2 -->
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i class="icon-<?php echo $PAGE->theme->settings->marketing2icon ?>"></i> <?php echo $PAGE->theme->settings->marketing2 ?></span></h5>
            <?php if ($hasmarketing2image) { ?>
            	<div class="marketing-image2"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing2content ?>
            <p align="right"><a href="<?php echo $PAGE->theme->settings->marketing2buttonurl ?>" id="button"><?php echo $PAGE->theme->settings->marketing2buttontext ?></a></p>
        </div>
    </div>
    
    <div class="span4">
        <!-- Advert #3 -->
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i class="icon-<?php echo $PAGE->theme->settings->marketing3icon ?>"></i> <?php echo $PAGE->theme->settings->marketing3 ?></span></h5>
            <?php if ($hasmarketing3image) { ?>
            	<div class="marketing-image3"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing3content ?>
            <p align="right"><a href="<?php echo $PAGE->theme->settings->marketing3buttonurl ?>" id="button"><?php echo $PAGE->theme->settings->marketing3buttontext ?></a></p>
        </div>
    </div>
</div>

<!-- End Marketing Spots -->

<?php } ?>

<div id="page-content" class="row-fluid">
	<div id="<?php echo $regionbsid ?>" class="span12">
		<div class="row-fluid">
			<div id="region-main-essential" class="<?php echo $contentclass; ?>">
				<section id="region-main" class="span8 desktop-first-column">
				<?php
				echo $OUTPUT->course_content_header();
				echo $OUTPUT->main_content();
				echo $OUTPUT->course_content_footer();
				?>
                </section>
            </div>
			<?php echo $OUTPUT->essentialblocks('side-pre', 'span4 pull-right'); ?>
		</div>
	</div>
</div>

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