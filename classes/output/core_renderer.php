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
 * Essential is a clean and customizable theme.
 *
 * @package     theme_essential
 * @copyright   2016 Gareth J Barnard
 * @copyright   2015 Gareth J Barnard
 * @copyright   2014 Gareth J Barnard, David Bezemer
 * @copyright   2013 Julian Ridden
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_essential\output;

use block_contents;
use block_move_target;
use coding_exception;
use context_course;
use custom_menu;
use custom_menu_item;
use html_writer;
use moodle_page;
use moodle_url;
use pix_icon;
use stdClass;

class core_renderer extends \core_renderer {
    use core_renderer_toolbox;
    public $language = null;
    protected $themeconfig;

    protected $essential = null; // Used for determining if this is a Essential or child of renderer.

    /**
     * Constructor
     *
     * @param moodle_page $page the page we are doing output for.
     * @param string $target one of rendering target constants
     */
    public function __construct(moodle_page $page, $target) {
        parent::__construct($page, $target);
        $this->themeconfig = array(\theme_config::load('essential'));
    }

    /**
     * This renders the breadcrumbs
     * @return string $breadcrumbs
     */
    public function navbar() {
        $breadcrumbstyle = \theme_essential\toolbox::get_setting('breadcrumbstyle');
        if ($breadcrumbstyle) {
            if ($breadcrumbstyle == '4') {
                $breadcrumbstyle = '1'; // Fancy style with no collapse.
            }

            $showcategories = true;
            if (($this->page->pagelayout == 'course') || ($this->page->pagelayout == 'incourse')) {
                $showcategories = \theme_essential\toolbox::get_setting('categoryincoursebreadcrumbfeature');
            }

            $breadcrumbs = html_writer::tag('span', get_string('pagepath'), array('class' => 'accesshide', 'id' => 'navbar-label'));
            $breadcrumbs .= html_writer::start_tag('nav', array('aria-labelledby' => 'navbar-label'));
            $breadcrumbs .= html_writer::start_tag('ul', array('class' => "breadcrumb style$breadcrumbstyle"));
            foreach ($this->page->navbar->get_items() as $item) {
                // Test for single space hide section name trick.
                if ((strlen($item->text) == 1) && ($item->text[0] == ' ')) {
                    continue;
                }
                if ((!$showcategories) && ($item->type == \navigation_node::TYPE_CATEGORY)) {
                    continue;
                }
                $item->hideicon = true;
                $breadcrumbs .= html_writer::tag('li', $this->render($item));
            }
            $breadcrumbs .= html_writer::end_tag('ul');
            $breadcrumbs .= html_writer::end_tag('nav');
        } else {
            $breadcrumbs = '';
        }
        return $breadcrumbs;
    }

    /**
     * This renders a notification message.
     * Uses bootstrap compatible html.
     * @param string $message
     * @param string $class
     * @return string $notification
     */
    public function notification($message, $class = 'notifyproblem') {
        $message = \clean_text($message);
        $type = '';

        if ($class == 'notifyproblem') {
            $type = 'alert alert-error';
        } else if ($class == 'notifysuccess') {
            $type = 'alert alert-success';
        } else if ($class == 'notifymessage') {
            $type = 'alert alert-info';
        } else if ($class == 'redirectmessage') {
            $type = 'alert alert-block alert-info';
        }
        $notification = "<div class=\"$type\">$message</div>";
        return $notification;
    }

    /**
     * Outputs the page's footer
     * @return string HTML fragment
     */
    public function footer() {
        global $CFG;

        $output = $this->container_end_all(true);

        $footer = $this->opencontainers->pop('header/footer');

        // Provide some performance info if required.
        $performanceinfo = '';
        if (defined('MDL_PERF') || (!empty($CFG->perfdebug) and $CFG->perfdebug > 7)) {
            $perf = get_performance_info();
            if (defined('MDL_PERFTOLOG') && !function_exists('register_shutdown_function')) {
                // @codingStandardsIgnoreStart
                error_log("PERF: " . $perf['txt']);
                // @codingStandardsIgnoreEnd
            }
            if (defined('MDL_PERFTOFOOT') || debugging() || $CFG->perfdebug > 7) {
                $performanceinfo = $this->performance_output($perf, \theme_essential\toolbox::get_setting('perfinfo'));
            }
        }

        $footer = str_replace($this->unique_performance_info_token, $performanceinfo, $footer);
        $footer = str_replace($this->unique_end_html_token, $this->page->requires->get_end_code(), $footer);
        $this->page->set_state(moodle_page::STATE_DONE);
        $info = '<!-- Essential theme version: '.$this->page->theme->settings->version.
            ', developed, enhanced and maintained by Gareth J Barnard: about.me/gjbarnard -->';

        return $output . $footer . $info;
    }

    /**
     * Outputs a heading
     *
     * @param string $text The text of the heading
     * @param int $level The level of importance of the heading. Defaulting to 2
     * @param string $classes A space-separated list of CSS classes. Defaulting to null
     * @param string $id An optional ID
     * @return string the HTML to output.
     */
    public function heading($text, $level = 2, $classes = null, $id = null) {
        $heading = parent::heading($text, $level, $classes, $id);

        if (($level == 2) && ($this->page->pagelayout == 'incourse') && (is_object($this->page->cm)) &&
            (\theme_essential\toolbox::get_setting('returntosectionfeature'))) {
            static $called = false;
            if (!$called) {
                $markup = html_writer::start_tag('div', array('class' => 'row-fluid'));

                $markup .= html_writer::start_tag('div', array('class' => 'span8'));
                $markup .= $heading;
                $markup .= html_writer::end_tag('div');

                $markup .= html_writer::start_tag('div', array('class' => 'span4 heading-rts'));
                $markup .= $this->return_to_section();
                $markup .= html_writer::end_tag('div');

                $markup .= html_writer::end_tag('div');
                $called = true;

                return $markup;
            }
        }
        return $heading;
    }

    /**
     * Outputs the course title.
     *
     * @return string the HTML to output.
     */
    public function course_title() {
        $content = '';
        if ($this->page->course->id > 1) {
            $enablecategorycti = $this->get_setting('enablecategorycti');
            $override = false;
            if ($enablecategorycti) {
                // Is there an override?
                if (strpos($this->page->course->summary, 'categorycti') !== false) {
                    $context = \context_course::instance($this->page->course->id);
                    $summary = file_rewrite_pluginfile_urls($this->page->course->summary, 'pluginfile.php',
                        $context->id, 'course', 'summary', null);

                    $matches = array();
                    if (preg_match_all("/<img[^>]*>/", $summary, $matches) !== false) {
                        foreach ($matches[0] as $imgmatches) {
                            if (strpos($imgmatches, 'categorycti') !== false) {
                                $imgparts = array();
                                if (preg_match_all("/(src|ctih|ctit|ctib|ctio)=\"([^\"]*)\"/", $imgmatches, $imgparts) !== false) {
                                    $imgvalues = array('ctih' => '200', 'ctit' => '#ffffff', 'ctib' => '#222222',
                                        'ctio' => '0.8');
                                    $ctihs = $this->get_setting('ctioverrideheight');
                                    $ctits = $this->get_setting('ctioverridetextcolour');
                                    $ctibs = $this->get_setting('ctioverridetextbackgroundcolour');
                                    $ctios = $this->get_setting('ctioverridetextbackgroundopacity');
                                    if ($ctihs) {
                                        $imgvalues['ctih'] = $ctihs;
                                    }
                                    if ($ctits) {
                                        $imgvalues['ctit'] = $ctits;
                                    }
                                    if ($ctibs) {
                                        $imgvalues['ctib'] = $ctibs;
                                    }
                                    if ($ctios) {
                                        $imgvalues['ctio'] = $ctios;
                                    }
                                    // Index '1' is the 'key' and index '2' is the value.  Index '0' is them combined.
                                    foreach ($imgparts[1] as $imgpartskey => $imgpartsvalue) {
                                        $imgvalues[$imgpartsvalue] = $imgparts[2][$imgpartskey];
                                    }
                                    $override = true;
                                    $content .= '<div class="categorycti" style="height: '.$imgvalues['ctih'].'px;';
                                    $content .= ' background-image: url('.$imgvalues['src'].');">';
                                    /* This is a level 1 h1 header so no need to call 'heading' method for return to section
                                       and also parent version does not support addition of the style attribute. */
                                    $content .= '<h1 class="coursetitle" style="color: '.$imgvalues['ctit'].'; background-color: ';
                                    $content .= $imgvalues['ctib'].'; opacity: '.$imgvalues['ctio'].';">';
                                    $content .= format_string($this->page->course->fullname).'</h1>';
                                    // Closing 'div' is below because $enablecategorycti would be true.
                                }
                                break;
                            }
                        }
                    }
                }
                // If the override did not exist or was not ok, then see if there is a category image.
                if ($override == false) {
                    $imagecatid = $this->get_categorycti_catid();
                    if ($imagecatid) {
                        $content .= '<div class=\'categorycti categorycti-'.$imagecatid.'\' >';
                    } else {
                        $enablecategorycti = false;
                    }
                }
            }
            if ($override == false) {
                $content .= $this->heading(format_string($this->page->course->fullname), 1, 'coursetitle');
            }
            if ($enablecategorycti) {
                $content .= '</div>';
            }

            $content .= '<div class="bor"></div>';
        }

        return $content;
    }

    /**
     * Gets the current category.
     *
     * @return int Category id.
     */
    protected function get_current_category() {
        $catid = 0;

        if (is_array($this->page->categories)) {
            $catids = array_keys($this->page->categories);
            $catid = reset($catids);
        } else if (!empty($$this->page->course->category)) {
            $catid = $this->page->course->category;
        }

        return $catid;
    }

    /**
     * Gets the category course title image category id for the given category or 0 if not found.
     * Walks up the parent tree if the current category does not have an image.
     *
     * @return int Category id.
     */
    protected function get_categorycti_catid() {
        $catid = 0;
        $currentcatid = $this->get_current_category();

        if ($currentcatid) {
            $image = $this->get_setting('categoryct'.$currentcatid.'image');
            if ($image) {
                $catid = $currentcatid;
            } else {
                $imageurl = $this->get_setting('categoryctimageurl'.$currentcatid);
                if ($imageurl) {
                    $catid = $currentcatid;
                } else {
                    $parents = array_reverse(\coursecat::get($currentcatid)->get_parents());
                    foreach ($parents as $parent) {
                        $image = $this->get_setting('categoryct'.$parent.'image');
                        if ($image) {
                            $catid = $parent;
                            break;
                        }
                        $imageurl = $this->get_setting('categoryctimageurl'.$parent);
                        if ($imageurl) {
                            $catid = $parent;
                            break;
                        }
                    }
                }
            }
        }

        return $catid;
    }

    /**
     * Returns course-specific information to be output immediately below content on any course page
     * (for the current course)
     *
     * @param bool $onlyifnotcalledbefore output content only if it has not been output before
     * @return string
     */
    public function course_content_footer($onlyifnotcalledbefore = false) {
        if ($this->page->course->id == SITEID) {
            // Return immediately and do not include /course/lib.php if not necessary.
            return '';
        }
        static $functioncalled = false;
        if ($functioncalled && $onlyifnotcalledbefore) {
            // We have already output the content header.
            return '';
        }
        $functioncalled = true;

        $markup = parent::course_content_footer($onlyifnotcalledbefore);
        if (($this->page->pagelayout == 'incourse') && (is_object($this->page->cm)) &&
            (\theme_essential\toolbox::get_setting('returntosectionfeature'))) {
            $markup .= html_writer::start_tag('div', array('class' => 'row-fluid'));
            $markup .= html_writer::start_tag('div', array('class' => 'span12 text-center footer-rts'));
            $markup .= $this->return_to_section();
            $markup .= html_writer::end_tag('div');
            $markup .= html_writer::end_tag('div');
        }

        return $markup;
    }

    /**
     * Generate the return to section X button code.
     * @return markup.
     */
    protected function return_to_section() {
        static $markup = null;
        if ($markup === null) {
            $url = new moodle_url('/course/view.php');
            $url->param('id', $this->page->course->id);
            $url->param('sesskey', sesskey());
            $courseformat = \course_get_format($this->page->course);
            $courseformatsettings = $courseformat->get_format_options();

            $sectionname = $courseformat->get_section_name($this->page->cm->sectionnum);
            $sectionnamelen = mb_strlen($sectionname);
            if ($sectionnamelen !== false) {
                $sectionnamelimit = \theme_essential\toolbox::get_setting('returntosectiontextlimitfeature');
                if (($sectionnamelimit) && ($sectionnamelen > $sectionnamelimit)) {
                    $sectionname = substr($sectionname, 0, $sectionnamelimit).'...';
                }
            }

            if ((!empty($courseformatsettings['coursedisplay'])) &&
                ($courseformatsettings['coursedisplay'] == \COURSE_DISPLAY_MULTIPAGE)) {
                $url->param('section', $this->page->cm->sectionnum);
                $href = $url->out(false);
            } else {
                $href = $url->out(false).'#section-'.$this->page->cm->sectionnum;
            }
            $title = get_string('returntosection', 'theme_essential', array('section' => $sectionname));

            $markup = html_writer::tag('a', $title.html_writer::tag('i', '', array('class' => 'fa-sign-in fa fa-fw')),
                array('href' => $href, 'class' => 'btn btn-default', 'title' => $title));
        }

        return $markup;
    }

    /**
     * Defines the Moodle custom_menu
     * @param string $custommenuitems
     * @return render_custom_menu for $custommenu
     */
    public function custom_menu($custommenuitems = '') {
        global $CFG;

        if (empty($custommenuitems) && !empty($CFG->custommenuitems)) {
            $custommenuitems = $CFG->custommenuitems;
        }
        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }

    /**
     * Renders the custom_menu
     * @param custom_menu $menu
     * @return string $content
     */
    protected function render_custom_menu(custom_menu $menu) {

        $content = '<ul class="nav">';
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }
        $content .= '</ul>';
        return $content;
    }

    /**
     * Renders menu items for the custom_menu
     * @param custom_menu_item $menunode
     * @param int $level
     * @return string $content
     */
    protected function render_custom_menu_item(custom_menu_item $menunode, $level = 0) {
        static $submenucount = 0;

        if ($menunode->has_children()) {

            if ($level == 1) {
                $class = 'dropdown';
            } else {
                $class = 'dropdown-submenu';
            }

            if ($menunode === $this->language) {
                $class .= ' langmenu';
            }
            $content = html_writer::start_tag('li', array('class' => $class));

            // If the child has menus render it as a sub menu.
            $submenucount++;
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#cm_submenu_' . $submenucount;
            }
            $content .= html_writer::start_tag('a', array('href' => $url, 'class' => 'dropdown-toggle',
                'data-toggle' => 'dropdown', 'title' => $menunode->get_title()));
            $content .= $menunode->get_text();
            if ($level == 1) {
                $content .= $this->getfontawesomemarkup('caret-right');
            }
            $content .= '</a>';
            $content .= '<ul class="dropdown-menu">';
            foreach ($menunode->get_children() as $menunode) {
                $content .= $this->render_custom_menu_item($menunode, 0);
            }
            $content .= '</ul>';
        } else {
            // Also, if the node's text matches '####', add a class so we can treat it as a divider.
            $content = '';
            if (preg_match("/^#+$/", $menunode->get_text())) {
                // This is a divider.
                $content = html_writer::start_tag('li', array('class' => 'divider'));
            } else {
                $content = html_writer::start_tag('li');
                // The node doesn't have children so produce a final menuitem.
                $class = '';
                if ($menunode->get_url() !== null) {
                    $url = $menunode->get_url();
                    $class = $url->get_param('essentialcolours');
                } else {
                    $url = '#';
                }
                $content .= html_writer::link($url, $menunode->get_text(), array('title' => $menunode->get_title(),
                    'class' => $class));
            }
            $content .= html_writer::end_tag('li');
        }
        return $content;
    }

    /**
     * Outputs the language menu
     * @return custom_menu object
     */
    public function custom_menu_language() {
        global $CFG;
        $langmenu = new custom_menu();

        $addlangmenu = true;
        $langs = get_string_manager()->get_list_of_translations();
        if (count($langs) < 2
            or empty($CFG->langmenu)
            or ($this->page->course != SITEID and !empty($this->page->course->lang))
        ) {
            $addlangmenu = false;
        }

        if ($addlangmenu) {
            $strlang = get_string('language');
            $currentlang = current_language();
            if (isset($langs[$currentlang])) {
                $currentlang = $langs[$currentlang];
            } else {
                $currentlang = $strlang;
            }
            $this->language = $langmenu->add($this->getfontawesomemarkup('flag').$currentlang, new moodle_url('#'), $strlang, 100);
            foreach ($langs as $langtype => $langname) {
                $this->language->add($this->getfontawesomemarkup('language').$langname, new moodle_url($this->page->url,
                    array('lang' => $langtype)), $langname);
            }
        }
        return $this->render_custom_menu($langmenu);
    }

    /**
     * Outputs the courses menu
     * @return custom_menu object
     */
    public function custom_menu_courses() {
        global $CFG;

        $coursemenu = new custom_menu();

        $hasdisplaymycourses = \theme_essential\toolbox::get_setting('displaymycourses');
        if (isloggedin() && !isguestuser() && $hasdisplaymycourses) {
            $mycoursetitle = \theme_essential\toolbox::get_setting('mycoursetitle');
            if ($mycoursetitle == 'module') {
                $branchtitle = get_string('mymodules', 'theme_essential');
            } else if ($mycoursetitle == 'unit') {
                $branchtitle = get_string('myunits', 'theme_essential');
            } else if ($mycoursetitle == 'class') {
                $branchtitle = get_string('myclasses', 'theme_essential');
            } else {
                $branchtitle = get_string('mycourses', 'theme_essential');
            }
            $branchlabel = $this->getfontawesomemarkup('briefcase').$branchtitle;
            $branchurl = new moodle_url('');
            $branchsort = 200;

            $branch = $coursemenu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

            $hometext = get_string('myhome');
            $homelabel = html_writer::tag('span', '', array('class' => 'fa fa-home')).html_writer::tag('span', ' '.$hometext);
            $branch->add($homelabel, new moodle_url('/my/index.php'), $hometext);

            // Get 'My courses' sort preference from admin config.
            if (!$sortorder = $CFG->navsortmycoursessort) {
                $sortorder = 'sortorder';
            }

            // Retrieve courses and add them to the menu when they are visible.
            $numcourses = 0;
            $hasdisplayhiddenmycourses = \theme_essential\toolbox::get_setting('displayhiddenmycourses');
            if ($courses = enrol_get_my_courses(null, $sortorder . ' ASC')) {
                foreach ($courses as $course) {
                    if ($course->visible) {
                        $branch->add('<span class="fa fa-graduation-cap"></span>'.format_string($course->fullname),
                            new moodle_url('/course/view.php?id=' . $course->id), format_string($course->shortname));
                        $numcourses += 1;
                    } else if (has_capability('moodle/course:viewhiddencourses', context_course::instance($course->id)) && $hasdisplayhiddenmycourses) {
                        $branchtitle = format_string($course->shortname);
                        $branchlabel = '<span class="dimmed_text">'.$this->getfontawesomemarkup('eye-slash').
                            format_string($course->fullname) . '</span>';
                        $branchurl = new moodle_url('/course/view.php', array('id' => $course->id));
                        $branch->add($branchlabel, $branchurl, $branchtitle);
                        $numcourses += 1;
                    }
                }
            }
            if ($numcourses == 0 || empty($courses)) {
                $noenrolments = get_string('noenrolments', 'theme_essential');
                $branch->add('<em>' . $noenrolments . '</em>', new moodle_url('#'), $noenrolments);
            }
        }
        return $this->render_custom_menu($coursemenu);
    }

    /**
     * Outputs the alternative colours menu
     * @return custom_menu object
     */
    public function custom_menu_themecolours() {
        $colourmenu = new custom_menu();

        if (!isguestuser()) {
            $alternativethemes = array();
            foreach (range(1, 4) as $alternativethemenumber) {
                if (\theme_essential\toolbox::get_setting('enablealternativethemecolors' . $alternativethemenumber)) {
                    $alternativethemes[] = $alternativethemenumber;
                }
            }
            if (!empty($alternativethemes)) {
                $branchtitle = get_string('themecolors', 'theme_essential');
                $branchlabel = $this->getfontawesomemarkup('th-large'). $branchtitle;
                $branchurl = new moodle_url('#');
                $branchsort = 300;
                $branch = $colourmenu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

                $defaultthemecolorslabel = get_string('defaultcolors', 'theme_essential');
                $branch->add($this->getfontawesomemarkup('square', array('colours-default')).$defaultthemecolorslabel,
                    new moodle_url($this->page->url, array('essentialcolours' => 'default')), $defaultthemecolorslabel);
                foreach ($alternativethemes as $alternativethemenumber) {
                    if (\theme_essential\toolbox::get_setting('alternativethemename' . $alternativethemenumber)) {
                        $alternativethemeslabel = \theme_essential\toolbox::get_setting(
                            'alternativethemename'.$alternativethemenumber);
                    } else {
                        $alternativethemeslabel = get_string('alternativecolors', 'theme_essential', $alternativethemenumber);
                    }
                    $branch->add($this->getfontawesomemarkup('square', array('colours-alternative'.$alternativethemenumber)).
                        $alternativethemeslabel,
                        new moodle_url($this->page->url, array('essentialcolours' => 'alternative' . $alternativethemenumber)),
                            $alternativethemeslabel);
                }
            }
        }
        return $this->render_custom_menu($colourmenu);
    }

    /**
     * Outputs the Activity Stream menu
     * @return custom_menu object
     */
    public function custom_menu_activitystream() {
        if (!isguestuser()) {
            if ((($this->page->pagelayout == 'course') || ($this->page->pagelayout == 'incourse') ||
                ($this->page->pagelayout == 'report') || ($this->page->pagelayout == 'admin') ||
                ($this->page->pagelayout == 'standard')) &&
                ((!empty($this->page->course->id) && $this->page->course->id > 1))) {
                $activitystreammenu = new custom_menu();
                $branchtitle = get_string('thiscourse', 'theme_essential');
                $branchlabel = $this->getfontawesomemarkup('book').$branchtitle;
                $branchurl = new moodle_url('#');
                $branch = $activitystreammenu->add($branchlabel, $branchurl, $branchtitle, 10002);
                $branchtitle = get_string('people', 'theme_essential');
                $branchlabel = $this->getfontawesomemarkup('users').$branchtitle;
                $branchurl = new moodle_url('/user/index.php', array('id' => $this->page->course->id));
                $branch->add($branchlabel, $branchurl, $branchtitle, 100003);
                $context = context_course::instance($this->page->course->id);
                if (((has_capability('gradereport/overview:view', $context) || has_capability('gradereport/user:view', $context)) &&
                        $this->page->course->showgrades) || has_capability('gradereport/grader:view', $context)) {
                    $branchtitle = get_string('grades');
                    $branchlabel = $this->getfontawesomemarkup('list-alt', array('icon')).$branchtitle;
                    $branchurl = new moodle_url('/grade/report/index.php', array('id' => $this->page->course->id));
                    $branch->add($branchlabel, $branchurl, $branchtitle, 100004);
                }

                $data = $this->get_course_activities();
                foreach ($data as $modname => $modfullname) {
                    if ($modname === 'resources') {
                        $icon = $this->pix_icon('icon', '', 'mod_page', array('class' => 'icon'));
                        $branch->add($icon.$modfullname, new moodle_url('/course/resources.php',
                            array('id' => $this->page->course->id)));
                    } else {
                        $icon = '<img src="'.$this->pix_url('icon', $modname) . '" class="icon" alt="" />';
                        $branch->add($icon.$modfullname, new moodle_url('/mod/'.$modname.'/index.php',
                            array('id' => $this->page->course->id)));
                    }
                }
                return $this->render_custom_menu($activitystreammenu);
            }
        }
        return '';
    }

    private function get_course_activities() {
        // A copy of block_activity_modules.
        $course = $this->page->course;
        $modinfo = get_fast_modinfo($course);
        $course = course_get_format($course)->get_course();
        $modfullnames = array();
        $archetypes = array();

        foreach ($modinfo->get_section_info_all() as $section => $thissection) {
            if (((!empty($course->numsections)) and ($section > $course->numsections)) or (empty($modinfo->sections[$section]))) {
                // This is a stealth section or is empty.
                continue;
            }
            foreach ($modinfo->sections[$thissection->section] as $modnumber) {
                $cm = $modinfo->cms[$modnumber];
                // Exclude activities which are not visible or have no link (=label).
                if (!$cm->uservisible or !$cm->has_view()) {
                    continue;
                }
                if (array_key_exists($cm->modname, $modfullnames)) {
                    continue;
                }
                if (!array_key_exists($cm->modname, $archetypes)) {
                    $archetypes[$cm->modname] = plugin_supports('mod', $cm->modname, FEATURE_MOD_ARCHETYPE, MOD_ARCHETYPE_OTHER);
                }
                if ($archetypes[$cm->modname] == MOD_ARCHETYPE_RESOURCE) {
                    if (!array_key_exists('resources', $modfullnames)) {
                        $modfullnames['resources'] = get_string('resources');
                    }
                } else {
                    $modfullnames[$cm->modname] = $cm->modplural;
                }
            }
        }
        \core_collator::asort($modfullnames);

        return $modfullnames;
    }

    /**
     * Outputs the messages menu
     * @return custom_menu object
     */
    public function custom_menu_messages() {
        global $CFG;
        $messagemenu = new custom_menu();

        if (!isloggedin() || isguestuser() || empty($CFG->messaging)) {
            return false;
        }

        $messages = $this->get_user_messages();
        $totalmessages = count($messages['messages']);

        if (empty($totalmessages)) {
            $messagemenuicon = html_writer::tag('i', '', array('class' => 'fa fa-envelope-o'));
            $messagetitle = get_string('nomessagesfound', 'theme_essential');
            $messagemenutext = html_writer::span($messagemenuicon);
            $messagemenu->add(
                $messagemenutext,
                new moodle_url('/message/index.php', array('viewing' => 'recentconversations')),
                $messagetitle,
                9999
            );
        } else {

            if (empty($messages['newmessages'])) {
                $messagemenuicon = html_writer::tag('i', '', array('class' => 'fa fa-envelope-o'));
            } else {
                $messagemenuicon = html_writer::tag('i', '', array('class' => 'fa fa-envelope'));
            }
            $messagetitle = get_string('unreadmessages', 'message', $messages['newmessages']);

            $messagemenutext = html_writer::tag('span', $messages['newmessages']) . $messagemenuicon;
            $messagesubmenu = $messagemenu->add(
                $messagemenutext,
                new moodle_url('/message/index.php', array('viewing' => 'recentconversations')),
                $messagetitle,
                9999
            );

            foreach ($messages['messages'] as $message) {
                $addclass = 'read';
                $iconadd = '-o';

                if ($message->unread) {
                    $addclass = 'unread';
                    $iconadd = '';
                }
                if ($message->type === 'notification') {
                    $messagecontent = html_writer::start_div('notification ' . $addclass);
                    $messagecontent .= html_writer::tag('i', '', array('class' => 'fa fa-info-circle icon'));
                    $messagecontent .= html_writer::start_span('msg-time');
                    $messagecontent .= html_writer::tag('i', '', array('class' => 'fa fa-comment'.$iconadd));
                    $messagecontent .= $this->get_time_difference($message->date);
                    $messagecontent .= html_writer::end_span();
                    $messagecontent .= html_writer::span(htmlspecialchars($message->text, ENT_COMPAT | ENT_HTML401, 'UTF-8'),
                        'notification-text');
                    $messagecontent .= html_writer::end_div();
                } else {
                    if (!is_object($message->from) || !empty($message->from->deleted)) {
                        continue;
                    }
                    $senderpicture = new \user_picture($message->from);
                    $senderpicture->link = false;
                    $senderpicture->size = 60;

                    $messagecontent = html_writer::start_div('message ' . $addclass);
                    $messagecontent .= html_writer::start_span('msg-picture').$this->render($senderpicture).
                        html_writer::end_span();
                    $messagecontent .= html_writer::start_span('msg-body');
                    $messagecontent .= html_writer::start_span('msg-time');
                    $messagecontent .= html_writer::tag('i', '', array('class' => 'fa fa-comments'.$iconadd));
                    $messagecontent .= $this->get_time_difference($message->date);
                    $messagecontent .= html_writer::end_span();
                    $messagecontent .= html_writer::span($message->from->firstname, 'msg-sender');
                    $messagecontent .= html_writer::span($message->text, 'msg-text');
                    $messagecontent .= html_writer::end_span();
                    $messagecontent .= html_writer::end_div();
                }

                $messagesubmenu->add($messagecontent, $message->url, $message->text);
            }
        }
        return $this->render_custom_menu($messagemenu);
    }

    /**
     * Retrieves messages from the database
     * @return array $messagelist
     */
    private function get_user_messages() {
        global $USER, $DB;
        $messagelist['messages'] = array();
        $maxmessages = 5;

        $newmessagesql = "SELECT id, smallmessage, useridfrom, useridto, timecreated, fullmessageformat, notification, contexturl
                          FROM {message}
                          WHERE useridto = :userid
                          ORDER BY timecreated DESC";

        $messages = $DB->get_records_sql($newmessagesql, array('userid' => $USER->id), 0, $maxmessages);
        $messagelist['newmessages'] = count($messages);

        foreach ($messages as $message) {
            $messagelist['messages'][] = $this->process_message($message);
        }

        if ($messagelist['newmessages'] < $maxmessages) {
            $maxmessages = 5 - $messagelist['newmessages'];

            $readmessagesql = "
                SELECT id, smallmessage, useridfrom, useridto, timecreated, timeread, fullmessageformat,notification, contexturl
                FROM {message_read}
                WHERE useridto = :userid
                ORDER BY timecreated DESC";

            $messages = $DB->get_records_sql($readmessagesql, array('userid' => $USER->id), 0, $maxmessages);

            foreach ($messages as $message) {
                if (!$message->notification) {
                    $messagelist['messages'][] = $this->process_message($message);
                }
            }
        }

        return $messagelist;

    }

    /**
     * Takes the content of messages from database and makes it usable
     * @param $message object
     * @return object $messagecontent
     */
    private function process_message($message) {
        global $DB, $USER;
        $messagecontent = new stdClass();

        if ($message->notification || $message->useridfrom < 1) {
            $messagecontent->text = $message->smallmessage;
            $messagecontent->type = 'notification';
            $messagecontent->url = new moodle_url($message->contexturl);
            if (empty($message->contexturl)) {
                $messagecontent->url = new moodle_url('/message/index.php', array('user1' => $USER->id,
                    'viewing' => 'recentnotifications'));
            }
        } else {
            $messagecontent->type = 'message';
            if ($message->fullmessageformat == FORMAT_HTML) {
                $message->smallmessage = html_to_text($message->smallmessage);
            }
            if (strlen($message->smallmessage) > 18) {
                $messagecontent->text = substr($message->smallmessage, 0, 15) . '...';
            } else {
                $messagecontent->text = $message->smallmessage;
            }
            $messagecontent->from = $DB->get_record('user', array('id' => $message->useridfrom));
            $messagecontent->url = new moodle_url('/message/index.php', array('user1' => $USER->id,
                'user2' => $message->useridfrom));
        }

        $options = new stdClass();
        $options->para = false;
        $messagecontent->text = format_text($messagecontent->text, FORMAT_PLAIN, $options);
        $messagecontent->text = strip_tags($messagecontent->text);

        $messagecontent->date = $message->timecreated;
        $messagecontent->unread = empty($message->timeread);
        return $messagecontent;
    }

    /**
     * Calculates time difference between now and a timestamp
     * @param $created_time int
     * @return string
     */
    private function get_time_difference($createdtime) {
        // It returns the time difference in Seconds...
        $timedifference = time() - $createdtime;

        // To Calculate the time difference in Years...
        $years = 60 * 60 * 24 * 365;

        // To Calculate the time difference in Months...
        $months = 60 * 60 * 24 * 30;

        // To Calculate the time difference in Days...
        $days = 60 * 60 * 24;

        // To Calculate the time difference in Hours...
        $hours = 60 * 60;

        // To Calculate the time difference in Minutes...
        $minutes = 60;

        if (intval($timedifference / $years) > 1) {
            return get_string('ago', 'core_message', intval($timedifference / $years).' '.get_string('years'));
        } else if (intval($timedifference / $years) > 0) {
            return get_string('ago', 'core_message', intval($timedifference / $years).' '.get_string('year'));
        } else if (intval($timedifference / $months) > 1) {
            return get_string('ago', 'core_message', intval($timedifference / $months).' '.get_string('months'));
        } else if (intval(($timedifference / $months)) > 0) {
            return get_string('ago', 'core_message', intval($timedifference / $months).' '.get_string('month'));
        } else if (intval(($timedifference / $days)) > 1) {
            return get_string('ago', 'core_message', intval($timedifference / $days).' '.get_string('days'));
        } else if (intval(($timedifference / $days)) > 0) {
            return get_string('ago', 'core_message', intval($timedifference / $days).' '.get_string('day'));
        } else if (intval(($timedifference / $hours)) > 1) {
            return get_string('ago', 'core_message', intval($timedifference / $hours).' '.get_string('hours'));
        } else if (intval(($timedifference / $hours)) > 0) {
            return get_string('ago', 'core_message', intval($timedifference / $hours).' '.get_string('hour'));
        } else if (intval(($timedifference / $minutes)) > 1) {
            return get_string('ago', 'core_message', intval($timedifference / $minutes).' '.get_string('minutes'));
        } else if (intval(($timedifference / $minutes)) > 0) {
            return get_string('ago', 'core_message', intval($timedifference / $minutes).' '.get_string('minute'));
        } else if (intval(($timedifference)) > 20) {
            return get_string('ago', 'core_message', intval($timedifference).' '.get_string('seconds'));
        } else {
            return get_string('ago', 'core_message', get_string('few', 'theme_essential').get_string('seconds'));
        }
    }

    /**
     * Outputs the goto bottom menu.
     * @return custom_menu object
     */
    public function custom_menu_goto_bottom() {
        $html = '';
        if (($this->page->pagelayout == 'course') || ($this->page->pagelayout == 'incourse') ||
            ($this->page->pagelayout == 'admin')) { // Go to bottom.
            $menu = new custom_menu();
            $gotobottom = html_writer::tag('i', '', array('class' => 'fa fa-arrow-circle-o-down'));
            $menu->add($gotobottom, new moodle_url('#region-main'), get_string('gotobottom', 'theme_essential'));
            $html = $this->render_custom_menu($menu);
        }
        return $html;
    }

    public function custom_menu_editing() {
        $html = '';
        if (\theme_essential\toolbox::get_setting('displayeditingmenu')) {
            if ($this->page->user_allowed_editing()) {
                $menu = new custom_menu();
                $buttontoadd = true; // Only set to false when cannot determine what the URL / params should be for a page type.
                $pagetype = $this->page->pagetype;
                if (strpos($pagetype, 'admin-setting') !== false) {
                    $pagetype = 'admin-setting'; // Deal with all setting page types.
                } else if ((strpos($pagetype, 'mod') !== false) &&
                    ((strpos($pagetype, 'edit') !== false) || (strpos($pagetype, 'view') !== false))) {
                    $pagetype = 'mod-edit-view'; // Deal with all mod edit / view page types.
                } else if (strpos($pagetype, 'mod-data-field') !== false) {
                    $pagetype = 'mod-data-field'; // Deal with all mod data field page types.
                } else if (strpos($pagetype, 'mod-lesson') !== false) {
                    $pagetype = 'mod-lesson'; // Deal with all mod lesson page types.
                }
                switch ($pagetype) {
                    case 'site-index':
                    case 'calendar-view':  // Slightly faulty as even the navigation link goes back to the frontpage.  TODO: MDL.
                        $url = new moodle_url('/course/view.php');
                        $url->param('id', 1);
                        if ($this->page->user_is_editing()) {
                            $url->param('edit', 'off');
                        } else {
                            $url->param('edit', 'on');
                        }
                    break;
                    case 'admin-index':
                    case 'admin-setting':
                        $url = $this->page->url;
                        if ($this->page->user_is_editing()) {
                            $url->param('adminedit', 0);
                        } else {
                            $url->param('adminedit', 1);
                        }
                    break;
                    case 'course-index':
                    case 'course-management':
                    case 'course-search':
                    case 'mod-resource-mod':
                    case 'tag-search':
                        $buttontoadd = false;
                    break;
                    case 'mod-data-field':
                    case 'mod-edit-view':
                    case 'mod-forum-discuss':
                    case 'mod-forum-index':
                    case 'mod-forum-search':
                    case 'mod-forum-subscribers':
                    case 'mod-lesson':
                    case 'mod-quiz-index':
                    case 'mod-scorm-player':
                        $url = new moodle_url('/course/view.php');
                        $url->param('id', $this->page->course->id);
                        $url->param('return', $this->page->url->out_as_local_url(false));
                        if ($this->page->user_is_editing()) {
                            $url->param('edit', 'off');
                        } else {
                            $url->param('edit', 'on');
                        }
                    break;
                    case 'my-index':
                    case 'user-profile':
                        // TODO: Not sure how to get 'id' param and if it is really needed.
                        $url = $this->page->url;
                        // Umm! Both /user/profile.php and /user/profilesys.php have the same page type but different parameters!
                        if ($this->page->user_is_editing()) {
                            $url->param('adminedit', 0);
                            $url->param('edit', 0);
                        } else {
                            $url->param('adminedit', 1);
                            $url->param('edit', 1);
                        }
                    break;
                    default:
                        $url = $this->page->url;
                        if ($this->page->user_is_editing()) {
                            $url->param('edit', 'off');
                        } else {
                            $url->param('edit', 'on');
                        }
                    break;
                }
                if ($buttontoadd) {
                    $url->param('sesskey', sesskey());
                    if ($this->page->user_is_editing()) {
                        $editstring = get_string('turneditingoff');
                        $iconclass = 'fa-power-off fa fa-fw';
                    } else {
                        $editstring = get_string('turneditingon');
                        $iconclass = 'fa-edit fa fa-fw';
                    }
                    $edit = html_writer::tag('i', '', array('class' => $iconclass));
                    $menu->add($edit, $url, $editstring);
                    $html = $this->render_custom_menu($menu);

                    if (\theme_essential\toolbox::get_setting('hidedefaulteditingbutton')) {
                        // Unset button on page.
                        $this->page->set_button('');
                    }
                }
            }
        }
        return $html;
    }

    /**
     * Internal implementation of user image rendering.
     *
     * @param user_picture $userpicture
     * @return string
     */
    protected function render_user_picture(\user_picture $userpicture) {
        if ($this->page->pagetype == 'mod-forum-discuss') {
            $userpicture->size = 1;
        }
        return parent::render_user_picture($userpicture);
    }

    /**
     * Outputs the user menu.
     * @return custom_menu object
     */
    public function custom_menu_user() {
        // Die if executed during install.
        if (during_initial_install()) {
            return false;
        }

        global $USER, $CFG, $DB;
        $loginurl = get_login_url();

        $usermenu = html_writer::start_tag('ul', array('class' => 'nav'));
        $usermenu .= html_writer::start_tag('li', array('class' => 'dropdown'));

        if (!isloggedin()) {
            if ($this->page->pagelayout != 'login') {
                $userpic = '<em>'.$this->getfontawesomemarkup('sign-in').get_string('login').'</em>';
                $usermenu .= html_writer::link($loginurl, $userpic, array('class' => 'loginurl'));
            }
        } else if (isguestuser()) {
            $userurl = new moodle_url('#');
            $userpic = parent::user_picture($USER, array('link' => false));
            $caret = $this->getfontawesomemarkup('caret-right');
            $userclass = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');
            $usermenu .= html_writer::link($userurl, $userpic.get_string('guest').$caret, $userclass);

            // Render direct login link.
            $usermenu .= html_writer::start_tag('ul', array('class' => 'dropdown-menu pull-right'));
            $branchlabel = '<em>'.$this->getfontawesomemarkup('sign-in').get_string('login').'</em>';
            $branchurl = new moodle_url('/login/index.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            // Render Help Link.
            $usermenu .= $this->theme_essential_render_helplink();

            $usermenu .= html_writer::end_tag('ul');

        } else {
            $course = $this->page->course;
            $context = context_course::instance($course->id);

            // Output Profile link.
            $userurl = new moodle_url('#');
            $userpic = parent::user_picture($USER, array('link' => false));
            $caret = $this->getfontawesomemarkup('caret-right');
            $userclass = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');

            if (!empty($USER->alternatename)) {
                $usermenu .= html_writer::link($userurl, $userpic.$USER->alternatename.$caret, $userclass);
            } else {
                $usermenu .= html_writer::link($userurl, $userpic.$USER->firstname.$caret, $userclass);
            }

            // Start dropdown menu items.
            $usermenu .= html_writer::start_tag('ul', array('class' => 'dropdown-menu pull-right'));

            if (\core\session\manager::is_loggedinas()) {
                $realuser = \core\session\manager::get_realuser();
                $branchlabel = '<em>'.$this->getfontawesomemarkup('key').fullname($realuser, true).
                    get_string('loggedinas', 'theme_essential').fullname($USER, true).'</em>';
            } else {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('user').fullname($USER, true).'</em>';
            }
            $branchurl = new moodle_url('/user/profile.php', array('id' => $USER->id));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            if (is_mnet_remote_user($USER) && $idprovider = $DB->get_record('mnet_host', array('id' => $USER->mnethostid))) {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('users').get_string('loggedinfrom', 'theme_essential').
                    $idprovider->name.'</em>';
                $branchurl = new moodle_url($idprovider->wwwroot);
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            if (is_role_switched($course->id)) { // Has switched roles.
                $branchlabel = '<em>'.$this->getfontawesomemarkup('users').get_string('switchrolereturn').'</em>';
                $branchurl = new moodle_url('/course/switchrole.php', array('id' => $course->id, 'sesskey' => sesskey(),
                    'switchrole' => 0, 'returnurl' => $this->page->url->out_as_local_url(false)));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Add preferences submenu.
            $usermenu .= $this->theme_essential_render_preferences($context);

            $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));

            // Output Calendar link if user is allowed to edit own calendar entries.
            if (has_capability('moodle/calendar:manageownentries', $context)) {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('calendar').
                    get_string('pluginname', 'block_calendar_month').'</em>';
                $branchurl = new moodle_url('/calendar/view.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Check if messaging is enabled.
            if (!empty($CFG->messaging)) {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('envelope').get_string('pluginname', 'block_messages').'</em>';
                $branchurl = new moodle_url('/message/index.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Check if user is allowed to manage files.
            if (has_capability('moodle/user:manageownfiles', $context)) {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('file').get_string('privatefiles', 'block_private_files').'</em>';
                $branchurl = new moodle_url('/user/files.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Check if user is allowed to view discussions.
            if (has_capability('mod/forum:viewdiscussion', $context)) {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('list-alt').get_string('forumposts', 'mod_forum').'</em>';
                $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

                $branchlabel = '<em>'.$this->getfontawesomemarkup('list').get_string('discussions', 'mod_forum').'</em>';
                $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id, 'mode' => 'discussions'));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

                $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));
            }

            // Output user grade links, course sensitive where appropriate.
            if ($course->id == SITEID) {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('list-alt').get_string('mygrades', 'theme_essential').'</em>';
                $branchurl = new moodle_url('/grade/report/overview/index.php', array('userid' => $USER->id));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            } else {
                if (has_capability('gradereport/overview:view', $context)) {
                    $branchlabel = '<em>'.$this->getfontawesomemarkup('list-alt').get_string('mygrades', 'theme_essential').'</em>';
                    $params = array('userid' => $USER->id);
                    if ($course->showgrades) {
                        $params['id'] = $course->id;
                    }
                    $branchurl = new moodle_url('/grade/report/overview/index.php', $params);
                    $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
                }

                if (has_capability('gradereport/user:view', $context) && $course->showgrades) {
                    // In Course also output Course grade links.
                    $branchlabel = '<em>'.$this->getfontawesomemarkup('list-alt').
                        get_string('coursegrades', 'theme_essential').'</em>';
                    $branchurl = new moodle_url('/grade/report/user/index.php', array('id' => $course->id, 'userid' => $USER->id));
                    $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
                }
            }

            // Check if badges are enabled.
            if (!empty($CFG->enablebadges) && has_capability('moodle/badges:manageownbadges', $context)) {
                $branchlabel = '<em>'.$this->getfontawesomemarkup('certificate').get_string('badges').'</em>';
                $branchurl = new moodle_url('/badges/mybadges.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }
            $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));

            // Render direct logout link.
            $branchlabel = '<em>'.$this->getfontawesomemarkup('sign-out').get_string('logout').'</em>';
            if (\core\session\manager::is_loggedinas()) {
                $branchurl = new moodle_url('/course/loginas.php', array('id' => $course->id, 'sesskey' => sesskey()));
            } else {
                $branchurl = new moodle_url('/login/logout.php', array('sesskey' => sesskey()));
            }
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            // Render Help Link.
            $usermenu .= $this->theme_essential_render_helplink();

            $usermenu .= html_writer::end_tag('ul');
        }

        $usermenu .= html_writer::end_tag('li');
        $usermenu .= html_writer::end_tag('ul');

        return $usermenu;
    }

    /**
     * Renders helplink
     *
     * @return string
     */
    protected function theme_essential_render_helplink() {
        global $USER, $CFG;
        if (!\theme_essential\toolbox::get_setting('helplinktype')) {
            return false;
        }
        $branchlabel = '<em>'.$this->getfontawesomemarkup('question-circle').get_string('help').'</em>';
        $branchurl = '';
        $target = '';

        if (\theme_essential\toolbox::get_setting('helplinktype') === '1') {
            if (\theme_essential\toolbox::get_setting('helplink') &&
                    filter_var(\theme_essential\toolbox::get_setting('helplink'), FILTER_VALIDATE_EMAIL)) {
                $branchurl = 'mailto:' . \theme_essential\toolbox::get_setting('helplink').'?cc='.$USER->email;
            } else if ($CFG->supportemail && filter_var($CFG->supportemail, FILTER_VALIDATE_EMAIL)) {
                $branchurl = 'mailto:'.$CFG->supportemail.'?cc='.$USER->email;
            } else {
                if (is_siteadmin()) {
                    $branchurl = preg_replace("(https?:)", "", $CFG->wwwroot).'/admin/settings.php?section=theme_essential_header';
                }
                $branchlabel = '<em>'.$this->getfontawesomemarkup('exclamation-triangle', array('red')).
                    get_string('invalidemail').'</em>';
            }
        }

        if (\theme_essential\toolbox::get_setting('helplinktype') === '2') {
            if (\theme_essential\toolbox::get_setting('helplink') &&
                    filter_var(\theme_essential\toolbox::get_setting('helplink'),
                        FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
                $branchurl = \theme_essential\toolbox::get_setting('helplink');
                $target = '_blank';
            } else if ((!\theme_essential\toolbox::get_setting('helplink')) &&
                (filter_var($CFG->supportpage, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED))) {
                $branchurl = $CFG->supportpage;
                $target = '_blank';
            } else {
                if (is_siteadmin()) {
                    $branchurl = preg_replace("(https?:)", "", $CFG->wwwroot).'/admin/settings.php?section=theme_essential_header';
                }
                $branchlabel = '<em>'.$this->getfontawesomemarkup('exclamation-triangle', array('red')).
                    get_string('invalidurl', 'error').'</em>';
            }

        }

        return html_writer::tag('li', html_writer::link($branchurl, $branchlabel, array('target' => $target)));
    }

    /**
     * Renders preferences submenu
     *
     * @param integer $context
     * @return string $preferences
     */
    protected function theme_essential_render_preferences($context) {
        global $USER, $CFG;
        $label = '<em>'.$this->getfontawesomemarkup('cog').get_string('preferences').'</em>';
        $preferences = html_writer::start_tag('li', array('class' => 'dropdown-submenu preferences'));
        $preferences .= html_writer::link(new moodle_url('#'), $label,
            array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        $preferences .= html_writer::start_tag('ul', array('class' => 'dropdown-menu'));

        $branchlabel = '<em>'.$this->getfontawesomemarkup('user').get_string('user', 'moodle').'</em>';
        $branchurl = new moodle_url('/user/preferences.php', array('userid' => $USER->id));
        $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        // Check if user is allowed to edit profile.
        if (has_capability('moodle/user:editownprofile', $context)) {
            $branchlabel = '<em>'.$this->getfontawesomemarkup('info-circle').get_string('editmyprofile').'</em>';
            $branchurl = new moodle_url('/user/edit.php', array('id' => $USER->id));
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if (has_capability('moodle/user:changeownpassword', $context)) {
            $branchlabel = '<em>'.$this->getfontawesomemarkup('key').get_string('changepassword').'</em>';
            $branchurl = new moodle_url('/login/change_password.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if (has_capability('moodle/user:editownmessageprofile', $context)) {
            $branchlabel = '<em>'.$this->getfontawesomemarkup('comments').get_string('message', 'message').'</em>';
            $branchurl = new moodle_url('/message/edit.php', array('id' => $USER->id));
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if ($CFG->enableblogs) {
            $branchlabel = '<em>'.$this->getfontawesomemarkup('rss-square').get_string('blog', 'blog').'</em>';
            $branchurl = new moodle_url('/blog/preferences.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if ($CFG->enablebadges && has_capability('moodle/badges:manageownbadges', $context)) {
            $branchlabel = '<em>'.$this->getfontawesomemarkup('certificate').
                get_string('badgepreferences', 'theme_essential').'</em>';
            $branchurl = new moodle_url('/badges/preferences.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        $preferences .= html_writer::end_tag('ul');
        $preferences .= html_writer::end_tag('li');
        return $preferences;
    }

    /**
     * Renders tabtree
     *
     * @param tabtree $tabtree
     * @return string
     */
    public function render_tabtree(\tabtree $tabtree) {
        if (empty($tabtree->subtree)) {
            return false;
        }
        $firstrow = $secondrow = '';
        foreach ($tabtree->subtree as $tab) {
            $firstrow .= $this->render($tab);
            if (($tab->selected || $tab->activated) && !empty($tab->subtree) && $tab->subtree !== array()) {
                $secondrow = $this->tabtree($tab->subtree);
            }
        }
        return html_writer::tag('ul', $firstrow, array('class' => 'nav nav-tabs')) . $secondrow;
    }

    /**
     * Renders tabobject (part of tabtree)
     *
     * This function is called from {@link core_renderer::render_tabtree()}
     * and also it calls itself when printing the $tabobject subtree recursively.
     *
     * @param tabobject $tab
     * @return string HTML fragment
     */
    public function render_tabobject(\tabobject $tab) {
        if ($tab->selected or $tab->activated) {
            return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'active'));
        } else if ($tab->inactive) {
            return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'disabled'));
        } else {
            if (!($tab->link instanceof moodle_url)) {
                // Backward compartibility when link was passed as quoted string.
                $link = "<a href=\"$tab->link\" title=\"$tab->title\">$tab->text</a>";
            } else {
                $link = html_writer::link($tab->link, $tab->text, array('title' => $tab->title));
            }
            return html_writer::tag('li', $link);
        }
    }

    /*
    * This code replaces icons in with
    * FontAwesome variants where available.
    */

    public function render_pix_icon(pix_icon $icon) {
        static $icons = array(
            'add' => 'plus',
            'book' => 'book',
            'chapter' => 'file',
            'docs' => 'question-circle',
            'generate' => 'gift',
            'i/marker' => 'lightbulb-o',
            'i/delete' => 'times-circle',
            'i/dragdrop' => 'arrows',
            'i/loading' => 'refresh fa-spin fa-2x',
            'i/loading_small' => 'refresh fa-spin',
            'i/backup' => 'cloud-download',
            'i/checkpermissions' => 'user',
            'i/edit' => 'pencil',
            'i/enrolusers' => 'user-plus',
            'i/filter' => 'filter',
            'i/grades' => 'table',
            'i/group' => 'group',
            'i/groupn' => 'user',
            'i/groupv' => 'user-plus',
            'i/groups' => 'user-secret',
            'i/hide' => 'eye',
            'i/import' => 'upload',
            'i/move_2d' => 'arrows',
            'i/navigationitem' => 'file',
            'i/outcomes' => 'magic',
            'i/preview' => 'search',
            'i/publish' => 'globe',
            'i/reload' => 'refresh',
            'i/report' => 'list-alt',
            'i/restore' => 'cloud-upload',
            'i/return' => 'repeat',
            'i/roles' => 'user',
            'i/cohort' => 'users',
            'i/scales' => 'signal',
            'i/settings' => 'cogs',
            'i/show' => 'eye-slash',
            'i/switchrole' => 'random',
            'i/user' => 'user',
            'i/users' => 'user',
            't/right' => 'arrow-right',
            't/left' => 'arrow-left',
            't/edit_menu' => 'cogs',
            'i/withsubcat' => 'indent',
            'i/permissions' => 'key',
            'i/assignroles' => 'lock',
            't/assignroles' => 'lock',
            't/cohort' => 'users',
            't/delete' => 'times-circle',
            't/edit' => 'cog',
            't/hide' => 'eye',
            't/show' => 'eye-slash',
            't/up' => 'arrow-up',
            't/down' => 'arrow-down',
            't/copy' => 'copy',
            't/block_to_dock' => 'caret-square-o-left',
            't/sort' => 'sort',
            't/sort_asc' => 'sort-asc',
            't/sort_desc' => 'sort-desc',
            't/grades' => 'th-list',
            't/preview' => 'search'
        );
        if (array_key_exists($icon->pix, $icons)) {
            $pix = $icons[$icon->pix];
            /* Note: MUST have the 'i' tag instead of 'span' and the embedded icon even though it is not displayed otherwise
               the editing action menu will break! */
            if (empty($icon->attributes['alt'])) {
                return '<i class="fa fa-'.$pix.' icon" aria-hidden="true">'.parent::render_pix_icon($icon).'</i>';
            } else {
                $alt = $icon->attributes['alt'];
                return '<i class="fa fa-'.$pix.' icon" title="'.$alt.'" aria-hidden="true">'.parent::render_pix_icon($icon).'</i>';
            }
        } else {
            return parent::render_pix_icon($icon);
        }
    }

    /**
     * Returns HTML to display a "Turn editing on/off" button in a form.
     *
     * @param moodle_url $url The URL + params to send through when clicking the button
     * @return string HTML the button
     * Written by G J Barnard
     */

    public function edit_button(moodle_url $url) {
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $btn = 'btn-danger';
            $title = get_string('turneditingoff');
            $icon = 'fa-power-off';
        } else {
            $url->param('edit', 'on');
            $btn = 'btn-success';
            $title = get_string('turneditingon');
            $icon = 'fa-edit';
        }
        return html_writer::tag('a', html_writer::start_tag('i', array('class' => $icon . ' fa fa-fw')) .
            html_writer::end_tag('i').$title, array('href' => $url, 'class' => 'btn '.$btn, 'title' => $title));
    }

    public function render_social_network($socialnetwork) {
        if (\theme_essential\toolbox::get_setting($socialnetwork)) {
            $icon = $socialnetwork;
            if ($socialnetwork === 'googleplus') {
                $icon = 'google-plus';
            } else if ($socialnetwork === 'website') {
                $icon = 'globe';
            } else if ($socialnetwork === 'ios') {
                $icon = 'apple';
            } else if ($socialnetwork === 'winphone') {
                $icon = 'windows';
            }
            $socialhtml = html_writer::start_tag('li');
            $socialhtml .= html_writer::start_tag('button', array('type' => "button",
                'class' => 'socialicon ' . $socialnetwork,
                'onclick' => "window.open('".\theme_essential\toolbox::get_setting($socialnetwork)."')",
                'title' => get_string($socialnetwork, 'theme_essential'),
            ));
            $socialhtml .= html_writer::start_tag('i', array('class' => 'fa fa-'.$icon));
            $socialhtml .= html_writer::end_tag('i');
            $socialhtml .= html_writer::start_span('sr-only').html_writer::end_span();
            $socialhtml .= html_writer::end_tag('button');
            $socialhtml .= html_writer::end_tag('li');

            return $socialhtml;

        } else {
            return false;
        }
    }

    /**
     * Get the HTML for blocks in the given region.
     *
     * @since 2.5.1 2.6
     * @param string $region The region to get HTML for.
     * @param array $classes array of classes for the tag.
     * @param string $tag Tag to use.
     * @param int $footer if > 0 then this is a footer block specifying the number of blocks per row, max of '4'.
     * @return string HTML.
     */
    public function essential_blocks($region, $classes = array(), $tag = 'aside', $footer = 0) {
        $displayregion = $this->page->apply_theme_region_manipulations($region);
        $classes = (array) $classes;
        $classes[] = 'block-region';

        $attributes = array(
            'id' => 'block-region-' . preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $displayregion),
            'class' => join(' ', $classes),
            'data-blockregion' => $displayregion,
            'data-droptarget' => '1'
        );

        if ($this->page->blocks->region_has_content($displayregion, $this)) {
            if ($footer > 0) {
                $attributes['class'] .= ' footer-blocks';
                $editing = $this->page->user_is_editing();
                if ($editing) {
                    $attributes['class'] .= ' footer-edit';
                }
                $output = html_writer::tag($tag,
                    $this->essential_blocks_for_region($displayregion, $footer, $editing), $attributes);
            } else {
                $output = html_writer::tag($tag, $this->blocks_for_region($displayregion), $attributes);
            }
        } else {
            $output = '';
        }

        return $output;
    }

    /**
     * Output all the blocks in a particular region.
     *
     * @param string $region the name of a region on this page.
     * @param int $blocksperrow Number of blocks per row, if > 4 will be set at 4.
     * @param boolean $editing If we are editing.
     * @return string the HTML to be output.
     */
    protected function essential_blocks_for_region($region, $blocksperrow, $editing) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';

        $blockcount = count($blockcontents);

        if ($blockcount >= 1) {
            if (!$editing) {
                $output .= html_writer::start_tag('div', array('class' => 'row-fluid'));
            }
            $blocks = $this->page->blocks->get_blocks_for_region($region);
            $lastblock = null;
            $zones = array();
            foreach ($blocks as $block) {
                $zones[] = $block->title;
            }

            /* When editing we want all the blocks to be the same as side-pre / side-post so set by CSS:
             *
             * aside.footer-edit .block {
             *     .footer-fluid-span(3);
             * }
             */
            if (($blocksperrow > 4) || ($editing)) {
                $blocksperrow = 4; // Will result in a 'span3' when more than one row.
            }
            $rows = $blockcount / $blocksperrow; // Maximum blocks per row.

            if (!$editing) {
                if ($rows <= 1) {
                    $span = 12 / $blockcount;
                    if ($span < 1) {
                        // Should not happen but a fail safe - block will be small so good for screen shots when this happens.
                        $span = 1;
                    }
                } else {
                    $span = 12 / $blocksperrow;
                }
            }

            $currentblockcount = 0;
            $currentrow = 0;
            $currentrequiredrow = 1;
            foreach ($blockcontents as $bc) {

                if (!$editing) { // Using CSS and special 'span3' only when editing.
                    $currentblockcount++;
                    if ($currentblockcount > ($currentrequiredrow * $blocksperrow)) {
                        // Tripping point.
                        $currentrequiredrow++;
                        // Break...
                        $output .= html_writer::end_tag('div');
                        $output .= html_writer::start_tag('div', array('class' => 'row-fluid'));
                        // Recalculate 'span' if needed...
                        $remainingblocks = $blockcount - ($currentblockcount - 1);
                        if ($remainingblocks < $blocksperrow) {
                            $span = 12 / $remainingblocks;
                            if ($span < 1) {
                                /* Should not happen but a fail safe.
                                   Block will be small so good for screen shots when this happens. */
                                $span = 1;
                            }
                        }
                    }

                    if ($currentrow < $currentrequiredrow) {
                        $currentrow = $currentrequiredrow;
                    }

                    // Class 'desktop-first-column' done in CSS with ':first-of-type' and ':nth-of-type'.
                    // Class 'spanX' done in CSS with calculated special width class as fixed at 'span3' for all.
                    $bc->attributes['class'] .= ' span' . $span;
                }

                if ($bc instanceof block_contents) {
                    $output .= $this->block($bc, $region);
                    $lastblock = $bc->title;
                } else if ($bc instanceof block_move_target) {
                    $output .= $this->block_move_target($bc, $zones, $lastblock);
                } else {
                    throw new coding_exception('Unexpected type of thing ('.get_class($bc).') found in list of block contents.');
                }
            }
            if (!$editing) {
                $output .= html_writer::end_tag('div');
            }
        }

        return $output;
    }

    /**
     * Produces a header for a block.
     *
     * @param block_contents $bc.
     * @return string.
     */
    protected function block_header(block_contents $bc) {
        $title = '';
        if ($bc->title) {
            $attributes = array();
            if ($bc->blockinstanceid) {
                $attributes['id'] = 'instance-'.$bc->blockinstanceid.'-header';
            }
            static $icons = array(
                'activity_modules' => 'puzzle-piece',
                'admin_bookmarks' => 'bookmark',
                'adminblock' => 'th-large',
                'blog_menu' => 'book',
                'blog_tags' => 'tags',
                'book_toc' => 'book',
                'calendar_month' => 'calendar',
                'calendar_upcoming' => 'calendar',
                'comments' => 'comments',
                'community' => 'globe',
                'completionstatus' => 'tachometer',
                'course_badges' => 'trophy',
                'course_list' => 'desktop',
                'feedback' => 'thumbs-o-up',
                'flickr' => 'flickr',
                'glossary_random' => 'lightbulb-o',
                'html' => 'list-alt',
                'iconic_html' => '', // It decides.
                'login' => 'user',
                'messages' => 'envelope',
                'mentees' => 'tags',
                'navigation' => 'sitemap',
                'news_items' => 'bullhorn',
                'myprofile' => 'user',
                'online_users' => 'users',
                'participants' => 'users',
                'private_files' => 'folder-o',
                'quiz_navblock' => 'code-fork',
                'quiz_results' => 'bar-chart',
                'recent_activity' => 'clock-o',
                'rss_client' => 'rss',
                'search_forums' => 'comments-o',
                'section_links' => 'bookmark',
                'selfcompletion' => 'tachometer',
                'settings' => 'cogs',
                'style_guide' => 'paint-brush',
                'tags' => 'tags',
                'theme_selector' => 'paint-brush',
                'twitter_search' => 'twitter',
                'youtube' => 'youtube'
            );
            if (array_key_exists($bc->attributes['data-block'], $icons)) {
                $theicon = $icons[$bc->attributes['data-block']];
            } else {
                $theicon = 'reorder';
            }
            $title = html_writer::tag('h2', $bc->title, $attributes);
            if (!empty($theicon)) {
                $title = $this->getfontawesomemarkup($theicon).$title;
            }
        }

        $blockid = null;
        if (isset($bc->attributes['id'])) {
            $blockid = $bc->attributes['id'];
        }
        $controlshtml = $this->block_controls($bc->controls, $blockid);

        $output = '';
        if ($title || $controlshtml) {
            $output .= html_writer::tag('div', html_writer::tag('div',
                html_writer::tag('div', '', array('class' => 'block_action')).$title.$controlshtml, array('class' => 'title')),
                array('class' => 'header'));
        }
        return $output;
    }

    public function standard_footer_html() {
        $output = parent::standard_footer_html();
        $output .= html_writer::start_tag('div', array ('class' => 'themecredit')).
            get_string('credit', 'theme_essential',
            array('name' => html_writer::link('https://moodle.org/plugins/theme_essential', 'Essential', array('target' => '_blank')))).
            html_writer::link('//about.me/gjbarnard', 'Gareth J Barnard', array('target' => '_blank')).html_writer::end_tag('div');

        return $output;
    }

    // Essential custom bits.
    public function essential_marketing_button($spot) {
        $o = '';
        $url = \theme_essential\toolbox::get_setting('marketing'.$spot.'buttonurl');
        if (!empty($url)) {
            $url = '<a href="'.$url.'" ';
            $url .= 'target="'.\theme_essential\toolbox::get_setting('marketing'.$spot.'target').'" class="marketing-button">';
            $url .= \theme_essential\toolbox::get_setting('marketing'.$spot.'buttontext', true);
            $url .= '</a>';
        }
        $edit = $this->essential_edit_button('theme_essential_frontpage');
        if ((!empty($url)) || (!empty($edit))) {
            $o = '<div class="marketing-buttons">'.$url.$edit.'</div>';
        }

        return $o;
    }

    public function essential_edit_button($section) {
        global $CFG;
        if ($this->page->user_is_editing() && is_siteadmin()) {
            $url = preg_replace("(https?:)", "", $CFG->wwwroot . '/admin/settings.php?section=');
            return '<a class="btn btn-success" href="'.$url.$section.'">'.get_string('edit').'</a>';
        }
        return null;
    }

    public function get_title($location) {
        global $CFG, $SITE;
        $title = '';
        if ($location === 'navbar') {
            $url = preg_replace("(https?:)", "", $CFG->wwwroot);
            switch (\theme_essential\toolbox::get_setting('navbartitle')) {
                case 0:
                    return false;
                break;
                case 1:
                    $title = '<a class="brand" href="'.$url.'">'.format_string($SITE->fullname, true,
                                    array('context' => context_course::instance(SITEID))).'</a>';
                    break;
                case 2:
                    $title = '<a class="brand" href="'.$url.'">'.format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))).'</a>';
                    break;
                default:
                    $title = '<a class="brand" href="'.$url.'">' . format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))).'</a>';
                    break;
            }
        } else if ($location === 'header') {
            switch (\theme_essential\toolbox::get_setting('headertitle')) {
                case 0:
                    return false;
                    break;
                case 1:
                    $title = '<h1 id="title">'.format_string($SITE->fullname, true,
                                    array('context' => context_course::instance(SITEID))).'</h1>';
                    break;
                case 2:
                    $title = '<h1 id="title">'.format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))).'</h1>';
                    break;
                case 3:
                    $title = '<h1 id="smalltitle">'.format_string($SITE->fullname, true,
                                    array('context' => context_course::instance(SITEID))).'</h2>';
                    $title .= '<h2 id="subtitle">'.strip_tags($SITE->summary).'</h3>';
                    break;
                case 4:
                    $title = '<h1 id="smalltitle">'.format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))).'</h2>';
                    $title .= '<h2 id="subtitle">'.strip_tags($SITE->summary).'</h3>';
                    break;
                default:
                    break;
            }
        }
        return $title;
    }

    /**
     * get_performance_output() override get_peformance_info()
     *  in moodlelib.php. Returns a string
     * values ready for use.
     * @param array $param
     * @param string $perfinfo
     * @return string $html
     */
    protected function performance_output($param, $perfinfo) {
        $html = html_writer::start_tag('div', array('class' => 'container-fluid performanceinfo'));
        $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
        $html .= html_writer::start_tag('div', array('class' => 'span12'));
        $html .= html_writer::tag('h2', get_string('perfinfoheading', 'theme_essential'));
        $html .= html_writer::end_tag('div');
        $html .= html_writer::end_tag('div');
        $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
        $colcount = 0;
        if (isset($param['realtime'])) {
            $colcount++;
        }
        if (isset($param['memory_total'])) {
            $colcount++;
        }
        if (isset($param['includecount'])) {
            $colcount++;
        }
        if (isset($param['dbqueries'])) {
            $colcount++;
        }
        if ($colcount != 0) {
            $thespan = 12 / $colcount;
            if (isset($param['realtime'])) {
                $html .= html_writer::start_tag('div', array('class' => 'span'.$thespan));
                $html .= html_writer::tag('var', $this->getfontawesomemarkup('clock-o').
                    round($param['realtime'], 2).' '.get_string('seconds'), array('id' => 'load'));
                $html .= html_writer::span(get_string('loadtime', 'theme_essential'));
                $html .= html_writer::end_tag('div');
            }
            if (isset($param['memory_total'])) {
                $html .= html_writer::start_tag('div', array('class' => 'span'.$thespan));
                $html .= html_writer::tag('var', $this->getfontawesomemarkup('tachometer').
                    display_size($param['memory_total']), array('id' => 'memory'));
                $html .= html_writer::span(get_string('memused', 'theme_essential'));
                $html .= html_writer::end_tag('div');
            }
            if (isset($param['includecount'])) {
                $html .= html_writer::start_tag('div', array('class' => 'span'.$thespan));
                $html .= html_writer::tag('var', $this->getfontawesomemarkup('stackoverflow').
                    $param['includecount'], array('id' => 'included'));
                $html .= html_writer::span(get_string('included', 'theme_essential'));
                $html .= html_writer::end_tag('div');
            }
            if (isset($param['dbqueries'])) {
                $html .= html_writer::start_tag('div', array('class' => 'span'.$thespan));
                $html .= html_writer::tag('var', $this->getfontawesomemarkup('trello').
                    $param['dbqueries'], array('id' => 'dbqueries'));
                $html .= html_writer::span(get_string('dbqueries', 'theme_essential'));
                $html .= html_writer::end_tag('div');
            }
        }
        $html .= html_writer::end_tag('div');
        if ($perfinfo === "max") {
            $html .= html_writer::empty_tag('hr');
            $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
            $html .= html_writer::start_tag('div', array('class' => 'span12'));
            $html .= html_writer::tag('h2', get_string('extperfinfoheading', 'theme_essential'));
            $html .= html_writer::end_tag('div');
            $html .= html_writer::end_tag('div');
            $html .= html_writer::start_tag('div', array('class' => 'row-fluid'));
            $colcountmax = 0;
            if (isset($param['serverload'])) {
                $colcountmax++;
            }
            if (isset($param['memory_peak'])) {
                $colcountmax++;
            }
            if (isset($param['cachesused'])) {
                $colcountmax++;
            }
            if (isset($param['sessionsize'])) {
                $colcountmax++;
            }
            if (isset($param['dbtime'])) {
                $colcountmax++;
            }
            if ($colcountmax != 0) {
                $thespanmax = 12 / $colcountmax;
                if (isset($param['serverload'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span'.$thespanmax));
                    $html .= html_writer::tag('var', $this->getfontawesomemarkup('clock-o').
                        $param['serverload'], array('id' => 'load'));
                    $html .= html_writer::span(get_string('serverload', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['memory_peak'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span'.$thespanmax));
                    $html .= html_writer::tag('var', $this->getfontawesomemarkup('tachometer').
                        display_size($param['memory_peak']), array('id' => 'peakmemory'));
                    $html .= html_writer::span(get_string('peakmem', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['cachesused'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span'.$thespanmax));
                    $html .= html_writer::tag('var', $this->getfontawesomemarkup('paw').
                        $param['cachesused'], array('id' => 'cache'));
                    $html .= html_writer::span(get_string('cachesused', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['sessionsize'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span'.$thespanmax));
                    $html .= html_writer::tag('var', $this->getfontawesomemarkup('tachometer').
                        $param['sessionsize'], array('id' => 'session'));
                    $html .= html_writer::span(get_string('sessionsize', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['dbtime'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span'.$thespanmax));
                    $html .= html_writer::tag('var', $this->getfontawesomemarkup('trello').
                        $param['dbtime'], array('id' => 'dbtime'));
                    $html .= html_writer::span(get_string('dbtime', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
            }
            $html .= html_writer::end_tag('div');
        }
        $html .= html_writer::end_tag('div');
        $html .= html_writer::end_tag('div');

        return $html;
    }

    private function getfontawesomemarkup($theicon, $classes = array(), $attributes = array(), $content = '') {
        $classes[] = 'fa fa-'.$theicon;
        $attributes['aria-hidden'] = 'true';
        $attributes['class'] = implode(' ', $classes);
        return html_writer::tag('span', $content, $attributes);
    }

    /**
     * Returns the alert markup if outside of the Moodle version supported as can cause issues.
     */
    public function version_alert() {
        global $CFG;
        $result = '';

        if (($CFG->version < 2015111600.00) || ($CFG->version >= 2015120400.00)) {
            $result = '<div class="useralerts alert alert-error">';
            $result .= '<a class="close" data-dismiss="alert" href="#">'.$this->getfontawesomemarkup('times-circle').'</a>';
            $result .= '<span class="fa-stack">'.$this->getfontawesomemarkup('square', array('fa-stack-2x'));
            $result .= $this->getfontawesomemarkup('warning', array('fa-stack-1x', 'fa-inverse')).'</span>';
            $result .= '<span class="title">'.get_string('versionalerttitle', 'theme_essential').'</span><br />'.
                get_string('versionalerttext1', 'theme_essential').'<br />'.
                get_string('versionalerttext2', 'theme_essential');
            $result .= '</div>';
        }

        return $result;
    }

    /**
     * Returns the url of the custom favicon.
     */
    public function favicon() {
        $favicon = \theme_essential\toolbox::get_setting('favicon', 'format_file_url');

        if (empty($favicon)) {
            return $this->page->theme->pix_url('favicon', 'theme');
        } else {
            return $favicon;
        }
    }
}
