$(function() {
    if (qtdComentarios) {
        $('#badge-comentarios').text(qtdComentarios);
    }

    $('.btn-salvar-comentario').click(function() {
        $.LoadingOverlay("show");

        var campo = $(this).parent().parent();
        var resposta = campo.find('.text-area').val().trim();
        var comentario_id = campo.find('.comentario-id').val().trim();
        console.log(comentario_id + ' - ' + $('#user_id_atual').val() + ' - ' + resposta);
        if (resposta) {
            $.post(
                '', {
                    comentario_id: comentario_id,
                    user_id: $('#user_id_atual').val(),
                    resposta: resposta,
                },
                function(resposta) {
                    campo.toggle(500);

                    qtdComentarios--;
                    if (!qtdComentarios) {
                        $('#alerta-comentarios').removeClass('d-none');
                        $('#badge-comentarios').remove();
                    }
                    $('#badge-comentarios').text(qtdComentarios);

                    $.LoadingOverlay("hide");
                }
            );
        }
    });

});