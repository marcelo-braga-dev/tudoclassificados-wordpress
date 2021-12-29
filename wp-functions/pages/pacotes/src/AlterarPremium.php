<?php
$where = get_posts_by_author_sql('acadp_listings', true, get_current_user_id(), true);
$results = $wpdb->get_results("SELECT id FROM $wpdb->posts $where");


foreach ($results as $res) {
    $categoria = wp_get_object_terms($res->id, 'acadp_categories');

    if ($categoria[0]->parent == 27){
        update_post_meta($res->id, 'featured', 1);
    }
}
