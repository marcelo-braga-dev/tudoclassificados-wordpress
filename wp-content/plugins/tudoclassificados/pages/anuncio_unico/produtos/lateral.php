<div class="border p-4 rounded my-3 shadow-sm">
    <?php if (is_user_logged_in()) { ?>
        <div>
            <h4>Entre em contato com o Anunciante:</h4>
        </div>
        <div class="row justify-content-center">
            <?php if ($post_meta['phone'][0]) : ?>
                <div class="col-md-12">
                    <a class="btn btn-success text-white btn-block" href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/\D/', '', $post_meta['phone'][0]) ?>" target="_blank" style="font-size: 16px;">
                        <i class="bi bi-whatsapp"></i>&nbsp;
                        <?= $post_meta['phone'][0] ?>
                    </a>
                </div>
            <?php endif ?>
            <?php if ($post_meta['website'][0]) : ?>
                <div class="col-md-6">
                    <a class="btn btn-danger text-white btn-block" href="<?= $post_meta['website'][0] ?>" target="_blank" style="font-size: 16px;">
                        <i class="bi bi-globe"></i>&nbsp;
                        SITE
                    </a>
                </div>
            <?php endif ?>
            <?php if ($post_meta['email'][0]) : ?>
                <div class="col-md-6">
                    <a class="btn btn-primary text-white btn-block" href="mailto:<?= $post_meta['email'][0] ?>" target="_blank" style="font-size: 16px;">
                        <i class="bi bi-envelope"></i>&nbsp;
                        E-mail
                    </a>
                </div>
            <?php endif ?>
        </div>

    <?php } else { ?>
        <div>
            <h4>Você precisa estar conectado para entrar em contato com o Anunciante.</h4>
        </div>
        <div>
            <a class="btn btn-primary text-white btn-block" data-toggle="modal" data-target="#modalExemplo" style="font-size: 16px;">
                Entrar
            </a>
        </div>
    <?php } ?>
</div>

<div class="p-2 justify-content-center d-none d-lg-block">
    <div class="col-auto text-right">
        <img src="/wp-content/plugins/tudoclassificados/imagens/marketing/lateral-1.jpeg" style="border-radius: 3px;">
        <div class="w-100"></div>
        <small>Anuncie aqui</small>
    </div>
</div>