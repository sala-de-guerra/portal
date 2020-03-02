
$(document).ready( function () {

    $.getJSON('js/relacao_cidades_por_gilie.json', function(dados){

        $.each(dados, function(key, item) {
            let linha =
                '<tr>' +
                    '<td>' + item.GILIE + '</td>' +
                    '<td>' + item.MUNICIPIO + '</td>' +
                    '<td>' + item.SR + '</td></td>' +
                '</tr>';
    
            $(linha).appendTo('#tbl_area_atuacao>tbody');
        });
        
        //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
        _formataDatatable ();
    });

});

