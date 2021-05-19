<?php
/**
 * Template Name: Single Article
 */

get_header();

the_post();

?>

<div class="container mb-5 mt-3 mt-lg-5" style="min-height: 250px">
    <article class="<?= $post->post_status ?> post-list-item">
        <?php
            if( has_post_thumbnail() ) {
                the_post_thumbnail( 'medium', array( 'class' => 'rounded float-left mr-3' ) );
            }

            echo "<p class=\"mb-4\"><button type=\"button\" class=\"btn btn-default btn-sm article-pdf\">" . do_shortcode( "[pdf_attachment file=\"1\" name=\"Download Article PDF\"]" ) . "</button></p>";

            the_content();
        ?>
    </article>
</div>

<script>
document.querySelector('div.container > div.mb-4.mb-md-5').remove();
</script>

<?php

get_footer();

?>