<div class="acadp acadp-user acadp-manage-listings acadp-list-view">
    <!-- the loop -->
    <?php while ($acadp_query->have_posts()) :
        $acadp_query->the_post();
        $post_meta = get_post_meta($post->ID);
        ?>
        <div class="card mb-3">
            <div class="row p-3">
                <div class="col-md-3">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_acadp_listing_thumbnail($post_meta); ?>" class="rounded">
                    </a>
                </div>

                <div class=" col-md-6">
                    <div class="acadp-listings-title-block">
                        <h3 class="acadp-no-margin"><a
                                    href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
                        <?php the_acadp_listing_labels($post_meta); ?>
                    </div>

                    <?php if ($post->post_status == 'sem_imagens') : ?>
                        <div class="row alert alert-danger">
                            <div class="col-auto align-items-center">
                                <h4><i class="bi bi-exclamation-diamond" style="font-size: 22px;"></i></h4>
                            </div>
                            <div class="col-auto">
                                <span><b>Anúncio não publicado por falta de imagens.</b></span><br>
                                <small class="text-white">Insira imagens nesse anúncio, clicando no botão
                                    editar.</small>
                            </div>
                        </div>
                    <?php endif; ?>

                    <small class="text-muted d-block">
                        <?php printf(esc_html__('Posted %s ago', 'advanced-classifieds-and-directory-pro'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?>
                    </small>

                    <?php
                    $info = array();

                    if ($categories = wp_get_object_terms($post->ID, 'acadp_categories')) {
                        $category_links = array();
                        foreach ($categories as $category) {
                            $category_links[] = sprintf('<a href="%s">%s</a>', esc_url(acadp_get_category_page_link($category)), esc_html($category->name));
                        }
                        $info[] = sprintf('<span class="glyphicon glyphicon-briefcase"></span>&nbsp;%s', implode(', ', $category_links));
                    }

                    if ($has_location && $locations = wp_get_object_terms($post->ID, 'acadp_locations')) {
                        $location_links = array();
                        foreach ($locations as $location) {
                            $location_links[] = sprintf('<a href="%s">%s</a>', esc_url(acadp_get_location_page_link($location)), esc_html($location->name));
                        }
                        $info[] = sprintf('<span class="glyphicon glyphicon-map-marker"></span>&nbsp;%s', implode(', ', $location_links));
                    }

                    if (!empty($post_meta['views'][0])) {
                        $info[] = sprintf(esc_html__("%d views", 'advanced-classifieds-and-directory-pro'), $post_meta['views'][0]);
                    }

                    echo '<span class=""><small>' . implode(' / ', $info) . '</small></span>';
                    ?>
                    <span class="d-block py-2">
						<?php
                        if (!empty($post_meta['price'][0])) {
                            $price = acadp_format_amount($post_meta['price'][0]);
                            echo esc_html(acadp_currency_filter($price));
                        }
                        ?>
					</span>
                    <small>
                        <strong><?php _e('Status', 'advanced-classifieds-and-directory-pro'); ?></strong>:
                        <?php echo esc_html(acadp_get_listing_status_i18n($post->post_status)); ?> /
                    </small>

                    <?php if (!empty($post_meta['never_expires'])) : ?>
                        <small>
                            <strong><?php esc_html_e('Expires on', 'advanced-classifieds-and-directory-pro'); ?></strong>:
                            <?php esc_html_e('Never Expires', 'advanced-classifieds-and-directory-pro'); ?>
                        </small>
                    <?php elseif (!empty($post_meta['expiry_date'])) : ?>
                        <small>
                            <strong><?php esc_html_e('Expires on', 'advanced-classifieds-and-directory-pro'); ?></strong>:
                            <?php echo date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($post_meta['expiry_date'][0])); ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="col-md-3 text-right">
                    <!-- Botoes -->
                    <div class="row">
                        <div class="col-12">
                            <?php
                            $can_edit = 1;

                            if (!empty($post_meta['listing_status']) && in_array($post_meta['listing_status'][0], array('renewal', 'expired'))) {
                                if ('expired' == $post_meta['listing_status'][0]) {
                                    $can_edit = 0;
                                }

                                if ($can_renew) {
                                    printf('<a href="%s" class="btn btn-primary"><i class="fas fa-recycle"></i></a>', esc_url(acadp_get_listing_renewal_page_link($post->ID)));
                                }
                            } else {
                                if ('pending' == $post->post_status) {
                                    $can_edit = 0;

                                    if ('0000-00-00 00:00:00' == $post->post_date_gmt && $has_checkout_page = apply_filters('acadp_has_checkout_page', 0, $post->ID)) {
                                        printf('<a href="%s" class="btn btn-primary btn-sm btn-block">%s</a>', esc_url(acadp_get_checkout_page_link($post->ID)), esc_html__('Retry Payment', 'advanced-classifieds-and-directory-pro'));
                                    }
                                }

                                if ('sem_imagens' == $post->post_status) {
                                    $can_edit = 1;
                                }

                                if ($can_promote && empty($post_meta['featured'][0]) && 'publish' == $post->post_status) {
                                    // printf('<a href="%s" class="btn btn-primary btn-sm btn-block">%s</a>', esc_url(acadp_get_listing_promote_page_link($post->ID)), esc_html__('Promote', 'advanced-classifieds-and-directory-pro'));
                                    if ($post_meta['featured'][0]) {
                                        echo '<button class="btn btn-success">Promover</button>';
                                    } else {
                                    }
                                }
                            }
                            ?>

                            <?php if ($can_edit) : ?>
                                <a href="<?php echo esc_url(acadp_get_listing_edit_page_link($post->ID)); ?>"
                                   class="btn btn-success">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(acadp_get_listing_delete_page_link($post->ID)); ?>"
                               class="btn btn-danger"
                               onclick="return confirm( '<?php esc_attr_e('Are you sure you want to delete this listing?', 'advanced-classifieds-and-directory-pro'); ?>' );">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                        <div class="col-12">
                        </div>
                    </div>

                    <hr class="my-3">
                    <?php //if (bs4t_user_is_premium('imoveis') || bs4t_user_is_premium('geral')) :
                    ?>
                    <!-- Botao Premium -->
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="togglebutton mb-3">
                                <label class="text-primary">
                                    <input type="checkbox"
                                           class="btn-premium btn-premium-< ?= is_imovel($category->parent) ? 'imovel' : 'geral' ?>"
                                           tipo="<?= $category->parent ?>"
                                           post-id="<?= $post->ID ?>"
                                        <?php if ($post_meta['featured'][0]) echo 'checked' ?>>
                                    <span class="toggle"></span>
                                    Anúncio Premium
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <!-- pagination here -->
    <?php the_acadp_pagination($acadp_query->max_num_pages, "", $paged); ?>
</div>