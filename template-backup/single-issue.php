<?php
/**
 * Template Name: Single Issue
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<style>
/* Declared the style in this page because I was unable to add a class to the existing header as it pulls from the parent theme Colleges-Theme.
	 I didn't put this in styles.css because I didn't want to apply this style to all the h1's in the site as we just wanted it on every single issue page.*/
h1{
	display:none;
}
</style>

<?php get_header();?>


<?php 

the_post(); ?>

<div class="container mb-5 mt-3 mt-lg-5" style="min-height:250px;">
<div class = "serif-div">
	
		
		<?php if ( has_post_thumbnail() ){
			//$meme = get_post_thumbnail_id();
			//echo $meme;
			$url = get_the_post_thumbnail_url($post,'medium');
			//echo $url;
			echo '<div class = "row"><div class = "col-2">';
		//the_post_thumbnail('medium', array( 'class' => 'rounded float-left mr-3' ));
		echo '<img src="'. $url .'" />';
		//the_post_thumbnail('medium');
		echo '</div><div class = "col">';
		
		}
		$issue = get_post_meta($post->ID, 'issue-num', true);
		$theme = get_post_meta($post->ID, 'theme', true);
		$pub = get_post_meta($post->ID, 'pub-date', true);
		$p = (int)$pub->format('m');
		$volume = get_post_meta($post->ID, 'vol-num', true);
		$vol = numberToRomanRepresentation($volume);
		$cover_date = get_post_meta($post->ID, 'cov-date', true);

		$meta_value = "$volume.$issue";
		
		echo '<h2 class = \'h1 font-condensed text-complementary\'>Volume '.$volume. ', Issue '. $issue. '</h1>';
		if(isset($theme))
			echo '<h2 class = \'h2 mb-2\'>'.$theme.'</h2>';
		if(isset($cover_date))
			echo '<h2 class = \'h2 mb-2\'>'.$cover_date.'</h2>';
		echo the_content();
		?>
		
		<h4 class = "mb-4">Articles</h4>
		<?php
				
        if(isset($_GET['posts'])) {
					if(is_numeric($_GET['posts'])) {
						$posts = stripslashes(htmlspecialchars($_GET['posts']));   
					}
				}
                               $args = array(
								'post_type' => array('article'),
								'orderby' => 'meta_value_num',
								'meta_key' => 'article-page-start',              
								'order' => 'asc',
								'meta_query' => array(
									array(
										'field' => 'issue-num',
										'value' => $meta_value,
										
									),
								),
								);
								
                               $category_posts = new WP_Query($args);

							   if($category_posts->have_posts()) : 
								echo '<ul style="list-style-type: none;">';
                                  while($category_posts->have_posts()) : 
                                    
                                    $category_posts->the_post();
									$custom = get_post_custom(get_the_ID());
									//$pub = date($custom["pub-date"][0]);
									//$pub = maybe_unserialize( $custom['pub-date'][0] );
									$pub = $custom['pub-date'][0];							
									$pageNum = $custom["start"][0];
									//$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )["0"];
									$test = 15;
									$title = get_the_title();
									//var_dump($title);
									//$title = str_pad($title, 120, "-");
							?>
							
								
									<li><a href = "<?php the_permalink();?>"><?php echo "<b>" . $pageNum . "</b>". "								" . $title;?></a>
						

								
								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); 
									
									if (isset($url)){
									//echo '</div>';
									}
									
									?>
								</footer>

							</article>

							<?php endwhile;  
								
								echo "</ul>";

								else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Articles Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
		</div>
</div>

<?php get_footer(); 



