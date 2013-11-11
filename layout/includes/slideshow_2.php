<?php 
    if ($hasslideshow && !strpos($checkuseragent, 'MSIE 7')) { // Hide slideshow for IE7
?>
    <div id="da-slider" class="da-slider variant2	<?php echo $hideonphone ?>" style="background-position: 8650% 0%;">

    <?php if ($hasslide1) { ?>
        <div class="da-slide">
            <h2><?php echo $slide1 ?></h2>
            <?php if ($hasslide1caption) { ?>
                <p><?php echo $slide1caption ?></p>
            <?php } ?>
            <?php if ($hasslide1url) { ?>
                <a href="<?php echo $slide1url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide1image) { ?>
            <div class="da-img"><img src="<?php echo $slide1image ?>" alt="<?php echo $slide1 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    

    <?php if ($hasslide2) { ?>
        <div class="da-slide">
            <h2><?php echo $slide2 ?></h2>
            <?php if ($hasslide2caption) { ?>
                <p><?php echo $slide2caption ?></p>
            <?php } ?>
            <?php if ($hasslide2url) { ?>
                <a href="<?php echo $slide2url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide2image) { ?>
            <div class="da-img"><img src="<?php echo $slide2image ?>" alt="<?php echo $slide2 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    

    <?php if ($hasslide3) { ?>
        <div class="da-slide">
            <h2><?php echo $slide3 ?></h2>
            <?php if ($hasslide3caption) { ?>
                <p><?php echo $slide3caption ?></p>
            <?php } ?>
            <?php if ($hasslide3url) { ?>
                <a href="<?php echo $slide3url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide3image) { ?>
            <div class="da-img"><img src="<?php echo $slide3image ?>" alt="<?php echo $slide3 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    

    <?php if ($hasslide4) { ?>
        <div class="da-slide">
            <h2><?php echo $slide4 ?></h2>
            <?php if ($hasslide4caption) { ?>
                <p><?php echo $slide4caption ?></p>
            <?php } ?>
            <?php if ($hasslide4url) { ?>
                <a href="<?php echo $slide4url ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide4image) { ?>
            <div class="da-img"><img src="<?php echo $slide4image ?>" alt="<?php echo $slide4 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
    
    

        <nav class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>
        </nav>
        
    </div>
<?php } ?>