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
     *
     * Extends the H5P renderer so that we are able to override the relevant
     * functions declared there
     */
    class theme_essential_mod_hvp_renderer extends mod_hvp_renderer {

        /**
         * Add styles when an H5P is displayed.
         *
         * @param array $styles Styles that will be applied.
         * @param array $libraries Libraries that wil be shown.
         * @param string $embedType How the H5P is displayed.
         */
        public function hvp_alter_styles(&$styles, $libraries, $embedType) {
            error_log('HVPR Hullo');
            global $CFG;

            $styles[] = (object) array(
                'path' => $this->get_style_url(),
                //'version' => '?ver=3.5.1.2' // Not really needed as theme revision in the URL changes when the HVP custom CSS does.
                'version' => ''
            );
        }
        
        protected function get_style_url() {
            global $CFG;
            
            $syscontext = \context_system::instance();
            $itemid = \theme_get_revision();
            $content = '.h5p-box-wrapper { border: 10px solid #fab; }';
            $itemid = md5($content);
            $url = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                "/$syscontext->id/theme_essential/hvp/$itemid/hvp.css");
            //$url = preg_replace('|^https?://|i', '//', $url->out(false));
            error_log('hvpr url: '.$url);
            return $url;
        }
    }
}
