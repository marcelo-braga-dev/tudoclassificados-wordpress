<?php
// echo '<pre>';
// print_r(get_terms());
// echo '</pre>';
?>

<h3 class="mb-4">Todas as Categorias</h3>
<div class="card-columns">
    <?php
    foreach ($terms as $term) :
        $attributes['term_id'] = $term->term_id;
        
        $count = 0;
        if (!empty($attributes['hide_empty']) || !empty($attributes['show_count'])) {
            $count = acadp_get_listings_count_by_category($term->term_id, $attributes['pad_counts']);

            if (!empty($attributes['hide_empty']) && 0 == $count) continue;
        }

        $category_url = acadp_get_category_page_link($term);
    ?>
        <div class="card">
        <div class="card-body p-0">
            <a class="list-group-item list-group-item-action active rounded-top" href="<?= esc_url($category_url) ?>" title="<?= esc_attr($title_attr) ?>" style="background-color: var(--principal)">
                <?= $term->description ?>
                <strong><?= esc_html($term->name) ?></strong>
            </a>
            <?= acadp_categories($attributes) ?>
        </div>
        </div>

    <?php endforeach ?>
</div>

<div class="p-1">
<!-- Horizontal-1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5788964970631749"
     data-ad-slot="1820744055"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

<?php the_acadp_social_sharing_buttons();
/*
if (!empty($attributes['show_count'])) {
    echo ' (' . esc_html($count) . ')';
}*/