<?php

$hasfacebook    = (empty($PAGE->theme->settings->facebook)) ? false : $PAGE->theme->settings->facebook;
$hastwitter     = (empty($PAGE->theme->settings->twitter)) ? false : $PAGE->theme->settings->twitter;
$hasgoogleplus  = (empty($PAGE->theme->settings->googleplus)) ? false : $PAGE->theme->settings->googleplus;
$hasflickr      = (empty($PAGE->theme->settings->flickr)) ? false : $PAGE->theme->settings->flickr;
$haspicasa      = (empty($PAGE->theme->settings->picasa)) ? false : $PAGE->theme->settings->picasa;
$haslinkedin    = (empty($PAGE->theme->settings->linkedin)) ? false : $PAGE->theme->settings->linkedin;
$hasyoutube     = (empty($PAGE->theme->settings->youtube)) ? false : $PAGE->theme->settings->youtube;

?>
<header id="page-header" class="clearfix">
    <div class="container-fluid">
    <div class="row">
    <!-- HEADER: LOGO AREA -->
        <div class="span5 desktop-first-column">
            <?php
            if (!$haslogo) { ?>
                <h1><?php echo $PAGE->heading; ?></h1>
            <?php
            } else { ?>
                <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
            <?php
            } ?>
        </div>
        <div class="span3 pull-right">
            <ul class="socials unstyled">
            <p>Our Social Networks</p>
                <?php if ($hasgoogleplus) { ?>
                <li><a class="googleplus" href="<?php echo $hasgoogleplus; ?>"></a></li>
                <?php } ?>
                <?php if ($hastwitter) { ?>
                <li><a class="twitter" href="<?php echo $hastwitter; ?>"></a></li>
                <?php } ?>
                <?php if ($hasfacebook) { ?>
                <li><a class="facebook" href="<?php echo $hasfacebook; ?>"></a></li>
                <?php } ?>
                <?php if ($haslinkedin) { ?>
                <li><a class="linkedin" href="<?php echo $haslinkedin; ?>"></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php if (!empty($courseheader)) { ?>
        <div id="course-header"><?php echo $courseheader; ?></div>
        <?php } ?>
    </div>
</header>
