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
 
/** @var custom_menu_item language The language menu if created */
    public $language = null;
 
    public function navbar() {
        $breadcrumbs = '';
        $breadcrumbstyle = (!empty($PAGE->theme->settings->breadcrumbstyle)) ? $PAGE->theme->settings->breadcrumbstyle : '1'; // Default in settings.php.
        if (!empty($breadcrumbstyle) && ($breadcrumbstyle > 0) ) {
            foreach ($this->page->navbar->get_items() as $item) {
                $item->hideicon = true;
                $breadcrumbs .= html_writer::tag('li',$this->render($item),array());
            }
            return html_writer::tag('ul', $breadcrumbs, array('class' => "breadcrumb style$breadcrumbstyle"));
        }
    }
    
    /*
     * This renders a notification message.
     * Uses bootstrap compatible html.
     */
    public function notification($message, $classes = 'notifyproblem') {
        $message = clean_text($message);
        $type = '';

        if ($classes == 'notifyproblem') {
            $type = 'alert alert-error';
        }
        if ($classes == 'notifysuccess') {
            $type = 'alert alert-success';
        }
        if ($classes == 'notifymessage') {
            $type = 'alert alert-info';
        }
        if ($classes == 'redirectmessage') {
            $type = 'alert alert-block alert-info';
        }
        return "<div class=\"$type\">$message</div>";
    } 
    
   
    /**
     * Outputs the page's footer
     * @return string HTML fragment
     */
    public function footer() {
        global $CFG, $USER;

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
                $performanceinfo = essential_performance_output($perf, $this->page->theme->settings->perfinfo);
            }
        }

        $footer = str_replace($this->unique_performance_info_token, $performanceinfo, $footer);

        $footer = str_replace($this->unique_end_html_token, $this->page->requires->get_end_code(), $footer);

        $this->page->set_state(moodle_page::STATE_DONE);

        if(!empty($this->page->theme->settings->persistentedit) && property_exists($USER, 'editing') && $USER->editing && !$this->really_editing) {
            $USER->editing = false;
        }

        return $output . $footer;
    }
    
    /*
     * Overriding the custom_menu function ensures the custom menu is
     * always shown, even if no menu items are configured in the global
     * theme settings page.
     */
    public function custom_menu($custommenuitems = '') {
        global $CFG;

        if (empty($custommenuitems) && !empty($CFG->custommenuitems)) {
            $custommenuitems = $CFG->custommenuitems;
        }
        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }
        
    protected function render_custom_menu(custom_menu $menu) {

        $content = '<ul class="nav">';
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }
        return $content.'</ul>';
    }
    
    /*
     * This code renders the custom menu items for the
     * bootstrap dropdown menu.
     */
    protected function render_custom_menu_item(custom_menu_item $menunode, $level = 0 ) {
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
                $url = '#cm_submenu_'.$submenucount;
            }
            $content .= html_writer::start_tag('a', array('href'=>$url, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'title'=>$menunode->get_title()));
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
            $content .= html_writer::link($url, $menunode->get_text(), array('title'=>$menunode->get_title()));
        }
        return $content;
    }
    
    /**
     * Outputs the language menu
     * @return custom menu object
     */
    public function custom_menu_language() {
        global $CFG;
        $langmenu = new custom_menu();

        $addlangmenu = true;
        $langs = get_string_manager()->get_list_of_translations();
        if (count($langs) < 2
            or empty($CFG->langmenu)
            or ($this->page->course != SITEID and !empty($this->page->course->lang))) {
            $addlangmenu = false;
        }

        if ($addlangmenu) {
            $strlang =  get_string('language');
            $currentlang = current_language();
            if (isset($langs[$currentlang])) {
                $currentlang = $langs[$currentlang];
            } else {
                $currentlang = $strlang;
            }
            $this->language = $langmenu->add($currentlang, new moodle_url('#'), $strlang, 100);
            foreach ($langs as $langtype => $langname) {
                $this->language->add('<i class="fa fa-language"></i>'.$langname, new moodle_url($this->page->url, array('lang' => $langtype)), $langname);
            }
        }
        return $this->render_custom_menu($langmenu);
    }

    /**
     * Outputs the courses menu
     * @return custom menu object
     */
    public function custom_menu_courses() {
        $coursemenu = new custom_menu();

        $hasdisplaymycourses = (empty($this->page->theme->settings->displaymycourses)) ? false : $this->page->theme->settings->displaymycourses;
        if (isloggedin() && !isguestuser() && $hasdisplaymycourses) {
            $mycoursetitle = $this->page->theme->settings->mycoursetitle;
            if ($mycoursetitle == 'module') {
                $branchtitle = get_string('mymodules', 'theme_essential');
            } else if ($mycoursetitle == 'unit') {
                $branchtitle = get_string('myunits', 'theme_essential');
            } else if ($mycoursetitle == 'class') {
                $branchtitle = get_string('myclasses', 'theme_essential');
            } else {
                $branchtitle = get_string('mycourses', 'theme_essential');
            }
            $branchlabel = '<i class="fa fa-briefcase"></i>'.$branchtitle;
            $branchurl   = new moodle_url('/my/index.php');
            $branchsort  = 200;
 
            $branch = $coursemenu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
            
            // Retrieve courses and add them to the menu when they are visible
            $numcourses = 0;
            if($courses = enrol_get_my_courses(NULL , 'fullname ASC')) {
                foreach ($courses as $course) {
                    if ($course->visible) {
                        $branch->add('<i class="fa fa-graduation-cap"></i>'.format_string($course->fullname), new moodle_url('/course/view.php?id='.$course->id), format_string($course->shortname));
                        $numcourses += 1;
                    } else if (has_capability('moodle/course:viewhiddencourses', context_system::instance())) {
                        $branchtitle = format_string($course->shortname);
                        $branchlabel = '<span class="dimmed_text"><i class="fa fa-eye-slash"></i>'.format_string($course->fullname).'</span>';
                        $branchurl   = new moodle_url('/course/view.php?id='.$course->id);
                        $branch->add($branchlabel, $branchurl , $branchtitle);
                        $numcourses += 1;
                    }
                }
            }
            if ($numcourses == 0 || empty($courses)) {
                $noenrolments = get_string('noenrolments', 'theme_essential');
                $branch->add('<em>'.$noenrolments.'</em>', new moodle_url('#'), $noenrolments);
            }
        }
        return $this->render_custom_menu($coursemenu);
    }
    
    /**
     * Outputs the color menu
     * @return custom menu object
     */
    public function custom_menu_themecolours() {
        $colourmenu = new custom_menu();

        if (!isguestuser()) {
            $alternativethemes = array();
            foreach (range(1, 3) as $alternativethemenumber) {
                if (!empty($this->page->theme->settings->{'enablealternativethemecolors' . $alternativethemenumber})) {
                    $alternativethemes[] = $alternativethemenumber;
                }
            }
            if (!empty($alternativethemes)) {
                $branchtitle = get_string('themecolors', 'theme_essential');
                $branchlabel = '<i class="fa fa-th-large"></i>' . $branchtitle;
                $branchurl   = new moodle_url('#');
                $branchsort  = 300;
                $branch = $colourmenu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
                
                $defaultthemecolorslabel = get_string('defaultcolors', 'theme_essential');
                $branch->add('<i class="fa fa-square colours-default"></i>' . $defaultthemecolorslabel,
                        new moodle_url($this->page->url, array('essentialcolours' => 'default')), $defaultthemecolorslabel);
                foreach ($alternativethemes as $alternativethemenumber) {
                    if (!empty($this->page->theme->settings->{'alternativethemename' . $alternativethemenumber})) {
                        $alternativethemeslabel = $this->page->theme->settings->{'alternativethemename' . $alternativethemenumber};
                    } else {
                        $alternativethemeslabel = get_string('alternativecolors', 'theme_essential', $alternativethemenumber);
                    }
                    $branch->add('<i class="fa fa-square colours-alternative' .  $alternativethemenumber . '"></i>' . $alternativethemeslabel,
                            new moodle_url($this->page->url, array('essentialcolours' => 'alternative' . $alternativethemenumber)), $alternativethemeslabel);
                }
            }
        }
        return $this->render_custom_menu($colourmenu);
    }

    /**
     * Outputs the messages menu
     * @return custom menu object
     */
    public function custom_menu_messages() {
        global $USER;
        $messagemenu = new custom_menu();

        $addmessagemenu = true;

        if (!isloggedin() || isguestuser()) {
            $addmessagemenu = false;
        }

        if ($addmessagemenu) {
            $messages = $this->get_user_messages();
            $messagecount = 0;
            foreach ($messages as $message) {
                if (!$message->from) { // Workaround for issue #103 in Elegance.
                    continue;
                }
                $messagecount++;
            }

            $messagetitle =  $messagecount.' ';
            if ($messagecount == 0) {
                $messagemenuicon = html_writer::tag('i', '', array('class' => 'fa fa-envelope-o'));
                $messagetitle .= get_string('messages', 'message');
            } else {
                $messagemenuicon = html_writer::tag('i', '', array('class' => 'fa fa-envelope'));
                if ($messagecount == 1) {
                    $messagetitle .= get_string('message', 'message');
                } else {
                    $messagetitle .= get_string('messages', 'message');
                }
            }
            $messagemenucount = $messagecount.' ';
            $messagemenutext = html_writer::tag('span', $messagemenucount).$messagemenuicon;
            $messagesubmenu = $messagemenu->add(
                $messagemenutext,
                new moodle_url('/message/index.php', array('viewing' => 'recentconversations')),
                $messagetitle,
                9999
            );
            foreach ($messages as $message) {
                if (!$message->from) { // Workaround for issue #103.
                    continue;
                }
                $senderpicture = new user_picture($message->from);
                $senderpicture->link = false;
                $senderpicture->size = 60;

                $messagecontent = html_writer::start_span('msg-picture').$this->render($senderpicture).html_writer::end_span();
                $messagecontent .= html_writer::start_span('msg-body');
                $messagecontent .= html_writer::span($message->from->firstname, 'msg-sender');
                $messagecontent .= html_writer::span($message->text, 'msg-text');
                $messagecontent .= html_writer::start_span('msg-time');
                $messagecontent .= html_writer::tag('i', '', array('class' => 'fa fa-comments'));
                $messagecontent .= html_writer::span($this->get_time_difference($message->date));
                $messagecontent .= html_writer::end_span();
                $messagecontent .= html_writer::end_span();

                $messageurl = new moodle_url('/message/index.php', array('user1' => $USER->id, 'user2' => $message->from->id));
                $messagesubmenu->add($messagecontent, $messageurl, $message->text);
            }
        }

        return $this->render_custom_menu($messagemenu);
    }
    
    protected function get_user_messages() {
        global $USER, $DB;
        $messagelist = array();

        $newmessagesql = "SELECT id, smallmessage, useridfrom, useridto, timecreated, fullmessageformat, notification
                            FROM {message}
                           WHERE useridto = :userid";

        $newmessages = $DB->get_records_sql($newmessagesql, array('userid' => $USER->id));

        foreach ($newmessages as $message) {
            $messagelist[] = $this->process_message($message);
        }

        $showoldmessages = (empty($this->page->theme->settings->showoldmessages)) ? false : $this->page->theme->settings->showoldmessages;
        if ($showoldmessages == 2) {
            $maxmessages = 5;
            $readmessagesql = "SELECT id, smallmessage, useridfrom, useridto, timecreated, fullmessageformat, notification
                                 FROM {message_read}
                                WHERE useridto = :userid
                             ORDER BY timecreated DESC
                                LIMIT $maxmessages";

            $readmessages = $DB->get_records_sql($readmessagesql, array('userid' => $USER->id));

            foreach ($readmessages as $message) {
                $messagelist[] = $this->process_message($message);
            }
        }

        return $messagelist;

    }

    protected function process_message($message) {
        global $DB;
        $messagecontent = new stdClass();

        if ($message->notification) {
            $messagecontent->text = get_string('unreadnewnotification', 'message');
        } else {
            if ($message->fullmessageformat == FORMAT_HTML) {
                $message->smallmessage = html_to_text($message->smallmessage);
            }
            if (core_text::strlen($message->smallmessage) > 18) {
                $messagecontent->text = core_text::substr($message->smallmessage, 0, 15).'...';
            } else {
                $messagecontent->text = $message->smallmessage;
            }
        }
        
        $messagecontent->date = strtotime(userdate($message->timecreated));
        $messagecontent->from = $DB->get_record('user', array('id' => $message->useridfrom));

        return $messagecontent;
    }
    
    protected function get_time_difference($created_time) {
        $today = usertime(time());

        // It returns the time difference in Seconds...
        $time_difference = $today-$created_time;

        // To Calculate the time difference in Years...
        $years = 60*60*24*365;

        // To Calculate the time difference in Months...
        $months = 60*60*24*30;

        // To Calculate the time difference in Days...
        $days = 60*60*24;

        // To Calculate the time difference in Hours...
        $hours = 60*60;

        // To Calculate the time difference in Minutes...
        $minutes = 60;

        if(intval($time_difference/$years) > 1) {
            return get_string('ago', 'core_message', intval($time_difference/$years).' '.get_string('years'));
        } else if(intval($time_difference/$years) > 0) {
            return get_string('ago', 'core_message', intval($time_difference/$years).' '.get_string('year'));
        } else if(intval($time_difference/$months) > 1) {
            return get_string('ago', 'core_message', intval($time_difference/$months).' '.get_string('months'));
        } else if(intval(($time_difference/$months)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference/$months).' '.get_string('month'));
        } else if(intval(($time_difference/$days)) > 1) {
            return get_string('ago', 'core_message', intval($time_difference/$days).' '.get_string('days'));
        } else if (intval(($time_difference/$days)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference/$days).' '.get_string('day'));
        } else if (intval(($time_difference/$hours)) > 1) {
            return get_string('ago', 'core_message', intval($time_difference/$hours).' '.get_string('hours'));
        } else if (intval(($time_difference/$hours)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference/$hours).' '.get_string('hour'));
        } else if (intval(($time_difference/$minutes)) > 1)  {
            return get_string('ago', 'core_message', intval($time_difference/$minutes).' '.get_string('minutes'));
        } else if (intval(($time_difference/$minutes)) > 0) {
            return get_string('ago', 'core_message', intval($time_difference/$minutes).' '.get_string('minute'));
        } else if (intval(($time_difference)) > 20) {
            return get_string('ago', 'core_message', intval($time_difference).' '.get_string('seconds'));
        } else {
            return get_string('ago', 'core_message', get_string('few', 'theme_essential').get_string('seconds'));
        }
    }
    
    /**
     * Outputs the messages menu
     * @return custom menu object
     */
    public function custom_menu_user() {
        global $USER, $CFG, $DB, $SESSION;
        $loginurl = get_login_url();
        
        $usermenu  = html_writer::start_tag('ul', array('class' => 'nav'));
        $usermenu .= html_writer::start_tag('li', array('class' => 'dropdown'));
        
        if (isloggedin() && !isguestuser()) {
            $userurl    = new moodle_url('/user/profile.php?id='.$USER->id);
            $userpic    = parent::user_picture($USER, array('link' => false));
            $caret      = '<i class="fa fa-caret-right"></i>';
            $userclass  = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');
            $usermenu  .= html_writer::link($userurl, $userpic.$USER->firstname.$caret, $userclass);
            
            $usermenu  .= html_writer::start_tag('ul', array('class' => 'dropdown-menu pull-right'));

            if (during_initial_install()) {
                return '';
            }
            
            if (\core\session\manager::is_loggedinas()) {
                $realuser = \core\session\manager::get_realuser();
                
                $branchlabel = '<em><i class="fa fa-key"></i>'.fullname($realuser, true).get_string('loggedinas', 'theme_essential').fullname($USER, true).'</em>';
                $branchurl   = new moodle_url('/user/profile.php?id='.$USER->id);
                $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            } else {
                $branchlabel = '<em><i class="fa fa-user"></i>'.fullname($USER, true).'</em>';
                $branchurl   = new moodle_url('/user/profile.php?id='.$USER->id);
                $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            }
                
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host', array('id'=>$USER->mnethostid))) {
                $branchlabel = '<em><i class="fa fa-users"></i>'.get_string('loggedinfrom' , 'theme_essential').$idprovider->name.'</em>';
                $branchurl   = new moodle_url($idprovider->wwwroot);
                $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            }

                $course = $this->page->course;
                if (is_role_switched($course->id)) { // Has switched roles
                    $branchlabel = '<em><i class="fa fa-users"></i>'.get_string('switchrolereturn').'</em>';
                    $branchurl   = new moodle_url('/course/switchrole.php', array('id'=>$course->id,'sesskey'=>sesskey(), 'switchrole'=>0, 'returnurl'=>$this->page->url->out_as_local_url(false)));
                    $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
                }
                
            $usermenu   .= html_writer::empty_tag('hr', array('class' => 'sep'));

            $branchlabel = '<em><i class="fa fa-calendar"></i>'.get_string('pluginname', 'block_calendar_month').'</em>';
            $branchurl   = new moodle_url('/calendar/view.php');
            $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            
            // Check if messaging is enabled.
            if (!empty($CFG->messaging)) {
                $branchlabel = '<em><i class="fa fa-envelope"></i>'.get_string('pluginname', 'block_messages').'</em>';
                $branchurl   = new moodle_url('/message/index.php');
                $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            }
            
            $branchlabel = '<em><i class="fa fa-file"></i>'.get_string('privatefiles', 'block_private_files').'</em>';
            $branchurl   = new moodle_url('/user/files.php');
            $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            
            $branchlabel = '<em><i class="fa fa-list-alt"></i>'.get_string('forumposts', 'mod_forum').'</em>';
            $branchurl   = new moodle_url('/mod/forum/user.php?id='.$USER->id);
            $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            
            $branchlabel = '<em><i class="fa fa-list"></i>'.get_string('discussions', 'mod_forum').'</em>';
            $branchurl   = new moodle_url('/mod/forum/user.php?id='.$USER->id.'&mode=discussions');
            $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            
            $usermenu   .= html_writer::empty_tag('hr', array('class' => 'sep'));
            
            if ($course->id == 1) {
                if ($hascourses = enrol_get_my_courses(NULL , 'visible DESC,id ASC', 1)) {
                    foreach ($hascourses as $hascourse) {
                        if ($hascourse->visible) {
                            $context = context_course::instance($hascourse->id);
                            if (has_capability ('gradereport/user:view', $context)) {
                                $branchlabel = '<em><i class="fa fa-list-alt"></i>'.get_string('mygrades', 'theme_essential').'</em>';
                                $branchurl   = new moodle_url('/grade/report/overview/index.php?id='.$hascourse->id.'&userid='.$USER->id);
                                $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
                            }
                        }
                    }
                }
            } else {
                $context = context_course::instance($course->id);
                if (has_capability ('gradereport/user:view', $context)) {
                    $branchlabel = '<em><i class="fa fa-list-alt"></i>'.get_string('mygrades', 'theme_essential').'</em>';
                    $branchurl   = new moodle_url('/grade/report/overview/index.php?id='.$course->id.'&userid='.$USER->id);
                    $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
                }
                if (has_capability ('gradereport/user:view', $context)) {
                    $branchlabel = '<em><i class="fa fa-list-alt"></i>'.get_string('coursegrades', 'theme_essential').'</em>';
                    $branchurl   = new moodle_url('/grade/report/user/index.php?id='.$course->id.'&user='.$USER->id);
                    $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
                }
            }
            
            // Check if badges are enabled.
            if (!empty($CFG->enablebadges)) {
                $branchlabel = '<em><i class="fa fa-certificate"></i>'.get_string('badges').'</em>';
                $branchurl   = new moodle_url('/badges/mybadges.php');
                $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            }
            
            $branchlabel = '<em><i class="fa fa-cog"></i>'.get_string('preferences').'</em>';
            $branchurl   = new moodle_url('/user/edit.php?id='.$USER->id);
            $usermenu   .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            
            $usermenu   .= html_writer::empty_tag('hr', array('class' => 'sep'));
                
            $branchlabel = '<em><i class="fa fa-sign-out"></i>'.get_string('logout').'</em>';
            $branchurl   = new moodle_url('/login/logout.php?sesskey='.sesskey());
            $usermenu .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel));
            
            if(!empty($CFG->supportpage)) {
                $branchlabel = '<em><i class="fa fa-question-circle"></i>'.get_string('help').'</em>';
                $branchurl   = new moodle_url($CFG->supportpage);
                $usermenu .= html_writer::tag('li',html_writer::link($branchurl, $branchlabel, array('target' => '_blank')));
            }
            
            $usermenu .= html_writer::end_tag('ul');

        } else {
            $userpic    = '<em><i class="fa fa-sign-in"></i>'.get_string('login').'</em>';
            $usermenu  .= html_writer::link($loginurl, $userpic, array('class' => 'loginurl'));
        }
        
        $usermenu .= html_writer::end_tag('li');
        $usermenu .= html_writer::end_tag('ul');
        
        return $usermenu;
    }

    /**
     * Renders tabtree
     *
     * @param tabtree $tabtree
     * @return string
     */
    public function render_tabtree(tabtree $tabtree) {
        if (empty($tabtree->subtree)) {
            return '';
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
     * @param tabobject $tabobject
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
        if (self::replace_moodle_icon($icon->pix) !== false && $icon->attributes['alt'] === '') {
            return self::replace_moodle_icon($icon->pix);
        } else {
            return parent::render_pix_icon($icon);
        }
    }    
   
    private static function replace_moodle_icon($name) {
        $icons = array(
            'add' => 'plus',
            'book' => 'book',
            'chapter' => 'file',
            'docs' => 'question-sign',
            'generate' => 'gift',
            'i/dragdrop' => 'arrows',
            'i/loading_small' => 'spinner',
            'i/backup' => 'cloud-download',
            'i/checkpermissions' => 'user',
            'i/edit' => 'pencil',
            'i/filter' => 'filter',
            'i/grades' => 'table',
            'i/group' => 'group',
            'i/hide' => 'eye',
            'i/import' => 'upload',
            'i/move_2d' => 'arrows',
            'i/navigationitem' => 'circle',
            'i/outcomes' => 'magic',
            'i/publish' => 'globe',
            'i/reload' => 'refresh',
            'i/report' => 'list-alt',
            'i/restore' => 'cloud-upload',
            'i/return' => 'repeat',
            'i/roles' => 'user',
            'i/settings' => 'cogs',
            'i/show' => 'eye-slash',
            'i/switchrole' => 'random',
            'i/user' => 'user',
            'i/users' => 'user',
            't/right' => 'arrow-right',
            't/left' => 'arrow-left'
        );
        if (isset($icons[$name])) {
            return "<i class=\"fa fa-$icons[$name]\" id=\"icon\"></i>";
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
        return html_writer::tag('a', html_writer::start_tag('i', array('class' => $icon.' fa fa-fw')).
               html_writer::end_tag('i'), array('href' => $url, 'class' => 'btn '.$btn, 'title' => $title));
    }
    
    public function render_social_network($socialnetwork) {
        global $PAGE;
        if (!empty($PAGE->theme->settings->$socialnetwork)) {
            if ($socialnetwork === 'googleplus') {
                $icon = 'google-plus';
            } else if ($socialnetwork === 'website') {
                $icon = 'globe';
            } else if ($socialnetwork === 'ios') {
                $icon = 'apple';
            } else {
                $icon = $socialnetwork;
            }
            $iconclass = $socialnetwork;
            $socialhtml  = html_writer::start_tag('li');
            $socialhtml .= html_writer::start_tag('button', array('type' => "button",
                                                                  'class' => 'socialicon '.$socialnetwork, 
                                                                  'onclick' => "window.open('".$PAGE->theme->settings->$socialnetwork."')",
                                                                  'title' => get_string($socialnetwork, 'theme_essential'),
                                                                  ));
            $socialhtml .= html_writer::start_tag('i', array('class' => 'fa fa-'.$icon.' fa-inverse'));
            $socialhtml .= html_writer::end_tag('i');
            $socialhtml .= html_writer::start_span('sr-only').html_writer::end_span();
            $socialhtml .= html_writer::end_tag('button');
            $socialhtml .= html_writer::end_tag('li');
        
            return $socialhtml;
        
        } else {
            return false;
        }
    }
}
?>