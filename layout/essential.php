<div id="page" class="container-fluid">
	<div id="page-content" class="row-fluid">

        <?php if ($layout === 'pre-and-post') { ?>
        <section id="region-main" class="span6 desktop-first-column">
        <?php } else if ($layout === 'side-post-only') { ?>
        <section id="region-main" class="span8 desktop-first-column">
        <?php } else if ($layout === 'side-pre-only') { ?>
        <section id="region-main" class="span9 desktop-first-column">
        <?php } else if ($layout === 'content-only') { ?>
        <section id="region-main" class="span12">
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
        <?php if ($layout === 'pre-and-post') { ?>
        <div class="span6">
        <?php } else if ($layout === 'side-post-only') { ?>
        <div class="span3">
        <?php } else if ($layout === 'side-pre-only') { ?>
        <div class="span3">
        <?php } else if ($layout === 'content-only') { ?>
        <div class="span0">
        <?php } ?>
            <?php if ($layout === 'pre-and-post') { ?>
            <div class="span6">
            <?php } else { ?>
            <div class="span12" id="move">
            <?php } ?>
                <div id="region-post" class="block-region">
                    <div class="region-content">
                    <?php echo $OUTPUT->blocks_for_region('side-post'); ?>
                    </div>
                </div>
            </div>
            <?php if ($layout === 'pre-and-post') { ?>
            <div class="span6">
            <?php } else { ?>
            <div class="span12">
            <?php } ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                    <?php echo $OUTPUT->blocks_for_region('side-pre'); ?>
                    </div>
                </div>
            </div>
        </div>
</div>