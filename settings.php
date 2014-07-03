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
    
    // Include Awesome Font from Bootstrapcdn
    $name = 'theme_essential/bootstrapcdn';
    $title = get_string('bootstrapcdn', 'theme_essential');
    $description = get_string('bootstrapcdndesc', 'theme_essential');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
    // Logo file setting.
    $name = 'theme_essential/logo';
    $title = get_string('logo', 'theme_essential');
    $description = get_string('logodesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Font Selector.
    $name = 'theme_essential/fontselect';
    $title = get_string('fontselect' , 'theme_essential');
    $description = get_string('fontselectdesc', 'theme_essential');
    $default = '1';
    $choices = array(
    	'1'=>'Oswald & PT Sans', 
    	'2'=>'Lobster & Cabin', 
    	'3'=>'Raleway & Goudy', 
    	'4'=>'Allerta & Crimson Text', 
    	'5'=>'Arvo & PT Sans',
    	'6'=>'Dancing Script & Josefin Sans',
    	'7'=>'Allan & Cardo',
    	'8'=>'Molengo & Lekton',
    	'9'=>'Droid Serif & Droid Sans',
    	'10'=>'Corbin & Nobile',
    	'11'=>'Ubuntu & Vollkorn',
    	'12'=>'Bree Serif & Open Sans', 
    	'13'=>'Bevan & Pontano Sans', 
    	'14'=>'Abril Fatface & Average', 
    	'15'=>'Playfair Display and Muli', 
    	'16'=>'Sansita One & Kameron',
    	'17'=>'Istok Web & Lora',
    	'18'=>'Pacifico & Arimo',
    	'19'=>'Nixie One & Ledger',
    	'20'=>'Cantata One & Imprima',
    	'21'=>'Rancho & Gudea',
    	'22'=>'DISABLE Google Fonts');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
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
    
    //Include the Editicons css rules
    $name = 'theme_essential/editicons';
    $title = get_string('editicons', 'theme_essential');
    $description = get_string('editiconsdesc', 'theme_essential');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $temp->add($setting);
    
    //Include the Autohide css rules
    $name = 'theme_essential/autohide';
    $visiblename = get_string('autohide', 'theme_essential');
    $title = get_string('autohide', 'theme_essential');
    $description = get_string('autohidedesc', 'theme_essential');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 0);
    $temp->add($setting);
    
    // Performance Information Display.
    $name = 'theme_essential/perfinfo';
    $title = get_string('perfinfo' , 'theme_essential');
    $description = get_string('perfinfodesc', 'theme_essential');
    $perf_max = get_string('perf_max', 'theme_essential');
    $perf_min = get_string('perf_min', 'theme_essential');
    $default = 'min';
    $choices = array('min'=>$perf_min, 'max'=>$perf_max);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
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
    
    /* Custom Menu Settings */
    $temp = new admin_settingpage('theme_essential_custommenu', get_string('custommenuheading', 'theme_essential'));
	            
    //This is the descriptor for the following Moodle color settings
    $name = 'theme_essential/mydashboardinfo';
    $heading = get_string('mydashboardinfo', 'theme_essential');
    $information = get_string('mydashboardinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Toggle dashboard display in custommenu.
    $name = 'theme_essential/displaymydashboard';
    $title = get_string('displaymydashboard', 'theme_essential');
    $description = get_string('displaymydashboarddesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //This is the descriptor for the following Moodle color settings
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
	$title = get_string('mycoursetitle','theme_essential');
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
    
    $ADMIN->add('theme_essential', $temp);
    
	/* Color Settings */
    $temp = new admin_settingpage('theme_essential_color', get_string('colorheading', 'theme_essential'));
    $temp->add(new admin_setting_heading('theme_essential_color', get_string('colorheadingsub', 'theme_essential'),
            format_text(get_string('colordesc' , 'theme_essential'), FORMAT_MARKDOWN)));

    // Background Image.
    $name = 'theme_essential/pagebackground';
    $title = get_string('pagebackground', 'theme_essential');
    $description = get_string('pagebackgrounddesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'pagebackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Main theme colour setting.
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
    
    // Footer background colour setting.
    $name = 'theme_essential/footercolor';
    $title = get_string('footercolor', 'theme_essential');
    $description = get_string('footercolordesc', 'theme_essential');
    $default = '#000000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer text colour setting.
    $name = 'theme_essential/footertextcolor';
    $title = get_string('footertextcolor', 'theme_essential');
    $description = get_string('footertextcolordesc', 'theme_essential');
    $default = '#DDDDDD';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer Block Heading colour setting.
    $name = 'theme_essential/footerheadingcolor';
    $title = get_string('footerheadingcolor', 'theme_essential');
    $description = get_string('footerheadingcolordesc', 'theme_essential');
    $default = '#CCCCCC';
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
    $default = '#BBBBBB';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer URL hover colour setting.
    $name = 'theme_essential/footerhovercolor';
    $title = get_string('footerhovercolor', 'theme_essential');
    $description = get_string('footerhovercolordesc', 'theme_essential');
    $default = '#FFFFFF';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);



 	$ADMIN->add('theme_essential', $temp);
 
 
    /* Slideshow Widget Settings */
    $temp = new admin_settingpage('theme_essential_slideshow', get_string('slideshowheading', 'theme_essential'));
    $temp->add(new admin_setting_heading('theme_essential_slideshow', get_string('slideshowheadingsub', 'theme_essential'),
            format_text(get_string('slideshowdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
    
    // Toggle Slideshow.
    $name = 'theme_essential/toggleslideshow';
    $title = get_string('toggleslideshow' , 'theme_essential');
    $description = get_string('toggleslideshowdesc', 'theme_essential');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 'alwaysdisplay';
    $choices = array('1'=>$alwaysdisplay, '2'=>$displaybeforelogin, '3'=>$displayafterlogin, '0'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Hide slideshow on phones.
    $name = 'theme_essential/hideonphone';
    $title = get_string('hideonphone' , 'theme_essential');
    $description = get_string('hideonphonedesc', 'theme_essential');
    $display = get_string('alwaysdisplay', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 'display';
    $choices = array(''=>$display, 'hidden-phone'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 1
     */
     
    //This is the descriptor for Slide One
    $name = 'theme_essential/slide1info';
    $heading = get_string('slide1', 'theme_essential');
    $information = get_string('slideinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Title.
    $name = 'theme_essential/slide1';
    $title = get_string('slidetitle', 'theme_essential');
    $description = get_string('slidetitledesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide1image';
    $title = get_string('slideimage', 'theme_essential');
    $description = get_string('slideimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide1caption';
    $title = get_string('slidecaption', 'theme_essential');
    $description = get_string('slidecaptiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide1url';
    $title = get_string('slideurl', 'theme_essential');
    $description = get_string('slideurldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 2
     */
     
    //This is the descriptor for Slide Two
    $name = 'theme_essential/slide2info';
    $heading = get_string('slide2', 'theme_essential');
    $information = get_string('slideinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Title.
    $name = 'theme_essential/slide2';
    $title = get_string('slidetitle', 'theme_essential');
    $description = get_string('slidetitledesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide2image';
    $title = get_string('slideimage', 'theme_essential');
    $description = get_string('slideimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide2caption';
    $title = get_string('slidecaption', 'theme_essential');
    $description = get_string('slidecaptiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide2url';
    $title = get_string('slideurl', 'theme_essential');
    $description = get_string('slideurldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 3
     */

    //This is the descriptor for Slide Three
    $name = 'theme_essential/slide3info';
    $heading = get_string('slide3', 'theme_essential');
    $information = get_string('slideinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Title.
    $name = 'theme_essential/slide3';
    $title = get_string('slidetitle', 'theme_essential');
    $description = get_string('slidetitledesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide3image';
    $title = get_string('slideimage', 'theme_essential');
    $description = get_string('slideimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide3caption';
    $title = get_string('slidecaption', 'theme_essential');
    $description = get_string('slidecaptiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide3url';
    $title = get_string('slideurl', 'theme_essential');
    $description = get_string('slideurldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 4
     */
     
    //This is the descriptor for Slide Four
    $name = 'theme_essential/slide4info';
    $heading = get_string('slide4', 'theme_essential');
    $information = get_string('slideinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Title.
    $name = 'theme_essential/slide4';
    $title = get_string('slidetitle', 'theme_essential');
    $description = get_string('slidetitledesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_essential/slide4image';
    $title = get_string('slideimage', 'theme_essential');
    $description = get_string('slideimagedesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_essential/slide4caption';
    $title = get_string('slidecaption', 'theme_essential');
    $description = get_string('slidecaptiondesc', 'theme_essential');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_essential/slide4url';
    $title = get_string('slideurl', 'theme_essential');
    $description = get_string('slideurldesc', 'theme_essential');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $ADMIN->add('theme_essential', $temp);
    
    $temp = new admin_settingpage('theme_essential_frontcontent', get_string('frontcontentheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_frontcontent', get_string('frontcontentheadingsub', 'theme_essential'),
            format_text(get_string('frontcontentdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
    
    // Enable Frontpage Content
    $name = 'theme_essential/usefrontcontent';
    $title = get_string('usefrontcontent', 'theme_essential');
    $description = get_string('usefrontcontentdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
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
        
    $ADMIN->add('theme_essential', $temp);
    

	/* Marketing Spot Settings */
	$temp = new admin_settingpage('theme_essential_marketing', get_string('marketingheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_marketing', get_string('marketingheadingsub', 'theme_essential'),
            format_text(get_string('marketingdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
	
	// Toggle Marketing Spots.
    $name = 'theme_essential/togglemarketing';
    $title = get_string('togglemarketing' , 'theme_essential');
    $description = get_string('togglemarketingdesc', 'theme_essential');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential');
    $dontdisplay = get_string('dontdisplay', 'theme_essential');
    $default = 'display';
    $choices = array('1'=>$alwaysdisplay, '2'=>$displaybeforelogin, '3'=>$displayafterlogin, '0'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Marketing Spot Image Height
	$name = 'theme_essential/marketingheight';
	$title = get_string('marketingheight','theme_essential');
	$description = get_string('marketingheightdesc', 'theme_essential');
	$default = 100;
	$choices = array(50, 100, 150, 200, 250, 300);
	$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
	$temp->add($setting);
	
	//This is the descriptor for Marketing Spot One
    $name = 'theme_essential/marketing1info';
    $heading = get_string('marketing1', 'theme_essential');
    $information = get_string('marketinginfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
	
	//Marketing Spot One.
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
    
    //This is the descriptor for Marketing Spot Two
    $name = 'theme_essential/marketing2info';
    $heading = get_string('marketing2', 'theme_essential');
    $information = get_string('marketinginfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    //Marketing Spot Two.
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
    
    //This is the descriptor for Marketing Spot Three
    $name = 'theme_essential/marketing3info';
    $heading = get_string('marketing3', 'theme_essential');
    $information = get_string('marketinginfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    //Marketing Spot Three.
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
    
    
    $ADMIN->add('theme_essential', $temp);

	
	/* Social Network Settings */
	$temp = new admin_settingpage('theme_essential_social', get_string('socialheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_social', get_string('socialheadingsub', 'theme_essential'),
            format_text(get_string('socialdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
	
    // Website url setting.
    $name = 'theme_essential/website';
    $title = get_string('website', 'theme_essential');
    $description = get_string('websitedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Facebook url setting.
    $name = 'theme_essential/facebook';
    $title = get_string('facebook', 'theme_essential');
    $description = get_string('facebookdesc', 'theme_essential');
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
    
    // Pinterest url setting.
    $name = 'theme_essential/pinterest';
    $title = get_string('pinterest', 'theme_essential');
    $description = get_string('pinterestdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Instagram url setting.
    $name = 'theme_essential/instagram';
    $title = get_string('instagram', 'theme_essential');
    $description = get_string('instagramdesc', 'theme_essential');
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
    
    // Skype url setting.
    $name = 'theme_essential/skype';
    $title = get_string('skype', 'theme_essential');
    $description = get_string('skypedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
 
    // VKontakte url setting.
    $name = 'theme_essential/vk';
    $title = get_string('vk', 'theme_essential');
    $description = get_string('vkdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting); 
    
    $ADMIN->add('theme_essential', $temp);
    
    $temp = new admin_settingpage('theme_essential_mobileapps', get_string('mobileappsheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_mobileapps', get_string('mobileappsheadingsub', 'theme_essential'),
            format_text(get_string('mobileappsdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
    // Android App url setting.
    $name = 'theme_essential/android';
    $title = get_string('android', 'theme_essential');
    $description = get_string('androiddesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iOS App url setting.
    $name = 'theme_essential/ios';
    $title = get_string('ios', 'theme_essential');
    $description = get_string('iosdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //This is the descriptor for iOS Icons
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
    
    /* User Alerts */
    $temp = new admin_settingpage('theme_essential_alerts', get_string('alertsheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_alerts', get_string('alertsheadingsub', 'theme_essential'),
            format_text(get_string('alertsdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
    
    //This is the descriptor for Alert One
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
    $title = get_string('alerttype' , 'theme_essential');
    $description = get_string('alerttypedesc', 'theme_essential');
    $alert_info = get_string('alert_info', 'theme_essential');
    $alert_warning = get_string('alert_warning', 'theme_essential');
    $alert_general = get_string('alert_general', 'theme_essential');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
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
    
    //This is the descriptor for Alert Two
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
    $title = get_string('alerttype' , 'theme_essential');
    $description = get_string('alerttypedesc', 'theme_essential');
    $alert_info = get_string('alert_info', 'theme_essential');
    $alert_warning = get_string('alert_warning', 'theme_essential');
    $alert_general = get_string('alert_general', 'theme_essential');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
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
    
    //This is the descriptor for Alert Three
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
    $title = get_string('alerttype' , 'theme_essential');
    $description = get_string('alerttypedesc', 'theme_essential');
    $alert_info = get_string('alert_info', 'theme_essential');
    $alert_warning = get_string('alert_warning', 'theme_essential');
    $alert_general = get_string('alert_general', 'theme_essential');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
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
    
    /* Analytics Settings */
    $temp = new admin_settingpage('theme_essential_analytics', get_string('analyticsheading', 'theme_essential'));
	$temp->add(new admin_setting_heading('theme_essential_analytics', get_string('analyticsheadingsub', 'theme_essential'),
            format_text(get_string('analyticsdesc' , 'theme_essential'), FORMAT_MARKDOWN)));
    
    // Enable Analytics
    $name = 'theme_essential/useanalytics';
    $title = get_string('useanalytics', 'theme_essential');
    $description = get_string('useanalyticsdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Google Analytics ID
    $name = 'theme_essential/analyticsid';
    $title = get_string('analyticsid', 'theme_essential');
    $description = get_string('analyticsiddesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Clean Analytics URL
    $name = 'theme_essential/analyticsclean';
    $title = get_string('analyticsclean', 'theme_essential');
    $description = get_string('analyticscleandesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
        
    $ADMIN->add('theme_essential', $temp);

