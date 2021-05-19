<?php
/**
* Template Name: Issue Index
*
* Description: A template to display all the issues on FPR
*
*/
?>
<style>
h1{
	display:none;
}
</style>


<?php get_header();?>
    <div class = "container my-5">
		<div class = "serif-div">
        <body>
        <?php
            the_post();
			//$content = get_the_content();
			the_content();
			//the_content();
            //the_content();
			echo '<div class = "container mb-2><p>' . $content . '</p></div>';
		?>
		<hr class = "my-4" style = "clear:both;">
		<h2 class = "my-4">Previous Issues</h2>
		<?php
            $query = new WP_Query(array(
					'post_type' => 'issue',
					'meta_key'   => 'vol-num',
					'orderby'    => 'meta_value_num',
                    'post_status' => 'publish',
                    'order' => 'desc',
                    'posts_per_page' => -1
                    ));
            $issues_per_row = 3;
            $count = 0;
            // Array to hold the issue objects so we can sort them by pub_date. I tried doing this
            // with a meta_query array but couldn't get it to work properly. No idea why.
            $issues_array = array();

            // Instead of the standard query Loop, I'm instead loading it into an array, and passing
			// it to the $issues_array that I created.
			while ($query->have_posts()) {
				$query->the_post();
				$id = get_the_id();
				$title = get_the_title();
				$thumbnail = get_the_post_thumbnail_url($id);
				$vol_num = get_post_meta($id,"vol-num",true);
				$issue_num = get_post_meta($id,"issue-num",true);
				$cov_date = get_post_meta($id,"cov-date",true);
				$permalink = get_the_permalink();

				$pub_date = get_post_meta( $id, 'pub-date', true );
				if( !isset( $pub_date ) || empty( $pub_date ) ) {
					$meta = maybe_unserialize( get_post_meta( $id, 'issue-meta', true ) );

					$pub_date = $meta['pub-date'];
				}

                $p = (int)$pub_date->format('m');
                
				
				if(empty($thumbnail)){
					$thumbnail = get_stylesheet_directory_uri() . "/public/images/emptyIssue.png";
				}

				$new_array = array(
					'title' => $title,
					'thumbnail' => $thumbnail,
					'vol_num' => $vol_num,
					'issue_num' => $issue_num,
					'cov_date' => $cov_date,
					'permalink' => $permalink,
					'pub_date' => maybe_unserialize( $pub_date ), // WordPress automatically serializes objects, but doesn't unserialize them when you call get_post_meta() for some reason. >_<
					'vol' => "Vol. " . numberToRomanRepresentation($vol_num)
				);

				$issues_array[$id] = $new_array;
            }// End while
            wp_reset_postdata();

            // Sort the array by UNIX timestamp. I use $b first because I want them sorted in reverse-chronological order.
			uasort( $issues_array, function( $a, $b ) {
				return date_timestamp_get( $b['pub_date'] ) - date_timestamp_get( $a['pub_date'] );
            });
            
            foreach( $issues_array as $issue ) {
				$cov_date = ( !empty( $issue['cov_date'] ) ) ? ' | ' . $issue['cov_date'] : ' | ' . date_format( $issue['pub_date'], 'F Y' );
				if($count % $issues_per_row == 0)
					echo "<div class=\"issue-display\">";
		        ?>
				
					<!--<div class="issue-container" onclick="location.href='<?//=$issue['permalink']?>'">-->
                    <a href = "<?php echo $issue['permalink'];?>">
						<div class="issue-front">
                            <ul><?/*
                            if($p < 6){
                                echo "Spring Issue ". $pub_date->format('Y') . ' &bull; ';
                            }
                            else{
                                echo "Winter Issue ". $pub_date->format('Y') . ' &bull; ';
							}
							echo $issue['vol'] . ", Issue ".$issue['issue_num'];*/?>
							</ul>
							<!--<ul>--><?
							if(!empty($issue['cov_date'])&&!empty($issue['vol_num'])&&!empty($issue['issue_num']))
							echo '<ul>'.$issue['cov_date'] . ' &bull; Volume '.$issue['vol_num'] . ", Issue ".$issue['issue_num'].'</ul>';?>
							<!--</ul>-->
						</div>
					<!--</div>-->
                    </a>

		<?php
				if($count % $issues_per_row == ($issues_per_row-1))
					echo "</div>";
				$count++;
			} // End foreach

        ?>
		</body>
		</div>
    </div>
<?php get_footer();?>