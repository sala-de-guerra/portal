$(document).ready(function(){
    $.getJSON('/controle-arquivos/lista', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                '<tr>' +
                    '<td>' + item.Contrato + '</td>' +
                    '<td>' + item.caixa + '</td>' +
                    '<td>' + item.silog + '</td>' +
                '</tr>';          
    
    // popula toda tabela de leiloeiro
    $(linha).appendTo('#tblimportexcel>tbody');
        }
    )}
    )
})

setTimeout(function(){
    $('.bg-success').fadeOut("slow");
    }, 2000);