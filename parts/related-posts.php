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
