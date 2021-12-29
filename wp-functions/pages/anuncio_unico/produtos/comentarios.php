<?php include_once ABSPATH . 'wp-functions/pages/anuncio_unico/produtos/assets/php/db_comentarios.php'; ?>
<?php if (is_user_logged_in()) { ?>
    <div class="w-100">
        <h5>Pergunte ao vendedor</h5>
        <small class="text-muted w-100">Não é permitido enviar infomaçoes pessoais ou links externos.</small>
        <div class="w-100"></div>
        <div id="alerta-comentario"></div>
        <div class="w-100"></div>

        <textarea id="campo-nova-pergunta" class="rounded mb-2 w-100"></textarea>
        <div class="row justify-content-end mb-4">
            <div class="col-auto">
                <input type="hidden" id="id-post" value="<?= $post->ID ?>">
                <input type="hidden" id="id-user" value="<?= get_current_user_id() ?>">
                <input type="hidden" id="id-anunciante" value="<?= $post->post_author ?>">
                <button id="btn-nova-pergunta" class="btn btn-primary rounded btn-block">Enviar</button>
            </div>
        </div>
        <div id="primeiro-comentario"></div>

    </div>
<?php } else { ?>
    <div>
        <h4>Você precisa estar conectado para fazer sua pergunta ao vendedor.</h4>
    </div>
    <div>
        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#modalExemplo">
            Entrar
        </a>
    </div>
    <hr>
<?php } ?>
<?php if (count($comentarios)) : ?>
    <h5>Perguntas Recentes</h5>
    <?php
    foreach ($comentarios as $comentario) :
    ?>
        <div class="shadow-sm p-3 border rounded mb-3">
            <i class="fas fa-chevron-right" style="font-size:10px"></i>&nbsp;
            <span>
                <?= ucfirst(filtrar_texto($comentario->pergunta)) ?>
                <small class="text-muted font-weight-light font-italic"><?= $comentario->data_pergunta ?></small>
            </span>
            <div class="w-100"></div>
            <div class="col-11">
                <span class="text-muted">
                    <?= ucfirst(filtrar_texto($comentario->resposta)) ?>
                    <small class="text-muted font-weight-light font-italic"><?= $comentario->data_resposta ?></small>
                </span>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>