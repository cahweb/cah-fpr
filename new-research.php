<?php
/**
* Template Name: Migrate Research Page Template
*
* Description: A page template that provides a key component of WordPress as a CMS
* by meeting the need for a carefully crafted introductory page. The front page template
* in Twenty Twelve consists of a page content area for adding text, images, video --
* anything you'd like -- followed by front-page-only widgets in one or two columns.
*
*/
?>

<?php get_header();?>
<div class = "container">
			<?php
				// TO SHOW THE PAGE CONTENTS
                    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
                <body>
                    <?php the_content();?>
                </body>

<?php endwhile;wp_reset_query();?>
<div class = "row">
<div class="col-">
<h2><a href="/newsroom/publications/">Recent Faculty Publications</a></h2>
<?php
//print_cah_publications(0,1,0,6,36,3,0,false,false);
?>
<a class = "btn btn-info" href= "/newsroom/publications/" role ="button"></a>

</div>  <!-- col-md-6 -->
<div class = "col-" style= "background: black;">
    <h2>Featured Projects</h2>
                <a href="//chdr.cah.ucf.edu/spaceandspirituality/"><img src="//www.cah.ucf.edu/images/researchfeature/sss.jpg" width="385" height="188"></a><br><br>
             <a href="//riches.cah.ucf.edu/?page_id=1764"><img src="//www.cah.ucf.edu/images/researchfeature/richespodcast.jpg" width="385" height="188"></a><br><br>
             <a href="//writingandrhetoric.cah.ucf.edu/showcase.php"><img src="//www.cah.ucf.edu/images/researchfeature/knightswrite.jpg" width="385" height="188"></a><br><br>
             
           <a href="//brockdenbrown.cah.ucf.edu/"><img src="//www.cah.ucf.edu/images/researchfeature/brockdenbrown.jpg" width="385" height="188"></a>
</div>

</div>  <!-- row -->
</div>

<?php get_footer();?>