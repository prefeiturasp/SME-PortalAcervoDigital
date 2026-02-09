<?php get_header(); 

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<section>
	<div class="container mt-4 mb-4">
		<div class="row">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					$args = array(
						'type' => get_post_type(),
						'orderby' => 'name',
						'order' => 'ASC'
					);

					$file = get_field('arquivo_acervo_digital');
					$stringSeparada = explode(".", $file['filename']);
					$indice = count($stringSeparada);
					$indice = $indice - 1;
					$type = get_post_type();
					$postid = get_the_ID();

					$class = generateRandomString();

					$partional = array();

					// Check value exists.
					if( have_rows('arquivos_particionados') ):

						// Loop through rows.
						while ( have_rows('arquivos_particionados') ) : the_row();
							
							if( get_row_layout() == 'adicionar_arquivos' ):
								$text = get_sub_field('arquivo');
								$partional[] = $text;													
							endif;

						// End loop.
						endwhile;

					endif;

					$tipo = get_field('tipos_de_documentos'); // Tipo de documento
				?>

				<div class="col-sm-12 mb-4">
					<a href="<?php echo get_home_url(); ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar ao resultado de busca</a>
				</div>

				<div class="col-sm-12 d-lg-none d-xl-none">
					<p class='title-acervo title-mobile'><strong><?php the_title(); ?></strong></p>
					<div class="infos mt-3 d-flex justify-content-between">
						<p>
							<?php 
								$categories = get_the_terms(get_the_ID(), 'categoria_acervo' );
								$n = 0;
								foreach($categories as $categoria){
									if($n == 0){
										echo "<a href='" . get_home_url() . "/?avanc=1&categ=1&s=&categ_acervo=" . $categoria->term_id . "'>" . $categoria->name . "</a>";
									} else {
										echo " / <a href='" . get_home_url() . "/?avanc=1&categ=1&s=&categ_acervo=" . $categoria->term_id . "'>" . $categoria->name . "</a>";
									}
									$n++;
								}									
							?>
						</p>
					</div>
				</div>

				<div class="col-md-4 col-12">

					<div class="mask-detail">
						<img src="<?php
							  if(get_field('substituir_capa_acervo_digital') == '' && $stringSeparada[$indice] == 'pdf'){
								 echo $file['icon']; 
							  }else if(get_field('substituir_capa_acervo_digital') == '' && ($stringSeparada[$indice] == 'xlsx' || $stringSeparada[$indice] == 'xls') ){
								echo 'https://hom-acervodigital.sme.prefeitura.sp.gov.br/wp-content/uploads/2021/08/acervo-xls.jpg';
							  }else if(get_field('substituir_capa_acervo_digital') == '' && ($stringSeparada[$indice] == 'docx' || $stringSeparada[$indice] == 'doc') ){
								echo 'https://hom-acervodigital.sme.prefeitura.sp.gov.br/wp-content/uploads/2021/08/acervo-doc.jpg';
							  }else if(get_field('substituir_capa_acervo_digital') == '' && ($stringSeparada[$indice] == 'pptx' || $stringSeparada[$indice] == 'ppt') ){
								echo 'https://hom-acervodigital.sme.prefeitura.sp.gov.br/wp-content/uploads/2021/08/acervo-doc.jpg';
							  }else if(get_field('substituir_capa_acervo_digital') != ''){
								 echo get_field('substituir_capa_acervo_digital'); 
							  }else if($file['url']){
								 echo $file['url'];
							  } else {
								  echo 'https://hom-acervodigital.sme.prefeitura.sp.gov.br/wp-content/uploads/2021/08/acervo-doc.jpg';
							  }
							  ?>" alt="<?php the_field('campo_alt_acervo_digital'); ?>" class='shadow-sm img-mobile'>
					</div>
					<?php 
						if($file['url'] != ''){
							$url = $file['url']; 
						} elseif($partional){
							$url = $partional[0];
							$stringSeparada = explode(".", $url);
							$indice = count($stringSeparada);
							$indice = $indice - 1;
						}else{
							$url = false;
						}
					?>
					
						<button type="button" class="btn btn-view mb-2" data-toggle="modal" data-target=".<?php echo $class; ?>"><i class="fa fa-search" aria-hidden="true"></i> Visualizar</button>
					
						<?php if($stringSeparada[$indice] == 'jpg' || $stringSeparada[$indice] == 'jpeg' || $stringSeparada[$indice] == 'png' || $stringSeparada[$indice] == 'gif' || $stringSeparada[$indice] == 'webp') : ?>

												

							<div class="modal <?php echo $class; ?>" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<p class="modal-title"><?php the_title(); ?></p>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<?php if($url) : ?>
												<img src="<?php echo $url; ?>" class="img-fluid d-block mx-auto py-2">
											<?php else: ?>
												<p>Visualização não disponível.</p>
											<?php endif; ?>
										</div>															
									</div>
								</div>
							</div>

						<?php else : ?>

							<div class="modal fade bd-example-modal-lg <?php echo $class; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-xl">

									

									<div class="modal-content">

										<div class="modal-header">
											<p class="modal-title"><?php the_title(); ?></p>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>

										<div class="modal-body">
											<div class="embed-responsive embed-responsive-16by9">
												<iframe title="doc" type="application/pdf" src="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true" class="jsx-690872788 eafe-embed-file-iframe"></iframe>
											</div>
										</div>

									</div>
								</div>
							</div>

						<?php endif; ?>

					<?php
						if($file['url'] != ''){
							?>
							<a href="<?php echo $file['url']; ?>" id="download_link" target="_blank" download>
								<button type="button" class="btn btn-down btn-primary mb-2"><i class="fa fa-download" aria-hidden="true"></i> Baixar documento</button>
							</a>
							<?php
						}
					?>
							

						<?php
							if(!$file){
								$a = 1;
								if( have_rows('arquivos_particionados') ):
								?>
									<div class="dropdown" style="display: initial;">
										<button class="btn btn-down btn-primary mb-1 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Baixar documento
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<?php
												while ( have_rows('arquivos_particionados') ) : the_row();
													if( get_row_layout() == 'adicionar_arquivos' ):
														?>
														<a href="<?php echo $text = get_sub_field('arquivo'); ?>" class="dropdown-item" id="download_link" target="_blank" download>
															Baixar Arquivo <?php echo $a++; ?>
														</a>
														<?php
													endif;
												endwhile;											
										?>
										</div>
									</div>
									
								<?php
								endif;
								
							}
						?>

					<?php if(get_field('diario_oficial') && $tipo == 'proposta_formativa'): ?>
							<a href="<?php the_field('diario_oficial') ?>" id="download_link" target="_blank" download>
								<button type="button" class="btn btn-primary mb-2 btn-diario">Ver no Diário Oficial</button>
							</a>
					<?php endif; ?>
										
				</div>

					<?php

					$idpost = get_the_ID();

					$ipacesso = get_client_ip();

					$titledoc = get_the_title();

					?>

					<?php

					$articles = get_posts(

					 array(

					  's' => $titledoc,

					  'numberposts' => -1,

					  'post_status' => 'any',

					  'post_type' => 'download',
					 )

					);

					?>

					<?php

					//executar depois do click

					// Cria post para registro de downloads.

					

					if(isset($_GET['ajaxify'])) {

					    echo 'ajaxifying';

					$download_data = array(

						'post_title'    => $titledoc,

						'post_type'     => 'download',

						'post_status'   => 'publish'

					);

					$download_id = wp_insert_post( $download_data );
					// Salva nome do documento.

					$field_key = "field_5f6a0eddf2ee2";

					$value = $titledoc;

					update_field( $field_key, $value, $download_id );

					// Salva id do documento.

					$field_key = "field_5f6a2e01aafb7";

					$value = $idpost;

					update_field( $field_key, $value, $download_id );

					// Salva ipdo visitante

					$field_key = "field_5f6a267742f16";

					$value = $ipacesso;

          update_field( $field_key, $value, $download_id );

        }

					?>

					<?php

					// Cria post para registro de visitas.

					$acesso_data = array(

						'post_title'    => $titledoc,

						'post_type'     => 'acesso',

						'post_status'   => 'publish'

					);

					$acesso_id = wp_insert_post( $acesso_data );
					// Salva nome do documento.

					$field_key = "field_5f6ac9d93c0a7";

					$value = $titledoc;

					update_field( $field_key, $value, $acesso_id );

					// Salva id do documento.

					$field_key = "field_5f6ac9d93c122";

					$value = $idpost;

					update_field( $field_key, $value, $acesso_id );

					// Salva ipdo visitante

					$field_key = "field_5f6ac9d93c0e6";

					$value = $ipacesso;

					update_field( $field_key, $value, $acesso_id );

					
					?>
			
			
						<div class="col-md-8">
						<div class="row">
						<div class="col-sm-12 mb-4">
							<h1 class='title-acervo d-none d-lg-block d-xl-block'><strong><?php the_title(); ?></strong></h1>
							<div class="infos mt-3 d-flex justify-content-between">
								<p class='d-none d-lg-block d-xl-block'>
									<?php 
										$categories = get_the_terms(get_the_ID(), 'categoria_acervo' );
										$n = 0;
										foreach($categories as $categoria){
											if($n == 0){
												echo "<a href='" . get_home_url() . "/?avanc=1&categ=1&s=&categ_acervo=" . $categoria->term_id . "'>" . $categoria->name . "</a>";
											} else {
												echo " / <a href='" . get_home_url() . "/?avanc=1&categ=1&s=&categ_acervo=" . $categoria->term_id . "'>" . $categoria->name . "</a>";
											}
											$n++;
										}									
									?>
								</p>
								<div class="share">
									Compartilhar: 
									<a href="mailto:?subject=&body=:%20" title="<?php the_title(); ?>" onclick="window.open('mailto:?subject=' + 'Acervo Digital SME' + '&body=' + encodeURIComponent(document.URL)); return false;">
										<img src="<?php echo get_template_directory_uri(); ?>/images/email-icon.png" width="32" alt="compartilhar no email">
									</a>
									<a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/images/twitter-icon.png" width="32" alt="compartilhar no twitter">
									</a>
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/images/facebook-icon.png" width="32" alt="compartilhar no facebook">
									</a>
									<a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/images/whatsapp-icon.png" width="32" alt="compartilhar no Whatsappl">
									</a>
								</div>							
							</div>
							
						</div>

						<div class="col-sm-12 tabs-acervo">
							<ul class="nav nav-tabs">
								<li><a data-toggle="tab" href="#descri" class="active">Descrição</a></li>
								<li><a data-toggle="tab" href="#especi">Especificações</a></li>
							</ul>

							<div class="tab-content">
								<div id="descri" class="tab-pane fade in active show">
									<p><?php the_field('descricao_acervo_digital'); ?></p>
								</div>
								<div id="especi" class="tab-pane fade">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<td scope="col">
													<strong>Modalidade de ensino</strong><br>
													<?php
													$terms = get_field('modalidade_acervo_digital');

													if($terms != '' && ($tipo == 'publicacoes_institucionais' || $tipo == 'proposta_formativa') ){
														$n = 0;									
														if( $terms ):
															foreach( $terms as $term ):
																if($n == 0){
																	echo "<a href='" . get_home_url() . "/?avanc=1&modal=1&s=&modalidade%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																} else {
																	echo " / <a href='" . get_home_url() . "/?avanc=1&modal=1&s=&modalidade%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																}
																$n++;																
															endforeach;
														endif; 
													} else {
														echo "-";
													}
												?>

												</td>
												<td scope="col">
													<strong>Componente curricular</strong><br>
													<?php
														$terms = get_field('componente_acervo_digital');
														if(get_field('componente_acervo_digital') != '' && $tipo == 'publicacoes_institucionais' ){
															$n = 0;
															if( $terms ):
																foreach( $terms as $term ):
																	if($n == 0){
																		echo "<a href='" . get_home_url() . "/?avanc=1&comp=1&s=&componente%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																	} else {
																		echo " / <a href='" . get_home_url() . "/?avanc=1&comp=1&s=&componente%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																	}
																	$n++;															
																endforeach;
															endif;  
														} else {
															echo "-";
														}
													?>
												</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td scope="row">
													<strong>Mês de publicação</strong><br>
													<?php
														if(get_field('mes_da_publicacao_acervo_digital') != ''){
															the_field('mes_da_publicacao_acervo_digital');
														} else {
															echo "-";
														}
													?>
												</td>
												<td>
													<strong>Ano de publicação</strong><br>
													<?php
														if(get_field('ano_da_publicacao_acervo_digital') != ''){
															$ano = get_field('ano_da_publicacao_acervo_digital');
															echo "<a href='" . get_home_url() . "/?avanc=1&tano=1&s=&anob%5B%5D=" . $ano . "'>" . $ano . "</a>";															
														} else {
															echo "-";
														}
													?>
												</td>
											</tr>

											<tr>
												<td scope="row">
													<strong>Autor</strong><br>
													<?php
														$terms = get_field('autor_acervo_digital');
														if(get_field('autor_acervo_digital') != ''){
															$n = 0;
															if( $terms ):
																foreach( $terms as $term ):
																	if($n == 0){
																		echo "<a href='" . get_home_url() . "/?avanc=1&aut=1&s=&autorb=" . $term->slug . "'>" . $term->name . "</a>";
																	} else {
																		echo " / <a href='" . get_home_url() . "/?avanc=1&aut=1&s=&autorb=" . $term->slug . "'>" . $term->name . "</a>";
																	}
																	$n++;																	
																endforeach;
															endif;
														}
													?>
												</td>
												<td>
													<strong>Setor</strong><br>
													<?php
														$terms = get_field('setor_acervo_digital');
														if(get_field('setor_acervo_digital') != ''){
															$n = 0;
															if( $terms ):
																foreach( $terms as $term ):
																	if($n == 0){
																		echo "<a href='" . get_home_url() . "/?avanc=1&set=1&s=&setorb%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																	} else {
																		echo " / <a href='" . get_home_url() . "/?avanc=1&set=1&s=&setorb%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																	}
																	$n++;																	
																endforeach;
															endif;
														}
													?>
												</td>
											</tr>

											<tr>
												<td scope="row">
													<strong>Tipo de documento</strong><br>
													<span class="upper">
														<?php 
															if($partional && !$file){
																$formats = array();

																foreach($partional as $format){
																	$format = explode(".", $format);
																	$formats[] = $format[6];											
																}

																// Remover formatos duplicados
																$formats = array_unique($formats);

																echo implode(", ", $formats);
																
															}
															elseif($stringSeparada[$indice] != ''){
																echo $stringSeparada[$indice];
															}else{
																echo 'DIVERSOS';
															}
														?>
													</span>
												</td>
												<td>
													<strong>Tamanho do documento</strong><br>
													<?php
														if( $file['filesize']  != ''){
															echo size_format( $file['filesize'] );
														}else{
															echo 'INDEFINIDO';
														}
													?>
												</td>
											</tr>

											<tr>
												<td scope="row">
													<strong>Idioma</strong><br>
													<?php
														$terms = get_field('idioma_acervo_digital');
														if(get_field('autor_acervo_digital') != ''){
															$n = 0;
															if( $terms ):
																foreach( $terms as $term ):
																	if($n == 0){
																		echo "<a href='" . get_home_url() . "/?avanc=1&idi=1&s=&idiomab%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																	} else {
																		echo " / <a href='" . get_home_url() . "/?avanc=1&idi=1&s=&idiomab%5B%5D=" . $term->term_id . "'>" . $term->name . "</a>";
																	}
																	$n++;															
																endforeach;
															endif;
														}
													?>
												</td>
												<td>
													<strong>Número de visualizações</strong><br>
													<?php 
														function title_filter_t( $where, &$wp_query ){
															global $wpdb;
															if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
																$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $search_term ) ) . '\'';
															}
															return $where;
														}

														function retornaNumero_t($posttype) {	
															$args = array(
																'post_type' => $posttype,
																'posts_per_page' => -1,
																'search_prod_title' => get_the_title(),
																'post_status' => 'publish',
																'orderby'     => 'title', 
																'order'       => 'ASC'
															);

															add_filter( 'posts_where', 'title_filter_t', 10, 2 );
															$wp_query = new WP_Query($args);
															remove_filter( 'posts_where', 'title_filter_t', 10 );

															$contador = 0;
															echo '<div style="display: none">';
															$artigo = get_posts(
																array(
																	's' => 'Alimentação Escolar',
																	'post_type' => $posttype,
																	'numberposts' => -1,
																	'post_status' => 'any',
																));
															echo '</div>';

															foreach ($artigo as $article) { 
															$contador++;
															//var_dump($article);
															}
															//return $contador;
															return $wp_query->found_posts;
														}
														echo retornaNumero_t(('acesso'));
													?>  
												</td>
											</tr>

											<tr>												
												<td colspan='2'>
													<strong>Palavras-chave</strong><br>
													<span class='single-palavras'>
														<?php
															$palavras = get_the_terms(get_the_ID(), 'palavra' );
															$n = 0;
															if($palavras){
																foreach($palavras as $palavra){
																	if($n == 0){
																		echo "<a href='" . get_home_url() . "/?avanc=1&chave=1&s=&palavrab=" . $palavra->term_id . "'>" . $palavra->name . "</a>";
																	} else {
																		echo " <a href='" . get_home_url() . "/?avanc=1&chave=1&s=&palavrab=" . $palavra->term_id . "'>" . $palavra->name . "</a>";
																	}
																	$n++;
																}
															} else {
																echo "-";
															}
															
														?>
													</span>
												</td>
											</tr>
											
										</tbody>
									</table>
								</div>								
							</div>
						</div>

						<div class="col-12 mb-3">
						
						</div>	
					</div>
				</div>	

			<?php endwhile; wp_reset_query(); ?>

		</div>
	</div>
</section>

<script>
function ctDownload() {

    var href = new URL(window.location.href);

href.searchParams.set('ajaxify', '1');
  jQuery.ajax({url: href.toString(), success: function(result){

    console.log(result);

  }});

}	jQuery( "#download_link" ).click(function() {

ctDownload();

	});

	

	jQuery( "#view_link" ).click(function() {

ctDownload();

	});

/*

		jQuery.ajax({
		 type:"POST",
		 url: 'https://hom-portal.sme.prefeitura.sp.gov.br/acervodigital/wp-admin/admin-ajax.php',
		 data: {
			'action':'update_counter',
			'post_id' : <?php global $post; echo $post->ID; ?>
		 }
		 });
			setTimeout("window.location.reload();", 2000);

*/

		 //window.location.reload();

</script>
<?php get_footer(); ?>