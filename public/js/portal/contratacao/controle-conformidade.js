$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.getJSON('/estoque-imoveis/conformidade-contratacao/listar-contratos', function(dados){
        $.each(dados, function(key, item) {
            var linha =
            '<tr>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td>' + item.fluxoContratacao + '</td>' +
                '<td>' + item.codigoAgencia + '</td>' +
                '<td>' + item.tipoVenda + '</td>' +
                '<td>' + item.tipoProposta + '</td>' +
                '<td class="formata-valores">' + item.valorRecursosProprios + '</td>' +
                '<td class="formata-valores">' + item.valorTotalRecebido + '</td>' +
                '<td>' + item.statusContratacao + '</td>' +
                '<td>' + item.cardAgrupamento + '</td>' +
                '<td class="formata-data-sem-hora">' + item.dataEntradaConformidade + '</td>' +
                '<td>' +
                    '<div class="row">' +
                        '<button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link" onclick="copyToClipboard("#linkServidor")"><i class="far fa-copy"></i></button>' +
                        '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor">\\sp7257sr001\PUBLIC\EstoqueImoveis\ + item.contratoFormatado + </a>' +
                    '</div>' +
                '</td>' +
            '</tr>';
            
            $(linha).appendTo('#tblConformidade>tbody');
        });
        _formataDatatable ();
    });

})