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

/* Core */
$string['configtitle'] = 'Essential';
$string['pluginname'] = 'Essential';
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>Essential</h2>
<p><img class="img-polaroid" src="essential/pix/screenshot.jpg" /></p>
</div>
<div class="well">
<h3>About Essential</h3>
<p>Essential is based upon the Bootstrap theme, which was created for Moodle 2.5, with the help of:<br>
Bas Brands, Stuart Lamour, Mark Aberdour, Paul Hibbitts, Mary Evans.</p>
<h3>Theme Credits</h3>
<p>Original Author: Julian Ridden<br>
Work taken over in July 2014 by:<br>
Gareth J. Barnard<br>
David Bezemer<br>
Work taken over on the 9th October 2014 by:<br>
Gareth J. Barnard<br>
</p>
<h3>Donations</h3>
<p>This theme is provided to you for free, and if you want to express your gratitude for using this theme, please consider donating by:
<h4>PayPal</h4>
<p>Please contact me via my <a href="http://moodle.org/user/profile.php?id=442195" target="_blank">\'Moodle profile\'</a> for details as I am an individual and therefore am unable to have \'donation\' / \'buy me now\' buttons under their terms.</p>
<h4>Flattr</h4>
<a href="https://flattr.com/profile/gjb2048" target="_blank">
clicking here to donate.
</a>
<br>Donations help to facilitate maintenance and allow me to provide you with more and better features.  Without your support the theme cannot be maintained.</p>
</div></div>';

// General.
$string['genericsettings'] = 'General';
$string['generalheadingsub'] = 'General settings';
$string['generalheadingdesc'] = 'Configure the general settings for the theme here.';

$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Whatever CSS rules you add to this text area will be reflected in every page, making for easier customization of this theme.';

$string['footnote'] = 'Footnote';
$string['footnotedesc'] = 'Whatever you add to this textarea will be displayed in the footer throughout your Moodle site.';

$string['logo'] = 'Logo';
$string['logodesc'] = 'Please upload your custom logo here if you want to add it to the header.
                       <br>The image should be 65px high and any reasonable width that suits.
                       <br>If you upload a logo it will replace the standard icon and name that was displayed by default.';
$string['credit'] = 'The Essential theme is developed, enhanced and maintained by ';

// Font settings.
$string['fontsettings'] = 'Font';
$string['fontheadingsub'] = 'Font settings';
$string['fontheadingdesc'] = 'Select and enter the fonts that you want to use in your Moodle environment.';
$string['fontselect'] = 'Font type selector';
$string['fontselectdesc'] = 'Choose from the list of available font types. Please save to show the options for your choice.';
$string['fonttypestandard'] = 'Standard fonts';
$string['fonttypegoogle'] = 'Google web fonts';
$string['fonttypecustom'] = 'Custom font';
$string['fontnameheading'] = 'Heading font';
$string['fontnameheadingdesc'] = 'Enter the exact name of the font to use for headings.';
$string['fontnamebody'] = 'Text font';
$string['fontnamebodydesc'] = 'Enter the exact name of the font to use for all other text.';

// Font files.
$string['fontfiles'] = 'Font files';
$string['fontfilesdesc'] = 'Upload your font files here.';
$string['fontfilettfheading'] = 'Heading TTF font file';
$string['fontfileotfheading'] = 'Heading OTF font file';
$string['fontfilewoffheading'] = 'Heading WOFF font file';
$string['fontfilewofftwoheading'] = 'Heading WOFF2 font file';
$string['fontfileeotheading'] = 'Heading EOT font file';
$string['fontfilesvgheading'] = 'Heading SVG font file';
$string['fontfilettfbody'] = 'Body TTF font file';
$string['fontfileotfbody'] = 'Body OTF font file';
$string['fontfilewoffbody'] = 'Body WOFF font file';
$string['fontfilewofftwobody'] = 'Body WOFF2 font file';
$string['fontfileeotbody'] = 'Body EOT font file';
$string['fontfilesvgbody'] = 'Body SVG font file';


$string['fontcharacterset'] = 'Google font additional character set';
$string['fontcharactersetdesc'] = 'Pick additional character sets for different languages.
                                   Using many character sets can slow down your Moodle, so only select the character sets that you actually need.';
$string['fontcharactersetlatinext'] = 'Latin Extended';
$string['fontcharactersetcyrillic'] = 'Cyrillic';
$string['fontcharactersetcyrillicext'] = 'Cyrillic Extended';
$string['fontcharactersetgreek'] = 'Greek';
$string['fontcharactersetgreekext'] = 'Greek Extended';
$string['fontcharactersetvietnamese'] = 'Vietnamese';

$string['bootstrapcdn'] = 'FontAwesome from CDN';
$string['bootstrapcdndesc'] = 'If enabled this will load FontAwesome from the online Bootstrap CDN source.
                               Enable this if you are having issues getting the Font Awesome icons to display in your site.';

$string['copyright'] = 'Copyright';
$string['copyrightdesc'] = 'The name of your organisation.';

$string['profilebarcustomtitle'] = 'Profile bar custom block title';
$string['profilebarcustomtitledesc'] = 'Title for custom profile bar block.';

$string['contactinfo'] = 'Contact information';
$string['contactinfodesc'] = 'Enter your contact information';

$string['siteicon'] = 'Site icon';
$string['siteicondesc'] = 'Do not have a logo? Enter the name of the icon you wish to use.  List is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>. Just enter what is after the "fa-". ';

$string['layout'] = 'Use a standard course layout';
$string['layoutdesc'] = 'This theme is designed to put both block columns on the side.  If you prefer the standard Moodle course layout you can check this box and be returned to the boring old three column layout.';

$string['oldnavbar'] = 'Use the old navbar position';
$string['oldnavbardesc'] = 'Enable this option to use the old navbar position, placing it below the header.';

$string['fitvids'] = 'Use FitVids';
$string['fitvidsdesc'] = 'Enable FitVids (fitvidsjs.com) to make your embedded videos responsive.  If FitVids is on and you want a video to be excluded then add \'class="fitvidsignore"\' to the \'iframe\' tag in the HTML mode of the editor.  For example: \'iframe class="fitvidsignore" width="420" height="315" src="//www.youtube.com/embed/enmEmym85xc" frameborder="0" allowfullscreen=""></iframe\'.';

$string['left'] = 'Left';
$string['right'] = 'Right';

$string['perfinfo'] = 'Performance information mode';
$string['perfinfodesc'] = 'Many sites don\'t need the fully detailed performance info.  Especially when viewed by users.  When enabled, this shows a cleaned up minimal form with basic page load information.';
$string['perf_max'] = 'Detailed';
$string['perf_min'] = 'Minimal';

$string['perfinfoheading'] = 'Performance Information';
$string['extperfinfoheading'] = 'Extended Performance Information';
$string['loadtime'] = 'Load Time';
$string['memused'] = 'Memory Used';
$string['peakmem'] = 'Peak Memory';
$string['included'] = 'Files Included';
$string['dbqueries'] = 'DB Read/Write';
$string['dbtime'] = 'DB Queries Time';
$string['serverload'] = 'Server Load';
$string['cachesused'] = 'Cached Used';
$string['sessionsize'] = 'Session Size';

$string['visibleadminonly'] = 'Blocks moved into the area below will only be seen by admins';
$string['backtotop'] = 'Back to top';

$string['nextsection'] = 'Next section';
$string['previoussection'] = 'Previous section';

$string['pagewidth'] = 'Set page width';
$string['pagewidthdesc'] = 'Choose from the list of available page widths for your site.';
$string['fixedwidthwide'] = 'Fixed width - Wide';
$string['fixedwidthnormal'] = 'Fixed width - Normal';
$string['fixedwidthnarrow'] = 'Fixed width - Narrow';
$string['variablewidth'] = 'Variable width';

$string['alwaysdisplay'] = 'Always show';
$string['displaybeforelogin'] = 'Show before login only';
$string['displayafterlogin'] = 'Show after login only';
$string['dontdisplay'] = 'Never show';

// Donate.
$string['donate_title'] = 'Essential donations';
$string['donate_desc'] = 'Please donate via PayPal by contacting me via my \'';
$string['donate_desc2'] = ' to keep the Essential development going, or simply to express your gratitude.';
$string['paypal_desc'] = '{$a->url}\' for details as I am an individual and therefore am unable to have \'donation\' / \'buy me now\' buttons under their terms or ';
$string['flattr_desc'] = '{$a->url}';
$string['paypal_click'] = 'Moodle profile';
$string['flattr_click'] = 'donate via Flattr';

// Readme.
$string['readme_title'] = 'Essential read-me';
$string['readme_desc'] = 'Please {$a->url} containing more information about the Essential theme.';
$string['readme_click'] = 'click for README.txt';


// Custom Menu.
$string['mycoursesinfo'] = 'Enrolled courses menu';
$string['mycoursesinfodesc'] = 'Displays a dynamic list of enrolled courses to the user.';
$string['displaymycourses'] = 'Display enrolled courses';
$string['displaymycoursesdesc'] = 'Display enrolled courses for users in the Custom Menu';

$string['mycoursetitle'] = 'Terminology';
$string['mycoursetitledesc'] = 'Change the terminology for the "My Courses" link in the drop down menu';
$string['mycourses'] = 'My courses';
$string['myunits'] = 'My units';
$string['mymodules'] = 'My modules';
$string['myclasses'] = 'My classes';
$string['allcourses'] = 'All courses';
$string['allunits'] = 'All units';
$string['allmodules'] = 'All modules';
$string['allclasses'] = 'All classes';
$string['noenrolments'] = 'You have no current enrolments';
$string['thiscourse'] = 'This course';
$string['people'] = 'People';

$string['helplinktype'] = 'Enable help link in menu';
$string['helplinktypedesc'] = 'Choose whether you want to enable a help option in the user menu, you can choose to either provide an URL that will be opened in a new window or an email address.';
$string['helplink'] = 'Help link';
$string['helplinkdesc'] = 'If you chose URL above fill in the complete URL to your help site (must include http:// or https://). If you chose Email address fill in your email address.';

$string['few'] = 'A few ';
$string['loggedinas'] = ' logged in as ';
$string['loggedinfrom'] = 'Logged in from ';

$string['mygrades'] = 'My grades';
$string['coursegrades'] = 'Course grades';

$string['gotobottom'] = 'Go to the bottom of the page';

// Breadcrumb Style.
$string['breadcrumbstyle'] = 'Breadcrumb style';
$string['breadcrumbstyledesc'] = 'Here you can change the style of the breadcrumbs.';
$string['breadcrumbstyled'] = 'Fancy';
$string['breadcrumbstylednocollapse'] = 'Fancy with no collapse';
$string['breadcrumbsimple'] = 'Simple';
$string['breadcrumbthin'] = 'Thin';
$string['nobreadcrumb'] = 'Hide';

// Regions.
$string['region-side-post'] = 'Right';
$string['region-side-pre'] = 'Left';
$string['region-home-left'] = 'Home (Left)';
$string['region-home-middle'] = 'Home (Middle)';
$string['region-home-right'] = 'Home (Right)';
$string['region-footer-left'] = 'Footer (Left)';
$string['region-footer-middle'] = 'Footer (Middle)';
$string['region-footer-right'] = 'Footer (Right)';
$string['region-hidden-dock'] = 'Hidden from users';

// Colours.
$string['colorheading'] = 'Colour';
$string['colorheadingsub'] = 'Set the colours used in your theme';
$string['colordesc'] = 'Here you can find various settings to change many of the colours found in this theme.';

$string['footercolors'] = 'Footer colours';
$string['footercolorsdesc'] = 'Change the colours on the page footers';

$string['themecolor'] = 'Theme colour';
$string['themecolordesc'] = 'What colour should your theme be.  This will change multiple components to produce the colour you wish across the Moodle site';

$string['themetextcolor'] = 'Text colour';
$string['themetextcolordesc'] = 'Set the colour for your text.';
$string['themeurlcolor'] = 'Link colour';
$string['themeurlcolordesc'] = 'Set the colour for your linked text.';
$string['themehovercolor'] = 'Theme hover colour';
$string['themehovercolordesc'] = 'What colour should your theme hovers be. This is used for links, menus, etc.';
$string['themeiconcolor'] = 'Icon colour';
$string['themeiconcolordesc'] = 'Set the colour for all icons.';
$string['themenavcolor'] = 'Navigation colour';
$string['themenavcolordesc'] = 'Set the colour for navigation.  Being the navigation bar and the breadcrumb fancy style.';

$string['footercolor'] = 'Footer background colour';
$string['footercolordesc'] = 'Set what colour the background of the Footer box should be.';
$string['footersepcolor'] = 'Footer separator colour';
$string['footersepcolordesc'] = 'Separators are lines used to separate content.  Set their colour here.';
$string['footertextcolor'] = 'Footer text colour';
$string['footertextcolordesc'] = 'Set the colour you want your text to be in the footer.';
$string['footerurlcolor'] = 'Footer link colour';
$string['footerurlcolordesc'] = 'Set the colour for your linked text in the footer.';
$string['footerhovercolor'] = 'Footer link hover colour';
$string['footerhovercolordesc'] = 'Set the colour for your linked text when hovered over in the footer.';
$string['footerheadingcolor'] = 'Footer heading colour';
$string['footerheadingcolordesc'] = 'Set the colour for block headings in the footer.';

$string['headerbackground'] = 'Header background image';
$string['headerbackgrounddesc'] = 'Upload your own background image.';
$string['headertextcolor'] = 'Header text colour';
$string['headertextcolordesc'] = 'Set the text colour for the header.';
$string['pagebackground'] = 'Page background image';
$string['pagebackgrounddesc'] = 'Upload your own background image. Select the style of the image below.';
$string['pagebackgroundstyle'] = 'Page background style';
$string['pagebackgroundstyledesc'] = 'Select the style for the uploaded image.';
$string['backgroundstylefixed'] = 'Fixed';
$string['backgroundstyletiled'] = 'Tiled';
$string['backgroundstylestretch'] = 'Stretch';

// Alternate Colour Switcher.
$string['themecolors'] = 'Theme colours';
$string['defaultcolors'] = 'Default colours';
$string['alternativecolors'] = 'Alternative colours {$a}';
$string['alternativethemecolor'] = 'Alternative theme colour {$a}';
$string['alternativethemecolordesc'] = 'What colour should your theme be for the alternative theme colours {$a}.';
$string['alternativethemename'] = 'Colour scheme name';
$string['alternativethemenamedesc'] = 'Provide a name for your alternative theme colours';
$string['alternativethemecolors'] = 'Alternative theme colours';
$string['alternativethemecolorsdesc'] = 'Defines theme colours alternative that the user may select.';
$string['alternativethemecolorname'] = 'Name of alternative colour set {$a}';
$string['alternativethemecolornamedesc'] = 'Provide a recognisable name for this set of alternative theme colours';
$string['alternativethemetextcolor'] = 'Alternative text colour  {$a}';
$string['alternativethemetextcolordesc'] = 'Set the colour for your alternative text {$a}.';
$string['alternativethemeurlcolor'] = 'Alternative link colour {$a}';
$string['alternativethemeurlcolordesc'] = 'Set the colour for your alternative linked text {$a}.';
$string['alternativethemehovercolor'] = 'Alternative theme hover colour {$a}';
$string['alternativethemehovercolordesc'] = 'What colour should your theme hovers be for the alternative theme colours {$a}.';
$string['enablealternativethemecolors'] = 'Enable alternative theme colours {$a}';
$string['enablealternativethemecolorsdesc'] = 'If enabled, the user will be able to choose the alternative theme colours {$a}.';

// Frontpage Settings.
$string['frontpageheading'] = 'Front page';
$string['frontpageheadingdesc'] = 'Configure here what additional items you want to show on the front page.';

$string['courselistteachericon'] = 'Course list teacher icon';
$string['courselistteachericondesc'] = 'Name of the icon you wish to use or empty for none.  List is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>.  Just enter what is after "fa-", e.g. "star".';

$string['frontcontentheading'] = 'Front page content area';
$string['frontcontent'] = 'Enable front page content area';
$string['frontcontentdesc'] = 'If enabled this adds a custom content area between the Slide show and the Marketing boxes for your own custom content.';
$string['frontcontentarea'] = 'Front page content area contents';
$string['frontcontentareadesc'] = 'Whatever is typed into this box will display across the full width of the page in between the slide show and the Marketing spots.';

$string['frontpageblocksheading'] = 'Front page blocks';
$string['frontpageblocks'] = 'Front page blocks alignment';
$string['frontpageblocksdesc'] = 'Here you can determine if the standard Moodle blocks on the frontpage align to the left or the right.';
$string['frontpagemiddleblocks'] = 'Enable additional front page middle blocks';
$string['frontpagemiddleblocksdesc'] = 'If enabled this will display three additional block locations just under the marketing spots.';

// Slideshow.
$string['slideshowheading'] = 'Slide show';
$string['slideshowheadingsub'] = 'Dynamic slide show for the front page';
$string['slideshowdesc'] = 'This creates a dynamic slide show of up to sixteen slides for you to promote important elements of your site.  The show is responsive where image height is set according to screen size.  The recommended height is 300px.  The width is set at 100% and therefore the actual height will be smaller if the width is greater than the screen size.  At smaller screen sizes the height is reduced dynamically without the need to provide separate images.  For reference screen width < 767px = height 165px, width between 768px and 979px = height 225px and width > 980px = height 300px.  If no image is selected for a slide, then the default_slide image in the pix folder is used.';

$string['toggleslideshow'] = 'Toggle slide show display';
$string['toggleslideshowdesc'] = 'Choose if you wish to hide or show the slide show.';

$string['numberofslides'] = 'Number of slides';
$string['numberofslides_desc'] = 'Number of slides on the slider.';

$string['hideonphone'] = 'Hide slide show on mobiles';
$string['hideonphonedesc'] = 'Choose if you wish to disable slide show on mobiles.';

$string['hideontablet'] = 'Hide slide show on tablets';
$string['hideontabletdesc'] = 'Choose if you wish to disable the slide show on tablets.';

$string['readmore'] = 'Read more';

$string['slideinterval'] = 'Slide interval';
$string['slideintervaldesc'] = 'Slide transition interval in milliseconds.';

$string['slidecolor'] = 'Slide text colour';
$string['slidecolordesc'] = 'What colour the slide caption text should be.';

$string['slidecaptionoptions'] = 'Slide caption options';
$string['slidecaptionoptionsdesc'] = 'Where the captions should appear in relation to the image.';
$string['slidecaptionbeside'] = 'Beside';
$string['slidecaptionontop'] = 'On top';
$string['slidecaptionunderneath'] = 'Underneath';

// Backward compatibility.
$string['slidecaptionbelow'] = 'Slide caption below image';
$string['slidecaptionbelowdesc'] = 'If the slide caption should be below the image.';

$string['slidecaptioncentred'] = 'Slide caption centred';
$string['slidecaptioncentreddesc'] = 'If the slide caption should be centred.';

$string['slidebuttoncolor'] = 'Slide button colour';
$string['slidebuttoncolordesc'] = 'What colour the slide navigation button should be.';
$string['slidebuttonhovercolor'] = 'Slide button hover colour';
$string['slidebuttonhovercolordesc'] = 'What colour the slide navigation button hover should be.';

$string['slideno'] = 'Slide {$a->slide}';
$string['slidenodesc'] = 'Enter the settings for slide {$a->slide}.';
$string['slidetitle'] = 'Slide title';
$string['slidetitledesc'] = 'Enter a descriptive title for your slide';
$string['noslidetitle'] = 'No title for slide {$a->slide}';
$string['slideimage'] = 'Slide image';
$string['slideimagedesc'] = 'Image works best if it is transparent.';
$string['slidecaption'] = 'Slide caption';
$string['slidecaptiondesc'] = 'Enter the caption text to use for the slide';
$string['slideurl'] = 'Slide link';
$string['slideurldesc'] = 'Enter the target destination of the slide\'s image link';
$string['slideurltarget'] = 'Link target';
$string['slideurltargetdesc'] = 'Choose how the link should be opened';
$string['slideurltargetself'] = 'Current page';
$string['slideurltargetnew'] = 'New page';
$string['slideurltargetparent'] = 'Parent frame';

// Marketing Spots.
$string['marketingheading'] = 'Marketing spots';
$string['marketinginfodesc'] = 'Enter the settings for your marketing spot.';
$string['marketingheadingsub'] = 'Three locations on the front page to add information and links';

$string['marketingheight'] = 'Height of marketing images';
$string['marketingheightdesc'] = 'If you want to display images in the Marketing boxes you can specify their height here.';
$string['marketingdesc'] = 'This theme provides the option of enabling three "marketing" or "ad" spots just under the slide show.  These allow you to easily identify core information to your users and provide direct links.';

$string['togglemarketing'] = 'Toggle marketing spot display';
$string['togglemarketingdesc'] = 'Choose if you wish to hide or show the three marketing spots.';

$string['marketing1'] = 'Marketing spot one';
$string['marketing2'] = 'Marketing spot two';
$string['marketing3'] = 'Marketing spot three';

$string['marketingtitle'] = 'Title';
$string['marketingtitledesc'] = 'Title to show in this marketing spot';
$string['marketingicon'] = 'Icon';
$string['marketingicondesc'] = 'Name of the icon you wish to use.  List is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>.  Just enter what is after "fa-", e.g. "star".';
$string['marketingimage'] = 'Image';
$string['marketingimagedesc'] = 'This provides the option of displaying an image above the text in the marketing spot';
$string['marketingcontent'] = 'Content';
$string['marketingcontentdesc'] = 'Content to display in the marketing box.  Keep it short and sweet.';
$string['marketingbuttontext'] = 'Link text';
$string['marketingbuttontextdesc'] = 'Text to appear on the button.';
$string['marketingbuttonurl'] = 'Link URL';
$string['marketingbuttonurldesc'] = 'URL the button will point to.';
$string['marketingurltarget'] = 'Link target';
$string['marketingurltargetdesc'] = 'Choose how the link should be opened';
$string['marketingurltargetself'] = 'Current page';
$string['marketingurltargetnew'] = 'New page';
$string['marketingurltargetparent'] = 'Parent frame';

// Social Networks.
$string['socialheading'] = 'Social networking';
$string['socialheadingsub'] = 'Engage your users with social networking';
$string['socialdesc'] = 'Provide direct links to the core social networks that promote your brand.  These will appear in the header of every page.';
$string['socialnetworks'] = 'Social networks';

$string['facebook'] = 'Facebook';
$string['facebookurl'] = 'Facebook URL';
$string['facebookdesc'] = 'Enter the URL of your Facebook page. (i.e https://www.facebook.com/mycollege)';

$string['twitter'] = 'Twitter';
$string['twitterurl'] = 'Twitter URL';
$string['twitterdesc'] = 'Enter the URL of your Twitter feed. (i.e https://www.twitter.com/mycollege)';

$string['googleplus'] = 'Google+';
$string['googleplusurl'] = 'Google+ URL';
$string['googleplusdesc'] = 'Enter the URL of your Google+ profile. (i.e https://plus.google.com/+mycollege)';

$string['linkedin'] = 'LinkedIn';
$string['linkedinurl'] = 'LinkedIn URL';
$string['linkedindesc'] = 'Enter the URL of your LinkedIn profile. (i.e https://www.linkedin.com/company/mycollege)';

$string['youtube'] = 'YouTube';
$string['youtubeurl'] = 'YouTube URL';
$string['youtubedesc'] = 'Enter the URL of your YouTube channel. (i.e https://www.youtube.com/user/mycollege)';

$string['flickr'] = 'Flickr';
$string['flickrurl'] = 'Flickr URL';
$string['flickrdesc'] = 'Enter the URL of your Flickr page. (i.e http://www.flickr.com/photos/mycollege)';

$string['vk'] = 'VKontakte';
$string['vkurl'] = 'VKontakte URL';
$string['vkdesc'] = 'Enter the URL of your Vkontakte page. (i.e http://www.vk.com/mycollege)';

$string['skype'] = 'Skype Account';
$string['skypeuri'] = 'Skype Account URI';
$string['skypedesc'] = 'Enter the Skype user name URI of your organisations Skype account (i.e skype://my.college)';

$string['pinterest'] = 'Pinterest';
$string['pinteresturl'] = 'Pinterest URL';
$string['pinterestdesc'] = 'Enter the URL of your Pinterest page. (i.e http://pinterest.com/mycollege/mypinboard)';

$string['instagram'] = 'Instagram';
$string['instagramurl'] = 'Instagram URL';
$string['instagramdesc'] = 'Enter the URL of your Instagram page. (i.e http://instagram.com/mycollege)';

$string['website'] = 'Website';
$string['websiteurl'] = 'Website URL';
$string['websitedesc'] = 'Enter the URL of your own website. (i.e http://about.me/gjbarnard)';

// Category Icons.
$string['categoryiconheading'] = 'Category icons';
$string['categoryiconheadingsub'] = 'Use icons to represent your categories';
$string['categoryicondesc'] = 'If enabled this will allow you to set icons for each category of course.';
$string['categoryiconcategory'] = 'The icon for the category: {$a->category}.';

$string['enablecategoryicon'] = 'Enable category icons';
$string['enablecategoryicondesc'] = 'If enabled you will be able to select category icons after clicking "Save changes".';

$string['usecategoryicon'] = 'Enable category icons';
$string['usecategoryicondesc'] = 'Use custom icons for categories';

$string['defaultcategoryicon'] = 'Default category icons';
$string['defaultcategoryicondesc'] = 'Set a default category icon';

$string['enablecustomcategoryicon'] = 'Enable custom category icons';
$string['enablecustomcategoryicondesc'] = 'If enabled below this section you will see each category with a customizable option behind each category, please save after enabling and disabling this option.';

$string['categoryiconinfo'] = 'Set custom category icons';
$string['categoryiconinfodesc'] = 'Enter the name of the icon you wish to use.  List is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>. Just enter what is after "fa-".';

// Header Settings.
$string['headerheading'] = 'Header';
$string['headertitle'] = 'Header title';
$string['headertitledesc'] = 'Configure here what title to output in the header.  Note: The header title will only be used if there is no logo.';
$string['navbartitle'] = 'Navigation bar title';
$string['navbartitledesc'] = 'Configure here what title to output in the navigation bar.';
$string['notitle'] = 'No Title';
$string['fullname'] = 'Site full name';
$string['shortname'] = 'Site short name';
$string['fullnamesummary'] = 'Full name and summary';
$string['shortnamesummary'] = 'Short name and summary';

// Footer Settings.
$string['footerheading'] = 'Footer';

// Mobile Apps.
$string['mobileappsheading'] = 'Apps';
$string['mobileappsheadingsub'] = 'Link to your app to get your students using mobiles';
$string['mobileappsdesc'] = 'Have you got a web app on the App Store or Google Play Store?  Provide a link here so your users can grab the apps online.';

$string['android'] = 'Android (Google Play)';
$string['androidurl'] = 'Android (Google Play) URL';
$string['androiddesc'] = 'Provide an URL to your mobile App on the Google Play Store.  If you do not have one of your own maybe consider linking to the official Moodle Mobile app. (https://play.google.com/store/apps/details?id=com.moodle.moodlemobile)';

$string['windows'] = 'Windows Desktop';
$string['windowsurl'] = 'Windows Desktop URL';
$string['windowsdesc'] = 'Provide an URL to your mobile App on the Windows Store.  If you do not have one of your own maybe consider linking to the official Moodle Mobile app. (http://apps.microsoft.com/windows/en-us/app/9df51338-015c-41b7-8a85-db2fdfb870bc)';

$string['winphone'] = 'Windows Mobile';
$string['winphoneurl'] = 'Windows Mobile URL';
$string['winphonedesc'] = 'Provide an URL to your mobile App on the Google Play Store.  If you do not have one of your own maybe consider linking to the official Moodle Mobile app. (http://www.windowsphone.com/en-us/store/app/moodlemobile/d0732b88-3c6d-4127-8f24-3fca2452a4dc)';

$string['ios'] = 'iPhone/iPad (App Store)';
$string['iosurl'] = 'iPhone/iPad (App Store) URL';
$string['iosdesc'] = 'Provide an URL to your mobile App on the App Store.  If you do not have one of your own maybe consider linking to the official Moodle Mobile app (https://itunes.apple.com/en/app/moodle-mobile/id633359593).';

// iOS Icons.
$string['iosicon'] = 'iOS home screen icons';
$string['iosicondesc'] = 'The theme does provide a default icon for iOS and android home screens.  You can upload your custom icons if you wish.';

$string['iphoneicon'] = 'iPhone/iPod Touch icon (Non Retina)';
$string['iphoneicondesc'] = 'Icon should be a PNG files sized 57px by 57px.';

$string['iphoneretinaicon'] = 'iPhone/iPod Touch icon (Retina)';
$string['iphoneretinaicondesc'] = 'Icon should be a PNG files sized 114px by 114px.';

$string['ipadicon'] = 'iPad Icon (Non retina)';
$string['ipadicondesc'] = 'Icon should be a PNG files sized 72px by 72px.';

$string['ipadretinaicon'] = 'iPad Icon (Retina)';
$string['ipadretinaicondesc'] = 'Icon should be a PNG files sized 144px by 144px.';

// Analytics.
$string['analytics'] = 'Analytics';
$string['analyticsheadingsub'] = 'Powerful analytics for Moodle';
$string['analyticsdesc'] = 'Choose the type of analytics you want to insert and save to enable the other options.';
$string['analyticssiteid'] = 'Site ID';
$string['analyticssiteiddesc'] = 'Enter your Site ID';
$string['analyticstrackingid'] = 'Site ID';
$string['analyticstrackingiddesc'] = 'Enter your Tracking ID';
$string['analyticssiteurl'] = 'Analytics URL';
$string['analyticssiteurldesc'] = 'Enter your "Piwik Analytics" URL without http(s) or a trailing slash.  For example "mysite.com/analytics".';
$string['analyticsenabled'] = 'Enabled';
$string['analyticsenableddesc'] = 'Enable analytics for Moodle';
$string['analyticsimagetrack'] = 'Image tracking';
$string['analyticscleanurl'] = 'Clean URLs';
$string['analyticscleanurldesc'] = 'Generate clean URL for in advanced tracking';
$string['analyticsimagetrackdesc'] = 'Enable Image Tracking for browsers with JavaScript disabled.';
$string['analyticstrackadmin'] = 'Tracking Admins';
$string['analyticstrackadmindesc'] = 'Enable tracking of Admin users (not recommended)';
$string['analyticspiwik'] = 'Piwik';
$string['analyticsguniversal'] = 'Google Universal Analytics';

// Alerts.
$string['alertsheading'] = 'User alerts';
$string['alertsheadingsub'] = 'Display important messages to your users on the front page';
$string['alertsdesc'] = 'This will display an alert (or multiple) in three different styles to your users on the Moodle frontpage. Please remember to disable these when no longer needed.';

$string['enablealert'] = 'Enable alerts';
$string['enablealertdesc'] = 'Enable or disable alerts';

$string['alert1'] = 'First alert';
$string['alert2'] = 'Second alert';
$string['alert3'] = 'Third alert';
$string['alertinfodesc'] = 'Enter the settings for your alert.';

$string['alerttitle'] = 'Title';
$string['alerttitledesc'] = 'Main title/heading for your alert.';

$string['alerttype'] = 'Level';
$string['alerttypedesc'] = 'Set the appropriate alert level/type to best inform your users.';

$string['alerttext'] = 'Alert text';
$string['alerttextdesc'] = 'What is the text you wish to display in your alert.';

$string['alert_info'] = 'Information';
$string['alert_warning'] = 'Warning';
$string['alert_general'] = 'Announcement';

// Message Menu.
$string['unreadnewnotification'] = 'New notification';
$string['nomessagesfound'] = 'No messages were found';

$string['blogpreferences'] = 'Blog preferences';
$string['badgepreferences'] = 'Badge preferences';
$string['messagepreferences'] = 'Message preferences';
