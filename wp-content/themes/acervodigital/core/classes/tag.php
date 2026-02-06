<?php

//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Palavras chavs', 'taxonomy general name' ),
    'singular_name' => _x( 'Palavra chave', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar palavras chaves' ),
    'popular_items' => __( 'Palavras chaves mais usadas' ),
    'all_items' => __( 'Todos as palavras chaves' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar palavra chave' ), 
    'update_item' => __( 'Atualizar palavra chave' ),
    'add_new_item' => __( 'Adicionar palavra chave' ),
    'new_item_name' => __( 'Nova palavras chave' ),
    'separate_items_with_commas' => __( 'Separe palavras chaves com virgulas' ),
    'add_or_remove_items' => __( 'Adicionar ou remover palavras chaves' ),
    'choose_from_most_used' => __( 'Escolha entre as palavras chaves mais usadas' ),
    'menu_name' => __( 'Filtros' ),
  ); 

  register_taxonomy('Palavra chave','acervo',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'Palavra chave' ),
  ));
}
//add_action( 'init', 'create_tag_taxonomies', 0 );