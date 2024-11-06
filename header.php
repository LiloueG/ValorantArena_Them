<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="wrap">
      <header>
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_valorantarena_header.svg" alt="Valorant Arena Logo" class="logo">
        <nav class="principal">
          <?php 
            wp_nav_menu ( array (
             'theme_location' => 'primary'
             ) ); ?>
        </nav>
      </header>
      <?php wp_footer(); ?>
    </div>
  </body>
</html>