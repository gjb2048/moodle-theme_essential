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

$settings = null;

defined('MOODLE_INTERNAL') || die;
if (is_siteadmin()) {

    $ADMIN->add('themes', new admin_category('theme_essential', 'Essential'));

    /* Generic Settings */
    $temp = new admin_settingpage('theme_essential_generic', get_string('genericsettings', 'theme_essential'));

    $donate = new moodle_url('http://moodle.org/user/profile.php?id=442195');
    $donate = html_writer::link($donate, get_string('paypal_click', 'theme_essential'), array('target' => '_blank'));

    $flattr = new moodle_url('https://flattr.com/profile/gjb2048');
    $flattr = html_writer::link($flattr, get_string('flattr_click', 'theme_essential'), array('target' => '_blank'));

    $temp->add(new admin_setting_heading('theme_essential_generaldonate', get_string('donate_title', 'theme_essential'),
        get_string('donate_desc', 'theme_essential').get_string('paypal_desc', 'theme_essential', array('url' => $donate)).get_string('flattr_desc', 'theme_essential', array('url' => $flattr)).get_string('donate_desc2', 'theme_essential')));

    $temp->add(new admin_setting_heading('theme_essential_generalheading', get_string('generalheadingsub', 'theme_essential'),
        format_text(get_string('generalheadingdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Page Background Image.
    $name = 'theme_essential/pagebackground';
    $title = get_string('pagebackground', 'theme_essential');
    $description = get_string('pagebackgrounddesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'pagebackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Background Style.
    $name = 'theme_essential/pagebackgroundstyle';
    $title = get_string('pagebackgroundstyle', 'theme_essential');
    $description = get_string('pagebackgroundstyledesc', 'theme_essential');
    $default = 'fixed';
    $setting = new admin_setting_configselect($name, $title, $description, $default, array(
        'fixed' => get_string('backgroundstylefixed', 'theme_essential'),
        'tiled' => get_string('backgroundstyletiled', 'theme_essential'),
        'stretch' => get_string('backgroundstylestretch', 'theme_essential'),
    ));
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Fixed or Variable Width.
    $name = 'theme_essential/pagewidth';
    $title = get_string('pagewidth', 'theme_essential');
    $description = get_string('pagewidthdesc', 'theme_essential');
    $default = 1200;
    $choices = array(960 => get_string('fixedwidthnarrow', 'theme_essential'),
        1200 => get_string('fixedwidthnormal', 'theme_essential'),
        1400 => get_string('fixedwidthwide', 'theme_essential'),
        100 => get_string('variablewidth', 'theme_essential'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Custom or standard layout.
    $name = 'theme_essential/layout';
    $title = get_string('layout', 'theme_essential');
    $description = get_string('layoutdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Choose breadcrumbstyle
    $name = 'theme_essential/breadcrumbstyle';
    $title = get_string('breadcrumbstyle', 'theme_essential');
    $description = get_string('breadcrumbstyledesc', 'theme_essential');
    $default = 1;
    $choices = array(
        1 => get_string('breadcrumbstyled', 'theme_essential'),
        4 => get_string('breadcrumbstylednocollapse', 'theme_essential'),
        2 => get_string('breadcrumbsimple', 'theme_essential'),
        3 => get_string('breadcrumbthin', 'theme_essential'),
        0 => get_string('nobreadcrumb', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Fitvids.
    $name = 'theme_essential/fitvids';
    $title = get_string('fitvids', 'theme_essential');
    $description = get_string('fitvidsdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Custom CSS file.
    $name = 'theme_essential/customcss';
    $title = get_string('customcss', 'theme_essential');
    $description = get_string('customcssdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $readme = new moodle_url('/theme/essential/README.txt');
    $readme = html_writer::link($readme, get_string('readme_click', 'theme_essential'), array('target' => '_blank'));

    $temp->add(new admin_setting_heading('theme_essential_generalreadme', get_string('readme_title', 'theme_essential'),
        get_string('readme_desc', 'theme_essential', array('url' => $readme))));

    $ADMIN->add('theme_essential', $temp);


    /* Colour Settings */
    $temp = new admin_settingpage('theme_essential_color', get_string('colorheading', 'theme_essential'));
    $temp->add(new admin_setting_heading('theme_essential_color', get_string('colorheadingsub', 'theme_essential'),
        format_text(get_string('colordesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Main theme colour setting.
    $name = 'theme_essential/themecolor';
    $title = get_string('themecolor', 'theme_essential');
    $description = get_string('themecolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme text colour setting.
    $name = 'theme_essential/themetextcolor';
    $title = get_string('themetextcolor', 'theme_essential');
    $description = get_string('themetextcolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme link colour setting.
    $name = 'theme_essential/themeurlcolor';
    $title = get_string('themeurlcolor', 'theme_essential');
    $description = get_string('themeurlcolordesc', 'theme_essential');
    $default = '#943b21';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme Hover colour setting.
    $name = 'theme_essential/themehovercolor';
    $title = get_string('themehovercolor', 'theme_essential');
    $description = get_string('themehovercolordesc', 'theme_essential');
    $default = '#6a2a18';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Icon colour setting.
    $name = 'theme_essential/themeiconcolor';
    $title = get_string('themeiconcolor', 'theme_essential');
    $description = get_string('themeiconcolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Navigation colour setting.
    $name = 'theme_essential/themenavcolor';
    $title = get_string('themenavcolor', 'theme_essential');
    $description = get_string('themenavcolordesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for the Footer
    $name = 'theme_essential/footercolorinfo';
    $heading = get_string('footercolors', 'theme_essential');
    $information = get_string('footercolorsdesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Footer background colour setting.
    $name = 'theme_essential/footercolor';
    $title = get_string('footercolor', 'theme_essential');
    $description = get_string('footercolordesc', 'theme_essential');
    $default = '#555555';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Footer text colour setting.
    $name = 'theme_essential/footertextcolor';
    $title = get_string('footertextcolor', 'theme_essential');
    $description = get_string('footertextcolordesc', 'theme_essential');
    $default = '#bbbbbb';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Footer Block Heading colour setting.
    $name = 'theme_essential/footerheadingcolor';
    $title = get_string('footerheadingcolor', 'theme_essential');
    $description = get_string('footerheadingcolordesc', 'theme_essential');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Footer Seperator colour setting.
    $name = 'theme_essential/footersepcolor';
    $title = get_string('footersepcolor', 'theme_essential');
    $description = get_string('footersepcolordesc', 'theme_essential');
    $default = '#313131';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Footer URL colour setting.
    $name = 'theme_essential/footerurlcolor';
    $title = get_string('footerurlcolor', 'theme_essential');
    $description = get_string('footerurlcolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Footer URL hover colour setting.
    $name = 'theme_essential/footerhovercolor';
    $title = get_string('footerhovercolor', 'theme_essential');
    $description = get_string('footerhovercolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for the user theme colors.
    $name = 'theme_essential/alternativethemecolorsinfo';
    $heading = get_string('alternativethemecolors', 'theme_essential');
    $information = get_string('alternativethemecolorsdesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    $defaultalternativethemecolors = array('#a430d1', '#d15430', '#5dd130');
    $defaultalternativethemehovercolors = array('#9929c4', '#c44c29', '#53c429');

    foreach (range(1, 3) as $alternativethemenumber) {

        // Enables the user to select an alternative colours choice.
        $name = 'theme_essential/enablealternativethemecolors' . $alternativethemenumber;
        $title = get_string('enablealternativethemecolors', 'theme_essential', $alternativethemenumber);
        $description = get_string('enablealternativethemecolorsdesc', 'theme_essential', $alternativethemenumber);
        $default = false;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // User theme colour name.
        $name = 'theme_essential/alternativethemename' . $alternativethemenumber;
        $title = get_string('alternativethemename', 'theme_essential', $alternativethemenumber);
        $description = get_string('alternativethemenamedesc', 'theme_essential', $alternativethemenumber);
        $default = get_string('alternativecolors', 'theme_essential', $alternativethemenumber);
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // User theme colour setting.
        $name = 'theme_essential/alternativethemecolor' . $alternativethemenumber;
        $title = get_string('alternativethemecolor', 'theme_essential', $alternativethemenumber);
        $description = get_string('alternativethemecolordesc', 'theme_essential', $alternativethemenumber);
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Alternative theme text colour setting.
        $name = 'theme_essential/alternativethemetextcolor' . $alternativethemenumber;
        $title = get_string('alternativethemetextcolor', 'theme_essential', $alternativethemenumber);
        $description = get_string('alternativethemetextcolordesc', 'theme_essential', $alternativethemenumber);
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Alternative theme link colour setting.
        $name = 'theme_essential/alternativethemeurlcolor' . $alternativethemenumber;
        $title = get_string('alternativethemehovercolor', 'theme_essential', $alternativethemenumber);
        $description = get_string('alternativethemehovercolordesc', 'theme_essential', $alternativethemenumber);
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // User theme hover colour setting.
        $name = 'theme_essential/alternativethemehovercolor' . $alternativethemenumber;
        $title = get_string('alternativethemehovercolor', 'theme_essential', $alternativethemenumber);
        $description = get_string('alternativethemehovercolordesc', 'theme_essential', $alternativethemenumber);
        $default = $defaultalternativethemehovercolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    }

    $ADMIN->add('theme_essential', $temp);

    /* Header Settings */
    $temp = new admin_settingpage('theme_essential_header', get_string('headerheading', 'theme_essential'));

    // New or old navbar.
    $name = 'theme_essential/oldnavbar';
    $title = get_string('oldnavbar', 'theme_essential');
    $description = get_string('oldnavbardesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Default Site icon setting.
    $name = 'theme_essential/siteicon';
    $title = get_string('siteicon', 'theme_essential');
    $description = get_string('siteicondesc', 'theme_essential');
    $default = 'laptop';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // Logo file setting.
    $name = 'theme_essential/logo';
    $title = get_string('logo', 'theme_essential');
    $description = get_string('logodesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Header title setting.
    $name = 'theme_essential/headertitle';
    $title = get_string('headertitle', 'theme_essential');
    $description = get_string('headertitledesc', 'theme_essential');
    $default = '1';
    $choices = array(
        0 => get_string('notitle', 'theme_essential'),
        1 => get_string('fullname', 'theme_essential'),
        2 => get_string('shortname', 'theme_essential'),
        3 => get_string('fullnamesummary', 'theme_essential'),
        4 => get_string('shortnamesummary', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Navbar title setting.
    $name = 'theme_essential/navbartitle';
    $title = get_string('navbartitle', 'theme_essential');
    $description = get_string('navbartitledesc', 'theme_essential');
    $default = '2';
    $choices = array(
        0 => get_string('notitle', 'theme_essential'),
        1 => get_string('fullname', 'theme_essential'),
        2 => get_string('shortname', 'theme_essential'),
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Header Background Image.
    $name = 'theme_essential/headerbackground';
    $title = get_string('headerbackground', 'theme_essential');
    $description = get_string('headerbackgrounddesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerbackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Header text colour setting.
    $name = 'theme_essential/headertextcolor';
    $title = get_string('headertextcolor', 'theme_essential');
    $description = get_string('headertextcolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /* Course Menu Settings */
    $name = 'theme_essential/mycoursesinfo';
    $heading = get_string('mycoursesinfo', 'theme_essential');
    $information = get_string('mycoursesinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Toggle courses display in custommenu.
    $name = 'theme_essential/displaymycourses';
    $title = get_string('displaymycourses', 'theme_essential');
    $description = get_string('displaymycoursesdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Set terminology for dropdown course list
    $name = 'theme_essential/mycoursetitle';
    $title = get_string('mycoursetitle', 'theme_essential');
    $description = get_string('mycoursetitledesc', 'theme_essential');
    $default = 'course';
    $choices = array(
        'course' => get_string('mycourses', 'theme_essential'),
        'unit' => get_string('myunits', 'theme_essential'),
        'class' => get_string('myclasses', 'theme_essential'),
        'module' => get_string('mymodules', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Helplink type
    $name = 'theme_essential/helplinktype';
    $title = get_string('helplinktype', 'theme_essential');
    $description = get_string('helplinktypedesc', 'theme_essential');
    $default = 1;
    $choices = array(1 => get_string('email'),
        2 => get_string('url'),
        0 => get_string('none')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Helplink
    $name = 'theme_essential/helplink';
    $title = get_string('helplink', 'theme_essential');
    $description = get_string('helplinkdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /* Social Network Settings */
    $temp->add(new admin_setting_heading('theme_essential_social', get_string('socialheadingsub', 'theme_essential'),
        format_text(get_string('socialdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Website url setting.
    $name = 'theme_essential/website';
    $title = get_string('websiteurl', 'theme_essential');
    $description = get_string('websitedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Facebook url setting.
    $name = 'theme_essential/facebook';
    $title = get_string('facebookurl', 'theme_essential');
    $description = get_string('facebookdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Flickr url setting.
    $name = 'theme_essential/flickr';
    $title = get_string('flickrurl', 'theme_essential');
    $description = get_string('flickrdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_essential/twitter';
    $title = get_string('twitterurl', 'theme_essential');
    $description = get_string('twitterdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Google+ url setting.
    $name = 'theme_essential/googleplus';
    $title = get_string('googleplusurl', 'theme_essential');
    $description = get_string('googleplusdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_essential/linkedin';
    $title = get_string('linkedinurl', 'theme_essential');
    $description = get_string('linkedindesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Pinterest url setting.
    $name = 'theme_essential/pinterest';
    $title = get_string('pinteresturl', 'theme_essential');
    $description = get_string('pinterestdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Instagram url setting.
    $name = 'theme_essential/instagram';
    $title = get_string('instagramurl', 'theme_essential');
    $description = get_string('instagramdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // YouTube url setting.
    $name = 'theme_essential/youtube';
    $title = get_string('youtubeurl', 'theme_essential');
    $description = get_string('youtubedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Skype url setting.
    $name = 'theme_essential/skype';
    $title = get_string('skypeuri', 'theme_essential');
    $description = get_string('skypedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // VKontakte url setting.
    $name = 'theme_essential/vk';
    $title = get_string('vkurl', 'theme_essential');
    $description = get_string('vkdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /* Apps Settings */
    $temp->add(new admin_setting_heading('theme_essential_mobileapps', get_string('mobileappsheadingsub', 'theme_essential'),
        format_text(get_string('mobileappsdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Android App url setting.
    $name = 'theme_essential/android';
    $title = get_string('androidurl', 'theme_essential');
    $description = get_string('androiddesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Windows App url setting.
    $name = 'theme_essential/windows';
    $title = get_string('windowsurl', 'theme_essential');
    $description = get_string('windowsdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Windows PhoneApp url setting.
    $name = 'theme_essential/winphone';
    $title = get_string('winphoneurl', 'theme_essential');
    $description = get_string('winphonedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // iOS App url setting.
    $name = 'theme_essential/ios';
    $title = get_string('iosurl', 'theme_essential');
    $description = get_string('iosdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for iOS Icons
    $name = 'theme_essential/iosiconinfo';
    $heading = get_string('iosicon', 'theme_essential');
    $information = get_string('iosicondesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // iPhone Icon.
    $name = 'theme_essential/iphoneicon';
    $title = get_string('iphoneicon', 'theme_essential');
    $description = get_string('iphoneicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // iPhone Retina Icon.
    $name = 'theme_essential/iphoneretinaicon';
    $title = get_string('iphoneretinaicon', 'theme_essential');
    $description = get_string('iphoneretinaicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // iPad Icon.
    $name = 'theme_essential/ipadicon';
    $title = get_string('ipadicon', 'theme_essential');
    $description = get_string('ipadicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // iPad Retina Icon.
    $name = 'theme_essential/ipadretinaicon';
    $title = get_string('ipadretinaicon', 'theme_essential');
    $description = get_string('ipadretinaicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_essential', $temp);


    /* Font Settings */
    $temp = new admin_settingpage('theme_essential_font', get_string('fontsettings', 'theme_essential'));
    // This is the descriptor for the font settings
    $name = 'theme_essential/fontheading';
    $heading = get_string('fontheadingsub', 'theme_essential');
    $information = get_string('fontheadingdesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Font Selector.
    $name = 'theme_essential/fontselect';
    $title = get_string('fontselect', 'theme_essential');
    $description = get_string('fontselectdesc', 'theme_essential');
    $default = 1;
    $choices = array(
        1 => get_string('fonttypestandard', 'theme_essential'),
        2 => get_string('fonttypegoogle', 'theme_essential'),
        3 => get_string('fonttypecustom', 'theme_essential'),
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Heading font name
    $name = 'theme_essential/fontnameheading';
    $title = get_string('fontnameheading', 'theme_essential');
    $description = get_string('fontnameheadingdesc', 'theme_essential');
    $default = 'Verdana';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Text font name
    $name = 'theme_essential/fontnamebody';
    $title = get_string('fontnamebody', 'theme_essential');
    $description = get_string('fontnamebodydesc', 'theme_essential');
    $default = 'Verdana';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    if(get_config('theme_essential', 'fontselect') === "2") {
        // Google Font Character Sets
        $name = 'theme_essential/fontcharacterset';
        $title = get_string('fontcharacterset', 'theme_essential');
        $description = get_string('fontcharactersetdesc', 'theme_essential');
        $default = 'latin-ext';
        $setting = new admin_setting_configmulticheckbox($name, $title, $description, $default, array(
            'latin-ext' => get_string('fontcharactersetlatinext', 'theme_essential'),
            'cyrillic' => get_string('fontcharactersetcyrillic', 'theme_essential'),
            'cyrillic-ext' => get_string('fontcharactersetcyrillicext', 'theme_essential'),
            'greek' => get_string('fontcharactersetgreek', 'theme_essential'),
            'greek-ext' => get_string('fontcharactersetgreekext', 'theme_essential'),
            'vietnamese' => get_string('fontcharactersetvietnamese', 'theme_essential'),
        ));
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

    } else if(get_config('theme_essential', 'fontselect') === "3") {

        if (floatval($CFG->version) >= 2014111005.01) { // 2.8.5+ (Build: 20150313) which has MDL-49074 integrated into it.
            $woff2 = true;
        } else {
            $woff2 = false;
        }

        // This is the descriptor for the font files
        $name = 'theme_essential/fontfiles';
        $heading = get_string('fontfiles', 'theme_essential');
        $information = get_string('fontfilesdesc', 'theme_essential');
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);

        // Heading Fonts.
        // TTF Font.
        $name = 'theme_essential/fontfilettfheading';
        $title = get_string('fontfilettfheading', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilettfheading');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // OTF Font.
        $name = 'theme_essential/fontfileotfheading';
        $title = get_string('fontfileotfheading', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfileotfheading');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // WOFF Font.
        $name = 'theme_essential/fontfilewoffheading';
        $title = get_string('fontfilewoffheading', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilewoffheading');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        if ($woff2) {
            // WOFF2 Font.
            $name = 'theme_essential/fontfilewofftwoheading';
            $title = get_string('fontfilewofftwoheading', 'theme_essential');
            $description = '';
            $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilewofftwoheading');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $temp->add($setting);
        }

        // EOT Font.
        $name = 'theme_essential/fontfileeotheading';
        $title = get_string('fontfileeotheading', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfileweotheading');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // SVG Font.
        $name = 'theme_essential/fontfilesvgheading';
        $title = get_string('fontfilesvgheading', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilesvgheading');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Body fonts.
        // TTF Font.
        $name = 'theme_essential/fontfilettfbody';
        $title = get_string('fontfilettfbody', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilettfbody');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // OTF Font.
        $name = 'theme_essential/fontfileotfbody';
        $title = get_string('fontfileotfbody', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfileotfbody');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // WOFF Font.
        $name = 'theme_essential/fontfilewoffbody';
        $title = get_string('fontfilewoffbody', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilewoffbody');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        if ($woff2) {
            // WOFF2 Font.
            $name = 'theme_essential/fontfilewofftwobody';
            $title = get_string('fontfilewofftwobody', 'theme_essential');
            $description = '';
            $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilewofftwobody');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $temp->add($setting);
        }

        // EOT Font.
        $name = 'theme_essential/fontfileeotbody';
        $title = get_string('fontfileeotbody', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfileweotbody');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // SVG Font.
        $name = 'theme_essential/fontfilesvgbody';
        $title = get_string('fontfilesvgbody', 'theme_essential');
        $description = '';
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'fontfilesvgbody');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    }

    // Include Awesome Font from Bootstrapcdn
    $name = 'theme_essential/bootstrapcdn';
    $title = get_string('bootstrapcdn', 'theme_essential');
    $description = get_string('bootstrapcdndesc', 'theme_essential');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_essential', $temp);


    /* Footer Settings */
    $temp = new admin_settingpage('theme_essential_footer', get_string('footerheading', 'theme_essential'));

    // Copyright setting.
    $name = 'theme_essential/copyright';
    $title = get_string('copyright', 'theme_essential');
    $description = get_string('copyrightdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // Footnote setting.
    $name = 'theme_essential/footnote';
    $title = get_string('footnote', 'theme_essential');
    $description = get_string('footnotedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Performance Information Display.
    $name = 'theme_essential/perfinfo';
    $title = get_string('perfinfo', 'theme_essential');
    $description = get_string('perfinfodesc', 'theme_essential');
    $perf_max = get_string('perf_max', 'theme_essential');
    $perf_min = get_string('perf_min', 'theme_essential');
    $default = 'min';
    $choices = array('min' => $perf_min, 'max' => $perf_max);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_essential', $temp);

    $temp = new admin_settingpage('theme_essential_frontpage', get_string('frontpageheading', 'theme_essential'));

    $name = 'theme_essential/courselistteachericon';
    $title = get_string('courselistteachericon', 'theme_essential');
    $description = get_string('courselistteachericondesc', 'theme_essential');
    $default = 'graduation-cap';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $temp->add(new admin_setting_heading('theme_essential_frontcontent', get_string('frontcontentheading', 'theme_essential'),
        ''));

    // Toggle Frontpage Content.
    $name = 'theme_essential/togglefrontcontent';
    $title = get_string('frontcontent', 'theme_essential');
    $description = get_string('frontcontentdesc', 'theme_essential');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 0;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Frontpage Content
    $name = 'theme_essential/frontcontentarea';
    $title = get_string('frontcontentarea', 'theme_essential');
    $description = get_string('frontcontentareadesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential_frontpageblocksheading';
    $heading = get_string('frontpageblocksheading', 'theme_essential');
    $information = '';
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Frontpage Block alignment.
    $name = 'theme_essential/frontpageblocks';
    $title = get_string('frontpageblocks', 'theme_essential');
    $description = get_string('frontpageblocksdesc', 'theme_essential');
    $left = get_string('left', 'theme_essential');
    $right = get_string('right', 'theme_essential');
    $default = 1;
    $choices = array(1 => $left, 0 => $right);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Toggle Frontpage Middle Blocks
    $name = 'theme_essential/frontpagemiddleblocks';
    $title = get_string('frontpagemiddleblocks', 'theme_essential');
    $description = get_string('frontpagemiddleblocksdesc', 'theme_essential');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 0;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    /* Marketing Spot Settings */
    $temp->add(new admin_setting_heading('theme_essential_marketing', get_string('marketingheadingsub', 'theme_essential'),
        format_text(get_string('marketingdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Toggle Marketing Spots.
    $name = 'theme_essential/togglemarketing';
    $title = get_string('togglemarketing', 'theme_essential');
    $description = get_string('togglemarketingdesc', 'theme_essential');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 1;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Marketing Spot Image Height.
    $name = 'theme_essential/marketingheight';
    $title = get_string('marketingheight', 'theme_essential');
    $description = get_string('marketingheightdesc', 'theme_essential');
    $default = 100;
    $choices = array(50 => '50', 100 => '100', 150 => '150', 200 => '200', 250 => '250', 300 => '300');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    // This is the descriptor for Marketing Spot One.
    $name = 'theme_essential/marketing1info';
    $heading = get_string('marketing1', 'theme_essential');
    $information = get_string('marketinginfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Marketing Spot One.
    $name = 'theme_essential/marketing1';
    $title = get_string('marketingtitle', 'theme_essential');
    $description = get_string('marketingtitledesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing1icon';
    $title = get_string('marketingicon', 'theme_essential');
    $description = get_string('marketingicondesc', 'theme_essential');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing1image';
    $title = get_string('marketingimage', 'theme_essential');
    $description = get_string('marketingimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing1content';
    $title = get_string('marketingcontent', 'theme_essential');
    $description = get_string('marketingcontentdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing1buttontext';
    $title = get_string('marketingbuttontext', 'theme_essential');
    $description = get_string('marketingbuttontextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing1buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_essential');
    $description = get_string('marketingbuttonurldesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing1target';
    $title = get_string('marketingurltarget', 'theme_essential');
    $description = get_string('marketingurltargetdesc', 'theme_essential');
    $target1 = get_string('marketingurltargetself', 'theme_essential');
    $target2 = get_string('marketingurltargetnew', 'theme_essential');
    $target3 = get_string('marketingurltargetparent', 'theme_essential');
    $default = '_blank';
    $choices = array('_self' => $target1, '_blank' => $target2, '_parent' => $target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for Marketing Spot Two.
    $name = 'theme_essential/marketing2info';
    $heading = get_string('marketing2', 'theme_essential');
    $information = get_string('marketinginfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Marketing Spot Two.
    $name = 'theme_essential/marketing2';
    $title = get_string('marketingtitle', 'theme_essential');
    $description = get_string('marketingtitledesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing2icon';
    $title = get_string('marketingicon', 'theme_essential');
    $description = get_string('marketingicondesc', 'theme_essential');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing2image';
    $title = get_string('marketingimage', 'theme_essential');
    $description = get_string('marketingimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing2content';
    $title = get_string('marketingcontent', 'theme_essential');
    $description = get_string('marketingcontentdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing2buttontext';
    $title = get_string('marketingbuttontext', 'theme_essential');
    $description = get_string('marketingbuttontextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing2buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_essential');
    $description = get_string('marketingbuttonurldesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing2target';
    $title = get_string('marketingurltarget', 'theme_essential');
    $description = get_string('marketingurltargetdesc', 'theme_essential');
    $target1 = get_string('marketingurltargetself', 'theme_essential');
    $target2 = get_string('marketingurltargetnew', 'theme_essential');
    $target3 = get_string('marketingurltargetparent', 'theme_essential');
    $default = '_blank';
    $choices = array('_self' => $target1, '_blank' => $target2, '_parent' => $target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for Marketing Spot Three
    $name = 'theme_essential/marketing3info';
    $heading = get_string('marketing3', 'theme_essential');
    $information = get_string('marketinginfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Marketing Spot Three.
    $name = 'theme_essential/marketing3';
    $title = get_string('marketingtitle', 'theme_essential');
    $description = get_string('marketingtitledesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing3icon';
    $title = get_string('marketingicon', 'theme_essential');
    $description = get_string('marketingicondesc', 'theme_essential');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing3image';
    $title = get_string('marketingimage', 'theme_essential');
    $description = get_string('marketingimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing3content';
    $title = get_string('marketingcontent', 'theme_essential');
    $description = get_string('marketingcontentdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing3buttontext';
    $title = get_string('marketingbuttontext', 'theme_essential');
    $description = get_string('marketingbuttontextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing3buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_essential');
    $description = get_string('marketingbuttonurldesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_essential/marketing3target';
    $title = get_string('marketingurltarget', 'theme_essential');
    $description = get_string('marketingurltargetdesc', 'theme_essential');
    $target1 = get_string('marketingurltargetself', 'theme_essential');
    $target2 = get_string('marketingurltargetnew', 'theme_essential');
    $target3 = get_string('marketingurltargetparent', 'theme_essential');
    $default = '_blank';
    $choices = array('_self' => $target1, '_blank' => $target2, '_parent' => $target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /* User Alerts */
    $temp->add(new admin_setting_heading('theme_essential_alerts', get_string('alertsheadingsub', 'theme_essential'),
        format_text(get_string('alertsdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    $information = get_string('alertinfodesc', 'theme_essential');

    // This is the descriptor for Alert One
    $name = 'theme_essential/alert1info';
    $heading = get_string('alert1', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Enable Alert
    $name = 'theme_essential/enable1alert';
    $title = get_string('enablealert', 'theme_essential');
    $description = get_string('enablealertdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Type.
    $name = 'theme_essential/alert1type';
    $title = get_string('alerttype', 'theme_essential');
    $description = get_string('alerttypedesc', 'theme_essential');
    $alert_info = get_string('alert_info', 'theme_essential');
    $alert_warning = get_string('alert_warning', 'theme_essential');
    $alert_general = get_string('alert_general', 'theme_essential');
    $default = 'info';
    $choices = array('info' => $alert_info, 'error' => $alert_warning, 'success' => $alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Title.
    $name = 'theme_essential/alert1title';
    $title = get_string('alerttitle', 'theme_essential');
    $description = get_string('alerttitledesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Text.
    $name = 'theme_essential/alert1text';
    $title = get_string('alerttext', 'theme_essential');
    $description = get_string('alerttextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for Alert Two
    $name = 'theme_essential/alert2info';
    $heading = get_string('alert2', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Enable Alert
    $name = 'theme_essential/enable2alert';
    $title = get_string('enablealert', 'theme_essential');
    $description = get_string('enablealertdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Type.
    $name = 'theme_essential/alert2type';
    $title = get_string('alerttype', 'theme_essential');
    $description = get_string('alerttypedesc', 'theme_essential');
    $alert_info = get_string('alert_info', 'theme_essential');
    $alert_warning = get_string('alert_warning', 'theme_essential');
    $alert_general = get_string('alert_general', 'theme_essential');
    $default = 'info';
    $choices = array('info' => $alert_info, 'error' => $alert_warning, 'success' => $alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Title.
    $name = 'theme_essential/alert2title';
    $title = get_string('alerttitle', 'theme_essential');
    $description = get_string('alerttitledesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Text.
    $name = 'theme_essential/alert2text';
    $title = get_string('alerttext', 'theme_essential');
    $description = get_string('alerttextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for Alert Three
    $name = 'theme_essential/alert3info';
    $heading = get_string('alert3', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Enable Alert
    $name = 'theme_essential/enable3alert';
    $title = get_string('enablealert', 'theme_essential');
    $description = get_string('enablealertdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Type.
    $name = 'theme_essential/alert3type';
    $title = get_string('alerttype', 'theme_essential');
    $description = get_string('alerttypedesc', 'theme_essential');
    $alert_info = get_string('alert_info', 'theme_essential');
    $alert_warning = get_string('alert_warning', 'theme_essential');
    $alert_general = get_string('alert_general', 'theme_essential');
    $default = 'info';
    $choices = array('info' => $alert_info, 'error' => $alert_warning, 'success' => $alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Title.
    $name = 'theme_essential/alert3title';
    $title = get_string('alerttitle', 'theme_essential');
    $description = get_string('alerttitledesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Alert Text.
    $name = 'theme_essential/alert3text';
    $title = get_string('alerttext', 'theme_essential');
    $description = get_string('alerttextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_essential', $temp);

    /* Slideshow Widget Settings */
    $temp = new admin_settingpage('theme_essential_slideshow', get_string('slideshowheading', 'theme_essential'));
    $temp->add(new admin_setting_heading('theme_essential_slideshow', get_string('slideshowheadingsub', 'theme_essential'),
        format_text(get_string('slideshowdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Toggle Slideshow.
    $name = 'theme_essential/toggleslideshow';
    $title = get_string('toggleslideshow', 'theme_essential');
    $description = get_string('toggleslideshowdesc', 'theme_essential');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 1;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Number of slides.
    $name = 'theme_essential/numberofslides';
    $title = get_string('numberofslides', 'theme_essential');
    $description = get_string('numberofslides_desc', 'theme_essential');
    $default = 4;
    $choices = array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
        13 => '13',
        14 => '14',
        15 => '15',
        16 => '16'
    );
    $temp->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Hide slideshow on phones.
    $name = 'theme_essential/hideontablet';
    $title = get_string('hideontablet', 'theme_essential');
    $description = get_string('hideontabletdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Hide slideshow on tablet.
    $name = 'theme_essential/hideonphone';
    $title = get_string('hideonphone', 'theme_essential');
    $description = get_string('hideonphonedesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide interval.
    $name = 'theme_essential/slideinterval';
    $title = get_string('slideinterval', 'theme_essential');
    $description = get_string('slideintervaldesc', 'theme_essential');
    $default = '5000';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide Text colour setting.
    $name = 'theme_essential/slidecolor';
    $title = get_string('slidecolor', 'theme_essential');
    $description = get_string('slidecolordesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Show caption options.
    $name = 'theme_essential/slidecaptionoptions';
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
    $temp->add($setting);

    // Show caption centred.
    $name = 'theme_essential/slidecaptioncentred';
    $title = get_string('slidecaptioncentred', 'theme_essential');
    $description = get_string('slidecaptioncentreddesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide button colour setting.
    $name = 'theme_essential/slidebuttoncolor';
    $title = get_string('slidebuttoncolor', 'theme_essential');
    $description = get_string('slidebuttoncolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide button hover colour setting.
    $name = 'theme_essential/slidebuttonhovercolor';
    $title = get_string('slidebuttonhovercolor', 'theme_essential');
    $description = get_string('slidebuttonhovercolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $numberofslides = get_config('theme_essential', 'numberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {
        // This is the descriptor for Slide One
        $name = 'theme_essential/slide' . $i . 'info';
        $heading = get_string('slideno', 'theme_essential', array('slide' => $i));
        $information = get_string('slidenodesc', 'theme_essential', array('slide' => $i));
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);

        // Title.
        $name = 'theme_essential/slide' . $i;
        $title = get_string('slidetitle', 'theme_essential');
        $description = get_string('slidetitledesc', 'theme_essential');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Image.
        $name = 'theme_essential/slide' . $i . 'image';
        $title = get_string('slideimage', 'theme_essential');
        $description = get_string('slideimagedesc', 'theme_essential');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide' . $i . 'image');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Caption text.
        $name = 'theme_essential/slide' . $i . 'caption';
        $title = get_string('slidecaption', 'theme_essential');
        $description = get_string('slidecaptiondesc', 'theme_essential');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // URL.
        $name = 'theme_essential/slide' . $i . 'url';
        $title = get_string('slideurl', 'theme_essential');
        $description = get_string('slideurldesc', 'theme_essential');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // URL target.
        $name = 'theme_essential/slide' . $i . 'target';
        $title = get_string('slideurltarget', 'theme_essential');
        $description = get_string('slideurltargetdesc', 'theme_essential');
        $target1 = get_string('slideurltargetself', 'theme_essential');
        $target2 = get_string('slideurltargetnew', 'theme_essential');
        $target3 = get_string('slideurltargetparent', 'theme_essential');
        $default = '_blank';
        $choices = array('_self' => $target1, '_blank' => $target2, '_parent' => $target3);
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    }

    $ADMIN->add('theme_essential', $temp);

    /* Category Settings */
    $temp = new admin_settingpage('theme_essential_categoryicon', get_string('categoryiconheading', 'theme_essential'));
    $temp->add(new admin_setting_heading('theme_essential_categoryicon', get_string('categoryiconheadingsub', 'theme_essential'),
        format_text(get_string('categoryicondesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Category Icons.
    $name = 'theme_essential/enablecategoryicon';
    $title = get_string('enablecategoryicon', 'theme_essential');
    $description = get_string('enablecategoryicondesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // We only want to output category icon options if the parent setting is enabled
    if (get_config('theme_essential', 'enablecategoryicon')) {

        // Default Icon Selector.
        $name = 'theme_essential/defaultcategoryicon';
        $title = get_string('defaultcategoryicon', 'theme_essential');
        $description = get_string('defaultcategoryicondesc', 'theme_essential');
        $default = 'folder-open';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Category Icons.
        $name = 'theme_essential/enablecustomcategoryicon';
        $title = get_string('enablecustomcategoryicon', 'theme_essential');
        $description = get_string('enablecustomcategoryicondesc', 'theme_essential');
        $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        if (get_config('theme_essential', 'enablecustomcategoryicon')) {

            // This is the descriptor for Custom Category Icons
            $name = 'theme_essential/categoryiconinfo';
            $heading = get_string('categoryiconinfo', 'theme_essential');
            $information = get_string('categoryiconinfodesc', 'theme_essential');
            $setting = new admin_setting_heading($name, $heading, $information);
            $temp->add($setting);

            // Get the default category icon.
            $defaultcategoryicon = get_config('theme_essential', 'defaultcategoryicon');
            if (empty($defaultcategoryicon)) {
                $defaultcategoryicon = 'folder-open';
            }

            // Get all category IDs and their pretty names
            require_once($CFG->libdir . '/coursecatlib.php');
            $coursecats = coursecat::make_categories_list();

            // Go through all categories and create the necessary settings
            foreach ($coursecats as $key => $value) {

                // Category Icons for each category.
                $name = 'theme_essential/categoryicon';
                $title = $value;
                $description = get_string('categoryiconcategory', 'theme_essential', array('category' => $value));
                $default = $defaultcategoryicon;
                $setting = new admin_setting_configtext($name . $key, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $temp->add($setting);
            }
            unset($coursecats);
        }
    }

    $ADMIN->add('theme_essential', $temp);

    /* Analytics Settings */
    $temp = new admin_settingpage('theme_essential_analytics', get_string('analytics', 'theme_essential'));
    $temp->add(new admin_setting_heading('theme_essential_analytics', get_string('analyticsheadingsub', 'theme_essential'),
        format_text(get_string('analyticsdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    $name = 'theme_essential/analyticsenabled';
    $title = get_string('analyticsenabled', 'theme_essential');
    $description = get_string('analyticsenableddesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $temp->add($setting);

    $name = 'theme_essential/analytics';
    $title = get_string('analytics', 'theme_essential');
    $description = get_string('analyticsdesc', 'theme_essential');
    $guniversal = get_string('analyticsguniversal', 'theme_essential');
    $piwik = get_string('analyticspiwik', 'theme_essential');
    $default = 'piwik';
    $choices = array(
        'piwik' => $piwik,
        'guniversal' => $guniversal,
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    if (get_config('theme_essential', 'analytics') === 'piwik') {
        $name = 'theme_essential/analyticssiteid';
        $title = get_string('analyticssiteid', 'theme_essential');
        $description = get_string('analyticssiteiddesc', 'theme_essential');
        $default = '1';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $temp->add($setting);

        $name = 'theme_essential/analyticsimagetrack';
        $title = get_string('analyticsimagetrack', 'theme_essential');
        $description = get_string('analyticsimagetrackdesc', 'theme_essential');
        $default = true;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $temp->add($setting);

        $name = 'theme_essential/analyticssiteurl';
        $title = get_string('analyticssiteurl', 'theme_essential');
        $description = get_string('analyticssiteurldesc', 'theme_essential');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $temp->add($setting);
    } else if (get_config('theme_essential', 'analytics') === 'guniversal') {
        $name = 'theme_essential/analyticstrackingid';
        $title = get_string('analyticstrackingid', 'theme_essential');
        $description = get_string('analyticstrackingiddesc', 'theme_essential');
        $default = 'UA-XXXXXXXX-X';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $temp->add($setting);
    }

    $name = 'theme_essential/analyticstrackadmin';
    $title = get_string('analyticstrackadmin', 'theme_essential');
    $description = get_string('analyticstrackadmindesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $temp->add($setting);

    $name = 'theme_essential/analyticscleanurl';
    $title = get_string('analyticscleanurl', 'theme_essential');
    $description = get_string('analyticscleanurldesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $temp->add($setting);

    $ADMIN->add('theme_essential', $temp);
}