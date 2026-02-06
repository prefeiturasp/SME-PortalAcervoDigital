<?php
/*$user_teste = true; //Ative para remover e aplicar novas capacidades ao usuário
if($user_teste = true){
	remove_role('teste_user1');
	add_role('teste_user1', __(//Role name
	   'Teste_user1'),//Display name
	   array(
		   //Default
		   'read'	=>	true,
		   //Posts
		   'edit_posts'	=>	true, //permite editar posts
		   'delete_posts'	=>	true, //permite deletar posts
		   'publish_posts'	=>	true, //permite publicar
		   'edit_published_posts'	=>	true, //permite editar posts publicados
		   'delete_published_posts'	=>	false, //permite deletar posts publicados

		   'read_private_posts'	=>	false, //permite visualisar posts privados
		   'edit_private_posts'	=>	false, //permite visualisar posts privados
		   'delete_private_posts'	=>	false, //permite visualisar posts privados

		   'read_others_posts'	=>	false, //permite visualisar posts privados
		   'edit_others_posts'	=>	false, //permite visualisar posts privados
		   'delete_others_posts'	=>	false, //permite visualisar posts privados
		   
		   //uploads
		   'upload_files' => false, //permite upload de arquivos
		   
		   //Comments
		   'moderate_comments' => false,

		   //ACF Options
		   'acf_options' => false,//permite visualizar pagina de opções do  ACF

		   //Plugins
		   'read_fswpma_manutencao' => false
	   )
	);
}


//Remove menus do admin para o usuário
function remove_menu_for_user_teste_user1(){
	
	if(current_user_can('teste_user1')){
		//remove_menu_page( 'index.php' );//Dashboard
		//remove_menu_page( 'edit.php' );//Posts
		//remove_menu_page( 'upload.php' );//Media
		//remove_menu_page( 'edit.php?post_type=page' );//Pages
		remove_menu_page( 'edit-comments.php' );//Comments
		remove_menu_page( 'themes.php' );//Appearance
		remove_menu_page( 'plugins.php' );//Plugins
		remove_menu_page( 'profile.php' );//Perfil
		remove_menu_page( 'users.php' );//Users
		remove_menu_page( 'tools.php' );//Tools
		remove_menu_page( 'options-general.php' );//Settings
	}
   
}
add_action( 'admin_menu', 'remove_menu_for_user_teste_user1' );


//Consegue visualizar somente conteudos do proprio usuário
function posts_for_current_author($query) {
  global $user_level;

  if(current_user_can('teste_user1')) {
    global $user_ID;
    $query->set('author', $user_ID);
    unset($user_ID);
  }
  unset($user_level);

  return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');*/