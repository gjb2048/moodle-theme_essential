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

require_once(\theme_essential\toolbox::get_tile_file('pagesettings'));

echo $OUTPUT->doctype();
?>
<html <?php echo $OUTPUT->htmlattributes(); ?> class="no-js">
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>"/>
    <?php
    echo \theme_essential\toolbox::get_csswww();
    echo $OUTPUT->standard_head_html();
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google web fonts -->
    <?php require_once(\theme_essential\toolbox::get_tile_file('fonts')); ?>
    <!-- iOS Homescreen Icons -->
    <?php require_once(\theme_essential\toolbox::get_tile_file('iosicons')); ?>
    <!-- Start Analytics -->
    <?php require_once(\theme_essential\toolbox::get_tile_file('analytics')); ?>
    <!-- End Analytics -->
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html(); ?>

<header role="banner">
<?php
if (!$oldnavbar) {
    require_once(\theme_essential\toolbox::get_tile_file('navbar'));
}
?>
    <div id="page-header" class="clearfix<?php echo ($oldnavbar) ? ' oldnavbar' : ''; ?>">
        <div class="container-fluid">
            <div class="row-fluid">
                <!-- HEADER: LOGO AREA -->
                <div class="<?php echo $logoclass;
                echo (!$left) ? ' pull-right' : ' pull-left'; ?>">
<?php
if (!$haslogo) {
    echo '<a class="textlogo" href="';
    echo preg_replace("(https?:)", "", $CFG->wwwroot);
    echo '">';
    echo '<span id="headerlogo" aria-hidden="true" class="fa fa-'.\theme_essential\toolbox::get_setting('siteicon').'"></span>';
    echo '<div class="titlearea">'.$OUTPUT->get_title('header').'</div>';
    echo '</a>';
} else {
    echo '<a class="logo" href="'.preg_replace("(https?:)", "", $CFG->wwwroot).'" title="'.get_string('home').'"></a>';
}
?>
                </div>
                <?php if ($hassocialnetworks || $hasmobileapps) { ?>
                <a class="btn btn-icon" data-toggle="collapse" data-target="#essentialicons">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div id='essentialicons' class="collapse pull-<?php echo ($left) ? 'right' : 'left'; ?>">
<?php
}
// If true, displays the heading and available social links; displays nothing if false.
if ($hassocialnetworks) {
?>
                        <div class="pull-<?php echo ($left) ? 'right' : 'left'; ?>" id="socialnetworks">
                            <p id="socialheading"><?php echo get_string('socialnetworks', 'theme_essential') ?></p>
                            <ul class="socials unstyled">
                                <?php
                                echo $OUTPUT->render_social_network('googleplus');
                                echo $OUTPUT->render_social_network('twitter');
                                echo $OUTPUT->render_social_network('facebook');
                                echo $OUTPUT->render_social_network('linkedin');
                                echo $OUTPUT->render_social_network('youtube');
                                echo $OUTPUT->render_social_network('flickr');
                                echo $OUTPUT->render_social_network('pinterest');
                                echo $OUTPUT->render_social_network('instagram');
                                echo $OUTPUT->render_social_network('vk');
                                echo $OUTPUT->render_social_network('skype');
                                echo $OUTPUT->render_social_network('website');
                                ?>
                            </ul>
                        </div>
                    <?php
}
                    // If true, displays the heading and available social links; displays nothing if false.
if ($hasmobileapps) { ?>
                        <div class="pull-<?php echo ($left) ? 'right' : 'left'; ?>" id="mobileapps">
                            <p id="socialheading"><?php echo get_string('mobileappsheading', 'theme_essential') ?></p>
                            <ul class="socials unstyled">
                                <?php
                                echo $OUTPUT->render_social_network('ios');
                                echo $OUTPUT->render_social_network('android');
                                echo $OUTPUT->render_social_network('winphone');
                                echo $OUTPUT->render_social_network('windows');
                                ?>
                            </ul>
                        </div>
                    <?php
}
if ($hassocialnetworks || $hasmobileapps) {
?>
                </div>
<?php
}
?>
            </div>
        </div>
    </div>
<?php
if ($oldnavbar) {
    require_once(\theme_essential\toolbox::get_tile_file('navbar'));
}
?>
</header>
