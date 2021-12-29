<?php
function icones_anuncio($args)
{ ?>
    <style>
        .icone-imovel {
            height: 25px !important;
        }
    </style>
    <?php if ($args['506'][0]) : ?>
        <div class="col-auto text-center">
            <span class="text-center">
                <img class="icone-imovel" src="/wp-functions/imagens/icones/double-bed.png"><br>
                <small><?= $args['506'][0] ?> quartos</small>
            </span>
        </div>
    <?php endif ?>
    <?php if ($args['508'][0]) : ?>
        <div class="col-auto text-center">
            <span class="text-center">
                <img class=icone-imovel src="/wp-functions/imagens/icones/public-toilet.png"><br>
                <small><?= $args['508'][0] ?> banheiros</small>
            </span>
        </div>
    <?php endif ?>
    <?php if ($args['509'][0]) : ?>
        <div class="col-auto text-center">
            <span class="text-center">
                <img class=icone-imovel src="/wp-functions/imagens/icones/car.png"><br>
                <small><?= $args['509'][0] ?> vagas</small>
            </span>
        </div>
    <?php endif ?>
    <?php if ($args['512'][0]) : ?>
        <div class="col-auto text-center">
            <span class="text-center">
                <img class=icone-imovel src="/wp-functions/imagens/icones/double-bed.png"><br>
                <small><?= $args['512'][0] ?> suites</small>
            </span>
        </div>
    <?php endif ?>
    <?php if ($args['510'][0]) : ?>
        <div class="col-auto text-center">
            <span class="text-center">
                <img class=icone-imovel src="/wp-functions/imagens/icones/ruler.png"><br>
                <small><?= $args['510'][0] ?>m² útil</small>
            </span>
        </div>
    <?php endif ?>
    <?php if ($args['511'][0]) : ?>
        <div class="col-auto text-center">
            <span class="text-center">
                <img class=icone-imovel src="/wp-functions/imagens/icones/ruler.png"><br>
                <small><?= $args['511'][0] ?>m² total</small>
            </span>
        </div>
    <?php endif ?>
<?php
}
