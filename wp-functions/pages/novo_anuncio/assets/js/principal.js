$(function() {


    $('.radio-categoria').change(function() {
        $('.radio-categoria').removeClass('radio-categoria-ativo');
        $(this).addClass('radio-categoria-ativo');
    })

    $('#id-avancar').click(function(e) {

        $('#alerta-erros').hide();

        if ( ! $('.acadp-category-listing').is(':checked') && $('.acadp-category-listing').attr('data-exist') == 'true') {
            $('#mensagem-erro').text('Por favor, selecione a categoria do anúncio.');
            $('#alerta-erros').show();
            
            e.preventDefault();
        }

        if (!$('.acadp-image-field').val() && $('#acadp-images').attr('data-exist') == 'true') {
            $('#mensagem-erro').text('Por favor, insira imagens no anúncio.');
            $('#alerta-erros').show();

            e.preventDefault();
        }
    });

    $('.categoria-anuncio').click(function() {
        console.log($(this).attr('id-categoria'));

        var idCategoria = $(this).attr('id-categoria');

        if ( 
            idCategoria == 27 || 
            idCategoria == 31 || 
            idCategoria == 21 || 
            idCategoria == 32 || 
            idCategoria == 177 
            ) {

            $('.dimensionamento').attr('disabled', true);
            $('#frete-gratis').attr('disabled', true)

        } else {

            $('.dimensionamento').attr('disabled', false);
            $('#frete-gratis').attr('disabled', false);

        }
    });

    $('#frete-gratis').click(function () {
        console.log($(this).is(':checked'));
        if ($(this).is(':checked')) $('.dimensionamento').attr('disabled', true);
        else $('.dimensionamento').attr('disabled', false);
        
    });

    // $.LoadingOverlay("show");
});