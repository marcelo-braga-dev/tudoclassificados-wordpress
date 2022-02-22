<div class="border p-4 rounded my-3 shadow-sm">
    <div class="w-100 text-right" style="margin-top:-25px">
        <?php the_acadp_social_sharing_buttons(); ?>
    </div>
    <div class="m-0 p-0">
        <?php
        $categoriaImovel = get_term($category->term_taxonomy_id);
        ?>
    </div>
    <div class="w-100">
        <small><?= get_term($category->term_taxonomy_id)->name; ?></small>
        <h4 class="mt-0"><b><?php echo esc_html($post->post_title); ?></b> </h4>
    </div>
    <div class="w-100 mb-3">
        <?php the_acadp_listing_labels($post_meta); ?>
    </div>
    <div class="w-100 mb-3">
        <div class="row">
            <div class="col-auto">
                <span style="font-size:30px">
                    <?php
                    $price = acadp_format_amount($post_meta['price'][0]);
                    echo esc_html(acadp_currency_filter($price))
                    ?>
                </span>
            </div>
            <div class="col-1 align-self-center" style="font-size:24px">
                <!-- Footer -->
                <?php if ($can_show_user || $can_add_favourites || $can_report_abuse) : ?>
                    <?php if ($can_add_favourites) : ?>
                        <span id="" class="acadp-favourites"><?php the_acadp_favourites_link(); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="w-100 mb-2">
        <span>Anunciado por <?php echo '<a href="' . esc_url(acadp_get_user_page_link($post->post_author)) . '" style="color: #1e4b75">' . get_the_author() . '</a>'; ?></span>
    </div>
</div>