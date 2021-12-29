<?php

/**
 * This template displays the ACADP listings in grid view.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */
include ABSPATH . 'wp-functions/widgets/carrocel_anuncios.php';
return;
?>

<?php /*
<!-- pagination here -->
<?php //if ( $can_show_pagination ) the_acadp_pagination( $acadp_query->max_num_pages, "", $paged ); 
?>


<?php the_acadp_social_sharing_buttons(); ?>






<?php /*

<script>
    $(function() {
        $('.slick-carroucel').slick({
            //dots: true,
            speed: 700,
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,

            //autoplay: true,
            autoplaySpeed: 3000,
            adaptiveHeight: true,

            //centerMode: true,

            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>

<!--
 <!--
            <?php if ($i % $columns == 0) : ?>
                <div class="">
            <?php endif; ?>            
                <div class="">
                    <div <?php the_acadp_listing_entry_class($post_meta, 'thumbnail'); ?>>
                        <?php if ($can_show_images) : ?>
                            <a href="<?php the_permalink(); ?>" class=""><?php the_acadp_listing_thumbnail($post_meta); ?></a>      	
                        <?php endif; ?>
                
                        <div class="">
                            <div class="">
                                <h3 class=""><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
                                <?php the_acadp_listing_labels($post_meta); ?>
                            </div>
                            
                            <?php
                            $info = array();

                            if ($can_show_date) {
                                $info[] = sprintf(esc_html__('Posted %s ago', 'advanced-classifieds-and-directory-pro'), human_time_diff(get_the_time('U'), current_time('timestamp')));
                            }

                            if ($can_show_user) {
                                $info[] = '<a href="' . esc_url(acadp_get_user_page_link($post->post_author)) . '">' . get_the_author() . '</a>';
                            }

                            echo '<p class=""><small class="">' . implode(' ' . esc_html__("by", 'advanced-classifieds-and-directory-pro') . ' ', $info) . '</small></p>';
                            ?>
                            
                            <?php if (!empty($listings_settings['excerpt_length']) && !empty($post->post_content)) : ?>
                                <p class=""><?php echo wp_trim_words($post->post_content, $listings_settings['excerpt_length'], '...'); ?></p>
                            <?php endif; ?>
                            
                            <?php
                            $info = array();

                            if ($can_show_category && $categories = wp_get_object_terms($post->ID, 'acadp_categories')) {
                                $category_links = array();
                                foreach ($categories as $category) {
                                    $category_links[] = sprintf('<a href="%s">%s</a>', esc_url(acadp_get_category_page_link($category)), esc_html($category->name));
                                }
                                $info[] = sprintf('<span class=""></span>&nbsp;%s', implode(', ', $category_links));
                            }

                            if ($can_show_location && $locations = wp_get_object_terms($post->ID, 'acadp_locations')) {
                                $location_links = array();
                                foreach ($locations as $location) {
                                    $location_links[] = sprintf('<a href="%s">%s</a>', esc_url(acadp_get_location_page_link($location)), esc_html($location->name));
                                }
                                $info[] = sprintf('<span class=""></span>&nbsp;%s', implode(', ', $location_links));
                            }

                            if ('acadp_favourite_listings' == $shortcode) {
                                $info[] = '<a href="' . esc_url(acadp_get_remove_favourites_page_link($post->ID)) . '">' . esc_html__('Remove from favourites', 'advanced-classifieds-and-directory-pro') . '</a>';
                            }

                            if ($can_show_views && !empty($post_meta['views'][0])) {
                                $info[] = sprintf(esc_html__("%d views", 'advanced-classifieds-and-directory-pro'), $post_meta['views'][0]);
                            }

                            echo '<p class=""><small>' . implode(' / ', $info) . '</small></p>';

                            if ($can_show_price && isset($post_meta['price']) && $post_meta['price'][0] > 0) {
                                $price = acadp_format_amount($post_meta['price'][0]);
                                echo '<p class="">' . esc_html(acadp_currency_filter($price)) . '</p>';
                            }
                            ?>
                            
                            <?php do_action('acadp_after_listing_content', $post->ID, 'grid'); ?>
                        </div>
                    </div>
                </div>
                -->*/