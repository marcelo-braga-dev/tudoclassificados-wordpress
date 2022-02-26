<?php

namespace TudoClassificados\Services\Shortcodes\Anuncios;

use WP_Query;

class AnunciosFavoritos
{
    public function execute($atts)
    {
        if (!is_user_logged_in()) {
            return acadp_login_form();
        }

        $shortcode = 'acadp_favourite_listings';

        $general_settings = get_option('acadp_general_settings');
        $listings_settings = get_option('acadp_listings_settings');
        $featured_listing_settings = get_option('acadp_featured_listing_settings');

        $atts = shortcode_atts(array(
            'view' => $listings_settings['default_view'],
            'featured' => 1,
            'filterby' => '',
            'orderby' => $listings_settings['orderby'],
            'order' => $listings_settings['order'],
            'listings_per_page' => !empty($listings_settings['listings_per_page']) ? $listings_settings['listings_per_page'] : -1,
            'pagination' => 1,
            'header' => 1
        ), $atts);

        $view = acadp_get_listings_current_view_name($atts['view']);

        // Enqueue style dependencies
        wp_enqueue_style(ACADP_PLUGIN_NAME);

        // Enqueue script dependencies
        if (wp_script_is(ACADP_PLUGIN_NAME . '-bootstrap', 'registered')) {
            wp_enqueue_script(ACADP_PLUGIN_NAME . '-bootstrap');
        }

        wp_enqueue_script(ACADP_PLUGIN_NAME);

        if ('map' == $view) {
            wp_enqueue_script(ACADP_PLUGIN_NAME . '-markerclusterer');
        }

        // ...
        $can_show_header = empty($listings_settings['display_in_header']) ? 0 : (int)$atts['header'];
        $pre_content = '';
        $can_show_listings_count = $can_show_header && in_array('listings_count', $listings_settings['display_in_header']) ? true : false;
        $can_show_views_selector = $can_show_header && in_array('views_selector', $listings_settings['display_in_header']) ? true : false;
        $can_show_orderby_dropdown = $can_show_header && in_array('orderby_dropdown', $listings_settings['display_in_header']) ? true : false;

        $can_show_date = isset($listings_settings['display_in_listing']) && in_array('date', $listings_settings['display_in_listing']) ? true : false;
        $can_show_user = isset($listings_settings['display_in_listing']) && in_array('user', $listings_settings['display_in_listing']) ? true : false;
        $can_show_category = isset($listings_settings['display_in_listing']) && in_array('category', $listings_settings['display_in_listing']) ? true : false;
        $can_show_views = isset($listings_settings['display_in_listing']) && in_array('views', $listings_settings['display_in_listing']) ? true : false;
        $can_show_images = empty($general_settings['has_images']) ? false : true;
        $has_featured = apply_filters('acadp_has_featured', empty($featured_listing_settings['enabled']) ? false : true);
        if ($has_featured) {
            $has_featured = $atts['featured'];
        }

        $current_order = acadp_get_listings_current_order($atts['orderby'] . '-' . $atts['order']);
        $can_show_pagination = (int)$atts['pagination'];

        $has_price = empty($general_settings['has_price']) ? false : true;
        $can_show_price = false;

        if ($has_price) {
            $can_show_price = isset($listings_settings['display_in_listing']) && in_array('price', $listings_settings['display_in_listing']) ? true : false;
        }

        $has_location = empty($general_settings['has_location']) ? false : true;
        $can_show_location = false;

        if ($has_location) {
            $can_show_location = isset($listings_settings['display_in_listing']) && in_array('location', $listings_settings['display_in_listing']) ? true : false;
        }

        $span = 12;
        if ($can_show_images) $span = $span - 2;
        if ($can_show_price) $span = $span - 3;
        $span_middle = 'col-md-' . $span;

        // Define the query
        $paged = acadp_get_page_number();
        $favourite_posts = get_user_meta(get_current_user_id(), 'acadp_favourites', true);

        $args = array(
            'post_type' => 'acadp_listings',
            'post_status' => 'publish',
            'posts_per_page' => (int)$atts['listings_per_page'],
            'paged' => $paged,
            'post__in' => !empty($favourite_posts) ? $favourite_posts : array(0)
        );

        if ($has_location && $general_settings['base_location'] > 0) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'acadp_locations',
                    'field' => 'term_id',
                    'terms' => $general_settings['base_location'],
                    'include_children' => true,
                ),
            );
        }

        $meta_queries = array();

        if ('map' == $view) {
            $meta_queries['hide_map'] = array(
                'key' => 'hide_map',
                'value' => 0,
                'compare' => '='
            );
        }

        if ($has_featured) {
            if ('featured' == $atts['filterby']) {
                $meta_queries['featured'] = array(
                    'key' => 'featured',
                    'value' => 1,
                    'compare' => '='
                );
            } else {
                $meta_queries['featured'] = array(
                    'key' => 'featured',
                    'type' => 'NUMERIC',
                    'compare' => 'EXISTS',
                );
            }
        }

        switch ($current_order) {
            case 'title-asc' :
                if ($has_featured) {
                    $args['meta_key'] = 'featured';
                    $args['orderby'] = array(
                        'meta_value_num' => 'DESC',
                        'title' => 'ASC',
                    );
                } else {
                    $args['orderby'] = 'title';
                    $args['order'] = 'ASC';
                };
                break;
            case 'title-desc' :
                if ($has_featured) {
                    $args['meta_key'] = 'featured';
                    $args['orderby'] = array(
                        'meta_value_num' => 'DESC',
                        'title' => 'DESC',
                    );
                } else {
                    $args['orderby'] = 'title';
                    $args['order'] = 'DESC';
                };
                break;
            case 'date-asc' :
                if ($has_featured) {
                    $args['meta_key'] = 'featured';
                    $args['orderby'] = array(
                        'meta_value_num' => 'DESC',
                        'date' => 'ASC',
                    );
                } else {
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC';
                };
                break;
            case 'date-desc' :
                if ($has_featured) {
                    $args['meta_key'] = 'featured';
                    $args['orderby'] = array(
                        'meta_value_num' => 'DESC',
                        'date' => 'DESC',
                    );
                } else {
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC';
                };
                break;
            case 'price-asc' :
                if ($has_featured) {
                    $meta_queries['price'] = array(
                        'key' => 'price',
                        'type' => 'NUMERIC',
                        'compare' => 'EXISTS',
                    );

                    $args['orderby'] = array(
                        'featured' => 'DESC',
                        'price' => 'ASC',
                    );
                } else {
                    $args['meta_key'] = 'price';
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = 'ASC';
                };
                break;
            case 'price-desc' :
                if ($has_featured) {
                    $meta_queries['price'] = array(
                        'key' => 'price',
                        'type' => 'NUMERIC',
                        'compare' => 'EXISTS',
                    );

                    $args['orderby'] = array(
                        'featured' => 'DESC',
                        'price' => 'DESC',
                    );
                } else {
                    $args['meta_key'] = 'price';
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = 'DESC';
                };
                break;
            case 'views-asc' :
                if ($has_featured) {
                    $meta_queries['views'] = array(
                        'key' => 'views',
                        'type' => 'NUMERIC',
                        'compare' => 'EXISTS',
                    );

                    $args['orderby'] = array(
                        'featured' => 'DESC',
                        'views' => 'ASC',
                    );
                } else {
                    $args['meta_key'] = 'views';
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = 'ASC';
                };
                break;
            case 'views-desc' :
                if ($has_featured) {
                    $meta_queries['views'] = array(
                        'key' => 'views',
                        'type' => 'NUMERIC',
                        'compare' => 'EXISTS',
                    );

                    $args['orderby'] = array(
                        'featured' => 'DESC',
                        'views' => 'DESC',
                    );
                } else {
                    $args['meta_key'] = 'views';
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = 'DESC';
                };
                break;
            case 'rand-asc' :
            case 'rand-desc' :
                if ($has_featured) {
                    $args['meta_key'] = 'featured';
                    $args['orderby'] = 'meta_value_num rand';
                } else {
                    $args['orderby'] = 'rand';
                };
                break;
        }

        $count_meta_queries = count($meta_queries);
        if ($count_meta_queries) {
            $args['meta_query'] = ($count_meta_queries > 1) ? array_merge(array('relation' => 'AND'), $meta_queries) : $meta_queries;
        }

        $acadp_query = new WP_Query($args);

        // Start the Loop
        global $post;

        // Process output
        if ($acadp_query->have_posts()) {
            ob_start();
            include(acadp_get_template("listings/acadp-public-listings-$view-display.php"));
            return ob_get_clean();
        } else {
            return '<span>' . __('No Results Found.', 'advanced-classifieds-and-directory-pro') . '</span>';
        }
    }
}