<div class="acadp acadp-user acadp-post-form">
      <form action="<?php echo esc_url(acadp_get_listing_form_page_link()); ?>" method="post" id="acadp-post-form" class="form-vertical" role="form">
            <!-- Display errors -->
            <div id="acadp-post-errors" class="alert alert-danger" role="alert" style="display: none;">
                  <?php esc_html_e('Please fill in all required fields.', 'advanced-classifieds-and-directory-pro'); ?>
            </div>

            <!-- Choose category -->
            <div class="panel panel-default">
                  <div class="panel-heading bg-white"><?php esc_html_e('Choose category', 'advanced-classifieds-and-directory-pro'); ?></div>

                  <div class="panel-body bg-white">
                        <div class="form-group">
                              <label class="col-md-3 control-label" for="acadp_category"><b><?php esc_html_e('Category', 'advanced-classifieds-and-directory-pro'); ?></b><span class="acadp-star">*</span></label>
                              <div class="col-md-6">
                                    <?php
                                    $args = array(
                                          'show_option_none'  => '-- ' . esc_html__('Select category', 'advanced-classifieds-and-directory-pro') . ' --',
                                          'option_none_value' => '',
                                          'taxonomy'          => 'acadp_categories',
                                          'name'                       => 'acadp_category',
                                          'class'             => 'form-control acadp-category-listing',
                                          'required'          => true,
                                          'orderby'           => sanitize_text_field($categories_settings['orderby']),
                                          'order'             => sanitize_text_field($categories_settings['order']),
                                          'selected'          => (int) $category
                                    );

                                    if ($disable_parent_categories) {
                                          $args['walker'] = new ACADP_Walker_CategoryDropdown;
                                    }

                                    echo apply_filters('acadp_listing_form_categories_dropdown', acadp_dropdown_terms($args, false), $post_id);
                                    ?>
                              </div>
                        </div>
                  </div>
            </div>

            <?php if ($can_add_price) : ?>
                  <!-- Your price -->
                  <div class="panel panel-default bg-white">
                        <div class="panel-heading bg-white">Pre??o
                              <!--<?php printf('%s [%s]', esc_html__("Your price", 'advanced-classifieds-and-directory-pro'), acadp_get_currency()); ?>-->
                        </div>

                        <div class="panel-body">
                              <div class="row">
                                    <div class="col-md-12">
                                          <label class="control-label" for="acadp-price"><?php esc_html_e('How much do you want it to be listed for?', 'advanced-classifieds-and-directory-pro'); ?></label>
                                    </div>
                                    <div class="col-6 col-md-3">
                                          <div class="form-group">
                                                <input type="text" data-type='currency' step="0.01" name="price" id="acadp-price" class="form-control" placeholder="R$ 0,00" style="text-align:right" value="<?php if (isset($post_meta['price'])) echo esc_attr($post_meta['price'][0]); ?>" required />
                                          </div>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-12">
                                          <p class="help-block"><?php esc_html_e('You can adjust your price anytime you like, even after your listing is published.', 'advanced-classifieds-and-directory-pro'); ?></p>
                                    </div>
                              </div>
                        </div>
                  </div>
            <?php endif; ?>

            <!-- Listing details -->
            <div class="panel panel-default">
                  <div class="panel-heading bg-white"><?php esc_html_e('Listing details', 'advanced-classifieds-and-directory-pro'); ?></div>

                  <div class="panel-body bg-white">
                        <div class="form-group">
                              <label class="control-label" for="acadp-title"><b><?php esc_html_e('Title', 'advanced-classifieds-and-directory-pro'); ?></b><span class="acadp-star">*</span></label>
                              <input type="text" name="title" id="acadp-title" class="form-control" value="<?php if ($post_id > 0) echo esc_attr($post->post_title); ?>" required />
                        </div>
                        <!-- start custon filelds-->
                        <div id="acadp-custom-fields-listings" data-post_id="<?php echo esc_attr($post_id); ?>">
                              <?php do_action('wp_ajax_acadp_public_custom_fields_listings', $post_id); ?>
                        </div>
                        <!-- start custon filelds-->
                        <div class="form-group">
                              <label class="control-label" for="description"><b><?php esc_html_e('Description', 'advanced-classifieds-and-directory-pro'); ?></b></label>
                              <?php
                              $post_content = ($post_id > 0) ? $post->post_content : '';

                              if (is_admin()) { // Fix for Gutenberg
                                    $editor = 'textarea';
                              }

                              if ('textarea' == $editor) {
                                    printf('<textarea name="%s" class="form-control" rows="8">%s</textarea>', 'description', esc_textarea($post_content));
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

            <?php if ($can_add_location) : ?>
                  <!-- Contact details -->
                  <div id="acadp-contact-details" class="panel panel-default">
                        <div class="panel-heading bg-white"><?php esc_html_e('Contact details', 'advanced-classifieds-and-directory-pro'); ?></div>

                        <div class="panel-body bg-white">
                              <div class="row">
                                    <div class="col-md-6">
                                          <!--<div class="form-group">-->
                                          <!--       <label class="control-label" for="acadp-address"><?php esc_html_e('Address', 'advanced-classifieds-and-directory-pro'); ?></label>-->
                                          <!--       <textarea name="address" id="acadp-address" class="form-control acadp-map-field" rows="3"><?php if (isset($post_meta['address'])) echo esc_textarea($post_meta['address'][0]); ?></textarea>-->
                                          <!--   </div>-->

                                          <!--            		<div class="form-group">-->
                                          <!--						<label class="control-label" for="acadp_location"><?php esc_html_e('Location', 'advanced-classifieds-and-directory-pro'); ?></label>-->
                                          <!--						< ?php-->
                                          <!--acadp_dropdown_terms(array(-->
                                          <!--	'show_option_none'  => '-- ' . esc_html__( 'Selecionar Regi??o', 'advanced-classifieds-and-directory-pro' ) . ' --',-->
                                          <!--	'option_none_value' => '',//(int) $general_settings['base_location'],-->
                                          <!--	'base_term'         => max( 0, (int) $general_settings['base_location'] ),-->
                                          <!--	'parent'            => max( 0, (int) $general_settings['base_location'] ),									-->
                                          <!--	'taxonomy'          => 'acadp_locations',-->
                                          <!--	'name'              => 'acadp_location',	-->
                                          <!--	'class'             => 'form-control acadp-map-field',	-->
                                          <!--	'required'          => true,-->
                                          <!--	'orderby'           => sanitize_text_field( $locations_settings['orderby'] ), -->
                                          <!--	'order'             => sanitize_text_field( $locations_settings['order'] ),				-->
                                          <!--	'selected'          => (int) $location-->
                                          <!--));-->
                                          <!--			?>-->
                                          <!--				</div>-->

                                          <div class="form-group">
                                                <label class="control-label" for="acadp-zipcode"><?php esc_html_e('Zip Code', 'advanced-classifieds-and-directory-pro'); ?></label>
                                                <input type="text" name="zipcode" id="acadp-zipcode" class="form-control acadp-map-field" data-mask="00000-000" value="<?php if (isset($post_meta['zipcode'])) echo esc_attr($post_meta['zipcode'][0]); ?>" />
                                          </div>
                                    </div>

                                    <div class="col-md-6">
                                          <!--      		<div class="form-group">-->
                                          <!--<label class="control-label" for="acadp-phone"><?php esc_html_e('Phone', 'advanced-classifieds-and-directory-pro'); ?></label>-->
                                          <!--<input type="text" name="phone" id="acadp-phone" class="form-control" data-mask="(00) 00000-0000" value="<?php if (isset($post_meta['phone'])) echo esc_attr($post_meta['phone'][0]); ?>" />-->
                                          <!--      		</div>-->

                                          <!--              <div class="form-group">-->
                                          <!--<label class="control-label" for="acadp-email"><?php esc_html_e('Email', 'advanced-classifieds-and-directory-pro'); ?></label>-->
                                          <!--<input type="email" name="email" id="acadp-email" class="form-control" value="<?php echo esc_attr($email); ?>" />-->
                                          <!--      		</div>-->

                                          <div class="form-group">
                                                <label class="control-label" for="acadp-website"><?php esc_html_e('Website', 'advanced-classifieds-and-directory-pro'); ?></label>
                                                <input type="text" name="website" id="acadp-website" class="form-control" value="<?php if (isset($post_meta['website'])) echo esc_attr($post_meta['website'][0]); ?>" />
                                          </div>
                                    </div>
                              </div>
                              <!-- MAPS -->
                              <?php if ($has_map) : ?>
                                    <div class="row">
                                          <div class="col">
                                                <div class="acadp-map embed-responsive embed-responsive-16by9 bg-white" data-type="form">
                                                      <?php
                                                      $latitude  = isset($post_meta['latitude'])  ? esc_attr($post_meta['latitude'][0])  : '';
                                                      $longitude = isset($post_meta['longitude']) ? esc_attr($post_meta['longitude'][0]) : '';
                                                      ?>
                                                      <div class="marker" data-latitude="<?php echo $latitude; ?>" data-longitude="<?php echo $longitude; ?>"></div>
                                                </div>
                                                <input type="hidden" id="acadp-default-location" value="<?php echo esc_attr($default_location); ?>" />
                                                <input type="hidden" id="acadp-latitude" name="latitude" value="<?php echo $latitude; ?>" />
                                                <input type="hidden" id="acadp-longitude" name="longitude" value="<?php echo $longitude; ?>" />

                                                <div class="checkbox">
                                                      <label><input type="checkbox" name="hide_map" value="1" <?php if (isset($post_meta['hide_map'])) checked($post_meta['hide_map'][0], 1); ?>><?php esc_html_e("Don't show the Map", 'advanced-classifieds-and-directory-pro'); ?></label>
                                                </div>
                                          </div>
                                    </div>
                              <?php endif; ?>
                        </div>
                  </div>
            <?php endif; ?>

            <?php if ($can_add_images) : ?>
                  <!-- Images -->
                  <div class="panel panel-default">
                        <div class="panel-heading bg-white"><?php esc_html_e('Images', 'advanced-classifieds-and-directory-pro'); ?></div>

                        <div class="panel-body bg-white">
                              <?php if ($images_limit > 0) : ?>
                                    <p class="help-block">
                                          <strong><?php esc_html_e('Note', 'advanced-classifieds-and-directory-pro'); ?></strong>:
                                          <?php printf(esc_html__('You can upload up to %d images', 'advanced-classifieds-and-directory-pro'), $images_limit); ?>
                                    </p>
                              <?php endif; ?>

                              <table class="acadp-images bg-white" id="acadp-images">
                                    <tbody>
                                          <?php
                                          $disable_image_upload_attr = '';

                                          if (isset($post_meta['images'])) {
                                                $images = unserialize($post_meta['images'][0]);
                                                foreach ($images as $index => $image) {
                                                      $image_attributes = wp_get_attachment_image_src($images[$index]);

                                                      if (isset($image_attributes[0])) {
                                                            echo '<tr class="acadp-image-row">' .
                                                                  '<td class="acadp-handle"><span class="glyphicon glyphicon-th-large"></span></td>' .
                                                                  '<td class="acadp-image">' .
                                                                  '<img src="' . esc_url($image_attributes[0]) . '" />' .
                                                                  '<input type="hidden" class="acadp-image-field" name="images[]" value="' . esc_attr($images[$index]) . '" />' .
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
                              <a href="javascript:void(0);" class="btn btn-default" id="acadp-upload-image" data-limit="<?php echo esc_attr($images_limit); ?>" <?php echo $disable_image_upload_attr; ?>><?php esc_html_e('Upload Image', 'advanced-classifieds-and-directory-pro'); ?></a>
                        </div>
                  </div>
            <?php endif; ?>

            <?php if ($can_add_video) : ?>
                  <!-- Video -->
                  <div class="panel panel-default">
                        <div class="panel-heading bg-white"><?php esc_html_e('Video URL', 'advanced-classifieds-and-directory-pro'); ?></div>

                        <div class="panel-body bg-white">
                              <input type="text" name="video" id="acadp-video" class="form-control" placeholder="<?php esc_attr_e('Only YouTube & Vimeo URLs', 'advanced-classifieds-and-directory-pro'); ?>" value="<?php if (isset($post_meta['video'])) echo esc_attr($post_meta['video'][0]); ?>" />
                        </div>
                  </div>
            <?php endif; ?>

            <!-- Hook for developers to add new fields -->
            <?php do_action('acadp_listing_form_fields'); ?>

            <!-- Complete listing -->
            <div class="panel panel-default">
                  <div class="panel-heading bg-white">Completar An??ncio
                        <!--<?php esc_html_e('Complete listing', 'advanced-classifieds-and-directory-pro'); ?>-->
                  </div>

                  <div class="panel-body bg-white">
                        <?php if ($mark_as_sold) : ?>
                              <div class="checkbox">
                                    <label>
                                          <input type="checkbox" name="sold" value="1" <?php if (isset($post_meta['sold'])) checked($post_meta['sold'][0], 1); ?>>
                                          <?php esc_html_e("Mark as", 'advanced-classifieds-and-directory-pro'); ?>&nbsp;
                                          <strong><?php echo esc_html($general_settings['sold_listing_label']); ?></strong>
                                    </label>
                              </div>
                        <?php endif; ?>

                        <?php echo the_acadp_terms_of_agreement(); ?>

                        <?php if ($post_id == 0) : ?>
                              <div id="acadp-listing-g-recaptcha"></div>
                              <div id="acadp-listing-g-recaptcha-message" class="help-block text-danger"></div>
                        <?php endif; ?>

                        <?php wp_nonce_field('acadp_save_listing', 'acadp_listing_nonce'); ?>
                        <input type="hidden" name="post_type" value="acadp_listings" />

                        <?php if ($has_draft) : ?>
                              <input type="submit" name="action" class="btn btn-default acadp-listing-form-submit-btn" value="<?php esc_html_e('Save Draft', 'advanced-classifieds-and-directory-pro'); ?>" />
                        <?php endif; ?>

                        <?php if ($post_id > 0) : ?>
                              <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />
                              <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="btn btn-default" target="_blank"><?php esc_html_e('Preview', 'advanced-classifieds-and-directory-pro'); ?></a>
                        <?php endif; ?>

                        <?php if ($has_draft) { ?>
                              <input type="submit" name="action" class="btn btn-primary pull-right acadp-listing-form-submit-btn" value="<?php esc_html_e('Pr??ximo', 'advanced-classifieds-and-directory-pro'); ?>" />
                        <?php } else { ?>
                              <input type="submit" name="action" class="btn btn-primary pull-right acadp-listing-form-submit-btn" value="<?php esc_html_e('Save Changes', 'advanced-classifieds-and-directory-pro'); ?>" />
                        <?php } ?>

                        <div class="clearfix"></div>
                  </div>
            </div>
      </form>
      <form id="acadp-form-upload" class="hidden" method="post" action="#" enctype="multipart/form-data">
            <input type="file" multiple name="acadp_image[]" id="acadp-upload-image-hidden" />
            <input type="hidden" name="action" value="acadp_public_image_upload" />
            <?php wp_nonce_field('acadp_upload_images', 'acadp_images_nonce'); ?>
      </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>

<script>
      // Exemplo de JavaScript inicial para desativar envios de formul??rio, se houver campos inv??lidos.
      (function() {
            'use strict';
            window.addEventListener('load', function() {
                  // Pega todos os formul??rios que n??s queremos aplicar estilos de valida????o Bootstrap personalizados.
                  var forms = document.getElementsByClassName('needs-validation');
                  // Faz um loop neles e evita o envio
                  var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                              if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                              }
                              form.classList.add('was-validated');
                        }, false);
                  });
            }, false);
      })();
</script>