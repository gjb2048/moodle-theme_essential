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
 * Shoelace theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage shoelace
 * @copyright  &copy; 2018-onwards G J Barnard in respect to modifications of /lib/amd/src/icon_system_fontawesome.js.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Damyon Wiese.
 */

define(['core/icon_system', 'jquery', 'core/ajax', 'core/mustache', 'core/localstorage', 'core/url'],
        function(IconSystem, $, Ajax, Mustache, LocalStorage, Url) {

    var staticMap = null;
    var fetchMap = null;

    /**
     * IconSystemFontawesome
     */
    var IconSystemFontawesome = function() {
        IconSystem.apply(this, arguments);
    };
    IconSystemFontawesome.prototype = Object.create(IconSystem.prototype);

    /**
     * Prefetch resources so later calls to renderIcon can be resolved synchronously.
     *
     * @method init
     * @return {Promise}
     */
    IconSystemFontawesome.prototype.init = function() {
        if (staticMap) {
            return $.when(this);
        }

        var map = LocalStorage.get('theme_shoelace/iconmap-fontawesome');
        if (map) {
            map = JSON.parse(map);
        }

        if (map) {
            staticMap = map;
            return $.when(this);
        }

        if (fetchMap === null) {
            fetchMap = Ajax.call([{
                methodname: 'theme_shoelace_output_load_fontawesome_icon_map',
                args: []
            }], true, false)[0];
        }

        return fetchMap.then(function(map) {
            staticMap = {};
            $.each(map, function(index, value) {
                staticMap[value.component + '/' + value.pix] = value.to;
            });
            LocalStorage.set('theme_shoelace/iconmap-fontawesome', JSON.stringify(staticMap));
            return this;
        }.bind(this));
    };

    /**
     * Render an icon.
     *
     * @param {String} key
     * @param {String} component
     * @param {String} title
     * @param {String} template
     * @return {String}
     * @method renderIcon
     */
    IconSystemFontawesome.prototype.renderIcon = function(key, component, title, template) {
        var mappedIcon = staticMap[component + '/' + key];
        var unmappedIcon = false;
        if (typeof mappedIcon === "undefined") {
            var url = Url.imageUrl(key, component);

            unmappedIcon = {
                attributes: [
                    {name: 'src', value: url},
                    {name: 'alt', value: title},
                    {name: 'title', value: title}
                ]
            };
        }

        var context = {
            key: mappedIcon,
            title: title,
            alt: title,
            unmappedIcon: unmappedIcon
        };

        return Mustache.render(template, context);
    };

    /**
     * Get the name of the template to pre-cache for this icon system.
     *
     * @return {String}
     * @method getTemplateName
     */
    IconSystemFontawesome.prototype.getTemplateName = function() {
        return 'theme_shoelace/pix_icon_fontawesome';
    };

    return /** @alias module:theme_shoelace/icon_system_fontawesome */ IconSystemFontawesome;

});
