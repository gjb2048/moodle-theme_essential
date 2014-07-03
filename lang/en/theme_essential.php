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

/* Core */
$string['configtitle'] = 'Essential';
$string['pluginname'] = 'Essential';
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>Essential</h2>
<p><img class=img-polaroid src="essential/pix/screenshot.jpg" /></p>
</div>
<div class="well">
<h3>About Essential</h3>
<p>Essential is a modified Moodle bootstrap theme which inherits styles and renderers from its parent theme.</p>
<h3>Parents</h3>
<p>This theme is based upon the Bootstrap theme, which was created for Moodle 2.5, with the help of:<br>
Stuart Lamour, Mark Aberdour, Paul Hibbitts, Mary Evans.</p>
<h3>Theme Credits</h3>
<p>Authors: Julian Ridden<br>
Contact: julian@moodleman.net<br>
Website: <a href="http://www.moodleman.net">www.moodleman.net</a>
</p>
</div></div>';

/* General */
$string['geneicsettings'] = 'General Settings';
$string['autohide'] = 'Include Autohide Functionality';
$string['autohidedesc'] = 'The Autohide functionality is designed to make Moodle less intimidating.  When editing is turned on edit icons only appear when the item is hovered over.';
$string['editicons'] = 'Edit Icons V2';
$string['editiconsdesc'] = 'This utilises the Font Awesome to display coloured and neater formatted edit icons in course pages and blocks.  Please note that currsently this is NOT compatible with Autohide.';
$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Whatever CSS rules you add to this textarea will be reflected in every page, making for easier customization of this theme.';
$string['footnote'] = 'Footnote';
$string['footnotedesc'] = 'Whatever you add to this textarea will be displayed in the footer throughout your Moodle site.';
$string['invert'] = 'Invert navbar';
$string['invertdesc'] = 'Swaps text and background for the navbar at the top of the page between black and white.';
$string['logo'] = 'Logo';
$string['logodesc'] = 'Please upload your custom logo here if you want to add it to the header.<br>If you upload a logo it will replace the standard icon and name that was displayed by default.';
$string['fontselect'] = 'Font Selector';
$string['fontselectdesc'] = 'Choose from the list of availble font combinations. You can choose here to disable Google fonts if needed.';
$string['bootstrapcdn'] = 'FontAwesome from CDN';
$string['bootstrapcdndesc'] = 'If enabled this will load FontAwesome from the online Bootstrap CDN source. Enable this if you are having issues getting the Font Awesome icons to display in your site.';
$string['copyright'] = 'Copyright';
$string['copyrightdesc'] = 'The name of your organisation.';
$string['profilebarcustomtitle'] = 'Profile Bar Custom Block Title';
$string['profilebarcustomtitledesc'] = 'Title for custom Profile Bar block.';
$string['contactinfo'] = 'Contact Information';
$string['contactinfodesc'] = 'Enter your contact information';
$string['siteicon'] = 'Site Icon';
$string['siteicondesc'] = 'Do not have a logo? Enter the name of the icon you wish to use. List is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>. Just enter what is after the "icon-". ';
$string['yourprofile'] = 'You';
$string['headerprofilepic'] = 'Display user\'s picture';
$string['headerprofilepicdesc'] = 'If checked, displays the user\'s profile picture in the header of the page.';
$string['layout'] = 'Use a standard course layout';
$string['layoutdesc'] = 'This theme is designed to put both block columns on the side.  If you prefer the standard Moodle course layout you can check this box and be returned to the boring old three column layout.';
$string['perfinfo'] = 'Performance Info Mode';
$string['perfinfodesc'] = 'Many sites don\'t need the fully detailed performance info.  Especially when viewed by users.  When enabled, this shows a cleaned up miniminal form with basic page load information.';
$string['perf_max'] = 'Detailed';
$string['perf_min'] = 'Minimal';
$string['visibleadminonly'] = 'Blocks moved into the area below will only be seen by admins';
$string['backtotop'] = 'Back to top';

$string['alwaysdisplay'] = 'Always Show';
$string['displaybeforelogin'] = 'Show before login only';
$string['displayafterlogin'] = 'Show after login only';
$string['dontdisplay'] = 'Never Show';

/* CustomMenu */
$string['custommenuheading'] = 'Custom Menu';
$string['custommenuheadingsub'] = 'Add additional functionality to your custommenu.';
$string['custommenudesc'] = 'Settings here allow you to add new dynamic functionality to the custommenu (also refered to as Dropdown menu)';

$string['mydashboardinfo'] = 'Custom User Dashboard';
$string['mydashboardinfodesc'] = 'Displays a list of common functions used by users.';
$string['displaymydashboard'] = 'Display Dashboard';
$string['displaymydashboarddesc'] = 'Display Dashboard of user links in the Custom Menu';

$string['mycoursesinfo'] = 'Dynamic Enrolled Courses List';
$string['mycoursesinfodesc'] = 'Displays a dynamic list of enrolled courses to the user.';
$string['displaymycourses'] = 'Display enrolled courses';
$string['displaymycoursesdesc'] = 'Display enrolled courses for users in the Custom Menu';

$string['mycoursetitle'] = 'Terminology';
$string['mycoursetitledesc'] = 'Change the terminology for the "My Courses" link in the dropdown menu';
$string['mycourses'] = 'My Courses';
$string['myunits'] = 'My Units';
$string['mymodules'] = 'My Modules';
$string['myclasses'] = 'My Classes';
$string['allcourses'] = 'All Courses';
$string['allunits'] = 'All Units';
$string['allmodules'] = 'All Modules';
$string['allclasses'] = 'All Classes';
$string['noenrolments'] = 'You have no current enrolments';

/* My Dashboard custommenu dropdown */
$string['mydashboard'] = 'My Dashboard';

/* Navbar Seperator */
$string['navbarsep'] = 'Navbar Separator';
$string['navbarsepdesc'] = 'Here you can change the type of separator displayed in the navbar/breadcrumb';
$string['nav_thinbracket'] = 'Thin bracket';
$string['nav_doublebracket'] = 'Double thin bracket';
$string['nav_thickbracket'] = 'Thick Bracket';
$string['nav_slash'] = 'Forward slash';
$string['nav_pipe'] = 'Verticle line';

/* Regions */
$string['region-side-post'] = 'Right';
$string['region-side-pre'] = 'Left';
$string['region-footer-left'] = 'Footer (Left)';
$string['region-footer-middle'] = 'Footer (Middle)';
$string['region-footer-right'] = 'Footer (Right)';
$string['region-hidden-dock'] = 'Hidden from users';

/* Colours */
$string['colorheading'] = 'Colour Settings';
$string['colorheadingsub'] = 'Set the colours used in your theme';
$string['colordesc'] = 'Here you can find various settings to change many of the colours found in this theme.';

$string['themecolor'] = 'Theme Colour';
$string['themecolordesc'] = 'What colour should your theme be.  This will change mulitple components to produce the colour you wish across the moodle site';
$string['themehovercolor'] = 'Theme Hover Colour';
$string['themehovercolordesc'] = 'What colour should your theme hovers be. This is used for links, menus, etc';
$string['footercolor'] = 'Footer Background Colour';
$string['footercolordesc'] = 'Set what colour the background of the Footer box should be.';
$string['footersepcolor'] = 'Footer Seperator Colour';
$string['footersepcolordesc'] = 'Seperators are lines used to seperate content.  Set their colour here.';
$string['footertextcolor'] = 'Footer Text Colour';
$string['footertextcolordesc'] = 'Set the colour you want your text to be in the footer.';
$string['footerurlcolor'] = 'Footer Link Colour';
$string['footerurlcolordesc'] = 'Set the colour for your linked text in the footer.';
$string['footerhovercolor'] = 'Footer Link Hover Colour';
$string['footerhovercolordesc'] = 'Set the colour for your linked text when hovered over in the footer.';
$string['footerheadingcolor'] = 'Footer Heading Colour';
$string['footerheadingcolordesc'] = 'Set the colour for block headings in the footer.';
$string['pagebackground'] = 'Page Background Image';
$string['pagebackgrounddesc'] = 'Upload your own background image.  This will be tiled in the background on all pages.  If none is uploaded a default image is used.';

/* Frontpage Content */
$string['frontcontentheading'] = 'Frontpage Content';
$string['frontcontentheadingsub'] = 'Add information to your frontpage for users';
$string['frontcontentdesc'] = 'This adds a custom content area inbetween the Slideshow and the Marketing boxes for your own custom content';

$string['usefrontcontent'] = 'Enable Frontpage content';
$string['usefrontcontentdesc'] = 'If enabled this will display the content of the box below inbetween the Slideshow and the Marketing spots.';

$string['frontcontentarea'] = 'Frontpage Content';
$string['frontcontentareadesc'] = 'Whatever is typed into this box will display across the full width of the page inbetween the Slideshow and the Marketing spots ';

/* Slideshow */
$string['slideshowheading'] = 'Frontpage Slideshow';
$string['slideshowheadingsub'] = 'Dynamic Slideshow for the frontpage';
$string['slideshowdesc'] = 'This creates a dynamic slideshow of up to 4 slides for you to promote important elements of your site.';

$string['toggleslideshow'] = 'Toggle Slideshow display';
$string['toggleslideshowdesc'] = 'Choose if you wish to hide or show the Slideshow.';

$string['hideonphone'] = 'Slideshow on Mobiles';
$string['hideonphonedesc'] = 'Choose if you wish to have the slideshow shown on mobiles or not';
$string['readmore'] = 'Read More';

$string['slideshowTitle'] = 'Slideshow';
$string['slideinfodesc'] = 'Enter the settings for your slide.';
$string['slide1'] = 'Slide One';
$string['slide2'] = 'Slide Two';
$string['slide3'] = 'Slide Three';
$string['slide4'] = 'Slide Four';

$string['slidetitle'] = 'Slide Title';
$string['slidetitledesc'] = 'Enter a descriptive title for your slide';
$string['slideimage'] = 'Slide Image';
$string['slideimagedesc'] = 'Image works best if it is transparent. (Image size should be 256px x 256px)';
$string['slidecaption'] = 'Slide Caption';
$string['slidecaptiondesc'] = 'Enter the caption text to use for the first slide';
$string['slideurl'] = 'Slide Link';
$string['slideurldesc'] = 'Enter the target destination of the first slide\'s image link';

/* Marketing Spots */
$string['marketingheading'] = 'Marketing Spots';
$string['marketinginfodesc'] = 'Enter the settings for your marketing spot.';
$string['marketingheadingsub'] = 'Three locations on the front page to add information and links';
$string['marketingheight'] = 'Height of Marketing Images';
$string['marketingheightdesc'] = 'If you want to display images in the Marketing boxes you can specify their hight here.';
$string['marketingdesc'] = 'This theme provides the option of enabling three "marketing" or "ad" spots just under the slideshow.  These allow you to easily identify core information to your users and provide direct links.';

$string['togglemarketing'] = 'Toggle Marketing Spot display';
$string['togglemarketingdesc'] = 'Choose if you wish to hide or show the three Marketing Spots.';


$string['marketing1'] = 'Marketing Spot One';
$string['marketing2'] = 'Marketing Spot Two';
$string['marketing3'] = 'Marketing Spot Three';

$string['marketingtitle'] = 'Title';
$string['marketingtitledesc'] = 'Title to show in this marketing spot';
$string['marketingicon'] = 'Icon';
$string['marketingicondesc'] = 'Name of the icon you wish to use. List is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>.  Just enter what is after the "icon-".';
$string['marketingimage'] = 'Image';
$string['marketingimagedesc'] = 'This provides the option of displaying an image above the text in the marketing spot';
$string['marketingcontent'] = 'Content';
$string['marketingcontentdesc'] = 'Content to display in the marketing box. Keep it short and sweet.';
$string['marketingbuttontext'] = 'Link Text';
$string['marketingbuttontextdesc'] = 'Text to appear on the button.';
$string['marketingbuttonurl'] = 'Link URL';
$string['marketingbuttonurldesc'] = 'URL the button will point to.';

/* Social Networks */
$string['socialheading'] = 'Social Networking';
$string['socialheadingsub'] = 'Engage your users with Social Networking';
$string['socialdesc'] = 'Provide direct links to the core social networks that promote your brand.  These will appear in the header of every page.';
$string['socialnetworks'] = 'Social Networks';
$string['facebook'] = 'Facebook URL';
$string['facebookdesc'] = 'Enter the URL of your Facebook page. (i.e http://www.facebook.com/mycollege)';

$string['twitter'] = 'Twitter URL';
$string['twitterdesc'] = 'Enter the URL of your Twitter feed. (i.e http://www.twitter.com/mycollege)';

$string['googleplus'] = 'Google+ URL';
$string['googleplusdesc'] = 'Enter the URL of your Google+ profile. (i.e http://plus.google.com/107817105228930159735)';

$string['linkedin'] = 'LinkedIn URL';
$string['linkedindesc'] = 'Enter the URL of your LinkedIn profile. (i.e http://www.linkedin.com/company/mycollege)';

$string['youtube'] = 'YouTube URL';
$string['youtubedesc'] = 'Enter the URL of your YouTube channel. (i.e http://www.youtube.com/mycollege)';

$string['flickr'] = 'Flickr URL';
$string['flickrdesc'] = 'Enter the URL of your Flickr page. (i.e http://www.flickr.com/mycollege)';

$string['vk'] = 'VKontakte URL';
$string['vkdesc'] = 'Enter the URL of your Vkontakte page. (i.e http://www.vk.com/mycollege)';

$string['skype'] = 'Skype Account';
$string['skypedesc'] = 'Enter the Skype username of your organisations Skype account';

$string['pinterest'] = 'Pinterest URL';
$string['pinterestdesc'] = 'Enter the URL of your Pinterest page. (i.e http://pinterest.com/mycollege)';

$string['instagram'] = 'Instagram URL';
$string['instagramdesc'] = 'Enter the URL of your Instagram page. (i.e http://instagram.com/mycollege)';

$string['website'] = 'Website URL';
$string['websitedesc'] = 'Enter the URL of your own website. (i.e http://www.pukunui.com)';

/* Mobile Apps */
$string['mobileappsheading'] = 'Mobile Apps';
$string['mobileappsheadingsub'] = 'Link to your App to get your students using Mobiles';
$string['mobileappsdesc'] = 'Have you got a web app on the App Store or Google Play Store?  Provide a link here so your users can grab the apps online';

$string['android'] = 'Android (Google Play)';
$string['androiddesc'] = 'Prove a URL to your mobile App on the Google Play Store.  If you do not have one of your own maybe consider linking to the free official Moodle Mobile app.';

$string['ios'] = 'iPhone/iPad (App Store)';
$string['iosdesc'] = 'Prove a URL to your mobile App on the App Store.  If you do not have one of your own maybe consider linking to the free official Moodle Mobile app.';

/* iOS Icons */
$string['iosicon'] = 'iOS Homescreen Icons';
$string['iosicondesc'] = 'The them does provide a default icon for iOS and android homescreens. You can upload your custom icons if you wish.';

$string['iphoneicon'] = 'iPhone/iPod Touch Icon (Non Retina)';
$string['iphoneicondesc'] = 'Icon should be a PNG files sized 57px by 57px';

$string['iphoneretinaicon'] = 'iPhone/iPod Touch Icon (Retina)';
$string['iphoneretinaicondesc'] = 'Icon should be a PNG files sized 114px by 114px';

$string['ipadicon'] = 'iPad Icon (Non Retina)';
$string['ipadicondesc'] = 'Icon should be a PNG files sized 72px by 72px';

$string['ipadretinaicon'] = 'iPad Icon (Retina)';
$string['ipadretinaicondesc'] = 'Icon should be a PNG files sized 144px by 144px';

/* Google Analytics */
$string['analyticsheading'] = 'Google Analytics';
$string['analyticsheadingsub'] = 'Powerful analytics from Google';
$string['analyticsdesc'] = 'Here you can enable Google Analytics for your moodle site. You will need to sign up for a free account at the Google Analytics site (<a href="http://analytics.google.com" target="_blank">http://analytics.google.com</a>)';

$string['useanalytics'] = 'Enable Google Analytics';
$string['useanalyticsdesc'] = 'Enable or disable Google analytics functionaliy.';

$string['analyticsid'] = 'Your Tracking ID';
$string['analyticsiddesc'] = 'Enter the provided Tracking ID. Typically formatted like UA-XXXXXXXX-X';

$string['analyticsclean'] = 'Send Clean URLs';
$string['analyticscleandesc'] = 'This fantastic feature was created by <a href="https://moodle.org/user/profile.php?id=281671" target="_blank">Gavin Henrick</a> and <a href="https://moodle.org/user/view.php?id=907814" target="_blank">Bas Brands</a> and is implemented in this theme. Rather than standard Moodle URLs the theme will send out clean URLs making it easier to identify the page and provide advanced reporting. More information on using this feature and its uses can be <b><a href="http://www.somerandomthoughts.com/blog/2012/04/18/ireland-uk-moodlemoot-analytics-to-the-front/" target="_blank">found here</a></b>.';

/* Alerts */
$string['alertsheading'] = 'User Alerts';
$string['alertsheadingsub'] = 'Display important messages to your users on the frontpage';
$string['alertsdesc'] = 'This will display an alert (or multiple) in three different styles to your users on the Moodle frontpage. Please remember to disable these when no longer needed.';

$string['enablealert'] = 'Enable Alert';
$string['enablealertdesc'] = 'Enable or disable alerts';

$string['alert1'] = 'First Alert';
$string['alert2'] = 'Second Alert';
$string['alert3'] = 'Third Alert';

$string['alerttitle'] = 'Title';
$string['alerttitledesc'] = 'Main title/heading for your alert';

$string['alerttype'] = 'Level';
$string['alerttypedesc'] = 'Set the appropriate alert level/type to best inform your users';

$string['alerttext'] = 'Alert Text';
$string['alerttextdesc'] = 'What is the text you wish to display in your alert';

$string['alert_info'] = 'Information';
$string['alert_warning'] = 'Warning';
$string['alert_general'] = 'Announcement';

$string['ie7message'] = '<p id="ie7message">Sorry, this site requires <strong>Internet Explorer 8</strong> or higher to display and function correctly.  Please update your browser via Windows Update, or <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">download the latest version here</a>.  Alternatively, you can try installing the <a href="http://www.google.com/chromeframe" target="_blank">ChromeFrame plugin</a> which may solve some of the issues experienced in older browsers.  If using IE8 or above you may have Compatibility Mode switched on, turn this off to display this website correctly.  If you continue having problems accessing this website or the updates mentioned above, please contact your Helpdesk for further assistance.</p>';
