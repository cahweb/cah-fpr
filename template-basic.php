<?php
/**
 * Template Name: Basic
 * Template Post Type: degree
 */
?>
<?php get_header(); if(get_query_var('pagename')=='faculty-staff') ?>

<link rel="stylesheet" type="text/css" href="/wp-content/themes/cah-florida/library/css/bootstrap_fctable.css" media='all'>

<?php the_post(); ?>

<div class="container mb-5 mt-3 mt-lg-5" style="min-height:250px;">
<div class = "serif-div">
	<article class="<?php echo $post->post_status; ?> post-list-item">
		<?php if ( has_post_thumbnail() )
		
		the_post_thumbnail('medium', array( 'class' => 'rounded float-left mr-3' ));
		
		the_content();
		
		?>
	</article>

</div>
</div>
<?php get_footer(); 

if(get_query_var('pagename')=='newsroom')?>
<script>
$(document).ready(function(e) {
    $(".ucf-news-section").hide();
	$(".ucf-news-item-title").css("font-size","1.3em");
});

$(window).resize(function(){
     if($(window).width() <= 575){
	  $("div:contains('more stories')").removeClass( "text-right" );
    	}
	 else{
		$("div:contains('more stories')").removeClass( "text-right");
		}
});



</script>

<? if(get_query_var('pagename')=='faculty-staff')?>

<script type="text/javascript" src="/wp-content/themes/cah-florida/library/js/bootstrap_202.js"></script>


