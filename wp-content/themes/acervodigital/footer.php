<footer style="background: #363636; color: #fff;">
	<div class="container pt-3 pb-3" id="irrodape">
		<div class="row">
			<div class="col-sm-3 align-middle d-flex align-items-center">
				<a href="https://www.capital.sp.gov.br/"><img src="<?php the_field('logo_prefeitura','conf-rodape'); ?>" alt="<?php bloginfo('name'); ?>" class="img-fluid"></a>
			</div>
			<div class="col-sm-3 align-middle bd-contact">
				<h2 class='pt-3'><?php the_field('nome_da_secretaria','conf-rodape'); ?></h2>
				<i class="fa fa-map-marker float-left pr-1" aria-hidden="true" style="padding-top: 3px;"><span class='d-none'>icone telefone</span></i> <?php the_field('endereco_da_secretaria','conf-rodape'); ?>
			</div>
			<div class="col-sm-3 align-middle">
				<h2 class='pt-3'>Contatos</h2>
				
				<?php if(get_field('telefone','conf-rodape')) :?>
					<p><i class="fa fa-phone" aria-hidden="true"><span class='d-none'>icone telefone</span></i> <a href="tel:<?php the_field('telefone','conf-rodape'); ?>"><?php the_field('telefone','conf-rodape'); ?></a></p>
				<?php endif; ?>
				
				
				<?php if(get_field('email','conf-rodape')) :?>
					<p><i class="fa fa-envelope" aria-hidden="true"><span class='d-none'>icone email</span></i> <a href="mailto:<?php the_field('email','conf-rodape'); ?>"><?php the_field('email','conf-rodape'); ?></a></p>
				<?php endif; ?>
				
				
			</div>
			<div class="col-sm-3 align-middle">	
			<h2 class='pt-3'>Redes sociais</h2>
				<?php 
					$facebook = get_field('icone_facebook','conf-rodape');
					$instagram = get_field('icone_instagram','conf-rodape');
					$twitter = get_field('icone_twitter','conf-rodape');
					$youtube = get_field('icone_youtube','conf-rodape');
				?>
				<div class="row redes-footer">

					<?php if($facebook) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_facebook','conf-rodape'); ?>">
							<img src="<?php echo $facebook; ?>" alt="Facebook"></a>
						</div>
					<?php endif; ?>

					<?php if($instagram) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_instagram','conf-rodape'); ?>">
							<img src="<?php echo $instagram; ?>" alt="Instagram"></a>
						</div>
					<?php endif; ?>

					<?php if($twitter) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_twitter','conf-rodape'); ?>">
							<img src="<?php echo $twitter; ?>" alt="Twitter"></a>
						</div>
					<?php endif; ?>

					<?php if($youtube) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_youtube','conf-rodape'); ?>">
							<img src="<?php echo $youtube; ?>" alt="YouTube"></a>
						</div>
					<?php endif; ?>
				</div>				
			</div>
		</div>
	</div>
</footer>
<div class="subfooter rodape-api-col">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<p>Prefeitura Municipal de São Paulo - Viaduto do Chá, 15 - Centro - CEP: 01002-020</p>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?> 
<script>
	document.onkeyup = PresTab;
 
	function PresTab(e)	{
		var keycode = (window.event) ? event.keyCode : e.keyCode;
		

		if (keycode == 9){
			jQuery('.cabecalho-acessibilidade').show();	
			jQuery(" a[accesskey='1']").focus();
			document.onkeyup = null;
		}
	}

	var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
	triggerTabList.forEach(function (triggerEl) {
		var tabTrigger = new bootstrap.Tab(triggerEl)

		triggerEl.addEventListener('click', function (event) {
			event.preventDefault()
			tabTrigger.show()
		})
	})
</script>
<noscript>Seu navegador não suporta JavaScript!</noscript>
</body>
</html>