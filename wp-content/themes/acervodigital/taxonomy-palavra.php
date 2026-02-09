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

<main class="mt-5 mb-5">

	<section>

		<div class="container">	

			<div class="row">

				<div class="col-sm-12">

					<?php
						
						// Pega a quantidade de posts retornados
						$qtd = $wp_query->found_posts;

						// valida a quantidade para singular ou plural
						if($qtd == 1){
							$text = 'resultado';
						} else {
							$text = 'resultados';
						}

						// Pega o nome da categoria corrente
						$tax = $wp_query->get_queried_object();
					?>

					<span class="azul-claro-acervo"><strong><?php echo $qtd; ?></strong></span> <?php echo $text; ?> <?php _e( ' para', 'locale' ); ?>: <strong> <?php echo  strip_tags (get_the_term_list(get_the_ID(), 'palavra', '', ' / ', '')); ?> </strong>

				</div>

				<div class="col-sm-8 mt-3 mb-5">

				<?php

				$tax = $wp_query->get_queried_object();

				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

				$loop = new WP_Query( array(

					'post_type' => array(

						'acervo',

					),

					'tax_query' => array(

			        array(

			        'taxonomy' => 'palavra',

			        //'paged' => $paged,

			        'field' => 'slug',

			        'terms' => $tax->slug,

			                )

			            ),

					'order' => 'ASC',

					//'posts_per_page' => 10

				  )

				);

				?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

								<?php

								$file = get_field('arquivo_acervo_digital');

								$stringSeparada = explode(".", $file['filename']);

								$type = get_post_type();

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


								?>

								<div class="row">

								<div class="col-sm-12">

									<div class="row acervo-display">

										<div class="col-sm-4 view-tag flag">

											<img src="

														<?php

													  if(get_field('substituir_capa_acervo_digital') == '' && $stringSeparada[1] == 'pdf'){

														 echo $file['icon']; 

													  }else if(get_field('substituir_capa_acervo_digital') == '' && $stringSeparada[1] == 'xlsx'){

														 echo $file['icon'];

													  }else if(get_field('substituir_capa_acervo_digital') != ''){

														 echo get_field('substituir_capa_acervo_digital'); 

													  }else{

														 echo $file['url'];

													  }

													  ?>		

													  " alt="">			

													<span class="flag-pdf-full">

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
															} else {
																echo $stringSeparada[1]; 
															}
														?>

													</span>

										</div>

										<div class="col-sm-8 mt-3 mb-3">

											<h3 class="azul-claro-acervo"><strong><?php the_title(); ?></strong></h3>

											<div class="cat-flag mb-4"><?php echo  strip_tags (get_the_term_list(get_the_ID(), 'categoria_acervo', '', ' / ', '')); ?></div>

											<p><?php the_field('descricao_acervo_digital'); ?></p>

											<p><strong>Ano de publicação:</strong>

												<?php the_field('ano_da_publicacao_acervo_digital'); ?>

												<?php
													$palavras = get_the_term_list(get_the_ID(), 'palavra', '', '  ', '');
													if($palavras) : 
												?>

													&nbsp;&nbsp;&nbsp;<strong>Palavras chaves: </strong>

												<?php endif; ?>				

											<span class="words-link">

												<?php echo  get_the_term_list(get_the_ID(), 'palavra', '', '  ', ''); 
													
													$class = generateRandomString();

													if($file['url'] != ''){
														$url = $file['url']; 
													} elseif($partional){
														$url = $partional[0];
														$stringSeparada = explode(".", $url);
													}else{
														$url = false;
													}
												?>

											</span>	

											</p>

											<div class="links-flag">

													<?php if($stringSeparada[1] == 'jpg' || $stringSeparada[1] == 'jpeg' || $stringSeparada[1] == 'png' || $stringSeparada[1] == 'gif' || $stringSeparada[1] == 'webp') : ?>

														

														<div class="modal <?php echo $class; ?>" tabindex="-1" role="dialog">
															<div class="modal-dialog" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title"><?php the_title(); ?></h5>
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
																		<h5 class="modal-title"><?php the_title(); ?></h5>
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

													<?php if($partional && !$file) : ?>
														<p class='partial-text'>* Esse documento foi dividido em partes, acesse <strong>ver detalhes</strong> para baixá-las.</p>
													<?php endif; ?>

													<a data-toggle="modal" data-target=".<?php echo $class; ?>">Visualizar</a>

													<a href="<?php the_permalink(); ?>">Ver detalhes</a>
													
													<?php if($file && !$partial) : ?>
														<a href="<?php
															if($file['url'] != ''){
																echo $file['url']; 
															}else{
																the_permalink();
															}
															?>">Baixar Arquivo</a>
													<?php endif; ?>

												</div>

											</div>

									</div>

								</div>

							</div>

				<?php endwhile;  ?>

							<div class="col-sm-12 mt-5 mb-5 text-center">

								<?php

								if(function_exists('wp_pagenavi'))

								wp_pagenavi(); ?>

							</div>

							<?php wp_reset_query(); ?>

				</div>

						<div class="col-sm-4 mt-3 mb-5">
							<p><strong>Filtros</strong></p>
							<form method="get" class="text-left" action="<?php echo esc_url( home_url( '/acervo' ) ) ?>">
								<fieldset>
									<input type="hidden" name="s" class="form-control" value="<?php echo $_GET["s"] ?>"/>
									<div class="mt-3 mb-3">
										<label for="type"><strong>Categoria:</strong></label>
										<select id="type" name="categoria_acervo" class="selectpicker form-control" data-live-search="true" onchange="form.submit()">
										   <?php $project_types = get_categories('taxonomy=categoria_acervo'); ?>
										   <option value="<?php echo $_GET["categoria_acervo"] ?>">
											   <?php
											   $cat = $_GET["categoria_acervo"];
											   $catCorrigida = str_replace('-', ' ', $cat);
											    if($_GET["categoria_acervo"] != ''){
													echo $catCorrigida;
												}else{ echo 'Selecione a categoria';}  ?>
										</option>
										   <?php foreach ($project_types as $project_type) { ?>
												<?php
													if($project_type->slug != $_GET["categoria_acervo"]){
														echo '<option value="'.$project_type->slug.'">'.$project_type->name.'</option>';
													}
												?>
										   <?php } ?>
										</select>
									</div>
									<?php /*?><div class="mt-3 mb-3">
										<label for="type"><strong>Ano de publicação</strong></label>
										<select id="ano_select_box" name="ano_da_publicacao_acervo_digital" class="selectpicker form-control" data-live-search="true" onchange="form.submit()">
											<option value="<?php echo $_GET["ano_da_publicacao_acervo_digital"] ?>">
											   <?php
											    if($_GET["ano_da_publicacao_acervo_digital"] != ''){
													echo $_GET["ano_da_publicacao_acervo_digital"];
												}else{ echo 'Selecione o ano';}  ?>
											</option>
											<?php
											$loop2 = new WP_Query( array(
												'post_type' => 'acervo',
												'posts_per_page' => -1
											  )
											);
											?>
											<?php while ( $loop2->have_posts() ) : $loop2->the_post(); ?>
											  <option value="<?php echo the_field('ano_da_publicacao_acervo_digital'); ?>">
												  <?php echo the_field('ano_da_publicacao_acervo_digital'); ?>
											  </option>
											<?php endwhile;
											wp_reset_query(); ?>
										</select>
									</div><?php */?>
									<div class="mt-3 mb-3">
										<label for="type"><strong>Ano de publicação</strong></label>
										<select id="ano_select_box" name="ano_da_publicacao_acervo_digital" class="selectpicker form-control" data-live-search="true" onchange="form.submit()">
											<option value="<?php echo $_GET["ano_da_publicacao_acervo_digital"] ?>">
											   <?php
											    if($_GET["ano_da_publicacao_acervo_digital"] != ''){
													echo $_GET["ano_da_publicacao_acervo_digital"];
												}else{ echo 'Selecione o ano';}  ?>
											</option>
											  <option value="2020">2020</option>
											  <option value="2019">2019</option>
											  <option value="2018">2018</option>
											  <option value="2017">2017</option>
											  <option value="2016">2016</option>
											  <option value="2015">2015</option>
											  <option value="2014">2014</option>
											  <option value="2013">2013</option>
											  <option value="2012">2012</option>
											  <option value="2011">2011</option>
											  <option value="2010">2010</option>
											  <option value="2009">2009</option>
											  <option value="2008">2008</option>
											  <option value="2007">2007</option>
											  <option value="2006">2006</option>
											  <option value="2005">2005</option>
											  <option value="2004">2004</option>
											  <option value="2003">2003</option>
											  <option value="2002">2002</option>
											  <option value="2001">2001</option>
											  <option value="2000">2000</option>
											wp_reset_query(); ?>
										</select>
									</div>
									
									
									
									
									
									
									<div class="mt-3 mb-3">
										<label for="type"><strong>Idioma:</strong></label>
										<select id="type" name="idioma" class="selectpicker form-control" data-live-search="true" onchange="form.submit()">
										   <?php $project_types = get_categories('taxonomy=idioma'); ?>
										   <option value="<?php echo $_GET["idioma"] ?>">
											   <?php
											   $cat = $_GET["idioma"];
											   $catCorrigida = str_replace('-', ' ', $cat);
											    if($_GET["idioma"] != ''){
													echo $catCorrigida;
												}else{ echo 'Selecione o idioma';}  ?>
										</option>
										   <?php foreach ($project_types as $project_type) { ?>
												<?php
													if($project_type->slug != $_GET["idioma"]){
														echo '<option value="'.$project_type->slug.'">'.$project_type->name.'</option>';
													}
												?>
										   <?php } ?>
										</select>
									</div>
									<div class="mt-3 mb-3">
										<label for="type"><strong>Autor:</strong></label>
										<select id="type" name="autor" class="selectpicker form-control" data-live-search="true" onchange="form.submit()">
										   <?php $project_types = get_categories('taxonomy=autor'); ?>
										   <option value="<?php echo $_GET["autor"] ?>">
											   <?php
											   $cat = $_GET["autor"];
											   $catCorrigida = str_replace('-', ' ', $cat);
											    if($_GET["autor"] != ''){
													echo $catCorrigida;
												}else{ echo 'Selecione o autor';}  ?>
										</option>
										   <?php foreach ($project_types as $project_type) { ?>
												<?php
													if($project_type->slug != $_GET["autor"]){
														echo '<option value="'.$project_type->slug.'">'.$project_type->name.'</option>';
													}
												?>
										   <?php } ?>
										</select>
									</div>
									<div class="mt-3 mb-3">
										<label for="type"><strong>Setor:</strong></label>
										<select id="type" name="setor" class="selectpicker form-control" data-live-search="true" onchange="form.submit()">
										   <?php $project_types = get_categories('taxonomy=setor'); ?>
										   <option value="<?php echo $_GET["setor"] ?>">
											   <?php
											   $cat = $_GET["setor"];
											   $catCorrigida = str_replace('-', ' ', $cat);
											    if($_GET["setor"] != ''){
													echo $catCorrigida;
												}else{ echo 'Selecione o setor';}  ?>
										</option>
										   <?php foreach ($project_types as $project_type) { ?>
												<?php
													if($project_type->slug != $_GET["setor"]){
														echo '<option value="'.$project_type->slug.'">'.$project_type->name.'</option>';
													}
												?>
										   <?php } ?>
										</select>
									</div>
								</fieldset>
							</form>
							

						</div>		

			</div>

		</div>

	</section>

</main>

<?php get_footer(); ?>