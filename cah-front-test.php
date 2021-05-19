<?php
/**
 * Template Name: MIGRATE Front Page Template
 *
 * I wish it was more explicit how this worked, other than "Name it front-page.php and it
 * will change the front page." Edit this to change the front page.
 *
 * @package cah-starter
 */
?>
<div id = "container" role = "main">
<?php get_header();?>

<div class = "container">
<?php 
the_content();
$content = get_the_content();
echo $content;
?>
</div>
<?php get_footer();?>
</div>