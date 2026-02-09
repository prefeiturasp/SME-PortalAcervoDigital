<?php
//Default

//require_once 'core/index.php';

//Enqueues
require_once 'core/enqueue.php';

//Classes
require_once 'core/classes/ctp.php';
require_once 'core/classes/taxonomia.php';
require_once 'core/classes/tag.php';

//Modify Wordpress
require_once 'core/modify.php';

//Client suport
require_once 'core/suport.php';

//ACF
require_once 'core/acf.php';

//Users
require_once 'core/users/user.php';

//Notices admin
require_once 'core/notices.php';

//tutorial
require_once 'core/tutorial.php';

//metricas
require_once 'core/metricas.php';

// Excel Export
require_once 'core/SimpleXLSXGen.php';


/*//Count access acervo

function gt_get_post_view() {

    $count = get_post_meta( get_the_ID(), 'post_views_count', true );

    return $count;

}

function gt_set_post_view() {

    $key = 'post_views_count';

    $post_id = get_the_ID();

    $count = (int) get_post_meta( $post_id, $key, true );

    $count++;

    update_post_meta( $post_id, $key, $count );

}

function gt_posts_column_views( $columns ) {

    $columns['post_views'] = 'Visualizações';

    return $columns;

}

function gt_posts_custom_column_views( $column ) {

    if ( $column === 'post_views') {

        echo gt_get_post_view();

    }

}

add_filter( 'manage_posts_columns', 'gt_posts_column_views' );

add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );





//Count download Acervo

function update_counter_ajax() {

$postID = trim($_POST['post_id']);

$count_key = 'download';

$counter = get_post_meta($postID, $count_key, true);

    if($counter==''){

        $count = 1;

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '1');

    }else{

        $counter++;

        update_post_meta($postID, $count_key, $counter);

    }

wp_die();

}

function gt_get_downloads_view() {

    $count = get_post_meta( get_the_ID(), 'download', true );

    return $count;

}

function gt_downloads_column_views( $columns ) {

    $columns['download'] = 'Downloads';

    return $columns;

}

function gt_downloads_custom_column_views( $column ) {

    if ( $column === 'download') {

        echo gt_get_downloads_view();

    }

}

add_action('wp_ajax_update_counter', 'update_counter_ajax');

add_action('wp_ajax_nopriv_update_counter', 'update_counter_ajax');

add_filter( 'manage_posts_columns', 'gt_downloads_column_views' );

add_action( 'manage_posts_custom_column', 'gt_downloads_custom_column_views' );*/





//pega ip do visitante
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
get_client_ip();




//Remove hierarquia Taxonomia Palavra Chave

function wpse_58799_remove_parent_category()

{

    if ( 'palavra' != $_GET['taxonomy'] )

        return;



    $parent = 'parent()';



    if ( isset( $_GET['action'] ) )

        $parent = 'parent().parent()';



    ?>

        <script type="text/javascript">

            jQuery(document).ready(function($)

            {     

                $('label[for=parent]').<?php echo $parent; ?>.remove();       

            });

        </script>

    <?php

}

add_action( 'admin_head-edit-tags.php', 'wpse_58799_remove_parent_category' );



/*

//adiciona ACF na busca do wordpress
function my_pre_get_posts( $query ) {
	// do not modify queries in the admin
	if( is_admin() ) {
		return $query;
	}
	// only modify queries for 'event' post type
	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'acervo' ) {
		// allow the url to alter the query
		if( isset($_GET['ano_da_publicacao_acervo_digital']) ) {
    		$query->set('meta_key', 'ano_da_publicacao_acervo_digital');
			$query->set('meta_value', $_GET['ano_da_publicacao_acervo_digital']);
    	} 
	}
	// return
	return $query;
}

add_action('pre_get_posts', 'my_pre_get_posts');
*/

// Remove a taxomia da lateral do editor
function wpse60590_remove_metaboxes() {
    remove_meta_box( 'palavradiv' , 'acervo' , 'normal' ); // Remove Palavra
    remove_meta_box( 'categoria_acervodiv' , 'acervo' , 'normal' ); // Remove Categoria
    remove_meta_box( 'autordiv' , 'acervo' , 'normal' ); // Remove Autor
    remove_meta_box( 'setordiv' , 'acervo' , 'normal' ); // Remove Setor
    remove_meta_box( 'idiomadiv' , 'acervo' , 'normal' ); // Remove Idioma
    remove_meta_box( 'modalidadediv' , 'acervo' , 'normal' ); // Remove Modalidade
    remove_meta_box( 'componentediv' , 'acervo' , 'normal' ); // Remove Componente
    remove_meta_box( 'formacaodiv' , 'acervo' , 'normal' ); // Remove Formacao
    remove_meta_box( 'promotoradiv' , 'acervo' , 'normal' ); // Remove Promotora
    remove_meta_box( 'publicodiv' , 'acervo' , 'normal' ); // Remove Publico
}
add_action( 'admin_menu' , 'wpse60590_remove_metaboxes' );

add_filter( 'posts_where', 'wpse18703_posts_where', 10, 2 );
function wpse18703_posts_where( $where, $wp_query )
{
    global $wpdb;
    if ( $wpse18703_title = $wp_query->get( 'wpse18703_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $wpse18703_title ) ) . '%\'';
    }
    return $where;
}

function wd_admin_menu_rename() {
    global $menu; // Global to get menu array
    global $submenu;
    $menu[10][0] = 'Arquivos'; // Change name of posts to portfolio  
    $submenu['upload.php'][10][0] = 'Adicionar novo';
}
add_action( 'admin_menu', 'wd_admin_menu_rename' );

add_action( 'admin_head', 'admin_head_script' );

function admin_head_script(){
    global $pagenow, $title;

    if ($pagenow == 'upload.php') {            
        $title = 'Biblioteca de Arquivos';    
    } // end pagenow
}

// Define o idioma padrao para Portugues no acervo
add_filter('acf/load_value/key=field_5efbf013703c5', 'kiteboat_set_tax_default', 20, 3);

function kiteboat_set_tax_default( $value, $post_id, $field ) {
	if ($value === false && get_post_status($post_id) == 'auto-draft') {
        // Esse id correponde ao do site atual nao sendo um valor fixo, em caso de migracao ou duplicidade de ambientes verificar o id do idioma desejado
		$value = 43; // id do portugues dentro da taxinomia idioma
	}
  return $value;
}

// Ocultar itens do menu
add_action( 'admin_init', 'wpse_136058_remove_menu_pages' );

function wpse_136058_remove_menu_pages() {
    remove_menu_page( 'edit.php?post_type=download' ); // Ocultar Downloads
    remove_menu_page( 'edit.php?post_type=acesso' ); // Ocultar Acessos
}

// Desabilita o tipo de usuario
remove_role( 'subscriber' );
remove_role( 'author' );

#############################################################################################################
#############################################################################################################

// Ocultar itens do menu para usuarios que não sao ASCOM ou AMCOM
function hide_menu() {
     
	$user = get_current_user_id(); // pega o ID usuario logado
    $setor = get_field('setor', 'user_' . $user); // pega o setor do usuario logado

    if($setor == 'AMCom' || $setor == 'ASCOM'){
       
    } else {
        remove_menu_page( 'themes.php' ); // Aparencias
        remove_menu_page( 'plugins.php' ); // Plugins
        remove_menu_page( 'tools.php' ); // Ferramentas
        remove_menu_page( 'edit.php?post_type=acf-field-group' ); // Campos Personalizados
        remove_menu_page( 'options-general.php' ); // Configuracoes
        remove_menu_page( 'wp-mail-smtp' ); // WP Mails SMTP
    }      
    
}
add_action('admin_head', 'hide_menu', 5, 1);

// Cria uma nova coluna
function register_custom_user_column($columns) {
    $columns['setor'] = 'Setor';
    return $columns;
}

add_action('manage_users_columns', 'register_custom_user_column');

// Insere o valor na coluna
function register_custom_user_column_view($value, $column_name, $user_id) {
    
    $setor = get_field('setor', 'user_' . $user_id); // pega o setor do usuario logado
    
    if($column_name == 'setor'){
        if($setor){
            return $setor;
        } else {
            return 'Nenhum setor cadastrado';
        }
    } 
    return $value;

}

add_action('manage_users_custom_column', 'register_custom_user_column_view', 10, 3);

// Adicionar o botão de ordenacao na coluna
function sortable_setor_column( $columns ) {
    $columns['setor'] = 'setor';
    return $columns;
}
add_filter( 'manage_users_sortable_columns', 'sortable_setor_column' );

// Ordena usuarios pela coluna "Setor"
add_action("pre_get_users", function ($WP_User_Query) {

    if (    isset($WP_User_Query->query_vars["orderby"])
        &&  ("setor" === $WP_User_Query->query_vars["orderby"])
    ) {
        $WP_User_Query->query_vars["meta_key"] = "setor";
        $WP_User_Query->query_vars["orderby"] = "meta_value";
    }

}, 10, 1);

// Remover o campor "Additional Capabilities" do editor do usuarios
add_filter( 'ure_show_additional_capabilities_section', '__return_false' );

################################################################################################
################################################################################################

// Altera o texto da label
add_filter(  'gettext',  'dirty_translate'  );
add_filter(  'ngettext',  'dirty_translate'  );
function dirty_translate( $translated ) {
     $words = array(
            // 'termo para traducao' => 'traducao'
            'Enviar nova mídia' => 'Enviar novo arquivo',
            'Editar mídia' => 'Editar arquivo'
     );
$translated = str_ireplace(  array_keys($words),  $words,  $translated );
return $translated;
}

function theme_slug_widgets_init()
	{

		register_sidebar(array(
			'name' => 'Rodape Esquerda',
			'id' => 'sidebar-4',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<p class="titulo-rodape">',
			'after_title' => '</p>',
		));
	}

add_action( 'widgets_init', 'theme_slug_widgets_init' );

######################################################################

add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'capa-acervo', 372, 479, true ); // (cropped)
}

function removeParam($url, $varname){
    $parsedUrl = parse_url($url);
    $query = array();

    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $query);
        unset($query[$varname]);
    }

    $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
    $query = !empty($query) ? '?'. http_build_query($query) : '';

    return $parsedUrl['scheme']. '://'. $parsedUrl['host']. $path. $query;
}

// Alterar email novo usuarios
add_filter( 'wp_new_user_notification_email', 'custom_wp_new_user_notification_email', 10, 3 );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {

	// Gerar uma chave de verificacao
	$key = get_password_reset_key( $user );

    // Assunto
    $subject = '[Acervo Digital] Detalhes de acesso';
    $wp_new_user_notification_email['subject'] = $subject;

	// Editar conteudo do Email
    $message = sprintf(__('Nome de usuário: ')) . rawurlencode($user->user_login) . "\r\n\r\n";
    $message .= 'Para definir sua senha, visite o seguinte endereço:' . "\r\n\r\n";
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . "\r\n\r\n";
    $message .= "Para acesso à página de login:" . "\r\n\r\n";
    $message .= network_site_url("wp-login.php", 'login') . "\r\n\r\n";
    $wp_new_user_notification_email['message'] = $message;

    // Para alterar o cabecalho do email edite a linha abaixo
	//$wp_new_user_notification_email['headers'] = 'From: MyName<example@domain.ext>'; // this just changes the sender name and email to whatever you want (instead of the default WordPress <wordpress@domain.ext>

    // retorna o conteudo do email
	return $wp_new_user_notification_email;
}

/**
 * Patch to prevent black PDF backgrounds.
 *
 * https://core.trac.wordpress.org/ticket/45982
 */
require_once ABSPATH . 'wp-includes/class-wp-image-editor.php';
require_once ABSPATH . 'wp-includes/class-wp-image-editor-imagick.php';

// phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
final class ExtendedWpImageEditorImagick extends WP_Image_Editor_Imagick
{
    /**
     * Add properties to the image produced by Ghostscript to prevent black PDF backgrounds.
     *
     * @return true|WP_error
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    protected function pdf_load_source()
    {
        $loaded = parent::pdf_load_source();

        try {
            $this->image->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
            $this->image->setBackgroundColor('#ffffff');
        } catch (Exception $exception) {
            error_log($exception->getMessage());
        }

        return $loaded;
    }
}

/**
 * Filters the list of image editing library classes to prevent black PDF backgrounds.
 *
 * @param array $editors
 * @return array
 */
add_filter('wp_image_editors', function (array $editors): array {
    array_unshift($editors, ExtendedWpImageEditorImagick::class);

    return $editors;
});

// Incluir Pagina Exportar Usuarios no menu Usuarios
add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');

function wpdocs_register_my_custom_submenu_page() {
    add_submenu_page(
        'users.php',
        'Exportar Usuarios',
        'Exportar Usuarios',
        'manage_options',
        'export-users',
        'wpdocs_my_custom_submenu_page_callback' );
}

function wpdocs_my_custom_submenu_page_callback() {
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Exportar Usuarios</h2><br>';

	?>

		<form action="<?= get_template_directory_uri(); ?>/export-users.php">
			<select name="funcao" id="">
				<option value="all">Todos</option>
				<option value="administrator">Administrador</option>
				<option value="editor">Editor</option>
				<option value="contributor">Colaborador</option>
			</select>
			<input type="submit" value="Exportar" class="button action">
		</form>

	<?php
    echo '</div>';
}

add_action( 'rest_api_init', 'rest_api_filter_add_filters' );

 /**
  * Add the necessary filter to each post type
  **/
function rest_api_filter_add_filters() {
	foreach ( get_post_types( array( 'show_in_rest' => true ), 'objects' ) as $post_type ) {
		add_filter( 'rest_' . $post_type->name . '_query', 'rest_api_filter_add_filter_param', 10, 2 );
	}
}

/**
 * Add the filter parameter
 *
 * @param  array           $args    The query arguments.
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function rest_api_filter_add_filter_param( $args, $request ) {
	// Bail out if no filter parameter is set.
	if ( empty( $request['filter'] ) || ! is_array( $request['filter'] ) ) {
		return $args;
	}

	$filter = $request['filter'];

	if ( isset( $filter['posts_per_page'] ) && ( (int) $filter['posts_per_page'] >= 1 && (int) $filter['posts_per_page'] <= 100 ) ) {
		$args['posts_per_page'] = $filter['posts_per_page'];
	}

	global $wp;
	$vars = apply_filters( 'rest_query_vars', $wp->public_query_vars );

	// Allow valid meta query vars.
	$vars = array_unique( array_merge( $vars, array( 'meta_query', 'meta_key', 'meta_value', 'meta_compare' ) ) );

	foreach ( $vars as $var ) {
		if ( isset( $filter[ $var ] ) ) {
			$args[ $var ] = $filter[ $var ];
		}
	}
	return $args;
}

add_filter( 'rest_query_vars', function ( $valid_vars ) {
    return array_merge( $valid_vars, array( 'ano_da_publicacao_acervo_digital', 'meta_query' ) );
} );
add_filter( 'rest_acervo_query', function( $args, $request ) {
    $ano_da_publicacao_acervo_digital   = $request->get_param( 'ano_da_publicacao_acervo_digital' );

    if ( ! empty( $ano_da_publicacao_acervo_digital ) ) {
        $args['meta_query'] = array(
            array(
                'key'     => 'ano_da_publicacao_acervo_digital',
                'value'   => $ano_da_publicacao_acervo_digital,
                //'compare' => '=',
            )
        );      
    }

    return $args;
}, 10, 2 );

// Contador de visitas
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if( $count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// registrar a funcao de contador de visualizacoes na chamada do Ajax para usuarios autenticados
add_action('wp_ajax_count_acervo_view', 'count_acervo_view');

// registrar a funcao de contador de visualizacoes na chamada do Ajax para usuarios NAO autenticados
add_action('wp_ajax_nopriv_count_acervo_view', 'count_acervo_view');

// Funcao para incrementar o contador de visualizacoes
function count_acervo_view() {
    $acervo_id = $_REQUEST['acervo_id'];

    // verificar se existe um contador e incrementa +1 no contador
    $count_key = 'post_views_count';
    $count = get_post_meta($acervo_id, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($acervo_id, $count_key);
        add_post_meta($acervo_id, $count_key, '0');
    }else{
        $count++;
        update_post_meta($acervo_id, $count_key, $count);
    }

    $contador = getPostViews($acervo_id); // Pega o valor de visualizacoes

    // retorna o valor atualizado do contador
    wp_send_json_success([$contador]);

    // caso tenha erro retorna a mensagem
    wp_send_json_error(['error']);
}

// Contador de downloads
function getPostDownloads($postID){
    $count_key = 'post_downloads_count';
    $count = get_post_meta($postID, $count_key, true);
    if( $count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// registrar a funcao de contador de downloads na chamada do Ajax para usuarios autenticados
add_action('wp_ajax_count_acervo_download', 'count_acervo_download');

// registrar a funcao de contador de downloads na chamada do Ajax para usuarios NAO autenticados
add_action('wp_ajax_nopriv_count_acervo_download', 'count_acervo_download');

// Funcao para incrementar o contador de visualizacoes
function count_acervo_download() {
    $acervo_id = $_REQUEST['acervo_id'];

    // verificar se existe um contador e incrementa +1 no contador
    $count_key = 'post_downloads_count';
    $count = get_post_meta($acervo_id, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($acervo_id, $count_key);
        add_post_meta($acervo_id, $count_key, '0');
    }else{
        $count++;
        update_post_meta($acervo_id, $count_key, $count);
    }

    $contador = getPostDownloads($acervo_id); // Pega o valor de visualizacoes

    // retorna o valor atualizado do contador
    wp_send_json_success([$contador]);

    // caso tenha erro retorna a mensagem
    wp_send_json_error(['error']);
}