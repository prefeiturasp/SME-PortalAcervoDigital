<div id="simpleform">
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<fieldset>
		<?php
				$search = get_search_query();
				if($search && $search != ''){
					$value = 'value="' . $search . '"';
				} else {
					$value = '';
				}
				
			?>
		<div class="row" >
			<div class="col-sm-12 mb-2"><span class='d-none'>campo de busca</span><label for="busca1" class='d-none'>Busque por título</label><input type="text" id='busca1' minlength="3" class="form-control search-field campo-busca" placeholder="Busque por título de documento ou palavra-chave" <?php echo $value; ?> name="s" /></div>
			<div class="col-sm-12 text-right">
				<button type="button" class="btn btn-outline-primary btn-avanc btn-avanc-m d-lg-none d-xl-none" data-toggle="modal" data-target="#buscaAvanc">
					Busca avançada
				</button>
				<a id="show" class='btn btn-outline-primary btn-avanc'>Busca avançada</a> 
				<button type="submit" class="btn btn-primary search-submit">Buscar</button>			
			</div>
		</div>
	</fieldset>
</form>
</div>

<div id="advancedform" style="display: none">
<form method="get" class="text-left" action="<?php echo esc_url( home_url( '/' ) ) ?>">
		<input type="hidden" name="avanc" value='1'>
		<div class="row">
			<div class="col-sm-12 p-4">
				<div class="row">
					<div class="col-sm-12 mt-2 mb-2">
						<label for="busca2" class='d-none'>Busque por título</label>
						<input id="busca2" type="search" minlength="3" name="s" class="form-control campo-busca-avanc" value="" placeholder="Busque por título de documento ou palavra-chave"/>
						<div class="alert alert-danger mt-2" role="alert" id="empty-field" style="display: none;">
							Preencha o campo acima ou selecione uma opção abaixo.
						</div>
					</div>
					<div class="col-sm-6 mt-2 mb-2">
						<label for="type">Categoria:</label>
						<select id="type" name="categ_acervo" class="selectpicker form-control" data-live-search="true">
						   <?php $project_types = get_categories('taxonomy=categoria_acervo'); ?>
						   <option value="">Selecione a categoria</option>
						   <?php foreach ($project_types as $project_type) { ?>
							  <option value="<?php echo $project_type->slug; ?>">
								 <?php echo $project_type->name; ?>
							  </option>
						   <?php } ?>
						</select>
					</div>
					<div class="col-sm-6 mt-2 mb-2">
						<label for="type">Palavra Chave:</label>
						<select id="type" name="palavrab" class="selectpicker form-control" data-live-search="true">
						   <?php $project_types = get_categories('taxonomy=palavra'); ?>
						   <option value="">Escreva a palavra chave</option>
						   <?php foreach ($project_types as $project_type) { ?>
							  <option value="<?php echo $project_type->slug; ?>">
								 <?php echo $project_type->name; ?>
							  </option>
						   <?php } ?>
						</select>
					</div>
					<div class="col-sm-3 mt-2 mb-2">
						<?php /*?><label for="type">Mês de publicação</label>
						<select id="type" name="s" class="selectpicker form-control" data-live-search="true">
							<option value="">Selecione o mês</option>
							  <option value="01">Janeiro</option>
							  <option value="02">Fevereiro</option>
							  <option value="03">Março</option>
						</select><?php */?>
						<label for="type">Idioma da publicação</label>
						<select id="type" name="idiomab[]" class="selectpicker form-control" data-live-search="true">
						   <?php $project_types = get_categories('taxonomy=idioma'); ?>
						   <option value="">Selecione o idioma</option>
						   <?php foreach ($project_types as $project_type) { ?>
							  <option value="<?php echo $project_type->slug; ?>">
								 <?php echo $project_type->name; ?>
							  </option>
						   <?php } ?>
						</select>
					</div>
					<div class="col-sm-3 mt-2 mb-2">
						<label for="type">Ano de publicação</label>
						<select id="ano_select" name="anob[]" class="selectpicker form-control" data-live-search="true" >
							<?php
							$loop = new WP_Query( array(
								'post_type' => 'acervo',
								'posts_per_page' => -1,
								'meta_key' => 'ano_da_publicacao_acervo_digital',
								'orderby' => 'meta_value',
								'order'	=> 'DESC'
							  )
							);
							?>
							<option value="">Selecione o ano</option>
							<?php while ( $loop->have_posts() ) : $loop->the_post();
								$ano = get_field('ano_da_publicacao_acervo_digital');
								if($ano != ''):
							?>
							  <option value="<?php echo the_field('ano_da_publicacao_acervo_digital'); ?>">
								  <?php echo the_field('ano_da_publicacao_acervo_digital'); ?>
							  </option>
							<?php 
								endif;
								endwhile;
							wp_reset_query(); ?>
						</select>
					</div>
					<div class="col-sm-3 mt-2 mb-2">
						<label for="type">Setor responsável</label>
						<select id="type" name="setorb[]" class="selectpicker form-control" data-live-search="true">
						   <?php $project_types = get_categories('taxonomy=setor'); ?>
						   <option value="">Selecione o setor</option>
						   <?php foreach ($project_types as $project_type) { ?>
							  <option value="<?php echo $project_type->slug; ?>">
								 <?php echo $project_type->name; ?>
							  </option>
						   <?php } ?>
						</select>
					</div>
					<div class="col-sm-3 mt-2 mb-2">
						<label for="type">Autor:</label>
						<select id="type" name="autorb" class="selectpicker form-control" data-live-search="true">
						   <?php $project_types = get_categories('taxonomy=autor'); ?>
						   <option value="">Escreva o nome do autor</option>
						   <?php foreach ($project_types as $project_type) { ?>
							  <option value="<?php echo $project_type->slug; ?>">
								 <?php echo $project_type->name; ?>
							  </option>
						   <?php } ?>
						</select>
					</div>

					<div class="col-sm-12 mt-2 mb-2 text-right">						
						<a id="hide" class="btn btn-outline-primary btn-avanc">Busca simples</a>
						<button class="btn btn-primary search-submit" type="submit">Refinar busca</button>
					</div>
				</div>
			</div>			
		</div>
</form>
</div>

<!-- Modal -->
<div class="modal right fade" id="buscaAvanc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<p class="modal-title" id="myModalLabel2">Busca Avançada</p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>				
			</div>

			<div class="modal-body">
				<form method="get" class="text-left" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					
						<div class="row">
							<div class="col-sm-12 px-4">
								<div class="row">
									<div class="col-sm-12 mt-2 mb-2">
										<label for="busca3" class='d-none'>Busque por título</label>
										<input id="busca3" type="search" minlength="3" name="s" class="form-control campo-busca-avanc" value="" placeholder="Busque por título de documento ou palavra-chave"/>
										<div class="alert alert-danger mt-2" role="alert" id="empty-field-mob" style="display: none;">
											Preencha o campo acima ou selecione uma opção abaixo.
										</div>
									</div>
									<div class="col-sm-12 mt-2 mb-2">
										<label for="busca4">Categoria:</label>
										<select id="busca4" name="categ_acervo" class="selectpicker form-control" data-live-search="true">
										<?php $project_types = get_categories('taxonomy=categoria_acervo'); ?>
										<option value="">Selecione a categoria</option>
										<?php foreach ($project_types as $project_type) { ?>
											<option value="<?php echo $project_type->slug; ?>">
												<?php echo $project_type->name; ?>
											</option>
										<?php } ?>
										</select>
									</div>
									<div class="col-sm-12 mt-2 mb-2">
										<label for="busca5">Palavra Chave:</label>
										<select id="busca5" name="palavrab" class="selectpicker form-control" data-live-search="true">
										<?php $project_types = get_categories('taxonomy=palavra'); ?>
										<option value="">Escreva a palavra chave</option>
										<?php foreach ($project_types as $project_type) { ?>
											<option value="<?php echo $project_type->slug; ?>">
												<?php echo $project_type->name; ?>
											</option>
										<?php } ?>
										</select>
									</div>
									<div class="col-sm-12 mt-2 mb-2">
										<?php /*?><label for="type">Mês de publicação</label>
										<select id="type" name="s" class="selectpicker form-control" data-live-search="true">
											<option value="">Selecione o mês</option>
											<option value="01">Janeiro</option>
											<option value="02">Fevereiro</option>
											<option value="03">Março</option>
										</select><?php */?>
										<label for="busca6">Idioma da publicação</label>
										<select id="busca6" name="idiomab" class="selectpicker form-control" data-live-search="true">
										<?php $project_types = get_categories('taxonomy=idioma'); ?>
										<option value="">Selecione o idioma</option>
										<?php foreach ($project_types as $project_type) { ?>
											<option value="<?php echo $project_type->slug; ?>">
												<?php echo $project_type->name; ?>
											</option>
										<?php } ?>
										</select>
									</div>
									<div class="col-sm-12 mt-2 mb-2">
										<label for="ano_select">Ano de publicação</label>
										<select id="ano_select" name="ano_da_publicacao_acervo_digital" class="selectpicker form-control" data-live-search="true" >
											<?php
											$loop = new WP_Query( array(
												'post_type' => 'acervo',
												'posts_per_page' => -1
											)
											);
											?>
											<option value="">Selecione o ano</option>
											<?php while ( $loop->have_posts() ) : $loop->the_post(); 
												$ano = get_field('ano_da_publicacao_acervo_digital');
												if($ano != ''):
											?>
												<option value="<?php echo the_field('ano_da_publicacao_acervo_digital'); ?>">
													<?php echo the_field('ano_da_publicacao_acervo_digital'); ?>
												</option>
											<?php 
												endif;
												endwhile;
											wp_reset_query(); ?>
										</select>
									</div>
									<div class="col-sm-12 mt-2 mb-2">
										<label for="busca7">Setor responsável</label>
										<select id="busca7" name="setor" class="selectpicker form-control" data-live-search="true">
										<?php $project_types = get_categories('taxonomy=setor'); ?>
										<option value="">Selecione o setor</option>
										<?php foreach ($project_types as $project_type) { ?>
											<option value="<?php echo $project_type->slug; ?>">
												<?php echo $project_type->name; ?>
											</option>
										<?php } ?>
										</select>
									</div>
									<div class="col-sm-12 mt-2 mb-2">
										<label for="busca8">Autor:</label>
										<select id="busca8" name="autorb" class="selectpicker form-control" data-live-search="true">
										<?php $project_types = get_categories('taxonomy=autor'); ?>
										<option value="">Escreva o nome do autor</option>
										<?php foreach ($project_types as $project_type) { ?>
											<option value="<?php echo $project_type->slug; ?>">
												<?php echo $project_type->name; ?>
											</option>
										<?php } ?>
										</select>
									</div>

									<div class="col-sm-12 mt-2 mb-2 text-right">										
										<button class="btn btn-primary search-submit-mob" type="submit">Buscar</button>
									</div>
								</div>
							</div>			
						</div>
				</form>
			</div>

		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal -->