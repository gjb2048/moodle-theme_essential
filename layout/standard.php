





<div id="page" class="container-fluid">

<div id="page-content" class="row-fluid">

<?php if ($layout === 'pre-and-post') { ?>
    <div id="region-bs-main-and-pre" class="span9">
    <div class="row-fluid">
    <section id="region-bs-main" class="span8 pull-right">
<?php } else if ($layout === 'side-post-only') { ?>
    <section id="region-bs-main" class="span9">
<?php } else if ($layout === 'side-pre-only') { ?>
    <section id="region-bs-main" class="span9 pull-right">
<?php } else if ($layout === 'content-only') { ?>
    <section id="region-bs-main" class="span12">
<?php } ?>
	<?php if ($hasnavbar) { ?>
            			<nav class="breadcrumb-button"><?php echo $PAGE->button; ?></nav>
            			<?php echo $OUTPUT->navbar(); ?>
            		<?php } ?>

    <?php echo $coursecontentheader; ?>
    <h2 class="pagetitle"><span><?php echo $PAGE->title ?></span></h2>
    <?php echo $OUTPUT->main_content() ?>
    <?php echo $coursecontentfooter; ?>
    </section>


<?php if ($layout !== 'content-only') {
          if ($layout === 'pre-and-post') { ?>
            <aside id="region-pre" class="span4 block-region desktop-first-column region-content">
    <?php } else if ($layout === 'side-pre-only') { ?>
            <aside id="region-pre" class="span3 block-region desktop-first-column region-content">
    <?php } ?>
          <?php
                if (!right_to_left()) {
                    echo $OUTPUT->blocks_for_region('side-pre');
                } else if ($hassidepost) {
                    echo $OUTPUT->blocks_for_region('side-post');
                }
            ?>
            </aside>
    <?php if ($layout === 'pre-and-post') {
          ?></div></div><?php // Close row-fluid and span9.
   }

    if ($layout === 'side-post-only' OR $layout === 'pre-and-post') { ?>
        <aside id="region-post" class="span3 block-region region-content">
        <?php if (!right_to_left()) {
                  echo $OUTPUT->blocks_for_region('side-post');
              } else {
                  echo $OUTPUT->blocks_for_region('side-pre');
              } ?>
        </aside>
    <?php } ?>
<?php } ?>
</div>