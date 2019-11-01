$(document).ready(function() { 

    $.ajax({
        type: 'GET',
        url: '../../esteiracomex/contratacao/resumo/conformidade',
        // url: '../../js/contratacao/tabela_minhas_demandas_contratacao.json',
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            // captura os arrays de demandas do json
            $.each(dados, function(key, item) {

            // monta a linha
                var linha = 
                    '<tr>' +
                        '<td>' + item.responsavelCeopc + '</td>' +
                        '<td>' + item.nomeCompleto + '</td>' +
                        '<td>' + item.prontoImportacao + '</td>' +
                        '<td>' + item.prontoImportacaoAntecipado + '</td>' +
                        '<td>' + item.prontoExportacao + '</td>' +
                        '<td>' + item.prontoExportacaoAntecipado + '</td>' +
                        '<td>' + item.total + '</td>' +
                    '</tr>';

                // popula a linha na tabela
                $(linha).appendTo('#tabelaDistribuidasAnalistas>tbody');
            });          
            
            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable();        
        
        }
    });

});
