<?php 

$hasslide1 = (!empty($PAGE->theme->settings->slide1));
$hasslide1image = (!empty($PAGE->theme->settings->slide1image));
$hasslide1caption = (!empty($PAGE->theme->settings->slide1caption));
$hasslide1url = (!empty($PAGE->theme->settings->slide1url));
$hasslide2 = (!empty($PAGE->theme->settings->slide2));
$hasslide2image = (!empty($PAGE->theme->settings->slide2image));
$hasslide2caption = (!empty($PAGE->theme->settings->slide2caption));
$hasslide2url = (!empty($PAGE->theme->settings->slide2url));
$hasslide3 = (!empty($PAGE->theme->settings->slide3));
$hasslide3image = (!empty($PAGE->theme->settings->slide3image));
$hasslide3caption = (!empty($PAGE->theme->settings->slide3caption));
$hasslide3url = (!empty($PAGE->theme->settings->slide3url));
$hasslide4 = (!empty($PAGE->theme->settings->slide4));
$hasslide4image = (!empty($PAGE->theme->settings->slide4image));
$hasslide4caption = (!empty($PAGE->theme->settings->slide4caption));
$hasslide4url = (!empty($PAGE->theme->settings->slide4url));
$hasslide5 = (!empty($PAGE->theme->settings->slide5));
$hasslide5image = (!empty($PAGE->theme->settings->slide5image));
$hasslide5caption = (!empty($PAGE->theme->settings->slide5caption));
$hasslide5url = (!empty($PAGE->theme->settings->slide5url));
$hasslideshow = ($hasslide1||$hasslide2||$hasslide3||$hasslide4||$hasslide5);
$slideshow = $PAGE->theme->settings->slideshowvariant;

/* Slide 1 settings */
$hideonphone = $PAGE->theme->settings->hideonphone;
if ($hasslide1) {
    $slide1 = $PAGE->theme->settings->slide1;
}

if ($slideshow === '1') {
	$slideshowvariant = '';
} else {
	$slideshowvariant = ' variant2';
}
	
if ($hasslide1image) {
    $slide1image = $PAGE->theme->setting_file_url('slide1image', 'slide1image');
}
if ($hasslide1caption) {
    $slide1caption = $PAGE->theme->settings->slide1caption;
}
if ($hasslide1url) {
    $slide1url = $PAGE->theme->settings->slide1url;
	$slide1target = $PAGE->theme->settings->slide1target;
}

/* Slide 2 settings */
if ($hasslide2) {
    $slide2 = $PAGE->theme->settings->slide2;
}
if ($hasslide2image) {
    $slide2image = $PAGE->theme->setting_file_url('slide2image', 'slide2image');
}
if ($hasslide2caption) {
    $slide2caption = $PAGE->theme->settings->slide2caption;
}
if ($hasslide2url) {
    $slide2url = $PAGE->theme->settings->slide2url;
	$slide2target = $PAGE->theme->settings->slide2target;
}

/* Slide 3 settings */
if ($hasslide3) {
    $slide3 = $PAGE->theme->settings->slide3;
}
if ($hasslide3image) {
    $slide3image = $PAGE->theme->setting_file_url('slide3image', 'slide3image');
}
if ($hasslide3caption) {
    $slide3caption = $PAGE->theme->settings->slide3caption;
}
if ($hasslide3url) {
    $slide3url = $PAGE->theme->settings->slide3url;
	$slide3target = $PAGE->theme->settings->slide3target;
}

/* Slide 4 settings */
if ($hasslide4) {
    $slide4 = $PAGE->theme->settings->slide4;
}
if ($hasslide4image) {
    $slide4image = $PAGE->theme->setting_file_url('slide4image', 'slide4image');
}
if ($hasslide4caption) {
    $slide4caption = $PAGE->theme->settings->slide4caption;
}
if ($hasslide4url) {
    $slide4url = $PAGE->theme->settings->slide4url;
	$slide4target = $PAGE->theme->settings->slide4target;
}

/* Slide 5 settings */
if ($hasslide5) {
    $slide5 = $PAGE->theme->settings->slide5;
}
if ($hasslide5image) {
    $slide5image = $PAGE->theme->setting_file_url('slide5image', 'slide5image');
}
if ($hasslide5caption) {
    $slide5caption = $PAGE->theme->settings->slide5caption;
}
if ($hasslide5url) {
    $slide5url = $PAGE->theme->settings->slide5url;
	$slide5target = $PAGE->theme->settings->slide5target;
}

if ($hasslideshow && !strpos($checkuseragent, 'MSIE 7')) { // Hide slideshow for IE7
?>
    <div id="da-slider" class="da-slider<?php echo $slideshowvariant.' '.$hideonphone; ?>" style="background-position: 8650% 0%;">

    <?php if ($hasslide1) { ?>
        <div class="da-slide">
            <h2><?php echo $slide1 ?></h2>
            <?php if ($hasslide1caption) { ?>
                <p><?php echo $slide1caption ?></p>
            <?php } ?>
            <?php if ($hasslide1url) { ?>
                <a href="<?php echo $slide1url ?>" target= "<?php echo $slide1target ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
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
                <a href="<?php echo $slide2url ?>" target= "<?php echo $slide2target ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
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
                <a href="<?php echo $slide3url ?>" target= "<?php echo $slide3target ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
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
                <a href="<?php echo $slide4url ?>" target= "<?php echo $slide4target ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide4image) { ?>
            <div class="da-img"><img src="<?php echo $slide4image ?>" alt="<?php echo $slide4 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>
	
    <?php if ($hasslide5) { ?>
        <div class="da-slide">
            <h2><?php echo $slide5 ?></h2>
            <?php if ($hasslide5caption) { ?>
                <p><?php echo $slide5caption ?></p>
            <?php } ?>
            <?php if ($hasslide5url) { ?>
                <a href="<?php echo $slide5url ?>" target= "<?php echo $slide5target ?>" class="da-link"><?php echo get_string('readmore','theme_essential')?></a>
            <?php } ?>
            <?php if ($hasslide5image) { ?>
            <div class="da-img"><img src="<?php echo $slide5image ?>" alt="<?php echo $slide5 ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>

        <nav class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>
        </nav>
        
    </div>
<?php } ?>