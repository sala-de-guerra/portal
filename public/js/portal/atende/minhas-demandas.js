$(document).ready(function(){  
    $.getJSON('/atende/listar-demandas-disponiveis', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                '<tr>' +
                    '<td>' + item.nomeAtividade + '</td>' +
                    '<td>' + item.nomeAtividade + '</td>' +
                    '<td>' + item.nomeAtividade + '</td>' +
                    '<td>' + item.assuntoAtende + '</td>' +
                    '<td>' + item.nomeAtividade + '</td>' +
                    '<td>' + item.descricaoAtende + '</td>' +
                '</tr>' 
        $(linha).appendTo('#tblminhasDemandas>tbody');

        })
    })
})