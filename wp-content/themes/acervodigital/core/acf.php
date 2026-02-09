<?php



//força posicionamento dos campos ACF no admin

function prefix_reset_metabox_positions(){

  delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_post' );

  delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_page' );

  delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_custom_post_type' );

}

add_action( 'admin_init', 'prefix_reset_metabox_positions' );



////////Habilita Opções Gerais ACF////////
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title' 	=> 'Configurações Gerais',
        'menu_title'	=> 'Opções Gerais',
        'menu_slug' 	=> 'conf-geral',
        'position' 		=> '3',
        'capability'	=> 'acf_options',
        'update_button' => __('Atualizar', 'acf'),
        //'redirect'		=> false
    ));

    // Para ativar o item "Página Inicial" em Opções Gerais basta descomentar o trecho abaixo  
    /*
    acf_add_options_sub_page(array(
        'page_title'    => 'Configurações da Página Inicial',
        'menu_title'    => 'Página Inicial',
        'parent_slug'   => 'conf-geral',
        'capability'    => 'acf_options',
        'update_button' => __('Atualizar', 'acf'),
		'updated_message' => __("Alerta da Página Inicial atualizado com sucesso", 'acf'),
    ));
    */
    // Para ativar o item "Informações Gerais" em Opções Gerais basta descomentar o trecho abaixo  
    /*
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Informações Gerais',
        'menu_title'	=> 'Informações',
        'parent_slug'	=> 'conf-geral',
		'capability'	=> 'acf_options',
    ));
    */
	
	acf_add_options_sub_page(array(
        'page_title' 	=> 'Configurações de tutoriais e suporte',
        'menu_title'	=> 'Inclusão de tutoriais',
        'parent_slug'	=> 'conf-geral',
		'capability'	=> 'acf_options',
        'update_button' => __('Atualizar', 'acf'),
		'updated_message' => __("Tutoriais atualizado com sucesso", 'acf'),
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Analytics',
        'menu_title'	=> 'Analytics',
        'parent_slug'	=> 'conf-geral',
        'capability'	=> 'acf_options',
		'post_id' 		=> 'conf-analytics',
        'update_button' => __('Atualizar', 'acf'),
		'updated_message' => __("Informações do Analytics atualizado com sucesso", 'acf'),
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Informações Rodapé',
        'menu_title'	=> 'Rodapé',
        'parent_slug'	=> 'conf-geral',
        'capability'	=> 'acf_options',
		'post_id' => 'conf-rodape',
        'update_button' => __('Atualizar', 'acf'),
		'updated_message' => __("Informações do Rodapé atualizado com sucesso", 'acf'),
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Placeholders',
        'menu_title'	=> 'Placeholders',
        'parent_slug'	=> 'conf-geral',
        'capability'	=> 'manage_categories',
		'post_id' => 'placeholders',
		'update_button' => __('Atualizar', 'acf'),
		'updated_message' => __("Imagens atualizadas com sucesso", 'acf'),
    ));

}





//Gera arquivo css com PHP e ACF

function generate_options_css() {
    $ss_dir = get_stylesheet_directory();
    ob_start(); // Capture all output into buffer
    require($ss_dir . '/assets/css/acf.css.php'); // Grab the custom-style.php file
    $css = ob_get_clean(); // Store output in a variable, then flush the buffer
    file_put_contents($ss_dir . '/assets/css/custom-styles-acf.css', $css, LOCK_EX); // Save it as a css file
}

add_action( 'wp_enqueue_scripts', 'generate_options_css', 20 ); //Parse the output and write the CSS file on post save


//Gera miniatura para PDF
function acf_change_icon_on_files ( $icon, $mime, $attachment_id ){ // Display thumbnail instead of document.png
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) === false && $mime === 'application/pdf' ){
        $get_image = wp_get_attachment_image_src ( $attachment_id, 'full' );
        
        if ( $get_image ) {
            $icon = $get_image[0];
        } 
    }

    return $icon;
}

add_filter( 'wp_mime_type_icon', 'acf_change_icon_on_files', 10, 3 );

//habilita revisoes para o acf
add_filter( 'rest_prepare_revision', function( $response, $post ) {
    $data = $response->get_data();
    $data['acf'] = get_fields( $post->ID );
    return rest_ensure_response( $data );
}, 10, 2 );

// limita quantidade de categorias na página inicial ACF
function my_category_validate_value($valid, $value, $field, $input) {
	if(!$valid) {
		return $valid;
	}
	if(sizeof($value) < 6) {
		$valid = '6 categorias são obrigatorias';
	}
	else if(sizeof($value) > 6) {
		$valid = 'somente 6 categorias são possíveis';
	}else {
		$valid = true;
	}
	return $valid;
}
add_filter('acf/validate_value/key=field_5f447be376c35', 'my_category_validate_value', 10, 4);