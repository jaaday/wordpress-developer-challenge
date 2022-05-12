<?php

add_theme_support('post-thumbnails' );

function add_normalize_CSS() {
   wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
}
add_action('wp_enqueue_scripts', 'add_normalize_CSS');


function add_widget_support() {
               register_sidebar( array(
                               'name'          => 'Sidebar',
                               'id'            => 'sidebar',
                               'before_widget' => '<div>',
                               'after_widget'  => '</div>',
                               'before_title'  => '<h2>',
                               'after_title'   => '</h2>',
               ) );
}
add_action( 'widgets_init', 'add_widget_support' );



function add_Main_Nav() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'add_Main_Nav' );


function wpdocs_videosplay_init() {
    $labels = array(
        'name'                  => _x( 'Videos Play', 'Post type general name', 'Video Play' ),
        'singular_name'         => _x( 'Video Play', 'Post type singular name', 'Video Play' ),
        'menu_name'             => _x( 'Videos Play', 'Admin Menu text', 'Video Play' ),
        'name_admin_bar'        => _x( 'Video Play', 'Add New on Toolbar', 'Video Play' ),
        'add_new'               => __( 'Add New', 'Video Play' ),
        'add_new_item'          => __( 'Add New Video Play', 'Video Play' ),
        'new_item'              => __( 'New Video Play', 'Video Play' ),
        'edit_item'             => __( 'Edit Video Play', 'Video Play' ),
        'view_item'             => __( 'View Video Play', 'Video Play' ),
        'all_items'             => __( 'All Videos Play', 'Video Play' ),
        'search_items'          => __( 'Search Videos Play', 'Video Play' ),
        'parent_item_colon'     => __( 'Parent Videos Play:', 'Video Play' ),
        'not_found'             => __( 'No Videos Play found.', 'Video Play' ),
        'not_found_in_trash'    => __( 'No Videos Play found in Trash.', 'Video Play' ),
        'featured_image'        => _x( 'Video Play Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'Video Play' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'Video Play' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'Video Play' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'Video Play' ),
        'archives'              => _x( 'Video Play archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'Video Play' ),
        'insert_into_item'      => _x( 'Insert into Video Play', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'Video Play' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Video Play', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'Video Play' ),
        'filter_items_list'     => _x( 'Filter Videos Play list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'Video Play' ),
        'items_list_navigation' => _x( 'Videos Play list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'Video Play' ),
        'items_list'            => _x( 'Videos Play list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'Video Play' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Video Play custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'videos-play' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ),
        'taxonomies'         => array( 'series', 'documentarios', 'filmes' ),
        'show_in_rest'       => true
    );
      
    register_post_type( 'Video Play', $args );
}
add_action( 'init', 'wpdocs_videosplay_init' );

add_action("admin_init", "custom_metabox");

function custom_metabox() {
	add_meta_box("custom_metabox_01", "Tempo de Duração", "custom_metabox_tempo", "videoplay", "side", "low");
	add_meta_box("custom_metabox_02", "Sinopse ", "custom_metabox_sinopse", "videoplay", "side", "low");
	add_meta_box("custom_metabox_03", "Embed do Vídeo ", "custom_metabox_embed", "videoplay", "side", "low");
}

function custom_metabox_tempo(){
	global $post;
	
	$data = get_post_custom($post->ID);
	$val = isset($data['tempo-duracao']) ? esc_attr($data['tempo-duracao'][0]) : '0 min';
	
	echo '<input type="text" name="tempo-duracao" id="tempo-duracao" value="'.$val.'">';
}

function custom_metabox_sinopse(){
	global $post;
	
	$data = get_post_custom($post->ID);
	
	$val = isset($data['sinopse-video']) ? esc_attr($data['sinopse-video'][0]) : 'Em breve';
	echo '<input type="text" name="sinopse-video" id="sinopse-video" value="'.$val.'">';
}

function custom_metabox_embed(){
	global $post;
	
	$data = get_post_custom($post->ID);
	
	$val = isset($data['embed-video']) ? esc_attr($data['embed-video'][0]) : 'Código aqui';
	echo '<input type="text" name="embed-video" id="embed-video" placeholder="Código aqui" value="'.$val.'">';
}

function save_detail(){
	global $post;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
	
	update_post_meta(isset($post->ID) ? $post->ID : null, 'tempo-duracao', isset($_POST["tempo-duracao"]) ? $_POST["tempo-duracao"] : null);
	update_post_meta(isset($post->ID) ? $post->ID : null, 'sinopse-video', isset($_POST["sinopse-video"]) ? $_POST["sinopse-video"] : null);
	update_post_meta(isset($post->ID) ? $post->ID : null, 'embed-video',  isset($_POST["embed-video"]) ? $_POST["embed-video"] : null);

}
add_action("save_post", "save_detail");

function create_filmes_hierarchical_taxonomy() {
	global $labels;
	$labels = array(
		'name' => __( 'Filmes', 'taxonomy general name' ),
		'singular_name' => __( 'Filme', 'taxonomy singular name' ),
		'search_items' => __( 'Search Filmes' ),
		'all_items' => __( 'All Filmes' ),
		'parent_item' => __( 'Parent Filme' ),
		'parent_item_colon' => __( 'Parent Filme:' ),
		'edit_item' => __( 'Edit Filme' ),
		'update_item' => __( 'Update Filme' ),
		'add_new_item' => __( 'Add New Filme Categoria' ),
		'new_item_name' => __( 'New Filme Name Categoria' ),
		'menu_name' => __( 'Filmes' ),
	);
	
	register_taxonomy('filmes',array('videosplay'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'filmes' ),
	));

}
add_action( 'init', 'create_filmes_hierarchical_taxonomy', 0 );

function create_documentarios_hierarchical_taxonomy() {
	global $labels;
	$labels = array(
		'name' => __( 'Documentários', 'taxonomy general name' ),
		'singular_name' => __( 'Documentário', 'taxonomy singular name' ),
		'search_items' => __( 'Search Documentários' ),
		'all_items' => __( 'All Documentários' ),
		'parent_item' => __( 'Parent Documentário' ),
		'parent_item_colon' => __( 'Parent Documentário:' ),
		'edit_item' => __( 'Edit Documentário' ),
		'update_item' => __( 'Update Documentário' ),
		'add_new_item' => __( 'Add New Documentário Categoria' ),
		'new_item_name' => __( 'New Documentário Name Categoria' ),
		'menu_name' => __( 'Documentários' ),
	);
	
	register_taxonomy('documentarios',array('videosplay'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'documentarios' ),
	));

}
add_action( 'init', 'create_documentarios_hierarchical_taxonomy', 0 );


function create_series_hierarchical_taxonomy() {
	global $labels;
	$labels = array(
		'name' => __( 'Séries', 'taxonomy general name' ),
		'singular_name' => __( 'Série', 'taxonomy singular name' ),
		'search_items' => __( 'Search Séries' ),
		'all_items' => __( 'All Séries' ),
		'parent_item' => __( 'Parent Série' ),
		'parent_item_colon' => __( 'Parent Série:' ),
		'edit_item' => __( 'Edit Série' ),
		'update_item' => __( 'Update Série' ),
		'add_new_item' => __( 'Add New Série Categoria' ),
		'new_item_name' => __( 'New Série Name Categoria' ),
		'menu_name' => __( 'Séries' ),
	);
	
	register_taxonomy('series',array('videosplay'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'series' ),
	));

}
add_action( 'init', 'create_series_hierarchical_taxonomy', 0 );

function jm_custom_logo_setup() {
    $defaults = array(
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false, 
		'height'               => 33,
        'width'                => 104,
		'flex-height'          => false,
        'flex-width'           => false,
    );
 
    add_theme_support( 'custom-logo', $defaults );
}
 
add_action( 'after_setup_theme', 'jm_custom_logo_setup' );

function jm_custom_logo_output($html) {
    $html = str_replace('custom-logo-link', 'navbar-brand', $html);
    $html = str_replace('custom-logo', 'img-fluid', $html);
    return $html;
}
add_filter('get_custom_logo', 'jm_custom_logo_output', 10);

function thumbnail_bg () {
	global $post;
	$get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 1080, false, '' );
	echo 'style="background: url('.$get_post_thumbnail[0].' )" center center; background-size:cover;"';
}