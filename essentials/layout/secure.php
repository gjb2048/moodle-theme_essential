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
 * Essentials is a basic child theme of Essential to help you as a theme
 * developer create your own child theme of Essential.
 *
 * @package     theme_essentials
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($OUTPUT->get_include_file('pagesettings'));

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>"/>
    <?php echo $OUTPUT->get_csswww(); ?>
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<header role="banner" class="navbar navbar-fixed-top">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo preg_replace("(https?:)", "", $CFG->wwwroot); ?>"><?php echo $SITE->shortname; ?></a>
        </div>
    </nav>
</header>

<div id="page" class="container-fluid">
    <section role="main-content">
        <div id="page-content" class="row-fluid">
            <div id="region-bs-main-and-pre" class="span9">
                <div class="row-fluid">
                    <section id="region-main" class="span8 pull-right">
                        <?php echo $OUTPUT->main_content(); ?>
                    </section>
                    <?php echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column'); ?>
                </div>
            </div>
            <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
        </div>
    </section>
</div>

<footer>
    <a href="#top" class="back-to-top" ><i class="fa fa-angle-up "></i></a>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            <?php
            if ($OUTPUT->theme_essential_not_lte_ie9()) {
              echo "jQuery('#essentialnavbar').affix({";
              echo "offset: {";
              echo "top: $('#page-header').height()";
              echo "}";
              echo "});";
              if ($breadcrumbstyle == '1') {
                  echo "$('.breadcrumb').jBreadCrumb();";
              }
            }
            if ($OUTPUT->get_setting('fitvids')) {
                echo "$('#page').fitVids();";
            }
            ?>
        });
    </script>
</footer>

<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>