$(function() {

    $('#consulta-frete').change(function() {

       $('#tabela-frete').children().remove();
       var cep = $(this).val().replace(/\D/g, '');

       if (cep !== "") {
          var validacep = /^[0-9]{8}$/;
          if (validacep.test(cep)) {

             $.LoadingOverlay("show");

             $.post(
                "/wp-content/plugins/tudoclassificados/aplicacoes/consulta-correios/consulta-frete.php", {
                   'cep_destino': cep,
                   'cep_origem': $('#cep-origem').val(),
                   'peso_produto': $('#peso-produto').val(),
                   'comprimento_produto': $('#comprimento-produto').val(),
                   'altura_produto': $('#altura-produto').val(),
                   'largura_produto': $('#largura-produto').val(),
                },
                function(result) {

                   result = jQuery.parseJSON(result);


                   var linhas = '';
                   var tabela = '';

                   $.each(result, function(index, linha) {

                      if (linha.Erro == '-3') {
                         tabela =
                            '<div class="col-auto alert alert-danger">' +
                                'Cep não encontrado.' +
                            '</div>';
                      } else {

                         if (linha.PrazoEntrega > 0) {
                            linhas +=
                               '<tr>' +
                               '<th class="text-center px-0 m-0">' +
                                    '<input class="valor-frete m-0 px-0" type="radio" name="frete" value="'+
                                    linha.Valor + ';' + linha.Tipo + ';' + linha.PrazoEntrega +
                                    '" required>'+ 
                                '</th>' +
                               '<td class="bg-white">' + linha.Tipo + '</td>' +
                               '<td class="bg-white">R$ ' + linha.Valor + '</td>' +
                               '<td class="bg-white">' + linha.PrazoEntrega + ' dias</td>' +
                               '</tr>';
                         }
                      }
                   });

                   if (linhas !== '') {
                      tabela =
                        '<div class="table-responsive">'+
                            '<table class="table table-sm table-borderless">' +
                                '<thead>' +
                                    '<tr>' +
                                        '<th scope="col"></th>' +
                                        '<th scope="col">Serviço</th>' +
                                        '<th scope="col">Valor</th>' +
                                        '<th scope="col">Prazo</th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                    linhas +
                                '</tbody>' +
                            '</table>' + 
                        '</div> ' +
                        '<input type="hidden" name="cep_pesquisado" value="'+cep+'">';
                   } else {
                      tabela =
                         '<div class="col-auto alert alert-info">' +
                         'Não há frete disponível para esse produto.' +
                         '</div>';
                   }

                    $('#inserir-tabela-frete').children().remove();
                   $('#inserir-tabela-frete').append(tabela);
                   $('#modalEscolhaFrete').modal('show');
                   // $('#btn-add-frete').show();


                }).always(function() {
                $.LoadingOverlay("hide");
             });
          }
       }
    });
 });