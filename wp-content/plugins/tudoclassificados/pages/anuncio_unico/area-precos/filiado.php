<div class="card m-0 p-3 mb-4">
    <div class="d-block text-right">
        <?php the_acadp_social_sharing_buttons(); ?>
    </div>
    <div class="d-block m-0">
        <small><?= get_term($category->term_taxonomy_id)->name; ?></small>
        <small>
            <?php //if ($post_meta['price'][0]) echo 'Venda'; 
            ?>
        </small>
        <span class="d-block titulo-anuncio">
            <?php echo esc_html($post->post_title); ?>
        </span>
    </div>
    <div class="d-block mb-0">
        <?php the_acadp_listing_labels($post_meta); ?>
    </div>

    <!-- Precos -->
    <div class="d-block my-3">
        <div class="row">
            <div class="col-auto" style="font-size:30px">
                <?php
                $price = acadp_format_amount($post_meta['price'][0]);
                $precoAluguel = acadp_format_amount($post_meta['preco_aluguel'][0]);
                ?>
                <!-- venda -->
                <?php if ($post_meta['price'][0]) : ?>
                    <p class="lead acadp-no-margin font-weight-normal" style="font-size: 22px">
                        <?= esc_html(acadp_currency_filter($price)); ?>
                    </p>
                <?php endif ?>
            </div>
            <div class="col-1 align-self-center" style="font-size:24px">
                <span id="" class="acadp-favourites"><?php the_acadp_favourites_link(); ?></span>
            </div>
        </div>
    </div>

    <!-- SITE EXTERNO -->
    <a href="<?= tc_montar_url($post_meta['link_externo'][0]) ?>" target="_blank" style="text-decoration:none;">
        <div class="row rounded align-items-center mx-2 mb-4 text-center btn-info">
            <div class="col-2 p-2 m-0 rounded-left text-white" style="background: rgba(0,0,0,0.1);">
                <i class="bi bi-box-arrow-up-right" style="font-size: 24px;"></i>
            </div>
            <div class="col-10 rounded-right text-white text-truncate">
                <span style="font-size: 16px;">IR PARA O SITE DE VENDA</span>
            </div>
        </div>
    </a>

    <div class="d-block mb-2">
        <small>
            Anunciado por <?php echo '<a href="' . esc_url(acadp_get_user_page_link($post->post_author)) . '" style="color: #1e4b75">' . get_the_author() . '</a>'; ?>
        </small>
    </div>
</div>