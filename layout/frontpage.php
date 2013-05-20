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
 
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hasheader = (empty($PAGE->layout_options['noheader']));

$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));

$hashiddendock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('hidden-dock', $OUTPUT));
$hasfooterleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-left', $OUTPUT));
$hasfootermiddle = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-middle', $OUTPUT));
$hasfooterright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-right', $OUTPUT));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$showhiddendock = ($hashiddendock && !$PAGE->blocks->region_completely_docked('hidden-dock', $OUTPUT));
$showfooterleft = ($hasfooterleft && !$PAGE->blocks->region_completely_docked('footer-left', $OUTPUT));
$showfootermiddle = ($hasfootermiddle && !$PAGE->blocks->region_completely_docked('footer-middle', $OUTPUT));
$showfooterright = ($hasfooterright && !$PAGE->blocks->region_completely_docked('footer-right', $OUTPUT));

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

// If there can be a sidepost region on this page and we are editing, always
// show it so blocks can be dragged into it.
if ($PAGE->user_is_editing()) {
    if ($PAGE->blocks->is_known_region('side-pre')) {
        $showsidepre = true;
    }
    if ($PAGE->blocks->is_known_region('side-post')) {
        $showsidepost = true;
    }
}

$haslogo = (!empty($PAGE->theme->settings->logo));

/* Social settings */

/*
if ($hasfacebook) {
	$facebook = $PAGE->theme->settings->facebook;
}

if ($hastwitter) {
	$twitter = $PAGE->theme->settings->twitter;
}

if ($haslinkedin) {
	$linkedin = $PAGE->theme->settings->linkedin;
}

if ($hasgoogleplus) {
	$googleplus = $PAGE->theme->settings->googleplus;
}
*/

/* Slide1 settings */
if ($hasslide1) {
	$slide1 = $PAGE->theme->settings->slide1;
}
if ($hasslide1image) {
	$slide1image = $PAGE->theme->settings->slide1image;
}
if ($hasslide1caption){
	$slide1caption = $PAGE->theme->settings->slide1caption;
} 
if ($hasslide1url){
	$slide1url = $PAGE->theme->settings->slide1url;
}
/* slide2 settings */
if ($hasslide2){
	$slide2 = $PAGE->theme->settings->slide2;
}
if ($hasslide2image) {
	$slide2image = $PAGE->theme->settings->slide2image;
}
if ($hasslide2caption){
	$slide2caption = $PAGE->theme->settings->slide2caption;
} 
if ($hasslide2url){
	$slide2url = $PAGE->theme->settings->slide2url;
}
/* slide3 settings */
if ($hasslide3){
	$slide3 = $PAGE->theme->settings->slide3;
}
if ($hasslide3image) {
	$slide3image = $PAGE->theme->settings->slide3image;
}
if ($hasslide3caption){
	$slide3caption = $PAGE->theme->settings->slide3caption;
} 
if ($hasslide3url){
	$slide3url = $PAGE->theme->settings->slide3url;
}
/* slide4 settings */
if ($hasslide4){
	$slide4 = $PAGE->theme->settings->slide4;
}
if ($hasslide4image) {
	$slide4image = $PAGE->theme->settings->slide4image;
}
if ($hasslide4caption){
	$slide4caption = $PAGE->theme->settings->slide4caption;
} 
if ($hasslide4url){
	$slide4url = $PAGE->theme->settings->slide4url;
}

$hasfootnote = (!empty($PAGE->theme->settings->footnote));
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$courseheader = $coursecontentheader = $coursecontentfooter = $coursefooter = '';

if (empty($PAGE->layout_options['nocourseheaderfooter'])) {
    $courseheader = $OUTPUT->course_header();
    $coursecontentheader = $OUTPUT->course_content_header();
    if (empty($PAGE->layout_options['nocoursefooter'])) {
        $coursecontentfooter = $OUTPUT->course_content_footer();
        $coursefooter = $OUTPUT->course_footer();
    }
}

$layout = 'pre-and-post';
if ($showsidepre && !$showsidepost) {
    if (!right_to_left()) {
        $layout = 'side-pre-only';
    } else {
        $layout = 'side-post-only';
    }
} else if ($showsidepost && !$showsidepre) {
    if (!right_to_left()) {
        $layout = 'side-post-only';
    } else {
        $layout = 'side-pre-only';
    }
} else if (!$showsidepost && !$showsidepre) {
    $layout = 'content-only';
}
$bodyclasses[] = $layout;

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <meta name="author" content="Site by Pukunui Australia" /> 
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google web fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
  	<style type="text/css">
        @font-face {
		font-family: 'FontAwesome';
		src: url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/fontawesome-webfont.eot');
		src: url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/fontawesome-webfont.eot?#iefix') format('embedded-opentype'),
			url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/fontawesome-webfont.woff') format('woff'), 
			url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/fontawesome-webfont.ttf') format('truetype'), 
			url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/fontawesome-webfont.svg') format('svg');
		font-weight: normal;
  		font-style: normal;
    </style>
    <style type="text/css">
        @font-face {
		font-family: 'soul_paparegular';
		src: url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/soulpapa-webfont.eot');
		src: url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/soulpapa-webfont.eot?#iefix') format('embedded-opentype'),
			url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/soulpapa-webfont.woff') format('woff'), 
			url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/soulpapa-webfont.ttf') format('truetype'), 
			url('<?php echo $CFG->wwwroot ?>/theme/essential/fonts/soulpapa-webfont.svg') format('svg');
    </style>
</head>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php if ($hasheader) { ?>
<?php include('header.php') ?>
<?php } ?>

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
            <li><?php echo $PAGE->headingmenu ?></li>
            <li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
            </ul>
            </div>
        </div>
    </nav>
</header>

<div id="page" class="container-fluid">

<?php //Start slideshow
	if ($hasslideshow) {   
?>
	<div id="da-slider" class="da-slider" style="background-position: 8650% 0%;">

	<?php if ($hasslide1) { ?>
		<div class="da-slide da-slide-toleft">
			<h2><?php echo $slide1 ?></h2>
			<?php if ($hasslide1caption) { ?>
				<p><?php echo $slide1caption ?></p>
			<?php } ?>
			<?php if ($hasslide1url) { ?>
				<a href="<?php echo $slide1url ?>" class="da-link">Read more</a>
			<?php } ?>
			<?php if ($hasslide1image) { ?>
			<div class="da-img"><img src="<?php echo $slide1image ?>" alt="<?php echo $slide1 ?>"></div>
			<?php } ?>
		</div>
	<?php } ?>
	

	<?php if ($hasslide2) { ?>
		<div class="da-slide da-slide-toleft">
			<h2><?php echo $slide2 ?></h2>
			<?php if ($hasslide2caption) { ?>
				<p><?php echo $slide2caption ?></p>
			<?php } ?>
			<?php if ($hasslide2url) { ?>
				<a href="<?php echo $slide2url ?>" class="da-link">Read more</a>
			<?php } ?>
			<?php if ($hasslide2image) { ?>
			<div class="da-img"><img src="<?php echo $slide2image ?>" alt="<?php echo $slide2 ?>"></div>
			<?php } ?>
		</div>
	<?php } ?>
	

	<?php if ($hasslide3) { ?>
		<div class="da-slide da-slide-toleft">
			<h2><?php echo $slide3 ?></h2>
			<?php if ($hasslide3caption) { ?>
				<p><?php echo $slide3caption ?></p>
			<?php } ?>
			<?php if ($hasslide3url) { ?>
				<a href="<?php echo $slide3url ?>" class="da-link">Read more</a>
			<?php } ?>
			<?php if ($hasslide3image) { ?>
			<div class="da-img"><img src="<?php echo $slide3image ?>" alt="<?php echo $slide3 ?>"></div>
			<?php } ?>
		</div>
	<?php } ?>
	

	<?php if ($hasslide4) { ?>
		<div class="da-slide da-slide-toleft">
			<h2><?php echo $slide4 ?></h2>
			<?php if ($hasslide4caption) { ?>
				<p><?php echo $slide4caption ?></p>
			<?php } ?>
			<?php if ($hasslide4url) { ?>
				<a href="<?php echo $slide4url ?>" class="da-link">Read more</a>
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

 <div class="bor"></div>
		<?php echo $OUTPUT->main_content() ?>
		<div class="bor"></div>
		
		<div id="page-content" class="row-fluid">
	<?php if ($layout === 'content-only') { ?>
	<section id="region-main" class="span12">
	<?php } else { ?>
	<section id="region-main" class="span9">
	<?php } ?>
		<?php echo $coursecontentheader; ?>
		
<div class="row-fluid" id="middle-blocks">
	<div class="span4">
		<!-- Service #1 -->
		<div class="service">
			<!-- Icon & title. Font Awesome icon used. -->
			<h5><span><i class="icon-magic"></i> Our Keynote Speakers</span></h5>
			<p>Each year we search the globe to source recognised passionate experts in the fields of both Moodle and online education to present at the essential. This year we have six fantastic keynotes that are sure to engage all our attendees.</p><p align="right"><a href="http://2013.essential.org/mod/book/view.php?id=1853" id="button">Meet our Keynotes</a></p>
		</div>
	</div>
	
	<div class="span4">
		<!-- Service #2 -->
		<div class="service">
			<!-- Icon & title. Font Awesome icon used. -->
			<h5><span><i class="icon-calendar"></i> The essential Program</span></h5>
			<p>essential provides a 4 day program with 2 simultaneous that runs 24 hours a day. This means that whenever you are here, there is guarranteed to be something that should interest you. All sessions are recorded and available for immediate viewing.</p><p align="right"><a href="http://2013.essential.org/local/schedule/schedulehtml.php" id="button">View The Program</a></p>
		</div>
	</div>
	
	<div class="span4">
		<!-- Service #3 -->
		<div class="service">
			<!-- Icon & title. Font Awesome icon used. -->
			<h5><span><i class="icon-bullhorn"></i> Presenting at essential</span></h5>
			<p>Presenting at essential provides educators the opportunity to share their knowledge with a gobal audience. Many presenters have delivered at local Moots, others are brand new. All are passionate experts in their field.</p><p align="right"><a href="http://2013.essential.org/mod/data/view.php?id=10" id="button">Present at essential</a></p>
		</div>
	</div>
</div>
		<?php echo $coursecontentfooter; ?>
	</section>
    
    <aside class="span3">
		<div id="region-pre" class="block-region">
			<div class="region-content">
				<?php
					echo $OUTPUT->blocks_for_region('side-pre');
					echo $OUTPUT->blocks_for_region('side-post');
				?>
         	</div>
		</div>
	</aside>
</div>




<div class="sponsors">
		<h4>Our Sponsors</h4>
		<img src="<?php echo $OUTPUT->pix_url('sponsors/pukunui', 'theme'); ?>" alt="Pukunui" a href="">
		<img src="<?php echo $OUTPUT->pix_url('sponsors/blindside', 'theme'); ?>" alt="Blindside Networks" a href="">
		<img src="<?php echo $OUTPUT->pix_url('sponsors/packt', 'theme'); ?>" alt="Packt Publishing" a href="">
		<img src="<?php echo $OUTPUT->pix_url('sponsors/freemoodle', 'theme'); ?>" alt="Free Moodle" a href="">
</div>

<?php if(is_siteadmin()){ ?>
<div class="hidden-blocks">
	<div class="row-fluid">
		<h4>Blocks moved into the area below will only be seen by admins</h4>
		<div id="hidden-dock" class="block-region">
			<div class="region-content">
			<?php
				echo $OUTPUT->blocks_for_region('hidden-dock');
			?>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<footer id="page-footer">
	<div class="container-fluid">
		<div class="row-fluid">
			<?php include('footer.php')
			?>
		</div>
	</div>				    
</footer>

<?php echo $OUTPUT->standard_footer_html(); ?>



<?php echo $OUTPUT->standard_end_of_body_html() ?>

<script type="text/javascript">
			$(function() {
			
				$('#da-slider').cslider({
					autoplay	: true,
					interval : 6000
				});
			
			});
</script>

</body>
</html>
