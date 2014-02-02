The "Essential" Moodle Theme
======================

With 2.5 now released I thought it time to take the opportunity to build a new theme that would push the new theme engine to it's limits a bit. With that in mind I am happy to introduce the new "Essential" theme.

The idea of this theme, as usual with my themes, is to make the site look as little like Moodle as possible. In this specific instance, it would be used on sites where Moodle would potentially serve as a company homepage rather than just a course list.

Cool things to know about the theme.
 - It only uses 4 images.
 - Most of what you think are "graphics" are actually the [Awesome font](http://fortawesome.github.io/Font-Awesome/)
 - The slider on the frontpage of the demo site is completely customisable through theme settings
 - I am really trying to push what [Bootstrap](http://twitter.github.io/bootstrap/) Grids can do. As such the theme is fully responsive.
 - The footer is all custom Moodle regions. This means blocks can be added. The footer of the demo site is full of HTML blocks in this instance
 - The Theme uses [Google web fonts](http://www.google.com/fonts/) to give it that extra bit of shazam!
 - Social Network icons appear at the top of the page dynamically based on theme settings
 - The entire color scheme can be modified with theme settings (like on [Rocket](https://moodle.org/plugins/view.php?plugin=theme_rocket))
 - The homepage main area is just a label. The theme will ship with custom classes that you can set for tables and links to modify their formatting. No knowledge of code is needed as you can use the text editor to do this. Documentation will be provided outlining what the additional classes are.
 
 New in 2.7
 ========================
 - FIX: Numerous CSS fixes
 - FIX: Due to popular request reports are now 2 column again
 - FIX: Significantly improved RTL support
 - FIX: Back To Top link now moved to the right side so does not overlap on content
 - FIX: Fixed layout of top icons.
 - NEW: Can create alternative color schemes for users to select.
 - NEW: Can select icons for categories
 - NEW: Add support for the max-layout-width feature when empty regions are used.
 
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
 - NEW: Moved layouts to a more "moodle standard" 1, 2 and 3 column layout.
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
 - Updated include method to minimse conflicts with 3rd party plugins
 - Code significanty optimised. (about 1/5 less lines!)
 - Many CSS Fixes
 - IMPORTANT: Theme requires Moodle 2.5.1 or higher

 New in 2.5.3
 ========================
 - New Settings screen just for color selection
 - Admin can now toggle to use "autohide" functionality in courses.
 - Admin now upload their own background image
 - Can now set colors for footer area
 - Cleanup of required images (Theme now only uses 4 images)
 - Performance info now neatly formatted.
 - Fixed Custom Menu color in IE8 and IE9
 - Can now upload optional images into the marketing spots
 - Now available in English, German, Russian, Turkish and Spanish (many thanks to the Moodle Community for translating)
 - New Pinterest, Instagram, Skype and the Russian VK social networks added.
 - Can now add links to Mobile apps on the iOS App Store and Google Play
 - New formatting on login block
 - Minor CSS Fixes
 - EXPERIMENTAL: New course editing icons formatted and built with Font Awesome can now be used.
 
2.5.2
========================
 - New theme setting to have user image show in the header when logged in.
 - Admin can choose to revert courses to a "standard" layout with blocks on the left and right sides
 - Admin can choose the default Navbar/breadcrumb seperator
 - Frontage now is a 2 column layout by popular demand
 - Icons in navigation and administration block now rendered with Awesome Font
 - Font Awesome now loaded and cached through lib.php. Should improve performance
 - Minor CSS fixes
 
See the theme in Action
========================

A video showing many of the core features is available for viewing at https://vimeo.com/channels/moodleman

If you would like to see it in action, head to this year's iMoot site at [http://2013.imoot.org](http://2013.imoot.org)


Documentation
=============

As always, documentation is a work in progress. Availbale documentation is available at http://docs.moodle.org/25/en/Essential_theme

If you have questions you can post them in the official discussion moodle.org forum at https://moodle.org/mod/forum/discuss.php?d=231970
