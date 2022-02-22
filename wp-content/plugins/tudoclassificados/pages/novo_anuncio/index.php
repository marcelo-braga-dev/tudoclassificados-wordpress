<?php include_once 'src/funcoes.php'; ?>
<style>
	.categoria-anuncio {
		padding: 8px;
	}

	.categoria-anuncio.active {
		border-radius: 5px;
	}

	.radio-categoria {
		color: #495057;
		font-weight: 300;
		padding: 8px !important;
	}

	.radio-categoria:hover {
		background-color: #f8f9fa;
		cursor: pointer;
	}

	.radio-categoria-ativo,
	.radio-categoria-ativo:hover {
		color: white;
		background-color: var(--principal);
		padding: 8px !important;
		border-radius: 5px;
		color: white !important;
	}

	.categoria-novo-anunio {
		font-size: 14px;
	}
</style>
<?php
$premium_imoveis = bs4t_user_is_premium('imoveis');

if (!empty($_POST['cep-usuario'])) {
	set_cep_usuario($_POST['cep-usuario']);
}

$user_meta = get_user_meta(get_current_user_id());

if (empty($user_meta['cep'][0])) : ?>
	<form method="POST">
		<div class="form-row justify-content-center">
			<div class="col-10 col-md-auto mt-5">
				<span>Por favor, antes de começar, insira o seu cep:</span>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text" for="cep-usuario">Cep</div>
					</div>
					<input type="text" class="form-control" name="cep-usuario" id="cep-usuario" data-mask="00000-000" pattern="[0-9]{5}-[0-9]{3}" placeholder="00000-000" required>
				</div>
			</div>
		</div>
		<div class="form-row justify-content-center">
			<div class="col-10 col-md-auto">
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
		</div>
	</form>
<?php
else :
?>
	<div class="row mt-3">
		<div class="col-12">
			<div class="row justify-content-end text-end mb-2">
				<div class="col-auto">
					<small class="text-muted">
						Anunciar com:
					</small>
				</div>
				<div class="col-auto">
					<a href="/minha-conta">
						<img height="25px" src="/wp-content/plugins/tudoclassificados/imagens/logo-bling.png" style="height: 25px;">
					</a>
				</div>
				<div class="col-auto">
					<a href="/minha-conta">
						<img src="/wp-content/plugins/tudoclassificados/imagens/logo-inGaia.png" style="height: 25px;">
					</a>
				</div>
			</div>
		</div>
		<form action="<?= esc_url(acadp_get_listing_form_page_link()); ?>" method="post">
			<!-- TÍTULO DO ANÚNCIO -->
			<div class="card mb-3">
				<div class="card-body">
					<div class="form-group bmd-form-group">
						<label class="bmd-label-static">Título do Anúncio</label>
						<input type="text" class="form-control" name="title" id="acadp-title" value="<?php if ($post_id > 0) echo esc_attr($post->post_title); ?>" required />
					</div>
				</div>
			</div>

			<?php if (!$post_id) : ?>
				<div class="card mb-3">
					<div class="card-body">
						<h5>Categoria do Anúncio</h5>
						<?php bs4t_aba_categorias('acadp_category') ?>
					</div>
				</div>
			<?php else : ?>
				<input type="number" class="acadp-category-listing d-none" name="acadp_category" id="categoria-anuncio" value="<?= $category ?>" required>
			<?php endif ?>

			<!-- DESCRICAO DO ANÚNCIO -->
			<div class="card mb-3">
				<div class="card-body">
					<h6>Descrição do Anúncio</h6>
					<!-- init custon filelds-->
					<div class="form-row" id="acadp-custom-fields-listings" data-post_id="<?= esc_attr($post_id); ?>">
						<?php do_action('wp_ajax_acadp_public_custom_fields_listings', $post_id); ?>
					</div>

					<div class="form-group pt-0">
						<span>Descrição</span>

						<?php
						$post_content = ($post_id > 0) ? $post->post_content  : '';

						$post_content = strip_tags(preg_replace('/\<br\>|\<\/p\>/', "\n", $post_content));

						if (is_admin()) { // Fix for Gutenberg
							$editor = 'textarea';
						}

						if ('textarea' == $editor) {
							printf('<textarea name="%s" class="form-control" rows="13" placeholder="Insira a descrição do anúncio aqui..." required>%s</textarea>', 'description', esc_textarea($post_content));
						} else {
							wp_editor(
								wp_kses_post($post_content),
								'description',
								array(
									'media_buttons' => false,
									'quicktags'     => true,
									'editor_height' => 200
								)
							);
						}
						?>
					</div>
				</div>
			</div>

			<!-- PRECO -->
			<div class="card mb-3">
				<div class="card-body">
					<div class="form-row">
						<div class="col-md-3 mx-4">
							<label for="acadp-price">Preço</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">R$</div>
								</div>
								<input type="text" class="form-control" data-type="currency" step="0.01" name="price" id="acadp-price" placeholder="0,00" style="text-align:right" value="<?php if (isset($post_meta['price'])) echo esc_attr(str_replace('.', ',', $post_meta['price'][0])); ?>" required />
							</div>
						</div>
						<div class="col-md-4">
							<label>Estado</label>
							<select name="estado" id="estados" class="form-control select2" required></select>
						</div>

						<div class="col-md-4">
							<label>Cidade</label>
							<select name="cidade" id="cidades" class="form-control select2" required></select>
						</div>

						<!--
				<div class="col-md-4">
					<div class="form-group">
						<label for="acadp_location">Região</label>
						<?php
						acadp_dropdown_terms(array(
							'show_option_none'  => '-- ' . esc_html__('Selecionar Região', 'advanced-classifieds-and-directory-pro') . ' --',
							'option_none_value' => '', //(int) $general_settings['base_location'],
							'base_term'         => max(0, (int) $general_settings['base_location']),
							'parent'            => max(0, (int) $general_settings['base_location']),
							'taxonomy'          => 'acadp_locations',
							'name'              => 'acadp_location',
							'class'             => 'form-control acadp-map-field',
							'required'          => true,
							'orderby'           => sanitize_text_field($locations_settings['orderby']),
							'order'             => sanitize_text_field($locations_settings['order']),
							'selected'          => (int) $location
						));
						?>
					</div>
					
				</div>-->
					</div>
				</div>
			</div>

			<!-- Dimensoes -->
			<div class="card mb-3">
				<div class="card-body">
					<div class="row mb-3">
						<h6 class="col-12">Dimensões do Produto para Cálculo de Frete</h6>
						<!-- Altura -->
						<div class="col-6 col-md-2">
							<label><small>Altura</small></label>
							<div class="input-group">
								<input type="number" class="form-control dimensionamento" name="altura" value="<?= isset($post_meta['altura']) ? $post_meta['altura'][0] : '' ?>" required>
								<div class="input-group-append">
									<div class="input-group-text">cm</div>
								</div>
							</div>
						</div>
						<!-- Largura -->
						<div class="col-6 col-md-2">
							<label><small>Largura</small></label>
							<div class="input-group">
								<input type="text" class="form-control dimensionamento" name="largura" value="<?= isset($post_meta['largura']) ? $post_meta['largura'][0] : '' ?>" required>
								<div class="input-group-append">
									<div class="input-group-text">cm</div>
								</div>
							</div>
						</div>
						<!-- Comprimento -->
						<div class="col-6 col-md-2">
							<label><small>Comprimento</small></label>
							<div class="input-group">
								<input type="text" class="form-control dimensionamento" name="comprimento" value="<?= isset($post_meta['comprimento']) ? $post_meta['comprimento'][0] : '' ?>" required>
								<div class="input-group-append">
									<div class="input-group-text">cm</div>
								</div>
							</div>
						</div>
						<!-- Comprimento -->
						<div class="col-6 col-md-2">
							<label><small>Peso do Produto</small></label>
							<div class="input-group">
								<input type="text" class="form-control dimensionamento" name="peso" value="<?= isset($post_meta['peso']) ? $post_meta['peso'][0] : '' ?>" required>
								<div class="input-group-append">
									<div class="input-group-text">kg</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group form-check">
								<input type="checkbox" class="form-check-input" id="frete-gratis" name="frete-gratis" value="S" style="font-size: 16px !important;">
								<label class="form-check-label" style="font-size: 16px !important; color: black !important" for="frete-gratis">Oferecer frete grátis</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- IMAGENS -->
			<?php if (!$post_meta['origem']) : ?>
				<div class="card mb-3">
					<div class="card-body">
						<?php if ($can_add_images) : ?>
							<!-- Images -->
							<div class="panel panel-default">
								<div class="panel-heading bg-white"><?php esc_html_e('Images', 'advanced-classifieds-and-directory-pro'); ?></div>

								<div class="panel-body bg-white">
									<?php if ($images_limit > 0) : ?>
										<p class="help-block">
											<strong>Observações:</strong>:
											<?php printf(esc_html__('You can upload up to %d images', 'advanced-classifieds-and-directory-pro'), $images_limit); ?>
										</p>
									<?php endif; ?>

									<table class="acadp-images bg-white" id="acadp-images" data-exist="true">
										<tbody>
											<?php
											$disable_image_upload_attr = '';

											if (isset($post_meta['images'])) {
												$images = unserialize($post_meta['images'][0]);
												foreach ($images as $index => $image) {
													$image_attributes = wp_get_attachment_image_src($images[$index]);

													if (isset($image_attributes[0])) {
														echo '<tr class="acadp-image-row">' .
															'<td class="acadp-handle"><span class="glyphicon glyphicon-th-large"><i class="bi bi-chevron-bar-expand"></i></span></td>' .
															'<td class="acadp-image">' .
															'<img src="' . esc_url($image_attributes[0]) . '" />' .
															'<input type="hidden" class="acadp-image-field" name="images[]" value="' . esc_attr($images[$index]) . '" required />' .
															'</td>' .
															'<td>' .
															'<span class="acadp-image-url">' . esc_html($image_attributes[0]) . '</span><br />' .
															'<a href="javascript:void(0);" class="acadp-delete-image" data-attachment_id="' . esc_attr($images[$index]) . '">' . esc_html__('Delete Permanently', 'advanced-classifieds-and-directory-pro') . '</a>' .
															'</td>' .
															'</tr>';
													}
												}
												if (count($images) >= $images_limit) {
													$disable_image_upload_attr = ' disabled';
												}
											}
											?>
										</tbody>
									</table>
									<div id="acadp-progress-image-upload"></div>
									<a href="javascript:void(0);" class="btn btn-primary" id="acadp-upload-image" data-limit="<?= esc_attr($images_limit); ?>" <?= $disable_image_upload_attr; ?>><?php esc_html_e('Upload Image', 'advanced-classifieds-and-directory-pro'); ?></a>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif ?>

			<!-- Contato -->
			<div class="card mb-3">
				<div class="card-body">
					<div class="row">
						<h6 class="col-12">Contato</h6>
						<div class="col-md-6">
							<div class="form-group bmd-form-group">
								<label for="acadp-phone"><small>Whatsapp para contato com clientes</small></label>
								<input type="text" name="phone" id="acadp-phone" class="form-control" placeholder="(00) 0 0000-0000" data-mask="(00) 0 0000-0000" value="<?= isset($post_meta['phone']) ? esc_attr($post_meta['phone'][0]) : get_user_meta(get_current_user_id(), 'celular')[0] ?>" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group bmd-form-group">
								<label class="control-label" for="acadp-email"><small>E-mail</small></label>
								<input type="email" name="email" id="acadp-email" class="form-control" value="<?= esc_attr($email); ?>" required />
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Video -->
			<?php if ($premium_imoveis) : ?>
			<?php endif; ?>
			<div class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-static"><small>Vídeo</small></label>
								<input type="text" name="video" id="acadp-video" class="form-control" placeholder="Somente Vídeos do YouTube" value="<?php if (isset($post_meta['video'])) echo esc_attr($post_meta['video'][0]); ?>" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group bmd-form-group">
								<label class="control-label" for="acadp-website"><small>Link do Site de Venda</small></label>
								<input type="text" name="website" id="acadp-website" class="form-control" placeholder="https://" value="<?php if (isset($post_meta['website'])) echo esc_attr($post_meta['website'][0]); ?>" />
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- MAPA -->
			<?php if ($premium_imoveis) : ?>
			<?php endif; ?>
			<div class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" name="hide_map" value="1" <?php if (isset($post_meta['hide_map'])) checked($post_meta['hide_map'][0], 1); ?>>
									Não inserir mapa no anúncio.
									<span class="form-check-sign">
										<span class="check"></span>
									</span>
								</label>
							</div>
							<div class="acadp-map embed-responsive embed-responsive-16by9 bg-white" data-type="form">
								<?php
								$latitude  = isset($post_meta['latitude'])  ? esc_attr($post_meta['latitude'][0])  : '-16.46769474828896';
								$longitude = isset($post_meta['longitude']) ? esc_attr($post_meta['longitude'][0]) : '-36.826171875';
								?>
								<div class="marker" data-latitude="<?= $latitude; ?>" data-longitude="<?= $longitude; ?>"></div>
							</div>
							<input type="hidden" id="acadp-default-location" value="<?= esc_attr($default_location); ?>" />
							<input type="hidden" id="acadp-latitude" name="latitude" value="<?= $latitude; ?>" />
							<input type="hidden" id="acadp-longitude" name="longitude" value="<?= $longitude; ?>" />
						</div>
					</div>
				</div>
			</div>

			<!-- Display errors -->
			<!-- <div class="alert alert-danger mt-3" role="alert" style="display: none;"> -->
			<div class="row alert alert-danger" id="alerta-erros" style="display: none;">
				<div class="col-auto align-items-center">
					<h4><i class="bi bi-exclamation-diamond" style="font-size: 22px;"></i></h4>
				</div>
				<div class="col-auto align-items-center" id="mensagem-erro">
					<span><b>Anúncio não publicado por falta de imagens.</b></span><br>
					<small class="text-white">Insira imagens nesse anúncio, clicando no botão editar.</small>
				</div>
			</div>
			<!-- </div> -->

			<!-- BOTOES -->
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="panel-body bg-white">
							<?php if ($mark_as_sold) : ?>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="sold" value="1" <?php if (isset($post_meta['sold'])) checked($post_meta['sold'][0], 1); ?>>
										<?php esc_html_e("Mark as", 'advanced-classifieds-and-directory-pro'); ?>&nbsp;
										<strong><?= esc_html($general_settings['sold_listing_label']); ?></strong>
									</label>
								</div>
							<?php endif; ?>

							<?= the_acadp_terms_of_agreement(); ?>

							<?php if ($post_id == 0) : ?>
								<div id="acadp-listing-g-recaptcha"></div>
								<div id="acadp-listing-g-recaptcha-message" class="help-block text-danger"></div>
							<?php endif; ?>

							<?php wp_nonce_field('acadp_save_listing', 'acadp_listing_nonce'); ?>
							<input type="hidden" name="post_type" value="acadp_listings" />

							<?php /*if ($has_draft) : ?>
						<input type="submit" name="action" class="btn btn-default acadp-listing-form-submit-btn" value="<?php esc_html_e('Save Draft', 'advanced-classifieds-and-directory-pro'); ?>" />
					<?php endif;*/ ?>

							<?php if ($post_id > 0) : ?>
								<input type="hidden" name="post_id" id="post_id" value="<?= esc_attr($post_id); ?>" />
								<!-- <a href="< ?= esc_url(get_permalink($post_id)); ?>" class="btn btn-default" target="_blank"><?php esc_html_e('Preview', 'advanced-classifieds-and-directory-pro'); ?></a> -->
							<?php endif;  ?>

							<?php if ($has_draft) { ?>
								<input type="submit" name="action" id="id-avancar" class="btn btn-primary pull-right acadp-listing-form-submit-btn" value="Publicar Anúncio" />
							<?php } else { ?>
								<input type="submit" name="action" id="id-avancar" class="btn btn-primary pull-right acadp-listing-form-submit-btn btn-lg" value="<?php esc_html_e('Save Changes', 'advanced-classifieds-and-directory-pro'); ?>" />
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- CARREGA IMAGENS -->
	<form id="acadp-form-upload" class="hidden" method="post" action="#" enctype="multipart/form-data">
		<input type="file" multiple name="acadp_image[]" id="acadp-upload-image-hidden" style="display: none;" />
		<input type="hidden" name="action" value="acadp_public_image_upload" />
		<?php wp_nonce_field('acadp_upload_images', 'acadp_images_nonce'); ?>
	</form>

	<div class="acadp acadp-user acadp-post-form">
	</div>

	<script>
		var estado = '<?= $post_meta['estado'][0] ?>';
		var cidade = '<?= $post_meta['cidade'][0] ?>';
	</script>

<?php
endif;
function bs4t_adicionando_script()
{
?>
	<script src="/wp-content/plugins/tudoclassificados/assets/js/currency.js"></script>
	<script src="/wp-content/plugins/tudoclassificados/assets/js/cidade-estado-select/main.js?id=<?= uniqid() ?>"></script>
	<script src="/wp-content/plugins/tudoclassificados/pages/tudoclassificados/pages/novo_anuncio/assets/js/principal.js?id=<?= uniqid() ?>"></script>
<?php
}
add_action('wp_footer', 'bs4t_adicionando_script', 101);
?>

<!-- Hook for developers to add new fields -->
<?php do_action('acadp_listing_form_fields'); ?>