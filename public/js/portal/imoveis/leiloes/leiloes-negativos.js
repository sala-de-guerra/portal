
$(document).ready(function(){
    var unidade = $('#lotacao').text()
    var str = unidade
    var unidade = str.replace(/\D/g, "");
    $.getJSON('/estoque-imoveis/leiloes-negativos/listar-leiloes/'+ unidade, function(dados){
        $.each(dados, function(key, item) {
            dataLeilaoNegativo = item.dataSegundoLeilao
            var linha =
                '<tr href="/estoque-imoveis/leiloes-negativos/contratos/'+ item.dataSegundoLeilao+'" class="cursor-pointer">'+
                    '<td>' + item.numeroLeilao + '</td>' +
                    '<td>' + item.numeroContrato + '</td>' +
                    '<td class="formata-data-sem-hora">'+ item.dataSegundoLeilao + '</td>'+
                '</tr>';

                $(linha).appendTo('#tblleiloesnegativos>tbody');
        })
        _formataData();
        _formataDatatableComData()
    })
    $('#tblleiloesnegativos tbody').on('click', 'tr', function () {
        var href = $(this).attr("href");            
        if (href == undefined) {
            document.location.href = '/estoque-imoveis/leiloes-negativos';
        } else {
            document.location.href = href;
        };
    });  
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
})
setTimeout(function(){
    $('.bg-danger').fadeOut("slow");
    }, 2000);
   