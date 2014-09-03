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

if (file_exists("$CFG->dirroot/course/format/noticebd/renderer.php")) {
    include_once($CFG->dirroot . "/course/format/noticebd/renderer.php");

    class theme_essential_format_noticebd_renderer extends format_noticebd_renderer
    {
        public function start_section_list()
        {
            return parent::start_section_list();
        }

        public function end_section_list()
        {
            return parent::end_section_list();
        }

        public function get_nav_links($course, $sections, $sectionno)
        {
            return theme_essential_get_nav_links($course, $sections, $sectionno);
        }

        public function section_left_content($section, $course, $onsectionpage)
        {
            return parent::section_left_content($section, $course, $onsectionpage);
        }

        public function section_right_content($section, $course, $onsectionpage)
        {
            return parent::section_right_content($section, $course, $onsectionpage);
        }

        public function section_header($section, $course, $onsectionpage, $sectionreturn = null)
        {
            return parent::section_header($section, $course, $onsectionpage, $sectionreturn);
        }

        public function section_footer()
        {
            return parent::section_footer();
        }

        public function section_availability_message($section, $canviewhidden)
        {
            return parent::section_availability_message($section, $canviewhidden);
        }

        public function course_activity_clipboard($course, $sectionno = null)
        {
            return parent::course_activity_clipboard($course, $sectionno);
        }

        public function format_summary_text($section)
        {
            return parent::format_summary_text($section);
        }

        public function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection)
        {
            return theme_essential_print_single_section_page($this, $this->courserenderer, $course, $sections, $mods, $modnames, $modnamesused, $displaysection);
        }
    }
}