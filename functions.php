<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package 	WordPress
	 * @subpackage 	Bootstrap 3.3.7
	 * @autor 		Babobski
	 */


    /* ========================================================================================================================

	Add language support to theme

	======================================================================================================================== */
	add_action('after_setup_theme', 'my_theme_setup');
	function my_theme_setup(){
		load_theme_textdomain('wp_babobski', get_template_directory() . '/language');
	}

	add_filter( 'single_template', function ($single_template) {

     global $post;

    if ( in_category( 'Recipe' ) ) {
          $single_template = dirname( __FILE__ ) . '/single-recipe.php';
     }

     if ( in_category( 'Rezepte' ) ) {
          $single_template = dirname( __FILE__ ) . '/single-recipe.php';
     }
     return $single_template;

}, 10, 3 );



	/* ========================================================================================================================

	======================================================================================================================== */

	require_once( 'external/bootstrap-utilities.php' );
	require_once( 'external/wp_bootstrap_navwalker.php' );

	/* ========================================================================================================================

	Add html 5 support to wordpress elements

	===============================
	Required external files
	========================================================================================= */
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

	/* ========================================================================================================================

	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme

	======================================================================================================================== */

	add_theme_support('post-thumbnails');

	register_nav_menus(array('primary' => 'Primary'));

	/* ========================================================================================================================

	Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );

	add_filter( 'body_class', array( 'BsWp', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================

	Custom Post Types - include custom post types and taxonomies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

	======================================================================================================================== */

	/* ========================================================================================================================

	Widgets

	======================================================================================================================== */

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Pinterest', 'pinterest' ),
        'id' => 'pinterest',
        'description' => __( 'Widgets in this area will be shown on the home page.', 'pinterest' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'Instagram', 'instagram' ),
        'id' => 'instagram',
        'description' => __( 'Widgets in this area will be shown on the home page.', 'instagram' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}

	/* ========================================================================================================================

	Scripts

	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function bootstrap_script_init() {

		wp_register_script('bootstrap', get_template_directory_uri(). '/vendor/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true);
		wp_enqueue_script('bootstrap');

    $version = '3.1';

    wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/css/style.css?v=' . $version , false);
    wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/js/main.js?v=' . $version, array(), false, true);
		wp_enqueue_style( 'screen' );
	}

	/* ========================================================================================================================

	Security & cleanup wp admin

	======================================================================================================================== */

	//remove wp version
	function theme_remove_version() {
	return '';
	}

	add_filter('the_generator', 'theme_remove_version');

	//remove default footer text
	function remove_footer_admin () {
        echo "";
    }

    add_filter('admin_footer_text', 'remove_footer_admin');

	//remove wordpress logo from adminbar
	function wp_logo_admin_bar_remove() {
        global $wp_admin_bar;

        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
	}

	add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);


	/* ========================================================================================================================

	Comments

	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function bootstrap_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li class="media">
			<div class="media-left">
				<?php echo get_avatar( $comment ); ?>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</div>
		<?php endif;
	}


  function wpb_list_child_pages() {

    global $post;

    if ( is_page() && $post->post_parent )
      $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
    else
      $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
    if ( $childpages ) {
      $string = '<ul>' . $childpages . '</ul>';
    }
    return $string;
  }

  add_shortcode('wpb_childpages', 'wpb_list_child_pages');

  function next_page_ID($id) {
    // Get all pages under this section
    $post = get_post($id);
    $post_parent = $post->post_parent;
    $get_pages_query = 'child_of=' . $post_parent . '&parent=' . $post_parent . '&sort_column=menu_order&sort_order=asc';
	$get_pages = get_pages($get_pages_query);
	$next_page_id = '';
    // Count results
	$page_count = count($get_pages);

	for ($p=0; $p < $page_count; $p++) {
	  	// Get the array key for our entry
		if ($id == $get_pages[$p]->ID) break;
	}

	// Assign our next key
	$next_key = $p+1;

	// If there isn't a value assigned for the previous key, go all the way to the end
	if (isset($get_pages[$next_key])) {
		$next_page_id = $get_pages[$next_key]->ID;
	}
	return $next_page_id;
}
/* =============================================================
    PREVIOUS PAGE ID
    A function to get the previous page's ID.
    $id = ID of the page you want to find the previous page for.
 * ============================================================= */
function previous_page_ID($id) {
    // Get all pages under this section
    $post = get_post($id);
    $post_parent = $post->post_parent;
    $get_pages_query = 'child_of=' . $post_parent . '&parent=' . $post_parent . '&sort_column=menu_order&sort_order=asc';
	$get_pages = get_pages($get_pages_query);
	$prev_page_id = '';
	// Count results
	$page_count = count($get_pages);

	for($p=0; $p < $page_count; $p++) {
	  // get the array key for our entry
		if ($id == $get_pages[$p]->ID) break;
	}

	// assign our next & previous keys
	$prev_key = $p-1;
	$last_key = $page_count-1;

	// if there isn't a value assigned for the previous key, go all the way to the end
	if (isset($get_pages[$prev_key])) {
		$prev_page_id = $get_pages[$prev_key]->ID;
	}
  	return $prev_page_id;
}

function siblings($link) {
    global $post;

    if ($post->post_parent)	{
      $ancestors=get_post_ancestors($post->ID);
      $root=count($ancestors)-1;
      $parent = $ancestors[$root];
    } else {
      $parent = $post->ID;
    }

    $siblings = get_pages('child_of=14&parent=14&depth=0');
    foreach ($siblings as $key=>$sibling){
        if ($post->ID == $sibling->ID){
            $ID = $key;
        }
    }
    $closest = array('before'=>get_permalink($siblings[$ID-1]->ID),'after'=>get_permalink($siblings[$ID+1]->ID));

    if ($link == 'before' || $link == 'after') { echo $closest[$link]; } else { return $closest; }
}


function list_child_pages() {
    global $post;
    $child_pages_query_args = array(
        'post_type'   => 'page',
        'child_of' => $post->ID,
        'orderby'     => 'date DESC'
    );

    $child_pages = get_pages( $child_pages_query_args );

    if ( $child_pages) :
        ?>
        <nav class="collection__nav">
          <ul>
          <?php
          $parent_page = get_page($post->ID);

          foreach($child_pages as $page) {
              list_page($page);
          }
          ?>
          </ul>
        </nav>

        <?php
    endif;
    wp_reset_postdata();

}

function list_page($page) {
    ?>
    <li class="page_item">
      <a href="<?php echo get_permalink($page->ID); ?>">

        <div class="" style="background-image: url(<?php echo get_the_post_thumbnail_url($page->ID, 'large');?>)">
          <?php echo get_the_title($page->ID); ?>
        </div>

    </a></li>
   <?php
}

add_shortcode('show_child_pages_custom', 'my_function');

// Woocommerce
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function textdomain_register_sidebars() {

    /* Register the primary sidebar. */
    register_sidebar(
        array(
            'id' => 'sidebar-1',
            'name' => __( 'Shop Top Bar', 'sara_maia' ),
            'description' => __( 'A short description of the sidebar.', 'sara_maia' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );

    /* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'textdomain_register_sidebars' );

add_action( 'widgets_init', 'below_post_sidebar' );

function below_post_sidebar() {

    register_sidebar(
        array(
            'id' => 'below-post',
            'name' => __( 'Below Post' ),
            'description' => __( 'Content that will go below post pages.' ),
                        'class' => 'widget-class',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );
}
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-slider' );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}
