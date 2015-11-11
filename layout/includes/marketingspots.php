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

$spot1image = \theme_essential\toolbox::get_setting('marketing1image');
$spot2image = \theme_essential\toolbox::get_setting('marketing2image');
$spot3image = \theme_essential\toolbox::get_setting('marketing3image');

if ($spot1image || $spot2image || $spot3image) {
    $additionalmarketingclasses = ' withimage';
} else {
    $additionalmarketingclasses = ' noimages';
}

$additionalmarketingcontentclasses = '';
$spot1button = $OUTPUT->essential_marketing_button('1');
$spot2button = $OUTPUT->essential_marketing_button('2');
$spot3button = $OUTPUT->essential_marketing_button('3');
if ($spot1button || $spot2button || $spot3button) {
    $additionalmarketingcontentclasses = ' withbutton';
}

?>
<div class="row-fluid<?php echo $additionalmarketingclasses; ?>" id="marketing-spots">
    <div class="row-fluid">
        <!-- Spot #1 -->
        <div class="marketing-spot span4">
            <div class="title"><h5><span>
                <i class="fa fa-<?php echo \theme_essential\toolbox::get_setting('marketing1icon'); ?>"></i>
                <?php echo \theme_essential\toolbox::get_setting('marketing1', true); ?>
            </span></h5></div>
            <?php if ($spot1image) { ?>
                <div class="marketing-image-container"><div class="marketing-image" id="marketing-image1"></div></div>
            <?php } ?>
            <div class="content<?php echo $additionalmarketingcontentclasses; ?>">
                <?php
                    echo \theme_essential\toolbox::get_setting('marketing1content', 'format_html');
                    echo $spot1button;
                ?>
            </div>
        </div>

        <!-- Spot #2 -->
        <div class="marketing-spot span4">
            <div class="title"><h5><span>
                <i class="fa fa-<?php echo \theme_essential\toolbox::get_setting('marketing2icon'); ?>"></i>
                <?php echo \theme_essential\toolbox::get_setting('marketing2', true); ?>
            </span></h5></div>
            <?php if ($spot2image) { ?>
                <div class="marketing-image-container"><div class="marketing-image" id="marketing-image2"></div></div>
            <?php } ?>
            <div class="content<?php echo $additionalmarketingcontentclasses; ?>">
                <?php
                    echo \theme_essential\toolbox::get_setting('marketing2content', 'format_html');
                    echo $spot2button;
                ?>
            </div>
        </div>

        <!-- Spot #3 -->
        <div class="marketing-spot span4">
            <div class="title"><h5><span>
                <i class="fa fa-<?php echo \theme_essential\toolbox::get_setting('marketing3icon'); ?>"></i>
                <?php echo \theme_essential\toolbox::get_setting('marketing3', true); ?>
            </span></h5></div>
            <?php if ($spot3image) { ?>
                <div class="marketing-image-container"><div class="marketing-image" id="marketing-image3"></div></div>
            <?php } ?>
            <div class="content<?php echo $additionalmarketingcontentclasses; ?>">
                <?php
                    echo \theme_essential\toolbox::get_setting('marketing3content', 'format_html');
                    echo $spot3button;
                ?>
            </div>
        </div>
    </div>
</div>
