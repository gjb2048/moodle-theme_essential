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
?>
    <nav id="essentialnavbar" role="navigation"<?php echo ($oldnavbar) ? ' class="oldnavbar"' : ''; ?>>
        <div class="navbar">
            <div class="container-fluid navbar-inner">
                <div class="row-fluid">
                    <div class="custommenus pull-<?php echo ($left) ? 'left' : 'right'; ?>">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target="#essentialmenus">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <?php echo $OUTPUT->get_title('navbar'); ?>
                    <div class="pull-<?php echo ($left) ? 'right' : 'left'; ?>">
                        <div class="usermenu">
                            <?php echo $OUTPUT->custom_menu_user(); ?>
                        </div>
                        <div class="messagemenu">
                            <?php echo $OUTPUT->custom_menu_messages(); ?>
                        </div>
                        <div class="gotobottommenu">
                            <?php echo $OUTPUT->custom_menu_goto_bottom(); ?>
                        </div>
                        <div id="custom_menu_editing" class="editingmenu">
                            <?php echo $OUTPUT->custom_menu_editing(); ?>
                        </div>
                    </div>
                        <div id='essentialmenus' class="nav-collapse collapse pull-<?php echo ($left) ? 'left' : 'right'; ?>">
                            <div id="custom_menu_language">
                                <?php echo $OUTPUT->custom_menu_language(); ?>
                            </div>
                            <div id="custom_menu_courses">
                                <?php echo $OUTPUT->custom_menu_courses(); ?>
                            </div>
                            <?php if ($colourswitcher) { ?>
                                <div id="custom_menu_themecolours">
                                    <?php echo $OUTPUT->custom_menu_themecolours(); ?>
                                </div>
<?php
}
?>
                            <div id="custom_menu">
                                <?php echo $OUTPUT->custom_menu(); ?>
                            </div>
                            <div id="custom_menu_activitystream">
                                <?php echo $OUTPUT->custom_menu_activitystream(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
