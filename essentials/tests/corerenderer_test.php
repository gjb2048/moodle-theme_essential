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
 * Essentials theme.
 *
 * @package    theme
 * @subpackage essentials
 * @copyright  &copy; 2015-onwards G J Barnard in respect to modifications of the Bootstrap theme.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Bas Brands, David Scotson and many other contributors.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Core renderer unit tests for the Essentials theme.
 * @group theme_essentials
 */
class theme_essentials_corerenderer_testcase extends advanced_testcase {

    protected $outputus;

    protected function setUp() {
        set_config('themetextcolour', '#00ff00', 'theme_essentials');
        set_config('logo', '/test_essential.jpg', 'theme_essential');
        set_config('logo', '/test_essentials.jpg', 'theme_essentials');
        $this->resetAfterTest(true);

        global $PAGE;
        $this->outputus = $PAGE->get_renderer('theme_essentials', 'core');
        \theme_essential\toolbox::set_core_renderer($this->outputus);
    }

    public function test_version() {
        $ourversion = \theme_essential\toolbox::get_setting('version');
        $coretheme = \theme_config::load('essentials');

        $this->assertEquals($coretheme->settings->version, $ourversion);
    }

    public function test_themetextcolour() {
        $ourcolour = \theme_essential\toolbox::get_setting('themetextcolour');

        $this->assertEquals('#00ff00', $ourcolour);
    }

    public function test_logo_essentials() {
        $ourlogo = \theme_essential\toolbox::setting_file_url('logo', 'logo');

        $this->assertEquals('//www.example.com/moodle/pluginfile.php/1/theme_essentials/logo/1/test_essentials.jpg', $ourlogo);
    }

    public function test_logo_essential() {
        global $PAGE;
        $outputus = $PAGE->get_renderer('theme_essentials', 'core');
        $ourlogo = $outputus->setting_file_url('logo', 'logo');

        $this->assertEquals('//www.example.com/moodle/pluginfile.php/1/theme_essentials/logo/1/test_essential.jpg', $ourlogo);
    }

    public function test_pix() {
        $ouricon = \theme_essential\toolbox::pix_url('essential_button', 'theme');

        $this->assertEquals('http://www.example.com/moodle/theme/image.php/_s/essentials/theme/1/essential_button', $ouricon->out(false));
    }
}