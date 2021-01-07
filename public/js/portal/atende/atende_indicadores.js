var csrfVar = $('meta[name="csrf-token"]').attr('content');

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "asc" ]],

       columnDefs: [
           {type: 'date-uk', targets: [3]} //vai filtrar a coluna com data dd/mm/yyyy
        ],
       
        "pageLength": 10,
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


$(document).ready( function () {
    $.getJSON('/atende/total-atende-vencido', function(dados){
        $.each(dados, function(key, item) {  
       
        $('#totalVencidos').text(totalAtendesVencidos)
    })
    }).done(function() {
    })
})


/* 
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {

    type: 'line',

    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    options: {}
});
*/

    


/*
$(document).ready( function () {
    $.getJSON('/indicadores/indicadores-atende', function(dados){
        $.each(dados, function(key, item) {

            let linha =
            `<tr>
                <td>${item.usuario}</td>
                <td>${item.AtendeNovos}</td>
                <td>${item.AtendeTratados}</td>
                <td>${item.AtendePendentes}</td>
                <td>${item.AtendeVencidos}</td>
                <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                </td>
            </tr>`



    $(linha).appendTo('#tblIndicadorAtende>tbody');

    ('#dataHoraCaptura').text(item.dataEHoraCaptura +'h')
})

}).done(function() {
    _formataDatatableComData("tblIndicadorAtende")

})
});

*/



setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
  }, 2000);