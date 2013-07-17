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
$settings = null;

defined('MOODLE_INTERNAL') || die;


	$ADMIN->add('themes', new admin_category('theme_essential', 'Essential'));

	// "geneicsettings" settingpage
	$temp = new admin_settingpage('theme_essential_generic',  get_string('geneicsettings', 'theme_essential'));
	
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
    
    // User picture in header setting.
    $name = 'theme_essential/headerprofilepic';
    $title = get_string('headerprofilepic', 'theme_essential');
    $description = get_string('headerprofilepicdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
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
    
    // Navbar Seperator.
    $name = 'theme_essential/navbarsep';
    $title = get_string('navbarsep' , 'theme_essential');
    $description = get_string('navbarsepdesc', 'theme_essential');
    $nav_thinbracket = get_string('nav_thinbracket', 'theme_essential');
    $nav_doublebracket = get_string('nav_doublebracket', 'theme_essential');
    $nav_thickbracket = get_string('nav_thickbracket', 'theme_essential');
    $nav_slash = get_string('nav_slash', 'theme_essential');
    $nav_pipe = get_string('nav_pipe', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = '/';
    $choices = array('/'=>$nav_slash, '\f105'=>$nav_thinbracket, '\f101'=>$nav_doublebracket, '\f054'=>$nav_thickbracket, '|'=>$nav_pipe);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme background colour setting.
    $name = 'theme_essential/themecolor';
    $title = get_string('themecolor', 'theme_essential');
    $description = get_string('themecolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme Hover colour setting.
    $name = 'theme_essential/themehovercolor';
    $title = get_string('themehovercolor', 'theme_essential');
    $description = get_string('themehovercolordesc', 'theme_essential');
    $default = '#29a1c4';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

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
    
    // Custom CSS file.
    $name = 'theme_essential/customcss';
    $title = get_string('customcss', 'theme_essential');
    $description = get_string('customcssdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

 	$ADMIN->add('theme_essential', $temp);
 
 
    /* Slideshow Widget Settings */
    $temp = new admin_settingpage('theme_essential_slideshow', get_string('slideshowheading', 'theme_essential'));
    $temp->add(new admin_setting_heading('theme_essential_slideshow', get_string('slideshowheadingsub', 'theme_essential'),
            format_text(get_string('slideshowdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
    
    
    // Hide slideshow on phones.
    $name = 'theme_essential/hideonphone';
    $title = get_string('hideonphone' , 'theme_essential');
    $description = get_string('hideonphonedesc', 'theme_essential');
    $display = get_string('display', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 'display';
    $choices = array(''=>$display, 'hidden-phone'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 1
     */

    // Title.
    $name = 'theme_essential/slide1';
    $title = get_string('slide1', 'theme_essential');
    $description = get_string('slide1desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide1image';
    $title = get_string('slide1image', 'theme_essential');
    $description = get_string('slide1imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide1caption';
    $title = get_string('slide1caption', 'theme_essential');
    $description = get_string('slide1captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide1url';
    $title = get_string('slide1url', 'theme_essential');
    $description = get_string('slide1urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 2
     */

    // Title.
    $name = 'theme_essential/slide2';
    $title = get_string('slide2', 'theme_essential');
    $description = get_string('slide2desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide2image';
    $title = get_string('slide2image', 'theme_essential');
    $description = get_string('slide2imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide2caption';
    $title = get_string('slide2caption', 'theme_essential');
    $description = get_string('slide2captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide2url';
    $title = get_string('slide2url', 'theme_essential');
    $description = get_string('slide2urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 3
     */

    // Title.
    $name = 'theme_essential/slide3';
    $title = get_string('slide3', 'theme_essential');
    $description = get_string('slide3desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide3image';
    $title = get_string('slide3image', 'theme_essential');
    $description = get_string('slide3imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide3caption';
    $title = get_string('slide3caption', 'theme_essential');
    $description = get_string('slide3captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide3url';
    $title = get_string('slide3url', 'theme_essential');
    $description = get_string('slide3urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 4
     */

    // Title.
    $name = 'theme_essential/slide4';
    $title = get_string('slide4', 'theme_essential');
    $description = get_string('slide4desc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide4image';
    $title = get_string('slide4image', 'theme_essential');
    $description = get_string('slide4imagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide4caption';
    $title = get_string('slide4caption', 'theme_essential');
    $description = get_string('slide4captiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide4url';
    $title = get_string('slide4url', 'theme_essential');
    $description = get_string('slide4urldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $ADMIN->add('theme_essential', $temp);
    

	/* Marketing Spot Settings */
	$temp = new admin_settingpage('theme_essential_marketing', get_string('marketingheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_marketing', get_string('marketingheadingsub', 'theme_essential'),
            format_text(get_string('marketingdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
	
	// Toggle Marketing Spots.
    $name = 'theme_essential/togglemarketing';
    $title = get_string('togglemarketing' , 'theme_essential');
    $description = get_string('togglemarketingdesc', 'theme_essential');
    $display = get_string('display', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 'display';
    $choices = array('1'=>$display, '0'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	//Marketing Spot One.
	$name = 'theme_essential/marketing1';
    $title = get_string('marketing1', 'theme_essential');
    $description = get_string('marketing1desc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing1icon';
    $title = get_string('marketing1icon', 'theme_essential');
    $description = get_string('marketing1icondesc', 'theme_essential');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing1content';
    $title = get_string('marketing1content', 'theme_essential');
    $description = get_string('marketing1contentdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing1buttontext';
    $title = get_string('marketing1buttontext', 'theme_essential');
    $description = get_string('marketing1buttontextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing1buttonurl';
    $title = get_string('marketing1buttonurl', 'theme_essential');
    $description = get_string('marketing1buttonurldesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //Marketing Spot Two.
	$name = 'theme_essential/marketing2';
    $title = get_string('marketing2', 'theme_essential');
    $description = get_string('marketing2desc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing2icon';
    $title = get_string('marketing2icon', 'theme_essential');
    $description = get_string('marketing2icondesc', 'theme_essential');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing2content';
    $title = get_string('marketing2content', 'theme_essential');
    $description = get_string('marketing2contentdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing2buttontext';
    $title = get_string('marketing2buttontext', 'theme_essential');
    $description = get_string('marketing2buttontextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing2buttonurl';
    $title = get_string('marketing2buttonurl', 'theme_essential');
    $description = get_string('marketing2buttonurldesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //Marketing Spot Three.
	$name = 'theme_essential/marketing3';
    $title = get_string('marketing3', 'theme_essential');
    $description = get_string('marketing3desc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing3icon';
    $title = get_string('marketing3icon', 'theme_essential');
    $description = get_string('marketing3icondesc', 'theme_essential');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing3content';
    $title = get_string('marketing3content', 'theme_essential');
    $description = get_string('marketing3contentdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing3buttontext';
    $title = get_string('marketing3buttontext', 'theme_essential');
    $description = get_string('marketing3buttontextdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential/marketing3buttonurl';
    $title = get_string('marketing3buttonurl', 'theme_essential');
    $description = get_string('marketing3buttonurldesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $ADMIN->add('theme_essential', $temp);

	
	/* Social Network Settings */
	$temp = new admin_settingpage('theme_essential_social', get_string('socialheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_social', get_string('socialheadingsub', 'theme_essential'),
            format_text(get_string('socialdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
	
    // Facebook url setting.
    $name = 'theme_essential/facebook';
    $title = get_string('facebook', 'theme_essential');
    $description = get_string('facebookdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_essential/twitter';
    $title = get_string('twitter', 'theme_essential');
    $description = get_string('twitterdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Google+ url setting.
    $name = 'theme_essential/googleplus';
    $title = get_string('googleplus', 'theme_essential');
    $description = get_string('googleplusdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_essential/linkedin';
    $title = get_string('linkedin', 'theme_essential');
    $description = get_string('linkedindesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // YouTube url setting.
    $name = 'theme_essential/youtube';
    $title = get_string('youtube', 'theme_essential');
    $description = get_string('youtubedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Flickr url setting.
    $name = 'theme_essential/flickr';
    $title = get_string('flickr', 'theme_essential');
    $description = get_string('flickrdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $ADMIN->add('theme_essential', $temp);

