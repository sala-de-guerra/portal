$(document).ready( function () {

    $.getJSON('corretores/lista-corretores', function(dados){

        $.each(dados, function(key, item) {
            var hoje = new Date()
            var dataVencimento = item.DT_VENCIMENTO_CONTRATO
            var transformaData = dataVencimento.split(/\//).reverse().join('/')
            var data = new Date(transformaData)
            dataFormatada = moment(data).format('DD/MM/YYYY');
          
            let linha =
                `<tr>
                    <td>${item.NO_CORRETOR}</td>
                    <td>${item.NU_CRECI}</td>
                    <td id="telefone${item.NU_CRECI}">(${item.CO_DDD_CELULAR})`+" "+`${item.CO_TELEFONE_CELULAR}</td>
                    <td>${item.ED_EMAIL_PESSOA}</td>
                    <td>${dataFormatada}</td>
                </tr>`

                if (data >= hoje){
                    $(linha).appendTo('#tblCorretores>tbody');
                   }
            
            if($('#telefone' + item.NU_CRECI).text() == "(null) null" ||
                $('#telefone' + item.NU_CRECI).text() == "(Null) Null"){
                $('#telefone' + item.NU_CRECI).text("")
            }
        
        });
    });
});

setTimeout(function(){ 
    $('.dataTable').DataTable({
        "order": [[ 0, "asc" ]],
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
}, 3000);
