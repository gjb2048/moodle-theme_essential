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
 
?>
<!--[if lt IE 9]>
<?php echo get_string('ie8message', 'theme_essential'); ?>
<![endif]-->

<header role="banner">
    <?php
    $nav = html_writer::start_tag('nav', array('role' => 'navigation'));
    $oldnav = ($oldnavbar) ? ' oldnavbar': '';
    $nav .= html_writer::start_tag('div', array('class' => 'navbar'.$oldnav));
    $nav .= html_writer::start_tag('div', array('class' => 'container-fluid navbar-inner'));
    $nav .= html_writer::start_tag('div', array('class' => 'row-fluid'));
    $nav .= html_writer::start_tag('div', array('class' => 'span8'));
    $nav .= html_writer::link(new moodle_url('/'), $SITE->shortname, array('class' => 'brand'));
    $nav .= html_writer::tag('a', html_writer::span('', 'icon-bar').html_writer::span('', 'icon-bar').html_writer::span('', 'icon-bar'), array('class' => 'btn btn-navbar', 'data-toggle' => 'collapse', 'data-target' => '.nav-collapse'));
    $nav .= html_writer::start_tag('div', array('class' => 'nav-collapse collapse'));
    $nav .= $OUTPUT->custom_menu_language();
    $nav .= $OUTPUT->custom_menu_courses();
    $nav .= $OUTPUT->custom_menu_dashboard();
    if ($colourswitcher) {
        $nav .= $OUTPUT->custom_menu_themecolours();
    }
    $nav .= $OUTPUT->custom_menu();
    $nav .= html_writer::end_tag('div');
    $nav .= html_writer::end_tag('div');
    $nav .= html_writer::start_tag('div', array('class' => 'span4 pull-right'));
    $nav .= html_writer::start_tag('ul', array('class' => 'nav pull-right'));
    $nav .= html_writer::tag('li', $OUTPUT->login_info(), array('class' => 'navbar-text'));
    $nav .= html_writer::end_tag('ul');
    $nav .= html_writer::end_tag('div');
    $nav .= html_writer::end_tag('div');
    $nav .= html_writer::end_tag('div');
    $nav .= html_writer::end_tag('div');
    $nav .= html_writer::end_tag('nav');
    
    $pageheader = html_writer::start_tag('div', array('id' => 'page-header', 'class' => 'clearfix '.$oldnav));
    $pageheader .= html_writer::start_tag('div', array('class' => "container-fluid"));
    $notleftclass = (!$left) ? ' pull-right': '';
    $pageheader .= html_writer::start_tag('div', array('class' => $logoclass.$notleftclass));
    if (!$haslogo) {
        $pageheader .= html_writer::start_tag('i', array('id' => 'headerlogo', 'class' => 'fa fa-'.$PAGE->theme->settings->siteicon)).html_writer::end_tag('i');
        $pageheader .= html_writer::tag('h1', $SITE->shortname, array('id' => 'title'));
    } else {
        $pageheader .= html_writer::link(new moodle_url('/'), '', array('class' => 'logo', 'title' => get_string('home')));
    }
    $pageheader .= html_writer::end_tag('div');
    $pageheader .= html_writer::tag('a', html_writer::span('', 'icon-bar').html_writer::span('', 'icon-bar').html_writer::span('', 'icon-bar'), array('class' => 'btn btn-icon', 'data-toggle' => 'collapse', 'data-target' => '.icon-collapse'));
    $pageheader .= html_writer::start_tag('div', array('class' => 'icon-collapse collapse'));
    $leftclass = ($left) ? ' pull-right': '';
    if (isloggedin() && $hasprofilepic) {
        $pageheader .= html_writer::start_tag('div', array('class' => 'span1'.$leftclass, 'id' => 'profilepic'));
        $pageheader .= html_writer::tag('p', $USER->firstname, array('id' => 'profileheading'));
        $pageheader .= html_writer::start_tag('ul', array('class' => 'socials unstyled'));
        $pageheader .= html_writer::tag('li', $OUTPUT->user_picture($USER));
        $pageheader .= html_writer::end_tag('ul');
        $pageheader .= html_writer::end_tag('div');
    }
    // If true, displays the heading and available social links; displays nothing if false.
    if ($hassocialnetworks) {
        $pageheader .= html_writer::start_tag('div', array('class' => 'span4'.$leftclass, 'id' => 'socialnetworks'));
        $pageheader .= html_writer::tag('p', get_string('socialnetworks', 'theme_essential'), array('id' => 'socialheading'));
        $pageheader .= html_writer::start_tag('ul', array('class' => 'socials unstyled'));
        $pageheader .= $OUTPUT->render_social_network('googleplus');
        $pageheader .= $OUTPUT->render_social_network('twitter');
        $pageheader .= $OUTPUT->render_social_network('facebook');
        $pageheader .= $OUTPUT->render_social_network('linkedin');
        $pageheader .= $OUTPUT->render_social_network('youtube');
        $pageheader .= $OUTPUT->render_social_network('flickr');
        $pageheader .= $OUTPUT->render_social_network('pinterest');
        $pageheader .= $OUTPUT->render_social_network('instagram');
        $pageheader .= $OUTPUT->render_social_network('vk');
        $pageheader .= $OUTPUT->render_social_network('skype');
        $pageheader .= $OUTPUT->render_social_network('website');
        $pageheader .= html_writer::end_tag('ul');
        $pageheader .= html_writer::end_tag('div');
    }
    // If true, displays the heading and available social links; displays nothing if false.
    if ($hasmobileapps) {
        $pageheader .= html_writer::start_tag('div', array('class' => 'span2'.$leftclass));
        $pageheader .= html_writer::tag('p', get_string('mobileappsheading', 'theme_essential'), array('id' => 'socialheading'));
        $pageheader .= html_writer::start_tag('ul', array('class' => 'socials unstyled'));
        $pageheader .= $OUTPUT->render_social_network('ios');
        $pageheader .= $OUTPUT->render_social_network('android');
        $pageheader .= html_writer::end_tag('ul');
        $pageheader .= html_writer::end_tag('div');
    }
        $pageheader .= html_writer::end_tag('div');
    if (!empty($courseheader)) {
        $pageheader .= html_writer::tag('div', $courseheader, array('id' => 'course-header'));
    }
    $pageheader .= html_writer::end_tag('div');
    $pageheader .= html_writer::end_tag('div');

    if ($oldnavbar) {
        echo $pageheader.$nav;
    } else {
        echo $nav.$pageheader;
    }
    ?>
</header>