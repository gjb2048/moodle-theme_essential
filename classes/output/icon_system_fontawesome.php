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
 * @copyright   2018 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace theme_essential\output;

defined('MOODLE_INTERNAL') || die();

class icon_system_fontawesome extends \core\output\icon_system_fontawesome {

    /**
     * @var array $map Cached map of moodle icon names to font awesome icon names.
     */
    private $map = [];

    public function get_core_icon_map() {
        // Information on https://fontawesome.com/how-to-use/upgrading-from-4.
        return [
            'core:docs' => 'fas fa-info-circle',
            'core:help' => 'fas fa-question-circle text-info',
            'core:req' => 'fas fa-exclamation-circle text-danger',
            'core:a/add_file' => 'far fa-file',
            'core:a/create_folder' => 'far fa-folder',
            'core:a/download_all' => 'fas fa-download',
            'core:a/help' => 'fas fa-question-circle text-info',
            'core:a/logout' => 'fas fa-sign-out-alt',
            'core:a/refresh' => 'fas fa-sync',
            'core:a/search' => 'fas fa-search',
            'core:a/setting' => 'fas fa-cog',
            'core:a/view_icon_active' => 'fas fa-th',
            'core:a/view_list_active' => 'fas fa-list',
            'core:a/view_tree_active' => 'fas fa-folder',
            'core:b/bookmark-new' => 'fas fa-bookmark',
            'core:b/document-edit' => 'fas fa-pencil-alt',
            'core:b/document-new' => 'far fa-file',
            'core:b/document-properties' => 'fas fa-info',
            'core:b/edit-copy' => 'far fa-file',
            'core:b/edit-delete' => 'fas fa-trash',
            'core:e/abbr' => 'fas fa-comment',
            'core:e/absolute' => 'fas fa-crosshairs',
            'core:e/accessibility_checker' => 'fas fa-universal-access',
            'core:e/acronym' => 'fas fa-comment',
            'core:e/advance_hr' => 'fas fa-arrows-alt-h',
            'core:e/align_center' => 'fas fa-align-center',
            'core:e/align_left' => 'fas fa-align-left',
            'core:e/align_right' => 'fas fa-align-right',
            'core:e/anchor' => 'fas fa-link',
            'core:e/backward' => 'fas fa-undo',
            'core:e/bold' => 'fas fa-bold',
            'core:e/bullet_list' => 'fas fa-list-ul',
            'core:e/cancel' => 'fas fa-times',
            'core:e/cell_props' => 'fas fa-info',
            'core:e/cite' => 'fas fa-quote-right',
            'core:e/cleanup_messy_code' => 'fas fa-eraser',
            'core:e/clear_formatting' => 'fas fa-i-cursor',
            'core:e/copy' => 'fas fa-clone',
            'core:e/cut' => 'fas fa-cut',
            'core:e/decrease_indent' => 'fas fa-outdent',
            'core:e/delete_col' => 'fas fa-minus',
            'core:e/delete_row' => 'fas fa-minus',
            'core:e/delete' => 'fas fa-minus',
            'core:e/delete_table' => 'fas fa-minus',
            'core:e/document_properties' => 'fas fa-info',
            'core:e/emoticons' => 'far fa-smile',
            'core:e/find_replace' => 'fas fa-search-plus',
            'core:e/forward' => 'fas fa-arrow-right',
            'core:e/fullpage' => 'fas fa-expand-arrows-alt',
            'core:e/fullscreen' => 'fas fa-expand-arrows-alt',
            'core:e/help' => 'fas fa-question-circle',
            'core:e/increase_indent' => 'fas fa-indent',
            'core:e/insert_col_after' => 'fas fa-columns',
            'core:e/insert_col_before' => 'fas fa-columns',
            'core:e/insert_date' => 'fas fa-calendar-alt',
            'core:e/insert_edit_image' => 'fas fa-image',
            'core:e/insert_edit_link' => 'fas fa-link',
            'core:e/insert_edit_video' => 'fas fa-video',
            'core:e/insert_file' => 'fas fa-file',
            'core:e/insert_horizontal_ruler' => 'fas fa-arrows-alt-h',
            'core:e/insert_nonbreaking_space' => 'far fa-square',
            'core:e/insert_page_break' => 'fas fa-level-down-alt',
            'core:e/insert_row_after' => 'fas fa-plus',
            'core:e/insert_row_before' => 'fas fa-plus',
            'core:e/insert' => 'fas fa-plus',
            'core:e/insert_time' => 'far fa-clock',
            'core:e/italic' => 'fas fa-italic',
            'core:e/justify' => 'fas fa-align-justify',
            'core:e/layers_over' => 'fas fa-level-up-alt',
            'core:e/layers' => 'fas fa-window-restore',
            'core:e/layers_under' => 'fas fa-level-down-alt',
            'core:e/left_to_right' => 'fas fa-chevron-right',
            'core:e/manage_files' => 'far fa-copy',
            'core:e/math' => 'fas fa-calculator',
            'core:e/merge_cells' => 'fas fa-compress',
            'core:e/new_document' => 'far fa-file',
            'core:e/numbered_list' => 'fas fa-list-ol',
            'core:e/page_break' => 'fas fa-level-down-alt',
            'core:e/paste' => 'far fa-clipboard',
            'core:e/paste_text' => 'far fa-clipboard',
            'core:e/paste_word' => 'far fa-clipboard',
            'core:e/prevent_autolink' => 'fas fa-exclamation',
            'core:e/preview' => 'fas fa-search-plus',
            'core:e/print' => 'fas fa-print',
            'core:e/question' => 'fas fa-question',
            'core:e/redo' => 'fas fa-redo',
            'core:e/remove_link' => 'fas fa-unlink',
            'core:e/remove_page_break' => 'fas fa-times',
            'core:e/resize' => 'fas fa-expand',
            'core:e/restore_draft' => 'fas fa-undo',
            'core:e/restore_last_draft' => 'fas fa-undo',
            'core:e/right_to_left' => 'fas fa-chevron-left',
            'core:e/row_props' => 'fas fa-info',
            'core:e/save' => 'far fa-floppy',
            'core:e/screenreader_helper' => 'fas fa-braille',
            'core:e/search' => 'fas fa-search',
            'core:e/select_all' => 'fas fa-arrows-alt-h',
            'core:e/show_invisible_characters' => 'fas fa-eye-slash',
            'core:e/source_code' => 'fas fa-code',
            'core:e/special_character' => 'fas fa-pen-square',
            'core:e/spellcheck' => 'fas fa-check',
            'core:e/split_cells' => 'fas fa-columns',
            'core:e/strikethrough' => 'fas fa-strikethrough',
            'core:e/styleprops' => 'fas fa-info',
            'core:e/subscript' => 'fas fa-subscript',
            'core:e/superscript' => 'fas fa-superscript',
            'core:e/table_props' => 'fas fa-table',
            'core:e/table' => 'fas fa-table',
            'core:e/template' => 'fas fa-sticky-note',
            'core:e/text_color_picker' => 'fas fa-paint-brush',
            'core:e/text_color' => 'fas fa-paint-brush',
            'core:e/text_highlight_picker' => 'far fa-lightbulb',
            'core:e/text_highlight' => 'far fa-lightbulb',
            'core:e/tick' => 'fas fa-check',
            'core:e/toggle_blockquote' => 'fas fa-quote-left',
            'core:e/underline' => 'fas fa-underline',
            'core:e/undo' => 'fas fa-undo',
            'core:e/visual_aid' => 'fas fa-universal-access',
            'core:e/visual_blocks' => 'fas fa-audio-description',
            'theme:fp/add_file' => 'far fa-file',
            'theme:fp/alias' => 'fas fa-share',
            'theme:fp/alias_sm' => 'fas fa-share',
            'theme:fp/check' => 'fas fa-check',
            'theme:fp/create_folder' => 'far fa-folder',
            'theme:fp/cross' => 'fas fa-times',
            'theme:fp/download_all' => 'fas fa-download',
            'theme:fp/help' => 'fas fa-question-circle',
            'theme:fp/link' => 'fas fa-link',
            'theme:fp/link_sm' => 'fas fa-link',
            'theme:fp/logout' => 'fas fa-sign-out-alt',
            'theme:fp/path_folder' => 'fas fa-folder',
            'theme:fp/path_folder_rtl' => 'fas fa-folder',
            'theme:fp/refresh' => 'fas fa-sync',
            'theme:fp/search' => 'fas fa-search',
            'theme:fp/setting' => 'fas fa-cog',
            'theme:fp/view_icon_active' => 'fas fa-th',
            'theme:fp/view_list_active' => 'fas fa-list',
            'theme:fp/view_tree_active' => 'fas fa-folder',
            'core:i/assignroles' => 'fas fa-user-plus',
            'core:i/backup' => 'fas fa-file-archive',
            'core:i/badge' => 'fas fa-shield-alt',
            'core:i/calc' => 'fas fa-calculator',
            'core:i/calendar' => 'fas fa-calendar-alt',
            'core:i/calendareventdescription' => 'fas fa-align-left',
            'core:i/calendareventtime' => 'far fa-clock',
            'core:i/caution' => 'fas fa-exclamation text-warning',
            'core:i/checked' => 'fas fa-check',
            'core:i/checkpermissions' => 'fas fa-unlock-alt',
            'core:i/cohort' => 'fas fa-users',
            'core:i/competencies' => 'far fa-check-square',
            'core:i/completion_self' => 'far fa-user',
            'core:i/dashboard' => 'fas fa-tachometer-alt',
            'core:i/lock' => 'fas fa-lock',
            'core:i/categoryevent' => 'fas fa-cubes',
            'core:i/courseevent' => 'fas fa-university',
            'core:i/db' => 'fas fa-database',
            'core:i/delete' => 'fas fa-trash',
            'core:i/down' => 'fas fa-arrow-down',
            'core:i/dragdrop' => 'fas fa-arrows-alt',
            'core:i/duration' => 'far fa-clock',
            'core:i/edit' => 'fas fa-pencil-alt',
            'core:i/email' => 'fas fa-envelope',
            'core:i/enrolmentsuspended' => 'fas fa-pause',
            'core:i/enrolusers' => 'fas fa-user-plus',
            'core:i/expired' => 'fas fa-exclamation text-warning',
            'core:i/export' => 'fas fa-download',
            'core:i/files' => 'far fa-copy',
            'core:i/filter' => 'fas fa-filter',
            'core:i/flagged' => 'fas fa-flag',
            'core:i/folder' => 'fas fa-folder',
            'core:i/grade_correct' => 'fas fa-check text-success',
            'core:i/grade_incorrect' => 'fas fa-times text-danger',
            'core:i/grade_partiallycorrect' => 'fas fa-check-square',
            'core:i/grades' => 'fas fa-table',
            'core:i/groupevent' => 'fas fa-users',
            'core:i/groupn' => 'fas fa-user',
            'core:i/group' => 'fas fa-users',
            'core:i/groups' => 'fas fa-user-circle',
            'core:i/groupv' => 'far fa-user-circle',
            'core:i/hide' => 'fas fa-eye',
            'core:i/home' => 'fas fa-home',
            'core:i/hierarchylock' => 'fas fa-lock',
            'core:i/import' => 'fas fa-level-up-alt',
            'core:i/info' => 'fas fa-info',
            'core:i/invalid' => 'fas fa-times text-danger',
            'core:i/item' => 'fas fa-circle',
            'core:i/loading' => 'fas fa-circle-notch fa-spin',
            'core:i/loading_small' => 'fas fa-circle-notch fa-spin',
            'core:i/lock' => 'fas fa-lock',
            'core:i/log' => 'fas fa-list-alt',
            'core:i/mahara_host' => 'fas fa-id-badge',
            'core:i/manual_item' => 'far fa-square',
            'core:i/marked' => 'fas fa-circle',
            'core:i/marker' => 'far fa-circle',
            'core:i/mean' => 'fas fa-calculator',
            'core:i/menu' => 'fas fa-ellipsis-v',
            'core:i/menubars' => 'fas fa-bars',
            'core:i/mnethost' => 'fas fa-external-link-alt',
            'core:i/moodle_host' => 'fas fa-graduation-cap',
            'core:i/move_2d' => 'fas fa-arrows-alt',
            'core:i/navigationitem' => 'fas fa-chevron-right',
            'core:i/ne_red_mark' => 'fas fa-times',
            'core:i/new' => 'fas fa-bolt',
            'core:i/news' => 'far fa-newspaper',
            'core:i/nosubcat' => 'far fa-plus-square',
            'core:i/notifications' => 'fas fa-bell',
            'core:i/open' => 'fas fa-folder-open',
            'core:i/outcomes' => 'fas fa-tasks',
            'core:i/payment' => 'far fa-money-bill-alt',
            'core:i/permissionlock' => 'fas fa-lock',
            'core:i/permissions' => 'fas fa-pen-square',
            'core:i/persona_sign_in_black' => 'fas fa-male',
            'core:i/portfolio' => 'fas fa-id-badge',
            'core:i/preview' => 'fas fa-search-plus',
            'core:i/progressbar' => 'fas fa-spinner fa-spin',
            'core:i/publish' => 'fas fa-share',
            'core:i/questions' => 'fas fa-question',
            'core:i/reload' => 'fas fa-sync',
            'core:i/report' => 'fas fa-chart-area',
            'core:i/repository' => 'far fa-hdd',
            'core:i/restore' => 'fas fa-level-up-alt',
            'core:i/return' => 'fas fa-arrow-left',
            'core:i/risk_config' => 'fas fa-exclamation text-muted',
            'core:i/risk_managetrust' => 'fas fa-exclamation-triangle text-warning',
            'core:i/risk_personal' => 'fas fa-exclamation-circle text-info',
            'core:i/risk_spam' => 'fas fa-exclamation text-primary',
            'core:i/risk_xss' => 'fas fa-exclamation-triangle text-danger',
            'core:i/role' => 'fas fa-user-md',
            'core:i/rss' => 'fas fa-rss',
            'core:i/rsssitelogo' => 'fas fa-graduation-cap',
            'core:i/scales' => 'fas fa-balance-scale',
            'core:i/scheduled' => 'far fa-calendar-check',
            'core:i/search' => 'fas fa-search',
            'core:i/settings' => 'fas fa-cog',
            'core:i/show' => 'fas fa-eye-slash',
            'core:i/siteevent' => 'fas fa-globe',
            'core:i/star-rating' => 'fas fa-star',
            'core:i/stats' => 'fas fa-chart-line',
            'core:i/switch' => 'fas fa-exchange-alt',
            'core:i/switchrole' => 'fas fa-user-secret',
            'core:i/twoway' => 'fas fa-arrows-alt-h',
            'core:i/unchecked' => 'far fa-square',
            'core:i/unflagged' => 'far fa-flag',
            'core:i/unlock' => 'fas fa-unlock',
            'core:i/up' => 'fas fa-arrow-up',
            'core:i/userevent' => 'fas fa-user',
            'core:i/user' => 'fas fa-user',
            'core:i/users' => 'fas fa-users',
            'core:i/valid' => 'fas fa-check text-success',
            'core:i/warning' => 'fas fa-exclamation text-warning',
            'core:i/withsubcat' => 'fas fa-plus-square',
            'core:m/USD' => 'fas fa-usd',
            'core:t/addcontact' => 'fas fa-address-card',
            'core:t/add' => 'fas fa-plus',
            'core:t/approve' => 'fas fa-thumbs-up',
            'core:t/assignroles' => 'fas fa-user-circle',
            'core:t/award' => 'fas fa-trophy',
            'core:t/backpack' => 'fas fa-shopping-bag',
            'core:t/backup' => 'fas fa-arrow-circle-down',
            'core:t/block' => 'fas fa-ban',
            'core:t/block_to_dock_rtl' => 'fas fa-chevron-right',
            'core:t/block_to_dock' => 'fas fa-chevron-left',
            'core:t/calc_off' => 'fas fa-calculator', // TODO: Change to better icon once we have stacked icon support or more icons.
            'core:t/calc' => 'fas fa-calculator',
            'core:t/check' => 'fas fa-check',
            'core:t/cohort' => 'fas fa-users',
            'core:t/collapsed_empty_rtl' => 'far fa-plus-square',
            'core:t/collapsed_empty' => 'far fa-plus-square',
            'core:t/collapsed_rtl' => 'fas fa-plus-square',
            'core:t/collapsed' => 'fas fa-plus-square',
            'core:t/contextmenu' => 'fas fa-cog',
            'core:t/copy' => 'fas fa-copy',
            'core:t/delete' => 'fas fa-trash',
            'core:t/dockclose' => 'fas fa-window-close',
            'core:t/dock_to_block_rtl' => 'fas fa-chevron-right',
            'core:t/dock_to_block' => 'fas fa-chevron-left',
            'core:t/download' => 'fas fa-download',
            'core:t/down' => 'fas fa-arrow-down',
            'core:t/dropdown' => 'fas fa-cog',
            'core:t/editinline' => 'fas fa-pencil-alt',
            'core:t/edit_menu' => 'fas fa-cog',
            'core:t/editstring' => 'fas fa-pencil-alt',
            'core:t/edit' => 'fas fa-cog',
            'core:t/emailno' => 'fas fa-ban',
            'core:t/email' => 'far fa-envelope',
            'core:t/enrolusers' => 'fas fa-user-plus',
            'core:t/expanded' => 'fas fa-caret-down',
            'core:t/go' => 'fas fa-play',
            'core:t/grades' => 'fas fa-table',
            'core:t/groupn' => 'fas fa-user',
            'core:t/groups' => 'fas fa-user-circle',
            'core:t/groupv' => 'far fa-user-circle',
            'core:t/hide' => 'fas fa-eye',
            'core:t/left' => 'fas fa-arrow-left',
            'core:t/less' => 'fas fa-caret-up',
            'core:t/locked' => 'fas fa-lock',
            'core:t/lock' => 'fas fa-unlock',
            'core:t/locktime' => 'fas fa-lock',
            'core:t/markasread' => 'fas fa-check',
            'core:t/messages' => 'fas fa-comments',
            'core:t/message' => 'fas fa-comment',
            'core:t/more' => 'fas fa-caret-down',
            'core:t/move' => 'fas fa-arrows-alt-v',
            'core:t/passwordunmask-edit' => 'fas fa-pencil-alt',
            'core:t/passwordunmask-reveal' => 'fas fa-eye',
            'core:t/portfolioadd' => 'fas fa-plus',
            'core:t/preferences' => 'fas fa-wrench',
            'core:t/preview' => 'fas fa-search-plus',
            'core:t/print' => 'fas fa-print',
            'core:t/removecontact' => 'fas fa-user-times',
            'core:t/reset' => 'fas fa-redo',
            'core:t/restore' => 'fas fa-arrow-circle-up',
            'core:t/right' => 'fas fa-arrow-right',
            'core:t/show' => 'fas fa-eye-slash',
            'core:t/sort_asc' => 'fas fa-sort-up',
            'core:t/sort_desc' => 'fas fa-sort-down',
            'core:t/sort' => 'fas fa-sort',
            'core:t/stop' => 'fas fa-stop',
            // Note: Does not work with blocks due to M.util.init_block_hider using M.util.image_url.  See: MDL-58848.
            'core:t/switch_minus' => 'fas fa-minus',
            'core:t/switch_plus' => 'fas fa-plus',
            'core:t/switch_whole' => 'far fa-square',
            'core:t/unblock' => 'fas fa-commenting-alt',
            'core:t/unlocked' => 'fas fa-unlock-alt',
            'core:t/unlock' => 'fas fa-lock',
            'core:t/up' => 'fas fa-arrow-up',
            'core:t/user' => 'fas fa-user',
            'core:t/viewdetails' => 'fas fa-list',
        ];
    }

    /**
     * Overridable function to get a mapping of all icons.
     * Default is to do no mapping.
     */
    public function get_icon_name_map() {
        if ($this->map === []) {
            $cache = \cache::make('theme_essential', 'fontawesome5iconmapping');

            $this->map = $cache->get('mapping');

            if (empty($this->map)) {
                $this->map = $this->get_core_icon_map();
                $callback = 'get_fontawesome_icon_map';

                if ($pluginsfunction = get_plugins_with_function($callback)) {
                    $toolbox = \theme_essential\toolbox::get_instance();
                    foreach ($pluginsfunction as $plugintype => $plugins) {
                        foreach ($plugins as $pluginsubtype => $pluginfunction) {
                            $pluginmap = $pluginfunction();
                            // Convert map from fas 4 to 5.
                            foreach ($pluginmap as $micon => $faicon) {
                                $pluginmap[$micon] = $toolbox->get_fa5_from_fa4($faicon, true);
                            }
                            $this->map += $pluginmap;
                        }
                    }
                }
                $cache->set('mapping', $this->map);
            }

        }
        return $this->map;
    }

    public function get_amd_name() {
        return 'theme_essential/icon_system_fontawesome';
    }

    public function render_pix_icon(\renderer_base $output, \pix_icon $icon) {
        $subtype = '\pix_icon_fontawesome';
        $subpix = new $subtype($icon);
        $data = $subpix->export_for_template($output);

        if (!$subpix->is_mapped()) {
            $data['unmappedIcon'] = $icon->export_for_template($output);
        }

        return $output->render_from_template('theme_essential/pix_icon_fontawesome', $data);
    }
}

