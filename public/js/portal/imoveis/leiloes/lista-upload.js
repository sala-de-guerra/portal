$(document).ready(function(){
    $.getJSON('/testeExcel/lista', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                '<tr>' +
                    '<td>' + item.Nome + '</td>' +
                    '<td>' + item.Matricula + '</td>' +
                    '<td>' + item.funcao + '</td>' +
                '</tr>';          
    
    // popula toda tabela de leiloeiro
    $(linha).appendTo('#tblimportexcel>tbody');
        }
    )}
    )
})