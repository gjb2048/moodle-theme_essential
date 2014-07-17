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
    <?php if (!empty($fontselect) && ($fontselect < 7)) {
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
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php require_once(dirname(__FILE__).'/includes/header.php'); ?>

<section role="main-content">
    <!-- Start Main Regions -->
    <div id="page" class="container-fluid">
        <div id="page-content" class="row-fluid">
            <div id="<?php echo $regionbsid ?>" class="span9">
                <div class="row-fluid">
                    <?php if ($hasboringlayout) { ?>
                    <section id="region-main" class="span8 pull-right">
                    <?php } else { ?>
                    <section id="region-main" class="span8 desktop-first-column">
                    <?php } ?>
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
                    <?php if ($hasboringlayout) { ?>
                    <?php echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column'); ?>
                    <?php } else { ?>
                    <?php echo $OUTPUT->blocks('side-pre', 'span4 pull-right'); ?>
                    <?php } ?>
                </div>
            </div>
            <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
        </div>
        <!-- End Main Regions -->
    </div>
</section>

<?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>

</body>
</html>
