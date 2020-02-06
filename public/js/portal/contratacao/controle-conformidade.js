$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.getJSON('/estoque-imoveis/conformidade-contratacao/listar-contratos', function(dados){
        $.each(dados, function(key, item) {

            elementoLinkServidor = "'#linkServidor" + item.numeroContrato + "'";

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
                '<td>' + item.dataEntradaConformidade + '</td>' +
                '<td>' +
                    '<div class="row">' +
                        '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoLinkServidor + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                        '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden>ALO</a>' +
                    '</div>' +
                '</td>' +
            '</tr>';
            
            $(linha).appendTo('#tblConformidadeFluxoAgencia>tbody');

        });

        _formataValores();
        _formataDatatable ();
    });

}); 

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr('href')).select();
    document.execCommand("copy");
    $temp.remove();

    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'success',
            title: 'Copiado com sucesso!'
        })    
    })
}