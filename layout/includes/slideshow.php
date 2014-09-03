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

$numberofslides = theme_essential_showslider('numberofslides');
$slideinterval  = theme_essential_get_setting('slideinterval');
$captionscenter = (theme_essential_get_setting('slidecaptioncentred'))? ' centred' : '';
$captionsbelow  = (theme_essential_get_setting('slidecaptionbelow'))? ' below' : '';

if ($numberofslides) { ?>
    <div class="row-fluid">
        <div class="span12">
            <div id="essentialCarousel" class="carousel slide" data-interval="<?php echo $slideinterval;?>">
                <?php echo theme_essential_edit_button('theme_essential_slideshow');?>
                <ol class="carousel-indicators">
                    <?php for ($p = 1; $p <= $numberofslides; $p++) {
                        echo '<li data-target="#essentialCarousel" data-slide-to="'.$p.'" class=""></li>';
                    } ?>
                </ol>
                <div class="carousel-inner<?php echo $captionscenter.$captionsbelow;?>">
                    <?php for ($i = 1; $i <= $numberofslides; $i++) {
                        echo theme_essential_render_slide($i);
                    } ?>
                </div>
                <a class="left carousel-control" href="#essentialCarousel" data-slide="prev"><i class="fa fa-chevron-circle-left"></i></a>
                <a class="right carousel-control" href="#essentialCarousel" data-slide="next"><i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
<?php } ?>