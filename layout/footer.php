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
 
$footerl = 'footer-left';
$footerm = 'footer-middle';
$footerr = 'footer-right';

$hascopyright = (empty($PAGE->theme->settings->copyright)) ? false : $PAGE->theme->settings->copyright;
$hasfootnote = (empty($PAGE->theme->settings->footnote)) ? false : $PAGE->theme->settings->footnote;
$hasfooterleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-left', $OUTPUT));
$hasfootermiddle = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-middle', $OUTPUT));
$hasfooterright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('footer-right', $OUTPUT));

?>
	<div class="row-fluid">
		<?php
            		echo $OUTPUT->essentialblocks($footerl, 'span4');

            		echo $OUTPUT->essentialblocks($footerm, 'span4');

            		echo $OUTPUT->essentialblocks($footerr, 'span4');
		?>
 	</div>

	<div class="footerlinks row-fluid">
    	<hr>
    	<p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')); ?></p>
    <?php if ($hascopyright) {
        echo '<p class="copy">&copy; '.date("Y").' '.$hascopyright.'</p>';
    } ?>
    
    <?php if ($hasfootnote) {
        echo '<div class="footnote">'.$hasfootnote.'</div>';
    } ?>
	</div>
	

