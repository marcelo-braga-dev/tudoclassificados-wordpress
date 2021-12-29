<?php
if (!empty($_GET['frete'])) {
    $frete = explode(';', $_GET['frete']);

    $fretePreco = $frete[0];
    $freteTipo = $frete[1];
    $freteDias = $frete[2];
}

?>
<div class="card m-0 p-3 mb-4">
    <div class="d-block text-right">
        <?php the_acadp_social_sharing_buttons(); ?>
    </div>
    <div class="d-block m-0">
        <small><?= get_term($category->term_taxonomy_id)->name; ?></small>
        <small>
            <?php if ($post_meta['price'][0]) echo 'Venda'; ?>
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
                <?php $price = acadp_format_amount($post_meta['price'][0]); ?>
                <!-- venda -->
                <?php if ($price) : ?>
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

    <?php
    if ($post_meta['frete_gratis'][0] == 'S') : ?>
        <div class="col-12">
            <div class="alert alert-success">
                FRETE GRÁTIS
            </div>
        </div>
        <?php else :

        $cep_anunciante = get_user_meta($post->post_author)['cep'][0];

        if (
            !empty($cep_anunciante) &&
            !empty($post_meta['peso'][0]) &&
            !empty($post_meta['comprimento'][0]) &&
            !empty($post_meta['altura'][0]) &&
            !empty($post_meta['largura'][0])
        ) :
        ?>

            <div class="row mb-3">
                <div class="col-auto align-self-end">
                    <small><b>Consulte o valor do frete</b></small>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text" for="consulta-frete">Cep</div>
                        </div>
                        <input style="width: 8rem;" type="text" class="form-control" id="consulta-frete" value="<?= $_GET['cep_pesquisado'] ?>" data-mask="00000-000" placeholder="00000-000">
                    </div>
                    <a class="small d-block" target="_blank" href="https://buscacepinter.correios.com.br/app/endereco/index.php">
                        Não sei o CEP
                    </a>
                    <input type="hidden" id="cep-origem" value="<?= $cep_anunciante ?>">
                    <input type="hidden" id="peso-produto" value="<?= $post_meta['peso'][0] ?>">
                    <input type="hidden" id="comprimento-produto" value="<?= $post_meta['comprimento'][0] ?>">
                    <input type="hidden" id="altura-produto" value="<?= $post_meta['altura'][0] ?>">
                    <input type="hidden" id="largura-produto" value="<?= $post_meta['largura'][0] ?>">
                </div>
            </div>

            <?php if ($fretePreco) : ?>
                <div class="row mb-3">
                    <div class="col-12">
                        <?php
                        $preco = str_replace(',', '.', $price);
                        $frete = str_replace(',', '.', $fretePreco);
                        $precoFinal = str_replace('.', ',', $preco + $frete);
                        ?>
                        <small>Frete: <b>RS <?= $fretePreco ?></b></small>
                    </div>
                    <div class="col-12">
                        <small>Preço Final: </small>
                        <span><b>R$ <?= $precoFinal ?></b></span>
                    </div>
                </div>
            <?php endif ?>

        <?php endif ?>

    <?php endif ?>

    <?php if (empty($_GET['frete'])) : ?>
        <div class="alert alert-info" id="alert-cep" style="display: none">
            Por favor, calcule o valor do frete.
        </div>
        <button class="btn btn-success rounded mb-3 btn-block" id="btn-comprar" style="font-size: 18px" onclick="alertCep(this)">
            COMPRAR
        </button>

    <?php else : ?>
        <form action="/checkout-marketplace-mercadopago" class="mb-0">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="id" value="<?= $post->ID ?>">
                    <input type="hidden" name="cep" value="<?= $_GET['cep_pesquisado'] ?>">
                    <input type="hidden" name="frete_valor" value="<?= $fretePreco ?>">
                    <input type="hidden" name="frete_tipo" value="<?= $freteTipo ?>">
                    <input type="hidden" name="frete_prazo" value="<?= $freteDias ?>">
                    <button class="btn btn-success rounded mb-3 btn-block" style="font-size: 18px">
                        COMPRAR
                    </button>
                </div>
            </div>
        </form>
    <?php endif ?>

    <div class="d-block">
        <small>
            Anunciado por <?php echo '<a href="' . esc_url(acadp_get_user_page_link($post->post_author)) . '" style="color: #1e4b75">' . get_the_author() . '</a>'; ?>
        </small>
    </div>
</div>

<script>
    function alertCep(e) {
        $('#alert-cep').show();
    }
</script>