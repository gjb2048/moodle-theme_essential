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
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


function xmldb_theme_essential_upgrade($oldversion = 0) {

    if ($oldversion < 2016061708) {
        // Define table theme_essential to be created.
        $table = new xmldb_table('theme_essential');

        // Adding fields to table theme_essential.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('alertid', XMLDB_TYPE_INTEGER, '2', null, null, null, '0');
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('state', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table theme_essential.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('userid', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));

        global $DB;
        $dbman = $DB->get_manager();
        // Conditionally launch create table for theme_essential.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Essential savepoint reached.
        upgrade_plugin_savepoint(true, 2016061708, 'theme', 'essential');
    }

    // Automatic 'Purge all caches'....
    if ($oldversion < 2106022400) {
        purge_all_caches();
    }

    return true;
}