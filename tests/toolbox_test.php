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
 * Essential theme.
 *
 * @package    theme
 * @subpackage essential
 * @copyright  &copy; 2015-onwards G J Barnard in respect to modifications of the Bootstrap theme.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Bas Brands, David Scotson and many other contributors.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Toolbox unit tests for the Shoehorn theme.
 * @group theme_essential
 */
class theme_essential_toolbox_testcase extends advanced_testcase {

    protected $outputus;

    protected function setUp() {
        set_config('theme', 'essential');
        set_config('slide1url', 'https://about.me/gjbarnard', 'theme_essential');
        set_config('slide1target', '_blank', 'theme_essential');
        set_config('slide1', 'Test slide one', 'theme_essential');
        set_config('slide1caption', '<p>Test of link in caption: <a href="https://about.me/gjbarnard" target="_blank">me.</a></p>',
            'theme_essential');
        set_config('slide2target', '_blank', 'theme_essential');
        set_config('slide2', 'Test slide two', 'theme_essential');
        set_config('slide2caption', '<p>Test of link in caption: <a href="https://about.me/gjbarnard" target="_blank">me.</a></p>',
            'theme_essential');
        $this->resetAfterTest(true);

        global $PAGE;
        $this->outputus = $PAGE->get_renderer('theme_essential', 'core');
        \theme_essential\toolbox::set_core_renderer($this->outputus);
    }
    public function test_get_tilefile_header() {
        $thefile = \theme_essential\toolbox::get_tile_file('header');
        global $CFG;
        $withoutdirroot = str_replace($CFG->dirroot, '', $thefile);

        $this->assertEquals('/theme/essential/layout/tiles/header.php', $withoutdirroot);
    }

    public function test_get_tilefile_pagesettings() {
        $thefile = \theme_essential\toolbox::get_tile_file('pagesettings');
        global $CFG;
        $withoutdirroot = str_replace($CFG->dirroot, '', $thefile);

        $this->assertEquals('/theme/essential/layout/tiles/pagesettings.php', $withoutdirroot);
    }

    public function test_get_tilefile_slideshow() {
        $thefile = \theme_essential\toolbox::get_tile_file('slideshow');
        global $CFG;
        $withoutdirroot = str_replace($CFG->dirroot, '', $thefile);

        $this->assertEquals('/theme/essential/layout/tiles/slideshow.php', $withoutdirroot);
    }

    public function test_render_indicators() {
        $theindicators = \theme_essential\toolbox::render_indicators(4);
        $thecontent = '<li data-target="#essentialCarousel" data-slide-to="0" class="active"></li>';
        $thecontent .= '<li data-target="#essentialCarousel" data-slide-to="1"></li>';
        $thecontent .= '<li data-target="#essentialCarousel" data-slide-to="2"></li>';
        $thecontent .= '<li data-target="#essentialCarousel" data-slide-to="3"></li>';
        $this->assertEquals($thecontent, $theindicators);
    }

    public function test_render_slide() {
        $theslide1 = \theme_essential\toolbox::render_slide(1, 0);
		global $CFG;
		error_log('DR:  '.$CFG->dataroot);
		error_log('PDR: '.$CFG->phpunit_dataroot);
        $thecontent1 = '<a href="https://about.me/gjbarnard" target="_blank" class="item side-caption active">';
        $thecontent1 .= '<div class="container-fluid"><div class="row-fluid"><div class="span5 the-side-caption">';
        $thecontent1 .= '<div class="the-side-caption-content"><h4>Test slide one</h4><div><p>Test of link in caption: me.</p>';
        $thecontent1 .= '</div></div></div><div class="span7"><div class="carousel-image-container">';
        $thecontent1 .= '<img src="http://www.example.com/moodle/theme/image.php/_s/essential/theme/1/default_slide" ';
        $thecontent1 .= 'alt="Test slide one" class="carousel-image"></div></div></div></div></a>';
        $this->assertEquals($thecontent1, $theslide1);

        $theslide2 = \theme_essential\toolbox::render_slide(2, 0);
        $thecontent2 = '<div class="item side-caption">';
        $thecontent2 .= '<div class="container-fluid"><div class="row-fluid"><div class="span5 the-side-caption">';
        $thecontent2 .= '<div class="the-side-caption-content"><h4>Test slide two</h4><div>';
        $thecontent2 .= '<p>Test of link in caption: <a href="https://about.me/gjbarnard" target="_blank">me.</a></p>';
        $thecontent2 .= '</div></div></div><div class="span7"><div class="carousel-image-container">';
        $thecontent2 .= '<img src="http://www.example.com/moodle/theme/image.php/_s/essential/theme/1/default_slide" ';
        $thecontent2 .= 'alt="Test slide two" class="carousel-image"></div></div></div></div></div>';
        $this->assertEquals($thecontent2, $theslide2);
    }

    public function test_themeinfo() {
        global $PAGE, $CFG;
        $themedir = str_replace($CFG->dirroot, '', $PAGE->theme->dir);

        $this->assertEquals('essential', $PAGE->theme->name);
        $this->assertEquals('/theme/essential', $themedir);
        $this->assertEmpty($PAGE->theme->parents);
    }
}