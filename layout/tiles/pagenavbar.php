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
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

echo '<div id="page-navbar" class="clearfix row-fluid">';
echo '<div class="breadcrumb-nav pull-';
echo ($left) ? 'left' : 'right';
echo '">';
echo $OUTPUT->navbar();
echo '</div>';
echo '<nav class="breadcrumb-button pull-';
echo ($left) ? 'right' : 'left';
echo '">';
echo $OUTPUT->page_heading_button();
echo '</nav>';
echo '</div>';