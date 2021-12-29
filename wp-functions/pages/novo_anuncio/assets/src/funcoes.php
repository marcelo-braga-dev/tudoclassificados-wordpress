<?php
function bs4t_select_categorias($name, $excluir = [])
{
    $principais = [];
    $options = [];
    $select = [];

    $todas_categorias = get_terms('acadp_categories');

    foreach ($todas_categorias as $categoria) {
        if ($categoria->parent == '') {
            $principais[] =
                [
                    'id' => $categoria->term_id,
                    'nome' => $categoria->name
                ];
        }
    }
    $i = 0;
    foreach ($todas_categorias as $categoria) {
        foreach ($principais as $principal) {
            $options[$principal['id']]['primario_id'] = $principal['id'];
            $options[$principal['id']]['primario_nome'] = $principal['nome'];
            if ($categoria->parent == $principal['id']) {
                $options[$principal['id']]['secundario'][] =
                    [
                        'secundario_id' => $categoria->term_id,
                        'secundario_nome' => $categoria->name
                    ];
            }
        }
    }
    echo '<label class="mb-0">Categoria</label>';
    echo '<select data-placeholder="&nbsp;Selecione a categoria do anúncio" class="form-control acadp-category-listing select2" name="' . $name . '" style="width:100%">';
    echo '<option></option>';
    foreach ($options as $option) {
        if (!in_array($option['primario_id'], $excluir)) {
            echo '<optgroup class="border" label="' . $option['primario_nome'] . '">';

            foreach ($option['secundario'] as $secundario) {
                echo '<option value="'.$secundario['secundario_id'].'" style="font-size: 12px">' . $secundario['secundario_nome'] . '</option>';
            }
            echo '</optgroup>';
        }
    }
    echo '<select>';
}