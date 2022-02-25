<!-- Descricao -->
<div class="card p-3 mb-3">
    <div class="row">
        <div class="col-12">
            <h5 class="d-block"><b>Descrição</b></h5>
            <div class="w-100"></div>
            <span>
                <?= filtrar_texto(nl2br(wp_kses_post($description))); ?>
            </span>
        </div>
    </div>
</div>

<!-- Maps -->
<?php if ($post_meta['latitude'][0] != 0 && $post_meta['longitude'][0] != 0 && $category->parent == '27') : ?>
    <div class="card p-lg-3 mb-3">
        <div class="row m-1">
            <div class="col-12">
                <fieldset>
                    <span><b>Localização do Imóvel</b></span>
                    <div class="embed-responsive embed-responsive-16by9 acadp-margin-bottom" data-type="single-listing">
                        <div class="acadp-map embed-responsive-item">
                            <div class="marker" data-latitude="<?= $post_meta['latitude'][0] ?>" data-longitude="<?= $post_meta['longitude'][0] ?>"></div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
<?php endif; ?>