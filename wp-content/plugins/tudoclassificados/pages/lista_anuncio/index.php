<?php
include_once 'assets/funcoes.php';

while ($acadp_query->have_posts()) :
    $acadp_query->the_post();
    $post_meta = get_post_meta($post->ID);
?>
    <?php
    $qtd_anuncios++;

    if ($qtd_anuncios == 1) {

        if ('/categorias/imoveis/' == $_SERVER['REQUEST_URI']) : ?>
            <a href="https://quin.to/drhpia?codigo=bpmGN">
                <img src="/wp-content/uploads/2021/11/banner-quinto-andar.jpg">
            </a>
        <?php else : ?>
            <div class="col-12">
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5788964970631749" data-ad-slot="1820744055" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
    <?php endif;
    } ?>

    <div class="row my-4 m-2 border rounded shadow-sm bg-white ">
        <div class="col-md-4 rounded" style="background: url('<?php the_acadp_listing_thumbnail($post_meta) ?>'); background-size: cover; background-position: center; ">
            <a href="<?php the_permalink(); ?>">
                <div class="p-5"></div>
                <div class="p-5"></div>
                <div class="p-5"></div>
            </a>
        </div>

        <div class="col-md-8 p-3">
            <?php
            if ($can_show_category && $categories = wp_get_object_terms($post->ID, 'acadp_categories')) {
                $category_links = array();
                foreach ($categories as $category) {
                    $category_links[] = sprintf('<a href="%s">%s</a>', esc_url(acadp_get_category_page_link($category)), esc_html($category->name));
                }
                $categoriaNome = sprintf('%s', implode(', ', $category_links));
            }
            ?>
            <!-- TITULO -->
            <div class="acadp-listings-title-block mb-3 w-100">
                <small class="d-block text-muted">
                    <?= esc_html($category->name) ?>
                    <?php if ($post_meta['price'][0]) echo '| Venda'; ?>
                    <?php if ($post_meta['preco_aluguel'][0]) echo '| Aluga'; ?>
                </small>
                <span class="font-weight-lightx">
                    <a class="titulo-anuncio" href="<?php the_permalink(); ?>">
                        <?php echo esc_html(get_the_title()); ?>
                    </a>
                </span>
                <div class="w-100"></div>
                <?php the_acadp_listing_labels($post_meta); ?>
                <?php if ($post_meta['cidade'][0] && $post_meta['estado'][0]) : ?>
                    <div class="w-100"></div>
                    <small><?= $post_meta['cidade'][0] . ' - ' . $post_meta['estado'][0]  ?></small>
                <?php endif; ?>
                <div class="row mt-1">
                    <?php icones_anuncio($post_meta) ?>
                </div>

            </div>
            <!-- PRECO -->
            <div class="col-auto">
                <div class="row">
                    <div class="col-auto">
                        <?php
                        $price = acadp_format_amount($post_meta['price'][0]);
                        $precoAluguel = acadp_format_amount($post_meta['preco_aluguel'][0]); ?>
                        <!-- venda -->
                        <?php if ($post_meta['price'][0]) : ?>
                            <p class="lead acadp-no-margin font-weight-normal">
                                <?= esc_html(acadp_currency_filter($price)) ?>
                            </p>
                        <?php endif ?>
                        <!-- aluga -->
                        <?php if ($post_meta['preco_aluguel'][0]) : ?>
                            <p class="lead acadp-no-margin font-weight-normal">
                                <?= esc_html(acadp_currency_filter($precoAluguel)) . '<small> /mês </small>'; ?>
                            </p>
                        <?php endif ?>
                    </div>
                    <div class="col-auto">
                        <span class="acadp-favourites"><?php the_acadp_favourites_link(); ?></span>
                    </div>
                </div>
            </div>
            <!-- SELLER -->
            <div class="col-auto w-100 text-muted" style="font-size: 12px">
                <span>Anunciado por </span>
                <a style="text-decoration: none; color: var(--principal)" href="<?= esc_url(acadp_get_user_page_link($post->post_author)) ?>"><?= get_the_author() ?></a>
            </div>
            <!-- CATEGORIA -->
        </div>
    </div>
<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

<?php the_acadp_pagination($acadp_query->max_num_pages, "", $paged); ?>


<?php return; ?>