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

// Number of slides.
$name = 'theme_essentials/numberofslides';
$title = get_string('numberofslides', 'theme_essential');
$description = get_string('numberofslides_desc', 'theme_essential');
$default = 4;
$choices = array(
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4'
);
$generalsettings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

// Slide interval.
$name = 'theme_essentials/slideinterval';
$title = get_string('slideinterval', 'theme_essential');
$description = get_string('slideintervaldesc', 'theme_essential');
$default = '5000';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Slide caption text colour setting.
$name = 'theme_essentials/slidecaptiontextcolor';
$title = get_string('slidecaptiontextcolor', 'theme_essential');
$description = get_string('slidecaptiontextcolordesc', 'theme_essential');
$default = '#ffffff';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Slide caption background colour setting.
$name = 'theme_essentials/slidecaptionbackgroundcolor';
$title = get_string('slidecaptionbackgroundcolor', 'theme_essential');
$description = get_string('slidecaptionbackgroundcolordesc', 'theme_essential');
$default = '#30add1';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Show caption options.
$name = 'theme_essentials/slidecaptionoptions';
$title = get_string('slidecaptionoptions', 'theme_essential');
$description = get_string('slidecaptionoptionsdesc', 'theme_essential');
$default = '0';
$choices = array(
    0 => get_string('slidecaptionbeside', 'theme_essential'),
    1 => get_string('slidecaptionontop', 'theme_essential'),
    2 => get_string('slidecaptionunderneath', 'theme_essential'),
);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Show caption centred.
$name = 'theme_essentials/slidecaptioncentred';
$title = get_string('slidecaptioncentred', 'theme_essential');
$description = get_string('slidecaptioncentreddesc', 'theme_essential');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Slide button colour setting.
$name = 'theme_essentials/slidebuttoncolor';
$title = get_string('slidebuttoncolor', 'theme_essential');
$description = get_string('slidebuttoncolordesc', 'theme_essential');
$default = '#30add1';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

// Slide button hover colour setting.
$name = 'theme_essentials/slidebuttonhovercolor';
$title = get_string('slidebuttonhovercolor', 'theme_essential');
$description = get_string('slidebuttonhovercolordesc', 'theme_essential');
$default = '#217a94';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$generalsettings->add($setting);

$numberofslides = get_config('theme_essentials', 'numberofslides');
for ($i = 1; $i <= $numberofslides; $i++) {
    // This is the descriptor.
    $name = 'theme_essentials/slide' . $i . 'info';
    $heading = get_string('slideno', 'theme_essential', array('slide' => $i));
    $information = get_string('slidenodesc', 'theme_essential', array('slide' => $i));
    $setting = new admin_setting_heading($name, $heading, $information);
    $generalsettings->add($setting);

    // Title.
    $name = 'theme_essentials/slide' . $i;
    $title = get_string('slidetitle', 'theme_essential');
    $description = get_string('slidetitledesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Image.
    $name = 'theme_essentials/slide' . $i . 'image';
    $title = get_string('slideimage', 'theme_essential');
    $description = get_string('slideimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide' . $i . 'image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Caption text.
    $name = 'theme_essentials/slide' . $i . 'caption';
    $title = get_string('slidecaption', 'theme_essential');
    $description = get_string('slidecaptiondesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // URL.
    $name = 'theme_essentials/slide' . $i . 'url';
    $title = get_string('slideurl', 'theme_essential');
    $description = get_string('slideurldesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // URL target.
    $name = 'theme_essentials/slide' . $i . 'target';
    $title = get_string('slideurltarget', 'theme_essential');
    $description = get_string('slideurltargetdesc', 'theme_essential');
    $target1 = get_string('slideurltargetself', 'theme_essential');
    $target2 = get_string('slideurltargetnew', 'theme_essential');
    $target3 = get_string('slideurltargetparent', 'theme_essential');
    $default = '_blank';
    $choices = array('_self' => $target1, '_blank' => $target2, '_parent' => $target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);
}

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
