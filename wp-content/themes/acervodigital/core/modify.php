<?php
//habilita suporte a miniatura e logo
function acervo_settings_theme(){
	add_theme_support( 'post-thumbnails' ); 	
  	add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'acervo_settings_theme' );


//Remover versão do WordPress do rodapé
function change_footer_version() {
  return 'ACERVO DIGITAL SME';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );

//Mudar o texto de rodapé no painel de admin
function remove_footer_admin () {
  echo 'Visite: <a href="https://educacao.sme.prefeitura.sp.gov.br/"> Portal SME</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

//Remover ajuda no admin
function hide_help() {
    echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
          </style>';
}
add_action('admin_head', 'hide_help');

//Remove logo com links do wordpress
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
}

//remove editor Gutenberg
add_filter('use_block_editor_for_post', '__return_false', 10);

// Desabilita o box "Bem-vindo ao WordPress!" no painel administrativo
remove_action('welcome_panel', 'wp_welcome_panel');

// Desabilita os boxes do painel administrativo
function remove_wordpress_dashboard() {

    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');	// Agora
    //remove_meta_box('dashboard_activity', 'dashboard', 'normal');	// Atividade
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');	// Rascunho rápido
    remove_meta_box('dashboard_primary', 'dashboard', 'side');		// Novidades do WordPress

}

add_action('admin_init', 'remove_wordpress_dashboard');

// Altera o termo Post para Noticia no WordPress
function erikasarti_post_para_noticia_menu() {

    // altera as labels do menu do painel administrativo
	global $menu;
	global $submenu;
	$menu[5][0] = 'Not&iacute;cias';
	$submenu['edit.php'][5][0] = 'Not&iacute;cias';
	$submenu['edit.php'][10][0] = 'Adicionar not&iacute;cia';
	echo '';
}

add_action( 'admin_menu', 'erikasarti_post_para_noticia_menu' );

function erikasarti_post_para_noticia_painel() {

    // altera as strings no painel administrativo e na barra de ferramentas
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Not&iacute;cias';
 	$labels->singular_name = 'Not&iacute;cia';
	$labels->add_new = 'Nova not&iacute;cia';
	$labels->add_new_item = 'Adicionar nova not&iacute;cia';
	$labels->edit_item = 'Editar not&iacute;cia';
	$labels->new_item = 'Not&iacute;cia';
	$labels->view_item = 'Ver not&iacute;cia';
	$labels->search_items = 'Pesquisar nas not&iacute;cias';
	$labels->not_found = 'Nenhuma not&iacute;cia encontrada';
	$labels->not_found_in_trash = 'Nenhuma not&iacute;cia encontrada na Lixeira';
	$labels->all_items = 'Todas as not&iacute;cias';
	$labels->menu_name = 'Not&iacute;cias';
	$labels->name_admin_bar = 'Not&iacute;cia';
}

add_action( 'init', 'erikasarti_post_para_noticia_painel' );

//adiciona logo no admin bar
function wp_admin_bar_new_logo() {
global $wp_admin_bar;
	$wp_admin_bar->add_menu(array(
		'id' => 'wp-admin-bar-new-logo',
		'title' => '<img class="logo-new-admin-bar" src="'.get_bloginfo('template_directory').'/images/logo-admin.png">'
	));
}
add_action('admin_bar_menu', 'wp_admin_bar_new_logo',10);

//adiciona logo no wp-login
function my_login_logo() { ?>
<style type="text/css">
#login h1 a, .login h1 a {
background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo_login.png);
background-repeat: no-repeat;
	height: 125px;
	background-size: 100%;
	width: 100%;
}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//função muda URL do logo em wp-login
function my_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
return 'Acervo Digital';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//remover opções de cores do perfil de usuários
function admin_color_scheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'admin_color_scheme');

//remove avisos de atualizações do wordpress, temas e plugins
add_filter( 'pre_site_transient_update_core','remove_core_updates' );
add_filter( 'pre_site_transient_update_plugins','remove_core_updates' );
add_filter( 'pre_site_transient_update_themes','remove_core_updates' );

function remove_core_updates(){
    global $wp_version;
    return(object) array(
        'last_checked' => time(),
        'version_checked' => $wp_version
    );
}

//remove menus do admin wordpress
function wpdocs_remove_menus(){
   
  //remove_menu_page( 'index.php' );                  //Dashboard
  //remove_menu_page( 'jetpack' );                    //Jetpack* 
  remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings
   
}
add_action( 'admin_menu', 'wpdocs_remove_menus' );


//remove menus do admin wordpress
function editor_remove_menus(){
   
   if(current_user_can('editor')){
   	  //remove_menu_page( 'index.php' );                  //Dashboard
	  remove_menu_page( 'jetpack' );                    //Jetpack* 
	  remove_menu_page( 'edit.php' );                   //Posts
	  //remove_menu_page( 'upload.php' );                 //Media
	  remove_menu_page( 'edit.php?post_type=page' );    //Pages
	  remove_menu_page( 'edit-comments.php' );          //Comments
	  remove_menu_page( 'themes.php' );                 //Appearance
	  remove_menu_page( 'plugins.php' );                //Plugins
	  remove_menu_page( 'users.php' );                  //Users
	  remove_menu_page( 'tools.php' );                  //Tools
	  remove_menu_page( 'options-general.php' );        //Settings
   } 
}
add_action( 'admin_menu', 'editor_remove_menus' );
