<div id="page" class="container-fluid">
	<div id="page-content" class="row-fluid">
        <div id="<?php echo $regionbsid ?>" class="span9">
            <div class="row-fluid">
                <section id="region-main" class="span8 desktop-first-column">
                	<div id="page-navbar" class="clearfix">
            			<nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
            			<div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
        			</div>
                    <?php
                    echo $OUTPUT->course_content_header();
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php echo $OUTPUT->blocks('side-pre', 'span4 pull-right'); ?>
            </div>
        </div>
        <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
    </div>
</div>