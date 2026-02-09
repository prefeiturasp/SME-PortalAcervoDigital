<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Acervo Digital</title>
	<?php wp_head(); ?>
	<?php
        $analytics = get_field('codigo','conf-analytics');
        if($analytics && $analytics != ''){
            echo $analytics;
        }
    ?>
</head>
<body>
	<header>
			<section class="row cabecalho-acessibilidade" style='display: none;'>
                <section class="container">
                    <section class="row">
                        <article class="col-lg-8 col-xs-12 d-flex justify-content-start">
                            <ul class="list-inline my-3">                                
                                <li class="list-inline-item"><a accesskey="1" id="1" href="#content" >Ir ao Conteúdo <span class="span-accesskey">1</span></a></li>
                                <li class="list-inline-item"><a accesskey="2" id="2" href="#irmenu"  >Ir para menu principal <span class="span-accesskey">2</span></a></li>
                                <li class="list-inline-item"><a accesskey="3" id="3" href="#simpleform"  >Ir para busca <span class="span-accesskey">3</span></a></li>
                                <li class="list-inline-item"><a accesskey="4" id="4" href="#irrodape"  >Ir para rodapé <span class="span-accesskey">4</span></a></li>
                                <li class="list-inline-item"><a href="<?php echo get_home_url(); ?>/acessibilidade/" accesskey="5">Acessibilidade <span class="span-accesskey">5</span> </a></li>
                            </ul>
                        </article>

                        <article class="col-lg-4 col-xs-12 d-flex justify-content-end">
                            <?php dynamic_sidebar('Rodape Esquerda') ?>
                        </article>

                    </section>
                </section>

            </section>
		<section class="sub-top-header">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<a class="mr-3" href="http://esic.prefeitura.sp.gov.br/Account/Login.aspx">Acesso à informação e-sic</a>
						<a class="mr-3" href="https://www.prefeitura.sp.gov.br/cidade/secretarias/ouvidoria/fale_com_a_ouvidoria/index.php?p=464">Ouvidoria</a>
						<a class="mr-3" href="http://transparencia.prefeitura.sp.gov.br/">Portal da Transparência</a>
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
					<div class="col-sm-3 text-center d-none d-lg-block d-xl-block">
						<a class="logo-principal" href="https://educacao.sme.prefeitura.sp.gov.br/<?php //echo get_site_url(); ?>">
						<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
							echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="Logotipo da Secretaria Municipal de Educação - Ir para a página principal">';
						?>
						</a>
					</div>
					<div class="menu-home mt-3 col-sm-9 d-none d-lg-flex d-xl-flex" id="irmenu">
						<div class="menu-item"><a href="<?php echo get_site_url(); ?>">Página Inicial</a></div>
						<?php
						wp_nav_menu( array( 
						    'theme_location' => 'menu-principal', 
						    'container_class' => 'menu-item-class' ) ); 
						?>
					</div>
					<div class='col-sm-12 d-lg-none d-xl-none p-0'>
						<nav class="navbar navbar-expand-lg navbar-dark bg-white">							
							<a class="navbar-brand" href="https://educacao.sme.prefeitura.sp.gov.br/<?php //echo get_site_url(); ?>">
								<?php
									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
									echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="Logotipo da Secretaria Municipal de Educação - Ir para a página principal">';
								?>
							</a>
							<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"><span class='d-none'>icone abrir</span></span>
								<i class="fa fa-times close-icon" aria-hidden="true"><span class='d-none'>icone fechar</span></i>
							</button>
							
							<div class="collapse navbar-collapse bg-white p-0" id="navbarCollapse">
								<div class="menu-title">
									Acervo Digital
								</div>
								<div class="menu-item"><a href="<?php echo get_site_url(); ?>">Página Inicial</a></div>
								<?php
								wp_nav_menu( array( 
									'theme_location' => 'menu-principal', 
									'container_class' => 'menu-item-class navbar-nav mr-auto' ) ); 
								?>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</section>
	</header>
	<span id='content'><p class='d-none'>inicio do conteudo</p></span>