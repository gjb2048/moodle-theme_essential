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

require_once(dirname(__FILE__).'/includes/pagesettings.php');

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (!empty($fontselect)) {
        // Google web fonts -->
        require_once(dirname(__FILE__).'/includes/fonts.php');
    }?>
    <!-- iOS Homescreen Icons -->
    <?php require_once(dirname(__FILE__).'/includes/iosicons.php'); ?>
    <!-- Start Google Analytics -->
    <?php if ($hasanalytics) { ?>
        <?php require_once(dirname(__FILE__).'/includes/analytics.php'); ?>
    <?php } ?>
    <!-- End Google Analytics -->
    <script type="text/javascript">
    jQuery(document).ready(function() {
        $('.carousel').carousel();
    });
    </script>
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php require_once(dirname(__FILE__).'/includes/header.php');?>
<section class="slideshow">
    <!-- Start Slideshow -->
    <?php 
        if($PAGE->theme->settings->toggleslideshow==1) {
            require_once(dirname(__FILE__).'/includes/slideshow.php');
        } else if($PAGE->theme->settings->toggleslideshow==2 && !isloggedin()) {
            require_once(dirname(__FILE__).'/includes/slideshow.php');
        } else if($PAGE->theme->settings->toggleslideshow==3 && isloggedin()) {
            require_once(dirname(__FILE__).'/includes/slideshow.php');
        } 
    ?>
    <!-- End Slideshow -->
</section>

<section role="main-content">
    <!-- Start Main Regions -->
    <div id="page" class="container-fluid">

    <!-- Start Alerts -->

    <!-- Alert #1 -->
    <?php if ($PAGE->theme->settings->enable1alert) { ?>  
        <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert1type ?>">  
        <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
        <?php 
        if ($PAGE->theme->settings->alert1type == 'info') {
            $alert1icon = $alertinfo;
        } else if ($PAGE->theme->settings->alert1type == 'error') {
            $alert1icon = $alertwarning;
        } else {
            $alert1icon = $alertsuccess;
        } 
        $alert1title = 'alert1title';
        $alert1text = 'alert1text';
        echo $alert1icon.'<span class="title">'.$PAGE->theme->settings->$alert1title.'</span>'.$PAGE->theme->settings->$alert1text; ?> 
    </div>
    <?php } ?>

    <!-- Alert #2 -->
    <?php if ($PAGE->theme->settings->enable2alert) { ?>  
        <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert2type ?>">  
        <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
        <?php 
        if ($PAGE->theme->settings->alert2type == 'info') {
            $alert2icon = $alertinfo;
        } else if ($PAGE->theme->settings->alert2type == 'error') {
            $alert2icon = $alertwarning;
        } else {
            $alert2icon = $alertsuccess;
        } 
        $alert2title = 'alert2title';
        $alert2text = 'alert2text';
        echo $alert2icon.'<span class="title">'.$PAGE->theme->settings->$alert2title.'</span>'.$PAGE->theme->settings->$alert2text; ?> 
    </div>
    <?php } ?>

    <!-- Alert #3 -->
    <?php if ($PAGE->theme->settings->enable3alert) { ?>  
        <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert3type ?>">  
        <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
        <?php 
        if ($PAGE->theme->settings->alert3type == 'info') {
            $alert3icon = $alertinfo;
        } else if ($PAGE->theme->settings->alert3type == 'error') {
            $alert3icon = $alertwarning;
        } else {
            $alert3icon = $alertsuccess;
        } 
        $alert3title = 'alert3title';
        $alert3text = 'alert3text';
        echo $alert3icon.'<span class="title">'.$PAGE->theme->settings->$alert3title.'</span>'.$PAGE->theme->settings->$alert3text; ?> 
    </div>
    <?php } ?>
    <!-- End Alerts -->
    
    <!-- Start Frontpage Content -->
    <?php if($PAGE->theme->settings->usefrontcontent ==1) { 
        echo $PAGE->theme->settings->frontcontentarea;
        ?>
        <div class="bor" style="margin-top: 10px;"></div>   
    <?php }?>
    <!-- End Frontpage Content -->

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

        <div id="page-content" class="row-fluid">
            <?php if ($PAGE->theme->settings->frontpageblocks) { ?>
            <section id="<?php echo $regionbsid;?>" class="span8 pull-right">
            <?php } else { ?>
            <section id="<?php echo $regionbsid;?>" class="span8 desktop-first-column">
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
            if ($PAGE->theme->settings->frontpageblocks) {
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
                    echo $OUTPUT->blocks('hidden-dock');
                ?>
            </div>
        </div>
        <?php } ?>

    </div>
</section>

<?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>
</body>
</html>
