<?php
/*
Template Name: Home
*/
?>

<!-- Header -->
<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
    <!-- CONTENT -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Home Template</h1>
      </div>
  	</div>
  </div>

<script type="text/javascript">
  var $ = jQuery.noConflict();
  // This way you can use the '$' as jquery
  console.log('Check home.php to know how to write jQuey on php templates', $('body'));
</script>

<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
