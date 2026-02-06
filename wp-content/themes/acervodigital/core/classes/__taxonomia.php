<?php 

/**
 * Register custom taxonomy
 */

class AcervoRegisterCustomTaxonomy
{
	private $type_name = '';
	private $singular_name = '';
	private $button_name = '';
	private $args = array();
	private $labels = array();
	private $vinculo = array();
	public $capabily = '';

	function __construct( $type_name, $singular_name, $button_name, $vinculo = array(), $args = array(), $labels = array() )
	{
		$this->type_name = $type_name;
		$this->singular_name = $singular_name;
		$this->button_name = $button_name;
		$this->args = $args;
		$this->labels = $labels;
		$this->vinculo = $vinculo;
		$this->capabily = $capabily;

		//registrando o action do custom post type
		add_action( 'init', array( $this, 'register_taxonomy' ) );
	}

	function register_taxonomy(){

		$labels = array(
			'name' => $this->singular_name,
			'singular_name' => $this->singular_name,
			'menu_name' => $this->singular_name,
			'all_items' => 'Todas as ' . strtolower( $this->singular_name ) . 's',
			'parent_item' => $this->singular_name . ' Pai',
			'new_item_name' => strtolower( $this->button_name ) . strtolower( $this->singular_name ) . '',
			'add_new_item' => $this->button_name . ' ' . strtolower( $this->singular_name ) . '',
			'edit_item' => 'Editar ' . strtolower( $this->singular_name ) . '',
			'update_item' => 'Atualizar ' . strtolower( $this->singular_name ) . '',
			'view_item' => 'Visualizar ' . strtolower( $this->singular_name ) . '',
			'add_or_remove_items' => 'Adicionar ou remover ' . strtolower( $this->singular_name ) . 's',
			'separate_items_with_commas' => 'Separar por virgulas',
			'choose_from_most_used' => 'Escolher entre as mais utilizadas',
			'popular_items' => $this->singular_name . ' mais populares',
			'search_items' => 'Pesquisar ' . strtolower( $this->singular_name ) . 's',
			'not_found' => 'Nada foi encontrado',
			'no_terms' => 'Nenhuma ' . strtolower( $this->singular_name ) . '',
			'items_list' => 'Lista de ' . strtolower( $this->singular_name ) . 's',
			'items_list_navigation' => 'Lista de navegação para ' . strtolower( $this->singular_name ) . 's',			
		);

		$labels = array_merge( $labels, $this->labels );

		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => true,			
			'fields' => 'all', 
			'show_ui' => true,			
			'search' => 'categoria',
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,	
		);

		if($this->capabily){
			$capabilities = array(
				'capabilities' => array(
					'manage_terms' => $this->capabily,
					'edit_terms' => $this->capabily,
					'delete_terms' => $this->capabily,
					'assign_terms' => $this->capabily,
				)
			);

			$args = array_merge( $args, $capabilities );
		}

		$args = array_merge( $args, $this->args );

		$vinculo = is_array( $this->vinculo ) ? $this->vinculo : array( $this->vinculo );

		register_taxonomy( $this->type_name, $vinculo, $args );

	}

}

$categorias = new AcervoRegisterCustomTaxonomy( 'categoria_acervo', 'Categoria', 'acervo' );
$categorias->capabily = 'list_users';

new AcervoRegisterCustomTaxonomy( 'autor', 'Autor', 'Adicionar um novo', 'acervo' );
new AcervoRegisterCustomTaxonomy( 'setor', 'Setor', 'Adicionar um novo', 'acervo' );
new AcervoRegisterCustomTaxonomy( 'idioma', 'Idioma', 'Adicionar um novo', 'acervo' );
new AcervoRegisterCustomTaxonomy( 'modalidade', 'Nível/Etapa/Modalidade', 'Adicionar um novo', 'acervo' );
new AcervoRegisterCustomTaxonomy( 'componente', 'Componente', 'Adicionar um novo', 'acervo' );
new AcervoRegisterCustomTaxonomy( 'formacao', 'Formação', 'Adicionar uma nova', 'acervo' );
new AcervoRegisterCustomTaxonomy( 'promotora', 'Promotora', 'Adicionar uma nova', 'acervo' );
new AcervoRegisterCustomTaxonomy( 'publico', 'Público', 'Adicionar um novo', 'acervo' );


//taxonomy acervo palavra chave

function palavra_custom_taxonomy() { 

  $labels = array(
    'name' => _x( 'Palavra Chave', 'taxonomy general name' ),
    'singular_name' => _x( 'Palavra Chave', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Palavras Chaves' ),
    'all_items' => __( 'Todas as Palavras Chaves' ),
    'parent_item' => null,
    'parent_item_colon' => null,
	  	//'parent_item' => __( 'Parent Type' ),
    	//'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Editar Palavra Chave' ), 
    'update_item' => __( 'Atualizar Palavra Chave' ),
    'add_new_item' => __( 'Cadastrar Palavra Chave' ),
    'new_item_name' => __( 'nome' ),
    'menu_name' => __( 'Palavras Chaves' ),
  ); 	

 

  register_taxonomy('palavra',array('acervo'), array(

/*  'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'palavra' ),*/
	'labels' => $labels,
	'public' => true,
	'hierarchical' => true,
	'show_ui' => true,
	'show_admin_column' => true,
	'show_in_nav_menus' => true,
	'show_tagcloud' => true, 
  ));

}

add_action( 'init', 'palavra_custom_taxonomy', 0 );