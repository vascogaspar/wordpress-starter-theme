<!--

   _             _ _    _        __         _             _ _    _
  /_\  _ __  ___| (_)__| |___   / _|___    /_\  _ __  ___| (_)__| |___
 / _ \| '_ \/ -_) | / _` / _ \  > _|_ _|  / _ \| '_ \/ -_) | / _` / _ \
/_/ \_\ .__/\___|_|_\__,_\___/  \_____|  /_/ \_\ .__/\___|_|_\__,_\___/
      |_|                                      |_|

https://apelido-apelido.com
...........................

Coded by Vasco Gaspar: https://vasco.work
Designed by Rui Paz: http://rui.cool
    & Pedro Cardoso: http://pedrothe.ninja

-->
<!DOCTYPE html>
<html lang="en" class="<?php get_bloginfo('language'); ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php bloginfo( 'name' ); ?> - <?php wp_title(); ?>
  </title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="icon" href="<?php echo get_template_directory_uri()?>/assets/favicon.ico?v=2" />
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri()?>/assets/apple-icon-180x180.png">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri()?>/assets/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri()?>/assets/android-icon-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri()?>/assets/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri()?>/assets/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?php echo get_template_directory_uri()?>/assets/manifest.json">
  <meta name="msapplication-TileColor" content="#000000">
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri()?>/assets/mstile-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <?php wp_head(); ?>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body <?php body_class(); ?> >
  <div id="barba-wrapper">
    <div <?php body_class('barba-container'); ?> data-namespace="<?php echo get_page_template_slug( $post_id ); ?>">
