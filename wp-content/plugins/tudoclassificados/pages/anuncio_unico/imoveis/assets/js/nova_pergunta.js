$(function() {
    $('#btn-nova-pergunta').click(function() {
        var pergunta = $('#campo-nova-pergunta').val();
        if (pergunta) {
            $.LoadingOverlay("show");
            $.post(
                '', {
                    post_id: $('#id-post').val(),
                    user_id: $('#id-user').val(),
                    anunciante_id: $('#id-anunciante').val(),
                    pergunta: pergunta,
                },
                function(resposta) {
                    var mensagem =
                        '<div class="alert alert-success">' +
                        'Sua pergunta foi enviada ao anunciante.' +
                        '</div>';
                    $('#alerta-comentario').after(mensagem);
                    $('#campo-nova-pergunta').val('');

                    var novaMensagem =
                        '<div class="shadow-sm p-3 border rounded mb-3">' +
                        '<i class="fas fa-chevron-right" style="font-size:10px"></i>&nbsp;' +
                        '<span>' +
                        pergunta +
                        ' <small class="text-muted font-weight-light font-italic">agora</small>' +
                        '</span>' +
                        '</div>';
                    $('#primeiro-comentario').after(novaMensagem);
                    $.LoadingOverlay("hide");
                }
            );
        }
    });
});