The "Essential" Moodle Theme
======================

With 2.5 now released Julian thought it time to take the opportunity to build a new theme that would push the new theme engine to it's limits a bit. With that in mind he introduced the new "Essential" theme. Now Julian has left us for Canvassian adventures, Gareth and David have taken over development and maintenance of this theme.
The idea of this theme is to make the site look as little like Moodle as possible. In this specific instance, it would be used on sites where Moodle would potentially serve as a company homepage rather than just a course list.

Cool things to know about the theme.
 - It attempts to load as many as possible icons from a font
 - Most of what you think are "graphics" are actually the [Awesome font](http://fortawesome.github.io/Font-Awesome/)
 - The slider on the frontpage of the demo site is completely customisable through theme settings
 - I am really trying to push what [Bootstrap](http://twitter.github.io/bootstrap/) Grids can do. As such the theme is fully responsive.
 - The footer is all custom Moodle regions. This means blocks can be added. The footer of the demo site is full of HTML blocks in this instance
 - The Theme uses [Google web fonts](http://www.google.com/fonts/) to give it that extra bit of shazam!
 - Social Network icons appear at the top of the page dynamically based on theme settings
 - The entire colour scheme can be modified with theme settings
 - The homepage main area is just a label. The theme will ship with custom classes that you can set for tables and links to modify their formatting. No knowledge of code is needed as you can use the text editor to do this. Documentation will be provided outlining what the additional classes are.

New in 2.7.3
========================
- FIX: Fixed slide show by replacing with Bootstrap 2.3.2 one.  Issue #18.
- FIX: Make background image fixed and set a background transparent colour
- FIX: Permanently replace edit icons with FontAwesome icons
- FIX: Massive cleanup in all files, reducing CSS with 25%
- FIX: Fixed all custom block regions to stick where they are
- FIX: Displaying footer and header on login page as well
- FIX: Further language file cleanup, looking for maintainers of all non-english language files!
- FIX: Optimize code for much improved processing time
- FIX: Optimize javascript to reduce browser lag on load
- FIX: Resolve layout issues on font-rendering
- FIX: Set layout options for responsive rendering, more mobile support to come soon
- FIX: Load fonts through htmlwriter (Thanks Mary :))
- FIX: Fix various alignment issues
- FIX: Fix popup/secure header overlay for quizzes
- FIX: optimize code to make loading much faster
- NEW: Reduced amount of fonts in theme, added legacy themes for websafe support
- NEW: New slider with up to 16 slides, full responsive
- NEW: Footer will go all the way to bottom on modern browsers (except IE of course)
- NEW: Removed output of summary to header due to potential exploits
- NEW: Breadcrumb styling
- NEW: Login Block styling
- NEW: Full custom category icon settings (Thanks Danny Wahl)
- NEW: Transparent fixed background when setting a background image

New in 2.7.2
========================
- FIX: Slideshow CSS fixes
- FIX: Image alignment on slideshow
- NEW: Select slideshow background color
- NEW: Option to bring back the old navbar location
 
New in 2.7.1
========================
- FIX: Numerous CSS fixes
- FIX: Translation fixes
- FIX: Updated Google Analytics code
- FIX: Cleanup of code in files
- FIX: Fixed logout page blocks in footer
- FIX: Now also outputs detailed performance info when selected
- FIX: Various menu features (messaging/badges) only enabled when feature is enabled
- NEW: Dutch translation
- NEW: Moved menu bar to top
- NEW: Now allows setting target on links
- NEW: New slideshow design (WIP)
 
New in 2.6.3
========================
- FIX: Numerous CSS fixes
- FIX: Due to popular request reports are now 2 column again
- FIX: Significantly improved RTL support
- FIX: Back To Top link now moved to the right side so does not overlap on content
- FIX: Fixed layout of top icons.
- NEW: Can create alternative colour schemes for users to select.
- NEW: Can select icons for categories
- NEW: Add support for the max-layout-width feature when empty regions are used.
- NEW: Start Dutch translation

New in 2.6.2
========================
- FIX: Numerous CSS fixes
- FIX: Third level dropdown in custom menu now works
- FIX: iOS7 custom menu now works when changed to a sing dropdown in portrait view
- FIX: Social networking icons now line up properly
- FIX: GoogleFonts will now load in HTTPS setups
- NEW: Frontpage content now goes full width if all blocks removed.

New in 2.6.1
========================
- NEW: MAJOR UPDATES for 2.6 compatibility.
- NEW: Moved layouts to a more "Moodle standard" 1, 2 and 3 column layout.
- NEW: Can now add three columns of blocks to middle of the homepage under marketing spots.
- NEW: Theme setting added to allow admins to align frontage blocks to the left or right.
- NEW: Two designs for the slideshow available. One with image to the right, other with a background image.
- UPDATE: [Font Awesome 4.0.3](http://fontawesome.io/) now supported.
- UPDATE: Using new font setting to dynamically load the fonts.
- UPDATE: Removing autohide feature as no longer needed in Moodle 2.6
- FIX: Guest users no longer get "my courses" or "dashboard" dropdown menus.
- FIX: Nav Menu generates cleanly on IE.
- FIX: Gradebook now displays no blocks to maximise available space.
- FIX: Numerous CSS fixes and cleanup

New in 2.6
========================
- Added ability to select from 21 preset Google Font combinations or disable their use completely.
- Now includes additional Bootstrap JS plugins to allow for more dynamic formatting as shown on http://getbootstrap.com/javascript/
- New Frontpage Slideshow settings to allow to display; all the time, only before login, only after login or never.
- New Marketing Spots settings to allow to display; all the time, only before login, only after login or never.
- Course Labels are no longer in bold by default
- Now has a companion Mahara ePorfolio theme so you can keep them looking alike - https://github.com/moodleman/mahara-theme_essential
- Further minor bug fixes and tidy up.

New in 2.5.4
========================
- Display current enrolled courses in dropdown menu and choose terminology (modules, courses, classes or units).
- New 'My Dashboard" in custommenu provides quick links to student tools. Can be disabled in theme settings.
- iOS home screen icons now built in. Can upload your own via settings.
- Alerts for users can be added to the frontpage. (Originally dreamed up by Shaun Daubney and re-coded by me).
- Theme options to connect to Google Analytics.
- Advanced Google Analytics function allowing Clean URL's for better reporting. Contributed by @basbrands and @ghenrick. More info on this feature can be found in [this blog post](http://www.somerandomthoughts.com/blog/2012/04/18/ireland-uk-moodlemoot-analytics-to-the-front/)
- Significantly improved gradebook formatting.
- Toggle in Theme settings determines if FontAwesome is loaded from the theme or from the netdna.bootstrapcdn.com source.
- Back to top button for course pages.
- New "Frontpage Content" box to add custom content in between the slideshow and marketing spots.

Fixes in 2.5.4
=======================
- Fix to frontpage slideshow. First slide now loads properly.
- Updated include method to minimise conflicts with 3rd party plugins
- Code significantly optimised. (about 1/5 less lines!)
- Many CSS Fixes
- IMPORTANT: Theme requires Moodle 2.5.1 or higher

New in 2.5.3
========================
- New Settings screen just for colour selection
- Admin can now toggle to use "autohide" functionality in courses.
- Admin now upload their own background image
- Can now set colours for footer area
- Cleanup of required images (Theme now only uses 4 images)
- Performance info now neatly formatted.
- Fixed Custom Menu colour in IE8 and IE9
- Can now upload optional images into the marketing spots
- Now available in English, German, Russian, Turkish and Spanish (many thanks to the Moodle Community for translating)
- New Pinterest, Instagram, Skype and the Russian VK social networks added.
- Can now add links to Mobile apps on the iOS App Store and Google Play
- New formatting on login block
- Minor CSS Fixes
- EXPERIMENTAL: New course editing icons formatted and built with Font Awesome can now be used.
 
New in  2.5.2
========================
 - New theme setting to have user image show in the header when logged in.
 - Admin can choose to revert courses to a "standard" layout with blocks on the left and right sides
 - Admin can choose the default Navbar/breadcrumb separator
 - Frontage now is a 2 column layout by popular demand
 - Icons in navigation and administration block now rendered with Awesome Font
 - Font Awesome now loaded and cached through lib.php. Should improve performance
 - Minor CSS fixes
 
See the theme in Action
========================
A video showing many of the core features is available for viewing at http://vimeo.com/69683774

Documentation
=============
As always, documentation is a work in progress. Available documentation is available at http://docs.moodle.org/25/en/Essential_theme
If you have questions you can post them in the issue tracker at https://github.com/DBezemer/moodle-theme_essential/issues

Maintained by
========================
David Bezemer
Moodle profile: https://moodle.org/user/profile.php?id=1416592

G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.
Moodle profile: http://moodle.org/user/profile.php?id=442195
Web profile   : http://about.me/gjbarnard
