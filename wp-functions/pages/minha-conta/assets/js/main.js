$(function () {
    var qtdImovelAtivo = $('#qtd-imovel-ativo').val();
    var qtdGeralAtivo = $('#qtd-geral-ativo').val();

    if (qtdImovelAtivo > maxPremiumImovel) {
        $('.btn-premium-imovel').attr('disabled', true);
    }
    if (qtdGeralAtivo > maxPremiumImovel) {
        $('.btn-premium-geral').attr('disabled', true);
    }

    $('.btn-premium').change(function () {
        var valor = 0;
        var post_id = $(this).attr('post-id');

        if ($(this).is(':checked')) {
            valor = 1;

            if ($(this).attr('tipo') == '27') {
                maxPremiumImovel--;
                if (maxPremiumImovel < 1) {
                    $('.btn-premium-imovel').attr('disabled', true);
                }
                console.log(maxPremiumImovel);
            } else {
                maxPremiumGeral--;
                if (maxPremiumGeral < 1) {
                    $('.btn-premium-geral').attr('disabled', true);
                }
                console.log(maxPremiumGeral);
            }
        }

        if (maxPremiumGeral) { }
        $.LoadingOverlay("show");
        $.post(
            '', {
            'user_id': $('#user_id_atual').val(),
            'valor': valor,
            'post_id': post_id,
            'editar-premium': true
        },
            function (resposta) {
                $.LoadingOverlay("hide");

            }
        );

    });
});