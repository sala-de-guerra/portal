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
        
        // popula toda tabela de leiloeiro
        $(linha).appendTo('#tblimportexcel>tbody');
            }
        )}
    )
})

setTimeout(function(){
    _formataDatatable()
    }, 1000);

setTimeout(function(){
    $('.bg-success').fadeOut("slow");
    $('.bg-danger').fadeOut("slow");
    }, 4000);
