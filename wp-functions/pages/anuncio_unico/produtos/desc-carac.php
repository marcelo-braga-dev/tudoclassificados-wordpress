<div class="w-100 mb-4 px-4">
    <h6>Descrição</h6>
    <span>
        <?= filtrar_texto(nl2br(wp_kses_post($description))); ?>
    </span>
</div>





<!-- <div class="table-responsive mb-4">
    <h5 class="mt-4 px-3">Descrição</h5>
    <table class="table table-hover rounded border">
        <tbody>
            <?php
            $ids_filds = $classProdutos->preencherTabela();

            foreach ($ids_filds as $id_fild) {
                if ($post_meta[$id_fild['id']][0]) { ?>
                    <tr>
                        <th scope="row" style="width:35%"><?= $id_fild['post_title'] ?></th>
                        <td><?= ucwords($post_meta[$id_fild['id']][0]) ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div> -->