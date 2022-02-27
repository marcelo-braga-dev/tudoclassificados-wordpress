<?php
function icones_anuncio_imoveis($args)
{ ?>
    <?php if ($args['506'][0]) : ?>
    <div class="col-auto text-center">
            <span class="text-center">
                <img src="<?= TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/icones/double-bed.png' ?>"
                     style="height: 40px;"><br>
                <small><?= $args['506'][0] ?> quartos</small>
            </span>
    </div>
<?php endif ?>
    <?php if ($args['508'][0]) : ?>
    <div class="col-auto text-center">
            <span class="text-center">
                <img src="<?= TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/icones/public-toilet.png' ?>"
                     style="height: 40px;"><br>
                <small><?= $args['508'][0] ?> banheiros</small>
            </span>
    </div>
<?php endif ?>
    <?php if ($args['509'][0]) : ?>
    <div class="col-auto text-center">
            <span class="text-center">
                <img src="<?= TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/icones/car.png' ?>" style="height: 40px;"><br>
                <small><?= $args['509'][0] ?> vagas</small>
            </span>
    </div>
<?php endif ?>
    <?php if ($args['512'][0]) : ?>
    <div class="col-auto text-center">
            <span class="text-center">
                <img src="<?= TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/icones/double-bed.png' ?>"
                     style="height: 40px;"><br>
                <small><?= $args['512'][0] ?> suites</small>
            </span>
    </div>
<?php endif ?>
    <?php if ($args['510'][0]) : ?>
    <div class="col-auto text-center">
            <span class="text-center">
                <img src="<?= TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/icones/ruler.png' ?>" style="height: 40px;"><br>
                <small><?= $args['510'][0] ?>m² útil</small>
            </span>
    </div>
<?php endif ?>
    <?php if ($args['511'][0]) : ?>
    <div class="col-auto text-center">
            <span class="text-center">
                <img src="<?= TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/icones/ruler.png' ?>" style="height: 40px;"><br>
                <small><?= $args['511'][0] ?>m² total</small>
            </span>
    </div>
<?php endif ?>
    <?php
} ?>