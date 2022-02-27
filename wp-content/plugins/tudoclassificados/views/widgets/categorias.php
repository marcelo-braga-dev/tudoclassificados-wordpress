<style>
    .list-group-flush {
        background-color: white;
        color: var(--principal);
    }

    .widget-categoria {
        color: var(--principal);
        font-weight: 300 !important;
        font-size: 15px;
    }

    .widget-categoria:hover {
        color: white;
        background-color: var(--principal);
    }

    .top-categoria {
        font-size: 16px;
        text-align: center;
        color: var(--principal);
        background-color: white;
        font-weight: 500 !important;
    }
</style>

<div class="row m-2 m-md-0">
    <div class="col-12 card p-1 rounded mt-3">
        <div class="list-group list-group-flush">
            <span href="#" class="list-group-item p-2 top-categoria d-block">
                Categorias
            </span>
            <?php

            $args = array(
                'taxonomy' => 'acadp_categories',
                'hide_empty' => false,
                'update_term_meta_cache' => false,
            );

            $todas_categorias = get_terms($args);

            foreach ($todas_categorias as $term) :
                if (!$term->parent && $term->taxonomy == 'acadp_categories') :
                    $attributes['term_id'] = $term->term_id;

                    $count = 0;
                    if (!empty($attributes['hide_empty']) || !empty($attributes['show_count'])) {
                        $count = acadp_get_listings_count_by_category($term->term_id, $attributes['pad_counts']);

                        if (!empty($attributes['hide_empty']) && 0 == $count) continue;
                    }

                    $category_url = acadp_get_category_page_link($term);
                    ?>
                    <a class="list-group-item list-group-item-action widget-categoria p-2 px-3"
                       href="<?= esc_url($category_url) ?>" title="<?= esc_attr($title_attr) ?>">
                        <div class="d-inline" style="width: 0px;"><?= $term->description ?></div>
                        <?= esc_html($term->name) ?>
                    </a>
                    <?= acadp_categories($attributes) ?>
                <?php endif;
            endforeach; ?>

            <a class="list-group-item list-group-item-action widget-categoria p-2 px-3" href="/lista-categorias/">
                <div class="d-inline" style="width: 0px;"><i aria-hidden="true" class="fas fa-layer-group mr-2"></i>
                </div>
                Todas Categorias
            </a>
        </div>
    </div>
</div>