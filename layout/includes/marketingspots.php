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

<div class="row-fluid" id="marketing-spots">
    <div class="span4">
        <!-- Advert #1 -->
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i class="fa fa-<?php echo $PAGE->theme->settings->marketing1icon ?>"></i> <?php echo $PAGE->theme->settings->marketing1 ?></span></h5>
            <?php if ($hasmarketing1image) { ?>
                <div class="marketing-image1"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing1content ?>
            <p align="right">
                <a href="<?php echo $PAGE->theme->settings->marketing1buttonurl ?>" target="<?php echo $PAGE->theme->settings->marketing1target ?>" id="button">
                    <?php echo $PAGE->theme->settings->marketing1buttontext ?>
                </a>
            </p>
        </div>
    </div>
    
    <div class="span4">
        <!-- Advert #2 -->
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i class="fa fa-<?php echo $PAGE->theme->settings->marketing2icon ?>"></i> <?php echo $PAGE->theme->settings->marketing2 ?></span></h5>
            <?php if ($hasmarketing2image) { ?>
                <div class="marketing-image2"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing2content ?>
            <p align="right">
                <a href="<?php echo $PAGE->theme->settings->marketing2buttonurl ?>" target="<?php echo $PAGE->theme->settings->marketing2target ?>" id="button">
                    <?php echo $PAGE->theme->settings->marketing2buttontext ?>
                </a>
            </p>
        </div>
    </div>
    
    <div class="span4">
        <!-- Advert #3 -->
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i class="fa fa-<?php echo $PAGE->theme->settings->marketing3icon ?>"></i> <?php echo $PAGE->theme->settings->marketing3 ?></span></h5>
            <?php if ($hasmarketing3image) { ?>
                <div class="marketing-image3"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing3content ?>
            <p align="right">
                <a href="<?php echo $PAGE->theme->settings->marketing3buttonurl ?>" target="<?php echo $PAGE->theme->settings->marketing3target ?>" id="button">
                    <?php echo $PAGE->theme->settings->marketing3buttontext ?>
                </a>
            </p>
        </div>
    </div>
</div>