// popula o botão de entregar documentos despachante
    $.getJSON('/fornecedores/controle-despachantes/listar-despachantes/' + unidade, function(dados){
        $.each(dados, function(key, item) {
            var botaodespachante = '<option value="'+item.idDespachante+'">'+item.nomeDespachante+'</option>' 
            $(botaodespachante).appendTo('#inputGroupSelect02')
            
        })
    })