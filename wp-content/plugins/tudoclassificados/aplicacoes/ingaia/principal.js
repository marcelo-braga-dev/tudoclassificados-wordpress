let _checkeds_table = document.getElementsByClassName('linha-table-ingaia');
let btnIntegrarIngaia = document.getElementById('btn-integrar-ingaia');
let i;

btnIntegrarIngaia.disabled = true;

if (limite_check < 1) {
    for (i = 0; i < _checkeds_table.length; i++) {
        _checkeds_table[i].disabled = true;
    }
}

function alterar_checkeds_ingaia() {
    let qtd_check_ingaia = 0;

    for (i = 0; i < _checkeds_table.length; i++) {
        if (_checkeds_table[i].checked) {
            qtd_check_ingaia++;
        }
    }
    
    if (qtd_check_ingaia >= limite_check) {
        $('#modalLimiteImoveis').modal('show');

        for (i = 0; i < _checkeds_table.length; i++) {
            if (_checkeds_table[i].checked) {

            } else {
                _checkeds_table[i].disabled = true;
            }
        }
    } else {
        for (i = 0; i < _checkeds_table.length; i++) {
            _checkeds_table[i].disabled = false;
            btnIntegrarIngaia.disabled = true;
        }
    }

    btnIntegrarIngaia.disabled = qtd_check_ingaia < 1;
}