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
class theme_essentials_core_renderer extends theme_essential_core_renderer {
    /**
     * This renders the breadcrumbs
     * @return string $breadcrumbs
     */
    public function navbar()
    {
        $breadcrumbs = html_writer::start_tag('ul', array('class' => "breadcrumb style2"));  // If change, alter $breadcrumbstyle in header.php.
        $index = 1;
        foreach ($this->page->navbar->get_items() as $item) {
            $item->hideicon = true;
            $breadcrumbs .= html_writer::tag('li', $this->render($item), array('style' => 'z-index:' . (100 - $index) . ';'));
            $index += 1;
        }
        $breadcrumbs .= html_writer::end_tag('ul');
        return $breadcrumbs;
    }
}
