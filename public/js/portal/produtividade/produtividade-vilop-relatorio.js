function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "desc" ]],     
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


$('#listagemFTE').click(function(){
    $('#iconeFTE').toggleClass('fa fa-angle-double-up fa fa-angle-double-down');
});

$('#listagemProdutividade').click(function(){
    $('#iconeProdutividade').toggleClass('fa fa-angle-double-up fa fa-angle-double-down');
});

   
$(document).ready(function(){
    $(".menu-hamburguer").click(); 
/*
    $.getJSON('relatorio/unidade', function(dados){
       $.each(dados, function(key, item) {
        if (item.CGC_UNIDADE == $('#unidade').text()){
        let produtividade = item.Produtividade
        let desempenho = item.Desempenho
        let pessoas = item.Pessoas
        let fte = item.FTE

        $('#produtividadeUnidade').html('<b>'+parseFloat(produtividade).toFixed(2)+'</b> <sup style="font-size: 20px">%</sup>' )
        $('#desempenhoUnidade').html('<b>'+parseFloat(desempenho).toFixed(2)+'</b> <sup style="font-size: 20px">%</sup>' )
        $('#pessoasUnidade').html('<b>'+parseFloat(pessoas).toFixed(2)+'</b> <sup style="font-size: 20px">%</sup>' )
        $('#fteUnidade').html('<b>'+parseFloat(fte).toFixed(2)+'</b> <sup style="font-size: 20px">%</sup>' )

        $('#lapUnidade').html('<b>'+ lapUnidade +'</b>')
        $('#totalMicroatividades').html('<b>'+ totalMicroatividades +'</b>')
        $('#totalHorasAlocadas').html('<b>'+ totalHorasAlocadas +'</b>')
        $('#totalUplopHora').html('<b>'+ totalUplopHora +'</b>')
        $('#totalUplopDevidaUnidade').html('<b>'+ totalUplopDevidaUnidade +'</b>')
        $('#totalUplopProduzidaUnidade').html('<b>'+ totalUplopProduzidaUnidade +'</b>')
        $('#totalUplopDevidaEmpregado').html('<b>'+ totalUplopDevidaEmpregado +'</b>')
        $('#totalUplopProduzidaEmpregado').html('<b>'+ totalUplopProduzidaEmpregado +'</b>')
        $('#totalLapLiquida').html('<b>'+ totalLapLiquida +'</b>')

        $('#fteApuradaMensuravel').html('<b>'+ fteApuradaMensuravel +'</b> <sup style="font-size: 20px">%</sup>')
        $('#fteTecnicaMensuravel').html('<b>'+ fteTecnicaMensuravel +'</b>')
        $('#fteNaoMensuravel').html('<b>'+ fteNaoMensuravel +'</b>')
        $('#fteGestores').html('<b>'+ fteGestores +'</b>')
        $('#fteAfastados').html('<b>'+ fteAfastados +'</b>')

    }
      })
    })
*/
    $.getJSON('/produtividade-vilop/api/relatorio-geral/' + unidade, function(dados){
        $.each(dados, function(key, item) {{

            var macroprocesso = item.DE_MACRO

            cardMacro =
                $(this).addClass("cardMacroprocesso")

            let lista = 
            `
                <tr>
                    <td>c${digitoMatricula}${Matricula}-${Digito}</td>
                    <td style="white-space: nowrap;">${item.nomeColaborador}</td>
                    <td>${Funcao}</td>
                    <td></td>
                    <td style="white-space: nowrap;">
                        <button type="button" id="enquadra${item.matricula}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarEnquadra${item.matricula}">
                            <i class="fas fa-edit"></i> Editar Enquadramento
                        </button>

                    </td>
                </tr>
            `
            $(lista).appendTo('#>tbody');

        }
    })
  })
});