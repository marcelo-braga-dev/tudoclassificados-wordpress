<h5 class="mb-0">Mais Vendidos X</h5>
<div class="card-deck center slider2">
    <?php
    $query = $classProdutos->produtosRelacionados();

    foreach ($query->posts as $anuncio) :
        $i++;
        if ($i > 8) break;
        $meta_dados = get_post_meta($anuncio->ID, '', true);

        $url_anuncio_img = get_post($meta_dados['_thumbnail_id'][0], ARRAY_A);
        ?>a
        <div class="card shadow border p-2 m-3">
            <div>
                <a href="<?= $anuncio->guid ?>">
                    <?php
                    if (!preg_match('/\/$/', $url_anuncio_img['guid'])) { ?>
                        <img class="mx-auto" style="height:200px;" src="<?= $url_anuncio_img['guid'] ?>" alt="Imagem de capa do card">
                    <?php } else {
                        echo '<div style="height:200px;"></div>';
                    } ?>
                </a>
            </div>
            <div class="border-top px-2 pt-2">
                <span style="font-size:18px">R$ <?= number_format($meta_dados['price'][0],2,',','.')  ?></span>
                <div class="w-100"></div>
                <!-- <small class="card-title w-100">em 3x R$ 23,23</small> -->
            </div>
            <div class="bg-white px-2 pt-0 animado">
                <a href="<?= $anuncio->guid ?>">
                    <small class="text-muted">
                        <?php
                        $max_len = 40;
                        echo  bs4_limitar_texto($anuncio->post_title, $max_len);
                        ?>
                    </small>
                </a>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>


