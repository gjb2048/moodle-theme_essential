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

$hasfooterleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-left', $OUTPUT));
$hasfootermiddle = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-middle', $OUTPUT));
$hasfooterright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-right', $OUTPUT));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$showfooterleft = ($hasfooterleft && !$PAGE->blocks->region_completely_docked('footer-left', $OUTPUT));
$showfootermiddle = ($hasfootermiddle && !$PAGE->blocks->region_completely_docked('footer-middle', $OUTPUT));
$showfooterright = ($hasfooterright && !$PAGE->blocks->region_completely_docked('footer-right', $OUTPUT));

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
		
	<div id="page-content" class="row-fluid">

		<?php if ($layout === 'pre-and-post') { ?>
    	<section id="region-main" class="span6 desktop-first-column">
	<?php } else if ($layout === 'side-post-only') { ?>
    	<section id="region-main" class="span8 desktop-first-column">
	<?php } else if ($layout === 'side-pre-only') { ?>
    	<section id="region-main" class="span9 desktop-first-column">
	<?php } else if ($layout === 'content-only') { ?>
    	<section id="region-main" class="span12">
	<?php } ?>
			<?php if ($hasnavbar) { ?>
        	<nav class="breadcrumb-button"><?php echo $PAGE->button; ?></nav>
        	<?php echo $OUTPUT->navbar(); ?>
    		<?php } ?>
    		<?php echo $coursecontentheader; ?>   
    		<?php echo $OUTPUT->main_content() ?>
    		<?php echo $coursecontentfooter; ?>
		</section>
		<?php if ($layout === 'pre-and-post') { ?>
		<div class="span6">
		<?php } else if ($layout === 'side-post-only') { ?>
		<div class="span3">
		<?php } else if ($layout === 'side-pre-only') { ?>
		<div class="span3">
		<?php } else if ($layout === 'content-only') { ?>
		<div class="span0">
		<?php } ?>
			<?php if ($layout === 'pre-and-post') { ?>
			<div class="span6">
			<?php } else { ?>
			<div class="span12" id="move">
			<?php } ?>
				<?php if ($layout === 'side-post-only' OR $layout === 'pre-and-post') { ?>
				<div id="region-post" class="block-region">
					<div class="region-content">
					<?php echo $OUTPUT->blocks_for_region('side-post'); ?>
					</div>
				</div>
				<?php } ?>
       		</div>
        	<?php if ($layout === 'pre-and-post') { ?>
			<div class="span6">
			<?php } else { ?>
			<div class="span12">
			<?php } ?>
        		<?php if ($layout === 'side-pre-only' OR $layout === 'pre-and-post') { ?>
        		<div id="region-pre" class="block-region">
        			<div class="region-content">
					<?php echo $OUTPUT->blocks_for_region('side-pre'); ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>		

<footer id="page-footer">
	<div class="container">
		<div class="row-fluid">
			<?php include('footer.php')
			?>
		</div>
	</div>				    
</footer>

<?php echo $OUTPUT->standard_footer_html(); ?>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

</body>
</html>