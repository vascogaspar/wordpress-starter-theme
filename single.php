<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 3.3.6
 * @autor 		http://gaspardbruno.com/
 */
?>
<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>



<div class="container-fluid post-container">
	<div class="row">
	  <div class="col-md-8 col-md-offset-2">
	    <h1 class="pagetitle"><?php the_title(); ?></h1>

	    <div class="post-content">
	     <?php the_content(); ?>
	    </div>

	  </div>
	</div>

<div class="related-posts">
    <h3 class="related-title">Related posts</h3>
    <div class="row">
    <?php
        $orig_post = $post;
        global $post;
        $tags = wp_get_post_tags($post->ID);

        if ($tags) {
            $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
            $args=array(
                'tag__in' => $tag_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=>4, // Number of related posts to display.
                'caller_get_posts'=>1
            );

        $my_query = new wp_query( $args );

        while( $my_query->have_posts() ) {
            $my_query->the_post();
        ?>

        <div class="col-md-3 related-post">
            <a rel="external" href="<? the_permalink()?>">
            <span class="related-thumbnail" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></span>
            <?php the_title(); ?>
            </a>
        </div>

        <?php }
        }
        $post = $orig_post;
        wp_reset_query();
        ?>
        </div>
    </div>
	</div>


<?php endwhile;
wp_reset_query(); ?>


<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
