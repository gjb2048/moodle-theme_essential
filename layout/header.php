<header id="page-header" class="clearfix">
	<div class="container-fluid">
	<div class="row">
	<!-- HEADER: LOGO AREA -->
		<div class="span5 desktop-first-column">
			<?php
			if (!$haslogo) { ?>
				<h1><?php echo $PAGE->heading ?></h1>
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
				<li><a class="googleplus" href="<?php echo $googleplus ?>"></a></li>
				<?php } ?>
				<?php if ($hastwitter) { ?>
				<li><a class="twitter" href="<?php echo $twitter ?>"></a></li>
				<?php } ?>
				<?php if ($hasfacebook) { ?>
				<li><a class="facebook" href="<?php echo $facebook ?>"></a></li>
				<?php } ?>
				<?php if ($haslinkedin) { ?>
				<li><a class="linkedin" href="<?php echo $linkedin ?>"></a></li>
				<?php } ?>
			</ul>
		</div>


    <?php if (!empty($courseheader)) { ?>
        <div id="course-header"><?php echo $courseheader; ?></div>
    <?php } ?>
    </div>
</header>