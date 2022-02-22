<!-- IMAGEM -->
<?php if ($can_show_images) : $images = unserialize($post_meta['images'][0]); ?>
      <?php if (1 == count($images)) : $image_attributes = wp_get_attachment_image_src($images[0], 'large'); ?>
            <div class="row">
                  <div class="mx-auto">
                        <a class="acadp-image-popup" href="<?php echo esc_url($image_attributes[0]); ?>">
                              <img src="<?php echo esc_url($image_attributes[0]); ?>" style="height:500px" />
                        </a>
                  </div>
            </div>
      <?php else : ?>
            <div id="acadp-slider-wrapper">
                  <!-- Slider for -->
                  <div class="acadp-slider-for">
                        <?php foreach ($images as $index => $image) : 
                              $image_attributes = wp_get_attachment_image_src($images[$index], 'large'); 
                              $imagemCarrocel = esc_url($image_attributes[0]);

                              $urlExterno = get_post_meta($images[$index])['_url_externo'][0];
                              if (!empty($urlExterno)) $imagemCarrocel = $urlExterno;
                        ?>
                              <div class="acadp-slider-item">
                                    <div class="row justify-content-center">
                                          <div class="">
                                                <img src="<?= $imagemCarrocel ?>" class="acadp-responsive-item" style="height:300px; cursor: pointer;" />
                                          </div>
                                    </div>
                                    <div class="acadp-responsive-container mx-auto">
                                    </div>
                              </div>
                        <?php endforeach; ?>
                  </div>
                  <!-- Slider nav -->
                  <div class="acadp-slider-nav" style="margin:5px 15%">
                        <?php foreach ($images as $index => $image) : 
                              $image_attributes = wp_get_attachment_image_src($images[$index], 'thumbnail'); 
                              $imagemCarrocel = esc_url($image_attributes[0]);

                              $urlExterno = get_post_meta($images[$index])['_url_externo'][0];
                              if (!empty($urlExterno)) $imagemCarrocel = $urlExterno;
                        ?>
                              <div class="p-2">
                                    <picture>
                                          <img src="<?= $imagemCarrocel ?>" style="width: 100px; cursor: pointer;" />
                                    </picture>
                              </div>
                        <?php endforeach; ?>
                  </div>
            </div>
      <?php endif; ?>
<?php endif; ?>