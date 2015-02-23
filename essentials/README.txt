The "Essentials" Moodle Theme
======================
Essentials is a basic child theme of Essential to help you as a theme developer create your own child theme of Essential.

Essentials is provided 'AS IS' so that you may learn from it and use it as the starting point of your child.  If you want to change
the name of this theme, then follow the standard procedure for cloning a theme: https://docs.moodle.org/dev/Cloning_a_theme.

You MUST have 'Essential' installed for this child theme to work.  The 'version.php' file contains the correct 'required' dependent
version of 'Essential'.

Maintained by
=============
G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.
Moodle profile | http://moodle.org/user/profile.php?id=442195
Web profile | http://about.me/gjbarnard

Free Software
=============
The Essentials theme is 'free' software under the terms of the GNU GPLv3 License, please see 'COPYING.txt'.

It is a child theme within 'Essential' - folder 'essentials' can be obtained for free from:
http://moodle.org/plugins/view.php?plugin=theme_essential
and
https://github.com/gjb2048/moodle-theme_essential/releases

You have all the rights granted to you by the GPLv3 license.  If you are unsure about anything, then the
FAQ - http://www.gnu.org/licenses/gpl-faq.html - is a good place to look.

If you reuse any of the code then I kindly ask that you make reference to the theme.

If you make improvements or bug fixes then I would appreciate if you would send them back to me by forking from
https://github.com/gjb2048/moodle-theme_essential and doing a 'Pull Request' so that the rest of the
Moodle community benefits.

Donations
=========
This theme is provided to you for free, and if you want to express your gratitude for using this theme, please consider donating by:

PayPal - Please contact me via my 'Moodle profile' (above) for details as I am an individual and therefore am unable to have 'donation' / 'buy me now' buttons under their terms.

Flattr - https://flattr.com/profile/gjb2048

Donations may allow me to provide you with more or better features in less time.

Required version of Moodle
==========================
This version works with Moodle version 2014111000.00 release 2.8 (Build: 20141110) and above within the 2.8 branch until the
next release.

Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on
'docs.moodle.org/28/en/Installing_Moodle'.

Installation
============
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    theme relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Copy the 'essentials' folder to the '/theme/' folder.
 4. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 5. Select as the theme for the site.
 6. Put Moodle out of Maintenance Mode.

Upgrading
=========
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    theme relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Make a backup of your old 'essentials' folder in '/theme/' and then delete the folder.
 4. Copy the replacement extracted 'essentials' folder to the '/theme/' folder.
 5. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 6. If automatic 'Purge all caches' appears not to work by lack of display etc. then perform a manual 'Purge all caches'
    under 'Home -> Site administration -> Development -> Purge all caches'.
 7. Put Moodle out of Maintenance Mode.

Uninstallation
==============
 1. Put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 2. Change the theme to another theme of your choice.
 3. In '/theme/' remove the folder 'essentials'.
 4. Put Moodle out of Maintenance Mode.

Downgrading
===========
If for any reason you wish to downgrade to a previous version of the theme (unsupported) then this procedure will inform you of how to
do so:
1.  Ensure that you have a copy of the existing and older replacement theme files.
2.  Put Moodle into 'Maintenance mode' under 'Home -> Administration -> Site administration -> Server -> Maintenance mode', so that there
    are no users using it bar you as the administrator.
3.  Switch to a core theme, 'Clean' for example, under 'Home -> Administration -> Site administration -> Appearance -> Themes ->
    Theme selector -> Default'.
4.  In '/theme/' remove the folder 'essentials' i.e. ALL of the contents - this is VITAL.
5.  Put in the replacement 'essentials' folder into '/theme/'.
6.  In the database, remove the row with the 'plugin' of 'theme_essentials' and 'name' of 'version' in the 'config_plugins' table, then
    in the 'config' table find the 'name' with the value 'allversionhash' and clear its 'value' field.  Perform a 'Purge all caches'
    under 'Home -> Site administration -> Development -> Purge all caches'.
7.  Go back in as an administrator and follow standard the 'plugin' update notification.  If needed, go to
    'Site administration' -> 'Notifications' if this does not happen.
8.  Switch the theme back to 'Essentials' under 'Home -> Administration -> Site administration -> Appearance -> Themes -> Theme selector ->
    Default'.
9.  Put Moodle out of 'Maintenance mode' under 'Home -> Administration -> Site administration -> Server -> Maintenance mode'.

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

New in 2.8.0.3
==============
- UPD: Update layout include code.

New in 2.8.0.1
==============
- NEW: First version.

Documentation
=============
As always, documentation is a work in progress. Available documentation is available at http://docs.moodle.org/28/en/Essential_theme
If you have questions you can post them in the issue tracker at https://github.com/gjb2048/moodle-theme_essential/issues