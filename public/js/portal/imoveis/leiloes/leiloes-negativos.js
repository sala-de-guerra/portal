var gilie = $('#lotacao').text()

$(document).ready(function(){
    $.getJSON('/estoque-imoveis/leiloes-negativos/listar-contratos/' + gilie, function(dados){
        $.each(dados, function(key, item) {
            var linha =
            '<tr href="/estoque-imoveis/leiloes-negativos/tratar/'+ item.contratoFormatado+'" class="cursor-pointer">'+
                '<td>'+ item.numeroContrato + '</td>' + '</a>'+
                '<td>' + item.numeroLeilao + '</td>' +
                '<td class="replaceData'+item.numeroContrato+'">' + item.dataAlteracao + '</td>' +
                '<td>' + item.statusAverbacao + '</td>' +
            '</tr>' 

      
  
$(linha).appendTo('#tblleiloesnegativos>tbody');
        

var data = $('.replaceData'+item.numeroContrato).text()
var novaData = data.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
$('.replaceData'+item.numeroContrato).text(novaData)
            })
            // _formataDatatableComData()
        })
    $('#tblleiloesnegativos tbody').on('click', 'tr', function () {
        var href = $(this).attr("href");            
        if (href == undefined) {
            document.location.href = '/estoque-imoveis/distrato';
        } else {
            document.location.href = href;
        };
    });  
})
$(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});

   