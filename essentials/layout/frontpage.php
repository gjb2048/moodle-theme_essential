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
 * Essentials is a basic child theme of Essential to help you as a theme
 * developer create your own child theme of Essential.
 *
 * @package     theme_essentials
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($OUTPUT->get_include_file('header'));
?>
<div id="page" class="container-fluid">

    <section role="main-content">
        <div id="page-content" class="row-fluid">
            <section id="<?php echo $regionbsid; ?>">
                <section id="region-main" class="span9 desktop-first-column">
                <?php
                    echo $OUTPUT->course_content_header();
                    echo '<h1 class="frontpagetitle">'.get_string('frontpagetitle', 'theme_essentials').'</h1>';
                    echo '<p class="frontpagedetails">'.get_string('frontpagedetails', 'theme_essentials').'</p>';
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php
                    echo $OUTPUT->blocks('side-pre', 'span3 pull-right');
                ?>
            </section>
        </div>
    </section>
</div>

<?php 
require_once($OUTPUT->get_include_file('footer'));
?>
</body>
</html>
