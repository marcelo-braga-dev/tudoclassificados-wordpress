(function() {
    var selectEstados = $('#estados'),
        selectCidades = $('#cidades');

    var url = '/wp-content/plugins/tudoclassificados/assets/js/cidade-estado-select/db-estados-cidades.json';

    preencheEstados();

    function preencheEstados() {
        $.getJSON(url, function(data) {
            var options = "<option value=''>Selecione um estado</option>";

            $.each(data.estados, function(key, val) {
                options += "<option value='" + val.sigla + "'> " + val.nome + "</option>";
            });

            selectEstados.html(options);

            selectEstados.on('change', function() {
                preencheCidade(data);
            });

            cidadeAnuncio(data);


        });
    }

    function cidadeAnuncio(data) {
        if (estado) {

            selectEstados.val(estado).select2();
            preencheCidade(data);
            selectCidades.val(cidade).select2();
        }
    }


    function preencheCidade(data) {
        var estado = data.estados.find(function(estado) {
            return selectEstados.val() === estado.sigla;
        })
        var options = "<option value=''>Selecione uma cidade</option>";
        $.each(estado.cidades, function(key, val) {
            options += "<option value='" + val + "'> " + val + "</option>";
        });
        selectCidades.html(options);
        $('.cidade-select').show();
    }

})();