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

$numberofslides = theme_essential_showslider('numberofslides'); // In lib.php.

if ($numberofslides) {
    $slideinterval = theme_essential_get_setting('slideinterval');
    $slidecaptionbelow = theme_essential_get_setting('slidecaptionbelow');
?>
    <div class="row-fluid">
        <div class="span12">
            <div id="essentialCarousel" class="carousel slide" data-interval="<?php echo $slideinterval;?>">
                <ol class="carousel-indicators">
                    <?php
                    $first = true;
                    for ($i = 1; $i <= $numberofslides; $i++) { ?>
                        <li data-target="#essentialCarousel" data-slide-to="<?php echo $i - 1; ?>" <?php if ($first) { echo 'class="active"'; $first = false; } ?>></li>
                    <?php } ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $first = true;
                    for ($i = 1; $i <= $numberofslides; $i++) {
                        $urlsetting = 'slide'.$i.'url';
                        $urltarget = 'slide'.$i.'target';
                        if (theme_essential_get_setting($urlsetting)) {
                            echo '<a href="'.theme_essential_get_setting($urlsetting).'" target="'.theme_essential_get_setting($urltarget).'"';
                        } else {
                            echo '<div';
                        }
                        echo ' class="';
                        if ($first) {
                            echo 'active ';
                            $first = false;
                        }
                        echo 'item">';
                        $imagesetting = 'slide'.$i.'image';
                        if (theme_essential_get_setting($imagesetting)) {
                            $image = $PAGE->theme->setting_file_url($imagesetting, $imagesetting);
                        } else {
                            $image = $OUTPUT->pix_url('default_slide', 'theme');
                        }
                        $slidetitle = 'slide'.$i;
                        if (theme_essential_get_setting($slidetitle)) {
                            $imgalt = theme_essential_get_setting($slidetitle);
                        } else {
                            $imgalt = get_string('noslidetitle', 'theme_essential', array('slide' => $i));
                        }
                        ?>
                        <img src="<?php echo $image; ?>" alt="<?php echo $imgalt; ?>" class="carousel-image" />

                        <?php
                        if ($slidecaptionbelow) {
                            echo '<div class="row-fluid"><div class="span12">';
                        }
                        $slidecaption = 'slide'.$i.'caption';
                        if ((theme_essential_get_setting($slidetitle)) || (theme_essential_get_setting($slidecaption))) { ?>
                            <div class="carousel-caption">
                                <div class="carousel-caption-inner">
                                <?php
                                if (theme_essential_get_setting($slidetitle)) { echo '<h4>'.theme_essential_get_setting($slidetitle, true).'</h4>'; }
                                if (theme_essential_get_setting($slidecaption)) { echo '<p>'.theme_essential_get_setting($slidecaption, true).'</p>'; }
                                ?> 
                                </div>
                            </div> 
                            <?php 
                        }
                        if ($slidecaptionbelow) {
                            echo '</div></div>';
                        }
                        echo (theme_essential_get_setting($urlsetting)? '</a>' : '</div>');
                    } ?>
                </div>
                <a class="left carousel-control" href="#essentialCarousel" data-slide="prev"><i class="fa fa-chevron-circle-left"></i></a>
                <a class="right carousel-control" href="#essentialCarousel" data-slide="next"><i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
<?php } ?>
