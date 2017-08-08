<?php
/*
Template Name: Index
*/
?>

<!-- Header -->
<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<h1><?php echo __(the_title(), 'wp_babobski')?></h1>
	<?php
		if ( $thumbnail_id = get_post_thumbnail_id() ) {
			if ( $image_src = wp_get_attachment_image_src( $thumbnail_id, 'normal-bg' ) )
				printf( '<img src="%s" />', $image_src[0] );
		}
	?>

	<!-- Sample Repeater from Advanced Custom Fields -->
	<?php if( have_rows('icon_repeater') ): ?>

	<ul class="slides">

	<?php while( have_rows('icon_repeater') ): the_row();

		// vars
		$image = get_sub_field('icon_image');
		$content = get_sub_field('icon_description');
		$link = get_sub_field('icon_url');

		?>

		<li class="slide">

			<?php if( $link ): ?>
				<a href="<?php echo $link; ?>">
			<?php endif; ?>

				<img src="<?php echo $image; ?>" />
				<?php echo $content; ?>

			<?php if( $link ): ?>
				</a>
			<?php endif; ?>


		</li>

	<?php endwhile; ?>

	</ul>

<?php endif; ?>

<!-- Search Form include -->
<?php BsWp::get_template_parts( array( '/searchform' ) ); ?>

<!-- Latest Posts -->
<div>
<?php
$args = array( 'numberposts' => 8, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date", 'suppress_filters'=>0);
$postslist = get_posts( $args );
if (count($postslist) % 2 == 0) {
echo '<ul id="latest_posts" class="even">';
} else {
echo '<ul id="latest_posts" class="odd">';
}

 foreach ($postslist as $post) :  setup_postdata($post); ?>
 <li class="" <?php
if ( $thumbnail_id = get_post_thumbnail_id() ) {
if ( $image_src = wp_get_attachment_image_src( $thumbnail_id, 'normal-bg' ) )
printf( ' style="background-image: url(%s);"', $image_src[0] );
}
?>
>
<div class="welcome__baseline hidden-xs hidden-sm"></div>
       <div class="post__content">
<h2 class="media-heading"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<p><?php the_content();?></p>
</div>

</li>
<?php endforeach; ?>
 </ul>
</div>


<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
