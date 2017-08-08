<?php
/**
* The template for displaying all pages.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
*
* @package 	WordPress
* @subpackage 	Bootstrap 3.3.6
* @autor 		Babobski
*/
?>


<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<div class="container post-container mod-static">
  <div class="row">
    <div class="col-md-12">
      <div class="post-content">
        <h1 class="pagetitle"><?php the_title(); ?></h1>
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
