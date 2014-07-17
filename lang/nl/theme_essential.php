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
<p><img class=img-polaroid src="essential/pix/screenshot.jpg" /></p>
</div>
<div class="well">
<h3>Over Essential</h3>
<p>Essential is een aangepast Moodle bootstrap thema dat stylen en renderers van haar moeder themas erft.</p>
<h3>Afhankelijkheden</h3>
<p>Dit thema is gebaseerd op het Bootstrap thema ontwikkeld door:<br>
Stuart Lamour, Mark Aberdour, Paul Hibbitts en Mary Evans.</p>
<h3>Thema Credits</h3>
<p>Origineel Auteur: Julian Ridden<br>
Werk in Juli 2014 overgenomen door:<br>
Gareth J. Barnard<br>
David Bezemer<br>
</p>
</div></div>';

/* Algemeen */
$string['genericsettings'] = 'Algemene Instellingen';

$string['customcss'] = 'Aanvullende CSS';
$string['customcssdesc'] = 'Als er aanvullende CSS vereist is kan dit in het onderstaande tekstvak worden ingevoerd, en zal automatisch op iedere pagina ingevoegd worden.';

$string['footnote'] = 'Voetnoot';
$string['footnotedesc'] = 'Tekst welke in dit veld wordt ingevoegd zal op iedere pagina in de voetnoot worden weergegeven.';

$string['invert'] = 'Navigatie in negatief';
$string['invertdesc'] = 'Wisselt tekst en achtergrond kleur voor de navigatie balk boven in het scherm.';

$string['logo'] = 'Logo';
$string['logodesc'] = 'Upload hier je eigen logo. Indien je een logo upload vervangt dit automatisch het standaard logo en het gekozen icoon.';

$string['fontselect'] = 'Font kiezer';
$string['fontselectdesc'] = 'Kies hier uit de lijst met beschikbare fonts.';

$string['bootstrapcdn'] = 'FontAwesome laden van CDN';
$string['bootstrapcdndesc'] = 'Indien ingeschakeld zal FontAwesome van het Bootstrap CDN geladen worden. Deze optie kan ingeschakeld worden als iconen niet correct worden geladen.';

$string['copyright'] = 'Copyright';
$string['copyrightdesc'] = 'Naam van je organisatie om als copyright houder te tonen.';

$string['profilebarcustomtitle'] = 'Aangepaste profielbalk titel';
$string['profilebarcustomtitledesc'] = 'Voer hier indien gewenst een aangepaste title in voor de profielbalk.';

$string['contactinfo'] = 'Contact informatie';
$string['contactinfodesc'] = 'Voer hier je contact informatie in.';

$string['siteicon'] = 'Site afbeelding';
$string['siteicondesc'] = 'Als je geen logo hebt kun je hier een icoon invullen om op de plaats van het logo te tonen. De volledige lijst staat op <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Voer het gedeelte achter "fa-" hier in.';

$string['yourprofile'] = 'Je profiel';
$string['headerprofilepic'] = 'Toon afbeelding van gebruiker';
$string['headerprofilepicdesc'] = 'Indien ingeschakeld wordt de afbeelding van de gebruiker getoond.';

$string['layout'] = 'Gebruik standaard cursus layout';
$string['layoutdesc'] = 'Dit thema is ontwikkeld om beide kolommen met blokken aan één kan te tonen. Als je de Moodle standaard prettiger vind kun je deze optie inschakelen om de oude drie kolommen layout terug te krijgen.';

$string['oldnavbar'] = 'Gebruik oude navigatie balk positie';
$string['oldnavbardesc'] = 'Indien ingeschakeld wordt de navigatie balk op de oude positie getoond.';

$string['frontpageblocks'] = 'Uitlijning van voorpagina blokken';
$string['frontpageblocksdesc'] = 'Hier kun je de uitlijning van de blokken op de voorpagina kiezen.';

$string['left'] = 'Links';
$string['right'] = 'Rechts';

$string['perfinfo'] = 'Performance informatie';
$string['perfinfodesc'] = 'Voor veel sites is de volledige performance informatie té veel. Indien ingeschakeld worden minimale gegevens onderaan iedere pagina getoond.';
$string['perf_max'] = 'Gedetailleerd';
$string['perf_min'] = 'Minimaal';

$string['sideregionsmaxwidth'] = 'Beperk maximale breedte voor de blok regio\'s';
$string['sideregionsmaxwidthdesc'] = 'Dit thema heeft een vloeiende breedte. Op brede schermen kunnen de zij blokken groter worden dan gewenst. Door deze optie in te schakelen wordt de maximale breedte beperkt.';
$string['visibleadminonly'] = 'Blokken in deze regio worden alleen aan beheerders getoond';
$string['backtotop'] = 'Naar boven';

$string['nextsection'] = 'Volgende sectie';
$string['previoussection'] = 'Vorige sectie';

$string['pagewidth'] = 'Kies pagina breedte';
$string['pagewidthdesc'] = 'Kies uit de lijst met beschikbare breedtes om de site breedte in te stellen.';
$string['fixedwidthwide'] = 'Vaste breedte - breed';
$string['fixedwidthnarrow'] = 'Vaste breedte - smal';
$string['variablewidth'] = 'Volledige breedte';

$string['alwaysdisplay'] = 'Altijd tonen';
$string['displaybeforelogin'] = 'Alleen voor inloggen tonen';
$string['displayafterlogin'] = 'Alleen na inloggen tonen';
$string['dontdisplay'] = 'Nooit tonen';

/* CustomMenu */
$string['custommenuheading'] = 'Aangepast menu';
$string['custommenuheadingsub'] = 'Voeg additionele functionaliteit toe aan het aangepaste menu.';
$string['custommenudesc'] = 'De instellingen maken het mogelijk om dynamische functionaliteit toe te voegen aan het aangepaste menu (ook bekend als het Dropdown menu).';

$string['mydashboardinfo'] = 'Aangepast gebruikers dashboard';
$string['mydashboardinfodesc'] = 'Toont een lijst met veelgebruikte opties.';
$string['displaymydashboard'] = 'Toon dashboard';
$string['displaymydashboarddesc'] = 'Toon een lijst met dashboard links in het aangepaste menu.';

$string['mycoursesinfo'] = 'Automatische cursus lijst';
$string['mycoursesinfodesc'] = 'Toont een lijst met alle cursussen waar een gebruiker in ingeschreven is.';
$string['displaymycourses'] = 'Toon ingeschreven cursussen';
$string['displaymycoursesdesc'] = 'Toon ingeschreven cursussen in het aangepaste menu.';

$string['mycoursetitle'] = 'Naamgeving';
$string['mycoursetitledesc'] = 'Verander de naamgeving voor het "Mijn cursussen" menu hieronder.';
$string['mycourses'] = 'Mijn cursussen';
$string['myunits'] = 'Mijn lessen';
$string['mymodules'] = 'Mijn modules';
$string['myclasses'] = 'Mijn klassen';
$string['allcourses'] = 'Alle cursussen';
$string['allunits'] = 'Alle lessen';
$string['allmodules'] = 'Alle modules';
$string['allclasses'] = 'Alle klassen';
$string['noenrolments'] = 'Geen cursusinschrijving bekend';

/* My Dashboard custommenu dropdown */
$string['mydashboard'] = 'Mijn dashboard';

/* Breadcrumb Style */
$string['breadcrumbstyle'] = 'Kruimelpad stijl';
$string['breadcrumbstyledesc'] = 'Kies hier de stijl van het kruimelpad.';
$string['breadcrumbstyled'] = 'Fancy';
$string['breadcrumbsimple'] = 'Simpel';
$string['breadcrumbthin'] = 'Klein';
$string['nobreadcrumb'] = 'Verberg';

/* Regions */
$string['region-side-post'] = 'Rechts';
$string['region-side-pre'] = 'Links';
$string['region-home-left'] = 'Home (links)';
$string['region-home-middle'] = 'Home (midden)';
$string['region-home-right'] = 'Home (rechts)';
$string['region-footer-left'] = 'Voetnoot (links)';
$string['region-footer-middle'] = 'Voetnoot (midden)';
$string['region-footer-right'] = 'Voetnoot (rechts)';
$string['region-hidden-dock'] = 'Verborgen';

/* Colours */
$string['colorheading'] = 'Kleurinstellingen';
$string['colorheadingsub'] = 'Kies hier de kleuren die je in je thema wil gebruiken.';
$string['colordesc'] = 'Hieronder staan de verschillende instellingen om veel van de gebruikte kleuren in dit thema aan te passen.';

$string['footercolors'] = 'Voetnoot kleuren';
$string['footercolorsdesc'] = 'Verander de kleuren van de voetnoot';

$string['themecolor'] = 'Thema kleuren';
$string['themecolordesc'] = 'Welke kleur wil je het thema hebben? Dit heeft invloed op meerdere componenten binnen Moodle en bepaalt de basis kleur voor je thema.';

$string['themeurlcolor'] = 'Thema link kleuren';
$string['themeurlcolordesc'] = 'Stel hier de kleur voor links.';
$string['themehovercolor'] = 'Thema hover kleuren';
$string['themehovercolordesc'] = 'Welke kleuren moeten de hovers in het thema hebben? Dit wordt bijvoorbeeld gebruikt voor links.';

$string['footercolor'] = 'Voetnoot achtergrondkleur';
$string['footercolordesc'] = 'Stel hier de kleur in voor de achtergrond van de voetnoot regio.';
$string['footersepcolor'] = 'Voetnoot scheidingskleur';
$string['footersepcolordesc'] = 'Hier kun je de kleur van de scheidingslijnen instellen.';
$string['footertextcolor'] = 'Voetnoot tekstkleur';
$string['footertextcolordesc'] = 'Stel hier de kleur in van de tekst in de voetnoot.';
$string['footerurlcolor'] = 'Voetnoot link kleur';
$string['footerurlcolordesc'] = 'Stel hier de kleur van de links in de voetnoot in.';
$string['footerhovercolor'] = 'Voetnoot link hover kleur';
$string['footerhovercolordesc'] = 'Stel hier de kleur in voor de links in de voetnoot als je er met de muis op zweeft.';
$string['footerheadingcolor'] = 'Voetnoot titelkleur';
$string['footerheadingcolordesc'] = 'Stel hier de kleur in van de titel van de voetnoot.';

$string['pagebackground'] = 'Pagina achtergrondafbeelding';
$string['pagebackgrounddesc'] = 'Upload hier je achtergrond afbeelding. Deze achtergrond afbeelding zal op alle pagina\'s getoond worden. Als je geen afbeelding upload wordt hier een vaste kleur voor gebruikt.';

/* Alternate Color Switcher */
$string['themecolors'] = 'Themakleuren';
$string['defaultcolors'] = 'Standaardkleuren';
$string['alternativethemecolors'] = 'Alternatieve themakleur {$a}';
$string['alternativethemecolorsdesc'] = 'Definieer de alternatieve kleurschema\'s.';
$string['enablealternativethemecolors'] = 'Schakel alternatief kleurschema {$a} in';
$string['enablealternativethemecolorsdesc'] = 'Indien ingeschakeld krijgen gebruikers de keuze om alternatief kleurschema {$a}te kiezen.';
$string['alternativecolors'] = 'Alternatieve kleurschema {$a}';
$string['alternativethemecolor'] = 'Alternatieve themakleur {$a}';
$string['alternativethemecolordesc'] = 'Welke kleur moet het thema in alternatief kleurschema {$a} zijn?';
$string['alternativethemename'] = 'Naam voor kleurschema {$a}';
$string['alternativethemenamedesc'] = 'Voer hier de naam van alternatief kleurschema {$a} in.';
$string['alternativethemecolorname'] = 'Naam van alternatief kleurschema {$a}';
$string['alternativethemecolornamedesc'] = 'Geef een herkenbare naam op voor dit alternatieve kleurschema.';
$string['alternativethemehovercolor'] = 'Alternative Theme Hover Colour {$a}';
$string['alternativethemehovercolordesc'] = 'Welke kleur moet er gebruikt worden voor hovers in alternatief kleurschema {$a}?';

/* Frontpage Settings */
$string['frontcontentheading'] = 'Voorpagina instellingen';
$string['frontcontentheadingsub'] = 'Stel hier de verschillende onderdelen voor de voorpagina in.';
$string['frontcontentdesc'] = 'Dit voegt een speciaal blok in tussen de slideshow en de marketing blokken waar je eigen content kan plaatsen.';

$string['usefrontcontent'] = 'Voorpagina content inschakelen';
$string['usefrontcontentdesc'] = 'Indien ingeschakeld wordt de inhoud van dit blok tussen de slidehsow en marketing blokken weergegeven.';

$string['frontcontentarea'] = 'Voorpagina content';
$string['frontcontentareadesc'] = 'De inhoud van dit blik wordt over de gehele breedte van de pagina tussen de slidehsow en marketing blokken weergegeven.';

$string['frontpagemiddleblocks'] = 'Voorpagina midden blokken inschakelen';
$string['frontpagemiddleblocksdesc'] = 'Indien ingeschakeld worden er drie blokken weergegeven onder de marketing blokken.';

/* Slideshow */
$string['slideshowheading'] = 'Voorpagina slideshow';
$string['slideshowheadingsub'] = 'Een dynamische slideshow voor de voorpagina';
$string['slideshowdesc'] = 'Indien ingeschakeld wordt er een dynamische slideshow met maximaal 4 slides getoond om belangrijke informatie aantrekkelijk weer te geven.';

$string['toggleslideshow'] = 'Slideshow inschakelen';
$string['toggleslideshowdesc'] = 'Kies hier of je de slideshow in wil schakelen.';

$string['numberofslides'] = 'Aantal slides';
$string['numberofslides_desc'] = 'Kies hier het aantal slider voor de slideshow.';

$string['hideonphone'] = 'Verberg slideshow op telefoons';
$string['hideonphonedesc'] = 'Kies hier of je de slideshow wil uitschakelen op telefoons.';

$string['hideontablet'] = 'Verberg slideshow op tablets';
$string['hideontabletdesc'] = 'Kies hier of je de slideshow wil uitschakelen op tablets.';

$string['readmore'] = 'Lees verder';

$string['slideinterval'] = 'Slide interval';
$string['slideintervaldesc'] = 'Voer hier de tijd in milliseconden in voor het wisselen tussen slides.';

$string['slidecolor'] = 'Slide tekstkleur';
$string['slidecolordesc'] = 'Kies hier de kleur van de hoofdtekst op de slide.';

$string['slidebuttoncolor'] = 'Slide buttonkleur';
$string['slidebuttoncolordesc'] = 'Kies hier de kleur voor de navigatie knoppen.';
$string['slidebuttonhovercolor'] = 'Slide hover buttonkleur';
$string['slidebuttonhovercolordesc'] = 'Kies hier de kleur voor de navigatie knoppen wanneer je erover beweegt.';

$string['slideno'] = 'Slide {$a->slide}';
$string['slidenodesc'] = 'Voer de informatie in voor slide {$a->slide}.';
$string['slidetitle'] = 'Slide titel';
$string['slidetitledesc'] = 'Voer een titel in voor je slide.';
$string['noslidetitle'] = 'No title for slide {$a->slide}';
$string['slideimage'] = 'Slide afbeelding';
$string['slideimagedesc'] = 'Gebruik hier een transparante png (formaat is 256px x 256px voor de kleine afbeelding, en 300px x 1200px voor de achtergrond afbeelding)';
$string['slidecaption'] = 'Slide tekst';
$string['slidecaptiondesc'] = 'Voer hier de tekst in die op de slide getoond zal worden.';
$string['slideurl'] = 'Slide link';
$string['slideurldesc'] = 'Voer hier in waar de link achter "Verder lezen" naar moet verwijzen.';
$string['slideurltarget'] = 'Link doel';
$string['slideurltargetdesc'] = 'Voer hier in hoe de link geopend moet worden';
$string['slideurltargetself'] = 'Open in huidige pagina';
$string['slideurltargetnew'] = 'Open in nieuwe pagina';
$string['slideurltargetparent'] = 'Open in hoofdframe';

/* Marketing Spots */
$string['marketingheading'] = 'Marketing blokken';
$string['marketinginfodesc'] = 'Configureer hier de marketing blokken.';
$string['marketingheadingsub'] = 'De marketing blokken zijn drie blokken op de voorpagina waarin informatie en links getoond worden.';

$string['marketingheight'] = 'Hoogte van de marketing afbeeldingen';
$string['marketingheightdesc'] = 'Als je afbeeldingen wil tonen in de marketing blokken kun je hier de hoogte instellen.';
$string['marketingdesc'] = 'Dit thema bevat de optie om drie marketing blokken te tonen onder de slideshow. Dit geeft je de mogelijkheid om direct informatie te tonen aan gebruikers, ook zonder dat deze ingelogd zijn. Dit is handig voor als je specifieke cursussen wil uitlichten.';

$string['togglemarketing'] = 'Marketing blokken inschakelen';
$string['togglemarketingdesc'] = 'Kies hier of je de marketing blokken wil tonen.';

$string['marketing1'] = 'Marketing blok 1';
$string['marketing2'] = 'Marketing blok 2';
$string['marketing3'] = 'Marketing blok 3';

$string['marketingtitle'] = 'Titel';
$string['marketingtitledesc'] = 'Marketing blok titel.';
$string['marketingicon'] = 'Icoon';
$string['marketingicondesc'] = 'Naam van het iccon dat je wil gebruiken. Kies uit de lijst <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>. Voor de naam in achter "fa-", bijvoorbeeld "star".';
$string['marketingimage'] = 'Afbeelding';
$string['marketingimagedesc'] = 'Stel hier een afbeelding in om boven de tekst in dit marketing blok te tonen.';
$string['marketingcontent'] = 'Inhoud';
$string['marketingcontentdesc'] = 'Stel hier de inhoud van het marketing blok in. Maak het kort maar krachtig.';
$string['marketingbuttontext'] = 'Link tekst';
$string['marketingbuttontextdesc'] = 'Tekst om te tonen op de link button.';
$string['marketingbuttonurl'] = 'Link URL';
$string['marketingbuttonurldesc'] = 'URL the button will point to.';
$string['marketingurltarget'] = 'Link doel';
$string['marketingurltargetdesc'] = 'Voer hier in hoe de link geopend moet worden';
$string['marketingurltargetself'] = 'Open in huidige pagina';
$string['marketingurltargetnew'] = 'Open in nieuwe pagina';
$string['marketingurltargetparent'] = 'Open in hoofdframe';

/* Social Networks */
$string['socialheading'] = 'Sociale netwerk sites';
$string['socialheadingsub'] = 'Bind je gebruikers door gebruik te maken van sociale netwerken.';
$string['socialdesc'] = 'Geef hier directe links naar de locaties op sociale netwerken waar jouw merk of organisatie voorkomt. Deze links worden overal in de koptekst van de pagina getoond.';
$string['socialnetworks'] = 'Sociale netwerk sites';

$string['facebook'] = 'Facebook URL';
$string['facebookdesc'] = 'Link naar je Facebook pagina. (bvb. https://www.facebook.com/mijnorganisatie)';

$string['twitter'] = 'Twitter URL';
$string['twitterdesc'] = 'Link naar je Twitter feed. (bvb. https://twitter.com/mijnorganisatie)';

$string['googleplus'] = 'Google+ URL';
$string['googleplusdesc'] = 'Link naar je Google+ profiel. (bvb. https://plus.google.com/+mijnorganisatie)';

$string['linkedin'] = 'LinkedIn URL';
$string['linkedindesc'] = 'Link naar je LinkedIn profiel. (bvb. https://www.linkedin.com/company/mijnorganisatie)';

$string['youtube'] = 'YouTube URL';
$string['youtubedesc'] = 'Link naar je YouTube kanaal. (bvb. https://www.youtube.com/user/mijnorganisatie)';

$string['flickr'] = 'Flickr URL';
$string['flickrdesc'] = 'Link naar je Flickr pagina. (bvb. https://www.flickr.com/photos/mijnorganisatie)';

$string['vk'] = 'VKontakte URL';
$string['vkdesc'] = 'Link naar je VKontakte profiel. (bvb. http://vk.com/mijnorganisatie)';

$string['skype'] = 'Skype Account';
$string['skypedesc'] = 'Skype gebruikersnaam van je organisatie. (bvb. mijn.organisatie)';

$string['pinterest'] = 'Pinterest URL';
$string['pinterestdesc'] = 'Link naar je Pinterest prikbord. (bvb. http://www.pinterest.com/mijnorganisatie/mijnprikbord)';

$string['instagram'] = 'Instagram URL';
$string['instagramdesc'] = 'Link naar je Instagram feed. (bvb. http://instagram.com/mijnorganisatie)';

$string['website'] = 'Website URL';
$string['websitedesc'] = 'Link naar je website. (bvb. http://www.uplearning.nl)';

/* Category Icons */
$string['categoryiconheading'] = 'Categorie Iconen';
$string['categoryiconheadingsub'] = 'Gebruik iconen om categorieën weer te geven.';
$string['categoryicondesc'] = 'Indien ingeschakeld kun je hier iconen voor iedere categorie instellen.';
$string['categoryiconcategory'] = 'Het icoon voor categorie: {$a->category}.';


$string['enablecategoryicon'] = 'Categorie iconen inschakelen';
$string['enablecategoryicondesc'] = 'Kies hier of je iconen voor categorieën in wil schakelen. Na inschakelen dien je eerst op "Opslaan" te klikken.';

$string['usecategoryicon'] = 'Enable Category Icons';
$string['usecategoryicondesc'] = 'Use custom icons for categories';

$string['defaultcategoryicon'] = 'Standaard categorie icoon';
$string['defaultcategoryicondesc'] = 'Stel hier een standaard categorie icoon in.';

$string['enablecustomcategoryicon'] = 'Aangepaste categorie iconen inschakelen';
$string['enablecustomcategoryicondesc'] = 'Kies hier of je aangepaste iconen voor categorieën in wil schakelen. Dit zorgt dat je voor iedere categorie een ander icoon kan instellen. Na inschakelen dien je eerst op "Opslaan" te klikken.';

$string['categoryiconinfo'] = 'Aangepaste categorie iconen';
$string['categoryiconinfodesc'] = 'Stel hier per categorie een icoon in. De mogelijke opties vind je <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">hier</a>, voer het gedeelte na "fa-" in.';

/* Mobile Apps */
$string['mobileappsheading'] = 'Mobiele applicaties';
$string['mobileappsheadingsub'] = 'Link naar je apps om te stimuleren dat gebruikers mobiele apparaten gebruiken.';
$string['mobileappsdesc'] = 'Heb je een app in de App Store of Play Store? Voer hier de links in zodat je apps eenvoudig gevonden kunenn worden.';

$string['android'] = 'Android (Google Play)';
$string['androiddesc'] = 'Voer een URL in naar je app in de Google Play. Als je zelf geen app hebt, kun je hier ook de officiële Moodle app invoeren. (https://play.google.com/store/apps/details?id=com.Moodle.Moodlemobile)';

$string['ios'] = 'iPhone/iPad (Apple App Store)';
$string['iosdesc'] = 'Voer een URL in naar je App in de App Store. Als je zelf geen app hebt, kun je hier ook de officiële Moodle app invoeren. (https://itunes.apple.com/en/app/Moodle-mobile/id633359593)';

/* iOS Icons */
$string['iosicon'] = 'iOS thuisscherm iconen';
$string['iosicondesc'] = 'In dit thema zijn iconen in te stellen die getoond worden op het iOS thuisscherm als je een bladwijzer maakt voor de Moodle omgeving.';

$string['iphoneicon'] = 'iPhone/iPod Touch icoon (Zonder Retina)';
$string['iphoneicondesc'] = 'Dit icoon moet een 57px x 57px PNG zijn.';

$string['iphoneretinaicon'] = 'iPhone/iPod Touch icoon (Retina)';
$string['iphoneretinaicondesc'] = 'Dit icoon moet een 114px x 114px PNG zijn.';

$string['ipadicon'] = 'iPad icoon (Zonder Retina)';
$string['ipadicondesc'] = 'Dit icoon moet een 72px x 72px PNG icoon zijn.';

$string['ipadretinaicon'] = 'iPad icoon (Retina)';
$string['ipadretinaicondesc'] = 'Dit icoon moet een 144px x 144px PNG icoon zijn.';

/* Google Analytics */
$string['analyticsheading'] = 'Google Analytics';
$string['analyticsheadingsub'] = 'Krachtige site analytics mogelijk gemaakt door Google Analytics.';
$string['analyticsdesc'] = 'Stel hier Google Analytics in voor je Moodle omgeving. Om Analytics te kunnen gebruiken moet je gratis een account aanmaken voor Google Analytics op: <a href="http://analytics.google.com" target="_blank">http://analytics.google.com</a>';

$string['useanalytics'] = 'Google Analytics inschakelen';
$string['useanalyticsdesc'] = 'Stel hier in of je Google Analytics functionaliteit in wil schakelen.';

$string['analyticsid'] = 'Tracking code';
$string['analyticsiddesc'] = 'Voer hier je tracking ID in. Het formaat van deze code is normaal gesproken UA-XXXXXXXX-X';

$string['analyticsclean'] = 'Gebruik schone titels';
$string['analyticscleandesc'] = 'Deze schitterende optie is bedacht door <a href="https://Moodle.org/user/profile.php?id=281671" target="_blank">Gavin Henrick</a> en <a href="https://Moodle.org/user/view.php?id=907814" target="_blank">Bas Brands</a>. In plaats van standaard Moodle pagina links te verzenden worden nette titels verzonden. Meer informatie, en waarom dit handig kan zijn kun je <b><a href="http://www.somerandomthoughts.com/blog/2012/04/18/ireland-uk-Moodlemoot-analytics-to-the-front/" target="_blank">hier vinden</a></b>.';

$string['analyticsadmin'] = 'Beheerders volgens';
$string['analyticsadmindesc'] = 'Kies hier of je ook beheerders wil volgen.';

/* Alerts */
$string['alertsheading'] = 'Notificaties';
$string['alertsheadingsub'] = 'Toon belangrijke notificaties op de voorpagina.';
$string['alertsdesc'] = 'Deze optie maakt het mogelijk om drie notificaties op de voorpagina te tonen. Vergeet ze niet uit te zetten als ze niet meer nodig zijn!';

$string['enablealert'] = 'Notificatie  inschakelen';
$string['enablealertdesc'] = 'Kies hier of je notificaties wil inschakelen.';

$string['alert1'] = 'Notificatie 1';
$string['alert2'] = 'Notificatie 2';
$string['alert3'] = 'Notificatie 3';

$string['alerttitle'] = 'Titel';
$string['alerttitledesc'] = 'Voer hier de titel van je notificatie in.';

$string['alerttype'] = 'Type';
$string['alerttypedesc'] = 'Stel hier het type notificatie in.';

$string['alerttext'] = 'Notificatie tekst';
$string['alerttextdesc'] = 'Voer hier de notificatie tekst in.';

$string['alert_info'] = 'Informatief';
$string['alert_warning'] = 'Waarschuwing';
$string['alert_general'] = 'Aankondiging';

$string['ie7message'] = '<p id="ie7message">Sorry, deze site vereist minimaal <strong>Internet Explorer 8</strong>. Update je browser via Windows Update.  Als je IE8 of hoger gebruik staat mogelijk Compatibility Modus aan, om deze site correct weer te geven moet dit uitgeschakeld staan.</p>';