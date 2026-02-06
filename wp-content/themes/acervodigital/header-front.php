<!DOCTYPE html>

<html lang="pt-br">

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Acervo Digital</title>

	<?php wp_head(); ?>

</head>

<body>

	<header>

		<section class="top-header">

			<div class="container">

				<div class="row">

					<div class="col-6">

						Menu acessibilidade

					</div>

					<div class="col-6 text-right">

						Menu acessibilidade

					</div>

				</div>

			</div>

		</section>

		<section class="sub-top-header">

			<div class="container">

				<div class="row">

					<div class="col-6">

						<a class="mr-3" href="http://transparencia.prefeitura.sp.gov.br/acesso-a-informacao">Acesso à informação e-sic</a>

						<a class="mr-3" href="https://www.prefeitura.sp.gov.br/cidade/secretarias/ouvidoria/fale_com_a_ouvidoria/index.php?p=464">Ouvidoria</a>

						<a class="mr-3" href="http://transparencia.prefeitura.sp.gov.br/Paginas/home.aspx">Portal da Transparência</a>

						<a class="mr-3" href="https://sp156.prefeitura.sp.gov.br/portal/servicos">SP 156</a>

					</div>

					<div class="col-6 text-right">
						<?php 
							$facebook = get_field('url_facebook','conf-rodape');
							$instagram = get_field('url_instagram','conf-rodape');
							$twitter = get_field('url_twitter','conf-rodape');
							$youtube = get_field('url_youtube','conf-rodape');
						?>
                            
						<?php if($facebook) : ?>							
							<div class="footer-social">
								<a href="<?php the_field('url_facebook','conf-rodape'); ?>">
									<img src="<?php echo get_bloginfo('template_directory') ?>/images/icone-facebook-topo.png" width="15" alt="Ir para Facebook da Prefeitura de São Paulo">
								</a>
							</div>
						<?php endif; ?>
						<?php if($instagram) : ?>
							<div class="footer-social">
								<a href="<?php the_field('url_instagram','conf-rodape'); ?>">
									<img src="<?php echo get_bloginfo('template_directory') ?>/images/icone-instagram-topo.png" width="15" alt="Ir para Instagram da Prefeitura de São Paulo">
								</a>
							</div>
						<?php endif; ?>
						<?php if($twitter) : ?>
							<div class="footer-social">
								<a href="<?php the_field('url_twitter','conf-rodape'); ?>">
									<img src="<?php echo get_bloginfo('template_directory') ?>/images/icone-twitter-topo.png" width="15" alt="Ir para Twitter da Prefeitura de São Paulo">
								</a>
							</div>
						<?php endif; ?>
						<?php if($youtube) : ?>
							<div class="footer-social">
								<a href="<?php the_field('url_youtube','conf-rodape'); ?>">
									<img src="<?php echo get_bloginfo('template_directory') ?>/images/icone-youtube-topo.png" width="15" alt="Ir para YouTube da Prefeitura de São Paulo">
								</a>
							</div>
						<?php endif; ?>  						
					</div>

				</div>

			</div>

		</section>

		<section>

			<div class="container pt-3 pb-5">

				<div class="row">

					<div class="col-sm-3 text-center">

						<a class="logo-principal" href="https://educacao.sme.prefeitura.sp.gov.br/<?php //echo get_site_url(); ?>">

						<?php

							$custom_logo_id = get_theme_mod( 'custom_logo' );

							$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );

							echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="Logotipo da Secretaria Municipal de Educação - Ir para a página principal">';

						?>

						</a>

					</div>

					<div class="menu-home mt-3 col-sm-9">

						<?php

						wp_nav_menu( array( 

						    'theme_location' => 'menu-principal', 

						    'container_class' => 'menu-item-class' ) ); 

						?>

					</div>

				</div>

			</div>

		</section>

	</header>