var csrfVar = $('meta[name="csrf-token"]').attr('content');

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "asc" ]],

       columnDefs: [
           {type: 'date-uk', targets: [6]} //vai filtrar a coluna com data dd/mm/yyyy
       ],

        "pageLength": 25,
        "language": {
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
}


/*

$(document).ready(function(){
    $.getJSON('/controle-arquivos/lista', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                '<tr>' +
                '<td><a href="/consulta-bem-imovel/'+ item.Contrato +'" class="cursor-pointer">' + item.Contrato + '</a></td>' +
                    '<td>' + item.Caixa + '</td>' +
                    '<td>' + item.Silog + '</td>' +
                    '<td>' + item.Matricula + '</td>' +
                    '<td>' + item.GILIE + '</td>' +
                    '<td>' + item.created_at + '</td>' +
                '</tr>';          
    
    $(linha).appendTo('#tblimportexcel>tbody');
        }
    )}
)
})

*/

setTimeout(function(){
_formataDatatable()
}, 1000);

setTimeout(function(){
$('.bg-success').fadeOut("slow");
$('.bg-danger').fadeOut("slow");
}, 4000);
