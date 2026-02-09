<?php
function general_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'term.php' ) {
         echo '<div class="notice notice-warning is-dismissible">
             <p><strong>Atenção:</strong> Em caso de alteração de nome ou slug, todos os arquivos e urls vinculados a esse termo também serão renomeados!</p>
         </div>';
    }
	if ( $pagenow == 'edit-tags.php' ) {
         echo '<div class="notice notice-warning is-dismissible">
             <p><strong>Atenção:</strong> Caso exista arquivos vinculados, os mesmos deverão ser movidos para outra categoria! Caso contrario o arquivo ficará sem categoria</p>
         </div>';
    }
}
add_action('admin_notices', 'general_admin_notice');