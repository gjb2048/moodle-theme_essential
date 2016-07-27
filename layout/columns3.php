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
 * Essential is a clean and customizable theme.
 *
 * @package     theme_essential
 * @copyright   2016 Gareth J Barnard
 * @copyright   2014 Gareth J Barnard, David Bezemer
 * @copyright   2013 Julian Ridden
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(\theme_essential\toolbox::get_tile_file('additionaljs'));
require_once(\theme_essential\toolbox::get_tile_file('header'));

if (core_useragent::get_device_type() == "tablet") {
    $tablet = true;
} else {
    $tablet = false;
}
?>

<div id="page" class="container-fluid">
    <?php require_once(\theme_essential\toolbox::get_tile_file('pagenavbar')); ?>
        <!-- Start Main Regions -->
        <div id="page-content" class="row-fluid">
            <div id="<?php echo $regionbsid ?>" class="span9">
                <div class="row-fluid">
<?php
if ($tablet) {
    echo '<div class="span12">';
} else if ($hasboringlayout) {
    echo '<div class="span8 pull-right">';
} else {
    echo '<div class="span8 desktop-first-column">';
}
echo $OUTPUT->essential_blocks('page-top', 'row-fluid', 'aside', \theme_essential\toolbox::get_setting('pagetopblocksperrow'));
echo '<section id="region-main">';
echo $OUTPUT->course_title();
echo $OUTPUT->course_content_header();
echo $OUTPUT->main_content();
if (empty($PAGE->layout_options['nocoursefooter'])) {
    echo $OUTPUT->course_content_footer();
}
echo '</section>';
echo '</div>';
if (!$tablet) {
    if ($hasboringlayout) {
        echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column');
    } else {
        echo $OUTPUT->blocks('side-pre', 'span4 pull-right');
    }
}
?>
                </div>
            </div>
            <?php
            if ($tablet) {
                ?> <div class="span3"><div class="row-fluid"> <?php
    echo $OUTPUT->blocks('side-pre', '');
    echo $OUTPUT->blocks('side-post', '');
?> </div></div> <?php
            } else {
                echo $OUTPUT->blocks('side-post', 'span3');
            }
?>
        </div>
        <!-- End Main Regions -->
</div>

<?php require_once(\theme_essential\toolbox::get_tile_file('footer')); ?>
</body>
</html>
