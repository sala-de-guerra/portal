
//formata data table
function _formataDatatable (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 2, "asc" ]],
        "columnDefs": [{
            "render": function(data){
             return parseFloat(data).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});},
            "targets": [4]},
            {type: 'date-uk', targets: [2,5]}],
        "pageLength": 25,
        "language": {
            "decimal": ",",
            "thousands": ".",
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
};

    $.getJSON('/contratacao/controle-boletos/listar-universo-a-vista', function(dados){
        $.each(dados, function(key, item) {
            let linha =
                `<tr>
                    <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.nuBEM}</a></td>
                    <td>${item.proponente}</td>
                    <td>${item.vencimento}</td>
                    <td id="vencimento${item.nuBEM + item.status}">${item.status}</td>
                    <td>${item.valorPagamento}</td>
                    <td id="pagamento${item.nuBEM + item.status}">${item.dataPagamento}</td>
                </tr>`

                    $(linha).appendTo('#tblControleDeBoletosAvista>tbody'); 
                    
                    
                    if($('#pagamento' + item.nuBEM + item.status).text() == "null" ){
                    $('#pagamento' + item.nuBEM + item.status).text("")
                    }
                    
        });
        _formataDatatable('tblControleDeBoletosAvista')
    })


    $.getJSON('/contratacao/controle-boletos/listar-universo-financiamento', function(dados){
        $.each(dados, function(key, item) {
            let linha =
                `<tr>
                    <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.nuBEM}</a></td>
                    <td>${item.proponente}</td>
                    <td id="vencimento${item.nuBEM + item.status}">${item.vencimento}</td>
                    <td>${item.status}</td>
                    <td>${item.valorPagamento}</td>
                    <td id="pagamento${item.nuBEM + item.status}">${item.dataPagamento}</td>
                </tr>`
                    $(linha).appendTo('#tblControleDeBoletosFinanciado>tbody');
                    
                    if($('#pagamento' + item.nuBEM + item.status).text() == "null" ){
                        $('#pagamento' + item.nuBEM + item.status).text("")
                    }
        });
        _formataDatatable('tblControleDeBoletosFinanciado')
    })

//formata data table Novos
function _formataDatatableNovos (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 2, "desc" ]],
        "columnDefs": [{
            "render": function(data){
             return parseFloat(data).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});},
            "targets": [2]},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
};


    $.getJSON('/contratacao/controle-boletos/listar-pagamentos-novos', function(dados){
        $.each(dados, function(key, item) {
            let linha =
                `<tr>
                    <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.nuBEM}</a></td>
                    <td>${item.proponente}</td>
                    <td>${item.valorPagamento}</td>
                    <td id="status${item.nuBEM}"></td>
                </tr>`
                    $(linha).appendTo('#tblControleDeBoletosNovos>tbody');

                if(item.totalProposta == item.valorPagamento){
                    $('#status' + item.nuBEM).text("À Vista")
                }else{
                    $('#status' + item.nuBEM).text("Financiamento")
                }
                    
        });
        _formataDatatableNovos('tblControleDeBoletosNovos')
    })
