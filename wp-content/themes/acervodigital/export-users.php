<?php
require_once("../../../wp-load.php");
$date = date('d_m_y_h_i_s');
$fileName = $date . '_usuarios_acervo.xlsx';
 
if($_GET['funcao'] == 'all'){
	$blogusers = get_users( array( 'fields' => array( 'id', 'user_login', 'user_email' ) ) );
} else {
	$blogusers = get_users( 
		array( 
			'fields' => array( 'id', 'user_login', 'user_email' ),
			'role__in' => array( $_GET['funcao'] )
		)
	);
}

$usuarios = array();
$usuarios[] = array(
	'<style bgcolor="#8EA9DB">ID</style>',
	'<style bgcolor="#8EA9DB">Login</style>',
	'<style bgcolor="#8EA9DB">Nome</style>',
	'<style bgcolor="#8EA9DB">E-mail</style>',
	'<style bgcolor="#8EA9DB">Função</style>',
	'<style bgcolor="#8EA9DB">Setor</style>'
);

function convertFunc($funcao){
	switch ($funcao):
		case 'administrator':
			return 'Administrador';
			break;
		case 'contributor':
			return 'Colaborador';
			break;
		case 'editor':
			return 'Editor';
			break;
		default:
			return $funcao;
	endswitch;
}

foreach($blogusers as $user){
	$user_meta = get_userdata($user->id);
	$user_roles = $user_meta->roles;
	$setor = get_field('setor', 'user_'. $user->id );	
	$func = $user_roles[0];

	if($setor == '')
		$setor = '<center>-</center>';

	if($func == '')
		$func = '<center>-</center>';

	$user_info = get_userdata( $user->id );
	$nome = $user_info->first_name . ' ' . $user_info->last_name;

	$usuarios[] = array(
		$user->id,
		$user->user_login,
		$nome,
		$user->user_email,
		convertFunc($func),
		$setor
	);

}

$xlsx = Classes\Lib\SimpleXLSXGen::fromArray( $usuarios );
$xlsx->downloadAs($fileName); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 

exit();