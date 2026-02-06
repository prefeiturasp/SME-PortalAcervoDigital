<?php
//adicionar novo item na barra superior do admin para suporte a cliente
function wp_admin_bar_new_item() {
$site_cliente = get_option( 'siteurl' );	
global $wp_admin_bar;
	$wp_admin_bar->add_menu(array(
		'id' => 'wp-admin-bar-new-item-1',
		'title' => '<span class="ab-icon dashicons dashicons-editor-help"></span>' . __('Tutoriais'),
		'href' => 'https://hom-portal.sme.prefeitura.sp.gov.br/acervodigital/wp-admin/admin.php?page=tutorial_slug'
		//'meta' => array('target' => '_blank',)
	));
}
add_action('wp_before_admin_bar_render', 'wp_admin_bar_new_item');


// Habilitar página de manutenção
function wp_maintenance_mode() {
$field = get_field('ativar_manutencao','option');
$value = $field['value'];
	
	if (!is_user_logged_in() && $value == 'sim') {
		wp_die('<img style="display: block; margin: auto;" src="'.get_bloginfo('template_directory').'/images/logo_login.png"><h1 style="text-align: center;">Site em manutenção</h1><br /><p style="text-align: center;">Estamos realizando algumas atualizações.</p><p style="text-align: center;">Por favor volte mais tarde.</p>','Manutenção Acervo Digital');
	}
}
add_action('get_header', 'wp_maintenance_mode');

// Registra menu
function wp_custom_menu() {
  register_nav_menu('menu-principal',__( 'Menu Principal' ));
}
add_action( 'init', 'wp_custom_menu' );