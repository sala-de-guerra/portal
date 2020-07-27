    
var csrfVar = $('meta[name="csrf-token"]').attr('content');

function _formataDatatableComId (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "desc" ]],
        "columnDefs": [{
            "render": function(data){
             return parseFloat(data).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});},
            "targets": [2]
            }],
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


$(document).ready(function(){
    $.getJSON('/tma-venda-a-vista', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                `<tr>
                    <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                    <td>${item.CLASSIFICACAO}</td>
                    <td>${item.PAGAMENTO_BOLETO}</td>
                    <td>${item.DIAS_DECORRIDOS}</td>
                    <td>${item.NOME_PROPONENTE}</td>
                    <td>${item.CPF_CNPJ_PROPONENTE}</td>
                </tr>`       
        
            $(linha).appendTo('#tblTma>tbody');
            }
        )}
    ).done(function() {
        _formataDatatableComId('tblTma')
         $('.spinnerTbl').remove()
    })
})
