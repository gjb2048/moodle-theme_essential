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
 * @copyright   2015 Gareth J Barnard
 * @copyright   2014 Gareth J Barnard, David Bezemer
 * @copyright   2013 Julian Ridden
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
<div class="row-fluid" id="marketing-spots">
    <div class="row-fluid">
        <!-- Advert #1 -->
        <div class="marketing-spot span4">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i
                        class="fa fa-<?php echo \theme_essential\toolbox::get_setting('marketing1icon'); ?>"></i> <?php
                        echo \theme_essential\toolbox::get_setting('marketing1', true);
                        ?></span>
            </h5>
            <?php if (\theme_essential\toolbox::get_setting('marketing1image')) { ?>
                <div class="marketing-image" id="marketing-image1"></div>
                <?php
            }
            echo \theme_essential\toolbox::get_setting('marketing1content', 'format_html');
            ?>
            <?php echo $OUTPUT->essential_marketing_button('1'); ?>
        </div>

        <!-- Advert #2 -->
        <div class="marketing-spot span4">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i
                        class="fa fa-<?php echo \theme_essential\toolbox::get_setting('marketing2icon'); ?>"></i> <?php
                        echo \theme_essential\toolbox::get_setting('marketing2', true);
                        ?></span>
            </h5>
            <?php if (\theme_essential\toolbox::get_setting('marketing2image')) { ?>
                <div class="marketing-image" id="marketing-image2"></div>
                <?php
            }
            echo \theme_essential\toolbox::get_setting('marketing2content', 'format_html');
            ?>
            <?php echo $OUTPUT->essential_marketing_button('2'); ?>
        </div>

        <!-- Advert #3 -->
        <div class="marketing-spot span4">
            <!-- Icon & title. Font Awesome icon used. -->
            <h5><span><i
                        class="fa fa-<?php echo \theme_essential\toolbox::get_setting('marketing3icon'); ?>"></i> <?php
                        echo \theme_essential\toolbox::get_setting('marketing3', true);
                        ?></span>
            </h5>
            <?php if (\theme_essential\toolbox::get_setting('marketing3image')) { ?>
                <div class="marketing-image" id="marketing-image3"></div>
                <?php
            }
            echo \theme_essential\toolbox::get_setting('marketing3content', 'format_html');
            ?>
            <?php echo $OUTPUT->essential_marketing_button('3'); ?>
        </div>
    </div>
</div>
