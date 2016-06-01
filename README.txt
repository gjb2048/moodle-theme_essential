The "Essential" Moodle Theme
============================

With 2.5 now released Julian thought it time to take the opportunity to build a new theme that would push the new theme engine
to it's limits a bit. With that in mind he introduced the new "Essential" theme.  Now Julian has left us for Canvassian
adventures, David and Gareth took over development and maintenance.  And now David has left for pastures new, Gareth continues
to maintain and make improvements.

The idea of this theme is to make the site look as little like Moodle as possible. In this specific instance, it would be used
on sites where Moodle would potentially serve as a company homepage rather than just a course list.

Cool things to know about the theme.
 - It attempts to load as many as possible icons from a font
 - Most of what you think are "graphics" are actually the [Awesome font](http://fortawesome.github.io/Font-Awesome/)
 - The slider on the front page of the demo site is completely customisable through theme settings
 - I am really trying to push what [Bootstrap](http://twitter.github.io/bootstrap/) Grids can do. As such the theme is fully
   responsive.
 - The footer is all custom Moodle regions. This means blocks can be added. The footer of the demo site is full of HTML blocks in
   this instance
 - The Theme uses [Google web fonts](http://www.google.com/fonts/) to give it that extra bit of shazam!
 - Social Network icons appear at the top of the page dynamically based on theme settings
 - The entire colour scheme can be modified with theme settings
 - The homepage main area is just a label. The theme will ship with custom classes that you can set for tables and links to modify
   their formatting.  No knowledge of code is needed as you can use the text editor to do this. Documentation will be provided
   outlining what the additional classes are.

Original Author
===============
Julian Ridden
Moodle profile: https://moodle.org/user/profile.php?id=39680
Web profile:    http://au.linkedin.com/in/eduridden/

Previous Authors
================
David Bezemer
Moodle profile | https://moodle.org/user/profile.php?id=1416592
Web profile | http://www.davidbezemer.nl

Maintained by
=============
G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.
Moodle profile | http://moodle.org/user/profile.php?id=442195
Web profile | http://about.me/gjbarnard

Free Software
=============
The Essential theme is 'free' software under the terms of the GNU GPLv3 License, please see 'COPYING.txt'.

It can be obtained for free from:
http://moodle.org/plugins/view.php?plugin=theme_essential
and
https://github.com/gjb2048/moodle-theme_essential/releases

You have all the rights granted to you by the GPLv3 license.  If you are unsure about anything, then the
FAQ - http://www.gnu.org/licenses/gpl-faq.html - is a good place to look.

If you reuse any of the code then I kindly ask that you make reference to the theme.

If you make improvements or bug fixes then I would appreciate if you would send them back to me by forking from
https://github.com/gjb2048/moodle-theme_essential and doing a 'Pull Request' so that the rest of the
Moodle community benefits.

Support
=======
As Essential is licensed under the GNU GPLv3 License it comes with NO support.  If you would like support from
me then I'm happy to provide it for a fee (please see my contact details above).  Otherwise, the 'Themes' forum:
moodle.org/mod/forum/view.php?id=46 is an excellent place to ask questions.

Sponsorships
============
This theme is provided to you for free, and if you want to express your gratitude for using this theme, please consider sponsoring
by:

PayPal - Please contact me via my 'Moodle profile' (above) for details as I am an individual and therefore am unable to have
'buy me now' buttons under their terms.

Flattr - https://flattr.com/profile/gjb2048

Sponsorships help to facilitate maintenance and allow me to provide you with more and better features.  Without your support the theme
cannot be maintained.

Sponsors
========
Sponsorships gratefully received with thanks from:
Mihai Bojonca, TCM International Institute.
Guido Hornig, actXcellence http://actxcellence.de
Delvon Forrester, Esparanza co uk
iZone
Anis Jradah
Ute Hlasek, https://hlasek-it.de/moodle

Essential for Moodle 3.0 kindly sponsored by
--------------------------------------------
Leila Hiret
Vilar da Camara Neto
Kees Koopman
Matej Topolovec
Mihai Bojonca
V. Y. S. Cavalcanti
Christian Kleinhanss
Nadav Kavalerchik
Francisco Gomez Gonzalez
Lazar Ivanov
Duval Arnaud
Kai ner Maa Pitanta
Gregory Reinert
M van der Niet
Floyd Saner
Andreas Schenkel
Gemma Lesterhuis
Roy Bentley
Duane Cox

Customisation
=============
If you like this theme and would like me to customise it, transpose functionality to another theme, build a new theme from scratch
or create a child theme then I offer competitive rates.  Please contact me via 'www.gjbarnard.co.uk/contact/' or
'gjbarnard at gmail dot com' or 'about.me/gjbarnard' to discuss your requirements.

Required version of Moodle
==========================
This version works with Moodle version 2015111600.00 3.0 (Build: 20151116) and above within the 3.0 branch until the
next release.

Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on
'docs.moodle.org/30/en/Installing_Moodle'.

Installation
============
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    theme relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the
    administrator.
 3. Copy the extracted 'essential' folder to the '/theme/' folder.
 4. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 5. Select as the theme for the site.
 6. Put Moodle out of Maintenance Mode.

Upgrading
=========
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    theme relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the
    administrator.
 3. Make a backup of your old 'essential' folder in '/theme/' and then delete the folder.
 4. Copy the replacement extracted 'essential' folder to the '/theme/' folder.
 5. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 6. If automatic 'Purge all caches' appears not to work by lack of display etc. then perform a manual 'Purge all caches'
    under 'Home -> Site administration -> Development -> Purge all caches'.
 7. Put Moodle out of Maintenance Mode.

Uninstallation
==============
 1. Put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 2. Change the theme to another theme of your choice.
 3. In '/theme/' remove the folder 'essential'.
 4. Put Moodle out of Maintenance Mode.

Downgrading
===========
If for any reason you wish to downgrade to a previous version of the theme (unsupported) then this procedure will inform you of how
to do so:
1.  Ensure that you have a copy of the existing and older replacement theme files.
2.  Put Moodle into 'Maintenance mode' under 'Home -> Administration -> Site administration -> Server -> Maintenance mode', so that
    there are no users using it bar you as the administrator.
3.  Switch to a core theme, 'Clean' for example, under 'Home -> Administration -> Site administration -> Appearance -> Themes ->
    Theme selector -> Default'.
4.  In '/theme/' remove the folder 'essential' i.e. ALL of the contents - this is VITAL.
5.  Put in the replacement 'essential' folder into '/theme/'.
6.  In the database, remove the row with the 'plugin' of 'theme_essential' and 'name' of 'version' in the 'config_plugins' table,
    then in the 'config' table find the 'name' with the value 'allversionhash' and clear its 'value' field.  Perform a
    'Purge all caches' under 'Home -> Site administration -> Development -> Purge all caches'.
7.  Go back in as an administrator and follow standard the 'plugin' update notification.  If needed, go to
    'Site administration' -> 'Notifications' if this does not happen.
8.  Switch the theme back to 'Essential' under 'Home -> Administration -> Site administration -> Appearance -> Themes ->
    Theme selector -> Default'.
9.  Put Moodle out of 'Maintenance mode' under 'Home -> Administration -> Site administration -> Server -> Maintenance mode'.

CSlider
=======
The original version of Essential used 'CSlider' - 
  http://tympanus.net/codrops/2012/03/15/parallax-content-slider-with-css3-and-jquery/.

It has been removed because of licencing issues: https://github.com/gjb2048/moodle-theme_essential/issues/61

Please do not request that it be put back.  The licence that CSlider has is incompatible with GPLv3 and therefore cannot be a part
of or redistributed with the theme.

Videos and FitVids
==================
Essential uses FitVids.js - http://fitvidsjs.com/ - to make embedded videos responsive.  If you do not want this feature for a
particular video, then please add the class 'fitvidsignore' to the video element.

WOFF2 Font Support
==================
WOFF2 font support will automatically kick in if you are running Moodle 2.8.5+ (Build: 20150313) - 2014111005.01 or above.  If you
are and the settings do not appear on the font setting page when using 'Custom font' for 'fontselect', then perform a
'Purge all caches'.

Category course title image in a course
=======================================
If you wish to override the category course title image in a course when this is enabled, then edit the course summary in the course
settings and add an image.  Then edit in HTML mode, remove the surrounding 'p' tags and 'br' tag, then remove the 'style', 'width' and
'height' attributes and any 'classes' added by the text editor on the 'img' tag.  Then add the class 'categorycti'.  To specifiy
the height (px) and the contained title text colour, background colour and opacity, use the following attributes: 'ctih', 'ctit',
'ctib' and ctio respectively, for example:

<img src="https://mymoodleinstall.mr/pluginfile.php/493/course/section/237/myimage.jpg" alt="Replacement image" class="categorycti"
 ctih="250" ctit="#afafaf" ctib="#222222" ctio="0.5">

This image will not be shown in the summary itself when viewing the list of courses.

Reporting issues
================
Before reporting an issue, please ensure that you are running the latest version for your release of Moodle.  It is essential
that you are operating the required version of Moodle as stated at the top - this is because the theme relies on core
functionality that is out of its control.

When reporting an issue you can post in the theme's forum on Moodle.org (currently 'moodle.org/mod/forum/view.php?id=46')
or check the issue list https://github.com/gjb2048/moodle-theme_essential/issues and if the problem does not exist, create an
issue.

It is essential that you provide as much information as possible, the critical information being the contents of the theme's 
'version.php' file.  Other version information such as specific Moodle version, theme name and version also helps.  A screen shot
can be really useful in visualising the issue along with any files you consider to be relevant.

History
=======
Please look in CHANGES.txt.

See the theme in Action
=======================
A video showing many of the core features is available for viewing at https://www.youtube.com/watch?v=grhmR5PmWtA

Documentation
=============
As always, documentation is a work in progress. Available documentation is available at http://docs.moodle.org/30/en/Essential_theme
If you have questions you can post them in the issue tracker at https://github.com/gjb2048/moodle-theme_essential/issues