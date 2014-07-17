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

require_once(dirname(__FILE__).'/pagesettings.php');
 
?>

<header role="banner">
    <div id="page-header" class="clearfix<?php echo ($oldnavbar)? ' oldnavbar': '';?>">
        <div class="container-fluid">
            <div class="row-fluid">
            <!-- HEADER: LOGO AREA -->
                <div class="<?php echo $logoclass;?>">
                    <?php if (!$haslogo) { ?>
                        <i id="headerlogo" class="fa fa-<?php echo $PAGE->theme->settings->siteicon ?>"></i>
                            <h1 id="title"><?php echo $SITE->shortname; ?></h1>
                    <?php } else { ?>
                        <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
                    <?php } ?>
                </div>
                <?php if (isloggedin() && $hasprofilepic) { ?>
                <div class="span1 pull-right" id="profilepic">
                    <p id="socialheading"><?php echo $USER->firstname; ?></p>
                    <ul class="socials unstyled">
                        <li>
                            <?php echo $OUTPUT->user_picture($USER); ?>
                        </li>
                    </ul>            
                </div>
                <?php
                }
                // If true, displays the heading and available social links; displays nothing if false.
                if ($hassocialnetworks) {
                ?>
                <div class="span3 pull-right">
                <p id="socialheading"><?php echo get_string('socialnetworks','theme_essential')?></p>
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
                if ($hasmobileapps) {
                ?>
                <div class="span2 pull-right">
					<p id="socialheading"><?php echo get_string('mobileappsheading','theme_essential')?></p>
                    <ul class="socials unstyled">
                        <?php 
                            echo $OUTPUT->render_social_network('ios');
                            echo $OUTPUT->render_social_network('android');
                        ?>
					</ul>
                </div>
                <?php 
                }
                
                if (!empty($courseheader)) { ?>
                <div id="course-header"><?php echo $courseheader; ?></div>
                <?php } ?>
			</div>
        </div>
    </div>

    <nav role="navigation">
        <div class="navbar<?php echo ($oldnavbar)? ' oldnavbar': '';?> navbar-static-top">
            <div class="container-fluid navbar-inner">
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
                        <li class="navbar-text"><?php echo $OUTPUT->login_info(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>