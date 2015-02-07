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
<div class="row-fluid" id="marketing-spots">
    <!-- Advert #1 -->
    <div class="marketing-spot span4">
        <!-- Icon & title. Font Awesome icon used. -->
        <h5><span><i
                    class="fa fa-<?php echo $OUTPUT->get_setting('marketing1icon'); ?>"></i> <?php echo $OUTPUT->get_setting('marketing1', true); ?></span>
        </h5>
        <?php if ($OUTPUT->get_setting('marketing1image')) { ?>
            <div class="marketing-image" id="marketing-image1"></div>
        <?php } ?>
        <?php echo $OUTPUT->get_setting('marketing1content', 'format_html'); ?>
        <div class="button">
            <a href="<?php echo $OUTPUT->get_setting('marketing1buttonurl'); ?>"
               target="<?php echo $OUTPUT->get_setting('marketing1target'); ?>"
               class="marketing-button responsive">
                <?php echo $OUTPUT->get_setting('marketing1buttontext', true); ?>
            </a>
        </div>
    </div>

    <!-- Advert #2 -->
    <div class="marketing-spot span4">
        <!-- Icon & title. Font Awesome icon used. -->
        <h5><span><i
                    class="fa fa-<?php echo $OUTPUT->get_setting('marketing2icon'); ?>"></i> <?php echo $OUTPUT->get_setting('marketing2', true); ?></span>
        </h5>
        <?php if ($OUTPUT->get_setting('marketing2image')) { ?>
            <div class="marketing-image" id="marketing-image2"></div>
        <?php } ?>
        <?php echo $OUTPUT->get_setting('marketing2content', 'format_html'); ?>
        <div class="button">
            <a href="<?php echo $OUTPUT->get_setting('marketing2buttonurl'); ?>"
               target="<?php echo $OUTPUT->get_setting('marketing2target'); ?>"
               class="marketing-button responsive">
                <?php echo $OUTPUT->get_setting('marketing2buttontext', true); ?>
            </a>
        </div>
    </div>

    <!-- Advert #3 -->
    <div class="marketing-spot span4">
        <!-- Icon & title. Font Awesome icon used. -->
        <h5><span><i
                    class="fa fa-<?php echo $OUTPUT->get_setting('marketing3icon'); ?>"></i> <?php echo $OUTPUT->get_setting('marketing3', true); ?></span>
        </h5>
        <?php if ($OUTPUT->get_setting('marketing3image')) { ?>
            <div class="marketing-image" id="marketing-image3"></div>
        <?php } ?>
        <?php echo $OUTPUT->get_setting('marketing3content', 'format_html'); ?>
        <div class="button">
            <a href="<?php echo $OUTPUT->get_setting('marketing3buttonurl'); ?>"
               target="<?php echo $OUTPUT->get_setting('marketing3target'); ?>"
               class="marketing-button responsive">
                <?php echo $OUTPUT->get_setting('marketing3buttontext', true); ?>
            </a>
        </div>
    </div>
</div>
<div class="row-fluid" id="marketing-buttons">
    <!-- Advert Button #1 -->
    <div class="span4">
        <a href="<?php echo $OUTPUT->get_setting('marketing1buttonurl'); ?>"
           target="<?php echo $OUTPUT->get_setting('marketing1target'); ?>" class="marketing-button">
            <?php echo $OUTPUT->get_setting('marketing1buttontext', true); ?>
        </a>
        <?php echo $OUTPUT->essential_edit_button('theme_essential_frontpage'); ?>
    </div>

    <!-- Advert Button #2 -->
    <div class="span4">
        <a href="<?php echo $OUTPUT->get_setting('marketing2buttonurl'); ?>"
           target="<?php echo $OUTPUT->get_setting('marketing2target'); ?>" class="marketing-button">
            <?php echo $OUTPUT->get_setting('marketing2buttontext', true); ?>
        </a>
        <?php echo $OUTPUT->essential_edit_button('theme_essential_frontpage'); ?>
    </div>

    <!-- Advert Button #3 -->
    <div class="span4">
        <a href="<?php echo $OUTPUT->get_setting('marketing3buttonurl'); ?>"
           target="<?php echo $OUTPUT->get_setting('marketing3target'); ?>" class="marketing-button">
            <?php echo $OUTPUT->get_setting('marketing3buttontext', true); ?>
        </a>
        <?php echo $OUTPUT->essential_edit_button('theme_essential_frontpage'); ?>
    </div>
</div>