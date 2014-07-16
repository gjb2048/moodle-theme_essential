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
 
 class theme_essential_core_renderer extends theme_bootstrapbase_core_renderer {
 
    public function navbar() {
        $breadcrumbs = '';
        $breadcrumbstyle = $this->page->theme->settings->breadcrumbstyle;
        if (!empty($breadcrumbstyle) && ($breadcrumbstyle > 0) ) {
            foreach ($this->page->navbar->get_items() as $item) {
                $item->hideicon = true;
                $breadcrumbs .= html_writer::tag('li',$this->render($item),array());
            } 
            if ($breadcrumbstyle == 1) {
                $breadcrumbs .= html_writer::tag('li','',array());
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
        
    protected function render_custom_menu(custom_menu $menu) {
        global $CFG,$USER;
        /*
        * This code replaces adds the current enrolled
        * courses to the custommenu.
        */
    
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
            $branchsort  = 10000;
 
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
            if ($courses = enrol_get_my_courses(NULL, 'fullname ASC')) {
                foreach ($courses as $course) {
                    if ($course->visible){
                        $branch->add(format_string($course->fullname), new moodle_url('/course/view.php?id='.$course->id), format_string($course->shortname));
                    }
                }
            } else {
                $noenrolments = get_string('noenrolments', 'theme_essential');
                $branch->add('<em>'.$noenrolments.'</em>', new moodle_url('/'), $noenrolments);
            }
            
        }
        
        /*
        * This code replaces adds the My Dashboard
        * functionality to the custommenu.
        */
        $hasdisplaymydashboard = (empty($this->page->theme->settings->displaymydashboard)) ? false : $this->page->theme->settings->displaymydashboard;
        if (isloggedin() && !isguestuser() && $hasdisplaymydashboard) {
            $branchlabel = '<i class="fa fa-dashboard"></i>'.get_string('mydashboard', 'theme_essential');
            $branchurl   = new moodle_url('/my/index.php');
            $branchtitle = get_string('mydashboard', 'theme_essential');
            $branchsort  = 10000;
 
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
            $branch->add('<em><i class="fa fa-user"></i>'.get_string('profile').'</em>',new moodle_url('/user/profile.php'),get_string('profile'));
            $branch->add('<em><i class="fa fa-calendar"></i>'.get_string('pluginname', 'block_calendar_month').'</em>',new moodle_url('/calendar/view.php'),get_string('pluginname', 'block_calendar_month'));
            // Check if messaging is enabled.
            if (!empty($CFG->messaging)) {
                $branch->add('<em><i class="fa fa-envelope"></i>'.get_string('pluginname', 'block_messages').'</em>',new moodle_url('/message/index.php'),get_string('pluginname', 'block_messages'));
            }
            // Check if badges are enabled.
            if (!empty($CFG->enablebadges)) {
                $branch->add('<em><i class="fa fa-certificate"></i>'.get_string('badges').'</em>',new moodle_url('/badges/mybadges.php'),get_string('badges'));
            }
            $branch->add('<em><i class="fa fa-file"></i>'.get_string('privatefiles', 'block_private_files').'</em>',new moodle_url('/user/files.php'),get_string('privatefiles', 'block_private_files'));
            $branch->add('<i class="fa fa-list-alt"></i>'.get_string('forumposts', 'mod_forum'),new moodle_url('/mod/forum/user.php?id='.$USER->id));
            $branch->add('<i class="fa fa-list"></i>'.get_string('discussions', 'mod_forum'),new moodle_url('/mod/forum/user.php?id='.$USER->id.'&mode=discussions'));
            $branch->add('<em><i class="fa fa-sign-out"></i>'.get_string('logout').'</em>',new moodle_url('/login/logout.php'),get_string('logout'));    
        }
        
        /*
         * This code adds the Theme colors selector to the custommenu.
         */
        if (isloggedin() && !isguestuser()) {
            $alternativethemes = array();
            foreach (range(1, 3) as $alternativethemenumber) {
                if (!empty($this->page->theme->settings->{'enablealternativethemecolors' . $alternativethemenumber})) {
                    $alternativethemes[] = $alternativethemenumber;
                }
            }
            if (!empty($alternativethemes)) {
                $branchtitle = get_string('themecolors', 'theme_essential');
                $branchlabel = '<i class="fa fa-th-large"></i>' . $branchtitle;
                $branchurl   = new moodle_url('/my/index.php');
                $branchsort  = 11000;
                $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
                
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
 
        return parent::render_custom_menu($menu);
    }
    
    /*
    * This code replaces the icons in the Admin block with
    * FontAwesome variants where available.
    */
    
    protected function render_pix_icon(pix_icon $icon) {
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
            't/left' => 'arrow-left',
        );
        if (isset($icons[$name])) {
            return "<i class=\"fa fa-$icons[$name]\" id=\"icon\"></i>";
        } else {
            return false;
        }
    }
    
    
    
    /**
    * Get the HTML for blocks in the given region.
    *
    * @since 2.5.1 2.6
    * @param string $region The region to get HTML for.
    * @return string HTML.
    * Written by G J Barnard
    */
    
    public function essentialblocks($region, $classes = array(), $tag = 'aside') {
        $classes = (array)$classes;
        $classes[] = 'block-region';
        $attributes = array(
            'id' => 'block-region-'.preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $region),
            'class' => join(' ', $classes),
            'data-blockregion' => $region,
            'data-droptarget' => '1'
        );
        return html_writer::tag($tag, $this->blocks_for_region($region), $attributes);
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
            $socialhtml .= html_writer::start_tag('button', array('class' => 'socialicon '.$socialnetwork, 
                                                                  'onclick' => "window.open('".$PAGE->theme->settings->$socialnetwork."')"));
            $socialhtml .= html_writer::start_tag('i', array('class' => 'fa fa-'.$icon.' fa-inverse'));
            $socialhtml .= html_writer::end_tag('i');
            $socialhtml .= html_writer::start_span('sr-only').get_string($socialnetwork, 'theme_essential').html_writer::end_span();
            $socialhtml .= html_writer::end_tag('button');
            $socialhtml .= html_writer::end_tag('li');
        
            return $socialhtml;
        
        } else {
            return false;
        }
    }
}
?>