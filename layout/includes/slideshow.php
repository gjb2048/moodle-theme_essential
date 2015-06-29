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

$data = array('data' => array('slideinterval' => '5000'));
$PAGE->requires->js_call_amd('theme_essential/carousel', 'init', $data);

$numberofslides = \theme_essential\toolbox::showslider();

if ($numberofslides) {
    $slideinterval  = \theme_essential\toolbox::get_setting('slideinterval');
    $captionscenter = (\theme_essential\toolbox::get_setting('slidecaptioncentred'))? ' centred' : '';
    $captionoptions = \theme_essential\toolbox::get_setting('slidecaptionoptions');
    $captionsbelowclass  = ($captionoptions == 2) ? ' below' : '';
    ?>
    <div class="row-fluid">
        <div class="span12">
            <div id="essentialCarousel" class="carousel slide" data-interval="<?php echo $slideinterval;?>">
                <?php echo $OUTPUT->essential_edit_button('theme_essential_slideshow');?>
                <ol class="carousel-indicators">
                    <?php
                    for ($indicatorslideindex = 0; $indicatorslideindex < $numberofslides; $indicatorslideindex++) {
                        echo '<li data-target="#essentialCarousel" data-slide-to="'.$indicatorslideindex.'"';
                        if ($indicatorslideindex == 0) {
                            echo 'class="active"';
                        }
                        echo '></li>';
                    }
                    ?>
                </ol>
                <div class="carousel-inner<?php echo $captionscenter.$captionsbelowclass;?>">
                    <?php for ($slideindex = 1; $slideindex <= $numberofslides; $slideindex++) {
                        echo \theme_essential\toolbox::render_slide($slideindex, $captionoptions);
                    } ?>
                </div>
                <?php echo \theme_essential\toolbox::render_slide_controls($left); ?>
            </div>
        </div>
    </div>
<?php } ?>