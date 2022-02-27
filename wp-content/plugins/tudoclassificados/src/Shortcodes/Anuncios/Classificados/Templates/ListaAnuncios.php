<?php
namespace TudoClassificados\Shortcodes\Anuncios\Classificados\Templates;

use WP_Query;

class ListaAnuncios
{
    public function __construct()
    {
        add_shortcode("tc_lista_anuncios_classificados", array($this, "run_shortcode_lista_anuncios_classificados"));
    }

    public function run_shortcode_lista_anuncios_classificados($atts)
    {
        $term_slug = 'classificados';

        $listings_settings = get_option('acadp_listings_settings');

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

        $args = array(
            'post_type' => 'acadp_listings',
            'post_status' => 'publish',
            'posts_per_page' => (int)$atts['listings_per_page'],
            'paged' => acadp_get_page_number(),
        );

        $tax_queries = array();

        $tax_queries[] = array(
            'taxonomy' => 'acadp_categories',
            'field' => 'slug',
            'terms' => $term_slug,
            'include_children' => isset($listings_settings['include_results_from']) && in_array('child_categories', $listings_settings['include_results_from']) ? true : false,
        );

        $args['tax_query'] = (count($tax_queries) > 1) ? array_merge(array('relation' => 'AND'), $tax_queries) : $tax_queries;


        $featured_listing_settings = get_option('acadp_featured_listing_settings');
        $has_featured = apply_filters('acadp_has_featured', empty($featured_listing_settings['enabled']) ? false : true);
        if ($has_featured) {
            $has_featured = $atts['featured'];
        }

        $meta_queries = array();

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

        $args = $this->getArgs($atts, $has_featured, $args, $meta_queries);

        $args = apply_filters('acadp_query_args', $args);
        $acadp_query = new WP_Query($args);

        // Start the Loop
        global $post;

        // Process output
        if ($acadp_query->have_posts()) {
            ob_start();
            require_once TUDOCLASSIFICADOS_PATH . 'pages/lista-anuncios/index.php';
            return ob_get_clean();
        }

        return '<span>' . __('No Results Found.', 'advanced-classifieds-and-directory-pro') . '</span>';
    }

    private function getArgs(array $atts, $has_featured, array $args, array $meta_queries): array
    {
        $current_order = acadp_get_listings_current_order($atts['orderby'] . '-' . $atts['order']);
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
        return $args;
    }
}