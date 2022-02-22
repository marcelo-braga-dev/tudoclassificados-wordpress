<?php
$columns = $instance['columns'];
$span = 'col-md-' . floor(12 / $columns);
$i = 0;

while ($acadp_query->have_posts()) :
      $acadp_query->the_post();
      $post_meta = get_post_meta($post->ID);
?>
      <div class="card shadow-sm mb-3">
            <a href="<?php the_permalink(); ?>">
                  <div class="col-12 p-5 rounded-top" style="background: url('<?php the_acadp_listing_thumbnail($post_meta) ?>'); background-size: cover; background-position: center; ">
                        <div class="p-5"></div>
                  </div>
            </a>
            <div class="border-top p-2 px-4">
                  <?php
                  if ($instance['has_price'] && $instance['show_price'] && isset($post_meta['price']) && $post_meta['price'][0] > 0) {
                        $price = acadp_format_amount($post_meta['price'][0]);
                        echo '<span class="lead acadp-listings-price">' . esc_html(acadp_currency_filter($price)) . '</span>';
                  }
                  the_acadp_listing_labels($post_meta);
                  ?>
                  <div class="w-100"></div>
            </div>
            <div class="card-footer bg-white border-top-0 border pt-0 animado">
                  <small class="text-muted">
                        <a style="text-decoration:none; color:gray" href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
                  </small>
            </div>
      </div>
      <?php
      $i++;
      if ($i % $columns == 0 || $i == $acadp_query->post_count) : ?>
      <?php endif; ?>
<?php endwhile; ?>
<!-- end of the loop -->

<!-- Use reset postdata to restore orginal query -->
<?php wp_reset_postdata(); ?>