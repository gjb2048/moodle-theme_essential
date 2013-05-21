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

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Logo file setting.
    $name = 'theme_essential/logo';
    $title = get_string('logo', 'theme_essential');
    $description = get_string('logodesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Main theme background colour setting.
    $name = 'theme_essential/themecolor';
    $title = get_string('themecolor', 'theme_essential');
    $description = get_string('themecolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Main theme Hover colour setting.
    $name = 'theme_essential/themehovercolor';
    $title = get_string('themehovercolor', 'theme_essential');
    $description = get_string('themehovercolordesc', 'theme_essential');
    $default = '#29a1c4';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    /* Slideshow Widget Settings */

    /*
     * Slide 1
     */

    // Title.
    $name = 'theme_essential/slide1';
    $title = get_string('slide1', 'theme_essential');
    $description = get_string('slide1desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $settings->add($setting);

    // Image.
    $name = 'theme_essential/slide1image';
    $title = get_string('slide1image', 'theme_essential');
    $description = get_string('slide1imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Caption.
    $name = 'theme_essential/slide1caption';
    $title = get_string('slide1caption', 'theme_essential');
    $description = get_string('slide1captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $settings->add($setting);

    // URL.
    $name = 'theme_essential/slide1url';
    $title = get_string('slide1url', 'theme_essential');
    $description = get_string('slide1urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    /*
     * Slide 2
     */

    // Title.
    $name = 'theme_essential/slide2';
    $title = get_string('slide2', 'theme_essential');
    $description = get_string('slide2desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $settings->add($setting);

    // Image.
    $name = 'theme_essential/slide2image';
    $title = get_string('slide2image', 'theme_essential');
    $description = get_string('slide2imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Caption.
    $name = 'theme_essential/slide2caption';
    $title = get_string('slide2caption', 'theme_essential');
    $description = get_string('slide2captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $settings->add($setting);

    // URL.
    $name = 'theme_essential/slide2url';
    $title = get_string('slide2url', 'theme_essential');
    $description = get_string('slide2urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    /*
     * Slide 3
     */

    // Title.
    $name = 'theme_essential/slide3';
    $title = get_string('slide3', 'theme_essential');
    $description = get_string('slide3desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $settings->add($setting);

    // Image.
    $name = 'theme_essential/slide3image';
    $title = get_string('slide3image', 'theme_essential');
    $description = get_string('slide3imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Caption.
    $name = 'theme_essential/slide3caption';
    $title = get_string('slide3caption', 'theme_essential');
    $description = get_string('slide3captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $settings->add($setting);

    // URL.
    $name = 'theme_essential/slide3url';
    $title = get_string('slide3url', 'theme_essential');
    $description = get_string('slide3urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    /*
     * Slide 4
     */

    // Title.
    $name = 'theme_essential/slide4';
    $title = get_string('slide4', 'theme_essential');
    $description = get_string('slide4desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $settings->add($setting);

    // Image.
    $name = 'theme_essential/slide4image';
    $title = get_string('slide4image', 'theme_essential');
    $description = get_string('slide4imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Caption.
    $name = 'theme_essential/slide4caption';
    $title = get_string('slide4caption', 'theme_essential');
    $description = get_string('slide4captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $settings->add($setting);

    // URL.
    $name = 'theme_essential/slide4url';
    $title = get_string('slide4url', 'theme_essential');
    $description = get_string('slide4urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // Contact Info setting.
    $name = 'theme_essential/contactinfo';
    $title = get_string('contactinfo', 'theme_essential');
    $description = get_string('contactinfodesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);

    // Copyright setting.
    $name = 'theme_essential/copyright';
    $title = get_string('copyright', 'theme_essential');
    $description = get_string('copyrightdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $settings->add($setting);

    // Facebook url setting.
    $name = 'theme_essential/facebook';
    $title = get_string('facebook', 'theme_essential');
    $description = get_string('facebookdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $settings->add($setting);

    // Twitter url setting.
    $name = 'theme_essential/twitter';
    $title = get_string('twitter', 'theme_essential');
    $description = get_string('twitterdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $settings->add($setting);

    // Google+ url setting.
    $name = 'theme_essential/googleplus';
    $title = get_string('googleplus', 'theme_essential');
    $description = get_string('googleplusdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $settings->add($setting);

    // LinkedIn url setting.
    $name = 'theme_essential/linkedin';
    $title = get_string('linkedin', 'theme_essential');
    $description = get_string('linkedindesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $settings->add($setting);

    // Custom CSS file.
    $name = 'theme_essential/customcss';
    $title = get_string('customcss', 'theme_essential');
    $description = get_string('customcssdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Footnote setting.
    $name = 'theme_essential/footnote';
    $title = get_string('footnote', 'theme_essential');
    $description = get_string('footnotedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);
}
