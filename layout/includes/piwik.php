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
 * Analytics
 *
 * This module provides extensive analytics on a platform of choice
 * Currently support Google Analytics and Piwik
 *
 * @package    local_analytics
 * @copyright  David Bezemer <info@davidbezemer.nl>, www.davidbezemer.nl
 * @author     David Bezemer <info@davidbezemer.nl>, Bas Brands <bmbrands@gmail.com>, Gavin Henrick <gavin@lts.ie>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function analytics_trackurl()
{
    global $DB, $PAGE;
    $pageinfo = get_context_info_array($PAGE->context->id);
    $trackurl = "'";

    // Adds course category name.
    if (isset($pageinfo[1]->category)) {
        if ($category = $DB->get_record('course_categories', array('id' => $pageinfo[1]->category))) {
            $cats = explode("/", $category->path);
            foreach (array_filter($cats) as $cat) {
                if ($categorydepth = $DB->get_record("course_categories", array("id" => $cat))) {
                    ;
                    $trackurl .= $categorydepth->name . '/';
                }
            }
        }
    }

    // Adds course full name.
    if (isset($pageinfo[1]->fullname)) {
        if (isset($pageinfo[2]->name)) {
            $trackurl .= $pageinfo[1]->fullname . '/';
        } else if ($PAGE->user_is_editing()) {
            $trackurl .= $pageinfo[1]->fullname . '/' . get_string('edit');
        } else {
            $trackurl .= $pageinfo[1]->fullname . '/' . get_string('view');
        }
    }

    // Adds activity name.
    if (isset($pageinfo[2]->name)) {
        $trackurl .= $pageinfo[2]->modname . '/' . $pageinfo[2]->name;
    }

    $trackurl .= "'";
    return $trackurl;
}

function insert_analytics_tracking()
{
    $imagetrack = theme_essential_get_setting('analyticsimagetrack');
    $siteurl = theme_essential_get_setting('analyticssiteurl');
    $siteid = theme_essential_get_setting('analyticssiteid');
    $trackadmin = theme_essential_get_setting('analyticstrackadmin');
    $cleanurl = theme_essential_get_setting('analyticscleanurl');
    $tracking = '';

    if (!empty($siteurl)) {
        if ($imagetrack) {
            $addition = '<noscript><p><img src="//' . $siteurl . '/piwik.php?idsite=' . $siteid . ' style="border:0" alt="" /></p></noscript>';
        } else {
            $addition = '';
        }

        if ($cleanurl) {
            $doctitle = "_paq.push(['setDocumentTitle', " . analytics_trackurl() . "]);";
        } else {
            $doctitle = "";
        }

        if (!is_siteadmin() || $trackadmin) {
            $tracking = "
				<script type='text/javascript'>
					var _paq = _paq || [];
					(function(){ var u=(('https:' == document.location.protocol) ? 'https://" . $siteurl . "/' : 'http://" . $siteurl . "/');
					_paq.push(['setSiteId', " . $siteid . "]);
					_paq.push(['setTrackerUrl', u+'piwik.php']);
					_paq.push(['trackPageView']);
					" . $doctitle . "
					_paq.push(['enableLinkTracking']);
					var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript'; g.defer=true; g.async=true; g.src=u+'piwik.js';
					s.parentNode.insertBefore(g,s); })();
				</script>
				" . $addition;
        }
    }
    return $tracking;
}

echo insert_analytics_tracking();