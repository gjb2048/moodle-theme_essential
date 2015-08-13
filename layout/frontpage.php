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

require_once($OUTPUT->get_include_file('header'));

$enable1alert = $OUTPUT->get_setting('enable1alert');
$enable2alert = $OUTPUT->get_setting('enable2alert');
$enable3alert = $OUTPUT->get_setting('enable3alert');

if ($enable1alert || $enable2alert || $enable3alert) {
    $alertinfo = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-info fa-stack-1x fa-inverse"></i></span>';
    $alerterror = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-warning fa-stack-1x fa-inverse"></i></span>';
    $alertsuccess = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></span>';
}
?>

<div id="page" class="container-fluid">
    <section class="slideshow">
        <!-- Start Slideshow -->
        <?php
        $toggleslideshow = $OUTPUT->get_setting('toggleslideshow');
        if ($toggleslideshow == 1) {
            require_once($OUTPUT->get_include_file('slideshow'));
        } else if ($toggleslideshow == 2 && !isloggedin()) {
            require_once($OUTPUT->get_include_file('slideshow'));
        } else if ($toggleslideshow == 3 && isloggedin()) {
            require_once($OUTPUT->get_include_file('slideshow'));
        }
        ?>
        <!-- End Slideshow -->
    </section>

    <section role="main-content">
        <!-- Start Main Regions -->

        <!-- Start Alerts -->

        <!-- Alert #1 -->
        <?php if ($enable1alert) { ?>
            <div class="useralerts alert alert-<?php echo $OUTPUT->get_setting('alert1type'); ?>">
                <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
                <?php
                $alert1icon = 'alert' . $OUTPUT->get_setting('alert1type');
                echo $$alert1icon . '<span class="title">' . $OUTPUT->get_setting('alert1title', true) . '</span>' . $OUTPUT->get_setting('alert1text', true); ?>
            </div>
        <?php } ?>

        <!-- Alert #2 -->
        <?php if ($enable2alert) { ?>
            <div class="useralerts alert alert-<?php echo $OUTPUT->get_setting('alert2type'); ?>">
                <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
                <?php
                $alert2icon = 'alert' . $OUTPUT->get_setting('alert2type');
                echo $$alert2icon . '<span class="title">' . $OUTPUT->get_setting('alert2title', true) . '</span>' . $OUTPUT->get_setting('alert2text', true); ?>
            </div>
        <?php } ?>

        <!-- Alert #3 -->
        <?php if ($enable3alert) { ?>
            <div class="useralerts alert alert-<?php echo $OUTPUT->get_setting('alert3type'); ?>">
                <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
                <?php
                $alert3icon = 'alert' . $OUTPUT->get_setting('alert3type');
                echo $$alert3icon . '<span class="title">' . $OUTPUT->get_setting('alert3title', true) . '</span>' . $OUTPUT->get_setting('alert3text', true); ?>
            </div>
        <?php } ?>
        <!-- End Alerts -->

        <!-- Start Frontpage Content -->
        <?php
        $showfrontcontent = false;
        switch ($OUTPUT->get_setting('togglefrontcontent')) {
            case 1:
                $showfrontcontent = true;
                break;
            case 2:
                if (!isloggedin()) {
                    $showfrontcontent = true;
                }
                break;
            case 3:
                if (isloggedin()) {
                    $showfrontcontent = true;
                }
                break;
        }
        if ($showfrontcontent) { ?>
            <div class="frontpagecontent">
                <div class="bor"></div>
                <?php
                echo $OUTPUT->get_setting('frontcontentarea', 'format_html');
                echo $OUTPUT->essential_edit_button('theme_essential_frontpage');
                ?>
                <div class="bor"></div>
            </div>
        <?php
        }
        ?>
        <!-- End Frontpage Content -->

        <!-- Start Marketing Spots -->
        <?php
        $togglemarketing = $OUTPUT->get_setting('togglemarketing');
        if ($togglemarketing == 1) {
            require_once($OUTPUT->get_include_file('marketingspots'));
        } else if ($togglemarketing == 2 && !isloggedin()) {
            require_once($OUTPUT->get_include_file('marketingspots'));
        } else if ($togglemarketing == 3 && isloggedin()) {
            require_once($OUTPUT->get_include_file('marketingspots'));
        }
        ?>
        <!-- End Marketing Spots -->

        <!-- Start Middle Blocks -->
        <?php
        $frontpagemiddleblocks = $OUTPUT->get_setting('frontpagemiddleblocks');
        if ($frontpagemiddleblocks == 1) {
            require_once($OUTPUT->get_include_file('middleblocks'));
        } else if ($frontpagemiddleblocks == 2 && !isloggedin()) {
            require_once($OUTPUT->get_include_file('middleblocks'));
        } else if ($frontpagemiddleblocks == 3 && isloggedin()) {
            require_once($OUTPUT->get_include_file('middleblocks'));
        }
        ?>
        <!-- End Middle Blocks -->

        <div id="page-content" class="row-fluid">
            <section id="<?php echo $regionbsid; ?>">
                <?php if ($OUTPUT->get_setting('frontpageblocks')) { ?>
                <section id="region-main" class="span9 pull-right">
                    <?php } else { ?>
                    <section id="region-main" class="span9 desktop-first-column">
                        <?php } ?>
                        <?php
                        echo $OUTPUT->course_content_header();
                        echo $OUTPUT->main_content();
                        echo $OUTPUT->course_content_footer();
                        ?>
                    </section>
                    <?php
                    if ($OUTPUT->get_setting('frontpageblocks')) {
                        echo $OUTPUT->blocks('side-pre', 'span3 desktop-first-column');
                    } else {
                        echo $OUTPUT->blocks('side-pre', 'span3 pull-right');
                    }
                    ?>
                </section>
        </div>

        <!-- End Main Regions -->

        <?php if (is_siteadmin()) { ?>
            <div class="hidden-blocks">
                <div class="row-fluid">
                    <h4><?php echo get_string('visibleadminonly', 'theme_essential'); ?></h4>
                    <?php echo $OUTPUT->blocks('hidden-dock'); ?>
                </div>
            </div>
        <?php } ?>

    </section>
</div>

<?php require_once($OUTPUT->get_include_file('footer')); ?>

<!-- Initialize slideshow -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.carousel').carousel();
    });
</script>
</body>
</html>
