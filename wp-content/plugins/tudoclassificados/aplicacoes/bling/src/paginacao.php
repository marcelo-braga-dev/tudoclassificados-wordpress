<?php
    $num_page = $_GET['page_bling'];
    if(!$num_page) $num_page = 1;

    if ($num_page === 1) {
        $num_page = 2;
        $pag_disabled_ant = 'disabled';
        $pag_disabled_1 = 'disabled';
    } else {
        $pag_disabled_2 = 'disabled';
    }
    $p1 = $num_page - 1;
    $p2 = $num_page;
    $p3 = $num_page + 1;

    if (!$p1) {
        $pag_esconder_1 = 'display:none;';
        $pag_disabled_ant = 'disabled';
    }
    if ($i < 100) {
        $esconder_pag = 'display:none;';
        $pag_disabled_pro = ' disabled';
    }
    if ($erro_14 || $num_page === 2 && $i < 100) {
        $esconder_opc_pag = 'style="display:none;"';
    }
    ?>
<nav aria-label="Navegação de página exemplo" <?php echo $esconder_opc_pag ?>>
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $pag_disabled_ant ?>" style="margin:0px">
            <a class="page-link" href="?page_bling=<?php echo $p1 ?>" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Anterior</span>
            </a>
        </li>
        <li class="page-item <?php echo $pag_disabled_1 ?>" style="margin:0px; <?php echo $pag_esconder_1 ?>">
            <a class="page-link" href="?page_bling=<?php echo $p1 ?>"><?php echo $p1 ?></a>
        </li>
        <li class="page-item <?php echo $pag_disabled_2 ?>" style="margin:0px">
            <a class="page-link" href="?page_bling=<?php echo $p2 ?>"><?php echo $p2 ?></a>
        </li>
        <li class="page-item <?php echo $pag_disabled_3 ?>" style="margin:0px;<?php echo $esconder_pag ?>">
            <a class="page-link" href="?page_bling=<?php echo $p3 ?>"><?php echo $p3 ?></a>
        </li>
        <li class="page-item <?php echo $pag_disabled_pro ?>" style="margin:0px">
            <a class="page-link" href="?page_bling=<?php echo $p3 ?>" aria-label="Próximo">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Próximo</span>
            </a>
        </li>
    </ul>
</nav>