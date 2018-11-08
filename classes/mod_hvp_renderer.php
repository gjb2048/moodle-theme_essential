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
 * @copyright   2018 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

global $CFG;
$h5prenderer = $CFG->dirroot.'/mod/hvp/renderer.php';
if (file_exists($h5prenderer)) {
    // Be sure to include the H5P renderer so it can be extended.
    require_once($h5prenderer);

    /**
     * Class theme_essential_mod_hvp_renderer
     */
    class theme_essential_mod_hvp_renderer extends mod_hvp_renderer {

        /**
         * Add styles when an H5P is displayed.
         *
         * @param array $styles Styles that will be applied.
         * @param array $libraries Libraries that will be shown.
         * @param string $embedtype How the H5P is displayed.
         */
        public function hvp_alter_styles(&$styles, $libraries, $embedtype) {
            $content = \theme_essential\toolbox::get_setting('hvpcustomcss');
            if (!empty($content)) {
                $styles[] = (object) array(
                    'path' => $this->get_style_url($content),
                    'version' => ''
                );
            }
        }

        protected function get_style_url($content) {
            global $CFG;

            $syscontext = \context_system::instance();
            $itemid = md5($content);
            return \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                "/$syscontext->id/theme_essential/hvp/$itemid/themehvp.css");
        }
    }
}
