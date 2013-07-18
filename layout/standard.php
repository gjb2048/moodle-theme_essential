<div id="page" class="container-fluid">

    <div id="page-content" class="row-fluid">
        <div id="<?php echo $regionbsid ?>" class="span12">
            <div class="row-fluid">
                <section id="region-main" class="span8 pull-right">
                	<?php if ($hasnavbar) { ?>
            			<nav class="breadcrumb-button"><?php echo $PAGE->button; ?></nav>
            			<?php echo $OUTPUT->navbar(); ?>
            		<?php } ?>

                    <?php echo $OUTPUT->course_content_header(); ?>
                    <h2 class="pagetitle"><span><?php echo $PAGE->title ?></span></h2>
                    <?php echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column'); ?>
            </div>
        </div>
        <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
    </div>
</div>