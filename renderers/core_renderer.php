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
class theme_essential_core_renderer extends core_renderer {
    public $language = null;
    protected $theme = null;

    /**
     * This renders the breadcrumbs
     * @return string $breadcrumbs
     */
    public function navbar() {
        $breadcrumbstyle = $this->get_setting('breadcrumbstyle');
        if ($breadcrumbstyle) {
            if ($breadcrumbstyle == '4') {
                $breadcrumbstyle = '1'; // Fancy style with no collapse.
            }
            $breadcrumbs = html_writer::start_tag('ul', array('class' => "breadcrumb style$breadcrumbstyle"));
            $index = 1;
            foreach ($this->page->navbar->get_items() as $item) {
                $item->hideicon = true;
                $breadcrumbs .= html_writer::tag('li', $this->render($item), array('style' => 'z-index:' . (100 - $index) . ';'));
                $index += 1;
            }
            $breadcrumbs .= html_writer::end_tag('ul');
        } else {
            $breadcrumbs = html_writer::tag('p', '&nbsp;');
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
        $message = clean_text($message);
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

        // Provide some performance info if required
        $performanceinfo = '';
        if (defined('MDL_PERF') || (!empty($CFG->perfdebug) and $CFG->perfdebug > 7)) {
            $perf = get_performance_info();
            if (defined('MDL_PERFTOLOG') && !function_exists('register_shutdown_function')) {
                error_log("PERF: " . $perf['txt']);
            }
            if (defined('MDL_PERFTOFOOT') || debugging() || $CFG->perfdebug > 7) {
                $performanceinfo = $this->performance_output($perf, $this->get_setting('perfinfo'));
            }
        }

        $footer = str_replace($this->unique_performance_info_token, $performanceinfo, $footer);
        $footer = str_replace($this->unique_end_html_token, $this->page->requires->get_end_code(), $footer);
        $this->page->set_state(moodle_page::STATE_DONE);
        $info = '<!-- Essential theme version: '.$this->page->theme->settings->version.', developed, enhanced and maintained by Gareth J Barnard: about.me/gjbarnard -->';

        return $output . $footer . $info;
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
            $content .= html_writer::start_tag('a', array('href' => $url, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'title' => $menunode->get_title()));
            $content .= $menunode->get_text();
            if ($level == 1) {
                $content .= '<i class="fa fa-caret-right"></i>';
            }
            $content .= '</a>';
            $content .= '<ul class="dropdown-menu">';
            foreach ($menunode->get_children() as $menunode) {
                $content .= $this->render_custom_menu_item($menunode, 0);
            }
            $content .= '</ul>';
        } else {
            $content = '<li>';
            // The node doesn't have children so produce a final menuitem.
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#';
            }
            $content .= html_writer::link($url, $menunode->get_text(), array('title' => $menunode->get_title()));
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
            $this->language = $langmenu->add('<i class="fa fa-flag"></i>' . $currentlang, new moodle_url('#'), $strlang, 100);
            foreach ($langs as $langtype => $langname) {
                $this->language->add('<i class="fa fa-language"></i>' . $langname, new moodle_url($this->page->url, array('lang' => $langtype)), $langname);
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

        $hasdisplaymycourses = $this->get_setting('displaymycourses');
        if (isloggedin() && !isguestuser() && $hasdisplaymycourses) {
            $mycoursetitle = $this->get_setting('mycoursetitle');
            if ($mycoursetitle == 'module') {
                $branchtitle = get_string('mymodules', 'theme_essential');
            } else if ($mycoursetitle == 'unit') {
                $branchtitle = get_string('myunits', 'theme_essential');
            } else if ($mycoursetitle == 'class') {
                $branchtitle = get_string('myclasses', 'theme_essential');
            } else {
                $branchtitle = get_string('mycourses', 'theme_essential');
            }
            $branchlabel = '<i class="fa fa-briefcase"></i>' . $branchtitle;
            $branchurl = new moodle_url('');
            $branchsort = 200;

            $branch = $coursemenu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

            $hometext = get_string('myhome');
            $homelabel = html_writer::tag('i', '', array('class' => 'fa fa-home')).html_writer::tag('span', ' '.$hometext);
            $branch->add($homelabel, new moodle_url('/my/index.php'), $hometext);

            // Get 'My courses' sort preference from admin config.
            if (!$sortorder = $CFG->navsortmycoursessort) {
                $sortorder = 'sortorder';
            }

            // Retrieve courses and add them to the menu when they are visible
            $numcourses = 0;
            if ($courses = enrol_get_my_courses(NULL, $sortorder . ' ASC')) {
                foreach ($courses as $course) {
                    if ($course->visible) {
                        $branch->add('<i class="fa fa-graduation-cap"></i>' . format_string($course->fullname), new moodle_url('/course/view.php?id=' . $course->id), format_string($course->shortname));
                        $numcourses += 1;
                    } else if (has_capability('moodle/course:viewhiddencourses', context_system::instance())) {
                        $branchtitle = format_string($course->shortname);
                        $branchlabel = '<span class="dimmed_text"><i class="fa fa-eye-slash"></i>' . format_string($course->fullname) . '</span>';
                        $branchurl = new moodle_url('/course/view.php', array('id' =>$course->id));
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
            foreach (range(1, 3) as $alternativethemenumber) {
                if ($this->get_setting('enablealternativethemecolors' . $alternativethemenumber)) {
                    $alternativethemes[] = $alternativethemenumber;
                }
            }
            if (!empty($alternativethemes)) {
                $branchtitle = get_string('themecolors', 'theme_essential');
                $branchlabel = '<i class="fa fa-th-large"></i>' . $branchtitle;
                $branchurl = new moodle_url('#');
                $branchsort = 300;
                $branch = $colourmenu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

                $defaultthemecolorslabel = get_string('defaultcolors', 'theme_essential');
                $branch->add('<i class="fa fa-square colours-default"></i>' . $defaultthemecolorslabel,
                    new moodle_url($this->page->url, array('essentialcolours' => 'default')), $defaultthemecolorslabel);
                foreach ($alternativethemes as $alternativethemenumber) {
                    if ($this->get_setting('alternativethemename' . $alternativethemenumber)) {
                        $alternativethemeslabel = $this->get_setting('alternativethemename' . $alternativethemenumber);
                    } else {
                        $alternativethemeslabel = get_string('alternativecolors', 'theme_essential', $alternativethemenumber);
                    }
                    $branch->add('<i class="fa fa-square colours-alternative' . $alternativethemenumber . '"></i>' . $alternativethemeslabel,
                        new moodle_url($this->page->url, array('essentialcolours' => 'alternative' . $alternativethemenumber)), $alternativethemeslabel);
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
        if ($this->page->pagelayout != 'course') {
            return '';
        }

        if (!isguestuser()) {
            if (isset($this->page->course->id) && $this->page->course->id > 1) {
                $activitystreammenu = new custom_menu();
                $branchtitle = get_string('thiscourse', 'theme_essential');
                $branchlabel = '<i class="fa fa-book"></i>'.$branchtitle;
                $branchurl = new moodle_url('#');
                $branch = $activitystreammenu->add($branchlabel, $branchurl, $branchtitle, 10002);
                $branchtitle = get_string('people', 'theme_essential');
                $branchlabel = '<i class="fa fa-users"></i>'.$branchtitle;
                $branchurl = new moodle_url('/user/index.php', array('id' => $this->page->course->id));
                $branch->add($branchlabel, $branchurl, $branchtitle, 100003);
                $branchtitle = get_string('grades');
                $branchlabel = '<i class="fa fa-list-alt icon"></i>'.$branchtitle;
                $branchurl = new moodle_url('/grade/report/index.php', array('id' => $this->page->course->id));
                $branch->add($branchlabel, $branchurl, $branchtitle, 100004);

                $data = $this->get_course_activities();
                foreach ($data as $modname => $modfullname) {
                    if ($modname === 'resources') {
                        $icon = $this->pix_icon('icon', '', 'mod_page', array('class' => 'icon'));
                        $branch->add($icon.$modfullname, new moodle_url('/course/resources.php', array('id' => $this->page->course->id)));
                    } else {
                        $icon = '<img src="'.$this->pix_url('icon', $modname) . '" class="icon" alt="" />';
                        $branch->add($icon.$modfullname, new moodle_url('/mod/'.$modname.'/index.php', array('id' => $this->page->course->id)));
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
        $content = new stdClass();
        $modinfo = get_fast_modinfo($course);
        $modfullnames = array();
        $archetypes = array();
        foreach ($modinfo->cms as $cm) {
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
        core_collator::asort($modfullnames);

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
                    $messagecontent .= html_writer::tag('i', '', array('class' => 'fa fa-comment' . $iconadd));
                    $messagecontent .= $this->get_time_difference($message->date);
                    $messagecontent .= html_writer::end_span();
                    $messagecontent .= html_writer::span($message->text, 'notification-text');
                    $messagecontent .= html_writer::end_div();
                } else {
                    if (!is_object($message->from) || !empty($message->from->deleted)) {
                        continue;
                    }
                    $senderpicture = new user_picture($message->from);
                    $senderpicture->link = false;
                    $senderpicture->size = 60;

                    $messagecontent = html_writer::start_div('message ' . $addclass);
                    $messagecontent .= html_writer::start_span('msg-picture') . $this->render($senderpicture) . html_writer::end_span();
                    $messagecontent .= html_writer::start_span('msg-body');
                    $messagecontent .= html_writer::start_span('msg-time');
                    $messagecontent .= html_writer::tag('i', '', array('class' => 'fa fa-comments' . $iconadd));
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

            $readmessagesql = "SELECT id, smallmessage, useridfrom, useridto, timecreated,timeread, fullmessageformat, notification, contexturl
                               FROM {message_read}
                               WHERE useridto = :userid
                               ORDER BY timecreated DESC";

            $messages = $DB->get_records_sql($readmessagesql, array('userid' => $USER->id), 0, $maxmessages);

            foreach ($messages as $message) {
                $messagelist['messages'][] = $this->process_message($message);
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
                $messagecontent->url = new moodle_url('/message/index.php', array('user1' => $USER->id, 'viewing' => 'recentnotifications'));
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
            $messagecontent->url = new moodle_url('/message/index.php', array('user1' => $USER->id, 'user2' => $message->useridfrom));
        }

        $messagecontent->date = $message->timecreated;
        $messagecontent->unread = empty($message->timeread);
        return $messagecontent;
    }

    /**
     * Calculates time difference between now and a timestamp
     * @param $created_time int
     * @return string
     */
    private function get_time_difference($created_time) {
        // It returns the time difference in Seconds...
        $time_difference = time() - $created_time;

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

        if (intval($time_difference / $years) > 1) {
            return get_string('ago', 'core_message', intval($time_difference / $years) . ' ' . get_string('years'));
        } else if (intval($time_difference / $years) > 0) {
            return get_string('ago', 'core_message', intval($time_difference / $years) . ' ' . get_string('year'));
        } else if (intval($time_difference / $months) > 1) {
            return get_string('ago', 'core_message', intval($time_difference / $months) . ' ' . get_string('months'));
        } else if (intval(($time_difference / $months)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference / $months) . ' ' . get_string('month'));
        } else if (intval(($time_difference / $days)) > 1) {
            return get_string('ago', 'core_message', intval($time_difference / $days) . ' ' . get_string('days'));
        } else if (intval(($time_difference / $days)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference / $days) . ' ' . get_string('day'));
        } else if (intval(($time_difference / $hours)) > 1) {
            return get_string('ago', 'core_message', intval($time_difference / $hours) . ' ' . get_string('hours'));
        } else if (intval(($time_difference / $hours)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference / $hours) . ' ' . get_string('hour'));
        } else if (intval(($time_difference / $minutes)) > 1) {
            return get_string('ago', 'core_message', intval($time_difference / $minutes) . ' ' . get_string('minutes'));
        } else if (intval(($time_difference / $minutes)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference / $minutes) . ' ' . get_string('minute'));
        } else if (intval(($time_difference)) > 20) {
            return get_string('ago', 'core_message', intval($time_difference) . ' ' . get_string('seconds'));
        } else {
            return get_string('ago', 'core_message', get_string('few', 'theme_essential') . get_string('seconds'));
        }
    }

    /**
     * Outputs the goto bottom menu.
     * @return custom_menu object
     */
    public function custom_menu_goto_bottom() {
        $html = '';
        if (($this->page->pagelayout == 'course') || ($this->page->pagelayout == 'incourse') || ($this->page->pagelayout == 'admin')) { // Go to bottom.
            $menu = new custom_menu();
            $gotobottom = html_writer::tag('i', '', array('class' => 'fa fa-arrow-circle-o-down'));
            $menu->add($gotobottom, new moodle_url('#region-main'), get_string('gotobottom', 'theme_essential'));
            $html = $this->render_custom_menu($menu);
        }
        return $html;
    }

    /**
     * Outputs the user menu.
     * @return custom_menu object
     */
    public function custom_menu_user() {
        // die if executed during install
        if (during_initial_install()) {
            return false;
        }

        global $USER, $CFG, $DB, $SESSION;
        $loginurl = get_login_url();

        $usermenu = html_writer::start_tag('ul', array('class' => 'nav'));
        $usermenu .= html_writer::start_tag('li', array('class' => 'dropdown'));

        if (!isloggedin()) {
            if ($this->page->pagelayout != 'login') {
                $userpic = '<em><i class="fa fa-sign-in"></i>' . get_string('login') . '</em>';
                $usermenu .= html_writer::link($loginurl, $userpic, array('class' => 'loginurl'));
            }
        } else if (isguestuser()) {
            $userurl = new moodle_url('#');
            $userpic = parent::user_picture($USER, array('link' => false));
            $caret = '<i class="fa fa-caret-right"></i>';
            $userclass = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');
            $usermenu .= html_writer::link($userurl, $userpic . get_string('guest') . $caret, $userclass);

            // Render direct logout link
            $usermenu .= html_writer::start_tag('ul', array('class' => 'dropdown-menu pull-right'));
            $branchlabel = '<em><i class="fa fa-sign-out"></i>' . get_string('logout') . '</em>';
            $branchurl = new moodle_url('/login/logout.php?sesskey=' . sesskey());
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            // Render Help Link
            $usermenu .= $this->theme_essential_render_helplink();

            $usermenu .= html_writer::end_tag('ul');

        } else {
            $course = $this->page->course;
            $context = context_course::instance($course->id);

            // Output Profile link
            $userurl = new moodle_url('#');
            $userpic = parent::user_picture($USER, array('link' => false));
            $caret = '<i class="fa fa-caret-right"></i>';
            $userclass = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');

            $usermenu .= html_writer::link($userurl, $userpic . $USER->firstname . $caret, $userclass);

            // Start dropdown menu items
            $usermenu .= html_writer::start_tag('ul', array('class' => 'dropdown-menu pull-right'));

            if (\core\session\manager::is_loggedinas()) {
                $realuser = \core\session\manager::get_realuser();
                $branchlabel = '<em><i class="fa fa-key"></i>' . fullname($realuser, true) . get_string('loggedinas', 'theme_essential') . fullname($USER, true) . '</em>';
                $branchurl = new moodle_url('/user/profile.php', array('id' => $USER->id));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            } else {
                $branchlabel = '<em><i class="fa fa-user"></i>' . fullname($USER, true) . '</em>';
                $branchurl = new moodle_url('/user/profile.php', array('id' => $USER->id));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            if (is_mnet_remote_user($USER) && $idprovider = $DB->get_record('mnet_host', array('id' => $USER->mnethostid))) {
                $branchlabel = '<em><i class="fa fa-users"></i>' . get_string('loggedinfrom', 'theme_essential') . $idprovider->name . '</em>';
                $branchurl = new moodle_url($idprovider->wwwroot);
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            if (is_role_switched($course->id)) { // Has switched roles
                $branchlabel = '<em><i class="fa fa-users"></i>' . get_string('switchrolereturn') . '</em>';
                $branchurl = new moodle_url('/course/switchrole.php', array('id' => $course->id, 'sesskey' => sesskey(), 'switchrole' => 0, 'returnurl' => $this->page->url->out_as_local_url(false)));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Add preferences submenu
            $usermenu .= $this->theme_essential_render_preferences($context);

            $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));

            // Output Calendar link if user is allowed to edit own calendar entries
            if (has_capability('moodle/calendar:manageownentries', $context)) {
                $branchlabel = '<em><i class="fa fa-calendar"></i>' . get_string('pluginname', 'block_calendar_month') . '</em>';
                $branchurl = new moodle_url('/calendar/view.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Check if messaging is enabled.
            if (!empty($CFG->messaging)) {
                $branchlabel = '<em><i class="fa fa-envelope"></i>' . get_string('pluginname', 'block_messages') . '</em>';
                $branchurl = new moodle_url('/message/index.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Check if user is allowed to manage files
            if (has_capability('moodle/user:manageownfiles', $context)) {
                $branchlabel = '<em><i class="fa fa-file"></i>' . get_string('privatefiles', 'block_private_files') . '</em>';
                $branchurl = new moodle_url('/user/files.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Check if user is allowed to view discussions
            if (has_capability('mod/forum:viewdiscussion', $context)) {
                $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('forumposts', 'mod_forum') . '</em>';
                $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

                $branchlabel = '<em><i class="fa fa-list"></i>' . get_string('discussions', 'mod_forum') . '</em>';
                $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id, 'mode' => 'discussions'));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

                $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));
            }

            // Output user grade links course sensitive, workaround for frontpage, selecting first enrolled course
            if ($course->id == 1) {
                $hascourses = enrol_get_my_courses(NULL, 'visible DESC,id ASC', 1);
                foreach ($hascourses as $hascourse) {
                    $reportcontext = context_course::instance($hascourse->id);
                    if (has_capability('gradereport/user:view', $reportcontext) && $hascourse->visible) {
                        $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('mygrades', 'theme_essential') . '</em>';
                        $branchurl = new moodle_url('/grade/report/overview/index.php' , array('id' => $hascourse->id, 'userid' => $USER->id));
                        $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
                    }
                }
            } else if (has_capability('gradereport/user:view', $context)) {
                $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('mygrades', 'theme_essential') . '</em>';
                $branchurl = new moodle_url('/grade/report/overview/index.php' , array('id' => $course->id, 'userid' => $USER->id));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

                // In Course also output Course grade links
                $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('coursegrades', 'theme_essential') . '</em>';
                $branchurl = new moodle_url('/grade/report/user/index.php' , array('id' => $course->id, 'userid' => $USER->id));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }

            // Check if badges are enabled.
            if (!empty($CFG->enablebadges) && has_capability('moodle/badges:manageownbadges', $context)) {
                $branchlabel = '<em><i class="fa fa-certificate"></i>' . get_string('badges') . '</em>';
                $branchurl = new moodle_url('/badges/mybadges.php');
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }
            $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));

            // Render direct logout link
            $branchlabel = '<em><i class="fa fa-sign-out"></i>' . get_string('logout') . '</em>';
            $branchurl = new moodle_url('/login/logout.php?sesskey=' . sesskey());
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            // Render Help Link
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
        if (!$this->get_setting('helplinktype')) {
            return false;
        }
        $branchlabel = '<em><i class="fa fa-question-circle"></i>' . get_string('help') . '</em>';
        $branchurl = '';
        $target = '';

        if ($this->get_setting('helplinktype') === '1') {
            if ($this->get_setting('helplink') && filter_var($this->get_setting('helplink'), FILTER_VALIDATE_EMAIL)) {
                $branchurl = 'mailto:' . $this->get_setting('helplink') . '?cc=' . $USER->email;
            } else if ($CFG->supportemail && filter_var($CFG->supportemail, FILTER_VALIDATE_EMAIL)) {
                $branchurl = 'mailto:' . $CFG->supportemail . '?cc=' . $USER->email;
            } else {
                if (is_siteadmin()) {
                    $branchurl = preg_replace("(https?:)", "", $CFG->wwwroot).'/admin/settings.php?section=theme_essential_header';
                }
                $branchlabel = '<em><i class="fa fa-exclamation-triangle red"></i>' . get_string('invalidemail') . '</em>';
            }
        }

        if ($this->get_setting('helplinktype') === '2') {
            if ($this->get_setting('helplink') && filter_var($this->get_setting('helplink'), FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
                $branchurl = $this->get_setting('helplink');
                $target = '_blank';
            } else if ((!$this->get_setting('helplink')) && (filter_var($CFG->supportpage, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED))) {
                $branchurl = $CFG->supportpage;
                $target = '_blank';
            } else {
                if (is_siteadmin()) {
                    $branchurl = preg_replace("(https?:)", "", $CFG->wwwroot).'/admin/settings.php?section=theme_essential_header';
                }
                $branchlabel = '<em><i class="fa fa-exclamation-triangle red"></i>' . get_string('invalidurl', 'error') . '</em>';
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
        $label = '<em><i class="fa fa-cog"></i>' . get_string('preferences') . '</em>';
        $preferences = html_writer::start_tag('li', array('class' => 'dropdown-submenu preferences'));
        $preferences .= html_writer::link(new moodle_url('#'), $label, array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        $preferences .= html_writer::start_tag('ul', array('class' => 'dropdown-menu'));
        // Check if user is allowed to edit profile
        if (has_capability('moodle/user:editownprofile', $context)) {
            $branchlabel = '<em><i class="fa fa-user"></i>' . get_string('editmyprofile') . '</em>';
            $branchurl = new moodle_url('/user/edit.php', array('id' => $USER->id));
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if (has_capability('moodle/user:changeownpassword', $context)) {
            $branchlabel = '<em><i class="fa fa-key"></i>' . get_string('changepassword') . '</em>';
            $branchurl = new moodle_url('/login/change_password.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if (has_capability('moodle/user:editownmessageprofile', $context)) {
            $branchlabel = '<em><i class="fa fa-comments"></i>' . get_string('messagepreferences', 'theme_essential') . '</em>';
            $branchurl = new moodle_url('/message/edit.php', array('id' => $USER->id));
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if ($CFG->enableblogs) {
            $branchlabel = '<em><i class="fa fa-rss-square"></i>' . get_string('blogpreferences', 'theme_essential') . '</em>';
            $branchurl = new moodle_url('/blog/preferences.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if ($CFG->enablebadges && has_capability('moodle/badges:manageownbadges', $context)) {
            $branchlabel = '<em><i class="fa fa-certificate"></i>' . get_string('badgepreferences', 'theme_essential') . '</em>';
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
    public function render_tabtree(tabtree $tabtree) {
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
    public function render_tabobject(tabobject $tab) {
        if ($tab->selected or $tab->activated) {
            return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'active'));
        } else if ($tab->inactive) {
            return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'disabled'));
        } else {
            if (!($tab->link instanceof moodle_url)) {
                // backward compartibility when link was passed as quoted string
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
        if (self::replace_moodle_icon($icon->pix)) {
            $newicon = self::replace_moodle_icon($icon->pix, $icon->attributes['alt']) . parent::render_pix_icon($icon) . "</i>";
            return $newicon;
        } else {
            return parent::render_pix_icon($icon);
        }
    }

    private static function replace_moodle_icon($icon, $alt = false) {
        $icons = array(
            'add' => 'plus',
            'book' => 'book',
            'chapter' => 'file',
            'docs' => 'question-circle',
            'generate' => 'gift',
            'i/marker' => 'lightbulb-o',
            'i/dragdrop' => 'arrows',
            'i/loading' => 'refresh fa-spin fa-2x',
            'i/loading_small' => 'refresh fa-spin',
            'i/backup' => 'cloud-download',
            'i/checkpermissions' => 'user',
            'i/edit' => 'pencil',
            'i/filter' => 'filter',
            'i/grades' => 'table',
            'i/group' => 'group',
            'i/groupn' => 'group',
            'i/groupv' => 'group',
            'i/groups' => 'group',
            'i/hide' => 'eye',
            'i/import' => 'upload',
            'i/move_2d' => 'arrows',
            'i/navigationitem' => 'file',
            'i/outcomes' => 'magic',
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
            't/cohort' => 'users',
            'i/assignroles' => 'lock',
            't/assignroles' => 'lock',
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
            't/preview' => 'search',
        );
        if (array_key_exists($icon, $icons)) {
            return "<i class=\"fa fa-$icons[$icon] icon\" title=\"$alt\">";
        } else {
            return false;
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
            html_writer::end_tag('i') . $title, array('href' => $url, 'class' => 'btn ' . $btn, 'title' => $title));
    }

    public function render_social_network($socialnetwork) {
        if ($this->get_setting($socialnetwork)) {
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
                'onclick' => "window.open('" . $this->get_setting($socialnetwork) . "')",
                'title' => get_string($socialnetwork, 'theme_essential'),
            ));
            $socialhtml .= html_writer::start_tag('i', array('class' => 'fa fa-' . $icon . ' fa-inverse'));
            $socialhtml .= html_writer::end_tag('i');
            $socialhtml .= html_writer::start_span('sr-only') . html_writer::end_span();
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
                $output = html_writer::tag($tag, $this->essential_blocks_for_region($displayregion, $footer, $editing), $attributes);
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

            /*
             * When editing we want all the blocks to be the same as side-pre / side-post so set by CSS:
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
                        // Recalculate span if needed...
                        $remainingblocks = $blockcount - ($currentblockcount - 1);
                        if ($remainingblocks < $blocksperrow) {
                            $span = 12 / $remainingblocks;
                            if ($span < 1) {
                                // Should not happen but a fail safe - block will be small so good for screen shots when this happens.
                                $span = 1;
                            }
                        }
                    }

                    if ($currentrow < $currentrequiredrow) {
                        $currentrow = $currentrequiredrow;
                    }

                    // 'desktop-first-column' done in CSS with ':first-of-type' and ':nth-of-type'.
                    // 'spanX' done in CSS with calculated special width class as fixed at 'span3' for all.
                    $bc->attributes['class'] .= ' span' . $span;
                }

                if ($bc instanceof block_contents) {
                    $output .= $this->block($bc, $region);
                    $lastblock = $bc->title;
                } else if ($bc instanceof block_move_target) {
                    $output .= $this->block_move_target($bc, $zones, $lastblock);
                } else {
                    throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
                }
            }
            if (!$editing) {
                $output .= html_writer::end_tag('div');
            }
        }

        return $output;
    }

    // Essential custom bits.
    // Moodle CSS file serving.
    public function get_csswww() {
        global $CFG;

        if (!$this->theme_essential_lte_ie9()) {
            if (right_to_left()) {
                $moodlecss = 'essential-rtl.css';
            } else {
                $moodlecss = 'essential.css';
            }

            $syscontext = context_system::instance();
            $itemid = theme_get_revision();
            $url = moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_essential/style/$itemid/$moodlecss");
            $url = preg_replace('|^https?://|i', '//', $url->out(false));
            return '<link rel="stylesheet" href="'.$url.'">';
        } else {
            if (right_to_left()) {
                $moodlecssone = 'essential-rtl_ie9-blessed1.css';
                $moodlecsstwo = 'essential-rtl_ie9.css';
            } else {
                $moodlecssone = 'essential_ie9-blessed1.css';
                $moodlecsstwo = 'essential_ie9.css';
            }

            $syscontext = context_system::instance();
            $itemid = theme_get_revision();
            $urlone = moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_essential/style/$itemid/$moodlecssone");
            $urlone = preg_replace('|^https?://|i', '//', $urlone->out(false));
            $urltwo = moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_essential/style/$itemid/$moodlecsstwo");
            $urltwo = preg_replace('|^https?://|i', '//', $urltwo->out(false));
            return '<link rel="stylesheet" href="'.$urlone.'"><link rel="stylesheet" href="'.$urltwo.'">';
        }
    }

    /**
     * Finds the given include file in the theme.  If it does not exist for the Essential child theme then the parent is checked.
     * @param string $filename Filename without extension to get.
     * @return string Complete path of the file.
     */
    public function get_include_file($filename) {
        global $CFG;
        $themedir = $this->page->theme->dir;
        $themename = $this->page->theme->name;
        $filename .= '.php';
        if (file_exists("$themedir/layout/includes/$filename")) {
            return "$themedir/layout/includes/$filename";
        } else if (file_exists("$CFG->dirroot/theme/$themename/layout/includes/$filename")) {
            return "$CFG->dirroot/theme/$themename/layout/includes/$filename";
        } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/$themename/layout/includes/$filename")) {
            return "$CFG->themedir/$themename/includes/$filename";
        }
        // Not here so check parent Essential.
        if (file_exists("$CFG->dirroot/theme/essential/layout/includes/$filename")) {
            return "$CFG->dirroot/theme/essential/layout/includes/$filename";
        } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/essential/layout/includes/$filename")) {
            return "$CFG->themedir/essential/includes/$filename";
        } else {
            return dirname(__FILE__)."$filename";
        }
    }

    public function get_setting($setting, $format = false, $theme = null) {

        if (empty($theme)) {
            if (empty($this->theme)) {
                $this->theme = theme_config::load('essential');
            }
            $theme = $this->theme;
        }

        global $CFG;
        require_once($CFG->dirroot . '/lib/weblib.php');
        if (empty($theme->settings->$setting)) {
            return false;
        } else if (!$format) {
            return $theme->settings->$setting;
        } else if ($format === 'format_text') {
            return format_text($theme->settings->$setting, FORMAT_PLAIN);
        } else if ($format === 'format_html') {
            return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
        } else {
            return format_string($theme->settings->$setting);
        }
    }

    public function render_slide($i, $captionoptions, $theme = null) {

        if (empty($theme)) {
            if (empty($this->theme)) {
                $this->theme = theme_config::load('essential');
            }
            $theme = $this->theme;
        }

        $slideurl = $this->get_setting('slide' . $i . 'url', false, $theme);
        $slideurltarget = $this->get_setting('slide' . $i . 'target', false, $theme);
        $slidetitle = $this->get_setting('slide' . $i, true, $theme);
        $slidecaption = $this->get_setting('slide' . $i . 'caption', true, $theme);
        if ($captionoptions == 0) {
            $slideextraclass = ' side-caption';
        } else {
            $slideextraclass = '';
        }
        $slideextraclass .= ($i === 1) ? ' active' : '';
        $slideimagealt = strip_tags($slidetitle);

        // Get slide image or fallback to default.
        $slideimage = $this->get_setting('slide' . $i . 'image', false, $theme);
        if ($slideimage) {
            $slideimage = $theme->setting_file_url('slide' . $i . 'image', 'slide' . $i . 'image');
        } else {
            $slideimage = $this->pix_url('default_slide', 'theme');
        }

        if ($slideurl) {
            $slide = '<a href="' . $slideurl . '" target="' . $slideurltarget . '" class="item' . $slideextraclass . '">';
        } else {
            $slide = '<div class="item' . $slideextraclass . '">';
        }

        if ($captionoptions == 0) {
            $slide .= '<div class="container-fluid">';
            $slide .= '<div class="row-fluid">';
        
            if ($slidetitle || $slidecaption) {
                $slide .= '<div class="span5 the-side-caption">';
                $slide .= '<div class="the-side-caption-content">';
                $slide .= '<h4>' . $slidetitle . '</h4>';
                $slide .= '<p>' . $slidecaption . '</p>';
                $slide .= '</div>';
                $slide .= '</div>';
                $slide .= '<div class="span7">';
            } else {
                $slide .= '<div class="span10 offset1 nocaption">';
            }
            $slide .= '<div class="carousel-image-container">';
            $slide .= '<img src="' . $slideimage . '" alt="' . $slideimagealt . '" class="carousel-image"/>';
            $slide .= '</div>';
            $slide .= '</div>';

            $slide .= '</div>';
            $slide .= '</div>';
        } else {
            $nocaption = (!($slidetitle || $slidecaption)) ? ' nocaption' : '';
            $slide .= '<div class="carousel-image-container'.$nocaption.'">';
            $slide .= '<img src="' . $slideimage . '" alt="' . $slideimagealt . '" class="carousel-image"/>';
            $slide .= '</div>';

            // Output title and caption if either is present
            if ($slidetitle || $slidecaption) {
                $slide .= '<div class="carousel-caption">';
                $slide .= '<div class="carousel-caption-inner">';
                $slide .= '<h4>' . $slidetitle . '</h4>';
                $slide .= '<p>' . $slidecaption . '</p>';
                $slide .= '</div>';
                $slide .= '</div>';
            }
        }
        $slide .= ($slideurl) ? '</a>' : '</div>';

        return $slide;
    }

    public function render_slide_controls($left) {
        $faleft = 'left';
        $faright = 'right';
        if (!$left) {
            $temp = $faleft;
            $faleft = $faright;
            $faright = $temp;
        }
        $prev = '<a class="left carousel-control" href="#essentialCarousel" data-slide="prev"><i class="fa fa-chevron-circle-' . $faleft . '"></i></a>';
        $next = '<a class="right carousel-control" href="#essentialCarousel" data-slide="next"><i class="fa fa-chevron-circle-' . $faright . '"></i></a>';

        return $prev . $next;
    }

    public function essential_edit_button($section) {
        global $CFG;
        if ($this->page->user_is_editing() && is_siteadmin()) {
            $url = preg_replace("(https?:)", "", $CFG->wwwroot . '/admin/settings.php?section=');
            return '<a class="btn btn-success" href="' . $url . $section . '">' . get_string('edit') . '</a>';
        }
    }

    public function get_title($location) {
        global $CFG, $SITE;
        $title = '';
        if ($location === 'navbar') {
            $url = preg_replace("(https?:)", "", $CFG->wwwroot);
            switch ($this->get_setting('navbartitle')) {
                case 0:
                    return false;
                break;
                case 1:
                    $title = '<a class="brand" href="' . $url . '">' . format_string($SITE->fullname, true,
                                    array('context' => context_course::instance(SITEID))) . '</a>';
                    break;
                case 2:
                    $title = '<a class="brand" href="' . $url . '">' . format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))) . '</a>';
                    break;
                default:
                    $title = '<a class="brand" href="' . $url . '">' . format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))) . '</a>';
                    break;
            }
        } else if ($location === 'header') {
            switch ($this->get_setting('headertitle')) {
                case 0:
                    return false;
                    break;
                case 1:
                    $title = '<h1 id="title">' . format_string($SITE->fullname, true,
                                    array('context' => context_course::instance(SITEID))) . '</h1>';
                    break;
                case 2:
                    $title = '<h1 id="title">' . format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))) . '</h1>';
                    break;
                case 3:
                    $title = '<h1 id="smalltitle">' . format_string($SITE->fullname, true,
                                    array('context' => context_course::instance(SITEID))) . '</h2>';
                    $title .= '<h2 id="subtitle">' . strip_tags($SITE->summary) . '</h3>';
                    break;
                case 4:
                    $title = '<h1 id="smalltitle">' . format_string($SITE->shortname, true,
                                    array('context' => context_course::instance(SITEID))) . '</h2>';
                    $title .= '<h2 id="subtitle">' . strip_tags($SITE->summary) . '</h3>';
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
                $html .= html_writer::start_tag('div', array('class' => 'span' . $thespan));
                $html .= html_writer::tag('var', round($param['realtime'], 2) . ' ' . get_string('seconds'), array('id' => 'load'));
                $html .= html_writer::span(get_string('loadtime', 'theme_essential'));
                $html .= html_writer::end_tag('div');
            }
            if (isset($param['memory_total'])) {
                $html .= html_writer::start_tag('div', array('class' => 'span' . $thespan));
                $html .= html_writer::tag('var', display_size($param['memory_total']), array('id' => 'memory'));
                $html .= html_writer::span(get_string('memused', 'theme_essential'));
                $html .= html_writer::end_tag('div');
            }
            if (isset($param['includecount'])) {
                $html .= html_writer::start_tag('div', array('class' => 'span' . $thespan));
                $html .= html_writer::tag('var', $param['includecount'], array('id' => 'included'));
                $html .= html_writer::span(get_string('included', 'theme_essential'));
                $html .= html_writer::end_tag('div');
            }
            if (isset($param['dbqueries'])) {
                $html .= html_writer::start_tag('div', array('class' => 'span' . $thespan));
                $html .= html_writer::tag('var', $param['dbqueries'], array('id' => 'dbqueries'));
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
                    $html .= html_writer::start_tag('div', array('class' => 'span' . $thespanmax));
                    $html .= html_writer::tag('var', $param['serverload'], array('id' => 'load'));
                    $html .= html_writer::span(get_string('serverload', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['memory_peak'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span' . $thespanmax));
                    $html .= html_writer::tag('var', display_size($param['memory_peak']), array('id' => 'peakmemory'));
                    $html .= html_writer::span(get_string('peakmem', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['cachesused'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span' . $thespanmax));
                    $html .= html_writer::tag('var', $param['cachesused'], array('id' => 'cache'));
                    $html .= html_writer::span(get_string('cachesused', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['sessionsize'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span' . $thespanmax));
                    $html .= html_writer::tag('var', $param['sessionsize'], array('id' => 'session'));
                    $html .= html_writer::span(get_string('sessionsize', 'theme_essential'));
                    $html .= html_writer::end_tag('div');
                }
                if (isset($param['dbtime'])) {
                    $html .= html_writer::start_tag('div', array('class' => 'span' . $thespanmax));
                    $html .= html_writer::tag('var', $param['dbtime'], array('id' => 'dbtime'));
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

    /**
     * States if the browser is not IE9 or less.
     */
    public function theme_essential_not_lte_ie9() {
        $properties = $this->theme_essential_ie_properties();
        if (!is_array($properties)) {
            return true;
        }
        // We have properties, it is a version of IE, so is it greater than 9?
        return ($properties['version'] > 9.0);
    }

    /**
     * States if the browser is IE9 or less.
     */
    public function theme_essential_lte_ie9() {
        $properties = $this->theme_essential_ie_properties();
        if (!is_array($properties)) {
            return false;
        }
        // We have properties, it is a version of IE, so is it greater than 9?
        return ($properties['version'] <= 9.0);
    }

    /**
     * States if the browser is IE by returning properties, otherwise false.
     */
    public function theme_essential_ie_properties() {
        $properties = core_useragent::check_ie_properties(); // In /lib/classes/useragent.php.
        if (!is_array($properties)) {
            return false;
        } else {
            return $properties;
        }
    }

}
