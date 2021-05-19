<?php
/**
 * Template Name: Full Width
 * Template Post Type: page, degree
 */
?>
<?php get_header(); the_post(); ?>
<div class = "serif-div">
<article class="<?php echo $post->post_status; ?> post-list-item">
	<?php the_content(); ?>
</article>
</div>

<?php get_footer(); ?>
