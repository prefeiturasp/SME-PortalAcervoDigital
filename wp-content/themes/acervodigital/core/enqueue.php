<?php
////////////////////////////////////////////////
//////////CSS and JS for WP admin///////////////
////////////////////////////////////////////////
function rhs_load_admin(){
	wp_enqueue_style( 'style_admin', get_template_directory_uri() . '/assets/css/style-admin.css', array() );
	if ( current_user_can( 'contributor' ) ) {
		wp_enqueue_style( 'login-contributor-style', get_template_directory_uri() . '/assets/css/contributor-style.css', array() );
	}
	wp_enqueue_script( 'script_admin', get_template_directory_uri().'/assets/js/script-admin.js', array( 'jquery' ), 2, true );
	//wp_enqueue_style( 'bootstrap_style_admin', get_template_directory_uri().'/assets/css/bootstrap.min.css', array() );
}
add_action( 'admin_enqueue_scripts', 'rhs_load_admin' );


////////////////////////////////////////////////
//////////////////////CSS///////////////////////
////////////////////////////////////////////////
function rhs_load_css(){
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.min.css', array() );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/assets/css/fontawesome.css', array());
	wp_enqueue_style( 'style_theme', get_template_directory_uri().'/assets/css/style.css', array() );
	wp_enqueue_style( 'style_construtor', get_template_directory_uri().'/assets/css/construtor.css', array() );
	wp_enqueue_style( 'style_acf_theme', get_template_directory_uri().'/assets/css/custom-styles-acf.css', array() );//custom css ACF
	wp_enqueue_style('font_awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action( 'wp_enqueue_scripts', 'rhs_load_css' );


////////////////////////////////////////////////
//////////////////////CDN///////////////////////
////////////////////////////////////////////////
function rhs_load_cdn(){
	wp_enqueue_style( 'bootstrap-select-css', 'https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css', array() );
}
add_action( 'wp_enqueue_scripts', 'rhs_load_cdn' );



////////////////////////////////////////////////
/////////////////CSS for PAGE///////////////////
////////////////////////////////////////////////
function acervo_css_for_page(){
	if(is_front_page()){//verifica se é a página inicial
		wp_enqueue_style( 'style_front_page', get_template_directory_uri().'/assets/css/front-page.css', array() );
	}
}
add_action( 'wp_enqueue_scripts', 'acervo_css_for_page' );


////////////////////////////////////////////////
/////////////////CSS ID PAGE////////////////////
////////////////////////////////////////////////
/*function acervo_css_id_page(){
	if(is_page(5)){//verifica o id da página
		wp_enqueue_style( 'style_front_page', get_template_directory_uri().'/assets/css/front-page.css', array() );
	}
}
add_action( 'wp_enqueue_scripts', 'acervo_css_id_page' );*/


////////////////////////////////////////////////
//////////////////////JS////////////////////////
////////////////////////////////////////////////
function rhs_load_js(){
	wp_enqueue_script( 'bootstrap-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), 1, true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), 1, true );
	wp_enqueue_script( 'bootstrap-select-js', get_template_directory_uri().'/assets/js/bootstrap-select.min.js', array('jquery'), 1, true );
	wp_enqueue_script( 'bootstrap-select-br', get_template_directory_uri().'/assets/js/defaults-pt_BR.js', array('jquery'), 1, true );
	wp_enqueue_script( 'js_theme', get_template_directory_uri().'/assets/js/script.js', array( 'jquery' ), 2, true );
}
add_action( 'wp_enqueue_scripts', 'rhs_load_js' );