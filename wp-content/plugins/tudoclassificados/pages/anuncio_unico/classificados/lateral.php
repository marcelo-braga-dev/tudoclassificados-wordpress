<div class="justify-content-center d-none d-lg-block my-3">
    <div class="col-auto text-right p-0">
        <a href="https://quin.to/drhpia?codigo=bpmGN" target="_blank">
            <img src="/wp-content/uploads/2021/11/banner-quadrado-quinto-andar.png" style="border-radius: 3px; width: 100%">
        </a>
    </div>
</div>

<div class="card m-0 p-3 mb-4">
    <?php if (is_user_logged_in()) : ?>
        <div class="row justify-content-center mb-2">
            <h3>Entre em contato com o Anunciante:</h3>
        </div>
        <?php
        $numCelular = $post_meta['phone'][0] ? $post_meta['phone'][0] : get_user_meta($post->post_author, 'celular')[0];
        if ($numCelular) : ?>
            <a href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/\D/', '', $numCelular) ?>" target="_blank" style="text-decoration:none;">
                <div class="row rounded align-items-center mx-2 mb-4 text-center btn-success">
                    <div class="col-3 p-2 m-0 rounded-left text-white" style="background: rgba(0,0,0,0.1);">
                        <i class="bi bi-whatsapp" style="font-size: 24px;"></i>
                    </div>
                    <div class="col-9 rounded-right text-white text-truncate">
                        <span style="font-size: 20px;"><?= $numCelular ?></span>
                    </div>
                </div>
            </a>
        <?php endif ?>
        <?php if ($post_meta['email'][0]) : ?>
            <a href="mailto:<?= $post_meta['email'][0] ?>" target="_blank" style="text-decoration:none;">
                <div class="row rounded align-items-center mx-2 mb-4 text-center btn-primary">
                    <div class="col-3 p-2 m-0 rounded-left text-white" style="background: rgba(0,0,0,0.1);">
                        <i class="bi bi-envelope" style="font-size: 24px;"></i>
                    </div>
                    <div class="col-9 rounded-right text-white text-truncate">
                        <span style="font-size: 20px;">E-MAIL</span>
                    </div>
                </div>
            </a>
        <?php endif ?>
    <?php else : ?>
        <div>
            <h4>Você precisa estar conectado para entrar em contato com o Anunciante.</h4>
        </div>
        <div>
            <a class="btn btn-primary text-white btn-block" data-toggle="modal" data-target="#modalExemplo" style="font-size: 16px;">
                Entrar
            </a>
        </div>
    <?php endif; ?>
</div>

<div class="d-none d-lg-block">
    <!-- Anuncio -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Vertical -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5788964970631749" data-ad-slot="5943342967" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>

 