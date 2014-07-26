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
 * @author 2013 Julian Ridden
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * German translation by Christian Conradi and Michael Drawe
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
$string['genericsettings'] = 'Allgemeine Einstellungen';
$string['autohide'] = 'F&uuml;ge Automatisch Ausblenden hinzu';
$string['autohidedesc'] = 'Die Funktion Automatisch Ausblenden wurde entwickelt, um Moodle weniger einsch&uuml;chternd wirken zu lassen. Wenn der Bearbeitungsmodus eingeschaltet ist, erscheinen die Icons erst dann, wenn man mit dem Zeiger darüber schwebt.';
$string['editicons'] = 'Bearbeite Icons V2';
$string['editiconsdesc'] = 'Dies nutzt den Font Awesome, damit farbige und &uuml;bersichtlichere formatierte Icons auf der Kursseite und Bl&ouml;cken angezeigt werden. Bitte beachten Sie, dass es nicht kompatibel mit Autohide ist.';
$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Alle CSS-Anweisungen in diesem Feld werden auf jeder Seite benutzt. Das Design kann so einfach an Ihre Bed&uuml;rfnisse angepasst werden.';
$string['footnote'] = 'Fussnote';
$string['footnotedesc'] = 'Alles, was hier in dem Textfeld eingef&uuml;gt wird, erscheint auf jeder Seite im footer.';
$string['invert'] = 'Invertierte Navigationsleiste';
$string['invertdesc'] = 'Wechselt den Text und Hintergrund der Navigationsleiste zwischen schwarz und weiss.';
$string['logo'] = 'Logo';
$string['logodesc'] = 'Hier kannst du dein eigenes Logo in den header hochladen.<br>Wenn du ein Logo hochgeladen hast, ersetzt es das Standard-Logo und den Standard-Text der Moodle Seite.';
$string['copyright'] = 'Copyright-Text, Name der Organisation';
$string['copyrightdesc'] = 'Der Name der Organisation.';
$string['profilebarcustomtitle'] = 'Profile Bar Custom Block Title';
$string['profilebarcustomtitledesc'] = 'Titel Text zur Anpassung des Profile Bar block';
$string['contactinfo'] = 'Kontaktdaten';
$string['contactinfodesc'] = 'Hier bitte die Kontaktdaten eingeben';
$string['siteicon'] = 'Anstatt-Logo-Icon';
$string['siteicondesc'] = 'Kein Logo vorhanden oder zu Hand? Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. ';
$string['yourprofile'] = 'Ich';
$string['headerprofilepic'] = 'Anzeige des Nutzerbildes';
$string['headerprofilepicdesc'] = 'Wenn diese Option aktiviert ist, zeigt wird das Nutzerbild im header der Seite angezeigt.';
$string['layout'] = 'Verwende das Standard-Layout des Kurses';
$string['layoutdesc'] = 'Dieses Theme ist so konzipiert, dass die Bl&ouml;cke nur auf einer Seite sind. Wenn Sie das Standard Layout des Kurses mit den drei Spalten bevorzugen, koennen sie es hier wieder aktivieren.';
$string['perfinfo'] = 'Performance-Info-Modus';
$string['perfinfodesc'] = 'Many sites don\'t need the fully detailed performance info. Especially when viewed by users. When enabled, this shows a cleaned up miniminal form with basic page load information.';
$string['perf_max'] = 'Ausf&uuml;hrlich';
$string['perf_min'] = 'Minimal';
$string['visibleadminonly'] = 'Bl&ouml;cke, die in diesen unteren Bereich verschoben werden, k&ouml;nnen nur von den Administratoren gesehen werden';

/* Navbar Seperator */
$string['navbarsep'] = 'Trennzeichen der Navigationsleiste/Breadcrumb';
$string['navbarsepdesc'] = 'Hier k&ouml;nnen Sie die Art der Trennzeichen der Navigationsleiste/Breadcrumb ausw&auml;hlen';
$string['nav_thinbracket'] = 'D&uuml;nne Klammern';
$string['nav_doublebracket'] = 'Doppelt d&uuml;nne Klammern';
$string['nav_thickbracket'] = 'Fette Klammern';
$string['nav_slash'] = 'Schr&auml;gstrich';
$string['nav_pipe'] = 'Vertikale Line';

/* Regions */
$string['region-side-post'] = 'Rechts';
$string['region-side-pre'] = 'Links';
$string['region-footer-left'] = 'Footer (Links)';
$string['region-footer-middle'] = 'Footer (Mitte)';
$string['region-footer-right'] = 'Footer (Rechts)';
$string['region-hidden-dock'] = 'Verborgen für Nutzer';

/* Colors */
$string['colorheading'] = 'Farbeinstellungen';
$string['colorheadingsub'] = 'Geben Sie die Farbe für das Theme an';
$string['colordesc'] = 'Hier finden Sie verschiedene Einstellungen, um die Farben für das Theme zu &auml;ndern.';

$string['themecolor'] = 'Theme Farbe';
$string['themecolordesc'] = 'Welche Grund-Farbe soll dein Theme haben? Diese Grundfarbe wird dann &uuml;berall auf der moodle-Seite verwendet.';
$string['themehovercolor'] = 'Theme Hover Farbe';
$string['themehovercolordesc'] = 'Welche Grund-Farbe soll dein Theme haben? Diese Grundfarbe wird dann &uuml;berall auf der moodle-Seite verwendet.';
$string['footercolor'] = 'Footer Hintergrundfarbe';
$string['footercolordesc'] = 'Stellen Sie hier die Hintergrundfarbe ein, die der footer haben soll.';
$string['footersepcolor'] = 'Footer Trenn-Farbe';
$string['footersepcolordesc'] = 'Trenn-Linien werden verwendet, um Inhalte zu trennen. Stellen Sie hier die Farbe dafür ein.';
$string['footertextcolor'] = 'Footer Text Farbe';
$string['footertextcolordesc'] = 'Legen Sie hier die Text-Farbe für den footer fest.';
$string['footerurlcolor'] = 'Footer Link Farbe';
$string['footerurlcolordesc'] = 'Legen Sie hier die Farbe für den verlinkten Text im footer fest.';
$string['footerhovercolor'] = 'Footer Link Hover Farbe';
$string['footerhovercolordesc'] = 'Wenn du mit der Maus &uuml;ber den verlinkten Text schwebst, erscheint diese Farbe im footer.';
$string['footerheadingcolor'] = 'Footer &uuml;berschrift/Kopf Farbe';
$string['footerheadingcolordesc'] = 'Legen Sie hier die Farbe für den &uuml;berschriften-Block im footer fest.';
$string['pagebackground'] = 'Seiten Hintergrund-Bild';
$string['pagebackgrounddesc'] = 'Laden Sie ihr eigenes Hintergrundbild hoch. Dies wird im Hintergrund auf allen Seiten angezeigt. Wenn nichts hochgeladen wird, wird ein Standard Bild verwendet.';

/* Slideshow */
$string['slideshowheading'] = 'Startseite Slideshow';
$string['slideshowheadingsub'] = 'Dynamische Slideshow auf der Startseite';
$string['slideshowdesc'] = 'Dies schafft eine dynamische Slideshow von bis zu 4 Bildern um wichtige Elemente hervorzuheben.';

$string['hideonphone'] = 'Slideshow auf Mobil-Telefonen';
$string['hideonphonedesc'] = 'Wählen Sie, ob die Slideshow auf dem Handy angezeigt werden soll oder nicht';
$string['display'] = 'Anzeigen';
$string['dontdisplay'] = 'Nicht anzeigen';
$string['readmore'] = 'Mehr erfahren...';

/* Marketing Spots */
$string['marketingheading'] = 'Marketing Spots';
$string['marketingheadingsub'] = 'Drei Bereiche auf der Starteite für zusätzliche Information und Links';
$string['marketingheight'] = 'Hoehe der Marketing Bilder';
$string['marketingheightdesc'] = 'Wenn Bilder in den Marketing-Boxen angezeigt werden sollen, können Sie ihre Höhe angeben.';
$string['marketingdesc'] = 'Dieses theme bietet die Möglichkeit, drei Marketing Spots unterhalb der Diashow anzuzeigen. Es können Informationen und Links für die Besucher der Seite angezeigt werden.';

$string['togglemarketing'] = 'Schalter Marketing Spot';
$string['togglemarketingdesc'] = 'Wählen Sie, ob die drei Marketing-Spots angezeigt werden sollen.';

$string['marketing1'] = 'Marketing Spot Eins - Titel/Bezeichnung';
$string['marketing1desc'] = 'Titel/Bezeichnung, der in diesem Marketing-Spot angezeigt werden soll';
$string['marketing1icon'] = 'Marketing Spot Eins - Icon';
$string['marketing1icondesc'] = 'Namen des Icon, welches man verwenden möchte. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld.';
$string['marketing1image'] = 'Marketing Spot Eins - Bild';
$string['marketing1imagedesc'] = 'Dies bietet die Möglichkeit, ein Bild ueber den Marketing-Spot anzuzeigen.';
$string['marketing1content'] = 'Marketing Spot Eins - Inhalt/Text';
$string['marketing1contentdesc'] = 'Hier werden die Inhalte des Marketing Spot angezeigt. Halten Sie es kurz und knapp.';
$string['marketing1buttontext'] = 'Marketing Spot Eins - Text für den Link';
$string['marketing1buttontextdesc'] = 'Text, der auf dem Button angezeigt werden soll.';
$string['marketing1buttonurl'] = 'Marketing Spot Eins - Link URL';
$string['marketing1buttonurldesc'] = 'gib die URL fuer den Button an.';

$string['marketing2'] = 'Marketing Spot Zwei - Titel/Bezeichnung';
$string['marketing2desc'] = 'Titel/Bezeichnung, der in diesem Marketing-Spot angezeigt werden soll';
$string['marketing2icon'] = 'Marketing Spot Zwei - Icon';
$string['marketing2icondesc'] = 'Namen des Icon, welches man verwenden möchte. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld.';
$string['marketing2image'] = 'Marketing Spot Zwei - Bild';
$string['marketing2imagedesc'] = 'Dies bietet die Möglichkeit, ein Bild ueber den Marketing-Spot anzuzeigen.';
$string['marketing2content'] = 'Marketing Spot Zwei - Inhalt/Text';
$string['marketing2contentdesc'] = 'Hier werden die Inhalte des Marketing Spot angezeigt. Halten Sie es kurz und knapp.';
$string['marketing2buttontext'] = 'Marketing Spot Zwei - Text fuer den Link';
$string['marketing2buttontextdesc'] = 'Text, der auf dem Button angezeigt werden soll.';
$string['marketing2buttonurl'] = 'Marketing Spot Zwei - Link URL';
$string['marketing2buttonurldesc'] = 'gib die URL fuer den Button an.';

$string['marketing3'] = 'Marketing Spot Drei - Titel/Bezeichnung';
$string['marketing3desc'] = 'Titel/Bezeichnung, der in diesem Marketing-Spot angezeigt werden soll';
$string['marketing3icon'] = 'Marketing Spot Drei - Icon';
$string['marketing3icondesc'] = 'Namen des Icon, welches man verwenden möchte. Die Liste ist <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Tippe den Namen des Icons z.B. icon-glass (Erstes Beispiel-Icon) in dieses Feld.';
$string['marketing3image'] = 'Marketing Spot Drei - Bild';
$string['marketing3imagedesc'] = 'Dies bietet die Moeglichkeit, ein Bild ueber den Marketing-Spot anzuzeigen.';
$string['marketing3content'] = 'Marketing Spot Drei - Inhalt/Text';
$string['marketing3contentdesc'] = 'Hier werden die Inhalte des Marketing Spot angezeigt. Halten Sie es kurz und knapp.';
$string['marketing3buttontext'] = 'Marketing Spot Drei - Text für den Link';
$string['marketing3buttontextdesc'] = 'Text, der auf dem Button angezeigt werden soll.';
$string['marketing3buttonurl'] = 'Marketing Spot Drei - Link URL';
$string['marketing3buttonurldesc'] = 'gib die URL fuer den Button an.';

/* Social Networks */
$string['socialheading'] = 'Social Networking';
$string['socialheadingsub'] = 'Binden Sie Ihre Nutzer mit Social Networking ein';
$string['socialdesc'] = 'Geben Sie direkte Links zu den sozialen Netzwerken an, um die Seite zu fördern. Diese werden im header jeder Seite angezeigt.';
$string['socialnetworks'] = 'Soziale Netzwerke';
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

$string['vk'] = 'VKontakte URL';
$string['vkdesc'] = 'Gib die URL deiner Seite an. (z.B. http://www.vk.com/mycollege)';

$string['skype'] = 'Skype Account';
$string['skypedesc'] = 'Enter the Skype username of your organisations Skype account';

$string['pinterest'] = 'Pinterest URL';
$string['pinterestdesc'] = 'Enter the URL of your Pinterest page. (i.e http://pinterest.com/mycollege)';

$string['instagram'] = 'Instagram URL';
$string['instagramdesc'] = 'Enter the URL of your Instagram page. (i.e http://instagram.com/mycollege)';

$string['website'] = 'Website URL';
$string['websitedesc'] = 'Gib die URL deiner Website an. (z.B. http://www.pukunui.com)';

/* Mobile Apps */
$string['mobileappsheading'] = 'Mobile Apps';
$string['mobileappsheadingsub'] = 'Link zu ihrer App für die Nutzer';
$string['mobileappsdesc'] = 'Haben Sie eine Web-App im App Store oder Google Play Store? Geben Sie hier einen Link an, damit die Anwender die Apps Online bekommen kann.';

$string['android'] = 'Android (Google Play)';
$string['androiddesc'] = 'Geben Sie hier die URL zu ihrer Handy-App aus dem Google Play Store an. Wenn sie keine eigene haben, können sie stattdessen die frei offizielle Moodle Mobile app nehmen.';

$string['ios'] = 'iPhone/iPad (App Store)';
$string['iosdesc'] = 'Geben Sie hier die URL zu ihrer Handy-App aus dem Google Play Store an. Wenn sie keine eigene haben, können sie stattdessen die frei offizielle Moodle Mobile app nehmen.';

/* Alerts */
$string['ie8message'] = '<p id="ie8message">Sorry, this site requires <strong>Internet Explorer 9</strong> or higher to display and function correctly. Please update your browser via Windows Update, or <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">download the latest version here</a>. Alternatively, you can try installing the <a href="http://www.google.com/chromeframe" target="_blank">ChromeFrame plugin</a> which may solve some of the issues experienced in older browsers. If using IE9 or above you may have Compatibility Mode switched on, turn this off to display this website correctly. If you continue having problems accessing this website or the updates mentioned above, please contact your Helpdesk for further assistance.</p>';
