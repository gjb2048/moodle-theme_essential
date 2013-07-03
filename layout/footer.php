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
 * This is built using the Clean template to allow for new theme's using
 * Moodle's new Bootstrap theme engine
 *
 *
 * @package   theme_essential
 * @copyright 2013 Julian Ridden
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hascopyright = (empty($PAGE->theme->settings->copyright)) ? false : $PAGE->theme->settings->copyright;
?>
<div class="row-fluid">
    <!-- Widget 1 -->
    <div class="span4">
        <?php if ($hasfooterleft) {
            echo $OUTPUT->blocks_for_region('footer-left');
        } ?>
    </div>

    <!-- widget 2 -->
    <div class="span4">
        <?php if ($hasfootermiddle) {
            echo $OUTPUT->blocks_for_region('footer-middle');
        } ?>
    </div>

    <!-- Widget 3 -->
    <div class="span4">
        <?php if ($hasfooterright) {
            echo $OUTPUT->blocks_for_region('footer-right');
        } ?>
    </div>
</div>

<div class="row-fluid">
    <hr>
    <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')); ?></p>
    <?php if ($hascopyright) {
        echo '    <p class="copy">&copy; '.date("Y").' '.$hascopyright.'</p>';
    } ?>
</div>
