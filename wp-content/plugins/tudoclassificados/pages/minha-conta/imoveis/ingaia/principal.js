let checkbox_ingaia = document.getElementsByClassName('linha-table-ingaia');
let btnIntegrarIngaia = document.getElementById('btn-integrar-ingaia');
let i;

if (limite_disponivel_imoveis < 1) {
    for (i = 0; i < checkbox_ingaia.length; i++) {
        checkbox_ingaia[i].disabled = true;
    }
    btnIntegrarIngaia.disabled = true;
}

function alterar_checkeds_ingaia() {
    let qtd_check_ingaia = 0;

    for (i = 0; i < checkbox_ingaia.length; i++) {
        if (checkbox_ingaia[i].checked) {
            qtd_check_ingaia++;
        }
    }
    
    if (qtd_check_ingaia >= limite_disponivel_imoveis) {
        $('#modalLimiteImoveis').modal('show');

        for (i = 0; i < checkbox_ingaia.length; i++) {
            if (!checkbox_ingaia[i].checked) {
                checkbox_ingaia[i].disabled = true;
            }
        }
    } else {
        for (i = 0; i < checkbox_ingaia.length; i++) {
            checkbox_ingaia[i].disabled = false;
        }
    }
}