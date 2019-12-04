
$(document).ready( function () {

    $.getJSON('js/relacao_cidades_por_gilie.json', function(dados){

        $.each(dados, function(key, item) {
            var linha =
                '<tr>' +
                    '<td>' + item.GILIE + '</td>' +
                    '<td>' + item.MUNICIPIO + '</td>' +
                    '<td>' + item.PV + '</td>' +
                    '<td>' + item.SR + '</td></td>' +
                '</tr>';
    
            $(linha).appendTo('#tbl_area_atuacao>tbody');
        });
        
        $('#tbl_area_atuacao').DataTable();

    });

});

