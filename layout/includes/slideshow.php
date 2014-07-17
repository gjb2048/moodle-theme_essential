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

$numberofslides = theme_essential_showslider($PAGE->theme->settings); // In lib.php.

if ($numberofslides) {
    $slideinterval = (empty($PAGE->theme->settings->slideinterval)) ? 5000 : $PAGE->theme->settings->slideinterval;
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
                        if (!empty($PAGE->theme->settings->$urlsetting)) {
                            echo '<a href="'.$PAGE->theme->settings->$urlsetting.'" target="'.$PAGE->theme->settings->$urltarget.'"';
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
                        if (!empty($PAGE->theme->settings->$imagesetting)) {
                            $image = $PAGE->theme->setting_file_url($imagesetting, $imagesetting);
                        } else {
                            $image = $OUTPUT->pix_url('default_slide', 'theme');
                        }
                        $slidetitle = 'slide'.$i;
                        if (!empty($PAGE->theme->settings->$slidetitle)) {
                            $imgalt = $PAGE->theme->settings->$slidetitle;
                        } else {
                            $imgalt = get_string('noslidetitle', 'theme_essential', array('slide' => $i));
                        }
                        ?>
                        <img src="<?php echo $image; ?>" alt="<?php echo $imgalt; ?>" class="carousel-image" />

                        <?php
                        $slidecaption = 'slide'.$i.'caption';
                        if ((!empty($PAGE->theme->settings->$slidetitle)) || (!empty($PAGE->theme->settings->$slidecaption))) { ?>
                            <div class="carousel-caption">
                                <div class="carousel-caption-inner">
                                <?php
                                if (!empty($PAGE->theme->settings->$slidetitle)) { echo '<h4>'.$PAGE->theme->settings->$slidetitle.'</h4>'; }
                                if (!empty($PAGE->theme->settings->$slidecaption)) { echo '<p>'.$PAGE->theme->settings->$slidecaption.'</p>'; }
                                ?> 
                                </div>
                            </div> 
                            <?php 
                            }
                            echo (!empty($PAGE->theme->settings->$urlsetting)? '</a>' : '</div>');
                    } ?>
                </div>
                <a class="left carousel-control" href="#essentialCarousel" data-slide="prev"><span class="sr-only"><?php echo get_string('previous'); ?></span><i class="fa fa-chevron-circle-left"></i></a>
                <a class="right carousel-control" href="#essentialCarousel" data-slide="next"><span class="sr-only"><?php echo get_string('next'); ?></span><i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
<?php } ?>
