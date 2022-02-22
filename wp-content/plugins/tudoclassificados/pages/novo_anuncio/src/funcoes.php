<?php

function bs4t_aba_categorias($name, $excluir = [])
{
    $principais = [];
    $options = [];

    $args =  array(
        'taxonomy'                    => 'acadp_categories',
        'hide_empty'                => false,
        'update_term_meta_cache'    => false,
    );

    $todas_categorias = get_terms($args);

    foreach ($todas_categorias as $categoria) {
        if ($categoria->parent < 1) {
            $principais[] =
                [
                    'id' => $categoria->term_id,
                    'nome' => $categoria->name
                ];
        }
    }

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
?>

    <div class="row bg-white">
        <div class="col-6 col-lg-4">
            <!-- Grupo de lista -->
            <div class="list-group categoria-novo-anunio" id="minhaLista" role="tablist">
                <?php $abaAtiva = 'active';
                foreach ($options as $option) {
                    echo '
                        <a class="list-group-item list-group-item-action categoria-anuncio ' . $abaAtiva . '" data-toggle="list" id-categoria="' . $option['primario_id'] . '" href="#id' . $option['primario_id'] . '" role="tab">
                            ' . $option['primario_nome'] . '
                        </a>
                        ';
                    $abaAtiva = '';
                }
                ?>
            </div>
        </div>
        <div class="col-6 col-lg-4 border-left">
            <!-- Painel de abas -->
            <div class="tab-content">
                <?php
                $abaAtiva = 'show active';
                $idRadio = 0;

                foreach ($options as $option) {
                    echo '<div class="tab-pane fade ' . $abaAtiva . ' py-2 categoria-novo-anunio" id="id' . $option['primario_id'] . '" role="tabpanel">';

                    foreach ($option['secundario'] as $secundario) {
                        echo '<label for="id-' . $idRadio . '" class="w-100 p-1 radio-categoria">
                        <input  type="radio" 
                                style="display: none" 
                                class="acadp-category-listing" 
                                name="' . $name . '" 
                                id="id-' . $idRadio . '" 
                                value="' . $secundario['secundario_id'] . '" 
                                data-exist="true" 
                                required>
                        ' . $secundario['secundario_nome'] . '</label>';
                        $idRadio++;
                    }

                    echo '</div>';

                    $abaAtiva = '';
                }
                ?>
            </div>
        </div>
    </div>

<?php
}
