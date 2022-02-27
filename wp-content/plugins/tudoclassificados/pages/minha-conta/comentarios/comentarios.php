<?php
global $wpdb;
include_once ABSPATH . 'wp-content/plugins/tudoclassificados/pages/minha-conta/assets/php/db_comentarios.php';

$table = 'class_imp_comentarios';
$user_id = get_current_user_id();

$comentarios = $wpdb->get_results("SELECT * FROM $table WHERE anunciante_id = $user_id AND resposta = '' ORDER BY id DESC");

$qtdComentarios = count($comentarios);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h3 class="mb-0">Comentários</h3>
                    </div>
                    <div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fas fa-comment"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                foreach ($comentarios as $comentario) : ?>
                    <div class="card shadow-sm p-3 m-3 border rounded mb-3">
                        <div>
                            <h5><?= get_the_title($comentario->post_id); ?></h5>
                        </div>
                        <div class="w-100"></div>
                        <span class="mb-3">
                                            <i class="fas fa-chevron-right" style="font-size:10px"></i>&nbsp;
                                            <?= ucfirst(filtrar_texto($comentario->pergunta)) ?>
                                            <small class="text-muted font-weight-light font-italic"><?= $comentario->data_pergunta ?></small>
                                        </span>
                        <div class="w-100"></div>
                        <div class="col-11">
                            <textarea class="form-control text-area"></textarea>
                            <input class="comentario-id" type="hidden" value="<?= $comentario->id ?>">
                            <button class="btn btn-primary btn-salvar-comentario">Salvar</button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <input type="hidden" id="user_id_atual" value="<?= $user_id ?>">

                <div id="alerta-comentarios" class="m-3 <?php if ($qtdComentarios > 0) echo 'd-none'; ?>"><span>Não há comentários para responder.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var qtdComentarios = <?= $qtdComentarios ?>;
</script>
