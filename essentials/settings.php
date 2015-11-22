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
defined('MOODLE_INTERNAL') || die;

// Settings.
$settings = null;

$readme = new moodle_url('/theme/essentials/README.txt');
$readme = html_writer::link($readme, 'README.txt', array('target' => '_blank'));

$ADMIN->add('themes', new admin_category('theme_essentials', 'Essentials'));

$generalsettings = new admin_settingpage('theme_essentials_general', get_string('generalsettings', 'theme_essentials'));

// Overridden Essential settings.
// Logo file setting.
$name = 'theme_essentials/logo';
$title = get_string('logo', 'theme_essentials');
$description = get_string('logodesc', 'theme_essentials');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Custom CSS.
$name = 'theme_essentials/customcss';
$title = get_string('customcss', 'theme_essentials');
$description = get_string('customcssdesc', 'theme_essentials');
$default = '';
$setting = new admin_setting_configtextarea($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Essentials settings.
// Front page title style.
$name = 'theme_essentials/frontpagetitlestyle';
$title = get_string('frontpagetitlestyle', 'theme_essentials');
$description = get_string('frontpagetitlestyledesc', 'theme_essentials');
$default = 'inherit';
$setting = new admin_setting_configselect($name, $title, $description, $default,
        array(
    'inherit' => get_string('inherit', 'theme_essentials'),
    'normal' => get_string('normal', 'theme_essentials'),
    'italic' => get_string('italic', 'theme_essentials')
));
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

$ADMIN->add('theme_essentials', $generalsettings);
