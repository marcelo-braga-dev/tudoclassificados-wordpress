<div class="espaco-carrocel" style="height: 320px;"></div>

<div class="card-deck center slider" style="display: none;">
      <?php
      while ($acadp_query->have_posts()) :
            $acadp_query->the_post();
            $post_meta = get_post_meta($post->ID);
      ?>
            <div class="card shadow-sm border m-3 p-1">
                  <div class="rounded-top rounded-md-left" style="background: url('<?php the_acadp_listing_thumbnail($post_meta) ?>'); background-size: cover; background-position: center; ">
                        <a href="<?php the_permalink(); ?>">
                              <div class="p-5"></div>
                              <div class="p-5"></div>
                        </a>
                  </div>
                  <div class="d-block border-top px-1 pt-1">

                        <?php if ($post_meta['price'][0]) :
                              $price = acadp_format_amount($post_meta['price'][0]);
                        ?>
                              <span class="d-block">
                                    <?= esc_html(acadp_currency_filter($price)); ?>
                              </span>
                        <?php endif ?>

                        <!-- aluga -->
                        <?php if ($post_meta['preco_aluguel'][0]) :
                              $precoAluguel = acadp_format_amount($post_meta['preco_aluguel'][0]);
                        ?>
                              <span class="d-block">
                                    <?= esc_html(acadp_currency_filter($precoAluguel)) . '<small> /mês </small>'; ?>
                              </span>
                        <?php endif ?>
                        
                  </div>
                  <div class="bg-white px-1 pt-0 animad o">
                        <a href="<?php the_permalink(); ?>">
                              <small class="text-muted">
                                    <?php
                                    $texto = esc_html(get_the_title());
                                    $max_len = 40;
                                    echo bs4_limitar_texto($texto, $max_len);
                                    ?>
                              </small>
                        </a>
                        <div class="d-block text-right">
                              <?php the_acadp_listing_labels($post_meta); ?>
                        </div>
                  </div>
            </div>
      <?php endwhile; ?>
</div>

<?php wp_reset_postdata(); ?>