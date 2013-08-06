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
 * german translation by Christian Conradi and Michael Drawe
 */
/* Core */
$string['configtitle'] = 'Essential';
$string['pluginname'] = 'Essential';
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>Clean</h2>
<p><img class=img-polaroid src="clean/pix/screenshot.jpg" /></p>
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
$string['geneicsettings'] = 'Allgemeine Einstellungen';
$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Alle CSS-Anweisungen in diesem Feld werden auf jeder Seite benutzt. Das Design kann so einfach an Ihre Beduerfnisse angepasst werden.';
$string['footnote'] = 'Fussnote';
$string['footnotedesc'] = 'Alles, was hier in dem Textfeld eingefuegt wird, erscheint auf jeder Seite im footer.';
$string['invert'] = 'Invertierte Navigationsleiste';
$string['invertdesc'] = 'Wechselt den Text und Hintergrund der Navigationsleiste zwischen schwarz und weiss.';
$string['logo'] = 'Logo';
$string['logodesc'] = 'Hier kannst du dein eigenes Logo in den header hochladen.<br>Wenn du ein Logo hochgeladen hast, ersetzt es das Standard-Logo und den Standard-Text der Moodle Seite.';
$string['copyright'] = 'Copyright-Text, Name der Organisation';
$string['copyrightdesc'] = 'Der Name der Organisation.';
$string['profilebarcustomtitle'] = 'Profile Bar Custom Block Title';
$string['profilebarcustomtitledesc'] = 'Titel Text zur Anpassung des Profile Bar block';
$string['themecolor'] = 'Theme Grund-Farbe';
$string['themecolordesc'] = 'Welche Grund-Farbe soll dein Theme haben? Diese Grundfarbe wird dann überall auf der moodle-Seite verwendet.';
$string['themehovercolor'] = 'Theme Hover Color';
$string['themehovercolordesc'] = 'Wenn du mit der Maus ueber Links, Menues schwebst, erscheint diese Farbe.';
$string['contactinfo'] = 'Kontaktdaten';
$string['contactinfodesc'] = 'Hier bitte die Kontaktdaten eingeben';
$string['siteicon'] = 'Anstatt-Logo-Icon';
$string['siteicondesc'] = 'Kein Logo vorhanden oder zu Hand? Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>.';
$string['yourprofile'] = 'Ich';
$string['headerprofilepic'] = 'Anzeige des Nutzerbildes';
$string['headerprofilepicdesc'] = 'Wenn diese Option aktiviert ist, zeigt wird das Nutzerbild im header der Seite angezeigt.';
$string['layout'] = 'Verwenden Sie ein Standard-Layout des Kurses';
$string['layoutdesc'] = 'Dieses Theme ist so konzipiert, dass die Bloecke nur auf einer Seite sind. Wenn Sie das Standard Layout des Kurses mit den drei Spalten bevorzugen, koennen sie es hier wieder aktivieren.';

/* Navbar Seperator */
$string['navbarsep'] = 'Trennzeichen der Navigationsleiste/Breadcrumb';
$string['navbarsepdesc'] = 'Hier koennen Sie die Art der Trennzeichen der Navigationsleiste/Breadcrumb auswaehlen';
$string['nav_thinbracket'] = 'Duenne Klammern';
$string['nav_doublebracket'] = 'Doppelt duenne Klammern';
$string['nav_thickbracket'] = 'Fette Klammern';
$string['nav_slash'] = 'Schraegstrich';
$string['nav_pipe'] = 'Vertikale Line';

/* Regions */
$string['region-side-post'] = 'Rechts';
$string['region-side-pre'] = 'Links';
$string['region-footer-left'] = 'Footer (Links)';
$string['region-footer-middle'] = 'Footer (Mitte)';
$string['region-footer-right'] = 'Footer (Rechts)';
$string['region-hidden-dock'] = 'Verborgen für Nutzer';

/* Slideshow */
$string['slideshowheading'] = 'Startseite Slideshow';
$string['slideshowheadingsub'] = 'Dynamische Slideshow auf der Startseite';
$string['slideshowdesc'] = 'Dies schafft eine dynamische Slideshow von bis zu 4 Bildern um wichtige Elemente hervorzuheben.';

$string['hideonphone'] = 'Slideshow auf Mobil-Telefonen';
$string['hideonphonedesc'] = 'Waehlen Sie, ob die Slideshow auf dem Handy angezeigt werden soll oder nicht';
$string['display'] = 'Anzeigen';
$string['dontdisplay'] = 'Nicht anzeigen';
$string['readmore'] = 'Mehr erfahren...';

$string['slideshowTitle'] = 'Slideshow';
$string['slide1'] = 'Ueberschrift für das Slideshow Bild 1';
$string['slide1desc'] = 'Geben Sie eine aussagekraeftigen Titel für Ihr Bild an';
$string['slide1image'] = 'Slideshow Bild 1';
$string['slide1imagedesc'] = 'Bild funktioniert am besten, wenn es transparent ist. (Bildgroeße sollte 256px x 256px sein)';
$string['slide1caption'] = 'Slideshow Bild 1: Bildunterschrift';
$string['slide1captiondesc'] = 'Geben Sie die Bildunterschrift (ein erklaerender Zwischentext)';
$string['slide1url'] = 'Slideshow Bild 1: Link';
$string['slide1urldesc'] = 'Hier einen Link eingeben für weitere Infos';

$string['slide2'] = 'Ueberschrift für das Slideshow Bild 2';
$string['slide2desc'] = 'Geben Sie eine aussagekraeftigen Titel für Ihr Bild an';
$string['slide2image'] = 'Slideshow Bild 2';
$string['slide2imagedesc'] = 'Bild funktioniert am besten, wenn es transparent ist. (Bildgroeße sollte 256px x 256px sein)';
$string['slide2caption'] = 'Slideshow Bild 2: Bildunterschrift';
$string['slide2captiondesc'] = 'Geben Sie die Bildunterschrift (ein erklaerender Zwischentext)';
$string['slide2url'] = 'Slideshow Bild 2: Link';
$string['slide2urldesc'] = 'Hier einen Link eingeben für weitere Infos';

$string['slide3'] = 'Ueberschrift für das Slideshow Bild 3';
$string['slide3desc'] = 'Geben Sie eine aussagekraeftigen Titel für Ihr Bild an';
$string['slide3image'] = 'Slideshow Bild 3';
$string['slide3imagedesc'] = 'Bild funktioniert am besten, wenn es transparent ist. (Bildgroeße sollte 256px x 256px sein)';
$string['slide3caption'] = 'Slideshow Bild 3: Bildunterschrift';
$string['slide3captiondesc'] = 'Geben Sie die Bildunterschrift (ein erkärender Zwischentext)';
$string['slide3url'] = 'Slideshow Bild 3: Link';
$string['slide3urldesc'] = 'Hier einen Link eingeben für weitere Infos';

$string['slide4'] = 'Ueberschrift für das Slideshow Bild 4';
$string['slide4desc'] = 'Geben Sie eine aussagekraeftigen Titel für Ihr Bild an';
$string['slide4image'] = 'Slideshow Bild 4';
$string['slide4imagedesc'] = 'Bild funktioniert am besten, wenn es transparent ist. (Bildgroeße sollte 256px x 256px sein)';
$string['slide4caption'] = 'Slideshow Bild 1: Bildunterschrift';
$string['slide4captiondesc'] = 'Geben Sie die Bildunterschrift (ein erklaerender Zwischentext)';
$string['slide4url'] = 'Slideshow Bild 4: Link';
$string['slide4urldesc'] = 'Hier einen Link eingeben für weitere Infos';

/* Marketing Spots */
$string['marketingheading'] = 'Marketing Spots';
$string['marketingheadingsub'] = 'Drei Bereiche auf der Starteite für zusaetzliche Information und Links';
$string['marketingdesc'] = 'This theme provides the option of enabling three "marketing" or "ad" spots just under the slideshow. These allow you to easily identify core information to your users and provide direct links.';

$string['togglemarketing'] = 'Schalter Marketing Spot';
$string['togglemarketingdesc'] = 'Waehlen Sie, ob die drei Marketing-Spots angezeigt werden sollen.';


$string['marketing1'] = 'Marketing Spot Eins - Titel/Bezeichnung';
$string['marketing1desc'] = 'Titel/Bezeichnung, der in diesem Marketing-Spot angezeigt werden soll';
$string['marketing1icon'] = 'Marketing Spot Eins - Icon';
$string['marketing1icondesc'] = 'Namen des Icon, welches man verwenden moechte. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld.';
$string['marketing1content'] = 'Marketing Spot Eins - Inhalt/Text';
$string['marketing1contentdesc'] = 'Hier werden die Inahlte des Marketing Spot angezeigt. Halten Sie es kurz und buendig.';
$string['marketing1buttontext'] = 'Marketing Spot Eins - Text fuer den Link';
$string['marketing1buttontextdesc'] = 'Text, der auf dem Button angezeigt werden soll.';
$string['marketing1buttonurl'] = 'Marketing Spot Eins - Link URL';
$string['marketing1buttonurldesc'] = 'gib die URL fuer den Button an.';

$string['marketing2'] = 'Marketing Spot Zwei - Titel/Bezeichnung';
$string['marketing2desc'] = 'Titel/Bezeichnung, der in diesem Marketing-Spot angezeigt werden soll';
$string['marketing2icon'] = 'Marketing Spot Zwei - Icon';
$string['marketing2icondesc'] = 'Namen des Icon, welches man verwenden moechte. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld.';
$string['marketing2content'] = 'Marketing Spot Zwei - Inhalt/Text';
$string['marketing2contentdesc'] = 'Hier werden die Inhalte des Marketing Spot angezeigt. Halten Sie sich kurz und knapp.';
$string['marketing2buttontext'] = 'Marketing Spot Zwei - Text fuer den Link';
$string['marketing2buttontextdesc'] = 'Text, der auf dem Button angezeigt werden soll.';
$string['marketing2buttonurl'] = 'Marketing Spot Zwei - Link URL';
$string['marketing2buttonurldesc'] = 'gib die URL fuer den Button an.';

$string['marketing3'] = 'Marketing Spot Drei - Titel/Bezeichnung';
$string['marketing3desc'] = 'Titel/Bezeichnung, der in diesem Marketing-Spot angezeigt werden soll';
$string['marketing3icon'] = 'Marketing Spot Drei - Icon';
$string['marketing3icondesc'] = 'Namen des Icon, welches man verwenden moechte. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld.';
$string['marketing3content'] = 'Marketing Spot Drei - Inhalt/Text';
$string['marketing3contentdesc'] = 'Hier werden die Inahlte des Marketing Spot angezeigt. Halten Sie es kurz und buendig.';
$string['marketing3buttontext'] = 'Marketing Spot Drei - Text fuer den Link';
$string['marketing3buttontextdesc'] = 'Text, der auf dem Button angezeigt werden soll.';
$string['marketing3buttonurl'] = 'Marketing Spot Drei- Link URL';
$string['marketing3buttonurldesc'] = 'gib die URL fuer den Button an.';

/* Social Networks */
$string['socialheading'] = 'Social Networking';
$string['socialheadingsub'] = 'Binden Sie Ihre Nutzer mit Social Networking ein';
$string['socialdesc'] = 'Geben Sie direkte Links zu den sozialen Netzwerken an, um die Seite zu foerdern. Diese werden im header jeder Seite angezeigt.';
$string['socialnetworks'] = 'Social Networks';
$string['facebook'] = 'Facebook URL';
$string['facebookdesc'] = 'Gib die URL der Facebook Seite an. (z.B. http://www.facebook.com/mycollege)';

$string['twitter'] = 'Twitter URL';
$string['twitterdesc'] = 'Gib die URL von Twitter an. (z.B. http://www.twitter.com/mycollege)';

$string['googleplus'] = 'Google+ URL';
$string['googleplusdesc'] = 'Gib die URL von Google+ an. (z.B. http://plus.google.com/107817105228930159735)';

$string['linkedin'] = 'LinkedIn URL';
$string['linkedindesc'] = 'Gib die URL von LinkedIn an. (z.B. http://www.linkedin.com/company/mycollege)';

$string['youtube'] = 'YouTube URL';
$string['youtubedesc'] = 'Gib die URL des YouTube Kanals an. (z.B. http://www.youtube.com/mycollege)';

$string['flickr'] = 'Flickr URL';
$string['flickrdesc'] = 'Gib die URL der Flickr Seite an. (z.B. http://www.flickr.com/mycollege)';

/* Alerts */
$string['ie7message'] = '<p id="ie7message">Sorry, this site requires <strong>Internet Explorer 8</strong> or higher to display and function correctly. Please update your browser via Windows Update, or <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">download the latest version here</a>. Alternatively, you can try installing the <a href="http://www.google.com/chromeframe" target="_blank">ChromeFrame plugin</a> which may solve some of the issues experienced in older browsers. If you continue having problems accessing this website or the updates mentioned above, please contact your Helpdesk for further assistance.</p>';
