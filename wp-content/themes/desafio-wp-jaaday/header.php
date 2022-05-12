<?php
/*
Theme Name: Desafio WP Jaaday
Theme URI: https://github.com/Buildbox-ItSolutions/wordpress-developer-challenge
Author: Jaaday Melkran
Author URI: https://github.com/jaaday
Description: Tema criado para o WordPress Developer Challenge
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: black, brown, orange, tan, white, yellow, light, one-column, two-columns, right-sidebar, flexible-width, custom-header, custom-menu, editor-style, featured-images, microformats, post-formats, rtl-language-support, sticky-post, translation-ready
Text Domain: desafiowpjaaday

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>
 <head>
   <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
   <meta charset="<?php bloginfo( 'charset' ); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="//db.onlinewebfonts.com/c/1bc2daddba36ba331fc4fa67828eabdc?family=Circular+Spotify+Tx+T+Med" rel="stylesheet" type="text/css"/>
   <link href="//db.onlinewebfonts.com/c/01173b246d9d9ea808ea75a26b3b61bb?family=Circular+Spotify+Tx+T+Black" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
   <?php wp_head(); ?>
 </head>
 <body <?php body_class(); ?>>
   <header class="my-header sticky">
	<nav class="navbar navbar-collapse collapse">
		<?php
			if (has_custom_logo()):
				the_custom_logo();
			endif;		
		?>
		<?php wp_nav_menu( array( 'header-menu' => 'header-menu' ) ); ?>
	</nav>
 </header>
