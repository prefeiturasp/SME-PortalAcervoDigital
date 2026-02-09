<?php
/**
 * Register custom post type
 */
class AcervoRegisterCustomPostType
{
	private $type_name = '';
	private $singular_name = '';
	private $menu_icon = '';
	private $args = array();
	private $labels = array();

	function __construct( $type_name, $singular_name, $menu_icon, $args = array(), $labels = array() )
	{
		$this->type_name = $type_name;
		$this->singular_name = $singular_name;
		$this->menu_icon = $menu_icon;
		$this->args = $args;
		$this->labels = $labels;

		//registrando o action do custom post type
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	function register_post_type(){
		$labels = array(
			'name' => $this->singular_name . 's',
			'singular_name' => $this->singular_name . '',
			'menu_name' => $this->singular_name . 's',
			'add_new' => 'Adicionar novo',
			'add_new_item' => 'Adicionar novo ' . strtolower( $this->singular_name ) . '',
			'new_item' => 'Novo ' . strtolower( $this->singular_name ) . '',
			'edit_item' => 'Editar ' . strtolower( $this->singular_name ) . '',
			'view_item' => 'Visualizar ' . strtolower( $this->singular_name ) . '',
			'all_items' => 'Todos os ' . strtolower( $this->singular_name ) . 's',
			'search_items' => 'Pesquisar ' . strtolower( $this->singular_name ) . 's',
			'not_found' => 'Nenhum ' . strtolower( $this->singular_name ) . ' foi encontrado',
			'not_found_in_trash' => 'Nenhum ' . strtolower( $this->singular_name ) . ' encontrado na lixeira',
			'featured_image' => 'Imagem destacada',
			'set_featured_image' => 'Escolher como imagem destacada',
			'remove_featured_image' => 'Remover imagem destacada',
			'use_featured_image' => 'Usar como imagem destacada'
	 	);

		$labels = array_merge( $labels, $this->labels );

		$args = array(
			'labels' => $labels,
			'public' => true,
			'menu_icon' => $this->menu_icon,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true, 
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			/*'taxonomies' => array(
				'taxonomy' => 'post_tag',
				'name' => 'Palavra chave',
				'slug' => 'palavra-chave'
			),*/
			'supports' => array('title','revisions')
			
		);

		$args = array_merge( $args, $this->args );
		register_post_type( $this->type_name, $args );
	}
}
$varteste = new AcervoRegisterCustomPostType( 'acervo','Acervo','dashicons-media-archive' );
$varteste = new AcervoRegisterCustomPostType( 'download','Download','dashicons-media-archive' );
$varteste = new AcervoRegisterCustomPostType( 'acesso','Acesso','dashicons-media-archive' );
//$novocpt = new AcervoRegisterCustomPostType( 'novo','Novo','dashicons-admin-tools');

//modifica tag para palavra chave
function change_tax_object_label() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['post_tag']->labels;
    $labels->name = "Palavras chaves";
    $labels->singular_name = "Palavra chave";
    $labels->search_items = "Buscar palavras chaves";
    $labels->all_items = "Palavras chaves";
    $labels->separate_items_with_commas = "Separe palavras chaves por virgulas \";\"";
    $labels->choose_from_most_used = "Escolha entre os mais usados";
    $labels->popular_items = "Palavras chaves mais usadas";
    $labels->edit_item = "Editar palavras chaves";
    $labels->view_item = "Visualizar palavras chaves";
    $labels->update_item = "Modificar palavras chaves";
    $labels->add_new_item = "Nova Palavra chave";
    $labels->new_item_name = "Novo nome palavras chave";
    $labels->add_or_remove_items = "Adiconar ou remover palavras chaves";
    $labels->not_found = "Sem palavras chaves";
    $labels->no_terms = "Nenhuma palavras chaves";
    $labels->items_list_navigation = "Navegue pelas palavras chaves";
    $labels->items_list = "Lista de palavras chaves";
    $labels->back_to_items = "← Voltar para palavras chaves";
    $labels->menu_name = "Palavras chaves";
}
add_action( 'init', 'change_tax_object_label' );


//adiciona colunas ao CPT acervo
//function set_custom_edit_acervo_columns($columns) {
//	//Habilita coluna autor
//    $columns['author'] = __( 'Usuário', 'your_text_domain' );
//    //custom coluna
//    $columns['tipo'] = __( 'Tipo', 'your_text_domain' );
//    return $columns;
//}
//add_filter( 'manage_acervo_posts_columns', 'set_custom_edit_acervo_columns' );



/*function custom_acervo_column( $column, $post_id ) {
    switch ( $column ) {

        case 'tipo' :
       		$file = get_field('arquivo_acervo', $post_id);
			$stringSeparada = explode(".", $file['filename']);
        	echo $stringSeparada[1];
            break;
    }
}
add_action( 'manage_acervo_posts_custom_column' , 'custom_acervo_column', 10, 2 );*/