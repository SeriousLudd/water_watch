<?php

// ACTIVATION DU THEME ENFANT
function theme_enqueue_styles() {
 wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


// AJOUT DES ICONES FONT AWESOME
function dc_load_fontawesome() {
  wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', null, '4.7.0' );
}
add_action('wp_enqueue_scripts', 'dc_load_fontawesome');


// AJOUT DE LA CARTE INTERACTIVE DU PROJET WATER WATCH
function cc_scripts() {
  if (is_page (2027)) { 
  
  wp_enqueue_style( 'leaflet-style', '/wp-content/themes/child/interactiveMap/leaflet/leaflet.css');
  wp_enqueue_script('leaflet-js', '/wp-content/themes/child/interactiveMap/leaflet/leaflet.js', array('jquery'), '1.0', true );
  wp_enqueue_style('full_screen_leaflet_styles', 'https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css');
  wp_enqueue_script('full_screen_leaflet', 'https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js', array('wp_leaflet_map'), '1.1', true);
  wp_enqueue_script('interactiveMap.js', '/wp-content/themes/child/interactiveMap/js/interactiveMap.js', array('jquery'), '', true);
  }
}
  add_action( 'wp_enqueue_scripts', 'cc_scripts' );

// STYLE PAGE INTERACTIVE WATER WATCH 
function wpse_enqueue_page_template_styles() {
  if ( is_page_template( 'PageInteractiveMap.php' ) ) {
      wp_enqueue_style( 'page-template', get_stylesheet_directory_uri() . '/interactiveMap/css/interactiveMap.css', null, '1.34' );
      
  }
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_page_template_styles' );

